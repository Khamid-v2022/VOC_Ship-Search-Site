var table = null;

$(function() {
	// $('.pickadate').pickadate({
 //        // labelMonthNext: 'Go to the next month',
 //        // labelMonthPrev: 'Go to the previous month',
 //        // labelMonthSelect: 'Pick a month from the dropdown',
 //        // labelYearSelect: 'Pick a year from the dropdown',
 //        selectMonths: true,
 //        selectYears: true,
 //        weekdaysShort: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
 //        showMonthsShort: true,
 //        today: '',
 //        close: '',
 //        clear: 'Clear selection',
 //        format: 'yyyy-mm-dd',
 //        min: [1400,1,1],
 //        max: [2020,11,31]
 //    });

	$.extend( $.fn.dataTable.defaults, {
        autoWidth: true,
        width: 100,
        columnDefs: [],
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Search:</span> _INPUT_',
            lengthMenu: '<span>rows per page:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });

	$('.search-select-2').select2({
        // minimumResultsForSearch: Infinity,
        // width: 'auto'
    });

    // $("#direction, #chamber, #port_arrival, #port_departure, #shipwreck, #location, #date_at_cape, #date_from_cape, #date_arrival").on("change", function(){
    $("#direction, #chamber, #port_arrival, #port_departure, #date_at_cape, #date_from_cape, #date_arrival").on("change", function(){
    	
    	setTimeout(function(){
			reload_table();
	    }, 100);
    })

    reload_table();
})

function upload_data_from_excel(){
    $.post(SITE_URL + 'Searchvoyages/upload_data_from_excel', function(resp){
    	console.log(resp);
    })
}


var is_loading = false;

var reload_table = function(){
	if(is_loading)
		return;
	
	is_loading = true;
    if(table)
        table.destroy();
    table = $('.datatable-ajax').DataTable({
        ajax: {
            'type': 'POST',
            'url': SITE_URL + 'searchvoyages/get_table',
            'data' : {
                direction : $("#direction").val(),
                chamber : $("#chamber").val(),
                port_arrival : $("#port_arrival").val(),
                port_departure: $("#port_departure").val(),
                // shipwreck: $("#shipwreck").val(),
                // wreck_region: $("#location").val(),
                cape_at_date: $("#date_at_cape").val(),
                cape_from_date: $("#date_from_cape").val(),
                arrival_date: $("#date_arrival").val()
            },
            complete: function(data){
                console.log(data['responseJSON']);
                is_loading = false;
            }
        }
        
        // "order": [[ 1, "asc" ]]
    });

    // Add placeholder to the datatable filter option
    $('.dataTables_filter input[type=search]').attr('placeholder','Please enter the keyword');

    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });
}

var show_all = function(){
	$("#direction").val("").trigger('change');
    $("#chamber").val("").trigger('change');
    $("#port_arrival").val("").trigger('change');
    $("#port_departure").val("").trigger('change');
    // $("#shipwreck").val("").trigger('change');
    // $("#location").val("").trigger('change');
    $("#date_at_cape").val("");
    $("#date_from_cape").val("");
    $("#date_arrival").val("");
}