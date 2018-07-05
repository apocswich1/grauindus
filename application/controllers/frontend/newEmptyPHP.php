<?php if($dato->idc_03 != ""){$registro =$this->grupos_model->getCotizacionesGruposPorId($dato->idc_03,$dato->id);} $c1=unidades_valor($infoc3->cantidad_1, $registro->unidades);$c2=unidades_valor($infoc3->cantidad_2, $registro->unidades);$c3=unidades_valor($infoc3->cantidad_3, $registro->unidades);$c4=unidades_valor($infoc3->cantidad_4, $registro->unidades);?>

