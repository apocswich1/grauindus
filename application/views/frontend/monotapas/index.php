<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<div class="page-header"><h3>Monotapas ( <?php echo sizeof($datos)?> en total)</h3></div>



<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>monotapas/add">Agregar Monotapas</a>
    <br /><br />

</div>

<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
		    <th>Tapa, papel o cartulina Onda</th>  
			<th>Código</th>
             <th>Monotapa</th>
		      <th>Gramaje Onda</th>
              <th>Tapa, papel o cartulina Liner</th>
              <th> Liner</th>
              <th>Gramaje</th>
              <th>Precio</th>
              <th>Estado</th>
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
        $t=$this->materiales_model->getMaterialesPorId($dato->id_tapa);
        $t2=$this->materiales_model->getMaterialesPorId($dato->id_tapa_2);
    ?> <tr>
        <td><?php echo $t->nombre?></td>
        <td><?php echo $dato->codigo?></td>
        <td><?php echo $dato->nombre?></td>
			<td><?php echo $dato->gramaje_onda?> - <?php echo $dato->onda?></td>
             <td><?php echo $t2->nombre?></td>
            <td><?php echo $dato->gramaje_liner?> - <?php echo $dato->liner?></td>
            
            <td><?php echo $dato->gramaje?></td>
            <td>$<?php echo number_format($dato->precio,0,"",".")?></td>
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
               <a href="<?php echo base_url()?>monotapas/edit/<?php echo $dato->id?>/<?php echo $pagina?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>monotapas/delete/<?php echo $dato->id?>/<?php echo $pagina?>');" title="Eliminar"><i class="icon-trash"></i></a>	
            </td>
            <?php
            }
            ?>
           </tr>
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


