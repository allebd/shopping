        <!-- //////////////////////////////////
	//////////////PAGE CONTENT///////////// 
	////////////////////////////////////-->



        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <aside class="sidebar-left">
                        <ul class="nav nav-tabs nav-stacked nav-coupon-category">
                            <li <?php if(($this->uri->segment(2) == '') && ($this->uri->segment(1) == 'category')): ?>class="active"<?php endif;?> >
                                <a href="<?=base_url();?>category"><i class="fa fa-asterisk"></i>All 
                                    <span>
                                        <?php
                                            $this->db->select('*');     
                                            $this->db->from('products');
                                            $this->db->where_not_in('product_status','deleted');
                                            $this->db->join('submenu', 'submenu.thesmid = products.product_cat');
                                            $this->db->join('menu', 'menu.themid = submenu.menuid');
                                            $theprodallcount = $this->db->count_all_results();
                                            echo $theprodallcount;
                                        ?>
                                    </span>
                                </a>
                            </li>
                            <?php foreach($menu1query->result() as $m1row):?>
                            <li <?php if(strtolower(str_replace('_', '', $this->uri->segment(2))) == strtolower($m1row->mname)): ?>class="active"<?php endif;?> >
                                <a href="<?=base_url();?>category/<?=strtolower(str_replace(' ', '_', $m1row->mname));?>"><?php if($m1row->icon == ''):?><i class="fa fa-circle"></i><?php endif; ?><?php if($m1row->icon != ''):?><i class="fa fa-<?=$m1row->icon;?>"></i><?php endif; ?><?=$m1row->mname;?>
                                    <span>
                                        <?php
                                            $this->db->select('*');     
                                            $this->db->from('products');
                                            $this->db->where('mname',$m1row->mname);
                                            $this->db->where_not_in('product_status','deleted');
                                            $this->db->join('submenu', 'submenu.thesmid = products.product_cat');
                                            $this->db->join('menu', 'menu.themid = submenu.menuid');
                                            $theprodallcount = $this->db->count_all_results();
                                            echo $theprodallcount;
                                        ?>
                                    </span>
                                </a>
                            </li>
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
                <div class="col-md-9">
                    <?php
                        if($this->session->flashdata('the_error'))
                        { 
                            echo "<div class='alert alert-danger alert-error'>
                                <button type='button' class='close' data-dismiss='alert'>×</button>"
                                .$this->session->flashdata('the_error').
                                "</div>"; 
                        }
                    ?>  
                    <?php
                        if($this->session->flashdata('the_success'))
                        { 
                            echo "<div class='alert alert-success'>
                                <button type='button' class='close' data-dismiss='alert'>×</button>"
                                .$this->session->flashdata('the_success').
                                "</div>"; 
                        }
                    ?>
                    <?php if($arrivequery->num_rows() !== 0): ?>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="product-sort">
                                <span class="product-sort-selected">sort by</span>
                                <a href="#" class="product-sort-order fa fa-angle-down"></a>
                                <ul>
                                    <li><a href="<?=base_url();?>category/search/name">Name</a>
                                    </li>
                                    <li><a href="<?=base_url();?>category/search/price">Price</a>
                                    </li>
                                    <li><a href="<?=base_url();?>category/search/popular">Popularity</a>
                                    </li>
                                    <li><a href="<?=base_url();?>category/search/latest">Latest</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="row row-wrap">
                        <?php if($arrivequery->num_rows() !== 0): ?>
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
                        <?php endif; ?>
                        <?php if($arrivequery->num_rows() === 0): ?>
                        <p>No product listed.</p>
                        <?php endif; ?>
                    </div>
                    <?php if($arrivequery->num_rows() !== 0): ?>
                    <!-- <ul class="pagination">
                        <li class="prev disabled">
                            <a href="#"></a>
                        </li>
                        <li class="active"><a href="#">1</a>
                        </li>
                        <li><a href="#">2</a>
                        </li>
                        <li><a href="#">3</a>
                        </li>
                        <li><a href="#">4</a>
                        </li>
                        <li><a href="#">5</a>
                        </li>
                        <li class="next">
                            <a href="#"></a>
                        </li>
                    </ul> -->
                    <?php endif; ?>
                    <div class="gap"></div>
                </div>
            </div>

        </div>


        <!-- //////////////////////////////////
	//////////////END PAGE CONTENT///////// 
	////////////////////////////////////-->