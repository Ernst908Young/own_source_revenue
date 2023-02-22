<h1><?= $_SESSION['role_id'] ?></h1>
<h3><?php 
 if(isset($_SESSION['RESPONSE']))
                                  echo "<span class='username'>".$_SESSION['RESPONSE']['first_name']." ".$_SESSION['RESPONSE']['last_name']."</span>";
                           else
                                 echo "<span class='username'>".$_SESSION['uname']."</span>";
?></h3>