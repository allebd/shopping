<div class="row">
    <div class="col-md-6">
        <h3>Edit Product Sub-type</h3>

	    <?php echo form_open('profile_admin/manage_product_subtype_editing/'); ?>
		<?php foreach($prodsubtypeeditquery->result() as $prodtyperow): ?>
			<div class="form-group">
                <label for="">Type</label>	
                <?php echo form_dropdown('thetype', $menu_options, set_value('thetype',$prodtyperow->menuid), 'id="thetype" class="form-control" required="required"'); ?>
			</div>
            <div class="form-group">
                <label for="">Sub-Type</label>	
                <input type="hidden" name="theid"  value="<?=$prodtyperow->smid;?>"  class="form-control" />
        		<input type="text" name="thename" value="<?=$prodtyperow->smname;?>" placeholder='Sub-Type Name' class="form-control" />
			</div>
            <input type="submit" value="Save Changes" class="btn btn-primary">
            <a href="<?=base_url();?>profile_admin/manage_product_subtype" class="btn btn-danger" >Cancel</a>
        <?php  endforeach;?>
        <?php echo form_close(); ?>
    </div>
</div>
<div class="gap"></div>