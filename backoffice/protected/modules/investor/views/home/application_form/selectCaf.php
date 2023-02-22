<section class="panel site-min-height" >
                          <header class="panel-heading">
                              Please Select your Commmon Application Form Application
                          </header>
                          <div class="panel-body">
                            <?php
                            if(isset($isRedirect) && $isRedirect=='Y'){
                               ?>
                              <form class="form-horizontal" role="form" action="<?php echo Yii::app()->createAbsoluteUrl('frontuser/application_form/RedirectToApplicationWithCaf')?>" method="post">
                               <input type="hidden" name="PrevCaf[CALL_BACK_URL]" value='<?php echo $CALL_BACK_URL;?>' />
                               <input type="hidden" name="PrevCaf[service_id]" value='<?php echo @$service_id;?>' />
                               <input type="hidden" name="PrevCaf[service_name]" value='<?php echo @$service_name;?>' />
                              <?php
                            }
                            else{
                              ?>
                              <form class="form-horizontal" role="form" action="<?php echo Yii::app()->createAbsoluteUrl('frontuser/application_form/GenerateIncentiveForms')?>" method="post">
                              <?php

                            }
                            ?>

                                  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Please Select Your CAF </label>
                                      <div class="col-lg-10">
                                        <input type="hidden" name="PrevCaf[application]" value="<?php echo $app_id;?>" />
                                        <input type="hidden" name="PrevCaf[department]" value="<?php echo $department;?>" />
                                        <input type="hidden" name="PrevCaf[service_provider]" value="<?php echo $service_provider;?>" />

                                          <select class="form-control" required name="PrevCaf[CafID]" <?php if($service_provider =='Pollution') echo "required" ;?> id="">
                                          <option value="">Please Select Your Approved CAF</option>
                                          <?php
                                            foreach ($prevCaf as $key => $caf){
                                              $field_value=json_decode($caf['field_value']);
                                              $company_name=$field_value->company_name;
                                               echo "<option value='".$caf->submission_id."'>".$caf->submission_id." - ".$company_name;

                                            } 
                                             
                                          ?>
                                         <?php
                                            if($service_provider!='Pollution' && $service_provider!='UPCL' )
                                             echo '<option value="">None of the Above</option>';
                                          ?>
                                          

                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                          <button type="submit" class="btn btn-primary">Apply</button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </section>