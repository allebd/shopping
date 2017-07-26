
                    <div class="row">
                        <div class="col-md-6">
                            <h3>My Profile</h3>
                            <?php echo form_open('profile'); ?>
                            <?php foreach($profilequery->result() as $prow): ?>
                                <div class="form-group">
                                    <label for="">First Name</label>
                                    <?php echo form_error('user_first', "<div class='alert alert-danger alert-error'>
                                <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                                    <input type="text" name='user_first' value="<?php echo ucwords($prow->user_first); ?>" placeholder="First Name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Last Name</label>
                                    <?php echo form_error('user_last', "<div class='alert alert-danger alert-error'>
                                <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                                    <input type="text" name='user_last' value="<?php echo ucwords($prow->user_last); ?>" placeholder="Last Name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">E-mail</label>
                                    <input type="email" name='user_mail' value="<?php echo $prow->user_mail; ?>" value="email@domain.com" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Phone Number</label>
                                    <?php echo form_error('user_phone', "<div class='alert alert-danger alert-error'>
                                <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                                    <input type="text" name='user_phone' value="<?php echo $prow->user_phone; ?>" placeholder="07010000000" class="form-control" required>
                                </div>
                                <input type="submit" value="Save Changes" name='profilesubmit' class="btn btn-primary">
                            <?php  endforeach;?>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div class="gap"></div>