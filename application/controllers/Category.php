<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->model('email_sending');
	}

	public function details()
	{  
        $cat_id = $this->uri->segment(3);

       // check if category is parent or not
        $where = array('is_delete' => '0', 'category_status' => '1', 'category_id' => $cat_id);
        $get_cat_level1 = $this->master_model->getRecords('tbl_category_master', $where);

        if(count($get_cat_level1) > 0)
        {
            if($get_cat_level1[0]['parent_id'] != 0)
            {
                $where = array('is_delete' => '0', 'category_status' => '1', 'category_id' => $get_cat_level1[0]['parent_id']);
                $get_cat_level2 = $this->master_model->getRecords('tbl_category_master', $where);

                if($get_cat_level2[0]['parent_id'] != 0)
                {
                    $where = array('is_delete' => '0', 'category_status' => '1', 'category_id' => $get_cat_level2[0]['parent_id']);
                    $get_cat_level3 = $this->master_model->getRecords('tbl_category_master', $where);

                    $cat_id = $get_cat_level3[0]['category_id'];
                } // end if
                else
                {
                    $cat_id = $get_cat_level2[0]['category_id'];
                } // end else

            } // end if
        } // end if

        $where = array('parent_id'=>'0','is_delete'=>'0','category_status'=>'1','category_id'=>$cat_id);
        $data['maincategory'] = $this->master_model->getRecords('tbl_category_master',$where);
        
        /*echo"<pre>";
        print_r($data['fetchcategory']);exit;  */

        //$data['addlisting'] = $this->master_model->getRecords('tbl_addlisting');
        
        $data['pageTitle']       = 'Category Listing - '.PROJECT_NAME;
        $data['page_title']      = 'Category Listing - '.PROJECT_NAME;
        $data['middle_content']  = 'category-list.php';
        
        $this->load->view('template',$data);
	}

}
?>