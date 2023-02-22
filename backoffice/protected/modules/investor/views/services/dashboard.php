<title>
    <?php if(isset($sc['category_name'])){
       echo $sc['category_name'];
    }else{
        echo 'Services Dashboard';
        }
    ?>
    
</title>
<div class="dashboard-home">
<div class="applied-status"> 
    <ul class="breadcrumb">
        <li><a href="/backoffice/investor/home/investorWalkthrough">Home</a></li>
        <li><?= $sc['category_name'] ?></li>
    </ul>
    
<!-- <div class="status-title d-flex flex-wrap align-items-center justify-content-end">
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
</div>  -->                              
    <div class="row my-4">
        <?php
        

//$checktoshow=Check_agent::indShow();
        $checktoshow=true;

/*$signatoryData = json_decode(@Yii::app()->db->createCommand("SELECT submission_id,service_id,field_value from bo_new_application_submission sub
                        where submission_id = (select srn_no from bo_company_details where reg_no='45000751' and is_active=1 order by id desc limit 1)")->queryRow()['field_value'],true);

print_r($signatoryData);*/
/*foreach ($res_s as $key => $value) {
   echo $value['service_id'].'<br>';
}
*/

if(!$res_s){ ?>
    <div class="col-md-12 col-sm-12 col-xs-12">
<img src="/themes/investuk/assets/applicant/images/coming_soon.png" alt="" clas="img-fluid" style="margin:0 auto;display: block;">
</div>
<?php }

foreach ($res_s as $key => $data_arr) {
    // echo "<pre>";print_r($data_arr);die;
    $service_id = $data_arr['service_id'];
    $sub_service_id = $data_arr['servicetype_additionalsubservice'];
    if ($data_arr['is_integrated_with_swcs'] == 'Y') {
        $swcs_department_id = $data_arr['department_id'];
        $swcs_service_id = $data_arr['swcs_service_id'];
    } else {
        $swcs_department_id = false;
        $swcs_service_id = false;
    }
    if($data_arr['core_service_name'] != '') 
    {
        if((($type == 'BM') && ($data_arr['business_name_services'] == 1) && $sub_service_id == 0) || 
        (($type == 'Incop') && ($data_arr['incorporation_services'] == 1) && $sub_service_id == 0) || 
        (($type == 'Cont') && ($data_arr['continuance_services'] == 1) && $sub_service_id == 0) || 
        (($type == 'Amal') && ($data_arr['amalgamation_services'] == 1) && $sub_service_id == 0) ||
        (($type == 'ClS') && ($data_arr['closure_service'] == 1) && $sub_service_id == 0) ||

         (($type == 'OS') && ($data_arr['other_services'] == 1) && $sub_service_id == 0) ||

        (($type == 'PES') && ($data_arr['service_id'] != '484') && ($data_arr['incidence_pre_establishment'] == 1) && $sub_service_id == 0) ||
        (($type == 'POS') && ($sub_service_id == 0) && ($data_arr['incidence_pre_operation'] == 1) && (($data_arr['service_type'] != 'Amendment - Others') || 
        ($data_arr['service_type'] != 'Amendment - Surrender') || 
        ($data_arr['service_type'] != 'Amendment - Cancellation') || 
        ($data_arr['service_type'] != 'Amendment - Cancellation'))) ||
        (($type == 'PO') && (($sub_service_id != 0))) || 
        ($type == '') || ($type == 'INC' && $data_arr['is_incentive'] == 1)) 
        {
                    
                $serId = $service_id.'.'.$sub_service_id;
                $offline_flag = 0;
                $online_flag = 0;
                $swcs_flag = 0;
                $is_online = $data_arr['is_online'];
                $is_integrated_with_swcs = $data_arr['is_integrated_with_swcs'];
                if($is_online == 'Y' && $is_integrated_with_swcs == 'N') {
                    $status_text = "Online";
                    $offline_flag = 0;
                    $online_flag = 1;
                    $swcs_flag = 0;
                }
				$servID =$service_id.".".$sub_service_id;
				$fee_amount=Yii::app()->db->createCommand("SELECT fee_amount FROM tbl_service_fee WHERE service_id='$servID'")->queryRow();
            ?>   
				<div class="col-md-12 col-sm-12 col-xs-12" id="<?php echo $service_id . "_" . $sub_service_id; ?>">
					<div class="namebox mb-3">
						<h4> <h4><?php echo $data_arr['core_service_name'];  ?></h4></h4>
                
						<p><?= $data_arr['service_description'] ?></p>

                        <!-- <h5>Fee <span><?php echo @$fee_amount['fee_amount'];?></span> /day</h5> -->

                        <h5>Amount will applicable on your process/demand</h5>

						 <div style="text-align:right;">
							
							<?php 
							

									$activeServiceArray = Yii::app()->db->createCommand("SELECT concat(service_id,'.',servicetype_additionalsubservice) as service_id FROM `bo_information_wizard_service_parameters` WHERE `is_active` = 'Y'")->queryAll();
									$list = Array();                                                    
									foreach ($activeServiceArray as $key=>$value) {
									  $list[] = $value['service_id'];
									}  

                                 
									if(in_array($serId,$list))
									{

										$appURlData = Yii::app()->db->createCommand("select app_url from bo_sp_all_applications where service_id = '$serId'")->queryRow(); 
										
                                        $appurl = $appURlData['app_url']; 
									   $sc_id = isset($_GET['sc_id']) ? $_GET['sc_id'] : NULL;

									   $appurlf=  $appurl.'?sc_id='.$sc_id;
									?>  
							
								<a href="<?php echo $appurlf; ?>" class="btn-secondary">Apply Now</a> 
								
                                <!-- <a href="/panchayatiraj/backoffice/investor/services/donation/sc_id/<1?php echo $serId;?>" class="btn-secondary">Donate Now</a>     -->   
								                 
									<?php
									}
									?>
								</div>
                                                               
								</div>
								</div>
                                    
                                            
                            <?php   }
                                }
                            } 
                            ?>
                                  
                                </div>
                            </div>

                        </div>
