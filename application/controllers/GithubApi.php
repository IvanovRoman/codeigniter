<?php

defined('BASEPATH') OR exit('No direct script access allowed');

  class GithubApi extends CI_Controller {
    
    public function getData()
    {
      $urlCommit = $this->input->post('url-commit');
      $startDate = $this->input->post('start-date');
      $endDate = $this->input->post('end-date');

      $client_id = $this->config->item('client_id');
      $client_secret = $this->config->item('client_secret');

      $client = new GuzzleHttp\Client(['base_uri' => 'https://api.github.com']);
      $response = $client->request('GET', '/search/commits?q=repo:'.$urlCommit.'+committer-date:' .$startDate.'..' .$endDate.'&client_id=' .$client_id. '&client_secret=' .$client_secret,
        [
          'headers' => ['Accept' => 'application/vnd.github.cloak-preview'],
        ]);
      $commits = json_decode($response->getBody());
      $response->getBody()->close();

      $commitsUrl = array();

      foreach ($commits->items as $key) {
        array_push($commitsUrl, $key->url);
      }

      $filesData = array();
      foreach ($commitsUrl as $url) {
        $client = new GuzzleHttp\Client();
        $response = $client->request('GET', $url,
          [
            'headers' => ['Accept' => 'application/vnd.github.cloak-preview'],
          ]);
        $data = json_decode($response->getBody());
        array_push($filesData, $data);
        $response->getBody()->close();
      }
      
      // include 'json_test.php';
      // $jsonArray = array();
      // foreach ($jsonTest as $key) {
      //   $json = json_decode($key);
      //   array_push($jsonArray, $json);  
      // }
      

      $dataTable = array();
      // foreach ($jsonArray as $key) {
      foreach ($filesData as $key) {
        $addItemAuthor = [$key->commit->author->name => 1];

        foreach ($key->files as $file) {
          $addItemFile = $file->filename;

          if (array_key_exists($addItemFile, $dataTable)) { // Проверка существования файла
            if (array_key_exists($key->commit->author->name, $dataTable[$addItemFile])) {
              $dataTable[$addItemFile][$key->commit->author->name] = $dataTable[$addItemFile][$key->commit->author->name] + 1;
            }
            else
            {
              $dataTable[$addItemFile] += $addItemAuthor;
            }
          }
          else
          {
            $dataTable += [$addItemFile => $addItemAuthor];
          }
        }
      }

      return $dataTable;
    }
  }
?>