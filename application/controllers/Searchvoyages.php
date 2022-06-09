<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Searchvoyages extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library("excel");
        $this->load->model('ship_m');
    }

	public function index()
	{
		$data['primary_menu'] = 'Search Voayges';

		$data['directions'] = $this->ship_m->get_grouped_fields('direction', 'voyages');
		$data['chambers'] = $this->ship_m->get_grouped_fields('chamber', 'voyages');
		$data['arrivals'] = $this->ship_m->get_grouped_fields('port_arrival', 'voyages');
		$data['departures'] = $this->ship_m->get_grouped_fields('port_departure', 'voyages');
		$data['shipwrecks'] = $this->ship_m->get_grouped_fields('shipwreck', 'ships');
		$data['wreck_regions'] = $this->ship_m->get_grouped_fields('wreck_region', 'ships');

		$this->load->view('header', $data);
		$this->load->view('Search_voyages');
		$this->load->view('footer');
	}

	
	public function get_table(){
		$req = $this->input->post();

		$list = $this->ship_m->get_voyage_list($req);
	
		$data = [];
		
		for($index = 0; $index < count($list); $index++){
			$row = $list[$index];

			$array_item = array($row['ship_nr'], $row['ship_name'], $row['direction'], $row['captain'], $row['chamber'], $row['departure_date'], $row['port_departure'], $row['cape_at_date'], $row['cape_from_date'], $row['arrival_date'], $row['port_arrival']);

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

	public function upload_data_from_excel(){
		$inputFileName = APPPATH . 'Voyages.xlsx';
		$object = PHPExcel_IOFactory::load($inputFileName);

		foreach($object->getWorksheetIterator() as $worksheet){
			$highestRow = $worksheet->getHighestRow();
			$highestColumn = $worksheet->getHighestColumn();
			for($row = 2; $row <= $highestRow; $row++){
				$item['id'] = $row - 1;
				$item['ship_nr'] = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
				$item['ship_name'] = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
				$item['voyage_nr'] = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
				$item['direction'] = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
				$item['captain'] = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
				$item['chamber'] = $worksheet->getCellByColumnAndRow(5, $row)->getValue();

				$dd = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
				$mm = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
				$yy = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
				$item['departure_date'] = $yy . '-' . $mm . '-' . $dd;
				
				$item['streepje_1'] = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
				$item['streepje_2'] = $worksheet->getCellByColumnAndRow(9, $row)->getValue();

				$item['streepje_3'] = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
				$item['streepje_4'] = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
				$item['streepje_5'] = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
				$item['streepje_6'] = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
				$item['streepje_7'] = $worksheet->getCellByColumnAndRow(23, $row)->getValue();
				$item['streepje_8'] = $worksheet->getCellByColumnAndRow(25, $row)->getValue();

				$item['port_departure'] = $worksheet->getCellByColumnAndRow(11, $row)->getValue();

				$dd = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
				$mm = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
				$yy = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
				$item['cape_at_date'] =  $yy . '-' . $mm . '-' . $dd;

				$dd = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
				$mm = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
				$yy = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
				$item['cape_from_date'] =  $yy . '-' . $mm . '-' . $dd;

				$dd = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
				$mm = $worksheet->getCellByColumnAndRow(24, $row)->getValue();
				$yy = $worksheet->getCellByColumnAndRow(26, $row)->getValue();
				$item['arrival_date'] = $yy . '-' . $mm . '-' . $dd;

				$item['port_arrival'] = $worksheet->getCellByColumnAndRow(27, $row)->getValue();
				$item['voyage_particulars'] = $worksheet->getCellByColumnAndRow(28, $row)->getValue();
				$item['corr_voyage_nr'] = $worksheet->getCellByColumnAndRow(29, $row)->getValue();
				$data[] = $item;
			}
		}

		$count = $this->ship_m->add_list('voyages', $data);
		$this->generate_json($count);
	}

}
