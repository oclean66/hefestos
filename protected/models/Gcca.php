<?php

/**
 * This is the model class for table "gcca".
 *
 * The followings are the available columns in table 'gcca':
 * @property string $GCCA_Id
 * @property string $GCCD_Id
 * @property string $GCCA_Cod
 * @property string $GCCA_Nombre
 * @property string $GCCA_Direccion
 * @property integer $GCCA_Status
 * @property string $GCCA_Rif
 * @property string $GCCA_Responsable
 * @property string $GCCA_Telefono
 * @property string $GCCA_Email
 *
 * The followings are the available model relations:
 * @property Fcco[] $fccos
 * @property Gccd $gCCD
 */
class Gcca extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Gcca the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getConcatened() {
        return $this->GCCA_Cod . ' - ' . $this->GCCA_Nombre;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'gcca';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('GCCD_Id, GCCA_Cod, GCCA_Nombre, GCCA_Direccion, GCCA_Status, GCCA_Rif, GCCA_Responsable, GCCA_Telefono,GCCA_Email', 'required'),
            array('GCCA_Status', 'numerical', 'integerOnly' => true),
            array('GCCD_Id', 'length', 'max' => 10),
             array('GCCA_Direccion', 'length', 'max' => 160),
            array('GCCA_Cod, GCCA_Nombre,  GCCA_Rif, GCCA_Responsable, GCCA_Telefono', 'length', 'max' => 45),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('GCCA_Id, GCCD_Id, GCCA_Cod, GCCA_Nombre, GCCA_Direccion, GCCA_Status, GCCA_Rif, GCCA_Responsable, GCCA_Telefono,GCCA_Email', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'fccos' => array(self::HAS_MANY, 'Fcco', 'GCCA_Id'),
            'gCCD' => array(self::BELONGS_TO, 'Gccd', 'GCCD_Id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'GCCA_Id' => 'Id',
            'GCCD_Id' => 'Grupo',
            'GCCA_Cod' => 'Cod',
            'GCCA_Nombre' => 'Nombre',
            'GCCA_Direccion' => 'Direccion',
            'GCCA_Status' => 'Status',
            'GCCA_Rif' => 'Rif',
            'GCCA_Responsable' => 'Responsable',
            'GCCA_Telefono' => 'Telefono',
            'GCCA_Email' => 'Email'
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('GCCA_Id', $this->GCCA_Id, true);
        $criteria->compare('GCCD_Id', $this->GCCD_Id, false);
        $criteria->compare('GCCA_Cod', $this->GCCA_Cod, true);
        $criteria->compare('GCCA_Nombre', $this->GCCA_Nombre, true);
        $criteria->compare('GCCA_Direccion', $this->GCCA_Direccion, true);
        $criteria->compare('GCCA_Status', $this->GCCA_Status);
        $criteria->compare('GCCA_Rif', $this->GCCA_Rif, true);
        $criteria->compare('GCCA_Responsable', $this->GCCA_Responsable, true);
        $criteria->compare('GCCA_Telefono', $this->GCCA_Telefono, true);
         $criteria->compare('GCCA_Email', $this->GCCA_Email, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 100),
            'sort'=>array(
                'defaultOrder'=>'GCCA_Cod',
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
