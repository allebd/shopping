        <!-- //////////////////////////////////
	//////////////PAGE CONTENT///////////// 
	////////////////////////////////////-->



        <div class="container">
            <div class="row">
                <div class="col-md-8 mb10">
                    <h3>Cart</h3>
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
                    <?php if($cartthequery->num_rows() === 0): ?>
                    <p><strong>Shopping Cart is Empty</strong></p>
                    <p>You have no items in your shopping cart. <a href='<?=base_url();?>category'>Click here</a> to continue shopping.</p>
                    <?php endif; ?>
                    <?php if($cartthequery->num_rows() !== 0): ?>
                    <?php echo form_open('profile/cart_update'); ?>
                    <table class="table cart-table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>QTY</th>
                                <th>Measure</th>
                                <th>Price</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $subtotal = 0;                            
                                foreach($cartthequery->result() as $carttherow): ?>
                            <input type="hidden" name="theproduct[]" value="<?php echo $carttherow->cart_id;?>" />
                            <tr>
                                <td class="cart-item-image" width="200px">
                                    <a href="#"><?=ucwords(strtolower($carttherow->product_name));?></a><br>
                                    <a href="#">
                                        <img src="<?=base_url();?>assets/products/<?=$carttherow->product_image;?>" height="100px" alt="<?=ucwords(strtolower($carttherow->product_name));?>" title="<?=ucwords(strtolower($carttherow->product_name));?>" />
                                    </a>
                                </td>
                                <td class="cart-item-quantity"><i class="fa fa-minus cart-item-minus"></i>
                                    <input type="text" name="quantity[]" class="cart-quantity" value="<?php echo $carttherow->cart_quantity;?>" /><i class="fa fa-plus cart-item-plus"></i>
                                </td>
                                <td class="cart-measure">
                                    <select name='measure[]'>
                                        <option value='<?php echo $carttherow->quant_id;?>' selected><?php echo $carttherow->quant_quantity;?></option>
                                        <?php 
                                            $this->db->select('*');     
                                            $this->db->from('quantities');
                                            $this->db->where_not_in('quant_id', $carttherow->quant_id);
                                            $this->db->where('quant_code', $carttherow->cart_product);
                                            $this->db->order_by("quant_price", "desc");
                                            $quant_prod = $this->db->get();

                                            foreach($quant_prod->result() as $quantprow)
                                            {
                                        ?>
                                        <option value='<?php echo $quantprow->quant_id;?>'><?php echo $quantprow->quant_quantity;?></option>
                                        <?php 
                                            } 
                                        ?>
                                    </select>                                    
                                </td>
                                <td>₦<?php echo number_format($carttherow->quant_price * $carttherow->cart_quantity,2);?></td>
                                <td class="cart-item-remove">
                                    <a class="fa fa-times" href="<?=base_url();?>profile/cart_delete/<?=$carttherow->cart_id;?>"></a>
                                </td>
                            </tr>
                            <?php $subtotal = ($carttherow->cart_quantity * $carttherow->quant_price) + $subtotal; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <input type="submit" value="Update the cart" name='updatecart' class="btn btn-primary">
                    <?php echo form_close(); ?>                    
                    <?php endif; ?>
                </div>
                <div class="col-md-3">
                    <?php if($cartthequery->num_rows() !== 0): ?>
                    <ul class="cart-total-list">
                        <li><span>Sub Total</span><span>₦<?php echo number_format($subtotal,2); ?></span>
                        </li>
                        <li><span>Shipping</span>
                            <span>₦
                                <?php 
                                    $shipping = 0;
                                    if (isset($shippin)) 
                                        {
                                            foreach($shippin as $shippin): $shipping = $shippin->ship_amount; echo number_format($shipping,2); endforeach;
                                        } else {
                                                echo number_format($shipping, 2);
                                        }
                                    ?>
                            </span>
                        </li>
                        <li><span>Total</span><span>₦<?php $total=0; $total = $subtotal + $shipping; echo number_format($total,2); ?></span>
                        </li>
                    </ul>
                    <a href="<?=base_url();?>profile/checkout" class="btn btn-primary btn-lg">Checkout</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="gap"></div>
        </div>


        <!-- //////////////////////////////////
	//////////////END PAGE CONTENT///////// 
	////////////////////////////////////-->