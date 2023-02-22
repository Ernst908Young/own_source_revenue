<?php

/**
 * This is the model class for table "bo_application_approve_level".
 *
 * The followings are the available columns in table 'bo_application_approve_level':
 * @property string $appr_lvl_id
 * @property string $role_id
 * @property string $approval_user_id
 * @property string $app_id
 * @property string $approval_user_comment
 * @property string $approv_status
 *
 * The followings are the available model relations:
 * @property Applications $app
 * @property User $approvalUser
 * @property Roles $role
 */
class ApplicationApproveLevel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_application_approve_level';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role_id, app_id', 'required'),
			array('role_id, approval_user_id, app_id', 'length', 'max'=>10),
			array('approv_status', 'length', 'max'=>1),
			array('approval_user_comment', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('appr_lvl_id, role_id, approval_user_id, app_id, approval_user_comment, approv_status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'app' => array(self::BELONGS_TO, 'Applications', 'app_id'),
			'approvalUser' => array(self::BELONGS_TO, 'User', 'approval_user_id'),
			'role' => array(self::BELONGS_TO, 'Roles', 'role_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'appr_lvl_id' => 'Appr Lvl',
			'role_id' => 'Role',
			'approval_user_id' => 'Approval User',
			'app_id' => 'App',
			'approval_user_comment' => 'Approval User Comment',
			'approv_status' => 'Approv Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('appr_lvl_id',$this->appr_lvl_id,true);
		$criteria->compare('role_id',$this->role_id,true);
		$criteria->compare('approval_user_id',$this->approval_user_id,true);
		$criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('approval_user_comment',$this->approval_user_comment,true);
		$criteria->compare('approv_status',$this->approv_status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ApplicationApproveLevel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
