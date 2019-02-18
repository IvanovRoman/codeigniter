<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php echo form_open(site_url('Github/loadRecord'), array('id' => 'create_frm', 'name' => 'create_frm', 'class' => 'form-horizontal')); ?>
  <div class="form-group">
      <label for="title" class="control-label col-sm-1">URL (Git-репозитория)</label> 
      
      <div class="col-sm-10"><input type="text" name="url-commit" id="url-commit" class="form-control" value="reduxjs/redux" placeholder="Url до удалённого git-репозитория"/></div>
  </div>
  <div class="form-group">
      <label for="text" class="control-label col-sm-1">Начало даты</label>
      <div class="col-sm-10"><input type="date" name="start-date" id="start-date" class="form-control" value="2019-01-25" placeholder="Начало периода"/></div>
  </div>
  <div class="form-group">
      <label for="text" class="control-label col-sm-1">Конец даты</label>
      <div class="col-sm-10"><input type="date" name="end-date" id="start-date" class="form-control" value="2019-02-10" placeholder="Конец периода"/></div>
  </div>
  <div class="form-group">
      <div class="col-sm-offset-1 col-sm-10">
          <?php echo form_submit('submit', 'Найти коммит', array('class' => 'btn btn-default')) ?>
      </div>
  </div>
  <?php echo form_close() ?>
