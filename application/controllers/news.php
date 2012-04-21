<?php
class News extends CI_Controller {
/* structure database
1. ID
2. Datetime
3. Title
4. description
5. Reporter
6. Content
7. Category */

	// max record per page
	private $limit = 10;
	
	function __construct()
	{
		parent::__construct();
		
		// load library
		$this->load->library(array('table','form_validation'));
		
		// load helper
		$this->load->helper('url');
		
		// load model
		$this->load->model('News_model','',TRUE);
	}

	function index($offset=0)
	{	
		// offset
		$uri_segment = 3;   // di segmen ke berapa si no halaman mau diletakkan (utk pagination)
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$news = $this->News_model->get_paged_list($this->limit, $offset)->result();
		
		// configure & generate pagination
		$this->load->library('pagination');
		$config['base_url'] 	= site_url('news/index/');
 		$config['total_rows'] 	= $this->News_model->count_all();
 		$config['per_page'] 	= $this->limit;
		$config['uri_segment'] 	= $uri_segment;
		$config['full_tag_open'] = '<ul>';		//The opening tag placed on the left side of the entire result.
		$config['full_tag_close'] = '</ul>';	//The closing tag placed on the right side of the entire result.

		//Customizing the First Link
		$config['first_link'] = 'First';		//The text you would like shown in the "first" link on the left. If you do not want this link rendered, you can set its value to FALSE.
		$config['last_link'] = 'Last';			//The text you would like shown in the "last" link on the right. If you do not want this link rendered, you can set its value to FALSE.
		$config['last_tag_open'] = '<li>';		//The opening tag for the "last" link.
		$config['last_tag_close'] = '</li>';	//The closing tag for the "last" link.

		//Customizing the "Next" Link
		$config['next_link'] = '&gt;';			//The text you would like shown in the "next" page link. If you do not want this link rendered, you can set its value to FALSE.
		$config['next_tag_open'] = '<li>';		//The opening tag for the "next" link.
		$config['next_tag_close'] = '</li>';	//The closing tag for the "next" link.

		//Customizing the "Previous" Link
		$config['prev_link'] = '&lt;';			//The text you would like shown in the "previous" page link. If you do not want this link rendered, you can set its value to FALSE.
		$config['prev_tag_open'] = '<li>';		//The opening tag for the "previous" link.
		$config['prev_tag_close'] = '</li>';	//The closing tag for the "previous" link.

		//Customizing the "Current Page" Link
		$config['cur_tag_open'] = '<li><a href="#">';	//The opening tag for the "current" link.
		$config['cur_tag_close'] = '</a></li>';			//The closing tag for the "current" link.

		//Customizing the "Digit" Link
		$config['num_tag_open'] = '<li>';		//The opening tag for the "digit" link.
		$config['num_tag_close'] = '</li>';		//The closing tag for the "digit" link. */
		
		
		$this->pagination->initialize($config);
		$data['pagination'] 	= $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		// setting table header
		$tmpl = array ('table_open'          => '<table class="table table-condensed">');
		$this->table->set_template($tmpl);

		//ID	Thumb	Title	Category	Date	Producer	Action
		$this->table->set_heading('No', 'Thumb','Title', 'Teaser','Category', 'Date', 'Producer', 'Actions');
		$i = 0 + $offset;
		
		foreach ($news as $video)
		{
			$this->table->add_row(
				++$i, 
				'<img src="'.$news->screenshoot_url.'" "width="160" height="90" alt="">', 
				$news->news_title, 
				$news->news_teaser,
				$news->news_category,
				date('d-m-Y',strtotime($news->news_date)),
				$news->news_producer,
				
				anchor('news/update/'.$news->id,'<button class="btn btn-primary" type="submit">Edit</button>',array('class'=>'update')).' '.
				anchor('news/delete/'.$news->id,'<button class="btn btn-danger" type="submit">Delete</button></td>',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this video?')"))
			);
		}
		$data['table'] = $this->table->generate();
		$data1['title'] = "TVRSA";
		// load view
		$this->load->view('admin_header',$data1);
		$this->load->view('admin_menu');
		$this->load->view('news_view', $data);
		$this->load->view('admin_footer');
	}
	
	function add()
	{
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// set common properties
		$data['title'] = 'Add new video';
		$data['message'] = '';
		$data['action'] = site_url('news/add_news/');
		$data['link_back'] = anchor('news/index/','Back to list of news',array('class'=>'back'));
	
		// load view
		$data1['title'] = "TVRSA";
		$this->load->view('admin_header',$data1);
		$this->load->view('admin_menu');
		$this->load->view('news_add', $data);
		$this->load->view('admin_footer');
	}
	  
	
	function add_news()
	{   // form handler utk add video
		// set common properties
		$data['title'] = 'Add new video';
		$data['action'] = site_url('news/add_news/');
		$data['link_back'] = anchor('news/index/','Back to list of news',array('class'=>'back'));
		
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// run validation
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = '';
		}
		else
		{	
			// save data dari POST nya
			//	title, 			teaser,	videourl,		thumburl,	producer,
			// array berisi nama record di DB + isinya	
			$video = array(	'news_title' 		=> $this->input->post('title'),
							'news_teaser' 		=> $this->input->post('teaser'),
							'news_url' 		=> prep_url($this->input->post('videourl')),
							'screenshoot_url' 	=> prep_url($this->input->post('thumburl')),
							'news_producer' 	=> $this->input->post('producer'),
							'news_category' 	=> $this->input->post('category'),
							//,'news_tag' 		=> $this->input->post('gender'),
							'news_date' 		=> date('Y-m-d', time())
							);
			$id = $this->News_model->save($video);
			
			// set user message
			$data['message'] = '<div class="success">add new video success</div>';
		}
		
		// load view
		$data1['title'] = "TVRSA";
		$this->load->view('admin_header',$data1);
		$this->load->view('admin_menu');
		$this->load->view('news_add', $data);
		$this->load->view('admin_footer');
	}
	
	
	function update($id)
	{
		// set validation properties
		$this->_set_rules();
		
		//ambil data di database nya
		$video = $this->News_model->get_by_id($id)->row();
		// prefill form values
		
		// set common properties
		$data['title'] = 'Update video';
		$data['message'] = '';
		$data['action'] = site_url('news/update_news');
		$data['link_back'] = anchor('news/index/','Back to list of news',array('class'=>'back'));
		
		//current video status sent to form
		$data['news_id'] 			= $news->id;
		$data['news_title'] 		= $news->news_title;
		$data['news_teaser'] 		= $news->news_teaser;
		$data['news_url'] 			= $news->news_url;
		$data['screenshoot_url'] 	= $news->screenshoot_url;
		$data['news_category'] 	= $news->news_category;
		$data['news_producer'] 	= $news->news_producer;
		$data['news_date'] 		= $news->news_date;
		
		
		// load view
		$data1['title'] = "TVRSA";
		$this->load->view('admin_header',$data1);
		$this->load->view('admin_menu');
		//$this->load->view('news_edit', $data);
		$this->load->view('news_edit', $data);
		$this->load->view('admin_footer');
	}
	
