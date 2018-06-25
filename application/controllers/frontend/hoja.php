<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hoja extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('template_ajax');
    }
    /**
     * guardar
     * */
    public function save()
    {
                
        if($this->input->post())
        {
            //procedimiento de copiar hc
            $idcopia=$this->input->post("numerocopia",true);
            $copia = $this->input->post("copia",true);
            if($copia==1){
            //duplicando cotizacion
            $datos=$this->cotizaciones_model->getCotizacionPorId($idcopia);
            //duplicando revision ingenieria
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($idcopia);
            //duplicando revision fotomecanica
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($idcopia);
            //duplicando hoja de costos    
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($idcopia);
            //numero de copias
            $copias=$this->cotizaciones_model->obtenerMaximoIdCopias($idcopia);
            
            $maximo=$this->cotizaciones_model->obtenerMaximoId();
            $idnuevo=$maximo->id_max+1;
            $maximocopias = count($copias)+1;
            
            //Reasignacion de id para la recotizacion;
            $datos->id = $idnuevo;
            unset($ing->id);
            $ing->id_cotizacion = $idnuevo;
            unset($fotomecanica->id);
            $fotomecanica->id_cotizacion = $idnuevo;
            unset($hoja->id);
            $hoja->id_cotizacion = $idnuevo;
            unset($hoja->impreso);
            $hoja->impreso = 0;
            
            if($hoja->codigo_duplicado!=""){
            $hoja->codigo_duplicado = substr($hoja->codigo_duplicado, 0,5).(substr($hoja->codigo_duplicado, 5)+1);
            }else{    
            $hoja->codigo_duplicado = $idcopia.'-'.$maximocopias;
            }
           // echo $hoja->codigo_duplicado;exit();
            
            function formatear($array){
                echo "<pre>".
                print_r($array).
                "</pre>";
            }           
//            formatear($datos);
//            formatear($ing);
//            formatear($fotomecanica);
//            formatear($hoja);
            //Creacion de registros en cotizacion;
            $guardar=$this->cotizaciones_model->insertar($datos);
            //Creacion de registros en ingenieria;
            $this->cotizaciones_model->insertarIngenieria($ing);
            //Creacion de registros en fotomecanica;
            $this->cotizaciones_model->insertarFotomecanica($fotomecanica);
            //Creacion de registros en hoja de costos;
            $this->db->insert("hoja_de_costos_datos",$hoja);
            
            
            $this->session->set_flashdata('ControllerMessage', 'Se ha Copiado la Hoja de Costos exitosamente.');
            redirect("/cotizaciones/hoja_de_costos/$idnuevo",  301);
            }
            
            $impreso = $this->input->post("imprimir",true);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($this->input->post("id",true));
            if ($this->input->post("margen",true)==""){
                $margen=15;
                $margen_migrado=15;
            }else{
                $margen=$this->input->post("margen",true);         
                $margen_migrado=$this->input->post("margen",true);         
            }
            if ($this->input->post("pegado",true)==""){
                $pegado=30;
                $pegado=30;
        }else{
                $pegado=$this->input->post("pegado",true);                     
                $pegado_migrado=$this->input->post("pegado",true);                     
        
        }
            $data=array
                (
                    "id_usuario"=>$this->session->userdata('id'),
                    "id_cotizacion"=>$this->input->post("id",true),
                    "valor_empresa"=>$this->input->post("ve1",true),
                    "pegado"=>$pegado,
                    "costo_adicional"=>$this->input->post("costo_adicional",true),
                    "dias_de_entrega"=>$this->input->post("dias_de_entrega",true),
                    "margen"=>$margen,
                    "valor_acabado_1"=>$this->input->post("valor_acabado_1",true),
                    "valor_acabado_2"=>$this->input->post("valor_acabado_2",true),
                    "valor_acabado_3"=>$this->input->post("valor_acabado_3",true),
                    "valor_empresa_2"=>$this->input->post("valor_empresa2",true),
                    "valor_empresa_3"=>$this->input->post("valor_empresa3",true),
                    "valor_empresa_4"=>$this->input->post("valor_empresa4",true),
                    "fecha"=>date('Y-m-d'),
                    "valor_extra"=>$this->input->post("valor_extra",true),                        
                    "total_merma2"=>$this->input->post("total_merma2",true),                        
                    "total_merma3"=>$this->input->post("total_merma3",true),                        
                    "total_merma4"=>$this->input->post("total_merma4",true),                        
                    "impreso"=>$impreso,                        
                );
          
            $data_act=array
                (
                    "precio_1"=>$this->input->post("valor_empresa",true),    
                    "precio_2"=>$this->input->post("valor_empresa2",true),    
                    "precio_3"=>$this->input->post("valor_empresa3",true),    
                    "precio_4"=>$this->input->post("valor_empresa4",true),    
                    "pegado_migrado"=>$pegado,
                    "margen_migrado"=>$margen,
                    "dias_de_entrega"=>$this->input->post("dias_de_entrega",true),                
                    "precio_migrado"=>$this->input->post("valor_empresa",true),                
                );
            
            $data_alt=array
                (
                    "id_cotizacion"=>$this->input->post("id",true),
                    "despacho_fuera_de_santiago"=>$despacho_fuera_de_santiago,                
                    "retira_cliente"=>$retira_cliente,                
                );
  
            if(sizeof($hoja)==0)
            { 
                $this->db->insert("hoja_de_costos_datos",$data);
                $this->db->insert("hoja_de_costos_cambios",$data);
                $this->db->insert("hoja_de_costos_alt",$data_alt);
                $this->db->where('id', $this->input->post('id',true));
                $this->db->update("cotizaciones",$data_act);
            }else
            {
                $this->db->where('id_cotizacion', $this->input->post('id',true));
                $this->db->update("hoja_de_costos_datos",$data);
                $this->db->where('id_cotizacion', $this->input->post('id',true));
                $this->db->update("hoja_de_costos_cambios",$data);
                $this->db->where('id_cotizacion', $this->input->post('id',true));
                $this->db->update("hoja_de_costos_alt",$data_alt);
                 //exit(print_r($data));
            }
            $data2=array
                (
                    "id_cotizacion"=>$this->input->post("id",true),
                    "seccion"=>"Se guardó completa Hoja de Costos",
                    "glosa"=>"Se guardó completa Hoja de Costos",
                    "quien"=>$this->session->userdata('id'),
                    "cuando"=>date("Y-m-d"),
                );
                $this->db->insert("hoja_de_costos",$data2);    
            $this->session->set_flashdata('ControllerMessage', 'Se ha modificado Hoja de Costos exitosamente.');
            redirect($this->input->post("url",true),  301);
        }else
        {
            show_404();
        }
        
    }
    public function save2()
    {
                
        if($this->input->post())
        {
            //procedimiento de copiar hc
            $idcopia=$this->input->post("numerocopia",true);
            $copia = $this->input->post("copia",true);
            if($copia==1){
            //duplicando cotizacion
            $datos=$this->cotizaciones_model->getCotizacionPorId($idcopia);
            //duplicando revision ingenieria
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($idcopia);
            //duplicando revision fotomecanica
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($idcopia);
            //duplicando hoja de costos    
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($idcopia);
            //numero de copias
            $copias=$this->cotizaciones_model->obtenerMaximoIdCopias($idcopia);
            
            $maximo=$this->cotizaciones_model->obtenerMaximoId();
            $idnuevo=$maximo->id_max+1;
            $maximocopias = count($copias)+1;
            
            //Reasignacion de id para la recotizacion;
            $datos->id = $idnuevo;
            unset($ing->id);
            $ing->id_cotizacion = $idnuevo;
            unset($fotomecanica->id);
            $fotomecanica->id_cotizacion = $idnuevo;
            unset($hoja->id);
            $hoja->id_cotizacion = $idnuevo;
            unset($hoja->impreso);
            $hoja->impreso = 0;
            
            if($hoja->codigo_duplicado!=""){
            $hoja->codigo_duplicado = substr($hoja->codigo_duplicado, 0,5).(substr($hoja->codigo_duplicado, 5)+1);
            }else{    
            $hoja->codigo_duplicado = $idcopia.'-'.$maximocopias;
            }
           // echo $hoja->codigo_duplicado;exit();
            
            function formatear($array){
                echo "<pre>".
                print_r($array).
                "</pre>";
            }           
//            formatear($datos);
//            formatear($ing);
//            formatear($fotomecanica);
//            formatear($hoja);
            //Creacion de registros en cotizacion;
            $guardar=$this->cotizaciones_model->insertar($datos);
            //Creacion de registros en ingenieria;
            $this->cotizaciones_model->insertarIngenieria($ing);
            //Creacion de registros en fotomecanica;
            $this->cotizaciones_model->insertarFotomecanica($fotomecanica);
            //Creacion de registros en hoja de costos;
            $this->db->insert("hoja_de_costos_datos",$hoja);
            
            
            $this->session->set_flashdata('ControllerMessage', 'Se ha Copiado la Hoja de Costos exitosamente.');
            redirect("/cotizaciones/hoja_de_costos_propia/$idnuevo",  301);
            }
            
            $impreso = $this->input->post("imprimir",true);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($this->input->post("id",true));
            if ($this->input->post("margen",true)==""){
                $margen=15;
                $margen_migrado=15;
            }else{
                $margen=$this->input->post("margen",true);         
                $margen_migrado=$this->input->post("margen",true);         
            }
            if ($this->input->post("pegado",true)==""){
                $pegado=30;
                $pegado=30;
        }else{
                $pegado=$this->input->post("pegado",true);                     
                $pegado_migrado=$this->input->post("pegado",true);                     
        
        }
        
            $data=array
                (
                    "id_usuario"=>$this->session->userdata('id'),
                    "id_cotizacion"=>$this->input->post("id",true),
                    "valor_empresa"=>$this->input->post("valor_empresa",true),
                    "pegado"=>$pegado,
                    "costo_adicional"=>$this->input->post("costo_adicional",true),
                    "dias_de_entrega"=>$this->input->post("dias_de_entrega",true),
                    "margen"=>$margen,
                    "valor_acabado_1"=>$this->input->post("valor_acabado_1",true),
                    "valor_acabado_2"=>$this->input->post("valor_acabado_2",true),
                    "valor_acabado_3"=>$this->input->post("valor_acabado_3",true),
                    "valor_empresa_2"=>$this->input->post("valor_empresa2",true),
                    "valor_empresa_3"=>$this->input->post("valor_empresa3",true),
                    "valor_empresa_4"=>$this->input->post("valor_empresa4",true),
                    "fecha"=>date('Y-m-d'),
                    "valor_extra"=>$this->input->post("valor_extra",true),                        
                    "total_merma"=>$this->input->post("total_merma",true),                        
                    "total_merma2"=>$this->input->post("total_merma2",true),                        
                    "total_merma3"=>$this->input->post("total_merma3",true),                        
                    "total_merma4"=>$this->input->post("total_merma4",true),                        
                    "kilos_placa"=>$this->input->post("placa_kilo",true),                        
                    "placa_kilo"=>$this->input->post("placa_kilo",true),                        
                    "onda_kilo"=>$this->input->post("onda_kilo",true),                        
                    "kilos_onda"=>$this->input->post("kilos_onda",true),                        
                    "kilos_liner"=>$this->input->post("kilos_liner",true),                        
                    "total_pliegos"=>$this->input->post("total_pliegos",true),                        
                    "impreso"=>$impreso,                        
                );
        
            $data_act=array
                (
                    "precio_1"=>$this->input->post("valor_empresa",true),    
                    "precio_2"=>$this->input->post("valor_empresa2",true),    
                    "precio_3"=>$this->input->post("valor_empresa3",true),    
                    "precio_4"=>$this->input->post("valor_empresa4",true),    
                    "pegado_migrado"=>$pegado,
                    "margen_migrado"=>$margen,
                    "dias_de_entrega"=>$this->input->post("dias_de_entrega",true),                
                    "precio_migrado"=>$this->input->post("valor_empresa",true),                
                    "precio_migrado2"=>$this->input->post("valor_empresa2",true),                
                    "precio_migrado3"=>$this->input->post("valor_empresa3",true),                
                    "precio_migrado4"=>$this->input->post("valor_empresa4",true),                
                );
            
            $data_alt=array
                (
                    "id_cotizacion"=>$this->input->post("id",true),
                    "despacho_fuera_de_santiago"=>$despacho_fuera_de_santiago,                
                    "retira_cliente"=>$retira_cliente,                
                );
  
            if(sizeof($hoja)==0)
            { 
                $this->db->insert("hoja_de_costos_datos",$data);
                $this->db->insert("hoja_de_costos_cambios",$data);
                $this->db->insert("hoja_de_costos_alt",$data_alt);
                $this->db->where('id', $this->input->post('id',true));
                $this->db->update("cotizaciones",$data_act);
            }else
            {
                $this->db->where('id_cotizacion', $this->input->post('id',true));
                $this->db->update("hoja_de_costos_datos",$data);
                $this->db->where('id_cotizacion', $this->input->post('id',true));
                $this->db->update("hoja_de_costos_cambios",$data);
                $this->db->where('id_cotizacion', $this->input->post('id',true));
                $this->db->update("hoja_de_costos_alt",$data_alt);
                $this->db->where('id', $this->input->post('id',true));
                $this->db->update("cotizaciones",$data_act);
                 //exit(print_r($data));
            }
            $data2=array
                (
                    "id_cotizacion"=>$this->input->post("id",true),
                    "seccion"=>"Se guardó completa Hoja de Costos",
                    "glosa"=>"Se guardó completa Hoja de Costos",
                    "quien"=>$this->session->userdata('id'),
                    "cuando"=>date("Y-m-d"),
                );
                $this->db->insert("hoja_de_costos",$data2);    
            $this->session->set_flashdata('ControllerMessage', 'Se ha modificado Hoja de Costos exitosamente.');
            redirect($this->input->post("url",true),  301);
        }else
        {
            show_404();
        }
        
    }
    public function forma_pago($id=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        if($this->input->post())
        {
             $data=array
            (
                "forma_pago"=>$this->input->post("forma_pago",true),
            );
            $this->db->where('id', $this->input->post('id',true));
            $this->db->update("cotizaciones",$data);
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Forma de Pago -> Solicitud de Cotización",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('forma_pago',compact('id','pagina','datos'));  
    }
    public function moldes($id=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        if($this->input->post())
        {
             $data=array
            (
                "estan_los_moldes"=>$this->input->post("estan_los_moldes",true),
                "numero_molde"=>$this->input->post("molde",true),
            );
            $this->db->where('id_cotizacion', $this->input->post('id',true));
            $this->db->update("cotizacion_fotomecanica",$data);
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Moldes -> Fotomecánica",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('moldes',compact('id','pagina','fotomecanica'));  
    }
    public function impresion($id=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        if($this->input->post())
        {
             $data=array
            (
                "impresion"=>$this->input->post("impresion",true),
            );
            $this->db->where('id_cotizacion', $this->input->post('id',true));
            $this->db->update("cotizacion_fotomecanica",$data);
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Impresión -> Fotomecánica",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('impresion',compact('id','pagina','fotomecanica'));  
    }
    public function materialidad($id=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        if($this->input->post())
        {
             switch($this->input->post("datos_tecnicos"))
                               {
                                    case '1':
                                        $datos_tecnicos="Microcorrugado";
                                    break;
                                    case '2':
                                        $datos_tecnicos="Corrugado";
                                    break;
                                    case '3':
                                        $datos_tecnicos="Cartulina-cartulina";
                                    break;
                                    case '4':
                                        $datos_tecnicos="Sólo Cartulina";
                                    break;
                                    case '5':
                                        $datos_tecnicos="Onda a la Vista ( Micro/Micro )";
                                    break;
                                    case '6':
                                        $datos_tecnicos="Otro";
                                    break;
                                    case '7':
                                        $datos_tecnicos="Se solicita proposición";
                                    break;
                               }
//                               $data=array
//            (
//                "materialidad_datos_tecnicos"=>$datos_tecnicos,
//                "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),
//                "materialidad_1"=>$this->input->post("materialidad_1",true),
//                "materialidad_2"=>$this->input->post("materialidad_2",true),
//                "materialidad_3"=>$this->input->post("materialidad_3",true),
//                "materialidad_4"=>$this->input->post("materialidad_4",true),
//            );
            $data=array
            (
                "materialidad_datos_tecnicos"=>$datos_tecnicos,
                "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),
                "id_mat_placa1"=>$this->input->post("materialidad_1",true),
                "id_mat_onda2"=>$this->input->post("materialidad_2",true),
                "id_mat_liner3"=>$this->input->post("materialidad_3",true),
                "materialidad_4"=>$this->input->post("materialidad_4",true),
            );
            //print_r($data);exit();
            $this->db->where('id_cotizacion', $this->input->post('id',true));
            $this->db->update("cotizacion_fotomecanica",$data);
            
            $this->db->where('id_cotizacion', $this->input->post('id',true));
            $this->db->update("cotizacion_ingenieria",$data);
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Materialidad -> Fotomecánica",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('materialidad',compact('id','pagina','datos','fotomecanica'));  
    }
    public function cantidad($id=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        if($this->input->post())
        {
             $data=array
            (
                "cantidad_1"=>$this->input->post("cantidad_1",true),
                "precio_1"=>"0",
                "precio_migrado"=>"0",
            );
            $this->db->where('id', $this->input->post('id',true));
            $this->db->update("cotizaciones",$data);
             $data=array
            (
                "cantidad_1"=>$this->input->post("cantidad_1",true),
            );
            $this->db->where('id', $this->input->post('id',true));
            $this->db->update("cotizaciones",$data);
            
             $data=array
                        (
                            "valor_empresa"=>"0",
                        );
            
            $this->db->where('id_cotizacion', $this->input->post('id',true));
            $this->db->update("hoja_de_costos_datos",$data);
            
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Cantidad -> Solicitud de Cotización",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('cantidad',compact('id','pagina','datos'));  
    }
    public function molde_troquel($id=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        $proveedores=$this->proveedores_model->getProveedores();
        $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
        if($this->input->post())
        {
             $data=array
            (
                "molde_troquel"=>$this->input->post("molde_troquel",true),
            );
            
            $this->db->where('id_cotizacion', $this->input->post('id',true));
            $this->db->update("hoja_de_costos_datos",$data);
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Molde Troquel -> Solicitud de Cotización",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('molde_troquel',compact('id','pagina','datos','hoja','proveedores','ing'));  
    }
    public function despacho($id=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        $proveedores=$this->proveedores_model->getProveedores();
        $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
        if($this->input->post())
        {
             $data=array
            (
                "retira_cliente"=>$this->input->post("retira_cliente",true),
            );
            
            $this->db->where('id', $this->input->post('id',true));
            $this->db->update("cotizaciones",$data);
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Despacho -> Solicitud de Cotización",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('despacho',compact('id','pagina','datos','hoja','proveedores','ing'));  
    }
    public function tiraje1($id=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        $proveedores=$this->proveedores_model->getProveedores();
        $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
        if($this->input->post())
        {
             $data=array
            (
                "tiraje1"=>$this->input->post("tiraje1",true),
                "proveedor1"=>$this->input->post("proveedor1",true),
            );
            $this->db->where('id_cotizacion', $this->input->post('id',true));
            $this->db->update("hoja_de_costos_datos",$data);
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Tiraje -> Solicitud de Cotización",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('tiraje1',compact('id','pagina','datos','hoja','proveedores','ing'));  
    }
    public function tiraje2($id=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        $proveedores=$this->proveedores_model->getProveedores();
        $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
        if($this->input->post())
        {
             $data=array
            (
                "tiraje2"=>$this->input->post("tiraje2",true),
                "proveedor2"=>$this->input->post("proveedor2",true),
            );
            $this->db->where('id_cotizacion', $this->input->post('id',true));
            $this->db->update("hoja_de_costos_datos",$data);
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Tiraje -> Solicitud de Cotización",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('tiraje2',compact('id','pagina','datos','hoja','proveedores','ing'));  
    }
    public function tiraje3($id=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        $proveedores=$this->proveedores_model->getProveedores();
        $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
        if($this->input->post())
        {
             $data=array
            (
                "tiraje3"=>$this->input->post("tiraje3",true),
                "proveedor3"=>$this->input->post("proveedor3",true),
            );
            $this->db->where('id_cotizacion', $this->input->post('id',true));
            $this->db->update("hoja_de_costos_datos",$data);
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Tiraje -> Solicitud de Cotización",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('tiraje3',compact('id','pagina','datos','hoja','proveedores','ing'));  
    }
    public function tiraje4($id=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        $proveedores=$this->proveedores_model->getProveedores();
        $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
        if($this->input->post())
        {
             $data=array
            (
                "tiraje4"=>$this->input->post("tiraje4",true),
                "proveedor4"=>$this->input->post("proveedor4",true),
            );
            $this->db->where('id_cotizacion', $this->input->post('id',true));
            $this->db->update("hoja_de_costos_datos",$data);
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Tiraje -> Solicitud de Cotización",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('tiraje4',compact('id','pagina','datos','hoja','proveedores','ing'));  
    }
    public function cantidad2($id=null,$valor=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
      //  echo $this->input->post('url');exit();
        if($this->input->post())
        {
             switch($valor)
             {
                case '2':
                    $data=array
                        (
                            "cantidad_2"=>$this->input->post("cantidad_1",true),
                            "precio_2"=>"0",
                            "precio_migrado2"=>"0",
                        );
                        
                break;  
                case '3':
                    $data=array
                        (
                            "cantidad_3"=>$this->input->post("cantidad_1",true),
                            "precio_3"=>"0",
                            "precio_migrado3"=>"0",
                        );
                break;
                case '4':
                    $data=array
                        (
                            "cantidad_4"=>$this->input->post("cantidad_1",true),
                            "precio_4"=>"0",
                            "precio_migrado4"=>"0",
                        );
                break;              
             }
             
            $this->db->where('id', $this->input->post('id',true));
            $this->db->update("cotizaciones",$data);
            
             $data=array
                        (
                            "valor_empresa_2"=>"0",
                        );
            
            $this->db->where('id_cotizacion', $this->input->post('id',true));
            $this->db->update("hoja_de_costos_datos",$data);
            
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Cantidad ".$valor." -> Solicitud de Cotización",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        switch($valor)
             {
                case '2':
                    $cantidad=$datos->cantidad_2;
                break;  
                case '3':
                    $cantidad=$datos->cantidad_3;
                break;
                case '4':
                    $cantidad=$datos->cantidad_4;
                break;              
             }
        $this->layout->view('cantidad2',compact('id','valor','datos','cantidad'));  
    }
    public function cantidad3($id=null,$valor=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        if($this->input->post())
        {
             switch($valor)
             {
                case '2':
                    $data=array
                        (
                            "cantidad_2"=>$this->input->post("cantidad_1",true),
                            "precio_2"=>"0",
                            "precio_migrado2"=>"0",
                        );
                        
                break;  
                case '3':
                    $data=array
                        (
                            "cantidad_3"=>$this->input->post("cantidad_1",true),
                            "precio_3"=>"0",
                            "precio_migrado3"=>"0",
                        );
                break;
                case '4':
                    $data=array
                        (
                            "cantidad_4"=>$this->input->post("cantidad_1",true),
                            "precio_4"=>"0",
                            "precio_migrado4"=>"0",
                        );
                break;              
             }
             
            $this->db->where('id', $this->input->post('id',true));
            $this->db->update("cotizaciones",$data);
            
             $data=array
                        (
                            "valor_empresa_3"=>"0",
                        );
            
            $this->db->where('id_cotizacion', $this->input->post('id',true));
            $this->db->update("hoja_de_costos_datos",$data);
            
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Cantidad ".$valor." -> Solicitud de Cotización",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        switch($valor)
             {
                case '2':
                    $cantidad=$datos->cantidad_2;
                break;  
                case '3':
                    $cantidad=$datos->cantidad_3;
                break;
                case '4':
                    $cantidad=$datos->cantidad_4;
                break;              
             }
        $this->layout->view('cantidad2',compact('id','valor','datos','cantidad'));  
    }
    public function cantidad4($id=null,$valor=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        if($this->input->post())
        {
             switch($valor)
             {
                case '2':
                    $data=array
                        (
                            "cantidad_2"=>$this->input->post("cantidad_1",true),
                            "precio_2"=>"0",
                            "precio_migrado2"=>"0",
                        );
                        
                break;  
                case '3':
                    $data=array
                        (
                            "cantidad_3"=>$this->input->post("cantidad_1",true),
                            "precio_3"=>"0",
                            "precio_migrado3"=>"0",
                        );
                break;
                case '4':
                    $data=array
                        (
                            "cantidad_4"=>$this->input->post("cantidad_1",true),
                            "precio_4"=>"0",
                            "precio_migrado4"=>"0",
                        );
                break;              
             }
             
            $this->db->where('id', $this->input->post('id',true));
            $this->db->update("cotizaciones",$data);
            
            $data=array
                        (
                            "valor_empresa_4"=>"0",
                        );
            
            $this->db->where('id_cotizacion', $this->input->post('id',true));
            $this->db->update("hoja_de_costos_datos",$data);
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Cantidad ".$valor." -> Solicitud de Cotización",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        switch($valor)
             {
                case '2':
                    $cantidad=$datos->cantidad_2;
                break;  
                case '3':
                    $cantidad=$datos->cantidad_3;
                break;
                case '4':
                    $cantidad=$datos->cantidad_4;
                break;              
             }
        $this->layout->view('cantidad4',compact('id','valor','datos','cantidad'));  
    }
     public function colores_fotomecanica($id=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        if($this->input->post())
        {
             $data=array
            (
                "colores"=>$this->input->post("colores",true),
            );
            $this->db->where('id_cotizacion', $this->input->post('id',true));
            $this->db->update("cotizacion_fotomecanica",$data);
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Colores -> Fotomecánica",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('colores_fotomecanica',compact('id','pagina','fotomecanica'));  
    }
     public function cambio_vendedor($id=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $vendedores=$this->vendedores_model->getVendedoresSelect();
        if($this->input->post())
        {
             $data=array
            (
                "id_vendedor"=>$this->input->post("id_vendedor",true),
            );
            //print_r($data);exit();
            $this->db->where('id', $this->input->post('id',true));
            $this->db->update("cotizaciones",$data);
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Vendedor -> Cotizacion",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('cambio_vendedor',compact('id','pagina','datos','vendedores'));  
    }
     public function cambio_barniz($id=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $vendedores=$this->vendedores_model->getVendedoresSelect();
        if($this->input->post())
        {
             $data=array
            (
                "fot_lleva_barniz"=>$this->input->post("fot_lleva_barniz",true),
            );
            //print_r($data);exit();
            $this->db->where('id_cotizacion', $this->input->post('id',true));
            $this->db->update("cotizacion_fotomecanica",$data);
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Barniz -> Tipo",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('cambio_barniz',compact('id','pagina','datos','vendedores','fotomecanica'));  
    }
     public function acepta_excedentes($id=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $vendedores=$this->vendedores_model->getVendedoresSelect();
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        if($this->input->post())
        {
            if(sizeof($hoja)==0)
            {
             $data=array
            (
                "acepta_excedentes"=>$this->input->post("acepta_excedentes",true),
                "acepta_excedentes_extra"=>$this->input->post("acepta_excedentes_extra",true),
            );
            //print_r($data);exit();
            $this->db->where('id', $this->input->post('id',true));
            $this->db->update("cotizaciones",$data);
             
            $data_cot=array
            (
                "valor_acepeta_exce"=>$this->input->post("valor_acepeta_exce",true),
                "id_cotizacion"=>$this->input->post('id',true),
            );
            $this->db->insert("hoja_de_costos_datos",$data_cot);
            
            }else{
            $data=array
            (
                "acepta_excedentes"=>$this->input->post("acepta_excedentes",true),
                "acepta_excedentes_extra"=>$this->input->post("acepta_excedentes_extra",true),
            );
            //print_r($data);exit();
            $this->db->where('id', $this->input->post('id',true));
            $this->db->update("cotizaciones",$data);
            
            $data_cot=array
            (
                "valor_acepeta_exce"=>$this->input->post("valor_acepeta_exce",true),
            );
            $this->db->where("id_cotizacion",$this->input->post('id',true));
            $this->db->update("hoja_de_costos_datos",$data_cot);
            }
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Acepta Excedentes -> Cambio Excedentes",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('acepta_excedentes',compact('id','pagina','datos','vendedores','fotomecanica'));  
    }
     public function visto_bueno($id=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $vendedores=$this->vendedores_model->getVendedoresSelect();
        if($this->input->post())
        {
             $data=array
            (
                "vb_maquina"=>$this->input->post("vb_maquina",true),
            );
            //print_r($data);exit();
            $this->db->where('id', $this->input->post('id',true));
            $this->db->update("cotizaciones",$data);
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"VB Maquina -> Cambio VB Maquina",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('visto_bueno',compact('id','pagina','datos','vendedores','fotomecanica'));  
    }
    public function datos_fotomecanica($id=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        if($this->input->post())
        {
             $data=array
            (
                "fot_reserva_barniz"=>$this->input->post("fot_reserva_barniz",true),
                "fot_lleva_barniz"=>$this->input->post("fot_lleva_barniz",true),
            );
            $this->db->where('id_cotizacion', $this->input->post('id',true));
            $this->db->update("cotizacion_fotomecanica",$data);
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Barniz -> Fotomecánica",
                "glosa"=>$this->input->post("glosa",true),

                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('datos_fotomecanica',compact('id','pagina','fotomecanica'));  
    }
    public function cambios($id=null)
    {
        if($this->session->userdata('id'))
        {
            $datos=$this->cotizaciones_model->getCambiosHojaDeCostos($id);
            $this->layout->view('cambios',compact('id','datos'));
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    /**
     * modificación campos específicos de hoja de costos
     * */
    public function valor_empresa($id=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        //print_r($hoja);exit;
        if($this->input->post())
        {
             
            if(sizeof($hoja)==0)
            {
                
                $data=array
                (
                    "id_usuario"=>$this->session->userdata('id'),
                    "id_cotizacion"=>$this->input->post("id",true),
                    "valor_empresa"=>$this->input->post("valor_empresa",true),
                    "pegado"=>$this->input->post("pegado",true),
                    "costo_adicional"=>'0',
                    "dias_de_entrega"=>'20',
                    "margen"=>'15',
                    "valor_acabado_1"=>'0',
                    "valor_acabado_2"=>'0',
                    "valor_acabado_3"=>'0',
                );
//                    echo "guardo101";
//                    exit(print_r($data));    
                
                $this->db->insert("hoja_de_costos_datos",$data);
                
                $data=array
                (
                    "precio_migrado"=>$this->input->post("valor_empresa",true),
                );
               
                 $this->db->where('id', $this->input->post('id',true));
                 $this->db->update("cotizaciones",$data);
            }else
            {
               $data=array
                (
                    "valor_empresa"=>$this->input->post("valor_empresa",true),
                );
                 $this->db->where('id_cotizacion', $this->input->post('id',true));
                 $this->db->update("hoja_de_costos_datos",$data);
               
               $data=array
                (
                    "precio_migrado"=>$this->input->post("valor_empresa",true),
                );
               
                 $this->db->where('id', $this->input->post('id',true));
                 $this->db->update("cotizaciones",$data);
            }
            
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Valor empresa -> Hoja de Costos",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('valor_empresa',compact('id','pagina','fotomecanica','hoja'));  
    }
    public function pegado($id=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
		
		
		
		
        if($this->input->post())
        {
             
            if(sizeof($hoja)==0)
            {

                $data=array
                (
                    "id_usuario"=>$this->session->userdata('id'),
                    "id_cotizacion"=>$this->input->post("id",true),
                    "valor_empresa"=>$this->input->post("valor_empresa",true),
                    "pegado"=>$this->input->post("pegado",true),
                    "costo_adicional"=>'0',
                    "dias_de_entrega"=>'20',
                    "margen"=>'15',
                    "valor_acabado_1"=>'0',
                    "valor_acabado_2"=>'0',
                    "valor_acabado_3"=>'0',
                );
//                    echo "guardo4";
//                    exit(print_r($data));                    
                $this->db->insert("hoja_de_costos_datos",$data);
            }else
            {
               $data=array
                (
                    "pegado"=>$this->input->post("pegado",true),
                );
                 $this->db->where('id_cotizacion', $this->input->post('id',true));
                 $this->db->update("hoja_de_costos_datos",$data);
            }
            
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Pegado -> Hoja de Costos",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('pegado',compact('id','pagina','fotomecanica','hoja'));  
    }
    public function costo_adicional($id=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        //print_r($hoja);exit;
        if($this->input->post())
        {
             
            if(sizeof($hoja)==0)
            {
                
                $data=array
                (
                    "id_usuario"=>$this->session->userdata('id'),
                    "id_cotizacion"=>$this->input->post("id",true),
                    "valor_empresa"=>'0',
                    "pegado"=>'0',
                    "costo_adicional"=>$this->input->post("costo_adicional",true),
                    "dias_de_entrega"=>'20',
                    "margen"=>'15',
                    "valor_acabado_1"=>'0',
                    "valor_acabado_2"=>'0',
                    "valor_acabado_3"=>'0',
                );
//                    echo "guardo5";
//                    exit(print_r($data));                    
                $this->db->insert("hoja_de_costos_datos",$data);
            }else
            {
               $data=array
                (
                    "costo_adicional"=>$this->input->post("costo_adicional",true),
                );
                 $this->db->where('id_cotizacion', $this->input->post('id',true));
                 $this->db->update("hoja_de_costos_datos",$data);
            }
            
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Costo Adicional -> Hoja de Costos",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('costo_adicional',compact('id','pagina','fotomecanica','hoja'));  
    }
    public function dias($id=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        //print_r($hoja);exit;
        if($this->input->post())
        {
             
            if(sizeof($hoja)==0)
            {
                
                $data=array
                (
                    "id_usuario"=>$this->session->userdata('id'),
                    "id_cotizacion"=>$this->input->post("id",true),
                    "valor_empresa"=>'0',
                    "pegado"=>'0',
                    "costo_adicional"=>'0',
                    "dias_de_entrega"=>$this->input->post("dias_de_entrega",true),
                    "margen"=>'15',
                    "valor_acabado_1"=>'0',
                    "valor_acabado_2"=>'0',
                    "valor_acabado_3"=>'0',
                );
//                    echo "guardo6";
//                    exit(print_r($data));                    
                $this->db->insert("hoja_de_costos_datos",$data);
            }else
            {
               $data=array
                (
                    "dias_de_entrega"=>$this->input->post("dias_de_entrega",true),
                );
                 $this->db->where('id_cotizacion', $this->input->post('id',true));
                 $this->db->update("hoja_de_costos_datos",$data);
            }
            
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Costo Adicional -> Hoja de Costos",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('dias',compact('id','pagina','fotomecanica','hoja'));  
    }
    public function margen($id=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $presupuesto=$this->cotizaciones_model->getCotizacionCotizacionPrespuestoPorIdCotizacion($id);
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        if($this->input->post())
        {
            if(sizeof($hoja)==0)
            {
                
                $data=array
                (
                    "id_usuario"=>$this->session->userdata('id'),
                    "id_cotizacion"=>$this->input->post("id",true),
                    "valor_empresa"=>'0',
                    "pegado"=>'0',
                    "costo_adicional"=>'0',
                    "dias_de_entrega"=>'20',
                    "margen"=>$this->input->post("margen",true),
                    "valor_acabado_1"=>'0',
                    "valor_acabado_2"=>'0',
                    "valor_acabado_3"=>'0',
                );
//                    echo "guardo7";
//                    exit(print_r($data));                    
                $this->db->insert("hoja_de_costos_datos",$data);
            }else
            {
               $data=array
                (
                    "margen"=>$this->input->post("margen",true),
                );
                 $this->db->where('id_cotizacion', $this->input->post('id',true));
                 $this->db->update("hoja_de_costos_datos",$data);
            }
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Margen -> Hoja de Costos",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('margen',compact('id','pagina','fotomecanica','hoja'));  
    }
    public function trabajos_externos($id=null,$valor=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $presupuesto=$this->cotizaciones_model->getCotizacionCotizacionPrespuestoPorIdCotizacion($id);
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        if($this->input->post())
        {
            if(sizeof($hoja)==0)
            {
//                exit($valor);
               
                        $data=array
                        (
                            "id_usuario"=>$this->session->userdata('id'),
                            "id_cotizacion"=>$this->input->post("id",true),
                            "valor_externo"=>$this->input->post("valor_externo",true),                           
                        );
              
                $this->db->insert("hoja_de_costos_datos",$data);
            }else
            {           $data=array
                            (
                                "valor_externo"=>$this->input->post("valor_externo",true),
                            );
               
                 $this->db->where('id_cotizacion', $this->input->post('id',true));
                 $this->db->update("hoja_de_costos_datos",$data);
            }
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Trabajos externos -> Hoja de Costos",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('trabajos_externos',compact('id','pagina','fotomecanica','hoja'));  
    }
     
        public function valor_empresa_2($id=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        //print_r($hoja);exit;
       // echo $this->input->post("valor_empresa",true);
        if($this->input->post())
        {
             
            if(sizeof($hoja)==0)
            {
                
                $data=array
                (
                    "id_usuario"=>$this->session->userdata('id'),
                    "id_cotizacion"=>$this->input->post("id",true),
                    "valor_empresa_2"=>$this->input->post("valor_empresa",true),
                    "pegado"=>'0',
                    "costo_adicional"=>'0',
                    "dias_de_entrega"=>'20',
                    "margen"=>'15',
                    "valor_acabado_1"=>'0',
                    "valor_acabado_2"=>'0',
                    "valor_acabado_3"=>'0',
                );
//                    echo "guardo101";

                
                $this->db->insert("hoja_de_costos_datos",$data);
            }else
            {//echo $this->input->post("valor_empresa",true);
               $data=array
                (
                    "valor_empresa_2"=>$this->input->post("valor_empresa",true),
                );
                                   //exit(print_r($data));    
                 $this->db->where('id_cotizacion', $this->input->post('id',true));
                 $this->db->update("hoja_de_costos_datos",$data);
                 
                 $data=array
                (
                    "precio_migrado2"=>$this->input->post("valor_empresa",true),
                );
                 $this->db->where('id', $this->input->post('id',true));
                 $this->db->update("cotizaciones",$data);
            }
            
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Valor empresa -> Hoja de Costos",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('valor_empresa_2',compact('id','pagina','fotomecanica','hoja'));  
    }
        public function valor_empresa_3($id=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        //print_r($hoja);exit;
       // echo $this->input->post("valor_empresa",true);
        if($this->input->post())
        {
             
            if(sizeof($hoja)==0)
            {
                
                $data=array
                (
                    "id_usuario"=>$this->session->userdata('id'),
                    "id_cotizacion"=>$this->input->post("id",true),
                    "valor_empresa_3"=>$this->input->post("valor_empresa",true),
                    "pegado"=>'0',
                    "costo_adicional"=>'0',
                    "dias_de_entrega"=>'20',
                    "margen"=>'15',
                    "valor_acabado_1"=>'0',
                    "valor_acabado_2"=>'0',
                    "valor_acabado_3"=>'0',
                );
//                    echo "guardo101";

                
                $this->db->insert("hoja_de_costos_datos",$data);
            }else
            {//echo $this->input->post("valor_empresa",true);
               $data=array
                (
                    "valor_empresa_3"=>$this->input->post("valor_empresa",true),
                );
                                   //exit(print_r($data));    
                 $this->db->where('id_cotizacion', $this->input->post('id',true));
                 $this->db->update("hoja_de_costos_datos",$data);
                 $data=array
                (
                    "precio_migrado3"=>$this->input->post("valor_empresa",true),
                );
                 $this->db->where('id', $this->input->post('id',true));
                 $this->db->update("cotizaciones",$data);
                 
            }
            
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Valor empresa -> Hoja de Costos",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('valor_empresa_3',compact('id','pagina','fotomecanica','hoja'));  
    }
        public function valor_empresa_4($id=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        //print_r($hoja);exit;
       // echo $this->input->post("valor_empresa",true);
        if($this->input->post())
        {
             
            if(sizeof($hoja)==0)
            {
                
                $data=array
                (
                    "id_usuario"=>$this->session->userdata('id'),
                    "id_cotizacion"=>$this->input->post("id",true),
                    "valor_empresa_3"=>$this->input->post("valor_empresa",true),
                    "pegado"=>'0',
                    "costo_adicional"=>'0',
                    "dias_de_entrega"=>'20',
                    "margen"=>'15',
                    "valor_acabado_1"=>'0',
                    "valor_acabado_2"=>'0',
                    "valor_acabado_3"=>'0',
                );
//                    echo "guardo101";

                
                $this->db->insert("hoja_de_costos_datos",$data);
            }else
            {//echo $this->input->post("valor_empresa",true);
               $data=array
                (
                    "valor_empresa_4"=>$this->input->post("valor_empresa",true),
                );
                                   //exit(print_r($data));    
                 $this->db->where('id_cotizacion', $this->input->post('id',true));
                 $this->db->update("hoja_de_costos_datos",$data);
                 
                 $data=array
                (
                    "precio_migrado4"=>$this->input->post("valor_empresa",true),
                );
                 $this->db->where('id', $this->input->post('id',true));
                 $this->db->update("cotizaciones",$data);
            }
            
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Valor empresa -> Hoja de Costos",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('valor_empresa_4',compact('id','pagina','fotomecanica','hoja'));  
    }
     public function valor_empresa_22($id=null,$valor=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $presupuesto=$this->cotizaciones_model->getCotizacionCotizacionPrespuestoPorIdCotizacion($id);
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        if($this->input->post())
        {
            echo sizeof($hoja);
            if(sizeof($hoja)==0)
            {
                
                switch($valor)
                {
                    case '2':
                        $data=array
                        (
                            "id_usuario"=>$this->session->userdata('id'),
                            "id_cotizacion"=>$this->input->post("id",true),
                            "valor_empresa"=>'0',
                            "pegado"=>'0',
                            "costo_adicional"=>'0',
                            "dias_de_entrega"=>'20',
                            "margen"=>'15',
                            "valor_acabado_1"=>'0',
                            "valor_acabado_2"=>'0',
                            "valor_acabado_3"=>'0',
                            "valor_empresa_2"=>$this->input->post("valor",true),
                            "valor_empresa_3"=>'0',
                            "valor_empresa_4"=>'0',
                        );
                    break;
                    case '3':
                        $data=array
                        (
                            "id_usuario"=>$this->session->userdata('id'),
                            "id_cotizacion"=>$this->input->post("id",true),
                            "valor_empresa"=>'0',
                            "pegado"=>'0',
                            "costo_adicional"=>'0',
                            "dias_de_entrega"=>'20',
                            "margen"=>'15',
                            "valor_acabado_1"=>'0',
                            "valor_acabado_2"=>'0',
                            "valor_acabado_3"=>'0',
                            "valor_empresa_2"=>'0',
                            "valor_empresa_3"=>$this->input->post("valor",true),
                            "valor_empresa_4"=>'0',
                        );
                    break;
                    case '4':
                        $data=array
                        (
                            "id_usuario"=>$this->session->userdata('id'),
                            "id_cotizacion"=>$this->input->post("id",true),
                            "valor_empresa"=>'0',
                            "pegado"=>'0',
                            "costo_adicional"=>'0',
                            "dias_de_entrega"=>'20',
                            "margen"=>'15',
                            "valor_acabado_1"=>'0',
                            "valor_acabado_2"=>'0',
                            "valor_acabado_3"=>'0',
                            "valor_empresa_2"=>'0',
                            "valor_empresa_3"=>'0',
                            "valor_empresa_4"=>$this->input->post("valor",true),
                        );
                    break;
                }
//                    echo "guardo9";
               //    exit(print_r($data));                    
                $this->db->insert("hoja_de_costos_datos",$data);
            }else
            {
               
                switch($valor)
                {
                    case '2':
                        $data=array
                            (
                                "valor_empresa_2"=>$this->input->post("valor",true),
                            );
                    break;
                    case '3':
                        $data=array
                            (
                                "valor_empresa_3"=>$this->input->post("valor",true),
                            );
                    break;
                    case '4':
                        $data=array
                            (
                                "valor_empresa_4"=>$this->input->post("valor",true),
                            );
                    break;
                }
               // exit(print_r($data));
                 $this->db->where('id_cotizacion', $this->input->post('id',true));
                 $this->db->update("hoja_de_costos_datos",$data);
            }
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Trabajos externos -> Hoja de Costos",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        if(sizeof($hoja)==0)
        {
            $cantidad='0';
        }else
        {
            switch($valor)
             {
                case '2':
                    $cantidad=$hoja->valor_empresa_2;
                break;  
                case '3':
                    $cantidad=$hoja->valor_empresa_3;
                break;
                case '4':
                    $cantidad=$hoja->valor_empresa_4;
                break;              
             }
        }
        
        $this->layout->view('valor_empresa2',compact('id','pagina','fotomecanica','hoja','valor','cantidad'));  
    }
	
	
	public function pieza_adicional1($id=null,$valor=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $presupuesto=$this->cotizaciones_model->getCotizacionCotizacionPrespuestoPorIdCotizacion($id);
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        if($this->input->post())
        {
            if(sizeof($hoja)==0)
            {
                
                switch($valor)
                {
                    case '1':
                        $data=array
                        (
                            "id_usuario"=>$this->session->userdata('id'),
                            "id_cotizacion"=>$this->input->post("id",true),
                            "valor_empresa"=>'0',
                            "pegado"=>'0',
                            "costo_adicional"=>'0',
                            "dias_de_entrega"=>'20',
                            "margen"=>'15',
                            "piezas_adicionales1"=>$this->input->post("valor",true),
							
                        );
                    break;
                    case '2':
                        $data=array
                        (
                           "id_usuario"=>$this->session->userdata('id'),
                            "id_cotizacion"=>$this->input->post("id",true),
                            "valor_empresa"=>'0',
                            "pegado"=>'0',
                            "costo_adicional"=>'0',
                            "dias_de_entrega"=>'20',
                            "margen"=>'15',
                            "piezas_adicionales2"=>$this->input->post("valor",true),
                        );
                    break;
                    case '3':
                        $data=array
                        (
                            "id_usuario"=>$this->session->userdata('id'),
                            "id_cotizacion"=>$this->input->post("id",true),
                            "valor_empresa"=>'0',
                            "pegado"=>'0',
                            "costo_adicional"=>'0',
                            "dias_de_entrega"=>'20',
                            "margen"=>'15',
                            "piezas_adicionales3"=>$this->input->post("valor",true),
                        );
                    break;
                }
//                    echo "guardo10";
//                    exit(print_r($data));                    
                $this->db->insert("hoja_de_costos_datos",$data);
            }else
            {
               
                switch($valor)
                {
                    case '1':
                        $data=array
                            (
                                "piezas_adicionales1"=>$this->input->post("valor",true),
                            );
                    break;
                    case '2':
                        $data=array
                            (
                                 "piezas_adicionales2"=>$this->input->post("valor",true),
                            );
                    break;
                    case '3':
                        $data=array
                            (
                                 "piezas_adicionales3"=>$this->input->post("valor",true),
                            );
                    break;
                }
                 $this->db->where('id_cotizacion', $this->input->post('id',true));
                 $this->db->update("hoja_de_costos_datos",$data);
            }
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Trabajos externos -> Hoja de Costos",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('pieza_adicional1',compact('id','pagina','fotomecanica','hoja'));  
    }
    
    public function valores_extras($id=null,$valor=null)
    {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $presupuesto=$this->cotizaciones_model->getCotizacionCotizacionPrespuestoPorIdCotizacion($id);
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        if($this->input->post())
        {
            if(sizeof($hoja)==0)
            {
//                exit($valor);
                switch($valor)
                {
                    case '1':
                        $data=array
                        (
                            "id_usuario"=>$this->session->userdata('id'),
                            "id_cotizacion"=>$this->input->post("id",true),
                            "valor_extra"=>$this->input->post("valor",true),
                            "valor_bv_maquina"=>'0',
                            "valor_acepeta_exce"=>'0',
                        );
                    break;
                    case '2':
                        $data=array
                        (
                            "id_usuario"=>$this->session->userdata('id'),
                            "id_cotizacion"=>$this->input->post("id",true),
                            "valor_extra"=>'0',
                            "valor_bv_maquina"=>$this->input->post("valor",true),
                            "valor_acepeta_exce"=>'0',                          
                        );
                    break;
                    case '3':
                        $data=array
                        (
                            "id_usuario"=>$this->session->userdata('id'),
                            "id_cotizacion"=>$this->input->post("id",true),
                            "valor_extra"=>'0',
                            "valor_bv_maquina"=>'0',
                            "valor_acepeta_exce"=>$this->input->post("valor",true),                              
                        );
                    break;
                }
                $this->db->insert("hoja_de_costos_datos",$data);
            }else
            {
               
                switch($valor)
                {
                    case '1':
                        $data=array
                            (
                                "valor_extra"=>$this->input->post("valor",true),
                            );
                    break;
                    case '2':
                        $data=array
                            (
                                "valor_bv_maquina"=>$this->input->post("valor",true),
                            );
                    break;
                    case '3':
                        $data=array
                            (
                                "valor_acepeta_exce"=>$this->input->post("valor",true),
                            );
                    break;
                }
                 $this->db->where('id_cotizacion', $this->input->post('id',true));
                 $this->db->update("hoja_de_costos_datos",$data);
            }
            $data2=array
            (
                "id_cotizacion"=>$this->input->post("id",true),
                "seccion"=>"Valores Extras -> Hoja de Costos",
                "glosa"=>$this->input->post("glosa",true),
                "quien"=>$this->session->userdata('id'),
                "cuando"=>date("Y-m-d"),
            );
            $this->db->insert("hoja_de_costos",$data2);
             $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             redirect($this->input->post("url",true),  301);
        }
        $this->layout->view('valores_extras',compact('id','pagina','fotomecanica','hoja'));  
    }    
	
	
	
}
