
<?php

/**
 * This is the model class for table "bo_infowiz_page_master".
 *
 * The followings are the available columns in table 'bo_infowiz_page_master':
 * @property string $id
 * @property string $company_type
 * @property string $srn_no
 * @property string $name_related_srn
 * @property string $service_id
 * @property string $reg_no
 * @property string $company_name
 * @property string $address
 * @property string $user_id	
 * @property string $approved_by
 * @property string $created_on
 * @property string $is_active 
 */
class BoCompanyDetails extends CActiveRecord  
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_company_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		
		
			array('id, company_type, srn_no, name_related_srn, service_id, reg_no,
				company_name, address, user_id, approved_by, created_on, is_active, address_line1, address_line2, state_parish_id, postal_code_id, country, city, state_parish, postal_code, country', 'safe'),
		);
	}

	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getreg_no($c_type=NULL){
		switch ($c_type) {
			case 'IC':
					$condition = "WHERE company_type IN ('IC','NPC','EC')";
					$init_val = Yii::app()->params['CR_IN'];
				break;
			case 'NPC':
					$condition = "WHERE company_type IN ('IC','NPC','EC')";
					$init_val = Yii::app()->params['CR_IN'];
				break;
			case 'EC':
					$condition = "WHERE company_type IN ('IC','NPC','EC')";
					$init_val = Yii::app()->params['CR_IN'];
				break;

			case 'CH':
					$condition = "WHERE company_type IN ('CH','CHB')";
					$init_val = Yii::app()->params['CHR_IN'];
				break;
			case 'CHB':
					$condition = "WHERE company_type IN ('CH','CHB')";
					$init_val = Yii::app()->params['CHR_IN'];
				break;

			case 'S':
					$condition = "WHERE company_type IN ('S')";
					$init_val = Yii::app()->params['SR_IN'];
				break;

			case 'LP':
					$condition = "WHERE company_type IN ('LP')";
					$init_val = Yii::app()->params['LPR_IN'];
				break;

			case 'BUS':
					$condition = "WHERE company_type IN ('BUS')";
					$init_val = Yii::app()->params['BR_IN'];
				break;

			default:
					$condition = '';
					$init_val  = "NA";
				break;
		}

		$reco = Yii::app()->db->createCommand("SELECT IFNULL (reg_no,0) as reg_no FROM bo_company_details $condition AND is_active=1 ORDER BY created_on DESC")->queryRow();
		if($reco['reg_no']==0){
			return $init_val;
		}else{
			return $reco['reg_no']+1;
		}
		
	}
}
