<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		@session_start();
		if(isset($_SESSION['RESPONSE']) && !empty($_SESSION['RESPONSE']))
			$this->render('profile');
		else
			$this->redirect(Yii::app()->homeUrl);
	}
}