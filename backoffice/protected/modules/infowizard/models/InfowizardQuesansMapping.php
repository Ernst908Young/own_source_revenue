<?php

/**
 * This is the model class for table "bo_infowizard_quesans_mapping".
 *
 * The followings are the available columns in table 'bo_infowizard_quesans_mapping':
 * @property integer $queans_mapp_id
 * @property integer $question_id
 * @property integer $anscat_id
 * @property string $answer_detail
 * @property string $is_quesans_active
 * @property string $priority
 * @property string $exclude_question
 * @property string $created
 * @property string $modified
 */
class InfowizardQuesansMapping extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_infowizard_quesans_mapping';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('question_id, anscat_id, answer_detail, priority, created, modified', 'required'),
			array('question_id, anscat_id', 'numerical', 'integerOnly'=>true),
			array('answer_detail', 'length', 'max'=>500),
			array('is_quesans_active', 'length', 'max'=>1),
			array('priority, exclude_question', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('queans_mapp_id, question_id, anscat_id, answer_detail, is_quesans_active, priority, exclude_question, created, modified', 'safe', 'on'=>'search'),
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
			'queans_mapp_id' => 'Queans Mapp',
			'question_id' => 'Question',
			'anscat_id' => 'Anscat',
			'answer_detail' => 'Answer Detail',
			'is_quesans_active' => 'Is Quesans Active',
			'priority' => 'Priority',
			'exclude_question' => 'Exclude Question',
			'created' => 'Created',
			'modified' => 'Modified',
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

		$criteria->compare('queans_mapp_id',$this->queans_mapp_id);
		$criteria->compare('question_id',$this->question_id);
		$criteria->compare('anscat_id',$this->anscat_id);
		$criteria->compare('answer_detail',$this->answer_detail,true);
		$criteria->compare('is_quesans_active',$this->is_quesans_active,true);
		$criteria->compare('priority',$this->priority,true);
		$criteria->compare('exclude_question',$this->exclude_question,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InfowizardQuesansMapping the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
