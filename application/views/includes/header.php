<!DOCTYPE HTML>
<html>

<head>
    <title><?=$title;?></title>
    <!-- meta info -->
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="keywords" content="foods, Nigerian food, foodstuffs, fruits, seafood, soups, outdoor catering, small chops" />
    <meta name="description" content="Gracefoodsonline.com delivers fresh foods and cooked food to your homes and offices">
    <meta name="copyright" content="Bella Oyedele, January 2017">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300' rel='stylesheet' type='text/css'>
    <!-- Bootstrap styles -->
    <?=link_tag('assets/css/boostrap.css');?>
    <!-- Font Awesome styles (icons) -->
    <?=link_tag('assets/css/font_awesome.css');?>
    <!-- Main Template styles -->
    <?=link_tag('assets/css/styles.css');?>
    <!-- IE 8 Fallback -->
    <!--[if lt IE 9]>
	<link rel="stylesheet" type="text/css" href="assets/css/ie.css" />
<![endif]-->

    <!-- Your custom styles (blank file) -->
    <?=link_tag('assets/css/mystyles.css');?> 

    <!-- Scripts query -->
    <script src="<?=base_url();?>assets/js/jquery.js"></script>
    <script src="<?=base_url();?>assets/ckeditor/ckeditor.js"></script>
</head>

