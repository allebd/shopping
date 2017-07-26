 <!-- //////////////////////////////////
    //////////////PAGE CONTENT///////////// 
    ////////////////////////////////////-->



        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <aside class="sidebar-left">
                        <div class="panel-group" id="accordion">
                            <ul class="list-group">
                                <li class="list-group-item <?php echo (($my_side_link == "profile_admin") || ($my_side_link == "profile_admin/index")) ? 'active' : ''; ?>" ><a href="<?=base_url();?>profile_admin">Profile</a>
                                </li>
                                <?php foreach($regquery->result() as $suprow): ?>
                                <?php if($suprow->admin_username == 'super admin'): ?>
                                <li class="list-group-item <?php echo ($my_side_link == "profile_admin/manage_admins") ? 'active' : ''; ?>" ><a href="<?=base_url();?>profile_admin/manage_admins">Manage Admins</a>
                                </li>
                                <?php endif; ?>
                                <?php endforeach; ?>
                                <li class="list-group-item" ><a href="https://server1.hostsleek.net:2096/" target='_blank'>Access Webmail</a>
                                </li>
                            </ul>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed">Product Management</a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse"  style="height: 0px;">
                                    <ul class="list-group">
                                        <li class="list-group-item <?php echo ($my_side_link == "profile_admin/manage_product_type") ? "active" : ""; ?>">
                                            <?=anchor('profile_admin/manage_product_type', 'Manage Product Type'); ?>
                                        </li>  
                                        <li class="list-group-item <?php echo ($my_side_link == "profile_admin/manage_product_subtype") ? "active" : ""; ?>">
                                            <?=anchor('profile_admin/manage_product_subtype', 'Manage Product Sub-Type'); ?>
                                        </li>                                                                             
                                        <li class="list-group-item <?php echo ($my_side_link == "profile_admin/manage_products") ? "active" : ""; ?>">
                                            <?=anchor('profile_admin/manage_products', 'Manage Products'); ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed">Customer Management</a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse"  style="height: 0px;">
                                    <ul class="list-group">
                                        <li class="list-group-item <?php echo ($my_side_link == "profile_admin/manage_customers") ? "active" : ""; ?>">
                                            <?=anchor('profile_admin/manage_customers', 'Manage Customers'); ?>
                                        </li>  
                                        <li class="list-group-item popup-text"  href="#shipping-dialog" data-effect="mfp-move-from-top">
                                            <?=anchor('profile_admin/manage_shipping_fee', 'Manage Shipping Fee'); ?>
                                        </li>                                                                              
                                        <li class="list-group-item <?php echo ($my_side_link == "profile_admin/manage_orders") ? "active" : ""; ?>">
                                            <?=anchor('profile_admin/manage_orders', 'Manage Orders'); ?>
                                        </li>
                                        <li class="list-group-item <?php echo ($my_side_link == "profile_admin/manage_newsletter") ? "active" : ""; ?>">
                                            <?=anchor('profile_admin/manage_newsletter', 'Manage Newsletter'); ?>
                                        </li> 
                                    </ul>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">Site Management</a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse"  style="height: 0px;">
                                    <ul class="list-group">
                                        <li class="list-group-item <?php echo ($my_side_link == "profile_admin/manage_about") ? "active" : ""; ?>">
                                            <?=anchor('profile_admin/manage_about', 'Manage About Us'); ?>
                                        </li>
                                        <li class="list-group-item <?php echo ($my_side_link == "profile_admin/manage_social") ? "active" : ""; ?>">
                                            <?=anchor('profile_admin/manage_social', 'Manage Social Media Links'); ?>
                                        </li>
                                        <li class="list-group-item <?php echo ($my_side_link == "profile_admin/manage_slide") ? "active" : ""; ?>">
                                            <?=anchor('profile_admin/manage_slide', 'Manage Slide Show'); ?>
                                        </li>
                                        <li class=" list-group-item <?php echo ($my_side_link == "profile_admin/manage_faq") ? "active" : ""; ?>">
                                            <?=anchor('profile_admin/manage_faq', 'Manage FAQs'); ?>
                                        </li>
                                        <li class="list-group-item <?php echo ($my_side_link == "profile_admin/manage_privacy") ? "active" : ""; ?>">
                                            <?=anchor('profile_admin/manage_privacy', 'Manage Privacy Policy'); ?>
                                        </li>
                                        <li class=" list-group-item <?php echo ($my_side_link == "profile_admin/manage_terms") ? "active" : ""; ?>">
                                            <?=anchor('profile_admin/manage_terms', 'Manage Terms & Conditions'); ?>
                                        </li>
                                        <li class="list-group-item <?php echo ($my_side_link == "profile_admin/manage_changes") ? "active" : ""; ?>">
                                            <?=anchor('profile_admin/manage_changes', 'Manage Returns Policy'); ?>
                                        </li>                                        
                                        <li class=" list-group-item <?php echo ($my_side_link == "profile_admin/manage_careers") ? "active" : ""; ?>">
                                            <?=anchor('profile_admin/manage_careers', 'Manage Careers'); ?>
                                        </li>
                                        <li class="list-group-item <?php echo ($my_side_link == "profile_admin/manage_contact") ? "active" : ""; ?>">
                                            <?=anchor('profile_admin/manage_contact', 'Manage Contact Info'); ?>
                                        </li>
                                        <li class="list-group-item <?php echo ($my_side_link == "profile_admin/manage_welcome") ? "active" : ""; ?>">
                                            <?=anchor('profile_admin/manage_welcome', 'Manage Welcome Message'); ?>
                                        </li>
                                        <li class="list-group-item <?php echo ($my_side_link == "profile_admin/change_password") ? "active" : ""; ?>">
                                            <?=anchor('profile_admin/change_password', 'Change Password'); ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <ul class="list-group">
                                <li class="list-group-item <?php echo (($my_side_link == "gracefoods_admin/logout")) ? 'active' : ''; ?>" ><a href="<?=base_url();?>gracefoods_admin/logout">Logout</a>
                                </li>
                            </ul>
                        </div>
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
                    <div id="shipping-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
                        <i class="fa fa-sign-in dialog-icon"></i>

                        <?php echo form_open('profile_admin/update_shipping_fee', array('class'=>'dialog-form')); ?>
                            <div class="form-group">
                                <label>Shipping Fee</label>
                                <input type="number" name='shipping_fee' value ="<?php foreach($shipping as $shipping): echo $shipping->ship_amount; endforeach; ?>" class="form-control" required>
                            </div>

                            <input type="submit" value="Update"  class="btn btn-primary">
                        <?php echo form_close(); ?>

                    </div>

                    <?php if (!is_null($admin_dashboard_side_content) && isset($admin_dashboard_side_content)): ?>
                    <?php $this->load->view($admin_dashboard_side_content); ?>
                    <?php endif; ?>
                </div>

            </div>

        </div>


        <!-- //////////////////////////////////
    //////////////END PAGE CONTENT///////// 
    ////////////////////////////////////-->


