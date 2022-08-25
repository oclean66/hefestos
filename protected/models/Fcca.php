<?php

/**
 * This is the model class for table "fcca".
 *
 * The followings are the available columns in table 'fcca':
 * @property string $FCCA_Id
 * @property string $FCCA_Descripcion
 * @property string $FCUU_Id
 * @property string $FCCA_StockMin
 * @property string $FCCA_StockMax
 * @property string $FCCA_Stock
 *
 * The followings are the available model relations:
 * @property Fcuu $fCUU
 * @property Fcct[] $fccts
 */
class Fcca extends CActiveRecord
{ 
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Fcca the static model class
	 */

	public function getTotal()
	{
		$list = $this->fccts;
		$total = 0;
		foreach ($list as $key => $value) {
			$total += $value->total;
		}
		return $total;
	}

	public function getEstadisticas()
	{
		return Fcct::model()->count('FCCA_Id = ' . $this->FCCA_Id);
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
		return 'fcca';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FCCA_Descripcion, FCUU_Id', 'required'),
			array('FCCA_Descripcion', 'length', 'max' => 45),
			array('FCUU_Id,FCCA_StockMin,FCCA_StockMax,FCCA_Stock', 'length', 'max' => 10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('FCCA_Id, FCCA_Descripcion, FCUU_Id,FCCA_StockMin,FCCA_StockMax,FCCA_Stock', 'safe', 'on' => 'search'),
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
			'fCUU' => array(self::BELONGS_TO, 'Fcuu', 'FCUU_Id'),
			'fccts' => array(self::HAS_MANY, 'Fcct', 'FCCA_Id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'FCCA_Id' => 'Id',
			'FCCA_Descripcion' => 'Descripcion',
			'FCUU_Id' => 'Categoria',
			'FCCA_StockMin'=>'Stock Minimo',
			'FCCA_StockMax'=>'Stock Maximo',
			'FCCA_Stock'=>'Stock disponible',

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

		$criteria->compare('FCCA_Id', $this->FCCA_Id, true);
		$criteria->compare('FCCA_Descripcion', $this->FCCA_Descripcion, true);
		$criteria->compare('FCUU_Id', $this->FCUU_Id, true);
		$criteria->compare('FCCA_StockMin', $this->FCCA_StockMin, true);
		$criteria->compare('FCCA_StockMax', $this->FCCA_StockMax, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageSize' => 500,
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
