
<div class="container">
<header class="jumbotron subhead" id="overview">
  <h1>Upload News</h1>
  <p class="lead">Ke Web IkhwanNews.</p>  
</header>
<div class="mycontent">
	<!--video_id		-> otomatis
	title	 	 	 	 	 	 	 
	description		 	 	 	 	 	 	 
	content	 	 	 	 	 	 	 
	imgurl 	 	 	 	 	 
	category	 	 	 	 	 	 	 
	reporter	 	 	 	 	 	 	 
	video_tag	 	 	 	 	 	 	 
	newsdate		-> otomatis 
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
			<label class="control-label" for="description">Description</label>
            <div class="controls">
			  <textarea class="input-xlarge" id="description" name="description" rows="3"></textarea>	
       
            </div>
		</div>
		<div class="control-group">
			<label class="control-label" for="input02">Content</label>
            <div class="controls">
				<textarea class="input-xlarge" id="content" name="content" rows="8"></textarea>
            </div>
		</div>
		<div class="control-group">
			<label class="control-label" for="input02">Thumbnail URL</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="input02" name="imgurl" >
              
            </div>
		</div>	
		<div class="control-group">
            <label class="control-label" for="select01">Category</label>
            <div class="controls">			  
			<?php 
				$tbl_cat 	= 'news_category';
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
            <label class="control-label" for="select01">Reporter</label>
            <div class="controls">
			
			<?php 
			$tbl_prod 	= 'reporter';
			$news_reporter  	=  array();
			$this->db->select('id, reporter');
			$query = $this->db->get($tbl_prod);
			if ($query->num_rows() > 0)
			{
				foreach ($query->result() as $row)
				{
                 $news_reporter[$row->id] = $row->reporter;
				}
			}
		
			 /* $news-reporter = array(
                  '1'  	=> 'zone pusat',
                  '2'   => 'zone tengah',
				  '3'	=> 'zone barat',
                );  */
			echo form_dropdown('reporter', $news_reporter); 
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
