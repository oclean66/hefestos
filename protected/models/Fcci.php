<?php

/**
 * This is the model class for table "fcci".
 *
 * The followings are the available columns in table 'fcci':
 * @property string $FCCI_Id
 * @property string $FCCI_Descripcion
 *
 * The followings are the available model relations:
 * @property Fccu[] $fccus
 */
class Fcci extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Fcci the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getTotal(){
		return Fccu::model()->count('FCCI_Id = '.$this->FCCI_Id);
	}
	public function getConcatened(){
		return $this->FCCI_Id." - ".$this->FCCI_Descripcion;
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fcci';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FCCI_Descripcion', 'required'),
			array('FCCI_Descripcion', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('FCCI_Id, FCCI_Descripcion', 'safe', 'on'=>'search'),
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
			'fccus' => array(self::HAS_MANY, 'Fccu', 'FCCI_Id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'FCCI_Id' => 'Id',
			'FCCI_Descripcion' => 'Descripcion',
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

		$criteria->compare('FCCI_Id',$this->FCCI_Id,true);
		$criteria->compare('FCCI_Descripcion',$this->FCCI_Descripcion,true);

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