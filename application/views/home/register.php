        <!-- //////////////////////////////////
    //////////////PAGE CONTENT///////////// 
    ////////////////////////////////////-->



        <div class="container">
            <div class="row row-wrap"> 
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
                <div class="col-md-6">
                    <h3><strong>Login</strong></h3>
                    <p>Already have an account with us. Welcome back, friend. Sign In to get started</p>
                    <a href="#login-dialog" data-effect="mfp-zoom-out" class="popup-text btn btn-primary">Sign In</a>
                </div>
                <div class="col-md-6">
                    <h3><strong>Register Here</strong></h3>
                    <?php echo form_open('account/registration', array('class'=>'login-form')); ?>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <?php echo form_error('user_last', "<div class='alert alert-danger alert-error'>
                                <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                                        <input type="text" name='user_last' <?php if(!isset($this->session->flashdata('the_success'))): ?>value="<?php echo set_value('user_last'); ?>"<?php endif; ?> placeholder="Last Name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <?php echo form_error('user_first', "<div class='alert alert-danger alert-error'>
                                <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                                        <input type="text" name='user_first' <?php if(!isset($this->session->flashdata('the_success'))): ?>value="<?php echo set_value('user_first'); ?>"<?php endif; ?> placeholder="First Name" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>E-mail</label>
                                <?php echo form_error('user_mail', "<div class='alert alert-danger alert-error'>
                                <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                                <input type="email" name='user_mail' <?php if(!isset($this->session->flashdata('the_success'))): ?>value="<?php echo set_value('user_mail'); ?>"<?php endif; ?> placeholder="email@domain.com" class="form-control" required>
                            </div>                
                            <div class="form-group">
                                <label>Phone Number</label>
                                <?php echo form_error('user_phone', "<div class='alert alert-danger alert-error'>
                                <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                                <input type="number" name='user_phone' <?php if(!isset($this->session->flashdata('the_success'))): ?>value="<?php echo set_value('user_phone'); ?>"<?php endif; ?> placeholder="08010000000" class="form-control" required>
                            </div> 
                            <div class="form-group">
                                <label>Password</label>
                                <?php echo form_error('user_pass', "<div class='alert alert-danger alert-error'>
                                <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                                <input type="password" name='user_pass' placeholder="My secret password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Repeat Password</label>
                                <?php echo form_error('user_passconfirm', "<div class='alert alert-danger alert-error'>
                                <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                                <input type="password" name='user_passconfirm'  placeholder="Type your password again" class="form-control" required>
                            </div>               
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id='checkme' value="Terms"><?=anchor('terms_and_conditions', 'I agree with the terms and conditions', array('target'=>'_blank')); ?>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary" id='registeracct' disabled>Sign Up</button>
                        </fieldset>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <div class="gap gap-small"></div>
        </div>


        <!-- //////////////////////////////////
    //////////////END PAGE CONTENT///////// 
    ////////////////////////////////////-->