<?php
	class Utility {
		public  function getAllDept(){
				$model = new DepartmentsExt;
				$allDept = $model->getDept();
				return $allDept;
		}
	}

?>