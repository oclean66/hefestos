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
class Gccd extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Gccd the static model class
     */
    public function getPublic()
    {
        $data = array();
        $list = GccaPublic::model()->findAll('GCCD_Id =:id', array(':id' => $this->GCCD_Id));
        foreach ($list as $key => $value) {
            $data[] = $value->PUBLIC_GCCD_Id;
        }
        return $data;
    }
    public function getEstadisticas()
    {
        $stats['Equipos'] = Yii::app()->db->createCommand("Select count(*) as Equipos from fcco, fccu, fcct, fcca, fcuu, gcca, gccd where fcco.FCCO_Enabled = 1 and fcco.FCCN_Id = 1 and fcco.FCCU_Id = fccu.FCCU_Id and fccu.FCCT_Id = fcct.FCCT_Id and fcct.FCCA_Id = fcca.FCCA_Id and fcca.FCUU_Id = fcuu.FCUU_Id and fcco.GCCA_Id = gcca.GCCA_id and gcca.GCCD_Id = gccd.GCCD_id and gccd.GCCD_Id = '" . $this->GCCD_Id . "' and fcuu.FCUU_Id = 1 ")->queryRow();
        $stats['Herramientas'] = Yii::app()->db->createCommand("Select count(*) as Herramientas from fcco, fccu, fcct, fcca, fcuu, gcca, gccd where fcco.FCCO_Enabled = 1 and fcco.FCCN_Id = 1 and fcco.FCCU_Id = fccu.FCCU_Id and fccu.FCCT_Id = fcct.FCCT_Id and fcct.FCCA_Id = fcca.FCCA_Id and fcca.FCUU_Id = fcuu.FCUU_Id and fcco.GCCA_Id = gcca.GCCA_id and gcca.GCCD_Id = gccd.GCCD_id and gccd.GCCD_Id = '" . $this->GCCD_Id . "' and fcuu.FCUU_Id = 5 ")->queryRow();
        $stats['Suministros'] = Yii::app()->db->createCommand("Select count(*) as Suministros from fcco, fccu, fcct, fcca, fcuu, gcca, gccd where fcco.FCCO_Enabled = 1 and fcco.FCCN_Id = 1 and fcco.FCCU_Id = fccu.FCCU_Id and fccu.FCCT_Id = fcct.FCCT_Id and fcct.FCCA_Id = fcca.FCCA_Id and fcca.FCUU_Id = fcuu.FCUU_Id and fcco.GCCA_Id = gcca.GCCA_id and gcca.GCCD_Id = gccd.GCCD_id and gccd.GCCD_Id = '" . $this->GCCD_Id . "' and fcuu.FCUU_Id = 3 ")->queryRow();
        $stats['Conexiones'] = Yii::app()->db->createCommand("Select count(*) as Conexiones from fcco, fccu, fcct, fcca, fcuu, gcca, gccd where fcco.FCCO_Enabled = 1 and fcco.FCCN_Id = 1 and fcco.FCCU_Id = fccu.FCCU_Id and fccu.FCCT_Id = fcct.FCCT_Id and fcct.FCCA_Id = fcca.FCCA_Id and fcca.FCUU_Id = fcuu.FCUU_Id and fcco.GCCA_Id = gcca.GCCA_id and gcca.GCCD_Id = gccd.GCCD_id and gccd.GCCD_Id = '" . $this->GCCD_Id . "' and fcuu.FCUU_Id = 2 ")->queryRow();
        $stats['Publicidad'] = Yii::app()->db->createCommand("Select count(*) as Publicidad from fcco, fccu, fcct, fcca, fcuu, gcca, gccd where fcco.FCCO_Enabled = 1 and fcco.FCCN_Id = 1 and fcco.FCCU_Id = fccu.FCCU_Id and fccu.FCCT_Id = fcct.FCCT_Id and fcct.FCCA_Id = fcca.FCCA_Id and fcca.FCUU_Id = fcuu.FCUU_Id and fcco.GCCA_Id = gcca.GCCA_id and gcca.GCCD_Id = gccd.GCCD_id and gccd.GCCD_Id = '" . $this->GCCD_Id . "' and fcuu.FCUU_Id = 4 ")->queryRow();
        $stats['Inmobiliario'] = Yii::app()->db->createCommand("Select count(*) as Inmobiliario from fcco, fccu, fcct, fcca, fcuu, gcca, gccd where fcco.FCCO_Enabled = 1 and fcco.FCCN_Id = 1 and fcco.FCCU_Id = fccu.FCCU_Id and fccu.FCCT_Id = fcct.FCCT_Id and fcct.FCCA_Id = fcca.FCCA_Id and fcca.FCUU_Id = fcuu.FCUU_Id and fcco.GCCA_Id = gcca.GCCA_id and gcca.GCCD_Id = gccd.GCCD_id and gccd.GCCD_Id = '" . $this->GCCD_Id . "' and fcuu.FCUU_Id = 7 ")->queryRow();
        $stats['Electrodomesticos'] = Yii::app()->db->createCommand("Select count(*) as Electrodomesticos from fcco, fccu, fcct, fcca, fcuu, gcca, gccd where fcco.FCCO_Enabled = 1 and fcco.FCCN_Id = 1 and fcco.FCCU_Id = fccu.FCCU_Id and fccu.FCCT_Id = fcct.FCCT_Id and fcct.FCCA_Id = fcca.FCCA_Id and fcca.FCUU_Id = fcuu.FCUU_Id and fcco.GCCA_Id = gcca.GCCA_id and gcca.GCCD_Id = gccd.GCCD_id and gccd.GCCD_Id = '" . $this->GCCD_Id . "' and fcuu.FCUU_Id = 6 ")->queryRow();

        //1. Consultar todas las asignaciones de los grupos
        //2. Consultar el total por categoria

        return $stats;
    }

    public function hijas($id)
    {
        $aux = '';
        $gccas = Gcca::model()->findAll("GCCD_Id=" . $id . " and GCCA_Status = 1 order by GCCA_Cod");

        if (count($gccas)) {
            $aux = '<ul>';
            foreach ($gccas as $data) {

                $aux = $aux . '<li id="' . $data->GCCA_Id . '"  class="expanded ">' . $data->GCCA_Cod . ' | ' . $data->GCCA_Nombre . '</li>';
            }
            $aux = $aux . '</ul>';
        }


        return $aux;
    }

    public function getTotal()
    {
        return Gcca::model()->count('GCCD_Id = ' . $this->GCCD_Id . ' and GCCA_Status = 1');
    }

    public function ramas($id)
    {
        $aux = '';
        $gccds = Gccd::model()->findAll("GCCD_IdSuperior=" . $id . " and GCCD_Estado=1 order by GCCD_Cod");
        $gccas = Gcca::model()->findAll("GCCD_Id=" . $id . " and GCCA_Status = 1 order by GCCA_Cod");
        if (count($gccds) || count($gccas)) {

            $aux = '<ul>';
            if (count($gccds)) {

                foreach ($gccds as $data) {

                    $aux = $aux . '<li id="' . $data->GCCD_Id . '"  data="url: \'grupo/' . $data->GCCD_Id . '\',addClass: \'grupo\'">' . $data->GCCD_Cod . ' | ' . $data->GCCD_Nombre . ' (' . (Gcca::model()->count('GCCD_Id = ' . $data->GCCD_Id . ' and GCCA_Status = 1') + Gccd::model()->count('GCCD_IdSuperior = ' . $data->GCCD_Id . ' and GCCD_Estado = 1')) . ')';
                    $aux = $aux . $this->ramas($data->GCCD_Id);
                    $aux = $aux . '</li>';
                }
            }
            if (count($gccas)) {
                foreach ($gccas as $data) {

                    $aux = $aux . '<li id="' . $data->GCCA_Id . '"  data="url: \'agencia/' . $data->GCCA_Id . '\',addClass: \'agencia\'">' . $data->GCCA_Cod . ' | ' . $data->GCCA_Nombre . '</li>';
                }
            }
            $aux = $aux . '</ul>';
        }


        return $aux;
    }

    public function arbol()
    {
        $nodo = Yii::app()->user->grupo;
        if ($nodo == "") $nodo = 0;

        $arbol = '<ul id="arbol" style="border:0">';
        $data = Gccd::model()->find("GCCD_Id = " . $nodo);
        if(Yii::app()->user->isSuperAdmin && $nodo == 0)
        $data = Gccd::model()->find();
        // $data = Gccd::model()->find("GCCD_Id = 1 ");
        if ($data) {

            $arbol = $arbol . '<li id="' . $data->GCCD_Id . '"  data="url: \'grupo/' . $data->GCCD_Id . '\',addClass: \'banca\'">' . "(" . $data->GCCD_Id . ")" . $data->GCCD_Cod . ' | ' . $data->GCCD_Nombre;
            $arbol = $arbol . $this->ramas($data->GCCD_Id);
            $arbol = $arbol . $this->hijas($data->GCCD_Id);
            $arbol = $arbol . '</li>';
        }


        $arbol = $arbol . '</ul>';
        return $arbol;
    }

    public function getManagers()
    {

        $models = Gccd::model()->findAll('GCCD_Estado!=3  order by GCCD_Cod');
        return CHtml::listData($models, 'GCCD_Id', 'concatened');
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function getConcatened()
    {
        return $this->GCCD_Cod . ' - ' . $this->GCCD_Nombre;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'gccd';
    }

    public function findHijos($id)
    {
        $var = array();
        if (isset($id)) {
            $list = Gccd::model()->findAll("GCCD_Estado!=3 and GCCD_Id=" . $id);
            foreach ($list as $data) {
                $var = $var + array($data->GCCD_Id => $data->concatened);
                $var = $var + $this->Hijos($data->GCCD_Id);
            }
        } else {
            $var = $var + $this->Hijos(null);
        }



        return $var;
    }
    public function hijos($id)
    {
        $var = array();
        $list = isset($id) ?
            Gccd::model()->findAll("GCCD_Estado!=3 and GCCD_IdSuperior=" . $id . ' order by GCCD_Cod') :
            Gccd::model()->findAll("GCCD_Estado!=3 and GCCD_IdSuperior is null order by GCCD_Cod");

        foreach ($list as $data) {
            $var = $var + array($data->GCCD_Id => $data->concatened);
            $var = $var + $this->hijos($data->GCCD_Id);
        }

        return $var;
    }
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
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
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'fccos' => array(self::HAS_MANY, 'Fcco', 'GCCD_Id'),
            'gccas' => array(self::HAS_MANY, 'Gcca', 'GCCD_Id'),
            'gCCDIdSuperior' => array(self::BELONGS_TO, 'Gccd', 'GCCD_IdSuperior'),
            'gccds' => array(self::HAS_MANY, 'Gccd', 'GCCD_IdSuperior'),
            'gccaPublic' => array(self::HAS_MANY, 'GccaPublic', 'GCCD_Id'),

        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
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

    public function arrayHijos($id, $keep = true)
    {
        if (!isset($id))
            return array();

        $gccd = Gccd::model()->findAll('GCCD_IdSuperior=' . $id . ' order by GCCD_Cod asc');

        if ($keep) {
            $var = isset($id) ? array($id) : array();
            foreach ($gccd as $value) {
                $var = array_merge($var, $this->arrayHijos($value->GCCD_Id));
            }
        } else {
            $var = array();
            foreach ($gccd as $value) {
                $var[] = $value->GCCD_Id;
            }
        }

        // ksort($var);
        return $var;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('GCCD_Id', $this->GCCD_Id, false);
        $criteria->compare('GCCD_Cod', $this->GCCD_Cod, true);
        $criteria->compare('GCCD_Nombre', $this->GCCD_Nombre, true);
        $criteria->compare('GCCD_IdSuperior', $this->GCCD_IdSuperior, false);
        $criteria->compare('GCCD_Estado', $this->GCCD_Estado, false);
        $criteria->compare('GCCD_Responsable', $this->GCCD_Responsable, true);
        $criteria->compare('GCCD_Telefono', $this->GCCD_Telefono, true);

        // if (!Yii::app()->user->isSuperAdmin)
        $criteria->addInCondition('GCCD_Id', Gccd::model()->arrayHijos(Yii::app()->user->grupo));


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 100)
        ));
    }
    public function behaviors()
    {
        return array(
            // Classname => path to Class
            'LoggableBehavior' =>
            'application.behaviors.ActiveRecordLogableBehavior',
        );
    }
}
