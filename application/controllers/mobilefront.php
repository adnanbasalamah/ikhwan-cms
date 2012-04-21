<?php 

class Mobilefront extends CI_Controller {
//function list
//1. show news list
//2. show news based on category


	// max record per page
	private $limit = 10;
	
	function __construct()
	{
		parent::__construct();
		
		// load library
		$this->load->library(array('form_validation'));
		
		// load helper
		$this->load->helper('url');
		
		// load model
		$this->load->model('News_model','',TRUE); 
		$this->load->model('Reporter_model','',TRUE); 
	}
	
function index($offset=0)
	{	
		// offset
		$uri_segment = 2;   // di segmen ke berapa si no halaman mau diletakkan (utk pagination)
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$my_news = $this->News_model->get_paged_list($this->limit, $offset)->result();
		
		// configure & generate pagination
		$this->load->library('pagination');
		$config['base_url'] 	= site_url('/index/');
 		$config['total_rows'] 	= $this->News_model->count_all();
 		$config['per_page'] 	= $this->limit;
		$config['uri_segment'] 	= $uri_segment;
		$config['next_link'] = 'Selanjutnya';

		$this->pagination->initialize($config);
		$data['pagination'] 	= $this->pagination->create_links();
		
		$i = 0 + $offset;
		$news_list='';
		foreach ($my_news as $news)
		{	if ($i==0) { 
			$news_list .= '<li class="hl"><img src="'.urldecode($news->imgurl).'"'.$news->imgurl.'">
			<h3>'.anchor('mobilefront/newsview/'.$news->id, $news->title ).'</a> 
		<span class="date">('.date('d-m-Y',strtotime($news->newsdate)).')</span>
		</h3><div class="clearfix"></div></li>';
			++$i;
			}
		else {
			$news_list .= '<li><h3>'.anchor('mobilefront/newsview/'.$news->id,$news->title ).'</a><span class="date">('.date('d-m-Y',strtotime($news->newsdate)).')</span></h3></li>';
			++$i;

			//anchor('/news/'.$news->id);	
			}
		}
		
		
		$data['news_list'] = $news_list;
		
		
		// load view
		$this->load->view('news/mobilefront_header',$data);
		$this->load->view('news/mobilefront_menu',$data);
		$this->load->view('news/mobilefront_view_test',$data);
		$this->load->view('news/mobilefront_footer',$data);
		
	}
	
	function newsview($id)
	{
		//ambil data di database nya
		$news = $this->News_model->get_by_id($id)->row();
		// prefill form values
		
		// set common properties
		
		$data['message'] = '';
		//$data['action'] = site_url('/admin/news/update_news');
		$data['link_back'] = anchor('/mobilefront/index/','Kembali',array('class'=>'back'));
		
		//current news status sent to form
		$data['id'] 		= $news->id;
		$data['title'] 		= $news->title;
		$data['description']= $news->description;
		$data['content'] 	= $news->content;
		$data['imgurl'] 	= urldecode($news->imgurl);
		$data['category'] 	= $news->category;
		$reporter_num 		= $news->reporter;
		$reporter			= $this->Reporter_model->get_by_id($reporter_num)->row();
		$data['reporter'] 	= $reporter->reporter;
		$data['newsdate'] 	= $news->newsdate;
		
		
		// load view
		
		//$this->ag_auth->view('news/news_edit',$data);
		
		$this->load->view('news/mobilepage_header');
		$this->load->view('news/mobilepage_menu',$data);
		$this->load->view('news/mobilepage_view',$data);
		$this->load->view('news/mobilepage_footer');
		
		
	}
	
}
?>