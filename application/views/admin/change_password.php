<div class="row">
    <div class="col-md-6">
        <h3>Update Password</h3>
        <?php echo form_open('profile_admin/password_change'); ?>
            <div class="form-group">
                <label for="">Old Password</label>
                <?php echo form_error('old_pass', "<div class='alert alert-danger alert-error'>
            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                <input type="password" name='old_pass' placeholder="Old Password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">New Password</label>
                <?php echo form_error('new_pass', "<div class='alert alert-danger alert-error'>
            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                <input type="password" name='new_pass' placeholder="New Password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Confirm New Password</label>
                <?php echo form_error('confirm_pass', "<div class='alert alert-danger alert-error'>
            <button type='button' class='close' data-dismiss='alert'>×</button>", "</div>"); ?>
                <input type="password" name='confirm_pass' placeholder="Confirm New Password" class="form-control" required>
            </div>
            <input type="submit" value="Save Changes" class="btn btn-primary">
        
        <?php echo form_close(); ?>
    </div>
</div>
<div class="gap"></div>