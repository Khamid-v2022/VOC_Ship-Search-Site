<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'controllers/admin/Base_Controller.php';

class Search_voyages extends Base_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('ship_m');
    }

	public function index() {
		$data['primary_menu'] = 'Search Voyages';

		$data['directions'] = $this->ship_m->get_grouped_fields('direction', 'voyages');
		$data['chambers'] = $this->ship_m->get_grouped_fields('chamber', 'voyages');
		$data['arrivals'] = $this->ship_m->get_grouped_fields('port_arrival', 'voyages');
		$data['departures'] = $this->ship_m->get_grouped_fields('port_departure', 'voyages');
		$data['shipwrecks'] = $this->ship_m->get_grouped_fields('shipwreck', 'ships');
		$data['wreck_regions'] = $this->ship_m->get_grouped_fields('wreck_region', 'ships');

		$data['new_number'] = (int)$this->ship_m->get_voyages_max_number() + 1;
		
		$this->load->view('admin/header', $data);
		$this->load->view('admin/search_voyages', $data);
		$this->load->view('template/footer');
	}

	public function get_table(){
		$req = $this->input->post();

		if($req['cape_at_date'])
			$req['cape_at_date'] = $this->changeDateFormat($req['cape_at_date'], false);
		if($req['cape_from_date'])
			$req['cape_from_date'] = $this->changeDateFormat($req['cape_from_date'], false);
		if($req['arrival_date'])
			$req['arrival_date'] = $this->changeDateFormat($req['arrival_date'], false);

		$list = $this->ship_m->get_voyage_list($req);
	
		$data = [];
		
		for($index = 0; $index < count($list); $index++){
			$row = $list[$index];

			$edit = '<a href="javascript:show_voyages(' . $row['id'] . ')">' . $row['ship_name'] . '</a>';
			
			$bin = "<button type='button' class='btn border-warning text-warning-600 btn-flat btn-icon position-right delete-item-btn' item_id='" . $row['id'] . "' onclick='delete_voyages(" . $row['id'] . ")' title='delete'><i class='icon-bin'></i></button>";

			$array_item = array($row['ship_nr'], $edit, $row['direction'], $row['captain'], $row['chamber'], $this->changeDateFormat($row['departure_date']), $row['port_departure'], $this->changeDateFormat($row['cape_at_date']), $this->changeDateFormat($row['cape_from_date']), $this->changeDateFormat($row['arrival_date']), $row['port_arrival'], $bin);

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

	public function get_info($id){
		$info = $this->ship_m->get_item('voyages', array('id'=>$id));
		$this->generate_json($info);
	}

	public function save_voyages(){
		$req = $this->input->post();

		if($req['departure_date'])
			$req['departure_date'] = $this->changeDateFormat($req['departure_date'], false);
		if($req['cape_at_date'])
			$req['cape_at_date'] = $this->changeDateFormat($req['cape_at_date'], false);
		if($req['cape_from_date'])
			$req['cape_from_date'] = $this->changeDateFormat($req['cape_from_date'], false);
		if($req['arrival_date'])
			$req['arrival_date'] = $this->changeDateFormat($req['arrival_date'], false);


		if($req['action_type'] == 'edit'){
			$where['id'] = $req['sel_id'];
			unset($req['sel_id']);
			unset($req['action_type']);

			$this->ship_m->update_item('voyages', $req, $where);
			$this->generate_json("Updated");
		}else{
			unset($req['sel_id']);
			unset($req['action_type']);

			$this->ship_m->add_item('voyages', $req);
			$this->generate_json("Added");
		}
	}

	public function delete_voyages($id){
		$this->ship_m->delete_item('voyages', array('id' => $id));
		$this->generate_json("Deleted");
	}

}
