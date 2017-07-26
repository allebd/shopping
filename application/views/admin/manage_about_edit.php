<div class="row">
    <div class="col-md-12">
        <h3>Edit About</h3>

		<?php echo form_open('profile_admin/about_editing/'); ?>
        <?php foreach($abouteditquery->result() as $aboutrow): ?>
            <div class="form-group">
            	<label for=""><?=ucwords($aboutrow->name);?></label>
				<?php echo form_error('description', "<div class='alert alert-danger alert-error'>
            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>	
				<input type="hidden" name='id'  value="<?=$aboutrow->id;?>" required>
				<textarea name='description' id='description'  value="<?=$aboutrow->description;?>" row='10' class="form-control" required><?=$aboutrow->description;?></textarea>
				<script>
				    CKEDITOR.replace('description');
				</script>
            </div>
            <input type="submit" value="Save Changes" class="btn btn-primary">
            <a href="<?=base_url();?>profile_admin/manage_about" class="btn btn-danger" >Cancel</a>
        <?php  endforeach;?>
        <?php echo form_close(); ?>
    </div>
</div>
<div class="gap"></div>