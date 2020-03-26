<?php

/**
 * This is the model class for table "fccs".
 *
 * The followings are the available columns in table 'fccs':
 * @property string $FCCS_Id
 * @property string $FCCS_Fecha
 * @property string $FCCS_Control
 *
 * The followings are the available model relations:
 * @property Fccu[] $fccus
 */
class Fccs extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Fccs the static model class
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
		return 'fccs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FCCS_Control', 'required'),
			array('FCCS_Fecha, FCCS_Control', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('FCCS_Id, FCCS_Fecha, FCCS_Control', 'safe', 'on'=>'search'),
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
			'fccus' => array(self::HAS_MANY, 'Fccu', 'FCCS_Id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'FCCS_Id' => 'Fccs',
			'FCCS_Fecha' => 'Fccs Fecha',
			'FCCS_Control' => 'Fccs Control',
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

		$criteria->compare('FCCS_Id',$this->FCCS_Id,true);
		$criteria->compare('FCCS_Fecha',$this->FCCS_Fecha,true);
		$criteria->compare('FCCS_Control',$this->FCCS_Control,true);

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