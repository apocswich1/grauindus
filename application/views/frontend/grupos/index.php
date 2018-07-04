<style type="text/css">
#mimodal{
  width: 100% !important;
}
</style>
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
			<th>Detalle</th>
			<th>Fecha de Creacion</th>
                        <th>Acciones</th>
		</tr>
	</thead>
	<tbody>
    <?php
        function cantidades_disp($c1 = "",$c2 = "",$c3 = "",$c4 = "",$c5 = "",$c6 = "",$c7 = "",$c8 = "",$c9 = "",$c10 = ""){
          $array = array();
          if($c1!="" && $c1!=0){
              array_push($array, $c1);
          } 
          if($c1!="" && $c1!=0){
              array_push($array, $c1);
          } 
          if($c1!="" && $c1!=0){
              array_push($array, $c1);
          } 
          if($c1!="" && $c1!=0){
              array_push($array, $c1);
          }
        }
        function cantidades_disponibles($c1 = "",$c2 = "",$c3 = "",$c4 = "",$c5 = "",$c6 = "",$c7 = "",$c8 = "",$c9 = "",$c10 = ""){
          $array = array();
          if($c1!="" && $c1!=0){
              array_push($array, $c1);
          }
          if($c2!="" && $c2!=0){
              array_push($array, $c2);
          }
          if($c3!="" && $c3!=0){
              array_push($array, $c3);
          }
          if($c4!="" && $c4!=0){
              array_push($array, $c4);
          }
          if($c5!="" && $c5!=0){
              array_push($array, $c5);
          }
          if($c6!="" && $c6!=0){
              array_push($array, $c6);
          }
          if($c7!="" && $c7!=0){
              array_push($array, $c7);
          }
          if($c8!="" && $c8!=0){
              array_push($array, $c8);
          }
          if($c9!="" && $c9!=0){
              array_push($array, $c9);
          }
          if($c10!="" && $c10!=0){
              array_push($array, $c10);
          }

          $esigual = count(array_unique($array))===1;

          if($esigual==1){
          return $c1;
          }else{
          return "";
          }
          
          
        }
        
    function nombre_producto($id){
       // $nombre = $this->cotizaciones_model->getCotizacionPorId($id);
        return $nombre->producto;
    }
    
    foreach($datos as $dato)
    {
        $infoc = $this->cotizaciones_model->getCotizacionPorId($dato->idc_01);
        $infhoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($dato->idc_01);
        $infoc2 = $this->cotizaciones_model->getCotizacionPorId($dato->idc_02);
        $infhoja2=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($dato->idc_02);
        $infoc3 = $this->cotizaciones_model->getCotizacionPorId($dato->idc_03);
        $infhoja3=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($dato->idc_03);
        $infoc4 = $this->cotizaciones_model->getCotizacionPorId($dato->idc_04);
        $infhoja4=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($dato->idc_04);
        $infoc5 = $this->cotizaciones_model->getCotizacionPorId($dato->idc_05);
        $infhoja5=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($dato->idc_05);
        $infoc6 = $this->cotizaciones_model->getCotizacionPorId($dato->idc_06);
        $infhoja6=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($dato->idc_06);
        $infoc7 = $this->cotizaciones_model->getCotizacionPorId($dato->idc_07);
        $infhoja7=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($dato->idc_07);
        $infoc8 = $this->cotizaciones_model->getCotizacionPorId($dato->idc_08);
        $infhoja8=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($dato->idc_08);
        $infoc9 = $this->cotizaciones_model->getCotizacionPorId($dato->idc_09);
        $infhoja9=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($dato->idc_09);
        $infoc10 = $this->cotizaciones_model->getCotizacionPorId($dato->idc_10);
        $infhoja10=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($dato->idc_10);
        
        $cantidad_disponible1 = cantidades_disponibles($infoc->cantidad_1,$infoc2->cantidad_1,$infoc3->cantidad_1,$infoc4->cantidad_1,$infoc5->cantidad_1,$infoc6->cantidad_1,$infoc7->cantidad_1,$infoc8->cantidad_1,$infoc9->cantidad_1,$infoc10->cantidad_1);
        $cantidad_disponible2 = cantidades_disponibles($infoc->cantidad_2,$infoc2->cantidad_2,$infoc3->cantidad_2,$infoc4->cantidad_2,$infoc5->cantidad_2,$infoc6->cantidad_2,$infoc7->cantidad_2,$infoc8->cantidad_2,$infoc9->cantidad_2,$infoc10->cantidad_2);
        $cantidad_disponible3 = cantidades_disponibles($infoc->cantidad_3,$infoc2->cantidad_3,$infoc3->cantidad_3,$infoc4->cantidad_3,$infoc5->cantidad_3,$infoc6->cantidad_3,$infoc7->cantidad_3,$infoc8->cantidad_3,$infoc9->cantidad_3,$infoc10->cantidad_3);
        $cantidad_disponible4 = cantidades_disponibles($infoc->cantidad_4,$infoc2->cantidad_4,$infoc3->cantidad_4,$infoc4->cantidad_4,$infoc5->cantidad_4,$infoc6->cantidad_4,$infoc7->cantidad_4,$infoc8->cantidad_4,$infoc9->cantidad_4,$infoc10->cantidad_4);
   
    ?>
        <input id="disponibles<?php echo $dato->id?>" type="hidden" name="disponibles" value="<?php echo $cantidad_disponible1.",".$cantidad_disponible2.",".$cantidad_disponible3.",".$cantidad_disponible4?>"/>
			<td><?php echo $dato->id?></td>
                        <td><a><?php echo $dato->grupo?></a></td>
                        <td><?php echo "<ul>"?>
                        <?php if($dato->idc_01 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_01); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_01."'>".$dato->idc_01.' - '.$nombre->producto; } ?><?php if($dato->idc_01 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_01); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a href='../trabajo/trazados/edit/".$nombre->trazado."/0'>- Trazado:".$nombre->trazado."</a>"; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a href='../trabajo/moldes/edit/".$nombre->numero_molde."/0'>- Molde:".$nombre->numero_molde."</a>"; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_01 != ""){echo "<br />Cantidad 1:".$infoc->cantidad_1." P: ".$infhoja->valor_empresa." | Cantidad 2:".$infoc->cantidad_2." P: ".$infhoja->valor_empresa_2." | Cantidad 3:".$infoc->cantidad_3." P: ".$infhoja->valor_empresa_3." | Cantidad 4:".$infoc->cantidad_4." P: ".$infhoja->valor_empresa_4;} ?>
                        <?php if($dato->idc_02 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_02); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_02."'>".$dato->idc_02.' - '.$nombre->producto; } ?><?php if($dato->idc_02 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_02); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a href='../trabajo/trazados/edit/".$nombre->trazado."/0'>- Trazado:".$nombre->trazado."</a>"; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a href='../trabajo/moldes/edit/".$nombre->numero_molde."/0'>- Molde:".$nombre->numero_molde."</a>"; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_02 != ""){echo "<br />Cantidad 1:".$infoc2->cantidad_1." P: ".$infhoja2->valor_empresa." | Cantidad 2:".$infoc2->cantidad_2." P: ".$infhoja2->valor_empresa_2." | Cantidad 3:".$infoc2->cantidad_3." P: ".$infhoja2->valor_empresa_3." | Cantidad 4:".$infoc2->cantidad_4." P: ".$infhoja2->valor_empresa_4;} ?>
                        <?php if($dato->idc_03 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_03); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_03."'>".$dato->idc_03.' - '.$nombre->producto; } ?><?php if($dato->idc_03 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_03); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a href='../trabajo/trazados/edit/".$nombre->trazado."/0'>- Trazado:".$nombre->trazado."</a>"; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a href='../trabajo/moldes/edit/".$nombre->numero_molde."/0'>- Molde:".$nombre->numero_molde."</a>"; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_03 != ""){echo "<br />Cantidad 1:".$infoc3->cantidad_1." P: ".$infhoja3->valor_empresa." | Cantidad 2:".$infoc3->cantidad_2." P: ".$infhoja3->valor_empresa_2." | Cantidad 3:".$infoc3->cantidad_3." P: ".$infhoja3->valor_empresa_3." | Cantidad 4:".$infoc3->cantidad_4." P: ".$infhoja3->valor_empresa_4;} ?>
                        <?php if($dato->idc_04 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_04); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_04."'>".$dato->idc_04.' - '.$nombre->producto; } ?><?php if($dato->idc_04 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_04); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a href='../trabajo/trazados/edit/".$nombre->trazado."/0'>- Trazado:".$nombre->trazado."</a>"; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a href='../trabajo/moldes/edit/".$nombre->numero_molde."/0'>- Molde:".$nombre->numero_molde."</a>"; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_04 != ""){echo "<br />Cantidad 1:".$infoc4->cantidad_1." P: ".$infhoja4->valor_empresa." | Cantidad 2:".$infoc4->cantidad_2." P: ".$infhoja4->valor_empresa_2." | Cantidad 3:".$infoc4->cantidad_3." P: ".$infhoja4->valor_empresa_3." | Cantidad 4:".$infoc4->cantidad_4." P: ".$infhoja4->valor_empresa_4;} ?>
                        <?php if($dato->idc_05 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_05); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_05."'>".$dato->idc_05.' - '.$nombre->producto; } ?><?php if($dato->idc_05 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_05); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a href='../trabajo/trazados/edit/".$nombre->trazado."/0'>- Trazado:".$nombre->trazado."</a>"; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a href='../trabajo/moldes/edit/".$nombre->numero_molde."/0'>- Molde:".$nombre->numero_molde."</a>"; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_05 != ""){echo "<br />Cantidad 1:".$infoc5->cantidad_1." P: ".$infhoja5->valor_empresa." | Cantidad 2:".$infoc5->cantidad_2." P: ".$infhoja5->valor_empresa_2." | Cantidad 3:".$infoc5->cantidad_3." P: ".$infhoja5->valor_empresa_3." | Cantidad 4:".$infoc5->cantidad_4." P: ".$infhoja5->valor_empresa_4;} ?>
                        <?php if($dato->idc_06 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_06); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_06."'>".$dato->idc_06.' - '.$nombre->producto; } ?><?php if($dato->idc_06 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_06); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a href='../trabajo/trazados/edit/".$nombre->trazado."/0'>- Trazado:".$nombre->trazado."</a>"; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a href='../trabajo/moldes/edit/".$nombre->numero_molde."/0'>- Molde:".$nombre->numero_molde."</a>"; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_06 != ""){echo "<br />Cantidad 1:".$infoc6->cantidad_1." P: ".$infhoja6->valor_empresa." | Cantidad 2:".$infoc6->cantidad_2." P: ".$infhoja6->valor_empresa_2." | Cantidad 3:".$infoc6->cantidad_3." P: ".$infhoja6->valor_empresa_3." | Cantidad 4:".$infoc6->cantidad_4." P: ".$infhoja6->valor_empresa_4;} ?>
                        <?php if($dato->idc_07 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_07); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_07."'>".$dato->idc_07.' - '.$nombre->producto; } ?><?php if($dato->idc_07 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_07); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a href='../trabajo/trazados/edit/".$nombre->trazado."/0'>- Trazado:".$nombre->trazado."</a>"; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a href='../trabajo/moldes/edit/".$nombre->numero_molde."/0'>- Molde:".$nombre->numero_molde."</a>"; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_07 != ""){echo "<br />Cantidad 1:".$infoc7->cantidad_1." P: ".$infhoja7->valor_empresa." | Cantidad 2:".$infoc7->cantidad_2." P: ".$infhoja7->valor_empresa_2." | Cantidad 3:".$infoc7->cantidad_3." P: ".$infhoja7->valor_empresa_3." | Cantidad 4:".$infoc7->cantidad_4." P: ".$infhoja7->valor_empresa_4;} ?>
                        <?php if($dato->idc_08 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_08); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_08."'>".$dato->idc_08.' - '.$nombre->producto; } ?><?php if($dato->idc_08 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_08); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a href='../trabajo/trazados/edit/".$nombre->trazado."/0'>- Trazado:".$nombre->trazado."</a>"; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a href='../trabajo/moldes/edit/".$nombre->numero_molde."/0'>- Molde:".$nombre->numero_molde."</a>"; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_08 != ""){echo "<br />Cantidad 1:".$infoc8->cantidad_1." P: ".$infhoja8->valor_empresa." | Cantidad 2:".$infoc8->cantidad_2." P: ".$infhoja8->valor_empresa_2." | Cantidad 3:".$infoc8->cantidad_3." P: ".$infhoja8->valor_empresa_3." | Cantidad 4:".$infoc8->cantidad_4." P: ".$infhoja8->valor_empresa_4;} ?>
                        <?php if($dato->idc_09 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_09); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_09."'>".$dato->idc_09.' - '.$nombre->producto; } ?><?php if($dato->idc_09 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_09); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a href='../trabajo/trazados/edit/".$nombre->trazado."/0'>- Trazado:".$nombre->trazado."</a>"; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a href='../trabajo/moldes/edit/".$nombre->numero_molde."/0'>- Molde:".$nombre->numero_molde."</a>"; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_09 != ""){echo "<br />Cantidad 1:".$infoc9->cantidad_1." P: ".$infhoja9->valor_empresa." | Cantidad 2:".$infoc9->cantidad_2." P: ".$infhoja9->valor_empresa_2." | Cantidad 3:".$infoc9->cantidad_3." P: ".$infhoja9->valor_empresa_3." | Cantidad 4:".$infoc9->cantidad_4." P: ".$infhoja9->valor_empresa_4;} ?>
                        <?php if($dato->idc_10 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_10); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_10."'>".$dato->idc_10.' - '.$nombre->producto; } ?><?php if($dato->idc_10 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_10); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a href='../trabajo/trazados/edit/".$nombre->trazado."/0'>- Trazado:".$nombre->trazado."</a>"; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a href='../trabajo/moldes/edit/".$nombre->numero_molde."/0'>- Molde:".$nombre->numero_molde."</a>"; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_10 != ""){echo "<br />Cantidad 1:".$infoc10->cantidad_1." P: ".$infhoja10->valor_empresa." | Cantidad 2:".$infoc10->cantidad_2." P: ".$infhoja10->valor_empresa_2." | Cantidad 3:".$infoc10->cantidad_3." P: ".$infhoja10->valor_empresa_3." | Cantidad 4:".$infoc10->cantidad_4." P: ".$infhoja10->valor_empresa_4;} ?>
                        <?php echo "</ul>"?></td>
                        <td><a class="detalle" style="text-decoration: none" data-toggle="modal" data-target="#myModal" id="<?php echo $dato->id ?>">Detalle</a></td>
                        <td><?php echo $dato->fecha_creacion?></td>
			<td>
                        <a href="<?php echo base_url()?>grupos/edit/<?php echo $dato->id?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>grupos/delete/<?php echo $dato->id?>');" title="Eliminar"><i class="icon-trash"></i></a>	
                        <a href="javascript:void(0);" class="recotizarGrupo" onclick="" title="Recotizar"  data-toggle="modal" data-target="#myModal2"><i class="icon-check"></i></a>	
            </td>
            <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog" id="mimodal">
    <!-- Modal content-->
    <div class="modal-content">
        <?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
        
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detalle de Cotizacion Grupal</h4>
      </div>
      <div class="modal-body">
          <div class="container">
            <div class="row" id="galeria">
            </div>                                
            <div class="row" style="text-align: center; padding-bottom: 15px;">
                  <input type="file" class="form-control" name="userFiles[]" multiple/>
                  <input type="hidden" id="id_grupo" name="id_grupo" value=""/>    
            </div>            
              <div style="padding: 5px, 5px">
                         <div class="page-header">
                            <!--<h4>Encabezado de página <small>con un texto secundario</small></h4>-->
                        </div>
              </div>
          </div>
       </div>
      <div class="modal-footer">
          <button id="guardar" type="button" class="btn btn-success">Guardar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    <?php echo form_close() ?> 
    </div>

  </div>
