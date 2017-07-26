<div class="row">
    <div class="col-md-12">
        <h3>Edit Return Policy</h3>
		
			<?php echo form_open('profile_admin/changes_editing/'); ?>
			<?php foreach($changeseditquery->result() as $changerow): ?>
			<div class="form-group">
				<label for="">Name</label>
				<?php echo form_error('name', "<div class='alert alert-danger alert-error'>
            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>	
				<input type="text" name='name'  value="<?=$changerow->name;?>" placeholder="Name" class="form-control" readonly>
			</div>
			<div class="form-group">
				<?php echo form_error('description', "<div class='alert alert-danger alert-error'>
            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>	
				<input type="hidden" name='theid'  value="<?=$changerow->id;?>" required>
				<textarea name='description' id='description'  value="<?=$changerow->description;?>" row='10' class="form-control" required><?=$changerow->description;?></textarea>
				<script>
				    CKEDITOR.replace('description');
				</script>
            </div>
            <input type="submit" value="Save Changes" class="btn btn-primary">
            <a href="<?=base_url();?>profile_admin/manage_changes" class="btn btn-danger" >Cancel</a>
        <?php  endforeach;?>
        <?php echo form_close(); ?>
    </div>
</div>
<div class="gap"></div>