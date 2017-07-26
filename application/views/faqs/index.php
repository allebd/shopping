        <!-- //////////////////////////////////
	//////////////PAGE CONTENT///////////// 
	////////////////////////////////////-->



        <div class="container">
            <div class="row row-wrap">
                <div class="col-md-9">                    
                <h3><strong>Frequently Asked Questions</strong></h3>
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <?php foreach($faqquery->result() as $faqrow): ?>
                            <div class="panel-heading">
                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse-<?=$faqrow->id;?>"><?=$faqrow->question;?></a></h4>
                            </div>
                            <div class="panel-collapse collapse in" id="collapse-<?=$faqrow->id;?>">
                                <div class="panel-body">
                                    <p><?=$faqrow->answer;?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
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
                    <aside class="sidebar-right">
                        <h4>Still Have Questions?</h4>
                        <?php echo form_open_multipart('faqs/sendmsg', array('class'=>'box')); ?>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name='dfullname' class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" name='demail' class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label>Question</label>
                                <textarea class="form-control" name='dmessage' required ></textarea>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Ask Question" />
                        <?php echo form_close(); ?>
                    </aside>
                </div>
            </div>
            <div class="gap gap-small"></div>
        </div>


        <!-- //////////////////////////////////
	//////////////END PAGE CONTENT///////// 
	////////////////////////////////////-->