<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<div class="page-header"><h3>Tapas, Papeles y Cartulinas ( <?php echo sizeof($datos)?> en total)</h3></div>

<!--
<div style="text-align: right;">
 <div class="control-group">
		<label class="control-label" for="usuario">Filtrar</label>
		<div class="controls">
			<select name="perfil" onchange="enviaSelect2(this.value);">
                <option value="0">Seleccione.....</option>
               <?php
               foreach($tipos as $tipo)
               {
                    ?>
                    <option value="<?php echo $tipo->id?>"><?php echo $tipo->materiales_tipo?></option>
                    <?php
               }
               ?>   
            </select>
		</div>
	</div>
</div>
-->

<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>materiales/add">Agregar Tapas, Papeles y Cartulinas</a>
    <br /><br />

</div>

<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
		
			<th>Tipo</th>
             <th>Reverso</th>
		      <th>Gramaje</th>
              <th>Precio</th>
              <th>Estado</th>  
              <th>Detalle</th>
			<th>Fecha Última Actualización</th>
              <?php
              if($this->session->userdata('perfil')==1)
              {
                ?>
                <th>Acciones</th>
                <?php
              }
              ?>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
    ?>
    <tr>
        <td><?php echo $dato->materiales_tipo?></td>
        <td><?php echo $dato->reverso?></td>
			<td><?php echo $dato->gramaje?></td>
            <td>
                <?php 
                    if($dato->divisa=="Pesos")
                    {
                        echo "$".number_format($dato->precio,0,"",".");
                    }else
                    {
                        echo number_format($dato->precio,0,"",".")." USD";
                    }
                    
                ?>
            </td>
            <td>
                <?php 
                    switch($dato->estado)
                    {
                        case '1':
                            ?>
                            <span style="color: green; font-weight: bold;">Vigente</span>
                            <?php
                        break;
                        case '0':
                            ?>
                            <span style="color: red; font-weight: bold;">No Vigente</span>
                            <?php
                        break;
                    }
                    
                ?>
            </td>
            <td style="text-align: center;">
            <a href="<?php echo base_url()?>materiales/detalle_ajax/<?php echo $dato->id?>" title="<?php echo $dato->nombre?>" class="fancybox fancybox.ajax"><i class="icon-search"></i></a>	
            </td>
            <td>
                <?php
                if($dato->quien>=1)
                {
                    $quien=$this->usuarios_model->getUsuariosPorId($dato->quien);
                    echo "<strong>".$quien->nombre."</strong><br />";
                }
                ?>
                <?php echo $dato->cuando?>
            </td>
            <?php
              if($this->session->userdata('perfil')==1)
              {
                ?>
			<td>
               <a href="<?php echo base_url()?>materiales/edit/<?php echo $dato->id?>/<?php echo $pagina?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>materiales/delete/<?php echo $dato->id?>/<?php echo $pagina?>');" title="Eliminar"><i class="icon-trash"></i></a>	
            </td>
            </tr>
            <?php
            }
            ?>
    </tbody>
    <?php
    }
    ?>
     <tr>
        <td colspan="10" style="text-align: right;">
        <?php echo $this->layout->element('admin_paginador'); ?>
        </td>
    </tr>
</table>
<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
    
});
</script>

