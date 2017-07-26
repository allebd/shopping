



        <div class="container">
            <div class="row">
                <?php if($cartthequery->num_rows() === 0): ?>
                <p><strong>Shopping Cart is Empty</strong></p>
                <p>You have no items in your shopping cart. <a href='<?=base_url();?>category'>Click here</a> to continue shopping.</p>
                <?php endif; ?>
                <?php if($addquery->num_rows() === 0): ?>
                    <div class='alert alert-danger alert-error'>
                        <button type='button' class='close' data-dismiss='alert'>×</button>
                        No primary address specified, kindly add an address in your profile.
                    </div>
                <?php endif; ?>
                <?php if($cartthequery->num_rows() !== 0 && $addquery->num_rows() !== 0): ?>
                <div class="col-md-6 mb20">
                    <aside class="sidebar-left">
                        <div class="box clearfix">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>QTY</th>
                                        <th>Measure</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php
                                        $subtotal = 0;                            
                                        foreach($cartthequery->result() as $carttherow): ?>
                                    <tr>
                                        <td><?=ucwords(strtolower($carttherow->product_name));?></td>
                                        <td><?=ucwords(strtolower($carttherow->cart_quantity));?></td>
                                        <td><?php echo $carttherow->quant_quantity;?></td>
                                        <td>₦<?php echo number_format($carttherow->quant_price * $carttherow->cart_quantity,2);?></td>
                                    </tr>
                                    <?php $subtotal = ($carttherow->cart_quantity * $carttherow->quant_price) + $subtotal; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <ul class="cart-total-list text-center mb0">
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
                        </div>
                    </aside>
                </div>
                <div class="col-md-6">
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
                    <!-- <div class="row mb20">
                        <div class="col-md-12 col-md-offset-1">
                            <h3>Pay Via PayStack</h3>
                            <p>Important: You will be redirected to PayStack's website to securely complete your payment.</p>
                            <a href="#" class="btn btn-primary">Checkout via PayStack</a>
                        </div>
                    </div> -->
                    <div class="row mb20">
                        <div class="col-md-12 col-md-offset-1">
                            <h3>Pay at Bank</h3>
                            <p>Important: You will be required to pay at the bank with the details to complete your payment.</p>
                            <a href="#" class="btn btn-primary" data-toggle='modal' data-target='.bank-modal-sm'>Pay at Bank</a>
                        </div>
                    </div>
                    <div class="row mb20">
                        <div class="col-md-12 col-md-offset-1">
                            <h3>Pay via Transfer</h3>
                            <p>Important: You will be required to pay via internet banking or money transfer to complete your payment.</p>
                            <a href="#" class="btn btn-primary" data-toggle='modal' data-target='.bank-modal-st'>Pay via Transfer</a>
                        </div>
                    </div>
                    <?php if($total < 25000): ?>
                    <div class="row mb20">
                        <div class="col-md-12 col-md-offset-1">
                            <h3>Pay on Delivery</h3>
                            <p>Important: Your payment would be collected at the point of delivery.</p>
                            <ul>
                                <li>Only for payments not more than ₦25,000</li>
                                <li>No cheques accepted.</li>
                            </ul>
                            <a href="<?=base_url();?>profile/recorddeliverypayment/delivery" class="btn btn-primary" onclick='return confirm("Are you sure you want to continue with payment on delivery?")'>Pay on Delivery</a>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="modal fade bank-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title text-info" id="myModalLabel"> Banks Details/Procedures </h4>
                                </div>
                                <div class="modal-body">
                                    <div class='alert alert-danger alert-error'>
                                        <button type='button' class='close' data-dismiss='alert'>×</button>
                                        After reading through to continue, click pay to bank below or cancel above.
                                    </div>
                                    <label>Make payment to:</label>
                                    <div class="well">
                                        <p class="text-success -bank-acct">
                                           <span> <img src="<?php echo base_url().'assets/img/payment/firstbank.png' ?>" style='width:40px;height:40px' /></span>
                                           <span>
                                                <i>Bank Name: <b>First bank Nigeria Ltd.</b> </i><br>
                                                <i class="text-success" >Account Name:<b> Grace Foods Ventures</b> </i><br>
                                                <i class="text-success" >Account No:<b> 2029016385</b></i>
                                           </span>
                                        </p>
                                        <p class="text-success -bank-acct" >
                                            <span><img src="<?php echo base_url().'assets/img/payment/gtb.png' ?>" style='width:40px;height:40px' /></span>
                                            <span>
                                                <i>Bank Name: <b>Guaranty Trust Bank Plc.</b> </i><br>
                                                <i class="text-success" >Account Name:<b> Grace Foods Ventures</b> </i><br>
                                                <i class="text-success" >Account No:<b> 0160861841</b></i>
                                            </span>
                                        </p>
                                    </div>

                                    <label>After payment SMS the following from your registered phone number in this format:</label>
                                    <div class="well">
                                        <ul>
                                            <li>Depositor Name</li>
                                            <li>Your Registered Email</li>
                                            <li>Teller Number</li>
                                            <li>Amount Paid</li>
                                            <li>Bank Name</li>
                                            <li>Payment Date </li>
                                        </ul>
                                        <p class="text-success" >to: <b>+234 805 512 4397</b></p>
                                    </div>

                                    <div class="modal-footer">
                                        <a href="<?=base_url();?>profile/recordbankpayment/bank" class="btn btn-primary" onclick='return confirm("Are you sure you want to continue with payment to the bank?")'>Pay to bank</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade bank-modal-st" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title text-info" id="myModalLabel"> Transfer Details/Procedures </h4>
                                </div>
                                <div class="modal-body">
                                    <div class='alert alert-danger alert-error'>
                                        <button type='button' class='close' data-dismiss='alert'>×</button>
                                        After reading through to continue, click pay via transfer below or cancel above.
                                    </div>
                                    <label>Make payment to:</label>
                                    <div class="well">
                                        <p class="text-success -bank-acct">
                                           <span> <img src="<?php echo base_url().'assets/img/payment/firstbank.png' ?>" style='width:40px;height:40px' /></span>
                                           <span>
                                                <i>Bank Name: <b>First bank Nigeria Ltd.</b> </i><br>
                                                <i class="text-success" >Account Name:<b> Grace Foods Ventures</b> </i><br>
                                                <i class="text-success" >Account No:<b> 2029016385</b></i>
                                           </span>
                                        </p>
                                        <p class="text-success -bank-acct" >
                                            <span><img src="<?php echo base_url().'assets/img/payment/gtb.png' ?>" style='width:40px;height:40px' /></span>
                                            <span>
                                                <i>Bank Name: <b>Guaranty Trust Bank Plc.</b> </i><br>
                                                <i class="text-success" >Account Name:<b> Grace Foods Ventures</b> </i><br>
                                                <i class="text-success" >Account No:<b> 0160861841</b></i>
                                            </span>
                                        </p>
                                    </div>

                                    <label>After payment SMS the following from your registered phone number in this format:</label>
                                    <div class="well">
                                        <ul>
                                            <li>Your Registered Email</li>
                                            <li>Amount Transferred</li>
                                            <li>The Account Name where the money was transferred</li>
                                            <li>Payment Date </li>
                                        </ul>
                                        <p class="text-success" >to: <b>+234 805 512 4397</b></p>
                                    </div>

                                    <div class="modal-footer">
                                        <a href="<?=base_url();?>profile/recordbankpayment/transfer" class="btn btn-primary" onclick='return confirm("Are you sure you want to continue with payment via transfer?")'>Pay via transfer</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <div class="gap"></div>
        </div>


        <!-- //////////////////////////////////
	//////////////END PAGE CONTENT///////// 
	////////////////////////////////////-->