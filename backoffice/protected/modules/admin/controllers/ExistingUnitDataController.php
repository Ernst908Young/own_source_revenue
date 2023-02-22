<?php

class ExistingUnitDataController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

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
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$sql = "SELECT * FROM bo_existing_unit_data  WHERE swcs_id=$id ";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $data = $command->queryRow();
        $this->render('view', array(
            'data' => $data,
        ));
		
		
		/* //echo 'reached...';   exit();
		
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));  */
	}

	

	/**
	 * Lists all models.
	 */
	public function actionIndex($page=1, $search=NULL)
	{
		/*$model=new ExistingUnitData;
		$datas = $model->findAll(array(
				  'limit' => 5,
				));  */
		
		//echo '<pre>'; print_r($datas);
		/*$dataProvider=new CActiveDataProvider('ExistingUnitData');*/
		
		//echo $page; echo $search; exit();
		
		   $search=!empty($_GET['search'])?$_GET['search']:$search;
		
		
			$connection=Yii::app()->db;
			$wh_txt="";
				if($search!=NULL){
					$wh_txt = " WHERE enterprise_name LIKE '%$search%' OR proprietor_name LIKE '%$search%' OR registration_no LIKE '%$search%' OR mobile_no LIKE '%$search%' ";
				}
			$sql= "SELECT enterprise_name FROM bo_existing_unit_data $wh_txt ORDER BY swcs_id DESC";
			$command = $connection->createCommand($sql)->queryAll();
			$pages = new CPagination(count($command));
			$search=($search!=NULL)?$search:'';
			
			$sql= "SELECT * FROM bo_existing_unit_data $wh_txt ORDER BY swcs_id DESC";
			//echo count($command); exit();
			$offset=($page>0)?(($page-1)*100):0;
			$list = $connection->createCommand($sql." limit 100 offset ".$offset."")->queryAll();
			$this->render('index',array(
			  'datas' => $list,
			  'pages' => $pages,
			  'search'     =>  $search,
			));
		
	
	}

	

	
}
