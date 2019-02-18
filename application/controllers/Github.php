<?php

  defined('BASEPATH') OR exit('No direct script access allowed');
  require_once('GithubApi.php');

  class Github extends GithubApi { // CI_Controller

    public function __construct() {
      parent::__construct();
      $this->load->helper('url');
    }

    public function index() {
      redirect('Github/loadRecord');
    }

    public function loadRecord() {

      $this->load->helper(array('form'));
      $this->load->library('form_validation');

      $this->form_validation->set_rules('url-commit', 'Url Commit', 'required');
      $this->form_validation->set_rules('start-date', 'Start Date', 'required');
      $this->form_validation->set_rules('end-date', 'End Date', 'required');
                

      if ($this->form_validation->run() == FALSE)
      {
        $this->load->view('templates/header');
        $this->load->view('github/formView');
      }
      else
      {
        $this->load->view('templates/header');
        $this->load->view('github/formView');
        
        // Load view
        if ($this->getData() != array()) 
        {
          $this->load->view('github/postView');
        }
      }
    }

    public function get_commits() {
      $draw = intval($this->input->get("draw"));
      $start = intval($this->input->get("start"));
      $length = intval($this->input->get("length"));

      $fileNames = $this->getData();
      
      $data = array();

      foreach ($fileNames as $file => $value) {

        $authors = "";
        $countCommits = 0;
        foreach ($value as $key => $value) {
          $authors .= $key.": ".$value." ";
          $countCommits += $value;
        }

        $data[] = array(
          $file,
          $countCommits,
          $authors
        );

      }

      $output = array(
        "draw" => $draw,
        "recordsTotal" => count($fileNames),
        "recordsFiltered" => count($fileNames),
        "data" => $data
      );

      echo json_encode($output);
      exit;
    }

    public function view($slug = 'search')
    {
      $data['title'] = 'Github Repository';
      $this->load->view('templates/header', $data);
      $this->load->view('github/search', $data);
      $this->load->view('templates/footer');
    }

    public function search()
    {
      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $data['title'] = 'Create a search item';
      $this->form_validation->set_rules('title', 'Title', 'required');
      $this->form_validation->set_rules('text', 'Text', 'required');
      if ($this->form_validation->run() === FALSE)
      {
        $this->load->view('templates/header', $data);
        $this->load->view('github/search');
        $this->load->view('templates/footer');
      }
      else
      {
        $this->load->view('templates/header', $data);
        $this->load->view('news/success');
        $this->load->view('templates/footer');
      }
    }
  }