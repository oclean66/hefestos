<?php

/**
 * This is the model class for table "gccd".
 *
 * The followings are the available columns in table 'gccd':
 * @property string $GCCD_Id
 * @property string $GCCD_Cod
 * @property string $GCCD_Nombre
 * @property string $GCCD_IdSuperior
 * @property integer $GCCD_Estado
 * @property string $GCCD_Responsable
 * @property string $GCCD_Telefono
 *
 * The followings are the available model relations:
 * @property Fcco[] $fccos
 * @property Gcca[] $gccas
 * @property Gccd $gCCDIdSuperior
 * @property Gccd[] $gccds
 */
class Gccd extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Gccd the static model class
     */
    public function hijas($id) {
        $aux = '';
        $gccas = Gcca::model()->findAll("GCCD_Id=" . $id . " order by GCCA_Cod");

        if (count($gccas)) {
            $aux = '<ul>';
            foreach ($gccas as $data) {

                $aux = $aux . '<li id="' . $data->GCCA_Id . '"  class="expanded ">' . $data->GCCA_Cod . ' | ' . $data->GCCA_Nombre . '</li>';
            }
            $aux = $aux . '</ul>';
        }


        return $aux;
    }

    public function hijos($id) {
        $aux = '';
        $gccds = Gccd::model()->findAll("GCCD_IdSuperior=" . $id . " order by GCCD_Cod");
        $gccas = Gcca::model()->findAll("GCCD_Id=" . $id . " order by GCCA_Cod");
        if (count($gccds) || count($gccas)) {

            $aux = '<ul>';
            if (count($gccds)) {

                foreach ($gccds as $data) {

                    $aux = $aux . '<li id="' . $data->GCCD_Id . '"  data="url: \'grupo/'.$data->GCCD_Id.'\',addClass: \'grupo\'">' . $data->GCCD_Cod . ' | ' . $data->GCCD_Nombre;
                    $aux = $aux . $this->hijos($data->GCCD_Id);
                    $aux = $aux . '</li>';
                }
            }
            if (count($gccas)) {
                foreach ($gccas as $data) {

                    $aux = $aux . '<li id="' . $data->GCCA_Id . '"  data="url: \'agencia/'.$data->GCCA_Id.'\',addClass: \'agencia\'">' . $data->GCCA_Cod . ' | ' . $data->GCCA_Nombre . '</li>';
                }
            }
            $aux = $aux . '</ul>';
        }


        return $aux;
    }

    public function arbol() {
        $arbol = '<ul id="arbol" style="border:0">';
        $data = Gccd::model()->find("GCCD_Id = 1 ");
        
            $arbol = $arbol . '<li id="' . $data->GCCD_Id . '"  data="url: \'grupo/'.$data->GCCD_Id.'\',addClass: \'banca\'">' . "(".$data->GCCD_Id.")".$data->GCCD_Cod . ' | ' . $data->GCCD_Nombre;
            $arbol = $arbol . $this->hijos($data->GCCD_Id);
            $arbol = $arbol . $this->hijas($data->GCCD_Id);
            $arbol = $arbol . '</li>';
       

        $arbol = $arbol . '</ul>';
        return $arbol;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getConcatened() {
        return $this->GCCD_Cod . ' - ' . $this->GCCD_Nombre;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'gccd';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('GCCD_Cod, GCCD_Nombre', 'required'),
            array('GCCD_Estado', 'numerical', 'integerOnly' => true),
            array('GCCD_Cod, GCCD_Nombre, GCCD_Responsable, GCCD_Telefono', 'length', 'max' => 45),
            array('GCCD_IdSuperior', 'length', 'max' => 10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('GCCD_Id, GCCD_Cod, GCCD_Nombre, GCCD_IdSuperior, GCCD_Estado, GCCD_Responsable, GCCD_Telefono', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'fccos' => array(self::HAS_MANY, 'Fcco', 'GCCD_Id'),
            'gccas' => array(self::HAS_MANY, 'Gcca', 'GCCD_Id'),
            'gCCDIdSuperior' => array(self::BELONGS_TO, 'Gccd', 'GCCD_IdSuperior'),
            'gccds' => array(self::HAS_MANY, 'Gccd', 'GCCD_IdSuperior'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'GCCD_Id' => 'ID',
            'GCCD_Cod' => 'Cod',
            'GCCD_Nombre' => 'Nombre',
            'GCCD_IdSuperior' => 'Padre',
            'GCCD_Estado' => 'Estado',
            'GCCD_Responsable' => 'Responsable',
            'GCCD_Telefono' => 'Telefono',
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

        $criteria->compare('GCCD_Id', $this->GCCD_Id, true);
        $criteria->compare('GCCD_Cod', $this->GCCD_Cod, true);
        $criteria->compare('GCCD_Nombre', $this->GCCD_Nombre, true);
        $criteria->compare('GCCD_IdSuperior', $this->GCCD_IdSuperior, true);
        $criteria->compare('GCCD_Estado', $this->GCCD_Estado);
        $criteria->compare('GCCD_Responsable', $this->GCCD_Responsable, true);
        $criteria->compare('GCCD_Telefono', $this->GCCD_Telefono, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
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