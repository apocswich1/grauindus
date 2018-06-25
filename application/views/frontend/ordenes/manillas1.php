<?php
$cuerpo=' <!DOCTYPE html>
                        <html>
                        <head>
                        <meta charset="utf-8" />
        
<link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/bootstrap.css" />
        <link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/orden_de_produccion.css" />
    </head>
    <body>';
    $cuerpo.='<div class="container fuente">
            <header>';
                   
        $cuerpo.='</header>
                    <div class="separador_10"></div>
                    <div class="separador_10"></div>';
                    $cuerpo.='<table>';     
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>SANTIAGO&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>'.strtoupper($fecha_hoy).'</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td style="font-family: sans-serif;font-size: 18px;">'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'                                
                                . '&nbsp;<span class="borde">ORDEN DE COMPRA:'.strtoupper($ide).' </span></td>';
                    $cuerpo.='</tr>';
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';                    
                    $cuerpo.='</table>';   
                    $cuerpo.='<table>';  
                    $cuerpo.='<tr>';
                        $cuerpo.='<td style="font-family: sans-serif;font-size: 32px;">'.strtoupper($empresa->razon_social).' </td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';                     
                    $cuerpo.='<tr>';
                        $cuerpo.='<td style="font-family: sans-serif;font-size: 18px;font-weight: 400;">RUT :'.$empresa->rut.'</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';                    
                    $cuerpo.='<tr>';
                        $cuerpo.='<td style="font-family: sans-serif;font-size: 18px;">DIRECCIÓN '.strtoupper($empresa->direccion).'</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';        
                    $cuerpo.='<tr>';
                        $cuerpo.='<td style="font-family: sans-serif;font-size: 18px;">REGION '.strtoupper($empresa->region).'</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';  
                    $cuerpo.='<tr>';
                        $cuerpo.='<td style="font-family: sans-serif;font-size: 18px;">PROVINCIA '.strtoupper($empresa->comuna).'</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';  
                    $cuerpo.='<tr>';
                        $cuerpo.='<td style="font-family: sans-serif;font-size: 18px;">CIUDAD '.strtoupper($empresa->ciudad).'</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';      
                    $cuerpo.='<tr>';
                        $cuerpo.='<td style="font-family: sans-serif;font-size: 18px;">FONO '.strtoupper($empresa->telefono).'</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';    
                    $cuerpo.='</table>';  
                    $cuerpo.='<table>';                      
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';   
                    $cuerpo.='</table>';                      
                    $cuerpo.='<table>
                                <tr>
                                    <td class="centro"><h1><span id="titulo" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orden de Compra de Piezas Adicionales 1</span></h1>
                                    </td>
                                </tr>
                            </table>';         
                    $cuerpo.='<table>';           
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';    
                    $cuerpo.='<tr>';
