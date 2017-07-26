		            <div class="row">
                    	<div class="col-md-9" id='the-general'>
                            <h3>Manage About</h3>
                            <table class="table table-order">
                                <thead>
                                    <tr>
										<th>Name</th>
										<th>Edit</th>
									</tr>
                                </thead>
                                <tbody>
                                    <?php foreach($aboutquery->result() as $aboutrow): ?>
                                    <tr>
                                    	<td><?=ucwords($aboutrow->name);?></td>
                                        <td>
                                		    <a href="<?=base_url();?>profile_admin/manage_about_edit/<?=$aboutrow->id;?>" class="btn btn-info fa fa-edit" title='Edit'></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="gap"></div>