<body>


    <div class="global-wrap">

        <!-- //////////////////////////////////
	//////////////MAIN HEADER///////////// 
	////////////////////////////////////-->
        <?php if(!isset($is_adminlogged_in) || $is_adminlogged_in != ''):?>
        <div class="top-main-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <?php if(!isset($is_adminlogged_in)):?>
                        <a href="<?=base_url();?>" class="logo mt5">
                            <img src="<?=base_url();?>assets/img/logo.jpg" alt="Gracefoods Logo" title="Gracefoods Logo" />
                        </a>
                        <?php endif;?>
                        <?php if(isset($is_adminlogged_in) && ($is_adminlogged_in != '')):?>
                        <a href="<?=base_url();?>profile_admin" class="logo mt5">
                            <img src="<?=base_url();?>assets/img/logo.jpg" alt="Gracefoods Logo" title="Gracefoods Logo" />
                        </a>
                        <?php endif;?>
                    </div>
                    <div class="col-md-6 col-md-offset-4">
                        <div class="pull-right mt40">
                            <?php if(!isset($is_adminlogged_in)):?>
                            <ul class="header-features">
                                <li><i class="fa fa-phone"></i>
                                    <div class="header-feature-caption">
                                        <h5 class="header-feature-title">+234-805-512-4397</h5>
                                        <p class="header-feature-sub-title">24/7 phone assistance</p>
                                    </div>
                                </li>
                                <li><i class="fa fa-truck"></i>
                                    <div class="header-feature-caption">
                                        <h5 class="header-feature-title">Free Delivery</h5>
                                        <p class="header-feature-sub-title">on all orders over ₦9,000</p>
                                    </div>
                                </li>
                                <li><i class="fa fa-asterisk"></i>
                                    <div class="header-feature-caption">
                                        <h5 class="header-feature-title">Huge Bonuses</h5>
                                        <p class="header-feature-sub-title">shopping with ease</p>
                                    </div>
                                </li>
                            </ul>
                            <?php endif;?>
                            <?php if(isset($is_adminlogged_in) && $is_adminlogged_in != ''):?>
                            <h2>Administrator</h2>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <header class="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <?php if(!isset($is_adminlogged_in)):?>
                        <div class="flexnav-menu-button" id="flexnav-menu-button">Menu</div>
                        <nav>
                            <ul class="nav nav-pills flexnav" id="flexnav" data-breakpoint="800">
                                <li <?php if($page == 'home'): ?>class="active"<?php endif;?> ><a href="<?=base_url();?>">Home</a></li>
                                <?php foreach($menuquery->result() as $mrow):?>
                                <li <?php if(strtolower(str_replace('_', '', $this->uri->segment(2))) == strtolower($mrow->mname)): ?>class="active"<?php endif;?> ><a href="<?=base_url();?>category/<?=strtolower(str_replace(' ', '_', $mrow->mname));?>"><?=ucwords($mrow->mname);?></a>
                                    <?php 
                                        $this->db->order_by('smname','asc');
                                        $this->db->where('menuid', $mrow->themid);
                                        $submenuquery = $this->db->get('submenu');
                                    ?>
                                    <?php if($submenuquery->num_rows() > 0):?>
                                    <ul>
                                        <?php foreach($submenuquery->result() as $smrow): ?>
                                        <li><a href="<?=base_url();?>category/<?=strtolower(str_replace(' ', '_', $mrow->mname));?>/<?=strtolower(str_replace(' ', '_', $smrow->smname));?>"><?=ucwords($smrow->smname);?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <?php endif; ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </nav>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <?php if(!isset($is_adminlogged_in)):?>
                        <ul class="login-register">
                            <?php if(isset($is_logged_in) && $is_logged_in == true):?>
                            <li class="shopping-cart">
                                <a href='#'>
                                <i class='fa fa-shopping-cart'></i>                                    
                                <?php if($cartquery->num_rows() !== 0): ?>
                                    <?php
                                            $thecartcount = 0;

                                            $this->db->select('*');     
                                            $this->db->from('cart');
                                            $this->db->where('cart_user', $this->session->userdata('current_reg_id'));
                                            $this->db->where_not_in('product_status','deleted');
                                            $this->db->join('products', 'cart.cart_product = products.product_code');   
                                            $thecartcount = $this->db->count_all_results();

                                            echo "<span class='badge'>".$thecartcount."</span>";
                                    ?>
                                <?php endif; ?>
                                My Cart</a>
                                <div class="shopping-cart-box">
                                    <?php if($cartquery->num_rows() !== 0): ?>
                                    <ul class="shopping-cart-items">
                                        <?php foreach($cartquery->result() as $cartrow): ?>
                                        <li>
                                            <a href="#">
                                                <img src="<?=base_url();?>assets/products/<?=$cartrow->product_image;?>" alt="<?=ucwords(strtolower($cartrow->product_name));?>" title="<?=ucwords(strtolower($cartrow->product_name));?>" />
                                                <h5><?=ucwords(strtolower($cartrow->product_name));?></h5><span class="shopping-cart-item-price">₦<?=number_format($cartrow->quant_price * $cartrow->cart_quantity);?></span>
                                            </a>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <ul class="list-inline text-center">
                                        <li><a href="<?=base_url();?>profile/cart"><i class="fa fa-shopping-cart"></i> View Cart</a>
                                        </li>
                                        <li><a href="<?=base_url();?>profile/checkout"><i class="fa fa-check-square"></i> Checkout</a>
                                        </li>
                                    </ul>
                                    <?php endif; ?>
                                    <?php if($cartquery->num_rows() === 0): ?>
                                    <p class="shopping-cart-items">Shopping Cart is Empty</p>
                                    <?php endif; ?>                                    
                                </div>
                            </li>
                            <li><a href="<?=base_url();?>profile">
                                <i class="fa fa-user"></i>Hi, 
                                <?php foreach($regquery->result() as $regrow): ?>
                                    <?=ucwords($regrow->user_first);?>
                                <?php endforeach; ?></a>
                            </li>
                            <li><a href="<?=base_url();?>profile">
                                <i class="fa fa-table"></i>
                                My Dashboard</a>
                            </li>
                            <li><a href="<?=base_url();?>account/logout"><i class="fa fa-sign-out"></i>Log Out</a>
                            </li>
                            <?php endif; ?>
                            <?php if(!isset($is_logged_in) || $is_logged_in != true):?>
                            <li><a class="popup-text" href="#login-dialog" data-effect="mfp-move-from-top"><i class="fa fa-sign-in"></i>Sign in</a>
                            </li>
                            <li><a class="popup-text" href="#register-dialog" data-effect="mfp-move-from-top"><i class="fa fa-edit"></i>Sign up</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                        <?php endif; ?>
                        <?php if(isset($is_adminlogged_in) && $is_adminlogged_in != ''):?>
                        <ul class="login-register">
                            <li><a href="<?=base_url();?>profile_admin">
                                <i class="fa fa-user"></i>Hi, 
                                <?php foreach($regquery->result() as $regrow): ?>
                                    <?=ucwords($regrow->admin_firstname);?>
                                <?php endforeach; ?></a>
                            </li>
                            <li><a href="<?=base_url();?>profile_admin">
                                <i class="fa fa-table"></i>
                                My Dashboard</a>
                            </li>
                            <li><a href="<?=base_url();?>gracefoods_admin/logout"><i class="fa fa-sign-out"></i>Log Out</a>
                            </li>
                        </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </header>
        <?php if(!isset($is_adminlogged_in)):?>
        <?php if(!isset($is_logged_in) || $is_logged_in != true):?>
        <!-- LOGIN REGISTER LINKS CONTENT -->
        <div id="login-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
            <i class="fa fa-sign-in dialog-icon"></i>
            <h3>Login</h3>
            <h5>Welcome back, friend. Login to get started</h5>
            <?php echo form_open('account/validate_credentials', array('class'=>'dialog-form')); ?>
                <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" name='mymail' placeholder="email@domain.com" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name='mypass' placeholder="My secret password" class="form-control" required>
                </div>
                <input type="submit" value="Sign in" class="btn btn-primary">
            <?php echo form_close(); ?>
            <ul class="dialog-alt-links">
                <li><a class="popup-text" href="#register-dialog" data-effect="mfp-zoom-out">Not member yet</a>
                </li>
                <li><a class="popup-text" href="#password-recover-dialog" data-effect="mfp-zoom-out">Forgot password</a>
                </li>
            </ul>
        </div>


        <div id="register-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
            <i class="fa fa-edit dialog-icon"></i>
            <h3>Register</h3>
            <h5>Ready to get best offers? Let's get started!</h5>
            <?php echo form_open('account/registration', array('class'=>'dialog-form')); ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name='user_last' placeholder="Last Name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name='user_first' placeholder="First Name" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" name='user_mail' placeholder="email@domain.com" class="form-control" required>
                </div>                
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="number" name='user_phone' placeholder="08010000000" class="form-control" required>
                </div> 
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name='user_pass' placeholder="My secret password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Repeat Password</label>
                    <input type="password" name='user_passconfirm'  placeholder="Type your password again" class="form-control" required>
                </div>               
                <div class="checkbox">
                    <label>
                        <input type="checkbox" id='checkmes' value="Terms"><?=anchor('terms_and_conditions', 'I agree with the terms and conditions', array('target'=>'_blank')); ?>
                    </label>
                </div>
                <input type="submit" value="Sign up" name='signup' class="btn btn-primary" id='registeraccts' disabled >
            <?php echo form_close(); ?>
            <ul class="dialog-alt-links">
                <li><a class="popup-text" href="#login-dialog" data-effect="mfp-zoom-out">Already member</a>
                </li>
            </ul>
        </div>


        <div id="password-recover-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
            <i class="fa fa-retweet dialog-icon"></i>
            <h3>Password Recovery</h3>
            <h5>Forgot your password? Don't worry we can deal with it</h5>
            <?php echo form_open('account/reset_password', array('class'=>'dialog-form')); ?>
                <label>E-mail</label>
                <input type="email" name='mymail' placeholder="email@domain.com" class="form-control" class="span12" required>
                <input type="submit" value="Request new password" class="btn btn-primary">
            <?php echo form_close(); ?>
        </div>
        <!-- END LOGIN REGISTER LINKS CONTENT -->
        <?php endif; ?>

        <!-- SEARCH AREA -->
        <?php echo form_open('category/search', array('class'=>'search-area form-group')); ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-2 clearfix">
                    </div>
                    <div class="col-md-8 clearfix">
                        <label><i class="fa fa-search"></i><span>I am searching for</span>
                        </label>
                        <div class="search-area-division search-area-division-input">
                            <input class="form-control" name='searchall' type="text" placeholder="rice or apple......" />
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-block btn-white search-btn" type="submit">Search</button>
                    </div>
                    <div class="col-md-1 clearfix">
                    </div>
                </div>
            </div>
        <?php echo form_close(); ?>
        <!-- END SEARCH AREA -->
        <?php endif; ?>

        <?php if($this->uri->segment(1) != ''): ?>
        <div class="bg-white">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="<?=base_url();?>">Home</a>
                    </li>
                    <?php if($this->uri->segment(2) != ''): ?>
                    <li><a href="<?=base_url();?><?=$this->uri->segment(1);?>"><?=ucwords(str_replace('___', ')', str_replace('__', '(', str_replace('_', ' ', $this->uri->segment(1)))));?></a>
                    </li>
                    <?php endif; ?>
                    <?php if($this->uri->segment(3) != ''): ?>
                    <li><a href="<?=base_url();?><?=$this->uri->segment(1);?>/<?=strtolower(str_replace(' ', '_', $this->uri->segment(2)));?>"><?=ucwords(str_replace('___', ')', str_replace('__', '(', str_replace('_', ' ', $this->uri->segment(2)))));?></a>
                    </li>
                    <?php endif; ?>
                    <?php if($this->uri->segment(4) != ''): ?>
                    <li><a href="<?=base_url();?><?=$this->uri->segment(1);?>/<?=strtolower(str_replace(' ', '_', $this->uri->segment(2)));?>/<?=strtolower(str_replace(' ', '_', $this->uri->segment(3)));?>"><?=ucwords(str_replace('___', ')', str_replace('__', '(', str_replace('_', ' ', $this->uri->segment(3)))));?></a>
                    </li>
                    <?php endif; ?>
                    <?php if($this->uri->segment(5) != ''): ?>
                    <li><a href="<?=base_url();?><?=$this->uri->segment(1);?>/<?=strtolower(str_replace(' ', '_', $this->uri->segment(2)));?>/<?=strtolower(str_replace(' ', '_', $this->uri->segment(3)));?>/<?=strtolower(str_replace(' ', '_', $this->uri->segment(4)));?>"><?=ucwords(str_replace('___', ')', str_replace('__', '(', str_replace('_', ' ', $this->uri->segment(4)))));?></a>
                    </li>
                    <?php endif; ?>
                    <?php if($this->uri->segment(6) != ''): ?>
                    <li><a href="<?=base_url();?><?=$this->uri->segment(1);?>/<?=strtolower(str_replace(' ', '_', $this->uri->segment(2)));?>/<?=strtolower(str_replace(' ', '_', $this->uri->segment(3)));?>/<?=strtolower(str_replace(' ', '_', $this->uri->segment(4)));?>/<?=strtolower(str_replace(' ', '_', $this->uri->segment(5)));?>"><?=ucwords(str_replace('___', ')', str_replace('__', '(', str_replace('_', ' ', $this->uri->segment(5)))));?></a>
                    </li>
                    <?php endif; ?>
                    <li class="active">                        
                    <?php if(($this->uri->segment(2) == '')): ?>
                    <?=ucwords(str_replace('_', ' ', str_replace('__', '(', str_replace('___', ')', $this->uri->segment(1)))));?>                    
                    <?php endif; ?>
                    <?php if(($this->uri->segment(3) == '') && ($this->uri->segment(2) != '')): ?>
                    <?=ucwords(str_replace('_', ' ', str_replace('__', '(', str_replace('___', ')', $this->uri->segment(2)))));?>        
                    <?php endif; ?>
                    <?php if(($this->uri->segment(4) == '') && ($this->uri->segment(3) != '') && ($this->uri->segment(2) != '')): ?>
                    <?=ucwords(str_replace('_', ' ', str_replace('__', '(', str_replace('___', ')', $this->uri->segment(3)))));?>
                    <?php endif; ?>
                    <?php if(($this->uri->segment(5) == '') && ($this->uri->segment(4) != '') && ($this->uri->segment(3) != '') && ($this->uri->segment(2) != '')): ?>
                    <?=ucwords(str_replace('_', ' ', str_replace('__', '(', str_replace('___', ')', $this->uri->segment(4)))));?>             
                    <?php endif; ?>
                    <?php if(($this->uri->segment(6) == '') && ($this->uri->segment(5) != '') && ($this->uri->segment(4) != '') && ($this->uri->segment(3) != '') && ($this->uri->segment(2) != '')): ?>
                    <?=ucwords(str_replace('_', ' ', str_replace('__', '(', str_replace('___', ')', $this->uri->segment(5)))));?>                   
                    <?php endif; ?>
                    <?php if(($this->uri->segment(7) == '') && ($this->uri->segment(6) != '') && ($this->uri->segment(5) != '') && ($this->uri->segment(4) != '') && ($this->uri->segment(3) != '') && ($this->uri->segment(2) != '')): ?>
                    <?=ucwords(str_replace('_', ' ', str_replace('__', '(', str_replace('___', ')', $this->uri->segment(6)))));?>                    
                    <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
        <?php endif; ?>

        <div class="gap"></div>
        <?php endif; ?>

        <?php if(isset($is_adminlogged_in) && $is_adminlogged_in == ''):?>
        <div class="top-main-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-md-offset-5">
                        <a href="<?=base_url();?>" class="logo mt5">
                            <!-- <img src="assets/img/logo-small-dark.png" alt="Image Alternative text" title="Image Title" /> -->
                            <img src="<?=base_url();?>assets/img/logo.jpg" alt="Gracefoods Logo" title="Gracefoods Logo" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- //////////////////////////////////
	//////////////END MAIN HEADER////////// 
	////////////////////////////////////-->

