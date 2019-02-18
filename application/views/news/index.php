<a href="http://localhost/codeigniter/index.php/news/create" class="btn btn-info" role="button">Add news</a>

<?php foreach ($news as $news_item): ?>

  <h3><?php echo $news_item['title'] ?></h3>
  <div class="main">
    <?php echo $news_item['text'] ?>
  </div>
  <p><a href="<?php echo $news_item['slug'] ?>">View article</a></p>

<?php endforeach; ?>