<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

	// num of records per page
	private $limit = 10;
	
	function __construct()
	{
		parent::__construct();
		
		// load library
		$this->load->library(array('table','form_validation'));
		
		// load helper
		$this->load->helper('url');
		
		// load model
		$this->load->model('Category_model','',TRUE);
	}
	
	function index($offset = 0)
	{
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$categories = $this->Category_model->get_paged_list($this->limit, $offset)->result();
		
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('category/index/');
 		$config['total_rows'] = $this->Category_model->count_all();
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'Name', 'Gender', 'Date of Birth (dd-mm-yyyy)', 'Actions');
		$i = 0 + $offset;
		foreach ($categories as $category)
		{
			$this->table->add_row(++$i, $category->name, strtoupper($category->gender)=='M'? 'Male':'Female', date('d-m-Y',strtotime($category->dob)), 
				
				anchor('category/update/'.$category->id,'update',array('class'=>'update')).' '.
				anchor('category/delete/'.$category->id,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this category?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		// load view
		
		$data['table'] = $this->table->generate();
		$data1['title'] = "TVRSA";
		// load view
		$this->load->view('admin_header',$data1);
		$this->load->view('admin_menu');
		$this->load->view('category_view', $data);
		$this->load->view('admin_footer');
	}
	
	function add()
	{
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// set common properties
		$data['title'] = 'Add new category';
		$data['message'] = '';
		$data['action'] = site_url('category/addCategory');
		$data['link_back'] = anchor('category/index/','Back to list of categorys',array('class'=>'back'));
	
		// load view
		$this->load->view('categoryEdit', $data);
	}
	
	function addCategory()
	{
		// set common properties
		$data['title'] = 'Add new category';
		$data['action'] = site_url('category/addCategory');
		$data['link_back'] = anchor('category/index/','Back to list of categorys',array('class'=>'back'));
		
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
			// save data
			$category = array('name' => $this->input->post('name'),
							'gender' => $this->input->post('gender'),
							'dob' => date('Y-m-d', strtotime($this->input->post('dob'))));
			$id = $this->Category_model->save($category);
			
			// set user message
			$data['message'] = '<div class="success">add new category success</div>';
		}
		
		// load view
		$this->load->view('categoryEdit', $data);
	}
	
	function view($id)
	{
		// set common properties
		$data['title'] = 'Category Details';
		$data['link_back'] = anchor('category/index/','Back to list of categorys',array('class'=>'back'));
		
		// get category details
		$data['category'] = $this->Category_model->get_by_id($id)->row();
		
		// load view
		$this->load->view('categoryView', $data);
	}
	
	function update($id)
	{
		// set validation properties
		$this->_set_rules();
		
		// prefill form values
		$category = $this->Category_model->get_by_id($id)->row();
		$this->form_data->id = $id;
		$this->form_data->name = $category->name;
		$this->form_data->gender = strtoupper($category->gender);
		$this->form_data->dob = date('d-m-Y',strtotime($category->dob));
		
		// set common properties
		$data['title'] = 'Update category';
		$data['message'] = '';
		$data['action'] = site_url('category/updateCategory');
		$data['link_back'] = anchor('category/index/','Back to list of categorys',array('class'=>'back'));
	
		// load view
		$this->load->view('categoryEdit', $data);
	}
	
	function updateCategory()
	{
		// set common properties
		$data['title'] = 'Update category';
		$data['action'] = site_url('category/updateCategory');
		$data['link_back'] = anchor('category/index/','Back to list of categorys',array('class'=>'back'));
		
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
			// save data
			$id = $this->input->post('id');
			$category = array('name' => $this->input->post('name'),
							'gender' => $this->input->post('gender'),
							'dob' => date('Y-m-d', strtotime($this->input->post('dob'))));
			$this->Category_model->update($id,$category);
			
			// set user message
			$data['message'] = '<div class="success">update category success</div>';
		}
		
		// load view
		$this->load->view('categoryEdit', $data);
	}
	
	function delete($id)
	{
		// delete category
		$this->Category_model->delete($id);
		
		// redirect to category list page
		redirect('category/index/','refresh');
	}
	
	// set empty default form field values
	function _set_fields()
	{
		$this->form_data->id = '';
		$this->form_data->name = '';
		$this->form_data->gender = '';
		$this->form_data->dob = '';
	}
	
	// validation rules
	function _set_rules()
	{
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('dob', 'DoB', 'trim|required|callback_valid_date');
		
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_message('valid_date', 'date format is not valid. dd-mm-yyyy');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
	// date_validation callback
	function valid_date($str)
	{
		//match the format of the date
		if (preg_match ("/^([0-9]{2})-([0-9]{2})-([0-9]{4})$/", $str, $parts))
		{
			//check weather the date is valid of not
			if(checkdate($parts[2],$parts[1],$parts[3]))
				return true;
			else
				return false;
		}
		else
			return false;
	}
}
?>