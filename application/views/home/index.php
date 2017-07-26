        <!-- //////////////////////////////////
	//////////////PAGE CONTENT///////////// 
	////////////////////////////////////-->



        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <?php if($slidequery->num_rows() === 0): ?>
                    <!-- <p>You currently have no slides.</p> -->
                    <?php endif; ?>
                    <?php if($slidequery->num_rows() !== 0): ?>
                    <div class="owl-carousel owl-slider" id="owl-carousel-slider" data-inner-pagination="true" data-white-pagination="true" data-nav="false">
                        <?php foreach($slidequery->result() as $sliderow): ?>
                        <div>
                            <div class="bg-holder">
                                <img src="assets/img/backgrounds/<?=$sliderow->picture;?>" style='width:848px;height:471px' alt="Slides" title="Slides" />
                                <div class="bg-mask"></div>
                                <div class="bg-front vert-center text-white text-center">
                                    <h2 class="text-uc"><?=$sliderow->caption1;?></h2>
                                    <p class="text-bigger"><?=$sliderow->caption2;?></p>
                                    <p class="text-hero"><?=$sliderow->caption3;?></p><a class="btn btn-lg btn-ghost btn-white btn-lg" href="<?=base_url();?>category">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>                
                    </div>
                    <?php endif; ?>
                    <?php if($weekquery->num_rows() !== 0): ?>
                    <div class="gap gap-small"></div>
                    <h1 class="mb20">Weekly Featured <small><a href="<?=base_url();?>category">View All</a></small></h1>
                    <div class="row row-wrap">
                        <?php foreach($weekquery->result() as $weekrow): ?>
                        <div class="col-md-3 col-xs-6">
                            <div class="product-thumb">
                                <header class="product-header">
                                    <img src="<?=base_url();?>assets/products/<?=$weekrow->product_image;?>" style="height:162px" alt="<?=ucwords(strtolower($weekrow->product_name));?>" title="<?=ucwords(strtolower($weekrow->product_name));?>" />
                                </header>
                                <div class="product-inner">
                                    <h5 class="product-title"><?=ucwords(strtolower($weekrow->product_name));?></h5>
                                    <p class="product-desciption"><?=ucwords(strtolower($weekrow->mname));?></p>
                                    <div class="product-meta">
                                        <ul class="product-price-list">
                                            <?php 
                                                $this->db->select('*');     
                                                $this->db->from('quantities');
                                                $this->db->where('quant_code', $weekrow->product_code);
                                                $this->db->order_by("quant_price", "asc");
                                                $this->db->limit(1);
                                                $quant_wk = $this->db->get();

                                                foreach($quant_wk->result() as $quantwrow)
                                                {
                                            ?>
                                            <li><span class="product-price">₦<?=number_format($quantwrow->quant_price);?></span>
                                            </li>
                                            <?php $oldprice = $quantwrow->quant_oldprice;
                                                    if($oldprice !== ''): ?>
                                            <li><span class="product-old-price">₦<?=number_format($quantwrow->quant_oldprice);?></span>
                                            </li>
                                            <?php endif; ?>
                                            <?php 
                                                }
                                            ?>                                            
                                        </ul>
                                        <ul class="product-actions-list">
                                            <?php if(isset($is_logged_in) && $is_logged_in != true):?>
                                            <li><a class="btn btn-sm popup-text" href="#week-dialog"><i class="fa fa-shopping-cart"></i> To Cart</a>
                                                <div id="week-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
                                                    <i class="fa fa-exclamation dialog-icon"></i>
                                                    <p>
                                                        <br>
                                                        <div class='alert alert-error'>
                                                            <p>You have to be logged in to add to cart</p>
                                                        </div>
                                                    </p>
                                                </div>
                                            </li>
                                            <?php endif; ?>
                                            <?php if(isset($is_logged_in) && $is_logged_in == true):?>
                                            <li>
                                                <?=form_open("profile/cart_add/");?>
                                                <input type="hidden" name="measure" value="measure">
                                                <input type="hidden" name="product_code" value="<?=$weekrow->product_code;?>">
                                                <button type="submit" class="btn btn-sm"><i class="fa fa-shopping-cart"></i> To Cart</button>
                                                <?=form_close();?>
                                            </li>
                                            <?php endif; ?>
                                            <li><a class="btn btn-sm" href="<?=base_url();?>category/<?=str_replace(')', '___', str_replace('(', '__', str_replace(' ', '_', strtolower($weekrow->mname))));?>/<?=str_replace(')', '___', str_replace('(', '__', str_replace(' ', '_', strtolower($weekrow->smname))));?>/<?=strtolower($weekrow->product_code);?>"><i class="fa fa-bars"></i> Details</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <?php if($arrivequery->num_rows() !== 0): ?>
                    <div class="gap gap-small"></div>
                    <h1 class="mb20">New Arrivals <small><a href="<?=base_url();?>category">View All</a></small></h1>
                    <div class="row row-wrap">
                        <?php foreach($arrivequery->result() as $arriverow): ?>
                        <div class="col-md-3 col-xs-6">
                            <div class="product-thumb">
                                <header class="product-header">
                                    <img src="<?=base_url();?>assets/products/<?=$arriverow->product_image;?>" style="height:162px" alt="<?=ucwords(strtolower($arriverow->product_name));?>" title="<?=ucwords(strtolower($arriverow->product_name));?>" />
                                </header>
                                <div class="product-inner">
                                    <h5 class="product-title"><?=ucwords(strtolower($arriverow->product_name));?></h5>
                                    <p class="product-desciption"><?=ucwords(strtolower($arriverow->mname));?></p>
                                    <div class="product-meta">
                                        <ul class="product-price-list">
                                            <?php 
                                                $this->db->select('*');     
                                                $this->db->from('quantities');
                                                $this->db->where('quant_code', $arriverow->product_code);
                                                $this->db->order_by("quant_price", "asc");
                                                $this->db->limit(1);
                                                $quant_ar = $this->db->get();

                                                foreach($quant_ar->result() as $quantarow)
                                                {
                                            ?>
                                            <li><span class="product-price">₦<?=number_format($quantarow->quant_price);?></span>
                                            </li>
                                            <?php $oldprice = $quantarow->quant_oldprice;
                                                    if($oldprice !== ''): ?>
                                            <li><span class="product-old-price">₦<?=number_format($quantarow->quant_oldprice);?></span>
                                            </li>
                                            <?php endif; ?>
                                            <?php 
                                                }
                                            ?>   
                                        </ul>
                                        <ul class="product-actions-list">
                                            <?php if(isset($is_logged_in) && $is_logged_in != true):?>
                                            <li><a class="btn btn-sm popup-text" href="#arrive-dialog"><i class="fa fa-shopping-cart"></i> To Cart</a>
                                                <div id="arrive-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
                                                    <i class="fa fa-exclamation dialog-icon"></i>
                                                    <p>
                                                        <br>
                                                        <div class='alert alert-error'>
                                                            <p>You have to be logged in to add to cart</p>
                                                        </div>
                                                    </p>
                                                </div>
                                            </li>
                                            <?php endif; ?>
                                            <?php if(isset($is_logged_in) && $is_logged_in == true):?>
                                            <li>
                                                <?=form_open("profile/cart_add/");?>
                                                <input type="hidden" name="measure" value="measure">
                                                <input type="hidden" name="product_code" value="<?=$arriverow->product_code;?>">
                                                <button type="submit" class="btn btn-sm"><i class="fa fa-shopping-cart"></i> To Cart</button>
                                                <?=form_close();?>
                                            </li>
                                            <?php endif; ?>
                                            <li><a class="btn btn-sm" href="<?=base_url();?>category/<?=str_replace(')', '___', str_replace('(', '__', str_replace(' ', '_', strtolower($arriverow->mname))));?>/<?=str_replace(')', '___', str_replace('(', '__', str_replace(' ', '_', strtolower($arriverow->smname))));?>/<?=strtolower($arriverow->product_code);?>"><i class="fa fa-bars"></i> Details</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <div class="gap gap-small"></div>
                </div>
                <div class="col-md-3">
                    <aside class="sidebar-left">
                        <h3 class="mb20">I am looking for</h3>
                        <ul class="nav nav-tabs nav-stacked nav-coupon-category nav-coupon-category-left">
                            <?php foreach($menu1query->result() as $m1row):?>
                            <li><a href="<?=base_url();?>category/<?=strtolower(str_replace(' ', '_', $m1row->mname));?>"><?php if($m1row->icon == ''):?><i class="fa fa-circle"></i><?php endif; ?><?php if($m1row->icon != ''):?><i class="fa fa-<?=$m1row->icon;?>"></i><?php endif; ?><?=$m1row->mname;?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php if($latestquery->num_rows() !== 0): ?>
                        <div class="sidebar-box">
                            <h5>Latest</h5>
                            <ul class="thumb-list">
                                <?php foreach($latestquery->result() as $latrow): ?>
                                <li>
                                    <a href="<?=base_url();?>category/<?=str_replace(')', '___', str_replace('(', '__', str_replace(' ', '_', strtolower($latrow->mname))));?>/<?=str_replace(')', '___', str_replace('(', '__', str_replace(' ', '_', strtolower($latrow->smname))));?>/<?=strtolower($latrow->product_code);?>">
                                        <img src="<?=base_url();?>assets/products/<?=$latrow->product_image;?>" alt="<?=ucwords(strtolower($latrow->product_name));?>" title="<?=ucwords(strtolower($latrow->product_name));?>" />
                                    </a>
                                    <div class="thumb-list-item-caption">
                                        <h5 class="thumb-list-item-title"><a href="<?=base_url();?>category/<?=str_replace(')', '___', str_replace('(', '__', str_replace(' ', '_', strtolower($latrow->mname))));?>/<?=str_replace(')', '___', str_replace('(', '__', str_replace(' ', '_', strtolower($latrow->smname))));?>/<?=strtolower($latrow->product_code);?>"><?=ucwords(strtolower($latrow->product_name));?></a></h5>
                                        <?php 
                                            $this->db->select('*');     
                                            $this->db->from('quantities');
                                            $this->db->where('quant_code', $latrow->product_code);
                                            $this->db->order_by("quant_price", "asc");
                                            $this->db->limit(1);
                                            $quant_latest = $this->db->get();

                                            foreach($quant_latest->result() as $quantlrow)
                                            {
                                        ?>
                                        <p class="thumb-list-item-price">₦<?=number_format($quantlrow->quant_price);?></p>
                                        <?php 
                                            }
                                        ?>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                        <?php if($popularquery->num_rows() !== 0): ?>
                        <div class="sidebar-box">
                            <h5>Popular</h5>
                            <ul class="thumb-list">
                                <?php foreach($popularquery->result() as $poprow): ?>
                                <li>
                                    <a href="<?=base_url();?>category/<?=str_replace(')', '___', str_replace('(', '__', str_replace(' ', '_', strtolower($poprow->mname))));?>/<?=str_replace(')', '___', str_replace('(', '__', str_replace(' ', '_', strtolower($poprow->smname))));?>/<?=strtolower($poprow->product_code);?>">
                                        <img src="<?=base_url();?>assets/products/<?=$poprow->product_image;?>" alt="<?=ucwords(strtolower($poprow->product_name));?>" title="<?=ucwords(strtolower($poprow->product_name));?>" />
                                    </a>
                                    <div class="thumb-list-item-caption">
                                        <h5 class="thumb-list-item-title"><a href="<?=base_url();?>category/<?=str_replace(')', '___', str_replace('(', '__', str_replace(' ', '_', strtolower($poprow->mname))));?>/<?=str_replace(')', '___', str_replace('(', '__', str_replace(' ', '_', strtolower($poprow->smname))));?>/<?=strtolower($poprow->product_code);?>"><?=ucwords(strtolower($poprow->product_name));?></a></h5>
                                        <?php 
                                            $this->db->select('*');     
                                            $this->db->from('quantities');
                                            $this->db->where('quant_code', $poprow->product_code);
                                            $this->db->order_by("quant_price", "asc");
                                            $this->db->limit(1);
                                            $quant_pop = $this->db->get();

                                            foreach($quant_pop->result() as $quantprow)
                                            {
                                        ?>
                                        <p class="thumb-list-item-price">₦<?=number_format($quantprow->quant_price);?></p>
                                        <?php 
                                            }
                                        ?>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                    </aside>
                </div>
            </div>

        </div>


        <!-- //////////////////////////////////
	//////////////END PAGE CONTENT///////// 
	////////////////////////////////////-->



        