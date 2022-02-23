<?php

/**
 * This is the model class for table "gcca_public".
 *
 * The followings are the available columns in table 'gcca_public':
 * @property integer $PUBLIC_Id
 * @property string $PUBLIC_GCCD_Id
 * @property string $PUBLIC
 * @property string $GCCD_Id
 *
 * The followings are the available model relations:
 * @property Gccd $gCCD
 */
class GccaPublic extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GccaPublic the static model class
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
		return 'gcca_public';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('GCCD_Id', 'required'),
			array('PUBLIC_GCCD_Id', 'length', 'max'=>50),
			array('PUBLIC', 'length', 'max'=>145),
			array('GCCD_Id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PUBLIC_Id, PUBLIC_GCCD_Id, PUBLIC, GCCD_Id', 'safe', 'on'=>'search'),
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
			'gCCD' => array(self::BELONGS_TO, 'Gccd', 'GCCD_Id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PUBLIC_Id' => 'Public',
			'PUBLIC_GCCD_Id' => 'Public Gccd',
			'PUBLIC' => 'Public',
			'GCCD_Id' => 'Gccd',
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

		$criteria->compare('PUBLIC_Id',$this->PUBLIC_Id);
		$criteria->compare('PUBLIC_GCCD_Id',$this->PUBLIC_GCCD_Id,true);
		$criteria->compare('PUBLIC',$this->PUBLIC,true);
		$criteria->compare('GCCD_Id',$this->GCCD_Id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			 'Pagination' => array (
                  'PageSize' => 100 //edit your number items per page here
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