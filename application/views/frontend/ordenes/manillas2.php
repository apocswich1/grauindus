<?php

$cuerpo2=' <!DOCTYPE html>
                        <html>
                        <head>
                        <meta charset="utf-8" />
        
<link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/bootstrap.css" />
        <link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/orden_de_produccion.css" />
    </head>
    <body>';
    $cuerpo2.='<div class="container fuente">
            <header>';
		

                      
        $cuerpo2.='</header>
                    <div class="separador_10"></div>
                    <div class="separador_10"></div>';
                    $cuerpo2.='<table>';     
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>SANTIAGO&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>'.strtoupper($fecha_hoy).'</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td style="font-family: sans-serif;font-size: 18px;">'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'                                
                                . '&nbsp;<span class="borde">ORDEN DE COMPRA:'.strtoupper($ide).' </span></td>';
                    $cuerpo2.='</tr>';
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';                    
                    $cuerpo2.='</table>';   
                    $cuerpo2.='<table>';  
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td style="font-family: sans-serif;font-size: 32px;">'.strtoupper($empresa->razon_social).' </td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';                     
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td style="font-family: sans-serif;font-size: 18px;font-weight: 400;">RUT :'.$empresa->rut.'</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';                    
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td style="font-family: sans-serif;font-size: 18px;">DIRECCIÓN '.strtoupper($empresa->direccion).'</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';        
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td style="font-family: sans-serif;font-size: 18px;">REGION '.strtoupper($empresa->region).'</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';  
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td style="font-family: sans-serif;font-size: 18px;">PROVINCIA '.strtoupper($empresa->comuna).'</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';  
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td style="font-family: sans-serif;font-size: 18px;">CIUDAD '.strtoupper($empresa->ciudad).'</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';      
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td style="font-family: sans-serif;font-size: 18px;">FONO '.strtoupper($empresa->telefono).'</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';    
                    $cuerpo2.='</table>';  
                    $cuerpo2.='<table>';                      
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';   
                    $cuerpo2.='</table>';                      
                    $cuerpo2.='<table>
                                <tr>
                                    <td class="centro"><h1><span id="titulo" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orden de Compra de Piezas Adicionales 2</span></h1>
                                    </td>
                                </tr>
                            </table>';         
                    $cuerpo2.='<table>';           
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';    
                    $cuerpo2.='<tr>';
