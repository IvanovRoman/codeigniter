<?php
  $errors = validation_errors();
  if (!empty($errors)) {
    echo $errors . '<hr/>';
  }
?>

<?php echo form_open(site_url('/github/search'), array('id' => 'create_frm', 'name' => 'create_frm', 'class' => 'form-horizontal')); ?>

<h1>Path: views/github/search/</h1>
<div class="container">
  <div class="form-group">
    <label for="title" class="control-label col-sm-1">Репозиторий</label>
    <div class="col-sm-10"><input type="text" name="repos" id="repos" class="form-control" placeholder="Репозиторий"/></div>
  </div>
  <div class="form-group">
    <label for="title" class="control-label col-sm-1">Начало даты</label>
    <div class="col-sm-10"><input type="text" name="text" id="start-date" class="form-control" placeholder="Начало даты"/></div>
  </div>
  <div class="form-group">
    <label for="title" class="control-label col-sm-1">Конец даты</label>
    <div class="col-sm-10"><input type="text" name="text" id="start-date" class="form-control" placeholder="Конец даты"/></div>
  </div>
</div>

<?php echo form_close() ?>