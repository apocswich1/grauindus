<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <li>Acabados</li>
    </ol>
   <!-- /Migas -->
<div class="page-header"><h3>Acabados</h3></div>



<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>acabados/add">Agregar Acabado</a>
    <br /><br />

</div>
	<!-- Buscador -->
    <div class="pull-right">
	<?php echo form_open(base_url()."acabados/search", array('class' => 'form-search pull-right')); ?>
		<input type="text" class="input-medium search-query" name="buscar" placeholder="Buscar" />
		<button type="submit" class="btn">Buscar</button>
		
	</form>
</div>
    <!-- /Buscador -->

<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
		
	      <th>Proveedor 1</th>
              <th>Proveedor 2</th>
	      <th>Código</th>
              <th>Características</th>
              <th>Tipo</th>
              <th>U. de Compra</th>
              <th>U. de Venta</th>
	      <th>Valor Venta</th>
              <th>Costo Compra</th>
              <th>Fecha Cotización</th>
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
        $p1=$this->proveedores_model->getProveedoresPorId($dato->proveedor_1);
        $p2=$this->proveedores_model->getProveedoresPorId($dato->proveedor_2);
    ?>
            <td><?php echo $p1->nombre;?></td>
            <td><?php echo $p2->nombre;?></td>
            <td><?php echo $dato->codigo?></td>
            <td><?php echo $dato->caracteristicas?></td>
            <td><?php echo $dato->tipo?></td>
            <td><?php echo $dato->unc?></td>
            <td><?php echo $dato->unv?></td>
            <td>$<?php echo number_format($dato->valor_venta,0,"",".")?></td>
            <td>$<?php echo number_format($dato->costo_compra,0,"",".")?></td>
            <td><?php echo $dato->fecha_cotizacion?></td>
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
               <a href="<?php echo base_url()?>acabados/edit/<?php echo $dato->id?>/<?php echo $pagina?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>acabados/delete/<?php echo $dato->id?>/<?php echo $pagina?>');" title="Eliminar"><i class="icon-trash"></i></a>	
            </td>
                <?php
              }
              ?>
			
    </tbody>
    <?php
    }
    ?>
     <tr>
        <td colspan="7" style="text-align: right;">
        <?php echo $this->layout->element('admin_paginador'); ?>
        </td>
    </tr>
</table>
