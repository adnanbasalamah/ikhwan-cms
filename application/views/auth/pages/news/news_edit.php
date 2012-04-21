
<div class="container">
<header class="jumbotron subhead" id="overview">
  <h1>Edit Video</h1>
  <p class="lead">Yang sudah di upload ke Web TVRSA.</p>  
</header>
<div class="mycontent">
	
<div class="row">
	

<div class="span8">	
		
	<form class="form-horizontal" method="post" action="<?php echo $action; ?>">
	<fieldset>
		<div class="control-group">
			<label class="control-label" for="title">ID</label>
            <div class="controls">
				<input type="text" name="id" disabled="disable" class="input-xlarge" value="<?php echo $id; ?>"/>
				<input type="hidden" name="id" value="<?php echo $id ?>"/>
				
            </div>
		</div>
		<div class="control-group">
			<label class="control-label" for="title">Title</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="title" name="title" value="<?php echo $title; ?>">
			  
            </div>
		</div>
		<div class="control-group">
			<label class="control-label" for="teaser">description</label>
            <div class="controls">
			  
			  <textarea class="input-xlarge" id="description" name="description" rows="3" value=""><?php echo $description; ?></textarea>	
       
            </div>
		</div>
		<div class="control-group">
			<label class="control-label" for="videourl">content</label>
            <div class="controls">
				<textarea class="input-xlarge" id="content" name="content" rows="10" value=""><?php echo $content; ?></textarea>	
              

            </div>
		</div>
		<div class="control-group">
			<label class="control-label" for="thumburl">Thumbnail URL</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="thumburl" name="imgurl" value="<?php echo $imgurl; ?>">
              
            </div>
		</div>	
		<div class="control-group">
            <label class="control-label" for="select01">Category</label>
            <div class="controls">			  
			  <?php 
			$tbl_cat 	= 'news_category';
			$news_category  	=  array();
			$this->db->select('id, cat');
			$query = $this->db->get($tbl_cat);
			if ($query->num_rows() > 0)
			{
				foreach ($query->result() as $row)
				{
                 $news_category[$row->id] = $row->cat;
				}
			}
		
			 /* $category = array(
                  '1'  	=> 'clip',
                  '2'   => 'drama',
				  '3'	=> 'sajak',
                );  */
			echo form_dropdown('category', $news_category, $category); 
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
		
			 /* $producer = array(
                  '1'  	=> 'zone pusat',
                  '2'   => 'zone tengah',
				  '3'	=> 'zone barat',
                );  */
			echo form_dropdown('producer', $news_reporter, $reporter); 
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
