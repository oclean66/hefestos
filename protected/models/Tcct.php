<?php

/**
 * This is the model class for table "tcct".
 *
 * The followings are the available columns in table 'tcct':
 * @property integer $TCCT_Id
 * @property string $TCCT_Timestamp
 * @property string $TCCT_Text
 * @property integer $TCCT_IdUser
 * @property string $TCCT_Type
 * @property integer $TCCD_Id
 *
 * The followings are the available model relations:
 * @property Tccd $tCCD
 */
class Tcct extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tcct the static model class
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
		return 'tcct';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TCCD_Id', 'required'),
			array('TCCT_IdUser, TCCD_Id', 'numerical', 'integerOnly'=>true),
			array('TCCT_Type', 'length', 'max'=>45),
			array('TCCT_Timestamp, TCCT_Text', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TCCT_Id, TCCT_Timestamp, TCCT_Text, TCCT_IdUser, TCCT_Type, TCCD_Id', 'safe', 'on'=>'search'),
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
			'tCCD' => array(self::BELONGS_TO, 'Tccd', 'TCCD_Id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'TCCT_Id' => 'Tcct',
			'TCCT_Timestamp' => 'Tcct Timestamp',
			'TCCT_Text' => 'Tcct Text',
			'TCCT_IdUser' => 'Tcct Id User',
			'TCCT_Type' => 'Tcct Type',
			'TCCD_Id' => 'Tccd',
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

		$criteria->compare('TCCT_Id',$this->TCCT_Id);
		$criteria->compare('TCCT_Timestamp',$this->TCCT_Timestamp,true);
		$criteria->compare('TCCT_Text',$this->TCCT_Text,true);
		$criteria->compare('TCCT_IdUser',$this->TCCT_IdUser);
		$criteria->compare('TCCT_Type',$this->TCCT_Type,true);
		$criteria->compare('TCCD_Id',$this->TCCD_Id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			 'Pagination' => array (
                  'PageSize' => 50 //edit your number items per page here
              ),
		));
	}
}