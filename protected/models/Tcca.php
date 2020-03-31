<?php

/**
 * This is the model class for table "tcca".
 *
 * The followings are the available columns in table 'tcca':
 * @property integer $TCCA_Id
 * @property string $TCCA_Name
 * @property integer $TCCA_Type
 * @property integer $TCCA_BoardId
 *
 * The followings are the available model relations:
 * @property Tcca $tCCABoard
 * @property Tcca[] $tccas
 * @property Tccd[] $tccds
 */
class Tcca extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tcca the static model class
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
		return 'tcca';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TCCA_Type, TCCA_BoardId', 'numerical', 'integerOnly'=>true),
			array('TCCA_Name', 'length', 'max'=>80),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TCCA_Id, TCCA_Name, TCCA_Type, TCCA_BoardId', 'safe', 'on'=>'search'),
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
			'tCCABoard' => array(self::BELONGS_TO, 'Tcca', 'TCCA_BoardId'),
			'tccas' => array(self::HAS_MANY, 'Tcca', 'TCCA_BoardId'),
			'tccds' => array(self::HAS_MANY, 'Tccd', 'TCCA_Id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'TCCA_Id' => 'Tcca',
			'TCCA_Name' => 'Tcca Name',
			'TCCA_Type' => 'Tcca Type',
			'TCCA_BoardId' => 'Tcca Board',
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

		$criteria->compare('TCCA_Id',$this->TCCA_Id);
		$criteria->compare('TCCA_Name',$this->TCCA_Name,true);
		$criteria->compare('TCCA_Type',$this->TCCA_Type);
		$criteria->compare('TCCA_BoardId',$this->TCCA_BoardId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			 'Pagination' => array (
                  'PageSize' => 50 //edit your number items per page here
              ),
		));
	}
}