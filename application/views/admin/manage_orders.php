                    <div class="row">
                        <div class="col-md-12" id='the-general'>
                            <h3>
                                Manage Customer Orders
                            </h3>
                            <?php if($orders->num_rows() === 0): ?>
                            <p>You currently have no orders from any customer.</p>
                            <?php endif; ?>
                            <?php if($orders->num_rows() !== 0): ?>
                            <table class="table table-order">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer ID</th>
                                        <th>Order Product</th>
                                        <th>Quantity</th>
                                        <th>Measure</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Change Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $serial = 1; ?>
                                    <?php foreach($orders->result() as $orderrow): ?>
                                    <tr>
                                        <td><?=$serial; ?></td>
                                        <td><?=$orderrow->username;?></td>
                                        <td class="table-order-img">
                                            <a href="#"><?=ucwords(strtolower($orderrow->product_name));?></a><br>
                                            <a href="#">
                                                <img style="width:200px" src="<?=base_url();?>assets/products/<?=$orderrow->product_image;?>" alt="<?=ucwords(strtolower($orderrow->product_name));?>" height="100px" title="<?=ucwords(strtolower($orderrow->product_name));?>" />
                                            </a>
                                        </td>
                                        <td><?=$orderrow->order_quantity;?></td>
                                        <td><?=$orderrow->product_quantity;?></td>
                                        <td><?=date_format(date_create($orderrow->order_date), 'F j, Y');?></td>
                                        <?php if($orderrow->order_status == 'pending' || $orderrow->order_status == ''):?>
                                        <td><button type='button' class="btn btn-info" title='pending'>Pending</button></td>
                                        <?php endif; ?>
                                        <?php if($orderrow->order_status == 'completed'):?>
                                        <td><button type='button' class="btn btn-success" title='completed' >Completed</button></td>
                                        <?php endif; ?>
                                        <?php if($orderrow->order_status == 'cancelled'):?>
                                        <td><button type='button' class="btn btn-danger" title='cancelled' >Cancelled</button></td>
                                        <?php endif; ?>
                                        <td>
                                            <div class="product-sort">
                                                <span class="product-sort-selected" ><b>Change Status</b></span>
                                                <a href="#" class="product-sort-order fa fa-angle-down" class="btn btn-info"></a>
                                                <ul>
                                                    <li><a href="<?=base_url();?>profile_admin/manage_orders_update/pending/<?=$orderrow->id;?>">Pending</a>
                                                    </li>
                                                    <li><a href="<?=base_url();?>profile_admin/manage_orders_update/completed/<?=$orderrow->id;?>">Completed</a>
                                                    </li>
                                                    <li><a href="<?=base_url();?>profile_admin/manage_orders_update/cancelled/<?=$orderrow->id;?>">Cancelled</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $serial += 1; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="gap"></div>

