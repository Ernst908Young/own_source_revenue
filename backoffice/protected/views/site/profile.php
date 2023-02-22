<?php 
// echo"<pre>"; print_r($_SESSION['RESPONSE']); die;
?>
<!-- page start-->
 <div class="row">
                  <aside class="profile-nav col-lg-3">
                      <section class="panel">
                          <div class="user-heading round">
                              <a href="#">
                                  <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/person image.jpg" alt="">
                              </a>
                              <h1><strong><?php echo $_SESSION['RESPONSE']['first_name']." ".$_SESSION['RESPONSE']['last_name'];?></strong></h1>
                              <p><?php echo $_SESSION['RESPONSE']['email'];?></p>
                          </div>

                          <ul class="nav nav-pills nav-stacked">
                              <li class="active"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/profile');?>"> <i class="fa fa-user"></i> Profile</a></li>
                              <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/editprofile');?>"> <i class="fa fa-edit"></i> Edit</a></li>
                          </ul>

                      </section>
                  </aside>
                  <aside class="profile-info col-lg-9">
                      <!--section class="panel">
                          <form>
                              <textarea placeholder="Whats in your mind today?" rows="2" class="form-control input-lg p-text-area"></textarea>
                          </form>
                          <footer class="panel-footer">
                              <button class="btn btn-danger pull-right">Post</button>
                              <ul class="nav nav-pills">
                                  <li>
                                      <a href="#"><i class="fa fa-map-marker"></i></a>
                                  </li>
                                  <li>
                                      <a href="#"><i class="fa fa-camera"></i></a>
                                  </li>
                                  <li>
                                      <a href="#"><i class=" fa fa-film"></i></a>
                                  </li>
                                  <li>
                                      <a href="#"><i class="fa fa-microphone"></i></a>
                                  </li>
                              </ul>
                          </footer>
                      </section-->
                      <section class="panel">
                          <div class="panel-heading" style="background:#41CAC0;color:#FFF">
                            <h3 class="text-left"><strong><?php echo $_SESSION['RESPONSE']['first_name']." ".$_SESSION['RESPONSE']['last_name'];?>'<sup>s</sup> Profile &hellip;</strong></h3>
                          </div>
                              
                          <div class="panel-body bio-graph-info">
                              <h1>Bio Graph</h1>
                              <div class="row">
                                  <div class="bio-row">
                                      <p><span>First Name</span>: <?php echo $_SESSION['RESPONSE']['first_name'];?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Last Name</span>: <?php echo $_SESSION['RESPONSE']['last_name'];?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Email</span>: <?php echo $_SESSION['RESPONSE']['email'];?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>IUID</span>: <?php echo $_SESSION['RESPONSE']['iuid'];?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>PAN Card</span>: <?php echo $_SESSION['RESPONSE']['pan_card'];?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>AADHAR Card</span>: <?php echo $_SESSION['RESPONSE']['adhaar_number'];?></p>
                                  </div>
                                  <!--div class="bio-row">
                                      <p><span>Country </span>: <?php //echo $_SESSION['RESPONSE']['country_name'];?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>State</span>: <?php //echo $_SESSION['RESPONSE']['state_name'];?></p>
                                  </div-->
                                  <div class="bio-row">
                                      <p><span>City </span>: <?php echo $_SESSION['RESPONSE']['city_name'];?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Address </span>: <?php echo $_SESSION['RESPONSE']['address'];?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Pin Code </span>: <?php echo $_SESSION['RESPONSE']['pin_code'];?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Mobile </span>: <?php echo $_SESSION['RESPONSE']['mobile_number'];?></p>
                                  </div>
                              </div>
                          </div>
                      </section>
                      <!--section>
                          <div class="row">
                              <div class="col-lg-6">
                                  <div class="panel">
                                      <div class="panel-body">
                                          <div class="bio-chart">
                                              <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="35" data-fgColor="#e06b7d" data-bgColor="#e8e8e8">
                                          </div>
                                          <div class="bio-desk">
                                              <h4 class="red">Envato Website</h4>
                                              <p>Started : 15 July</p>
                                              <p>Deadline : 15 August</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="panel">
                                      <div class="panel-body">
                                          <div class="bio-chart">
                                              <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="63" data-fgColor="#4CC5CD" data-bgColor="#e8e8e8">
                                          </div>
                                          <div class="bio-desk">
                                              <h4 class="terques">ThemeForest CMS </h4>
                                              <p>Started : 15 July</p>
                                              <p>Deadline : 15 August</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="panel">
                                      <div class="panel-body">
                                          <div class="bio-chart">
                                              <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="75" data-fgColor="#96be4b" data-bgColor="#e8e8e8">
                                          </div>
                                          <div class="bio-desk">
                                              <h4 class="green">VectorLab Portfolio</h4>
                                              <p>Started : 15 July</p>
                                              <p>Deadline : 15 August</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="panel">
                                      <div class="panel-body">
                                          <div class="bio-chart">
                                              <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="50" data-fgColor="#cba4db" data-bgColor="#e8e8e8">
                                          </div>
                                          <div class="bio-desk">
                                              <h4 class="purple">Adobe Muse Template</h4>
                                              <p>Started : 15 July</p>
                                              <p>Deadline : 15 August</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </section-->
                  </aside>
              </div>
<!-- page end-->

<script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/jquery-knob/js/jquery.knob.js"></script>   
<script>
    //knob
    $(".knob").knob();
</script>