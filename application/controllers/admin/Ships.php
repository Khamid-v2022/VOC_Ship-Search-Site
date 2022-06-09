<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/admin/Base_Controller.php';

class Ships extends Base_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->library("excel");
        $this->load->model('ship_m');
    }

	public function index() {
		$data['primary_menu'] = 'Ships';
		$data['new_number'] = (int)$this->ship_m->get_ship_max_number() + 1;
		
		$this->load->view('admin/header', $data);
		$this->load->view('admin/ships', $data);
		$this->load->view('template/footer');
	}

	public function get_ships(){
		$list = $this->ship_m->get_list('ships');
	
		$data = [];
		
		for($index = 0; $index < count($list); $index++){
			// $edit = "<button type='button' class='btn border-info text-info-600 btn-flat btn-icon' onclick='edit_ship(" . $list[$index]['id'] . ")' title='edit'><i class='icon-pencil'></i></button>";
			$edit = "<a href='javascript:edit_ship(" . $list[$index]['id'] . ")' title='edit'>" . $list[$index]['ship_name'] . "</a>";
			$bin = "<button type='button' class='btn border-warning text-warning-600 btn-flat btn-icon position-right' onclick='delete_ship(" . $list[$index]['id'] . ")' title='delete'><i class='icon-bin'></i></button>";

			$array_item = array($list[$index]['ship_nr'], $edit, $list[$index]['tonnage'], $list[$index]['type_of_ship'], $list[$index]['year_build'], $list[$index]['yard_build'], $list[$index]['wreck_region'], $list[$index]['ship_extra_info'], $list[$index]['mentioned_first'], $list[$index]['mentioned_last'], $list[$index]['shipwreck'], $list[$index]['shipwreck_story'], $list[$index]['fate_of_ship'], $bin);

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

	public function delete_ship($id){
		$this->ship_m->delete_item('ships', array('id' => $id));
		$this->generate_json("Deleted");
	}

	public function save_ship(){
		$req = $this->input->post();

		if($req['action_type'] == 'edit'){
			$where['id'] = $req['sel_id'];
			unset($req['sel_id']);
			unset($req['action_type']);

			$this->ship_m->update_item('ships', $req, $where);
			$this->generate_json("Updated");
		}else{
			unset($req['sel_id']);
			unset($req['action_type']);

			$this->ship_m->add_item('ships', $req);
			$this->generate_json("Added");
		}
	}

	public function upload_data_from_excel(){
		$inputFileName = APPPATH . 'Table.xlsx';
		$object = PHPExcel_IOFactory::load($inputFileName);
		foreach($object->getWorksheetIterator() as $worksheet){
			$highestRow = $worksheet->getHighestRow();
			$highestColumn = $worksheet->getHighestColumn();
			for($row = 2; $row <= $highestRow; $row++){
				$item['id'] = $row - 1;
				$item['ship_nr'] = $worksheet->getCellByColumnAndRow(0, $row)->getValue();

				$item['ship_name'] = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
				$item['tonnage'] = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
				$item['type_of_ship'] = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
				$item['year_build'] = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
				$item['yard_build'] = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
				$item['wreck_region'] = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
				$item['ship_extra_info'] = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
				$item['mentioned_first'] = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
				$item['mentioned_last'] = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
				$item['shipwreck'] = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
				$item['shipwreck_story'] = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
				$item['fate_of_ship'] = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
				$item['shipwreck_story_txt'] = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
				

				$data[] = $item;
			}
		}

		$count = $this->ship_m->add_list('ships', $data);
		$this->generate_json($count);
	}
}
