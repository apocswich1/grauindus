<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ordenes extends CI_Controller {


    private $session_id;
    public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('backend');
      
    }
    public function index()
    {
         if($this->session->userdata('id'))
        {
            if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3);
            }else
            {
               $pagina=0;
            }
            $porpagina=10;
        $datos=$this->orden_model->getOrdenesPaginacion($pagina,$porpagina,"limit");
        $cuantos=$this->orden_model->getOrdenesPaginacion($pagina,$porpagina,"cuantos");
        $config['base_url'] = base_url().'ordenes/index';
            $config['total_rows'] = $cuantos;
            $config['per_page'] = $porpagina;
            $config['uri_segment'] = '3';
            $config['num_links'] = '4';
            $config['first_link'] = 'Primero';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['last_link'] = 'Ultimo';
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li><a><b>';
            $config['cur_tag_close'] = '</b></a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
              $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css"
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            );
            $this->layout->view('index',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    public function add($id=null,$pagina=null)
    {
        if($this->session->userdata('id'))
        {
            if(!$id){show_404();}
            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
            print_r($datos);exit;
            $impresionPresupuesto=$this->cotizaciones_model->getCotizacionImpresionPresupuestoPorIdCotizacion($id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
            $existeProducto=$this->productos_model->getProductosPorNombre($ing->producto);
            $existeProducto2=$this->productos_model->getProductosPorNombre($datos->producto);
            $cuentaProductos=$this->orden_model->countOrdenesPorClientePorIdParaProductosNuevos($datos->id_cliente);
            $cuentaProductos2 = $cuentaProductos + 1;
            if(sizeof($cuentaProductos2) == 2)
            {
                    $codigoNuevo= "0".$cuentaProductos2;
            } 
            elseif(sizeof($cuentaProductos2)==1)
            {
                     $codigoNuevo= "00".$cuentaProductos2;
            }
            if(sizeof($cuentaProductos2) == 3)
            {
                    $codigoNuevo= $cuentaProductos2;
            } 
            if(sizeof($cuentaProductos2) == 0)
            {
                    $codigoNuevo= "001";
            } 
            if($this->input->post())
            {
            if($this->input->post("estado",true)==1)
            {
               $fecha_20_dias=sumarDiasFecha(date("Y-m-d"),20); 
            }
            if(sizeof($orden)==0)
            {
		    if(sizeof($existeProducto)==0)
                    {  
                        //creo el producto
                        $arreglo=array
                    (
                        "id_cotizacion"=>$datos->id,
                        "codigo"=>$datos->id_cliente."A".$codigoNuevo,
                        "nombre"=>$ing->producto,
                        "tipo"=>"1",
                    );
                    $producto_id=$this->productos_model->insertar($arreglo);
                    }
                    //creo el molde
                    if($this->input->post("estan_los_moldes",true)=='SI')
                    {
                         $id_molde=$this->input->post("molde",true);
                         $tieneMolde='NO';
                    }elseif($this->input->post("estan_los_moldes",true)=='NO')
                    {
                        $array=array
                        (
                          "nombre"=>$this->input->post("nombre_molde",true),
                          "tamano_caja"=>$ing->medidas_de_la_caja.'X'.$ing->medidas_de_la_caja2.'X'.$ing->medidas_de_la_caja3.'X'.$ing->medidas_de_la_caja4,
                          "cuchillocuchillo"=>$ing->tamano_cuchillo_1,
                          "cuchillocuchillo2"=>$ing->tamano_cuchillo_2,
                          "ancho_bobina"=>$ing->tamano_a_imprimir_1,
                          "largo_bobina"=>$ing->tamano_a_imprimir_2,
                          "nombrecliente"=>$datos->id_cliente,
                          "tipo"=>"Normal",
                        );
                        $id_molde=$this->moldes_model->insertar($array);
			// $nombreMolde=>$this->input->post("nombre_molde",true);
                        $array2=array
                        (
                          "numero"=>$id_molde,
                        );
                        $this->db->where('id', $id_molde);
                        $this->db->update("moldes_grau",$array2); 
                        $tieneMolde='SI';  
			//Actualizar Molde en ing
			$arrayIng=array
                        (
                          "numero_molde"=>$id_molde,
                          "nombre_molde"=>$this->input->post("nombre_molde",true),
                        );
			$this->db->where('id_cotizacion', $id);
                        $this->db->update("cotizacion_ingenieria",$arrayIng); 
                    }else
                    {
                        $tieneMolde='NO LLEVA';
                    }
                    //inserto el registro
                    if(sizeof($existeProducto)==0)
                    {  
                        $data=array
                        (
                                "id_cotizacion"=>$this->input->post("id",true),
                                "valor"=>$this->input->post("valor",true),
                                "fecha_entrega"=>$this->input->post("fecha",true),
                                "tipo_entrega"=>$this->input->post("tota_o_parcial",true),
                                "id_forma_pago"=>$this->input->post("forma_pago",true),
                                "quien_autoriza"=>$this->session->userdata('id'),
                                "fecha"=>date("Y-m-d"),
                                "estado"=>$this->input->post("estado",true),
                                "cantidad_pedida"=>$this->input->post("cantidad_pedida",true),
                                "tiene_molde"=>$tieneMolde,
                                "can_despacho_1"=>$this->input->post("can_despacho_1",true),
                                "can_despacho_2"=>$this->input->post("can_despacho_2",true),
                                "can_despacho_3"=>$this->input->post("can_despacho_3",true),
                                "nombre_producto_normal"=>$this->input->post("nombre_producto_normal",true),
                                "producto_id"=>$producto_id,
                                "id_molde"=>$id_molde,
                                "nombre_molde"=>$this->input->post("nombre_molde",true),
                                "estan_los_moldes"=>$this->input->post("estan_los_moldes",true),
                                'quien'=>$this->session->userdata('id'),
                                'cuando'=>date("Y-m-d"),
                                "glosa"=>$this->input->post('glosa',true),
                                "fecha_20_dias"=>$fecha_20_dias,
                        );
                    }else{
                        $data=array
                         (
                             "id_cotizacion"=>$this->input->post("id",true),
                             "valor"=>$this->input->post("valor",true),
                             "fecha_entrega"=>$this->input->post("fecha",true),
                             "tipo_entrega"=>$this->input->post("tota_o_parcial",true),
                             "id_forma_pago"=>$this->input->post("forma_pago",true),
                             "quien_autoriza"=>$this->session->userdata('id'),
                             "fecha"=>date("Y-m-d"),
                             "estado"=>$this->input->post("estado",true),
                             "cantidad_pedida"=>$this->input->post("cantidad_pedida",true),
                             "tiene_molde"=>$tieneMolde,

                             "can_despacho_1"=>$this->input->post("can_despacho_1",true),
                             "can_despacho_2"=>$this->input->post("can_despacho_2",true),
                             "can_despacho_3"=>$this->input->post("can_despacho_3",true),
                             "nombre_producto_normal"=>$this->input->post("nombre_producto_normal",true),
                             "producto_id"=>$existeProducto->id,
                             "id_molde"=>$id_molde,
                             "nombre_molde"=>$this->input->post("nombre_molde",true),
                             "estan_los_moldes"=>$this->input->post("estan_los_moldes",true),
                             'quien'=>$this->session->userdata('id'),
                             'cuando'=>date("Y-m-d"),
                             "glosa"=>$this->input->post('glosa',true),
                             "fecha_20_dias"=>$fecha_20_dias,
                         ); 
			}
                               $this->db->insert("orden_de_produccion",$data);
                }else
                {
                    $producto_id=$this->input->post("producto_id",true);
                    if($this->input->post("estan_los_moldes",true)=='SI')
                    {
                        $id_molde=$this->input->post("molde",true);
                        $tieneMolde='SI';
                    }elseif($this->input->post("estan_los_moldes",true)=='NO')
                    {
                        $id_molde=$this->input->post("molde",true); 
                        $tieneMolde='NO';  
                    }else
                    {
                        $id_molde='1';
                        $tieneMolde='NO LLEVA';
                    }
                    if($this->input->post("estan_los_moldes",true)=='CLIENTE LO APORTA')
                    {
                        $id_molde='2';
                        $tieneMolde='CLIENTE LO APORTA';
                    }
                    $data=array
                       (
                           "valor"=>$this->input->post("valor",true),
                           "fecha_entrega"=>$this->input->post("fecha",true),
                           "tipo_entrega"=>$this->input->post("tota_o_parcial",true),
                           "id_forma_pago"=>$this->input->post("forma_pago",true),
                           "quien_autoriza"=>$this->session->userdata('id'),
                           "estado"=>$this->input->post("estado",true),
                           "cantidad_pedida"=>$this->input->post("cantidad_pedida",true),
                           "tiene_molde"=>$tieneMolde,
                           "can_despacho_1"=>$this->input->post("can_despacho_1",true),
                           "can_despacho_2"=>$this->input->post("can_despacho_2",true),
                           "can_despacho_3"=>$this->input->post("can_despacho_3",true),
                           "nombre_producto_normal"=>$this->input->post("nombre_producto_normal",true),
                           "producto_id"=>$producto_id,
                           "id_molde"=>$id_molde,
                           "nombre_molde"=>$this->input->post("nombre_molde",true),
                           "estan_los_moldes"=>$this->input->post("estan_los_moldes",true),
                           'quien'=>$this->session->userdata('id'),
                           'cuando'=>date("Y-m-d"),
                           "glosa"=>$this->input->post('glosa',true),
                           "fecha_20_dias"=>$fecha_20_dias,
                       );
                    $this->db->where('id_cotizacion', $this->input->post("id",true));
                    $this->db->update("orden_de_produccion",$data);
                } 
                if($this->input->post("estado",true)==2)
                {
                    $config['mailtype'] = 'html';
                    $this->email->initialize($config);
                    $this->email->from("contacto@grauindus.cl", 'Cartonajes Grau');
                    $this->email->to($vendedor->correo); 
                    $this->email->bcc('respaldocorreos@grauindus.cl');
                    $this->email->subject('Mensaje de Cartonajes Grau');
                    $html='<h2>Nuevo Mensaje:</h2>';
                    $html.='La orden de compra N°'.$guardar.' ha sido rechazada, con la glosa:<br/>'.$this->input->post("glosa",true);
                    $this->email->message($html);   
                    $this->email->send(); 
                }
                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
		redirect(base_url().'cotizaciones/index/'.$this->input->post('pagina',true),  301); 
            
            }
            $this->layout->css
            (
                array
                (
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );
            $productos=$this->productos_model->getProductos();
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $this->layout->view('add',compact("datos","id","pagina","impresionPresupuesto","orden","ordenDeCompra","ing","productos","hoja","fotomecanica","vendedor","codigoNuevo","existeProducto","existeProducto2")); 
		//}	
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
	  
    }    
    public function pdf_orden($id=null,$ide=null)
    {
        if($this->session->userdata('id'))
        {
            if(!$id or !$ide){show_404();}
            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
            //print_r($datos);exit;
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorId($ide);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
            $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
            $producto=$this->productos_model->getProductosPorId($orden->producto_id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
			
			$tapa = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
			$monda = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
			$mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
			
			
            if(sizeof($datos)==0){show_404();}
            if($datos->condicion_del_producto=='Nuevo')
            {
                $repeticion="NO";
            }else
            {
                $repeticion="SI";
            }
            $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
            $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
            $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
            $molde=$this->moldes_model->getMoldesPorId($fotomecanica->numero_molde);
            $tamano1=$ing->tamano_a_imprimir_1;
    $tamano2=$ing->tamano_a_imprimir_2;
    /**
    * validación máquina
    * */
    //if($tamano1>61 or $tamano2 > 120)
    /*
    if($tamano1>127 or $tamano2 > 92)
    {
       
        $maquina="Máquina Roland 800";
    }else
    {
         $maquina="Máquina Roland Ultra";
    }
    */
    if($tamano1==60 and $tamano2>100)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1==70 and $tamano2>120)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1==80 and $tamano2>89)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1==90 and $tamano2>89)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1>90 and $tamano2>60)
    {
        $maquina="Máquina Roland 800";
    }else
    {
        $maquina="Máquina Roland Ultra";
    }
	
	    /*<table id="tabla_detalle">
                    <tr>
                         <!--
                        <td class="celda_25 centro">N° OT Antiguo <span class="borde">'.number_format($orden->id_antiguo,0,'','.').'</span></td>-->
                         <td class="celda_25 centro">Orden de Compra <span class="borde">'.number_format($ordenDeCompra->orden_de_compra_cliente,0,'','.').'</span></td>
						 
                    </tr>
                     </table>*/
	
	
	
            $cuerpo=' <!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        
<link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/bootstrap.css" />
        <link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/orden_de_produccion.css" />
    </head>
    <body>';
    $cuerpo.='<div class="container fuente">
            <header>
		
                <div>
				<table>
				<tr>
							<td>
							<h1><span id="titulo">Cartonajes Grau </span></h1>
							</td>
				</tr>
				
				
					<tr>
							
							
							
							<td class="centro">
							<h1><span id="titulo" >
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							Orden de Producción</span>
							</h1>
							</td>
							
				</tr>
				
                </table>
                </div>
                      
            </header>
                <!--separador 20-->
                    <div class="separador_20"></div>
                <!--/separador 20-->
            
			
			
			
			
			
			
			
                    <!--separador 10-->
                    <div class="separador_10"></div>
                <!--/separador 10--> 
                   <table id="tabla_detalle">
                    <tr>
                        <td class="celda_25 centro">N° OT <span class="borde">'.number_format($ide,0,'','.').'</span></td>
						';
						
						if($orden->id_antiguo >= 1)
						{
						$cuerpo.='
                        <td class="celda_25 centro">N° OT Antiguo <span class="borde">'.number_format($orden->id_antiguo,0,'','.').'</span></td>
						';
						}
						
						if($datos->id_antiguo >= 1)
						{
						$cuerpo.='
                        <td class="celda_25 centro">N° H.C.A <span class="borde">'.number_format($datos->id_antiguo,0,'','.').'</span></td>
						';
						}
						$cuerpo.='
                        <td class="celda_25 centro">N° H.C <span class="borde">'.number_format($id,0,'','.').'</span></td>
                        <td class="celda_25 centro">Fecha ingreso O.C: <span class="borde">'.fecha_con_slash($ordenDeCompra->fecha).'</span></td>
                       
                    </tr>
                    
                </table>
                <!--separador 10-->
                    <div class="separador_10"></div>
                <!--/separador 10-->  
                <table id="tabla_detalle">';
                
                $diasEntregaCliente=$this->variables_cotizador_model->getVariablesCotizadorPorId(38);
                $cuerpo.='
                    <tr>
                        <td class="celda_25">CLIENTE <span class="borde"><br><strong>'.$cli->razon_social.'</strong></span></td>
                        <td class="celda_25">&nbsp;VENDEDOR <span class="borde"><br>'.$vendedor->nombre.'</span></td>
                        <td class="celda_25">FECHA EMISIÓN <span class="borde"><br>'.fecha_con_slash($orden->cuando).'</span></td>
                        <td class="celda_25">FECHA ENTREGA SEGUN CLIENTE <span class="borde"><br>'.fecha_con_slash($ordenDeCompra->fecha_despacho).'</span></td>
                        <td class="celda_25">FECHA ENTREGA SEGUN EMPRESA <span class="borde"><br>'.fecha_con_slash($orden->fecha_entrega).'</span></td>
                    </tr>
                    <tr>
                        <td><br><strong>TRABAJO</strong></td>
                    </tr>
                </table> 
								
                <div>
                '.$ing->producto.', Impreso a '.$fotomecanica->colores.' colores, Barniz:'.$fotomecanica->lleva_barniz.', En Placa'.$fotomecanica->materialidad_1.' onda: '.$fotomecanica->materialidad_2.' liner: '.$fotomecanica->materialidad_3.' Tamaño: '.$ing->medidas_de_la_caja.'X'.$ing->medidas_de_la_caja_2.'X'.$ing->medidas_de_la_caja_3.'X'.$ing->medidas_de_la_caja_4.'
                </div>
                    
                <!--separador 50-->
                    <div class="separador_20"></div>
                <!--/separador 50-->  
                <table id="tabla_detalle">
                    <tr>
                        <td class="celda_15">CANTIDAD</td>
                        <td class="celda_40">IDENTIFICACIÓN DEL TRABAJO</td>
                        <td class="celda_15">CPRODUCTO</td>
                        <td class="celda_15">PRECIO VENTA</td>
                    </tr>
                    <tr>
                        <td class="celda_15"><span class="borde"><strong>'.number_format($ordenDeCompra->cantidad_de_cajas,0,'','.').'</strong></span><br /></td>
                        <td class="celda_40"><span class="borde"><strong>'.$ing->producto.'</strong></span></td>
                        <td class="celda_15"><span class="borde">'.$producto->codigo.'</span></td>
                        <td class="celda_15"><span class="borde">$'.number_format($ordenDeCompra->precio).'</span></td>
                    </tr>
                </table>
                <!--separador 50-->
                    <div class="separador_50"></div>
                <!--/separador 50--> 
                <table id="tabla_detalle">
                    <tr>
                        <td class="celda_33">TAMAÑO PLIEGO: &nbsp;<span class="borde">'.$ing->tamano_a_imprimir_1.'</span>x<span class="borde">'.$ing->tamano_a_imprimir_2.'</span><br /> </td>
                        <td class="celda_33">UNIDAD PLIEGO: &nbsp;<span class="borde">'.$ing->unidades_por_pliego.'</span><br /> </td>
                        <td class="celda_33">REPETICIÓN &nbsp;<span class="borde">'.$repeticion.'</span></td>
                    </tr>
                </table>
                <!--separador 20-->
                    <div class="separador_20"></div>
                <!--/separador 20--> 
				';
				

				
									$acabado_1Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_1);
                                    $acabado_1=$acabado_4Array->caracteristicas; 
									$acabado_2Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_2);
                                    $acabado_2=$acabado_4Array->caracteristicas; 
									$acabado_3Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_3);
                                    $acabado_3=$acabado_4Array->caracteristicas; 
						
						
						if($fotomecanica->acabado_impresion_1=="16")
                                {
                                    $acabado_1="No Lleva";
                                    $acabado_1Valor="&nbsp;";
                                    $acabado_1MedidaMasValorVenta="&nbsp;";
                                    $acabado_1Unitario="&nbsp;";
									$acabado_1UnidadVentaNombre="&nbsp;";
                                }
						if($fotomecanica->acabado_impresion_2=="16")
                                {
                                    $acabado_2="No Lleva";
                                    $acabado_2Valor="&nbsp;";
                                    $acabado_2MedidaMasValorVenta="&nbsp;";
                                    $acabado_2Unitario="&nbsp;";
									$acabado_2UnidadVentaNombre="&nbsp;";
                                }
						if($fotomecanica->acabado_impresion_3=="16")
                                {
                                    $acabado_3="No Lleva";
                                    $acabado_3Valor="&nbsp;";
                                    $acabado_3MedidaMasValorVenta="&nbsp;";
                                    $acabado_3Unitario="&nbsp;";
									$acabado_3UnidadVentaNombre="&nbsp;";
                                }
			
			 if($fotomecanica->acabado_impresion_4=="17")
                                {
                                    $acabado_4="No Lleva";
                                    $acabado_4Valor="&nbsp;";
                                    $acabado_4MedidaMasValorVenta="&nbsp;";
                                    $acabado_4Unitario="&nbsp;";
									$acabado_4UnidadVentaNombre="&nbsp;";
                                }else
                                {
                                    $acabado_4Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_4);
                                    $acabado_4=$acabado_4Array->caracteristicas; // Nombre acabado
									
                                    $acabado_4UnidadVentaNombre=$acabado_4Array->unv; //Nombre unidad de venta
                                    $acabado_4Valor=$acabado_4Array->valor_venta; // ej: 52
									

									
                                    $acabado_4MedidaMasValorVenta=($tamano1*$tamano2*$acabado_4Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    
									$acabado_4CostoFijo=$acabado_4Array->costo_fijo;		
									
									 
									if ($acabado_4Array->unidad_de_venta == '1' /*== '1'and sizeof($hoja->valor_acabado_1)==0*/) //mt2
									{
										//(cf/(total cajas/unidad pliego))+((ancho x largo x valor venta)/10.000)
										$acabado_4Unitario = ($acabado_4CostoFijo/($datos->cantidad_1/$ing->unidades_por_pliego))+($acabado_4MedidaMasValorVenta);
									}
									
									if ($acabado_4Array->unidad_de_venta == '4') //por pasada
									{
										$acabado_4Unitario = (($acabado_4CostoFijo/($datos->cantidad_1/$ing->unidades_por_pliego))+ $acabado_4Valor);
										
									}									
                                }
                                 if($fotomecanica->acabado_impresion_5=="17")
                                {
                                    $acabado_5="No Lleva";
                                    $acabado_5Valor="&nbsp;";
                                    $acabado_4MedidaMasValorVenta="&nbsp;";
                                    $acabado_5Unitario="&nbsp;";
									$acabado_5UnidadVentaNombre="&nbsp;";
                                }else
                                {
                                    $acabado_5Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_5);
                                    $acabado_5=$acabado_5Array->caracteristicas;
									
									$acabado_5UnidadVentaNombre=$acabado_5Array->unv; //Nombre unidad de venta
                                    $acabado_5Valor=$acabado_5Array->valor_venta; // ej: 52
									

									
                                    $acabado_5MedidaMasValorVenta=($tamano1*$tamano2*$acabado_5Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    
									$acabado_5CostoFijo=$acabado_5Array->costo_fijo;		
									
									 
									if ($acabado_5Array->unidad_de_venta == '1' /*== '1'and sizeof($hoja->valor_acabado_1)==0*/) //mt2
									{
										//(cf/(total cajas/unidad pliego))+((ancho x largo x valor venta)/10.000)
										$acabado_5Unitario = ($acabado_5CostoFijo/($datos->cantidad_1/$ing->unidades_por_pliego))+($acabado_5MedidaMasValorVenta);
									}
									
									if ($acabado_5Array->unidad_de_venta == '4') //por pasada
									{
										$acabado_5Unitario = (($acabado_5CostoFijo/($datos->cantidad_1/$ing->unidades_por_pliego))+ $acabado_5Valor);
										
									}
                                }    
                              if($fotomecanica->acabado_impresion_6=="17")
                                {
                                    $acabado_6="No Lleva";
                                    $acabado_6Valor="&nbsp;";
                                    $acabado_4MedidaMasValorVenta="&nbsp;";
                                    $acabado_6Unitario="&nbsp;";
									$acabado_6UnidadVentaNombre="&nbsp;";
                                }else
                                {
                                    $acabado_6Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_6);
                                    $acabado_6=$acabado_6Array->caracteristicas;
									
                                    $acabado_6UnidadVentaNombre=$acabado_Array->unv; //Nombre unidad de venta
                                    $acabado_6Valor=$acabado_6Array->valor_venta; // ej: 52
									
                                    $acabado_6MedidaMasValorVenta=($tamano1*$tamano2*$acabado_6Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    
									$acabado_6CostoFijo=$acabado_6Array->costo_fijo;		
									
									 
									if ($acabado_6Array->unidad_de_venta == '1' /*== '1'and sizeof($hoja->valor_acabado_1)==0*/) //mt2
									{
										//(cf/(total cajas/unidad pliego))+((ancho x largo x valor venta)/10.000)
										$acabado_6Unitario = ($acabado_6CostoFijo/($datos->cantidad_1/$ing->unidades_por_pliego))+($acabado_6MedidaMasValorVenta);
									}
									
									if ($acabado_6Array->unidad_de_venta == '4') //por pasada
									{
										$acabado_6Unitario = (($acabado_6CostoFijo/($datos->cantidad_1/$ing->unidades_por_pliego))+ $acabado_6Valor);
										
									}
                                }  
			
			
								if($hoja->valor_acabado_1 != '0')
								{
									$valor_acabado_1hc = $hoja->valor_acabado_1;
								}
								else
								{
									$valor_acabado_1hc = $acabado_4Unitario;	
								}
								
								if($hoja->valor_acabado_2 != '0')
								{
									$valor_acabado_2hc = $hoja->valor_acabado_2;
								}
								else
								{
									$valor_acabado_2hc = $acabado_5Unitario;	
								}
								
								if($hoja->valor_acabado_3 != '0')
								{
									$valor_acabado_3hc = $hoja->valor_acabado_3;
								} 
								else
								{
									$valor_acabado_3hc = $acabado_6Unitario;	
								}
								
								
								/*if($fotomecanica->acabado_impresion_1=="16")
								{
									$hayAcabados = 'NO';
								}else{
									$hayAcabados = 'SI';
								}
								if($fotomecanica->acabado_impresion_2=="16")
								{
									$hayAcabados = 'NO';
								}else{
									$hayAcabados = 'SI';
								}
								if($fotomecanica->acabado_impresion_3=="16")
								{
									$hayAcabados = 'NO';
								}else{
									$hayAcabados = 'SI';
								}*/
								if($fotomecanica->acabado_impresion_4=="17" and $hayAcabados != 'SI')
								{
									$hayAcabados = 'NO';
									$lugarAcabado = 'No Aplica';
								}else{
									$hayAcabados = 'SI';
									$lugarAcabado = 'Externo';
								}
								if($fotomecanica->acabado_impresion_5=="17" and $hayAcabados != 'SI')
								{
									$hayAcabados = 'NO';
									$lugarAcabado = 'No Aplica';
								}else{
									$hayAcabados = 'SI';
									$lugarAcabado = 'Externo';
								}
								if($fotomecanica->acabado_impresion_6=="17" and $hayAcabados != 'SI')
								{
									$hayAcabados = 'NO';
									$lugarAcabado = 'No Aplica';
								}else{
									$hayAcabados = 'SI';
									$lugarAcabado = 'Externo';
								}
																
			
				$cuerpo.='
				
				<table id="tabla_detalle">
                    <tr>
                        <td class="celda_25">COLORES <span class="borde">'.$fotomecanica->colores.'</span></td>
                        <td class="celda_25">BARNIZ <span class="borde">'.$fotomecanica->lleva_barniz.'</span></td>
						<td class="celda_25">RESERVA <span class="borde">'.$fotomecanica->reserva_barniz.'</span></td>
                        <td class="celda_25">ACABADO <span class="borde">'.$hayAcabados.'</span></td>
                        <td class="celda_25">LUGAR <span class="borde">'.$lugarAcabado.'</span></td>
                    </tr>
                </table>
			
				
					<br>
		
														<table border="0" >
														
														<tr>
														<td class="celda_3"></td>
														<td class="celda_3"></td>
														<td class="celda_3"></td>
														<td class="celda_3">&nbsp;</td>
														
														<td class="fuente2">Descripcion</td>
														<td class="celda_3">&nbsp;</td>
														<td class="fuente2">Valor</td>
														 <td class="celda_3">&nbsp;</td>
														<td class="fuente2">Medida</td>
														 <td class="celda_3">&nbsp;</td>
														<td class="fuente2">Unitario</td>
														  <td class="celda_3">&nbsp;</td>
														<td class="fuente2">Empresa</td>
														</tr>
														
															<tr>
															<td class="celda_3"></td>
															<td class="celda_3"></td>
															<td class="celda_3"></td>
															<td class="celda_3">&nbsp;</td>
															
															<td class="fuente2"><span class="fuente2">'.$acabado_1.'</span></td>
															<td class="celda_3">&nbsp;</td>
															<td class="fuente2"><span class="fuente2">0</span></td>
															 <td class="celda_3">&nbsp;</td>
															<td class="fuente2"><span class="fuente2">0</span></td>
															 <td class="celda_3">&nbsp;</td>
															<td class="fuente2"><span class="fuente2">0</span></td>
															  <td class="celda_3">&nbsp;</td>
															<td class="fuente2"><span class="fuente2">0</span></td>
															</tr>
															';
															
															$cuerpo.='
															<tr>
															<td class="celda_3"><strong> Placa:</strong> </td>
															<td class="celda_3"></td>
															<td class="celda_3"><strong> Pliegos Gramajes</strong> </td>
															<td class="celda_3">&nbsp;</td>
															';
															
															$cuerpo.='
															<td class="fuente2"><span class="fuente2">'.$acabado_3.'</span></td>
															<td class="celda_3">&nbsp;</td>
															<td class="fuente2"><span class="fuente2">0</span></td>
															 <td class="celda_3">&nbsp;</td>
															<td class="fuente2"><span class="fuente2">0</span></td>
															 <td class="celda_3">&nbsp;</td>
															<td class="fuente2"><span class="fuente2">0</span></td>
															 <td class="celda_3">&nbsp;</td>
															<td class="fuente2"><span class="fuente2">0</span></td>
															</tr>
															';
															
															if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
															{
															$cuerpo.='
															<tr>															
															<td class="celda_3">'.$tapa->materiales_tipo.''.$tapa->gramaje.'</td>
															<td class="celda_3"> </td>
															<td class="celda_3 centro">'.$hoja->placa_kilo.'&nbsp;&nbsp;'.$materialidad_1->gramaje.'</td>
															<td class="celda_3">&nbsp;</td>
															';
															}else{
																
															$cuerpo.='
															<tr>															
															<td class="celda_3">'.$tapa->materiales_tipo.'&nbsp;'.$tapa->gramaje.'</td>
															<td class="celda_3"> </td>
															<td class="celda_3 centro">'.$hoja->placa_kilo.'&nbsp;&nbsp;'.$materialidad_1->gramaje.'</td>
															<td class="celda_3">&nbsp;</td>
															';
																
															}
															
															$cuerpo.='
															<td class="fuente2"><span class="fuente2">'.$acabado_3.'</span></td>
															 <td class="celda_3">&nbsp;</td>
															<td class="fuente2"><span class="fuente2">0</span></td>
															 <td class="celda_3">&nbsp;</td>
															<td class="fuente2"><span class="fuente2">0</span></td>
															  <td class="celda_3">&nbsp;</td>
															<td class="fuente2"><span class="fuente2">0</span></td>
															 <td class="celda_3">&nbsp;</td>
															<td class="fuente2"><span class="fuente2">0</span></td>
															</tr>
														
															<tr>
															
															<td class="celda_3"><strong> '.$fotomecanica->materialidad_datos_tecnicos.'</strong> </td>
														    <td class="celda_3"></td>
														    <td class="celda_3"></td>
															<td class="celda_3">&nbsp;</td>
														
																<td class="fuente2">'.$acabado_4.'</td>
																<td class="celda_3">&nbsp;</td>
																<td class="fuente2"><span class="fuente2">'.$acabado_4Valor.'</span></td>
																 <td class="celda_3">&nbsp;</td>
																<td class="fuente2"><span class="fuente2">'.$acabado_4UnidadVentaNombre.'</span></td>
																 <td class="celda_3">&nbsp;</td>
																<td class="fuente2"><span class="fuente2">'.$acabado_4Unitario.'</span></td>
																  <td class="celda_3">&nbsp;</td>
																<td class="fuente2"><span class="fuente2">'.$valor_acabado_1hc.'</span></td>
															</tr>
															
															 <tr>
															';

															if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
															{
																$cuerpo.='
																	<td class="celda_3"><strong>Tapa (Respaldo) :</strong></td>
																	<td class="celda_3"></td>
																	<td class="celda_3"></td>
																	<td class="celda_3">&nbsp;</td>
																';
															}else{
																
																$cuerpo.='
																	<td class="celda_3"><strong>Onda :</strong>'.$monda->materiales_tipo.'&nbsp; </td>
																	<td class="celda_3">'.$monda->gramaje.'</td>
																	<td class="celda_3 centro">'.$hoja->onda_kilo.'&nbsp;&nbsp;'.$hoja->gramos_metro_cuadrado.'</td>
																	<td class="celda_3">&nbsp;</td>
																';
																
															}	
														
														
													    	    $cuerpo.='														
																<td class="fuente2"><span class="fuente2">'.$acabado_5.'</span></td>
																 <td class="celda_3">&nbsp;</td>
																<td class="fuente2"><span class="fuente2">'.$acabado_5Valor.'</span></td>
																 <td class="celda_3">&nbsp;</td>
																<td class="fuente2"><span class="fuente2">'.$acabado_5UnidadVentaNombre.'</span></td>
																  <td class="celda_3">&nbsp;</td>
																<td class="fuente2"><span class="fuente2">'.$acabado_5Unitario.'</span></td>
																  <td class="celda_3">&nbsp;</td>
																<td class="fuente2"><span class="fuente2">'.$valor_acabado_2hc.'</span></td>															
																</tr>															
																<tr>
															     ';
															 
															 if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
															{
																	 $cuerpo.='															 
																	<td class="celda_3">'.$monda->materiales_tipo.'&nbsp; '.$monda->gramaje.'</td>
																	<td class="celda_3">&nbsp;</td>
																	<td class="celda_3 centro">'.$hoja->onda_kilo.'&nbsp;'.$monda->gramaje.'</td>
																	<td class="celda_3"></td>
																	
																	 ';
															}else{
																 
																	 $cuerpo.='
																	 <td class="celda_3"><strong>Liner :</strong>'.$mliner->materiales_tipo.'&nbsp;</td>
																	 <td class="celda_3">'.$mliner->gramaje.'</td>
																	 <td class="celda_3"></td>
																	 <td class="celda_3">&nbsp;</td>
																	 '; 
																 
															 }
															 
															 $cuerpo.='
																<td class="fuente2"><span class="fuente2">'.$acabado_6.'</span></td>
																<td class="celda_3">&nbsp;</td>
																<td class="fuente2"><span class="fuente2">'.$acabado_6Valor.'</span></td>
																 <td class="celda_3">&nbsp;</td>
																<td class="fuente2"><span class="fuente2">'.$acabado_6UnidadVentaNombre.'</span></td>
																  <td class="celda_3">&nbsp;</td>
																<td class="fuente2"><span class="fuente2">'.$acabado_6Unitario.'</span></td>
																  <td class="celda_3">&nbsp;</td>
																<td class="fuente2"><span class="fuente2">'.$valor_acabado_3hc.'</span></td>
															</tr>
															
														</table>

			
				
				
                
                <!--separador 50-->
                    <div class="separador_50"></div>
                <!--/separador 50--> 
                <table id="tabla_detalle">';
                if ($ing->archivo=="")
                {
                    $trazado='NO';    
                }else
                {
                    $trazado='SI';
                }
                $cuerpo.='
                    <tr>
                        
                        <td class="celda_25">TRAZADO <span class="borde">'.$trazado.'</span></td>
                        <td class="celda_25">CROMALÍN <span class="borde">'.$datos->impresion_hacer_cromalin.'</span></td>
                        <td class="celda_25">MONTAJE <span class="borde">'.$datos->montaje_pieza_especial.'</span></td>
                    </tr>
                </table>
                <!--separador 10-->
                    <div class="separador_10"></div>
                <!--/separador 10--> 
                <table id="tabla_detalle">
                    <tr>
                        <td class="celda_40">LUGAR DE IMPRESIÓN <span class="borde">'.$fotomecanica->impresion.'</span></td>
                        <td class="celda_20">&nbsp;</td>
                        <td class="celda_40">MÁQUINA <span class="borde">'.$maquina.'</span></td>
                    </tr>
                </table>
                <!--separador 10-->
                    <div class="separador_10"></div>
                <!--/separador 10--> 
                <table id="tabla_detalle">
                    <tr>
                        <td class="celda_40">CÓDIGO MOLDE <span class="borde">'.$orden->id_molde.'</span></td>
                        <td class="celda_20">&nbsp;</td>
                        <td class="celda_40">MOLDE <span class="borde">'.$orden->nombre_molde.'</span></td>
                    </tr>
                </table>
                <!--separador 10-->
                    <div class="separador_10"></div>
                <!--/separador 10--> 
				';
				
				if($datos->retira_cliente == 'NO')
				{
					$reiraCliente= 'Despacho Empresa';
					
				}
			
			    if($datos->retira_cliente == 'SI')
				{
					$reiraCliente= 'Retira Cliente';					
				}
				
				if($datos->despacho_fuera_de_santiago == 'NO')
				{
					$DespachoSantiago= 'Despacho Dentro de Santiago';
					
				}
			
			    if($datos->despacho_fuera_de_santiago == 'SI')
				{
					$DespachoSantiago= 'Despacho Fuera de Santiago';			
				}
				
				$cuerpo.='
                <table id="tabla_detalle">
                    <tr>
                        <td class="celda_40">TRANSPORTE :<span class="borde">'.$reiraCliente.'</span></td>
                        <td class="celda_20">&nbsp;</td>
                        <td class="celda_40">FORMA DE PAGO <span class="borde">'.$datos->forma_pago.'</span></td>
                    </tr>
                </table>
                <!--separador 10-->
                    <div class="separador_10"></div>
                <!--/separador 10--> 
                <table id="tabla_detalle">
                    <tr>
                        <td class="celda_50">DESPACHAR: <span class="borde">'.$DespachoSantiago.'</span></td>
                        <td class="celda_50">&nbsp;</td>
                    </tr>
                </table>
				
				
				 <!--separador 10-->
                    <div class="separador_10"></div>
                <!--/separador 10--> 
                <table id="tabla_detalle">					
					 <tr>
                        <td class="celda_50">VB EN MAQUINA: <span class="borde">'.$datos->vb_maquina.'</span></td>
                        <td class="celda_50">&nbsp;</td>
                    </tr>
                </table>
				
				
                <!--separador 50-->
                    <div class="separador_50"></div>
                <!--/separador 50-->
                <div class="linea_negra"></div>
                <!--separador 50-->
                    <div class="separador_50"></div>
                <!--/separador 50-->
                <table id="tabla_detalle">
                    <tr>
                        <td class="celda_25 negra izquierda">MATERIALES</td>
                        <td class="celda_25 negra izquierda">GRAMAJE</td>
                        <td class="celda_25 negra izquierda">KILOS</td>
                        <td class="celda_25 negra izquierda">ANCHO</td>
                    </tr>
                </table>
                <!--separador 10-->
                    <div class="separador_10"></div>
                <!--/separador 10-->
                <table id="tabla_detalle">';
                $kilo1=(2605*$materialidad_1->gramaje*$ing->tamano_a_imprimir_1*$ing->tamano_a_imprimir_2)/10000000;
                
                if($fotomecanica->materialidad_datos_tecnicos=='Microcorrugado')
                {
                   $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24); 
                }else
                {
                   $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24); 
                }
                $GramosMetroCuadrado=$materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
               // $kilo2=($GramosMetroCuadrado*$materialidad_2->gramaje*$ing->tamano_a_imprimir_1*$ing->tamano_a_imprimir_2)/10000000;
                //$kilo2=($GramosMetroCuadrado*(($variable_cotizador->precio*$ing->tamano_a_imprimir_1)/100)*$materialidad_2->gramaje*$ing->tamano_a_imprimir_1*$ing->tamano_a_imprimir_2)/10000000;
                //$kilo3=($GramosMetroCuadrado*$materialidad_2->gramaje*$ing->tamano_a_imprimir_1*$ing->tamano_a_imprimir_2)/10000000;
				
				$kilosliner= $hoja->onda_kilo * (($ing->tamano_a_imprimir_1 * $ing->tamano_a_imprimir_2 ) / 10000) * ($materialidad_3->gramaje / 1000);
				
				$kilosonda= ($hoja->onda_kilo * ($ing->tamano_a_imprimir_1 / 100) * ($ing->tamano_a_imprimir_2/100) * ($materialidad_2->gramaje / 1000)) * 1.37;
				
				
				//$kilosliner= $hoja->onda_kilo * 1.33*0.8*0.160;
				 if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
					{
                $cuerpo.='
                    <tr>
                        <td class="celda_25 izquierda">PLACA <span class="borde">'.$tapa->materiales_tipo.'</span></td>
                        <td class="celda_25 izquierda">'.$materialidad_1->gramaje.'</td>
                        <td class="celda_25 izquierda">'.number_format($hoja->kilos_placa,0,'','.').'</td>
                        <td class="celda_25 izquierda">'.$ing->tamano_a_imprimir_1.'</td>
                    </tr>
                </table>
                <!--separador 10-->
                    <div class="separador_10"></div>
                <!--/separador 10-->
                <table id="tabla_detalle">
                    <tr>
                        <td class="celda_25 izquierda">TAPA (RESPALDO)<span class="borde">'.$monda->materiales_tipo.'</span></td>
                        <td class="celda_25 izquierda">'.$materialidad_2->gramaje.'</td>
                        <td class="celda_25 izquierda">'.number_format($kilosonda,0,'','.').'</td>
                        <td class="celda_25 izquierda">'.$ing->tamano_a_imprimir_1.'</td>
                    </tr>
                </table>
                <!--separador 10-->
                    <div class="separador_10"></div>
                <!--/separador 10-->
                <table id="tabla_detalle">
                    <tr>
                        <td class="celda_25 izquierda"></td>
                        <td class="celda_25 izquierda"></td>
                        <td class="celda_25 izquierda"></td>
                        <td class="celda_25 izquierda"></td>
                    </tr>
                </table>
                <!--separador 50-->
                    <div class="separador_50"></div>
                <!--/separador 50-->
                <table id="tabla_detalle">
                    <tr>
                        <td class="celda_25 centro">N° OT <span class="borde">'.number_format($ide,0,'','.').'</span></td>
                        <td class="celda_25 centro">N° H.C <span class="borde">'.number_format($id,0,'','.').'</span></td>
                        <td class="celda_25 centro">FECHA EMISIÓN<span class="borde">'.fecha_con_slash($orden->cuando).'</span></td>
                        <td class="celda_25 centro">Orden de Compra <span class="borde"><br>'.$ordenDeCompra->orden_de_compra_cliente.'</span></td>
                    </tr>
					';
				}else{
					
					 $cuerpo.='
                    <tr>
                        <td class="celda_25 izquierda">PLACA <span class="borde">'.$tapa->materiales_tipo.'</span></td>
                        <td class="celda_25 izquierda">'.$materialidad_1->gramaje.'</td>
                        <td class="celda_25 izquierda">'.number_format($hoja->kilos_placa,0,'','.').'</td>
                        <td class="celda_25 izquierda">'.$ing->tamano_a_imprimir_1.'</td>
                    </tr>
                </table>
                <!--separador 10-->
                    <div class="separador_10"></div>
                <!--/separador 10-->
                <table id="tabla_detalle">
                    <tr>
                        <td class="celda_25 izquierda">ONDA <span class="borde">'.$monda->materiales_tipo.'</span></td>
                        <td class="celda_25 izquierda">'.$materialidad_2->gramaje.'</td>
                        <td class="celda_25 izquierda">'.number_format($hoja->kilos_onda,0,'','.').'</td>
                        <td class="celda_25 izquierda">'.$ing->tamano_a_imprimir_1.'</td>
                    </tr>
                </table>
                <!--separador 10-->
                    <div class="separador_10"></div>
                <!--/separador 10-->
                <table id="tabla_detalle">
                    <tr>
                        <td class="celda_25 izquierda">LINER <span class="borde">'.$mliner->materiales_tipo.'</span></td>
                        <td class="celda_25 izquierda">'.$materialidad_3->gramaje.'</td>
                        <td class="celda_25 izquierda">'.number_format($hoja->kilos_liner,0,'','.').' </td>
                        <td class="celda_25 izquierda">'.$ing->tamano_a_imprimir_1.'</td>
                    </tr>
                </table>
                <!--separador 50-->
                    <div class="separador_50"></div>
                <!--/separador 50-->
                <table id="tabla_detalle">
                    <tr>
                        <td class="celda_25 centro">N° OT <span class="borde">'.number_format($ide,0,'','.').'</span></td>
                        <td class="celda_25 centro">N° H.C <span class="borde">'.number_format($id,0,'','.').'</span></td>
                        <td class="celda_25 centro">FECHA EMISIÓN<span class="borde">'.fecha_con_slash($orden->cuando).'</span></td>
                        <td class="celda_25 centro">Orden de Compra <span class="borde"><br>'.$ordenDeCompra->orden_de_compra_cliente.'</span></td>
                    </tr>
					';
					
					
					
				}
				$cuerpo.='
                </table>
        </div>';
		
		
		
    $cuerpo.='</body>
