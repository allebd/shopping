		 <div class="container mb20 mt40">
            <div class="row row-wrap">                
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
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
                	<h2>Administrator</h2>
                    <?php echo form_open('gracefoods_admin/validate_credentials', array('class'=>'login-form')); ?>
                        <fieldset>
                            <div class="form-group">
								<label>Username*</label>
								<input type="username" class="form-control" name='myuser' placeholder="Username" required>
							</div>
							<div class="form-group">
								<label>Password*</label>
								<input type="password" class="form-control" name='mypass' placeholder="My secret password" required>
							</div>
							<button type="submit" class="btn btn-primary">Log In</button>
                        </fieldset>
                    <?php echo form_close(); ?>
                </div>
                <div class="col-md-4">
                </div>
            </div>
            <div class="gap"></div>
        </div>