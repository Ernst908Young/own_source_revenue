<?php
class LandregionExt extends Landregion{
	public static function getLandRegionNameViaId($lr_id){
		$criteria=new CDbCriteria;
		$criteria->condition="lr_id=:lr_id";
		$criteria->params=array(":lr_id"=>$lr_id);
		$criteria->select="lr_name";
		$lr_name=Landregion::model()->find($criteria);
		if(empty($lr_name))
			return false;
		else
			return $lr_name->lr_name;
	}
}
?>