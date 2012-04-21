
<div class="container">
<header class="jumbotron subhead" id="overview">
  <h1>Upload Image</h1>
  <p class="lead">ke Web IkhwanNews.</p>  
</header>
<div class="mycontent">
	
<div class="row">
<div class="span8">	
<?php echo $error;?>

<?php echo form_open_multipart('admin/upload/do_upload');?>
	

	<div class="control-group">
            <label class="control-label" for="userfile">File input</label>
            <div class="controls">
              <input class="input-file" id="userfile" type="file" name="userfile" size="20">
            </div>
    </div>
	<div class="control-group">
            <label class="control-label" for="input01">Rename file to</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="input01" name="filename">
              <p class="help-block">.</p>
            </div>
    </div>
<br /><br />

<input type="submit" value="upload" />

</form>
</div>
</div>
</div>
