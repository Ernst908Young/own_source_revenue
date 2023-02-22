<?php

/**
 * This is the model class for table "supportmain".
 *
 * The followings are the available columns in table 'supportmain':
 * @property integer $supportmessagescode
 * @property string $message 
 * @property integer $usercode
  * @property string $usertype
 * @property integer $supportmaincode
 * @property string $msgdatetime
*/
class Supportmessages extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'supportmessages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('service_id, page_name', 'required'),		
			
			array('message, usercode, supportmaincode, msgdatetime, usertype', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('supportmessagescode, message, usercode, supportmaincode, msgdatetime, usertype', 'safe', 'on'=>'search'),
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
			'supportmessagescode' => 'Supportmessagescode',
			'message' => 'Message',
			'usercode' => 'Usercode ',
			'supportmaincode' => 'Supportmaincode ',
			'msgdatetime' => 'Msgdatetime'
		
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

		$criteria->compare('supportmessagescode',$this->supportmessagescode);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('usercode',$this->usercode,true);
		$criteria->compare('supportmaincode',$this->supportmaincode,true);
		$criteria->compare('msgdatetime',$this->msgdatetime,true);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BoInfowizPageMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
