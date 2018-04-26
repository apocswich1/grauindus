<?php 
$ci = &get_instance();
$ci->load->model("cotizaciones_model");

if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<div class="page-header"><h3>Cotizaciones Grupales ( <?php echo sizeof($datos)?> en total)</h3></div>



<div>
	<!--<a class="btn btn-success pull-left" href="<?php// echo base_url()?>grupos/add">Agregar Grupo</a>-->
	<a class="btn btn-success pull-left" href="#">Agregar Grupo</a>
    <br /><br />

</div>

<table class="table table-bordered table-striped indice" id="">
	<thead>
		<tr>
		
			<th>Id</th>
			<th>Nombre de Grupo</th>
			<th>Cotizaciones Asociadas</th>
			<th>Fecha de Creacion</th>
                        <th>Acciones</th>
		</tr>
	</thead>
	<tbody>
    <?php
    function nombre_producto($id){
       // $nombre = $this->cotizaciones_model->getCotizacionPorId($id);
        return $nombre->producto;
    }
    
    foreach($datos as $dato)
    {
    ?>
			<td><?php echo $dato->id?></td>
                        <td><?php echo $dato->grupo?></td>
                        <td><?php echo "<ul>"?>
                        <?php if($dato->idc_01 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_01); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_01."'>".$dato->idc_01.' - '.$nombre->producto; } ?><?php if($dato->idc_01 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_01); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a>- Trazado:</a>".$nombre->trazado; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a>- Molde:</a>".$nombre->numero_molde; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_02 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_02); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_02."'>".$dato->idc_02.' - '.$nombre->producto; } ?><?php if($dato->idc_02 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_02); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a>- Trazado:</a>".$nombre->trazado; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a>- Molde:</a>".$nombre->numero_molde; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_03 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_03); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_03."'>".$dato->idc_03.' - '.$nombre->producto; } ?><?php if($dato->idc_03 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_03); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a>- Trazado:</a>".$nombre->trazado; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a>- Molde:</a>".$nombre->numero_molde; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_03 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_03); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_03."'>".$dato->idc_03.' - '.$nombre->producto; } ?><?php if($dato->idc_03 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_03); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a>- Trazado:</a>".$nombre->trazado; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a>- Molde:</a>".$nombre->numero_molde; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_04 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_04); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_04."'>".$dato->idc_04.' - '.$nombre->producto; } ?><?php if($dato->idc_04 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_04); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a>- Trazado:</a>".$nombre->trazado; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a>- Molde:</a>".$nombre->numero_molde; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_05 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_05); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_05."'>".$dato->idc_05.' - '.$nombre->producto; } ?><?php if($dato->idc_05 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_05); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a>- Trazado:</a>".$nombre->trazado; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a>- Molde:</a>".$nombre->numero_molde; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_06 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_06); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_06."'>".$dato->idc_06.' - '.$nombre->producto; } ?><?php if($dato->idc_06 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_06); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a>- Trazado:</a>".$nombre->trazado; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a>- Molde:</a>".$nombre->numero_molde; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_07 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_07); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_07."'>".$dato->idc_07.' - '.$nombre->producto; } ?><?php if($dato->idc_07 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_07); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a>- Trazado:</a>".$nombre->trazado; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a>- Molde:</a>".$nombre->numero_molde; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_08 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_08); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_08."'>".$dato->idc_08.' - '.$nombre->producto; } ?><?php if($dato->idc_08 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_08); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a>- Trazado:</a>".$nombre->trazado; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a>- Molde:</a>".$nombre->numero_molde; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_09 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_09); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_09."'>".$dato->idc_09.' - '.$nombre->producto; } ?><?php if($dato->idc_09 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_09); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a>- Trazado:</a>".$nombre->trazado; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a>- Molde:</a>".$nombre->numero_molde; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_10 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_10); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_10."'>".$dato->idc_10.' - '.$nombre->producto; } ?><?php if($dato->idc_10 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_10); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a>- Trazado:</a>".$nombre->trazado; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a>- Molde:</a>".$nombre->numero_molde; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php echo "</ul>"?></td>
                        <td><?php echo $dato->fecha_creacion?></td>
			<td>
                        <a href="<?php echo base_url()?>grupos/edit/<?php echo $dato->id?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>grupos/delete/<?php echo $dato->id?>');" title="Eliminar"><i class="icon-trash"></i></a>	
            </td>
    </tbody>
    <?php
    }
    ?>
    
</table>
