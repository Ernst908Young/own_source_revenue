<h1>PDF To Text converter</h1>


<?php


echo $output.'<br><br>';

$out_array = explode(':', $output);
print_r($out_array);

$attributes_array = ['Subject','Nature of Claim','Cause','Incident Type','Selection of Bench in behalf of','State','Jurisdiction','Bench','Was the victim a Railway Official ?','Was the Victim a Passenger?','Train No','Name of Train/Local/Sub Urban Train','Station From','Station To','Booking Date'];
$main_array = [];
foreach ($out_array as $key => $value) {
       foreach ($attributes_array as $k => $val) {
               //$main_array[$val] = [$value];

              if (strpos($value, $val)) { 
                   if($key==0){
                     $main_array[]=['attribute'=>$val,'text'=>''];
                   }else{
                     $next_string = explode($val, $value);
                     $main_array[]=['attribute'=>$val,'text'=>'']; 
                     $previous_key = sizeof($main_array)-2;
                     $main_array[$previous_key]= ['attribute'=>$main_array[$previous_key]['attribute'],'text'=>$next_string[0]];                   
                   }                  
              }
       }

       if($key == (sizeof($out_array)-1)){
              
              $previous_key = sizeof($main_array)-1;
              $main_array[$previous_key]= ['attribute'=>$main_array[$previous_key]['attribute'],'text'=>$value];   
       }
}
echo '<br><br>';
print_r($main_array);

?> 