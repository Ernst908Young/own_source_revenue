<?php

class ServiceTimelineController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	/*public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','index'),
				'expression'=>'RolesExt::isAdminUser()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','index'),
				'expression'=>'DefaultUtility::isInfoWizardAdmin()',
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}*/

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new BoInfowizardServiceTimeline;
        $serviceID = $_GET['serviceID'];
        $serviceData = BoInformationWizardServiceMaster::model()->findByPk($serviceID);
		$connection=Yii::app()->db;
        if (!empty($_POST)) 
		{  //print_r($_POST); die;
		    BoInfowizardServiceTimeline::model()->deleteAll("service_id='$serviceID'");
			$serviceType = $_POST['service_type']; 
            $alldata = $_POST;
			///////////////////////////Service Type//////////////////////////////
			$acilppr['acilppr'] = $_POST['acilppr'];
            $acilppr['acilppr']['service_type'] = $alldata['service_type'][0]; 
			 $acilppr['acilppr']['servicetype_additionalsubservice'] = '0'; 
              if(!empty($acilppr['acilppr'])) 
			{
		    $c=count($acilppr['acilppr']['go_notification_dh_no']); 
			$c1=count($acilppr['acilppr']['gov_act_dh_no']); 
			$c2=count($acilppr['acilppr']['gov_act_first_dh_no']); 
			$c3=count($acilppr['acilppr']['gov_act_second_dh_no']); 
			$c4=count($acilppr['acilppr']['uksw_act_dh_no']); 
			$c5=count($acilppr['acilppr']['uksw_act_first_dh_no']); 
			$c6=count($acilppr['acilppr']['uksw_act_second_dh_no']); 
			$c7=count($acilppr['acilppr']['ukrts_act_dh_no']); 
			$c8=count($acilppr['acilppr']['ukrts_act_first_dh_no']); 
			$c9=count($acilppr['acilppr']['ukrts_act_second_dh_no']); 
			
			$go_notification=array();
			for($i=0;$i<$c;$i++)
			{
				 $go_notification[$i]['go_notification_dh_no'] = $acilppr['acilppr']['go_notification_dh_no'][$i];
				 $go_notification[$i]['go_notification_dh'] = $acilppr['acilppr']['go_notification_dh'][$i];
				 $go_notification[$i]['go_notification_condition'] = $acilppr['acilppr']['go_notification_condition'][$i];
				 
			 } 
                         $je=json_encode($go_notification);
			 $acilppr['acilppr']['go_notification']=$je;
			 $gov_act=array();
			 for($i=0;$i<$c1;$i++)
	         {
				$gov_act[$i]['gov_act_dh_no'] = $acilppr['acilppr']['gov_act_dh_no'][$i];
				 $gov_act[$i]['gov_act_dh'] = $acilppr['acilppr']['gov_act_dh'][$i];
				 $gov_act[$i]['gov_act_condition'] = $acilppr['acilppr']['gov_act_condition'][$i];
			 }
                         $jegov=json_encode($gov_act);
			 $acilppr['acilppr']['gov_act']=$jegov;
			 $gov_act_first=array();
			  for($i=0;$i<$c2;$i++)
			{    
			     $gov_act_first[$i]['gov_act_first_dh_no'] = $acilppr['acilppr']['gov_act_first_dh_no'][$i];
				 $gov_act_first[$i]['gov_act_first_dh'] = $acilppr['acilppr']['gov_act_first_dh'][$i];
				 $gov_act_first[$i]['gov_act_first_condition'] = $acilppr['acilppr']['gov_act_first_condition'][$i];
			 }
		     $acilppr['acilppr']['gov_act_first']="'".json_encode($gov_act_first)."'";
			 $gov_act_second=array();
			  for($i=0;$i<$c3;$i++)
			{    
			     $gov_act_second[$i]['gov_act_second_dh_no'] = $acilppr['acilppr']['gov_act_second_dh_no'][$i];
				 $gov_act_second[$i]['gov_act_second_dh'] = $acilppr['acilppr']['gov_act_second_dh'][$i];
				 $gov_act_second[$i]['gov_act_second_condition'] = $acilppr['acilppr']['gov_act_second_condition'][$i];
			 }
		     $acilppr['acilppr']['gov_act_second']="'".json_encode($gov_act_second)."'";
			                       ////////////////////////////////Service Type Uksw///////////////////////////
			 $uksw_act=array();
			 for($i=0;$i<$c4;$i++)
	         {
				$uksw_act[$i]['uksw_act_dh_no'] = $acilppr['acilppr']['uksw_act_dh_no'][$i];
				 $uksw_act[$i]['uksw_act_dh'] = $acilppr['acilppr']['uksw_act_dh'][$i];
				 $uksw_act[$i]['uksw_act_condition'] = $acilppr['acilppr']['uksw_act_condition'][$i];
			 }
                         $jeuksw=json_encode($uksw_act);
			 $acilppr['acilppr']['uksw_act']=$jeuksw;
			 $uksw_act_first=array();
			  for($i=0;$i<$c5;$i++)
			{    
			     $uksw_act_first[$i]['uksw_act_first_dh_no'] = $acilppr['acilppr']['uksw_act_first_dh_no'][$i];
				 $uksw_act_first[$i]['uksw_act_first_dh'] = $acilppr['acilppr']['uksw_act_first_dh'][$i];
				 $uksw_act_first[$i]['uksw_act_first_condition'] = $acilppr['acilppr']['uksw_act_first_condition'][$i];
			 }
		     $acilppr['acilppr']['uksw_act_first']="'".json_encode($uksw_act_first)."'";
			 $uksw_act_second=array();
			  for($i=0;$i<$c6;$i++)
			{    
			     $uksw_act_second[$i]['uksw_act_second_dh_no'] = $acilppr['acilppr']['uksw_act_second_dh_no'][$i];
				 $uksw_act_second[$i]['uksw_act_second_dh'] = $acilppr['acilppr']['uksw_act_second_dh'][$i];
				 $uksw_act_second[$i]['uksw_act_second_condition'] = $acilppr['acilppr']['uksw_act_second_condition'][$i];
			 }
		     $acilppr['acilppr']['uksw_act_second']="'".json_encode($uksw_act_second)."'";
						   ////////////////////////////////Service Type UkRTS///////////////////////////
			 $ukrts_act=array();
			 for($i=0;$i<$c7;$i++)
	         {
				$ukrts_act[$i]['ukrts_act_dh_no'] = $acilppr['acilppr']['ukrts_act_dh_no'][$i];
				 $ukrts_act[$i]['ukrts_act_dh'] = $acilppr['acilppr']['ukrts_act_dh'][$i];
				 $ukrts_act[$i]['ukrts_act_condition'] = $acilppr['acilppr']['ukrts_act_condition'][$i];
			 }
                         $jeukswcsje=json_encode($ukrts_act);
			 $acilppr['acilppr']['ukrts_act']= $jeukswcsje;
			 $ukrts_act_first=array();
			  for($i=0;$i<$c8;$i++)
			{    
			     $ukrts_act_first[$i]['ukrts_act_first_dh_no'] = $acilppr['acilppr']['ukrts_act_first_dh_no'][$i];
				 $ukrts_act_first[$i]['ukrts_act_first_dh'] = $acilppr['acilppr']['ukrts_act_first_dh'][$i];
				 $ukrts_act_first[$i]['ukrts_act_first_condition'] = $acilppr['acilppr']['ukrts_act_first_condition'][$i];
			 }
             $jeukrts=json_encode($ukrts_act_first);
		     $acilppr['acilppr']['ukrts_act_first']=$jeukrts;
			 $ukrts_act_second=array();
			  for($i=0;$i<$c9;$i++)
			{    
			     $ukrts_act_second[$i]['ukrts_act_second_dh_no'] = $acilppr['acilppr']['ukrts_act_second_dh_no'][$i];
				 $ukrts_act_second[$i]['ukrts_act_second_dh'] = $acilppr['acilppr']['ukrts_act_second_dh'][$i];
				 $ukrts_act_second[$i]['ukrts_act_second_condition'] = $acilppr['acilppr']['ukrts_act_second_condition'][$i];
			 }
		     $acilppr['acilppr']['ukrts_act_second']=json_encode($ukrts_act_second);
			              ////////////////////////////////////////////////////////////
			
             }
			 $data[] = $acilppr['acilppr'];
		///////////////////////////Service Type End//////////////////////////////
			 
             ///////////////////////////Amendment - Others 1////////////////////////////// 
			 if (in_array('Amendment - Others', $serviceType)) { 
			$ao['ao'] = $_POST['ao'];
            $ao['ao']['service_type'] = 'Amendment - Others'; 
			$ao['ao']['servicetype_additionalsubservice'] = '1';
              if(!empty($ao['ao'])) 
			{
		    $c=count($ao['ao']['go_notification_dh_no']); 
			$c1=count($ao['ao']['gov_act_dh_no']); 
			$c2=count($ao['ao']['gov_act_first_dh_no']); 
			$c3=count($ao['ao']['gov_act_second_dh_no']); 
			$c4=count($ao['ao']['uksw_act_dh_no']); 
			$c5=count($ao['ao']['uksw_act_first_dh_no']); 
			$c6=count($ao['ao']['uksw_act_second_dh_no']); 
			$c7=count($ao['ao']['ukrts_act_dh_no']); 
			$c8=count($ao['ao']['ukrts_act_first_dh_no']); 
			$c9=count($ao['ao']['ukrts_act_second_dh_no']);
			$go_notification=array();
			for($j=0;$j<$c;$j++)
			{
				 $go_notification[$j]['go_notification_dh_no'] = $ao['ao']['go_notification_dh_no'][$j];
				 $go_notification[$j]['go_notification_dh'] = $ao['ao']['go_notification_dh'][$j];
				 $go_notification[$j]['go_notification_condition'] = $ao['ao']['go_notification_condition'][$j];
				 
			 } 
			 $ao['ao']['go_notification']=json_encode($go_notification);
			 $gov_act=array();
			 for($j=0;$j<$c1;$j++)
	         {
				$gov_act[$j]['gov_act_dh_no'] = $ao['ao']['gov_act_dh_no'][$j];
				 $gov_act[$j]['gov_act_dh'] = $ao['ao']['gov_act_dh'][$j];
				 $gov_act[$j]['gov_act_condition'] = $ao['ao']['gov_act_condition'][$j];
			 }
			 $ao['ao']['gov_act']=json_encode($gov_act);
			 $gov_act_first=array();
			  for($j=0;$j<$c2;$j++)
			{    
			     $gov_act_first[$j]['gov_act_first_dh_no'] = $ao['ao']['gov_act_first_dh_no'][$j];
				 $gov_act_first[$j]['gov_act_first_dh'] = $ao['ao']['gov_act_first_dh'][$j];
				 $gov_act_first[$j]['gov_act_first_condition'] = $ao['ao']['gov_act_first_condition'][$j];
			 }
		     $ao['ao']['gov_act_first']=json_encode($gov_act_first);
			 $gov_act_second=array();
			  for($j=0;$j<$c3;$j++)
			{    
			     $gov_act_second[$j]['gov_act_second_dh_no'] = $ao['ao']['gov_act_second_dh_no'][$j];
				 $gov_act_second[$j]['gov_act_second_dh'] = $ao['ao']['gov_act_second_dh'][$j];
				 $gov_act_second[$j]['gov_act_second_condition'] = $ao['ao']['gov_act_second_condition'][$j];
			 }
		     $ao['ao']['gov_act_second']=json_encode($gov_act_second);
			
             }
			////////////////////////////////Amendment - Others Uksw///////////////////////////
			 $uksw_act=array();
			 for($j=0;$j<$c4;$j++)
	         {
				$uksw_act[$j]['uksw_act_dh_no'] = $ao['ao']['uksw_act_dh_no'][$j];
				 $uksw_act[$j]['uksw_act_dh'] = $ao['ao']['uksw_act_dh'][$j];
				 $uksw_act[$j]['uksw_act_condition'] = $ao['ao']['uksw_act_condition'][$j];
			 }
			 $ao['ao']['uksw_act']="'".json_encode($uksw_act)."'";
			 $uksw_act_first=array();
			  for($j=0;$j<$c5;$j++)
			{    
			     $uksw_act_first[$j]['uksw_act_first_dh_no'] = $ao['ao']['uksw_act_first_dh_no'][$j];
				 $uksw_act_first[$j]['uksw_act_first_dh'] = $ao['ao']['uksw_act_first_dh'][$j];
				 $uksw_act_first[$j]['uksw_act_first_condition'] = $ao['ao']['uksw_act_first_condition'][$j];
			 }
		     $ao['ao']['uksw_act_first']="'".json_encode($uksw_act_first)."'";
			 $uksw_act_second=array();
			  for($j=0;$j<$c6;$j++)
			{    
			     $uksw_act_second[$j]['uksw_act_second_dh_no'] = $ao['ao']['uksw_act_second_dh_no'][$j];
				 $uksw_act_second[$j]['uksw_act_second_dh'] = $ao['ao']['uksw_act_second_dh'][$j];
				 $uksw_act_second[$j]['uksw_act_second_condition'] = $ao['ao']['uksw_act_second_condition'][$j];
			 }
		     $ao['ao']['uksw_act_second']="'".json_encode($uksw_act_second)."'";
			 
			  ////////////////////////////////Amendment - Others UkRTS///////////////////////////
			 $ukrts_act=array();
			 for($j=0;$j<$c7;$j++)
	         {
				$ukrts_act[$j]['ukrts_act_dh_no'] = $ao['ao']['ukrts_act_dh_no'][$j];
				 $ukrts_act[$j]['ukrts_act_dh'] = $ao['ao']['ukrts_act_dh'][$j];
				 $ukrts_act[$j]['ukrts_act_condition'] = $ao['ao']['ukrts_act_condition'][$j];
			 }
			 $ao['ao']['ukrts_act']="'".json_encode($ukrts_act)."'";
			 $ukrts_act_first=array();
			  for($j=0;$j<$c8;$j++)
			{    
			     $ukrts_act_first[$j]['ukrts_act_first_dh_no'] = $ao['ao']['ukrts_act_first_dh_no'][$j];
				 $ukrts_act_first[$j]['ukrts_act_first_dh'] = $ao['ao']['ukrts_act_first_dh'][$j];
				 $ukrts_act_first[$j]['ukrts_act_first_condition'] = $ao['ao']['ukrts_act_first_condition'][$j];
			 }
		     $ao['ao']['ukrts_act_first']="'".json_encode($ukrts_act_first)."'";
			 $ukrts_act_second=array();
			  for($j=0;$j<$c9;$j++)
			{    
			     $ukrts_act_second[$j]['ukrts_act_second_dh_no'] = $ao['ao']['ukrts_act_second_dh_no'][$j];
				 $ukrts_act_second[$j]['ukrts_act_second_dh'] = $ao['ao']['ukrts_act_second_dh'][$j];
				 $ukrts_act_second[$j]['ukrts_act_second_condition'] = $ao['ao']['ukrts_act_second_condition'][$j];
			 }
		     $ao['ao']['ukrts_act_second']="'".json_encode($ukrts_act_second)."'";
			 ////////////////////////////////////////////////////////////
			$data[] = $ao['ao'];
			}
		///////////////////////////Amendment - Others End//////////////////////////////
		
		 ///////////////////////////Amendment - Cancellation 2////////////////////////////// servicetype_additionalsubservice
			 if (in_array('Amendment - Cancellation', $serviceType)) { 
			$ac['ac'] = $_POST['ac'];
            $ac['ac']['service_type'] = 'Amendment - Cancellation'; 
			$ac['ac']['servicetype_additionalsubservice'] = '2'; 
              if(!empty($ac['ac'])) 
			{
		    $c=count($ac['ac']['go_notification_dh_no']); 
			$c1=count($ac['ac']['gov_act_dh_no']); 
			$c2=count($ac['ac']['gov_act_first_dh_no']); 
			$c3=count($ac['ac']['gov_act_second_dh_no']); 
			$c4=count($ac['ac']['uksw_act_dh_no']); 
			$c5=count($ac['ac']['uksw_act_first_dh_no']); 
			$c6=count($ac['ac']['uksw_act_second_dh_no']); 
			$c7=count($ac['ac']['ukrts_act_dh_no']); 
			$c8=count($ac['ac']['ukrts_act_first_dh_no']); 
			$c9=count($ac['ac']['ukrts_act_second_dh_no']);
			$go_notification=array();
			for($j=0;$j<$c;$j++)
			{
				 $go_notification[$j]['go_notification_dh_no'] = $ac['ac']['go_notification_dh_no'][$j];
				 $go_notification[$j]['go_notification_dh'] = $ac['ac']['go_notification_dh'][$j];
				 $go_notification[$j]['go_notification_condition'] = $ac['ac']['go_notification_condition'][$j];
				 
			 } 
			 $ac['ac']['go_notification']=json_encode($go_notification);
			 $gov_act=array();
			 for($j=0;$j<$c1;$j++)
	         {
				$gov_act[$j]['gov_act_dh_no'] = $ac['ac']['gov_act_dh_no'][$j];
				 $gov_act[$j]['gov_act_dh'] = $ac['ac']['gov_act_dh'][$j];
				 $gov_act[$j]['gov_act_condition'] = $ac['ac']['gov_act_condition'][$j];
			 }
			 $ac['ac']['gov_act']=json_encode($gov_act);
			 $gov_act_first=array();
			  for($j=0;$j<$c2;$j++)
			{    
			     $gov_act_first[$j]['gov_act_first_dh_no'] = $ac['ac']['gov_act_first_dh_no'][$j];
				 $gov_act_first[$j]['gov_act_first_dh'] = $ac['ac']['gov_act_first_dh'][$j];
				 $gov_act_first[$j]['gov_act_first_condition'] = $ac['ac']['gov_act_first_condition'][$j];
			 }
		     $ac['ac']['gov_act_first']=json_encode($gov_act_first);
			 $gov_act_second=array();
			  for($j=0;$j<$c3;$j++)
			{    
			     $gov_act_second[$j]['gov_act_second_dh_no'] = $ac['ac']['gov_act_second_dh_no'][$j];
				 $gov_act_second[$j]['gov_act_second_dh'] = $ac['ac']['gov_act_second_dh'][$j];
				 $gov_act_second[$j]['gov_act_second_condition'] = $ac['ac']['gov_act_second_condition'][$j];
			 }
		     $ac['ac']['gov_act_second']=json_encode($gov_act_second);
			
             }
			////////////////////////////////Amendment - Cancellation Uksw///////////////////////////
			 $uksw_act=array();
			 for($j=0;$j<$c4;$j++)
	         {
				$uksw_act[$j]['uksw_act_dh_no'] = $ac['ac']['uksw_act_dh_no'][$j];
				 $uksw_act[$j]['uksw_act_dh'] = $ac['ac']['uksw_act_dh'][$j];
				 $uksw_act[$j]['uksw_act_condition'] = $ac['ac']['uksw_act_condition'][$j];
			 }
			 $ac['ac']['uksw_act']="'".json_encode($uksw_act)."'";
			 $uksw_act_first=array();
			  for($j=0;$j<$c5;$j++)
			{    
			     $uksw_act_first[$j]['uksw_act_first_dh_no'] = $ac['ac']['uksw_act_first_dh_no'][$j];
				 $uksw_act_first[$j]['uksw_act_first_dh'] = $ac['ac']['uksw_act_first_dh'][$j];
				 $uksw_act_first[$j]['uksw_act_first_condition'] = $ac['ac']['uksw_act_first_condition'][$j];
			 }
		     $ac['ac']['uksw_act_first']="'".json_encode($uksw_act_first)."'";
			 $uksw_act_second=array();
			  for($j=0;$j<$c6;$j++)
			{    
			     $uksw_act_second[$j]['uksw_act_second_dh_no'] = $ac['ac']['uksw_act_second_dh_no'][$j];
				 $uksw_act_second[$j]['uksw_act_second_dh'] = $ac['ac']['uksw_act_second_dh'][$j];
				 $uksw_act_second[$j]['uksw_act_second_condition'] = $ac['ac']['uksw_act_second_condition'][$j];
			 }
		     $ac['ac']['uksw_act_second']="'".json_encode($uksw_act_second)."'";
			 
			  ////////////////////////////////Amendment - Cancellation UkRTS///////////////////////////
			 $ukrts_act=array();
			 for($j=0;$j<$c7;$j++)
	         {
				$ukrts_act[$j]['ukrts_act_dh_no'] = $ac['ac']['ukrts_act_dh_no'][$j];
				 $ukrts_act[$j]['ukrts_act_dh'] = $ac['ac']['ukrts_act_dh'][$j];
				 $ukrts_act[$j]['ukrts_act_condition'] = $ac['ac']['ukrts_act_condition'][$j];
			 }
			 $ac['ac']['ukrts_act']="'".json_encode($ukrts_act)."'";
			 $ukrts_act_first=array();
			  for($j=0;$j<$c8;$j++)
			{    
			     $ukrts_act_first[$j]['ukrts_act_first_dh_no'] = $ac['ac']['ukrts_act_first_dh_no'][$j];
				 $ukrts_act_first[$j]['ukrts_act_first_dh'] = $ac['ac']['ukrts_act_first_dh'][$j];
				 $ukrts_act_first[$j]['ukrts_act_first_condition'] = $ac['ac']['ukrts_act_first_condition'][$j];
			 }
		     $ac['ac']['ukrts_act_first']="'".json_encode($ukrts_act_first)."'";
			 $ukrts_act_second=array();
			  for($j=0;$j<$c9;$j++)
			{    
			     $ukrts_act_second[$j]['ukrts_act_second_dh_no'] = $ac['ac']['ukrts_act_second_dh_no'][$j];
				 $ukrts_act_second[$j]['ukrts_act_second_dh'] = $ac['ac']['ukrts_act_second_dh'][$j];
				 $ukrts_act_second[$j]['ukrts_act_second_condition'] = $ac['ac']['ukrts_act_second_condition'][$j];
			 }
		     $ac['ac']['ukrts_act_second']="'".json_encode($ukrts_act_second)."'";
			 ////////////////////////////////////////////////////////////
			$data[] = $ac['ac'];
			}
		///////////////////////////Amendment - Cancellation End//////////////////////////////
		
		 ///////////////////////////Amendment - Surrender 3////////////////////////////// 
			 if (in_array('Amendment - Surrender', $serviceType)) { 
			$as['as'] = $_POST['as'];
            $as['as']['service_type'] = 'Amendment - Surrender'; 
			 $as['as']['servicetype_additionalsubservice'] = '3'; 
              if(!empty($as['as'])) 
			{
		    $c=count($as['as']['go_notification_dh_no']); 
			$c1=count($as['as']['gov_act_dh_no']); 
			$c2=count($as['as']['gov_act_first_dh_no']); 
			$c3=count($as['as']['gov_act_second_dh_no']); 
			$c4=count($as['as']['uksw_act_dh_no']); 
			$c5=count($as['as']['uksw_act_first_dh_no']); 
			$c6=count($as['as']['uksw_act_second_dh_no']); 
			$c7=count($as['as']['ukrts_act_dh_no']); 
			$c8=count($as['as']['ukrts_act_first_dh_no']); 
			$c9=count($as['as']['ukrts_act_second_dh_no']);
			$go_notification=array();
			for($j=0;$j<$c;$j++)
			{
				 $go_notification[$j]['go_notification_dh_no'] = $as['as']['go_notification_dh_no'][$j];
				 $go_notification[$j]['go_notification_dh'] = $as['as']['go_notification_dh'][$j];
				 $go_notification[$j]['go_notification_condition'] = $as['as']['go_notification_condition'][$j];
				 
			 } 
			 $as['as']['go_notification']=json_encode($go_notification);
			 $gov_act=array();
			 for($j=0;$j<$c1;$j++)
	         {
				$gov_act[$j]['gov_act_dh_no'] = $as['as']['gov_act_dh_no'][$j];
				 $gov_act[$j]['gov_act_dh'] = $as['as']['gov_act_dh'][$j];
				 $gov_act[$j]['gov_act_condition'] = $as['as']['gov_act_condition'][$j];
			 }
			 $as['as']['gov_act']=json_encode($gov_act);
			 $gov_act_first=array();
			  for($j=0;$j<$c2;$j++)
			{    
			     $gov_act_first[$j]['gov_act_first_dh_no'] = $as['as']['gov_act_first_dh_no'][$j];
				 $gov_act_first[$j]['gov_act_first_dh'] = $as['as']['gov_act_first_dh'][$j];
				 $gov_act_first[$j]['gov_act_first_condition'] = $as['as']['gov_act_first_condition'][$j];
			 }
		     $as['as']['gov_act_first']=json_encode($gov_act_first);
			 $gov_act_second=array();
			  for($j=0;$j<$c3;$j++)
			{    
			     $gov_act_second[$j]['gov_act_second_dh_no'] = $as['as']['gov_act_second_dh_no'][$j];
				 $gov_act_second[$j]['gov_act_second_dh'] = $as['as']['gov_act_second_dh'][$j];
				 $gov_act_second[$j]['gov_act_second_condition'] = $as['as']['gov_act_second_condition'][$j];
			 }
		     $as['as']['gov_act_second']=json_encode($gov_act_second);
			
             }
			////////////////////////////////Amendment - Surrender Uksw///////////////////////////
			 $uksw_act=array();
			 for($j=0;$j<$c4;$j++)
	         {
				$uksw_act[$j]['uksw_act_dh_no'] = $as['as']['uksw_act_dh_no'][$j];
				 $uksw_act[$j]['uksw_act_dh'] = $as['as']['uksw_act_dh'][$j];
				 $uksw_act[$j]['uksw_act_condition'] = $as['as']['uksw_act_condition'][$j];
			 }
			 $as['as']['uksw_act']="'".json_encode($uksw_act)."'";
			 $uksw_act_first=array();
			  for($j=0;$j<$c5;$j++)
			{    
			     $uksw_act_first[$j]['uksw_act_first_dh_no'] = $as['as']['uksw_act_first_dh_no'][$j];
				 $uksw_act_first[$j]['uksw_act_first_dh'] = $as['as']['uksw_act_first_dh'][$j];
				 $uksw_act_first[$j]['uksw_act_first_condition'] = $as['as']['uksw_act_first_condition'][$j];
			 }
		     $as['as']['uksw_act_first']="'".json_encode($uksw_act_first)."'";
			 $uksw_act_second=array();
			  for($j=0;$j<$c6;$j++)
			{    
			     $uksw_act_second[$j]['uksw_act_second_dh_no'] = $as['as']['uksw_act_second_dh_no'][$j];
				 $uksw_act_second[$j]['uksw_act_second_dh'] = $as['as']['uksw_act_second_dh'][$j];
				 $uksw_act_second[$j]['uksw_act_second_condition'] = $as['as']['uksw_act_second_condition'][$j];
			 }
		     $as['as']['uksw_act_second']="'".json_encode($uksw_act_second)."'";
			 
			  ////////////////////////////////Amendment - Surrender UkRTS///////////////////////////
			 $ukrts_act=array();
			 for($j=0;$j<$c7;$j++)
	         {
				$ukrts_act[$j]['ukrts_act_dh_no'] = $as['as']['ukrts_act_dh_no'][$j];
				 $ukrts_act[$j]['ukrts_act_dh'] = $as['as']['ukrts_act_dh'][$j];
				 $ukrts_act[$j]['ukrts_act_condition'] = $as['as']['ukrts_act_condition'][$j];
			 }
			 $as['as']['ukrts_act']="'".json_encode($ukrts_act)."'";
			 $ukrts_act_first=array();
			  for($j=0;$j<$c8;$j++)
			{    
			     $ukrts_act_first[$j]['ukrts_act_first_dh_no'] = $as['as']['ukrts_act_first_dh_no'][$j];
				 $ukrts_act_first[$j]['ukrts_act_first_dh'] = $as['as']['ukrts_act_first_dh'][$j];
				 $ukrts_act_first[$j]['ukrts_act_first_condition'] = $as['as']['ukrts_act_first_condition'][$j];
			 }
		     $as['as']['ukrts_act_first']="'".json_encode($ukrts_act_first)."'";
			 $ukrts_act_second=array();
			  for($j=0;$j<$c9;$j++)
			{    
			     $ukrts_act_second[$j]['ukrts_act_second_dh_no'] = $as['as']['ukrts_act_second_dh_no'][$j];
				 $ukrts_act_second[$j]['ukrts_act_second_dh'] = $as['as']['ukrts_act_second_dh'][$j];
				 $ukrts_act_second[$j]['ukrts_act_second_condition'] = $as['as']['ukrts_act_second_condition'][$j];
			 }
		     $as['as']['ukrts_act_second']="'".json_encode($ukrts_act_second)."'";
			 ////////////////////////////////////////////////////////////
			$data[] = $as['as'];
			}
		///////////////////////////Amendment - Surrender End//////////////////////////////
		
		 ///////////////////////////Amendment - Transfer 4////////////////////////////// 
			 if (in_array('Amendment - Transfer', $serviceType)) { 
			$at['at'] = $_POST['at'];
            $at['at']['service_type'] = 'Amendment - Transfer'; 
			$at['at']['servicetype_additionalsubservice'] = '4'; 
              if(!empty($at['at'])) 
			{
		    $c=count($at['at']['go_notification_dh_no']); 
			$c1=count($at['at']['gov_act_dh_no']); 
			$c2=count($at['at']['gov_act_first_dh_no']); 
			$c3=count($at['at']['gov_act_second_dh_no']); 
			$c4=count($at['at']['uksw_act_dh_no']); 
			$c5=count($at['at']['uksw_act_first_dh_no']); 
			$c6=count($at['at']['uksw_act_second_dh_no']); 
			$c7=count($at['at']['ukrts_act_dh_no']); 
			$c8=count($at['at']['ukrts_act_first_dh_no']); 
			$c9=count($at['at']['ukrts_act_second_dh_no']);
			$go_notification=array();
			for($j=0;$j<$c;$j++)
			{
				 $go_notification[$j]['go_notification_dh_no'] = $at['at']['go_notification_dh_no'][$j];
				 $go_notification[$j]['go_notification_dh'] = $at['at']['go_notification_dh'][$j];
				 $go_notification[$j]['go_notification_condition'] = $at['at']['go_notification_condition'][$j];
				 
			 } 
			 $at['at']['go_notification']=json_encode($go_notification);
			 $gov_act=array();
			 for($j=0;$j<$c1;$j++)
	         {
				$gov_act[$j]['gov_act_dh_no'] = $at['at']['gov_act_dh_no'][$j];
				 $gov_act[$j]['gov_act_dh'] = $at['at']['gov_act_dh'][$j];
				 $gov_act[$j]['gov_act_condition'] = $at['at']['gov_act_condition'][$j];
			 }
			 $at['at']['gov_act']=json_encode($gov_act);
			 $gov_act_first=array();
			  for($j=0;$j<$c2;$j++)
			{    
			     $gov_act_first[$j]['gov_act_first_dh_no'] = $at['at']['gov_act_first_dh_no'][$j];
				 $gov_act_first[$j]['gov_act_first_dh'] = $at['at']['gov_act_first_dh'][$j];
				 $gov_act_first[$j]['gov_act_first_condition'] = $at['at']['gov_act_first_condition'][$j];
			 }
		     $at['at']['gov_act_first']=json_encode($gov_act_first);
			 $gov_act_second=array();
			  for($j=0;$j<$c3;$j++)
			{    
			     $gov_act_second[$j]['gov_act_second_dh_no'] = $at['at']['gov_act_second_dh_no'][$j];
				 $gov_act_second[$j]['gov_act_second_dh'] = $at['at']['gov_act_second_dh'][$j];
				 $gov_act_second[$j]['gov_act_second_condition'] = $at['at']['gov_act_second_condition'][$j];
			 }
		     $at['at']['gov_act_second']=json_encode($gov_act_second);
			
             }
			////////////////////////////////Amendment - Transfer Uksw///////////////////////////
			 $uksw_act=array();
			 for($j=0;$j<$c4;$j++)
	         {
				$uksw_act[$j]['uksw_act_dh_no'] = $at['at']['uksw_act_dh_no'][$j];
				 $uksw_act[$j]['uksw_act_dh'] = $at['at']['uksw_act_dh'][$j];
				 $uksw_act[$j]['uksw_act_condition'] = $at['at']['uksw_act_condition'][$j];
			 }
			 $at['at']['uksw_act']="'".json_encode($uksw_act)."'";
			 $uksw_act_first=array();
			  for($j=0;$j<$c5;$j++)
			{    
			     $uksw_act_first[$j]['uksw_act_first_dh_no'] = $at['at']['uksw_act_first_dh_no'][$j];
				 $uksw_act_first[$j]['uksw_act_first_dh'] = $at['at']['uksw_act_first_dh'][$j];
				 $uksw_act_first[$j]['uksw_act_first_condition'] = $at['at']['uksw_act_first_condition'][$j];
			 }
		     $at['at']['uksw_act_first']="'".json_encode($uksw_act_first)."'";
			 $uksw_act_second=array();
			  for($j=0;$j<$c6;$j++)
			{    
			     $uksw_act_second[$j]['uksw_act_second_dh_no'] = $at['at']['uksw_act_second_dh_no'][$j];
				 $uksw_act_second[$j]['uksw_act_second_dh'] = $at['at']['uksw_act_second_dh'][$j];
				 $uksw_act_second[$j]['uksw_act_second_condition'] = $at['at']['uksw_act_second_condition'][$j];
			 }
		     $at['at']['uksw_act_second']="'".json_encode($uksw_act_second)."'";
			 
			  ////////////////////////////////Amendment - Transfer UkRTS///////////////////////////
			 $ukrts_act=array();
			 for($j=0;$j<$c7;$j++)
	         {
				$ukrts_act[$j]['ukrts_act_dh_no'] = $at['at']['ukrts_act_dh_no'][$j];
				 $ukrts_act[$j]['ukrts_act_dh'] = $at['at']['ukrts_act_dh'][$j];
				 $ukrts_act[$j]['ukrts_act_condition'] = $at['at']['ukrts_act_condition'][$j];
			 }
			 $at['at']['ukrts_act']="'".json_encode($ukrts_act)."'";
			 $ukrts_act_first=array();
			  for($j=0;$j<$c8;$j++)
			{    
			     $ukrts_act_first[$j]['ukrts_act_first_dh_no'] = $at['at']['ukrts_act_first_dh_no'][$j];
				 $ukrts_act_first[$j]['ukrts_act_first_dh'] = $at['at']['ukrts_act_first_dh'][$j];
				 $ukrts_act_first[$j]['ukrts_act_first_condition'] = $at['at']['ukrts_act_first_condition'][$j];
			 }
		     $at['at']['ukrts_act_first']="'".json_encode($ukrts_act_first)."'";
			 $ukrts_act_second=array();
			  for($j=0;$j<$c9;$j++)
			{    
			     $ukrts_act_second[$j]['ukrts_act_second_dh_no'] = $at['at']['ukrts_act_second_dh_no'][$j];
				 $ukrts_act_second[$j]['ukrts_act_second_dh'] = $at['at']['ukrts_act_second_dh'][$j];
				 $ukrts_act_second[$j]['ukrts_act_second_condition'] = $at['at']['ukrts_act_second_condition'][$j];
			 }
		     $at['at']['ukrts_act_second']="'".json_encode($ukrts_act_second)."'";
			 ////////////////////////////////////////////////////////////
			$data[] = $at['at'];
			}
		///////////////////////////Amendment - Transfer End//////////////////////////////
		
		 ///////////////////////////Duplicate Copy 5////////////////////////////// 
			 if (in_array('Duplicate Copy', $serviceType)) { 
			$duplicate['duplicate'] = $_POST['duplicate'];
            $duplicate['duplicate']['service_type'] = 'Duplicate Copy'; 
			$duplicate['duplicate']['servicetype_additionalsubservice'] = '5';
              if(!empty($duplicate['duplicate'])) 
			{
		    $c=count($duplicate['duplicate']['go_notification_dh_no']); 
			$c1=count($duplicate['duplicate']['gov_act_dh_no']); 
			$c2=count($duplicate['duplicate']['gov_act_first_dh_no']); 
			$c3=count($duplicate['duplicate']['gov_act_second_dh_no']); 
			$c4=count($duplicate['duplicate']['uksw_act_dh_no']); 
			$c5=count($duplicate['duplicate']['uksw_act_first_dh_no']); 
			$c6=count($duplicate['duplicate']['uksw_act_second_dh_no']); 
			$c7=count($duplicate['duplicate']['ukrts_act_dh_no']); 
			$c8=count($duplicate['duplicate']['ukrts_act_first_dh_no']); 
			$c9=count($duplicate['duplicate']['ukrts_act_second_dh_no']);
			$go_notification=array();
			for($j=0;$j<$c;$j++)
			{
				 $go_notification[$j]['go_notification_dh_no'] = $duplicate['duplicate']['go_notification_dh_no'][$j];
				 $go_notification[$j]['go_notification_dh'] = $duplicate['duplicate']['go_notification_dh'][$j];
				 $go_notification[$j]['go_notification_condition'] = $duplicate['duplicate']['go_notification_condition'][$j];
				 
			 } 
			 $duplicate['duplicate']['go_notification']=json_encode($go_notification);
			 $gov_act=array();
			 for($j=0;$j<$c1;$j++)
	         {
				$gov_act[$j]['gov_act_dh_no'] = $duplicate['duplicate']['gov_act_dh_no'][$j];
				 $gov_act[$j]['gov_act_dh'] = $duplicate['duplicate']['gov_act_dh'][$j];
				 $gov_act[$j]['gov_act_condition'] = $duplicate['duplicate']['gov_act_condition'][$j];
			 }
			 $duplicate['duplicate']['gov_act']=json_encode($gov_act);
			 $gov_act_first=array();
			  for($j=0;$j<$c2;$j++)
			{    
			     $gov_act_first[$j]['gov_act_first_dh_no'] = $duplicate['duplicate']['gov_act_first_dh_no'][$j];
				 $gov_act_first[$j]['gov_act_first_dh'] = $duplicate['duplicate']['gov_act_first_dh'][$j];
				 $gov_act_first[$j]['gov_act_first_condition'] = $duplicate['duplicate']['gov_act_first_condition'][$j];
			 }
		     $duplicate['duplicate']['gov_act_first']=json_encode($gov_act_first);
			 $gov_act_second=array();
			  for($j=0;$j<$c3;$j++)
			{    
			     $gov_act_second[$j]['gov_act_second_dh_no'] = $duplicate['duplicate']['gov_act_second_dh_no'][$j];
				 $gov_act_second[$j]['gov_act_second_dh'] = $duplicate['duplicate']['gov_act_second_dh'][$j];
				 $gov_act_second[$j]['gov_act_second_condition'] = $duplicate['duplicate']['gov_act_second_condition'][$j];
			 }
		     $duplicate['duplicate']['gov_act_second']=json_encode($gov_act_second);
			
             }
			////////////////////////////////Duplicate Copy Uksw///////////////////////////
			 $uksw_act=array();
			 for($j=0;$j<$c4;$j++)
	         {
				$uksw_act[$j]['uksw_act_dh_no'] = $duplicate['duplicate']['uksw_act_dh_no'][$j];
				 $uksw_act[$j]['uksw_act_dh'] = $duplicate['duplicate']['uksw_act_dh'][$j];
				 $uksw_act[$j]['uksw_act_condition'] = $duplicate['duplicate']['uksw_act_condition'][$j];
			 }
			 $duplicate['duplicate']['uksw_act']="'".json_encode($uksw_act)."'";
			 $uksw_act_first=array();
			  for($j=0;$j<$c5;$j++)
			{    
			     $uksw_act_first[$j]['uksw_act_first_dh_no'] = $duplicate['duplicate']['uksw_act_first_dh_no'][$j];
				 $uksw_act_first[$j]['uksw_act_first_dh'] = $duplicate['duplicate']['uksw_act_first_dh'][$j];
				 $uksw_act_first[$j]['uksw_act_first_condition'] = $duplicate['duplicate']['uksw_act_first_condition'][$j];
			 }
		     $duplicate['duplicate']['uksw_act_first']="'".json_encode($uksw_act_first)."'";
			 $uksw_act_second=array();
			  for($j=0;$j<$c6;$j++)
			{    
			     $uksw_act_second[$j]['uksw_act_second_dh_no'] = $duplicate['duplicate']['uksw_act_second_dh_no'][$j];
				 $uksw_act_second[$j]['uksw_act_second_dh'] = $duplicate['duplicate']['uksw_act_second_dh'][$j];
				 $uksw_act_second[$j]['uksw_act_second_condition'] = $duplicate['duplicate']['uksw_act_second_condition'][$j];
			 }
		     $duplicate['duplicate']['uksw_act_second']="'".json_encode($uksw_act_second)."'";
			 
			  ////////////////////////////////Duplicate Copy UkRTS///////////////////////////
			 $ukrts_act=array();
			 for($j=0;$j<$c7;$j++)
	         {
				$ukrts_act[$j]['ukrts_act_dh_no'] = $duplicate['duplicate']['ukrts_act_dh_no'][$j];
				 $ukrts_act[$j]['ukrts_act_dh'] = $duplicate['duplicate']['ukrts_act_dh'][$j];
				 $ukrts_act[$j]['ukrts_act_condition'] = $duplicate['duplicate']['ukrts_act_condition'][$j];
			 }
			 $duplicate['duplicate']['ukrts_act']="'".json_encode($ukrts_act)."'";
			 $ukrts_act_first=array();
			  for($j=0;$j<$c8;$j++)
			{    
			     $ukrts_act_first[$j]['ukrts_act_first_dh_no'] = $duplicate['duplicate']['ukrts_act_first_dh_no'][$j];
				 $ukrts_act_first[$j]['ukrts_act_first_dh'] = $duplicate['duplicate']['ukrts_act_first_dh'][$j];
				 $ukrts_act_first[$j]['ukrts_act_first_condition'] = $duplicate['duplicate']['ukrts_act_first_condition'][$j];
			 }
		     $duplicate['duplicate']['ukrts_act_first']="'".json_encode($ukrts_act_first)."'";
			 $ukrts_act_second=array();
			  for($j=0;$j<$c9;$j++)
			{    
			     $ukrts_act_second[$j]['ukrts_act_second_dh_no'] = $duplicate['duplicate']['ukrts_act_second_dh_no'][$j];
				 $ukrts_act_second[$j]['ukrts_act_second_dh'] = $duplicate['duplicate']['ukrts_act_second_dh'][$j];
				 $ukrts_act_second[$j]['ukrts_act_second_condition'] = $duplicate['duplicate']['ukrts_act_second_condition'][$j];
			 }
		     $duplicate['duplicate']['ukrts_act_second']="'".json_encode($ukrts_act_second)."'";
			 ////////////////////////////////////////////////////////////
			$data[] = $duplicate['duplicate'];
			}
		///////////////////////////Duplicate Copy End//////////////////////////////
		
		 ///////////////////////////Renewal 6//////////////////////////////
			 if (in_array('Renewal', $serviceType)) { 
			$renewal['renewal'] = $_POST['renewal'];
            $renewal['renewal']['service_type'] = 'Renewal'; 
			$renewal['renewal']['servicetype_additionalsubservice'] = '6'; 
              if(!empty($renewal['renewal'])) 
			{
		    $c=count($renewal['renewal']['go_notification_dh_no']); 
			$c1=count($renewal['renewal']['gov_act_dh_no']); 
			$c2=count($renewal['renewal']['gov_act_first_dh_no']); 
			$c3=count($renewal['renewal']['gov_act_second_dh_no']); 
			$c4=count($renewal['renewal']['uksw_act_dh_no']); 
			$c5=count($renewal['renewal']['uksw_act_first_dh_no']); 
			$c6=count($renewal['renewal']['uksw_act_second_dh_no']); 
			$c7=count($renewal['renewal']['ukrts_act_dh_no']); 
			$c8=count($renewal['renewal']['ukrts_act_first_dh_no']); 
			$c9=count($renewal['renewal']['ukrts_act_second_dh_no']);
			$go_notification=array();
			for($j=0;$j<$c;$j++)
			{
				 $go_notification[$j]['go_notification_dh_no'] = $renewal['renewal']['go_notification_dh_no'][$j];
				 $go_notification[$j]['go_notification_dh'] = $renewal['renewal']['go_notification_dh'][$j];
				 $go_notification[$j]['go_notification_condition'] = $renewal['renewal']['go_notification_condition'][$j];
				 
			 } 
			 $renewal['renewal']['go_notification']=json_encode($go_notification);
			 $gov_act=array();
			 for($j=0;$j<$c1;$j++)
	         {
				$gov_act[$j]['gov_act_dh_no'] = $renewal['renewal']['gov_act_dh_no'][$j];
				 $gov_act[$j]['gov_act_dh'] = $renewal['renewal']['gov_act_dh'][$j];
				 $gov_act[$j]['gov_act_condition'] = $renewal['renewal']['gov_act_condition'][$j];
			 }
			 $renewal['renewal']['gov_act']=json_encode($gov_act);
			 $gov_act_first=array();
			  for($j=0;$j<$c2;$j++)
			{    
			     $gov_act_first[$j]['gov_act_first_dh_no'] = $renewal['renewal']['gov_act_first_dh_no'][$j];
				 $gov_act_first[$j]['gov_act_first_dh'] = $renewal['renewal']['gov_act_first_dh'][$j];
				 $gov_act_first[$j]['gov_act_first_condition'] = $renewal['renewal']['gov_act_first_condition'][$j];
			 }
		     $renewal['renewal']['gov_act_first']=json_encode($gov_act_first);
			 $gov_act_second=array();
			  for($j=0;$j<$c3;$j++)
			{    
			     $gov_act_second[$j]['gov_act_second_dh_no'] = $renewal['renewal']['gov_act_second_dh_no'][$j];
				 $gov_act_second[$j]['gov_act_second_dh'] = $renewal['renewal']['gov_act_second_dh'][$j];
				 $gov_act_second[$j]['gov_act_second_condition'] = $renewal['renewal']['gov_act_second_condition'][$j];
			 }
		     $renewal['renewal']['gov_act_second']=json_encode($gov_act_second);
			
             }
			////////////////////////////////Renewal Uksw///////////////////////////
			 $uksw_act=array();
			 for($j=0;$j<$c4;$j++)
	         {
				$uksw_act[$j]['uksw_act_dh_no'] = $renewal['renewal']['uksw_act_dh_no'][$j];
				 $uksw_act[$j]['uksw_act_dh'] = $renewal['renewal']['uksw_act_dh'][$j];
				 $uksw_act[$j]['uksw_act_condition'] = $renewal['renewal']['uksw_act_condition'][$j];
			 }
			 $renewal['renewal']['uksw_act']="'".json_encode($uksw_act)."'";
			 $uksw_act_first=array();
			  for($j=0;$j<$c5;$j++)
			{    
			     $uksw_act_first[$j]['uksw_act_first_dh_no'] = $renewal['renewal']['uksw_act_first_dh_no'][$j];
				 $uksw_act_first[$j]['uksw_act_first_dh'] = $renewal['renewal']['uksw_act_first_dh'][$j];
				 $uksw_act_first[$j]['uksw_act_first_condition'] = $renewal['renewal']['uksw_act_first_condition'][$j];
			 }
		     $renewal['renewal']['uksw_act_first']="'".json_encode($uksw_act_first)."'";
			 $uksw_act_second=array();
			  for($j=0;$j<$c6;$j++)
			{    
			     $uksw_act_second[$j]['uksw_act_second_dh_no'] = $renewal['renewal']['uksw_act_second_dh_no'][$j];
				 $uksw_act_second[$j]['uksw_act_second_dh'] = $renewal['renewal']['uksw_act_second_dh'][$j];
				 $uksw_act_second[$j]['uksw_act_second_condition'] = $renewal['renewal']['uksw_act_second_condition'][$j];
			 }
		     $renewal['renewal']['uksw_act_second']="'".json_encode($uksw_act_second)."'";
			 
			  ////////////////////////////////Renewal UkRTS///////////////////////////
			 $ukrts_act=array();
			 for($j=0;$j<$c7;$j++)
	         {
				$ukrts_act[$j]['ukrts_act_dh_no'] = $renewal['renewal']['ukrts_act_dh_no'][$j];
				 $ukrts_act[$j]['ukrts_act_dh'] = $renewal['renewal']['ukrts_act_dh'][$j];
				 $ukrts_act[$j]['ukrts_act_condition'] = $renewal['renewal']['ukrts_act_condition'][$j];
			 }
			 $renewal['renewal']['ukrts_act']="'".json_encode($ukrts_act)."'";
			 $ukrts_act_first=array();
			  for($j=0;$j<$c8;$j++)
			{    
			     $ukrts_act_first[$j]['ukrts_act_first_dh_no'] = $renewal['renewal']['ukrts_act_first_dh_no'][$j];
				 $ukrts_act_first[$j]['ukrts_act_first_dh'] = $renewal['renewal']['ukrts_act_first_dh'][$j];
				 $ukrts_act_first[$j]['ukrts_act_first_condition'] = $renewal['renewal']['ukrts_act_first_condition'][$j];
			 }
		     $renewal['renewal']['ukrts_act_first']="'".json_encode($ukrts_act_first)."'";
			 $ukrts_act_second=array();
			  for($j=0;$j<$c9;$j++)
			{    
			     $ukrts_act_second[$j]['ukrts_act_second_dh_no'] = $renewal['renewal']['ukrts_act_second_dh_no'][$j];
				 $ukrts_act_second[$j]['ukrts_act_second_dh'] = $renewal['renewal']['ukrts_act_second_dh'][$j];
				 $ukrts_act_second[$j]['ukrts_act_second_condition'] = $renewal['renewal']['ukrts_act_second_condition'][$j];
			 }
		     $renewal['renewal']['ukrts_act_second']="'".json_encode($ukrts_act_second)."'";
			 ////////////////////////////////////////////////////////////
			$data[] = $renewal['renewal'];
			}
		///////////////////////////Renewal End//////////////////////////////
		
		 ///////////////////////////Return 7//////////////////////////////
			 if (in_array('Return', $serviceType)) { 
			$return['return'] = $_POST['return'];
            $return['return']['service_type'] = 'Return'; 
			 $return['return']['servicetype_additionalsubservice'] = '7'; 
              if(!empty($return['return'])) 
			{
		    $c=count($return['return']['go_notification_dh_no']); 
			$c1=count($return['return']['gov_act_dh_no']); 
			$c2=count($return['return']['gov_act_first_dh_no']); 
			$c3=count($return['return']['gov_act_second_dh_no']); 
			$c4=count($return['return']['uksw_act_dh_no']); 
			$c5=count($return['return']['uksw_act_first_dh_no']); 
			$c6=count($return['return']['uksw_act_second_dh_no']); 
			$c7=count($return['return']['ukrts_act_dh_no']); 
			$c8=count($return['return']['ukrts_act_first_dh_no']); 
			$c9=count($return['return']['ukrts_act_second_dh_no']);
			$go_notification=array();
			for($j=0;$j<$c;$j++)
			{
				 $go_notification[$j]['go_notification_dh_no'] = $return['return']['go_notification_dh_no'][$j];
				 $go_notification[$j]['go_notification_dh'] = $return['return']['go_notification_dh'][$j];
				 $go_notification[$j]['go_notification_condition'] = $return['return']['go_notification_condition'][$j];
				 
			 } 
			 $return['return']['go_notification']=json_encode($go_notification);
			 $gov_act=array();
			 for($j=0;$j<$c1;$j++)
	         {
				$gov_act[$j]['gov_act_dh_no'] = $return['return']['gov_act_dh_no'][$j];
				 $gov_act[$j]['gov_act_dh'] = $return['return']['gov_act_dh'][$j];
				 $gov_act[$j]['gov_act_condition'] = $return['return']['gov_act_condition'][$j];
			 }
			 $return['return']['gov_act']=json_encode($gov_act);
			 $gov_act_first=array();
			  for($j=0;$j<$c2;$j++)
			{    
			     $gov_act_first[$j]['gov_act_first_dh_no'] = $return['return']['gov_act_first_dh_no'][$j];
				 $gov_act_first[$j]['gov_act_first_dh'] = $return['return']['gov_act_first_dh'][$j];
				 $gov_act_first[$j]['gov_act_first_condition'] = $return['return']['gov_act_first_condition'][$j];
			 }
		     $return['return']['gov_act_first']=json_encode($gov_act_first);
			 $gov_act_second=array();
			  for($j=0;$j<$c3;$j++)
			{    
			     $gov_act_second[$j]['gov_act_second_dh_no'] = $return['return']['gov_act_second_dh_no'][$j];
				 $gov_act_second[$j]['gov_act_second_dh'] = $return['return']['gov_act_second_dh'][$j];
				 $gov_act_second[$j]['gov_act_second_condition'] = $return['return']['gov_act_second_condition'][$j];
			 }
		     $return['return']['gov_act_second']=json_encode($gov_act_second);
			
             }
			////////////////////////////////Return Uksw///////////////////////////
			 $uksw_act=array();
			 for($j=0;$j<$c4;$j++)
	         {
				$uksw_act[$j]['uksw_act_dh_no'] = $return['return']['uksw_act_dh_no'][$j];
				 $uksw_act[$j]['uksw_act_dh'] = $return['return']['uksw_act_dh'][$j];
				 $uksw_act[$j]['uksw_act_condition'] = $return['return']['uksw_act_condition'][$j];
			 }
			 $return['return']['uksw_act']="'".json_encode($uksw_act)."'";
			 $uksw_act_first=array();
			  for($j=0;$j<$c5;$j++)
			{    
			     $uksw_act_first[$j]['uksw_act_first_dh_no'] = $return['return']['uksw_act_first_dh_no'][$j];
				 $uksw_act_first[$j]['uksw_act_first_dh'] = $return['return']['uksw_act_first_dh'][$j];
				 $uksw_act_first[$j]['uksw_act_first_condition'] = $return['return']['uksw_act_first_condition'][$j];
			 }
		     $return['return']['uksw_act_first']="'".json_encode($uksw_act_first)."'";
			 $uksw_act_second=array();
			  for($j=0;$j<$c6;$j++)
			{    
			     $uksw_act_second[$j]['uksw_act_second_dh_no'] = $return['return']['uksw_act_second_dh_no'][$j];
				 $uksw_act_second[$j]['uksw_act_second_dh'] = $return['return']['uksw_act_second_dh'][$j];
				 $uksw_act_second[$j]['uksw_act_second_condition'] = $return['return']['uksw_act_second_condition'][$j];
			 }
		     $return['return']['uksw_act_second']="'".json_encode($uksw_act_second)."'";
			 
			  ////////////////////////////////Return UkRTS///////////////////////////
			 $ukrts_act=array();
			 for($j=0;$j<$c7;$j++)
	         {
				$ukrts_act[$j]['ukrts_act_dh_no'] = $return['return']['ukrts_act_dh_no'][$j];
				 $ukrts_act[$j]['ukrts_act_dh'] = $return['return']['ukrts_act_dh'][$j];
				 $ukrts_act[$j]['ukrts_act_condition'] = $return['return']['ukrts_act_condition'][$j];
			 }
			 $return['return']['ukrts_act']="'".json_encode($ukrts_act)."'";
			 $ukrts_act_first=array();
			  for($j=0;$j<$c8;$j++)
			{    
			     $ukrts_act_first[$j]['ukrts_act_first_dh_no'] = $return['return']['ukrts_act_first_dh_no'][$j];
				 $ukrts_act_first[$j]['ukrts_act_first_dh'] = $return['return']['ukrts_act_first_dh'][$j];
				 $ukrts_act_first[$j]['ukrts_act_first_condition'] = $return['return']['ukrts_act_first_condition'][$j];
			 }
		     $return['return']['ukrts_act_first']="'".json_encode($ukrts_act_first)."'";
			 $ukrts_act_second=array();
			  for($j=0;$j<$c9;$j++)
			{    
			     $ukrts_act_second[$j]['ukrts_act_second_dh_no'] = $return['return']['ukrts_act_second_dh_no'][$j];
				 $ukrts_act_second[$j]['ukrts_act_second_dh'] = $return['return']['ukrts_act_second_dh'][$j];
				 $ukrts_act_second[$j]['ukrts_act_second_condition'] = $return['return']['ukrts_act_second_condition'][$j];
			 }
		     $return['return']['ukrts_act_second']="'".json_encode($ukrts_act_second)."'";
			 ////////////////////////////////////////////////////////////
			$data[] = $return['return'];
			}
		///////////////////////////Return End//////////////////////////////
		
		 ///////////////////////////Maintenance of Register 8//////////////////////////////
			 if (in_array('Maintenance of Register', $serviceType)) { 
			$maintainence['maintainence'] = $_POST['maintainence'];
            $maintainence['maintainence']['service_type'] = 'Maintenance of Register'; 
			 $maintainence['maintainence']['servicetype_additionalsubservice'] = '8'; 
              if(!empty($maintainence['maintainence'])) 
			{
		    $c=count($maintainence['maintainence']['go_notification_dh_no']); 
			$c1=count($maintainence['maintainence']['gov_act_dh_no']); 
			$c2=count($maintainence['maintainence']['gov_act_first_dh_no']); 
			$c3=count($maintainence['maintainence']['gov_act_second_dh_no']); 
			$c4=count($maintainence['maintainence']['uksw_act_dh_no']); 
			$c5=count($maintainence['maintainence']['uksw_act_first_dh_no']); 
			$c6=count($maintainence['maintainence']['uksw_act_second_dh_no']); 
			$c7=count($maintainence['maintainence']['ukrts_act_dh_no']); 
			$c8=count($maintainence['maintainence']['ukrts_act_first_dh_no']); 
			$c9=count($maintainence['maintainence']['ukrts_act_second_dh_no']);
			$go_notification=array();
			for($j=0;$j<$c;$j++)
			{
				 $go_notification[$j]['go_notification_dh_no'] = $maintainence['maintainence']['go_notification_dh_no'][$j];
				 $go_notification[$j]['go_notification_dh'] = $maintainence['maintainence']['go_notification_dh'][$j];
				 $go_notification[$j]['go_notification_condition'] = $maintainence['maintainence']['go_notification_condition'][$j];
				 
			 } 
			 $maintainence['maintainence']['go_notification']=json_encode($go_notification);
			 $gov_act=array();
			 for($j=0;$j<$c1;$j++)
	         {
				$gov_act[$j]['gov_act_dh_no'] = $maintainence['maintainence']['gov_act_dh_no'][$j];
				 $gov_act[$j]['gov_act_dh'] = $maintainence['maintainence']['gov_act_dh'][$j];
				 $gov_act[$j]['gov_act_condition'] = $maintainence['maintainence']['gov_act_condition'][$j];
			 }
			 $maintainence['maintainence']['gov_act']=json_encode($gov_act);
			 $gov_act_first=array();
			  for($j=0;$j<$c2;$j++)
			{    
			     $gov_act_first[$j]['gov_act_first_dh_no'] = $maintainence['maintainence']['gov_act_first_dh_no'][$j];
				 $gov_act_first[$j]['gov_act_first_dh'] = $maintainence['maintainence']['gov_act_first_dh'][$j];
				 $gov_act_first[$j]['gov_act_first_condition'] = $maintainence['maintainence']['gov_act_first_condition'][$j];
			 }
		     $maintainence['maintainence']['gov_act_first']=json_encode($gov_act_first);
			 $gov_act_second=array();
			  for($j=0;$j<$c3;$j++)
			{    
			     $gov_act_second[$j]['gov_act_second_dh_no'] = $maintainence['maintainence']['gov_act_second_dh_no'][$j];
				 $gov_act_second[$j]['gov_act_second_dh'] = $maintainence['maintainence']['gov_act_second_dh'][$j];
				 $gov_act_second[$j]['gov_act_second_condition'] = $maintainence['maintainence']['gov_act_second_condition'][$j];
			 }
		     $maintainence['maintainence']['gov_act_second']=json_encode($gov_act_second);
			
             }
			////////////////////////////////Maintenance of Register Uksw///////////////////////////
			 $uksw_act=array();
			 for($j=0;$j<$c4;$j++)
	         {
				$uksw_act[$j]['uksw_act_dh_no'] = $maintainence['maintainence']['uksw_act_dh_no'][$j];
				 $uksw_act[$j]['uksw_act_dh'] = $maintainence['maintainence']['uksw_act_dh'][$j];
				 $uksw_act[$j]['uksw_act_condition'] = $maintainence['maintainence']['uksw_act_condition'][$j];
			 }
			 $maintainence['maintainence']['uksw_act']="'".json_encode($uksw_act)."'";
			 $uksw_act_first=array();
			  for($j=0;$j<$c5;$j++)
			{    
			     $uksw_act_first[$j]['uksw_act_first_dh_no'] = $maintainence['maintainence']['uksw_act_first_dh_no'][$j];
				 $uksw_act_first[$j]['uksw_act_first_dh'] = $maintainence['maintainence']['uksw_act_first_dh'][$j];
				 $uksw_act_first[$j]['uksw_act_first_condition'] = $maintainence['maintainence']['uksw_act_first_condition'][$j];
			 }
		     $maintainence['maintainence']['uksw_act_first']="'".json_encode($uksw_act_first)."'";
			 $uksw_act_second=array();
			  for($j=0;$j<$c6;$j++)
			{    
			     $uksw_act_second[$j]['uksw_act_second_dh_no'] = $maintainence['maintainence']['uksw_act_second_dh_no'][$j];
				 $uksw_act_second[$j]['uksw_act_second_dh'] = $maintainence['maintainence']['uksw_act_second_dh'][$j];
				 $uksw_act_second[$j]['uksw_act_second_condition'] = $maintainence['maintainence']['uksw_act_second_condition'][$j];
			 }
		     $maintainence['maintainence']['uksw_act_second']="'".json_encode($uksw_act_second)."'";
			 
			  ////////////////////////////////Maintenance of Register UkRTS///////////////////////////
			 $ukrts_act=array();
			 for($j=0;$j<$c7;$j++)
	         {
				$ukrts_act[$j]['ukrts_act_dh_no'] = $maintainence['maintainence']['ukrts_act_dh_no'][$j];
				 $ukrts_act[$j]['ukrts_act_dh'] = $maintainence['maintainence']['ukrts_act_dh'][$j];
				 $ukrts_act[$j]['ukrts_act_condition'] = $maintainence['maintainence']['ukrts_act_condition'][$j];
			 }
			 $maintainence['maintainence']['ukrts_act']="'".json_encode($ukrts_act)."'";
			 $ukrts_act_first=array();
			  for($j=0;$j<$c8;$j++)
			{    
			     $ukrts_act_first[$j]['ukrts_act_first_dh_no'] = $maintainence['maintainence']['ukrts_act_first_dh_no'][$j];
				 $ukrts_act_first[$j]['ukrts_act_first_dh'] = $maintainence['maintainence']['ukrts_act_first_dh'][$j];
				 $ukrts_act_first[$j]['ukrts_act_first_condition'] = $maintainence['maintainence']['ukrts_act_first_condition'][$j];
			 }
		     $maintainence['maintainence']['ukrts_act_first']="'".json_encode($ukrts_act_first)."'";
			 $ukrts_act_second=array();
			  for($j=0;$j<$c9;$j++)
			{    
			     $ukrts_act_second[$j]['ukrts_act_second_dh_no'] = $maintainence['maintainence']['ukrts_act_second_dh_no'][$j];
				 $ukrts_act_second[$j]['ukrts_act_second_dh'] = $maintainence['maintainence']['ukrts_act_second_dh'][$j];
				 $ukrts_act_second[$j]['ukrts_act_second_condition'] = $maintainence['maintainence']['ukrts_act_second_condition'][$j];
			 }
		     $maintainence['maintainence']['ukrts_act_second']="'".json_encode($ukrts_act_second)."'";
			 ////////////////////////////////////////////////////////////
			$data[] = $maintainence['maintainence'];
			}
		///////////////////////////Maintenance of Register End//////////////////////////////
		
		
		$status = "";
			  foreach ($data as $key => $datasave) { 
			     $model=new BoInfowizardServiceTimeline;
			     $model->attributes = $datasave;
			     $model->service_id = $serviceID;
				 $model->created = date('Y-m-d H:m:s');
				 $model->modified = date('Y-m-d H:m:s');
             //   print_r($model->attributes); 
			   if ($model->save()) { $status = $status . ", " . $datasave['service_type']; }
			   
            }
			
			//die;
			if ($status != "") {
                Yii::app()->user->setFlash('Success', "Service Timeline for $status has been saved");
            } else {
                Yii::app()->user->setFlash('Error', "Service Timeline saving failed");
            }
            $serviceFeeURL = "/infowizard/ServiceStackholder/create/serviceID/$serviceID";
            $this->redirect(Yii::app()->createUrl($serviceFeeURL));
	
		}	
  
        $sql = "SELECT * from bo_infowizard_service_timeline where service_id=$serviceID";
		$command=$connection->createCommand($sql);
		$ServiceTimeline=$command->queryAll();	
	    //print_r($ServiceTimeline); die;
              if(!empty($ServiceTimeline)){
                foreach($ServiceTimeline as $key=>$params){
                    $service_type=$params['service_type'];
                    if($key==0){
                        $_SESSION['ServiceTimeline']['service']=$params; 
                    }else{
                 $_SESSION['ServiceTimeline'][$service_type]=$params;   
                    }
                }   
                }else{
                    $_SESSION['ServiceTimeline']="";
                }
				// print_r($_SESSION['ServiceTimeline']); die;
              $this->render('create',array("serviceData" => $serviceData));
        }
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BoInfowizardServiceTimeline']))
		{
			$model->attributes=$_POST['BoInfowizardServiceTimeline'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('BoInfowizardServiceTimeline');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new BoInfowizardServiceTimeline('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['BoInfowizardServiceTimeline']))
			$model->attributes=$_GET['BoInfowizardServiceTimeline'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return BoInfowizardServiceTimeline the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=BoInfowizardServiceTimeline::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param BoInfowizardServiceTimeline $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='bo-infowizard-service-timeline-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
