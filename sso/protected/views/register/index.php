<h1>Register :: SSO</h1>

<h4>Please fill up the information</h4>

<div class="form">
    <?php
   
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl('/register'),
        'enableAjaxValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true,
            'validateOnType' => false,
        ),
    ));
    ?>
    <div class="errors">
        <?php 
            if(isset($errors)){
                echo $errors;
            }
        ?>
    </div>
	<input type="hidden" name="CALL_BACK_URL" value="<?=$CALL_BACK_URL?>" />
    <div class="row">
        <?php echo $form->label($profiles, 'full_name'); ?>
        <?php echo $form->textField($profiles, 'full_name',array('placeholder'=>'Your full name')) ?>
    </div>
    
    <div class="row">
        <?php echo $form->label($users, 'email'); ?>
        <?php echo $form->textField($users, 'email',array('placeholder'=>'Email Address')) ?>
    </div>
    
    <div class="row">
        <?php echo $form->label($users, 'password'); ?>
        <?php echo $form->passwordField($users, 'password',array('placeholder'=>'Password')) ?>
    </div> 
    <div class="row">
        <label>Password Again</label>
        <input type="password" name="password2" placeholder="Password Again" />
    </div>
    
     <div class="row">
        <?php echo $form->label($profiles, 'mobile_number'); ?>
        <?php echo $form->textField($profiles, 'mobile_number',array('max-length'=>'10','placeholder'=>'Mobile number')) ?>
    </div>
    
    
     
    <div class="row submit">
        <?php echo CHtml::submitButton('Register'); ?>
    </div>
    
    <?php $this->endWidget(); ?>
</div>