//                    exit(print_r($proveedor));
                    
                        $cuerpo.='<td>Rut:&nbsp;&nbsp;</td>';
                        if ($proveedor->rut=='')
                            $cuerpo.='<td><strong>'.strtoupper($proveedor->rut).'</strong></td>';
                        else
                            $cuerpo.='<td><strong>'.strtoupper('Rut No Registrado').'</strong></td>';                            
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';                      
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>Señor(es)&nbsp;&nbsp;</td>';
                        if ($proveedor->razon_social!='')
                            $cuerpo.='<td><strong>'.strtoupper($proveedor->razon_social).'</strong></td>';
                        else
                            $cuerpo.='<td><strong>'.strtoupper($proveedor->nombre).'</strong></td>';                         
                        $cuerpo.='<td><strong>'.strtoupper().'</strong></td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';

                    $cuerpo.='<tr>';
                        $cuerpo.='<td>Fono&nbsp;&nbsp;</td>';
                        $cuerpo.='<td><strong>'.strtoupper($proveedor->telefono).'</strong></td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';        
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>E-mail:&nbsp;&nbsp;</td>';
                        $cuerpo.='<td><strong>'.strtoupper($proveedor->correo).'</strong></td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';   
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>Al Señor:&nbsp;&nbsp;</td>';
                        $cuerpo.='<td><strong>'.strtoupper($proveedor->contacto).'</strong></td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';                    

                    $cuerpo.='<tr>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';                        
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>Por nuestra cuenta lo siguiente:</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';                               
                    $cuerpo.='</table>';  
                        

                $cuerpo.='<!--separador 10-->';
                    $cuerpo.='<div class="separador_10"></div>';
                    $cuerpo.='<div class="separador_20"></div> 
                    <div style="margin-left:15px; text-align:center;"> 
                                    <table border="1" style="width:100% !important;">
                                            <tr>
                                               <td class="celda_5" colspan="5"><strong>&nbsp;&nbsp;&nbsp;Piezas Adicionales 1</strong></td>
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
                                            
                                            if ($fotomacanica->fot_reserva_barniz==''){$reserva = "Si Reserva";}else{$reserva=$fotomacanica->fot_reserva_barniz;}
                                            if ($orden_compra_piezas->id_pieza1!='0')
                                            {
//                                                if ($orden_compra_piezas->id_proveedor1==$id_proveedor)
//                                                {                                              
                                                    $cuerpo.='<tr>
                                                        <td class="celda_5" style"text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.ucwords(strtolower($orden_compra_piezas->cantidad_1)).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                        <td class="celda_5" style"text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.ucwords(strtolower($this->piezas_adicionales_model->getUnidadesUsoPieza($orden_compra_piezas->id_pieza1))).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>                                                
                                                        <td class="celda_5" style"text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.ucwords(strtolower($orden_compra_piezas->id_pieza1)).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>                                                
                                                        <td class="celda_5" style"text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.number_format($orden_compra_piezas->valor_compra,0,'','.').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>                                                
                                                        <td class="celda_5" style"text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.number_format(($orden_compra_piezas->valor_compra*$orden_compra_piezas->cantidad_1),0,'','.').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    </tr>';
                                                    $total1=$orden_compra_piezas->valor_compra*$orden_compra_piezas->cantidad_1;
                                                //} 
                                            }
                                                $cuerpo.='<tr>
                                                    <td class="celda_5" colspan="3"></td>
                                                    <td class="celda_5"><strong>&nbsp;&nbsp;&nbsp;Neto</strong></td>
                                                    <td class="celda_5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.number_format(($total1+$total2+$total3),0,'','.').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                </tr>';      
                                                $cuerpo.='<tr>
                                                    <td class="celda_5" colspan="3"></td>
                                                    <td class="celda_5"><strong>&nbsp;&nbsp;&nbsp;IVA</strong></td>
                                                    <td class="celda_5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.number_format(((($total1+$total2+$total3)*19)/100),0,'','.').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                </tr>';     
                                                $cuerpo.='<tr>
                                                    <td class="celda_5" colspan="3"></td>
                                                    <td class="celda_5"><strong>&nbsp;&nbsp;&nbsp;Total</strong></td>
                                                    <td class="celda_5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.number_format(($total1+$total2+$total3+((($total1+$total2+$total3)*19)/100)),0,'','.').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                </tr>';                                                 
                                    $cuerpo.='</table>  
                </div><div class="separador_50"></div>';
                    $cuerpo.='<table>';  
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';     
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';          
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;<td>';
                    $cuerpo.='</tr>';
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';                          
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>Sección(es): <strong>'.strtoupper($tipo_seccion).'</strong></td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>Fecha General de Entrega 19/06/2017</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';                      
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>En caso de reclamos, contactarse con: </td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';
                    $cuerpo.='<tr>';
                        $cuerpo.='<td><strong>Pedido por: '.strtoupper($envia_pedido->nombre).'</strong></td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';                    
                    $cuerpo.='<tr>';
                        $cuerpo.='<td><strong>Celular: '.strtoupper($envia_pedido->telefono).'</strong></td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';                     
                    $cuerpo.='<tr>';
                        $cuerpo.='<td><strong>Quien Recibe: '.strtoupper($recibe_pedido->nombre).'</strong></td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td></td>';
                    $cuerpo.='</tr>';
                
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;<td>';
                    $cuerpo.='</tr>';

                    $cuerpo.='<tr>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>'; 

                    
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>ADJUNTAMOS:</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td></td>';
                    $cuerpo.='</tr>';
                    
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>Forma de Pago&nbsp;&nbsp;</td>';
                        $cuerpo.='<td><strong>'.strtoupper($forma_pago->forma_pago).'</strong></td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';                      
                    
                    if ($proveedor->id_forma_pago==100)
                    {        
                        $cuerpo.='<tr>';
                            $cuerpo.='<td>Tipo de Cuenta&nbsp;&nbsp;</td>';
                            $cuerpo.='<td><strong>'.strtoupper($tipo_cuenta).'</strong></td>';
                            $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                            $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                            $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='</tr>';   
                        $cuerpo.='<tr>';
                            $cuerpo.='<td>Numero de Cuenta&nbsp;&nbsp;</td>';
                            $cuerpo.='<td><strong>'.strtoupper($proveedor->num_cuenta).'</strong></td>';
                            $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                            $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                            $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='</tr>';    
                        $cuerpo.='<tr>';
                            $cuerpo.='<td>Titular de Cuenta&nbsp;&nbsp;</td>';
                            $cuerpo.='<td><strong>'.strtoupper($proveedor->titular_cuenta).'</strong></td>';
                            $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                            $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                            $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='</tr>';   
                    }
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;<td>';
                    $cuerpo.='</tr>';
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;<td>';
                    $cuerpo.='</tr>';

                    $cuerpo.='<tr>';
                        $cuerpo.='<td>Sírvase Entregar a:</td>';
                        $cuerpo.='<td><strong>'.strtoupper($tipo_despacho).'</strong></td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';                       
                    $cuerpo.='</table>';   
                    $cuerpo.='<table>';     
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;<td>';
                    $cuerpo.='</tr>';
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>'; 
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;<td>';
                    $cuerpo.='</tr>';
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>'; 
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;<td>';
                    $cuerpo.='</tr>';
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>'; 
                    $cuerpo.='</table>';     
 
                    $cuerpo.='<table>';     
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';                    
                    $cuerpo.='</table>';                  
                    $cuerpo.='<table style="width:100% !important;">';                      

                    $cuerpo.='<tr>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;__________________________________________________</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>'; 
                    $cuerpo.='<tr>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        if (($total1+$total2+$total3+((($total1+$total2+$total3)*19)/100)>100000))
                            $cuerpo.='<td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper('Enrique Grau').'</strong></td>';
                        else
                            $cuerpo.='<td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($envia_pedido->nombre).'</strong></td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                        $cuerpo.='<td>&nbsp;&nbsp;&nbsp;</td>';
                    $cuerpo.='</tr>';                     
                    $cuerpo.='</table>';                       
		
		
		
    $cuerpo.='</body>
</html>';
?>