//                    exit(print_r($proveedor));
                    
                        $cuerpo2.='<td>Rut:&nbsp;&nbsp;</td>';
                        if ($proveedor2->rut=='')
                            $cuerpo2.='<td><strong>'.strtoupper($proveedor2->rut).'</strong></td>';
                        else
                            $cuerpo2.='<td><strong>'.strtoupper('Rut No Registrado').'</strong></td>';                            
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';                      
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>Señor(es)&nbsp;&nbsp;</td>';
                        if ($proveedor2->razon_social!='')
                            $cuerpo2.='<td><strong>'.strtoupper($proveedor2->razon_social).'</strong></td>';
                        else
                            $cuerpo2.='<td><strong>'.strtoupper($proveedor2->nombre).'</strong></td>';                         
                        $cuerpo2.='<td><strong>'.strtoupper().'</strong></td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';

                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>Fono&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td><strong>'.strtoupper($proveedor2->telefono).'</strong></td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';        
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>E-mail:&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td><strong>'.strtoupper($proveedor2->correo).'</strong></td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';   
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>Al Señor:&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td><strong>'.strtoupper($proveedor2->contacto).'</strong></td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';                    

                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';                        
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>Por nuestra cuenta lo siguiente:</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';                               
                    $cuerpo2.='</table>';  
                        

                $cuerpo2.='<!--separador 10-->';
                    $cuerpo2.='<div class="separador_10"></div>';
                    $cuerpo2.='<div class="separador_20"></div> 
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
                                            
                                         
                                            if ($orden_compra_piezas2->id_pieza2!='0')
                                            {                                            
                                                if ($orden_compra_piezas2->id_proveedor2==$id_proveedor)
                                                {
                                                    $cuerpo2.='<tr>
                                                        <td class="celda_5" style"text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.ucwords(strtolower($orden_compra_piezas2->cantidad_2)).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                        <td class="celda_5" style"text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.ucwords(strtolower($this->piezas_adicionales_model->getUnidadesUsoPieza($orden_compra_piezas2->id_pieza2))).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                        <td class="celda_5" style"text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.ucwords(strtolower($orden_compra_piezas2->id_pieza2)).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                        <td class="celda_5" style"text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.number_format($orden_compra_piezas2->valor_compra,0,'','.').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>                                                
                                                        <td class="celda_5" style"text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.number_format(($orden_compra_piezas2->valor_compra*$orden_compra_piezas2->cantidad_2),0,'','.').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    </tr>';
                                                    $total2=$orden_compra_piezas2->valor_compra*$orden_compra_piezas2->cantidad_2;
                                                }
                                            }
                                                                                     
                                                $cuerpo2.='<tr>
                                                    <td class="celda_5" colspan="3"></td>
                                                    <td class="celda_5"><strong>&nbsp;&nbsp;&nbsp;Neto</strong></td>
                                                    <td class="celda_5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.number_format(($total1+$total2+$total3),0,'','.').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                </tr>';      
                                                $cuerpo2.='<tr>
                                                    <td class="celda_5" colspan="3"></td>
                                                    <td class="celda_5"><strong>&nbsp;&nbsp;&nbsp;IVA</strong></td>
                                                    <td class="celda_5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.number_format(((($total1+$total2+$total3)*19)/100),0,'','.').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                </tr>';     
                                                $cuerpo2.='<tr>
                                                    <td class="celda_5" colspan="3"></td>
                                                    <td class="celda_5"><strong>&nbsp;&nbsp;&nbsp;Total</strong></td>
                                                    <td class="celda_5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.number_format(($total1+$total2+$total3+((($total1+$total2+$total3)*19)/100)),0,'','.').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                </tr>';                                                 
                                    $cuerpo2.='</table>  
                </div><div class="separador_50"></div>';
                    $cuerpo2.='<table>';  
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';     
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';          
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;<td>';
                    $cuerpo2.='</tr>';
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';                          
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>Sección(es): <strong>'.strtoupper($tipo_seccion).'</strong></td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>Fecha General de Entrega 19/06/2017</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';                      
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>En caso de reclamos, contactarse con: </td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td><strong>Pedido por: '.strtoupper($envia_pedido->nombre).'</strong></td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';                    
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td><strong>Celular: '.strtoupper($envia_pedido->telefono).'</strong></td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';                     
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td><strong>Quien Recibe: '.strtoupper($recibe_pedido->nombre).'</strong></td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td></td>';
                    $cuerpo2.='</tr>';
                
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;<td>';
                    $cuerpo2.='</tr>';

                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>'; 

                    
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>ADJUNTAMOS:</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td></td>';
                    $cuerpo2.='</tr>';
                    
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>Forma de Pago&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td><strong>'.strtoupper($forma_pago2->forma_pago).'</strong></td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';                      
                    
                    if ($proveedor2->id_forma_pago==100)
                    {        
                        $cuerpo2.='<tr>';
                            $cuerpo2.='<td>Tipo de Cuenta&nbsp;&nbsp;</td>';
                            $cuerpo2.='<td><strong>'.strtoupper($tipo_cuenta2).'</strong></td>';
                            $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                            $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                            $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='</tr>';   
                        $cuerpo2.='<tr>';
                            $cuerpo2.='<td>Numero de Cuenta&nbsp;&nbsp;</td>';
                            $cuerpo2.='<td><strong>'.strtoupper($proveedor2->num_cuenta).'</strong></td>';
                            $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                            $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                            $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='</tr>';    
                        $cuerpo2.='<tr>';
                            $cuerpo2.='<td>Titular de Cuenta&nbsp;&nbsp;</td>';
                            $cuerpo2.='<td><strong>'.strtoupper($proveedor2->titular_cuenta).'</strong></td>';
                            $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                            $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                            $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='</tr>';   
                    }
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;<td>';
                    $cuerpo2.='</tr>';
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;<td>';
                    $cuerpo2.='</tr>';

                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>Sírvase Entregar a:</td>';
                        $cuerpo2.='<td><strong>'.strtoupper($tipo_despacho).'</strong></td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';                       
                    $cuerpo2.='</table>';   
                    $cuerpo2.='<table>';     
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;<td>';
                    $cuerpo2.='</tr>';
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>'; 
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;<td>';
                    $cuerpo2.='</tr>';
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>'; 
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;<td>';
                    $cuerpo2.='</tr>';
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>'; 
                    $cuerpo2.='</table>';     
 
                    $cuerpo2.='<table>';     
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';                    
                    $cuerpo2.='</table>';                  
                    $cuerpo2.='<table style="width:100% !important;">';                      

                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;__________________________________________________</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>'; 
                    $cuerpo2.='<tr>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        if (($total1+$total2+$total3+((($total1+$total2+$total3)*19)/100)>100000))
                            $cuerpo2.='<td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper('Enrique Grau').'</strong></td>';
                        else
                            $cuerpo2.='<td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($envia_pedido->nombre).'</strong></td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo2.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo2.='</tr>';                     
                    $cuerpo2.='</table>';                       
		
		
		
    $cuerpo2.='</body>
</html>';
?>