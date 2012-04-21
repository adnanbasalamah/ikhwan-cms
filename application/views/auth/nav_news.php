<ul class="nav">
<?php
	if(logged_in())
	{
	?>
		<li class="active"><a href="<?php echo site_url("admin/news/");?>"><i class="icon-home icon-white"></i>Admin Home</a></li>
		<li><a href="<?php echo site_url("admin/news/add");?>"><i class="icon-film icon-white"></i>Add News</a></li>
		<li><a href="<?php echo site_url("admin/upload");?>"><i class="icon-film icon-white"></i>Upload Image</a></li>
		
		<?php 	if(user_group('admin')) 
						{ echo '<li><a href="'.site_url("admin/category/add").'"><i class="icon-star-empty icon-white"></i>Add News Category</a> ';
						  echo '<li><a href="'.site_url("admin/add/reporter").'"><i class="icon-user icon-white"></i>Add reporter</a> ';
						  echo '<li><a href="'.site_url("admin/users/manage").'"><i class="icon-user icon-white"></i>Manage Users</a> ';
						} ?>
			
			</li>
		<li><a href="<?php echo site_url("logout");?>"><i class="icon-user icon-white"></i>Logout</a></li>
		<li><a href="#"><i class="icon-heart icon-white"></i>About</a></li>
	
		
	<?php
	}
	else
	{
	?>
		<li><?php echo anchor('login', 'Login'); ?></li>
		<li><?php echo anchor('register', 'Register'); ?></li>
	<?php
	}
	
?>
</ul>


			
			