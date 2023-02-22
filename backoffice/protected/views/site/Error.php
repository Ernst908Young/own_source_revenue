<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle = Yii::app()->name . ' - Error';
$this->breadcrumbs = array(
    'Error',
);
?>

<h2>Error <?php echo $code; ?></h2>

<div class="error">
    <?php
    echo CHtml::encode($message); 
    $serviceFeeURL = "swcs/sample/one/action/signin";
    ?>
</div>
<?php
if (!empty($_GET['dev']) && $_GET['dev'] == 'Y') {
    $error = Yii::app()->errorHandler->error;
    echo "<pre>";
    print_r($error);
    echo 'HTTP STATUS -:' . $code . "<br/>";
    echo 'Line No-:' . $line . "<br/>";
    echo 'Message:' . CHtml::encode($message) . "<br/>";
    echo 'File Name :' . $file . "<br/>";
}
?>
<div style="display: none"><?php
    $error = Yii::app()->errorHandler->error;
    if (isset($error) && !empty($error)) {
        echo "<pre>";
        print_r($error);
        echo "</pre>";
    }
    ?>
</div>