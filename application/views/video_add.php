
<div class="container">
<header class="jumbotron subhead" id="overview">
  <h1>Upload Video</h1>
  <p class="lead">Ke Web TVRSA.</p>  
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
			<label class="control-label" for="title">Title</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="title" name="title">
            </div>
		</div>
		<div class="control-group">
			<label class="control-label" for="teaser">Teaser</label>
            <div class="controls">
			  <textarea class="input-xlarge" id="teaser" name="teaser" rows="3"></textarea>	
       
            </div>
		</div>
		<div class="control-group">
			<label class="control-label" for="input02">Video URL</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="input02" name="videourl" >

            </div>
		</div>
		<div class="control-group">
			<label class="control-label" for="input02">Thumbnail URL</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="input02" name="thumburl" >
              
            </div>
		</div>	
		<div class="control-group">
            <label class="control-label" for="select01">Category</label>
            <div class="controls">			  
			<?php 
				$tbl_cat 	= 'video_category';
				$category  	=  array();
				$this->db->select('id, cat');
				$query = $this->db->get($tbl_cat);
				if ($query->num_rows() > 0)
				{
					foreach ($query->result() as $row)
					{
					 $category[$row->id] = $row->cat;
					}
				}
			
				 /* $category = array(
					  '1'  	=> 'clip',
					  '2'   => 'drama',
					  '3'	=> 'sajak',
					);  */
				echo form_dropdown('category', $category); 
			?>
            </div>
          </div>
		  
		<div class="control-group">
            <label class="control-label" for="select01">Producer</label>
            <div class="controls">
			
			<?php 
			$tbl_prod 	= 'video_producer';
			$producer  	=  array();
			$this->db->select('id, prod');
			$query = $this->db->get($tbl_prod);
			if ($query->num_rows() > 0)
			{
				foreach ($query->result() as $row)
				{
                 $producer[$row->id] = $row->prod;
				}
			}
		
			 /* $producer = array(
                  '1'  	=> 'zone pusat',
                  '2'   => 'zone tengah',
				  '3'	=> 'zone barat',
                );  */
			echo form_dropdown('producer', $producer); 
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
