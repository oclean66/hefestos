<?php $baseUrl = Yii::app()->theme->baseUrl;?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody>
		<tr>
			<td height="30"></td>
		</tr>
		<tr bgcolor="#F1F2F7">
			<td align="center" bgcolor="#F1F2F7" valign="top" width="100%">

                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                    <tbody>
                        <tr bgcolor="f8a31f">
                            <td height="15"></td>
                        </tr>
                        <tr bgcolor="f8a31f">
                            <td align="center">
                                <table align="center" border="0" cellpadding="0" cellspacing="0" width="560">
                                    <tbody>
                                        <tr>
                                            <td>
                                            <table align="center"  border="0" cellpadding="0" cellspacing="0" width="360">
                                                    <tbody>
                                                        <tr>
                                                            <td style="color:#fff;font-size:16px;font-weight:bolder;font-family:Helvetica,Arial,sans-serif;text-decoration: underline;">
                                                                Activos con stock de inventario agotado
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table align="left" border="0" cellpadding="0" cellspacing="0">
                                                    <tbody>
                                                        <tr>
                                                            <td align="center">
                                                                <table border="0" cellpadding="0" cellspacing="0">
                                                                    <tbody>
                                                                        <tr>

                                                                            <td style="color:#fefefe;font-size:14px;font-weight:bold;font-family:Helvetica,Arial,sans-serif"> 

                                                                            <img style="display:block" 
                                                                            src="<?= Yii::app()->params->domain."/".Yii::app()->params->folder ?>/themes/flat/img/logo.png" alt="logo" style="height:30px;width:94px" class="CToWUd">

                                                                            <?php echo
                                                                            date('l jS \of F Y h:i:s A',strtotime(date('Y-m-d H:i:s'))); 

                                                                            ?> </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table align="left" border="0" cellpadding="0" cellspacing="0">
                                                    <tbody>
                                                        <tr>
                                                            <td height="20" width="30"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        <tr bgcolor="f8a31f">
                            <td height="10"></td>
                        </tr>
                    </tbody>
                </table>
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" bgcolor="ffffff">
                    <tbody>
                        <tr><td height="20"></td></tr>  


                        <tr>
                            <td>
                                
                                <table align="center" border="0" cellpadding="0" cellspacing="0" width="560" bgcolor="F1F2F7">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table align="center" border="0" cellpadding="0" cellspacing="0" width="528">
                                                    <thead><tr><th height="20">Tipo de activo</th><th>Stock disponible</th></tr></thead>
                                                    <tbody>
                                                    <?php foreach($model as $m){ ?>
                                                        <tr>
                                                            <td><?= $m['FCCA_Descripcion'] ?></td>
                                                            <td> &nbsp; &nbsp; <?= $m['FCCA_Stock'] ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>


                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr><td height="20"></td></tr>   

                    </tbody>
                </table>

                <table border="0" cellpadding="0" cellspacing="0" width="600">
                    <tbody>
                        <tr bgcolor="f8a31f"><td height="15"></td></tr>
                        <tr bgcolor="f8a31f">
                            <td style="color:#fff;font-size:10px;font-weight:normal;font-family:Helvetica,Arial,sans-serif" align="center">
                            GeekSkull Studios. Derechos Reservados
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="f8a31f" height="14"></td>
                            </tr>  

                        <tr><td height="30"></td></tr>

                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td height="20"></td>
        </tr>
        <tr>
            <td style="color:#939393;font-size:11px;font-weight:normal;font-family:Helvetica,Arial,sans-serif" align="center">

            Usted se encuentra registrado en nuestros sistemas como: <span style="color:#f8a31f"><a href="mailto: " target="_blank"> </a></span>

            </td>
        </tr>
        <tr>
            <td height="30"></td>
        </tr>
    </tbody>
</table>
<!--footer-->
