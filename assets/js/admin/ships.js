var table = null;
$(function() {
    $('#ship_modal').on('hidden.bs.modal', function() {
        $(this).find('form').trigger('reset');
    });
    

    $.extend( $.fn.dataTable.defaults, {
        // autoWidth: true,
        columnDefs: [{ 
            orderable: false,
            width: '120px',
            targets: [ 13 ],
            className: 'text-center', 
        }],
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

    reload_table();

    $("#m_form").submit(function(event) {
        /* stop form from submitting normally */
        event.preventDefault();

        if (!event.target.checkValidity()) {
            return false;
        }
        save();
    });

    $("#m_form :input").change(function() {
       // $("#m_form").data("changed",true);
       $("#m_submit_btn").css({display:"inline-block"})
    });
});

var reload_table = function(){
    if(table)
        table.destroy();
    table = $('.datatable-ajax').DataTable({
        ajax: SITE_URL + 'admin/ships/get_ships',
        // "order": [[ 1, "asc" ]]
    }).page.len(50).draw();

    // Add placeholder to the datatable filter option
    $('.dataTables_filter input[type=search]').attr('placeholder','Please enter the keyword');

    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });
}

function add_ship_modal(){
    $(".action-type").html("Add");
    $("#m_action_type").val("add");
    $("#m_submit_btn").css({display:"none"});

    $("#ship_modal").modal();
}

function edit_ship(id){
    $(".action-type").html("Edit");
    $("#m_action_type").val("edit");
    $("#m_submit_btn").css({display:"none"});

    $("#m_sel_id").val(id);

    $.post(SITE_URL + 'admin/ships/get_ship_info/' + id, function(resp){
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

function save(){    
    $(".icon-spinner10").css({display:"inline-block"});
    $("#m_submit_btn").attr("disabled", true);
    $.post(SITE_URL + 'admin/ships/save_ship', 
        {
            action_type: $("#m_action_type").val(),
            sel_id: $("#m_sel_id").val(),
            
            ship_nr: $("#m_ship_nr").val(),
            ship_name: $("#m_ship_name").val(),
            tonnage: $("#m_tonnage").val(),
            type_of_ship: $("#m_type_of_ship").val(),
            year_build: $("#m_year_build").val(),
            yard_build: $("#m_yard_build").val(),
            wreck_region: $("#m_wreck_region").val(),
            ship_extra_info: $("#m_ship_extra_info").val(),
            mentioned_first: $("#m_mentioned_first").val(), 
            mentioned_last: $("#m_mentioned_last").val(),
            shipwreck: $("#m_shipwreck").val(),
            shipwreck_story: $("#m_shipwreck_story").val(),
            fate_of_ship: $("#m_fate_of_ship").val(),
            shipwreck_story_txt: $("#m_shipwreck_story_txt").val()
        }, 
        function(resp){
            resp = JSON.parse(resp);
            $(".icon-spinner10").css({display:"none"});
            $("#m_submit_btn").removeAttr("disabled");
            if(resp.status){
                $("#ship_modal").modal('toggle');
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

function delete_ship(id){
    $.post(SITE_URL + 'admin/ships/delete_ship/' + id, function(resp){
        resp = JSON.parse(resp)
        if(resp.status){
            reload_table();
        }
    })
}

function upload_data_from_excel(){
    $.post(SITE_URL + 'admin/ships/upload_data_from_excel', function(){

    })
}