<?php
/* @var $this SiteController */

$this -> pageTitle = Yii::app() -> name;
?>

<h3>Welcome to <i><?php echo CHtml::encode(Yii::app() -> name); ?></i></h3>
<div class="row">&nbsp;<div class="row">&nbsp;</div></div>
<div class="row">
<p>
	<a class="btn btn-danger" href="<?=$this -> createUrl('/sample/one') ?>">Click here To Login/Register</a>
	
</p>
</div>
<div class="row">&nbsp;<div class="row">&nbsp;</div><div class="row">&nbsp;</div></div>