</div>
    </tbody>
    <?php
    }
    ?>
    
</table>
<script>
$("#guardar").on('click',function(){
    var form=document.getElementById('form');
    form.submit();
});

$(".detalle").on('click',function(){
    var id = $(this).attr('id');
    $('#id_grupo').val($(this).attr('id'));
    var ruta = 'grupos/galeria';
    $.post(webroot+ruta,{id_grupo:id},function(resp)
   {
        $("#galeria").html(resp);
   });
});

$(".recotizarGrupo").on("click",function(){
    var texto = $(this).parents('tr').find('a').eq(0).html();
    var grupo = $(this).parents('tr').find('td').eq(0).html();
    var str = $("#disponibles"+grupo).val();
    $("#nombreGrupo").text("Nombre: "+texto);
    var str2 = str.split(',');
    var c1 = str2[0];
    var c2 = str2[1];
    var c3 = str2[2];
    var c4 = str2[3];
    
    if(c1=="" || c1=="0" || c1=="1"){
        $("#divc1").hide();
    }else{
        $("#divc1").show();
    }
    if(c2=="" || c2=="0" || c2=="1"){
        $("#divc2").hide();
    }else{
        $("#divc2").show();
    }
    if(c3=="" || c3=="0" || c3=="1"){
        $("#divc3").hide();
    }else{
        $("#divc3").show();
    }
    if(c4=="" || c4=="0" || c4=="1"){
        $("#divc4").hide();
    }else{
        $("#divc4").show();
    }
    
    $("input[name=cantidad1]").val(c1);
    $("input[name=cantidad2]").val(c2);
    $("input[name=cantidad3]").val(c3);
    $("input[name=cantidad4]").val(c4);
    $("#span1").text('Cantidad 1: '+c1);
    $("#span2").text('Cantidad 2: '+c2);
    $("#span3").text('Cantidad 3: '+c3);
    $("#span4").text('Cantidad 4: '+c4);
});

</script>
<!-- The Modal -->
<div class="modal" id="myModal2" style="display: none">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Recotizar Conjunto</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <b id="nombreGrupo"></b><br /><br />
          <div><h4 class="modal-title">Cantidades Disponibles</h4></div>
          <div id="divc1"><span id="span1">Cantidad 1: 1000</span>&nbsp;&nbsp;<input type="checkbox" name="cantidad1" value="" /></div>
          <div id="divc2"><span id="span2">Cantidad 2: 2000</span>&nbsp;&nbsp;<input type="checkbox" name="cantidad2" value="" /></div>
          <div id="divc3"><span id="span3">Cantidad 3: 3000</span>&nbsp;&nbsp;<input type="checkbox" name="cantidad3" value="" /></div>
          <div id="divc4"><span id="span4">Cantidad 4: 4000</span>&nbsp;&nbsp;<input type="checkbox" name="cantidad4" value="" /></div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Recotizar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>