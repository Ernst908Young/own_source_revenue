<?php 

class GrievanceReplyExt extends GrievanceReply{
	/*used to Get Grievence Reply
		@author : Hemant Thakur 
		@param: In progress
		@return: array
		*/
	public static function getGrievance_Reply(){
		$criteria = new CDbCriteria();
		$criteria->select=array('reply_id,grievance_id,reply_text,is_bo_reply,replied_by,user_agent,remote_ip,created_date_time');
		$model = GrievanceReply::model()->find($criteria);
		return $model;
	}
	/*used to Get Total number of pending grievance of state nodal user
		@author : hemant thakur 
		@param: 
		@return: int
	*/
	static function getTotalPendingGrievanceOfStateNodal(){
		$count=0;
		$criteria=new CDbCriteria();
		$criteria->condition="have_replied=:have_replied AND grievance_status=:grievance_status";
		$criteria->params=array(":grievance_status"=>"O",":have_replied"=>"N");
		$grevience=Grievance::model()->findAll($criteria);
		if($grevience)
			$count=count($grevience);
		return $count;
	
	}
	/*used to Get Total number of pending grievance of distric comment level user
		@author : hemant thakur 
		@param: 
		@return: int
	*/
	static function getTotalPendingGrievanceOfDisttCommentLevelUser(){
		$distDept=UserExt::getUserDistDept($_SESSION['uid']);
		$count=0;
		$Alldistt=UserExt::getUserDistt($_SESSION['email']);
		$distt=0;
		if(!empty($Alldistt))
		  $distt=implode(",",$Alldistt);
		$criteria=new CDbCriteria();
		$criteria->condition="dtl.district_id  IN ($distt) AND dtl.dept_id=:dept_id AND have_replied=:have_replied AND grievance_status=:grievance_status";
		$criteria->params=array(":dept_id"=>$distDept['department_id'],":grievance_status"=>"O",":have_replied"=>"N");
		$criteria->join="inner join bo_grievance_detail dtl on t.grievence_no=dtl.grievence_no";
		$criteria->order="t.grievence_no DESC";
		$grevience=Grievance::model()->findAll($criteria);
		if($grevience)
			$count=count($grevience);
		return $count;
	}
		/*used to Get latest 10 New Grievance of state Nodal user 
			@author : hemant thakur 
			@param: 
			@return: object/boolean(false)
		*/
		static function getLastTenPendingGrievanceOfStateNodal(){
			$criteria=new CDbCriteria();
			$criteria->condition="have_replied=:have_replied AND grievance_status=:grievance_status";
			$criteria->params=array(":grievance_status"=>"O",":have_replied"=>"N");
			$criteria->limit=5;
			$criteria->order="grievence_no DESC";
			$grevience=Grievance::model()->findAll($criteria);
			if($grevience===false)
				return false;
			return $grevience;
		}
		/*used to Get latest 10 New Grievance of comment level user 
			@author : hemant thakur 
			@param: 
			@return: object/boolean(false)
		*/
		static function getLastTenPendingGrievanceOfCommenterUser(){
			$distDept=UserExt::getUserDistDept($_SESSION['uid']);
			$criteria=new CDbCriteria();
			$criteria->limit=5;
			$criteria->condition="dtl.district_id=:distt_id AND dtl.dept_id=:dept_id AND have_replied=:have_replied AND grievance_status=:grievance_status";
			$criteria->params=array(":distt_id"=>$distDept['disctrict_id'],":dept_id"=>$distDept['department_id'],":grievance_status"=>"O",":have_replied"=>"N");
			$criteria->join="inner join bo_grievance_detail dtl on t.grievence_no=dtl.grievence_no";
			$criteria->order="t.grievence_no DESC";
			$grevience=Grievance::model()->findAll($criteria);
			if($grevience===false)
				return false;
			return $grevience;
		}
		/**
		* check for user grievance whether created or not
		*@author Hemant thakur

		*/
		static function hasUserCreatedAnyGrievance($trackId){
			$criteria=new CDbCriteria;
			$criteria->condition="grievence_created_by=:trackId OR grievence_no=:trackId";
			$criteria->params=array("trackId"=>$trackId);
			$criteria->order="grievence_no DESC";
			$grevList=Grievance::model()->findAll($criteria);
			if(empty($grevList))
				return false;
			return true;
		}
		static function getDisttFromGrievanceId($grv_id){
			$connection=Yii::app()->db;
					$sql="select distt.distric_name from bo_grievance_detail  grv
		INNER JOIN bo_district distt
		on distt.district_id= grv.district_id	
		where grievence_no =$grv_id";
			$command=$connection->createCommand($sql);
			$distt=$command->queryRow();
			if($distt===false)
				return false;
			return $distt['distric_name'];
		}
static function getDisttFromGrievanceDeptName($grv_id){
			$connection=Yii::app()->db;
					$sql="select department_name from bo_departments where dept_id in(
							select dept_id from bo_grievance_detail  grv
							INNER JOIN bo_district distt
							on distt.district_id= grv.district_id	
							where grievence_no =$grv_id)";
			$command=$connection->createCommand($sql);
			$distt=$command->queryRow();
			if($distt===false)
				return false;
			return $distt['department_name'];
		}


}
