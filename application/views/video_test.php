
<div class="container">
<header class="jumbotron subhead" id="overview">
  <h1>Edit Video</h1>
  <p class="lead">Yang sudah di upload ke Web TVRSA.</p>  
</header>
<div class="mycontent">
	<!--video_id		-> otomatis
	video_title	 	 	 	 	 	 	 
	video_teaser		 	 	 	 	 	 	 
	video_url	 	 	 	 	 	 	 
	screenshoot_url 	 	 	 	 	 
	video_category	 	 	 	 	 	 	 
	video_producer		 	 	 	 	 	 	 
	video_tag	 	 	 	 	 	 	 
	video_date		-> otomatis 
	!-->
<div class="row">
	

<div class="span8">	
		
	<form class="form-horizontal" method="post" action="<?php echo $action; ?>">
	<fieldset>
		<div class="control-group">
			<label class="control-label" for="title">ID</label>
            <div class="controls">
				<input type="text" name="id" disabled="disable" class="input-xlarge" value="<?php echo $video_id; ?>"/>
				<input type="hidden" name="id" value="<?php echo $video_id ?>"/>
				
            </div>
		</div>
		<div class="control-group">
			<label class="control-label" for="title">Title</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="title" name="title" value="<?php echo $video_title; ?>">
			  
            </div>
		</div>
		<div class="control-group">
			<label class="control-label" for="teaser">Teaser</label>
            <div class="controls">
			  <textarea class="input-xlarge" id="teaser" name="teaser" rows="3" value="<?php echo $video_teaser; ?>"></textarea>	
       
            </div>
		</div>
		<div class="control-group">
			<label class="control-label" for="videourl">Video URL</label>
            <div class="controls">

              <input type="text" class="input-xlarge" id="videourl" name="videourl" value="<?php echo $video_url; ?>">

            </div>
		</div>
		<div class="control-group">
			<label class="control-label" for="thumburl">Thumbnail URL</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="thumburl" name="thumburl" value="<?php echo $screenshoot_url; ?>">
              
            </div>
		</div>	
		<div class="control-group">
            <label class="control-label" for="select01">Producer</label>
            <div class="controls">
			<?php 
			
			/* $tbl_prod = 'video_producer';
			$this->db->order_by('id','asc');
			$producer = $this->db->get($tbl_prod); */
		
			 $producer = array(
                  'zone pusat'  		=> 'zone pusat',
                  'zone tengah'    		=> 'zone tengah',
				  'zone barat'			=> 'zone barat',
                  'zone ibu pejabat'   	=> 'zone ibu pejabat',
                  'zone jawa 1 - sumatra 2' =>'zone jawa 1 - sumatra 2',
				  'zone sumatra1 - jawa 2'	=>'zone sumatra1 - jawa 2'
                ); 
			echo form_dropdown('producer', $producer, $video_producer); 
			?>
			
        
            </div>
          </div>
		<div class="form-actions">
            <button type="submit" class="btn btn-primary">Save changes</button>
            <button class="btn">Cancel</button>
          </div>
	</fieldset>	
	</form>    	
		
	
	</div>
 </div>    

	


</div>        
		


</div>        
