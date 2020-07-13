<?php

/**
 * This is the model class for table "tccd_has_tccl".
 *
 * The followings are the available columns in table 'tccd_has_tccl':
 * @property integer $tccd_TCCD_Id
 * @property integer $tccl_TCCL_Id
 */
class TccdHasTccl extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TccdHasTccl the static model class
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
		return 'tccd_has_tccl';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tccd_TCCD_Id, tccl_TCCL_Id', 'required'),
			array('tccd_TCCD_Id, tccl_TCCL_Id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('tccd_TCCD_Id, tccl_TCCL_Id', 'safe', 'on'=>'search'),
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
			'tccd_TCCD_Id' => 'Tccd Tccd',
			'tccl_TCCL_Id' => 'Tccl Tccl',
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

		$criteria->compare('tccd_TCCD_Id',$this->tccd_TCCD_Id);
		$criteria->compare('tccl_TCCL_Id',$this->tccl_TCCL_Id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			 'Pagination' => array (
                  'PageSize' => 50 //edit your number items per page here
              ),
		));
	}
}