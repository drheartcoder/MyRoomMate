<div class="sidebar inner-sidebr">
    <ul class="main-categories inner-sidebar">
        <li <?php if($this->uri->segment(2) == "dashboard" ) { ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>user/dashboard" class="profile-icon">Profile</a></li>
        <li <?php if($this->uri->segment(2) == "changepassword" ) { ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>user/changepassword" class="change-password-icon">Change Password</a></li>
        <li <?php if($this->uri->segment(2) == "addlisting" ) { ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>user/addlisting" class="add-listing-icon">Add Listing</a></li>
        <li <?php if($this->uri->segment(2) == "mylisting" || $this->uri->segment(2) == "mylisting_details" || $this->uri->segment(2) == "edit_mylisting" ) { ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>user/mylisting" class="my-listing-icon">My Listings</a></li>
        <li <?php if($this->uri->segment(2) == "myfavorite" ) { ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>user/myfavorite" class="favourite-icon">Favourites</a></li>
        <li <?php if($this->uri->segment(2) == "received_inquiry" || $this->uri->segment(2) == "received_inquiry_view" ) { ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>user/received_inquiry" class="received-inquiry-icon">Received Inquiries</a></li>
        <li <?php if($this->uri->segment(2) == "logout" ) { ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>login/logout" class="logout-icon">Logout</a></li>
    </ul>
</div>