<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class GithubApi extends CI_Controller {
    
    public function getData()
    {
      $client = new GuzzleHttp\Client(['base_uri' => 'https://api.github.com']);
      // $response = $client->request('GET', '/search/commits?q=repo:reduxjs/redux+committer-date:2018-11-01..2019-01-14',
      //   [
      //     'headers' => ['Accept' => 'application/vnd.github.cloak-preview'],
      //   ]);      
      // $commits = json_decode($response->getBody());

      $dataTable = array(
        array('file' => 'afile1', array('Daniel' => 3, 'Peter' => 1)), 
        array('file' => 'sfile2', array('Daniel' => 3, 'Peter' => 3)),
        array('file' => 'dfile3', array('Daniel' => 3, 'Peter' => 4)),
        array('file' => 'vfile4', array('Daniel' => 3, 'Peter' => 6)),
        array('file' => 'cfile5', array('Daniel' => 3, 'Peter' => 7, 'Santos' => 7, 'Genry' => 7)),
        array('file' => 'xfile6', array('Daniel' => 3, 'Peter' => 1)),
        array('file' => 'bfile4', array('Daniel' => 3, 'Peter' => 6)),
        array('file' => 'bfile5', array('Daniel' => 3, 'Peter' => 7, 'Santos' => 7, 'Genry' => 7)),
        array('file' => 'cfile6', array('Daniel' => 3, 'Peter' => 1)),
        array('file' => 'afile4', array('Daniel' => 3, 'Peter' => 6)),
        array('file' => 'file5', array('Daniel' => 3, 'Peter' => 7, 'Santos' => 7, 'Genry' => 7)),
        array('file' => 'file6', array('Daniel' => 3, 'Peter' => 1)),
        array('file' => 'file4', array('Daniel' => 3, 'Peter' => 6)),
        array('file' => 'file5', array('Daniel' => 3, 'Peter' => 7, 'Santos' => 7, 'Genry' => 7)),
        array('file' => 'file6', array('Daniel' => 3, 'Peter' => 1))
      );
      
      // foreach ($commits->items as $value) {
      //   $response = $client->request('GET', $value->url. '?client_id=7ab05be52ef22a1d496e&client_secret=6439baa8c6d2df25835c532beba14e7de94a7698');
      //   $commit = json_decode($response->getBody());
      //   $nameFile = $commit->files[0]->filename;
      //   array_push($nameFiles, $nameFile);
      // }
      return $dataTable;
    }
  }
?>