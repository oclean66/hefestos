<?php

class ActiveRecordLogableBehavior extends CActiveRecordBehavior {

    private $_oldattributes = array();

    public function afterSave($event) {
        if (!$this->Owner->isNewRecord) {

            // new attributes
            $newattributes = $this->Owner->getAttributes();
            $oldattributes = $this->getOldAttributes();

            // compare old and new
            $changes = '';
            $names = '';
            foreach ($newattributes as $name => $value) {
                if (!empty($oldattributes)) {
                    $old = $oldattributes[$name];
                } else {
                    $old = '{VACIO}';
                }
                if($old=="") $old = '{VACIO}';
                if ($value != $old)
                    $changes = $changes . " " . $this->Owner->getAttributeLabel($name) . ' (' . $old . ') => (' . $value . ')<br />';
                if ($value != $old)
                    $names = $names . " " . $this->Owner->getAttributeLabel($name) . ',';
            }



            $log = new Pcue;
            $log->PCUE_Descripcion = 'Usuario ' . Yii::app()->user->Name
                    . ' actualizo ' . $names . ' en '
                    . CrugeTranslator::t('classes', get_class($this->Owner));
            $log->PCUE_Action = 'ACTUALIZAR';
            $log->PCUE_Model =  get_class($this->Owner);
            $id = $this->Owner->getPrimaryKey();

            $log->PCUE_IdModel = is_array($id) ? implode(",", $id) : $id;
            $log->PCUE_Field = $this->Owner->getAttributeLabel($names);
            $log->PCUE_Date = new CDbExpression('NOW()');
            $log->PCUE_UserId = Yii::app()->user->id . " - " . Yii::app()->user->Name;
            $log->PCUE_Detalles = $changes;
            $log->save();
        } else {
            $newattributes = $this->Owner->getAttributes();
            $changes = '';
            foreach ($newattributes as $name => $value) {
                if (empty($value))
                    $value = '{VACIO}';
                $changes = $changes . ' ' . $this->Owner->getAttributeLabel($name) . ' => ' . $value . '<br /> ';
            }

            $log = new Pcue;
            $log->PCUE_Descripcion = 'Usuario ' . Yii::app()->user->Name
                    . ' inserto en ' . CrugeTranslator::t('classes', get_class($this->Owner));
            $log->PCUE_Action = 'INSERTAR';
            $log->PCUE_Model = CrugeTranslator::t('classes', get_class($this->Owner));

            $id = $this->Owner->getPrimaryKey();

            $log->PCUE_IdModel = is_array($id) ? implode(",", $id) : $id;
            $log->PCUE_Field = 'TODOS';
            $log->PCUE_Date = new CDbExpression('NOW()');
            $log->PCUE_UserId = Yii::app()->user->id . " - " . Yii::app()->user->Name;
            $log->PCUE_Detalles = $changes;
            $log->save();
        }

        //GUARDO EN FISICO
       
        $file = fopen('d:\MYLOG.txt', 'a');

        fwrite($file,   date('l jS \of F Y h:i:s A')." - ".$log->PCUE_Descripcion." - ID: ".$log->PCUE_IdModel." MODEL ".$log->PCUE_Model." - ".$changes. PHP_EOL);
        
        fclose($file);

    }

    public function afterDelete($event) {
        $oldattributes = $this->getOldAttributes();
        $changes = '';
        foreach ($oldattributes as $name => $value) {
            if (empty($value))
                $value = '{VACIO}';
            $changes = $changes . '(' . $this->Owner->getAttributeLabel($name) . ') => (' . $value . '), ';
        }
        $log = new Pcue;
        $log->PCUE_Descripcion = 'Usuario ' . Yii::app()->user->Name . ' elimino en '
                . CrugeTranslator::t('classes', get_class($this->Owner));
        $log->PCUE_Action = 'ELIMINIAR';
        $log->PCUE_Model = CrugeTranslator::t('classes', get_class($this->Owner));
        $id = $this->Owner->getPrimaryKey();

        $log->PCUE_IdModel = is_array($id) ? implode(",", $id) : $id;
        $log->PCUE_Field = 'TODOS';
        $log->PCUE_Date = new CDbExpression('NOW()');
        $log->PCUE_UserId = Yii::app()->user->id . " - " . Yii::app()->user->Name;
        $log->PCUE_Detalles = $changes;
        $log->save();
    }

    public function afterFind($event) {
        // Save old values
        $this->setOldAttributes($this->Owner->getAttributes());
    }

    public function getOldAttributes() {
        return $this->_oldattributes;
    }

    public function setOldAttributes($value) {
        $this->_oldattributes = $value;
    }

}

?>