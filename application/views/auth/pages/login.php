
<div class="container">	
<header class="jumbotron subhead" id="overview">
  <h1>Login</h1>
  <p class="lead">using your username and password.</p>
  
</header>    
	<div class="row">
  
     
	<div class="well  ">
			<form method="POST">
			Username/Email:<br />
			<input type="text" name="username" value="<?php echo set_value('username'); ?>" size="50" class="form" /><?php echo form_error('username'); ?><br /><br />
			Password:<br />
			<input type="password" name="password" value="<?php echo set_value('password'); ?>" size="50" class="form" /><?php echo form_error('password'); ?><br /><br />
			<input type="submit" value="Login" name="login" />
			</form>
	</div>
	</div>
</div>
