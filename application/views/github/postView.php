<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
?>
   
  <div class="container">
    <div class="row">
      <div class="col-md-12">
      <table id="book-table">
        <thead>
          <tr><td>Название файлов</td><td>Количество изменений</td><td>Авторы</td></tr>
        </thead>
        <tbody>
        </tbody>
      </table>    
      </div>
    </div>
  </div>
  
  <script type="text/javascript">
    $(document).ready(function() {
      $('#book-table').DataTable({
        "ajax": {
          url : "<?php echo site_url("github/get_commits") ?>",
          type: "GET"
        }
      });
    });
  </script>
</body>
</html>