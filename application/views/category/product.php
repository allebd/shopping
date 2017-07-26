        <!-- //////////////////////////////////
	//////////////PAGE CONTENT///////////// 
	////////////////////////////////////-->
        <script>
                $(document).ready(function(){
                    var base_url = "<?=base_url();?>";

                    $('[name="measure"]').on('ifChecked', function(event){
                      $.ajax({
                            type:"POST",
                            url: base_url+"home/getprodprice",
                            data:{action:$(this).val()},
                            success:function(data){
                                $("p#priceshow").hide();
                                $("p#pricehide").show();
                                $("p#pricehide").html(data);
                            }
                        });
                    });
                });
        </script>



        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <?php if($productquery->num_rows() !== 0): ?>
                    <?php foreach($productquery->result() as $prodrow): ?>
                    <div id="review-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
                        <h3>Add a Review</h3>
                        <?php echo form_open('home/review_add/');?>
                            <div class="form-group">
                                <input type="hidden" name='revcode' value='<?=$prodrow->product_code;?>' />
                                <?php if(isset($is_logged_in) && $is_logged_in == true):?>
                                <input type="hidden" name='revname' value="<?=$this->session->userdata('current_user_first');?>" class="form-control" required />
                                <?php endif; ?>
                                <?php if(isset($is_logged_in) && $is_logged_in != true):?>                                
                                <label>Name</label>
                                <input type="text" name='revname' placeholder="e.g. Surname Firstname" class="form-control" required />
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <?php if(isset($is_logged_in) && $is_logged_in == true):?>
                                <input type="hidden" name='revmail' value="<?=$this->session->userdata('current_user_mail');?>" class="form-control" required />
                                <?php endif; ?>
                                <?php if(isset($is_logged_in) && $is_logged_in != true):?>                                
                                <label>E-mail</label>
                                <input type="email" name='revmail' placeholder="e.g. email@domain.com" class="form-control" required />
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label>Review</label>
                                <textarea class="form-control" name='revtext' required></textarea>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Submit" />
                        <?php echo form_close();?>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="fotorama" data-nav="thumbs" data-allowfullscreen="1" data-thumbheight="150" data-thumbwidth="150">
                                <img src="<?=base_url();?>assets/products/<?=$prodrow->product_image;?>" alt="<?=ucwords(strtolower($prodrow->product_name));?>" title="<?=ucwords(strtolower($prodrow->product_name));?>" />
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="product-info box">
                                <h3><?=ucwords(strtolower($prodrow->product_name));?></h3>
                                <small>Product Code: <strong><?=$prodrow->product_code;?></strong><br>                                
                                Select Measure: </small>
                                <?=form_open("profile/cart_add/");?>
                                <??>
                                <div class="icon-list list-space product-info-list">
                                <?php 
                                    $this->db->select('*');     
                                    $this->db->from('quantities');
                                    $this->db->where('quant_code', $prodrow->product_code);
                                    $this->db->order_by("quant_price", "asc");
                                    $quant_prod = $this->db->get();

                                    foreach($quant_prod->result() as $quantprow)
                                    {
                                ?>
                                    <div class="radio">
                                        <label class="theradio">
                                        <input type="radio" class="i-radio" name="measure" value='<?=$quantprow->quant_id;?>' required /><strong><?=$quantprow->quant_quantity;?></strong></label>
                                    </div>
                                <?php
                                    }
                                ?>
                                </div>
                                <?php 
                                    $this->db->select('*');     
                                    $this->db->from('quantities');
                                    $this->db->where('quant_code', $prodrow->product_code);
                                    $this->db->order_by("quant_price", "asc");
                                    $this->db->limit(1);
                                    $quant_prod = $this->db->get();

                                    foreach($quant_prod->result() as $quantprow)
                                    {
                                ?>
                                <p class="product-info-price" id="priceshow">₦<?=number_format($quantprow->quant_price);?></p>
                                <?php } ?>
                                <p class="product-info-price" id="pricehide"></p>
                                <p class="text-smaller text-muted"><?=$prodrow->product_summ;?></p>
                                <ul class="list-inline">
                                    <?php if(isset($is_logged_in) && $is_logged_in != true):?>
                                        <li><a class="btn btn-primary popup-text" href="#cart-dialog"><i class="fa fa-shopping-cart"></i> To Cart</a>
                                            <div id="cart-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
                                                <i class="fa fa-exclamation dialog-icon"></i>
                                                     <p>
                                                        <br>
                                                        <div class='alert alert-error'>
                                                            <p>You have to be logged in to add to cart</p>
                                                        </div>
                                                    </p>
                                            </div>
                                        </li>
                                        <li><a class="btn popup-text" href="#wish-dialog"><i class="fa fa-star"></i> To Wishlist</a>
                                            <div id="wish-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
                                                <i class="fa fa-exclamation dialog-icon"></i>
                                                     <p>
                                                        <br>
                                                        <div class='alert alert-error'>
                                                            <p>You have to be logged in to add to wishlist</p>
                                                        </div>
                                                    </p>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(isset($is_logged_in) && $is_logged_in == true):?>
                                    <li><!-- <a href="<?=base_url();?>profile/cart_add/<?=$prodrow->product_code;?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                         -->
                                        <input type="hidden" name="product_code" value='<?=$prodrow->product_code;?>' />
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                                    </li>
                                    <li><a href="<?=base_url();?>profile/wish_add/<?=$prodrow->product_code;?>" class="btn"><i class="fa fa-star"></i> To Wishlist</a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                                <?php echo form_close();?>
                            </div>
                        </div>
                    </div>
                    <div class="gap"></div>
                    <div class="tabbable">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a href="#tab-1" data-toggle="tab"><i class="fa fa-pencil"></i>Description</a>
                            </li>
                            <li><a href="#tab-2" data-toggle="tab"><i class="fa fa-info"></i>Additional Information</a>
                            </li>
                            <li><a href="#tab-3" data-toggle="tab"><i class="fa fa-truck"></i>Shipping & Payment</a>
                            </li>
                            <li><a href="#tab-4" data-toggle="tab"><i class="fa fa-comments"></i>Reviews</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab-1">
                                <p><?=$prodrow->product_summ;?></p>
                            </div>
                            <div class="tab-pane fade" id="tab-2">
                                <p><?=$prodrow->product_desc;?></p>
                            </div>
                            <div class="tab-pane fade" id="tab-3">
                                <p>The Shipping fee is ₦
                                        <?php 
                                            $shipping = 0;
                                            if (isset($shippin)) 
                                                {
                                                    foreach($shippin as $shippin): $shipping = $shippin->ship_amount; echo number_format($shipping,2); endforeach;
                                                } else {
                                                        echo number_format($shipping, 2);
                                                }
                                            ?>
                                </p>
                            </div>
                            <div class="tab-pane fade" id="tab-4">
                                <?php 
                                    $this->db->select('*');     
                                    $this->db->from('reviews');
                                    $this->db->where('review_prod',$prodrow->product_code);
                                    $reviewquery = $this->db->get();
                                ?>
                                <?php if($reviewquery->num_rows() !== 0): ?>
                                <ul class="comments-list">  
                                    <?php foreach($reviewquery->result() as $revrow): ?>                                 
                                    <li>
                                        <!-- REVIEW -->
                                        <article class="comment">
                                            <div class="comment-inner">
                                                <span class="comment-author-name"><?=ucwords(strtolower($revrow->review_user));?></span>
                                                <p class="comment-content"><?=$revrow->review_text;?></p>
                                            </div>
                                        </article>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php endif; ?>
                                <?php if($reviewquery->num_rows() === 0): ?>
                                <p>No reviews.</p>
                                <?php endif; ?>
                                <a class="popup-text btn btn-primary" href="#review-dialog" data-effect="mfp-zoom-out"><i class="fa fa-pencil"></i> Add a review</a>
                            </div>
                        </div>
                    </div>
                    <div class="gap"></div>
                    <?php 
                        $this->db->select('*');     
                        $this->db->from('products');
                        $this->db->where('product_cat',$prodrow->product_cat);
                        $this->db->where_not_in('product_code',$prodrow->product_code);
                        $this->db->where_not_in('product_status','deleted');
                        $this->db->join('submenu', 'submenu.thesmid = products.product_cat');
                        $this->db->join('menu', 'menu.themid = submenu.menuid');            
                        $this->db->order_by("counter", "desc");
                        $this->db->limit(4);
                        $relatedquery = $this->db->get();
                    ?>
                    <?php if($relatedquery->num_rows() !== 0): ?>
                    <h3>Related Products</h3>
                    <div class="gap gap-mini"></div>
                    <div class="row row-wrap">                        
                        <?php foreach($relatedquery->result() as $relrow): ?>
                        <div class="col-md-3">
                            <div class="product-thumb">
                                <header class="product-header">
                                    <img src="<?=base_url();?>assets/products/<?=$relrow->product_image;?>" style="height:162px" alt="<?=ucwords(strtolower($relrow->product_name));?>" title="<?=ucwords(strtolower($relrow->product_name));?>" />
                                </header>
                                <div class="product-inner">
                                    <h5 class="product-title"><?=ucwords(strtolower($relrow->product_name));?></h5>
                                    <p class="product-desciption"><?=ucwords(strtolower($relrow->mname));?></p>
                                    <div class="product-meta">
                                        <ul class="product-price-list">
                                            <?php 
                                                $this->db->select('*');     
                                                $this->db->from('quantities');
                                                $this->db->where('quant_code', $relrow->product_code);
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
                                                <input type="hidden" name="product_code" value="<?=$relrow->product_code;?>">
                                                <button type="submit" class="btn btn-sm"><i class="fa fa-shopping-cart"></i> To Cart</button>
                                                <?=form_close();?>
                                            </li>
                                            <?php endif; ?>
                                            <li><a class="btn btn-sm" href="<?=base_url();?>category/<?=str_replace(')', '___', str_replace('(', '__', str_replace(' ', '_', strtolower($relrow->mname))));?>/<?=str_replace(')', '___', str_replace('(', '__', str_replace(' ', '_', strtolower($relrow->smname))));?>/<?=strtolower($relrow->product_code);?>"><i class="fa fa-bars"></i> Details</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>                    
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if($productquery->num_rows() === 0): ?>
                    <p>No product found.</p>
                    <?php endif; ?>
                    <div class="gap gap-small"></div>
                </div>
                <div class="col-md-3">
                    <aside class="sidebar-right">
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