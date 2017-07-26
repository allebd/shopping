
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Orders</h3>
                            <?php if($orderquery->num_rows() === 0): ?>
                            <p>You currently have no orders.</p>
                            <?php endif; ?>
                            <?php if($orderquery->num_rows() !== 0): ?>
                            <table class="table table-order">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Qty</th>
                                        <th>Measure</th>
                                        <th>Price</th>
                                        <th>Date</th>
                                        <th>Order Type</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($orderquery->result() as $orderrow): ?>
                                    <tr>
                                        <td class="table-order-img">
                                            <a href="#"><?=ucwords(strtolower($orderrow->product_name));?></a><br>
                                            <a href="#">
                                                <img style="width:100px" src="<?=base_url();?>assets/products/<?=$orderrow->product_image;?>" alt="<?=ucwords(strtolower($orderrow->product_name));?>" height="100px" title="<?=ucwords(strtolower($orderrow->product_name));?>" />
                                            </a>
                                        </td>
                                        <td><?=$orderrow->order_quantity;?></td>
                                        <td><?=$orderrow->product_quantity;?></td>
                                        <td>₦<?php echo number_format($orderrow->order_price);?></td>
                                        <td><?=date_format(date_create($orderrow->order_date), 'F j, Y');?></td>
                                        <td><?=ucwords($orderrow->order_type);?></td>
                                        <?php if($orderrow->order_status == 'pending' || $orderrow->order_status == ''):?>
                                        <td><button type='button' class="btn btn-info" title='pending'>Pending</button></td>
                                        <?php endif; ?>
                                        <?php if($orderrow->order_status == 'completed'):?>
                                        <td><button type='button' class="btn btn-success" title='completed' >Completed</button></td>
                                        <?php endif; ?>
                                        <?php if($orderrow->order_status == 'cancelled'):?>
                                        <td><button type='button' class="btn btn-danger" title='cancelled' >Cancelled</button></td>
                                        <?php endif; ?>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="gap"></div>