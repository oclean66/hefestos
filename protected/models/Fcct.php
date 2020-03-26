<?php

/**
 * This is the model class for table "fcct".
 *
 * The followings are the available columns in table 'fcct':
 * @property string $FCCT_Id
 * @property string $FCCT_Descripcion
 * @property string $FCCA_Id
 *
 * The followings are the available model relations:
 * @property Fcca $fCCA
 * @property Fccu[] $fccus
 */
class Fcct extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Fcct the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

public function getConcatened() {
        return $this->FCCT_Descripcion . ' - ' . $this->fCCA->FCCA_Descripcion;
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fcct';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FCCT_Descripcion, FCCA_Id', 'required'),
			array('FCCT_Descripcion', 'length', 'max'=>150),
			array('FCCA_Id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('FCCT_Id, FCCT_Descripcion, FCCA_Id', 'safe', 'on'=>'search'),
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
			'fCCA' => array(self::BELONGS_TO, 'Fcca', 'FCCA_Id'),
			'fccus' => array(self::HAS_MANY, 'Fccu', 'FCCT_Id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'FCCT_Id' => 'Id',
			'FCCT_Descripcion' => 'Descripcion',
			'FCCA_Id' => 'Tipo',
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

		$criteria->compare('FCCT_Id',$this->FCCT_Id,true);
		$criteria->compare('FCCT_Descripcion',$this->FCCT_Descripcion,true);
		$criteria->compare('FCCA_Id',$this->FCCA_Id,true); 

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>500,
		), 
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