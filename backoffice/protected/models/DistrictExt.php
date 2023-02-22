<?php
	class DistrictExt extends District{
		/**
		* This function is used to get the district name from the distric ID
		*@author : Hemant Thakur
		*@param  int distric_id
		*@return distric_name/false
		*/
		public static function getDistricNameById($id){
			if(empty($id))
				return false;
			$criterial= new CDbCriteria();
			$criterial->select="distric_name";
			$criterial->condition="district_id=:id";
			$criterial->params=array(":id"=>$id);
			$distric_name=District::model()->find($criterial);
			if(empty($distric_name))
				return false;
			else
				return $distric_name->distric_name;
		} 
	}
?>