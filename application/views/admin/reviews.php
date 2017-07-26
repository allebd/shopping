		            <div class="row">
                    	<div class="col-md-9" id='the-general'>
                            <h3>
                            	Manage Reviews
                                <span class="pull-right">
                                    <a href='<?=base_url();?>profile_admin/manage_products' class="btn btn-primary">Back to Products</a>                            
                                </span>
							</h3>
                            <?php if($reviewquery->num_rows() === 0): ?>
                    		<p>You currently have no reviews.</p>
                    		<?php endif; ?>
                    		<?php if($reviewquery->num_rows() !== 0): ?>
                            <table class="table table-order">
                                <thead>
                                    <tr>
                                    	<th>#</th>
										<th>Product</th>
										<th>Name</th>
										<th>Email Address.</th>
										<th>Comment</th>
										<th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php $serial = 1; ?>
                                    <?php foreach($reviewquery->result() as $revrow): ?>
                                    <tr>
                                    	<td><?=$serial; ?></td>
                                    	<td width='200px'><strong>(<?=$revrow->product_code;?>)</strong><br><?=ucwords(strtolower($revrow->product_name));?><br><img height='100px' src="<?=base_url();?>assets/products/<?=$revrow->product_image;?>" alt="<?=ucwords(strtolower($revrow->product_name));?>" title="<?=ucwords(strtolower($revrow->product_name));?>" /></td>
                                        <td><?=ucwords($revrow->review_user);?></td>
                                        <td><?=$revrow->review_mail;?></td>
                                        <td><?=$revrow->review_text;?></td>
                                        <td>
                                		    <a class="btn btn-danger fa fa-trash-o" title='Delete' href="<?=base_url();?>profile_admin/reviews_delete/<?=$revrow->review_id;?>"></a>
                                        </td>
                                    </tr>
                                    <?php $serial += 1; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="gap"></div>