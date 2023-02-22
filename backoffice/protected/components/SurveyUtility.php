<?php
	class SurveyUtility{
		 static function getAllQuestionAnswerMapping(){
			$connection=Yii::app()->db; 
			$sql = "SELECT qam.*,qm.question,atm.answer_type
					FROM 
					bo_survey_question_answer_mapping qam 
					INNER JOIN bo_survey_question_master qm ON qm.question_id = qam.question_id
					INNER JOIN bo_survey_answer_type_master atm ON atm.answer_type_id = qam.answer_type_id
					WHERE qam.is_active='Y' AND atm.is_active='Y' AND qm.is_active='Y'
					";
			$command=$connection->createCommand($sql);
			//$command->bindParam(":is_service_provider_active",'Y',PDO::PARAM_STR);
			$sp=$command->queryAll();	
			//print_r($sp);
			return $sp;
		 }
		 
		 static function pr($data,$flag=0){
			echo '<pre>'; print_r($data);
			if($flag==1){
				die;
			}
		 }
		 
		 static function displayAnswerHTML($q_id,$answer_type,$answer_type_value,$flag=0){
			$answer_html = '';
			$answer_type = strtolower($answer_type);
			$data_arr = explode("~",trim($answer_type_value,"~"));
			$flag_text ="";
			
			if($flag==1){
				$flag_text = "disabled";
			}
			
			if($answer_type == 'radio'){
				//echo '<pre>'; print_r($data_arr); die;
				foreach ($data_arr as $key => $value) {
					$value_arr = explode(":", $value);
					$answer_html .= '<label><input type="radio" name="answer_'.$q_id.'" value="'.$value_arr[0].'" '.$flag_text.'> '.$value_arr[0].'</label>';
				}
			}else if($answer_type == 'checkbox'){
				foreach ($data_arr as $key => $value) {
					$value_arr = explode(":", $value);
					$answer_html .= '<label><input type="checkbox" name="answer_'.$q_id.'" value="'.$value_arr[0].'" '.$flag_text.'> '.$value_arr[0].'</label>';
					//echo $value_arr[0]."--".$value_arr[1]."<br>";
				}
			}else if($answer_type == 'rating'){
				$value_arr = explode(":", $data_arr[0]);
				$answer_html .= '<label> Rating 1 - '.$value_arr[0].'</label>';
			}else if($answer_type == 'text'){
				$value_arr = explode(":", $data_arr[0]);
				$answer_html .= '<label><input type="text" name="answer_'.$q_id.'" placeholder="'.$value_arr[0].'" '.$flag_text.'></label>';
			}
			
			
			return $answer_html;
		 }
		 
		   /**
			  * Function to push otp
			  * auther: Hemant thakur
			  * @param string array
			  * @return boolean
			  */
			static function post_to_url($url, $data) {
			     $fields = '';
			     foreach($data as $key => $value) {
			        $fields .= $key . '=' . $value . '&';
			     }
			     rtrim($fields, '&');
			     // $url=$url.'?'.$fields;
			     $post = curl_init();
			     curl_setopt($post, CURLOPT_URL, $url);
			     curl_setopt($post, CURLOPT_POST, count($data));
			     curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
			     curl_setopt($post, CURLOPT_TIMEOUT, 500);
			     curl_setopt($post, CURLOPT_CONNECTTIMEOUT, 500);
			     curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
			     $result = curl_exec($post);
			     if ($result === false) {
			         $error = array();
			         $error['ERROR_MSG'] = curl_error($post);
			         $error['ERROR_CODE'] = curl_errno($post);
			         $error['url'] = $url;
			         $return = array();
			         $return['STATUS_ID'] = '222';
			         $return['STATUS_MSG'] = 'CURL_ERROR';
			         $return['RESPONSE'] = $error;

			         $error_message = "cURL ERROR: \t " . curl_errno($post) . " - " . curl_error($post);
			         echo json_encode($return);
			        return false;
			     } 
			    /* if (curl_errno($post) > 0) 
			             return FALSE;*/
			     curl_close($post);

			       return TRUE;

			     }
			
			      /**
			  * Function to send otp to mobile
			  * auther: Hemant thakur
			  * @param number number
			  * @return boolean
			  */
			 static function sendOTPToMobile($mobile,$msg){
			     $data = array(
			     "Id" => SMS_GATEWAY_ID,            
			    "Pwd" => SMS_GATEWAY_PASSWD,
			    "PhNo" =>"91".$mobile,      
			    "text"  => $msg        
			    );
			     if(SurveyUtility::post_to_url(SMS_GATEWAY, $data))
			         return true;
			     return false;

			 }
		 
		 
		 
	}
