<?php

class MisController extends Controller
{

	public function actionIndex(){
		@session_start();
		$this->render('index');
	}

}