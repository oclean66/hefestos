<?php

/**
 * This is the model class for table "fccu".
 *
 * The followings are the available columns in table 'fccu':
 * @property string $FCCU_Id
 * @property string $FCCU_Serial
 * @property string $FCCU_Timestamp
 * @property string $FCCU_Numero
 * @property string $FCCU_ClaveDatos
 * @property string $FCCU_ClaveMovil
 * @property integer $FCCU_DiaCorte
 * @property integer $FCCU_MontoMin
 * @property string $FCCU_TipoServicio
 * @property string $FCCU_Descripcion
 * @property integer $FCCU_Cantidad
 * @property integer $FCCU_Facturado
 * @property string $FCCD_Id
 * @property string $FCCT_Id
 * @property string $FCCI_Id
 * @property string $FCCS_Id
 * @property string $FCCU_Titular
 * @property integer $FCCU_Cedula
 * @property string $FCCU_FechaNacimiento
 * @property string $FCCU_ClaveWeb
 *
 * The followings are the available model relations:
 * @property Fcco[] $fccos
 * @property Fccd $fCCD
 * @property Fcci $fCCI
 * @property Fccs $fCCS
 * @property Fcct $fCCT
 * @property Fcuc[] $fcucs
 */
class Fccu extends CActiveRecord {

