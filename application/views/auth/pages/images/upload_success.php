
<div class="container">
<header class="jumbotron subhead" id="overview">
  <h1>Upload Image</h1>
  <p class="lead">ke Web IkhwanNews.</p>  
</header>
<div class="mycontent">

<h3>Your file was successfully uploaded!</h3>

<ul>
<?php foreach($upload_data as $item => $value):?>
<li><?php echo $item;?>: <?php echo $value;?></li>
<?php endforeach; ?>
</ul>

<p><?php echo anchor('/admin/upload', 'Upload Another File!'); ?></p>
</div>