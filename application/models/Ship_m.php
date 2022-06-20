<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ship_m extends MY_Model{

	private $table_name = 'ships';

	public function get_ship_list($ship_name, $ship_type, $yard_build, $shipwreck, $wreck_region, $selected_key){
		$this->db->where("ship_name LIKE '" . $selected_key . "%'");
		if($ship_name)
			$this->db->where('ship_name LIKE "' . $ship_name . '"');
		if($ship_type)
			$this->db->where('type_of_ship LIKE "' . $ship_type . '"');
		if($yard_build)
			$this->db->where('year_build LIKE "' . $yard_build . '"');
		if($shipwreck)
			$this->db->where('shipwreck = "' . $shipwreck . '"');
		if($wreck_region)
			$this->db->where('wreck_region LIKE "%' . $wreck_region . '%"');

		return $this->db->get("ships")->result_array();
	}
	
	public function get_ship_max_number(){
		$this->db->select("MAX(ship_nr) AS max_ship_number");
		return $this->db->get($this->table_name)->row_array()['max_ship_number'];
	}

	public function get_grouped_fields($field_name, $table_name='ships'){
		$this->db->select($field_name);
		$this->db->group_by($field_name);
		return $this->db->get($table_name)->result_array();
	}

	public function get_voyage_list($req_array){
		// $this->db->select("v.*, s.shipwreck, s.wreck_region");
		$this->db->select("*");
		$this->db->from('voyages v');
		// $this->db->join('ships s', 'v.ship_nr = s.ship_nr', 'left');

		if($req_array['direction'])
			$this->db->where('direction LIKE "' . $req_array['direction'] . '"');
		if($req_array['chamber'])
			$this->db->where('chamber LIKE "' . $req_array['chamber'] . '"');
		if($req_array['port_arrival'])
			$this->db->where('port_arrival LIKE "' . $req_array['port_arrival'] . '"');
		if($req_array['port_departure'])
			$this->db->where('port_departure LIKE "' . $req_array['port_departure'] . '"');
		// if($req_array['shipwreck'])
		// 	$this->db->where('shipwreck LIKE "' . $req_array['shipwreck'] . '"');
		// if($req_array['wreck_region'])
		// 	$this->db->where('wreck_region LIKE "' . $req_array['wreck_region'] . '"');
		if($req_array['cape_at_date'])
			$this->db->where('cape_at_date LIKE "' . $req_array['cape_at_date'] . '"');
		if($req_array['cape_from_date'])
			$this->db->where('cape_from_date LIKE "' . $req_array['cape_from_date'] . '"');
		if($req_array['arrival_date'])
			$this->db->where('arrival_date LIKE "' . $req_array['arrival_date'] . '"');
		
		return $this->db->get()->result_array();
	}

	public function get_voyages_max_number(){
		$this->db->select("MAX(ship_nr) AS max_ship_number");
		return $this->db->get('voyages')->row_array()['max_ship_number'];
	}
}

?>