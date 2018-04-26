<h3>No se Puede Repetir SIN Cambios la Cotización N° <?php echo number_format($id,0,'','.') ?> <?php if($datos->id_antiguo>0){?>(Antiguo <?php echo number_format($datos->id_antiguo,0,'','.')?>)<?php }?></h3>

<hr style="width:1000px;" />
<table class="table table-bordered">
<tbody>

</tbody>
<tr>
    <!-- <td>Repetir Sin Cambios</td> -->
  
</tr>

<tr>
 <div class="control-group">

		<div class="form-actions">
		<h5>No se Puede Repetir la Cotización ya que no hay Hoja de Costo guardada </h5>
         <input type="hidden" name="id" value="<?php echo $id?>" />
		</div>
	</div>
    
</tr>


</table>
