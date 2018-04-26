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
        if ($this->uri->segment(3)==1)
        {
            $maximo_datos_cotizacion=$this->migracion_model->getMigracionRegistroCotizacion();
            if ($conn_access = odbc_connect ( "bdacces2", "", "")){ 
                $ssql = "select [VALOR EMPRESA] AS VALOR_EMPRESA, [N COSTO] AS COSTO, [TIPO TRABAJO] AS TIPO_TRABAJO, [GR/PLACA] AS GR_PLACA from [HOJA DE COSTO] where [N COSTO] > ".$maximo_datos_cotizacion->maximo." order by [N COSTO] DESC ";
                if($rs_access = odbc_exec ($conn_access, $ssql)){ 
                $fila = odbc_fetch_object($rs_access);
//                odbc_close($conn_access);                
//                    exit(print_r($fila));                
                $i=0;
                while ($fila = odbc_fetch_object($rs_access)){ 
//                    exit(print_r($fila));
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

//                             $datos_cotizacion=$this->migracion_model->getMigracionRegistroPorNcosto($fila->COSTO);
//                             if(sizeof($datos_cotizacion) == 0)
//                             {                            
                                $guardar=$this->migracion_model->insertar($data);  
//                             }
//                             else
//                             {
//                                exit(print_r($datos_cotizacion));                                 
//                                 
//                             }
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
        }
        if($this->session->userdata('id'))
        {
          if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
           $datos=$this->migracion_model->getMigracionAll_indexPaginacion();
//           print_r($datos);
           $this->layout->view('index',compact('datos')); 
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
                // desde aqui
                if($this->session->userdata('id'))
                {
//                   $ValidarProducto=$this->productos_model->getProductosPorNombre($this->input->post("producto",true));
//                        if(sizeof($ValidarProducto)==0)
//                        {
                            // NOTA: SI LLEVA MAS DE TRES COLORES LLEVA CROMALIN INDICADO POR EL SEÑOR ENRIQUE
                            // CUANDO EL CROMALIN = 0 ES NO
                            // CUANDO EL CROMALIN = -1 ES SI
                    
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
//                            exit($repeticion_molde);
//                            if ($repeticion_molde=='SI')
//                            {
//                              $condicion="Repetición Sin Cambios";
//                              //$estanlosmoldes="SI";
//                            }  
//                            elseif ($repeticion_molde=='NO')
//                            {
//                                $condicion="Nuevo";  
//                                //$estanlosmoldes="NO";
//                            }
//                            else // ojo con esto
//                            {
//                                //$estanlosmoldes="NO LLEVA";
//                                $condicion="Nuevo";                                 
//                            }
                                
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
//                            exit($registro->VALOR7);
//                            if (($registro->VALOR7==0) and ($registro->MOLDE1==0))
//                            {
//                                $estanlosmoldes="SI";
//                            }
//                            elseif (($registro->MOLDE1>0) and ($registro->VALOR7=='-1')) 
//                            {
//                                $estanlosmoldes="NO";
//                            }
//                            else {
//                               $estanlosmoldes="NO LLEVA";
//                            }
                            
                          
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
                            $colores=$registro->COLORES;
                            $medidas_aleta = explode("X", strtoupper($registro->TC));
                            
                            // inicio de busqueda de forma de pago         
                            $formapago=$this->migracion_model->getFormaPagoPorId(str_replace("?", "Ñ", $registro->FORMAPAGO)); 
                            $id_forma_pago=$formapago->id;      
                            

                            
                            // inicio de busqueda de los moldes
                            $numeromolde="0";
                            $condicion="Nuevo";                                                 
                            $estanlosmoldes="NO";                              
//                            $repeticion_molde="NO";

                            if ($conn_access = odbc_connect ( "bdacces", "", "")){ 
                                
                                //22/05/2017
                                $ssql = "select [RESPALDO HC].BARNIZQ,[RESPALDO HC].BARNIZREQ,[RESPALDO HC].MONTAJE, [RESPALDO HC].FINALQ, [RESPALDO HC].MARGEN1Q, [RESPALDO HC].PEGADO1Q, [RESPALDO HC].UNIDADPLIEGOQ, [RESPALDO HC].OPN as OT, [RESPALDO HC].Cproducto as CODIGO_PRODUCTO, [RESPALDO HC].OC, [RESPALDO HC].[VALOR EMPRESAQ] AS PRECIO, [RESPALDO HC].FECHAQ, [RESPALDO HC].[N COSTOQ] AS N_COSTO, [RESPALDO HC].REPITQ, [RESPALDO HC].CODMOLDE AS NROMOLDE, [MAESTRO MOLDE].NOMBREMOLDE, [MAESTRO MOLDE].TAMANOMOLDE,  [MAESTRO MOLDE].TP, [MAESTRO MOLDE].ABOBINA, [MAESTRO MOLDE].LBOBINA, [MAESTRO MOLDE].FECHAMOLDE, [MAESTRO MOLDE].NOMBRECLIENTE from [RESPALDO HC],[MAESTRO MOLDE]  WHERE [RESPALDO HC].CODMOLDE=[MAESTRO MOLDE].NMOLDE  AND [RESPALDO HC].[N COSTOQ]=".$registro->N_COSTO;
                                if($rs_access = odbc_exec ($conn_access, $ssql)){ 
                                $i=0;
//                                exit($ssql);
                                while ($fila = odbc_fetch_object($rs_access)){ 
                                        $arreglo=$this->migracion_model->getMigracionPorId($fila->COSTO);
                                        if ($arreglo->n_costo=='')
                                        {     
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
//                                            exit($fila->FINALQ."-----".$datos_tecnicos);
                                            
                                            $fecha_de_registro= substr($fila->FECHAQ, 0, 10); 
                                            $numeromolde=$fila->NROMOLDE;
                                            // ojo revisar!!
                                            if ($numeromolde==0){
                                                $estanlosmoldes="NO LLEVA";
                                                $condicion="Nuevo";   
                                            }
                                            elseif ($numeromolde>1){
                                                $molde_creado=$this->moldes_model->getMoldesPorId($numeromolde);
                                                if ($molde_creado->tipo=="Normal")
                                                    $estanlosmoldes="MOLDE REGISTRADOS DEL CLIENTE";
                                                else
                                                    $estanlosmoldes="MOLDE GENERICO";
                                                $condicion="Repetición Sin Cambios";
                                            } else {
                                                $condicion="Nuevo";                                                 
                                                $estanlosmoldes="NO";
                                            }
                                            //exit($fila->NROMOLDE."hola");
                                            //================================== acoplarlas a cotizaciones
                                            $montaje=$fila->MONTAJE;
                                            $unidad_pliego = $fila->UNIDADPLIEGOQ;  
                                            
                                            if ($fila->BARNIZQ=="0")//-1 si, 0 es no
                                                $lleva_barniz="NO";
                                            else $lleva_barniz="SI";                            

                                            if ($fila->BAENIZREQ=="1")//1 si, 0 es no 
                                                $lleva_reserva_barniz="NO";
                                            else $lleva_reserva_barniz="SI";   
                                            
                                            $colores=$fila->COLORESQ;
                                        
                                            //==================================
//                                            exit($fila->NROMOLDE."-----".$datos_tecnicos."----".$fila->NOMBREMOLDE);
                                            
                                            $nombremolde=$fila->NOMBREMOLDE;
                                            $tamaño_caja_molde=$fila->TAMANOMOLDE;
                                            $ancho_bobina_molde=$fila->ABOBINA;
                                            $largo_bobina_molde=$fila->LBOBINA; 

                                            $codigo_producto_migrado=$fila->CODIGO_PRODUCTO;
                                            $orden_de_compra_migrada=$fila->OC;

                                            // sacar distancia cuchillo a cuchillo
                                            $cuchillo=false;
                                            $cuchillo = strpos(substr($fila->TP, 0, strpos($fila->TP, "=")), "X");
                                            if ($cuchillo==true)
                                            {
                                                $arreglo_cuchillos_molde= explode("X", strtoupper(substr($fila->TP, 0, strpos($fila->TP, "="))));
                                            }
                                            else {
                                                // y cuando no tiene colocarle 1X1
                                                $arreglo_cuchillos_molde=array("1", "1");
                                            }
                                            // unidades por molde 
                                            $pliego=false;
                                            $pliego = stripos($fila->TP, "=");
                                            if ($pliego==true)
                                            {
                                                $numero_pliego=substr($fila->TP, ($pliego+1), 4);  // bcd
                                            }
                                            else {
                                                $numero_pliego=0;
                                            }                                            
//                                            $repeticion=$fila->REPETICION;
//                                            if ($repeticion='SI')
//                                              $condicion="Repetición Sin Cambios";
//                                            else
//                                              $condicion="Nuevo";
                                            $fecha_molde=$fila->FECHAMOLDE;  
//                                            exit($fecha_molde);
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
//                            exit("paso");
                            // Trabajos externos
                            if ($conn_access = odbc_connect ( "bdacces", "", "")){ 
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
//                            if ($numeromolde>1){
//                                $estanlosmoldes="SI";
//                            }
//                            else
//                                $estanlosmoldes="NO LLEVA";
                        // cotizacion 
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
                                // ALTER TABLE `cotizaciones` ADD COLUMN `orden_de_compra_migrada` INT(11) NULL DEFAULT NULL AFTER `precio_migrado`;
                               // FIN                                
                            );
                            $guardar=$this->cotizaciones_model->insertar($data);  
                            $id_cotizaciom=$guardar;
                        // revision ingenieria
                        $quien=$this->session->userdata('id');
                        $cuando=date("Y-m-d");
							   

                        // Distancia cuchillo a cuchillo(*)  1 X 1

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
                            "estado"=>1,                            
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
                            "tamano_cuchillo_1"=>$arreglo_cuchillos_molde[0],
                            "tamano_cuchillo_2"=>$arreglo_cuchillos_molde[1],
                            "materialidad_datos_tecnicos"=>$datos_tecnicos,
//                            "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),                            
                            "materialidad_1"=>$materialidad_1,
                            "materialidad_2"=>$materialidad_2,
                            "materialidad_3"=>$materialidad_3,
                            "materialidad_4"=>$materialidad_4,
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
                                "lleva_barniz"=>$lleva_barniz,
                                "reserva_barniz"=>$lleva_reserva_barniz,
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
                                "estado"=>1,
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
                                 if($numeromolde>1) 
                                 {  
                                    // moldes cuando es nuevo se crea uno normal
                                     $data=array
                                     (
                                        "nombre"=>$nombremolde,
                                        "numero"=>$numeromolde,
                                        "pliegos_molde"=>$numero_pliego,
                                        "nombrecliente"=>$id_cliente,
                                        "tamano_caja"=>$tamaño_caja_molde,
                                        "cuchillocuchillo"=>$arreglo_cuchillos_molde[0],
                                        "cuchillocuchillo2"=>$arreglo_cuchillos_molde[1],
                                        "ancho_bobina"=>$ancho_bobina_molde,
                                        "largo_bobina"=>$largo_bobina_molde,
                                        "fecha"=>$fecha_molde,
                                        "nombrecliente2"=>$nombre_cliente_molde,
                                        "tipo"=>"Normal",
                                     );                                       
                                    $this->db->insert("moldes_grau",$data);  
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
                                // creamos el molde tipo generico
                                $maximo_molde=$this->moldes_model->getUltimoMoldeGuardado2();
//                                exit(print_r($maximo_molde));
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
                             // productos
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

                             $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.'.  $checks);
                             redirect(base_url().'cotizaciones',  301);                             
                }else
                    {
                        redirect(base_url().'usuarios/login',  301);
                    }
                }                
            }                

        
    }        
	

   
}

