<?php

/**
 * This is the model class for table "la_auction_detail".
 *
 * The followings are the available columns in table 'la_auction_detail':
 * @property integer $auc_id
 * @property integer $district_id
 * @property integer $estate_id
 * @property integer $plot_id
 * @property string $auc_start_date
 * @property string $auc_end_date
 * @property string $is_active
 * @property string $auc_status
 * @property string $created_date
 * @property string $remote_ip
 * @property string $user_agent
 */
class LaAuctionDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'la_auction_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('district_id, estate_id, plot_id, auc_start_date, auc_end_date, is_active, created_date, remote_ip, user_agent', 'required'),
			array('district_id, estate_id, plot_id', 'numerical', 'integerOnly'=>true),
			array('is_active, auc_status', 'length', 'max'=>1),
			array('remote_ip, user_agent', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('auc_id, district_id, estate_id, plot_id, auc_start_date, auc_end_date, is_active, auc_status, created_date, remote_ip, user_agent', 'safe', 'on'=>'search'),
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
			'auc_id' => 'Auc',
			'district_id' => 'District',
			'estate_id' => 'Estate',
			'plot_id' => 'Plot',
			'auc_start_date' => 'Auc Start Date',
			'auc_end_date' => 'Auc End Date',
			'is_active' => 'Is Active',
			'auc_status' => 'Auc Status',
			'created_date' => 'Created Date',
			'remote_ip' => 'Remote Ip',
			'user_agent' => 'User Agent',
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

		$criteria->compare('auc_id',$this->auc_id);
		$criteria->compare('district_id',$this->district_id);
		$criteria->compare('estate_id',$this->estate_id);
		$criteria->compare('plot_id',$this->plot_id);
		$criteria->compare('auc_start_date',$this->auc_start_date,true);
		$criteria->compare('auc_end_date',$this->auc_end_date,true);
		$criteria->compare('is_active',$this->is_active,true);
		$criteria->compare('auc_status',$this->auc_status,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('remote_ip',$this->remote_ip,true);
		$criteria->compare('user_agent',$this->user_agent,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LaAuctionDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
