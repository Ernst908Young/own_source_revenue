<?php  $basePath="/themes/investuk"; ?> 
<?php $userID = $_SESSION['RESPONSE']['user_id']; ?>
                        
                        <div class="dashboard-home">
                            <div class="home-top position-relative">
                                <div class="home-row d-flex flex-wrap">
                                    <div class="counter-item bord-1">
                                        <div class="data-counter">
                                            <div class="counter-left">
                                                <div class="d-inline-block text-center">
                                                    <span>DRAFT</span>
                                                    <span class="counter-number"><?php echo $this->GetServiceWiseCount('report_all','I',$userID); ?></span>
                                                </div>
                                            </div>
                                            <div class="counter-icon">
                                                <img src="<?php echo $basePath; ?>/assets/applicant/images/counter-1.png">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="counter-item bord-2">
                                        <div class="data-counter">
                                            <div class="counter-left">
                                                <div class="d-inline-block text-center">
                                                <span>SUBMITTED</span>
                                                <span class="counter-number font-montserrat"><?php echo $this->GetServiceWiseCount('report_all','P',$userID); ?></span>
                                            </div>
                                            </div>
                                            <div class="counter-icon">
                                                <img src="<?php echo $basePath; ?>/assets/applicant/images/counter-2.png">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="counter-item bord-3">
                                        <div class="data-counter">
                                            <div class="counter-left">
                                                <span>PENDING FOR RESUBMISSION</span>
                                                <span class="counter-number"><?php echo $this->GetServiceWiseCount('report_all','RBI',$userID); ?></span>
                                            </div>
                                            <div class="counter-icon">
                                                <img src="<?php echo $basePath; ?>/assets/applicant/images/counter-3.png">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="counter-item bord-4">
                                        <div class="data-counter">
                                            <div class="counter-left">
                                                <span>APPLICATION UNDER REVIEW</span>
                                                <span class="counter-number"><?php echo $this->GetServiceWiseCount('report_all','F',$userID); ?></span>
                                            </div>
                                            <div class="counter-icon">
                                                <img src="<?php echo $basePath; ?>/assets/applicant/images/counter-4.png">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="counter-item bord-5">
                                        <div class="data-counter">
                                            <div class="counter-left">
                                                <span>APPROVED</span>
                                                <span class="counter-number font-montserrat"><?php echo $this->GetServiceWiseCount('report_all','A',$userID)+$this->GetServiceWiseCount('to_be_used_in_iw','R',$userID); ?></span>
                                            </div>
                                            <div class="counter-icon">
                                                <img src="<?php echo $basePath; ?>/assets/applicant/images/counter-5.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="applied-status">
                                <div class="status-title d-flex flex-wrap align-items-center justify-content-between">
                                    <h4>Recent applied services status</h4>
                                    <div class="serach-bar">
                                        <form>
                                            <div class="search-field position-relative">
                                                <input type="text" name="" placeholder="Search">
                                            <button class="search-btn">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="applied-view">
                                    <div class="applied-item">
                                        <div class="item-row">
                                            <div class="iteam-td srn-no text-center">
                                                <h5>SRN No.</h5>
                                                <p>#122</p>
                                            </div>
                                            <div class="iteam-td services-name text-start">
                                                <h5>Service Name</h5>
                                                <p>Society: Societies with Restricted Liability ACT OF BARBADOS Request for Name Search and Name Reservation (FORM 33)</p>
                                            </div>
                                            <div class="iteam-td servoces-type text-center">
                                                <h5>Service Type</h5>
                                                <p>Name Related Service</p>
                                            </div>
                                            <div class="iteam-td applied-on  text-center">
                                                <h5>Applied On</h5>
                                                <p>23rd June, 2021</p>
                                            </div>
                                            <div class="iteam-td current-status  text-center">
                                                <h5>Current Status</h5>
                                                <p class="pending">Approval Pending</p>
                                            </div>
                                            <div class="toggle-click">
                                            </div>
                                        </div>
                                        <div class="toggle-open">
                                            <ul class="application-download d-flex flex-wrap justify-content-center">
                                                <li>
                                                    <div class="donwload-box">
                                                        <a href="">
                                                             <img src="<?php echo $basePath; ?>/assets/applicant/images/print-icon.png">
                                                             <p>Print<br>Application</p>
                                                         </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="donwload-box">
                                                         <a href="">
                                                             <img src="<?php echo $basePath; ?>/assets/applicant/images/pdf-icon.png">
                                                             <p>Download<br>Letter / Certificate</p>
                                                         </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="donwload-box">
                                                        <a href="#">
                                                            <img src="<?php echo $basePath; ?>/assets/applicant/images/time-icon.png">
                                                            <p>View Timeline</p>
                                                         </a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="applied-item">
                                        <div class="item-row">
                                            <div class="iteam-td srn-no text-center">
                                                <h5>SRN No.</h5>
                                                <p>#122</p>
                                            </div>
                                            <div class="iteam-td services-name text-start">
                                                <h5>Service Name</h5>
                                                <p>Society: Societies with Restricted Liability ACT OF BARBADOS Request for Name Search and Name Reservation (FORM 33)</p>
                                            </div>
                                            <div class="iteam-td servoces-type text-center">
                                                <h5>Service Type</h5>
                                                <p>Name Related Service</p>
                                            </div>
                                            <div class="iteam-td applied-on  text-center">
                                                <h5>Applied On</h5>
                                                <p>23rd June, 2021</p>
                                            </div>
                                            <div class="iteam-td current-status  text-center">
                                                <h5>Current Status</h5>
                                                <p class="approve">Approved</p>
                                            </div>
                                            <div class="toggle-click">
                                            </div>
                                        </div>
                                        <div class="toggle-open">
                                            <ul class="application-download d-flex flex-wrap justify-content-center">
                                                <li>
                                                    <div class="donwload-box">
                                                        <a href="">
                                                             <img src="<?php echo $basePath; ?>/assets/applicant/images/print-icon.png">
                                                             <p>Print<br>Application</p>
                                                         </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="donwload-box">
                                                         <a href="">
                                                             <img src="<?php echo $basePath; ?>/assets/applicant/images/pdf-icon.png">
                                                             <p>Download<br>Letter / Certificate</p>
                                                         </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="donwload-box">
                                                        <a href="#">
                                                            <img src="<?php echo $basePath; ?>/assets/applicant/images/time-icon.png">
                                                            <p>View Timeline</p>
                                                         </a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                 