<div class="row">
    <div class="col-md-8">
        <h3>Edit Slide</h3>
        <?php echo form_open_multipart('profile_admin/slide_editing'); ?>
		<?php foreach($slideeditquery->result() as $sliderow): ?>
            <div class="form-group">
            	<label for="">Slide Picture*</label>	
                <img src="<?=base_url();?>assets/img/backgrounds/<?=$sliderow->picture;?>" width="151px" height="200px" alt="slide">
            </div>
            <div class="form-group">
            	<label for="">Slide Number*</label>	
        		<input type="hidden" name="slidecode" value='<?=$this->uri->segment(3);?>' required />
			    <input type="number" name="slidenum" placeholder='slide number' value='<?=$sliderow->slide_number;?>' class="form-control" required />
            </div>
            <div class="form-group">
                <label for="">Caption 1 (Medium text)</label>	
        		<input type="text" name="caption1" placeholder='Caption 1' value='<?=$sliderow->caption1;?>' class="form-control" />
			</div>
            <div class="form-group">
                <label for="">Caption 2 (Small text)</label>	
        		<input type="text" name="caption2" placeholder='Caption 2' value='<?=$sliderow->caption2;?>' class="form-control" />
			</div>
			<div class="form-group">
                <label for="">Caption 3 (Large text)</label>	
        		<input type="text" name="caption3" placeholder='Caption 3' value='<?=$sliderow->caption3;?>' class="form-control" />
			</div>
            <input type="submit" value="Save Changes" class="btn btn-primary">
            <a href="<?=base_url();?>profile_admin/manage_slide" class="btn btn-danger" >Cancel</a>
        <?php  endforeach;?>
        <?php echo form_close(); ?>
    </div>
</div>
<div class="gap"></div>
