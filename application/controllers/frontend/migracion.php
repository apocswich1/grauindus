<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class migracion extends CI_Controller {


    private $session_id;
    public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('backend');
      
    }
    
    public function index()
	{
        $arreglo = "";
        if($this->session->userdata('id'))
        {
          if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
           //$datos=$this->migracion_model->getMigracionAll_indexPaginacion();
           
            if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3);
            }else
            {
               $pagina=0;
            }
            $porpagina=50;
            
            $datos=$this->migracion_model->getMigracionPaginacion($pagina,$porpagina,"limit");
            $cuantos=$this->migracion_model->getMigracionPaginacion($pagina,$porpagina,"cuantos");

            $config['base_url'] = base_url().'migracion/index';
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
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                     base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            ); 
            $this->layout->view('index',compact('datos','cuantos','pagina'));            
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
        
    public function registro()
    {

        if($this->session->userdata('id'))
        {
            $this->load->library('javascript');
            $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
            $this->layout->setLayout('template_ajax');
            $arreglo="";
            if ($this->uri->segment(3)!='')
            {
                $id=$this->uri->segment(3);
                $registro=$this->migracion_model->getMigracionRegistroPorId($id); 
                $registro_microondas=$this->migracion_model->getMigracion_MicroondaPorId($registro->MO); 
                $cotizacion_existente=$this->cotizaciones_model->getCotizacionPorOt_antigua($registro->N_COSTO);
                // desde aqui
                if($this->session->userdata('id'))
                {
                    if(sizeof($cotizacion_existente)==0) //SI PARA SABER QUE LA COTIZACION NO ESTE REGISTRADA
                    {                    
    //                   $ValidarProducto=$this->productos_model->getProductosPorNombre($this->input->post("producto",true));
//                        if(sizeof($ValidarProducto)==0)
//                        {
                            // NOTA: SI LLEVA MAS DE TRES COLORES LLEVA CROMALIN INDICADO POR EL SEÑOR ENRIQUE
                            // CUANDO EL CROMALIN = 0 ES NO
                            // CUANDO EL CROMALIN = -1 ES SI
                            $ot="";
                            $fecha_de_registro=$registro->FECHA;
                            $estanlosmoldes=""; 
                            if($registro->COLORES <= 3 and $registro->CROMALIN == '-1') 
                            {									   
                               $hacer_cromalin="SI";
                            }
                            if($registro->COLORES <= 3 and $registro->CROMALIN == '0') 
                            {									   
                               $hacer_cromalin="NO";
                            }
                            if($registro->CROMALIN == '0') 
                            {									   
                               $hacer_cromalin="NO";
                            }
                            if($registro->COLORES >= 4)
                            {
                               $hacer_cromalin="SI";
                            }
                            
                            if (herramientas_funciones::esRut($registro->RUT)!=false)
                            {		
                                // inicio de busqueda de cliente         
                                $cliente=$this->clientes_model->getValidarRut(str_replace("--", "-", $registro->RUT));
//                                $cliente=$this->migracion_model->getClientePorId(str_replace("?", "Ñ", $registro->NOMBRE)); 
                                if(sizeof($cliente)>0)
                                {
                                    $id_cliente=$cliente->id; 
                                }
                                else
                                {
                                    $cliente=$this->migracion_model->getClientePorId(str_replace("?", "Ñ", $registro->NOMBRE)); 
                                    if(sizeof($cliente)>0)
                                    {
                                        $id_cliente="92384000-1";  
                                    }                                    
                                }
                                $producto=$registro->TRABAJO;
                            }
                            else {
                                $producto=$registro->TRABAJO.", <strong>CLIENTE REFERIDO:</strong> ".$registro->NOMBRE;                                
                                $id_cliente="6201";                                 
                            }
                            
                            $ot_antigua=$registro->N_COSTO;                            
                            
                            if ($registro->CARTUCAN=='-1')
                                $datos_tecnicos="Microcorrugado";// materialidad    
                            elseif ($registro->CARTUCAN=='0')
                                $datos_tecnicos="Microcorrugado";// materialidad                                
                            elseif ($registro->CARTUCAN=='1')  
                                $datos_tecnicos="Corrugado";// materialidad
                            elseif ($registro->CARTUCAN=='2')
                                $datos_tecnicos="Onda a la Vista (MicroCorrugado/MicroCorrugado)";// materialidad
                            elseif ($registro->CARTUCAN=='3')
                                $datos_tecnicos="Corrugado";// materialidad                            
                            elseif ($registro->CARTUCAN=='4')   
                                $datos_tecnicos="Sólo Cartulina";// materialidad    
                            elseif ($registro->CARTUCAN=='5')
                                $datos_tecnicos="Cartulina-cartulina";// materialidad                            
                            elseif ($registro->CARTUCAN=='6')   
                               $datos_tecnicos="Tabique";// materialidad                            
                            elseif ($registro->CARTUCAN=='7')   
                               $datos_tecnicos="Publicitario";// materialidad                            
                            elseif ($registro->CARTUCAN=='8')   
                                $datos_tecnicos="Onda a la Vista (MicroCorrugado/MicroCorrugado)";// materialidad   
                            elseif ($registro->CARTUCAN=='9')   
                                $datos_tecnicos="serv-impres";// materialidad                               
                            else
                                $datos_tecnicos="Indefinido";// materialidad

//                            exit($registro->CARTUCAN."-----".$datos_tecnicos."ygtuftf");
                            // inicio de busqueda de placa
                            $color="";                              
                            $encontrado_cafe = strpos($registro->PLACA, "CAF?");
                            $encontrado_blanco = strpos($registro->PLACA, "BLANCO");  
                            
                            if ($encontrado_cafe === True ) 
                                $color="Cafe";
                            elseif ($encontrado_blanco === True ) 
                                $color="Blanco";   
                            
                            $placa=$this->migracion_model->getPlacaPorId($registro->GR_PLACA,$color);                                 
                            $materialidad_1=$placa->nombre;
                            
                            // inicio de busqueda de onda                            
                            $onda=$this->migracion_model->getOndaPorId($registro->MO,$registro_microondas->COLORREVERSO); 
                            $materialidad_2=$onda->onda;
                            
                            // inicio de busqueda de liner                            
                            $liner=$this->migracion_model->getLinerPorId($registro->MO,$registro_microondas->COLORREVERSO); 
                            $materialidad_3=$liner->liner;//liner
                            
                            $materialidad_4="No Aplica";// no aplica en este caso
                            $repeticion_molde=$registro->REPIT;
                            $recuerdo=$registro->RECUERDO;
                            
                          //  exit(print_r($onda));
                                
                            $largo = $registro->LARGO;
                            $ancho = $registro->ANCHO;
                            $cantidad_piezas_pliego=$registro->PIEZASUNIDAD;          
                            $precio_migrado=$registro->VALOR_EMPRESA; 
                            $id_antiguo=$registro->N_COSTO;                             
                            $pegado=$registro->PEGADO1;
                            $margen=$registro->MARGEN1;
                            if ($registro->CROMALINC=="1")
                               $cromalin="SI";
                            else
                               $cromalin="NO"; 
                            
                          
                            $tiraje_unidad=$registro->TIRAJEUNIDAD;
                            
                            if ($registro->BARNIZ=="0")//-1 si, 0 es no
                                $lleva_barniz="NO";
                            else $lleva_barniz="SI";                            

                            if ($registro->BAENIZRE=="1")//1 si, 0 es no 
                                $lleva_reserva_barniz="NO";
                            else $lleva_reserva_barniz="SI";                                 
                    

                            $cantidad = $registro->CANTIDAD;                        
                            $unidad_pliego = $registro->UNIDADPLIEGO;    
                            $vendedor = 7;// oficina
                            $hacer_troquel="";
                            $lleva_troquelado="";
                            $colores=$registro->COLORES;
                            $medidas_aleta = explode("X", strtoupper($registro->TC));
                            
                            // inicio de busqueda de forma de pago         
                            $formapago=$this->migracion_model->getFormaPagoPorId(str_replace("?", "Ñ", $registro->FORMAPAGO)); 
                            $id_forma_pago=$formapago->id;      
                            

                            
                            // inicio de busqueda de los moldes
                            $numeromolde="0";
                            $condicion="Nuevo";                                                 
                            $estanlosmoldes="NO"; 
                            $nombremolde="";
//                            $repeticion_molde="NO";

                            if ($conn_access = odbc_connect ( "bdacces2", "", "")){ 
                                
                                //22/05/2017
                                $ssql = "select [RESPALDO HC].COLORESQ,[RESPALDO HC].BARNIZQ,[RESPALDO HC].BARNIZREQ,[RESPALDO HC].MONTAJE, [RESPALDO HC].FINALQ, [RESPALDO HC].MARGEN1Q, [RESPALDO HC].PEGADO1Q, [RESPALDO HC].UNIDADPLIEGOQ, [RESPALDO HC].OPN as OT, [RESPALDO HC].Cproducto as CODIGO_PRODUCTO, [RESPALDO HC].OC, [RESPALDO HC].[VALOR EMPRESAQ] AS PRECIO, [RESPALDO HC].FECHAQ, [RESPALDO HC].[N COSTOQ] AS N_COSTO, [RESPALDO HC].REPITQ, [RESPALDO HC].CODMOLDE AS NROMOLDE, [MAESTRO MOLDE].NOMBREMOLDE, [MAESTRO MOLDE].TAMANOMOLDE,  [MAESTRO MOLDE].TP, [MAESTRO MOLDE].ABOBINA, [MAESTRO MOLDE].LBOBINA, [MAESTRO MOLDE].FECHAMOLDE, [MAESTRO MOLDE].NOMBRECLIENTE from [RESPALDO HC],[MAESTRO MOLDE]  WHERE [RESPALDO HC].CODMOLDE=[MAESTRO MOLDE].NMOLDE  AND [RESPALDO HC].[N COSTOQ]=".$registro->N_COSTO;
                                if($rs_access = odbc_exec ($conn_access, $ssql)){ 
                                $i=0;
//                                exit($ssql);
                                while ($fila = odbc_fetch_object($rs_access)){ 
                                        $arreglo=$this->migracion_model->getMigracionPorId($fila->COSTO);
                                        if ($arreglo->n_costo=='')
                                        {     
                                            $ot=$fila->OT;                                             
                                            // da prioridad sobre la tabla hoja de costo
                                            if ($fila->FINALQ=='1')  
                                                $datos_tecnicos="Corrugado";// materialidad
                                            elseif ($fila->FINALQ=='2')
                                                $datos_tecnicos="Microcorrugado";// materialidad
                                            elseif ($fila->FINALQ=='3')
                                                $datos_tecnicos="Sólo Cartulina";// materialidad                            
                                            elseif ($fila->FINALQ=='4') 
                                            {
                                                $datos_tecnicos="Cartulina-cartulina";// materialidad    
                                                $materialidad_2=$materialidad_3;
                                                $materialidad_3="";
                                            }
                                            elseif ($fila->FINALQ=='5')
                                                $datos_tecnicos="Indefinido";// materialidad                            
                                            elseif ($fila->FINALQ=='6')   
                                               $datos_tecnicos="Publicitario";// materialidad                            
                                            elseif ($fila->FINALQ=='7')   
                                               $datos_tecnicos="Tabique";// materialidad                            
                                            else
                                                $datos_tecnicos="Indefinido";// materialidad                                            
                                            
                                            $fecha_de_registro= substr($fila->FECHAQ, 0, 10); 
                                            $numeromolde=$fila->NROMOLDE;
                                            if ($numeromolde>2) // molde nro de id 1 es que no tiene, 2 es otro que no funciona
                                            {
    //                                            exit($numeromolde);
                                                // ojo revisar!!
                                                if ($numeromolde==0){
                                                    $estanlosmoldes="NO LLEVA";
                                                    $condicion="Nuevo";   
                                                }
                                                elseif ($numeromolde>2){
                                                    $molde_creado=$this->moldes_model->getMoldesPorId($numeromolde);
                                                    if ($molde_creado->tipo=="Normal")
                                                        $estanlosmoldes="MOLDE REGISTRADOS DEL CLIENTE";
                                                    else
                                                        $estanlosmoldes="MOLDE GENERICO";
                                                    $condicion="Repetición Sin Cambios";
                                                    $hacer_troquel="NO";
                                                    $lleva_troquelado="SI";
                                                } else {
                                                    $condicion="Nuevo";                                                 
                                                    $estanlosmoldes="NO";
                                                }
                                            }
                                            else {
                                                $estanlosmoldes="NO LLEVA";
                                                $condicion="Nuevo";  
                                                $numeromolde="";
                                                $hacer_troquel="NO";
                                                $lleva_troquelado="NO";                                                 
                                            }
                                            //================================== acoplarlas a cotizaciones
                                            $montaje=$fila->MONTAJE;
                                            $unidad_pliego = (int)$fila->UNIDADPLIEGOQ;  
                                            if ($fila->BARNIZQ=="0")//-1 si, 0 es no
                                                $lleva_barniz="NO";
                                            else $lleva_barniz="SI";                            

                                            if ($fila->BAENIZREQ=="1")//1 si, 0 es no 
                                                $lleva_reserva_barniz="NO";
                                            else $lleva_reserva_barniz="SI";   
                                            $colores=$fila->COLORESQ;
                                        
                                            //==================================
                                            
                                            $nombremolde=$fila->NOMBREMOLDE;
                                            $tamaño_caja_molde=$fila->TAMANOMOLDE;
                                            $ancho_bobina_molde=$fila->ABOBINA;
                                            $largo_bobina_molde=$fila->LBOBINA; 

                                            $codigo_producto_migrado=$fila->CODIGO_PRODUCTO;
                                            $orden_de_compra_migrada=$fila->OC;


                                            $pliego=false;
                                            $pliego = stripos($fila->TP, "=");
                                            if ($pliego==true)
                                            {
                                                $numero_pliego=substr($fila->TP, ($pliego+1), 4);  // bcd
                                            }
                                            else {
                                                $numero_pliego=0;
                                            }                                            
                                            $fecha_molde=$fila->FECHAMOLDE;  
                                            $nombre_cliente_molde=$fila->NOMBRECLIENTE;
                                        }
                                        $i++;                    
                                    } 
                                    }else{ 
                                    echo "Error al ejecutar la sentencia SQL"; 
                                    } 
                            } else{ 
                                    echo "Error en la conexión con la base de datos del sistema "; 
                            }
                            odbc_close($conn_access);  

                            // Trabajos externos
                            if ($conn_access = odbc_connect ( "bdacces2", "", "")){ 
                                //22/05/2017
                                $ssql = "select *  from  EXTERNOS, RBARNIZ WHERE EXTERNOS.TRABAJO=RBARNIZ.CODIGO AND EXTERNOS.NROHC=".$ot_antigua;
                                $i=0;
                                if($rs_access = odbc_exec ($conn_access, $ssql)){ 
                                $i=0;
                                while ($fila = odbc_fetch_object($rs_access)){ 
                                       $trabajos_externo[$i]=$fila->TRABAJO;
                                       $i++;                    
                                    } 
                                    }else{ 
                                    echo "Error al ejecutar la sentencia SQL"; 
                                    } 
                            } else{ 
                                    echo "Error en la conexión con la base de datos del sistema "; 
                            }
                            odbc_close($conn_access);   
                            
                            $data=array
                            (
                               "id_usuario"=>$this->session->userdata('id'),
                               "id_cliente"=>$id_cliente,
                               "nombre_cliente"=>'no aplica',
                               "id_vendedor"=>$vendedor,
                               "condicion_del_producto"=>$condicion,
                               "producto"=>$producto,
                               "cantidad_1"=>$cantidad,
                               "precio_1"=>100,
                               "precio_2"=>100,
                               "precio_3"=>100,
                               "precio_4"=>100,
                               "materialidad_datos_tecnicos"=>$datos_tecnicos,
                               "materialidad_1"=>$materialidad_1,
                               "materialidad_2"=>$materialidad_2,
                               "materialidad_3"=>$materialidad_3,
                               "materialidad_4"=>$materialidad_4,
                               "impresion_colores"=>$colores,
                               "impresion_hacer_cromalin"=>$cromalin,
                               "forma_pago"=>$id_forma_pago,
                               "fecha"=>$fecha_de_registro,
                               "estado"=>'0',
                               "id_antiguo"=>'0',
                               "estan_los_moldes"=>$estanlosmoldes,
                               "numero_molde"=>$numeromolde,
                               "lleva_barniz"=>$lleva_barniz,
                               "reserva_barniz"=>$lleva_reserva_barniz,
                               "id_antiguo"=>$id_antiguo,     
                               "precio_migrado"=>$precio_migrado,        
                                //22/05/2017
                               "orden_de_compra_migrada"=>$orden_de_compra_migrada,
                               "ot_antigua"=>$ot_antigua,
                               "pegado_migrado"=>$pegado,
                               "margen_migrado"=>$margen,  
                               "montaje_pieza_especial"=>$montaje,
                               "cliente_entrega_6"=>"Nada",
                               "ot_migrada"=>$ot,
                            );
                            $guardar=$this->cotizaciones_model->insertar($data);  
                            $id_cotizaciom=$guardar;
                        // revision ingenieria
                        $quien=$this->session->userdata('id');
                        $cuando=date("Y-m-d");
							   

                          if ($medidas_aleta[0]=="") $medidas_aleta[0]=0;
                          if ($medidas_aleta[1]=="") $medidas_aleta[1]=0;
                          if ($medidas_aleta[2]=="") $medidas_aleta[2]=0;
                          if ($medidas_aleta[3]=="") $medidas_aleta[3]=0;
                          if ($medidas_aleta[4]=="") $medidas_aleta[4]=0;   
                          $estan_los_moldes="NO";
                          $molde=8149;
                         
                        // ingenieria  
                        $data=array
                        (
                            "id_usuario"=>$this->session->userdata('id'),
                            "id_cotizacion"=>$id_cotizaciom,
                            "producto"=>$producto,
                            "medidas_de_la_caja"=>$medidas_aleta[0],
                            "medidas_de_la_caja_2"=>$medidas_aleta[1],
                            "medidas_de_la_caja_3"=>$medidas_aleta[2],
                            "medidas_de_la_caja_4"=>$medidas_aleta[3],
                            "estado"=>0,                            
//                            "aleta_pegado"=>$medidas_aleta[0],
//                            "largo_1"=>$medidas_aleta[1],                            
//                            "ancho_1"=>$medidas_aleta[2],
//                            "ancho_2"=>$medidas_aleta[3],
//                            "largo_2"=>$medidas_aleta[4],    
//                            "suma_largo_aleta"=>$medidas_aleta[0]+$medidas_aleta[1]+$medidas_aleta[2]+$medidas_aleta[3]+$medidas_aleta[4],                            
                            "unidades_por_pliego"=>$unidad_pliego,
//                            "hacer_troquel"=>$this->input->post('hacer_troquel',true),
//                            "lleva_troquelado"=>$this->input->post('lleva_troquelado',true),
                            "piezas_totales_en_el_pliego"=>$cantidad_piezas_pliego,
//                            "metros_de_cuchillo"=>$this->input->post('metros_de_cuchillo',true),
                            "tamano_a_imprimir_1"=>$ancho,
                            "tamano_a_imprimir_2"=>$largo,
//                            "tamano_cuchillo_1"=>$arreglo_cuchillos_molde[0],
//                            "tamano_cuchillo_2"=>$arreglo_cuchillos_molde[1],
                            "tamano_cuchillo_1"=>0,
                            "tamano_cuchillo_2"=>0,                            
                            "materialidad_datos_tecnicos"=>$datos_tecnicos,
//                            "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),                            
                            "materialidad_1"=>$materialidad_1,
                            "materialidad_2"=>$materialidad_2,
                            "materialidad_3"=>$materialidad_3,
                            "materialidad_4"=>$materialidad_4,
                            "hacer_troquel"=>$hacer_troquel,
                            "lleva_troquelado"=>$lleva_troquelado,                           
//                            "piezas_adicionales"=>$this->input->post("piezas_adicionales",true),
//                            "piezas_adicionales2"=>$this->input->post("piezas_adicionales2",true),
//                            "piezas_adicionales3"=>$this->input->post("piezas_adicionales3",true),
//                            "detalle_piezas_adicionales"=>$this->input->post("detalle_piezas_adicionales",true),
//                            "comentario_piezas_adicionales"=>$this->input->post("comentario_piezas_adicionales",true),
//                            "tipo_de_pegado"=>$this->input->post("tipo_de_pegado1",true),
//                            "lineas_pegado"=>$this->input->post("lineas_pegado",true),
//                            "detalle_lineas_pegado"=>$this->input->post("detalle_lineas_pegado",true),
//                            "es_una_maquina"=>$this->input->post("es_una_maquina",true),
//                            "impresion_compartida"=>$this->input->post("impresion_compartida",true),
//                            "contiene_otras_cotizaciones"=>$this->input->post("contiene_otras_cotizaciones",true),
//                            "numero_cotizacion"=>$this->input->post("numero_cotizacion",true),
                            "fecha"=>$fecha_de_registro,
//                            "trabajos_adicionales"=>$this->input->post("trabajos_adicionales",true),
//                            "trabajos_adicionales_glosa"=>$this->input->post("trabajos_adicionales_glosa",true),
//                            "estado"=>$this->input->post("estado",true),
                            "estan_los_moldes"=>$estanlosmoldes,
                            "numero_molde"=>$numeromolde,
                            "nombre_molde"=>$nombremolde,
                            "archivo"=>"",
//                            "id_adhesivo"=>$this->input->post("adhesivo",true),
//                            "quien"=>$quien,
//                            "cuando"=>$cuando,
//                            "solo_pegado"=>$this->input->post("solo_pegado",true),
//                            "tamano_pieza_a_empaquetar_ancho"=>$this->input->post("tamano_pieza_a_empaquetar_ancho",true),
//                            "tamano_pieza_a_empaquetar_largo"=>$this->input->post("tamano_pieza_a_empaquetar_largo",true),
//                            "glosa"=>$this->input->post("glosa",true),
//                            "pegado"=>$this->input->post("pegado",true),
//                            "doblado"=>$this->input->post("doblado",true),
//                            "empaquetado"=>$this->input->post("empaquetado",true),
//                            "tipo_pegado"=>$this->input->post("tipo_pegado",true),
//                            "pegado_puntos"=>$this->input->post("pegado_puntos",true),
//                            "pegado_cantidad_puntos"=>$this->input->post("pegado_cantidad_puntos",true),
//                            "tipo_fondo"=>$this->input->post("tipo_fondo",true),
//                            "lleva_aletas"=>$this->input->post("lleva_aletas",true),
//                            "total_aplicaciones_adhesivo"=>$this->input->post("total_aplicaciones_adhesivo",true),
//                            "id_molde"=>1,
//                            "largo_total_de_la_caja"=>$this->input->post("largo_total_de_la_caja",true),
//                            "cantidad_ordenes"=>"NO",
//                            "nombre_molde"=>$this->input->post("nombre_molde",true),
//                            "troquel_por_atras"=>$this->input->post("troquel_por_atras",true),
//                            "lleva_mica"=>$this->input->post("lleva_mica",true),
//                            "largo_mica"=>$this->input->post("largo_mica",true),
//                            "ancho_mica"=>$this->input->post("ancho_mica",true),                            
                            );
//                        exit(print_r($data));
                            $guardar=$this->cotizaciones_model->insertarIngenieria($data); 
                            
                    // fotomecanica

                       $data=array
                            (
                                "id_usuario"=>$this->session->userdata('id'),
                                "id_cotizacion"=>$id_cotizaciom,
                                "condicion_del_producto"=>$condicion,
//                                "estan_las_peliculas"=>$this->input->post("estan_las_peliculas",true),
                                "estan_los_moldes"=>$estanlosmoldes,
                                "numero_molde"=>$numeromolde,
                                "colores"=>$colores,
//                                "colores_metalicos"=>$this->input->post("colores_metalicos",true),
//                                "acabado_impresion_1"=>$this->input->post("acabado_impresion_1",true),
//                                "acabado_impresion_2"=>$this->input->post("acabado_impresion_2",true),
//                                "acabado_impresion_3"=>$this->input->post("acabado_impresion_3",true),
                                "acabado_impresion_4"=>$trabajos_externo[0],
                                "acabado_impresion_5"=>$trabajos_externo[1],
                                "acabado_impresion_6"=>$trabajos_externo[2],
                                "hacer_troquel"=>$hacer_troquel,
                                "lleva_troquelado"=>$lleva_troquelado,                            
                                "fot_lleva_barniz"=>$lleva_barniz,
                                "fot_reserva_barniz"=>$lleva_reserva_barniz,
                                "tamano_caja_corrugado"=>$this->input->post("tamano_caja_corrugado",true),
    //                            "comentarios"=>$this->input->post("obs",true),
                                "fecha"=>$fecha_de_registro,
//                                "desctec"=>$this->input->post("desctec",true),
                                "archivo"=>"",
                                "materialidad_datos_tecnicos"=>$datos_tecnicos,
    //                            "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),                            
                                "materialidad_1"=>$materialidad_1,
                                "materialidad_2"=>$materialidad_2,
                                "materialidad_3"=>$materialidad_3,
                                "materialidad_4"=>$materialidad_4,
                                "estado"=>0,
                                "procesos_especiales_folia"=>"NO",
                                "procesos_especiales_folia_2"=>"NO",
                                "procesos_especiales_folia_2_valor"=>"No Lleva",
                                "procesos_especiales_folia_3"=>"NO",
                                "procesos_especiales_folia_3_valor"=>"No Lleva",
                                "procesos_especiales_cuno"=>"NO",
                                "procesos_especiales_cuno_2"=>"NO",                             
                                "procesos_especiales_folia_valor"=>"No Lleva",                               
                                "procesos_especiales_cuno_valor"=>"No Lleva",
                                "procesos_especiales_cuno_2_valor"=>"No Lleva",
//                                "quien"=>$quien,
//                                "cuando"=>$cuando,
//                                "glosa"=>$this->input->post("glosa",true),
//                                "impresion"=>$this->input->post("impresion",true),
//                                "lleva_fondo_negro"=>$this->input->post("lleva_fondo_negro",true),
//                                "troquel_por_atras"=>$this->input->post("troquel_por_atras",true),
//                                "hacer_troquel"=>$this->input->post('hacer_troquel',true),
//                                "lleva_troquelado"=>$this->input->post('lleva_troquelado',true),
//                                "fondo_otro_color"=>$this->input->post('fondo_otro_color',true),
                                "input_variable_externo_1"=>0,
                                "input_variable_externo_2"=>0,
                                "input_variable_externo_3"=>0,                                   
                                "input_variable_externo_4"=>0,
                                "input_variable_externo_5"=>0,
                                "input_variable_externo_6"=>0,   
                                "folia1_proceso_seletec"=>0,
                                "folia2_proceso_seletec"=>0,
                                "folia3_proceso_seletec"=>0,                                   
                                "cuno1_proceso_seletec"=>0,
                                "cuno2_proceso_seletec"=>0,
                                "guardar_con_comentarios"=>$recuerdo,
                             );
                             $guardar=$this->cotizaciones_model->insertarFotomecanica($data);         
                             

                             // creacion o actualizacion de moldes
                             $molde_creado=array();
                             if ($numeromolde!='')
                                $molde_creado=$this->moldes_model->getMoldesPorId($numeromolde);
                             if(sizeof($molde_creado) == 0)
                             {
                                 if($numeromolde>2) // a partir del 2 se crean son validos los moldes
                                 {  
                                    // moldes cuando es nuevo se crea uno normal
                                     $data=array
                                     (
                                        "nombre"=>$nombremolde,
                                        "numero"=>$numeromolde,
                                        "pliegos_molde"=>$numero_pliego,
                                        "nombrecliente"=>$id_cliente,
                                        "tamano_caja"=>$tamaño_caja_molde,
                                        "cuchillocuchillo"=>0,
                                        "cuchillocuchillo2"=>0,
                                        "ancho_bobina"=>$ancho_bobina_molde,
                                        "largo_bobina"=>$largo_bobina_molde,
                                        "fecha"=>$fecha_molde,
                                        "nombrecliente2"=>$nombre_cliente_molde,
                                        "tipo"=>"Normal",
                                     );                                       
                                    $this->db->insert("moldes_grau",$data);  
                                 }
                             }
//                             else
//                             {
//                                 // le asignamos el cliente 2 al molde ya que pertenecia a otro
//                                $data_update_moldes=array
//                                (
//                                   "nombrecliente2"=>$id_cliente,
//                                );  
//                                // cuando el molde existe se crea uno nuevo Tipo generico y se actualiza el viejo
//                                $guardar=$this->moldes_model->update($data_update_moldes,$molde_creado->id);
                                // creamos el molde tipo generico
//                                $maximo_molde=$this->moldes_model->getUltimoMoldeGuardado2();
////                                exit(print_r($maximo_molde));
//                                $data=array
//                                 (
//                                    "nombre"=>$nombremolde,
//                                    "numero"=>$maximo_molde[0]->maximo,
//                                    "pliegos_molde"=>$numero_pliego,
//                                    "nombrecliente"=>$id_cliente,
//                                    "tamano_caja"=>$tamaño_caja_molde,
//                                    "cuchillocuchillo"=>$arreglo_cuchillos_molde[0],
//                                    "cuchillocuchillo2"=>$arreglo_cuchillos_molde[1],
//                                    "ancho_bobina"=>$ancho_bobina_molde,
//                                    "largo_bobina"=>$largo_bobina_molde,
//                                    "fecha"=>$fecha_molde,
//                                    "nombrecliente2"=>$molde_creado->nombrecliente2,
//                                    "tipo"=>"Genérico",
//                                 );                                       
//                                $this->db->insert("moldes_grau",$data);    
//                                $data_actualizar_cotizacion=array
//                                (
//                                   "estan_los_moldes"=>'MOLDE GENERICO',
//                                   "numero_molde"=>$maximo_molde[0]->maximo,
//                                );
//                                  $guardar=$this->cotizaciones_model->update($data_actualizar_cotizacion,$id_cotizaciom);                                
//                                  $guardar=$this->cotizaciones_model->update_ingenieria($data_actualizar_cotizacion,$id_cotizaciom); 
//                                  $guardar=$this->cotizaciones_model->update_fotomecanica($data_actualizar_cotizacion,$id_cotizaciom);                                 
//                                
//                             }
                             // productos
                            if ($numeromolde>2){ // a partir del 2 se crean son validos los moldes
                                         $data=array
                                         (
                                            "id_cotizacion"=>$id_cotizaciom,
                                            "codigo"=>$codigo_producto_migrado,
                                            "nombre"=>$nombremolde,
                                            "tipo"=>1,
                                            "quien"=>2,
                                            "cuando"=>$fecha_molde,
                                         );

                                         $producto_creado=array();
                                         if ($numeromolde!='')
                                            $producto_creado=$this->productos_model->getProductosPorCliente($codigo_producto_migrado);
                                         if(sizeof($producto_creado) == 0) 
                                             $this->db->insert("productos",$data);  

                                         $producto_creado=$this->productos_model->getProductosPorCotizacion($id_cotizaciom);
                                         $data_producto_creado=array
                                         (
                                            "producto_id"=>$producto_creado->id,
                                         );
            //                             $this->db->insert("cotizaciones",$data);  
                                         $guardar=$this->cotizaciones_model->update($data_producto_creado,$id_cotizaciom);
                            }
                             $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.'.  $checks);
                             redirect(base_url().'cotizaciones',  301);  
                    }
                }else
                    {
                        redirect(base_url().'usuarios/login',  301);
                    }
                }                
            }                

        
    }
    
    
    public function reactualizar_migracion()
	{
        $arreglo = "";
            if ($conn_access = odbc_connect ( "bdacces2", "", "")){ 
                $ssql = "select [GR/PLACAQ] AS GR_PLACAQ, [COSTO PLACAQ] AS COSTO_PLACAQ, [COSTO ONDAQ] AS COSTO_ONDAQ, [GR/ONDAQ] AS GR_ONDAQ, [VALOR EMPRESAQ] AS VALOR_EMPRESA, [N COSTOQ] AS COSTO, [TIPO TRABAJOQ] AS TIPO_TRABAJO, [GR/PLACAQ] AS GR_PLACA, * from [RESPALDO HC]";
                if($rs_access = odbc_exec ($conn_access, $ssql)){ 
                $fila = odbc_fetch_object($rs_access);
                $i=0;
                //NEBD = NO EXISTE EN TABLA
                while ($fila = odbc_fetch_object($rs_access)){
                        if ($fila->COSTO>0){
                            $arreglo=$this->migracion_model->getMigracionPorCodigo2($fila->COSTO);
                            if ($arreglo==0)
                            {         
                                $data=array
                                (                    
                                  "N_COSTO"=>$fila->COSTO,                            
                                  "TRABAJO"=>$fila->TRABAJO,                            
                                  "FECHA"=>$fila->FECHAQ,                         
                                  "COSTEO"=>$fila->COSTEOQ,                            
                                  "NOMBRE"=>$fila->NOMBREQ,                            
                                  "VEND"=>$fila->VENDQ,                            
                                  "RUT"=>$fila->RUTQQ,                            
                                  "CANTIDAD"=>$fila->CANTIDADQ,    
                                  "CANTIDAD1"=>$fila->CANTIDAD1Q,                            
                                  "CANTIDAD2"=>$fila->CANTIDAD2Q,                            
                                  "CANTIDAD3"=>$fila->CANTIDAD3Q,                            
                                  "FAX"=>$fila->FAXQ,                            
                                  "DIRECCION"=>$fila->DIRECCIONQ,                            
                                  "TELEFONO"=>$fila->TELEFONOQ,                            
                                  "COMUNA"=>$fila->COMUNAQ,    
                                  "CIUDAD"=>$fila->CIUDADQ,                            
                                  "AT"=>$fila->ATQ,                            
                                  "TIPO_TRABAJO"=>$fila->TIPO_TRABAJOQ,                           
                                  "ANCHO"=>$fila->ANCHOQ,                            
                                  "LARGO"=>$fila->LARGOQ,                            
                                  "COLORES"=>$fila->COLORESQ,                            
                                  "PLACA"=>$fila->PLACAQ,                            
                                  "COSTO_PLACA"=>$fila->COSTO_PLACAQ,    
                                  "GR_PLACA"=>$fila->GR_PLACAQ,                            
                                  "UNIDADPLIEGO"=>$fila->UNIDADPLIEGOQ,                            
                                  "PIEZASUNIDAD"=>$fila->PIEZASUNIDADQ,                            
                                  "MO"=>$fila->MOQ,                            
                                  "COSTO_ONDA"=>$fila->COSTO_ONDAQ,                            
                                  "GR_ONDA"=>$fila->GR_ONDAQ,                            
                                  "VALOR7"=>$fila->VALOR7Q,                              
                                  "MOLDE1"=>$fila->MOLDE1Q,                           
                                  "CANMOLDE"=>$fila->CANMOLDEQ,                            
                                  "EMPLA1"=>$fila->EMPLA1Q,                            
                                  "PEGADO1"=>$fila->PEGADO1Q,                            
                                  "VARIOS10"=>$fila->VARIOS10Q,                            
                                  "VALOR24"=>$fila->VALOR24Q,    
                                  "VALOR24IDEM"=>$fila->VALOR24IDEMQ,                            
                                  "VALOR_EMPRESA"=>$fila->VALOR_EMPRESA,                            
                                  "OBSERVACIONES"=>"NEBD",                            
                                  "PLANCHAMETAL"=>$fila->PLANCHAMETALQ,                            
                                  "COPY"=>$fila->COPYQ,                            
                                  "MOLDE"=>$fila->MOLDEQ,                            
                                  "PEGADODESCRI"=>$fila->PEGADODESCRIQ,   
                                  "CODPEGADO"=>$fila->CODPEGADOQ,                           
                                  "MULVENT"=>$fila->MULVENTQ,                            
                                  "MULTADICIONAL"=>$fila->MULTADICIONALQ,                            
                                  "MOLDERE"=>$fila->MOLDEREQ,                            
                                  "REPIT"=>$fila->REPITQ,                            
                                  "FINAL"=>$fila->FINALQ,    
                                  "IDEMF1F"=>$fila->IDEMF1FQ,                            
                                  "IDEMF2F"=>$fila->IDEMF2FQ,                            
                                  "IDEMF3F"=>$fila->IDEMF3FQ,                            
                                  "TC"=>$fila->TCQ,                            
                                  "VE1"=>$fila->VE1Q,                            
                                  "VE2"=>$fila->VE2Q,                            
                                  "VE3"=>$fila->VE3Q,                              
                                  "SEDA"=>$fila->SEDAQ,                           
                                  "IMPRESION"=>$fila->IMPRESIONQ,                            
                                  "CLASECLIENTE"=>$fila->CLASECLIENTEQ,                            
                                  "MARGEN1"=>$fila->MARGEN1Q,                            
                                  "TERMO"=>$fila->TERMOQ,                            
                                  "LUGARIMPRESION"=>$fila->LUGARIMPRESIONQ,    
                                  "TVCI"=>$fila->TVCIQ,                            
                                  "TVCIIDEM"=>$fila->TVCIIDEMQ,                            
                                  "V24"=>$fila->V24Q,                            
                                  "V24IDEM"=>$fila->V24IDEMQ,                            
                                  "V241"=>$fila->V241Q,                            
                                  "V24IDEM1"=>$fila->V24IDEM1Q,                            
                                  "T1"=>$fila->T1Q,                              
                                  "TU"=>$fila->TUQ,                           
                                  "TIRAJEUNIDAD"=>$fila->TIRAJEUNIDADQ,                            
                                  "A"=>$fila->AQ,                            
                                  "B"=>$fila->BQ,                            
                                  "C"=>$fila->CQ,                            
                                  "D"=>$fila->DQ,    
                                  "E"=>$fila->EQ,                            
                                  "F"=>$fila->FQ,                            
                                  "S"=>$fila->SQ,                            
                                  "FORMAPAGO"=>$fila->FORMAPAGOQ,                            
                                  "PE"=>$fila->PEQ,                            
                                  "FE"=>$fila->FEQ,                            
                                  "TODOS"=>$fila->TODOSQ,                              
                                  "COTEOP"=>$fila->COTEOPQ,                            
                                  "EMPLACADOOP"=>$fila->EMPLACADOOPQ,                            
                                  "TROQUELADOOP"=>$fila->TROQUELADOOPQ,    
                                  "DESGAJADOOP"=>$fila->DESGAJADOOPQ,                            
                                  "PEGADOOP"=>$fila->PEGADOOPQ,                            
                                  "TODOSRE"=>$fila->TODOSREQ,                            
                                  "EMPLACADORE"=>$fila->EMPLACADOREQ,                            
                                  "TROQUELADORE"=>$fila->TROQUELADOREQ,                            
                                  "DESGAJADORE"=>$fila->DESGAJADOREQ,                            
                                  "PEGADORE"=>$fila->PEGADOREQ,                             
                                  "TERMOOP"=>$fila->TERMOOPQ,                            
                                  "MOLDEOP"=>$fila->MOLDEOPQ,                            
                                  "PREPRINT"=>$fila->PREPRINTQ,    
                                  "PREPRINTRE"=>$fila->PREPRINTREQ,                            
                                  "BARNIZ"=>$fila->BARNIZQ,                            
                                  "BARNIZRE"=>$fila->BARNIZREQ,                            
                                  "Ñ"=>$fila->ÑQ,                            
                                  "DIAS"=>$fila->DIASQ,                            
                                  "VALORUNI"=>$fila->VALORUNIQ,                            
                                  "CROMALIN"=>$fila->CROMALINQ,                             
                                  "CROMALINC"=>$fila->CROMALINCQ,                            
                                  "CROMALINV"=>$fila->CROMALINVQ,                            
                                  "NC"=>"NEBD",    
                                  "PNC"=>"NEBD",                          
                                  "NC1"=>$fila->NC1Q,                            
                                  "PNC1"=>$fila->PNC1Q,                            
                                  "NC2"=>$fila->NC2Q,                            
                                  "PNC2"=>$fila->PNC2Q,                            
                                  "VALORF"=>$fila->VALORFQ,                            
                                  "T_IMP"=>$fila->T_IMPQ,   
                                  "T_PREIMPRESIO"=>$fila->T_PREIMPRESIOQ,                            
                                  "CARTUBAR"=>$fila->CARTUBARQ,                            
                                  "CARTUCAN"=>$fila->CARTUCANQ,    
                                  "TRASPA"=>$fila->TRASPAQ,                            
                                  "ESTADO2"=>$fila->ESTADO2Q,                            
                                  "RECUERDO"=>$fila->RECUERDOQ,                            
                                  "ONDAVISTA"=>$fila->ONDAVISTAQ,                            
                                  //"autorizo"=>$fila->autorizo,                            
                                  "SW"=>$fila->SWQ,                            
                                  "PORCEPLACA"=>$fila->PORCEPLACAQ,                               
                                  "PORCEMICRO"=>$fila->PORCEMICROQ,                            
                                  "VBARNIZ"=>$fila->VBARNIZQ,                            
                                  "SUBVE"=>$fila->SUBVEQ,                            
                                );
                                //$guardar=$this->migracion_model->insertar($data);  
                                $arreglo_prueba[]=$data;
                            }
                            $i++; 
                        }
                    } 
                    }else{ 
                    echo "Error al ejecutar la sentencia SQL"; 
                    } 
            } else{ 
                    echo "Error en la conexión con la base de datos del sistema "; 
            }
            odbc_close($conn_access);
            echo "<pre>";
            print_r($arreglo_prueba);
            echo "</pre>";

            exit;
            $arreglo="";
            $arreglo_prueba="";
            
        if($this->session->userdata('id'))
        {
          if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
           $datos=$this->migracion_model->getMigracionAll_indexPaginacion();
           
            if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3);
            }else
            {
               $pagina=0;
            }
            $porpagina=20;
            
            $datos=$this->migracion_model->getMigracionPaginacion($pagina,$porpagina,"limit");
            $cuantos=$this->migracion_model->getMigracionPaginacion($pagina,$porpagina,"cuantos");

            $config['base_url'] = base_url().'migracion/index';
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
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                     base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            ); 
            $this->layout->view('index',compact('datos','cuantos','pagina'));            
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
        
            
    
    
    
    
    
    
    public function migrar()
	{
        $arreglo = "";
            $maximo_datos_cotizacion=$this->migracion_model->getMigracionRegistroCotizacion();
            if ($conn_access = odbc_connect ( "bdacces2", "", "")){ 
                $ssql = "select [VALOR EMPRESA] AS VALOR_EMPRESA, [N COSTO] AS COSTO, [TIPO TRABAJO] AS TIPO_TRABAJO, [GR/PLACA] AS GR_PLACA, * from [HOJA DE COSTO] where [N COSTO] > ".$maximo_datos_cotizacion->maximo." order by [N COSTO] asc ";
                if($rs_access = odbc_exec ($conn_access, $ssql)){ 
                $fila = odbc_fetch_object($rs_access);
                $i=0;
                while ($fila = odbc_fetch_object($rs_access)){ 
                        $arreglo=$this->migracion_model->getMigracionPorId($fila->COSTO);
                        if ($arreglo->n_costo=='')
                        {                    
                            $data=array
                            (                    
                              "N_COSTO"=>$fila->COSTO,                            
                              "TRABAJO"=>$fila->TRABAJO,                            
                              "FECHA"=>$fila->FECHA,                            
                              "COSTEO"=>$fila->COSTEO,                            
                              "NOMBRE"=>$fila->NOMBRE,                            
                              "VEND"=>$fila->VEND,                            
                              "RUT"=>$fila->RUT,                            
                              "CANTIDAD"=>$fila->CANTIDAD,    
                              "CANTIDAD1"=>$fila->CANTIDAD1,                            
                              "CANTIDAD2"=>$fila->CANTIDAD2,                            
                              "CANTIDAD3"=>$fila->CANTIDAD3,                            
                              "FAX"=>$fila->FAX,                            
                              "DIRECCION"=>$fila->DIRECCION,                            
                              "TELEFONO"=>$fila->TELEFONO,                            
                              "COMUNA"=>$fila->COMUNA,    
                              "CIUDAD"=>$fila->CIUDAD,                            
                              "AT"=>$fila->AT,                            
                              "TIPO_TRABAJO"=>$fila->TIPO_TRABAJO,                           
                              "ANCHO"=>$fila->ANCHO,                            
                              "LARGO"=>$fila->LARGO,                            
                              "COLORES"=>$fila->COLORES,                            
                              "PLACA"=>$fila->PLACA,                            
                              "COSTO_PLACA"=>$fila->COSTO_PLACA,    
                              "GR_PLACA"=>$fila->GR_PLACA,                            
                              "UNIDADPLIEGO"=>$fila->UNIDADPLIEGO,                            
                              "PIEZASUNIDAD"=>$fila->PIEZASUNIDAD,                            
                              "MO"=>$fila->MO,                            
                              "COSTO_ONDA"=>$fila->COSTO_ONDA,                            
                              "GR_ONDA"=>$fila->GR_ONDA,                            
                              "VALOR7"=>$fila->VALOR7,                              
                              "MOLDE1"=>$fila->MOLDE1,                           
                              "CANMOLDE"=>$fila->CANMOLDE,                            
                              "EMPLA1"=>$fila->EMPLA1,                            
                              "PEGADO1"=>$fila->PEGADO1,                            
                              "VARIOS10"=>$fila->VARIOS10,                            
                              "VALOR24"=>$fila->VALOR24,    
                              "VALOR24IDEM"=>$fila->VALOR24IDEM,                            
                              "VALOR_EMPRESA"=>$fila->VALOR_EMPRESA,                            
                              "OBSERVACIONES"=>$fila->OBSERVACIONES,                            
                              "PLANCHAMETAL"=>$fila->PLANCHAMETAL,                            
                              "COPY"=>$fila->COPY,                            
                              "MOLDE"=>$fila->MOLDE,                            
                              "PEGADODESCRI"=>$fila->PEGADODESCRI,   
                              "CODPEGADO"=>$fila->CODPEGADO,                           
                              "MULVENT"=>$fila->MULVENT,                            
                              "MULTADICIONAL"=>$fila->MULTADICIONAL,                            
                              "MOLDERE"=>$fila->MOLDERE,                            
                              "REPIT"=>$fila->REPIT,                            
                              "FINAL"=>$fila->FINAL,    
                              "IDEMF1F"=>$fila->IDEMF1F,                            
                              "IDEMF2F"=>$fila->IDEMF2F,                            
                              "IDEMF3F"=>$fila->IDEMF3F,                            
                              "TC"=>$fila->TC,                            
                              "VE1"=>$fila->VE1,                            
                              "VE2"=>$fila->VE2,                            
                              "VE3"=>$fila->VE3,                              
                              "SEDA"=>$fila->SEDA,                           
                              "IMPRESION"=>$fila->IMPRESION,                            
                              "CLASECLIENTE"=>$fila->CLASECLIENTE,                            
                              "MARGEN1"=>$fila->MARGEN1,                            
                              "TERMO"=>$fila->TERMO,                            
                              "LUGARIMPRESION"=>$fila->LUGARIMPRESION,    
                              "TVCI"=>$fila->TVCI,                            
                              "TVCIIDEM"=>$fila->TVCIIDEM,                            
                              "V24"=>$fila->V24,                            
                              "V24IDEM"=>$fila->V24IDEM,                            
                              "V241"=>$fila->V241,                            
                              "V24IDEM1"=>$fila->V24IDEM1,                            
                              "T1"=>$fila->T1,                              
                              "TU"=>$fila->TU,                           
                              "TIRAJEUNIDAD"=>$fila->TIRAJEUNIDAD,                            
                              "A"=>$fila->A,                            
                              "B"=>$fila->B,                            
                              "C"=>$fila->C,                            
                              "D"=>$fila->D,    
                              "E"=>$fila->E,                            
                              "F"=>$fila->F,                            
                              "S"=>$fila->S,                            
                              "FORMAPAGO"=>$fila->FORMAPAGO,                            
                              "PE"=>$fila->PE,                            
                              "FE"=>$fila->FE,                            
                              "TODOS"=>$fila->TODOS,                              
                              "COTEOP"=>$fila->COTEOP,                            
                              "EMPLACADOOP"=>$fila->EMPLACADOOP,                            
                              "TROQUELADOOP"=>$fila->TROQUELADOOP,    
                              "DESGAJADOOP"=>$fila->DESGAJADOOP,                            
                              "PEGADOOP"=>$fila->PEGADOOP,                            
                              "TODOSRE"=>$fila->TODOSRE,                            
                              "EMPLACADORE"=>$fila->EMPLACADORE,                            
                              "TROQUELADORE"=>$fila->TROQUELADORE,                            
                              "DESGAJADORE"=>$fila->DESGAJADORE,                            
                              "PEGADORE"=>$fila->PEGADORE,                             
                              "TERMOOP"=>$fila->TERMOOP,                            
                              "MOLDEOP"=>$fila->MOLDEOP,                            
                              "PREPRINT"=>$fila->PREPRINT,    
                              "PREPRINTRE"=>$fila->PREPRINTRE,                            
                              "BARNIZ"=>$fila->BARNIZ,                            
                              "BARNIZRE"=>$fila->BARNIZRE,                            
                              "Ñ"=>$fila->Ñ,                            
                              "DIAS"=>$fila->DIAS,                            
                              "VALORUNI"=>$fila->VALORUNI,                            
                              "CROMALIN"=>$fila->CROMALIN,                             
                              "CROMALINC"=>$fila->CROMALINC,                            
                              "CROMALINV"=>$fila->CROMALINV,                            
                              "NC"=>$fila->NC,    
                              "PNC"=>$fila->PNC,                            
                              "NC1"=>$fila->NC1,                            
                              "PNC1"=>$fila->PNC1,                            
                              "NC2"=>$fila->NC2,                            
                              "PNC2"=>$fila->PNC2,                            
                              "VALORF"=>$fila->VALORF,                            
                              "T_IMP"=>$fila->T_IMP,   
                              "T_PREIMPRESIO"=>$fila->T_PREIMPRESIO,                            
                              "CARTUBAR"=>$fila->CARTUBAR,                            
                              "CARTUCAN"=>$fila->CARTUCAN,    
                              "TRASPA"=>$fila->TRASPA,                            
                              "ESTADO2"=>$fila->ESTADO2,                            
                              "RECUERDO"=>$fila->RECUERDO,                            
                              "ONDAVISTA"=>$fila->ONDAVISTA,                            
                              "autorizo"=>$fila->autorizo,                            
                              "SW"=>$fila->SW,                            
                              "PORCEPLACA"=>$fila->PORCEPLACA,                               
                              "PORCEMICRO"=>$fila->PORCEMICRO,                            
                              "VBARNIZ"=>$fila->VBARNIZ,                            
                              "SUBVE"=>$fila->SUBVE,                            
                            );
                            $guardar=$this->migracion_model->insertar($data);  

                        }
                        $i++;                    
                    } 
                    }else{ 
                    echo "Error al ejecutar la sentencia SQL"; 
                    } 
            } else{ 
                    echo "Error en la conexión con la base de datos del sistema "; 
            }
            odbc_close($conn_access);
        if($this->session->userdata('id'))
        {
          if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
           $datos=$this->migracion_model->getMigracionAll_indexPaginacion();
           
            if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3);
            }else
            {
               $pagina=0;
            }
            $porpagina=20;
            
            $datos=$this->migracion_model->getMigracionPaginacion($pagina,$porpagina,"limit");
            $cuantos=$this->migracion_model->getMigracionPaginacion($pagina,$porpagina,"cuantos");

            $config['base_url'] = base_url().'migracion/index';
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
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                     base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            ); 
            $this->layout->view('index',compact('datos','cuantos','pagina'));            
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
        
        
    public function update_rut_ajax()
    {
        $data_update_clientes=array
        (
           "rut"=>$this->input->post("valor",true),
        );  
        $rut=$this->input->post("valor",true);
        $guardar=$this->migracion_model->update($data_update_clientes,$this->input->post("id",true));        
        $this->load->library('javascript');
        $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
        $this->layout->setLayout('template_ajax');
        $datos=$this->materiales_model->getMaterialesGramajePorLike($this->input->post("valor",true));
        $this->layout->view('ajax_update_rut',compact("rut")); 
    } 
    
    public function buscar()
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
            if ( $this->input->post() )
             {
                //$this->session->set_userdata("chelasybares");
                $this->session->set_userdata('valor', $this->input->post('buscar',true));
                $buscar= $this->session->userdata('valor');
             }else
             {
                $buscar= $this->session->userdata('valor');
             }
            $porpagina=50;
        $datos=$this->migracion_model->getMigracionSearchPaginacion($pagina,$porpagina,"limit",$buscar);
        $cuantos=$this->migracion_model->getMigracionSearchPaginacion($pagina,$porpagina,"cuantos",$buscar);
        $config['base_url'] = base_url().'migracion/buscar';
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
            //print_r($datos);
            $this->pagination->initialize($config);
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                     base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            ); 
            $this->layout->view('buscar',compact('datos','cuantos','pagina','buscar')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}    
	
        
    public function ajax_registro()
    {
        if($this->session->userdata('id'))
        {
            $this->load->library('javascript');
            $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
            $this->layout->setLayout('template_ajax');
            $arreglo="";
            if ($this->input->post("id")!='')
            {
                $id=$this->input->post("id");
                $registro=$this->migracion_model->getMigracionRegistroPorId($id); 
               // exit(print_r($registro));
                
                $registro_microondas=$this->migracion_model->getMigracion_MicroondaPorId($registro->MO); 
               // exit(print_r($registro_microondas));
                $cotizacion_existente=$this->cotizaciones_model->getCotizacionPorOt_antigua($registro->N_COSTO);
                // desde aqui
                if($this->session->userdata('id'))
                {
                    if(sizeof($cotizacion_existente)==0) //SI PARA SABER QUE LA COTIZACION NO ESTE REGISTRADA
                    {                    
    //                   $ValidarProducto=$this->productos_model->getProductosPorNombre($this->input->post("producto",true));
//                        if(sizeof($ValidarProducto)==0)
//                        {
                            // NOTA: SI LLEVA MAS DE TRES COLORES LLEVA CROMALIN INDICADO POR EL SEÑOR ENRIQUE
                            // CUANDO EL CROMALIN = 0 ES NO
                            // CUANDO EL CROMALIN = -1 ES SI
                            $ot="";
                            $fecha_de_registro=$registro->FECHA;
                            $estanlosmoldes=""; 
                            if($registro->COLORES <= 3 and $registro->CROMALIN == '-1') 
                            {									   
                               $hacer_cromalin="SI";
                            }
                            if($registro->COLORES <= 3 and $registro->CROMALIN == '0') 
                            {									   
                               $hacer_cromalin="NO";
                            }
                            if($registro->CROMALIN == '0') 
                            {									   
                               $hacer_cromalin="NO";
                            }
                            if($registro->COLORES >= 4)
                            {
                               $hacer_cromalin="SI";
                            }
                            
                            if (herramientas_funciones::esRut($registro->RUT)!=false)
                            {		
                                // inicio de busqueda de cliente         
                                $cliente=$this->clientes_model->getValidarRut(str_replace("--", "-", $registro->RUT));
//                                $cliente=$this->migracion_model->getClientePorId(str_replace("?", "Ñ", $registro->NOMBRE)); 
                                if(sizeof($cliente)>0)
                                {
                                    $id_cliente=$cliente->id; 
                                }
                                else
                                {
                                    $cliente=$this->migracion_model->getClientePorId(str_replace("?", "Ñ", $registro->NOMBRE)); 
                                    if(sizeof($cliente)>0)
                                    {
                                        $id_cliente="92384000-1";  
                                    }                                    
                                }
                                $producto=$registro->TRABAJO;
                            }
                            else {
                                $producto=$registro->TRABAJO.", <strong>CLIENTE REFERIDO:</strong> ".$registro->NOMBRE;                                
                                $id_cliente="6201";                                 
                            }
                            
                            $ot_antigua=$registro->N_COSTO;                            
                            
                            if ($registro->CARTUCAN=='-1')
                                $datos_tecnicos="Microcorrugado";// materialidad    
                            elseif ($registro->CARTUCAN=='0')
                                $datos_tecnicos="Microcorrugado";// materialidad                                
                            elseif ($registro->CARTUCAN=='1')  
                                $datos_tecnicos="Corrugado";// materialidad
                            elseif ($registro->CARTUCAN=='2')
                                $datos_tecnicos="Onda a la Vista (MicroCorrugado/MicroCorrugado)";// materialidad
                            elseif ($registro->CARTUCAN=='3')
                                $datos_tecnicos="Corrugado";// materialidad                            
                            elseif ($registro->CARTUCAN=='4')   
                                $datos_tecnicos="Sólo Cartulina";// materialidad    
                            elseif ($registro->CARTUCAN=='5')
                                $datos_tecnicos="Cartulina-cartulina";// materialidad                            
                            elseif ($registro->CARTUCAN=='6')   
                               $datos_tecnicos="Tabique";// materialidad                            
                            elseif ($registro->CARTUCAN=='7')   
                               $datos_tecnicos="Publicitario";// materialidad                            
                            elseif ($registro->CARTUCAN=='8')   
                                $datos_tecnicos="Onda a la Vista (MicroCorrugado/MicroCorrugado)";// materialidad   
                            elseif ($registro->CARTUCAN=='9')   
                                $datos_tecnicos="serv-impres";// materialidad                               
                            else
                                $datos_tecnicos="Indefinido";// materialidad

//                            exit($registro->CARTUCAN."-----".$datos_tecnicos."ygtuftf");
                            // inicio de busqueda de placa
                            $color="";                              
                            $encontrado_cafe = strpos($registro->PLACA, "CAF?");
                            $encontrado_blanco = strpos($registro->PLACA, "BLANCO");  
                            
                            if ($encontrado_cafe !== false ) 
                                $color="Cafe";
                            elseif ($encontrado_blanco !== false ) 
                                $color="Blanco";  

                            
                            
                            // inicio de busqueda de Placa
                            /*
                             * el registro placa viene de esta forma
                             * codigo/descripcion 
                             * del sistema viejo por eso hago el explode
                             */
                            $placa_arreglo = explode("/", $registro->PLACA);
                            $codigo_placa_sistema_viejo=$placa_arreglo[0]; 
                            $descripcion_placa_sistema_viejo=$placa_arreglo[1];     
                            $placa_migrada=$this->migracion_model->getPlacaSistemaViejoPorId($codigo_placa_sistema_viejo);                            
                            $placa=$this->migracion_model->getPlacaPorId($placa_migrada->id_nuevo);                                 
                            $materialidad_1=$placa->nombre;
                           // exit($materialidad_1."fkffffftf");


                            // inicio de busqueda de onda   
                            //parche
                            if($registro_microondas->onda_sn!="" && $registro_microondas->onda_sn!=0){
                            $onda=$this->migracion_model->getOndaPorId($registro_microondas->onda_sn); 
                            $materialidad_2=$onda->nombre;
                            }
                            //fin de parche
                            
                            // inicio de busqueda de liner                            
                //echo "holass1".$registro_microondas->liner_sn;exit();
                            if($registro_microondas->liner_sn!="" && $registro_microondas->liner_sn!=0){
                            $liner=$this->migracion_model->getLinerPorId($registro_microondas->liner_sn); 
                            $materialidad_3=$liner->nombre;//liner
                            }
                            $materialidad_4="No Aplica";// no aplica en este caso
                            $repeticion_molde=$registro->REPIT;
                            $recuerdo=$registro->RECUERDO;
//                            exit(print_r($onda));
                                
//                            exit($materialidad_1);
                            $largo = $registro->LARGO;
                            $ancho = $registro->ANCHO;
                            $cantidad_piezas_pliego=$registro->PIEZASUNIDAD;          
                            $precio_migrado=$registro->VALOR_EMPRESA; 
                            $id_antiguo=$registro->N_COSTO;                             
                            $pegado=$registro->PEGADO1;
                            $margen=$registro->MARGEN1;
                            if ($registro->CROMALINC=="1")
                               $cromalin="SI";
                            else
                               $cromalin="NO"; 
                            
                          
                            $tiraje_unidad=$registro->TIRAJEUNIDAD;
                            
                            if ($registro->BARNIZ=="0")//-1 si, 0 es no
                                $lleva_barniz="NO";
                            else $lleva_barniz="SI";                            

                            if ($registro->BAENIZRE=="1")//1 si, 0 es no 
                                $lleva_reserva_barniz="NO";
                            else $lleva_reserva_barniz="SI";                                 
                    

                            $cantidad = $registro->CANTIDAD;                        
                            $unidad_pliego = $registro->UNIDADPLIEGO;    
                            $vendedor = 7;// oficina
                            $hacer_troquel="";
                            $lleva_troquelado="";
                            $colores=$registro->COLORES;
                            $medidas_aleta = explode("X", strtoupper($registro->TC));
                            
                            // inicio de busqueda de forma de pago         
                            $formapago=$this->migracion_model->getFormaPagoPorId(str_replace("?", "Ñ", $registro->FORMAPAGO)); 
                            $id_forma_pago=$formapago->id;      
                            

                            
                            // inicio de busqueda de los moldes
                            $numeromolde="0";
                            $condicion="Nuevo";                                                 
                            $estanlosmoldes="NO"; 
                            $nombremolde="";
                            $gastos_varios=0;
//                            $repeticion_molde="NO";

                            if ($conn_access = odbc_connect ( "bdacces2", "", "")){ 
                                
                                //22/05/2017
                                $ssql = "select [RESPALDO HC].CANTIDADQ,[RESPALDO HC].VARIOS10Q,[RESPALDO HC].COLORESQ,[RESPALDO HC].BARNIZQ,[RESPALDO HC].BARNIZREQ,[RESPALDO HC].MONTAJE, [RESPALDO HC].FINALQ, [RESPALDO HC].MARGEN1Q, [RESPALDO HC].PEGADO1Q, [RESPALDO HC].UNIDADPLIEGOQ, [RESPALDO HC].OPN as OT, [RESPALDO HC].Cproducto as CODIGO_PRODUCTO, [RESPALDO HC].OC, [RESPALDO HC].[VALOR EMPRESAQ] AS PRECIO, [RESPALDO HC].FECHAQ, [RESPALDO HC].[N COSTOQ] AS N_COSTO, [RESPALDO HC].REPITQ, [RESPALDO HC].CODMOLDE AS NROMOLDE, [MAESTRO MOLDE].NOMBREMOLDE, [MAESTRO MOLDE].TAMANOMOLDE,  [MAESTRO MOLDE].TP, [MAESTRO MOLDE].ABOBINA, [MAESTRO MOLDE].LBOBINA, [MAESTRO MOLDE].FECHAMOLDE, [MAESTRO MOLDE].NOMBRECLIENTE from [RESPALDO HC],[MAESTRO MOLDE]  WHERE [RESPALDO HC].CODMOLDE=[MAESTRO MOLDE].NMOLDE  AND [RESPALDO HC].[N COSTOQ]=".$registro->N_COSTO;
                                if($rs_access = odbc_exec ($conn_access, $ssql)){ 
                                $i=0;
//                                exit($ssql);
                                while ($fila = odbc_fetch_object($rs_access)){ 
                                        $arreglo=$this->migracion_model->getMigracionPorId($fila->COSTO);
                                        if ($arreglo->n_costo=='')
                                        {     
                                            $ot=$fila->OT;                                             
                                            $gastos_varios=($fila->VARIOS10Q*$fila->CANTIDADQ);                                                 
                                            // da prioridad sobre la tabla hoja de costo
                                            if ($fila->FINALQ=='1')  
                                                $datos_tecnicos="Corrugado";// materialidad
                                            elseif ($fila->FINALQ=='2')
                                                $datos_tecnicos="Microcorrugado";// materialidad
                                            elseif ($fila->FINALQ=='3')
                                                $datos_tecnicos="Sólo Cartulina";// materialidad                            
                                            elseif ($fila->FINALQ=='4') 
                                            {
                                                $datos_tecnicos="Cartulina-cartulina";// materialidad    
                                                $materialidad_2=$materialidad_3;
                                                $materialidad_3="";
                                            }
                                            elseif ($fila->FINALQ=='5')
                                                $datos_tecnicos="Indefinido";// materialidad                            
                                            elseif ($fila->FINALQ=='6')   
                                               $datos_tecnicos="Publicitario";// materialidad                            
                                            elseif ($fila->FINALQ=='7')   
                                               $datos_tecnicos="Tabique";// materialidad                            
                                            else
                                                $datos_tecnicos="Indefinido";// materialidad                                            
                                            
                                            $fecha_de_registro= substr($fila->FECHAQ, 0, 10); 
                                            $numeromolde=$fila->NROMOLDE;
                                            if ($numeromolde>2) // molde nro de id 1 es que no tiene, 2 es otro que no funciona
                                            {
    //                                            exit($numeromolde);
                                                // ojo revisar!!
                                                if ($numeromolde==0){
                                                    $estanlosmoldes="NO LLEVA";
                                                    $condicion="Nuevo";   
                                                }
                                                elseif ($numeromolde>2){
                                                    $molde_creado=$this->moldes_model->getMoldesPorId($numeromolde);
                                                    if (sizeof($molde_creado)>0)
                                                    {
                                                        if ($molde_creado->tipo=="Normal")
                                                            $estanlosmoldes="MOLDE REGISTRADOS DEL CLIENTE";
                                                        else
                                                            $estanlosmoldes="MOLDE GENERICO";
                                                    }
                                                    else {
                                                        $estanlosmoldes="MOLDE REGISTRADOS DEL CLIENTE";
                                                    }
                                                    
                                                    $condicion="Repetición Sin Cambios";
                                                    $hacer_troquel="NO";
                                                    $lleva_troquelado="SI";
                                                } else {
                                                    $condicion="Nuevo";                                                 
                                                    $estanlosmoldes="NO";
                                                }
                                            }
                                            else {
                                                $estanlosmoldes="NO LLEVA";
                                                $condicion="Nuevo";  
                                                $numeromolde="";
                                                $hacer_troquel="NO";
                                                $lleva_troquelado="NO";                                                 
                                            }
                                            //================================== acoplarlas a cotizaciones
                                            $montaje=$fila->MONTAJE;
                                            $unidad_pliego = (int)$fila->UNIDADPLIEGOQ;  
                                            if ($fila->BARNIZQ=="0")//-1 si, 0 es no
                                                $lleva_barniz="NO";
                                            else $lleva_barniz="SI";                            

                                            if ($fila->BAENIZREQ=="1")//1 si, 0 es no 
                                                $lleva_reserva_barniz="NO";
                                            else $lleva_reserva_barniz="SI";   
                                            $colores=$fila->COLORESQ;
                                        
                                            //==================================
                                            
                                            $nombremolde=$fila->NOMBREMOLDE;
                                            $tamaño_caja_molde=$fila->TAMANOMOLDE;
                                            $ancho_bobina_molde=$fila->ABOBINA;
                                            $largo_bobina_molde=$fila->LBOBINA; 

                                            $codigo_producto_migrado=$fila->CODIGO_PRODUCTO;
                                            $orden_de_compra_migrada=$fila->OC;


                                            $pliego=false;
                                            $pliego = stripos($fila->TP, "=");
                                            if ($pliego==true)
                                            {
                                                $numero_pliego=substr($fila->TP, ($pliego+1), 4);  // bcd
                                            }
                                            else {
                                                $numero_pliego=0;
                                            }                                            
                                            $fecha_molde=$fila->FECHAMOLDE;  
                                            $nombre_cliente_molde=$fila->NOMBRECLIENTE;
                                        }
                                        $i++;                    
                                    } 
                                    }else{ 
                                    echo "Error al ejecutar la sentencia SQL"; 
                                    } 
                            } else{ 
                                    echo "Error en la conexión con la base de datos del sistema "; 
                            }
                            odbc_close($conn_access);  

                            // Trabajos externos
                            if ($conn_access = odbc_connect ( "bdacces2", "", "")){ 
                                //22/05/2017
                                $ssql = "select *  from  EXTERNOS, RBARNIZ WHERE EXTERNOS.TRABAJO=RBARNIZ.CODIGO AND EXTERNOS.NROHC=".$ot_antigua;
                                $i=0;
                                if($rs_access = odbc_exec ($conn_access, $ssql)){ 
                                $i=0;
                                while ($fila = odbc_fetch_object($rs_access)){ 
                                       $trabajos_externo[$i]=$fila->TRABAJO;
                                       $i++;                    
                                    } 
                                    }else{ 
                                    echo "Error al ejecutar la sentencia SQL"; 
                                    } 
                            } else{ 
                                    echo "Error en la conexión con la base de datos del sistema "; 
                            }
                            odbc_close($conn_access);   
                            
                            $data=array
                            (
                               "id_usuario"=>$this->session->userdata('id'),
                               "id_cliente"=>$id_cliente,
                               "nombre_cliente"=>'no aplica',
                               "id_vendedor"=>$vendedor,
                               "condicion_del_producto"=>$condicion,
                               "producto"=>$producto,
                               "cantidad_1"=>$cantidad,
                               "precio_1"=>100,
                               "precio_2"=>100,
                               "precio_3"=>100,
                               "precio_4"=>100,
                               "materialidad_datos_tecnicos"=>$datos_tecnicos,
                               "materialidad_1"=>$materialidad_1,
                               "materialidad_2"=>$materialidad_2,
                               "materialidad_3"=>$materialidad_3,
                               "materialidad_4"=>$materialidad_4,
                               "impresion_colores"=>$colores,
                               "impresion_hacer_cromalin"=>$cromalin,
                               "forma_pago"=>$id_forma_pago,
                               "fecha"=>$fecha_de_registro,
                               "estado"=>'0',
                               "id_antiguo"=>'0',
                               "estan_los_moldes"=>$estanlosmoldes,
                               "numero_molde"=>$numeromolde,
                               "lleva_barniz"=>$lleva_barniz,
                               "reserva_barniz"=>$lleva_reserva_barniz,
                               "id_antiguo"=>$id_antiguo,     
                               "precio_migrado"=>$precio_migrado,        
                                //22/05/2017
                               "orden_de_compra_migrada"=>$orden_de_compra_migrada,
                               "ot_antigua"=>$ot_antigua,
                               "pegado_migrado"=>$pegado,
                               "margen_migrado"=>$margen,  
                               "montaje_pieza_especial"=>$montaje,
                               "cliente_entrega_6"=>"Nada",
                               "ot_migrada"=>$ot,
                               "varios_migrado"=>$gastos_varios,                                
                            );
                         //   exit(print_r($data));
                            $guardar=$this->cotizaciones_model->insertar($data);  
                            $id_cotizaciom=$guardar;
                        // revision ingenieria
                        $quien=$this->session->userdata('id');
                        $cuando=date("Y-m-d");
							   

                          if ($medidas_aleta[0]=="") $medidas_aleta[0]=0;
                          if ($medidas_aleta[1]=="") $medidas_aleta[1]=0;
                          if ($medidas_aleta[2]=="") $medidas_aleta[2]=0;
                          if ($medidas_aleta[3]=="") $medidas_aleta[3]=0;
                          if ($medidas_aleta[4]=="") $medidas_aleta[4]=0;   
                          $estan_los_moldes="NO";
                          $molde=8149;
                         
                        // ingenieria  
                        $data=array
                        (
                            "id_usuario"=>$this->session->userdata('id'),
                            "id_cotizacion"=>$id_cotizaciom,
                            "producto"=>$producto,
                            "medidas_de_la_caja"=>$medidas_aleta[0],
                            "medidas_de_la_caja_2"=>$medidas_aleta[1],
                            "medidas_de_la_caja_3"=>$medidas_aleta[2],
                            "medidas_de_la_caja_4"=>$medidas_aleta[3],
                            "estado"=>0,     
                            "archivo"=>"",                            
//                            "aleta_pegado"=>$medidas_aleta[0],
//                            "largo_1"=>$medidas_aleta[1],                            
//                            "ancho_1"=>$medidas_aleta[2],
//                            "ancho_2"=>$medidas_aleta[3],
//                            "largo_2"=>$medidas_aleta[4],    
//                            "suma_largo_aleta"=>$medidas_aleta[0]+$medidas_aleta[1]+$medidas_aleta[2]+$medidas_aleta[3]+$medidas_aleta[4],                            
                            "unidades_por_pliego"=>$unidad_pliego,
//                            "hacer_troquel"=>$this->input->post('hacer_troquel',true),
//                            "lleva_troquelado"=>$this->input->post('lleva_troquelado',true),
                            "piezas_totales_en_el_pliego"=>$cantidad_piezas_pliego,
//                            "metros_de_cuchillo"=>$this->input->post('metros_de_cuchillo',true),
                            "tamano_a_imprimir_1"=>$ancho,
                            "tamano_a_imprimir_2"=>$largo,
//                            "tamano_cuchillo_1"=>$arreglo_cuchillos_molde[0],
//                            "tamano_cuchillo_2"=>$arreglo_cuchillos_molde[1],
                            "tamano_cuchillo_1"=>0,
                            "tamano_cuchillo_2"=>0,                            
                            "materialidad_datos_tecnicos"=>$datos_tecnicos,
//                            "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),                            
                            "materialidad_1"=>$materialidad_1,
                            "materialidad_2"=>$materialidad_2,
                            "materialidad_3"=>$materialidad_3,
                            "materialidad_4"=>$materialidad_4,
                            "hacer_troquel"=>$hacer_troquel,
                            "lleva_troquelado"=>$lleva_troquelado,                           
//                            "piezas_adicionales"=>$this->input->post("piezas_adicionales",true),
//                            "piezas_adicionales2"=>$this->input->post("piezas_adicionales2",true),
//                            "piezas_adicionales3"=>$this->input->post("piezas_adicionales3",true),
//                            "detalle_piezas_adicionales"=>$this->input->post("detalle_piezas_adicionales",true),
//                            "comentario_piezas_adicionales"=>$this->input->post("comentario_piezas_adicionales",true),
//                            "tipo_de_pegado"=>$this->input->post("tipo_de_pegado1",true),
//                            "lineas_pegado"=>$this->input->post("lineas_pegado",true),
//                            "detalle_lineas_pegado"=>$this->input->post("detalle_lineas_pegado",true),
//                            "es_una_maquina"=>$this->input->post("es_una_maquina",true),
//                            "impresion_compartida"=>$this->input->post("impresion_compartida",true),
//                            "contiene_otras_cotizaciones"=>$this->input->post("contiene_otras_cotizaciones",true),
//                            "numero_cotizacion"=>$this->input->post("numero_cotizacion",true),
                            "fecha"=>$fecha_de_registro,
//                            "trabajos_adicionales"=>$this->input->post("trabajos_adicionales",true),
//                            "trabajos_adicionales_glosa"=>$this->input->post("trabajos_adicionales_glosa",true),
//                            "estado"=>$this->input->post("estado",true),
                            "estan_los_moldes"=>$estanlosmoldes,
                            "numero_molde"=>$numeromolde,
                            "nombre_molde"=>$nombremolde,
//                            "id_adhesivo"=>$this->input->post("adhesivo",true),
                            "quien"=>$quien,
//                            "cuando"=>$cuando,
//                            "solo_pegado"=>$this->input->post("solo_pegado",true),
//                            "tamano_pieza_a_empaquetar_ancho"=>$this->input->post("tamano_pieza_a_empaquetar_ancho",true),
//                            "tamano_pieza_a_empaquetar_largo"=>$this->input->post("tamano_pieza_a_empaquetar_largo",true),
//                            "glosa"=>$this->input->post("glosa",true),
//                            "pegado"=>$this->input->post("pegado",true),
//                            "doblado"=>$this->input->post("doblado",true),
//                            "empaquetado"=>$this->input->post("empaquetado",true),
//                            "tipo_pegado"=>$this->input->post("tipo_pegado",true),
//                            "pegado_puntos"=>$this->input->post("pegado_puntos",true),
//                            "pegado_cantidad_puntos"=>$this->input->post("pegado_cantidad_puntos",true),
//                            "tipo_fondo"=>$this->input->post("tipo_fondo",true),
//                            "lleva_aletas"=>$this->input->post("lleva_aletas",true),
//                            "total_aplicaciones_adhesivo"=>$this->input->post("total_aplicaciones_adhesivo",true),
//                            "id_molde"=>1,
//                            "largo_total_de_la_caja"=>$this->input->post("largo_total_de_la_caja",true),
//                            "cantidad_ordenes"=>"NO",
//                            "nombre_molde"=>$this->input->post("nombre_molde",true),
//                            "troquel_por_atras"=>$this->input->post("troquel_por_atras",true),
//                            "lleva_mica"=>$this->input->post("lleva_mica",true),
//                            "largo_mica"=>$this->input->post("largo_mica",true),
//                            "ancho_mica"=>$this->input->post("ancho_mica",true),                            
                            );
//                        exit(print_r($data));
                            $guardar=$this->cotizaciones_model->insertarIngenieria($data); 
                            
                    // fotomecanica

                       $data=array
                            (
                                "id_usuario"=>$this->session->userdata('id'),
                                "id_cotizacion"=>$id_cotizaciom,
                                "condicion_del_producto"=>$condicion,
//                                "estan_las_peliculas"=>$this->input->post("estan_las_peliculas",true),
                                "estan_los_moldes"=>$estanlosmoldes,
                                "numero_molde"=>$numeromolde,
                                "colores"=>$colores,
                                "archivo"=>"",                           
//                                "colores_metalicos"=>$this->input->post("colores_metalicos",true),
//                                "acabado_impresion_1"=>$this->input->post("acabado_impresion_1",true),
//                                "acabado_impresion_2"=>$this->input->post("acabado_impresion_2",true),
//                                "acabado_impresion_3"=>$this->input->post("acabado_impresion_3",true),
                                "acabado_impresion_4"=>$trabajos_externo[0],
                                "acabado_impresion_5"=>$trabajos_externo[1],
                                "acabado_impresion_6"=>$trabajos_externo[2],
                                "hacer_troquel"=>$hacer_troquel,
                                "lleva_troquelado"=>$lleva_troquelado,                            
                                "fot_lleva_barniz"=>$lleva_barniz,
                                "fot_reserva_barniz"=>$lleva_reserva_barniz,
                                "tamano_caja_corrugado"=>$this->input->post("tamano_caja_corrugado",true),
    //                            "comentarios"=>$this->input->post("obs",true),
                                "fecha"=>$fecha_de_registro,
//                                "desctec"=>$this->input->post("desctec",true),
    //                            "archivo"=>$file_name,
                                "materialidad_datos_tecnicos"=>$datos_tecnicos,
    //                            "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),                            
                                "materialidad_1"=>$materialidad_1,
                                "materialidad_2"=>$materialidad_2,
                                "materialidad_3"=>$materialidad_3,
                                "materialidad_4"=>$materialidad_4,
                                "estado"=>0,
                                "procesos_especiales_folia"=>"NO",
                                "procesos_especiales_folia_2"=>"NO",
                                "procesos_especiales_folia_2_valor"=>"No Lleva",
                                "procesos_especiales_folia_3"=>"NO",
                                "procesos_especiales_folia_3_valor"=>"No Lleva",
                                "procesos_especiales_cuno"=>"NO",
                                "procesos_especiales_cuno_2"=>"NO",                             
                                "procesos_especiales_folia_valor"=>"No Lleva",                               
                                "procesos_especiales_cuno_valor"=>"No Lleva",
                                "procesos_especiales_cuno_2_valor"=>"No Lleva",
                                "quien"=>$quien,
//                                "cuando"=>$cuando,
//                                "glosa"=>$this->input->post("glosa",true),
//                                "impresion"=>$this->input->post("impresion",true),
//                                "lleva_fondo_negro"=>$this->input->post("lleva_fondo_negro",true),
//                                "troquel_por_atras"=>$this->input->post("troquel_por_atras",true),
//                                "hacer_troquel"=>$this->input->post('hacer_troquel',true),
//                                "lleva_troquelado"=>$this->input->post('lleva_troquelado',true),
//                                "fondo_otro_color"=>$this->input->post('fondo_otro_color',true),
                                "input_variable_externo_1"=>0,
                                "input_variable_externo_2"=>0,
                                "input_variable_externo_3"=>0,                                   
                                "input_variable_externo_4"=>0,
                                "input_variable_externo_5"=>0,
                                "input_variable_externo_6"=>0,   
                                "folia1_proceso_seletec"=>0,
                                "folia2_proceso_seletec"=>0,
                                "folia3_proceso_seletec"=>0,                                   
                                "cuno1_proceso_seletec"=>0,
                                "cuno2_proceso_seletec"=>0,
                                "guardar_con_comentarios"=>$recuerdo,
                             );
                             $guardar=$this->cotizaciones_model->insertarFotomecanica($data);         
                             

                             // creacion o actualizacion de moldes
                             $molde_creado=array();
                             if ($numeromolde!='')
                                $molde_creado=$this->moldes_model->getMoldesPorId($numeromolde);
                             if(sizeof($molde_creado) == 0)
                             {
                                 if($numeromolde>2) // a partir del 2 se crean son validos los moldes
                                 {  
                                    // moldes cuando es nuevo se crea uno normal
                                     $data=array
                                     (
                                        "nombre"=>$nombremolde,
                                        "numero"=>$numeromolde,
                                        "pliegos_molde"=>$numero_pliego,
                                        "nombrecliente"=>$id_cliente,
                                        "tamano_caja"=>$tamaño_caja_molde,
                                        "cuchillocuchillo"=>0,
                                        "cuchillocuchillo2"=>0,
                                        "ancho_bobina"=>$ancho_bobina_molde,
                                        "largo_bobina"=>$largo_bobina_molde,
                                        "fecha"=>$fecha_molde,
                                        "nombrecliente2"=>$nombre_cliente_molde,
                                        "tipo"=>"Normal",
                                     );                                       
                                    $this->db->insert("moldes_grau",$data);
                                    if ($numeromolde)
                                    {
                                        $molde_ya_creado=$this->moldes_model->getNumeroMoldes($numeromolde);
                                        $data_actualizar_cotizacion=array
                                        (
                                           "estan_los_moldes"=>'MOLDE REGISTRADOS DEL CLIENTE',
                                           "numero_molde"=>$molde_ya_creado[0]->id,
                                        );
                                        $guardar=$this->cotizaciones_model->update($data_actualizar_cotizacion,$id_cotizaciom);                                
                                        $guardar=$this->cotizaciones_model->update_ingenieria($data_actualizar_cotizacion,$id_cotizaciom); 
                                        $guardar=$this->cotizaciones_model->update_fotomecanica($data_actualizar_cotizacion,$id_cotizaciom);                                       
                                    }
                                 }
                             }
                             else
                             {
                                 // le asignamos el cliente 2 al molde ya que pertenecia a otro
                                $data_update_moldes=array
                                (
                                   "nombrecliente2"=>$id_cliente,
                                );  
                                // cuando el molde existe se crea uno nuevo Tipo generico y se actualiza el viejo
                                $guardar=$this->moldes_model->update($data_update_moldes,$molde_creado->id);
                                 //creamos el molde tipo generico
                                $maximo_molde=$this->moldes_model->getUltimoMoldeGuardado2();
                                $data=array
                                 (
                                    "nombre"=>$nombremolde,
                                    "numero"=>$maximo_molde[0]->maximo,
                                    "pliegos_molde"=>$numero_pliego,
                                    "nombrecliente"=>$id_cliente,
                                    "tamano_caja"=>$tamaño_caja_molde,
                                    "cuchillocuchillo"=>$arreglo_cuchillos_molde[0],
                                    "cuchillocuchillo2"=>$arreglo_cuchillos_molde[1],
                                    "ancho_bobina"=>$ancho_bobina_molde,
                                    "largo_bobina"=>$largo_bobina_molde,
                                    "estado"=>0,
                                    "fecha"=>$fecha_molde,                                    
                                    "nombrecliente2"=>$molde_creado->nombrecliente2,
                                    "tipo"=>"Genérico",
                                 );                                       
                                $this->db->insert("moldes_grau",$data);    
                                $data_actualizar_cotizacion=array
                                (
                                   "estan_los_moldes"=>'MOLDE GENERICO',
                                   "numero_molde"=>$maximo_molde[0]->maximo,
                                );
                                $guardar=$this->cotizaciones_model->update($data_actualizar_cotizacion,$id_cotizaciom);                                
                                $guardar=$this->cotizaciones_model->update_ingenieria($data_actualizar_cotizacion,$id_cotizaciom); 
                                $guardar=$this->cotizaciones_model->update_fotomecanica($data_actualizar_cotizacion,$id_cotizaciom);                                 
                                
                             }
//                             exit();
                             // productos
                            if ($numeromolde>2){ // a partir del 2 se crean son validos los moldes
                                         $data=array
                                         (
                                            "id_cotizacion"=>$id_cotizaciom,
                                            "codigo"=>$codigo_producto_migrado,
                                            "nombre"=>$nombremolde,
                                            "tipo"=>1,
                                            "quien"=>2,
                                            "cuando"=>$fecha_molde,
                                         );

                                         $producto_creado=array();
                                         if ($numeromolde!='')
                                            $producto_creado=$this->productos_model->getProductosPorCliente($codigo_producto_migrado);
                                         if(sizeof($producto_creado) == 0) 
                                             $this->db->insert("productos",$data);  

                                         $producto_creado=$this->productos_model->getProductosPorCotizacion($id_cotizaciom);
                                         $data_producto_creado=array
                                         (
                                            "producto_id"=>$producto_creado->id,
                                         );
            //                             $this->db->insert("cotizaciones",$data);  
                                         $guardar=$this->cotizaciones_model->update($data_producto_creado,$id_cotizaciom);
                            }
                            echo "Orden Fue Registrada con Exito";
//                             $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.'.  $checks);
//                             redirect(base_url().'cotizaciones',  301);  
                    }
                    else {
                        echo "Orden Ya Fue Registrada";
                    }
                }else
                        echo "No esta logueado";
                }                
            }                

    }
            

   
}

