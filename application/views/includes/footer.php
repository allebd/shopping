<!-- //////////////////////////////////
	//////////////MAIN FOOTER////////////// 
	////////////////////////////////////-->

        <?php if(!isset($is_adminlogged_in) || (isset($is_adminlogged_in) && $is_adminlogged_in != '')):?>
        <footer class="main" id="main-footer">
            <?php if(!isset($is_adminlogged_in)):?>
            <div class="footer-top-area">
                <div class="container">
                    <div class="row row-wrap">
                        <div class="col-md-3">
                            <h4>Get to know us</h4>                            
                            <ul class="thumb-list">
                                <li><a href="<?=base_url();?>about">About Us</a></li>                                
                                <li><a href="<?=base_url();?>terms_and_conditions">Terms and Conditions</a></li>
                                <li><a href="<?=base_url();?>privacy_policy">Privacy Policy</a></li>
                                <li><a href="<?=base_url();?>careers">Careers</a></li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <h4>Let us help you</h4>                            
                            <ul class="thumb-list">
                                <li><a href="<?=base_url();?>contact">Contact Us</a></li>                                
                                <li><a href="<?=base_url();?>how_to_shop">How to Shop</a></li>
                                <li><a href="<?=base_url();?>return_policy">Return Policy</a></li>
                                <li><a href="<?=base_url();?>faqs">Help &amp; FAQs</a></li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <h4>Sign Up to the Newsletter</h4>
                            <div class="box">
                                <?php echo form_open('home/newsletter_add/');?>
                                    <div class="form-group mb10">
                                        <label>Subscribe for special offers</label>
                                        <input type="email" class="form-control" name='newletter' placeholder='Enter Email Address' required/>
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="Sign Up" />
                                <?php echo form_close();?>
                            </div>

                        </div>
                        <div class="col-md-3">
                            <h4>Connect with us</h4>

                            <ul class="thumb-list">
                                <li>
                                    <ul class="list list-social">
                                        <?php foreach($social->result() as $socialrow): ?>
                                        <li>
                                            <a target='_blank' class="fa fa-<?=$socialrow->name;?> box-icon" href="<?=$socialrow->link;?>" data-toggle="tooltip" title="<?=ucwords($socialrow->name);?>"></a>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                                <?php foreach($contact1query2->result() as $contact1row2): ?>
                                <li>
                                    <i class="fa fa-<?=$contact1row2->icon;?>"></i>
                                    <span><a href="tel:+2348055124397"><?=$contact1row2->description;?></a></span>
                                </li>
                                <?php endforeach; ?>
                                <?php foreach($contact1query3->result() as $contact1row3): ?>
                                <li>
                                    <i class="fa fa-<?=$contact1row3->icon;?>"></i>
                                    <span><a href="mailto:<?=$contact1row3->description;?>"><?=$contact1row3->description;?></a></span>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="footer-copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <p>Copyright © <?php echo date('Y'); ?>, Gracefoods, All Rights Reserved</p>
                        </div>
                        <div class="col-md-6 col-md-offset-2">
                            <div class="pull-right">
                                <ul class="list-inline list-payment">
                                    <li>
                                        <img src="<?=base_url();?>assets/img/payment/american-express-curved-32px.png" alt="Image Alternative text" title="Image Title" />
                                    </li>
                                    <li>
                                        <img src="<?=base_url();?>assets/img/payment/cirrus-curved-32px.png" alt="Image Alternative text" title="Image Title" />
                                    </li>
                                    <li>
                                        <img src="<?=base_url();?>assets/img/payment/discover-curved-32px.png" alt="Image Alternative text" title="Image Title" />
                                    </li>
                                    <li>
                                        <img src="<?=base_url();?>assets/img/payment/ebay-curved-32px.png" alt="Image Alternative text" title="Image Title" />
                                    </li>
                                    <li>
                                        <img src="<?=base_url();?>assets/img/payment/maestro-curved-32px.png" alt="Image Alternative text" title="Image Title" />
                                    </li>
                                    <li>
                                        <img src="<?=base_url();?>assets/img/payment/mastercard-curved-32px.png" alt="Image Alternative text" title="Image Title" />
                                    </li>
                                    <li>
                                        <img src="<?=base_url();?>assets/img/payment/visa-curved-32px.png" alt="Image Alternative text" title="Image Title" />
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <?php endif; ?>
        <!-- //////////////////////////////////
	//////////////END MAIN  FOOTER///////// 
	////////////////////////////////////-->



        <!-- Scripts queries -->
        <script src="<?=base_url();?>assets/js/boostrap.min.js"></script>
        <script src="<?=base_url();?>assets/js/countdown.min.js"></script>
        <script src="<?=base_url();?>assets/js/flexnav.min.js"></script>
        <script src="<?=base_url();?>assets/js/magnific.js"></script>
        <script src="<?=base_url();?>assets/js/tweet.min.js"></script>
    <!--    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script> -->
        <script src="<?=base_url();?>assets/js/fitvids.min.js"></script>
        <script src="<?=base_url();?>assets/js/mail.min.js"></script>
        <script src="<?=base_url();?>assets/js/ionrangeslider.js"></script>
        <script src="<?=base_url();?>assets/js/icheck.js"></script>
        <script src="<?=base_url();?>assets/js/fotorama.js"></script>
        <script src="<?=base_url();?>assets/js/card-payment.js"></script>
        <script src="<?=base_url();?>assets/js/owl-carousel.js"></script>
        <script src="<?=base_url();?>assets/js/masonry.js"></script>
        <!--    <script src="<?=base_url();?>assets/js/nicescroll.js"></script>  -->

        <!-- Custom scripts -->
        <script src="<?=base_url();?>assets/js/custom.js"></script>
    </div>
</body>

</html>
