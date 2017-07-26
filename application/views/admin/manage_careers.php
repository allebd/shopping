                    <div class="row">
                        <div class="col-md-9" id='the-general'>
                            <h3>
                                Manage Careers/Vacancy
                                <span class="pull-right">
                                    <a class="popup-text btn btn-primary" href="#new-style-dialog" data-effect="mfp-zoom-out" title='Add New Vacancy Details'>Add Opening</a>
                                </span>
                            </h3>
                            <?php if($careers_vacancy->num_rows() === 0): ?>
                            <p>You currently have no job openings.</p>
                            <?php endif; ?>
                            <?php if($careers_vacancy->num_rows() !== 0): ?>
                            <table class="table table-order">
                                <thead>
                                    <tr>
                                        <th># </th>
                                        <th>Position</th>
                                        <th>Description</th>
                                        <th>Closing Date</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $serial = 1; ?>
                                    <?php foreach($careers_vacancy->result() as $carrow): ?>
                                    <tr>
                                        <td><?=$serial;?></td>
                                        <td><?=$carrow->position;?></td>
                                        <td><?=$carrow->description;?></td>
                                        <td><?=date_format(date_create($carrow->closing_date), 'F j, Y');?></td>
                                        <td>
                                            <a href="<?=base_url();?>profile_admin/manage_careers_edit/<?=$carrow->id;?>" class="btn btn-info fa fa-edit" title='Edit'></a>
                                        </td>
                                        <td>
                                            <a href="<?=base_url();?>profile_admin/manage_careers_delete/<?=$carrow->id;?>" class="btn btn-danger fa fa-trash-o" title='Delete'></a>
                                        </td>
                                    </tr>
                                    <?php $serial += 1?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="gap"></div>

                    <div id="new-style-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
                        <i class="fa fa-upload dialog-icon"></i>
                        <h3>Add Vacancy Details</h3>
                        <form enctype="multipart/form-data" action="<?=base_url('profile_admin/manage_careers_upload');?>" method="post">
                            <div class="form-group">
                                <label>Vacancy Position</label>
                                <input type="text" class="form-control" name="vacancy_subject" required>
                            </div>
                            <div class="form-group">
                                <label>Vacancy Details </label>
                                <textarea class="form-control" name="vacancy_body" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Closing Date</label>
                                <input type="date" class="form-control" name="vacancy_date" required>
                            </div>
                            <input name="fileSubmit" type="submit" value="Add" class="btn btn-primary">
                        </form>
                    </div>