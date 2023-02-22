<?php $allLand=array(); //print_r($dataProvider);
                         
                                 foreach ($dataProvider as $key=>$act) {
                                      $latype=$act['la_type'];
                                        $tl=$act['type_of_land'];    
                                           $nw=0;
                                           if($act['area_type']=='Sq. m') {
                                              //  echo $act['area_sqmt'];
                                            }
                                            else{
                                                if($act['area_sqmt'] > 0){
                                                $nw =  LandownerConnectEXT::getLandUnitConversion($act['area_sqmt'],$act['area_type']);
                                           
                                                }
                                            } 
                                            $yu=$latype."-".@$tl;
                                           
                                         if(!isset($allLand[$latype])){
                                             $allLand[$latype]=array();
                                             
                                         }
                                         if(!isset($allLand[$latype][$tl])){
                                             $allLand[$latype][$tl]=array();
                                             
                                         }
                                         if(!isset($allLand[$latype][$tl]['total_application'])){
                                             $allLand[$latype][$tl]['total_application']=0;
                                         }
                                         if(!isset($allLand[$latype][$tl]['total_area_in_sqmt'])){
                                             $allLand[$latype][$tl]['total_area_in_sqmt']=0;
                                         }
                                          $allLand[$latype][$tl]['total_application']= $allLand[$latype][$tl]['total_application']+1; 
                                         $allLand[$latype][$tl]['total_area_in_sqmt']+= doubleval($allLand[$latype][$tl]['total_area_in_sqmt'])+doubleval($nw);
                                             
                                         
                                            
                                           
                                              
 
}
echo "<pre>";
// print_r($allLand);die; 

?>