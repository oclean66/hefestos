<?php

/**
 * This is the model class for table "fccl_has_fccu".
 *
 * The followings are the available columns in table 'fccl_has_fccu':
 * @property integer $fccl_FCCL_Id
 * @property integer $fccu_FCCU_Id
 * @property Fccu $fCCU
 */
class FcclHasFccu extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
    
	public function tableName()
	{
		return 'fccl_has_fccu';
	}
 
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fccl_FCCL_Id, fccu_FCCU_Id', 'required'),

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
			'Fccl' => array(self::BELONGS_TO, 'Fccl', 'fccl_FCCL_Id'),
			'fccu' => array(self::BELONGS_TO, 'Fccu', 'fccu_FCCU_Id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fccl_FCCL_Id' => 'Fccl Fccl',
			'fccu_FCCU_Id' => 'Fccu Fccu',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('FCCL_Id',$this->FCCL_Id);
		$criteria->compare('FCCU_Id',$this->FCCU_Id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FcclHasFccu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public static function listLabel($id=''){ 
		$labels=FcclHasFccu::model()->findAll(
            "fccu_FCCU_Id = :xyz", array(":xyz"=> $id) 
        );
		$List=array();
		foreach($labels as $l){
			$List[]=$l->Fccl->FCCL_Descripcion;
		}

		return implode(" / ",$List);
	}
}
