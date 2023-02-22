<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
/*$d = 	48;
$id  = 48;
for($i=1; $i<=16; $i++){
	
	$email = "demo".$i."@gmail.com";
$id = $d+$i;
	$model = Users::model()->findByPk($id);
	if($model){
			echo 'sdf';
		$password1 = 'Demo@12345';
	$salt = md5($password1."_".time()."-".rand(111,9999999));
	$model->salt = $salt;
	$model->activation_code = 'r';
	$model->password = hash_hmac("sha1",$password1.$salt,PASSWORD_SECRET_KEY); // Demo@12345
	$model->save(false);
	}else{
		echo 'sdf';
	}
	$id = $d+$i;
	$model = Profiles::model()->findByPk($id);
	$model->last_name = 'MEa';
	$model->surname = 'Sa';
	$model->gender = 'male';
	$model->date_of_birth = date('1996-01-02');
	$model->mobile_number = '7854565214';
	$model->country_code = 1246;
	$model->country_name = '2065';
	$model->state_name = '2075';
	$model->city_name = 'demo city';
	$model->distt_name = 'demo di';
	$model->pin_code = '547850';
	$model->address = 'Dummy address line 1';
	$model->address2 = 'Dummy address line 2';
	$model->telephone = '025487454';
	$model->nationality = '2065';
	$model->save(false);

}
*/
	






/*$user = Users::model()->findAll();
print_r($user);
echo '<br><br>';
$userp = Profiles::model()->findAll();
print_r($userp);*/

?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>


<p><a href="<?=$this->createUrl('/api')?>"> API Documentation </a></p>

<h4> About SSO </h4>
<p>
	 Lorem ipsum dolor sit amet, pede amet nonummy, lorem enim integer malesuada varius. Aliquet mauris vehicula, magna rutrum ante lorem magna, ac ut justo. Libero amet adipiscing nisl, lorem ut metus blandit non. Purus convallis non neque convallis fusce ullamcorper, eu wisi, hendrerit ligula arcu pulvinar nisl ut. Non sollicitudin eros, sed necessitatibus eleifend pharetra commodo, pellentesque metus. Magnis elit vel donec placerat neque eu. Dui recusandae leo, ultrices dolor, quibusdam vestibulum voluptas, augue quam et arcu ante in rutrum, dictum sollicitudin ultrices. Orci dictum eros mauris tortor tempus.

Ut quis arcu sit proin mauris, et sem ut vitae ac vitae, nulla eleifend, vestibulum pede lacus vestibulum a aliquam nulla. Quisque etiam, aliquam amet at sagittis sit lacus, suscipit blandit cum senectus lectus dignissim, interdum quam dui duis etiam enim velit. Aliquam nunc rutrum. Eu eros sodales purus, quis rutrum nullam. Mi viverra. Class lorem eget torquent et vestibulum tellus.
</p>

