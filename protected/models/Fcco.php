<?php

/**
 * This is the model class for table "fcco".
 *
 * The followings are the available columns in table 'fcco':
 * @property string $FCCO_Id
 * @property string $FCCO_Timestamp
 * @property string $FCCO_Lote
 * @property string $FCCO_Descripcion
 * @property integer $FCCO_Enabled
 * @property string $FCCN_Id
 * @property string $FCCU_Id
 * @property string $GCCA_Id
 * @property string $GCCD_Id
 *
 * The followings are the available model relations:
 * @property Gccd $gCCD
 * @property Fccn $fCCN
 * @property Fccu $fCCU
 * @property Gcca $gCCA
 */
class Fcco extends CActiveRecord {

//Variables para busqueda relacionada
    public $cityId, $city, $FCCU_Numero, $FCCU_Serial, $FCUU_Descripcion, $FCCA_Descripcion, $FCCT_Descripcion;
    public $GCCA_Nombre, $GCCD_Nombre,$desde,$hasta;

    public function getLugar() {
        return isset($this->gCCA) ? 
        $this->gCCA->GCCA_Cod . ' - ' . $this->gCCA->GCCA_Nombre . " | " . $this->gCCA->gCCD->GCCD_Cod . ' - ' . $this->gCCA->gCCD->GCCD_Nombre: 
        "No asignado";
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Fcco the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'fcco';
    }
    public function getConcatend() {
        return $this->gCCA->GCCA_Cod." - ".$this->gCCA->GCCA_Nombre;
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
//            Busqueda relacionada
            array('GCCD_Nombre,GCCA_Nombre,FCCU_Numero,FCCU_Serial,FCUU_Descripcion,FCCT_Descripcion,FCCA_Descripcion,desde,hasta', 'safe', 'on' => 'search'),
            array('FCCN_Id', 'required'),
            array('FCCO_Enabled,FCCU_Id', 'numerical', 'integerOnly' => true),
            array('FCCO_Timestamp, FCCO_Lote, FCCO_Descripcion', 'length', 'max' => 45),
            array('FCCN_Id, GCCA_Id, GCCD_Id', 'length', 'max' => 10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('FCCO_Id, FCCO_Timestamp, FCCO_Lote, FCCO_Descripcion, FCCO_Enabled, FCCN_Id, FCCU_Id,  GCCD_Id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'gCCD' => array(self::BELONGS_TO, 'Gccd', 'GCCD_Id'),
            'fCCN' => array(self::BELONGS_TO, 'Fccn', 'FCCN_Id'),
            'fCCU' => array(self::BELONGS_TO, 'Fccu', 'FCCU_Id'),
            'gCCA' => array(self::BELONGS_TO, 'Gcca', 'GCCA_Id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'FCCO_Id' => 'Id',
            'FCCO_Timestamp' => 'Fecha de Registro',
            'FCCO_Lote' => 'Id Lote',
            'FCCO_Descripcion' => 'Descripcion',
            'FCCO_Enabled' => 'Disponibilidad',
            'FCCN_Id' => 'Operacion',
            'FCCU_Id' => 'Id Item',
//            'GCCA_Id' => 'Agencia',
//            'GCCA_Nombre'=>'Agencia',
            'GCCD_Id' => 'Grupo',
            'FCCU_Serial' => 'Serial'
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

//Busqueda con campos relacionados
       

        $criteria->compare('GCCD_Nombre', $this->GCCD_Nombre, true);
        $criteria->with = array('gCCD');

        $criteria->compare('FCCU_Numero', $this->FCCU_Numero, true);
        $criteria->with = array('fCCU');

        $criteria->compare('CONCAT_WS(" ",FCCU_Serial,FCCU_Numero)', $this->FCCU_Serial, true);
        $criteria->with = array('fCCU');

        $criteria->compare('FCCA_Descripcion', $this->FCCA_Descripcion, true);
        $criteria->with = array('fCCU.fCCT.fCCA');

        $criteria->compare('FCCT_Descripcion', $this->FCCT_Descripcion, true);
        $criteria->with = array('fCCU.fCCT');

        $criteria->compare('FCUU_Descripcion', $this->FCUU_Descripcion, true);
        $criteria->with = array('fCCU.fCCT.fCCA.fCUU');


        $criteria->compare('FCCO_Id', $this->FCCO_Id);
        $criteria->addBetweenCondition('FCCO_Timestamp', $this->desde, $this->hasta);

        
//        $criteria->compare('FCCO_Timestamp', $this->FCCO_Timestamp, true);
        $criteria->compare('FCCO_Lote', $this->FCCO_Lote, true);
        $criteria->compare('FCCO_Descripcion', $this->FCCO_Descripcion, true);
        $criteria->compare('FCCO_Enabled', $this->FCCO_Enabled);
        $criteria->compare('FCCN_Id', $this->FCCN_Id, true);
        $criteria->compare('t.FCCU_Id', $this->FCCU_Id);
        $criteria->compare('GCCA_Id', $this->GCCA_Id, false);
        $criteria->compare('GCCD_Id', $this->GCCD_Id, false);
//      $criteria->condition = "GCCA_Id=" . $this->GCCA_Id;
//      $criteria->condition = "FCCO_Enabled=" . $this->FCCO_Enabled;
    //  $criteria->condition = "GCCD_Id=" . $this->GCCD_Id;
//      $criteria->params[':met_not_more']=$this->met_not_more;
//      Ordenamiento de columnas relacionadas

        $data = new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination'=>false,
            'sort' => array(
                'defaultOrder' => 'FCCO_Timestamp desc',
                'attributes' => array(
                    'GCCA_search' => array(
                        'asc' => 'gCCA.GCCA_Nombre',
                        'desc' => 'gCCA.GCCA_Nombre  DESC',
                    ),
                    //'GCCD_Nombre' => array(
                    //'asc' => 'gCCD.GCCD_Nombre',
                    //'desc' => 'gCCD.GCCD_Nombre  DESC',
                    //),
                'GCCA_Id' ,'FCCN_Id',
                    'FCCU_Numero' => array(
                        'asc' => 'fCCU.FCCU_Numero',
                        'desc' => 'fCCU.FCCU_Numero  DESC',
                    ),
                    'FCCU_Serial' => array(
                        'asc' => 'fCCU.FCCU_Serial',
                        'desc' => 'fCCU.FCCU_Serial  DESC',
                    ),
                    'FCCT_Descripcion' => array(
                        'asc' => 'fCCT.FCCT_Descripcion',
                        'desc' => 'fCCT.FCCT_Descripcion  DESC',
                    ),
                    'FCCA_Descripcion' => array(
                        'asc' => 'fCCA.FCCA_Descripcion',
                        'desc' => 'fCCA.FCCA_Descripcion  DESC',
                    ),
                    'FCUU_Descripcion' => array(
                        'asc' => 'fCUU.FCUU_Descripcion',
                        'desc' => 'fCUU.FCUU_Descripcion  DESC',
                    ),
                    //Agregar todos los filtro o quedaran deshabilitados
                    'FCCO_Lote' => array(
                        'asc' => 'FCCO_Lote',
                        'desc' => 'FCCO_Lote  DESC',
                    ),
                    'FCCO_Timestamp' => array(
                        'asc' => 'FCCO_Timestamp',
                        'desc' => 'FCCO_Timestamp  DESC',
                    ),
                    
                ),
            ),
        ));

        Yii::app()->session['all'] = $data;
       

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination'=>array(
                        'pageSize'=>500,
                ),
            'sort' => array(
                'defaultOrder' => 'FCCO_Timestamp desc',
                'attributes' => array(
                    'GCCA_search' => array(
                        'asc' => 'gCCA.GCCA_Nombre',
                        'desc' => 'gCCA.GCCA_Nombre  DESC',
                    ),
                    //'GCCD_Nombre' => array(
                    //'asc' => 'gCCD.GCCD_Nombre',
                    //'desc' => 'gCCD.GCCD_Nombre  DESC',
                    //),
                   'GCCA_Id' ,'FCCN_Id',
                    'FCCU_Numero' => array(
                        'asc' => 'fCCU.FCCU_Numero',
                        'desc' => 'fCCU.FCCU_Numero  DESC',
                    ),
                    'FCCU_Serial' => array(
                        'asc' => 'fCCU.FCCU_Serial',
                        'desc' => 'fCCU.FCCU_Serial  DESC',
                    ),
                    'FCCT_Descripcion' => array(
                        'asc' => 'fCCT.FCCT_Descripcion',
                        'desc' => 'fCCT.FCCT_Descripcion  DESC',
                    ),
                    'FCCA_Descripcion' => array(
                        'asc' => 'fCCA.FCCA_Descripcion',
                        'desc' => 'fCCA.FCCA_Descripcion  DESC',
                    ),
                    'FCUU_Descripcion' => array(
                        'asc' => 'fCUU.FCUU_Descripcion',
                        'desc' => 'fCUU.FCUU_Descripcion  DESC',
                    ),
                    //Agregar todos los filtro o quedaran deshabilitados
                    'FCCO_Lote' => array(
                        'asc' => 'FCCO_Lote',
                        'desc' => 'FCCO_Lote  DESC',
                    ),
                    'FCCO_Timestamp' => array(
                        'asc' => 'FCCO_Timestamp',
                        'desc' => 'FCCO_Timestamp  DESC',
                    ),
                    
                ),
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
