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
    
    public function getEstadisticas(){
        $stats['Equipo'] = Yii::app()->db->createCommand("Select count(*) as Equipo from fcco, fccu, fcct, fcca, fcuu where fcco.FCCO_Enabled = 1 and fcco.FCCN_Id = 1 and fcco.FCCU_Id = fccu.FCCU_Id and fccu.FCCT_Id = fcct.FCCT_Id and fcct.FCCA_Id = fcca.FCCA_Id and fcca.FCUU_Id = fcuu.FCUU_Id and fcco.GCCA_Id = '" . $this->GCCA_Id . "' and  fcuu.FCUU_Id = 1 ")->queryRow();
        $stats['Conexiones'] = Yii::app()->db->createCommand("Select count(*) as Conexiones from fcco, fccu, fcct, fcca, fcuu where fcco.FCCO_Enabled = 1 and fcco.FCCN_Id = 1 and  fcco.FCCU_Id = fccu.FCCU_Id and fccu.FCCT_Id = fcct.FCCT_Id and fcct.FCCA_Id = fcca.FCCA_Id and fcca.FCUU_Id = fcuu.FCUU_Id and fcco.GCCA_Id = '" . $this->GCCA_Id . "' and   fcuu.FCUU_Id = 2 ")->queryRow();
        $stats['Suministros'] = Yii::app()->db->createCommand("Select count(*) as Suministros from fcco, fccu, fcct, fcca, fcuu where fcco.FCCO_Enabled = 1 and fcco.FCCN_Id = 1 and  fcco.FCCU_Id = fccu.FCCU_Id and fccu.FCCT_Id = fcct.FCCT_Id and fcct.FCCA_Id = fcca.FCCA_Id and fcca.FCUU_Id = fcuu.FCUU_Id and fcco.GCCA_Id = '" . $this->GCCA_Id . "' and  fcuu.FCUU_Id = 3 ")->queryRow();
        $stats['Publicidad'] = Yii::app()->db->createCommand("Select count(*) as Publicidad from fcco, fccu, fcct, fcca, fcuu where fcco.FCCO_Enabled = 1 and fcco.FCCN_Id = 1 and  fcco.FCCU_Id = fccu.FCCU_Id and fccu.FCCT_Id = fcct.FCCT_Id and fcct.FCCA_Id = fcca.FCCA_Id and fcca.FCUU_Id = fcuu.FCUU_Id and fcco.GCCA_Id = '" . $this->GCCA_Id . "' and  fcuu.FCUU_Id = 4 ")->queryRow();
        $stats['Herramientas'] = Yii::app()->db->createCommand("Select count(*) as Herramientas from fcco, fccu, fcct, fcca, fcuu where fcco.FCCO_Enabled = 1 and fcco.FCCN_Id = 1 and  fcco.FCCU_Id = fccu.FCCU_Id and fccu.FCCT_Id = fcct.FCCT_Id and fcct.FCCA_Id = fcca.FCCA_Id and fcca.FCUU_Id = fcuu.FCUU_Id and fcco.GCCA_Id = '" . $this->GCCA_Id . "' and  fcuu.FCUU_Id = 5 ")->queryRow();
        $stats['Electrodomesticos'] = Yii::app()->db->createCommand("Select count(*) as Electrodomesticos from fcco, fccu, fcct, fcca, fcuu where fcco.FCCO_Enabled = 1 and fcco.FCCN_Id = 1 and  fcco.FCCU_Id = fccu.FCCU_Id and fccu.FCCT_Id = fcct.FCCT_Id and fcct.FCCA_Id = fcca.FCCA_Id and fcca.FCUU_Id = fcuu.FCUU_Id and fcco.GCCA_Id = '" . $this->GCCA_Id . "' and  fcuu.FCUU_Id = 6 ")->queryRow();
        $stats['Inmobiliario'] = Yii::app()->db->createCommand("Select count(*) as Inmobiliario from fcco, fccu, fcct, fcca, fcuu where fcco.FCCO_Enabled = 1 and fcco.FCCN_Id = 1 and  fcco.FCCU_Id = fccu.FCCU_Id and fccu.FCCT_Id = fcct.FCCT_Id and fcct.FCCA_Id = fcca.FCCA_Id and fcca.FCUU_Id = fcuu.FCUU_Id and fcco.GCCA_Id = '" . $this->GCCA_Id . "' and  fcuu.FCUU_Id = 7 ")->queryRow();

        //1. Consultar todas las asignaciones de la agencias
        //2. por cada tipo, consultar el total

        return $stats;
    }
    public function getConcatened() {
        return $this->GCCA_Cod . ' - ' . $this->GCCA_Nombre." | Grupo: ".$this->gCCD->concatened;
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
            array('GCCA_Cod', 'unique'),
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

        $criteria->compare('GCCA_Id', $this->GCCA_Id, false);
        $criteria->compare('GCCD_Id', $this->GCCD_Id, false);
        $criteria->compare('GCCA_Cod', $this->GCCA_Cod, true);
        $criteria->compare('GCCA_Nombre', $this->GCCA_Nombre, true); //partialMatch
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
