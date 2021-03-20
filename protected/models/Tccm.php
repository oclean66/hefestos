<?php

/**
 * This is the model class for table "tccm".
 *
 * The followings are the available columns in table 'tccm':
 * @property integer $TCCM_Id
 * @property integer $TCCM_IdModel
 * @property string $TCCM_Model
 * @property integer $TCCM_IdUser
 * @property string $TCCM_Status
 */
class Tccm extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tccm the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tccm';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TCCM_IdModel, TCCM_IdUser', 'numerical', 'integerOnly'=>true),
			array('TCCM_Model, TCCM_Status', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TCCM_Id, TCCM_IdModel, TCCM_Model, TCCM_IdUser, TCCM_Status', 'safe', 'on'=>'search'),
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
			'TCCM_Id' => 'Tccm',
			'TCCM_IdModel' => 'Tccm Id Model',
			'TCCM_Model' => 'Tccm Model',
			'TCCM_IdUser' => 'Tccm Id User',
			'TCCM_Status' => 'Tccm Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('TCCM_Id',$this->TCCM_Id);
		$criteria->compare('TCCM_IdModel',$this->TCCM_IdModel);
		$criteria->compare('TCCM_Model',$this->TCCM_Model,true);
		$criteria->compare('TCCM_IdUser',$this->TCCM_IdUser);
		$criteria->compare('TCCM_Status',$this->TCCM_Status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			 'Pagination' => array (
                  'PageSize' => 50 //edit your number items per page here
              ),
		));
	}
}