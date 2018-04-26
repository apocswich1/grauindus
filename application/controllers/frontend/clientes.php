<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes extends CI_Controller {


    private $session_id;
    public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('backend');
      
    }
    
    public function index()
	{
        
        //echo $session_id;exit;
        if($this->session->userdata('id'))
        {
           //if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
           if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3);
            }else
            {
               $pagina=0;
            }
            $porpagina=50;
            $datos=$this->clientes_model->getClientesPaginacion($pagina,$porpagina,"limit");
            $cuantos=$this->clientes_model->getClientesPaginacion($pagina,$porpagina,"cuantos");
            $config['base_url'] = base_url().'clientes/index';
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
           $this->layout->view('index',compact('datos','cuantos','pagina')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}

    public function index_auditoria()
	{
        
        //echo $session_id;exit;
        if($this->session->userdata('id'))
        {
           //if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
           if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3);
            }else
            {
               $pagina=0;
            }
            $porpagina=10;
        $datos=$this->clientes_model->getClientesPaginacion($pagina,$porpagina,"limit");
        $cuantos=$this->clientes_model->getClientesPaginacion($pagina,$porpagina,"cuantos");
        $config['base_url'] = base_url().'clientes/index';
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
           $this->layout->view('index',compact('datos','cuantos','pagina')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}

        
     public function search()
	{
        
        //echo $session_id;exit;
        if($this->session->userdata('id'))
        {
           if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
           if ( $this->input->post() )
             {
                //$this->session->set_userdata("chelasybares");
                $this->session->set_userdata('valor', str_replace('.', '', $this->input->post('buscar',true)));
                $buscar= $this->session->userdata('valor');
             }else
             {
                $buscar= $this->session->userdata('valor');
             }
            //print_r($_POST);exit;
           
           if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3);
            }else
            {
               $pagina=0;
            }
            $porpagina=10;
        $datos=$this->clientes_model->getClientesPaginacionPorSearchSinRegion($pagina,$porpagina,"limit",$buscar);
        $cuantos=$this->clientes_model->getClientesPaginacionPorSearchSinRegion($pagina,$porpagina,"cuantos",$buscar);
        $config['base_url'] = base_url().'clientes/search';
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
           $this->layout->view('search',compact('datos','cuantos','buscar')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
     public function activos()
	{
        
        //echo $session_id;exit;
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
        $datos=$this->clientes_model->getClientesPaginacionPorEstado($pagina,$porpagina,"limit","0");
        $cuantos=$this->clientes_model->getClientesPaginacionPorEstado($pagina,$porpagina,"cuantos","0");
        $config['base_url'] = base_url().'clientes/activos';
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
           $this->layout->view('activos',compact('datos','cuantos')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    public function no_activos()
	{
        
        //echo $session_id;exit;
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
        $datos=$this->clientes_model->getClientesPaginacionPorEstado($pagina,$porpagina,"limit","1");
        $cuantos=$this->clientes_model->getClientesPaginacionPorEstado($pagina,$porpagina,"cuantos","1");
        $config['base_url'] = base_url().'clientes/no_activos';
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
           $this->layout->view('no_activos',compact('datos','cuantos')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    public function region()
    {
         $this->load->library('javascript');
        $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
        $this->layout->setLayout('template_ajax');
        $id=$this->input->post("valor1",true);
        //die("ddd");
        $datos=$this->direccion_model->getCiudadPorRegion($id);
        //print_r($datos);
        $this->layout->view('region',compact("datos")); 
    }
    public function comuna()
    {
         $this->load->library('javascript');
        $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
        $this->layout->setLayout('template_ajax');
        $id=$this->input->post("valor1",true);
        //die("ddd");
        $datos=$this->direccion_model->getComunaPorCiudad($id);
        //print_r($datos);
        $this->layout->view('comuna',compact("datos")); 
    }
    
    public function add()
    	{
            if($this->session->userdata('id'))
            {
                // if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
                 if ( $this->input->post() )
 		 {
 		    if ( $this->form_validation->run('ad_cliente') )
                    {
    			if(!isset($_POST["si"]))
                        {
                            $data=array
                            (
                                'rut'=>$this->input->post("rut",true),
                                'razon_social'=>$this->input->post("razon",true),
                                'nombre_fantasia'=>$this->input->post("nom",true),
                                'id_region'=>$this->input->post("region",true),
                                'id_ciudad'=>$this->input->post("ciudad",true),
                                'id_comuna'=>$this->input->post("comuna",true),
                                'direccion'=>$this->input->post("dir",true),
                                'correo'=>$this->input->post("correo",true),
                                'telefono'=>$this->input->post("tel",true),
                                'celular'=>$this->input->post("cel",true),
                                'id_forma_pago'=>$this->input->post("forma_pago",true),
                                'direccion_despacho'=>$this->input->post("dir2",true),
                                'id_region_despacho'=>$this->input->post("region2",true),
                                'id_ciudad_despacho'=>$this->input->post("ciudad2",true),
                                'id_comuna_despacho'=>$this->input->post("comuna2",true),
                                'horario_despacho'=>$this->input->post("horario",true),
                                'observaciones'=>$this->input->post("descripcion",true),
                                'fecha_ingreso'=>date("Y-m-d H:m:s"),
                                "fecha_ultima_compra"=>"",
                                'id_vendedor'=>$this->input->post("vendedor",true),
                                'cupo_maximo'=>$this->input->post('cupo_maximo',true),
                            );       
                    }else
                    {
                            $data=array
                            (
                                'rut'=>$this->input->post("rut",true),
                                'razon_social'=>$this->input->post("razon",true),
                                'nombre_fantasia'=>$this->input->post("nom",true),
                                'id_region'=>$this->input->post("region",true),
                                'id_ciudad'=>$this->input->post("ciudad",true),
                                'id_comuna'=>$this->input->post("comuna",true),
                                'direccion'=>$this->input->post("dir",true),
                                'correo'=>$this->input->post("correo",true),
                                'telefono'=>$this->input->post("tel",true),
                                'celular'=>$this->input->post("cel",true),
                                'id_forma_pago'=>$this->input->post("forma_pago",true),
                                'direccion_despacho'=>$this->input->post("dir",true),
                                'id_region_despacho'=>$this->input->post("region",true),
                                'id_ciudad_despacho'=>$this->input->post("ciudad",true),
                                'id_comuna_despacho'=>$this->input->post("comuna",true),
                                'horario_despacho'=>$this->input->post("horario",true),
                                'observaciones'=>$this->input->post("descripcion",true),
                                'fecha_ingreso'=>date("Y-m-d H:m:s"),
                                "fecha_ultima_compra"=>"",
                                'id_vendedor'=>$this->input->post("vendedor",true),
                                'contacto'=>$this->input->post("contacto",true),
                                'cupo_maximo'=>$this->input->post('cupo_maximo',true),
                            );       
                    }
                            
                    $guardar=$this->clientes_model->insertar($data);
                    if($guardar)
                    {
                        $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
                                           redirect(base_url().'clientes',  301); 
                    }else
                    {
                       $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
                                           redirect(base_url().'clientes/add',  301);
                    }
                }
            }             
                  $this->layout->js
                    (
                        array
                            (
                                base_url().'public/backend/js/tiny_mce/tiny_mce.js'
                            )
                    );
                 $regions=$this->direccion_model->getRegion(); 
                 $formas=$this->clientes_model->getFormasPago();
                 $vendedors=$this->usuarios_model->getVendedores();
                 $this->layout->view('add',compact("regions","formas","vendedors"));
            }else
            {
                redirect(base_url().'usuarios/login',  301);
            }    
           
    	}
        public function mensaje($id=null)
        {
           if($this->session->userdata('id'))
            {
             if(!$id){ show_404();exit;}
             $this->layout->setLayout('template_ajax');
             $datos=$this->clientes_model->getClientePorIdSinJoin($id);
             //print_r($datos);exit;
             if($this->input->post())
             {
                    $config['mailtype'] = 'html';
                    $this->email->initialize($config);
                    $this->email->from("contacto@grauindus.cl", 'Cartonajes Grau');
                    $this->email->to($datos->correo); 
                    $this->email->bcc('respaldocorreos@grauindus.cl');
                    $this->email->subject('Mensaje de Cartonajes Grau');
                    $html="<h2>Nuevo Mensaje:</h2>".$this->input->post("mensaje",true);
                    $this->email->message($html);   

                    $this->email->send();

                    $this->session->set_flashdata('ControllerMessage', 'Se ha enviado el mensaje exitosamente.');
                   redirect($this->input->post("url",true),  301); 
             }
             
             $this->layout->view('mensaje',compact("datos","id"));
             }else
            {
                redirect(base_url().'usuarios/login',  301);
            } 
        }
        public function edit($id=null)
        {
            if ( $this->input->post() ) $error_rut=true;
            else $error_rut=false;
            if($this->session->userdata('id'))
            {
             if(!$id){ show_404();exit;}
             $datos=$this->clientes_model->getClientePorIdSinJoin($id);
             if(sizeof($datos)==0){show_404();}
                 if ( $this->input->post() )
 		         {
                            if ( $this->input->post("rut",true)!=$this->config->item('rut_repetido'))
                            {        
                                $error_rut=false;
                                if ( $this->form_validation->run('edit_cliente') )
                                {
                                    $data=array
                                    (
                                        'rut'=>$this->input->post("rut",true),
                                        'razon_social'=>$this->input->post("razon",true),
                                        'nombre_fantasia'=>$this->input->post("nom",true),
                                        'id_region'=>$this->input->post("region",true),
                                        'id_ciudad'=>$this->input->post("ciudad",true),
                                        'id_comuna'=>$this->input->post("comuna",true),
                                        'direccion'=>$this->input->post("dir",true),
                                        'correo'=>$this->input->post("correo",true),
                                        'telefono'=>$this->input->post("tel",true),
                                        'celular'=>$this->input->post("cel",true),
                                        'id_forma_pago'=>$this->input->post("forma_pago",true),
                                        'direccion_despacho'=>$this->input->post("dir2",true),
                                        'id_region_despacho'=>$this->input->post("region2",true),
                                        'id_ciudad_despacho'=>$this->input->post("ciudad2",true),
                                        'id_comuna_despacho'=>$this->input->post("comuna2",true),
                                        'horario_despacho'=>$this->input->post("horario",true),
                                        'observaciones'=>$this->input->post("descripcion",true),
                                        'fecha_ingreso'=>date("Y-m-d H:m:s"),
                                        "fecha_ultima_compra"=>"",
                                        'id_vendedor'=>$this->input->post("vendedor",true),
                                        'deuda_vigente'=>$this->input->post('deuda_vigente',true),
                                        'fast'=>$this->input->post("fast",true),
                                        'contacto'=>$this->input->post("contacto",true),
                                        'cupo_maximo'=>$this->input->post('cupo_maximo',true),
                                        'estado'=>$this->input->post('estado',true),
                                        'bloqueado'=>$this->input->post('bloqueado',true),
                                        "quien"=>$this->session->userdata('id'),
                                        "cuando"=>date("Y-m-d"),
                                    );       
//                                    exit(print_r($data));
                                    $guardar=$this->clientes_model->update($data,$this->input->post("id",true));
                                    if($guardar)
                                    {
                                        $this->session->set_flashdata('ControllerMessage', 'Se ha editado el registro exitosamente.');
                                        redirect(base_url().'clientes',  301); 
                                    }else
                                    {
                                       $this->session->set_flashdata('ControllerMessage', 'Se produjo un error interno. Por favor inténtelo nuevamente.');
                                       redirect(base_url().'clientes/edit/'.$id,  301);
                                    }
                                }
                            }
                 }            
                $regions=$this->direccion_model->getRegion(); 
                $formas=$this->clientes_model->getFormasPago();
                $vendedors=$this->usuarios_model->getVendedores();
                $cuidads=$this->direccion_model->getCiudad();
                $comunas=$this->direccion_model->getComuna();
                $this->layout->js
                (
                    array
                        (
                            base_url().'public/backend/js/tiny_mce/tiny_mce.js'
                        )
                );
                $this->layout->view('edit',compact("regions","formas","vendedors","datos","cuidads","comunas","error_rut"));
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
						//var_dump($pagina);
					}
					// else
					// {
					   // $pagina=0;
					// }				
				
                   // $data=array
                   // (
                        // "estado"=>"1"
                   // );
                   // $delete=$this->clientes_model->update($data,$id);
				    $this->clientes_model->delete($pagina);
                    // if($delete)
                                // {
					$this->session->set_flashdata('ControllerMessage', 'Se ha eliminado el registro exitosamente.');
					redirect(base_url().'clientes',  301); 
                                // }
								// else
                                // {
                                   // $this->session->set_flashdata('ControllerMessage', 'Se produjo un error interno. Por favor inténtelo nuevamente.');
    					           // redirect(base_url().'clientes',  301);
                                // }
                }else
                {
                    redirect(base_url().'usuarios/login',  301);
                } 
             }   
    /**
     * métodos para logueo
     **/
    public function login()
        	{
                if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('logueo') )
    			         {
    			             //echo sha1($this->input->post('pass',true))."<br>";
                             $datos=$this->usuarios_model->logueo($this->input->post('rut',true),sha1($this->input->post('pass',true))); 
                             //echo $datos;exit;
                             if(sizeof($datos)>=1)
                             {
                                   //die("s");
                                   $this->session->set_userdata("grau");
                                   $this->session->set_userdata('id', $datos->id);
                                   $this->session->set_userdata('nombre', $datos->nombre);
                                   $this->session->set_userdata('cargo', $datos->id_cargo);
                                   $this->session->set_userdata('rut', $datos->rut);
                                   $this->session->set_userdata('perfil', $datos->id_perfil);
                                   redirect(base_url().'',  301);
                             }else
                             {
                                $this->session->set_flashdata('ControllerMessage', 'Usuario y/o clave inválida.');
					           redirect(base_url().'backend/usuarios/login',  301);
                             }
                         }   
                 }     
                  $this->layout->setLayout('login');
                  $this->layout->view('login'); 
               
                
        	}
            public function logout()
        {
            $this->session->unset_userdata(array('login' => ''));
            $this->session->sess_destroy("grau");
            redirect(base_url().'usuarios/login',  301);
        }
     /**
     * #######################################################
     * CONTACTOS CLIENTES
     * */
    public function mensaje_contacto($id=null)
        {
           if($this->session->userdata('id'))
            {
             if(!$id){ show_404();exit;}
             $this->layout->setLayout('template_ajax');
             $datos=$this->clientes_model->geContactosPorId($id);
             //print_r($datos);exit;
             if($this->input->post())
             {
                    $config['mailtype'] = 'html';
                    $this->email->initialize($config);
                    $this->email->from("contacto@grauindus.cl", 'Cartonajes Grau');
                    $this->email->to($datos->correo); 
                    $this->email->bcc('respaldocorreos@grauindus.cl');
                    $this->email->subject('Mensaje de Cartonajes Grau');
                    $html="<h2>Nuevo Mensaje:</h2>".$this->input->post("mensaje",true);
                    $this->email->message($html);   

                    $this->email->send();

                    $this->session->set_flashdata('ControllerMessage', 'Se ha enviado el mensaje exitosamente.');
                   redirect($this->input->post("url",true),  301); 
             }
             
             $this->layout->view('mensaje_contacto',compact("datos","id"));
             }else
            {
                redirect(base_url().'usuarios/login',  301);
            } 
        } 
   public function contactos($id=null,$pagina=null)
   {
        if($this->session->userdata('id'))
            {
                if(!$id){show_404();}
                $cliente=$this->clientes_model->getClientePorIdSinJoin($id);
                if(sizeof($cliente)==0){show_404();}
                $datos=$this->clientes_model->geContactosClientePorId($id);
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
                $this->layout->view('contacto',compact("datos","cliente","pagina","id")); 
            }else
            {
                redirect(base_url().'usuarios/login',  301);
            } 
   }
   public function contacto_add($id=null,$pagina=null)
   {
        if($this->session->userdata('id'))
            {
                if(!$id){show_404();}
                $cliente=$this->clientes_model->getClientePorIdSinJoin($id);
                if(sizeof($cliente)==0){show_404();}
                 if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('ad_contacto_cliente') )
    			         {
    			              $data=array
                            (
                                'id_cliente'=>$this->input->post("id_cliente",true),
                                'nombre'=>$this->input->post("nom",true),
                                'correo'=>$this->input->post("correo",true),
                                'telefono'=>$this->input->post("tel",true),
                                'funcion'=>$this->input->post("funcion",true),
                            );       
                            $guardar=$this->clientes_model->insertarContacto($data);
                            $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
					           redirect(base_url().'clientes/contactos/'.$id."/".$pagina,  301); 
    			         }
                 }        
                
                $this->layout->view('contacto_add',compact("cliente","pagina","id")); 
            }else
            {
                redirect(base_url().'usuarios/login',  301);
            } 
   }
   public function contacto_edit($ide=null,$id=null,$pagina=null)
   {
    if($this->session->userdata('id'))
            {
                if(!$id or !$ide){show_404();}
                $cliente=$this->clientes_model->getClientePorIdSinJoin($id);
                if(sizeof($cliente)==0){show_404();}
                $datos=$this->clientes_model->geContactosPorId($ide);
                if(sizeof($datos)==0){show_404();}
                 if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('ad_contacto_cliente') )
    			         {
    			              $data=array
                            (
                                'id_cliente'=>$this->input->post("id_cliente",true),
                                'nombre'=>$this->input->post("nom",true),
                                'correo'=>$this->input->post("correo",true),
                                'telefono'=>$this->input->post("tel",true),
                                'funcion'=>$this->input->post("funcion",true),
                            );       
                            $guardar=$this->clientes_model->updateContacto($data,$ide);
                            $this->session->set_flashdata('ControllerMessage', 'Se ha editado el registro exitosamente.');
					           redirect(base_url().'clientes/contactos/'.$id."/".$pagina,  301); 
    			         }
                 }        
                
                $this->layout->view('contacto_edit',compact("cliente","pagina","id","datos","ide")); 
            }else
            {
                redirect(base_url().'usuarios/login',  301);
            } 
   }
    public function contacto_delete($ide=null,$id=null,$pagina=null)
   {
        if($this->session->userdata('id'))
            {
                if(!$id or !$ide){show_404();}
                $datos=$this->clientes_model->getClientePorIdSinJoin($ide);
                if(sizeof($datos)==0){show_404();}
                $guardar=$this->clientes_model->deleteContacto($ide);
                            $this->session->set_flashdata('ControllerMessage', 'Se ha eliminado el registro exitosamente.');
					           redirect(base_url().'clientes/contactos/'.$id."/".$pagina,  301); 
            }else
            {
                redirect(base_url().'usuarios/login',  301);
            }
   }
   
    public function validarRut()
    {
            if($this->session->userdata('id'))
            {
                    $this->layout->setLayout('template_ajax');
                    $this->layout->view('ajaxValidarRut',compact('rut')); 
            }else
            {
                    redirect(base_url().'usuarios/login',  301);
            }

    }   
}

