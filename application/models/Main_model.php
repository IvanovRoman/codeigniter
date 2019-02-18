<?php

  if (!defined('BASEPATH'))
    exit('No direct script access allowed');

  class Main_model extends CI_Model {
    
    public function __construct() {
      $this->load->database();
    }

    // Fetch records
    public function getData($rowno, $rowperpage, $sortBy, $order) {
      $this->db->select('*');
      $this->db->from('posts');
      $this->db->order_by($sortBy, $order);
      $this->db->limit($rowperpage, $rowno);
      $query = $this->db->get();

      return $query->result_array();
    }

    // Select total records
    public function getRecordCount() {
      $this->db->select('count(*) as allcount');
      $this->db->from('posts');
      $query = $this->db->get();
      $result = $query->result_array();
      
      return $result[0]['allcount'];
    }
  }

