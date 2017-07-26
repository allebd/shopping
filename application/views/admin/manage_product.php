		            <script>
                            $(document).ready(function(){
                                var base_url = "<?=base_url();?>";
                                $('#thetype').on('change', function(){
                                    $.ajax({
                                        type:"POST",
                                        url: base_url+"profile_admin/getsubmenu",
                                        data:{action:$("#thetype").val()},
                                        success:function(data){
                                        $("#thesubtype").html(data);
                                        }
                                    });
                                });                             
                            });
                    </script>
                    
		            <div class="row">
                    	<div class="col-md-12" id='the-general'>
                            <h3>Manage Products                                
                            	<span class="pull-right">
									<button class="btn btn-primary" id='the-add'>Add Product</button>							
								</span>
                            </h3>
                            <span class="pull-left mb10">
                                <input type="search" name="searchbox" placeholder="Search..." class="form-control"> 
                                <button type="submit" name="searching" class="btn btn-primary"><i class="fa fa-search"></i></button>                           
                            </span>
                            <?php if($prodquery->num_rows() === 0): ?>
                    		<p>You currently have no products.</p>
                    		<?php endif; ?>
                    		<?php $serial = 1; ?>
                    		<?php if($prodquery->num_rows() !== 0): ?>
                            <table class="table table-order">
                                <thead>
                                    <tr>
                                    	<th>#</th>
										<th>Type<br><strong>(Sub-Type)</strong></th>
										<th><strong>(Product ID)</strong><br>Product</th>					
										<!-- <th>Measure</th>
										<th>Price (₦)</th>
										<th>Old Price (₦)</th> -->
										<th><strong>(Summary)</strong><br>Description</th>
										<th>Date Uploaded</th>
										<th>Reviews</th>
										<th>Views</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
                                </thead>
                                <tbody>
                                    <?php foreach($prodquery->result() as $prodrow): ?>
                                    <tr>
                                    	<td><?=$serial;?></td>
                                    	<td><?=ucwords(strtolower($prodrow->mname));?><br><strong>(<?=ucwords(strtolower($prodrow->smname));?>)</strong></td>
                                    	<td width='200px'><strong>(<?=$prodrow->product_code;?>)</strong><br><?=ucwords(strtolower($prodrow->product_name));?><br><img height='100px' src="<?=base_url();?>assets/products/<?=$prodrow->product_image;?>" alt="<?=ucwords(strtolower($prodrow->product_name));?>" title="<?=ucwords(strtolower($prodrow->product_name));?>" /></td>
                                    	<!-- <td><?=$prodrow->product_quantity;?></td>
                                    	<td>₦<?=$prodrow->product_price;?></td>
                                    	<?php $oldprice = $prodrow->product_oldprice;
                                            if($oldprice !== ''): ?>
                                        <td>₦<?=$prodrow->product_oldprice;?></td>
                                        <?php endif; ?>
										<?php if($oldprice == ''): ?>
										<td></td>
										<?php endif; ?> -->
										<td><strong>(<?=$prodrow->product_summ;?>)</strong><br><?=$prodrow->product_desc;?></td>
										<td><?=date_format(date_create($prodrow->thedate), 'F j, Y');?></td>
										<td><a href='<?=base_url();?>profile_admin/reviews/<?=$prodrow->product_code;?>' class="btn btn-primary" title='pending'>Reviews 
											<?php
												$this->db->select('*');     
			                                    $this->db->from('reviews');
			                                    $this->db->where('review_prod',$prodrow->product_code);
			                                    $reviewcount = $this->db->count_all_results();
			                                    echo '('.$reviewcount.')';
											?>
											</a></td>
										<td><?=$prodrow->counter;?></td>
                                        <td>
                                		    <a href="<?=base_url();?>profile_admin/product_edit/<?=$prodrow->product_code;?>" class="btn btn-info fa fa-edit" title='Edit'></a>
                                        </td>
                                        <td>
                                		    <a href="<?=base_url();?>profile_admin/product_delete/<?=$prodrow->product_code;?>" class="btn btn-danger fa fa-trash-o" title='Delete'></a>
                                        </td>
                                    </tr>
                                    <?php $serial +=1; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-8" id='the-new'>
                            <h3>New Product</h3>
                            <?php echo form_open_multipart('profile_admin/product_insert'); ?>
                            	<div class='alert alert-error'>
	                                <button type='button' class='close' data-dismiss='alert'>×</button>
	                                For Product Upload: Maximum size is 2megabytes (mb), Width: 500px, Height: 500px
	                            </div>
                            	<div class="form-group">
                                    <label for="">Type</label>	
                                    <?php echo form_error('thetype', "<div class='alert alert-danger alert-error'>
					            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>	
                                    <?php echo form_dropdown('thetype', $menu_options, set_value('thetype'), 'id="thetype" class="form-control" required="required"'); ?>
								</div>
                                <div class="form-group">
                                    <label for="">Sub-Type</label>
                                    <?php echo form_error('thesubtype', "<div class='alert alert-danger alert-error'>
					            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>	
                            		<div id='thesubtype'>
		                                <select class="form-control" >
		                                </select>
		                            </div>
								</div>
								<div class="form-group">
                                    <label for="">Product Name</label>
                                    <?php echo form_error('prodname', "<div class='alert alert-danger alert-error'>
					            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>	
                                	<input type="text" name="prodname" value="<?=set_value('prodname');?>" placeholder='Product name' class="form-control" />    
                                </div>
                                <div class="form-group">
                                    <label for="">Product Image</label>	
                                    <?php echo form_error('prodimage', "<div class='alert alert-danger alert-error'>
					            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                                	<input type="file" name="prodimage" accept="image/x-png, image/jpg, image/png, image/jpeg" required />	  
                                </div>
                                <div class="form-group">
                                    <small style="color:red">
                                        * Old Price not compulsory, Only fill to show price slash <br>
                                        * Click on "<i class="fa fa-plus"></i> Add" to add more quantity/measure and their prices
                                    </small>
                                    <div class='row mb10' id='quantadd1'>
                                        <div class='col-md-4'>
                                            <label for="">Quantity/Measure</label>	
                                        	<input type="text" name="prodquantity[]" value="<?=set_value('prodquantity');?>" placeholder='Product Quantity' class="form-control" />    
                                        </div>
                                        <div class='col-md-3'>
                                            <label for="">Price</label>
                                            <?php echo form_error('prodprice', "<div class='alert alert-danger alert-error'>
                                        <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                                            <div class="input-group">
                                                <span class="input-group-addon" id="sizing-addon1">₦</span>
                                                <input type="number" name='prodprice[]'  value="<?=set_value('prodprice');?>" placeholder="00000" class="form-control" required="required" >
                                            </div>  
                                        </div>
                                        <div class='col-md-3'>
                                            <label for="">Old Price</label>
                                            <?php echo form_error('prodoldprice', "<div class='alert alert-danger alert-error'>
                                        <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                                            <div class="input-group">
                                                <span class="input-group-addon" id="sizing-addon1">₦</span>
                                                <input type="number" name='prodoldprice[]'  value="<?=set_value('prodoldprice');?>" placeholder="00000" class="form-control" >
                                            </div>      
                                        </div> 
                                        <div class='col-md-2'> 
                                            <label for="">&nbsp;</label>                                           
                                            <button type='button' class='btn btn-primary' id='btnadd1'><i class="fa fa-plus"></i>  <span>Add</span></button>
                                        </div>                                 
                                    </div>    
                                    <div class='row mb10' id='quantadd2'>
                                        <div class='col-md-4'>
                                            <label for="">Quantity/Measure</label>  
                                            <input type="text" name="prodquantity[]" value="<?=set_value('prodquantity');?>" placeholder='Product Quantity' class="form-control" />    
                                        </div>
                                        <div class='col-md-3'>
                                            <label for="">Price</label>
                                            <?php echo form_error('prodprice', "<div class='alert alert-danger alert-error'>
                                        <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                                            <div class="input-group">
                                                <span class="input-group-addon" id="sizing-addon1">₦</span>
                                                <input type="number" name='prodprice[]'  value="<?=set_value('prodprice');?>" placeholder="00000" class="form-control" >
                                            </div>  
                                        </div>
                                        <div class='col-md-3'>
                                            <label for="">Old Price</label>
                                            <?php echo form_error('prodoldprice', "<div class='alert alert-danger alert-error'>
                                        <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                                            <div class="input-group">
                                                <span class="input-group-addon" id="sizing-addon1">₦</span>
                                                <input type="number" name='prodoldprice[]'  value="<?=set_value('prodoldprice');?>" placeholder="00000" class="form-control" >
                                            </div>      
                                        </div> 
                                        <div class='col-md-2'> 
                                            <label for="">&nbsp;</label>                                           
                                            <button type='button' class='btn btn-primary' id='btnadd2'><i class="fa fa-plus"></i>  <span>Add</span></button>
                                        </div>                                 
                                    </div> 
                                    <div class='row mb10' id='quantadd3'>
                                        <div class='col-md-4'>
                                            <label for="">Quantity/Measure</label>  
                                            <input type="text" name="prodquantity[]" value="<?=set_value('prodquantity');?>" placeholder='Product Quantity' class="form-control" />    
                                        </div>
                                        <div class='col-md-3'>
                                            <label for="">Price</label>
                                            <?php echo form_error('prodprice', "<div class='alert alert-danger alert-error'>
                                        <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                                            <div class="input-group">
                                                <span class="input-group-addon" id="sizing-addon1">₦</span>
                                                <input type="number" name='prodprice[]'  value="<?=set_value('prodprice');?>" placeholder="00000" class="form-control" >
                                            </div>  
                                        </div>
                                        <div class='col-md-3'>
                                            <label for="">Old Price</label>
                                            <?php echo form_error('prodoldprice', "<div class='alert alert-danger alert-error'>
                                        <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                                            <div class="input-group">
                                                <span class="input-group-addon" id="sizing-addon1">₦</span>
                                                <input type="number" name='prodoldprice[]'  value="<?=set_value('prodoldprice');?>" placeholder="00000" class="form-control" >
                                            </div>      
                                        </div> 
                                        <div class='col-md-2'> 
                                            <label for="">&nbsp;</label>                                           
                                            <button type='button' class='btn btn-primary' id='btnadd3'><i class="fa fa-plus"></i>  <span>Add</span></button>
                                        </div>                                 
                                    </div> 
                                    <div class='row mb10' id='quantadd4'>
                                        <div class='col-md-4'>
                                            <label for="">Quantity/Measure</label>  
                                            <input type="text" name="prodquantity[]" value="<?=set_value('prodquantity');?>" placeholder='Product Quantity' class="form-control" />    
                                        </div>
                                        <div class='col-md-3'>
                                            <label for="">Price</label>
                                            <?php echo form_error('prodprice', "<div class='alert alert-danger alert-error'>
                                        <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                                            <div class="input-group">
                                                <span class="input-group-addon" id="sizing-addon1">₦</span>
                                                <input type="number" name='prodprice[]'  value="<?=set_value('prodprice');?>" placeholder="00000" class="form-control" >
                                            </div>  
                                        </div>
                                        <div class='col-md-3'>
                                            <label for="">Old Price</label>
                                            <?php echo form_error('prodoldprice', "<div class='alert alert-danger alert-error'>
                                        <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                                            <div class="input-group">
                                                <span class="input-group-addon" id="sizing-addon1">₦</span>
                                                <input type="number" name='prodoldprice[]'  value="<?=set_value('prodoldprice');?>" placeholder="00000" class="form-control" >
                                            </div>      
                                        </div> 
                                        <div class='col-md-2'> 
                                            <label for="">&nbsp;</label>                                           
                                            <button type='button' class='btn btn-primary' id='btnadd4'><i class="fa fa-plus"></i>  <span>Add</span></button>
                                        </div>                                 
                                    </div> 
                                    <div class='row mb10' id='quantadd5'>
                                        <div class='col-md-4'>
                                            <label for="">Quantity/Measure</label>  
                                            <input type="text" name="prodquantity[]" value="<?=set_value('prodquantity');?>" placeholder='Product Quantity' class="form-control" />    
                                        </div>
                                        <div class='col-md-3'>
                                            <label for="">Price</label>
                                            <?php echo form_error('prodprice', "<div class='alert alert-danger alert-error'>
                                        <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                                            <div class="input-group">
                                                <span class="input-group-addon" id="sizing-addon1">₦</span>
                                                <input type="number" name='prodprice[]'  value="<?=set_value('prodprice');?>" placeholder="00000" class="form-control" >
                                            </div>  
                                        </div>
                                        <div class='col-md-3'>
                                            <label for="">Old Price</label>
                                            <?php echo form_error('prodoldprice', "<div class='alert alert-danger alert-error'>
                                        <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                                            <div class="input-group">
                                                <span class="input-group-addon" id="sizing-addon1">₦</span>
                                                <input type="number" name='prodoldprice[]'  value="<?=set_value('prodoldprice');?>" placeholder="00000" class="form-control" >
                                            </div>      
                                        </div>                            
                                    </div>                               
                                </div>
                                <!-- <div class="form-group">
                                    <label for="">Product Price</label>
                                    <?php echo form_error('prodprice', "<div class='alert alert-danger alert-error'>
					            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                                    <div class="input-group">
										<span class="input-group-addon" id="sizing-addon1">₦</span>
                                		<input type="number" name='prodprice'  value="<?=set_value('prodprice');?>" placeholder="00000" class="form-control" required="required" >
									</div>	  
                                </div>
                                <div class="form-group">
                                    <label for="">Product Old Price (Not compulsory, Only fill to show price slash)</label>
                                    <?php echo form_error('prodoldprice', "<div class='alert alert-danger alert-error'>
					            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                                    <div class="input-group">
										<span class="input-group-addon" id="sizing-addon1">₦</span>
                                		<input type="number" name='prodoldprice'  value="<?=set_value('prodoldprice');?>" placeholder="00000" class="form-control" >
									</div>	  
                                </div> -->
                                <div class="form-group">
					            	<label for="">Product Summary</label>
									<?php echo form_error('prodsumm', "<div class='alert alert-danger alert-error'>
					            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
									<textarea name='prodsumm' id='prodsumm'  value="<?=set_value('prodsumm');?>" row='10' class="form-control" required></textarea>
								</div>
					            <div class="form-group">
					            	<label for="">Product Description</label>
									<?php echo form_error('proddesc', "<div class='alert alert-danger alert-error'>
					            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
									<textarea name='proddesc' id='proddesc'  value="<?=set_value('proddesc');?>" row='10' class="form-control" required></textarea>
									<script>
									    CKEDITOR.replace('proddesc');
									</script>
					            </div>
                                <input type="submit" value="Add Product" class="btn btn-primary">
                                <button type="button" class="btn btn-danger" id='the-cancel'>Cancel</button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div class="gap"></div>

