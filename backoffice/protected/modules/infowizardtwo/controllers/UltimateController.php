<?php
class UltimateController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
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
	
	public function actionPdfwatermark()
	{
		$this->render('pdfwatermark');
    }
	public function actionPdfwatermark2()
	{
		$this->render('pdfwatermark2');
    }
	public function actionService()
	{
		$this->render('services');
    }
}
?>