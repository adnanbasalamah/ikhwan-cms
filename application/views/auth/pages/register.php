<div class="container">
<header class="jumbotron subhead" id="overview">
  
  <?php if(empty($username)) { ?>
	<h1>Register</h1>
	<?php } else { ?>
	<h1>Update</h1>
	<?php } ?>
	<p class="lead">to become user of TVRSA .</p>
</header>
<div class="row">	
	<div class="well">
			<form method="post">
			<?php if(empty($username)) { ?>
			Username:<br />
			<input type="text" name="username" size="50" class="form" value="<?php echo set_value('username'); ?>" /><br /><?php echo form_error('username'); ?><br />
			Password:<br />
			<input type="password" name="password" size="50" class="form" value="<?php echo set_value('password'); ?>" /><?php echo form_error('password'); ?><br /><br />
			Password confirmation:<br />
			<input type="password" name="password_conf" size="50" class="form" value="<?php echo set_value('conf_password'); ?>" /><?php echo form_error('conf_password'); ?><br /><br />
			<?php } ?>
			Email:<br />
			<?php if(empty($username)){ ?>
				<input type="text" name="email" size="50" class="form" value="<?php echo set_value('email'); ?>" /><?php echo form_error('email'); ?><br /><br />
			<?php }else{ ?>
			<input type="text" name="email" size="50" class="form" value="<?php echo set_value('email', $email); ?>" /><?php echo form_error('email'); ?><br /><br />
			
			<?php } if(empty($username)) { ?>
			<input type="submit" value="Register" name="register" />
			<?php } else { ?>
			<input type="submit" value="Update" name="register" />
			<?php } ?>
			</form>
	</div>
</div>
</div>