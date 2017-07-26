		            <div class="row">
                    	<div class="col-md-9" id='the-general'>
                            <h3>Manage Contact Info</h3>
                            <?php if($contactquery->num_rows() === 0): ?>
                    		<p>You currently have no contact info.</p>
                    		<?php endif; ?>
                    		<?php if($contactquery->num_rows() !== 0): ?>
                            <table class="table table-order">
                                <thead>
                                    <tr>
										<th>Name</th>
										<th>Edit</th>
									</tr>
                                </thead>
                                <tbody>
                                    <?php foreach($contactquery->result() as $contactrow): ?>
                                    <tr>
                                    	<td><?=$contactrow->name;?></td>
                                        <td>
                                		    <a href="<?=base_url();?>profile_admin/contact_edit/<?=$contactrow->id;?>" class="btn btn-info fa fa-edit" title='Edit'></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="gap"></div>

