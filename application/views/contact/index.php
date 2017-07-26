  <!-- //////////////////////////////////
	//////////////PAGE CONTENT///////////// 
	////////////////////////////////////-->



        <div class="container">
            <div class="row row-wrap">                
                <div class="col-md-4">
                    <h3><strong>Contact Info</strong></h3>
                    <p>For enquiries or feedback, you can contact us below</p>
                    <ul class="list">
                        <?php foreach($contactquery1->result() as $contactrow1): ?>
                        <li class='mb5'><i class="fa fa-<?=$contactrow1->icon;?>"></i> Location: <?=$contactrow1->description;?></li>
                        <?php endforeach; ?>
                        <?php foreach($contactquery2->result() as $contactrow2): ?>                        
                        <li class='mb5'><i class="fa fa-<?=$contactrow2->icon;?>"></i> Phone: <a href="tel:+2348055124397"><?=$contactrow2->description;?></a></li>
                        <?php endforeach; ?>
                        <?php foreach($contactquery3->result() as $contactrow3): ?>
                        <li class='mb5'><i class="fa fa-<?=$contactrow3->icon;?>"></i> E-mail: <a href="mailto:<?=$contactrow3->description;?>"><?=$contactrow3->description;?></a>
                        <?php endforeach; ?>
                        </li>
                    </ul>
                </div>
                <div class="col-md-8">
                    <h3><strong>Send a message</strong></h3>
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
                    <?php echo form_open_multipart('contact/sendmsg'); ?>
                        <fieldset>
                            <div class="form-group">
                                <label>Name</label>
                                <div class="bg-warning form-alert" id="form-alert-name">Please enter your name</div>
                                <input class="form-control" id="name" type="text" placeholder="Enter Your name here" name='dfullname' required />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <div class="bg-warning form-alert" id="form-alert-email">Please enter your valid E-mail</div>
                                <input class="form-control" id="email" type="email" placeholder="You E-mail Address" name='demail' required />
                            </div>
                            <div class="form-group">
                                <label>Message</label>
                                <div class="bg-warning form-alert" id="form-alert-message">Please enter message</div>
                                <textarea class="form-control" id="message" placeholder="Your message" name='dmessage' required ></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </fieldset>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <div class="gap gap-small"></div>
        </div>


        <!-- //////////////////////////////////
	//////////////END PAGE CONTENT///////// 
	////////////////////////////////////-->