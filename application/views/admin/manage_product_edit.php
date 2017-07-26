<div class="row">
    <div class="col-md-8">
        <h3>Edit Product</h3>

	    <?php echo form_open('profile_admin/product_editing/'); ?>
		<?php foreach($prodeditquery->result() as $prodrow): ?>
			<div class='alert alert-error'>
                <button type='button' class='close' data-dismiss='alert'>×</button>
                For Product Upload: Maximum size is 2megabytes (mb), Width: 500px, Height: 500px
            </div>
        	<div class="form-group">
                <label for="">Type</label>	
                <?php echo form_error('thetype', "<div class='alert alert-danger alert-error'>
            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>	
                <?php echo form_dropdown('thetype', $menu_options, set_value('thetype',$prodrow->menuid), 'id="thetype" class="form-control" required="required"'); ?>
			</div>
            <div class="form-group">
                <label for="">Sub-Type</label>
                <?php echo form_error('thesubtype', "<div class='alert alert-danger alert-error'>
            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>	
        		<div id='thesubtype'>
                <?php echo form_dropdown('thesubtype', $submenu_options, set_value('thesubtype',$prodrow->product_cat), ' class="form-control" required="required"'); ?>
                </div>
			</div>
			<div class="form-group">
                <label for="">Product Name</label>
                <?php echo form_error('prodname', "<div class='alert alert-danger alert-error'>
            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>	
            	<input type="text" name="prodname" value="<?=set_value('prodname',$prodrow->product_name);?>" placeholder='Product name' class="form-control" />    
            </div>
            <div class="form-group">
                <label for="">Product Image</label>	
                <img src="<?=base_url();?>assets/products/<?=$prodrow->product_image;?>" width="116" height="151" alt="<?=$prodrow->product_name;?>">
                <p class='mt20 ml20'>
					<a class="btn btn-primary" id='chng_pic'>Change</a>
				</p>
				<p id='showchng_pic' class='ml20'>
					<?php echo form_error('prodimage', "<div class='alert alert-danger alert-error'>
		            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
		            	<input type="file" name="prodimage" accept="image/x-png, image/jpg, image/png, image/jpeg"  />	  
				</p>                
            </div>
            <div class="form-group">
                <small style="color:red">
                    * Old Price not compulsory, Only fill to show price slash <br>
                    * Click on "<i class="fa fa-plus"></i> Add" to add more quantity/measure and their prices
                </small>
            <?php 
                $this->db->select('*');     
                $this->db->from('quantities');
                $this->db->where('quant_code', $prodrow->product_code);
                $quant_edit = $this->db->get();

                foreach($quant_edit->result() as $quantrow)
                {
            ?>
                <div class='row mb10' id='quantadd1'>
                    <div class='col-md-4'>
                        <label for="">Quantity/Measure</label>  
                        <input type="text" name="prodquantity[]" value="<?=set_value('prodquantity',$quantrow->quant_quantity);?>" placeholder='Product Quantity' class="form-control" />    
                    </div>
                    <div class='col-md-3'>
                        <label for="">Price</label>
                        <?php echo form_error('prodprice', "<div class='alert alert-danger alert-error'>
                    <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon1">₦</span>
                            <input type="number" name='prodprice[]'  value="<?=set_value('prodprice',$quantrow->quant_price);?>" placeholder="00000" class="form-control" >
                        </div>  
                    </div>
                    <div class='col-md-3'>
                        <label for="">Old Price</label>
                        <?php echo form_error('prodoldprice', "<div class='alert alert-danger alert-error'>
                    <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon1">₦</span>
                            <input type="number" name='prodoldprice[]'  value="<?=set_value('prodoldprice',$quantrow->quant_oldprice);?>" placeholder="00000" class="form-control" >
                        </div>      
                    </div>                               
                </div>
            <?php 
                }
            ?>
            </div>
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
            <div class="form-group">
            	<label for="">Product Summary</label>
				<?php echo form_error('prodsumm', "<div class='alert alert-danger alert-error'>
            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
				<textarea name='prodsumm' id='prodsumm'  value="<?=set_value('prodsumm',$prodrow->product_summ);?>" row='10' class="form-control" required><?=$prodrow->product_desc;?></textarea>
			</div>
            <div class="form-group">
            	<label for="">Product Description</label>
            	<input type="hidden" name="prodcode"  value="<?=$prodrow->product_code;?>"  class="form-control" />
				<?php echo form_error('proddesc', "<div class='alert alert-danger alert-error'>
            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
				<textarea name='proddesc' id='proddesc'  value="<?=set_value('proddesc',$prodrow->product_desc);?>" row='10' class="form-control" required><?=$prodrow->product_desc;?></textarea>
				<script>
				    CKEDITOR.replace('proddesc');
				</script>
            </div>
            <input type="submit" value="Save Changes" class="btn btn-primary">
            <a href="<?=base_url();?>profile_admin/manage_products" class="btn btn-danger" >Cancel</a>
        <?php  endforeach;?>
        <?php echo form_close(); ?>
    </div>
</div>
<div class="gap"></div>