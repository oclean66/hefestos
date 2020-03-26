<?php

/**
 * This is the model class for table "fcuc".
 *
 * The followings are the available columns in table 'fcuc':
 * @property string $FCUC_Id
 * @property string $FCCU_Id
 * @property string $FCUC_Timestamp
 * @property integer $FCUC_Monto
 * @property integer $FCUC_Saldo
 * @property string $FCUC_Descripcion
 *
 * The followings are the available model relations:
 * @property Fccu $fCCU
 */
class Fcuc extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Fcuc the static model class
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
		return 'fcuc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FCCU_Id, FCUC_Timestamp, FCUC_Monto', 'required'),
			array('FCUC_Monto, FCUC_Saldo', 'numerical', 'integerOnly'=>true),
			array('FCCU_Id', 'length', 'max'=>10),
			array('FCUC_Descripcion', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('FCUC_Id, FCCU_Id, FCUC_Timestamp, FCUC_Monto, FCUC_Saldo, FCUC_Descripcion', 'safe', 'on'=>'search'),
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
			'fCCU' => array(self::BELONGS_TO, 'Fccu', 'FCCU_Id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'FCUC_Id' => 'Fcuc',
			'FCCU_Id' => 'Fccu',
			'FCUC_Timestamp' => 'Fcuc Timestamp',
			'FCUC_Monto' => 'Fcuc Monto',
			'FCUC_Saldo' => 'Fcuc Saldo',
			'FCUC_Descripcion' => 'Fcuc Descripcion',
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

		$criteria->compare('FCUC_Id',$this->FCUC_Id,true);
		$criteria->compare('FCCU_Id',$this->FCCU_Id,true);
		$criteria->compare('FCUC_Timestamp',$this->FCUC_Timestamp,true);
		$criteria->compare('FCUC_Monto',$this->FCUC_Monto);
		$criteria->compare('FCUC_Saldo',$this->FCUC_Saldo);
		$criteria->compare('FCUC_Descripcion',$this->FCUC_Descripcion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public function behaviors() {
        return array(
            // Classname => path to Class
            'LoggableBehavior' =>
            'application.behaviors.ActiveRecordLogableBehavior',
        );
    }
}