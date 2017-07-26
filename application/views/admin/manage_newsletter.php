		            <div class="row">
                    	<div class="col-md-9" id='the-general'>
                            <h3>
                            	Manage Newsletter
                            	<?php if($newsquery->num_rows() !== 0): ?>
								<span class="pull-right">
									<a href='<?=base_url();?>profile_admin/newsletter_export' class="btn btn-primary">Export to excel</a>							
								</span>
								<?php endif; ?>
							</h3>
                            <?php if($newsquery->num_rows() === 0): ?>
                    		<p>You currently have no Newsletter Subscribers.</p>
                    		<?php endif; ?>
                    		<?php if($newsquery->num_rows() !== 0): ?>
                            <table class="table table-order">
                                <thead>
                                    <tr>
                                    	<th>#</th>
										<th>Email Address</th>
										<th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php $serial = 1; ?>
                                    <?php foreach($newsquery->result() as $newsrow): ?>
                                    <tr>
                                    	<td><?=$serial; ?></td>
                                        <td><?=$newsrow->newletter_mail;?></td>
                                        <td>
                                		    <a class="btn btn-danger fa fa-trash-o" title='Delete' href="<?=base_url();?>profile_admin/newsletter_delete/<?=$newsrow->newletter_id;?>"></a>
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