<?php

/**
 * This is the model class for table "tcga".
 *
 * The followings are the available columns in table 'tcga':
 * @property integer $TCGA_Id
 * @property integer $TCCD_Id
 * @property string $GCCA_Id
 *
 * The followings are the available model relations:
 * @property Gcca $gCCA
 * @property Tccd $tCCD
 */
class Tcga extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tcga the static model class
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
		return 'tcga';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TCCD_Id, GCCA_Id', 'required'),
			array('TCCD_Id', 'numerical', 'integerOnly'=>true),
			array('GCCA_Id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TCGA_Id, TCCD_Id, GCCA_Id', 'safe', 'on'=>'search'),
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
			'gCCA' => array(self::BELONGS_TO, 'Gcca', 'GCCA_Id'),
			'tCCD' => array(self::BELONGS_TO, 'Tccd', 'TCCD_Id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'TCGA_Id' => 'Tcga',
			'TCCD_Id' => 'Tccd',
			'GCCA_Id' => 'Gcca',
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

		$criteria->compare('TCGA_Id',$this->TCGA_Id);
		$criteria->compare('TCCD_Id',$this->TCCD_Id);
		$criteria->compare('GCCA_Id',$this->GCCA_Id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			 'Pagination' => array (
                  'PageSize' => 50 //edit your number items per page here
              ),
		));
	}
}