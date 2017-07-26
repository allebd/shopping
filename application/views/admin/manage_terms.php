		            <div class="row">
                    	<div class="col-md-9" id='the-general'>
                            <h3>Manage Terms &amp; Conditions</h3>
                            <?php if($termsquery->num_rows() === 0): ?>
                    		<p>You currently have no terms and conditions.</p>
                    		<?php endif; ?>
                    		<?php if($termsquery->num_rows() !== 0): ?>
                            <table class="table table-order">
                                <thead>
                                    <tr>
										<th>Name</th>
										<th>Edit</th>
									</tr>
                                </thead>
                                <tbody>
                                    <?php foreach($termsquery->result() as $termrow): ?>
                                    <tr>
                                    	<td><?=$termrow->name;?></td>
                                        <td>
                                		    <a href="<?=base_url();?>profile_admin/terms_edit/<?=$termrow->id;?>" class="btn btn-info fa fa-edit" title='Edit'></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="gap"></div>
