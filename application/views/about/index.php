        <!-- //////////////////////////////////
	//////////////PAGE CONTENT///////////// 
	////////////////////////////////////-->



        <div class="container">
            <div class="row row-wrap">
                <div class="col-md-12">
                    <?php foreach($about->result() as $aboutrow): ?>
                    <h3><strong><?php echo $aboutrow->description; ?></strong></h3>
                    <?php endforeach; ?>
                    <?php foreach($about1->result() as $about1row): ?>
                    <p><?php echo $about1row->description; ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="gap gap-small"></div>
            <div class="row row-wrap">
                <div class="col-md-4">
                     <?php foreach($about3->result() as $about3row): ?>
                    <h3><strong><?php echo $about3row->name; ?></strong></h3>
                    <p><?php echo $about3row->description; ?></p>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-4">
                     <?php foreach($about2->result() as $about2row): ?>
                    <h3><strong><?php echo $about2row->name; ?></strong></h3>
                    <p><?php echo $about2row->description; ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="gap gap-small"></div>
        </div>


        <!-- //////////////////////////////////
	//////////////END PAGE CONTENT///////// 
	////////////////////////////////////-->