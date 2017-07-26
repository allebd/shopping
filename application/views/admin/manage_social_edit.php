<div class="row">
    <div class="col-md-6">
        <h3>Edit Social Media Link</h3>

		<?php echo form_open('profile_admin/social_editing/'); ?>
        <?php foreach($soceditquery->result() as $socrow): ?>
            <div class="form-group">
            	<label for=""><?=ucwords($socrow->name);?> Link</label>
				<?php echo form_error('link', "<div class='alert alert-danger alert-error'>
	<button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>	
				<input type="hidden" name='id'  value="<?=$socrow->id;?>" required>
				<input type="text" name='link'  value="<?=$socrow->link;?>" placeholder="Link" class="form-control" required>
            </div>
            <input type="submit" value="Save Changes" class="btn btn-primary">
            <a href="<?=base_url();?>profile_admin/manage_social" class="btn btn-danger" >Cancel</a>
        <?php  endforeach;?>
        <?php echo form_close(); ?>
    </div>
</div>
<div class="gap"></div>
