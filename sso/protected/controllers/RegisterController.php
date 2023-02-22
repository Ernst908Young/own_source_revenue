<?php

class RegisterController extends Controller
{
    
    public function actionIndex(){
    	if(isset($_POST['SP_TAG'])){
    		$SP_TAG=$_POST['SP_TAG'];
			$HMAC_HASH=$_POST['HMAC_HASH'];
			$CALL_BACK_URL=$_POST['CALL_BACK_URL'];
			
			$criteria=new CDbCriteria;
			$criteria->condition='service_provider_tag=:SP_TAG';
			$criteria->params=array(':SP_TAG'=>$SP_TAG);
			$SECRET=ServiceProviders::model()->find($criteria); 
			$SECRET=$SECRET->attributes;
			if(!empty($SECRET)){
				$SECRET=$SECRET['secret_key'];
				$HMAC=hash_hmac('sha1', $CALL_BACK_URL, $SECRET);
			}
			else{
				$HMAC=$SECRET=NULL;
			}
			
			if($_POST['HMAC_HASH']!=$HMAC){
				throw new CHttpException(400,'ERROR: Fraudulent Data');
				exit;
			}
    	}
		
		if(isset($_POST['CALL_BACK_URL']) && isset($_POST['password2'])){
			$params=array();
			$params=$_POST;
			$params['token']=md5(time());
			//echo "==> <pre>"; print_r($params); exit;			
			$this->renderPartial('redirect',$params);
			exit;
		}
        $data=array();
        $data['users']=new Users();
        $data['profiles']=new Profiles();
        $data['CALL_BACK_URL']=$CALL_BACK_URL;
		
        $this->render('index',$data);
    }
    
    public function actionSubmit(){
        echo "DEBUG <pre>"; print_r($_POST);
    }
    
}