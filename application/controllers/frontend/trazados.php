<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trazados extends CI_Controller {


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
          if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3);
            }else
            {
               $pagina=0;
            }
            $porpagina=10;
         
            //$trazados_select=$this->trazados_model->getTrazados();
            $datos=$this->trazados_model->getTrazadosAll_indexPaginacion($pagina,$porpagina,"limit");
            $cuantos=$this->trazados_model->getTrazadosAll_indexPaginacion($pagina,$porpagina,"cuantos");
            $config['base_url'] = base_url().'trazados/index';
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
//            print_r($config);            
             
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
           $this->layout->view('index',compact('datos','cuantos','pagina','trazados_select')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    

    public function search()
	{
        if($this->session->userdata('id'))
        {
            if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3);
            }else
            {
               $pagina=0;
            }
            $porpagina=10;
            if ( $this->input->post() )
            {
                $this->session->set_userdata('valor', $this->input->post('buscar',true));
                $buscar= $this->session->userdata('valor');
            }else
            {
                $buscar= $this->session->userdata('valor');
            }
            $datos=$this->trazados_model->getTrazadosSearchPaginacion($pagina,$porpagina,"limit",$buscar);
            $cuantos=$this->trazados_model->getTrazadosSearchPaginacion($pagina,$porpagina,"cuantos",$buscar);
            $config['base_url'] = base_url().'trazados/search';
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
            $this->layout->view('search',compact('datos','cuantos','pagina','buscar')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
}
        
        
     public function search_tipo($valor=null)
	{
        if($this->session->userdata('id'))
        {
            if(!$valor){show_404();}
            if ($valor!='') 
            {    
                if (!is_numeric($valor)) 
                    $this->session->set_userdata('valor_molde', $valor);
                $buscar_molde= $this->session->userdata('valor_molde');
            }                
            else
                $buscar_molde= $this->session->userdata('valor_molde');

            if($this->uri->segment(3))
            {
               $pagina=$this->uri->segment(3);
            }else
            {
               $pagina=0;
            }
            $porpagina=10;
            $datos=$this->trazados_model->getTrazadosAll_indexPaginacion_Seachr($pagina,$porpagina,"limit",$buscar_molde);
            $cuantos=$this->trazados_model->getTrazadosAll_indexPaginacion_Seachr($pagina,$porpagina,"cuantos",$buscar_molde);		

		
            $config['base_url'] = base_url().'trazados/search_tipo';
            $config['total_rows'] = $cuantos;
            $config['per_page'] = $porpagina;
            $config['uri_segment'] = '3';
            $config['num_links'] = '3';
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
//            print_r($config);
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
           $this->layout->view('search_tipo',compact('datos','cuantos','pagina','buscar_molde')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}        
        
   public function add()
    {
          if($this->session->userdata('id'))
        {
            if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('ad_molde') )
    			         {
                                  if(empty($_FILES["file"]["name"]))
                                    {
                                        $file_name=$this->input->post("archivo",true);
                                    }else
                                    {
                                         $error=NULL;
                                   //valido la foto
                                    $config['upload_path'] = './'.$this->config->item('direccion_pdf');
                                    $config['allowed_types'] = 'pdf';
                                    $config['max_size'] = '10240'; //550 x 138
                                    $config['encrypt_name'] = true; 
                                     $this->load->library('upload', $config);
                                     if ( ! $this->upload->do_upload('file'))
                                     {
                                            $this->session->set_flashdata('ControllerMessage', 'Error de archivo del Molde, no puede tener un tamaño mayor a 1 Megabyte (MB).');
                                            $this->session->set_flashdata('css',"danger");                                   
                                            redirect(base_url().'trazados/edit/'.$this->input->post("id",true)."/".$this->input->post("pagina",true),  301);                                         
                                            $error = array('error' => $this->upload->display_errors());
                                            $this->session->set_flashdata('mensaje', $error["error"]);
                                            $this->session->set_flashdata('css',"danger");
                                            redirect(base_url().'trazados/add',  301);
                                            
                                     }
                                        
                                        $ima = $this->upload->data();
                                        $file_name = $ima['file_name'];
                                        $datos_archivo_historial=array
                                        (
                                            "id_trazados"=>$id,
                                            "archivo"=>$datos->archivo,
                                            "fecha"=>date('Y-m-d'),                        
                                        );
                                       // $this->trazados_model->insertar_historial($datos_archivo_historial);                                              
                                    }
                                  //comentado
//                               $error=NULL;
//                                   //valido la foto
//                                    $config['upload_path'] = './'.$this->config->item('direccion_pdf');
//                                    $config['allowed_types'] = 'pdf';
//                                    $config['max_size'] = '10240'; //550 x 138
//                                    $config['encrypt_name'] = true; 
//                                     $this->load->library('upload', $config);
                                     //fin de comentado
//                                     if (!$this->upload->do_upload('file'))
//                                        {
//                                            $this->session->set_flashdata('ControllerMessage', 'Error de archivo del Molde, no puede tener un tamaño mayor a 1 Megabyte (MB).');
//                                            $this->session->set_flashdata('css',"danger");                                   
//                                            redirect(base_url().'trazados/add/'.$this->input->post("id",true)."/".$this->input->post("pagina",true),  301);                                           
//                                            $error = array('error' => $this->upload->display_errors());
//                                            $this->session->set_flashdata('mensaje', $error["error"]);
//                                            //$this->session->set_flashdata('css',"danger");
//                                            //redirect(base_url().'trazados/add',  301);
//                                            $file_name='';
//                                        }
//                                        
                                            $ima = $this->upload->data();
                                            $file_name = $ima['file_name'];
                             $data=array
                             (
                                "nombre"=>$this->input->post("nom",true),
                                "numero"=>0,
                                "archivo"=>$file_name,
                                "nombrecliente"=>$this->input->post("nombrecliente",true),
                                "tamano_caja"=>$this->input->post("tamano_caja",true),
                                "medidas_de_las_cajas"=>$this->input->post("medidas_de_las_cajas",true),
                                "medidas_de_las_cajas_2"=>$this->input->post("medidas_de_las_cajas_2",true),
                                "medidas_de_las_cajas_3"=>$this->input->post("medidas_de_las_cajas_3",true),
                                "medidas_de_las_cajas_4"=>$this->input->post("medidas_de_las_cajas_4",true),
                                "unidades_productos_completos"=>$this->input->post("unidades_productos_completos",true),
                                "piezas_totales"=>$this->input->post("piezas_totales",true),
                                "cuchillocuchillo"=>$this->input->post("tamano_cuchillo_1",true),
                                "cuchillocuchillo2"=>$this->input->post("tamano_cuchillo_2",true),
                                "ancho_bobina"=>$this->input->post("ancho_bobina",true),
                                "largo_bobina"=>$this->input->post("largo_bobina",true),
                                "fecha"=>date("Y-m-d"),
                                "nombrecliente2"=>$this->input->post("nombrecliente2",true),
                                "tipo"=>$this->input->post("tipo",true),
                                "fecha_creacion"=>$this->input->post("fecha_creacion",true),
                                "materialidad_opcion1"=>$this->input->post("materialidad_opcion1",true),
                                "materialidad_opcion2"=>$this->input->post("materialidad_opcion1",true),
                                "placa1"=>$this->input->post("placa1",true),
                                "onda1"=>$this->input->post("onda1",true),
                                "liner1"=>$this->input->post("liner1",true),
                                "placa2"=>$this->input->post("placa2",true),
                                "onda2"=>$this->input->post("onda2",true),
                                "liner2"=>$this->input->post("liner2",true),
                                "estatus"=>$this->input->post("estatus",true),
                                "colores"=>$this->input->post("colores",true),
                                "estado"=>0,
                                "rango_gramaje"=>$this->input->post("rango_gramaje",true),
                             );
                              $this->db->insert("trazados",$data);
                              $this->db->where('id', $this->db->insert_id());
                              $arreglo=array
                              (
                                "numero"=>$this->db->insert_id(),
                              );
                              $this->db->update("trazados",$arreglo);
                              $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');					           redirect(base_url().'trazados',  301); 
    			         }
                }   
                $this->layout->js
                (
                    array
                    (
                       
                        base_url()."public/backend/js/bootstrap.file-input.js"
                    )
                );  
                 $this->layout->css
            (
                array
                (
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );    
           $clientes=$this->clientes_model->getClientesNormal();      
           $this->layout->view('add',compact('clientes')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
     public function edit($id=null,$pagina=null)
    {
          if($this->session->userdata('id'))
        {
             if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
             if(!$id){show_404();}
            $datos=$this->trazados_model->getTrazadosPorId($id);
            //print_r($datos);exit;
            if(sizeof($datos)==0){show_404();}
            if ( $this->input->post() )
 		         {
                //echo $this->input->post("tamano_caja",true);exit();
 		             if ( $this->form_validation->run('ad_molde') )
    			         {
    			              if(empty($_FILES["file"]["name"]))
                                    {
                                        $file_name=$this->input->post("archivo",true);
                                    }else
                                    {
                                         $error=NULL;
                                   //valido la foto
                                    $config['upload_path'] = './'.$this->config->item('direccion_pdf');
                                    $config['allowed_types'] = 'pdf';
                                    $config['max_size'] = '10240'; //550 x 138
                                    $config['encrypt_name'] = true; 
                                     $this->load->library('upload', $config);
                                     if ( ! $this->upload->do_upload('file'))
                                     {
                                            $this->session->set_flashdata('ControllerMessage', 'Error de archivo del Molde, no puede tener un tamaño mayor a 1 Megabyte (MB).');
                                            $this->session->set_flashdata('css',"danger");                                   
                                            redirect(base_url().'trazados/edit/'.$this->input->post("id",true)."/".$this->input->post("pagina",true),  301);                                         
                                            $error = array('error' => $this->upload->display_errors());
                                            $this->session->set_flashdata('mensaje', $error["error"]);
                                            $this->session->set_flashdata('css',"danger");
                                            redirect(base_url().'trazados/add',  301);
                                            
                                     }
                                        
                                        $ima = $this->upload->data();
                                        $file_name = $ima['file_name'];
                                        $datos_archivo_historial=array
                                        (
                                            "id_trazados"=>$id,
                                            "archivo"=>$datos->archivo,
                                            "fecha"=>date('Y-m-d'),                        
                                        );
                                        $this->trazados_model->insertar_historial($datos_archivo_historial);                                              
                                    }
                              $data=array
                             (
                                "nombre"=>$this->input->post("nom",true),
                                "numero"=>$this->input->post("num",true),
                                "archivo"=>$file_name,
                                "nombrecliente"=>$this->input->post("nombrecliente",true),
                                "tamano_caja"=>$this->input->post("tamano_caja",true),
                                "medidas_de_las_cajas"=>$this->input->post("medidas_de_las_cajas",true),
                                "medidas_de_las_cajas_2"=>$this->input->post("medidas_de_las_cajas_2",true),
                                "medidas_de_las_cajas_3"=>$this->input->post("medidas_de_las_cajas_3",true),
                                "medidas_de_las_cajas_4"=>$this->input->post("medidas_de_las_cajas_4",true),
                                "unidades_productos_completos"=>$this->input->post("unidades_productos_completos",true),
                                "piezas_totales"=>$this->input->post("piezas_totales",true),
                                "cuchillocuchillo"=>$this->input->post("tamano_cuchillo_1",true),
                                "cuchillocuchillo2"=>$this->input->post("tamano_cuchillo_2",true),
                                "ancho_bobina"=>$this->input->post("ancho_bobina",true),
                                "largo_bobina"=>$this->input->post("largo_bobina",true),
                                "estado"=>$this->input->post("estado",true),
                                "nombrecliente2"=>$this->input->post("nombrecliente2",true),
                                "tipo"=>$this->input->post("tipo",true),
                                "fecha_creacion"=>$this->input->post("fecha_creacion",true),
                                "glosa"=>$this->input->post("glosa",true),
                                "pauta"=>$this->input->post("pauta",true),
                                "materialidad_opcion1"=>$this->input->post("materialidad_opcion1",true),
                                "materialidad_opcion2"=>$this->input->post("materialidad_opcion2",true),
                                "placa1"=>$this->input->post("placa1",true),
                                "onda1"=>$this->input->post("onda1",true),
                                "liner1"=>$this->input->post("liner1",true),
                                "placa2"=>$this->input->post("placa2",true),
                                "onda2"=>$this->input->post("onda2",true),
                                "liner2"=>$this->input->post("liner2",true),
                                "estatus"=>$this->input->post("estatus",true),
                                "colores"=>$this->input->post("colores",true),
                                "rango_gramaje"=>$this->input->post("rango_gramaje",true),
                             );
                              
                            // print_r($data);//exit(); 
                              $this->db->where('id', $this->input->post("id",true));
                              $this->db->update("trazados",$data);
                              $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');					           redirect(base_url().'trazados/index/'.$this->input->post("pagina",true),  301); 
    			         }
                }
            $this->layout->js
            (
                    array
                    (
                       
                        base_url()."public/backend/js/bootstrap.file-input.js"
                    )
            );  
                $this->layout->css
            (
                array
                (
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            ); 
           $clientes=$this->clientes_model->getClientesNormal();     
           $proveedores=$this->proveedores_model->getProveedores();     
           $this->layout->view('edit',compact("datos","id","pagina","proveedores","clientes")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
     public function instruccion($motivo,$id,$tipo)
    { 
          if($this->session->userdata('id'))
        {
             if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            //$datos=$this->trazados_model->getTrazadosPorId($id);
            //if(sizeof($datos)==0){show_404();}
              //echo "holaaa";exit();
            
//            $this->layout->js
//            (
//                    array
//                    (
//                       
//                        base_url()."public/backend/js/bootstrap.file-input.js"
//                    )
//            );  
//                $this->layout->css
//            (
//                array
//                (
//                    base_url()."public/frontend/css/prism.css",
//                    base_url()."public/frontend/css/chosen.css",
//                )
//            ); 
           $datos=$this->trazados_model->getTrazadosConClientePorId($id);
           $clientes=$this->clientes_model->getClientesNormal();     
           $proveedores=$this->proveedores_model->getProveedores();
           $this->layout->setLayout('template_ajax');
           if($tipo == 1){
           $this->layout->view('instruccion',compact("datos","motivo"));     
           }else{
               if($tipo==2){
           $this->layout->view('instruccion_revision',compact("datos","motivo"));     
           }}
           //$this->layout->view('instruccion',compact("datos","motivo")); 
                    
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    public function detalle_ajax()
    {
        if($this->session->userdata('id'))
        {
            if($this->input->post())
            {
                $this->layout->setLayout('template_ajax');
                $id=$this->input->post("valor1",true);
                $datos=$this->trazados_model->getTrazadosPorId($id);
//                exit(print_r($datos));
                $this->layout->view('detalle_ajax',compact("datos","id"));
            }else
            {
                show_404();
            }    
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    
    public function detalle_ajax_cambio_molde()
    {
        if($this->session->userdata('id'))
        {
            if($this->input->post())
            {
                $this->layout->setLayout('template_ajax');
                $id=$this->input->post("valor1",true);
                $datos=$this->trazados_model->getTrazadosPorId($id);
//                exit(print_r($datos));
                $this->layout->view('detalle_ajax_cambio_molde',compact("datos","id"));
            }else
            {
                show_404();
            }    
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    
    public function datos()
    {
        if($this->session->userdata('id'))
        {
            if($this->input->post())
            {
                $this->layout->setLayout('template_ajax');
                $id=$this->input->post("valor1",true);
                $datos=$this->trazados_model->getTrazadosDetallePorId($id);
//                exit(print_r($datos));
                $this->layout->view('detalle_ajax_cambio_trazado',compact("datos","id"));
            }else
            {
                show_404();
            }    
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    
    public function delete($id=null)
    {
        if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
        if(!$id)
        {
            show_404();exit;
        }
        if($this->session->userdata('id'))
        {
            $pagina="";
            if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3);
            }
            $this->trazados_model->delete_id($pagina);
            $this->session->set_flashdata('ControllerMessage', 'Se ha eliminado el registro exitosamente.');
            redirect(base_url().'trazados',  301); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        } 
    }   
    
}

