		            <div class="row">
                    	<div class="col-md-9" id='the-general'>
                            <h3>Manage Welcome Message</h3>
                            <?php if($welcomequery->num_rows() === 0): ?>
                    		<p>You currently have no welcome message.</p>
                    		<?php endif; ?>
                    		<?php if($welcomequery->num_rows() !== 0): ?>
                            <table class="table table-order">
                                <thead>
                                    <tr>
										<th>Name</th>
										<th>Edit</th>
									</tr>
                                </thead>
                                <tbody>
                                    <?php foreach($welcomequery->result() as $welcomerow): ?>
                                    <tr>
                                    	<td><?=$welcomerow->name;?></td>
                                        <td>
                                		    <a href="<?=base_url();?>profile_admin/welcome_edit/<?=$welcomerow->id;?>" class="btn btn-info fa fa-edit" title='Edit'></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="gap"></div>
