<?php

/**
 * This is the model class for table "bo_infowizard_formvariable_master".
 *
 * The followings are the available columns in table 'bo_infowizard_formvariable_master':
 * @property integer $formvar_id
 * @property string $formchk_id
 * @property integer $parent_id
 * @property string $name
 * @property string $created_date
 * @property string $is_formvar_active
 */
class InfowizardFormvariableMaster extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_infowizard_formvariable_master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('formchk_id, name, created_date', 'required'),
			array('parent_id,category_id', 'numerical', 'integerOnly'=>true),
			array('formchk_id', 'length', 'max'=>50),
			array('formchk_id','unique', 'message'=>'formchk_id Id already accupied.'),
			array('name', 'length', 'max'=>1000),
			array('name','unique', 'message'=>'Form Field Name is already accupied.'),
		    //array('column_name', 'length', 'max'=>255),
		    //array('column_name','unique', 'message'=>'Colunm Name is already accupied.'),
			array('is_formvar_active', 'length', 'max'=>1),
			array('is_editable', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('formvar_id, formchk_id, category_id ,parent_id, name, is_editable, created_date, is_formvar_active', 'safe', 'on'=>'search'),
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
			'formvar_id' => 'Formvar',
			'formchk_id' => 'Formchk',
			'parent_id' => 'Parent',
			'category_id' => 'Category',                    
			'name' => 'Name',
			'is_editable'=>'Is editable',
			'created_date' => 'Created Date',
			'is_formvar_active' => 'Is Formvar Active',
		);
	}
	//'column_name' => 'Column Name',

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

		$criteria->compare('formvar_id',$this->formvar_id);
		$criteria->compare('formchk_id',$this->formchk_id,true);
		$criteria->compare('parent_id',$this->parent_id);
                $criteria->compare('category_id',$this->category_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('is_editable',$this->is_editable,true);
	//	$criteria->compare('column_name',$this->column_name,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('is_formvar_active',$this->is_formvar_active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InfowizardFormvariableMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
