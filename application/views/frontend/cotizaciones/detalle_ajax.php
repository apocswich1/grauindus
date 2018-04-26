<h3>Detalle Cotización N° <?php echo number_format($id,0,'','.') ?> <?php if($datos->id_antiguo>0){?>(Antiguo <?php echo number_format($datos->id_antiguo,0,'','.')?>)<?php }?></h3>

<hr style="width:1000px;" />
<table class="table table-bordered">
<tbody>
    <th>Número de cotización:</th>
    <th>Detalle Cotización N° <?php echo number_format($id,0,'','.') ?> <?php if($datos->id_antiguo>0){?>(Antiguo <?php echo number_format($datos->id_antiguo,0,'','.')?>)<?php }?></th>
</tbody>
<tr>
    <td>Fecha</td>
    <td><?php echo fecha($datos->fecha)?></td>
</tr>
<tr>
    <td>Estado</td>
    <td>
      <?php
        /*switch($datos->estado)
        {
            case '1':
                $estado="Abierto";
            break;
             case '2':
                $estado="en proceso pendiente ingeniería";
            break;
             case '3':
                $estado="en proceso pendiente fotomecánica";
            break;
             case '4':
                $estado="información ratificada pendiente de cotización";
            break;
             case '5':
                $estado="cotización generada";
            break;
        }*/
		if(sizeof($datos) >=1 )
		{
			$estado="En Solicitud de Cotización";
		}
		//Ingenieria
		if(sizeof($ing) >=1 and $ing->estado == 0)
		{
			$estado="En Revisión Ingeniería: Activa";
		}
		if(sizeof($ing) >=1 and $ing->estado == 1)
		{
			$estado="En Revisión Ingeniería: Liberada";
		}
		if(sizeof($ing) >=1 and $ing->estado == 2)
		{
			$estado="En Revisión Ingeniería: Rechazada";
		}
		//Fotomecanica
		if(sizeof($fotomecanica) >=1 and $ing->estado == 0)
		{
			$estado="En Revisión Fotomecanica: Activa";
		}
		if(sizeof($fotomecanica) >=1 and $ing->estado == 1)
		{
			$estado="En Revisión Fotomecanica: Liberada";
		}
		if(sizeof($fotomecanica) >=1 and $ing->estado == 2)
		{
			$estado="En Revisión Fotomecanica: Rechazada";
		}
		
		if(sizeof($hoja) >=1 )
		{
			$estado="En Hoja de Costo";
		}
		
		//OC
		if(sizeof($orden) >=1 and $orden->estado == 0)
		{
			$estado="En Orden de Compra: Activa";
		}
		if(sizeof($orden) >=1 and $orden->estado == 1)
		{
			$estado="En Orden de Compra: Liberada";
		}
		if(sizeof($orden) >=1 and $orden->estado == 2)
		{
			$estado="En Orden de Compra: Rechazada";
		}
		

		//OP
		if(sizeof($orden_produccion) >=1 and $orden_produccion->estado == 0)
		{
			$estado="En Orden de Producción: Activa";
		}
		if(sizeof($orden_produccion) >=1 and $orden_produccion->estado == 1)
		{
			$estado="En Orden de Producción: Liberada";
		}
		if(sizeof($orden_produccion) >=1 and $orden_produccion->estado == 2)
		{
			$estado="En Orden de Producción: Rechazada";
		}
		
        echo $estado;
        ?>
    </td>
</tr>
<tr>
    <td>Quién Solicita es:</td>
    <td>
        <?php 
        $usuario=$this->usuarios_model->getUsuariosPorId($datos->id_usuario);
        echo $usuario->nombre;
        ?>
    </td>
</tr>
<tr>
    <td>Cliente</td>
    <td>
        <?php 
         if($datos->id_cliente==3000)
        {
            $cliente=$datos->nombre_cliente;
        }else
        {
            $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
            $cliente=$cli->razon_social;
        }
        echo $cliente;
        ?>
    </td>
</tr>
<tr>
    <td>Descripción</td>
    <td><?php echo $datos->producto?></td>
</tr>

<tr>
    <td>Cantidades</td>
    <td><?php if($datos->cantidad_1 == 1){echo '0';}else{echo $datos->cantidad_1;}?> - <?php if($datos->cantidad_2 == 1){echo '0';}else{echo $datos->cantidad_2;}?> - <?php if($datos->cantidad_3 == 1){echo '0';}else{echo $datos->cantidad_3;}?> - <?php if($datos->cantidad_4 == 1){echo '0';}else{echo $datos->cantidad_4;}?></td>
</tr>
<tr>
    <td>Acepta Excentes</td>
    <td><?php if($datos->acepta_excedentes == ''){echo 'NO';}else{echo $datos->acepta_excedentes;}?></td>
</tr>
<tr>
    <td>VB en Máquina</td>
    <td><?php if($datos->vb_maquina == ''){echo 'NO';}else{echo $datos->vb_maquina;}?></td>
</tr>
<tr>
    <td>Solicita Muesta :</td>
	<td><?php echo $datos->materialidad_solicita_muestra?></td>
