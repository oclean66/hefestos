<?php

/**
 * This is the model class for table "pcue".
 *
 * The followings are the available columns in table 'pcue':
 * @property string $PCUE_Id
 * @property string $PCUE_Descripcion
 * @property string $PCUE_Action
 * @property string $PCUE_Model
 * @property string $PCUE_IdModel
 * @property string $PCUE_Field
 * @property string $PCUE_Date
 * @property string $PCUE_UserId
 * @property string $PCUE_Detalles
 */
class Pcue extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pcue the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
         public function getTraduccion() {
        return CrugeTranslator::t("classes", $this->PCUE_Model);
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pcue';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PCUE_UserId', 'required'),
			array('PCUE_Descripcion', 'length', 'max'=>350),
			array('PCUE_Action', 'length', 'max'=>20),
			array('PCUE_Model, PCUE_Field, PCUE_UserId', 'length', 'max'=>45),
			array('PCUE_IdModel', 'length', 'max'=>10),
			array('PCUE_Detalles', 'length', 'max'=>1000),
			array('PCUE_Date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PCUE_Id, PCUE_Descripcion, PCUE_Action, PCUE_Model, PCUE_IdModel, PCUE_Field, PCUE_Date, PCUE_UserId, PCUE_Detalles', 'safe', 'on'=>'search'),
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
			'PCUE_Id' => 'Id',
			'PCUE_Descripcion' => 'Descripcion',
			'PCUE_Action' => 'Evento',
			'PCUE_Model' => 'Lugar',
			'PCUE_IdModel' => 'Id Referencia',
			'PCUE_Field' => 'Campos',
			'PCUE_Date' => 'Fecha',
			'PCUE_UserId' => 'Usuario',
			'PCUE_Detalles' => 'Detalles',
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

		$criteria->compare('PCUE_Id',$this->PCUE_Id,true);
		$criteria->compare('PCUE_Descripcion',$this->PCUE_Descripcion,true);
		$criteria->compare('PCUE_Action',$this->PCUE_Action,true);
		$criteria->compare('PCUE_Model',$this->PCUE_Model,true);
		$criteria->compare('PCUE_IdModel',$this->PCUE_IdModel,true);
		$criteria->compare('PCUE_Field',$this->PCUE_Field,true);
		$criteria->compare('PCUE_Date',$this->PCUE_Date,true);
		$criteria->compare('PCUE_UserId',$this->PCUE_UserId,true);
		$criteria->compare('PCUE_Detalles',$this->PCUE_Detalles,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
       
}