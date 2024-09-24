<!-- BEGIN Navlist -->
<?php $pagename=$this->router->fetch_class()."/".$this->router->fetch_method(); ?>
<ul class="nav nav-list">
  


  <li  <?php if($pagename=='dashboard/')echo 'class="active"'; ?>>
    <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>dashboard/">
       <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
    </a> 
  </li>


  <li  <?php if($this->router->fetch_class()=='profile' ){?> class="active" <?php }?>> 
    <a href="javascript:void(0);" class="dropdown-toggle">
      <i class="fa fa-cog"></i><span>&nbsp;&nbsp;Profile</span> <b class="arrow fa fa-angle-right"></b>
    </a> 
      <ul class="submenu">
        <li <?php if($this->router->fetch_class()=='profile' && $this->router->fetch_method()=='change_password'){?> class="active" <?php }?>><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>profile/change_password/">Change Password</a></li>

        <li <?php if($this->router->fetch_class()=='profile' && $this->router->fetch_method()=='edit'){?> class="active" <?php }?>><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>profile/edit/">Edit Profile</a></li>

        <li<?php  if($this->router->fetch_class()=='profile'  && $this->router->fetch_method()=='payment'){?> class="active" <?php }?>> <a  href="<?php echo base_url().ADMIN_PANEL_NAME.'profile/payment/'; ?>">Payment info</a></li>

        <li<?php  if($this->router->fetch_class()=='profile'  && $this->router->fetch_method()=='social' ){?> class="active" <?php }?>> <a  href="<?php echo base_url().ADMIN_PANEL_NAME.'profile/social/'; ?>">Social Links</a></li>
      </ul>
  </li>
 

    <!--COUNTRY-->
  
     <li  <?php if($this->router->fetch_class()=='country' ){?> class="active" <?php }?>> 
      <a href="javascript:void(0);" class="dropdown-toggle">
        <i class="fa fa-tag" aria-hidden="true"></i><span>&nbsp;&nbsp;Country</span> <b class="arrow fa fa-angle-right"></b>
      </a> 
        <ul class="submenu">
          
          <li <?php if($this->router->fetch_class()=='country' && $this->router->fetch_method()=='add'){?> class="active" <?php }?>><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>country/add/">Add</a></li>

          <li <?php if($this->router->fetch_class()=='country' && $this->router->fetch_method()=='manage'){?> class="active" <?php }?>><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>country/manage/">Manage</a></li>
          
        </ul>
    </li> 


    <!--residence-->   

    <li  <?php if($this->router->fetch_class()=='residence' ){?> class="active" <?php }?>> 
      <a href="javascript:void(0);" class="dropdown-toggle">
        <i class="fa fa-tags" aria-hidden="true"></i><span>&nbsp;&nbsp;Residence</span> <b class="arrow fa fa-angle-right"></b>
      </a> 
        <ul class="submenu">
          
          <li <?php if($this->router->fetch_class()=='residence' && $this->router->fetch_method()=='add'){?> class="active" <?php }?>><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>residence/add/">Add</a></li>

          <li <?php if($this->router->fetch_class()=='residence' && $this->router->fetch_method()=='manage'){?> class="active" <?php }?>><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>residence/manage/">Manage</a></li>
          
        </ul>
    </li> 

  <!--CATEGORY-->
  
     <li  <?php if($this->router->fetch_class()=='category' ){?> class="active" <?php }?>> 
      <a href="javascript:void(0);" class="dropdown-toggle">
        <i class="fa fa-tag" aria-hidden="true"></i><span>&nbsp;&nbsp;Category</span> <b class="arrow fa fa-angle-right"></b>
      </a> 
        <ul class="submenu">
          
          <li <?php if($this->router->fetch_class()=='category' && $this->router->fetch_method()=='add'){?> class="active" <?php }?>><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>category/add/">Add</a></li>

          <li <?php if($this->router->fetch_class()=='category' && $this->router->fetch_method()=='manage'){?> class="active" <?php }?>><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>category/manage/">Manage</a></li>
          
        </ul>
    </li> 

