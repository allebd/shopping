        <!-- //////////////////////////////////
	//////////////PAGE CONTENT///////////// 
	////////////////////////////////////-->



        <div class="container">
            <div class="row row-wrap">
                <div class="col-md-12">
                    <?php foreach($termsquery->result() as $termsrow): ?>
                    <h3><strong><?=$termsrow->name;?></strong></h3>
                    <p><?php echo $termsrow->description; ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="gap gap-small"></div>
        </div>


        <!-- //////////////////////////////////
	//////////////END PAGE CONTENT///////// 
	////////////////////////////////////-->