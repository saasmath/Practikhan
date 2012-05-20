<?php
include_once (realpath(dirname(__FILE__) . "/" . "base.php"));

class Graphs extends Base {

    function __construct() {
        parent::__construct();
    }

    public function view() {
        $this->load->view('graphs.php', $this->page_data);
    }
    public function edit() {
        $this->load->view('code-edit.php', $this->page_data);
    }
}
