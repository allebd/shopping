		            <div class="row">
                    	<div class="col-md-9" id='the-general'>
                            <h3>Manage Return Policy</h3>
                            <?php if($changesquery->num_rows() === 0): ?>
                    		<p>You currently have no Return Policy.</p>
                    		<?php endif; ?>
                    		<?php if($changesquery->num_rows() !== 0): ?>
                            <table class="table table-order">
                                <thead>
                                    <tr>
										<th>Name</th>
										<th>Edit</th>
									</tr>
                                </thead>
                                <tbody>
                                    <?php foreach($changesquery->result() as $changerow): ?>
                                    <tr>
                                    	<td><?=$changerow->name;?></td>
                                        <td>
                                		    <a href="<?=base_url();?>profile_admin/changes_edit/<?=$changerow->id;?>" class="btn btn-info fa fa-edit" title='Edit'></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="gap"></div>

