                    <div class="row">
                    	<div class="col-md-9" id='the-general'>
                            <h3>
                            	<h3>
									Manage Slides
									<span class="pull-right">
										<button class="btn btn-primary" id='the-add'>Add Slide</button>							
									</span>
								</h3>
							</h3>
                            <?php if($slidequery->num_rows() === 0): ?>
                    		<p>You currently have no slides.</p>
                    		<?php endif; ?>
                    		<?php if($slidequery->num_rows() !== 0): ?>
                            <table class="table table-order">
                                <thead>
                                    <tr>
										<th>Slide</th>
										<th>Slide Number</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
                                </thead>
                                <tbody>
                                <?php foreach($slidequery->result() as $sliderow): ?>
                                <tr>
                                	<td width='200px'><img src="<?=base_url();?>assets/img/backgrounds/<?=$sliderow->picture;?>" height="100px" alt="slide"></td>
                                    <td><?=$sliderow->slide_number;?></td>
                                    <td><a href="<?=base_url();?>profile_admin/slide_edit/<?=$sliderow->slide_code;?>" class="btn btn-info fa fa-edit" title='Edit'></a></td>
                                    <td>
                            		    <a href="<?=base_url();?>profile_admin/slide_delete/<?=$sliderow->slide_code;?>" class="btn btn-danger fa fa-trash-o" title='Delete'></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-8" id='the-new'>
                            <h3>New Slide</h3>
                            <?php echo form_open_multipart('profile_admin/slide_insert'); ?>
	                            <div class='alert alert-error'>
	                                <button type='button' class='close' data-dismiss='alert'>×</button>
	                                For Slide Upload: Maximum size is 2megabytes (mb), Width: 900px, Height: 500px
	                            </div>
                                <div class="form-group">
                                	<label for="">Slide Picture*</label>	
			                        <input type="file" name="slidefile" accept="image/x-png, image/jpg, image/png, image/jpeg" class="form-control" required />
			                    </div>
                                <div class="form-group">
                                	<label for="">Slide Number*</label>	
                            		<input type="number" name="slidenum" placeholder='slide number' class="form-control" required />
                                </div>
                                <div class="form-group">
                                    <label for="">Caption 1 (Medium text)</label>	
                            		<input type="text" name="caption1" placeholder='Caption 1' class="form-control" />
								</div>
                                <div class="form-group">
                                    <label for="">Caption 2 (Small text)</label>	
                            		<input type="text" name="caption2" placeholder='Caption 2' class="form-control" />
								</div>
								<div class="form-group">
                                    <label for="">Caption 3 (Large text)</label>	
                            		<input type="text" name="caption3" placeholder='Caption 3' class="form-control" />
								</div>
                                <input type="submit" value="Add Slide" class="btn btn-primary">
                                <button class="btn btn-danger" id='the-cancel'>Cancel</button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div class="gap"></div>