    //Variables para busqueda relacionada
    public $cityId, $city, $FCCU_Numero, $FCCU_Serial, $FCUU_Descripcion, $FCCA_Descripcion, $FCCT_Descripcion;
    public $GCCA_Nombre, $GCCD_Nombre;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Fccu the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'fccu';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //            Busqueda relacionada
            array('FCUU_Descripcion,FCCT_Descripcion,FCCA_Descripcion', 'safe', 'on' => 'search'),
            array('FCCU_Serial,  FCCU_Facturado, FCCI_Id', 'required'),
            array('FCCU_DiaCorte, FCCU_MontoMin, FCCU_Cantidad, FCCU_Facturado, FCCU_Cedula', 'numerical', 'integerOnly' => true),
            array('FCCU_Serial, FCCU_Numero, FCCU_ClaveDatos, FCCU_ClaveMovil, FCCU_TipoServicio, FCCU_Descripcion, FCCU_Titular, FCCU_ClaveWeb', 'length', 'max' => 45),
            array('FCCD_Id, FCCT_Id, FCCI_Id, FCCS_Id', 'length', 'max' => 10),
            array('FCCU_FechaNacimiento', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('FCCU_Id, FCCU_Serial, FCCU_Timestamp, FCCU_Numero, FCCU_ClaveDatos, FCCU_ClaveMovil, FCCU_DiaCorte, FCCU_MontoMin, FCCU_TipoServicio, FCCU_Descripcion, FCCU_Cantidad, FCCU_Facturado, FCCD_Id, FCCT_Id, FCCI_Id, FCCS_Id, FCCU_Titular, FCCU_Cedula, FCCU_FechaNacimiento, FCCU_ClaveWeb', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'fccos' => array(self::HAS_MANY, 'Fcco', 'FCCU_Id'),
            'fCCD' => array(self::BELONGS_TO, 'Fccd', 'FCCD_Id'),
            'fCCI' => array(self::BELONGS_TO, 'Fcci', 'FCCI_Id'),
            'fCCS' => array(self::BELONGS_TO, 'Fccs', 'FCCS_Id'),
            'fCCT' => array(self::BELONGS_TO, 'Fcct', 'FCCT_Id'),
            'fcucs' => array(self::HAS_MANY, 'Fcuc', 'FCCU_Id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'FCCU_Id' => 'ID',
            'FCCU_Serial' => 'Serial',
            'FCCU_Timestamp' => 'Agregado',
            'FCCU_Numero' => 'Numero Tlf',
            'FCCU_ClaveDatos' => 'Clave Datos',
            'FCCU_ClaveMovil' => 'Clave Movil',
            'FCCU_DiaCorte' => 'Dia de Corte',
            'FCCU_MontoMin' => 'Monto de renta',
            'FCCU_TipoServicio' => 'Tipo Servicio',
            'FCCU_Hogar'=>'Hogar',
            'FCCU_Descripcion' => 'Descripcion',
            'FCCU_Cantidad' => 'Cantidad',
            'FCCU_Facturado' => 'Facturado',
            'FCCD_Id' => 'Operador',
            'FCCT_Id' => 'Marca/Modelo',
            'FCCI_Id' => 'Estado',
            'FCCS_Id' => 'Factura N',
            'FCCU_Titular' => 'Titular',
            'FCCU_Cedula' => 'Cedula',
            'FCCU_FechaNacimiento' => 'Fecha Nacimiento',
            'FCCU_ClaveWeb' => 'Clave Web',
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

        $criteria->compare('FCCT_Descripcion', $this->FCCT_Descripcion, true);
        $criteria->with = array('fCCT');


        $criteria->compare('FCCA_Descripcion', $this->FCCA_Descripcion, true);
        $criteria->with = array('fCCT.fCCA.');


        $criteria->compare('FCUU_Descripcion', $this->FCUU_Descripcion, true);
        $criteria->with = array('fCCT.fCCA.fCUU');



        $criteria->compare('FCCU_Id', $this->FCCU_Id, true);
        $criteria->compare('FCCU_Serial', $this->FCCU_Serial, true);
        $criteria->compare('FCCU_Timestamp', $this->FCCU_Timestamp, true);
        $criteria->compare('FCCU_Numero', $this->FCCU_Numero, true);
        $criteria->compare('FCCU_ClaveDatos', $this->FCCU_ClaveDatos, true);
        $criteria->compare('FCCU_ClaveMovil', $this->FCCU_ClaveMovil, true);
        $criteria->compare('FCCU_DiaCorte', $this->FCCU_DiaCorte);
        $criteria->compare('FCCU_MontoMin', $this->FCCU_MontoMin);
        $criteria->compare('FCCU_TipoServicio', $this->FCCU_TipoServicio, true);
        $criteria->compare('FCCU_Descripcion', $this->FCCU_Descripcion, true);
        $criteria->compare('FCCU_Cantidad', $this->FCCU_Cantidad);
        $criteria->compare('FCCU_Facturado', $this->FCCU_Facturado);
        $criteria->compare('FCCD_Id', $this->FCCD_Id, true);
        $criteria->compare('FCCT_Id', $this->FCCT_Id, true);
        $criteria->compare('FCCI_Id', $this->FCCI_Id, false);
        $criteria->compare('FCCS_Id', $this->FCCS_Id, true);
        $criteria->compare('FCCU_Titular', $this->FCCU_Titular, true);
        $criteria->compare('FCCU_Cedula', $this->FCCU_Cedula);
        $criteria->compare('FCCU_FechaNacimiento', $this->FCCU_FechaNacimiento, true);
        $criteria->compare('FCCU_ClaveWeb', $this->FCCU_ClaveWeb, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'attributes' => array(
                   //elementos de ordenacion propios
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
                    'FCCU_Numero' => array(
                        'asc' => 'FCCU_Numero',
                        'desc' => 'FCCU_Numero  DESC',
                    ),
                    'FCCU_Serial' => array(
                        'asc' => 'FCCU_Serial',
                        'desc' => 'FCCU_Serial  DESC',
                    ),
                    'FCCU_Timestamp' => array(
                        'asc' => 'FCCU_Timestamp',
                        'desc' => 'FCCU_Timestamp  DESC',
                    ),
                    'FCCI_Id' => array(
                        'asc' => 'FCCI_Id',
                        'desc' => 'FCCI_Id  DESC',
                    ),
                ),
            ),
            'Pagination' => array (
                  'PageSize' => 500 //edit your number items per page here
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
