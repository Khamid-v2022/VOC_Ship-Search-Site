<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'controllers/admin/Base_Controller.php';

class Search_ships extends Base_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('ship_m');
    }

	public function index() {
		$data['primary_menu'] = 'Search Ships';

		$data['ship_names'] = $this->ship_m->get_grouped_fields('ship_name', 'ships');
		$data['ship_types'] = $this->ship_m->get_grouped_fields('type_of_ship', 'ships');
		$data['yard_build'] = $this->ship_m->get_grouped_fields('yard_build', 'ships');
		
		$this->load->view('admin/header', $data);
		$this->load->view('admin/search_ships', $data);
		$this->load->view('template/footer');
	}

	public function get_ships(){
		$req = $this->input->post();

		$list = $this->ship_m->get_ship_list($req['ship_name'], $req['ship_type'], $req['yard_build'], $req['selected_key']);
	
		$data = [];
		
		for($index = 0; $index < count($list); $index++){
			$edit = "<a href='javascript:show_ship(" . $list[$index]['id'] . ")' title='Show detail'>" . $list[$index]['ship_name'] . " (" . $list[$index]['mentioned_first'] . ' ~ ' . $list[$index]['mentioned_last'] . ")</a>";
			
			$array_item = array($list[$index]['ship_nr'], $edit, $list[$index]['type_of_ship'], $list[$index]['year_build'], $list[$index]['yard_build']);

			$data[] = $array_item;
		}

		$result = array(      
	        "recordsTotal" => count($list),
	        "recordsFiltered" => count($list),
	        "data" => $data
	    );

	    echo json_encode($result);
	    exit();
	}

	public function get_ship_info($id){
		$info = $this->ship_m->get_item('ships', array('id'=>$id));
		$this->generate_json($info);
	}

}
