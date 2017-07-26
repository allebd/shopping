 <!-- //////////////////////////////////
	//////////////PAGE CONTENT///////////// 
	////////////////////////////////////-->



        <div class="container">
            <div class="row">
                <div class="col-md-3 mb10">
                    <aside class="sidebar-left">
                        <ul class="nav nav-pills nav-stacked nav-arrow">
                            <li <?php echo (($my_side_link == "profile") || ($my_side_link == "profile/index")) ? "class='active'" : ""; ?> ><a href="<?=base_url();?>profile">Profile</a>
                            </li>
                            <li <?php echo ($my_side_link == "profile/address") ? "class='active'" : ""; ?> ><a href="<?=base_url();?>profile/address">Address Book</a>
                            </li>
                            <li <?php echo ($my_side_link == "profile/orders") ? "class='active'" : ""; ?> ><a href="<?=base_url();?>profile/orders">Orders History</a>
                            </li>
                            <li <?php echo ($my_side_link == "profile/wishlist") ? "class='active'" : ""; ?> ><a href="<?=base_url();?>profile/wishlist">Wishlist</a>
                            </li>
                        </ul>
                    </aside>
                    <div class="gap"></div>
                </div>                

                <div class="col-md-9">
                    <?php
                        if($this->session->flashdata('the_error'))
                        { 
                            echo "<div class='alert alert-danger alert-error'>
                                <button type='button' class='close' data-dismiss='alert'>×</button>"
                                .$this->session->flashdata('the_error').
                                "</div>"; 
                        }
                    ?>  
                    <?php
                        if($this->session->flashdata('the_success'))
                        { 
                            echo "<div class='alert alert-success'>
                                <button type='button' class='close' data-dismiss='alert'>×</button>"
                                .$this->session->flashdata('the_success').
                                "</div>"; 
                        }
                    ?>   
                    <?php if (!is_null($dashboard_side_content) && isset($dashboard_side_content)): ?>
                    <?php $this->load->view($dashboard_side_content); ?>
                    <?php endif; ?>
                </div>

            </div>

        </div>


        <!-- //////////////////////////////////
    //////////////END PAGE CONTENT///////// 
    ////////////////////////////////////-->