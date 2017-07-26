		            <div class="row">
                    	<div class="col-md-9" id='the-general'>
                            <h3>Manage Product Subtype
                            	<span class="pull-right">
									<button class="btn btn-primary" id='the-add'>Add SubType</button>							
								</span>
                            </h3>
                            <?php if($prodsubtypequery->num_rows() === 0): ?>
                    		<p>You currently have no product subtype.</p>
                    		<?php endif; ?>
                    		<?php $serial = 1; ?>
                    		<?php if($prodsubtypequery->num_rows() !== 0): ?>
                            <table class="table table-order">
                                <thead>
                                    <tr>
                                    	<th>#</th>
										<th>Type</th>
										<th>Sub-Type</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
                                </thead>
                                <tbody>
                                    <?php foreach($prodsubtypequery->result() as $prodtyperow): ?>
                                    <tr>
                                    	<td><?=$serial;?></td>
                                    	<td><?=$prodtyperow->mname;?></td>
                                    	<td><?=$prodtyperow->smname;?></td>
                                        <td>
                                		    <a href="<?=base_url();?>profile_admin/manage_product_subtype_edit/<?=$prodtyperow->smid;?>" class="btn btn-info fa fa-edit" title='Edit'></a>
                                        </td>
                                        <td>
                                		    <a href="<?=base_url();?>profile_admin/manage_product_subtype_delete/<?=$prodtyperow->smid;?>" class="btn btn-danger fa fa-trash-o" title='Delete'></a>
                                        </td>
                                    </tr>
                                    <?php $serial +=1; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-8" id='the-new'>
                            <h3>New Product SubType</h3>
                            <?php echo form_open_multipart('profile_admin/manage_product_subtype_insert'); ?>
                            	<div class="form-group">
                                    <label for="">Type</label>	
                                    <?php echo form_dropdown('thetype', $menu_options, set_value('thetype'), 'id="thetype" class="form-control" required="required"'); ?>
								</div>
                                <div class="form-group">
                                    <label for="">Sub-Type</label>	
                            		<input type="text" name="thename" placeholder='Sub-Type Name' class="form-control" />
								</div>
                                <input type="submit" value="Add Type" class="btn btn-primary">
                                <button type="button" class="btn btn-danger" id='the-cancel'>Cancel</button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div class="gap"></div>

