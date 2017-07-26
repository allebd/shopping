		            <div class="row">
                    	<div class="col-md-9" id='the-general'>
                            <h3>Manage FAQs
                            	<span class="pull-right">
									<button class="btn btn-primary" id='the-add'>Add FAQ</button>							
								</span>
                            </h3>
                            <?php if($faqquery->num_rows() === 0): ?>
                    		<p>You currently have no frequently asked question.</p>
                    		<?php endif; ?>
                    		<?php $serial = 1; ?>
                    		<?php if($faqquery->num_rows() !== 0): ?>
                            <table class="table table-order">
                                <thead>
                                    <tr>
                                    	<th>#</th>
										<th>Question</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
                                </thead>
                                <tbody>
                                    <?php foreach($faqquery->result() as $faqrow): ?>
                                    <tr>
                                    	<td><?=$serial;?></td>
                                    	<td><?=$faqrow->question;?></td>
                                        <td>
                                		    <a href="<?=base_url();?>profile_admin/faq_edit/<?=$faqrow->id;?>" class="btn btn-info fa fa-edit" title='Edit'></a>
                                        </td>
                                        <td>
                                		    <a href="<?=base_url();?>profile_admin/faq_delete/<?=$faqrow->id;?>" class="btn btn-danger fa fa-trash-o" title='Delete'></a>
                                        </td>
                                    </tr>
                                    <?php $serial +=1; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-8" id='the-new'>
                            <h3>New FAQ</h3>
                            <?php echo form_open_multipart('profile_admin/faq_insert'); ?>
                                <div class="form-group">
                                    <label for="">Question</label>	
                            		<input type="text" name="question" placeholder='Question' class="form-control" />
								</div>
                                <div class="form-group">
                                    <label for="">Answer</label>	
                            		<textarea name='answer' id='answer' row='10' placeholder='Answer' class="form-control" required></textarea>
									<script>
									    CKEDITOR.replace('answer');
									</script>
								</div>
                                <input type="submit" value="Add FAQ" class="btn btn-primary">
                                <button type="button" class="btn btn-danger" id='the-cancel'>Cancel</button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div class="gap"></div>

