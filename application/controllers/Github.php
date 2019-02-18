<?php

  defined('BASEPATH') OR exit('No direct script access allowed');
  require_once('GithubApi.php');

  class Github extends GithubApi { // CI_Controller

    public function __construct() {
      parent::__construct();
      $this->load->helper('url');
      // Load session
      $this->load->library('session');
      // Load Pagination library
      $this->load->library('pagination');
      // Load Main model
      $this->load->model('Main_model');
    }

    public function index() {
      redirect('Github/loadRecord');
    }

    public function loadRecord($page = 0, $sortBy = "id", $order = "asc") {
     
      // Set session 
      if ($this->uri->segment('4') != NULL) {
        $this->session->set_userdata(array("sortBy" => $sortBy));
        $this->session->set_userdata(array("order" => $order));
      } else {
        if ($this->session->userdata('sortBy') != NULL) {
          $sortBy = $this->session->userdata('sortBy');
          $order = $this->session->userdata('order');
        }
      }

      $fileNames = $this->getData();
      // Row per page
      $perPage = 3;
      $offset =  ($page - 1) + 1; // ($page - 1) * $perPage;
      
      $paginatedFiles = array();

      if (count($fileNames)) {
        $paginatedFiles = array_slice($fileNames, $offset, $perPage, true);
      }

      usort($paginatedFiles, function ($one, $two) {
        if ($one['file'] === $two['file']) {
            return 0;
        }
        return $one['file'] < $two['file'] ? -1 : 1;
      });

      $data['nameFiles'] = $paginatedFiles; 
      
      // Pagination Configuration
      $config['base_url'] = base_url().'index.php/github/loadRecord';
      $config['user_page_numbers'] = TRUE;
      $config['total_rows'] = count($fileNames);
      $config['per_page'] = $perPage;

      // Initialize
      $this->pagination->initialize($config);

      $data['pagination'] = $this->pagination->create_links();
      $data['row'] = $offset;
      $data['order'] = $order;

      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      
      $this->form_validation->set_rules('url', 'Url', 'required');
      $this->form_validation->set_rules('start', 'Start', 'required');
      $this->form_validation->set_rules('end', 'End', 'required');
      
      if ($this->form_validation->run() == FALSE)
      {
        // Load view
        $this->load->view('github/postView', $data);
      }
      else
      {
        $urlRepositry = $this->input->post_get('url', true);
        $start = $this->input->post_get('start', true);
        $end = $this->input->post_get('end', true);

        $this->load->view('github/postView', $data);
      }
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