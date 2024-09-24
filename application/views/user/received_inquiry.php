
 
    <div class="main-inner-gray">
 <div class="container">
     
     <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
             <?php $this->load->view('user/left-menu'); ?> 
         </div>
         <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
           <div class="title-inner-page">Received Inquiries</div>
            <div class="main-inner padding-o">
               
               <div class="table-responsive">
                    <table class="table transe-detai-table my-profile-table received-inqury-tble"> 
                       <thead>
                           <th>Id</th>
                           <th>Full Name</th>
                           <th>Email Address</th>
                           <th>Phone</th>
                           <th>Subject</th>
                           <th>Action</th>
                       </thead>                               
                        <tbody>
                            <?php
                            if(count($inquiry_data) > 0)
                            {
                                foreach($inquiry_data as $data)
                                {
                            ?>
                            <tr>
                                <td width="10%"><?php echo $data['contact_id']; ?></td>
                                <td width="20%"><?php echo $data['name']; ?></td>
                                <td width="15%"><?php echo $data['email']; ?></td>
                                <td width="10%"><?php echo $data['mobile_no']; ?></td>
                                <td width="25%"><?php echo $data['subject']; ?></td>
                                <td width="15%">
                                <div class="action-icon">
                                <!--<a href="#"> <i class="fa fa-reply" aria-hidden="true"></i></a>-->
                                 <a href="<?php echo base_url().'user/received_inquiry_view/'.base64_encode($data['contact_id']); ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a href="javascript:void(0);" class="to_delete" data-contact_id="<?php echo base64_encode($data['contact_id']); ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                </div>
                                </td>
                            </tr>
                            <?php
                                }// end foreach
                            }// end if
                            else
                            {
                                ?>
                                <tr>
                                    <td colspan="5" style="text-align:center;"><h4>No Inquiry Received</h4></td>
                                </tr>
                                <?php
                            } // end else if
                            ?>
                        </tbody>
                    </table>
            </div>	
            <div class="">
                <?php echo $this->pagination->create_links(); ?>
            </div>
         </div>
         </div>
 </div>
</div> 

    </div>

<!-- sweet alert -->
<script src="<?php echo base_url(); ?>assets/sweetalert/sweetalert.min.js"></script> <script src="<?php echo base_url(); ?>assets/sweetalert/sweetalert_actions.js">
  
</script> <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/sweetalert/sweetalert.css">
<style type="text/css">
.sweet-alert {
    background-color: white;
    font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
    width: 478px;
    padding: 17px;
    border-radius: 5px;
    text-align: center;
    position: fixed;
    left: 50%;
    top: 10%;
    margin-left: -256px;
    margin-top: 100px !important;
    overflow: hidden;
    display: none;
    z-index: 99999;
}  
</style>
<!-- end sweet alert -->

<script type="text/javascript">
  
  $('.to_delete').click(function(){
        var contact_id = jQuery(this).data("contact_id");
        //alert(contact_id);
        swal({   
             title: "Are you sure?",   
             text: "You want to delete Received Inquiry ?",  
             type: "warning",   
             showCancelButton: true,   
             confirmButtonColor: "#8cc63e",  
             confirmButtonText: "Yes",  
             cancelButtonText: "No",   
             closeOnConfirm: false,   
             closeOnCancel: false }, function(isConfirm){   
              if (isConfirm) 
              { 
                     swal("Deleted!", "Received Inquiry Deleted", "success"); 
                           location.href=site_url+"user/delete_received_inquiry/"+contact_id;
              } 
              else
              { 
                     swal("Cancelled", "Received Inquiry Not Deleted :)", "error");          
                } 
            });
    }); 

</script>
 