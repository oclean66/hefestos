<?php

/**
 * This is the model class for table "tccn".
 *
 * The followings are the available columns in table 'tccn':
 * @property integer $TCCN_Id
 * @property string $TCCN_Title
 * @property integer $TCCN_Thread
 * @property string $TCCN_Url
 * @property string $TCCN_Created
 * @property string $TCCN_Read
 * @property integer $TCCN_IdUSer
 */
class Tccn extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tccn the static model class
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
		return 'tccn';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TCCN_Thread, TCCN_IdUSer', 'numerical', 'integerOnly'=>true),
			array('TCCN_Title', 'length', 'max'=>160),
			array('TCCN_Url', 'length', 'max'=>160),
			array('TCCN_Created, TCCN_Read', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TCCN_Id, TCCN_Title, TCCN_Thread, TCCN_Url, TCCN_Created, TCCN_Read, TCCN_IdUSer', 'safe', 'on'=>'search'),
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
			'TCCN_Id' => 'Tccn',
			'TCCN_Title' => 'Tccn Title',
			'TCCN_Thread' => 'Tccn Thread',
			'TCCN_Url' => 'Tccn Url',
			'TCCN_Created' => 'Tccn Created',
			'TCCN_Read' => 'Tccn Read',
			'TCCN_IdUSer' => 'Tccn Id User',
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

		$criteria->compare('TCCN_Id',$this->TCCN_Id);
		$criteria->compare('TCCN_Title',$this->TCCN_Title,true);
		$criteria->compare('TCCN_Thread',$this->TCCN_Thread);
		$criteria->compare('TCCN_Url',$this->TCCN_Url,true);
		$criteria->compare('TCCN_Created',$this->TCCN_Created,true);
		$criteria->compare('TCCN_Read',$this->TCCN_Read,true);
		$criteria->compare('TCCN_IdUSer',$this->TCCN_IdUSer);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			 'Pagination' => array (
                  'PageSize' => 50 //edit your number items per page here
              ),
		));
	}
}