        <!-- //////////////////////////////////
	//////////////PAGE CONTENT///////////// 
	////////////////////////////////////-->



        <div class="container">
            <div class="row row-wrap">
                <div class="col-md-12">
                    <?php foreach($privacyquery->result() as $privacyrow): ?>
                    <h3><strong><?=$privacyrow->name;?></strong></h3>
                    <p><?php echo $privacyrow->description; ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="gap gap-small"></div>
        </div>


        <!-- //////////////////////////////////
	//////////////END PAGE CONTENT///////// 
	////////////////////////////////////-->