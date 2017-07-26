<div class="row">
    <div class="col-md-6">
        <h3>My Profile</h3>
        <?php echo form_open('profile_admin'); ?>
        <?php foreach($regquery->result() as $prow): ?>
            <div class="form-group">
                <label for="">First Name</label>
                <?php echo form_error('user_first', "<div class='alert alert-danger alert-error'>
            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                <input type="text" name='user_first' value="<?php echo ucwords($prow->admin_firstname); ?>" placeholder="First Name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Last Name</label>
                <?php echo form_error('user_last', "<div class='alert alert-danger alert-error'>
            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                <input type="text" name='user_last' value="<?php echo ucwords($prow->admin_surname); ?>" placeholder="Last Name" class="form-control" required>
            </div>
            <input type="submit" value="Save Changes" name='profilesubmit' class="btn btn-primary">
        <?php  endforeach;?>
        <?php echo form_close(); ?>
    </div>
</div>
<div class="gap"></div>