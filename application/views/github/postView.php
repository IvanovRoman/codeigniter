<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE <!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sort Pagination records on Header Click in CodeIgniter</title>

  <style type="text/css">
  a {
    padding-left: 5px;
    padding-right: 5px;
    margin-left: 5px;
    margin-right: 5px;
  }
  </style>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <?php

  // Set order
  $order == "asc" ? $order = "desc" : $order = "asc";

  ?>

  <h1>Поиск изменений</h1>
  
  <?php echo form_open(site_url('Github/loadRecord'), array('id' => 'create_frm', 'name' => 'create_frm', 'class' => 'form-horizontal')); ?>
  <div class="form-group">
      <label for="title" class="control-label col-sm-1">URL (Git-репозитория)</label>
      <div class="col-sm-10"><input type="text" name="url" id="url" class="form-control" value="https://github.com/reduxjs/redux/" placeholder="Url до удалённого git-репозитория"/></div>
  </div>
  <div class="form-group">
      <label for="text" class="control-label col-sm-1">Начало даты</label>
      <div class="col-sm-10"><input type="date" name="start" id="start" class="form-control" value="2019-01-10" placeholder="Начало периода"/></div>
  </div>
  <div class="form-group">
      <label for="text" class="control-label col-sm-1">Конец даты</label>
      <div class="col-sm-10"><input type="date" name="end" id="end" class="form-control" value="2019-02-10" placeholder="Конец периода"/></div>
  </div>
  <div class="form-group">
      <div class="col-sm-offset-1 col-sm-10">
          <?php echo form_submit('submit', 'Найти коммит', array('class' => 'btn btn-default')) ?>
      </div>
  </div>
  <?php echo form_close() ?>
  
  <!-- Post List -->
  <table border='1' width='100%' style='border-collapse: collapse;'>
    <tr>
      <th>S.no</th>

      <th>
        <!-- index.php/controller/method-name/pagination-index/order -->
        <a href='<?= base_url() ?>index.php/Github/loadRecord/'.$page.'/file/<?= $order ?>'>Файл</a>
      </th>
      <th>
        <!-- index.php/controller/method-name/pagination-index/order -->
        <a href='<?= base_url() ?>index.php/Github/loadRecord/0/count/<?= $order ?>'>Количество изменений</a>
      </th>
      <th>
        <!-- index.php/controller/method-name/pagination-index/order -->
        <a href='<?= base_url() ?>index.php/Github/loadRecord/0/authors/<?= $order ?>'>Авторы</a>
      </th>
    </tr>
    <?php
      $sno = $row + 1;

      foreach ($nameFiles as $nameFile) {
        $authors = "";
        $countCommits = 0;
        foreach ($nameFile[0] as $key => $value) {
          $authors .= $key.": ".$value." ";
          $countCommits += $value;
        }

        echo "<tr>";
        echo "<td>".$sno."</td>";
        echo "<td>".$nameFile['file']."</td>";
        echo "<td>".$countCommits."</td>";
        echo "<td>".$authors."</td>";
        echo "</tr>";
        $sno++;
      }

      // foreach ($result as $data) {
      //   $content = substr($data['content'], 0, 180)."...";  
      //   echo "<tr>";
      //   echo "<td>".$sno."</td>";
      //   echo "<td>".$data['nameFiles']."</td>";
      //   echo "<td>".$content."</td>";
      //   echo "<td>".$data['publish_date']."</td>";
      //   echo "</tr>";
      //   $sno++;
      // }

      if (count($nameFiles) == 0) {
        echo "<tr>";
        echo "<td colspan='3'>No record found.</td>";
        echo "</tr>";
      }
    ?>
  </table>

  <!-- Pagination -->
  <div style='margin-top: 10px;'>
    <?= $pagination; ?>
  </div>
</body>
</html>