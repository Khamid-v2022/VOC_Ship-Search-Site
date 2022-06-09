<?php

class MY_Controller extends CI_Controller {
    
    public $data;

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('America/Los_Angeles');
    }

    public function generate_json($msg, $status = true){
        $resp['status'] = $status;
        $resp['msg'] = $msg;
        echo json_encode($resp);
    }

    public function get_day_name($date){
        $days = array('Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa');

        return $days[date("w", strtotime($date))];
    }

}