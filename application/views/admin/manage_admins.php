                    <div class="row">
                    	<div class="col-md-9" id='the-general'>
                            <h3>
                            	Manage Admins
								<span class="pull-right">
									<button class="btn btn-primary" id='the-add'>Add Admin</button>							
								</span>
							</h3>
                            <?php if($adminquery->num_rows() === 0): ?>
                    		<p>You currently have no admins.</p>
                    		<?php endif; ?>
                    		<?php if($adminquery->num_rows() !== 0): ?>
                            <table class="table table-order">
                                <thead>
                                    <tr>
                                    	<th>#</th>
                                    	<th>Name</th>
										<th>Username</th>
										<th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                    				<?php $serial = 1; ?>
                                    <?php foreach($adminquery->result() as $adminrow): ?>
                                    <tr>
                                    	<td><?=$serial; ?></td>
                                        <td><?=ucwords($adminrow->admin_surname);?> <?=ucwords($adminrow->admin_firstname);?></td>
                                        <td><?=$adminrow->admin_username;?></td>
                                        <td>
                                		    <a class="btn btn-danger fa fa-trash-o" title='Delete' href="<?=base_url();?>profile_admin/admin_delete/<?=$adminrow->admin_id;?>"></a>
                                        </td>
                                    </tr>
                                    <?php $serial += 1; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6" id='the-new'>
                            <h3>New Admin</h3>
                            <?php echo form_open('profile_admin/admins_insert'); ?>
                                <div class="form-group">
                                	<label for="">First Name</label>
									<?php echo form_error('user_first', "<div class='alert alert-danger alert-error'>
                                <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>	
                            		<input type="text" name='user_first' value="<?=set_value('user_first');?>" placeholder="First Name" class="form-control"  required>
                                </div>
                                <div class="form-group">
                                	<label for="">Last Name</label>
									<?php echo form_error('user_last', "<div class='alert alert-danger alert-error'>
                                <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>	
                            		<input type="text" name='user_last'  value="<?=set_value('user_last');?>" placeholder="Last Name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Username</label>
									<?php echo form_error('user_name', "<div class='alert alert-danger alert-error'>
                                <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>	
                            		<input type="text" name='user_name' value="<?=set_value('user_name');?>" placeholder="Username" class="form-control" required>
								</div>
                                <div class="form-group">
                                    <label for="">Password</label>
									<?php echo form_error('user_pass', "<div class='alert alert-danger alert-error'>
                                <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>	
                            		<input type="password" name='user_pass' placeholder="Password" class="form-control"  required>
								</div>
                                <input type="submit" value="Add Admin" name='profilesubmit' class="btn btn-primary">
                                <button class="btn btn-danger" id='the-cancel'>Cancel</button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div class="gap"></div>