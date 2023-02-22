<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<h2>Error <?php echo $code; ?></h2>

<div class="error">
<?php echo CHtml::encode($message); die;
//https://caipotesturl.com/swcs/sample/one/action/signin
$serviceFeeURL="/swcs/sample/one/action/signin";
                   // $this->redirect(Yii::app()->createUrl($serviceFeeURL));
              ?>
</div>