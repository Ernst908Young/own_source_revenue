<?php

class ServiceMasterController extends Controller {

    /**



     * This function is used to get the Service Master



     * @Author: Neha Jaiswal



     */
    public $layout = '//layouts/column2';

    /**



     * @return array action filters



     */
    public function filters() {



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
    /* public function accessRules()



      {



      return array(







      array('allow', //allow authenticated user to perform 'create' and 'update' actions



      'actions'=>array('update','servicepage','issuerbydepartmentid','listservicepage','serviceupdate','view'),



      'expression'=>'RolesExt::isAdminUser()',



      ),

      array('allow', //allow authenticated user to perform 'create' and 'update' actions



      'actions'=>array('update','servicepage','issuerbydepartmentid','listservicepage','serviceupdate','view'),



      'expression'=>'DefaultUtility::isInfoWizardAdmin()',



      ),





      array('deny',  // deny all users



      'users'=>array('*'),



      ),



      );



      }



     */

    /**



     * Displays a particular model.



     * @param integer $id the ID of the model to be displayed



     */
    public function getNameOfIssuerBy($id) { //echo $id;  die;
        $sql = "select name from bo_infowizard_issuerby_master where issuerby_id=:id";



        $connection = Yii::app()->db;



        $command = $connection->createCommand($sql);



        $command->bindParam(":id", $id, PDO::PARAM_INT);



        $Fields = $command->queryRow();



        //echo "<pre>";print_r($Fields); die;



        if ($Fields === false)
            return false;



        return $Fields;
    }

    public function getNameOfSeviceSector($id) { //echo $id;  die;
        $sql = "select name from bo_information_wizard_sector where id=:id";



        $connection = Yii::app()->db;



        $command = $connection->createCommand($sql);



        $command->bindParam(":id", $id, PDO::PARAM_INT);



        $Fields = $command->queryRow();



        //echo "<pre>";print_r($Fields); die;



        if ($Fields === false)
            return false;



        return $Fields;
    }

    public function getListofService() { //echo $id;  die;
        $sql = "select * from bo_information_wizard_service_master ";



        $connection = Yii::app()->db;



        $command = $connection->createCommand($sql);



        //$command->bindParam(":id",$id,PDO::PARAM_INT);



        $Fields = $command->queryAll();



        //echo "<pre>";print_r($Fields); die;



        if ($Fields === false)
            return false;



        return $Fields;
    }

    public function getListofSubForm($serviceID) { //echo $id;  die;
        $sql = "select * from bo_infowizard_quesans_serviceform where service_id=:serviceID and is_active='Y'";

        $connection = Yii::app()->db;

        $command = $connection->createCommand($sql);

        $command->bindParam(":serviceID", $serviceID, PDO::PARAM_INT);

        $Fields = $command->queryAll();

        //echo "<pre>";print_r($Fields); die;

        if ($Fields === false)
            return false;

        return count($Fields);
    }

    public function actionListServicePage() {



        $applications = $this->getListofService(); //print_r($applications); die; question_id

        $this->render('listservicepage', array("apps" => $applications));
    }

    public function getDetailsofService($id) { //echo $id;  die;
        $sql = "select * from bo_information_wizard_service_master where id=:id";



        $connection = Yii::app()->db;



        $command = $connection->createCommand($sql);



        $command->bindParam(":id", $id, PDO::PARAM_INT);



        $Fields = $command->queryRow();



        //echo "<pre>";print_r($Fields); die;



        if ($Fields === false)
            return false;



        return $Fields;
    }

    public function actionServiceUpdate($serviceID) {



        $model = $this->loadModel($serviceID);

        $save_service_type = $model['service_type'];

        $save_additional_sub_service = $model['additional_sub_service'];

        // $jhgj=$save_service_type.",".$save_additional_sub_service;
//$cd= explode(",", $jhgj);

        if (!empty($_POST)) {

            $removeIt = array();

            if (!empty($ad)) {

                $ad = explode(",", $save_additional_sub_service);

                // $save_additional_sub_service

                foreach ($ad as $subservice) {

                    if (in_array($subservice, $_POST['additional_sub_service'])) {
                        $addIt[] = $subservice;
                    } else {

                        $removeIt[] = $subservice;   // Amendment - Others Amendment - Cancellation Amendment - Surrender Amendment - Transfer Duplicate Copy
                    }
                }
            }

            // print_r($removeIt);

            $countit = count($removeIt);

            for ($i = 0; $i < $countit; $i++) {  //echo "kk";
                BoInformationWizardServiceParameters::model()->deleteAll("service_id='$serviceID' and service_type='$removeIt[$i]'");

                BoInformationWizardInspection::model()->deleteAll("service_id='$serviceID' and service_type='$removeIt[$i]'");

                BoInformationWizardServiceFee::model()->deleteAll("service_id='$serviceID' and service_type='$removeIt[$i]'");

                BoInfowizardServiceStackholder::model()->deleteAll("service_id='$serviceID' and service_type='$removeIt[$i]'");

                BoInfowizardServiceTimeline::model()->deleteAll("service_id='$serviceID' and service_type='$removeIt[$i]'");

                BoInfowizardServiceValidity::model()->deleteAll("service_id='$serviceID' and service_type='$removeIt[$i]'");
            }

            if ($_POST['service_type'] != $save_service_type) {



                BoInformationWizardServiceParameters::model()->deleteAll("service_id='$serviceID'");

                BoInformationWizardInspection::model()->deleteAll("service_id='$serviceID'");

                BoInformationWizardServiceFee::model()->deleteAll("service_id='$serviceID'");

                BoInfowizardServiceStackholder::model()->deleteAll("service_id='$serviceID'");

                BoInfowizardServiceTimeline::model()->deleteAll("service_id='$serviceID'");

                BoInfowizardServiceValidity::model()->deleteAll("service_id='$serviceID'");
            }



            $model->attributes = $_POST;



            if (!empty($_POST['additional_sub_service'])) {



                $additional_sub_service = implode(",", $_POST['additional_sub_service']);
            } else {
                $additional_sub_service = '';
            }



            $model->additional_sub_service = $additional_sub_service;

            if (!empty($_POST['act'])) {

                $act = implode(",", $_POST['act']);
            } else {
                $act = "";
            }

            $model->act = $act;



            $model->modified = date('Y-m-d h:i:s');



            //print_r($model->attributes);die;



            if ($model->save()) {

                $mID = $model->id;

                //    $allData=   $this->updateAllRelatedTable($mID,$save_additional_sub_service,$save_service_type);
                // print_r($allData);die;



                Yii::app()->user->setFlash('Success', "Service Master data Updated Successfully");



                $serviceFeeURL = "/infowizard/serviceParameters/Addparams/serviceID/$model->id";



                $this->redirect(Yii::app()->createUrl($serviceFeeURL));
            }
        }



        $applications = $this->getDetailsofService($serviceID); // print_r($applications); die;



        $this->render('serviceupdate', array("apps" => $applications));
    }

    public function actionServicePage() {



        if (!empty($_POST)) {



            $model = new BoInformationWizardServiceMaster;



            $model->attributes = $_POST;



            $serviceSector = implode(",", $_POST['service_sector']);



            $model->service_sector = $serviceSector;



            $model->created = date('Y-m-d h:i:s');



            $model->modified = date('Y-m-d h:i:s');



            //print_r($model->attributes); die;



            $sqlbv = "select * from  bo_information_wizard_service_master where central_state=:central_state111 and service_name=:name111 and issuerby_id=:issuerby_id111";



            $connection = Yii::app()->db;



            $command = $connection->createCommand($sqlbv);



            $command->bindParam(":central_state111", $_POST['central_state'], PDO::PARAM_INT);



            $command->bindParam(":name111", $_POST['service_name'], PDO::PARAM_INT);



            $command->bindParam(":issuerby_id111", $_POST['issuerby_id'], PDO::PARAM_INT);



            $Fieldsaadssd = $command->queryAll();



            //print_r($Fieldsaadssd);



            $aaaa = count($Fieldsaadssd);



            // die;



            if ($aaaa == 0) { //Yii::app()->user->setFlash('Success', "Service Master data has been saved");
                if ($model->save()) {



                    Yii::app()->user->setFlash('Success', "Service Master data has been saved");



                    //$this->redirect("http://uk.swcspoc.com/backoffice/infowizard/infowizardQuesansMapping/subformquestionanswer/serviceID/$serviceID");



                    $serviceFeeURL = "/infowizard/infowizardQuesansMapping/subformquestionanswer/serviceID/$model->id";



                    $this->redirect(Yii::app()->createUrl($serviceFeeURL));
                }
            } else {
                Yii::app()->user->setFlash('Failure', "Data Already Exist");
            }
        }







        $this->render('servicepage');
    }

    public function actionView($serviceID) {

        $database = $this->getListofSubFormQuestion($serviceID);

        //print_r($database); die;

        $this->render('view', array('model' => $this->loadModel($serviceID), "data" => $database));
    }

    public function getListofSubFormQuestion($serviceID) { //echo $id;  die;
        $sql = "SELECT bo_infowizard_quesans_serviceform.queans_mapp_id,bo_infowizard_question_master.question_id,bo_infowizard_question_master.name,

	   bo_infowizard_quesans_mapping.anscat_id, bo_infowizard_quesans_mapping.answer_detail

	   FROM bo_infowizard_quesans_serviceform , bo_infowizard_quesans_mapping , bo_infowizard_question_master where                           bo_infowizard_quesans_serviceform.queans_mapp_id=bo_infowizard_quesans_mapping.queans_mapp_id and bo_infowizard_question_master.question_id=bo_infowizard_quesans_serviceform.question_id and bo_infowizard_quesans_serviceform.service_id=:serviceID and bo_infowizard_quesans_serviceform.is_active='Y' ";

        $connection = Yii::app()->db;

        $command = $connection->createCommand($sql);

        $command->bindParam(":serviceID", $serviceID, PDO::PARAM_INT);

        $Fields = $command->queryAll();

        //echo "<pre>";print_r($Fields); die;

        if (!empty($Fields)) {

            foreach ($Fields as $key => $field) {

                if (isset($field['name'])) {

                    $sectorid = $field['name'];

                    $newdetails[$sectorid][$key]['queans_mapp_id'] = $field['queans_mapp_id'];

                    $newdetails[$sectorid][$key]['answer_detail'] = $field['answer_detail'];

                    $newdetails[$sectorid][$key]['anscat_id'] = $field['anscat_id'];
                }
            } // print_r($newdetails);die;
        }

        if (isset($newdetails)) {

            if ($newdetails == false)
                return false;

            //echo "<pre>";print_r($Fields);die;

            return $newdetails;
        }
    }

    /**



     * Updates a particular model.



     * If update is successful, the browser will be redirected to the 'view' page.



     * @param integer $id the ID of the model to be updated



     */
    public function actionUpdate($serviceID) {



        $model = $this->loadModel($serviceID);







        if (!empty($_POST)) {



            if (empty($_POST['incidence_pre_establishment'])) {
                $model->incidence_pre_establishment = 0;
            }



            if (empty($_POST['incidence_pre_operation'])) {
                $model->incidence_pre_operation = 0;
            }



            if (empty($_POST['incidence_post_operation'])) {
                $model->incidence_post_operation = 0;
            }



            $model->attributes = $_POST;



            //print_r($model->attributes); die;



            $serviceSector = implode(",", $_POST['service_sector']);



            $model->service_sector = $serviceSector;



            $model->modified = date('Y-m-d h:i:s');



            ////////////////////////////////////////////////////////



            $sqlbv = "select * from  bo_information_wizard_service_master where central_state=:central_state111 and issuerby_id=:issuerby_id111 and service_name=:service_name111



			and id!=:id1";



            $connection = Yii::app()->db;



            $command = $connection->createCommand($sqlbv);



            $command->bindParam(":id1", $serviceID, PDO::PARAM_INT);



            $command->bindParam(":central_state111", $_POST['central_state'], PDO::PARAM_INT);



            $command->bindParam(":issuerby_id111", $_POST['issuerby_id'], PDO::PARAM_INT);



            $command->bindParam(":service_name111", $_POST['service_name'], PDO::PARAM_INT);



            $Fieldsaadssd = $command->queryAll();



            //print_r($Fieldsaadssd);



            $aaaa = count($Fieldsaadssd);



            //die;



            if ($aaaa == 0) {



                if ($model->save()) { //print_r($model->attributes); die;
                    $serviceFeeURL = "/infowizard/infowizardQuesansMapping/subformquestionanswerupdate/serviceID/$model->id";



                    $this->redirect(Yii::app()->createUrl($serviceFeeURL));



                    Yii::app()->user->setFlash('Success', "Service Master Updated Successfully");
                }
            } else {
                Yii::app()->user->setFlash('Failure', "Data Already Exist");
            }



            /////////////////////////////////////////////////////////////////
        }







        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**



     * Deletes a particular model.



     * If deletion is successful, the browser will be redirected to the 'admin' page.



     * @param integer $id the ID of the model to be deleted



     */
    /**



     * Lists all models.



     */
    /**



     * Manages all models.



     */

    /**



     * Returns the data model based on the primary key given in the GET variable.



     * If the data model is not found, an HTTP exception will be raised.



     * @param integer $id the ID of the model to be loaded



     * @return BoInformationWizardServiceMaster the loaded model



     * @throws CHttpException



     */
    public function loadModel($id) {



        $model = BoInformationWizardServiceMaster::model()->findByPk($id);



        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');



        return $model;
    }

    /**



     * Performs the AJAX validation.



     * @param BoInformationWizardServiceMaster $model the model to be validated



     */
    protected function performAjaxValidation($model) {



        if (isset($_POST['ajax']) && $_POST['ajax'] === 'bo-information-wizard-service-master-form') {



            echo CActiveForm::validate($model);



            Yii::app()->end();
        }
    }

    public function updateAllRelatedTable($serviceID = null, $subService = null, $serviceType = null) {

        $tableArray = array('BoInformationWizardServiceParameters', 'BoInformationWizardInspection', 'BoInformationWizardServiceFee', 'BoInfowizardServiceStackholder', 'BoInfowizardServiceTimeline', 'BoInfowizardServiceValidity');

        $allList = InfowizardQuestionMasterExt::getMasterList('bo_information_wizard_additional_sub_service_master', 'sub_service_name', 'id');



        foreach ($tableArray as $modTable) {



            $ExistingServices = $modTable::model()->findByAttributes(array('service_id' => $serviceID, 'servicetype_additionalsubservice' => '0'));

            if (empty($ExistingServices)) {

                $model = new $modTable;

                $model->service_id = $serviceID;

                $model->service_type = $serviceType;

                $model->servicetype_additionalsubservice = '0';

                $model->created = date('Y-m-d h:i:s');

                if ($model->save()) {

                    //  echo
                } else {

                    print_r($model->getErrors());
                }
            } else {

                //echo "===".$sS;
            }
        }





        foreach ($tableArray as $modTable) {



            $s = explode(",", $subService);



            //  print_r( $s);

            foreach ($s as $sS) {

                $ExistingServices = $modTable::model()->findByAttributes(array('service_id' => $serviceID, 'service_type' => $sS));

                $model = new $modTable;

                if (empty($ExistingServices)) {

                    $model->service_id = $serviceID;

                    $model->service_type = $sS;

                    $model->servicetype_additionalsubservice = $allList[$sS];

                    $model->created = date('Y-m-d h:i:s');

                    // print_r($model);

                    if ($model->save()) {

                    } else {

                        print_r($model->getErrors());
                    }
                } else {

                    //echo "===".$sS;
                }
            }
        }





        //die;
    }

    public function actionUpdateForAll() {



        $sql = "select id,service_type,additional_sub_service from bo_information_wizard_service_master";



        $connection = Yii::app()->db;



        $command = $connection->createCommand($sql);



        $command->bindParam(":id", $id, PDO::PARAM_INT);



        $allService = $command->queryAll();



        //   print_r($allService);die;

        foreach ($allService as $serviceData) {

            if (!empty($serviceData['service_type'])) {

                $this->updateAllRelatedTable($serviceData['id'], $serviceData['additional_sub_service'], $serviceData['service_type']);
            }
        }



        echo "Done";
        die;
    }
//For Service Module Mapping - Starts Here Rahul Kumar : 02052018 */ 
    public function actionSubservicetagmapping() {
        $this->render('subservicetagmapping');
    }

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
            if(!empty($model->sub_service_id)){
                $serviceIDS= explode(".", $model->sub_service_id);
                $model->service_id=@$serviceIDS[0];
                $model->subservice_id=@$serviceIDS[1];
            }
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
//For Service Module Mapping - Ends Here Rahul Kumar : 02052018 */
}
