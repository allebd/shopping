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
                    <h3><strong>Password Recovery</strong></h3>
                    <!-- <p>Forgot your password? Don't worry we can deal with it</p> -->
                    <?php echo form_open('account/reset_password', array('class'=>'login-form')); ?>
                        <fieldset>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name='mymail' placeholder="email@domain.com" class="form-control" required />
                            </div>
                            <button type="submit" class="btn btn-primary">Request new password</button>
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