<!--Attribute-->
  
     <li  <?php if($this->router->fetch_class()=='attribute' ){?> class="active" <?php }?>> 
      <a href="javascript:void(0);" class="dropdown-toggle">
        <i class="fa fa-tag" aria-hidden="true"></i><span>&nbsp;&nbsp;Attribute</span> <b class="arrow fa fa-angle-right"></b>
      </a> 
        <ul class="submenu">
          
          <li <?php if($this->router->fetch_class()=='attribute' && $this->router->fetch_method()=='add'){?> class="active" <?php }?>><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>attribute/add/">Add</a></li>

          <li <?php if($this->router->fetch_class()=='attribute' && $this->router->fetch_method()=='manage'){?> class="active" <?php }?>><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>attribute/manage/">Manage</a></li>
          
        </ul>
    </li> 


  <!--SUB-CATEGORY-->   

    <?php /*<li  <?php if($this->router->fetch_class()=='subcategory' ){?> class="active" <?php }?>> 
      <a href="javascript:void(0);" class="dropdown-toggle">
        <i class="fa fa-tags" aria-hidden="true"></i><span>&nbsp;&nbsp;Sub-category</span> <b class="arrow fa fa-angle-right"></b>
      </a> 
        <ul class="submenu">
          
          <li <?php if($this->router->fetch_class()=='subcategory' && $this->router->fetch_method()=='add'){?> class="active" <?php }?>><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>subcategory/add/">Add</a></li>

          <li <?php if($this->router->fetch_class()=='subcategory' && $this->router->fetch_method()=='manage'){?> class="active" <?php }?>><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>subcategory/manage/">Manage</a></li>
          
        </ul>
    </li> */ ?>

