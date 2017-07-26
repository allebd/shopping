		            <div class="row">
                    	<div class="col-md-9" id='the-general'>
                            <h3>Manage Social Media Links</h3>
                            <table class="table table-order">
                                <thead>
                                    <tr>
										<th>Name</th>
										<th>Link</th>
										<th>Edit</th>
									</tr>
                                </thead>
                                <tbody>
                                    <?php foreach($socquery->result() as $socrow): ?>
                                    <tr>
                                    	<td><?=ucwords($socrow->name);?></td>
                                    	<td><?=$socrow->link;?></td>
                                        <td>
                                		    <a href="<?=base_url();?>profile_admin/manage_social_edit/<?=$socrow->id;?>" class="btn btn-info fa fa-edit" title='Edit'></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="gap"></div>

