
<div class="container">
<header class="jumbotron subhead" id="overview">
  <h1>Upload Image</h1>
  <p class="lead">ke Web TVRSA.</p>  
</header>
<div class="mycontent">
	
<div class="row">
<div class="span8">	
<?php echo $error;?>

<?php echo form_open_multipart('upload/do_upload');?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>
</div>
</div>
</div>