<!--CATEGORY FIELDS -->   

    <li  <?php if($this->router->fetch_class()=='categoryfields' ){?> class="active" <?php }?>> 
      <a href="javascript:void(0);" class="dropdown-toggle">
        <i class="fa fa-tags" aria-hidden="true"></i><span>&nbsp;&nbsp;Custom Fields</span> <b class="arrow fa fa-angle-right"></b>
      </a> 
        <ul class="submenu">
          
          <li <?php if($this->router->fetch_class()=='categoryfields' && $this->router->fetch_method()=='add'){?> class="active" <?php }?>><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>categoryfields/add/">Add</a></li>

          <li <?php if($this->router->fetch_class()=='categoryfields' && $this->router->fetch_method()=='manage'){?> class="active" <?php }?>><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>categoryfields/manage/">Manage</a></li>
          
        </ul>
    </li>

  <!--SELLERS-->
  
     <li <?php if($this->router->fetch_class()=='users' || $this->router->fetch_class()=='reviews'){?> class="active" <?php }?>> 
      <a href="javascript:void(0);" class="dropdown-toggle">
        <i class="fa fa-users" aria-hidden="true"></i><span>&nbsp;&nbsp;Sellers</span> <b class="arrow fa fa-angle-right"></b>
      </a> 
        <ul class="submenu">

          <li <?php if($this->router->fetch_class()=='users' && $this->router->fetch_method()=='manage'){?> class="active" <?php }?>><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>users/manage/">Manage</a></li>

        </ul>
    </li> 

  <!--FRONT -PAGES -->   

  <li   <?php if($this->router->fetch_class()=='pages' ){?> class="active" <?php }?>> 
    <a href="javascript:void(0);" class="dropdown-toggle">
      <i class="fa fa-file-o" aria-hidden="true"></i><span>&nbsp;&nbsp;Front Pages</span> <b class="arrow fa fa-angle-right"></b>
    </a> 
      <ul class="submenu">
        
        <li <?php if($this->router->fetch_class()=='pages' && $this->router->fetch_method()=='manage'){?> class="active" <?php }?>><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>pages/manage/">Manage</a></li>
        
      </ul>
  </li>

  <li <?php if($this->router->fetch_class()=='testimonials'){?> class="active" <?php }?>>
    <a href="#" class="dropdown-toggle" >
      <i class="fa fa-file-o"></i>
      <span>Testimonials</span>
      <b class="arrow fa <?php if($this->router->fetch_class()=='testimonials' ){echo 'fa-angle-down';}else{echo 'fa-angle-right';} ?>"></b>
    </a>
    <ul class="submenu">
    <li <?php if($this->uri->segment(3)=='add'){?> class="active" <?php }?>><a href="<?php echo base_url().'admin/testimonials/add'; ?>">Add </a></li>
      <li <?php if($this->uri->segment(3)=='manage'){?> class="active" <?php }?>><a href="<?php echo base_url().'admin/testimonials/manage'; ?>">Manage </a></li>
    </ul>
  </li>

  <li <?php if($this->router->fetch_class()=='blogs' || $this->router->fetch_class()=='blogscategory' || $this->router->fetch_class()=='blogscomments'){?> class="active" <?php }?>>
    <a href="#" class="dropdown-toggle" >
      <i class="fa fa-rss"></i>
      <span>Blogs</span>
      <b class="arrow fa <?php if($this->router->fetch_class()=='blogs' ){echo 'fa-angle-down';}else{echo 'fa-angle-right';} ?>"></b>
    </a>
    <ul class="submenu">
    <li <?php if($this->uri->segment(3)=='add'){?> class="active" <?php }?>><a href="<?php echo base_url().'admin/blogscategory/add'; ?>">Add Category</a></li>
    <li <?php if($this->uri->segment(3)=='manage'){?> class="active" <?php }?>><a href="<?php echo base_url().'admin/blogscategory/manage'; ?>">Manage Category </a></li>
    <li <?php if($this->uri->segment(3)=='add'){?> class="active" <?php }?>><a href="<?php echo base_url().'admin/blogs/add'; ?>">Add Blog</a></li>
    <li <?php if($this->uri->segment(3)=='manage'){?> class="active" <?php }?>><a href="<?php echo base_url().'admin/blogs/manage'; ?>">Manage Blog</a></li>
    <li <?php if($this->uri->segment(3)=='manage'){?> class="active" <?php }?>><a href="<?php echo base_url().'admin/blogscomments/manage'; ?>">Blogs Comments </a></li>
    </ul>
  </li>

    <li  <?php if($this->router->fetch_class()=='subscribe' ){?> class="active" <?php }?>> 
      <a href="javascript:void(0);" class="dropdown-toggle">
        <i class="fa fa-envelope-o" aria-hidden="true"></i><span>&nbsp;&nbsp;Subscribers</span> <b class="arrow fa fa-angle-right"></b>
      </a> 
        <ul class="submenu">
          <li <?php if($this->router->fetch_class()=='subscribe' && $this->router->fetch_method()=='manage'){?> class="active" <?php }?>><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>subscribe/manage/">manage</a></li>
        </ul>
    </li>
    <li <?php if($this->router->fetch_class()=='Contactenquiry'){?> class="active" <?php }?> >
      <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>Contactenquiry/manage">
       <i class="fa fa-phone"></i>
       <span>Contact Enquiry</span>
     </a>
    </li>
    <!-- -----------------payment option--------------------------- -->
     <li <?php if($this->router->fetch_class()=='paymentoption' ){?> class="active" <?php }?>> 
      <a href="javascript:void(0);" class="dropdown-toggle">
        <i class="fa fa-eur" aria-hidden="true"></i><span>&nbsp;&nbsp;Payment Option</span> <b class="arrow fa fa-angle-right"></b>
      </a> 
        <ul class="submenu">
          <li <?php if($this->router->fetch_class()=='paymentoption' && $this->router->fetch_method()=='manage'){?> class="active" <?php }?>><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>paymentoption/manage/">Manage</a></li>
          
        </ul>
    </li>   
 <!-- ----------------------------Advertisement------------------------- -->
     <li <?php if($this->router->fetch_class()=='advertisement' ){?> class="active" <?php }?>> 
      <a href="javascript:void(0);" class="dropdown-toggle">
        <i class="fa fa-file-o" aria-hidden="true"></i><span>&nbsp;&nbsp;Advertisement</span> <b class="arrow fa fa-angle-right"></b>
      </a> 
        <ul class="submenu">
          <li <?php if($this->router->fetch_class()=='advertisement' && $this->router->fetch_method()=='manage'){?> class="active" <?php }?>><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>advertisement/add/">Add</a></li>
          <li <?php if($this->router->fetch_class()=='advertisement' && $this->router->fetch_method()=='manage'){?> class="active" <?php }?>><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>advertisement/manage/">Manage</a></li>
          
        </ul>
    </li>
    <li <?php if($this->router->fetch_class()=='listing' ){?> class="active" <?php }?>> 
      <a href="javascript:void(0);" class="dropdown-toggle">
        <i class="fa fa-tag" aria-hidden="true"></i><span>&nbsp;&nbsp;Listing</span> <b class="arrow fa fa-angle-right"></b>
      </a> 
        <ul class="submenu">
          <li <?php if($this->router->fetch_class()=='listing' && $this->router->fetch_method()=='manage'){?> class="active" <?php }?>><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>listing/manage/">Manage</a></li>
          
        </ul>
    </li>

</ul>
<!-- END Navlist --> 

<!-- BEGIN Sidebar Collapse Button -->
<div id="sidebar-collapse" class="visible-lg"> <i class="fa fa-angle-double-left"></i> </div>
<!-- END Sidebar Collapse Button --> 