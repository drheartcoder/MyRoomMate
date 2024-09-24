<!-- BEGIN Theme Setting -->
<div id="theme-setting">
  <?php //$this->load->view('admin/theme-setting'); ?>
</div>
<!-- END Theme Setting -->

<!-- BEGIN Navbar -->
<div id="navbar" class="navbar">
  <?php $this->load->view('admin/top-navigation'); ?>
</div>
<!-- END Navbar -->

<!-- BEGIN Container -->
<div class="container" id="main-container">
  <!-- BEGIN Sidebar -->
  <div id="sidebar" class="navbar-collapse collapse">
    <?php $this->load->view('admin/left-navigation'); ?>
  </div>
  <!-- END Sidebar -->

  <!-- BEGIN Content -->
  <div id="main-content">
    <!-- BEGIN Page Title -->
    <div class="page-title">
      <div>
         <h1><i class="fa fa-th-large"></i><?php echo ucfirst($page_title); ?></h1>
        <h4></h4>
      </div>
    </div>
    <!-- END Page Title -->
    <!-- BEGIN Breadcrumb -->
    <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url().'admin/dashboard/' ?>">Home</a> <span class="divider">
                <i class="fa fa-angle-right"></i></span>
                </li>
                <li><a href="<?php echo base_url().'admin/listing/manage' ?>">Manage listing</a> <span class="divider">
                <i class="fa fa-angle-right"></i></span>
                </li>
            <li class="active"><?php echo $page_title; ?></li>
          </ul>
    <!-- END Breadcrumb -->
    <!-- BEGIN Main Content -->
  <div class="row">
    <div class="col-md-12">
        <div class="box ">
            <div class="box-title">
                <h3><i class="fa fa-th-large"></i><?php echo ucfirst($page_title); ?></h3>
                <div class="box-tool">
                </div>
            </div>
            <div class="box-content">
              <form method="post" class="form-horizontal" id="validation-form" enctype="multipart/form-data">
              	  <div class="form-group">
                  	<div class="col-sm-12">
               		 	<?php if($this->session->flashdata('error')!=''){  ?>
                		 <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
               			 <?php }
                		 if($this->session->flashdata('success')!=''){?>
                		 <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
						 <?php } ?>
                     </div>
				  </div>
                   <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Name:</label>
                      <div class="col-sm-9 col-lg-10 controls">
                       
                     <?php
                      $where = array('verification_status'=>'Verified','status'=>'Unblock' , 'id' => $mylisting_data[0]['user_id']);
                      $fetchuser = $this->master_model->getRecords('tbl_user_master',$where);
                     // print_r($fetchuser);exit;

                          if($fetchuser)
                          {
                            echo $fetchuser['firstname'];
                          }
                          else
                          {
                            echo"Not Available";

                          }

                     /* foreach($fetchuser as $user)
                      {
                        if($user['id'] == $mylisting_data[0]['user_id'])
                        {
                          echo $user['firstname'];
                        }
                        else
                        {
                          echo "NA";
                        }

                      } */
                     ?>
                                 
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Category:</label>
                      <div class="col-sm-9 col-lg-10 controls">
                       
                      <?php foreach($fetchcategory as $category) 
                      {
                             if($category['category_id'] == $mylisting_data[0]['cat_id'])
                              {
                                  
                                    echo $category['category_name'];
                                  
                              } 

                        }
                      ?>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Title:</label>
                      <div class="col-sm-9 col-lg-10 controls">
                       
                        <?php echo isset($mylisting_data[0]['title'])?$mylisting_data[0]['title']:''; ?>
                                 
                      </div>
                  </div>
                  <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Description:</label>
                      <div class="col-sm-9 col-lg-10 controls">
                       <?php echo isset($mylisting_data[0]['description'])?$mylisting_data[0]['description']:''; ?>
                       </div>
                  </div>
                  <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Image Upload:</label>
                      <div class="col-sm-9 col-lg-10 controls">
                        <?php
                         $filename = 'uploads/addlisting_images/'.$mylisting_data[0]['mainphoto'];
                           if (file_exists($filename) && !empty($mylisting_data[0]['mainphoto']))
                           { 
                            
                           ?>
                           <img width='100px' height='100px'  src='<?php echo base_url().'uploads/addlisting_images/'.$mylisting_data[0]['mainphoto'];?>' alt="" />
                           <?php }else{ ?>
                            <img width='100px' height='100px'  src='<?php echo base_url().'uploads/noimage/'.'noimagefound.jpg'?>' alt="" />
                          <?php 
                          }?>
                       </div>
                  </div> 
                  <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Mobile Number:</label>
                      <div class="col-sm-9 col-lg-10 controls">
                       <?php echo isset($mylisting_data[0]['mobile'])?$mylisting_data[0]['mobile']:'NA'; ?>
                       </div>
                  </div> 
                   <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Email:</label>
                      <div class="col-sm-9 col-lg-10 controls">
                       <?php echo isset($mylisting_data[0]['email'])?$mylisting_data[0]['email']:'NA'; ?>
                       </div>
                  </div> 
                  <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">City:</label>
                      <div class="col-sm-9 col-lg-10 controls">
                     <?php foreach($fetchresidence as $residence) 
                     { 
                         if($mylisting_data['0']['countryofresidence'] == $residence['residence_id'] ) 
                         { 
                           echo $residence['residence_name'];
                         }

                     } 
                     ?>   
                    </div>
                  </div> 
                   <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Price:</label>
                      <div class="col-sm-9 col-lg-10 controls">
                     <?php echo isset($mylisting_data[0]['price'])?$mylisting_data[0]['price']:''; ?>
                       </div>
                  </div> 
                  <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Country:</label>
                      <div class="col-sm-9 col-lg-10 controls">
                       <?php foreach($fetchcountry as $country) 
                       {                                     
                           if($mylisting_data['0']['country'] == $country['country_id'] )
                           {
                              echo $country['country_name'];
                           }           
                        } 
                        ?>
                       </div>
                  </div> 
                  <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Availability:</label>
                      <div class="col-sm-9 col-lg-10 controls">
                       <?php $availability = isset($mylisting_data[0]['availability'])?$mylisting_data[0]['availability']:''; ?>
                   
                          <?php 
                              if($availability == 'Immediately')
                              {
                                echo"Immediately";
                              }
                              elseif($availability == 'Within1Week')
                              {
                                echo"Within1Week";
                              }
                              elseif($availability == 'Within1Month')
                              {
                                echo"Within1Month";
                              }
                              elseif($availability == 'Within3Months')
                              {
                                echo"Within3Months";
                              }
                              elseif($availability == 'Within6Months')
                              {
                                echo"Within6Months";
                              }
                              else
                              {
                                echo "NA";
                              }
                          ?>
                       </div>
                  </div> 
                  <div class="form-group">
                     <label class="col-sm-3 col-lg-2 control-label">&nbsp;</label>
                      <div class="col-sm-9 col-lg-10 controls">
                      <a class="btn" align="right"  href="<?php echo base_url().'admin/listing/manage';?>" >Back </a>
                      </div>
                  </div>
               </form>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('admin/top-footer'); ?>

<!-- END Main Content -->
