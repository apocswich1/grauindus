<?php

$cuerpo3=' <!DOCTYPE html>
                        <html>
                        <head>
                        <meta charset="utf-8" />
        
<link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/bootstrap.css" />
        <link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/orden_de_produccion.css" />
    </head>
    <body>';
    $cuerpo3.='<div class="container fuente">
            <header>';
		

                      
        $cuerpo3.='</header>
                    <div class="separador_10"></div>
                    <div class="separador_10"></div>';
                    $cuerpo3.='<table>';     
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>SANTIAGO&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>'.strtoupper($fecha_hoy).'</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td style="font-family: sans-serif;font-size: 18px;">'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'                                
                                . '&nbsp;<span class="borde">ORDEN DE COMPRA:'.strtoupper($ide).' </span></td>';
                    $cuerpo3.='</tr>';
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';                    
                    $cuerpo3.='</table>';   
                    $cuerpo3.='<table>';  
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td style="font-family: sans-serif;font-size: 32px;">'.strtoupper($empresa->razon_social).' </td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';                     
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td style="font-family: sans-serif;font-size: 18px;font-weight: 400;">RUT :'.$empresa->rut.'</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';                    
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td style="font-family: sans-serif;font-size: 18px;">DIRECCIÓN '.strtoupper($empresa->direccion).'</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';        
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td style="font-family: sans-serif;font-size: 18px;">REGION '.strtoupper($empresa->region).'</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';  
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td style="font-family: sans-serif;font-size: 18px;">PROVINCIA '.strtoupper($empresa->comuna).'</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';  
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td style="font-family: sans-serif;font-size: 18px;">CIUDAD '.strtoupper($empresa->ciudad).'</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';      
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td style="font-family: sans-serif;font-size: 18px;">FONO '.strtoupper($empresa->telefono).'</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';    
                    $cuerpo3.='</table>';  
                    $cuerpo3.='<table>';                      
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';   
                    $cuerpo3.='</table>';                      
                    $cuerpo3.='<table>
                                <tr>
                                    <td class="centro"><h1><span id="titulo" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orden de Compra de Piezas Adicionales</span></h1>
                                    </td>
                                </tr>
                            </table>';         
                    $cuerpo3.='<table>';           
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';    
                    $cuerpo3.='<tr>';
