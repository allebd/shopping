
                    <div class="row row-wrap">
                        <h3>Wishlist</h3>
                        <?php if($wishquery->num_rows() === 0): ?>
                        <p>You currently have no product on your wishlist.</p>
                        <?php endif; ?>
                        <?php if($wishquery->num_rows() !== 0): ?>
                        <?php foreach($wishquery->result() as $wishrow): ?>
                        <div class="col-md-4">
                            <div class="product-thumb">
                                <header class="product-header">
                                    <img src="<?=base_url();?>assets/products/<?=$wishrow->product_image;?> " alt="<?=ucwords(strtolower($wishrow->product_name));?>" width="70" title="<?=ucwords(strtolower($wishrow->product_name));?>" />
                                </header>
                                <div class="product-inner">
                                    <h5 class="product-title"><?=ucwords(strtolower($wishrow->product_name));?></h5>                                    
                                    <p class="product-desciption"><?=ucwords(strtolower($wishrow->mname));?></p>
                                    <div class="product-meta">
                                        <ul class="product-price-list">
                                            <?php 
                                                $this->db->select('*');     
                                                $this->db->from('quantities');
                                                $this->db->where('quant_code', $wishrow->product_code);
                                                $this->db->order_by("quant_price", "desc");
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
                                            <li>
                                                <?=form_open("profile/cart_add/");?>
                                                <input type="hidden" name="measure" value="measure">
                                                <input type="hidden" name="product_code" value="<?=$wishrow->product_code;?>">
                                                <button type="submit" class="btn btn-sm"><i class="fa fa-shopping-cart"></i> To Cart</button>
                                                <?=form_close();?>
                                            </li>
                                            <li><a class="btn btn-sm" href="<?=base_url();?>category/<?=strtolower($wishrow->mname);?>/<?=strtolower($wishrow->smname);?>/<?=strtolower($wishrow->product_code);?>"><i class="fa fa-bars"></i> Details</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="product-wishlist-remove"><a class="btn btn-ghost btn-sm" href="<?=base_url();?>profile/wish_delete/<?=$wishrow->wishlist_id;?>"><i class="fa fa-times"></i> Remove from wishlist</a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="gap gap-small"></div>