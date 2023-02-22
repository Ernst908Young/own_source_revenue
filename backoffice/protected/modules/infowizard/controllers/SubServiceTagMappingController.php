<?php

class SubServiceTagMappingController extends Controller {

    /**

     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning

     * using two-column layout. See 'protected/views/layouts/column2.php'.

     */
    /*
      public function accessRules()
      {
      return array(
      array('allow',  // allow all users to perform 'index' and 'view' actions
      'actions'=>array('subServicelist'),
      'users'=>array('*'),
      ),
      array('allow', // allow authenticated user to perform 'create' and 'update' actions
      'actions'=>array('subServicelist'),
      'users'=>array('*'),
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

     */


/* Rahul Kumar 03052018*/
    
    public function partialServiceTagMappingLayout(){
       $this->render('partialServiceTagMappingLayout');  
    }

    public function actionSubServicelist() {

        if (!empty($_POST)) {
            $s_id = @$_POST['service_id'];
            $sql_d = "SELECT service_id,core_service_name,servicetype_additionalsubservice FROM bo_information_wizard_service_parameters
             WHERE service_id=$s_id  AND is_active='Y' ORDER BY servicetype_additionalsubservice ASC ";
             $connection = Yii::app()->db;
            $command = $connection->createCommand($sql_d);
            $res_d = $command->queryAll();
            $this->renderPartial('partialServiceTagMappingLayout', array('sub_service_name_list' => $res_d));
          }else{
               $this->renderPartial('partialServiceTagMappingLayout');
          }
    }
    
    /* Rahul kumar */
       public function actionAddsubservicetagmapping() {

        $model = new SubserviceTagMapping;
        //echo "<pre/>";
        //print_r($_POST);die;
        if (!empty($_POST)) {
            if (!empty($_POST['SubserviceTagMapping']['id'])) {
                $model = $model::model()->findByAttributes(array('id' => $_POST['SubserviceTagMapping']['id']));
                $model->modified = date('Y-m-d H:i:s');
                $model->to_be_used_in_cis = "N";
                $model->to_be_used_in_online_offline = "N";
                $model->to_be_used_in_infowiz = "N";
                $model->to_be_used_in_caf_2 = "N";
                $model->to_be_used_in_inter_departmental_clearance = "N";
                $model->to_be_used_in_sectoral_clearence = "N";
                $model->to_be_used_in_dms = "N";
            } else {
                $model = new SubserviceTagMapping;
                $model->created = date('Y-m-d H:i:s');
                $model->modified = "00-00-00 00:00:00";
            }
            $model->attributes = $_POST['SubserviceTagMapping'];
            $model->is_active = "Y";
            $model->ip_address = $_SERVER['REMOTE_ADDR'];
            $model->user_agent = $_SERVER['HTTP_USER_AGENT'];
            $model->user_id = $_SESSION['uid'];


            if ($model->save()) {
               echo "Module Mapping with Tags for Service ID : " . $_POST['SubserviceTagMapping']['sub_service_id'] . " has been saved "; die;
             
            } else {
                 echo "Data saving failed. Please try again.";
                die;
            }
        }
    }

}
