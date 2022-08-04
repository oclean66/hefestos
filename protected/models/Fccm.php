<?php

/**
 * This is the model class for table "fccl".
 *
 * The followings are the available columns in table 'fccl':
 * @property string $FCCM_Id
 * @property string $FCCM_Descripcion
 *
 * @property Fcuu $fCUU
 * @property Fccm[] $fcct
 */
class Fccm extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Fccl the static model class
	 */

	public function getTotal()
	{
		return Fccu::model()->count("FCCM_Id =  ".$this->FCCM_Id);
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
		return 'fccm';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FCCM_Descripcion', 'required'),
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
			'Fccu' => array(self::HAS_MANY, 'fccu', 'FCCM_Id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'FCCM_Id' => 'Id',
			'FCCM_Descripcion' => 'Descripcion',
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

		$criteria->compare('FCCM_Id', $this->FCCM_Id, true);
		$criteria->compare('FCCM_Descripcion', $this->FCCM_Descripcion, true);
 

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