<?php 

  //$ocr_pdf_output =  [];

  //$curl = curl_init();

//$file_path = Yii::app()->basePath .'/uploads/default_aaplication_details/205/47.0/Applicant_data (6).pdf';
/*$file_path = Yii::app()->basePath .'/uploads/default_aaplication_details/205/47.0/NCLT_Petition___GOLDMAX Final.pdf';

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.ocr.space/parse/image',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('apikey' => '854475b20a88957','file'=> new CURLFILE($file_path)),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;*/

$latest_record = Yii::app()->db->createCommand("SELECT * FROM bo_application_pdf_parsedata WHERE service_id='48.0' AND srn_no IS NULL")->queryRow();
if($latest_record['parse_data']!=NULL){
    

  /*  $message = str_replace('\r\n',"<br>",$latest_record['parse_data']);
    $message = str_replace('\t',"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$message);*/
   $message = $latest_record['parse_data'];
    $decode_data = json_decode($message,true); 

   
   foreach ($decode_data['ParsedResults'] as $key => $value) {  
   // echo '<br><b style="text-align:center;">--------------------------page: '.($key+1).' of '.sizeof($decode_data['ParsedResults']).'--------------------------</b><br><br>';
    ?>

<!-- <div style="position: relative;
  width: auto;
  height: 1000px;
  border: 3px solid red;
  overflow: scroll;
  "> -->

   <?php // each page loop
           
      //  print_r($value);
        
            /*$textOverlay = $value['TextOverlay']['Lines'];
            foreach ($textOverlay as $ke => $val) {

               foreach ($val['Words'] as $k => $v) { ?>
                   <div style="position: absolute; top:<?= $v['Top'] ?>px; left:<?= $v['Left'] ?>px; Height:<?= $v['Height'] ?>px; ">
                    <?= $v['WordText'] ?>
                    </div> 
              <?php }
              
            }*/
            ?>
<!-- </div> -->
<?php
        }         
    } 



 /*$license_code = '43C14BBE-6319-4015-863D-C0E6A0F713BA';
        $username =  'aamiransari';
 $url = 'http://www.ocrwebservice.com/restservices/processDocument?gettext=true&pagerange=1&getwords=true&newline=1';
 $filePath = Yii::app()->basePath .'/uploads/default_aaplication_details/205/47.0/NCLT_Petition___GOLDMAX Final.pdf';
  
  
        $fp = fopen($filePath, 'r');
        $session = curl_init();

        curl_setopt($session, CURLOPT_URL, $url);
        curl_setopt($session, CURLOPT_USERPWD, "$username:$license_code");

        curl_setopt($session, CURLOPT_UPLOAD, true);
        curl_setopt($session, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($session, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($session, CURLOPT_TIMEOUT, 200);
        curl_setopt($session, CURLOPT_HEADER, false);


        // For SSL using
        //curl_setopt($session, CURLOPT_SSL_VERIFYPEER, true);

        // Specify Response format to JSON or XML (application/json or application/xml)
        curl_setopt($session, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
 
        curl_setopt($session, CURLOPT_INFILE, $fp);
        curl_setopt($session, CURLOPT_INFILESIZE, filesize($filePath));

        $result = curl_exec($session);

    $httpCode = curl_getinfo($session, CURLINFO_HTTP_CODE);
        curl_close($session);
        fclose($fp);
    
        if($httpCode == 401) 
    {
           // Please provide valid username and license code
           die('Unauthorized request');
        }

        // Output response
    $data = json_decode($result);

        if($httpCode != 200) 
    {
       // OCR error
           die($data->ErrorMessage);
        }

        // Task description
    echo 'TaskDescription:'.$data->TaskDescription."\r\n";

        // Available pages 
    echo 'AvailablePages:'.$data->AvailablePages."\r\n";

        // Extracted text
        echo 'OCRText='.$data->OCRText[0][0]."\r\n";*/

