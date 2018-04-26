<h3>Repetir CON o SIN Cambios la Cotización N° <?php echo number_format($id,0,'','.') ?> <?php if($datos->id_antiguo>0){?>(Antiguo <?php echo number_format($datos->id_antiguo,0,'','.')?>)<?php }?></h3>

<hr style="width:1000px;" />
<table class="table table-bordered">
<tbody>

</tbody>
<tr>
    <td>Repetir CON o SIN Cambios?</td>
  
</tr>

<tr>
 <div class="control-group">
		<div class="form-actions">
         <input type="hidden" name="id" value="<?php echo $id?>" />
         <input type="hidden" name="url" value="<?php echo base_url()."cotizaciones/add_sin_cambios/".$id;?>" />
		 <a href="<?php echo base_url()?>cotizaciones/add_sin_cambios/<?php echo $id ?>/<?php echo $pagina?> " class="btn btn-success" role="button" title="Usar ésta cotización">SIN</a>	

		   
		</div>
		
		
		<div class="form-actions">
         <input type="hidden" name="id" value="<?php echo $id?>" />
         <input type="hidden" name="url" value="<?php echo base_url()."cotizaciones/add_con_cambios/".$id;?>" />
		 <a href="<?php echo base_url()?>cotizaciones/add_con_cambios/<?php echo $id ?>/<?php echo $pagina?> " class="btn btn-danger" role="button" title="Usar ésta cotización">CON</a>	

		   
		</div>
	</div>
    
</tr>


</table>
