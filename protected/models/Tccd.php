<?php

/**
 * This is the model class for table "tccd".
 *
 * The followings are the available columns in table 'tccd':
 * @property integer $TCCD_Id
 * @property string $TCCD_Title
 * @property string $TCCD_Description
 * @property string $TCCD_Created
 * @property string $TCCD_Expired
 * @property string $TCCD_Archived
 * @property integer $TCCD_Order
 * @property integer $TCCA_Id
 *
 * The followings are the available model relations:
 * @property Tcca $tCCA
 * @property Tccl[] $tccls
 * @property Tcct[] $tccts
 */
class Tccd extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tccd the static model class
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
		return 'tccd';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TCCA_Id', 'required'),
			array('TCCD_Order, TCCA_Id', 'numerical', 'integerOnly'=>true),
			array('TCCD_Title', 'length', 'max'=>160),
			array('TCCD_Description, TCCD_Created, TCCD_Expired, TCCD_Archived', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TCCD_Id, TCCD_Title, TCCD_Description, TCCD_Created, TCCD_Expired, TCCD_Archived, TCCD_Order, TCCA_Id', 'safe', 'on'=>'search'),
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
			'tCCA' => array(self::BELONGS_TO, 'Tcca', 'TCCA_Id'),
			'tccls' => array(self::MANY_MANY, 'Tccl', 'tccd_has_tccl(tccd_TCCD_Id, tccl_TCCL_Id)'),
			'tccts' => array(self::HAS_MANY, 'Tcct', 'TCCD_Id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'TCCD_Id' => 'Tccd',
			'TCCD_Title' => 'Tccd Title',
			'TCCD_Description' => 'Tccd Description',
			'TCCD_Created' => 'Tccd Created',
			'TCCD_Expired' => 'Tccd Expired',
			'TCCD_Archived' => 'Tccd Archived',
			'TCCD_Order' => 'Tccd Order',
			'TCCA_Id' => 'Tcca',
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

		$criteria->compare('TCCD_Id',$this->TCCD_Id);
		$criteria->compare('TCCD_Title',$this->TCCD_Title,true);
		$criteria->compare('TCCD_Description',$this->TCCD_Description,true);
		$criteria->compare('TCCD_Created',$this->TCCD_Created,true);
		$criteria->compare('TCCD_Expired',$this->TCCD_Expired,true);
		$criteria->compare('TCCD_Archived',$this->TCCD_Archived,true);
		$criteria->compare('TCCD_Order',$this->TCCD_Order);
		$criteria->compare('TCCA_Id',$this->TCCA_Id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			 'Pagination' => array (
                  'PageSize' => 50 //edit your number items per page here
              ),
		));
	}
}