/*$apiKey = 'ansari.iqbal@in.ey.com_d9ce0992c3eef762befbb27a8605e32a2f8183d9b205a02823c3e967161b79db4c8e1199';


$url = "https://api.pdf.co/v1/pdf/convert/to/html";
        
    // Prepare requests params
    $parameters = array();
    $filePath = Yii::app()->basePath .'/uploads/default_aaplication_details/205/47.0/NCLT_Petition___GOLDMAX Final.pdf';
    $parameters["url"] = $filePath; 
    $parameters["pages"] = '1-3';

    $plainHtml = false;
    if($plainHtml){
        $parameters["simple"] = $plainHtml;
    }
    $columnLayout = true;
    if($columnLayout){
        $parameters["columns"] = $columnLayout;
    }

    // Create Json payload
    $data = json_encode($parameters);

    // Create request
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $apiKey, "Content-type: application/json"));
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    // Execute request
    $result = curl_exec($curl);
    
    if (curl_errno($curl) == 0)
    {
        $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        
        if ($status_code == 200)
        {
            $json = json_decode($result, true);
            
            if (!isset($json["error"]) || $json["error"] == false)
            {
                $resultFileUrl = $json["url"];
                
                // Display link to the file with conversion results
                echo "<div><h2>Conversion Result:</h2><a href='" . $resultFileUrl . "' target='_blank'>" . $resultFileUrl . "</a></div>";
            }
            else
            {
                // Display service reported error
                echo "<p>Error: " . $json["message"] . "</p>"; 
            }
        }
        else
        {
            // Display request error
            echo "<p>Status code: " . $status_code . "</p>"; 
            echo "<p>" . $result . "</p>"; 
        }
    }
    else
    {
        // Display CURL error
        echo "Error: " . curl_error($curl);
    }
    
    // Cleanup
    curl_close($curl);*/

?>

