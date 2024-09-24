<div class="main-inner-gray">
 <div class="container">
     <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
             <?php $this->load->view('user/left-menu'); ?> 
         </div>
         <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
           <div class="row">
               <div class="col-md-6"><div class="title-inner-page">View Received Inquiry</div></div>
               <div class="col-md-6"><div class="backbtn"><a href="<?php echo base_url().'user/received_inquiry' ?>"><span><i class="fa fa-long-arrow-left"></i></span>Back</a></div></div>
           </div>
            <div class="main-inner padding-o">
               
               <div class="table-responsive">
                    <table class="table transe-detai-table my-profile-table">                                
                        <tbody>
                            <?php
                            if(count($inquiry_view_data) > 0)
                            {
                                foreach($inquiry_view_data as $data)
                                {
                                    ?>
                                    <tr>
                                        <td class="bold-fnts">Full Name:</td>
                                        <td><?php echo $data['name']; ?></td>
                                    </tr>
                                    <tr style="background-color: #FAFAFA;">
                                        <td class="bold-fnts">Email Address:</td>
                                        <td><?php echo $data['email']; ?></td>
                                    </tr>
                                    <tr style="background-color: #FAFAFA;">
                                        <td class="bold-fnts">Phone:</td>
                                        <td><?php echo $data['mobile_no']; ?></td>
                                    </tr>
                                    <tr style="background-color: #FAFAFA;">
                                        <td class="bold-fnts">Subject:</td>
                                        <td><?php echo $data['subject']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bold-fnts">Message:</td>
                                        <td><?php echo $data['message']; ?></td>
                                    </tr>
                                    <tr style="background-color: #FAFAFA;">
                                        <td class="bold-fnts">Date and Time:</td>
                                        <td><?php echo date("d F Y h:m:sa", strtotime($data['date_time'])); ?></td>
                                    </tr>
                                    <?php 
                                } // end foreach 
                            } // end if
                            else
                            {
                                ?>
                                    <tr>
                                        <td style="text-align:center"><h3>No Data Found</h3></td>
                                    </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
            </div>	
             
         </div>
         </div>
 </div>
</div> 

    </div>
    