</html>';
		//echo $cuerpo;exit;
		//$mpdf=new mPDF('c'); 
        $this->mpdf->SetDisplayMode('fullpage');
        $css1 = file_get_contents('bootstrap/orden_de_produccion.css');
        $css2 = file_get_contents('bootstrap/bootstrap.css');
            $this->mpdf->WriteHTML($css2,1);
            $this->mpdf->WriteHTML($css1,1);
    		$this->mpdf->WriteHTML($cuerpo);
    		$this->mpdf->Output();
    		exit;
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    public function edit($id=null,$pagina=null)
    {
         if($this->session->userdata('id'))
        { 
            if(!$id){show_404();}
        $datos=$this->orden_model->getOrdenesPorClientePorId($id);
         $cotizacion=$this->cotizaciones_model->getCotizacionPorId($datos->id_cotizacion);
         //print_r($cotizacion);exit;
         $impresionPresupuesto=$this->cotizaciones_model->getCotizacionImpresionPresupuestoPorIdCotizacion($datos->id_cotizacion);
         if($this->input->post())
            {
                if($this->form_validation->run("ad_orden_de_produccion"))
                {
                    $data=array
                                 (
                                    "id_usuario"=>$this->session->userdata('id'),
                                     "id_cotizacion"=>$this->input->post("id",true),
                                    "id_cliente"=>$this->input->post("cliente",true),
                                    "producto"=>$this->input->post("producto",true),
                                    "generico"=>"0",
                                    "id_vendedor"=>$this->input->post("vendedor",true),
                                    "condicion_del_producto"=>$this->input->post("condicion_del_producto",true),
                                    "cantidad"=>$this->input->post("cantidad",true),
                                    "precio"=>$this->input->post("precio",true),
                                    "acepta_excedentes"=>$this->input->post("acepta_excedentes",true),
                                    "piezas_adicionales"=>$this->input->post("piezas_adicionales",true),
                                    "materialidad_datos_tecnicos"=>$this->input->post("datos_tecnicos",true),
                                    "materialidad_1"=>$this->input->post("materialidad_1",true),
                                    "materialidad_2"=>$this->input->post("materialidad_2",true),
                                    "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),
                                    "colores"=>$this->input->post("colores",true),
                                    "colores_metalicos"=>$this->input->post("colores_metalicos",true),
                                    "acabado_impresion_1"=>$this->input->post("acabado_impresion_1",true),
                                    "acabado_impresion_2"=>$this->input->post("acabado_impresion_2",true),
                                    "acabado_impresion_3"=>$this->input->post("acabado_impresion_3",true),
                                    "acabado_impresion_4"=>$this->input->post("acabado_impresion_4",true),
                                    "folia"=>$this->input->post("folia",true),
                                    "folia_se"=>$this->input->post("folia_se",true),
                                    "cuno"=>$this->input->post("cuno",true),
                                    "cuno_se"=>$this->input->post("cuno_se",true),
                                    "producto_se_entrega_armado"=>$this->input->post("producto_se_entrega_armado",true),
                                    "tiene_desgajado"=>$this->input->post("tiene_desgajado",true),
                                    "montaje_pieza_especial"=>$this->input->post("montaje_pieza_especial",true),
                                    "pegado_instrucciones"=>$this->input->post("pegado_instrucciones",true),
                                    "cantidad_especifica"=>$this->input->post("cantidad_especifica",true),
                                    "envasado"=>$this->input->post("envasado",true),
                                    "fecha_despacho"=>$this->input->post("fecha_despacho",true),
                                    "despacho_fuera_de_santiago"=>$this->input->post("despacho_fuera_de_santiago",true),
                                    "retira_cliente"=>$this->input->post("retira_cliente",true),
                                    "total_o_parcial"=>$this->input->post("tota_o_parcial",true),
                                    "can_despacho_1"=>$this->input->post("can_despacho_1",true),
                                    "can_despacho_2"=>$this->input->post("can_despacho_2",true),
                                    "can_despacho_3"=>$this->input->post("can_despacho_3",true),
                                    "forma_pago"=>$this->input->post("forma_pago",true),
                                    "comision_agencia"=>$this->input->post("comision_agencia",true),
                                    "costo_comercial"=>$this->input->post("costo_comercial",true),
                                    "persona_que_firma"=>$this->input->post("persona_que_firma",true),
                                    "numero_orden"=>$this->input->post("numero_orden",true),
                                    "estado"=>"1",
                                 );
                             
                              $guardar=$this->orden_model->update($data, $this->input->post("id",true));
                            if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha editado el registro exitosamente.');
					           redirect(base_url().'ordenes/index/'.$this->input->post("pagina",true),  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'ordenes/add',  301);
                            }
                }
             }   
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/css/calendario.css",
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                   // base_url()."public/frontend/css/bootstrap-chosen.less"
                )
            );        
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/js/calendar.js",
                    base_url()."public/backend/js/calendar-setup.js",
                    base_url()."public/backend/js/calendar-es.js",
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                    base_url()."public/frontend/js/dar_formato.js",
                    base_url()."public/backend/fancybox/jquery.fancybox.js",
                   // "http://harvesthq.github.io/chosen/chosen.jquery.js"
                )
            );    
            $tipos=$this->materiales_model->getMaterialesTipo();
            $vendedores=$this->vendedores_model->getVendedoresSelect();
            $this->layout->view('edit',compact("datos","id","pagina","vendedores","tipos","cotizacion","impresionPresupuesto"));
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
      public function revision($id=null,$pagina=null)
    {
         if($this->session->userdata('id'))
        { 
            if(!$id){show_404();}
        $datos=$this->orden_model->getOrdenesPorClientePorId($id);
         $cotizacion=$this->cotizaciones_model->getCotizacionPorId($datos->id_cotizacion);
         $this->layout->view('revision',compact("datos","id","pagina","cotizacion"));
         }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
    }
    public function detalle($id=null)
    {
         if($this->session->userdata('id'))
        {
             $this->load->library('javascript');
            $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
            $this->layout->setLayout('template_ajax');
            //$id=$this->input->post("valor1",true);
            $datos=$this->orden_model->getOrdenesPorClientePorId($id);
            //print_r($datos);exit;
            $this->layout->view('detalle',compact("datos","id")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
    }
    public function listado_cotizaciones()
    {
         if($this->session->userdata('id'))
        {
            $this->layout->setLayout('template_ajax');
            $id=$this->input->post("valor3",true);
            $datos=$this->cotizaciones_model->getCotizacionPorClienteDiezRegistros($this->input->post("valor2",true));
            $cliente=$this->clientes_model->getClientePorId($this->input->post("valor2",true));
            $this->layout->view('listado_cotizaciones',compact("datos","cliente","id")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
    }
      public function detalle_pdf($id=null,$orden=null)
	{
	    if($this->session->userdata('id'))
        {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
		//
		$vendedor=$this->vendedores_model->getVendedorPorId($datos->id_vendedor);
		$vcliente=$this->clientes_model->getClientePorId2($datos->id_cliente);
		$vcliente3=$this->clientes_model->getClientePorId3($datos->id_cliente);
		$usuario=$this->usuarios_model->getUsuariosPorId($datos->id_usuario);
		
		$ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($datos->id);
		
		$fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
		
	   // $vmolde1=$this->moldes_model->getMoldesPorId($fotomecanica->numero_molde);
		$vmolde1=$this->cotizaciones_model->getMoldesPorId($fotomecanica->numero_molde);
		
		if($ing->archivo ==NUll)
		{
			$vpdf="NO";
	    }
		else
		{
			$vpdf="SI";
		}
		
		
        if(sizeof($datos)==0){show_404();}
        $impresionPresupuesto=$this->cotizaciones_model->getCotizacionImpresionPresupuestoPorIdCotizacion($id);
         if($datos->id_cliente==3000)
            {
                $cliente=$datos->nombre_cliente;
                $correo="";
                $direccion="";
                $ciudad="";
                $comuna="";
                $rut="";
                $telefono="";
                
            }else
            {
                $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
                $cliente=$cli->razon_social;
                $correo=$cli->correo;
                $direccion=$cli->direccion;
                $ciudad=$cli->ciudad;
                $comuna=$cli->comuna;
                $rut=$cli->rut;
                $telefono=$cli->telefono;
                
                $contacto=$this->clientes_model->geContactosClientePorIdUltimo($datos->id);
            }
            //$vendedor=$this->vendedores_model->getVendedorPorId($datos->id_vendedor);
			//$vcliente=$this->clientes_model->getClientePorId($datos->id_cliente);
			
			
         $cuerpo='<!doctype html>
			<html> 
            <head>
            <meta charset="utf-8" />
            
<style type="text/css">
    .tabla
    {
         border: #000099; border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; width: 1200px;
    }
	

</style>
            </head>
			<body>';
	//Inicio Contenido Cuerpo	//<h1>Orden de Produccion</h1>
	//  <td colspan="3">Vendedor: '.$vendedor->nombre.' </td>
$cuerpo='	
		
 
<table >

<tr>
<td><font size="1">Codigo Producto:NNNNANNN NNNNANNN</font></td>
 <td>&nbsp; </td>
</tr>

<tr>
<td></td>
<td colspan="4"><center><b>O.T.N:'.$datos->id.'</b></center></td>  
<td></td>
<td>O.T Anexa: 0</td>
<td></td>
</tr>



<tr>
 <td colspan="2"><b><span style="font-size: 13px;">ORDEN DE PRODUCCION DISEÑO </span></b></td>
  <td><font size="3">Fecha:'.$datos->fecha.'</font></td>
  <td><font size="3">ENT:'.$datos->fecha.'</font></td>
</tr> 
 
 
<tr>
  <td colspan="3">Cliente: '.$vcliente->razon_social.'</td> 
  <td>OC:12345</td>
  <td colspan="3">Vendedor: '.$vendedor->nombre.'</td>
  <td>HC:'.$datos->id.'</td> 
  <td></td> 
</tr>
 
<tr>
  <td>Cantidad: '.$datos->cantidad_1.'</td>
</tr>


<tr>
  <td colspan="5">Trabajo:'.$datos->comentario_medidas.', '.$ing->medidas_de_la_caja.' </td>
   <td>&nbsp; </td>
    <td>&nbsp; </td>
	 <td>&nbsp; </td>
	  <td>&nbsp; </td>
</tr>
 
<tr>
 <td>&nbsp; </td>
</tr>
 
<tr>
  <td colspan="3"><b><u>'.$datos->materialidad_2.'</u></b></td>
</tr>

 <tr>
 <td>&nbsp; </td>
</tr> 

<tr>
  <td colspan="2">'.$usuario->nombre.'</td>
   <td>&nbsp; </td> 
   <td>&nbsp; </td>
</tr>

<tr>
  <td>Tamaño:'.$ing->medidas_de_la_caja.' </td>
  <td colspan="2">Tamaño Pliego:'.$ing->tamano_a_imprimir_1.' X '.$ing->tamano_a_imprimir_2.'CM</td> 
  <td colspan="2">Unidad/Pliego:'.$ing->unidades_por_pliego.'</td>
  <td colspan="2">Piezas/Unidad:'.$ing->piezas_adicionales.'</td>
  <td>&nbsp; </td> 
  <td>&nbsp; </td>
</tr>


<tr>
  <td colspan="3">Placa:'.$ing->materialidad_1.'</td>
  <td>Onda:</td>
  <td>Colores:'.$datos->impresion_colores.'</td>
  <td>Barniz:</td>
</tr>

<tr>
  <td>Termolaminado:</td>
  <td>Reserva:</td>
  <td>Trazado:'.$vpdf.'</td>
  <td colspan="2">Cromalin:'.$datos->impresion_hacer_cromalin.'</td>
  <td colspan="2">Repeticion:'.$datos->condicion_del_producto.'</td>
</tr>

<tr>
  <td>Observaciones:</td>

</tr>

<tr>
<td colspan="8"><hr size="2"> </hr></td>
</tr>



<tr>

  <td colspan="3"><b><span style="font-size: 13px;">Orden DE PRODUCCION FOTOMECANICA</span></b></td>
  <td colspan="1"><span style="font-size: 11px;">O.T.N:'.$datos->id.'</span></td>    
  <td><span style="font-size: 11px;">HC:'.$datos->id.'</span></td>
  <td>&nbsp; </td> 
  <td><span style="font-size: 11px;">Fecha:'.$datos->fecha.'</span></td>
<br><br>
</tr>
 
 

<tr>
 <td colspan="3">Cliente:'.$vcliente->razon_social.'</td>
  <td colspan="3">Vendedor:'.$vendedor->nombre.'</td>
</tr>


<tr>
  <td colspan="5">Trabajo:'.$datos->comentario_medidas.', '.$ing->medidas_de_la_caja.' </td>
   <td>&nbsp; </td>
    <td>&nbsp; </td>
	 <td>&nbsp; </td>
	  <td>&nbsp; </td>
</tr>

<tr>
 <td>Repeticion:'.$datos->condicion_del_producto.'</td>
   <td>&nbsp; </td>  
 <td colspan="3">Cantidad:'.$datos->cantidad_1.' Unidades</td>
 <td colspan="3">Tamaño:'.$ing->medidas_de_la_caja.'</td> 
 
</tr>



<tr>
      <td>&nbsp; </td>  
      <td>&nbsp; </td> 
      
  <td colspan="3">Tamaño Pliego: '.$ing->tamano_a_imprimir_1.' X '.$ing->tamano_a_imprimir_2.' CM</td>
  <td colspan="3">Unidad/Pliego:'.$ing->unidades_por_pliego.'</td>
</tr>


<tr>
  <td colspan="3">Placa:'.$ing->materialidad_1.'</td>
  <td>Onda:</td>
  <td>&nbsp; </td> 
  <td>Colores:'.$datos->impresion_colores.'</td>
</tr>


<tr>
  <td>Barniz:</td>
  <td>Termolaminado:</td>
   <td>&nbsp; </td> 
  <td>Reserva:</td>
</tr>

<tr>
  <td>Trazado:'.$vpdf.'</td>
  <td>Montaje:'.$datos->montaje_pieza_especial.'</td>
   <td>&nbsp; </td> 
  <td colspan="2">Planchas:</td>
</tr>




<tr>
  <td>Observaciones:</td>

</tr>

<tr>
<td colspan="8"><hr size="2"> </hr></td>
</tr>



<tr>

  <td colspan="3"><b><span style="font-size: 13px;">ORDEN DE PRODUCCION</span></b></td>
  <td colspan="1"><span style="font-size: 11px;">O.T.N:'.$datos->id.'</span></td>    
  <td><span style="font-size: 11px;">HC:'.$datos->id.'</span></td>
   <td>&nbsp; </td> 
  <td><span style="font-size: 11px;">Fecha:'.$datos->fecha.'</span></td>
<br><br>
</tr>

<tr>
  <td colspan="5">Trabajo:'.$datos->comentario_medidas.', '.$ing->medidas_de_la_caja.' </td>
   <td>&nbsp; </td>
    <td>&nbsp; </td>
	 <td>&nbsp; </td>
	  <td>&nbsp; </td>
</tr>


<tr>
  <td colspan="2">Vendedor:'.$vendedor->nombre.'</td>
  <td colspan="2">Placa: </td>
   <td>Repeticion:'.$datos->condicion_del_producto.'</td>
</tr>

  
<tr>
  <td colspan="3">Placa:'.$ing->materialidad_1.'</td>
  <td colspan="3">Tamaño Placa:'.$ing->tamano_a_imprimir_1.' X '.$ing->tamano_a_imprimir_2.'CM</td>
</tr>

<tr>
  <td>Colores:'.$datos->impresion_colores.'</td>
  <td>Barniz:</td>
  <td>Termolaminado:</td>
    <td>&nbsp; </td>
  <td>Reserva:</td>
</tr>

<tr>
 <td colspan="3">Lugar Impresion: Fabrica</td>
</tr>

<tr>
  <td>Observaciones:</td>

</tr>

<tr>
<td colspan="8"><hr size="2"> </hr></td>
</tr>



<tr>
  <td colspan="3"><b><span style="font-size: 13px;">ORDEN DE PRODUCCION MOLDE</span></b></td>
  <td colspan="1"><span style="font-size: 11px;">O.T.N:'.$datos->id.'</span></td>    
  <td><span style="font-size: 11px;">HC:'.$datos->id.'</span></td>
</tr>

<tr>
    <td>Molde:'.$fotomecanica->numero_molde.' </td>
    <td>&nbsp; </td>
    <td colspan="5">Nombre Molde:'.$vmolde1->nombremolde.'</td>
</tr>  

<tr>
 <td colspan="3">Medida:'.$vmolde1->tamano_caja.'</td>
    <td>&nbsp; </td>
 <td colspan="3">Corte Cuchillo a Cuchillo:'.$vmolde1->cuchillocuchillo.'</td>
</tr>


<tr>
  <br>
<td>&nbsp; </td> 
<td>&nbsp; </td> 
<td>&nbsp; </td> 
<td>&nbsp; </td> 
<td>&nbsp; </td> 
<td>&nbsp; </td> 
<td>&nbsp; </td> 
<td>&nbsp; </td> 
<td>&nbsp; </td> 
</tr>




<tr>
<td colspan="3">Cliente:'.$vcliente->razon_social.'</td>
<td colspan="2"><center><b>O.T.N:'.$datos->id.'</b></center></td>  
<td colspan="2">O.T Anexa: 0</td>
</tr>

<tr>
<td colspan="8"><hr size="2"> </hr></td>
</tr>

<tr>
  <td colspan="2">Cantidad:'.$datos->cantidad_1.' Unidad</td>
    <td colspan="5">Trabajo:'.$datos->comentario_medidas.', '.$ing->medidas_de_la_caja.'</td>
	<br><br>
</tr>

<tr>
  <td colspan="3"><b>'.$datos->materialidad_2.'</b></td>
  <br>
</tr>

<tr>
  <td colspan="3"><b><u>Corte Placa</u></b></td>
</tr>


<tr>
  <td colspan="2">Cantidad: 500 </td>
   <td colspan="2">Medida: 100x100 CM </td>
     <td colspan="3">Placa: "Papel encolado 500"</td>
</tr>

<tr>
  <td colspan="3"><b><u>Corte Onda</u></b></td>
    <td colspan="3"><b><u>Ancho Corrugado </u></b> 0 </td>
</tr>
 
<tr>
  <td colspan="2">Cantidad: 300 Pliegos </td>
   <td colspan="2">Medida: 100x100 CM </td>
     <td colspan="3">Material: 1161 Onda 160 GR/M2 Liner</td>
</tr>

<tr>
<td colspan="8"><hr size="2"> </hr></td>
</tr>


<tr>
  <td colspan="1"><b><u>Emplacado:</u></b></td>
   <td colspan="6">'.$datos->comentario_medidas.', '.$ing->medidas_de_la_caja.'</td>
</tr>

<tr>
   <td colspan="5">Trabajo:'.$datos->comentario_medidas.', '.$ing->medidas_de_la_caja.'</td>   
</tr>


<tr>
	<td>O.T.N: '.$datos->id.'</td>  
	<td colspan="2">Fecha:'.$datos->fecha.'</td>
	 <td colspan="3">Placa:'.$ing->materialidad_1.'</td>	 
</tr>




<tr>
  <td colspan="2">Cantidad:'.$datos->cantidad_1.'  Pliegos </td>
   <td colspan="2">Medida:'.$ing->tamano_a_imprimir_1.' X '.$ing->tamano_a_imprimir_2.' CM </td>
       <td colspan="3">Material:'.$datos->materialidad_2.'-'.$ing->materialidad_1.'</td>
</tr>



<tr>
<td colspan="8"><hr size="2"> </hr></td>
</tr>


<tr>
  <td colspan="1"><b><u>Troquelado:</u></b></td>
   <td colspan="6">Trabajo:'.$datos->comentario_medidas.', '.$ing->medidas_de_la_caja.'</td>
</tr>



<tr>
	<td>O.T.N:'.$datos->id.'</td>  
	<td colspan="2">Fecha:'.$datos->fecha.'</td>
</tr>

<tr>
<td colspan="2">Cantidad:'.$datos->cantidad_1.' Pliegos </td>
<td colspan="2">Medida:'.$ing->tamano_a_imprimir_1.' X '.$ing->tamano_a_imprimir_2.'CM</td>
<td colspan="4">Molde:'.$vmolde1->nombremolde.'</td>
</tr>


<tr>
<td colspan="2">Salen:'.$datos->cantidad_1.' Unidad </td>
<td colspan="2"></td>
<td colspan="3">Nº: '.$fotomecanica->numero_molde.'</td>
</tr>


<tr>
<td colspan="8"><hr size="2"> </hr></td>
</tr>


<tr>
  <td colspan="4"><b><u>Orden de prduccion para pegado y empaquetado</u></b></td>
	<td>O.T.N: '.$datos->id.'</td>  
	<td colspan="2">Fecha:'.$datos->fecha.'</td>
</tr>


<tr>
  <td colspan="2">Cantidad:'.$datos->cantidad_1.'</td>  
   <td colspan="2">Empaquetar de:  UNID</td> 
   <td colspan="2">Total Pqtes: </td>    
</tr>

<tr>
  <td colspan="2">Autoadhesivo:  </td>  
   <td colspan="3">Tipo Pegado:'.$ing->tipo_de_pegado.'</td> 
</tr>



<tr>
<td colspan="8"><hr size="2"> </hr></td>
</tr>


<tr>
  <td colspan="4"><b><u>Instrucciones para despacho orden</u></b></td>
	<td>O.T.N: '.$datos->id.'</td>  
	<td colspan="2">Fecha:'.$datos->fecha.'</td>
</tr>



<tr>
 <td colspan="2">Cliente:'.$vcliente->razon_social.'</td>
  <td colspan="2">Rut:'.$vcliente->rut.'</td>
    <td colspan="2">O/Compra: </td>
</tr>


<tr>
 <td colspan="2">Direccion:'.$vcliente->direccion.'</td>
  <td colspan="2">Fono/Fax: '.$vcliente->telefono.'</td>
</tr>

<tr>
 <td colspan="2">Comuna:'.$vcliente3->comuna.'</td>
  <td colspan="2">Ciudad:'.$vcliente3->ciudad.'</td>
  <td colspan="3">Vendedor:'.$vendedor->nombre.'</td>
</tr>


<tr>
 <td colspan="2">Forma de Pago: '.$vcliente3->pago.'</td>
</tr>



<tr>
 <td colspan="4">Trabajo:'.$datos->comentario_medidas.', '.$ing->medidas_de_la_caja.'</td>
  <td colspan="2">CProducto: NNNNANNN</td>
</tr>




<tr>
  <td colspan="2">Precio Unidad: 0 mas IVA</td>
    <td colspan="2">Transporte: Fabrica</td>
</tr>

<tr>
  <td colspan="4">Despacho a: "Aqui el despacho"</td>
    <td colspan="2">Total Pedido:'.$datos->cantidad_1.'</td>
</tr>

<tr>
  <td colspan="4">Forma de Entrega:'.$datos->total_o_parcial.'</td>
    <td colspan="2">Seda: </td>
</tr>

<tr>
  <td>Observaciones:</td>
<br><br>
</tr>





</table>



   '; //Fin cuerpo Hoja 1 _____________________________________________________________________________________
   
   
    //Fin Contenidos Cuerpo
      $cuepo.='</body></html>';
            //echo $cuerpo;exit;
		$mpdf=new mPDF(); 
		$nombre="Cotización de Cliente ".$id." ".date("Y-m-d H:i:s").".pdf";
		$mpdf->WriteHTML($cuerpo);
		$mpdf->Output($nombre,'I');
		exit;
            
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    public function imprimir($id=null)
    {
        if($this->session->userdata('id'))
        { 
            if(!$id){show_404();}
            $orden=$this->orden_model->getOrdenesPorId($id);
            if(sizeof($orden)==0){show_404();}
            $datos=$this->cotizaciones_model->getCotizacionPorId($orden->id_cotizacion);
            $cuerpo='';
            $cuerpo.=
            '
             <!DOCTYPE html>
<html lang="es">
	<head>
		<title>..:: Control de Gestión - Empresas Grau ::..</title>
		<meta charset="utf-8" />
        <style type="text/css">
        *
{
    font-size: 14px;
}
.borde 
    { 
        color: #000000;
        border: #000000;
        border-style: solid;
        border-top-width: 1px;
        border-right-width: 2px;
        border-bottom-width: 1px;
        border-left-width: 1px;
        float:left;
        font-size: 14px;
    }
    .cuadro_chico 
    { 
        color: #000000;
        border: #000000;
        border-style: solid;
        border-top-width: 1px;
        border-right-width: 2px;
        border-bottom-width: 1px;
        border-left-width: 1px;
        width: 25px;
        height: 25px;
        float:left;
        font-size: 14px;
    }
.izq
{
    text-align: left;
}
.derecha
{
    text-align: right;
}
.columna1 td
{
    width: 80px;
    font-size: 14px;
}
.columna2 td
{
    width: 200px;
    font-size: 14px;
}
.columna3 td
{
    width: auto;
    font-size: 14px;
}
.columna_100
{
    width: 200px;
}
.separador50
{
    width: auto;
    height: 50px;
}
.separador25
{
    width: auto;
    height: 25px;
}
.separador_negro
{
    width: auto;
    height: 20px;
    background-color: #000000;
}
table
{
    font-size: 14px;
}
  
        </style>

                
	</head>
	<body>
        <table>
            <tr>
                <td class="izq">
                   <h1>Cartonaje Grau</h1>
                </td>
            </tr>    
        </table>
        <table class="columna1">
            <tr>
                <td class="derecha">
                    <strong>N°O.T</strong>
                </td>
                <td>
                    <div class="borde">
                        17680
                    </div>
                </td>
                <td>&nbsp;</td>
                 <td class="derecha">
                    <strong>N°H.C</strong>
                </td>
                <td>
                    <div class="borde">
                        52845
                    </div>
                </td>
                <td>&nbsp;</td>
                 <td class="derecha">
                    <strong>FECHA</strong>
                </td>
                <td>
                    <div class="borde">
                        30/11/2015
                    </div>
                </td>
                <td>&nbsp;</td>
                 <td class="derecha">
                    <strong>Orden de Compra</strong>
                </td>
                <td>
                    <div class="borde">
                        34898
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            
        </table>
        <table>
        <tr>
                <td class="derecha">
                    CLIENTE
                </td>
                <td class="columna_100">
                    <div class="borde">
                        GOOD FOOD S.A.
                    </div>
                </td>
                <td class="derecha">
                    VENDEDOR
                </td>
                <td class="columna_100">
                    <div class="borde">
                        OFICINA
                    </div>
                </td>
                <td class="derecha">
                    FECHA DESPACHO
                </td>
                <td class="columna_100">
                    <div class="borde">
                        30/11/2015
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <td>TRABAJO</td>
            <td>
                <div class="borde">
                EXIBIDORA PARA ALIÑOS DRES, IMPRESIO A 2 COLORES+BARNIZ, EN CARTULINA DE 190 GR, EMPLACADO EN MICROCORRUGADO REV CAFÉ, T:18.2X11.7x9 CM, CÓDIGO: WBC612
                </div>
            </td>
        </table>
        <div class="separador50"></div>
        <table class="columna2">
            <tr>
                <td class="izq">
                    <strong>CANTIDAD</strong>
                </td>
                <td>
                    <strong>IDENTIFICACIÓN DEL TRABAJO</strong>
                </td>
                <td>
                    <strong>CPRODUCTO</strong>
                </td>
                <td>
                    <strong>PRECIO VENTA</strong>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="borde">
                    10000
                    </div>Unidades
                </td>
                <td style="width: 500px;">
                    <div class="borde">
                    EXHIBIDORA PARA ALIÑOS DRES, 2C+B, 18.2x11.7x 9CM
                    </div>
                </td>
                <td>
                    <div class="borde">
                    2286A004
                    </div>
                </td>
                <td>
                    <div class="borde">
                    205.0
                    </div>
                </td>
            </tr>
        </table>  
        <div class="separador50"></div>
        <table class="columna1">
            <tr>
                <td class="derecha">
                TAMAÑO PLIEGO
                </td>
                <td>
                    <div class="cuadro_chico">
                        80
                    </div> 
                    <div style="float: left;">x</div>
                    <div class="cuadro_chico">
                        80
                    </div> 
                </td>
                <td class="derecha">
                UNIDAD PLIEGO
                </td>
                <td>
                    <div class="cuadro_chico">
                        4
                    </div>  
                </td>
                <td class="derecha">
                REPETICIÓN
                </td>
                <td>
                    <div class="cuadro_chico">
                        NO
                    </div>  
                </td>
            </tr>
            <tr>
                <td colspan="7">
                    <br />
                </td>
            </tr>
             <tr>
                <td class="derecha">
                COLORES
                </td>
                <td>
                    <div class="cuadro_chico">
                        2
                    </div> 
                </td>
                <td class="derecha">
                BARNIZ
                </td>
                <td>
                    <div class="cuadro_chico">
                        SI
                    </div>  
                </td>
                <td class="derecha">
                TERMOLAMINADO
                </td>
                <td>
                    <div class="cuadro_chico">
                        NO
                    </div>  
                </td>
                <td>LUGAR TERMOLAMINADO</td>
            </tr>
            </table>
             <table>
             <tr>
                <td>
                    &nbsp;
                </td>
                <td style="width: 400px;">
                    &nbsp; 
                </td>
                <td>
                   <strong>PLIEGOS</strong>
                </td>
                <td>
                    <strong>GRAMAJE</strong>
                </td>
            </tr>
            <tr>
                <td>
                    PLACA
                </td>
                <td style="width: 400px;">
                    <div class="borde">
                        29/65/ CARTULINA VALDIVIA REVERSO CAFÉ 190
                    </div>  
                </td>
                <td>
                    <div class="borde">
                        2970
                    </div>
                </td>
                <td>
                    <div class="borde">
                        190
                    </div>
                </td>
            </tr>
             <tr>
                <td>
                    <div style="float: left;">MICROONDA:</div>
                    <div class="cuadro_chico" style="float: left;">131</div>
                </td>
                <td style="width: 400px;">
                    <div class="borde">
                        ONDA 125 GR/M2 LINER 125/M2
                    </div>  
                </td>
                <td>
                    <div class="borde">
                        2600
                    </div>
                </td>
                <td>
                    <div class="borde">
                        314
                    </div>
                </td>
            </tr>
            </table>
            <div class="separador25"></div>
            <table class="columna1">
            <tr>
                <td class="derecha">
                RESERVA
                </td>
                <td>
                    <div class="cuadro_chico">
                        SI
                    </div> 
                </td>
                <td class="derecha">
                TRAZADO
                </td>
                <td>
                    <div class="cuadro_chico">
                        SI
                    </div>  
                </td>
                <td class="derecha">
                CROMALÍN
                </td>
                <td>
                    <div class="cuadro_chico">
                        NO
                    </div>  
                </td>
                <td>MONTAJE</td>
                <td>
                    <div class="cuadro_chico">
                        SI
                    </div>  
                </td>
            </tr>
            </table>
            <table class="columna1">
                <tr>
                    <td>LUGAR DE IMPRESIÓN</td>
                    <td>
                        <div class="borde">
                            FABRICA
                        </div>
                    </td>
                    <td>&nbsp;</td>
                    <td>MÁQUINA</td>
                    <td>
                        <div class="borde">
                            800
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>CÓDIGO MOLDE</td>
                    <td>
                        <div class="borde">
                            8408
                        </div>
                    </td>
                    <td>&nbsp;</td>
                    <td>MOLDE</td>
                    <td style="width: 250px;">
                        <div class="borde">
                            EXHIBIDORA PARA ALIÑOS
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>TRANSPORTE</td>
                    <td>
                        <div class="borde">
                            FÁBRICA
                        </div>
                    </td>
                    <td>&nbsp;</td>
                    <td>FORMA PAGO</td>
                    <td style="width: 250px;">
                        <div class="borde">
                            60 DÍAS FECHA FACTURA
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>DESPACHAR</td>
                    <td style="width: 400px;">
                        <div class="borde">
                            PLANTA MALLOCO PEÑAFLOR BALMACEDA 3050
                        </div>
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
            <div class="separador25"></div>
            <div class="separador_negro"></div>
            <div class="separador50"></div>
            <table border="2">
                <tr>
                    <td style="width: 250px;"><strong>Materiales</strong></td>
                    <td style="width: 250px;"><strong>GRAMAJE</strong></td>
                    <td style="width: 250px;"><strong>KILOS</strong></td>
                    <td style="width: 250px;"><strong>ANCHO</strong></td>
                </tr>
               
                    <tr>
                        <td style="width: 250px;">
                            <div>PLACA</div>
                            <div class="borde" style="float: left;">
                                 29/65/ CARTULINA VALDIVIA REVERSO CAFÉ 190 GRAMOS
                            </div>
                        </td>
                        <td style="width: 250px;">
                            <div class="borde">
                                 190
                            </div>
                        </td>
                        <td style="width: 250px;">
                            <div class="borde">
                                 393
                            </div>
                        </td>
                        <td style="width: 250px;">
                            80
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 250px;">
                            <div>ONDA</div>
                            <div class="borde" style="float: left;">
                                 29/65/ CARTULINA VALDIVIA REVERSO CAFÉ 190 GRAMOS
                            </div>
                        </td>
                        <td style="width: 250px;">
                            <div class="borde">
                                 190
                            </div>
                        </td>
                        <td style="width: 250px;">
                            <div class="borde">
                                 393
                            </div>
                        </td>
                        <td style="width: 250px;">
                            80
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 250px;">
                            <div>LINER</div>
                            <div class="borde" style="float: left;">
                                 PAPEL ONDA 125 GRAMOS
                            </div>
                        </td>
                        <td style="width: 250px;">
                            <div class="borde">
                                 125
                            </div>
                        </td>
                        <td style="width: 250px;">
                            <div class="borde">
                                 294
                            </div>
                        </td>
                        <td style="width: 250px;">
                            80
                        </td>
                    </tr>
            </table>
            <div class="separador25"></div>
            <table class="columna1">
            <tr>
                <td class="derecha">
                    <strong>N°O.T</strong>
                </td>
                <td>
                    <div class="borde">
                        17680
                    </div>
                </td>
                <td>&nbsp;</td>
                 <td class="derecha">
                    <strong>N°H.C</strong>
                </td>
                <td>
                    <div class="borde">
                        52845
                    </div>
                </td>
                <td>&nbsp;</td>
                 <td class="derecha">
                    <strong>FECHA</strong>
                </td>
                <td>
                    <div class="borde">
                        30/11/2015
                    </div>
                </td>
                <td>&nbsp;</td>
                 <td class="derecha">
                    <strong>Orden de Compra</strong>
                </td>
                <td>
                    <div class="borde">
                        34898
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
        </table>
        <table>
            <td>TRABAJO</td>
            <td>
                <div class="borde">
                EXIBIDORA PARA ALIÑOS DRES, IMPRESIO A 2 COLORES+BARNIZ, EN CARTULINA DE 190 GR, EMPLACADO EN MICROCORRUGADO REV CAFÉ, T:18.2X11.7x9 CM, CÓDIGO: WBC612
                </div>
            </td>
        </table>
	</body>
</html>
            ';
            //echo $cuerpo;exit;
            $nombre="PDF Para Impresión fast Track ".$id." ".date("Y-m-d H:i:s").".pdf";
    		$mpdf=new mPDF('c'); 
            $mpdf->SetDisplayMode('fullpage');
            $stylesheet = file_get_contents(base_url().'public/frontend/css/orden.css');
            $mpdf->WriteHTML($stylesheet,1);
            $mpdf->WriteHTML($cuerpo);
    		$mpdf->Output($nombre,'I');
    		exit;
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
}

