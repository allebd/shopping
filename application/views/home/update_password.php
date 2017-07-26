   <!-- //////////////////////////////////
	//////////////PAGE CONTENT///////////// 
	////////////////////////////////////-->



        <div class="container">
            <div class="row row-wrap">      
                <div class="col-md-3"></div>
                <div class="col-md-6">                    
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
                    <h3><strong>Update Password</strong></h3>
                    <?php echo form_open('account/update_password', array('class'=>'login-form')); ?>
                        <fieldset>                            
                            <div class="form-group">
                                <label>E-mail</label>
                                <?php if(isset($email_hash, $email_code)): ?>
                                <?php echo form_error('email_hash', '<p class="error">', '</p>'); ?>
                                <input type='hidden' value='<?php echo $email_hash; ?>' name='email_hash' />
                                <?php echo form_error('email_code', '<p class="error">', '</p>'); ?>
                                <input type='hidden' value='<?php echo $email_code; ?>' name='email_code' />
                                <?php endif; ?>
                                <?php echo form_error('mymail', "<div class='alert alert-danger alert-error'>
                                <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                                <input type="email" name='mymail' placeholder="email@domain.com" class="form-control" required>
                            </div> 
                            <div class="form-group">
                                <label>Password</label>
                                <?php echo form_error('mypass', "<div class='alert alert-danger alert-error'>
                                <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                                <input type="password" name='mypass' placeholder="My secret password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Repeat Password</label>
                                <?php echo form_error('user_passconfirm', "<div class='alert alert-danger alert-error'>
                                <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                                <input type="password" name='user_passconfirm'  placeholder="Type your password again" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update my password</button>
                        </fieldset>
                    <?php echo form_close(); ?>
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="gap gap-small"></div>
        </div>


        <!-- //////////////////////////////////
	//////////////END PAGE CONTENT///////// 
	////////////////////////////////////-->