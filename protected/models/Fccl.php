<?php

/**
 * This is the model class for table "fccl".
 *
 * The followings are the available columns in table 'fccl':
 * @property string $FCCL_Id
 * @property string $FCCL_Descripcion
 *
 * @property Fcuu $fCUU
 * @property Fcct[] $fccts
 */
class Fccl extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Fccl the static model class
	 */

	public function getTotal()
	{
		return FcclHasFccu::model()->count("fccl_FCCL_Id =  ".$this->FCCL_Id);
	}

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fccl';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FCCL_Descripcion', 'required'),
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
			'fccls' => array(self::HAS_MANY, 'Fccu', 'FCCL_Id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'FCCL_Id' => 'Id',
			'FCCL_Descripcion' => 'Descripcion',
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

		$criteria = new CDbCriteria;

		$criteria->compare('FCCL_Id', $this->FCCL_Id, true);
		$criteria->compare('FCCL_Descripcion', $this->FCCL_Descripcion, true);
 

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageSize' => 50,
			),
		));
	}
	public function behaviors()
	{
		return array(
			// Classname => path to Class
			'LoggableBehavior' =>
			'application.behaviors.ActiveRecordLogableBehavior',
		);
	}
}
