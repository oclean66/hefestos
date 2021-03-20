<?php

/**
 * This is the model class for table "tccl".
 *
 * The followings are the available columns in table 'tccl':
 * @property integer $TCCL_Id
 * @property string $TCCL_Label
 * @property string $TCCL_Color
 * @property string $TCCL_Icon
 *
 * The followings are the available model relations:
 * @property Tccd[] $tccds
 */
class Tccl extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tccl the static model class
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
		return 'tccl';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TCCL_Label, TCCL_Color, TCCL_Icon', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TCCL_Id, TCCL_Label, TCCL_Color, TCCL_Icon', 'safe', 'on'=>'search'),
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
			'tccds' => array(self::MANY_MANY, 'Tccd', 'tccd_has_tccl(tccl_TCCL_Id, tccd_TCCD_Id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'TCCL_Id' => 'Tccl',
			'TCCL_Label' => 'Tccl Label',
			'TCCL_Color' => 'Tccl Color',
			'TCCL_Icon' => 'Tccl Icon',
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

		$criteria->compare('TCCL_Id',$this->TCCL_Id);
		$criteria->compare('TCCL_Label',$this->TCCL_Label,true);
		$criteria->compare('TCCL_Color',$this->TCCL_Color,true);
		$criteria->compare('TCCL_Icon',$this->TCCL_Icon,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			 'Pagination' => array (
                  'PageSize' => 50 //edit your number items per page here
              ),
		));
	}
}