</tr>
<!--
<tr>
    <td>Precios</td>
    <td>$<?php echo number_format($datos->precio_1)?> - $<?php echo number_format($datos->precio_1)?> - $<?php echo number_format($datos->precio_1)?> - $<?php echo number_format($datos->precio_1)?></td>
</tr>
-->
<tr>
    <td>Comentario Medidas</td>
    <td><?php echo $datos->comentario_medidas?></td>
</tr>
<tr>
    <td>Piezas Adicionales</td>
    <td>
	<?php 
	//Datos
	if(sizeof($datos) >=1 )
		{
			echo '°'.$datos->piezas_adicionales.'<br>';
			echo '°'.$datos->piezas_adicionales2.'<br>';
			echo '°'.$datos->piezas_adicionales3.'<br>';
		}else{
				//Ingenieria
				if(sizeof($ing) >=1)
				{
					echo '°'.$datos->piezas_adicionales.'<br>';
					echo '°'.$datos->piezas_adicionales2.'<br>';
					echo '°'.$datos->piezas_adicionales3.'<br>';
				}else{
					    //Fotomecanica
						if(sizeof($fotomecanica) >=1 )
						{
							echo '°'.$datos->piezas_adicionales.'<br>';
							echo '°'.$datos->piezas_adicionales2.'<br>';
							echo '°'.$datos->piezas_adicionales3.'<br>';
						}
				}
		}
	?>
	
	</td>
</tr>
<tr>
    <td>Comentario Piezas Adicionales</td>
    <td>
	<?php 
	//Datos
	if(sizeof($datos) >=1 )
		{
			$piezaAdicional =  $datos->comentario_piezas_adicionales;
		}else{
				//Ingenieria
				if(sizeof($ing) >=1)
				{
					$piezaAdicional = $ing->comentario_piezas_adicionales;
				}else{
					    //Fotomecanica
						if(sizeof($fotomecanica) >=1 )
						{
							$piezaAdicional = $fotomecanica->comentario_piezas_adicionales;
						}
				}
		}
		
		if($piezaAdicional == '')
		{
			echo 'Sin comentarios';
		}else{
			echo $piezaAdicional;
		}
	?>
	</td>
</tr>
<tr>
    <td>Materialidad</td>
    <td>
       <?php 
	//Datos
	if(sizeof($datos) >=1 )
		{
			$materialidad_datos_tecnicos =  $datos->materialidad_datos_tecnicos;
			$materialidad1 =  $datos->materialidad_1;
			$materialidad2 =  $datos->materialidad_2;
			$materialidad3 =  $datos->materialidad_3;
			$materialidad4 =  $datos->materialidad_4;
		}else{
				//Ingenieria
				if(sizeof($ing) >=1)
				{
					$materialidad_datos_tecnicos = $ing->materialidad_datos_tecnicos;
					$materialidad1 =  $ing->materialidad_1;
					$materialidad2 =  $ing->materialidad_2;
					$materialidad3 =  $ing->materialidad_3;
					$materialidad4 =  $ing->materialidad_4;
				}else{
					    //Fotomecanica
						if(sizeof($fotomecanica) >=1 )
						{
							$materialidad_datos_tecnicos = $fotomecanica->materialidad_datos_tecnicos;
							$materialidad1 =  $fotomecanica->materialidad_1;
							$materialidad2 =  $fotomecanica->materialidad_2;
							$materialidad3 =  $fotomecanica->materialidad_3;
							$materialidad4 =  $fotomecanica->materialidad_4;
						}
				}
		}
		if($materialidad_datos_tecnicos == '')
		{
			echo 'Sin comentarios';
		}else{
			echo 'Datos Tecnico: '.$materialidad_datos_tecnicos.'<br>';
			echo 'Tapa: '.$materialidad1.'<br>';
			echo 'Onda: '.$materialidad2.'<br>';
		    echo 'Liner: '.$materialidad3.'<br>';
		    //echo 'Liner2: '.$materialidad4;
		}
	?> 
    </td>
</tr>
<tr>
    <td>Impresión</td>
    <td>
        
                Colores : 
				<?php 
				
				if(sizeof($datos) >=1 )
					{
						echo $datos->impresion_colores;
					}
				?>
        <br />
        Colores Metálicos : <?php echo $datos->impresion_metalicos?>
        <br />
        <br />
        <label class="control-label" for="usuario">Fondo</label>		
              <ul>
                <li>Tiene Fondo: <?php if ($datos->tiene_fondo=="NO") echo "NO"; else echo "SI";?></li>
                <li>Imagen de Impresión: <?php if ($datos->proceso_fondo=="CO") echo "Al Corte"; elseif ($datos->proceso_fondo=="CE") echo "Al Centro"; else echo "No se Sabe"; ?></li>
            </ul>        
        <label class="control-label" for="usuario">Acabado Impresión interno</label>
            <ul>
                <li><?php $acabado1=$this->acabados_model->getAcabadosPorId($datos->impresion_acabado_impresion_1);echo $acabado1->caracteristicas?></li>
                <li><?php $acabado2=$this->acabados_model->getAcabadosPorId($datos->impresion_acabado_impresion_2);echo $acabado2->caracteristicas?></li>
                <li><?php $acabado3=$this->acabados_model->getAcabadosPorId($datos->impresion_acabado_impresion_3);echo $acabado3->caracteristicas?></li>
            </ul>
            
        	<label class="control-label" for="usuario">Acabado Impresión externo </label>		
              <ul>
                <li><?php $acabado4=$this->acabados_model->getAcabadosPorId($datos->impresion_acabado_impresion_4);echo $acabado4->caracteristicas?></li>
                <li><?php $acabado5=$this->acabados_model->getAcabadosPorId($datos->impresion_acabado_impresion_5);echo $acabado5->caracteristicas?></li>
                <li><?php $acabado6=$this->acabados_model->getAcabadosPorId($datos->impresion_acabado_impresion_6);echo $acabado6->caracteristicas?></li>
            </ul>
        Hacer Cromalín : <?php echo $datos->impresion_hacer_cromalin?>
    </td>
