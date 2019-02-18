<?php
  class TableStatic extends CI_Controller {
    public function __construct() {
      parent::__construct();
      // Load form helper
      $this->load->helper('form');
      // Load table library
      $this->load->library('table');
    }

    // Show table page
    public function index() {
      $this->load->view('table_view');
    }
  }

?>