        <!-- //////////////////////////////////
	//////////////PAGE CONTENT///////////// 
	////////////////////////////////////-->



        <div class="container">
            <div class="row row-wrap">
                <div class="col-md-12">
                    <?php foreach($returnquery->result() as $returnrow): ?>
                    <h3><strong><?=$returnrow->name;?></strong></h3>
                    <p><?php echo $returnrow->description; ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="gap gap-small"></div>
        </div>


        <!-- //////////////////////////////////
	//////////////END PAGE CONTENT///////// 
	////////////////////////////////////-->