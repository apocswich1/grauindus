<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produccion extends CI_Controller {


    private $session_id;
    public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('backend_rojo');
      
    }
    
    public function cotizaciones()
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
        $datos=$this->orden_model->getOrdenesConCotizacionPaginacion($pagina,$porpagina,"limit");
        $cuantos=$this->orden_model->getOrdenesConCotizacionPaginacion($pagina,$porpagina,"cuantos");
        
		$cuantosCerrados=$this->produccion_model->getpaguinacionBodegaCerrados();
		
		$cuantos = $cuantos - $cuantosCerrados;
        /*
        $datos=$this->cotizaciones_model->getCotizacionesProduccionPaginacion($pagina,$porpagina,"limit");
        $cuantos=$this->cotizaciones_model->getCotizacionesProduccionPaginacion($pagina,$porpagina,"cuantos");
        */
        $config['base_url'] = base_url().'produccion/cotizaciones';
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
            $this->layout->view('cotizaciones',compact('datos','cuantos','pagina')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    public function fast()
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
       $datos=$this->fast_track_model->getFastTrackProduccionPaginacion($pagina,$porpagina,"limit");
        $cuantos=$this->fast_track_model->getFastTrackProduccionPaginacion($pagina,$porpagina,"cuantos");
        $config['base_url'] = base_url().'produccion/fast';
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
            $this->layout->view('fast',compact('datos','cuantos','pagina')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    public function archivos($id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
            if(!$id){show_404();}
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            if($this->input->post())
            {
                //ingeniería
                if($this->input->post('pdf_ing',true)=='SI')
                {
                    $pdf_ing=$this->input->post('file',true);
                }else
                {
                      $config['upload_path'] = './public/uploads/pdf_trazado/';
                      $config['allowed_types'] = 'pdf|jpg|png|jpeg|gif';
                      $config['max_size'] = '51200'; //550 x 138
                      $config['encrypt_name'] = true; 
                      $this->load->library('upload', $config);
                      $this->upload->do_upload('file');
                      $ima = $this->upload->data();
                      $pdf_ing = $ima['file_name'];
                }
                $data1=array
                (
                    "archivo"=>$pdf_ing,
                );
                $this->db->where('id_cotizacion', $this->input->post('id',true));
                $this->db->update("cotizacion_ingenieria",$data1);
                //fotomecánica
                if($this->input->post('pdf_fotomecanica',true)=='SI')
                {
                    $pdf_fotomecanica=$this->input->post('file',true);
                }else
                {
                      $config2['upload_path'] = './public/uploads/cotizacion_archivo_fotomecanica/';
                      $config2['allowed_types'] = 'pdf|jpg|png|jpeg|gif';
                      $config2['max_size'] = '51200'; //550 x 138
                      $config2['encrypt_name'] = true; 
                      $this->load->library('upload', $config2);
                      $this->upload->do_upload('file2');
                      $ima2 = $this->upload->data();
                      $pdf_fotomecanica = $ima2['file_name'];
                }
                $data2=array
                (
                    "archivo"=>$pdf_fotomecanica,
                );
                $this->db->where('id_cotizacion', $this->input->post('id',true));
                $this->db->update("cotizacion_fotomecanica",$data2);
                //salgo de acá
                 $this->session->set_flashdata('ControllerMessage', 'Se han actualizado los archivos de Ingeniería y Fotomecánica');
                            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);    
            }
            $this->layout->js
            (
                array
                (
                        //base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                        base_url()."public/backend/js/bootstrap.file-input.js"
                )
            );   
            $this->layout->view('archivos',compact('datos','fotomecanica','ing','pagina','id')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Revisión fotomecánica
     * */
    public function pendientes_fotomecanica($id=null)
    {
        if($this->session->userdata('id'))
        {
            if(!$id){show_404();}
            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
            $fotomecanica=$this->produccion_model->getFotomecanicaPorTipo(1,$id);
            $this->layout->setLayout('template_ajax');
            $this->layout->view('pendientes_fotomecanica',compact('fotomecanica','datos','id')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    public function revision_fotomecanica($tipo=null,$id=null,$pagina=null)
    {
         if($this->session->userdata('id'))
        {
            if(!$id){show_404();}
            
            switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
			$fotomecanica=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $fotomecanica2=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
			
			
            
            //print_r($fotomecanica);exit;
            if(sizeof($datos)==0){show_404();}
            if($this->input->post())
            {
                    
            
          if($this->input->post('estado',true)=='1' or $this->input->post('estado',true)=='0')
            {       
                   
                    if($this->input->post('estado',true)=='1')
                    {
                        if($this->input->post('envio_vb_maqueta',true)=='NO' or $this->input->post('envio_vb_color',true)=='NO' or $this->input->post('envio_vb_estructura',true)=='NO' and $this->input->post('entrega_a_fabricacion_a_linea_de_troquel',true)=='NO' or $this->input->post('confeccion_de_planchas',true)=='NO')
                        {
                            $this->session->set_flashdata('ControllerMessage', 'Para liberar deben estar en SI : VB Maqueta, VB Color, VB Estructura, Entrega a fabricación a línea de troquel y Confección de Planchas');
                            redirect(base_url().'produccion/revision_fotomecanica/'.$this->input->post('tipo',true)."/".$this->input->post('id',true)."/".$this->input->post('pagina',true),  301);    
                        }
                    }
                    
                    //die($this->input->post('estado',true));
                   /* if(empty($_FILES["file"]["name"]))
                                    {
                                        $file_name="";
                                    }else
                                    {
                                    $error=NULL;
                                   //valido la foto
                                    $config['upload_path'] = './public/uploads/produccion/fotomecanica/';
                                     $config['allowed_types'] = 'pdf|jpg|png|jpeg|gif';
                                    $config['max_size'] = '51200'; //550 x 138
                                    $config['encrypt_name'] = true; 
                                     $this->load->library('upload', $config);
                                     if ( ! $this->upload->do_upload('file'))
                                        {
                                            $error = array('error' => $this->upload->display_errors());
                                            $file_name="";
                                            
                                        }
                                        
                                            $ima = $this->upload->data();
                                            $file_name = $ima['file_name'];
                                     } 
									 */
									 if(empty($_FILES["file"]["name"]))
                                    {
                                        	if(sizeof($ing->archivo) > 0)
										{
											$file_name=$ing->archivo;	
										}else{
											$file_name="";	
										}
                                    }else
                                    {
                                    $error=NULL;
                                   //valido la foto
                                    $config['upload_path'] = './public/uploads/produccion/fotomecanica/';
                                    $config['allowed_types'] = 'pdf|jpg|png|jpeg|gif';
                                    $config['max_size'] = '51200'; //550 x 138
                                    $config['encrypt_name'] = true; 
                                     $this->load->library('upload', $config);
                                     if ( ! $this->upload->do_upload('file'))
                                        {
                                            $error = array('error' => $this->upload->display_errors());
                                            $this->session->set_flashdata('mensaje', $error["error"]);
                                            $this->session->set_flashdata('css',"danger");
                                            redirect(base_url().'produccion/revision_fotomecanica/'.$this->input->post("id",true)."/".$this->input->post("pagina",true),  301);
                                            
                                        }
                                        
                                            $ima = $this->upload->data();
                                            $file_name = $ima['file_name'];
                                      }
									 
									 
                   if($this->input->post('revision_trazado',true)=="SI")
                   {
                       $revision_trazado=date("Y-m-d");
                   }else
                   {
                       $revision_trazado="0000-00-00"; 
                   }
                   if($this->input->post('revision_de_imagen',true)=="SI")
                   {
                       $revision_de_imagen=date("Y-m-d");
                   }else
                   {
                       $revision_de_imagen="0000-00-00"; 
                   }
                   if($this->input->post('preparacion_de_archivos',true)=="SI")
                   {
                       $preparacion_de_archivos=date("Y-m-d");
                   }else
                   {
                       $preparacion_de_archivos="0000-00-00"; 
                   }
                   if($this->input->post('envio_vb_cliente',true)=="SI")
                   {
                       $envio_vb_cliente=date("Y-m-d");
                       if($tipo=='1')
                       {
                           $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
                           $config['mailtype'] = 'html';
                           $this->email->initialize($config);
                           $this->email->from("contacto@grauindus.cl", 'Cartonajes Grau');
                           $this->email->to($vendedor->correo); 
                           $this->email->bcc('respaldocorreos@grauindus.cl');
                           $this->email->subject('Mensaje de Cartonajes Grau');
                           $html='<h2>Nuevo Mensaje:</h2>';
                           $html.='La cotización N°'.$this->input->post('id',true).' ha recibido el VB del vendedor '.$vendedor->nombre.', con la glosa:<br/>'.$this->input->post("glosa",true);
                           $this->email->message($html);   
                           $this->email->send();
                       }
                       
                   }else
                   {
                       $envio_vb_cliente="0000-00-00"; 
                   }
                   if($this->input->post('recepcion_vb_cliente_1',true))
                   {
                       $recepcion_vb_cliente_1=date("Y-m-d");
                   }else
                   {
                       $recepcion_vb_cliente_1="0000-00-00"; 
                   }
                   if($this->input->post('envio_vb_cliente_2',true)=="SI")
                   {
                       $envio_vb_cliente_2=date("Y-m-d");
                   }else
                   {
                       $envio_vb_cliente_2="0000-00-00"; 
                   }
                   if($this->input->post('envio_vb_cliente_3',true)=="SI")
                   {
                       $envio_vb_cliente_3=date("Y-m-d");
                   }else
                   {
                       $envio_vb_cliente_3="0000-00-00"; 
                   }
                   if($this->input->post('envio_vb_vendedor',true)=="SI")
                   {
                       $envio_vb_vendedor=date("Y-m-d");
                   }else
                   {
                       $envio_vb_vendedor="0000-00-00"; 
                   }
                   if($this->input->post('recepcion_vb_vendedor_1',true))
                   {
                       $recepcion_vb_vendedor_1=date("Y-m-d");
                   }else
                   {
                       $recepcion_vb_vendedor_1="0000-00-00"; 
                   }
                   if($this->input->post('envio_vb_vendedor_2',true)=="SI")
                   {
                       $envio_vb_vendedor_2=date("Y-m-d");
                   }else
                   {
                       $envio_vb_vendedor_2="0000-00-00"; 
                   }
                   if($this->input->post('envio_vb_vendedor_3',true)=="SI")
                   {
                       $envio_vb_vendedor_3=date("Y-m-d");
                   }else
                   {
                       $envio_vb_vendedor_3="0000-00-00"; 
                   }
                   if($this->input->post('correcciones',true)=="SI")
                   {
                       $correcciones=date("Y-m-d");
                   }else
                   {
                       $correcciones="0000-00-00"; 
                   }
                   if($this->input->post('confeccion_de_peliculas',true)=="SI")
                   {
                       $confeccion_de_peliculas=date("Y-m-d");
                   }else
                   {
                       $confeccion_de_peliculas="0000-00-00"; 
                   }
                   if($this->input->post('confeccion_de_planchas',true)=="SI")
                   {
                       $confeccion_de_planchas=date("Y-m-d");
                   }else
                   {
                       $confeccion_de_planchas="0000-00-00"; 
                   }
                   if($this->input->post('recepcion_parcial',true)=="SI")
                   {
                       $recepcion_parcial=date("Y-m-d");
                   }else
                   {
                       $recepcion_parcial="0000-00-00"; 
                   }
                   if($this->input->post('recepcion_total',true)=="SI")
                   {
                       $recepcion_total=date("Y-m-d");
                   }else
                   {
                       $recepcion_total="0000-00-00"; 
                   }
                   if($this->input->post('envio_vb_maqueta',true)=="SI")
                   {
                       $envio_vb_maqueta=date("Y-m-d");
                   }else
                   {
                       $envio_vb_maqueta="0000-00-00"; 
                   }
                   if($this->input->post('envio_vb_color',true)=="SI")
                   {
                       $envio_vb_color=date("Y-m-d");
                   }else
                   {
                       $envio_vb_color="0000-00-00"; 
                   }
                   if($this->input->post('envio_vb_estructura',true)=="SI")
                   {
                       $envio_vb_estructura=date("Y-m-d");
                   }else
                   {
                       $envio_vb_estructura="0000-00-00"; 
                   }

                   if(sizeof($fotomecanica)==0)
                   {
											switch($this->input->post('estado',true))
											 {
												case '1': //Liberra
													$situacion='Liberada';
													$fecha_pendiente='0000-00-00';
													$fecha_liberada=date('Y-m-d H:i:s');
													$fecha_activa='0000-00-00';
													$fecha_orden_cerrada='0000-00-00';
												break;
												case '0': //guardar
													$situacion='Guardar';
													$fecha_pendiente='0000-00-00';
													$fecha_liberada='0000-00-00';
													$fecha_activa=$orden->fecha;
													$fecha_orden_cerrada='0000-00-00';
												break;
												case '2': // rechazar
													$situacion='Rechazar';
													$fecha_pendiente=date('Y-m-d H:i:s');
													$fecha_liberada='0000-00-00';
													$fecha_activa='0000-00-00';
													$fecha_orden_cerrada='0000-00-00';
												break;
												
											 }
                   }else
                   {
                     switch($fotomecanica->estado)
                     {
                        case '1': //Liberra
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0': //guardar
                            $situacion='Guardar';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=$orden->fecha;
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2': // rechazar
                            $situacion='Rechazar';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
						
                     }
                   }
                   
                   $data=array
                   (
                       "id_usuario"=>$this->session->userdata('id'),
                       "tipo"=>$this->input->post('tipo',true),
                       "id_nodo"=>$this->input->post('id',true),
                       "revision_trazado"=>$this->input->post('revision_trazado',true),
                       "revision_trazado_fecha"=>$revision_trazado,
                       "revision_trazado_id_usuario"=>$this->session->userdata('id'),
                       "revision_de_imagen"=>$this->input->post('revision_de_imagen',true),
                       "revision_de_imagen_fecha"=>$revision_de_imagen,
                       "revision_de_imagen_id_usuario"=>$this->session->userdata('id'),
                       "preparacion_de_archivos"=>$this->input->post('preparacion_de_archivos',true),
                       "preparacion_de_archivos_fecha"=>$preparacion_de_archivos,
                       "preparacion_de_archivos_id_usuario"=>$this->session->userdata('id'),
					   
                       "envio_vb_cliente"=>$this->input->post('envio_vb_cliente',true),
                       "envio_vb_cliente_fecha"=>$envio_vb_cliente,
                       "envio_vb_cliente_id_usuario"=>$this->session->userdata('id'),
                       
                       "recepcion_vb_cliente_1"=>$this->input->post('recepcion_vb_cliente_1',true),
                       "recepcion_vb_cliente_1_fecha"=>$recepcion_vb_cliente_1,
                       "recepcion_vb_cliente_1_id_usuario"=>$this->session->userdata('id'),
                       
                       "envio_vb_cliente_2"=>$this->input->post('envio_vb_cliente_2',true),
                       "envio_vb_cliente_2_fecha"=>$envio_vb_cliente_2,
                       "envio_vb_cliente_2_id_usuario"=>$this->session->userdata('id'),
                       
                       "envio_vb_cliente_3"=>$this->input->post('envio_vb_cliente_3',true),
                       "envio_vb_cliente_3_fecha"=>$envio_vb_cliente_3,
                       "envio_vb_cliente_3_id_usuario"=>$this->session->userdata('id'),
                       
                       "envio_vb_vendedor"=>$this->input->post('envio_vb_vendedor',true),
                       "envio_vb_vendedor_fecha"=>$envio_vb_vendedor,
                       "envio_vb_vendedor_id_usuario"=>$this->session->userdata('id'),
                       
                       "recepcion_vb_vendedor_1"=>$this->input->post('recepcion_vb_vendedor_1',true),
                       "recepcion_vb_vendedor_1_fecha"=>$recepcion_vb_vendedor_1,
                       "recepcion_vb_vendedor_1_id_usuario"=>$this->session->userdata('id'),
                       
                       "envio_vb_vendedor_2"=>$this->input->post('envio_vb_vendedor_2',true),
                       "envio_vb_vendedor_2_fecha"=>$envio_vb_vendedor_2,
                       "envio_vb_vendedor_2_id_usuario"=>$this->session->userdata('id'),
                       
                       "envio_vb_vendedor_3"=>$this->input->post('envio_vb_vendedor_3',true),
                       "envio_vb_vendedor_3_fecha"=>$envio_vb_vendedor_3,
                       "envio_vb_vendedor_3_id_usuario"=>$this->session->userdata('id'),
                       
                       "correcciones"=>$this->input->post('correcciones',true),
                       "correcciones_fecha"=>date("Y-m-d"),
                       "correcciones_id_usuario"=>$this->session->userdata('id'),
                       "estado"=>$this->input->post('estado',true),
                       "confeccion_de_peliculas"=>$this->input->post('confeccion_de_peliculas',true),
                       "confeccion_de_peliculas_fecha"=>$confeccion_de_peliculas,
                       "confeccion_de_peliculas_id_usuario"=>$this->session->userdata('id'),
                       "confeccion_de_planchas"=>$this->input->post('confeccion_de_planchas',true),
                       "confeccion_de_planchas_fecha"=>$confeccion_de_planchas,
                       "confeccion_de_planchas_id_usuario"=>$this->session->userdata('id'),
                       "recepcion_parcial"=>$this->input->post('recepcion_parcial',true),
                       "recepcion_parcial_fecha"=>$recepcion_parcial,
                       "recepcion_parcial_id_usuario"=>$this->session->userdata('id'),
                       "recepcion_total"=>$this->input->post('recepcion_total',true),
                       "recepcion_total_fecha"=>$recepcion_total,
                       "recepcion_total_id_usuario"=>$this->session->userdata('id'),
                       "fecha"=>date("Y-m-d"),
                       'quien'=>$this->session->userdata('id'),
                       'cuando'=>date("Y-m-d"),
                       "glosa"=>$this->input->post('glosa',true),
                       
                       "envio_vb_maqueta"=>$this->input->post('envio_vb_maqueta',true),
                       "envio_vb_maqueta_fecha"=>$envio_vb_maqueta,
                       "envio_vb_maqueta_id_usuario"=>$this->session->userdata('id'),
                       
                       "envio_vb_color"=>$this->input->post('envio_vb_color',true),
                       "envio_vb_color_fecha"=>$envio_vb_color,
                       "envio_vb_color_id_usuario"=>$this->session->userdata('id'),
                       
                       "envio_vb_estructura"=>$this->input->post('envio_vb_estructura',true),
                       "envio_vb_estructura_fecha"=>$envio_vb_color,
                       "envio_vb_estructura_id_usuario"=>$this->session->userdata('id'),
                       
                       "pdf_imagen"=>$file_name,
                       "entrega_a_fabricacion_a_linea_de_troquel"=>$this->input->post('entrega_a_fabricacion_a_linea_de_troquel',true),
                       "situacion"=>$situacion,
                       "fecha_pendiente"=>$fecha_pendiente,
                       "fecha_liberada"=>$fecha_liberada,
                       "fecha_activa"=>$fecha_activa,
                       "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                       "peliculas_para_imprimir"=>$this->input->post('peliculas_para_imprimir',true),
                       "para_maquina"=>$this->input->post('para_maquina',true),
                       "tiene_fondo_negro"=>$this->input->post('tiene_fondo_negro',true),
                       "prioridad"=>$this->input->post('prioridad',true),
                    );
					
			}
			
			
						//Rechazar
						 if($this->input->post("estado",true)==2)
                                       {
                                           
                                                   $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
												   $user=$this->usuarios_model->getUsuariosPorId($this->session->userdata('id'));
												   $config['mailtype'] = 'html';
												   $this->email->initialize($config);
												   $this->email->from("contacto@grauindus.cl", 'Cartonajes Grau');
												   //$this->email->to($vendedor->correo); 
												   $this->email->to(array($vendedor->correo, 'contactos_fotomecanica@grauindus.cl', 'contactos_ingenieria@grauindus.cl','contactos_cotizador@grauindus.cl'));
												   $this->email->bcc('respaldocorreos@grauindus.cl');
												   $this->email->subject('Mensaje de Cartonajes Grau');
												   $html='<h2>Orden de Producción: Revisión Fotomecanica:</h2>';
												   $html.='La Orden de Producción N°'.$this->input->post('id',true).' ha sido rechazada, con la glosa:<br/>'.$this->input->post("glosa",true).'<br><br> Rechazado Por: '.$user->nombre;
												   $this->email->message($html);   
												   $this->email->send();  
										
										
										
												$op=$this->orden_model->getOrdenesPorId($id);
										
														//ING
														$data=array
														(
														 "estado"=>$this->input->post("estado",true),
														);
														
														$this->db->where('id_cotizacion', $this->input->post('id',true));
														$this->db->update("cotizacion_ingenieria",$data);
														
														//FOTO
														$data2=array
														(
														 "estado"=>$this->input->post("estado",true),
														);
														
														$this->db->where('id_cotizacion', $this->input->post('id',true));
														$this->db->update("cotizacion_fotomecanica",$data2);
														
														//HC
														$data3=array
														(
														 "fecha"=>'0000-00-00',
														);
														
														$this->db->where('id_cotizacion', $this->input->post('id',true));
														$this->db->update("hoja_de_costos_datos",$data3);
														
														//OC
														$data4=array
														(
														 "estado"=>$this->input->post("estado",true),
														);
														
														$this->db->where('id_cotizacion', $this->input->post('id',true));
														$this->db->update("cotizaciones_orden_de_compra",$data4);
														

														//op
														$data6=array
														(
														 "estado"=>$this->input->post("estado",true),
														);
														
														  $this->db->where('id_cotizacion', $this->input->post("id",true));
														  $this->db->update("orden_de_produccion",$data6);
														
														//-------------------------------------------------------------
														
														//op foto
														$data5=array
														(
														 "estado"=>$this->input->post("estado",true),
														);
														
														$this->db->where('id_nodo', $this->input->post('id',true));
														$this->db->update("produccion_fotomecanica",$data5);
														
														
										
                                       }
			
			
			
                    if(sizeof($fotomecanica)==0)
                    {
                        $this->db->insert("produccion_fotomecanica",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_fotomecanica', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }             
                    
            }
             $this->layout->js
            (
                array
                (
                        //base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                        base_url()."public/backend/js/bootstrap.file-input.js"
                )
            );   
            $this->layout->view('revision_fotomecanica',compact('datos','fotomecanica','tipo','id','pagina','ordenDeCompra','orden','fotomecanica2','ing')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	
	
	
	/**
     * Control Cartulina
     * */
     public function control_cartulina($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control_cartulina=$this->produccion_model->getControlCartulinaPorTipo($tipo,$id);
            $cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $fotomecanica2=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            if($this->input->post())
            {
                if($this->form_validation->run('control_cartulina'))
                {
                    if(sizeof($control_cartulina)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {}
                     switch($this->input->post('estado',true))
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Guardar';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
							 case '3':
                                $situacion='Parcial';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                     }
                  // gramaje_seleccionado
				  
				  
				  if($this->input->post('gramaje',true) != $this->input->post('gramaje_seleccionado',true) or $ing->tamano_a_imprimir_1 != $this->input->post('ancho_seleccionado_de_bobina',true))
				  {
					  //$kilos1=$this->produccion_model->MermasParaProduccion($this->input->post('id',true),$this->input->post('gramaje_seleccionado',true),$this->input->post('ancho_seleccionado_de_bobina',true));
					  $gramajeSeleccionado = $this->input->post('gramaje_seleccionado',true);
					  $kilos11=$this->produccion_model->MermasParaProduccion($this->input->post('id',true),$this->input->post('gramaje_seleccionado',true),$this->input->post('ancho_seleccionado_de_bobina',true));
					  $kilos1 = str_replace('.', '', $kilos11);
				  }else{
					  
					  $kilos1 = $this->input->post('total_kilos',true);
					  $gramajeSeleccionado = $this->input->post('gramaje',true);
					  
				  }
				  
				  
				  
				  
				  
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "dimensionar_a_ancho"=>$this->input->post('dimensionar_a_ancho',true),
                        "dimensionar_a_largo"=>$this->input->post('dimensionar_a_largo',true),
                        "ancho_de_bobina"=>$this->input->post('ancho_de_bobina',true),
                        "gramaje"=>$gramajeSeleccionado,
                        "total_pliegos"=>$this->input->post('total_pliegos',true),
                        "total_kilos"=>$kilos1,
                        "unidades_por_pliego"=>$this->input->post('unidades_por_pliego',true),
                        "descripcion_de_la_tapa"=>$this->input->post('descripcion_de_la_tapa',true),
                        "numero_de_bobina"=>$this->input->post('numero_de_bobina',true),
                        "total_de_bobinas"=>$this->input->post('total_de_bobinas',true),
                        "quien_sabe_ubicacion_de_la_bobina"=>$this->input->post('quien_sabe_ubicacion_de_la_bobina',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "hay_en_stock"=>$this->input->post('hay_en_stock',true),
                        "preguntar_stock_a"=>$this->input->post('preguntar_stock_a',true),
                        "stock_opciones"=>$this->input->post('stock_opciones',true),
                        "proveedor"=>$this->input->post('proveedor',true),
                        "fecha_estimada_recepcion"=>$this->input->post('fecha_estimada_recepcion',true),
                        "gramaje_seleccionado"=>$this->input->post('gramaje_seleccionado',true),
                        "ancho_seleccionado_de_bobina"=>$this->input->post('ancho_seleccionado_de_bobina',true),
                        "cantidad_total_o_parcial"=>$this->input->post('cantidad_total_o_parcial',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "hay_que_bobinar"=>$this->input->post('hay_que_bobinar',true),
                        "total_kilos2"=>$this->input->post('total_kilos2',true),
                    );
					
					//Liberar
                    if(sizeof($control_cartulina)==0)
                    {
                        $this->db->insert("produccion_control_cartulina",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_control_cartulina', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
					
					
						
					//Parcial	
                				
					$kilosCartulinaParcial=$this->produccion_model->MermasParaProduccion($this->input->post('id',true),$this->input->post('gramaje_seleccionado',true),$this->input->post('ancho_seleccionado_de_bobina',true));
					$data2=array
                    (              
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "dimensionar_a_ancho"=>$this->input->post('dimensionar_a_ancho',true),
                        "dimensionar_a_largo"=>$this->input->post('dimensionar_a_largo',true),
                        "ancho_de_bobina"=>$this->input->post('ancho_de_bobina',true),
                        "gramaje"=>$gramajeSeleccionado,
                        "total_pliegos"=>$this->input->post('total_pliegos',true),
                        "total_kilos"=>$kilos1,
                        "unidades_por_pliego"=>$this->input->post('unidades_por_pliego',true),
                        "descripcion_de_la_tapa"=>$this->input->post('descripcion_de_la_tapa',true),
                        "numero_de_bobina"=>$this->input->post('numero_de_bobina',true),
                        "total_de_bobinas"=>$this->input->post('total_de_bobinas',true),
                        "quien_sabe_ubicacion_de_la_bobina"=>$this->input->post('quien_sabe_ubicacion_de_la_bobina',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "hay_en_stock"=>$this->input->post('hay_en_stock',true),
                        "preguntar_stock_a"=>$this->input->post('preguntar_stock_a',true),
                        "stock_opciones"=>$this->input->post('stock_opciones',true),
                        "proveedor"=>$this->input->post('proveedor',true),
                        "fecha_estimada_recepcion"=>$this->input->post('fecha_estimada_recepcion',true),
                        "gramaje_seleccionado"=>$this->input->post('gramaje_seleccionado',true),
                        "ancho_seleccionado_de_bobina"=>$this->input->post('ancho_seleccionado_de_bobina',true),
                        "cantidad_total_o_parcial"=>$this->input->post('cantidad_total_o_parcial',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "hay_que_bobinar"=>$this->input->post('hay_que_bobinar',true),               
                        "total_kilos2"=>$this->input->post('total_kilos2',true),               
                    );
					
					//Parcial 
						 if($this->input->post('estado',true) == '3')
						 {
								$this->db->insert("produccion_control_cartulina_parcial",$data2);
						 }
					//Parcial Fin
					
					
					//Liberar + Total
					
					$hayparcial=$this->produccion_model->getParcialControlCartulina($this->input->post('id',true));
					
					if($this->input->post('total_o_parcial',true) == 'Total' and $hayparcial->sum > 0)
					{
							//$hayparcial=$this->produccion_model->getParcialControlCartulina($this->input->post('id',true));

							$pendiente = $this->input->post('total_kilos',true) - $hayparcial->sum;
							
							$data1=array
							(								
								"estado"=>1,
								"situacion"=>'Liberada',
								"fecha_liberada"=>date('Y-m-d H:i:s'),	
								"fecha_pendiente"=>'0000-00-00',
								"fecha_activa"=>'0000-00-00',
								"fecha_orden_cerrada"=>'0000-00-00',	
							);
							
						$this->db->update('produccion_control_cartulina', $data1, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
					
					
						/*$data3=array
							(								
								    "id_usuario"=>$this->session->userdata('id'),
									"tipo"=>$this->input->post('tipo',true),
									"id_nodo"=>$this->input->post('id',true),
									"id_cliente"=>$this->input->post('id_cliente',true),
									"orden_de_trabajo"=>$this->input->post('id',true),
									"descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
									"dimensionar_a_ancho"=>$this->input->post('dimensionar_a_ancho',true),
									"dimensionar_a_largo"=>$this->input->post('dimensionar_a_largo',true),
									"ancho_de_bobina"=>$this->input->post('ancho_de_bobina',true),
									"gramaje"=>$gramajeSeleccionado,
									"total_pliegos"=>$this->input->post('total_pliegos',true),
									"total_kilos"=>$this->input->post('total_kilos',true),
									"unidades_por_pliego"=>$this->input->post('unidades_por_pliego',true),
									"descripcion_de_la_tapa"=>$this->input->post('descripcion_de_la_tapa',true),
									"numero_de_bobina"=>$this->input->post('numero_de_bobina',true),
									"total_de_bobinas"=>$this->input->post('total_de_bobinas',true),
									"quien_sabe_ubicacion_de_la_bobina"=>$this->input->post('quien_sabe_ubicacion_de_la_bobina',true),
									"estado"=>3,
									"quien"=>$this->session->userdata('id'),
									"cuando"=>date("Y-m-d"),
									"glosa"=>$this->input->post('glosa',true),
									"hay_en_stock"=>$this->input->post('hay_en_stock',true),
									"preguntar_stock_a"=>$this->input->post('preguntar_stock_a',true),
									"stock_opciones"=>$this->input->post('stock_opciones',true),
									"proveedor"=>$this->input->post('proveedor',true),
									"fecha_estimada_recepcion"=>$this->input->post('fecha_estimada_recepcion',true),
									"gramaje_seleccionado"=>$this->input->post('gramaje_seleccionado',true),
									"ancho_seleccionado_de_bobina"=>$this->input->post('ancho_seleccionado_de_bobina',true),
									"cantidad_total_o_parcial"=>$this->input->post('cantidad_total_o_parcial',true),
									"situacion"=>'Parcial',
									"fecha_pendiente"=>$fecha_pendiente,
									"fecha_liberada"=>$fecha_liberada,
									"fecha_activa"=>$fecha_activa,
									"fecha_orden_cerrada"=>$fecha_orden_cerrada,
									"hay_que_bobinar"=>$this->input->post('hay_que_bobinar',true),               
									"total_kilos2"=>$pendiente,  
							);
						*/
					      // $this->db->insert("produccion_control_cartulina_parcial",$data3);
						   
						   
						   $data4=array
							(								
								"estado"=>1,
								"situacion"=>'Liberada',
								"fecha_liberada"=>date('Y-m-d H:i:s'),	
								"fecha_pendiente"=>'0000-00-00',
								"fecha_activa"=>'0000-00-00',
								"fecha_orden_cerrada"=>'0000-00-00',
							);
							
						$this->db->update('produccion_control_cartulina_parcial', $data4, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
					
					}					
					//Liberra Total fin
					
					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios=$this->usuarios_model->getUsuarios();
            $this->layout->view("control_cartulina",compact('usuarios','datos','tipo','pagina','id','control_cartulina','ing','fotomecanica','hoja','fotomecanica2','orden','ordenDeCompra')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Bobinado cartulina
     * */
	 public function bobinado_cartulina($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getBobinadoCartulinaPorTipo($tipo,$id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
			$fotomecanica=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $fotomecanica2=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $control_cartulina=$this->produccion_model->getControlCartulinaPorTipo($tipo,$id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            if($this->input->post())
            {
                if($this->form_validation->run('produccion_bobinado'))
                {
                        if(sizeof($control_cartulina)==0)
                       {
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                       }else
                       {}
                           switch($this->input->post('estado',true))
                         {
                            case '1':
                                $situacion='Liberada';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada=date('Y-m-d H:i:s');
                                $fecha_activa='0000-00-00';
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                            case '0':
                                $situacion='Guardar';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                            case '2':
                                $situacion='Rechazado';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
							   case '3':
                                $situacion='Parcial';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                         }
                       
					   $hayparcial=$this->produccion_model->getParcialControlCartulina($id);
					   if(sizeof($hayparcial->sum)==0)
						{
								$totalKilos = $this->input->post("total_kilos_a_bobinar",true);
						}
						else
						{
								$totalKilos = $hayparcial->sum;
						}
						
						
						/*
						  if($this->input->post('gramaje',true) != $this->input->post('gramaje_seleccionado',true) or $ing->tamano_a_imprimir_1 != $this->input->post('ancho_seleccionado_de_bobina',true))
				  {
					  //$kilos1=$this->produccion_model->MermasParaProduccion($this->input->post('id',true),$this->input->post('gramaje_seleccionado',true),$this->input->post('ancho_seleccionado_de_bobina',true));
					  $gramajeSeleccionado = $this->input->post('gramaje_seleccionado',true);
					  $kilos11=$this->produccion_model->MermasParaProduccion($this->input->post('id',true),$this->input->post('gramaje_seleccionado',true),$this->input->post('ancho_seleccionado_de_bobina',true));
					  $kilos1 = str_replace('.', '', $kilos11);
				  }else{
					  
					  $kilos1 = $this->input->post('total_kilos',true);
					  $gramajeSeleccionado = $this->input->post('gramaje',true);
					  
				  }
				  */
					   
					   
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "descripcion_cartulina"=>$this->input->post('descripcion_cartulina',true),
                        "datos_tecnicos"=>$this->input->post('datos_tecnicos',true),
                        "ancho_seleccionado_cartulina"=>$this->input->post('ancho_seleccionado_cartulina',true),
                        
                        "ancho_a_bobinar"=>$this->input->post('ancho_a_bobinar',true),
                        "medida_final_pliego_a_cortar"=>$this->input->post("medida_final_pliego_a_cortar",true),
                        "gramaje_seleccionado"=>$this->input->post("gramaje_seleccionado",true),
                        "total_pliegos_para_la_orden"=>$this->input->post("total_pliegos_para_la_orden",true),
                        "total_kilos_a_bobinar" => $totalKilos,
                        "total_bobinas"=>$this->input->post("total_bobinas",true),
                        "total_o_parcial"=>$this->input->post("total_o_parcial",true),
                        //"total_kilos"=>$this->input->post("total_kilos",true),
                        "operador"=>$this->input->post('operador',true),
                        "ayudante"=>$this->input->post('ayudante',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "total_kilos"=>$this->input->post('total_kilos',true),						
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_bobinado_cartunila",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_bobinado_cartunila', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
					
					
					
					//Parcial				
					
					$data2=array
                    (              
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "descripcion_cartulina"=>$this->input->post('descripcion_cartulina',true),
                        "datos_tecnicos"=>$this->input->post('datos_tecnicos',true),
                        "ancho_seleccionado_cartulina"=>$this->input->post('ancho_seleccionado_cartulina',true),
                        
                        "ancho_a_bobinar"=>$this->input->post('ancho_a_bobinar',true),
                        "medida_final_pliego_a_cortar"=>$this->input->post("medida_final_pliego_a_cortar",true),
                        "gramaje_seleccionado"=>$this->input->post("gramaje_seleccionado",true),
                        "total_pliegos_para_la_orden"=>$this->input->post("total_pliegos_para_la_orden",true),
                        "total_kilos_a_bobinar"=>$totalKilos,
                        "total_bobinas"=>$this->input->post("total_bobinas",true),
                        "total_o_parcial"=>$this->input->post("total_o_parcial",true),
						//"total_kilos"=>$this->input->post("total_kilos",true),
                        "operador"=>$this->input->post('operador',true),
                        "ayudante"=>$this->input->post('ayudante',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,         
						"total_kilos"=>$this->input->post('total_kilos',true),						
                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								$this->db->insert("produccion_bobinado_cartunila_parcial",$data2);
						
						 }
					//Parcial Fin

					
						//Liberar + Total
					
					$hayparcial2=$this->produccion_model->getParcialBobinadoCartulinaSuma($this->input->post('id',true));
					
					if($this->input->post('total_o_parcial',true) == 'Total' and $hayparcial2->sum > 0)
					{		
							$data1=array
							(								
								"estado"=>1,
								"situacion"=>'Liberada',
						    	"fecha_liberada"=>date('Y-m-d H:i:s'),	
								"fecha_pendiente"=>'0000-00-00',
								"fecha_activa"=>'0000-00-00',
								"fecha_orden_cerrada"=>'0000-00-00',
							);
							
		$this->db->update('produccion_bobinado_cartunila', $data1, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
 
						   $data4=array
							(								
								"estado"=>1,
								"situacion"=>'Liberada',
								"fecha_liberada"=>date('Y-m-d H:i:s'),	
								"fecha_pendiente"=>'0000-00-00',
								"fecha_activa"=>'0000-00-00',
								"fecha_orden_cerrada"=>'0000-00-00',
							);
							
	 $this->db->update('produccion_bobinado_cartunila_parcial', $data4, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
					
					}					
					//Liberra Total fin
					
					
					
					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios2=$this->usuarios_model->getUsuariosPorTipo(8);
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(9);
            $this->layout->view("bobinado_cartulina",compact('usuarios','datos','tipo','pagina','id','control','ing','usuarios2','orden','fotomecanica','fotomecanica2','control_cartulina','hoja')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
	
	
    /**
     * Bobinado onda
     * */
	 public function bobinado_onda($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getBobinadoCartulinaOndaPorTipo($tipo,$id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
			$fotomecanica=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $fotomecanica2=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $control_cartulina=$this->produccion_model->getControlCartulinaPorTipo($tipo,$id);
            $control_onda=$this->produccion_model->getControlControlOndaPorTipo($tipo,$id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            if($this->input->post())
            {
                if($this->form_validation->run('produccion_bobinado'))
                {
                         if(sizeof($control_onda)==0)
                       {
                                $situacion='Pendiente';
                                $fecha_pendiente=date('Y-m-d H:i:s');
                                $fecha_liberada='0000-00-00';
                                $fecha_activa='0000-00-00';
                                $fecha_orden_cerrada='0000-00-00';
                       }else
                       {
                          switch($this->input->post('estado',true))
                         {
                            case '1':
                                $situacion='Liberada';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada=date('Y-m-d H:i:s');
                                $fecha_activa='0000-00-00';
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                            case '0':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                            case '2':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
							case '3':
                                $situacion='Parcial';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                            
                         }
                       }
                    $data=array
                    (
					
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "descripcion_onda"=>$this->input->post('descripcion_onda',true),
                        "datos_tecnicos"=>$this->input->post('datos_tecnicos',true),
                        "ancho_seleccionado_onda"=>$this->input->post('ancho_seleccionado_de_bobina',true),
                        
                        "ancho_a_bobinar"=>$this->input->post('ancho_a_bobinar',true),
                        "medida_final_pliego_a_cortar"=>$this->input->post("medida_final_pliego_a_cortar",true),
                        "gramaje_seleccionado"=>$this->input->post("gramaje_seleccionado",true),
                        "total_pliegos_para_la_orden"=>$this->input->post("total_pliegos_para_la_orden",true),
                        "total_kilos_a_bobinar"=>$this->input->post("total_kilos_a_bobinar",true),
                        "total_bobinas"=>$this->input->post("total_bobinas",true),
                        "total_o_parcial"=>$this->input->post("total_o_parcial",true),
                        "operador"=>$this->input->post('operador',true),
                        "ayudante"=>$this->input->post('ayudante',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
						"total_kilos"=>$this->input->post('total_kilos',true),
                        
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_bobinado_onda",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_bobinado_onda', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
					
					
					
						
					//Parcial				
					
					$data2=array
                    (              
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "descripcion_onda"=>$this->input->post('descripcion_onda',true),
                        "datos_tecnicos"=>$this->input->post('datos_tecnicos',true),
                        "ancho_seleccionado_onda"=>$this->input->post('ancho_seleccionado_de_bobina',true),
                        
                        "ancho_a_bobinar"=>$this->input->post('ancho_a_bobinar',true),
                        "medida_final_pliego_a_cortar"=>$this->input->post("medida_final_pliego_a_cortar",true),
                        "gramaje_seleccionado"=>$this->input->post("gramaje_seleccionado",true),
                        "total_pliegos_para_la_orden"=>$this->input->post("total_pliegos_para_la_orden",true),
                        "total_kilos_a_bobinar"=>$this->input->post("total_kilos_a_bobinar",true),
                        "total_bobinas"=>$this->input->post("total_bobinas",true),
                        "total_o_parcial"=>$this->input->post("total_o_parcial",true),
                        "operador"=>$this->input->post('operador',true),
                        "ayudante"=>$this->input->post('ayudante',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,	
						"total_kilos"=>$this->input->post('total_kilos',true),
                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								 $this->db->insert("produccion_bobinado_onda_parcial",$data);
						
						 }
					//Parcial Fin
					
					
					//Liberar + Total
					
					$hayparcial2=$this->produccion_model->getParcialBobinadoOndaSuma($this->input->post('id',true));
					
					if($this->input->post('total_o_parcial',true) == 'Total' and $hayparcial2->sum > 0 and $this->input->post('estado',true) == 1)
					{		
							$data1=array
							(								
								"estado"=>1,
								"situacion"=>'Liberada',
						    	"fecha_liberada"=>date('Y-m-d H:i:s'),	
								"fecha_pendiente"=>'0000-00-00',
								"fecha_activa"=>'0000-00-00',
								"fecha_orden_cerrada"=>'0000-00-00',
							);
							
		$this->db->update('produccion_bobinado_onda', $data1, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
 
						   $data4=array
							(								
								"estado"=>1,
								"situacion"=>'Liberada',
								"fecha_liberada"=>date('Y-m-d H:i:s'),	
								"fecha_pendiente"=>'0000-00-00',
								"fecha_activa"=>'0000-00-00',
								"fecha_orden_cerrada"=>'0000-00-00',
							);
							
	 $this->db->update('produccion_bobinado_onda_parcial', $data4, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
					
					}					
					//Liberra Total fin
					
					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios2=$this->usuarios_model->getUsuariosPorTipo(8);
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(9);
            $this->layout->view("bobinado_onda",compact('usuarios','datos','tipo','pagina','id','control','ing','usuarios2','orden','fotomecanica','fotomecanica2','control_cartulina','hoja','control_onda')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Bobinado liner
     * */
	 public function bobinado_liner($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getBobinadoCartulinaLinerPorTipo($tipo,$id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
			$fotomecanica=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $fotomecanica2=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $control_cartulina=$this->produccion_model->getControlCartulinaPorTipo($tipo,$id);
            $control_liner=$this->produccion_model->getControlControlLinerPorTipo($tipo,$id);
            $bobinado_liner=$this->produccion_model->getBobinadolLinerPorTipo($tipo,$id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            if($this->input->post())
            {
                if($this->form_validation->run('produccion_bobinado'))
                {
                        if(sizeof($control_liner)==0)
                       {
                                $situacion='Pendiente';
                                $fecha_pendiente=date('Y-m-d H:i:s');
                                $fecha_liberada='0000-00-00';
                                $fecha_activa='0000-00-00';
                                $fecha_orden_cerrada='0000-00-00';
                       }else
                       {}
                         switch($this->input->post('estado',true))
                         {
                            case '1':
                                $situacion='Liberada';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada=date('Y-m-d H:i:s');
                                $fecha_activa='0000-00-00';
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                            case '0':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                            case '2':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
							case '3':
                                $situacion='Parcial';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                         }
                       
					   
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "descripcion_liner"=>$this->input->post('descripcion_liner',true),
                        "datos_tecnicos"=>$this->input->post('datos_tecnicos',true),
                        "ancho_seleccionado_de_bobina"=>$this->input->post('ancho_seleccionado_de_bobina',true),
                        
                        "ancho_a_bobinar"=>$this->input->post('ancho_a_bobinar',true),
                        "medida_final_pliego_a_cortar"=>$this->input->post("medida_final_pliego_a_cortar",true),
                        "gramaje_seleccionado"=>$this->input->post("gramaje_seleccionado",true),
                        "total_pliegos_para_la_orden"=>$this->input->post("total_pliegos_para_la_orden",true),
                        "total_kilos_a_bobinar"=>$this->input->post("total_kilos_a_bobinar",true),
                        "total_bobinas"=>$this->input->post("total_bobinas",true),
                        "total_o_parcial"=>$this->input->post("total_o_parcial",true),
                        "operador"=>$this->input->post('operador',true),
                        "ayudante"=>$this->input->post('ayudante',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
						"total_kilos2"=>$this->input->post('total_kilos2',true),
						"total_kilos"=> $this->input->post('total_kilos',true),
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_bobinado_liner",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_bobinado_liner', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
					
						//Parcial				
					
					$data2=array
                    (              
                         "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "descripcion_liner"=>$this->input->post('descripcion_liner',true),
                        "datos_tecnicos"=>$this->input->post('datos_tecnicos',true),
                        "ancho_seleccionado_de_bobina"=>$this->input->post('ancho_seleccionado_de_bobina',true),
                        
                        "ancho_a_bobinar"=>$this->input->post('ancho_a_bobinar',true),
                        "medida_final_pliego_a_cortar"=>$this->input->post("medida_final_pliego_a_cortar",true),
                        "gramaje_seleccionado"=>$this->input->post("gramaje_seleccionado",true),
                        "total_pliegos_para_la_orden"=>$this->input->post("total_pliegos_para_la_orden",true),
                        "total_kilos_a_bobinar"=>$this->input->post("total_kilos_a_bobinar",true),
                        "total_bobinas"=>$this->input->post("total_bobinas",true),
                        "total_o_parcial"=>$this->input->post("total_o_parcial",true),
                        "operador"=>$this->input->post('operador',true),
                        "ayudante"=>$this->input->post('ayudante',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
						"total_kilos2"=>$this->input->post('total_kilos2',true),
						"total_kilos"=> $this->input->post('total_kilos',true),
                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								 $this->db->insert("produccion_bobinado_liner_parcial",$data);
						
						 }
					//Parcial Fin
					
					
					
							
					//Liberar + Total
					
					$hayparcial2=$this->produccion_model->getParcialBobinadoLinerSuma($this->input->post('id',true));
					
					if($this->input->post('total_o_parcial',true) == 'Total' and $hayparcial2->sum > 0 and $this->input->post('estado',true) == 1)
					{		
							$data1=array
							(								
								"estado"=>1,
								"situacion"=>'Liberada',
						    	"fecha_liberada"=>date('Y-m-d H:i:s'),	
								"fecha_pendiente"=>'0000-00-00',
								"fecha_activa"=>'0000-00-00',
								"fecha_orden_cerrada"=>'0000-00-00',
							);
							
	$this->db->update('produccion_bobinado_liner', $data1, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
 
						   $data4=array
							(								
								"estado"=>1,
								"situacion"=>'Liberada',
								"fecha_liberada"=>date('Y-m-d H:i:s'),	
								"fecha_pendiente"=>'0000-00-00',
								"fecha_activa"=>'0000-00-00',
								"fecha_orden_cerrada"=>'0000-00-00',
							);
							
	 $this->db->update('produccion_bobinado_liner_parcial', $data4, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
					
					}					
					//Liberra Total fin
					
					
					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios2=$this->usuarios_model->getUsuariosPorTipo(8);
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(9);
            $this->layout->view("bobinado_liner",compact('usuarios','datos','tipo','pagina','id','control','ing','usuarios2','orden','fotomecanica','fotomecanica2','control_cartulina','hoja','control_liner','bobinado_liner')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Control Liner 
     * */
	 public function control_liner($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control_liner=$this->produccion_model->getControlControlLinerPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica2=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $fotomecanica=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            if($this->input->post())
            {
                if($this->form_validation->run('control_liner'))
                {
                    if(sizeof($fotomecanica)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {}
                     switch($this->input->post('estado',true))
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
						case '3':
                            $situacion='Parcial';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                     }
				   
				     if($this->input->post('gramaje',true) != $this->input->post('gramaje_seleccionado',true)  and $ing->tamano_a_imprimir_1 != $this->input->post('ancho_seleccionado_de_bobina',true))
				  {
					  $kilos1=$this->produccion_model->LlamarKilosLiner($this->input->post('id',true),$this->input->post('gramaje_seleccionado',true),$this->input->post('ancho_seleccionado_de_bobina',true));
					  $gramajeSeleccionado = $this->input->post('gramaje_seleccionado',true);
				  }else{
					  $kilos1 = $this->input->post('kilo_liner',true);
					  $gramajeSeleccionado = $this->input->post('gramaje',true);
				  }
				   
				   
				   
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "ancho_seleccionado_de_bobina"=>$gramajeSeleccionado,
						
                        "para_bobinado"=>$this->input->post('para_bobinado',true),
                        "ancho_de_bobina"=>$this->input->post('ancho_de_bobina',true),
                        "ancho_a_usar_liner"=>$this->input->post('ancho_a_usar_liner',true),
                        "gramaje_liner"=>$this->input->post('gramaje_liner',true),
                        "ubicacion_liner"=>$this->input->post('ubicacion_liner',true),
                        "preguntar_a_liner"=>$this->input->post('preguntar_a_liner',true),
                        "numero_bobina_liner"=>$this->input->post('numero_bobina_liner',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "gramaje_seleccionado"=>$this->input->post('gramaje_seleccionado',true),
                        "ancho_seleccionado_de_bobina"=>$this->input->post('ancho_seleccionado_de_bobina',true),
                        "gramaje_seleccionado"=>$this->input->post("gramaje_seleccionado",true),
                        "hay_que_comprar_liner"=>$this->input->post('hay_que_comprar_liner',true),
                        "proveedor"=>$this->input->post('proveedor',true),
                        "fecha_estimada_de_entrega"=>$this->input->post('fecha_estimada_de_entrega',true),
						"total_kilos2"=>$this->input->post('total_kilos2',true),
						"total_kilos"=>$kilos1,
                    );
                    if(sizeof($control_liner)==0)
                    {
                        $this->db->insert("produccion_control_liner",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_control_liner', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
					
					
					
					//Parcial				
					
					$data2=array
                    (              
                       "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "ancho_seleccionado_de_bobina"=>$gramajeSeleccionado,
						
                        "para_bobinado"=>$this->input->post('para_bobinado',true),
                        "ancho_de_bobina"=>$this->input->post('ancho_de_bobina',true),
                        "ancho_a_usar_liner"=>$this->input->post('ancho_a_usar_liner',true),
                        "gramaje_liner"=>$this->input->post('gramaje_liner',true),
                        "ubicacion_liner"=>$this->input->post('ubicacion_liner',true),
                        "preguntar_a_liner"=>$this->input->post('preguntar_a_liner',true),
                        "numero_bobina_liner"=>$this->input->post('numero_bobina_liner',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "gramaje_seleccionado"=>$this->input->post('gramaje_seleccionado',true),
                        "ancho_seleccionado_de_bobina"=>$this->input->post('ancho_seleccionado_de_bobina',true),
                        "gramaje_seleccionado"=>$this->input->post("gramaje_seleccionado",true),
                        "hay_que_comprar_liner"=>$this->input->post('hay_que_comprar_liner',true),
                        "proveedor"=>$this->input->post('proveedor',true),
                        "fecha_estimada_de_entrega"=>$this->input->post('fecha_estimada_de_entrega',true),
						"total_kilos2"=>$this->input->post('total_kilos2',true),
						"total_kilos"=>$kilos1,
                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								 $this->db->insert("produccion_control_liner_parcial",$data2);
						
						 }
					//Parcial Fin
					
							//Liberar + Total
					
					$hayparcial2=$this->produccion_model->getParcialControlLinerSuma($this->input->post('id',true));
					
					
					if($this->input->post('total_o_parcial',true) == 'Total' and $hayparcial2->sum > 0 and $this->input->post('estado',true) == 1)
					{		
							$data1=array
							(								
								"estado"=>1,
								"situacion"=>'Liberada',
						    	"fecha_liberada"=>date('Y-m-d H:i:s'),	
								"fecha_pendiente"=>'0000-00-00',
								"fecha_activa"=>'0000-00-00',
								"fecha_orden_cerrada"=>'0000-00-00',
							);
							
	$this->db->update('produccion_control_liner', $data1, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
 
						   $data4=array
							(								
								"estado"=>1,
								"situacion"=>'Liberada',
								"fecha_liberada"=>date('Y-m-d H:i:s'),	
								"fecha_pendiente"=>'0000-00-00',
								"fecha_activa"=>'0000-00-00',
								"fecha_orden_cerrada"=>'0000-00-00',
							);
							
	 $this->db->update('produccion_control_liner_parcial', $data4, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
					
					}					
					//Liberra Total fin
					
					
					
					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios=$this->usuarios_model->getUsuarios();
            $this->layout->view("control_liner",compact('usuarios','datos','tipo','pagina','id','control_liner','fotomecanica','fotomecanica2','ordenDeCompra','ing','orden','hoja')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
	
	 public function control_cartulina2($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control_liner=$this->produccion_model->getControlControlLinerPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica2=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $fotomecanica=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            if($this->input->post())
            {
                if($this->form_validation->run('control_liner'))
                {
                    if(sizeof($fotomecanica)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {
                     switch($tipo)
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
						case '3':
                            $situacion='Parcial';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                     }
                   }
				   
				     if($this->input->post('gramaje',true) != $this->input->post('gramaje_seleccionado',true)  and $ing->tamano_a_imprimir_1 != $this->input->post('ancho_seleccionado_de_bobina',true))
				  {
					  $kilos1=$this->produccion_model->LlamarKilosLiner($this->input->post('id',true),$this->input->post('gramaje_seleccionado',true),$this->input->post('ancho_seleccionado_de_bobina',true));
					  $gramajeSeleccionado = $this->input->post('gramaje_seleccionado',true);
				  }else{
					  $kilos1 = $this->input->post('kilo_liner',true);
					  $gramajeSeleccionado = $this->input->post('gramaje',true);
				  }
				   
				   
				   
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "ancho_seleccionado_de_bobina"=>$gramajeSeleccionado,
						
                        "para_bobinado"=>$this->input->post('para_bobinado',true),
                        "ancho_de_bobina"=>$this->input->post('ancho_de_bobina',true),
                        "ancho_a_usar_liner"=>$this->input->post('ancho_a_usar_liner',true),
                        "gramaje_liner"=>$this->input->post('gramaje_liner',true),
                        "ubicacion_liner"=>$this->input->post('ubicacion_liner',true),
                        "preguntar_a_liner"=>$this->input->post('preguntar_a_liner',true),
                        "numero_bobina_liner"=>$this->input->post('numero_bobina_liner',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "gramaje_seleccionado"=>$this->input->post('gramaje_seleccionado',true),
                        "ancho_seleccionado_de_bobina"=>$this->input->post('ancho_seleccionado_de_bobina',true),
                        "gramaje_seleccionado"=>$this->input->post("gramaje_seleccionado",true),
                        "hay_que_comprar_liner"=>$this->input->post('hay_que_comprar_liner',true),
                        "proveedor"=>$this->input->post('proveedor',true),
                        "fecha_estimada_de_entrega"=>$this->input->post('fecha_estimada_de_entrega',true),
						"total_kilos2"=>$this->input->post('total_kilos2',true),
						"total_kilos"=>$kilos1,
                    );
                    if(sizeof($control_liner)==0)
                    {
                        $this->db->insert("produccion_control_liner",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_control_liner', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
					
					
					
					//Parcial				
					
					$data2=array
                    (              
                       "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "ancho_seleccionado_de_bobina"=>$gramajeSeleccionado,
						
                        "para_bobinado"=>$this->input->post('para_bobinado',true),
                        "ancho_de_bobina"=>$this->input->post('ancho_de_bobina',true),
                        "ancho_a_usar_liner"=>$this->input->post('ancho_a_usar_liner',true),
                        "gramaje_liner"=>$this->input->post('gramaje_liner',true),
                        "ubicacion_liner"=>$this->input->post('ubicacion_liner',true),
                        "preguntar_a_liner"=>$this->input->post('preguntar_a_liner',true),
                        "numero_bobina_liner"=>$this->input->post('numero_bobina_liner',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "gramaje_seleccionado"=>$this->input->post('gramaje_seleccionado',true),
                        "ancho_seleccionado_de_bobina"=>$this->input->post('ancho_seleccionado_de_bobina',true),
                        "gramaje_seleccionado"=>$this->input->post("gramaje_seleccionado",true),
                        "hay_que_comprar_liner"=>$this->input->post('hay_que_comprar_liner',true),
                        "proveedor"=>$this->input->post('proveedor',true),
                        "fecha_estimada_de_entrega"=>$this->input->post('fecha_estimada_de_entrega',true),
						"total_kilos2"=>$this->input->post('total_kilos2',true),
						"total_kilos"=>$kilos1,
                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								 $this->db->insert("produccion_control_liner_parcial",$data);
						
						 }
					//Parcial Fin
					
							//Liberar + Total
					
					$hayparcial2=$this->produccion_model->getParcialBobinadoLinerSuma($this->input->post('id',true));
					
					if($this->input->post('total_o_parcial',true) == 'Total' and $hayparcial2->sum > 0 and $this->input->post('estado',true) == 1)
					{		
							$data1=array
							(								
								"estado"=>1,
								"situacion"=>'Liberada',
						    	"fecha_liberada"=>date('Y-m-d H:i:s'),	
								"fecha_pendiente"=>'0000-00-00',
								"fecha_activa"=>'0000-00-00',
								"fecha_orden_cerrada"=>'0000-00-00',
							);
							
	$this->db->update('produccion_control_liner', $data1, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
 
						   $data4=array
							(								
								"estado"=>1,
								"situacion"=>'Liberada',
								"fecha_liberada"=>date('Y-m-d H:i:s'),	
								"fecha_pendiente"=>'0000-00-00',
								"fecha_activa"=>'0000-00-00',
								"fecha_orden_cerrada"=>'0000-00-00',
							);
							
	 $this->db->update('produccion_control_liner_parcial', $data4, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
					
					}					
					//Liberra Total fin
					
					
					
					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios=$this->usuarios_model->getUsuarios();
            $this->layout->view("control_liner",compact('usuarios','datos','tipo','pagina','id','control_liner','fotomecanica','fotomecanica2','ordenDeCompra','ing','orden','hoja')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
	
	
	
	 public function control_onda($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control_onda=$this->produccion_model->getControlControlOndaPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica2=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $fotomecanica=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            if($this->input->post())
            {
                if($this->form_validation->run('control_onda'))
                {
                    if(sizeof($fotomecanica)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {}
                     switch($this->input->post('estado',true))
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
						case '3':
                            $situacion='Parcial';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                     }
                   
				   
				    if($this->input->post('gramaje',true) != $this->input->post('gramaje_seleccionado',true)  and $ing->tamano_a_imprimir_1 != $this->input->post('ancho_seleccionado_de_bobina',true))
				  {
					  
					  $gramajeSeleccionado = $this->input->post('gramaje_seleccionado',true);
					  $kilos11=$this->produccion_model->LlamarKilosOnda($this->input->post('id',true),$this->input->post('gramaje_seleccionado',true),$this->input->post('ancho_seleccionado_de_bobina',true));
					  $kilos1 = str_replace('.', '', $kilos11);
				  }else{
					  
					  $kilos1 = $this->input->post('kilo_onda',true);
					  $gramajeSeleccionado = $this->input->post('gramaje',true);
					  
				  }
				  

				  
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "ancho_a_usar_onda"=>$this->input->post('ancho_a_usar_onda',true),
                        "gramaje_onda"=>$gramajeSeleccionado,
                        "ubicacion_onda"=>$this->input->post('ubicacion_onda',true),
                        "preguntar_a_onda"=>$this->input->post('preguntar_a_onda',true),
                        "numero_bobina_onda"=>$this->input->post('numero_bobina_onda',true),
                        "para_bobinado"=>$this->input->post('para_bobinado',true),
                        "ancho_de_bobina"=>$this->input->post('ancho_de_bobina',true),
                        
         
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "gramaje_seleccionado"=>$this->input->post('gramaje_seleccionado',true),
                        "ancho_seleccionado_de_bobina"=>$this->input->post('ancho_seleccionado_de_bobina',true),
                        
                        "hay_que_comprar_onda"=>$this->input->post('hay_que_comprar_onda',true),
                        "proveedor"=>$this->input->post('proveedor',true),
                        "fecha_estimada_de_entrega"=>$this->input->post('fecha_estimada_de_entrega',true),
                        "total_kilos2"=>$this->input->post('total_kilos2',true),
						"total_kilos"=>$kilos1,
                        
						
                    );
                    if(sizeof($control_onda)==0)
                    {
                        $this->db->insert("produccion_control_onda",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_control_onda', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
				
						
					//Parcial				
					
					$data2=array
                    (              
                     "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "ancho_a_usar_onda"=>$this->input->post('ancho_a_usar_onda',true),
                        "gramaje_onda"=>$gramajeSeleccionado,
                        "ubicacion_onda"=>$this->input->post('ubicacion_onda',true),
                        "preguntar_a_onda"=>$this->input->post('preguntar_a_onda',true),
                        "numero_bobina_onda"=>$this->input->post('numero_bobina_onda',true),
                        "para_bobinado"=>$this->input->post('para_bobinado',true),
                        "ancho_de_bobina"=>$this->input->post('ancho_de_bobina',true),
                        
         
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "gramaje_seleccionado"=>$this->input->post('gramaje_seleccionado',true),
                        "ancho_seleccionado_de_bobina"=>$this->input->post('ancho_seleccionado_de_bobina',true),
                        
                        "hay_que_comprar_onda"=>$this->input->post('hay_que_comprar_onda',true),
                        "proveedor"=>$this->input->post('proveedor',true),
                        "fecha_estimada_de_entrega"=>$this->input->post('fecha_estimada_de_entrega',true),
						"total_kilos2"=>$this->input->post('total_kilos2',true),
						"total_kilos"=>$kilos1,
                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								 $this->db->insert("produccion_control_onda_parcial",$data2);
						
						 }
					//Parcial Fin
					
					
					
						//Liberar + Total
					
					$hayparcial=$this->produccion_model->getParcialControlOndaSuma($this->input->post('id',true));
					
					if($this->input->post('total_o_parcial',true) == 'Total' and $hayparcial->sum > 0)
					{
							$data1=array
							(								
								"estado"=>1,
								"situacion"=>'Liberada',
								"fecha_liberada"=>date('Y-m-d H:i:s'),	
								"fecha_pendiente"=>'0000-00-00',
								"fecha_activa"=>'0000-00-00',
								"fecha_orden_cerrada"=>'0000-00-00',	
							);
							
					$this->db->update('produccion_control_onda', $data1, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
	   
						   $data4=array
							(								
								"estado"=>1,
								"situacion"=>'Liberada',
								"fecha_liberada"=>date('Y-m-d H:i:s'),	
								"fecha_pendiente"=>'0000-00-00',
								"fecha_activa"=>'0000-00-00',
								"fecha_orden_cerrada"=>'0000-00-00',
							);
							
						$this->db->update('produccion_control_onda_parcial', $data4, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
					
					}					
					//Liberra Total fin
				
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
					//redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
					
                }
				
				
            }
            $usuarios=$this->usuarios_model->getUsuarios();
            $this->layout->view("control_onda",compact('usuarios','datos','tipo','pagina','id','control_onda','fotomecanica','fotomecanica2','ordenDeCompra','ing','orden','hoja')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Confección Molde de troquel
     * */
	 public function confeccion_molde_troquel($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getConfeccionModelTroquelPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica2=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $fotomecanica=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            if($this->input->post())
            {
                if($this->form_validation->run('confeccion_molde_troquel'))
                {
                    if(sizeof($fotomecanica)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {
                     switch($control->estado)
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
						case '':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                     }
                   }
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "hay_madera"=>$this->input->post('hay_madera',true),
                        "hay_cuchillos"=>$this->input->post('hay_cuchillos',true),
                        "calado"=>$this->input->post('calado',true),
                        "confeccion_de_chuchillo"=>$this->input->post('confeccion_de_chuchillo',true),
                        "armado_de_molde"=>$this->input->post('armado_de_molde',true),
                        "armado_de_molde"=>$this->input->post('armado_de_molde',true),
                        "existe_pdf_ingenieria"=>$this->input->post("existe_pdf_ingenieria",true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "hay_que_hacer_molde"=>$this->input->post("hay_que_hacer_molde",true),
                        "tamano_cuchillo_1"=>$this->input->post('tamano_cuchillo_1',true),
                        "tamano_cuchillo_2"=>$this->input->post('tamano_cuchillo_2',true),
                        "tamano_cuchillo_2"=>$this->input->post('tamano_cuchillo_2',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "molde_revision"=>$this->input->post('molde_revision',true),
                        "molde_para_revision"=>$this->input->post('molde_para_revision',true),
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_confeccion_molde_troquel",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_confeccion_molde_troquel', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
                    $cuchillocuchillo=$this->input->post('cuchillocuchillo',true);
                    $cuchillocuchillo2=$this->input->post('cuchillocuchillo2',true);
                    if(empty($cuchillocuchillo) and empty($cuchillocuchillo2))
                    {
                        $arrayMolde=array
                        (
                            'cuchillocuchillo'=>$this->input->post('tamano_cuchillo_1',true),
                            'cuchillocuchillo2'=>$this->input->post('tamano_cuchillo_2',true),
                        );
                        $this->db->where('id', $this->input->post('id_molde',true));
                        $this->db->update("moldes_grau",$arrayMolde);
                    }
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $this->layout->view("confeccion_molde_troquel",compact('usuarios','datos','tipo','pagina','id','control','ing','fotomecanica','fotomecanica2','orden','ordenDeCompra','hoja')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    
    /**
     * Confección Corte Cartulina
     * */
	 public function corte_cartulina($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getCorteCartulinaPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $control_cartulina=$this->produccion_model->getControlCartulinaPorTipo($tipo,$id);
            $control_cartulina_parcial=$this->produccion_model->getControlCartulinaParcialPorTipo($tipo,$id);
            $bobinado_cartulina=$this->produccion_model->getBobinadoCartulinaPorTipo($tipo,$id);
            $fotomecanica2=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            if($this->input->post())
            {
                if($this->form_validation->run('corte_cartulina'))
                {
                    if(sizeof($control_cartulina)==0 or sizeof($bobinado_cartulina)==0)
                       {
						   
						   
						   if($this->input->post('estado',true) == 3)
						   {
							   $situacion='Parcial';
                                $fecha_pendiente=date('Y-m-d H:i:s');
                                $fecha_liberada='0000-00-00';
                                $fecha_activa='0000-00-00';
                                $fecha_orden_cerrada='0000-00-00';
							   
						   }else
						   {
                                $situacion='Pendiente';
                                $fecha_pendiente=date('Y-m-d H:i:s');
                                $fecha_liberada='0000-00-00';
                                $fecha_activa='0000-00-00';
                                $fecha_orden_cerrada='0000-00-00';
						   }
                       }else
                       {}
                         switch($this->input->post('estado',true))
                         {
                            case '1':
                                $situacion='Liberada';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada=date('Y-m-d H:i:s');
                                $fecha_activa='0000-00-00';
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                            case '0':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                            case '2':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
							 case '':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
							 case '3':
                                $situacion='Parcial';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                         }
                       
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "ancho_bobina"=>$this->input->post('ancho_bobina',true),
                        "largo_a_cortar"=>$this->input->post('largo_a_cortar',true),
                        "ancho_a_cortar"=>$this->input->post('ancho_a_cortar',true),
                        "total_pliegos_a_cortar"=>$this->input->post('total_pliegos_a_cortar',true),
                        "total_kilos"=>$this->input->post('total_kilos',true),
                        "operador"=>$this->input->post('operador',true),
                        "numero_de_tarimas"=>$this->input->post('numero_de_tarimas',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "total_pliegos_cortados"=>$this->input->post('total_pliegos_cortados',true),
                        "ancho_realmente_cortado"=>$this->input->post('ancho_realmente_cortado',true),
                        "largo_realmente_cortado"=>$this->input->post('largo_realmente_cortado',true),
                        "can_despacho_1"=>$this->input->post('can_despacho_1',true),
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_corte_cartulina",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_corte_cartulina', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
					
					
							//Parcial				
					
					$data2=array
                    (              
                    "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "ancho_bobina"=>$this->input->post('ancho_bobina',true),
                        "largo_a_cortar"=>$this->input->post('largo_a_cortar',true),
                        "ancho_a_cortar"=>$this->input->post('ancho_a_cortar',true),
                        "total_pliegos_a_cortar"=>$this->input->post('total_pliegos_a_cortar',true),
                        "total_kilos"=>$this->input->post('total_kilos',true),
                        "operador"=>$this->input->post('operador',true),
                        "numero_de_tarimas"=>$this->input->post('numero_de_tarimas',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "total_pliegos_cortados"=>$this->input->post('total_pliegos_cortados',true),
                        "ancho_realmente_cortado"=>$this->input->post('ancho_realmente_cortado',true),
                        "largo_realmente_cortado"=>$this->input->post('largo_realmente_cortado',true),
                        "can_despacho_1"=>$this->input->post('can_despacho_1',true),

                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								 $this->db->insert("produccion_corte_cartulina_parcial",$data);
						
						 }
					//Parcial Fin
					
					
					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(8);
            $this->layout->view("corte_cartulina",compact('usuarios','datos','tipo','pagina','id','control','ing','fotomecanica','control_cartulina','bobinado_cartulina','fotomecanica2','ordenDeCompra','orden','hoja','control_cartulina_parcial')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Corrugado
     * */
	 public function corrugado($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getCorrugadoPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $fotomecanica2=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            //print_r($fotomecanica);exit;
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $confeccion_molde_troquel=$this->produccion_model->getConfeccionModelTroquelPorTipo($tipo,$id);
            $bobinado_onda=$this->produccion_model->getBobinadoCartulinaOndaPorTipo($tipo,$id);
            $bobinado_liner=$this->produccion_model->getBobinadoCartulinaLinerPorTipo($tipo,$id);
            $control_papel=$this->produccion_model->getControlControlPapelPorTipo($tipo,$id);
            $imprenta_produccion=$this->produccion_model->getImprentaProduccionPorTipo($tipo,$id);
            if($this->input->post())
            {
                if($this->form_validation->run('produccion_corrugado'))
                {
                     if(sizeof($control_papel)==0 or sizeof($bobinado_onda)==0 or sizeof($bobinado_onda)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {}
                     switch($this->input->post('estado',true))
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
						case '3':
                            $situacion='Parcial';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                     }
                   
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "datos_tecnicos"=>$fotomecanica->datos_tecnicos,
                        "onda_a_usar"=>$this->input->post('onda_a_usar',true),
                        "ancho_de_onda_a_usar"=>$this->input->post('ancho_de_onda_a_usar',true),
                        "liner_a_usar"=>$this->input->post('liner_a_usar',true),
                        "ancho_de_liner_a_usar"=>$this->input->post('ancho_de_liner_a_usar',true),
                        "tamano_a_fabricar"=>$this->input->post('tamano_a_fabricar',true),
                        "tamano_1"=>$this->input->post('tamano_1',true),
                        "tamano_2"=>$this->input->post('tamano_2',true),
                        "tamano_cuchillo_1"=>$this->input->post('tamano_cuchillo_1',true),
                        "tamano_cuchillo_2"=>$this->input->post('tamano_cuchillo_2',true),
                        "pinza"=>$this->input->post('pinza',true),
                        "reverso_a_usar"=>$this->input->post('reverso_a_usar',true),
                        "total_pliegos_a_fabricar"=>$this->input->post('total_pliegos_a_fabricar',true),
                        "operador"=>$this->input->post('operador',true),
                        "ayudante_1"=>$this->input->post('ayudante_1',true),
                        "ayudante_2"=>$this->input->post('ayudante_2',true),
                        "ayudante_3"=>$this->input->post('ayudante_3',true),
                        "total_pliegos_producidos"=>$this->input->post('total_pliegos_producidos',true),
                        "total_tarimas_producidas"=>$this->input->post('total_tarimas_producidas',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "ancho_a_corrugar"=>$this->input->post('ancho_a_corrugar',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                        "can_despacho_1"=>$this->input->post('can_despacho_1',true),
                        "can_despacho_2"=>$this->input->post('can_despacho_2',true),
                        "can_despacho_3"=>$this->input->post('can_despacho_3',true),
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_corrugado",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_corrugado', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
					
					//Parcial				
					
					$data2=array
                    (              
                  
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "datos_tecnicos"=>$fotomecanica->datos_tecnicos,
                        "onda_a_usar"=>$this->input->post('onda_a_usar',true),
                        "ancho_de_onda_a_usar"=>$this->input->post('ancho_de_onda_a_usar',true),
                        "liner_a_usar"=>$this->input->post('liner_a_usar',true),
                        "ancho_de_liner_a_usar"=>$this->input->post('ancho_de_liner_a_usar',true),
                        "tamano_a_fabricar"=>$this->input->post('tamano_a_fabricar',true),
                        "tamano_1"=>$this->input->post('tamano_1',true),
                        "tamano_2"=>$this->input->post('tamano_2',true),
                        "tamano_cuchillo_1"=>$this->input->post('tamano_cuchillo_1',true),
                        "tamano_cuchillo_2"=>$this->input->post('tamano_cuchillo_2',true),
                        "pinza"=>$this->input->post('pinza',true),
                        "reverso_a_usar"=>$this->input->post('reverso_a_usar',true),
                        "total_pliegos_a_fabricar"=>$this->input->post('total_pliegos_a_fabricar',true),
                        "operador"=>$this->input->post('operador',true),
                        "ayudante_1"=>$this->input->post('ayudante_1',true),
                        "ayudante_2"=>$this->input->post('ayudante_2',true),
                        "ayudante_3"=>$this->input->post('ayudante_3',true),
                        "total_pliegos_producidos"=>$this->input->post('total_pliegos_producidos',true),
                        "total_tarimas_producidas"=>$this->input->post('total_tarimas_producidas',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "ancho_a_corrugar"=>$this->input->post('ancho_a_corrugar',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                        "can_despacho_1"=>$this->input->post('can_despacho_1',true),
                        "can_despacho_2"=>$this->input->post('can_despacho_2',true),
                        "can_despacho_3"=>$this->input->post('can_despacho_3',true),
                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								$this->db->insert("produccion_corrugado_parcial",$data);
						
						 }
					//Parcial Fin
					
					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios2=$this->usuarios_model->getUsuariosPorTipo(8);
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(9);
            $this->layout->view("corrugado",compact('usuarios','datos','tipo','pagina','id','control','ing','usuarios2','orden','fotomecanica','confeccion_molde_troquel','fotomecanica2','ordenDeCompra','hoja','bobinado_liner','bobinado_onda','control_papel','imprenta_produccion')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Imprenta Producción
     * */
	 public function imprenta_produccion($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getImprentaProduccionPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $fotomecanica2=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            
            $cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $emplacado=$this->produccion_model->getEmplacadoPorTipo($tipo,$id);
            $corte_cartulina=$this->produccion_model->getCorteCartulinaPorTipo($tipo,$id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $imprenta_programacion=$this->produccion_model->getImprentaProgramacionPorTipo($tipo,$id);
            $control_cartulina=$this->produccion_model->getControlCartulinaPorTipo($tipo,$id);
            $confeccion_molde_troquel=$this->produccion_model->getConfeccionModelTroquelPorTipo($tipo,$id);
            if($this->input->post())
            {
                if($this->form_validation->run('impresion_produccion'))
                {
                    if(sizeof($corte_cartulina)==0 or sizeof($imprenta_programacion)==0 or sizeof($control_cartulina)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {}
                     switch($control->estado)
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        default:
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
						case '':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
							 case '3':
                                $situacion='Parcial';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                        
                     }
                   
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "colores"=>$this->input->post('colores',true),
                        "colores_metalicos"=>$this->input->post('colores_metalicos',true),
                        "tamano_a_imprimir_1"=>$this->input->post('tamano_a_imprimir_1',true),
                        "tamano_a_imprimir_2"=>$this->input->post('tamano_a_imprimir_2',true),
                        "tipo_cartulina"=>$this->input->post('tipo_cartulina',true),
                        "gramaje"=>$this->input->post('gramaje',true),
                        "barniz"=>$this->input->post('barniz',true),
                        "laca"=>$this->input->post('laca',true),
                        "cantidad_a_imprimir"=>$this->input->post('cantidad_a_imprimir',true),
                        "maestro"=>$this->input->post('maestro',true),
                        "ayudante_1"=>$this->input->post('ayudante_1',true),
                        "ayudante_2"=>$this->input->post('ayudante_2',true),
                        "ayudante_3"=>$this->input->post('ayudante_3',true),
                        "total_pliegos_buenos"=>$this->input->post('total_pliegos_buenos',true),
                        "total_merma"=>$this->input->post('total_merma',true),
                        "largo_de_pinza"=>$this->input->post('largo_de_pinza',true),
                        "impresion_para_trabajo"=>$this->input->post('impresion_para_trabajo',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "tamano_real_cartulina"=>$this->input->post('tamano_real_cartulina',true),
                        "gato"=>$this->input->post('gato',true),
                        "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
						"can_parcial"=>$this->input->post('can_parcial',true),
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_imprenta_produccion",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_imprenta_produccion', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
					
					
					
					//Parcial				
					
					$data2=array
                    (              
                   "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "colores"=>$this->input->post('colores',true),
                        "colores_metalicos"=>$this->input->post('colores_metalicos',true),
                        "tamano_a_imprimir_1"=>$this->input->post('tamano_a_imprimir_1',true),
                        "tamano_a_imprimir_2"=>$this->input->post('tamano_a_imprimir_2',true),
                        "tipo_cartulina"=>$this->input->post('tipo_cartulina',true),
                        "gramaje"=>$this->input->post('gramaje',true),
                        "barniz"=>$this->input->post('barniz',true),
                        "laca"=>$this->input->post('laca',true),
                        "cantidad_a_imprimir"=>$this->input->post('cantidad_a_imprimir',true),
                        "maestro"=>$this->input->post('maestro',true),
                        "ayudante_1"=>$this->input->post('ayudante_1',true),
                        "ayudante_2"=>$this->input->post('ayudante_2',true),
                        "ayudante_3"=>$this->input->post('ayudante_3',true),
                        "total_pliegos_buenos"=>$this->input->post('total_pliegos_buenos',true),
                        "total_merma"=>$this->input->post('total_merma',true),
                        "largo_de_pinza"=>$this->input->post('largo_de_pinza',true),
                        "impresion_para_trabajo"=>$this->input->post('impresion_para_trabajo',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "tamano_real_cartulina"=>$this->input->post('tamano_real_cartulina',true),
                        "gato"=>$this->input->post('gato',true),
                        "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
						"can_parcial"=>$this->input->post('can_parcial',true),
                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								 $this->db->insert("produccion_imprenta_produccion_parcial",$data);
						
						 }
					//Parcial Fin
					
					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(9);
            $usuarios2=$this->usuarios_model->getUsuariosPorTipo(10);
            $this->layout->view("imprenta_produccion",compact('usuarios','datos','tipo','pagina','id','control','ing','fotomecanica','cotizacion','hoja','usuarios2','emplacado','corte_cartulina','fotomecanica2','ordenDeCompra','orden','imprenta_programacion','control_cartulina','confeccion_molde_troquel')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Servicios post imprenta
     * */
	 public function servicios_post_imprenta($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getServiciosPorImprentaPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $fotomecanica2=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $imprenta_produccion=$this->produccion_model->getImprentaProduccionPorTipo($tipo,$id);
            $corte_cartulina=$this->produccion_model->getCorteCartulinaPorTipo($tipo,$id);
            if($this->input->post())
            {
                if($this->form_validation->run('servicios_post_imprenta'))
                {
                    if(sizeof($imprenta_produccion)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {}
                     switch($this->input->post('estado',true))
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        default:
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
						case '':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
							 case '3':
                                $situacion='Parcial';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                        
                     }
                   
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "si_no"=>$this->input->post('si_no',true),
                        "descripcion_trabajo_externo"=>$this->input->post('descripcion_trabajo_externo',true),
                        "proveedor"=>$this->input->post('proveedor',true),
                        "direccion_proveedor"=>$this->input->post('direccion_proveedor',true),
                        "horario_proveedor"=>$this->input->post('horario_proveedor',true),
                        "despachador"=>$this->input->post('despachador',true),
                        "camion_de_despacho"=>$this->input->post('camion_de_despacho',true),
                        "chofer"=>$this->input->post('chofer',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "tamano_cartulina"=>$this->input->post('tamano_cartulina',true),
                        "cantidad_de_pliegos"=>$this->input->post('cantidad_de_pliegos',true),
                        "instrucciones_de_despacho"=>$this->input->post('instrucciones_de_despacho',true),
                        "fecha_recepcion_pedido"=>$this->input->post('fecha_recepcion_pedido',true),
                        "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                        "can_despacho_1"=>$this->input->post('can_despacho_1',true),
                        "can_despacho_2"=>$this->input->post('can_despacho_2',true),
                        "can_despacho_3"=>$this->input->post('can_despacho_3',true),
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_servicios_post_imprenta",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_servicios_post_imprenta', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
					
					//Parcial				
					
					$data2=array
                    (              
						"id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "si_no"=>$this->input->post('si_no',true),
                        "descripcion_trabajo_externo"=>$this->input->post('descripcion_trabajo_externo',true),
                        "proveedor"=>$this->input->post('proveedor',true),
                        "direccion_proveedor"=>$this->input->post('direccion_proveedor',true),
                        "horario_proveedor"=>$this->input->post('horario_proveedor',true),
                        "despachador"=>$this->input->post('despachador',true),
                        "camion_de_despacho"=>$this->input->post('camion_de_despacho',true),
                        "chofer"=>$this->input->post('chofer',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "tamano_cartulina"=>$this->input->post('tamano_cartulina',true),
                        "cantidad_de_pliegos"=>$this->input->post('cantidad_de_pliegos',true),
                        "instrucciones_de_despacho"=>$this->input->post('instrucciones_de_despacho',true),
                        "fecha_recepcion_pedido"=>$this->input->post('fecha_recepcion_pedido',true),
                        "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                        "can_despacho_1"=>$this->input->post('can_despacho_1',true),
                        "can_despacho_2"=>$this->input->post('can_despacho_2',true),
                        "can_despacho_3"=>$this->input->post('can_despacho_3',true),
                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								 $this->db->insert("produccion_servicios_post_imprenta_parcial",$data);
						
						 }
					//Parcial Fin
					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(3);
            $this->layout->view("servicios_post_imprenta",compact('usuarios','datos','tipo','pagina','id','control','ing','fotomecanica','cotizacion','hoja','ordenDeCompra','orden','fotomecanica2','imprenta_produccion','corte_cartulina')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Emplacado
     * */
	 public function emplacado($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getEmplacadoPorTipo($tipo,$id);
            $corrugado=$this->produccion_model->getCorrugadoPorTipo($tipo,$id);
            $imprenta=$this->produccion_model->getImprentaProduccionPorTipo($tipo,$id);
            $imprenta_programacion=$this->produccion_model->getImprentaProgramacionPorTipo($tipo,$id);
            $servicios=$this->produccion_model->getServiciosPorImprentaPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $fotomecanica2=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $confeccion_molde_troquel=$this->produccion_model->getConfeccionModelTroquelPorTipo($tipo,$id);
            $cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $corte_cartulina=$this->produccion_model->getCorteCartulinaPorTipo($tipo,$id);
            if($this->input->post())
            {
                if($this->form_validation->run('produccion_emplacado'))
                {
                    if(sizeof($imprenta)==0 or sizeof($imprenta_programacion)==0 or sizeof($corrugado)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {}
                     switch($this->input->post('estado',true))
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        default:
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
						case '':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
							 case '3':
                                $situacion='Parcial';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                        
                     }
                     
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "total_pliegos_de_corrugado"=>$this->input->post('total_pliegos_de_corrugado',true),
                        "total_pliegos_de_imprenta"=>$this->input->post('total_pliegos_de_imprenta',true),
                        "operador"=>$this->input->post('operador',true),
                        "ayudante_1"=>$this->input->post('ayudante_1',true),
                        "ayudante_2"=>$this->input->post('ayudante_2',true),
                        "total_pliegos_buenos"=>$this->input->post('total_pliegos_buenos',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "ccac1"=>$this->input->post('ccac1',true),
                        "ccac2"=>$this->input->post('ccac2',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                        "can_despacho_1"=>$this->input->post('can_despacho_1',true),
                        "can_despacho_2"=>$this->input->post('can_despacho_2',true),
                        "can_despacho_3"=>$this->input->post('can_despacho_3',true),
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_emplacado",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_emplacado', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
					
							
					//Parcial				
					
					$data2=array
                    (              
						"id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "total_pliegos_de_corrugado"=>$this->input->post('total_pliegos_de_corrugado',true),
                        "total_pliegos_de_imprenta"=>$this->input->post('total_pliegos_de_imprenta',true),
                        "operador"=>$this->input->post('operador',true),
                        "ayudante_1"=>$this->input->post('ayudante_1',true),
                        "ayudante_2"=>$this->input->post('ayudante_2',true),
                        "total_pliegos_buenos"=>$this->input->post('total_pliegos_buenos',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "ccac1"=>$this->input->post('ccac1',true),
                        "ccac2"=>$this->input->post('ccac2',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                        "can_despacho_1"=>$this->input->post('can_despacho_1',true),
                        "can_despacho_2"=>$this->input->post('can_despacho_2',true),
                        "can_despacho_3"=>$this->input->post('can_despacho_3',true),
                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								 $this->db->insert("produccion_emplacado_parcial",$data);
						
						 }
					//Parcial Fin
					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(8);
            $usuarios2=$this->usuarios_model->getUsuariosPorTipo(9);
            $this->layout->view("emplacado",compact('usuarios','datos','tipo','pagina','id','control','ing','fotomecanica','cotizacion','hoja','corrugado','imprenta','confeccion_molde_troquel','servicios','usuarios2','ordenDeCompra','orden','fotomecanica2','imprenta_programacion','corte_cartulina')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Troquelado
     * */
	 public function troquelado($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getTroqueladoPorTipo($tipo,$id);
            $control_cartulina=$this->produccion_model->getControlCartulinaPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $fotomecanica2=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $emplacado=$this->produccion_model->getEmplacadoPorTipo($tipo,$id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $confeccion_molde_troquel=$this->produccion_model->getConfeccionModelTroquelPorTipo($tipo,$id);
            $corte_cartulina=$this->produccion_model->getCorteCartulinaPorTipo($tipo,$id);
            $corrugado=$this->produccion_model->getCorrugadoPorTipo($tipo,$id);
            $imprenta=$this->produccion_model->getImprentaProduccionPorTipo($tipo,$id);
            if($this->input->post())
            {
                if($this->form_validation->run('produccion_troquelado'))
                {
                    if(sizeof($emplacado)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {}
                     switch($this->input->post('estado',true))
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
						case '':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
							 case '3':
                                $situacion='Parcial';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                     }
                   
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "numero_molde_troquel"=>$this->input->post('numero_molde_troquel',true),
                        "total_pliegos_a_troquelar"=>$this->input->post('total_pliegos_a_troquelar',true),
                        "total_pliegos_recibidos_de_emplacado"=>$this->input->post('total_pliegos_recibidos_de_emplacado',true),
                        "operador"=>$this->input->post('operador',true),
                        "ayudante_1"=>$this->input->post('ayudante_1',true),
                        "total_pliegos_buenos"=>$this->input->post('total_pliegos_buenos',true),
                        "merma"=>$this->input->post('merma',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "tipo_maquina"=>$this->input->post('tipo_maquina',true),
                        "total_o_parcial"=>$this->input->post("total_o_parcial",true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "can_despacho_1"=>$this->input->post('can_despacho_1',true),
                        "can_despacho_2"=>$this->input->post('can_despacho_2',true),
                        "can_despacho_3"=>$this->input->post('can_despacho_3',true),
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_troquelado",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_troquelado', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }   

						//Parcial				
					
					$data2=array
                    (              
						   "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "numero_molde_troquel"=>$this->input->post('numero_molde_troquel',true),
                        "total_pliegos_a_troquelar"=>$this->input->post('total_pliegos_a_troquelar',true),
                        "total_pliegos_recibidos_de_emplacado"=>$this->input->post('total_pliegos_recibidos_de_emplacado',true),
                        "operador"=>$this->input->post('operador',true),
                        "ayudante_1"=>$this->input->post('ayudante_1',true),
                        "total_pliegos_buenos"=>$this->input->post('total_pliegos_buenos',true),
                        "merma"=>$this->input->post('merma',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "tipo_maquina"=>$this->input->post('tipo_maquina',true),
                        "total_o_parcial"=>$this->input->post("total_o_parcial",true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "can_despacho_1"=>$this->input->post('can_despacho_1',true),
                        "can_despacho_2"=>$this->input->post('can_despacho_2',true),
                        "can_despacho_3"=>$this->input->post('can_despacho_3',true),
                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								 $this->db->insert("produccion_troquelado_parcial",$data);
						
						 }
					//Parcial Fin

					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(8);
            $usuarios2=$this->usuarios_model->getUsuariosPorTipo(9);
            $this->layout->view("troquelado",compact('usuarios','datos','tipo','pagina','id','control','ing','fotomecanica','cotizacion','hoja','control_cartulina','orden','emplacado','usuarios2','ordenDeCompra','fotomecanica2','confeccion_molde_troquel','corte_cartulina','corrugado','imprenta')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Talleres externos
     * */
	 public function talleres_externos($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getTallerExternosPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $fotomecanica2=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $troquelado=$this->produccion_model->getTroqueladoPorTipo($tipo,$id);
            $corte_cartulina=$this->produccion_model->getCorteCartulinaPorTipo($tipo,$id);
            if($this->input->post())
            {
                if($this->form_validation->run('produccion_talleres_externos'))
                {
                    if(sizeof($troquelado)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {}
                     switch($this->input->post('estado',true))
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        default:
                             $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
						case '':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
							 case '3':
                                $situacion='Parcial';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                     }
                   
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "si_no"=>$this->input->post('si_no',true),
                        "descripcion_trabajo_externo"=>$this->input->post('descripcion_trabajo_externo',true),
                        "proveedor"=>$this->input->post('proveedor',true),
                        "direccion_proveedor"=>$this->input->post('direccion_proveedor',true),
                        "horario_proveedor"=>$this->input->post('horario_proveedor',true),
                        "despachador"=>$this->input->post('despachador',true),
                        "camion_de_despacho"=>$this->input->post('camion_de_despacho',true),
                        "chofer"=>$this->input->post('chofer',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "cantidad_a_pegar"=>$this->input->post('cantidad_a_pegar',true),
                        "precio"=>$this->input->post('precio',true),
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_talleres_externos",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_talleres_externos', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }   


					//Parcial				
					
					$data2=array
                    (              
                         "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "si_no"=>$this->input->post('si_no',true),
                        "descripcion_trabajo_externo"=>$this->input->post('descripcion_trabajo_externo',true),
                        "proveedor"=>$this->input->post('proveedor',true),
                        "direccion_proveedor"=>$this->input->post('direccion_proveedor',true),
                        "horario_proveedor"=>$this->input->post('horario_proveedor',true),
                        "despachador"=>$this->input->post('despachador',true),
                        "camion_de_despacho"=>$this->input->post('camion_de_despacho',true),
                        "chofer"=>$this->input->post('chofer',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "cantidad_a_pegar"=>$this->input->post('cantidad_a_pegar',true),
                        "precio"=>$this->input->post('precio',true),
                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								$this->db->insert("produccion_talleres_externos_parcial",$data);
						
						 }
					//Parcial Fin
					
					

					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(3);
            $this->layout->view("talleres_externos",compact('usuarios','datos','tipo','pagina','id','control','ing','fotomecanica','cotizacion','hoja','control_cartulina','fotomecanica2','ordenDeCompra','orden','troquelado','corte_cartulina')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Imprenta programación
     * */
	 public function imprenta_programacion($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getImprentaProgramacionPorTipo($tipo,$id);
            $control_cartulina=$this->produccion_model->getControlCartulinaPorTipo($tipo,$id);
            $cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica2=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $fotomecanica=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $corte_cartulina=$this->produccion_model->getCorteCartulinaPorTipo($tipo,$id);
            
            if($this->input->post())
            {
                if($this->form_validation->run('imprenta_programacion'))
                {
                    if(sizeof($control_cartulina)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {
                     switch($control->estado)
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
						case '':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
							 
                        
                     }
                   }
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "tamano_a_imprimir_1"=>$this->input->post('tamano_a_imprimir_1',true),
                        "tamano_a_imprimir_2"=>$this->input->post('tamano_a_imprimir_2',true),
                        "colores"=>$this->input->post('colores',true),
                        "procesos_adicionales"=>$this->input->post('procesos_adicionales',true),
                        "maquina"=>$this->input->post('maquina',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "troquel"=>$this->input->post('troquel',true),
                        "proveedor"=>$this->input->post('proveedor',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "descripcion_cartulina"=>$this->input->post('descripcion_cartulina',true),
                        "cantidad"=>$this->input->post('cantidad',true),
                        "gramaje"=>$this->input->post('gramaje',true),
                        "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                        "can_despacho_1"=>$this->input->post('can_despacho_1',true),
                        "can_despacho_2"=>$this->input->post('can_despacho_2',true),
                        "can_despacho_3"=>$this->input->post('can_despacho_3',true),
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_imprenta_programacion",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_imprenta_programacion', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(3);
            $this->layout->view("imprenta_programacion",compact('usuarios','datos','tipo','pagina','id','control','ing','fotomecanica','cotizacion','hoja','control_cartulina','fotomecanica2','ordenDeCompra','orden','corte_cartulina')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Desgajado
     * */
	 public function desgajado($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getDesgajadoPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $troquelado=$this->produccion_model->getTroqueladoPorTipo($tipo,$id);
            $cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
	        $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $fotomecanica2=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $corte_cartulina=$this->produccion_model->getCorteCartulinaPorTipo($tipo,$id);
            $corrugado=$this->produccion_model->getCorrugadoPorTipo($tipo,$id);
            $imprenta=$this->produccion_model->getImprentaProduccionPorTipo($tipo,$id);
            $emplacado=$this->produccion_model->getEmplacadoPorTipo($tipo,$id);
            if($this->input->post())
            {
                if($this->form_validation->run('produccion_desgajado'))
                {
                     if(sizeof($troquelado)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {}
                     switch($this->input->post('estado',true))
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        default:
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                            break;
								case '':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
							 case '3':
                                $situacion='Parcial';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                     
                   }
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "numero_de_pliegos"=>$this->input->post('numero_de_pliegos',true),
                        "unidades_de_caja_por_pliego"=>$this->input->post('unidades_de_caja_por_pliego',true),
                        "total_piezas_por_pliego"=>$this->input->post('total_piezas_por_pliego',true),
                        "total_cajas_a_entregar"=>$this->input->post('total_cajas_a_entregar',true),
                        "operador"=>$this->input->post('operador',true),
                        "merma"=>$this->input->post('merma',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "total_pliegos_troquelado"=>$this->input->post('total_pliegos_troquelado',true),
                        "total_piezas_a_desgajar"=>$this->input->post('total_piezas_a_desgajar',true),
                        "total_cajas_a_desgajar"=>$this->input->post('total_cajas_a_desgajar',true),
                        "total_desgajado"=>$this->input->post('total_desgajado',true),
                        "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_desgajado",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_desgajado', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
					
					
					//Parcial				
					
					$data2=array
                    (              
                       "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "numero_de_pliegos"=>$this->input->post('numero_de_pliegos',true),
                        "unidades_de_caja_por_pliego"=>$this->input->post('unidades_de_caja_por_pliego',true),
                        "total_piezas_por_pliego"=>$this->input->post('total_piezas_por_pliego',true),
                        "total_cajas_a_entregar"=>$this->input->post('total_cajas_a_entregar',true),
                        "operador"=>$this->input->post('operador',true),
                        "merma"=>$this->input->post('merma',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "total_pliegos_troquelado"=>$this->input->post('total_pliegos_troquelado',true),
                        "total_piezas_a_desgajar"=>$this->input->post('total_piezas_a_desgajar',true),
                        "total_cajas_a_desgajar"=>$this->input->post('total_cajas_a_desgajar',true),
                        "total_desgajado"=>$this->input->post('total_desgajado',true),
                        "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								$this->db->insert("produccion_desgajado_parcial",$data2);
						
						 }
					//Parcial Fin
					
					
					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(8);
            $this->layout->view("desgajado",compact('usuarios','datos','tipo','pagina','id','control','ing','fotomecanica','cotizacion','hoja','troquelado','orden','ordenDeCompra','fotonecanica2','corte_cartulina','imprenta','corrugado','emplacado')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Pegado
     * */
	 public function pegado($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getPegadoPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $troquelado=$this->produccion_model->getTroqueladoPorTipo($tipo,$id);
            $cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $fotomecanica2=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $troquelado=$this->produccion_model->getTroqueladoPorTipo($tipo,$id);
            $corte_cartulina=$this->produccion_model->getCorteCartulinaPorTipo($tipo,$id);
            $corrugado=$this->produccion_model->getCorrugadoPorTipo($tipo,$id);
            $imprenta=$this->produccion_model->getImprentaProduccionPorTipo($tipo,$id);
            $emplacado=$this->produccion_model->getEmplacadoPorTipo($tipo,$id);
            if($this->input->post())
            {
                if($this->form_validation->run('produccion_pegado'))
                {
                    if(sizeof($troquelado)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {}
			   
			   
			   
                     switch($this->input->post('estado',true))
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        default:
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;

							 case '3':
                                $situacion='Parcial';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                     }
                   
				   
				   
				   
				   
				   
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "total_cajas_recibidas"=>$this->input->post('total_cajas_recibidas',true),
                        "para_pegado"=>$this->input->post('para_pegado',true),
                        "empaquetado"=>$this->input->post('empaquetado',true),
                        "operador"=>$this->input->post('operador',true),
                        "cantidad_cajas_buenas"=>$this->input->post('cantidad_cajas_buenas',true),
                        "codigo_del_producto"=>$this->input->post('codigo_del_producto',true),
                        "cantidad_a_empaquetar"=>$this->input->post('cantidad_a_empaquetar',true),
                        "total_palet"=>$this->input->post('total_palet',true),
                        "cantidad_por_palet"=>$this->input->post('cantidad_por_palet',true),
                        "medidas_del_palet"=>$this->input->post('medidas_del_palet',true),
                        "entrega_parcial_o_total"=>$this->input->post('entrega_parcial_o_total',true),
                        "cantidad_pendiente"=>$this->input->post('cantidad_pendiente',true),
                        "numero_orden_de_compra"=>$this->input->post('numero_orden_de_compra',true),
                        "numero_orden_de_compra"=>$this->input->post('numero_orden_de_compra',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "tipo_pegado"=>$this->input->post("tipo_pegado",true),
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_pegado",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_pegado', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
					
					//Parcial				
					
					$data2=array
                    (              
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "total_cajas_recibidas"=>$this->input->post('total_cajas_recibidas',true),
                        "para_pegado"=>$this->input->post('para_pegado',true),
                        "empaquetado"=>$this->input->post('empaquetado',true),
                        "operador"=>$this->input->post('operador',true),
                        "cantidad_cajas_buenas"=>$this->input->post('cantidad_cajas_buenas',true),
                        "codigo_del_producto"=>$this->input->post('codigo_del_producto',true),
                        "cantidad_a_empaquetar"=>$this->input->post('cantidad_a_empaquetar',true),
                        "total_palet"=>$this->input->post('total_palet',true),
                        "cantidad_por_palet"=>$this->input->post('cantidad_por_palet',true),
                        "medidas_del_palet"=>$this->input->post('medidas_del_palet',true),
                        "entrega_parcial_o_total"=>$this->input->post('entrega_parcial_o_total',true),
                        "cantidad_pendiente"=>$this->input->post('cantidad_pendiente',true),
                        "numero_orden_de_compra"=>$this->input->post('numero_orden_de_compra',true),
                        "numero_orden_de_compra"=>$this->input->post('numero_orden_de_compra',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "tipo_pegado"=>$this->input->post("tipo_pegado",true),                    
                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								$this->db->insert("produccion_pegado_parcial",$data2);
						
						 }
					//Parcial Fin
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(8);
            $this->layout->view("pegado",compact('usuarios','datos','tipo','pagina','id','control','ing','fotomecanica','cotizacion','hoja','troquelado','fotomecanica2','ordenDeCompra','orden','troquelado','corte_cartulina','imprenta','emplacado','corrugado')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Pegado
     * */
	 public function bodega($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getBodegaPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $fotomecanica2=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $troquelado=$this->produccion_model->getTroqueladoPorTipo($tipo,$id);
            $cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $pegado=$this->produccion_model->getPegadoPorTipo($tipo,$id);
            $talleres_externos=$this->produccion_model->getTallerExternosPorTipo($tipo,$id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            if($this->input->post())
            {
                if($this->form_validation->run('produccion_bodega'))
                {
                    if(sizeof($talleres_externos)==0 or sizeof($pegado)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {}
                     switch($this->input->post('estado',true))
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        default:
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
						 case '3':
                            $situacion='Parcial';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                     }
                   
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "fecha_de_entrega"=>$this->input->post('fecha_de_entrega',true),
                        "ingreso_a_bodega"=>$this->input->post('ingreso_a_bodega',true),
                        "numero_de_orden_de_trabajo"=>$this->input->post('numero_de_orden_de_trabajo',true),
                        "cantidad_de_cajas"=>$this->input->post('cantidad_de_cajas',true),
                        "precio_venta"=>$this->input->post('precio_venta',true),
                        "codigo_producto"=>$this->input->post('codigo_producto',true),
                        "unidades_por_paquete_oficial"=>$this->input->post('unidades_por_paquete_oficial',true),
                        "unidades_paquete_efectivo"=>$this->input->post('unidades_paquete_efectivo',true),
                        "paquetes_por_pallet"=>$this->input->post('paquetes_por_pallet',true),
                        "medidas_de_pallet"=>$this->input->post('medidas_de_pallet',true),
                        "total_de_ingresos"=>$this->input->post('total_de_ingresos',true),
                        "total_cajas_ingresadas"=>$this->input->post('total_cajas_ingresadas',true),
                        "listado_ingresos_cantidades"=>$this->input->post('listado_ingresos_cantidades',true),
                        "cantidades_a_ingresar"=>$this->input->post('cantidades_a_ingresar',true),
                        "total_cajas_pendientes"=>$this->input->post('total_cajas_pendientes',true),
                        "cierra_la_orden"=>$this->input->post('cierra_la_orden',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_bodega",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_bodega', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
					
					//Parcial				
					
					$data2=array
                    (              
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "fecha_de_entrega"=>$this->input->post('fecha_de_entrega',true),
                        "ingreso_a_bodega"=>$this->input->post('ingreso_a_bodega',true),
                        "numero_de_orden_de_trabajo"=>$this->input->post('numero_de_orden_de_trabajo',true),
                        "cantidad_de_cajas"=>$this->input->post('cantidad_de_cajas',true),
                        "precio_venta"=>$this->input->post('precio_venta',true),
                        "codigo_producto"=>$this->input->post('codigo_producto',true),
                        "unidades_por_paquete_oficial"=>$this->input->post('unidades_por_paquete_oficial',true),
                        "unidades_paquete_efectivo"=>$this->input->post('unidades_paquete_efectivo',true),
                        "paquetes_por_pallet"=>$this->input->post('paquetes_por_pallet',true),
                        "medidas_de_pallet"=>$this->input->post('medidas_de_pallet',true),
                        "total_de_ingresos"=>$this->input->post('total_de_ingresos',true),
                        "total_cajas_ingresadas"=>$this->input->post('total_cajas_ingresadas',true),
                        "listado_ingresos_cantidades"=>$this->input->post('listado_ingresos_cantidades',true),
                        "cantidades_a_ingresar"=>$this->input->post('cantidades_a_ingresar',true),
                        "total_cajas_pendientes"=>$this->input->post('total_cajas_pendientes',true),
                        "cierra_la_orden"=>$this->input->post('cierra_la_orden',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								    $this->db->insert("produccion_bodega_parcial",$data);
						
						 }
					//Parcial Fin
					
					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(3);
            $this->layout->view("bodega",compact('usuarios','datos','tipo','pagina','id','control','ing','fotomecanica','cotizacion','hoja','troquelado','orden','pegado','fotomecanica2','ordenDeCompra','talleres_externos')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
	
	
	
	
	
	    public function listadoproduccion()
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
            $this->layout->view('listadoproduccion'); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	
	
	 public function validarListadoProduccionPorModulo()
				{
					if($this->session->userdata('id'))
					{
						$this->layout->setLayout('template_ajax');
						
				
						
						
						//Fotomecanica
						if($this->input->post('valor2',true) == 'Fotomecanica')
						{
							
						$nop = $this->input->post('valor1',true);
							
						$this->layout->view('ajax_listado_fotomecanica',compact('nop','valor2')); 	
					
						}
						
						//Listado Control Cartulina 
						if($this->input->post('valor2',true) == 'Listado Control Cartulina')
						{
							$nop = $this->input->post('valor1',true);
							$Buscar_estado = $this->input->post('valor3',true);
							$vendedor = $this->input->post('valor4',true);

						$this->layout->view('ajax_listado_cartulinas_general',compact('nop','valor2','Buscar_estado','vendedor')); 							
						}
						
						/*
						//Control Cartulina
						if($this->input->post('valor2',true) == 'Control Cartulina')
						{
							$nop = $this->input->post('valor1',true);
							
							
						$this->layout->view('ajax_listado_ccartulina',compact('nop','valor2')); 	
						
						}
						*/
						/*
						//Control Cartulina Estado
						if($this->input->post('valor2',true) == 'Control Cartulina Estado')
						{
							$nop = $this->input->post('valor1',true);
						$this->layout->view('ajax_listado_ccartulina_estado',compact('nop','valor2')); 	
						}
						*/
						
						
						//Listado Bobindado Cartulina
						if($this->input->post('valor2',true) == 'Listado Bobinado Cartulina')
						{
							$nop = $this->input->post('valor1',true);
							$Buscar_estado = $this->input->post('valor3',true);
							$vendedor = $this->input->post('valor4',true);
							
						$this->layout->view('ajax_listado_bobinado_cartulina_general',compact('nop','valor2','Buscar_estado','vendedor'));	
						}
						
						/*
						//Bobindado Cartulina
						if($this->input->post('valor2',true) == 'Bobinado Cartulina')
						{
							$nop = $this->input->post('valor1',true);
						$this->layout->view('ajax_listado_bobinadocartulina',compact('nop','valor2')); 	
						}
						
							//Bobindado Cartulina Estado
						if($this->input->post('valor2',true) == 'Bobinado Cartulina Estado')
						{
							$nop = $this->input->post('valor1',true);
						$this->layout->view('ajax_listado_bobinadocartulina_estado',compact('nop','valor2')); 	
						}
						
						*/
						
						//Listado Control Onda 
						if($this->input->post('valor2',true) == 'Listado Control Onda')
						{
							$nop = $this->input->post('valor1',true);
							$Buscar_estado = $this->input->post('valor3',true);
							$vendedor = $this->input->post('valor4',true);

						$this->layout->view('ajax_listado_onda_general',compact('nop','valor2','Buscar_estado','vendedor')); 							
						}
						
						
						/*
						//Control Onda
						if($this->input->post('valor2',true) == 'Control Onda')
						{
							$nop = $this->input->post('valor1',true);
						$this->layout->view('ajax_listado_conda',compact('nop','valor2')); 	
						}
						
						//Control Onda Estado
						if($this->input->post('valor2',true) == 'Control Onda Estado')
						{
							
						$nop = $this->input->post('valor1',true);
					      $this->layout->view('ajax_listado_conda_estado',compact('nop','valor2')); 
                    
						}
						*/
						
						//Bobindado Onda
						if($this->input->post('valor2',true) == 'Bobinado Onda')
						{
						$nop = $this->input->post('valor1',true);
						$this->layout->view('ajax_listado_bobinadoonda',compact('nop','valor2')); 	
						}
						
						
						
						//Bobindado Onda Estado
						if($this->input->post('valor2',true) == 'Bobinado Onda Estado')
						{
							$nop = $this->input->post('valor1',true);
						$this->layout->view('ajax_listado_bobinadoonda_estado',compact('nop','valor2')); 	
						}
						
						
						
						
						//Listado Control Liner 
						if($this->input->post('valor2',true) == 'Listado Control Liner')
						{
							$nop = $this->input->post('valor1',true);
							$Buscar_estado = $this->input->post('valor3',true);
							$vendedor = $this->input->post('valor4',true);

						$this->layout->view('ajax_listado_liner_general',compact('nop','valor2','Buscar_estado','vendedor')); 							
						}
						
						
						//Control Liner
						if($this->input->post('valor2',true) == 'Control Liner')
						{
						$this->layout->view('ajax_listado_cliner',compact('valor1','valor2')); 	
						}
						
						//Control Liner Estado
						if($this->input->post('valor2',true) == 'Control Liner Estado')
						{
						$this->layout->view('ajax_listado_cliner_estado',compact('valor1','valor2')); 	
						}
						
						
						
						//Bobindado Liner
						if($this->input->post('valor2',true) == 'Bobinado Liner')
						{
						$this->layout->view('ajax_listado_bobinadoliner',compact('valor1','valor2')); 	
						}
						
						//Bobindado Liner Estado
						if($this->input->post('valor2',true) == 'Bobinado Liner Estado')
						{
						$this->layout->view('ajax_listado_bobinadoliner_Estado',compact('valor1','valor2')); 	
						}
						
						
						
						
						//Confeccion Molde Troquel
						if($this->input->post('valor2',true) == 'Confeccion Molde Troquel')
						{
						$this->layout->view('ajax_listado_confeccion_molde_troquel',compact('valor1','valor2')); 	
						}
						
						
						
						
						
						
						//Corte Cartulina
						if($this->input->post('valor2',true) == 'Corte Cartulina')
						{
						$this->layout->view('ajax_listado_corte_cartulina',compact('valor1','valor2')); 	
						}
						
						//Corte Cartulina Estado
						if($this->input->post('valor2',true) == 'Corte Cartulina Estado')
						{
						$this->layout->view('ajax_listado_corte_cartulina_estado',compact('valor1','valor2')); 	
						}
						
						
						
						//Imprenta Programacion
						if($this->input->post('valor2',true) == 'Imprenta Programacion')
						{
						$this->layout->view('ajax_listado_imprenta_programacion_estado',compact('valor1','valor2')); 	
						}
						
						
						//Imprenta Produccion
						if($this->input->post('valor2',true) == 'Imprenta Produccion')
						{
						$this->layout->view('ajax_listado_imprenta_produccion',compact('valor1','valor2')); 	
						}
						//Imprenta Produccion Estado
						if($this->input->post('valor2',true) == 'Imprenta Produccion Estado')
						{
						$this->layout->view('ajax_listado_imprenta_produccion_estado',compact('valor1','valor2')); 	
						}
						
						
						//Servicios Post Imprenta
						if($this->input->post('valor2',true) == 'Servicios Post Imprenta')
						{
						$this->layout->view('ajax_listado_servicios_post_imprenta',compact('valor1','valor2')); 	
						}
						
						//Servicios Post Imprenta Estado
						if($this->input->post('valor2',true) == 'Servicios Post Imprenta Estado')
						{
						$this->layout->view('ajax_listado_servicios_post_imprenta_estado',compact('valor1','valor2')); 	
						}
							

						
							//Corrugado
						if($this->input->post('valor2',true) == 'Corrugado')
						{
						$this->layout->view('ajax_listado_corrugado',compact('valor1','valor2')); 	
						}
						
							//Corrugado Estado
						if($this->input->post('valor2',true) == 'Corrugado Estado')
						{
						$this->layout->view('ajax_listado_corrugado_estado',compact('valor1','valor2')); 	
						}
						
						
						//Emplacado
						if($this->input->post('valor2',true) == 'Emplacado')
						{
						$this->layout->view('ajax_listado_emplacado',compact('valor1','valor2')); 	
						}
						
						//Emplacado Estado
						if($this->input->post('valor2',true) == 'Emplacado Estado')
						{
						$this->layout->view('ajax_listado_emplacado_estado',compact('valor1','valor2')); 	
						}
						
						
						
						
						
						//Troquelado
						if($this->input->post('valor2',true) == 'Troquelado')
						{
						$this->layout->view('ajax_listado_troquelado',compact('valor1','valor2')); 	
						}
						
						
						//Troquelado Estado
						if($this->input->post('valor2',true) == 'Troquelado Estado')
						{
						$this->layout->view('ajax_listado_troquelado_estado',compact('valor1','valor2')); 	
						}
						
							//Taller Pegado Externo
						if($this->input->post('valor2',true) == 'Taller Pegado Externo')
						{
						$this->layout->view('ajax_listado_taller_pegado_externo',compact('valor1','valor2')); 	
						}
						
							//Taller Pegado Externo estado
						if($this->input->post('valor2',true) == 'Taller Pegado Externo Estado')
						{
						$this->layout->view('ajax_listado_taller_pegado_externo_estado',compact('valor1','valor2')); 	
						}
						
						
						//Desgajado
						if($this->input->post('valor2',true) == 'Desgajado')
						{
						$this->layout->view('ajax_listado_desgajado',compact('valor1','valor2')); 	
						}
						
						
						
						//Desgajado Estado
						if($this->input->post('valor2',true) == 'Desgajado Estado')
						{
						$this->layout->view('ajax_listado_desgajado_estado',compact('valor1','valor2')); 	
						}
						
						
						 //Pegado
						if($this->input->post('valor2',true) == 'Pegado')
						{
						$this->layout->view('ajax_listado_pegado',compact('valor1','valor2')); 	
						}
						 //Pegado Estado
						if($this->input->post('valor2',true) == 'Pegado Estado')
						{
						$this->layout->view('ajax_listado_pegado_estado',compact('valor1','valor2')); 	
						}


						//Bodega Parcial
						if($this->input->post('valor2',true) == 'Bodega Ingreso Parciales')
						{
						$this->layout->view('ajax_listado_bodega_parcial',compact('valor1','valor2')); 	
						}
						
						//Bodega Estado
						if($this->input->post('valor2',true) == 'Bodega Estado')
						{
						$this->layout->view('ajax_listado_bodega_estado',compact('valor1','valor2')); 	
						}
						
							//Bodega Trato pegado
						if($this->input->post('valor2',true) == 'Bodega Trato pegado' and $this->input->post('valor4',true) != '')
						{
							
							$desde =$this->input->post('valor1',true);
							$hasta =$this->input->post('valor3',true);
							$operador1 =$this->input->post('valor4',true);
							
							
							//echo $operador1;exit;
						$this->layout->view('ajax_listado_bodega_pegado',compact('desde','valor2','hasta','operador1')); 	
						}
						
						
						
						
				//		$this->layout->view('ajax_listado_fotomecanica',compact('valor1','valor2')); 
					}else
					{
						redirect(base_url().'usuarios/login',  301);
					}
					
				}
	
	
	//Filtro para pagina
	   public function listadoproduccionFotomecanica()
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
			$datos=$this->orden_model->getOrdenesConCotizacionPaginacion2($pagina,$porpagina,"limit");
			$cuantos=$this->orden_model->getOrdenesConCotizacionPaginacion2($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccionFotomecanica';
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
			
            $this->layout->view('listadoproduccionFotomecanica',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	 public function listadoproduccionPegado()
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
			$datos=$this->orden_model->getOrdenesConCotizacionPaginacion2($pagina,$porpagina,"limit");
			$cuantos=$this->orden_model->getOrdenesConCotizacionPaginacion2($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccionPegado';
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
			
            $this->layout->view('listadoproduccionPegado',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	public function listadoproduccionDesgajado()
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
			$datos=$this->orden_model->getOrdenesConCotizacionPaginacion2($pagina,$porpagina,"limit");
			$cuantos=$this->orden_model->getOrdenesConCotizacionPaginacion2($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccionDesgajado';
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
			
            $this->layout->view('listadoproduccionDesgajado',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	public function listadoproduccionCCartulina()
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
			$datos=$this->orden_model->getOrdenesConCotizacionPaginacion2($pagina,$porpagina,"limit");
			$cuantos=$this->orden_model->getOrdenesConCotizacionPaginacion2($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccionCCartulina';
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
			
            $this->layout->view('listadoproduccionCCartulina',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	public function listadoproduccionCCartulina_estado()
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
			$datos=$this->orden_model->getCCartulinaEstadoConCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->orden_model->getCCartulinaEstadoConCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccionCCartulina_estado';
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
			
            $this->layout->view('listadoproduccionCCartulina_estado',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	public function listadoproduccionbobinadocartulina()
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
			$datos=$this->produccion_model->getBobinadoCartulinaConCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getBobinadoCartulinaConCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccionbobinadocartulina';
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
			
            $this->layout->view('listadoproduccionbobinadocartulina',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	public function listadoproduccionbobinadocartulina_estado()
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
			$datos=$this->produccion_model->getBobinadoCartulinaEstadoConCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getBobinadoCartulinaEstadoConCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccionbobinadocartulina_estado';
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
			
            $this->layout->view('listadoproduccionbobinadocartulina_estado',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	public function listadoproduccionbobinadoonda()
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
			$datos=$this->produccion_model->getBobinadoOndaConCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getBobinadoOndaConCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccionbobinadoonda';
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
			
            $this->layout->view('listadoproduccionbobinadoonda',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	
	
	
	
	
	
	
	public function listadoproduccionCOnda()
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
			$datos=$this->produccion_model->getCOndaConCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getCOndaConCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccionCOnda';
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
			
            $this->layout->view('listadoproduccionCOnda',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	
	
	
	public function listadoproduccionCLiner()
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
			$datos=$this->produccion_model->getCLinerConCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getCLinerConCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccionCLiner';
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
			
            $this->layout->view('listadoproduccionCLiner',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	public function listadoproduccionbobinadoliner()
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
			$datos=$this->produccion_model->getBobinadoLinerConCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getBobinadoLinerConCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccionbobinadoliner';
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
			
            $this->layout->view('listadoproduccionbobinadoliner',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	
		public function listadoproduccioncorte_cartulina()
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
			$datos=$this->produccion_model->getCorteCartulinaConCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getCorteCartulinaConCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccioncorte_cartulina';
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
			
            $this->layout->view('listadoproduccioncorte_cartulina',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
    public function listadoproduccion_imprenta_produccion()
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
			$datos=$this->produccion_model->getImprentaProduccionConCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getImprentaProduccionConCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccion_imprenta_produccion';
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
			
            $this->layout->view('listadoproduccion_imprenta_produccion',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	 public function listadoproduccion_servicios_post_imprenta()
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
			$datos=$this->produccion_model->getImprentaProduccionConCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getImprentaProduccionConCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccion_servicios_post_imprenta';
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
			
            $this->layout->view('listadoproduccion_servicios_post_imprenta',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	 public function listadoproduccion_corrugado()
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
			$datos=$this->produccion_model->getCorrugadoCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getCorrugadoCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccion_corrugado';
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
			
            $this->layout->view('listadoproduccion_corrugado',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	
	 public function listadoproduccion_emplacado()
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
			$datos=$this->produccion_model->getEmplacadoCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getEmplacadoCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccion_emplacado';
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
			
            $this->layout->view('listadoproduccion_emplacado',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	
	
	 public function listadoproduccion_troquelado()
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
			$datos=$this->produccion_model->getTroqueladoCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getTroqueladoCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccion_troquelado';
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
			
            $this->layout->view('listadoproduccion_troquelado',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	  public function guia_despachos($id=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->orden_model->getOrdenesPorCotizacionPorId2($id);
		
        $bodega=$this->produccion_model->getBodegaPorIdnodo($id);
       
        if($this->input->post())
        {
           $glosa = $this->input->post('glosa',true);
           $total_cajas = $this->input->post('total_cajas',true);
           // $this->db->insert("hoja_de_costos",$data2);
             //$this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             //redirect($this->input->post("url",true),  301);
			 
			 
			 //echo $glosa;exit;
		 //$this->layout->view(redirect($this->input->post("url",true)));
		 
		redirect(base_url().'produccion/pdf_despacho/'.$datos->id.'/'.$total_cajas.'/'.$glosa.'/Despacho',  301);		 
        }
       $this->layout->view('guia_despachos',compact('id','pagina','datos','bodega'));  
      
		
    }
	
	
	
	
	 public function listadoproduccion_confeccion_molde_troquel()
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
			$datos=$this->produccion_model->getConfeccionMoldeTroquelCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getConfeccionMoldeTroquelCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccion_confeccion_molde_troquel';
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
			
            $this->layout->view('listadoproduccion_confeccion_molde_troquel',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	//ETIQUETAS
	
	public function pdf_etiqueta($id=null,$ide=null,$usu=null)
    {
        if($this->session->userdata('id'))
        {
            if(!$id or !$ide){show_404();}

			$datos=$this->produccion_model->getPegadoParcialPorId($ide,$usu);
			$orden=$this->orden_model->getOrdenesPorId($id);
			$producto=$this->productos_model->getProductosPorNombre($orden->nombre_producto_normal);
			
			
           //if(sizeof($datos)==0){show_404();}
           
	
	
            $cuerpo=' <!DOCTYPE html>
			<html>
				<head>
					<meta charset="utf-8" />
					
			<link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/etiquetas.css" />
			
					
				</head>
				<body>';
				
				
    $cuerpo.='
	
	<div >
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
							Etiquetas de Pegado</span>
							</h1>
							</td>
							
				</tr>
				
                </table>
       </div>
                      
            </header>
                <!--separador 20-->
                    <div class="separador_20"></div>
                <!--/separador 20-->

				
				';
            
			
			//->select("ppp.orden_de_trabajo,usu.nombre,ppp.descripcion_del_trabajo,ppp.cantidad_cajas_buenas,cli.razon_social,ppp.cuando,op.id as id_op,hcd.pegado,ppp.operador")
			for ($i = 1; $i <= 4; $i++) {
			
	$cuerpo.='		
			
			<br>
			<br>
			<table border="1">

			
				<TR>
					<TD COLSPAN=3 >
						
										<table border="0">
									
										
											<TR>
												<TH COLSPAN=3>CARTONAJES GRAU</TH> 
												<TH COLSPAN=15>OT</TH> 

												<TH COLSPAN=15>CODIGO</TH> 

											</TR>
											
											
											<TR>
												<TD COLSPAN=3></TD> 

												<TD COLSPAN=15>'.$id.'</TD> 

												<TD COLSPAN=15>'.$producto->codigo.'</TD> 
 
											</TR>
											
											
										   <TR>
												<TD COLSPAN=35>Tipo material: '.$datos->materialidad_datos_tecnicos.'</TD> 
											</TR>
											
											  <TR>
												<TH COLSPAN=1>Cliente:</TH> 											
												<TD COLSPAN=35>'.$datos->razon_social.'</TD> 											
											</TR>
											
											  <TR>
												<TH COLSPAN=1>Producto:</TH> 												
												<TD COLSPAN=35>'.$producto->nombre.'</TD> 												
											</TR>
											
											
											<TR>
												<TH COLSPAN=1>Paquetes de:</TH> 											
												<TD COLSPAN=3>'.$datos->cantidad_a_empaquetar.'</TD> 											
												<TH COLSPAN=15>UNIDADES</TH> 																						
											</TR>

											<TR>
												<TH COLSPAN=1>OPERADOR:</TH> 											
												<TD COLSPAN=15>'.$datos->nombre.'</TD> 	
                                                <TH COLSPAN=1>Fecha emisión:</TH> 											
												<TD COLSPAN=15>'.date("d/m/Y").'</TD> 												
											</TR>
											
											
										</table>
					
					      
					      
					</TD> 
					
					
					<TD COLSPAN=3>
									
									
								<table border="0">
									
										
											<TR>
												<TH COLSPAN=3>CARTONAJES GRAU</TH> 
												<TH COLSPAN=15>OT</TH> 

												<TH COLSPAN=15>CODIGO</TH> 

											</TR>
											
											
											<TR>
												<TD COLSPAN=3></TD> 

												<TD COLSPAN=15>'.$id.'</TD> 

												<TD COLSPAN=15>'.$producto->codigo.'</TD> 
 
											</TR>
											
											
										   <TR>
												<TD COLSPAN=35>Tipo material: '.$datos->materialidad_datos_tecnicos.'</TD> 
											</TR>
											
											  <TR>
												<TH COLSPAN=1>Cliente:</TH> 											
												<TD COLSPAN=35>'.$datos->razon_social.'</TD> 											
											</TR>
											
											  <TR>
												<TH COLSPAN=1>Producto:</TH> 												
												<TD COLSPAN=35>'.$producto->nombre.'</TD> 												
											</TR>
											
											
											<TR>
												<TH COLSPAN=1>Paquetes de:</TH> 											
												<TD COLSPAN=3>'.$datos->cantidad_a_empaquetar.'</TD> 											
												<TH COLSPAN=15>UNIDADES</TH> 																						
											</TR>

											<TR>
												<TH COLSPAN=1>OPERADOR:</TH> 											
												<TD COLSPAN=15>'.$datos->nombre.'</TD> 	
                                                <TH COLSPAN=1>Fecha emisión:</TH> 											
												<TD COLSPAN=15>'.date("d/m/Y").'</TD> 												
											</TR>
											
											
										</table>
					</TD> 
					

				</TR>
				
				
			 <!--separador 20-->
                    <div class="separador_20"></div>
                <!--/separador 20-->

			</table>
			
             ';
                
			} //for 4
		
    $cuerpo.='</body>
</html>';
		
		
        $this->mpdf->SetDisplayMode('fullpage');
        $css1 = file_get_contents('bootstrap/etiquetas.css');
       // $css2 = file_get_contents('bootstrap/bootstrap.css');
            //$this->mpdf->WriteHTML($css2,1);
            $this->mpdf->WriteHTML($css1,1);
    		$this->mpdf->WriteHTML($cuerpo);
    		$this->mpdf->Output();
    		exit;
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	public function pdf_despacho($id=null,$cant=null,$glosa=null)
    {
        if($this->session->userdata('id'))
        {
            if(!$id ){show_404();}

		$orden=$this->orden_model->getOrdenesPorCotizacionPorId($id);
		$hoja=$this->cotizaciones_model->getValoresCotizadasHojaDeCosto($orden->id_cotizacion);
		$cotizaciones=$this->cotizaciones_model->getCotizacionPorId($orden->id_cotizacion);
		
		$oc=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($orden->id_cotizacion);
		
		$forma_pago=$this->clientes_model->getFormasPagoPorId($oc->id_forma_pago);
		
		$cliente=$this->clientes_model->getClientePorIdParaDespacho($cotizaciones->id_cliente);
        $bodega=$this->produccion_model->getBodegaPorIdnodo($id);
			
			
			
           //if(sizeof($datos)==0){show_404();}
           
	
	
            $cuerpo=' <!DOCTYPE html>
			<html>
				<head>
					<meta charset="utf-8" />
					
			<link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/despacho.css" />
			
					
				</head>
				<body>';
				
				
    $cuerpo.='
	
	<div >
            <header>
		
                <div>
				<table>
				<tr>
							<td>
							<h1><span id="titulo"> </span></h1>
							</td>
				</tr>
				
				
					<tr>
							
							
							
							<td >
							<h1><span id="titulo" >
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							
							Despacho Bodega
							
							</span>
							</h1>
							</td>
							
				</tr>
				
                </table>
       </div>
                      
            </header>
                <!--separador 20-->
                    <div class="separador_20"></div>
                <!--/separador 20-->

				
				';
            
			
			
			
			
	$cuerpo.='		
			
		<table >		
			<tr>
				<td>
						<table>									
						<TR>	
						
						<td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td>
						<td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td>
						<td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td>
						<td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td>
						<td>
									<table align="center">
						.						<tr>
												<td class="centro titulo2 fuente3">Cartonajes Grau </td>
												</tr>
												
												<tr>
												<td class="centro">FABRICA DE CAJAS Y CARTONES </td>
												</tr>
												
												<tr>
												<td class="centro">JUAN FRANCISCO RIVAS #9435 LA CISTERNA</td>
												</tr>
												
												<tr>
												<td class="centro">FONO: 224959500</td>
												</tr>
									</table>
						</td>
						
		
	
						<td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td>
						<td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td>
						<td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td>
						<td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td>
						<td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td>
						<td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td>

						
						

							<td COLSPAN=10> </td>	

							
							<td>

											<table border="1" align="center">									
											<tr>				
												<td>Despacho Bodega Numero </td>																		
											</tr>
											
											<tr>				
												<td><strong>N: '.$id.' </strong></td>																		
											</tr>
											
											</table>

							</td>		
							
						</TR>
						
						</table>	
				</td>
			</tr>	
		</table>	
				
			 <!--separador 20-->
                    <div class="separador_20"></div>
                <!--/separador 20-->

			</table>
			
							
				<table border="1">	
				<tr>
					<td>
							<table>	
									<tr>			
									<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
									
									</tr>
							
							
									<tr>			
									<td>Fecha :</td>
									<td>'.$orden->fecha.'</td>
									</tr>
									
									<tr>
									<td>Hora despacho :</td>
									<td>'.$cliente->horario_despacho.'</td>
									</tr>
									
									<tr>
									<td>Nombre :</td>
									<td>'.$cliente->nombre_fantasia.'</td>
									</tr>
									
									<tr>
									<td>Rut :</td>
									<td>'.$cliente->rut.'</td>
									</tr>
									
									<tr>
									<td>Ciudad :</td>
									<td>'.$cliente->ciudad.'</td>
									</tr>
									
									<tr>
									<td>Direccion :</td>
									<td>'.$cliente->direccion.'</td>
									</tr>
									
									<tr>
									<td>Comuna :</td>
									<td>'.$cliente->comuna.'</td>
									</tr>

									<tr>
									<td>Telefono :</td>
									<td>'.$cliente->telefono.'</td>
									</tr>
									
									<tr>
									<td>Contacto despacho :</td>
									<td>'.$cliente->contacto.'</td>
									
	
									<tr>
									<td>Vendedor :</td>
									<td>'.$cliente->venom.'</td>
									</tr>
									
									<tr>
									<td>Tipo Pago :</td>
									<td>'.$forma_pago->forma_pago.'</td>
									</tr>
									
									
									<tr>
									<td>Detalles :</td>
									<td>'.$glosa.'</td>
									</tr>

								
							</table>	
							</td>
							
						</tr>
					</table>	
					
				
					<br>
					<br>

				<table border="1">	
				<tr>
					<td>
							<table>	
							
									
									<tr>
									<td class="borde"> <strong>OP:<strong></td>
									<td class="borde"> <strong>Cantidad:<strong></td>
									<td class="borde"> <strong>Descripcion del Producto <strong></td>
									<td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td>
									
									
									
									<td class="borde"> <strong>Precio Unitario:</strong></td>
									</tr>


									
									<tr>
									<td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td>
									</tr>	
									
									<tr>
										<td >'.$id.':</td>
										<td ><strong>'.$cant.'</strong></td>
										<td><strong>'.$orden->nombre_producto_normal.'</strong></td>
									<td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td>
										<td ><strong>'.$hoja->valor_empresa.'</strong></td>
										
										
									<td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td>
									<td></td><td></td><td></td><td></td><td></td><td></td>
									</tr>
								
								
								
							</table>	
							</td>
							
						</tr>
					</table>
				
				
				
			 <!--separador 20-->
                    <div class="separador_20"></div>
                <!--/separador 20-->

			</table>
			
             ';
                
		
		
			$cuerpo.='</body>
		</html>';
				
		
        $this->mpdf->SetDisplayMode('fullpage');
        $css1 = file_get_contents('bootstrap/etiquetas.css');
       // $css2 = file_get_contents('bootstrap/bootstrap.css');
            //$this->mpdf->WriteHTML($css2,1);
            $this->mpdf->WriteHTML($css1,1);
    		$this->mpdf->WriteHTML($cuerpo);
    		$this->mpdf->Output();
    		exit;
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	
	
	
	
	 public function BuscarKilosCartulina()
				{
					if($this->session->userdata('id'))
					{
						$this->layout->setLayout('template_ajax');
						
							$id	 =$this->input->post('valor1',true);
							$ngramaje =$this->input->post('valor2',true);
							$ancho =$this->input->post('valor3',true);
							
						
						$kilos1=$this->produccion_model->MermasParaProduccion($id,$ngramaje,$ancho);
						
						
						$this->layout->view('ajaxNuevoPlacaKilo',compact('kilos1')); 
						
					}else
					{
						redirect(base_url().'usuarios/login',  301);
					}
					
				}
	
	
	public function BuscarKilosOnda()
				{
					if($this->session->userdata('id'))
					{
						$this->layout->setLayout('template_ajax');
						
							$id	 =$this->input->post('valor1',true);
							$ngramaje =$this->input->post('valor2',true);
							$ancho =$this->input->post('valor3',true);
							
						
						$kilos1=$this->produccion_model->LlamarKilosOnda($id,$ngramaje,$ancho);
						
						
						$this->layout->view('ajaxNuevoOndaKilo',compact('kilos1')); 
						
					}else
					{
						redirect(base_url().'usuarios/login',  301);
					}
					
				}
	
		public function BuscarKilosLiner()
				{
					if($this->session->userdata('id'))
					{
						$this->layout->setLayout('template_ajax');
						
							$id	 =$this->input->post('valor1',true);
							$ngramaje =$this->input->post('valor2',true);
							$ancho =$this->input->post('valor3',true);
							
						
						$kilos1=$this->produccion_model->LlamarKilosLiner($id,$ngramaje,$ancho);
						
						
						$this->layout->view('ajaxNuevoLinerKilo',compact('kilos1')); 
						
					}else
					{
						redirect(base_url().'usuarios/login',  301);
					}
					
				}
	
	
	public function ListadoFotomecanica()
	{
	    if($this->session->userdata('id'))
        {
			
			
			//$datos=$this->orden_model->getOrdenesConCotizacionPaginacion2($pagina,$porpagina,"limit");
			$datos=$this->orden_model->getOrdenesConCotizacionPaginacion2(1,1000,"limit");
			
        $cuerpo='<!doctype html>
			<html> 
            <head>
             <meta charset="utf-8" />
            </head>
			<body>';
         
    
   
		   $cuerpo.='
		   <div class="page-header"><h3>Listado de Producción Fotomecanica</h3></div>
		   
		   <table border="1" style="font-size:10px">
					  <tr>
								  
								  <td style="width: 60px;"><b>Número Orden</b></td>
								  <td style="width: 200px;"><b>Cliente</b></td>
								  <td style="width: 200px;"><b>Detallle</b></td>
								  <td style="width: 100px;"><b>Fecha Emisión</b></td>
								  <td style="width: 80px;"><b>Vendedor</b></td>
								  <td style="width: 80px;"><b>Estado</b></td>
					  </tr>
					  
			</table>		  
            ';
  
  
  $cuerpo.=' <table border="1" style="font-size:10px"> ';
  foreach($datos as $dato)
    {
		$f=$this->clientes_model->getFormasPagoPorId($dato->id_forma_pago);
        $quien=$this->usuarios_model->getUsuariosPorId($dato->quien_autoriza);
		$estadoFotomecanica=$this->orden_model->getOrdenesPorCotizacionEstado($dato->id);
  
  
		$bodega=$this->produccion_model->getBodegaPorTipo(1,$dato->id);
  
		if($bodega->estado != '4')
		{
			if($estadoFotomecanica == null)
			{
				$estado = 'Activa';
				
			}else{
				$estado = 'Liberada';
				
			}
		   $cuerpo.='
		   
				  <tr>
						 
						 <td style="width: 60px;">'.$dato->id_op.'</td>
						 <td style="width: 200px;">'.$dato->razon_social.'</td>
						 <td style="width: 200px;">'.$dato->nombre_producto_normal.'</td>
						 <td style="width: 100px;">'.fecha($dato->fecha).'</td>
						 <td style="width: 80px;">'.$dato->nombre.'</td>
						 ';
						 
						 
			  $cuerpo.=' <td style="width: 80px;">'.$estado.'</td>';
						 
						 
			$cuerpo.='			 
				  </tr>
		  ';
		  
		}
	}
  
      $cuerpo.='</table>';
	  $cuepo.='</body>';
	  $cuepo.='</html>';

        //echo $cuerpo;exit;
		//$mpdf=new mPDF(); 
		//$nombre="Listado fotomecanica ".$id." ".date("Y-m-d H:i:s").".pdf";
		$nombre="Listado fotomecanica".date("Y-m-d H:i:s").".pdf";
		$this->mpdf->WriteHTML($cuerpo);
		$this->mpdf->Output($nombre,'I');
		exit;
            
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
    
}