	function update_news()
	{
		// set common properties
		$data['title'] = 'Update video';
		$data['action'] = site_url('news/update_news');
		$data['link_back'] = anchor('news/index/','Back to list of news',array('class'=>'back'));
		
		
			// save data
			$id = $this->input->post('id');
			
			
			$video = array(	'news_title' 		=> $this->input->post('title'),
							'news_teaser' 		=> $this->input->post('teaser'),
							'news_url' 		=> $this->input->post('videourl'),
							'screenshoot_url' 	=> $this->input->post('thumburl'),
							'news_category' 	=> $this->input->post('category'),
							'news_producer' 	=> $this->input->post('producer'),
							//,'news_tag' 		=> $this->input->post('gender'),
							'news_date' 		=> date('Y-m-d', time())
							);
							
			$this->News_model->update($id,$video);
			
			//video test
			$data['news_id'] 			= $this->input->post('id');
			$data['news_title'] 		= $this->input->post('title');
			$data['news_teaser'] 		= $this->input->post('teaser');
			$data['news_url'] 			= $this->input->post('videourl');
			$data['screenshoot_url'] 	= $this->input->post('thumburl');
			$data['news_category'] 	= $this->input->post('category');
			$data['news_producer'] 	= $this->input->post('producer');
			
			// set user message
			$data['message'] = '<div class="success">update person success</div>';
		
		
		
		// load view
		$data1['title'] = "TVRSA";
		$this->load->view('admin_header',$data1);
		$this->load->view('admin_menu');
		$this->load->view('news_edit',$data);
		$this->load->view('admin_footer');
	}
	
	function delete($id)
	{
		// delete person
		$this->News_model->delete($id);
		
		// redirect to person list page
		redirect('/news/index/','refresh');
	}       
	
	// set empty default form field values
	function _set_fields()
	{	//	title,	teaser,	videourl,	thumburl,	producer
		$this->form_data->title = '';
		$this->form_data->teaser = '';
		$this->form_data->videourl = '';
		$this->form_data->thumburl = '';
		$this->form_data->producer = '';
	}
	
	// validation rules
	function _set_rules()
	{
		//	id bigint auto_increment PRIMARY KEY,
			//	news_title varchar(50),			//	news_teaser tinytext,		 	 	 	 	 	 	 
			//	news_url tinytext,	 	 			//	screenshoot_url tinytext, 	 	 	 	 	 
			//	news_category varchar(50),	 	 	//	news_producer varchar(50),		 	 	 	 	 	 	 
			//	news_tag tinytext,	 	 	 	 	//	news_date date
			
			// save data
			// dari POST nya
			//	title,	teaser,	videourl,	thumburl,	producer
			
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('teaser', 'Teaser', 'required');
		$this->form_validation->set_rules('videourl', 'Videourl', 'required');
		$this->form_validation->set_rules('thumburl', 'Thumburl', 'required');
		$this->form_validation->set_rules('producer', 'Producer', 'required');
		//$this->form_validation->set_rules('dob', 'DoB', 'trim|required|callback_valid_date');
		
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_message('valid_date', 'date format is not valid. dd-mm-yyyy');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
	
}
?>
