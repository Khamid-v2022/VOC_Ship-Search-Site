var table = null;

$(function() {

    $('#voyages_modal').on('hidden.bs.modal', function() {
        $(this).find('form').trigger('reset');
    });

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

    $("#m_form :input").change(function() {
       // $("#m_form").data("changed",true);
       $("#m_submit_btn").css({display:"inline-block"})
    });

    $("#m_form").submit(function(event) {
        /* stop form from submitting normally */
        event.preventDefault();

        if (!event.target.checkValidity()) {
            return false;
        }
        save();
    });
})

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
            'url': SITE_URL + 'admin/search_voyages/get_table',
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
                let total_count = data['responseJSON'].recordsTotal;
                $("#total_count").html(total_count.toLocaleString());
                is_loading = false;
            }
        },
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, 'All'],
        ],
        
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

var add_voyages = function(){
    $(".action-type").html("Add");
    $("#m_action_type").val("add");
    $("#m_submit_btn").css({display:"none"});

    $("#voyages_modal").modal();
}

function save(){    
    $(".icon-spinner10").css({display:"inline-block"});
    $("#m_submit_btn").attr("disabled", true);
    $.post(SITE_URL + 'admin/search_voyages/save_voyages', 
        {
            action_type: $("#m_action_type").val(),
            sel_id: $("#m_sel_id").val(),
            
            ship_nr: $("#m_ship_nr").val(),
            ship_name: $("#m_ship_name").val(),
            voyage_nr: $("#m_voyage_nr").val(),
            direction: $("#m_direction").val(),
            captain: $("#m_captain").val(),
            chamber: $("#m_chamber").val(),
            streepje_1: $("#m_streepje_1").val(),
            streepje_2: $("#m_streepje_2").val(),
            streepje_3: $("#m_streepje_3").val(),
            streepje_4: $("#m_streepje_4").val(),
            streepje_5: $("#m_streepje_5").val(),
            streepje_6: $("#m_streepje_6").val(),
            streepje_7: $("#m_streepje_7").val(),
            streepje_8: $("#m_streepje_8").val(),
            departure_date: $("#m_departure_date").val(),
            cape_at_date: $("#m_cape_at_date").val(),
            cape_from_date: $("#m_cape_from_date").val(),
            arrival_date: $("#m_arrival_date").val(),
            port_departure: $("#m_port_departure").val(),
            port_arrival: $("#m_port_arrival").val(), 
            corr_voyage_nr: $("#m_corr_voyage_nr").val(),
            voyage_particulars: $("#m_voyage_particulars").val(),
        }, 
        function(resp){
            resp = JSON.parse(resp);
            $(".icon-spinner10").css({display:"none"});
            $("#m_submit_btn").removeAttr("disabled");
            if(resp.status){
                $("#voyages_modal").modal('toggle');
                reload_table();
            }else{
                swal({
                    title: resp.msg,
                    type: "error",
                    confirmButtonColor: "#2196F3"
                }, function(){
                    return;
                });
            }
        })
}

function show_voyages(id){
    $(".action-type").html("Edit");
    $("#m_action_type").val("edit");
    $("#m_submit_btn").css({display:"none"});

    $("#m_sel_id").val(id);

    $.post(SITE_URL + 'admin/search_voyages/get_info/' + id, function(resp){
        resp = JSON.parse(resp);
        if(resp.status){
            let info = resp.msg;

            $("#m_ship_nr").val(info.ship_nr);
            $("#m_ship_name").val(info.ship_name);
            $("#m_voyage_nr").val(info.voyage_nr)
            $("#m_direction").val(info.direction)
            $("#m_captain").val(info.captain)
            $("#m_chamber").val(info.chamber)
            $("#m_streepje_1").val(info.streepje_1)
            $("#m_streepje_2").val(info.streepje_2)
            $("#m_streepje_3").val(info.streepje_3)
            $("#m_streepje_4").val(info.streepje_4)
            $("#m_streepje_5").val(info.streepje_5)
            $("#m_streepje_6").val(info.streepje_6)
            $("#m_streepje_7").val(info.streepje_7)
            $("#m_streepje_8").val(info.streepje_8)
            $("#m_departure_date").val(info.departure_date)
            $("#m_cape_at_date").val(info.cape_at_date)
            $("#m_cape_from_date").val(info.cape_from_date)
            $("#m_arrival_date").val(info.arrival_date)
            $("#m_port_departure").val(info.port_departure)
            $("#m_port_arrival").val(info.port_arrival)
            $("#m_corr_voyage_nr").val(info.corr_voyage_nr)
            $("#m_voyage_particulars").val(info.voyage_particulars)
        }
    })

    $("#voyages_modal").modal();
}

function delete_voyages(id){
    $("#data_table").find(".delete-item-btn").map(function(){  
        let item_id = $(this).attr('item_id');
        if(id == item_id){
            $(this).attr("disabled", true);
        }
    });
    $.post(SITE_URL + 'admin/search_voyages/delete_voyages/' + id, function(resp){
        resp = JSON.parse(resp)
        if(resp.status){
            reload_table();
        }
    })
}