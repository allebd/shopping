<div class="row">
    <div class="col-md-12">
        <h3>Edit Privacy Policy</h3>

		<?php echo form_open('profile_admin/privacy_editing/'); ?>
		<?php foreach($privacyeditquery->result() as $privacyrow): ?>
			<div class="form-group">
				<label for="">Name</label>
				<?php echo form_error('name', "<div class='alert alert-danger alert-error'>
            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>	
				<input type="text" name='name'  value="<?=$privacyrow->name;?>" placeholder="Name" class="form-control" readonly>
			</div>
			<div class="form-group">
				<?php echo form_error('description', "<div class='alert alert-danger alert-error'>
            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>	
				<input type="hidden" name='theid'  value="<?=$privacyrow->id;?>" required>
				<textarea name='description' id='description'  value="<?=$privacyrow->description;?>" row='10' class="form-control" required><?=$privacyrow->description;?></textarea>
				<script>
				    CKEDITOR.replace('description');
				</script>
            </div>
            <input type="submit" value="Save Changes" class="btn btn-primary">
            <a href="<?=base_url();?>profile_admin/manage_privacy" class="btn btn-danger" >Cancel</a>
        <?php  endforeach;?>
        <?php echo form_close(); ?>
    </div>
</div>
<div class="gap"></div>