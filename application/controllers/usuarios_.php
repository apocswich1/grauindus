<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_ extends CI_Controller {


    private $session_id;
    public function __construct()
    {
        parent::__construct();
       // $this->layout->setLayout('backend');
      
    }
    
	public function index()
	{
        
        //echo $session_id;exit;
        if($this->session->userdata('id'))
        {
           $datos=$this->usuarios_model->getUsuarios();
           $this->layout->view('index',compact('datos')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    public function vendedores()
	{
        
        //echo $session_id;exit;
        if($this->session->userdata('id'))
        {
           $datos=$this->usuarios_model->getVendedores();
           $this->layout->view('vendedores',compact('datos')); 
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
                 if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('ad_usuario') )
    			         {
    			            $data=array
                            (
                                'nombre'=>$this->input->post("nom",true),
                                'correo'=>$this->input->post("correo",true),
                                'rut'=>$this->input->post("rut",true),
                                'correo'=>$this->input->post("correo",true),
                                'pass'=>sha1($this->input->post("pass",true)),
                                'telefono'=>$this->input->post("tel",true),
                                'id_cargo'=>$this->input->post("cargo",true),
                                'id_perfil'=>$this->input->post("perfil",true),
                                'fecha_ingreso'=>date("Y-m-d H:m:s")
                            );       
                            $guardar=$this->usuarios_model->insertar($data);
                            if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
					           redirect(base_url().'usuarios',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'usuarios/add',  301);
                            }
                         }
                 }             
                 $perfiles=$this->usuarios_model->getPerfiles();  
                 $cargos=$this->usuarios_model->getCargos();
                 $this->layout->view('add',compact("perfiles","cargos"));
            }else
            {
                redirect(base_url().'backend/usuarios/login',  301);
            }    
           
    	}
        public function edit($id=null)
        {
            if(!$id){ show_404();exit;}
             $datos=$this->usuarios_model->getUsuariosPorId($id);
             if(sizeof($datos)==0){show_404();}
            if($this->session->userdata('id'))
            {
                 if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('edit_usuario') )
    			         {
    			           $pass=$this->input->post("pass",true);
                           if(empty($pass))
                           {
                                $data=array
                                (
                                    'nombre'=>$this->input->post("nom",true),
                                    'correo'=>$this->input->post("correo",true),
                                    'rut'=>$this->input->post("rut",true),
                                    'correo'=>$this->input->post("correo",true),
                                    'telefono'=>$this->input->post("tel",true),
                                    'id_cargo'=>$this->input->post("cargo",true),
                                    'id_perfil'=>$this->input->post("perfil",true)
                                );   
                           }else
                           {
                                $data=array
                                (
                                    'nombre'=>$this->input->post("nom",true),
                                    'correo'=>$this->input->post("correo",true),
                                    'rut'=>$this->input->post("rut",true),
                                    'correo'=>$this->input->post("correo",true),
                                    'pass'=>sha1($this->input->post("pass",true)),
                                    'telefono'=>$this->input->post("tel",true),
                                    'id_cargo'=>$this->input->post("cargo",true),
                                    'id_perfil'=>$this->input->post("perfil",true)
                                );   
                           }
                                 
                            $guardar=$this->usuarios_model->update($data,$this->input->post("id",true));
                            if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha editado el registro exitosamente.');
					           redirect(base_url().'usuarios',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'Se produjo un error interno. Por favor inténtelo nuevamente.');
					           redirect(base_url().'usuarios/edit',  301);
                            }
                         }
                 }            
                 $perfiles=$this->usuarios_model->getPerfiles();  
                 $cargos=$this->usuarios_model->getCargos();
                 $this->layout->view('edit',compact('datos','id','perfiles','cargos'));
            }else
            {
                redirect(base_url().'backend/usuarios/login',  301);
            }    
        }
         public function delete($id=null)
            {
                if(!$id)
                {
                    show_404();exit;
                }
                if(!empty($this->session_id))
                {
                    $delete=$this->usuarios_model->delete($id);
                    if($delete)
                                {
                                    $this->session->set_flashdata('ControllerMessage', 'Se ha eliminado el registro exitosamente.');
    					           redirect(base_url().'backend/usuarios',  301); 
                                }else
                                {
                                   $this->session->set_flashdata('ControllerMessage', 'Se produjo un error interno. Por favor inténtelo nuevamente.');
    					           redirect(base_url().'backend/usuarios',  301);
                                }
                }else
                {
                    redirect(base_url().'backend/usuarios/login',  301);
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
					           redirect(base_url().'usuarios/login',  301);
                             }
                         }   
                 }     
              //    $this->layout->setLayout('login');
                 // $this->layout->view('login'); 
                       $this->views->load('cabcera');
        $this->views->load('menuLogo');
        $this->views->load('contenido');
        $this->views->load('piePagina');
                
        	}
            public function logout()
        {
            $this->session->unset_userdata(array('login' => ''));
            $this->session->sess_destroy("grau");
            redirect(base_url().'usuarios/login',  301);
        }
    
}

