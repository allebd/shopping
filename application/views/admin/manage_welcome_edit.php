    <div class="col-md-12">
        <h3>Edit Welcome Message</h3>

		<?php echo form_open('profile_admin/welcome_editing/'); ?>
		<?php foreach($welcomeeditquery->result() as $welcomerow): ?>
			<div class="form-group">
				<label for="">Name</label>
				<?php echo form_error('name', "<div class='alert alert-danger alert-error'>
            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>	
				<input type="text" name='name'  value="<?=$welcomerow->name;?>" placeholder="Name" class="form-control" readonly>
			</div>
			<div class="form-group">
				<label for="">Subject</label>
				<?php echo form_error('subject', "<div class='alert alert-danger alert-error'>
            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>	
				<input type="text" name='subject'  value="<?=$welcomerow->subject;?>" placeholder="Name" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="">Message</label>
				<?php echo form_error('message', "<div class='alert alert-danger alert-error'>
            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
				<textarea name='message' id='message'  value="<?=$welcomerow->message;?>" row='10' class="form-control" required><?=$welcomerow->message;?></textarea>
				<script>
				    CKEDITOR.replace('message');
				</script>
            </div>
            <div class="form-group">
            	<label for="">Signature</label>
				<?php echo form_error('signature', "<div class='alert alert-danger alert-error'>
            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>	
				<input type="hidden" name='theid'  value="<?=$welcomerow->id;?>" required>
				<textarea name='signature' id='signature'  value="<?=$welcomerow->signature;?>" row='10' class="form-control" required><?=$welcomerow->signature;?></textarea>
				<script>
				    CKEDITOR.replace('signature');
				</script>
            </div>
            <input type="submit" value="Save Changes" class="btn btn-primary">
            <a href="<?=base_url();?>profile_admin/manage_welcome" class="btn btn-danger" >Cancel</a>
        <?php  endforeach;?>
        <?php echo form_close(); ?>
    </div>
</div>
<div class="gap"></div>