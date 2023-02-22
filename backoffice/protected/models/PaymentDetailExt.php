<?php

/**
 * @author Hemant Thakur
 */
class PaymentDetailExt extends PaymentDetail {

    /**
     * this function is used to get the status of the submitted application payment
     */
    public static function getPaymentStatus($app_sub_id) {
        $critera = new CDbCriteria;
        $critera->condition = "app_sub_id=:app_sub_id";
        $critera->params = array(":app_sub_id" => $app_sub_id);
        $critera->order = "payment_id DESC";
        $checkPay = PaymentDetail::model()->find($critera);
        if (empty($checkPay))
            return false;
        return $checkPay->statusCode;
    }

    /**
     * @author: Rahul Kumar 
     * @description: Calculating the fee for Inprinciple application
     * @date: 01042019
     * 
     */
    public static function calculateCAFFee($submissionID, $printChk = null) {
        $amount = 0;
        $ConcessionFlg = 0;
        // Getting Submitted application details for calculating fee 
        $sql = "Select * from bo_new_application_submission where submission_id='$submissionID'";
        $result = Yii::app()->db->createCommand($sql)->queryRow();

        if (!empty($result)) { //&& $result['application_status']=='PD'
            $fieldData = (array) json_decode($result['field_value']);
            // Additional Check for calcuting unit type as per investment in Manufacturing - plant & machinary & Service - Equipment // For One more layer of calculation : Need to work on it
            /* if (isset($fieldData['UK-FCL-00038_10']) && !empty($fieldData['UK-FCL-00038_10']) && isset($fieldData['UK-FCL-00051_3']) && !empty($fieldData['UK-FCL-00051_3']) && $result['service_id'] == '591.0') {
              //
              if (isset($fieldData["UK-FCL-00648_0"]) && !empty($fieldData["UK-FCL-00648_0"]) && $fieldData['UK-FCL-00038_11'] != 'New') {
              $natureOfUnit = $fieldData['UK-FCL-00038_10']; //Nature of Unit
              $Investment = $fieldData['UK-FCL-00645_0']; //Investment
              } else {
              $natureOfUnit = $fieldData['UK-FCL-00038_10']; //Nature of Unit
              $Investment = $fieldData['UK-FCL-00051_3']; //Investment
              } */
            // Type of Investment :   Investment Details (In Lakhs) Category of Unit as per MSMED Act (UK-FCL-00038_6)
            if (isset($fieldData['UK-FCL-00038_6']) && !empty($fieldData['UK-FCL-00038_6'])) {
                $unitType = $fieldData['UK-FCL-00038_6'];
            }
            // Type of Investment :  Current / Existing Investment Details > Category of Unit (as per MSMED Act) (UK-FCL-00648_0)
            if (isset($fieldData['UK-FCL-00648_0']) && !empty($fieldData['UK-FCL-00648_0'])) {
                $unitType = $fieldData['UK-FCL-00648_0'];
            }
            //Unit Details : Proposed Location for Project / Business  > Nature of Unit (UK-FCL-00038_10)* 
            if (isset($fieldData['UK-FCL-00038_10']) && !empty($fieldData['UK-FCL-00038_10'])) {
                $unitNature = $fieldData['UK-FCL-00038_10'];
            }
            if (isset($unitNature) && !empty($unitNature) && isset($unitType) && !empty($unitType)) {
                // Getting details of fee structure 
                $sql = "Select * from caf_category_of_unit_msmed_act where nature_of_unit='$unitNature' AND id='$unitType'";
                $result = Yii::app()->db->createCommand($sql)->queryRow();
                if (!empty($result))
                    $unitType = $result['value_code'];
                // Calculation in code as per MSMED Act 
                if (isset($unitType) && !empty($unitType)) {
                    if ($unitType == 'micro')
                        $amount = 0;
                    if ($unitType == 'small')
                        $amount = 1000;
                    if ($unitType == 'medium')
                        $amount = 5000;
                    if ($unitType == 'large')
                        $amount = 10000;
                    // Category wise concession in Fee
                    /* if($filed->org_category=='SC' || $filed->org_category=='ST' || $filed->org_category=='WOMEN')
                      $amount=$amount / 2; */


                    //Gender Condition Start Here 
                    //Gender Code :  CCE : UK-FCL-00294_1 , Club : UK-FCL-00294_15 , CoS : UK-FCL-00294_2 , HUF : UK-FCL-00294_14 , LLP : UK-FCL-00294_11 ,OPC : UK-FCL-00294_10 , Pvt.LC : UK-FCL-00339_0 ,   PublicLC : UK-FCL-00294_1 , S-8,S-25 Company : UK-FCL-00294_1 , SHG : ,SP : UK-FCL-00294_12 , SGE : UK-FCL-00294_1 , Trust : UK-FCL-00336_0 , 
                    $genderArray = array('UK-FCL-00294_1', 'UK-FCL-00294_15', 'UK-FCL-00294_2', 'UK-FCL-00294_14', 'UK-FCL-00294_11', 'UK-FCL-00294_10', 'UK-FCL-00339_0', 'UK-FCL-00294_12', 'UK-FCL-00336_0', 'UK-FCL-00339_0');
                    foreach ($genderArray as $gender) {
                        if (isset($fieldData[$gender]) && !empty($fieldData[$gender])) {
                            if (!is_array($fieldData[$gender])) {
                                if ($fieldData[$gender] == "Female") {
                                    $ConcessionFlg = 1;
                                }
                            } else {
                                // Share 51% condition 
                            }
                        }
                    }
                    // Cast Category : UK-FCL-00337_0 , UK-FCL-00056_0, UK-FCL-00024_0, UK-FCL-00026_0 , UK-FCL-00030_0 , UK-FCL-00026_0 , UK-FCL-00328_0 , 
                    $categoryArray = array('0' => 'UK-FCL-00337_0', '1' => 'UK-FCL-00056_0', '2' => 'UK-FCL-00024_0', '3' => 'UK-FCL-00026_0', '4' => 'UK-FCL-00030_0', '5' => 'UK-FCL-00026_0', '6' => 'UK-FCL-00328_0');
                    foreach ($categoryArray as $category) {
                        if (isset($fieldData[$category]) && !empty($fieldData[$category])) {
                            if (!is_array($fieldData[$category])) {
                                // In db table  bo_caste_category : 1= SC & 2 = ST
                                $castArray = array('1', '2');
                                if (in_array($fieldData[$category], $castArray)) {
                                    $ConcessionFlg = 1;
                                }
                            } else {
                                // Share 51% condition 
                            }
                        }
                    }

                    // Other Category : UK-FCL-00279_0 , UK-FCL-00056_0, UK-FCL-00024_0, UK-FCL-00026_0 , UK-FCL-00030_0 , UK-FCL-00026_0 , UK-FCL-00328_0 , 
                    $otherArray = array('UK-FCL-00337_0', 'UK-FCL-00024_0', 'UK-FCL-00026_0', 'UK-FCL-00030_0', 'UK-FCL-00026_0', 'UK-FCL-00328_0');
                    foreach ($otherArray as $other) {
                        if (isset($fieldData[$other][0]) && !empty($fieldData[$other][0])) {
                            if (!is_array($fieldData[$other][0])) {
                                // In db table  bo_reserve_category : 2-Physically Handicapped, 3-Ex-Army, 4-Ex-Serviceman
                                $reservCategoryArray = array('2', '3', '4');
                                if (in_array($fieldData[$other], $reservCategoryArray)) {
                                    $ConcessionFlg = 1;
                                }
                            } else {
                                // Share 51% condition 
                            }
                        }
                    }
                }
            }
        }

        if ($ConcessionFlg == 1) {
            $amount = $amount / 2;
        }
//        if(isset($printChk) && !empty($printChk)){
//               echo $amount."=======".$unitType."=======".$ConcessionFlg."=="; print_r($fieldData);die;
//            }
        return $amount;
    }
    
    
       /**
     * @authour: Rahul Kumar 
     * @description: Check payment eligibility for Inprinciple Approval application  
     * @date: 01042019
     * */
    public static function isPaymentRequired($submissionID) {
        $sql = "Select * from bo_new_application_submission where submission_id='$submissionID'";
        $result = Yii::app()->db->createCommand($sql)->queryRow();

        if (!empty($result)) { //&& $result['application_status']=='PD'
            $fieldData = (array) json_decode($result['field_value']);
            // Additional Check for calcuting unit type as per investment in Manufacturing - plant & machinary & Service - Equipment // For One more layer of calculation : Need to work on it
            /* if (isset($fieldData['UK-FCL-00038_10']) && !empty($fieldData['UK-FCL-00038_10']) && isset($fieldData['UK-FCL-00051_3']) && !empty($fieldData['UK-FCL-00051_3']) && $result['service_id'] == '591.0') {
              //
              if (isset($fieldData["UK-FCL-00648_0"]) && !empty($fieldData["UK-FCL-00648_0"]) && $fieldData['UK-FCL-00038_11'] != 'New') {
              $natureOfUnit = $fieldData['UK-FCL-00038_10']; //Nature of Unit
              $Investment = $fieldData['UK-FCL-00645_0']; //Investment
              } else {
              $natureOfUnit = $fieldData['UK-FCL-00038_10']; //Nature of Unit
              $Investment = $fieldData['UK-FCL-00051_3']; //Investment
              } */
            // Type of Investment :   Investment Details (In Lakhs) Category of Unit as per MSMED Act (UK-FCL-00038_6)
            if (isset($fieldData['UK-FCL-00038_6']) && ($fieldData['UK-FCL-00038_6'] != "")) {
                $unitType = $fieldData['UK-FCL-00038_6'];
            }
            // Type of Investment :  Current / Existing Investment Details > Category of Unit (as per MSMED Act) (UK-FCL-00648_0)
            if (isset($fieldData['UK-FCL-00648_0']) && ($fieldData['UK-FCL-00648_0'] !="")) {
                $unitType = $fieldData['UK-FCL-00648_0'];
            }

            $total_payment = 0;
            $complete_payment =0;
            $sql = "Select * from bo_payment_detail where statusCode = 'S' and app_sub_id='$submissionID'";
            $payments = Yii::app()->db->createCommand($sql)->queryAll();
            if(!empty($payments)){
            foreach($payments as $payment){
                $total_payment = $total_payment+$payment['amount'];
            }
            if(isset($total_payment) && ($total_payment >0)){
                $complete_payment = $total_payment/100;
            }}
            // Getting details of fee structure 
            
            $sql = "Select * from caf_category_of_unit_msmed_act where id='$unitType'";
            $result = Yii::app()->db->createCommand($sql)->queryRow();

            if (!empty($result))
                $unitType = $result['value_code'];

			
			//print_r($complete_payment);die; && ($complete_payment <= $result['fee']))
            if (isset($unitType) && ($unitType !="") && ($unitType != "micro")) {
                return true;
            } else {

                return false;
            }
        }
    }

}

?>