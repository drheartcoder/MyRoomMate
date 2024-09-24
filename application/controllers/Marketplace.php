<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Marketplace extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('email_sending');
		$this->master_model->IsLogged();

	}
	public function index()
	{
        $data['pageTitle']       = 'Marketplace feeds- '.PROJECT_NAME;
   	    $data['page_title']      = 'Marketplace feeds- '.PROJECT_NAME;
   	    $data['middle_content']  = 'Marketplace/live-market';
      
        
        
        /* get last 7 days requirments */
        $this->db->where('created_date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()');

        if(isset($_REQUEST['location']) && $_REQUEST['location'] != ""){
            $this->db->like('location' , $_REQUEST['location']);
        }
        if(isset($_REQUEST['category']) && $_REQUEST['category'] != ""){
            $this->db->where_in('tbl_buyer_post_requirement.category_id' ,$_REQUEST['category']);
        }
        $this->db->where('tbl_buyer_post_requirement.status' , 'Unblock');
        $this->db->where('tbl_buyer_post_requirement.status <>' , 'Delete');
        $this->db->where('tbl_buyer_post_requirement.requirment_status' , 'open');
        $this->db->where('tbl_subcategory_master.is_delete <>','1');
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.subcategory_id = tbl_buyer_post_requirement.subcategory_id');
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_subcategory_master.category_id');
        $data['latest_requirment']  = $this->master_model->getRecords('tbl_buyer_post_requirement');
        /* end get last 7 days requirments */


        /* get last 7 days Offers */
        $this->db->where('created_date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()');

        if(isset($_REQUEST['location']) && $_REQUEST['location'] != ""){
            $this->db->like('location' , $_REQUEST['location']);
        }
        if(isset($_REQUEST['category']) && $_REQUEST['category'] != ""){
            $this->db->where_in('tbl_seller_products_offers.category_id' ,$_REQUEST['category']);
        }
        $this->db->where('tbl_seller_products_offers.status' , 'Unblock');
        $this->db->where('tbl_seller_products_offers.status <>' , 'Delete');
        $this->db->where('tbl_seller_products_offers.offer_status' , 'open');
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.subcategory_id = tbl_seller_products_offers.subcategory_id');
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_subcategory_master.category_id');
        $data['latest_offers']  = $this->master_model->getRecords('tbl_seller_products_offers');
        /* end get last 7 days Offers */

        /* get category for searching */
        $this->db->where('tbl_category_master.category_status' , '1');
        $this->db->where('tbl_category_master.is_delete' , '0');
        $this->db->where('subcategory_status' , '1');
        $this->db->where('tbl_subcategory_master.is_delete' , '0');
        $this->db->where('tbl_subcategory_master.is_delete' , '0');
        $this->db->group_by('tbl_category_master.category_id');
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.category_id=tbl_category_master.category_id');
        $data['getCat'] = $this->master_model->getRecords('tbl_category_master');
        /* end get category for searching */

        $this->load->view('template',$data);
	}
    public function make_offer()
    {
        if(isset($_POST['price'])) {

            $this->db->where('seller_id' , $this->session->userdata('user_id'));
            $this->db->where('status'   , 'Unblock');
            $getAvailablePostCount = $this->master_model->getRecords('tbl_seller_offer_requirments_count');

            if(sizeof($getAvailablePostCount) > 0){
                if($getAvailablePostCount[0]['available'] <= 0){

                    $url=base_url().'purchase/for_offers';
                    $arr_response['status'] = "error";
                    $arr_response['msg']    = "Sorry!!, you not able to make this offer. your make offer limit has expire, if you make this offer then purchase ".PROJECT_NAME." premium membership. <a href='$url'><button style='height: 30px; max-width: 122px; margin:16px 0 2px 0' class='change-btn-pass'>Purchase</button></a>";
                    echo json_encode($arr_response);
                    exit;
                }
            }
            else 
            {
                $arr_response['status'] = "error";
                $arr_response['msg']    = "Sorry, you not able to make offer.";
                echo json_encode($arr_response);
                exit;
            }

            $requirment_id    = $this->input->post('requirment_id');
            $price            = $this->input->post('price');
            $country          = $this->input->post('country');
            $offer_desc       = $this->input->post('description');

            $arr_req  = array(
                'offered_seller_id'  => $this->session->userdata('user_id'),
                'requirment_id'      => $requirment_id,
                'offered_price'      => $price, 
                'offer_description'  => $offer_desc, 
                'offer_country'      => $country,
                'offer_created_date' => date('Y-m-d H:m:s'),
            );

            if($this->db->insert('tbl_apply_for_requirment' , $arr_req)){

 

                /* insert notification */
                $this->db->where('tbl_buyer_post_requirement.id' , $requirment_id);
                $getrequirementdetails = $this->master_model->getRecords('tbl_buyer_post_requirement');
                if(isset($getrequirementdetails[0]['title'])) { $requirement = $getrequirementdetails[0]['title']; } else { $requirement ="Not Available"; }

                $arr_noti  = array(
                'seller_id'          => $this->session->userdata('user_id'),
                'buyer_id'           => $getrequirementdetails[0]['buyer_id'],
                'notification'       => 'New offer received for - <b>'.$requirement.'</b> requirement',
                'url'                => base_url().'buyer/requirment_detail/'.$requirment_id,
                'details'            => $offer_desc,
                'created_date'       => date('Y-m-d H:m:s'),
                'status'             =>'Unblock',
                'is_read'            =>'no'
                );
                $this->db->insert('tbl_buyer_notifications' , $arr_noti);
                /* end insert notification */



              
                $minus_availble_post_count = $getAvailablePostCount[0]['available'] - 1;
                $plus_completed_post_count = $getAvailablePostCount[0]['competed']  + 1;

                $arr_post_update_data = array(
                        'available'  => $minus_availble_post_count,
                        'competed'   => $plus_completed_post_count,
                );
                $this->db->where('seller_id' , $this->session->userdata('user_id'));
                $this->db->update('tbl_seller_offer_requirments_count',$arr_post_update_data);
                

                $arr_response['status'] = "success";
                $arr_response['msg']    = "Your offer successfully sent.";
                echo json_encode($arr_response);
                exit;

            }else {
                $arr_response['status'] = "error";
                $arr_response['msg']    = "Something was wrong,Please try again.";
                echo json_encode($arr_response);
                exit;
            }
        }
    }
    public function make_offer_to_sellersoffer()
    {
        if(isset($_POST['price'])) {

            $this->db->where('buyer_id' , $this->session->userdata('user_id'));
            $this->db->where('status'   , 'Unblock');
            $getAvailablePostCount = $this->master_model->getRecords('tbl_buyer_offer_count');

            if(sizeof($getAvailablePostCount) > 0){

                if($getAvailablePostCount[0]['available'] <= 0){
                    
                    $url=base_url().'purchase/market_offers';
                    $arr_response['status'] = "error";
                    $arr_response['msg']    = "Sorry!!, you not able to make this offer. your make offer limit has expire, if you make this offer then purchase ".PROJECT_NAME." premium membership. <a href='$url'><button style='height: 30px; max-width: 122px; margin:16px 0 2px 0' class='change-btn-pass'>Purchase</button></a>";
                    echo json_encode($arr_response);
                    exit;
                }
            }
            else 
            {
                $arr_response['status'] = "error";
                $arr_response['msg']    = "Sorry, you not able to make offer.";
                echo json_encode($arr_response);
                exit;
            }

            $offer_id         = $this->input->post('offer_id');
            $price            = $this->input->post('price');
            $country          = $this->input->post('country');
            $offer_desc       = $this->input->post('description');

            $arr_req  = array(
                'offered_buyer_id'   => $this->session->userdata('user_id'),
                'offer_id'           => $offer_id,
                'offered_price'      => $price, 
                'offer_description'  => $offer_desc, 
                'offer_country'      => $country,
                'offer_created_date' => date('Y-m-d H:m:s')
            );

            if($this->db->insert('tbl_apply_for_offers' , $arr_req)){
              
                $minus_availble_post_count = $getAvailablePostCount[0]['available'] - 1;
                $plus_completed_post_count = $getAvailablePostCount[0]['competed']  + 1;

                $arr_post_update_data = array(
                        'available'  => $minus_availble_post_count,
                        'competed'   => $plus_completed_post_count,
                );
                $this->db->where('buyer_id' , $this->session->userdata('user_id'));
                $this->db->update('tbl_buyer_offer_count',$arr_post_update_data);


                /* insert notification */
                $this->db->where('tbl_seller_products_offers.id' , $offer_id);
                $getofferdetails = $this->master_model->getRecords('tbl_seller_products_offers');
                if(isset($getofferdetails[0]['title'])) { $offer = $getofferdetails[0]['title']; } else { $offer ="Not Available"; }
                $arr_noti  = array(
                'seller_id'          => $getofferdetails[0]['seller_id'],
                'buyer_id'           => $this->session->userdata('user_id'),
                'notification'       => 'New offer received for - <b>'.$offer.'</b> offer.',
                'url'                => base_url().'seller/offer_detail/'.$offer_id,
                'details'            => $offer_desc,
                'created_date'       => date('Y-m-d H:m:s'),
                'status'             =>'Unblock',
                'is_read'            =>'no'
                );
                $this->db->insert('tbl_seller_notifications' , $arr_noti);
                /* end insert notification */


                $arr_response['status'] = "success";
                $arr_response['msg']    = "Your offer successfully sent.";
                echo json_encode($arr_response);
                exit;
            }else {
                $arr_response['status'] = "error";
                $arr_response['msg']    = "Something was wrong,Please try again.";
                echo json_encode($arr_response);
                exit;
            }
        }
    }
} //  end class
