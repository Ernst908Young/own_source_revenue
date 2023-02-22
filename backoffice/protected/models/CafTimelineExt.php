<?php
class CafTimelineExt extends Applications{
    
      /**
     * @author - Rahul Kumar
     * @date - 06-01-2018
     * @desc- It will calculate District level CAF time taken by department
     * @return array time taken by department
     */
    static function timetakenbydept($caf,$dept) {
        //extract($_GET);

        //Getting all row from table assigned to department for particular caf
        $connection = Yii::app()->db;
        $sql = "SELECT * from bo_application_forward_level where app_Sub_id=$caf AND forwarded_dept_id=$dept";
        $command = $connection->createCommand($sql);
        $allActionOnCafByDepartment = $command->queryAll();
         // Initilizing varibales to be used furthur
        $totalTimeTakenByDepartment = 0;
        foreach ($allActionOnCafByDepartment as $rowData) {
            // If Department has been commented 
            $departmentCommentedOn = $rowData['comment_date'];
            $assignedToDepartment = $rowData['created_on'];
            // In case Department has not commented yet
            if (empty($departmentCommentedOn)) {
                
        
                $departmentCommentedOn = date('Y-m-d H:i:s');
                      $connection = Yii::app()->db;
                $sql = "SELECT * from bo_application_submission where submission_id=$caf where application_status IN('A','R','H','RBI')";
                $command = $connection->createCommand($sql);
                $disposedCaf = $command->queryRow();
                if(!empty($disposedCaf)){
                    $departmentCommentedOn = $disposedCaf['pplication_updated_date_time']; 
                }
            }
            // Calculating time duration between commented date and assigned date     
            $difference = abs(strtotime($departmentCommentedOn) - strtotime($assignedToDepartment));
            $totalTimeTakenByDepartment = $totalTimeTakenByDepartment + $difference;
        }
       // $timeTakenByDept = $this->getTimeinDHMformat($totalTimeTakenByDepartment);
       $timeInString= $totalTimeTakenByDepartment;
        // print_r($totalTimeTakenByDepartment);die;
        // echo $timeTakenByDept;
        $years = floor($timeInString / (365 * 60 * 60 * 24));
        $months = floor(($timeInString - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
        $hours = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
        $minuts = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
        $seconds = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
        $allDays = ($months * 30) + $days;
        return "$allDays days, $hours hrs, $minuts min";
    }
    /**
     * @author - Rahul Kumar
     * @date - 06-01-2018
     * @desc- It will return time in Day Hour Minute format
     * @return string as 20 days, 2 hrs,1 min
     */
    public function getTimeinDHMformat($timeInString) {
        $years = floor($timeInString / (365 * 60 * 60 * 24));
        $months = floor(($timeInString - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
        $hours = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
        $minuts = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
        $seconds = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
        $allDays = ($months * 30) + $days;
        return "$allDays days, $hours hrs, $minuts min";
    }
    
}