//                    exit(print_r($proveedor));
                    
                        $cuerpo3.='<td>Rut:&nbsp;&nbsp;</td>';
                        if ($proveedor3->rut=='')
                            $cuerpo3.='<td><strong>'.strtoupper($proveedor3->rut).'</strong></td>';
                        else
                            $cuerpo3.='<td><strong>'.strtoupper('Rut No Registrado').'</strong></td>';                            
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';                      
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>Señor(es)&nbsp;&nbsp;</td>';
                        if ($proveedor3->razon_social!='')
                            $cuerpo3.='<td><strong>'.strtoupper($proveedor3->razon_social).'</strong></td>';
                        else
                            $cuerpo3.='<td><strong>'.strtoupper($proveedor3->nombre).'</strong></td>';                         
                        $cuerpo3.='<td><strong>'.strtoupper().'</strong></td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';

                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>Fono&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td><strong>'.strtoupper($proveedor3->telefono).'</strong></td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';        
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>E-mail:&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td><strong>'.strtoupper($proveedor3->correo).'</strong></td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';   
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>Al Señor:&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td><strong>'.strtoupper($proveedor3->contacto).'</strong></td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';                    

                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';                        
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>Por nuestra cuenta lo siguiente:</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';                               
                    $cuerpo3.='</table>';  
                        

                $cuerpo3.='<!--separador 10-->';
                    $cuerpo3.='<div class="separador_10"></div>';
                    $cuerpo3.='<div class="separador_20"></div> 
                    <div style="margin-left:15px; text-align:center;"> 
                                    <table border="1" style="width:100% !important;">
                                            <tr>
                                               <td class="celda_5" colspan="5"><strong>&nbsp;&nbsp;&nbsp;Piezas Adicionales</strong></td>
                                            </tr>                                    
                                            <tr>
                                                <td class="celda_5" style="width:15% !important;text-align: center;">&nbsp;&nbsp;&nbsp;<strong>Cantidad</strong>&nbsp;&nbsp;&nbsp;</td>
                                                <td class="celda_5" style="width:20% !important;text-align: center;">&nbsp;&nbsp;&nbsp;<strong>Unidad</strong>&nbsp;&nbsp;&nbsp;</td>                                                
                                                <td class="celda_5" style="width:35% !important;text-align: center;">&nbsp;&nbsp;&nbsp;<strong>Pieza</strong>&nbsp;&nbsp;&nbsp;</td>                                                
                                                <td class="celda_5" style="width:15% !important;text-align: center;">&nbsp;&nbsp;&nbsp;<strong>Precio</strong>&nbsp;&nbsp;&nbsp;</td>                                                
                                                <td class="celda_5" style="width:15% !important;text-align: center;">&nbsp;&nbsp;&nbsp;<strong>Total</strong>&nbsp;&nbsp;&nbsp;</td>
                                            </tr>';
                                            $total1=0;
                                            $total2=0;
                                            $total3=0;
                                            
                                         
                                               if ($orden_compra_piezas3->id_pieza3!='0')
                                            {                                               
                                                if ($orden_compra_piezas3->id_proveedor3==$id_proveedor)
                                                {
                                                    $cuerpo3.='<tr>
                                                        <td class="celda_5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.ucwords(strtolower($orden_compra_piezas3->cantidad_3)).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                        <td class="celda_5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.ucwords(strtolower($this->piezas_adicionales_model->getUnidadesUsoPieza($orden_compra_piezas3->id_pieza3))).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>                                                
                                                        <td class="celda_5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.ucwords(strtolower($orden_compra_piezas3->id_pieza3)).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                        <td class="celda_5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.number_format($orden_compra_piezas3->precio_venta3,0,'','.').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>                                                
                                                        <td class="celda_5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.number_format(($orden_compra_piezas3->precio_venta3*$orden_compra_piezas3->cantidad_3),0,'','.').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    </tr>';
                                                    $total3=$orden_compra_piezas3->valor_compra*$orden_compra_piezas3->cantidad_3;                                                
                                                }
                                            }
                                                                                     
                                                $cuerpo3.='<tr>
                                                    <td class="celda_5" colspan="3"></td>
                                                    <td class="celda_5"><strong>&nbsp;&nbsp;&nbsp;Neto</strong></td>
                                                    <td class="celda_5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.number_format(($total1+$total2+$total3),0,'','.').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                </tr>';      
                                                $cuerpo3.='<tr>
                                                    <td class="celda_5" colspan="3"></td>
                                                    <td class="celda_5"><strong>&nbsp;&nbsp;&nbsp;IVA</strong></td>
                                                    <td class="celda_5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.number_format(((($total1+$total2+$total3)*19)/100),0,'','.').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                </tr>';     
                                                $cuerpo3.='<tr>
                                                    <td class="celda_5" colspan="3"></td>
                                                    <td class="celda_5"><strong>&nbsp;&nbsp;&nbsp;Total</strong></td>
                                                    <td class="celda_5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.number_format(($total1+$total2+$total3+((($total1+$total2+$total3)*19)/100)),0,'','.').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                </tr>';                                                 
                                    $cuerpo3.='</table>  
                </div><div class="separador_50"></div>';
                    $cuerpo3.='<table>';  
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';     
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';          
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;<td>';
                    $cuerpo3.='</tr>';
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';                          
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>Sección(es): <strong>'.strtoupper($tipo_seccion).'</strong></td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>Fecha General de Entrega 19/06/2017</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';                      
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>En caso de reclamos, contactarse con: </td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td><strong>Pedido por: '.strtoupper($envia_pedido->nombre).'</strong></td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';                    
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td><strong>Celular: '.strtoupper($envia_pedido->telefono).'</strong></td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';                     
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td><strong>Quien Recibe: '.strtoupper($recibe_pedido->nombre).'</strong></td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td></td>';
                    $cuerpo3.='</tr>';
                
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;<td>';
                    $cuerpo3.='</tr>';

                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>'; 

                    
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>ADJUNTAMOS:</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td></td>';
                    $cuerpo3.='</tr>';
                    
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>Forma de Pago&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td><strong>'.strtoupper($forma_pago3->forma_pago).'</strong></td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';                      
                    
                    if ($proveedor3->id_forma_pago==100)
                    {        
                        $cuerpo3.='<tr>';
                            $cuerpo3.='<td>Tipo de Cuenta&nbsp;&nbsp;</td>';
                            $cuerpo3.='<td><strong>'.strtoupper($tipo_cuenta3).'</strong></td>';
                            $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                            $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                            $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='</tr>';   
                        $cuerpo3.='<tr>';
                            $cuerpo3.='<td>Numero de Cuenta&nbsp;&nbsp;</td>';
                            $cuerpo3.='<td><strong>'.strtoupper($proveedor3->num_cuenta).'</strong></td>';
                            $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                            $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                            $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='</tr>';    
                        $cuerpo3.='<tr>';
                            $cuerpo3.='<td>Titular de Cuenta&nbsp;&nbsp;</td>';
                            $cuerpo3.='<td><strong>'.strtoupper($proveedor3->titular_cuenta).'</strong></td>';
                            $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                            $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                            $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='</tr>';   
                    }
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;<td>';
                    $cuerpo3.='</tr>';
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;<td>';
                    $cuerpo3.='</tr>';

                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>Sírvase Entregar a:</td>';
                        $cuerpo3.='<td><strong>'.strtoupper($tipo_despacho).'</strong></td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';                       
                    $cuerpo3.='</table>';   
                    $cuerpo3.='<table>';     
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;<td>';
                    $cuerpo3.='</tr>';
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>'; 
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;<td>';
                    $cuerpo3.='</tr>';
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>'; 
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;<td>';
                    $cuerpo3.='</tr>';
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>'; 
                    $cuerpo3.='</table>';     
 
                    $cuerpo3.='<table>';     
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';                    
                    $cuerpo3.='</table>';                  
                    $cuerpo3.='<table style="width:100% !important;">';                      

                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;__________________________________________________</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>'; 
                    $cuerpo3.='<tr>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        if (($total1+$total2+$total3+((($total1+$total2+$total3)*19)/100)>100000))
                            $cuerpo3.='<td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper('Enrique Grau').'</strong></td>';
                        else
                            $cuerpo3.='<td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($envia_pedido->nombre).'</strong></td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo3.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo3.='</tr>';                     
                    $cuerpo3.='</table>';                       
		
		
		
    $cuerpo3.='</body>
</html>';
?>