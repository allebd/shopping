                <script>
                            $(document).ready(function(){
                                var base_url = "<?=base_url();?>";
                                $('#countryadd').on('change', function(){
                                    $.ajax({
                                        type:"POST",
                                        url: base_url+"profile/getstate",
                                        data:{action:$("#countryadd").val()},
                                        success:function(data){
                                        $("#thestateadd").html(data);
                                        }
                                    });
                                });


                                $('[name="primaryAddressOption"]').on('ifChecked', function(event){
                                  $.ajax({
                                        type:"POST",
                                        url: base_url+"profile/updateprimaryadd",
                                        data:{action:$(this).val()},
                                        success:function(data){
                                        //$("#thestateadd").html(data);
                                        }
                                    });
                                });

                                $('[data-myname="addedit"]').on('click', function(){
                                    $.ajax({
                                        type:"POST",
                                        url: base_url+"profile/addedit",
                                        data:{action:$(this).attr("data-myid")},
                                        success:function(data){
                                        $("#editaddress").html(data);
                                        }
                                    });
                                });
                            });
                    </script>
                    <div id="edit-address-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
                        <div id='editaddress'>
                        </div>
                    </div>
                    <div id="add-address-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">                                            
                        <?php echo form_open('profile/addaddress'); ?>
                        <div class="form-group">
                            <label>Country</label>
                            <?php echo form_dropdown('countryadd', $country_options, set_value('countryadd'), 'id="countryadd" class="form-control" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <div id='thestateadd'>
                                <select class="form-control" >
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Address</label> 
                            <textarea class="form-control" name="theaddress" rows="4" required="required"></textarea>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="primaryadd" value='1' checked class="i-check" />Set Primary
                            </label>
                        </div>
                       <input type="submit" class="btn btn-primary" name="addingaddress" alue="Add Address" />                                         
                        <?php echo form_close(); ?>
                    </div>
                    <div class="row row-wrap">
                        <?php foreach($addquery->result() as $addrow): ?>
                        <div class="col-md-4">
                            <div class="address-box">
                                <a class="address-box-remove" href="<?=base_url();?>profile/deleteadd/<?=$addrow->id;?>" data-toggle="tooltip" data-placement="right" title="Remove"></a>
                                <a class="address-box-edit popup-text" href="#edit-address-dialog" data-myname="addedit" data-myid="<?=$addrow->id;?>" data-effect="mfp-move-from-top" data-toggle="tooltip" data-placement="right" title="Edit"></a>
                                <ul>
                                    <li>Country: <?=ucwords(strtolower($addrow->country));?></li>
                                    <li>State: <?=ucwords(strtolower($addrow->state_name));?></li>
                                    <li>Address: <?=$addrow->address;?> </li>
                                </ul>
                                <div class="radio">
                                    <label>
                                    <?php if($addrow->primaryadd == 1):?>
                                    <input type="radio" class="i-radio" name="primaryAddressOption" value='<?=$addrow->id;?>' checked />Primary Address</label>
                                    <?php endif;?>
                                    <?php if($addrow->primaryadd == 0):?>
                                    <input type="radio" class="i-radio" name="primaryAddressOption" value='<?=$addrow->id;?>' />Primary Address</label>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                        <div class="col-md-4">
                            <a class="address-box address-box-new popup-text" href="#add-address-dialog" data-effect="mfp-move-from-top">
                                <div class="vert-center"><i class="fa fa-plus address-box-new-icon"></i>
                                    <p>Add New Address</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="gap"></div>