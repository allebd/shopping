<div class="row">
    <div class="col-md-6">
        <h3>Edit Product type</h3>

		<?php foreach($prodtypeeditquery->result() as $prodtyperow): ?>		
	    <?php echo form_open('profile_admin/manage_product_type_editing/'); ?>
			<div class="form-group">
                <label for="">Name</label>	
                <input type="hidden" name="theid"  value="<?=$prodtyperow->mid;?>"  class="form-control" />
        		<input type="text" name="thename"  value="<?=$prodtyperow->mname;?>" placeholder='Type' class="form-control" />
			</div>
            <input type="submit" value="Save Changes" class="btn btn-primary">
            <a href="<?=base_url();?>profile_admin/manage_product_type" class="btn btn-danger" >Cancel</a>

        <?php echo form_close(); ?>
        <?php  endforeach;?>
    </div>
</div>
<div class="gap"></div>