		            <div class="row">
                    	<div class="col-md-9" id='the-general'>
                            <h3>Manage Product type
                            	<span class="pull-right">
									<button class="btn btn-primary" id='the-add'>Add Type</button>							
								</span>
                            </h3>
                            <?php if($prodtypequery->num_rows() === 0): ?>
                    		<p>You currently have no product type.</p>
                    		<?php endif; ?>
                    		<?php $serial = 1; ?>
                    		<?php if($prodtypequery->num_rows() !== 0): ?>
                            <table class="table table-order">
                                <thead>
                                    <tr>
                                    	<th>#</th>
										<th>Type</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
                                </thead>
                                <tbody>
                                    <?php foreach($prodtypequery->result() as $prodtyperow): ?>
                                    <tr>
                                    	<td><?=$serial;?></td>
                                    	<td><?=$prodtyperow->mname;?></td>
                                        <td>
                                		    <a href="<?=base_url();?>profile_admin/manage_product_type_edit/<?=$prodtyperow->mid;?>" class="btn btn-info fa fa-edit" title='Edit'></a>
                                        </td>
                                        <td>
                                		    <a href="<?=base_url();?>profile_admin/manage_product_type_delete/<?=$prodtyperow->mid;?>" class="btn btn-danger fa fa-trash-o" title='Delete'></a>
                                        </td>
                                    </tr>
                                    <?php $serial +=1; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-8" id='the-new'>
                            <h3>New Product Type</h3>
                            <?php echo form_open_multipart('profile_admin/manage_product_type_insert'); ?>
                                <div class="form-group">
                                    <label for="">Type</label>	
                            		<input type="text" name="thename" placeholder='Type name' class="form-control" />
								</div>
                                <input type="submit" value="Add Type" class="btn btn-primary">
                                <button type="button" class="btn btn-danger" id='the-cancel'>Cancel</button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div class="gap"></div>

