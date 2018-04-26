
<div class="control-group">
<div class="controls">
<h3>Solicitudes con Ordenes de Producción en Sistema Nuevo</h3>
<!--
	   <table>
	<tr>
            <td>
		<br>-->
		<select name="rep" id="rep" onchange="llamarlink(this.value); Repajax(this.value);"  class="chosen-select">
                    <option value="0">Seleccione......</option>
                            <?php foreach($datos as $i=>$dato) { ?>		
				<option  value="<?php echo $dato->id_cotizacion?>"><?php echo 'N de Cotizacion: <strong>'.$dato->id_cotizacion.'</strong>';?> ( <?php echo 'Nro. Molde: '.$dato->numero_molde?> ) ( <?php echo 'Cod: '.$dato->codigo?> )	( <?php echo 'Nombre: '.$dato->nombre?> ) [<?php echo 'Condicion del producto: '.$dato->condicion_del_producto?>] </option>				
			    <?php } ?>			
                </select>
<!--	    </td>
	</tr>
    </table> -->
 
   <div id="productos_asociados2">
   </div>

<h3>Solicitudes sin Ordenes de Producción en Sistema Nuevo</h3>
 <!--<a href="<?php echo base_url()?>cotizaciones/rep_ajax/<?php //echo $dato->id_cotizacion?>/<?php //echo $pagina ;?>" title="Repeticion Sin Cambio" class="fancybox fancybox.ajax">	
    <?php  //echo $cont.' N de Cotizacion: <strong>'.$coti->id.'</strong>';?> ( <?php //echo 'Cod: '.$ing->producto; echo ' Sin OP';	$cont = $cont +1; ?> )</a> -->
<select name="rep2" id="rep2" onchange="Repajax2(this.value);"  class="chosen-select">
<option value="0">Seleccione......</option>
<?php 	

$regitros[]=array();
foreach($cot as $i=>$coti)
{	
	$op=$this->orden_model->getOrdenesPorCotizacionListado($coti->id);
	$ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($coti->id);
	$foto=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($coti->id);
	$hc=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($coti->id); 
	if ($foto->numero_molde!='')
            $mol=$this->moldes_model->getNumeroMoldesTodos($foto->numero_molde);
        if ($coti->id_cliente==$mol->nombrecliente)
        {
            if ($ing->numero_molde!='')
                $numero_molde='( Nro. Molde: '.$ing->numero_molde.' )';
            else 
                $numero_molde='';
        }
        else {   
            $numero_molde='Error molde:'.$ing->numero_molde.', no pertenece al cliente';
        }
	if(sizeof($foto) >=1 and sizeof($op) == 0)
	{
            if(in_array($ing->producto,$regitros)){
                array_push($regitros, "hola");
            }else{
                array_push($regitros, $ing->producto); ?>
                
                <option  value="<?php echo $coti->id?>"><?php  echo ' N de Cotizacion: <strong>'.$coti->id.'</strong>';?> <?php echo $numero_molde?>  ( <?php echo 'Cod: '.$ing->producto; echo ' Sin OP';?> )</option>				
            <?php
            }
	?>
	<!--<option  value="<?php //echo $coti->id?>"><?php  //echo ' N de Cotizacion: <strong>'.$coti->id.'</strong>';?> <?php echo $numero_molde?>  ( <?php// echo 'Cod: '.$ing->producto; //echo ' Sin OP';?> )</option>-->				

	<?PHP	
	}		
}
?>
</select>
   <div id="productos_asociados3">
   </div>
</div>
</div>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>