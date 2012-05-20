<?php
#include_once (realpath(dirname(__FILE__) . "/" . "base.php"));

class Graphs extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function view() {
        $this->load->view('graphs.php');
    }
}
