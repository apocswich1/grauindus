<?php
setlocale(LC_ALL,'es_ES');
$fecha = date("Y-m-d");
$fecha = fecha($fecha);
$cantidad=$datos->cantidad_1;             
$iva=19;             
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="spanish"/>
<title>Orden de Compra :: Trabajos Especiales</title>
</head>

    <body>
        <div id="dina4">
            <!-- Titulo y encabezado del pdf-->
            <div>

                <div class="div1">    
                    <table border='0' class="textos">
                        <tr><td><h1><img width="150px" src="public/frontend/images/Logo-Cartonajes-web.png" /></h1></td></tr>
                        <tr><td>Fabrica de Cajas y Cartones</td></tr>
                        <tr><td>Juan Francisco Rivas 9435 - La Cisterna - Santiago - Chile</td></tr>
                        <tr><td>Telefono 56 2 24959500</td></tr>
                    </table>
                </div>
                <div class="div2">    
                    <table border='0' class="textos center">
                        <tr><td>RUT: 79.897.500-5</td></tr>
                        <tr><td>ORDEN DE COMPRA</td></tr>
                        <tr><td>OC-<?php echo $var['cotizacion']; ?>-<?php echo str_pad($var['grupo'], 2, "0", STR_PAD_LEFT); ?><?php echo str_pad($var['correlativo'], 2, "0", STR_PAD_LEFT); ?></td></tr>
                    </table>
                </div>
            </div>
            <div class="separador"></div>
            <div class="div3">    
                <table class="textos interlineado">
                    <tr><td colspan="4"><h1></h1></td></tr>
                    <tr><td width="80px"><b>Santiago,</b></td><td colspan="3"><?php echo $fecha; ?></td></tr>
                    <tr><td><b>Señores:</b></td><td width="420px"><?php echo $var['razon']; ?></td><td width="80px"><b>Rut:</b></td><td><?php echo $var['cuenta']; ?></td></tr>
                    <tr><td>Direcci&oacute;n:</td><td><?php echo $var['direccion']; ?></td><td><b>Ciudad:</b></td><td><?php echo $var['ciudad']; ?></td></tr>
                    <tr><td>Contacto:</td><td><?php echo $var['contacto']; ?></td><td><b>Telefono:</b></td><td><?php echo $var['telefono']; ?></td></tr>
                </table>
            </div>
            <div class="separador2"></div>
            <div class="div4">    
                <table class="textos">
                    <tr><td>Condiciones de Pago:</td><td>&nbsp;<?php echo $var['formapago']; ?></td></tr>
                </table>    
                <div class="separador2"></div>
                <div class="div5">    
                    <table border="1" class="textos">
                        <tr>
                            <td width="125">Cantidad</td>
                            <td width="125">Codigo</td>
                            <td width="300">Descripci&oacute;n</td>
                            <td width="125">Precio</td>
                            <td width="125">Total</td></tr>
                        <tr>
                            <td class="alto" valign="top"><?php echo number_format($var['cantidad'],0,',','.'); ?></td>
                            <td class="alto" valign="top"><?php echo $var['codigo'];; ?></td>
                            <td class="alto" valign="top" align="left"><?php echo $var['descripcion']; ?></td>
                            <td class="alto" valign="top" align="right"><?php echo number_format($var['precio'],0,',','.'); ?></td>
                            <td class="alto" valign="top" align="right"><?php echo number_format($var['total'],0,',','.'); ?></td></tr>
                    </table>
                </div>
                <div class="separador3"></div>
                <div>    
                    <div class="div6">    
                        <table border="1" class="textos">
                            <tr>
                                <td class="alto2"  width=""  valign="top">
                                    Condiciones / Comentarios
                                    <br /><br /><br /><br />
                                    <br /><br /><br /><br />
                                    <table>
                                        <tr>
                                            <td><?php echo $var['tipocuenta'] . ' ' . $var['cuenta'];?></td>
                                            <td><?php //echo $tipocuenta1  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Mail: <?php echo $var['correo']; ?></td><td></td>
                                            <td></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                    </div>
                    <div class="div8" style="padding: 0px">    
                        <table border="0" class="textos" valign="top">
                            <tr>
                                <td class="">
                                    <table border="1">
                                        <tr><td width="106px">Valor</td><td align="right"><?php echo number_format($var['total'],0,',','.'); ?></td></tr>
                                        <tr><td>Descuento</td><td align="right"></td></tr>
                                        <tr><td>Neto</td><td align="right"><?php echo number_format($var['total'],0,',','.'); ?></td></tr>
                                        <tr><td>Iva</td><td align="right"><?php echo number_format((($var['total']*$iva)/100),0,',','.'); ?></td></tr>
                                        <tr><td>Total</td><td align="right"><?php echo number_format(((($var['total']*$iva)/100)+$var['total']),0,',','.'); ?></td></tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>
                <div class="separador3"></div>
                <div class="div7">    
                    <table border="1" class="textos">
                        <tr>
                            <td class="">Solicitado por: <?php echo $this->session->userdata('nombre') ?></td>
                        </tr>
                        <tr>
                            <td class="">Aprobado por:  <?php echo $this->session->userdata('nombre') ?></td>
                        </tr>
                    </table>
                </div>
                <div>    
                    <div class="separador5"></div>
                    <div class="div7">    
                        <table border="0" class="textos">
                            <tr>
                                <td class="sin2" style="width: 520px;"></td>
                                <td class="sin" align="center" style="width: 160px;">Firma de Aprobaci&oacute;n</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="separador4"></div>
                <div class="div7" class="footer">    
                    <table border="" class="textos">
                        <tr>
                            <td><p>NOTA:<br/>Las facturas se daran por recibidas solo con el timbre del ingreso del<br/>
                                    departamento de contabilidad y acompañadas de la orden de compra.</p></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </body>