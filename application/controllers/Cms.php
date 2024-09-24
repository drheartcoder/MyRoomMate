<?php if(!defined('BASEPATH')) exit('No Direct Script Access Allow');
class Cms extends CI_Controller
{
	public function __construct() {
		parent::__construct();
	}
    public function view($slug="") {
		$slug=$slug;
		if(trim($slug)=='') {
		 redirect(base_url());
		}
		$dynamic                = $this->master_model->getRecords('tbl_dynamic_pages',array('slug'=>$slug));
		$data['page_title']     = $dynamic[0]['page_title'] ; 
		$data['pageTitle']      = $dynamic[0]['page_title'] ; 
		$data['dynamic']        = $dynamic ;
		$data['middle_content'] = "front-page";
		$this->load->view('template',$data);			
    }
} // end cms class