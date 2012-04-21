<?php
class News extends Application
{
	// max record per page
	private $limit = 10;
	
	public function __construct()
	{
		parent::__construct();
		//$this->ag_auth->restrict('admin'); // restrict this controller to admins only
	
		// load library
		$this->load->library(array('table','form_validation'));
		
		// load helper
		$this->load->helper('url');
		
		// load model
		$this->load->model('News_model','',TRUE);
	
	}

	function index($offset=0)
	{	
		if(!logged_in()) { $this->login();}
	
	
		// offset
		$uri_segment = 3;   // di segmen ke berapa si no halaman mau diletakkan (utk pagination)
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$my_news = $this->News_model->get_paged_list($this->limit, $offset)->result();
		
		// configure & generate pagination
		$this->load->library('pagination');
		$config['base_url'] 	= site_url('/admin/news/index/');
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
		$this->table->set_heading('No', 'Thumb','Title', 'Description','Category', 'Date', 'Reporter', 'Actions');
		$i = 0 + $offset;
		
		foreach ($my_news as $news)
		{
			$this->table->add_row(
				++$i, 
				'<img src="'.urldecode($news->imgurl).'" "width="160" height="90" alt="">', 
				$news->title, 
				$news->description,
				$news->category,
				date('d-m-Y',strtotime($news->newsdate)),
				$news->reporter,
				
				anchor('/admin/news/update/'.$news->id,'<button class="btn btn-primary" type="submit">Edit</button>',array('class'=>'update')).' '.
				anchor('/admin/news/delete/'.$news->id,'<button class="btn btn-danger" type="submit">Delete</button></td>',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this news?')"))
			);
		}
		$data['table'] = $this->table->generate();
		$data1['title'] = "TVRSA";
		// load view
		
		$this->ag_auth->view('news/news_view',$data);
	}
	
	function add()
	{
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// set common properties
		
		$data['message'] = '';
		$data['action'] = site_url('/admin/news/add_news/');
		$data['link_back'] = anchor('/admin/news/index/','Back to list of news',array('class'=>'back'));
	
		// load view
		
		$this->ag_auth->view('news/news_add',$data);
	}
	  
	
	function add_news()
	{   // form handler utk add news
		// set common properties
		
		$data['action'] = site_url('/admin/news/add_news/');
		$data['link_back'] = anchor('/admin/news/index/','Back to list of News',array('class'=>'back'));
		
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// run validation
		//if ($this->form_validation->run() == FALSE)
		//{
		//	$data['message'] = '';
		//}
		//else
		//{	
			// save data dari POST nya
			//	title, 			description,	content,		imgurl,	reporter,
			// array berisi nama record di DB + isinya	
			$news = array(	'title' 		=> $this->input->post('title'),
							'description' 	=> $this->input->post('description'),
							'content' 		=> $this->input->post('content'),
							'imgurl' 	=> urlencode(prep_url($this->input->post('imgurl'))),
							'reporter' 	=> $this->input->post('reporter'),
							'category' 	=> $this->input->post('category'),
							'newsdate' 		=> date('Y-m-d', time())
							);
			$id = $this->News_model->save($news);
			
			// set user message
			$data['message'] = '<div class="success">add new news success</div>';
		//}
		
		// load view

		$this->ag_auth->view('news/news_add',$data);
	}
	
	
	function update($id)
	{
		// set validation properties
		$this->_set_rules();
		
		//ambil data di database nya
		$news = $this->News_model->get_by_id($id)->row();
		// prefill form values
		
		// set common properties
		
		$data['message'] = '';
		$data['action'] = site_url('/admin/news/update_news');
		$data['link_back'] = anchor('/admin/news/index/','Back to list of news',array('class'=>'back'));
		
		//current news status sent to form
		$data['id'] 		= $news->id;
		$data['title'] 		= $news->title;
		$data['description']= $news->description;
		$data['content'] 	= $news->content;
		$data['imgurl'] 	= urldecode($news->imgurl);
		$data['category'] 	= $news->category;
		$data['reporter'] 	= $news->reporter;
		$data['newsdate'] 	= $news->newsdate;
		
		
		// load view
		
		$this->ag_auth->view('news/news_edit',$data);
	}
	
	function update_news()
	{
		// set common properties
		
		$data['action'] = site_url('/admin/news/update_news');
		$data['link_back'] = anchor('news/index/','Back to list of news',array('class'=>'back'));
		
		
			// save data
			$id = $this->input->post('id');
			
			
			$news = array(	'title' 		=> $this->input->post('title'),
							'description' 	=> $this->input->post('description'),
							'content' 		=> $this->input->post('content'),
							'imgurl' 		=> urlencode(prep_url($this->input->post('imgurl'))),
							'category' 		=> $this->input->post('category'),
							'reporter' 		=> $this->input->post('reporter'),
							'newsdate' 		=> date('Y-m-d', time())
							);
							
			$this->News_model->update($id,$news);
			
			// test
			$data['id'] 			= $this->input->post('id');
			$data['title'] 		= $this->input->post('title');
			$data['description'] 		= $this->input->post('description');
			$data['content'] 			= $this->input->post('content');
			$data['imgurl'] 	= $this->input->post('imgurl');
			$data['category'] 	= $this->input->post('category');
			$data['reporter'] 	= $this->input->post('reporter');
			
			// set user message
			$data['message'] = '<div class="success">update news success</div>';
		
		
		
		// load view
		$this->ag_auth->view('news/news_edit',$data);
	}
	
	function delete($id)
	{
		// delete person
		$this->News_model->delete($id);
		
		// redirect to person list page
		redirect('/admin/news/index/','refresh');
	}       
	
	// set empty default form field values
	function _set_fields()
	{	//	title,	description,	content,	imgurl,	reporter
		$this->form_data->title = '';
		$this->form_data->description = '';
		$this->form_data->content = '';
		$this->form_data->imgurl = '';
		$this->form_data->reporter = '';
	}
	
	// validation rules
	function _set_rules()
	{
		
			
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('content', 'Content', 'required');
		//$this->form_validation->set_rules('imgurl', 'Imgurl', 'required');
		$this->form_validation->set_rules('reporter', 'Reporter', 'required');
		//$this->form_validation->set_rules('dob', 'DoB', 'trim|required|callback_valid_date');
		
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_message('valid_date', 'date format is not valid. dd-mm-yyyy');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
	
}
?>