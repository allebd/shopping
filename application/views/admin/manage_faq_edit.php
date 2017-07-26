<div class="row">
    <div class="col-md-12">
        <h3>Edit FAQ</h3>

	    <?php echo form_open('profile_admin/faq_editing/'); ?>
		<?php foreach($faqeditquery->result() as $faqrow): ?>
			<div class="form-group">
                <label for="">Question</label>	
        		<input type="text" name="question"  value="<?=$faqrow->question;?>" placeholder='Question' class="form-control" />
			</div>
            <div class="form-group">
                <label for="">Answer</label>	
                <input type='hidden' name='theid' value='<?=$faqrow->id;?>' />
        		<textarea name='answer' id='answer' row='10' placeholder='Answer' class="form-control" required><?=$faqrow->answer;?></textarea>
				<script>
				    CKEDITOR.replace('answer');
				</script>
			</div>
            <input type="submit" value="Save Changes" class="btn btn-primary">
            <a href="<?=base_url();?>profile_admin/manage_faq" class="btn btn-danger" >Cancel</a>
        <?php  endforeach;?>
        <?php echo form_close(); ?>
    </div>
</div>
<div class="gap"></div>