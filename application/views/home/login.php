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
                    <?php if(isset($reg_success) && ($reg_success != '')):?>
                    <div class='alert alert-success'>
                        <button type='button' class='close' data-dismiss='alert'>×</button>
                        <?=$reg_success; ?>
                    </div>
                    <?php endif;?>                          
                <div class="col-md-6">
                    <h3><strong>Register</strong></h3>
                    <p>By creating an account with us, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                    <a href="#register-dialog" data-effect="mfp-zoom-out" class="popup-text btn btn-primary">Sign Up</a>
                </div>
                <div class="col-md-6">
                    <h3><strong>Login</strong></h3>
                    <?php echo form_open('account/validate_credentials', array('class'=>'login-form')); ?>
                        <fieldset>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name='mymail' placeholder="email@domain.com" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name='mypass' placeholder="My secret password" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label><a href="#password-recover-dialog" data-effect="mfp-zoom-out" class="popup-text">Forgot your password?</a></label>
                            </div>
                            <button type="submit" class="btn btn-primary">Log In</button>
                        </fieldset>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <div class="gap gap-small"></div>
        </div>


        <!-- //////////////////////////////////
	//////////////END PAGE CONTENT///////// 
	////////////////////////////////////-->