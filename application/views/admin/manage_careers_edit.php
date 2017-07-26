<div class="row">
    <div class="col-md-12">
        <h3>Edit Vacancy/Careers</h3>

        <?php echo form_open_multipart('profile_admin/manage_careers_editing'); ?>
        <?php foreach($careers_vacancy_edit_query->result() as $career_row): ?>
            <div class="form-group">
                <label>Vacancy Position</label>
                 <input type="hidden" class="form-control" name="theid" value="<?= $career_row->id;?>" >
                <input type="text" class="form-control" name="vacancy_subject" value="<?= $career_row->position;?>" required>
            </div>
            <div class="form-group">
                <label>Vacancy Details </label>
                <textarea class="form-control" name="vacancy_body"  value="<?= $career_row->description?>" required><?= $career_row->description;?></textarea>
            </div>
            <div class="form-group">
                <label>Closing Date</label>
                <input type="date" class="form-control" name="vacancy_date" value="<?=$career_row->closing_date;?>" required>
            </div>
            <input type="submit" value="Save Changes" class="btn btn-primary">
            <a href="<?=base_url();?>profile_admin/manage_careers" class="btn btn-danger" >Cancel</a>
        <?php  endforeach;?>
        <?php echo form_close(); ?>
    </div>
</div>
<div class="gap"></div>