</tr>
<tr>
    <td>Procesos Especiales</td>
    <td>
        <?php 
        if ($fotomecanica->procesos_especiales_folia=="SI") {
            $array_folia= $this->procesos_especiales_model->getProcesosEspecialesPorId($fotomecanica->folia1_proceso_seletec);  ?>
            Folia : <?php echo $fotomecanica->procesos_especiales_folia?> - <?php echo $fotomecanica->procesos_especiales_folia_valor?> - <?php echo $array_folia->nombre_procesp."<br />";
        }
        if ($fotomecanica->procesos_especiales_folia_2=="SI") {            
            $array_folia2= $this->procesos_especiales_model->getProcesosEspecialesPorId($fotomecanica->folia2_proceso_seletec);  ?>
            Folia : <?php echo $fotomecanica->procesos_especiales_folia_2?> - <?php echo $fotomecanica->procesos_especiales_folia_2_valor?> - <?php echo $array_folia2->nombre_procesp."<br />";
        }
        if ($fotomecanica->procesos_especiales_folia_3=="SI") {  
            $array_folia3= $this->procesos_especiales_model->getProcesosEspecialesPorId($fotomecanica->folia3_proceso_seletec);  ?>
            Folia : <?php echo $fotomecanica->procesos_especiales_folia?> - <?php echo $fotomecanica->procesos_especiales_folia_3_valor?> - <?php echo $array_folia3->nombre_procesp."<br />";    
        }
        if ($fotomecanica->procesos_especiales_cuno=="SI") {  
            $array_cuno1= $this->procesos_especiales_model->getProcesosEspecialesPorId($fotomecanica->cuno1_proceso_seletec);  ?>
            Cuño : <?php echo $fotomecanica->procesos_especiales_cuno?> - <?php echo $fotomecanica->procesos_especiales_cuno_valor?> - <?php echo $array_cuno1->nombre_procesp."<br />";    
        }
        if ($fotomecanica->procesos_especiales_cuno_2=="SI") {  
            $array_cuno2= $this->procesos_especiales_model->getProcesosEspecialesPorId($fotomecanica->cuno2_proceso_seletec);  ?>
            Cuño : <?php echo $fotomecanica->procesos_especiales_cuno_2?> - <?php echo $fotomecanica->procesos_especiales_cuno_2_valor?> - <?php echo $array_cuno2->nombre_procesp."<br />";    
        }
        ?>        
    </td>
</tr>
<tr>
    <td>Instrucciones de Terminación</td>
    <td>
        Producto se entrega armado : <?php echo $datos->producto_se_entrega_armado?>
        <br />
        Tiene Desgajado : <?php echo $datos->tiene_desgajado?>
        <br />
        Montaje Pieza Especial : <?php echo $datos->montaje_pieza_especial?>
        <br />
        Instrucciones para la terminación y pegado : <?php echo $datos->pegado_instrucciones?>
        <br />
        Cantidad a empaquetar específica : <?php echo $datos->cantidad_especifica?>
        <br />
        Envasado : <?php echo $datos->envasado?>
    </td>
</tr>
<tr>
    <td>Detalle de Despacho</td>
    <td>
        Despacho fuera de Santiago : <?php echo $datos->despacho_fuera_de_santiago?>
        <br />
        Retira Cliente : <?php echo $datos->retira_cliente?>
        <br />
        Total o parcial : <?php echo $datos->tota_o_parcial?>
        <br />
        Cantidad Despacho : <?php echo $datos->can_despacho_1?> - <?php echo $datos->can_despacho_2?> - <?php echo $datos->can_despacho_3?>
    </td>
</tr>
<tr>
    <td>Comercial</td>
    <td>
        Forma de Pago : <?php $pagos_get=$this->clientes_model->getFormasPagoPorId($datos->forma_pago); echo $pagos_get->forma_pago; ?>
        <br />
        Comisión Agencia : <?php echo $datos->comision_agencia?>
        <br />
        Costo Comercial : <?php echo $datos->costo_comercial?>
    </td>
</tr>
<tr>
    <td>Cliente Entrega</td>
    <td>
        Cliente Entrega : <?php echo $datos->cliente_entrega_1?>
    </td>
</tr>

</table>
