		            <div class="row">
                    	<div class="col-md-9" id='the-general'>
                            <h3>Manage Privacy Policy</h3>
                            <?php if($privacyquery->num_rows() === 0): ?>
                    		<p>You currently have no privacy policy.</p>
                    		<?php endif; ?>
                    		<?php if($privacyquery->num_rows() !== 0): ?>
                            <table class="table table-order">
                                <thead>
                                    <tr>
										<th>Name</th>
										<th>Edit</th>
									</tr>
                                </thead>
                                <tbody>
                                    <?php foreach($privacyquery->result() as $privacyrow): ?>
                                    <tr>
                                    	<td><?=$privacyrow->name;?></td>
                                        <td>
                                		    <a href="<?=base_url();?>profile_admin/privacy_edit/<?=$privacyrow->id;?>" class="btn btn-info fa fa-edit" title='Edit'></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="gap"></div>
