<?php 

class grupouser {

    var $oracle;

    function grupouser($link) {
        $this->oracle = $link;
    }

    function listar_grupousers() {

        $sql = 'select * from grupousr';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
}

?>