var table = null;
$(function() {
   
    $.extend( $.fn.dataTable.defaults, {
        // autoWidth: true,
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

    $(".alphabet-btn").on('click', function(){
        $('.alphabet-btn').removeClass('active');
        $(this).addClass('active');
        reload_table();
    })

    $('.search-select-2').select2({
        // minimumResultsForSearch: Infinity,
        // width: 'auto'
    });

    $('.search-select-2').on('change', function(){
        reload_table();
    })

    reload_table();
    
});

var reload_table = function(){
    let selected_key = $(".alphabet-btn.active").attr("sel_key");
    if(!selected_key)
        selected_key = '';

    if(table)
        table.destroy();
    table = $('.datatable-ajax').DataTable({
        ajax: {
            'type': 'POST',
            'url': SITE_URL + 'searchships/get_ships',
            'data' : {
                ship_name : $("#ship_name").val(),
                ship_type : $("#ship_type").val(),
                yard_build : $("#yard_build").val(),
                selected_key: selected_key
            },
            complete: function(data){
                let total_count = data['responseJSON'].recordsTotal;
                $("#total_count").html(total_count.toLocaleString());
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

function show_ship(id){
    $.post(SITE_URL + 'searchships/get_ship_info/' + id, function(resp){
        resp = JSON.parse(resp);
        if(resp.status){
            let info = resp.msg;
            $("#m_ship_nr").val(info.ship_nr);
            $("#m_ship_name").val(info.ship_name);
            $("#m_tonnage").val(info.tonnage);
            $("#m_type_of_ship").val(info.type_of_ship);
            $("#m_year_build").val(info.year_build);
            $("#m_yard_build").val(info.yard_build);
            $("#m_wreck_region").val(info.wreck_region);
            $("#m_ship_extra_info").val(info.ship_extra_info);
            $("#m_mentioned_first").val(info.mentioned_first);
            $("#m_mentioned_last").val(info.mentioned_last);
            $("#m_shipwreck").val(info.shipwreck);
            $("#m_shipwreck_story").val(info.shipwreck_story);
            $("#m_fate_of_ship").val(info.fate_of_ship);
            $("#m_shipwreck_story_txt").val(info.shipwreck_story_txt);
        }
    })

    $("#ship_modal").modal();
}

function show_all(){
    $('.alphabet-btn').removeClass('active');
    $("#ship_name").val("").trigger("change");
    $("#ship_type").val("").trigger("change");
    $("#yard_build").val("").trigger("change");
}
