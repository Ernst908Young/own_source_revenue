<?php

/**
 * This is the model class for table "la_auction_plots".
 *
 * The followings are the available columns in table 'la_auction_plots':
 * @property integer $auc_plot_id
 * @property string $estate_id
 * @property string $area_name
 * @property double $plot_area
 * @property string $is_active
 * @property string $created_on
 */
class LaAuctionPlots extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'la_auction_plots';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('estate_id, area_name, plot_area, is_active, created_on', 'required'),
			array('plot_area', 'numerical'),
			array('estate_id', 'length', 'max'=>20),
			array('area_name', 'length', 'max'=>255),
			array('is_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('auc_plot_id, estate_id, area_name, plot_area, is_active, created_on', 'safe', 'on'=>'search'),
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
			'auc_plot_id' => 'Auc Plot',
			'estate_id' => 'Estate',
			'area_name' => 'Area Name',
			'plot_area' => 'Plot Area',
			'is_active' => 'Is Active',
			'created_on' => 'Created On',
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

		$criteria->compare('auc_plot_id',$this->auc_plot_id);
		$criteria->compare('estate_id',$this->estate_id,true);
		$criteria->compare('area_name',$this->area_name,true);
		$criteria->compare('plot_area',$this->plot_area);
		$criteria->compare('is_active',$this->is_active,true);
		$criteria->compare('created_on',$this->created_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LaAuctionPlots the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
