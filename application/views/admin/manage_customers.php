		            <div class="row">
                    	<div class="col-md-9" id='the-general'>
                            <h3>
                            	Manage Customers
                            	<?php if($custquery->num_rows() !== 0): ?>
								<span class="pull-right">
									<a href='<?=base_url();?>profile_admin/customers_export' class="btn btn-primary">Export to excel</a>							
								</span>
								<?php endif; ?>
							</h3>
                            <?php if($custquery->num_rows() === 0): ?>
                    		<p>You currently have no customers.</p>
                    		<?php endif; ?>
                    		<?php if($custquery->num_rows() !== 0): ?>
                            <table class="table table-order">
                                <thead>
                                    <tr>
                                    	<th>#</th>
										<th>Customer ID</th>
										<th>Name</th>
										<th>Email Address.</th>
										<th>Phone No.</th>
										<th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php $serial = 1; ?>
                                    <?php foreach($custquery->result() as $custrow): ?>
                                    <tr>
                                    	<td><?=$serial; ?></td>
                                    	<td><?=$custrow->myid;?></td>
                                        <td><?=ucwords($custrow->user_last);?> <?=ucwords($custrow->user_first);?></td>
                                        <td><?=$custrow->user_mail;?></td>
                                        <td><?=$custrow->user_phone;?></td>
                                        <td>
                                		    <a class="btn btn-danger fa fa-trash-o" title='Delete' href="<?=base_url();?>profile_admin/customers_delete/<?=$custrow->id;?>"></a>
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