<?php

/**
 * This is the model class for table "du_pis_mou_linkage_relation".
 *
 * The followings are the available columns in table 'du_pis_mou_linkage_relation':
 * @property integer $id
 * @property string $company_name
 * @property string $representative_name
 * @property string $phone_number
 * @property string $email_id
 * @property string $project_detail
 * @property integer $sector
 * @property string $pis_proposed_investment_type
 * @property double $pis_proposed_investment_rs
 * @property string $pis_upload
 * @property string $mou_proposed_investment_type
 * @property double $mou_proposed_investment_rs
 * @property string $mou_upload
 * @property string $is_active
 * @property string $created
 * @property string $modified
 */
class PisMouLinkage extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'du_pis_mou_linkage_relation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
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

		/* $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('linkage_ids',$this->linkage_ids,true);
		$criteria->compare('representative_name',$this->representative_name,true);
		$criteria->compare('phone_number',$this->phone_number,true);
		$criteria->compare('email_id',$this->email_id,true);
		$criteria->compare('project_detail',$this->project_detail,true);
		$criteria->compare('sector',$this->sector);
		$criteria->compare('pis_proposed_investment_type',$this->pis_proposed_investment_type,true);
		$criteria->compare('pis_proposed_investment_rs',$this->pis_proposed_investment_rs);
		$criteria->compare('pis_upload',$this->pis_upload,true);
		$criteria->compare('mou_proposed_investment_type',$this->mou_proposed_investment_type,true);
		$criteria->compare('mou_proposed_investment_rs',$this->mou_proposed_investment_rs);
		$criteria->compare('mou_upload',$this->mou_upload,true);
		$criteria->compare('is_active',$this->is_active,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		)); */
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PisMou the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
