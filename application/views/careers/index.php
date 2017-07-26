        <!-- //////////////////////////////////
	//////////////PAGE CONTENT///////////// 
	////////////////////////////////////-->



        <div class="container">
            <div class="row row-wrap">
                <div class="col-md-12">                    
                    <h3><strong>Careers</strong></h3>
                    <?php if($careerquery->num_rows() === 0): ?>
                    <p>We currently have no job openings.</p>
                    <?php endif; ?>
                    <?php if($careerquery->num_rows() !== 0): ?>
                    <table class="table table-order">
                        <thead>
                            <tr>
                                <th># </th>
                                <th>Position</th>
                                <th>Description</th>
                                <th>Closing Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $serial = 1; ?>
                            <?php foreach($careerquery->result() as $carrow): ?>
                            <tr>
                                <td><?=$serial;?></td>
                                <td><?=$carrow->position;?></td>
                                <td><?=$carrow->description;?></td>
                                <td><?=date_format(date_create($carrow->closing_date), 'F j, Y');?></td>
                            </tr>
                            <?php $serial += 1?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                </div>
            </div>
            <div class="gap gap-small"></div>
        </div>


        <!-- //////////////////////////////////
	//////////////END PAGE CONTENT///////// 
	////////////////////////////////////-->