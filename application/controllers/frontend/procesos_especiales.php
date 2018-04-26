<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Procesos_especiales extends CI_Controller {


    private $session_id;
    public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('backend');
        $this->load->model('procesos_especiales_model');
      
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
        $datos=$this->procesos_especiales_model->getProcesosEspecialesPaginacion($pagina,$porpagina,"limit");
        $cuantos=$this->procesos_especiales_model->getProcesosEspecialesPaginacion($pagina,$porpagina,"cuantos");
        
        $config['base_url'] = base_url().'procesos_especiales/index';
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
            
            $this->layout->view('index',compact('datos','cuantos','pagina')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}    
    
    public function index2()
	{
        error_reporting(E_ALL);
       // print_r(base_url());//.'test');
        //
        $this->load->model('procesos_especiales_model');

        $datos = $this->procesos_especiales_model->getProcesosEspeciales();
      

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
       // $datos=$this->proveedores_model->getProveedoresPaginacion($pagina,$porpagina,"limit");
       // $cuantos=$this->proveedores_model->getProveedoresPaginacion($pagina,$porpagina,"cuantos");
        $config['base_url'] = base_url().'procesos_especiales/index';
            $config['total_rows'] = 10;
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
           $this->layout->view('procesosEspeciales',compact('datos')); 
        }else
        {
            redirect(base_url().'procesos_especiales/procesosEspeciales',  301);
        }
        
	}
        
        function retornaDatos()
        {
                    $this->load->model('procesos_especiales_model');

        $datos = $this->procesos_especiales_model->getProcesosEspeciales();
        return $datos;
        }
        
        public function  guardar()
        {
            error_reporting(E_ALL);
           $proceso['proceso'] = $this->input->post("proceso",true);
           
         $proc = $proceso['proceso'];

         $this->load->model('procesos_especiales_model');
         $datos = array("nombre_procesp"=>$this->input->post("proceso",true));
         $resultado = $this->procesos_especiales_model->insertar($datos);
          $datos = $this->procesos_especiales_model->getProcesosEspeciales();
      $editar = false;
         $this->layout->view('procesosEspeciales',compact('datos')); 

        }
        
    public function add($id=null,$pagina=null)
    {
        if($this->session->userdata('id'))
        {
            if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            if ( $this->input->post() )
            {
                if ($this->form_validation->run('ad_proceso_especiales'))
                {
//                    exit("paso");
                  $data=array
                  (
                     "id_proveedores"=>$this->input->post("id_proveedores",true),
                     "nombre_procesp"=>$this->input->post("nombre_procesp",true),
                     "ancho"=>$this->input->post("ancho",true),
                     "largo"=>$this->input->post("largo",true),
                     "tipo"=>$this->input->post("tipo",true),
                     "precio"=>$this->input->post("precio",true),
                  );
                   $guardar=$this->procesos_especiales_model->insertar($data);                  
                   $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');					           
                   redirect(base_url().'procesos_especiales/index/'.$this->input->post("pagina",true),  301); 
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
           $proveedores=$this->proveedores_model->getProveedores();     
           $this->layout->view('add',compact("datos","id","pagina","proveedores")); 
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
            $proveedores=$this->proveedores_model->getProveedores();     
            $datos = $this->procesos_especiales_model->getProcesosEspecialesEdit($id);        
//            print_r($datos);
            if(sizeof($datos)==0){show_404();}
            if ( $this->input->post() )
            {
//         exit("hola22");                  
                if ($this->form_validation->run('ad_proceso_especiales'))
                {
//                    exit("paso");
                  $data=array
                  (
                     "id_proveedores"=>$this->input->post("id_proveedores",true),
                     "nombre_procesp"=>$this->input->post("nombre_procesp",true),
                     "ancho"=>$this->input->post("ancho",true),
                     "largo"=>$this->input->post("largo",true),
                     "tipo"=>$this->input->post("tipo",true),
                     "precio"=>$this->input->post("precio",true),
                  );
                   $this->db->where('id_procesp', $this->input->post("id",true));
                   $this->db->update("procesosespeciales",$data);
                   $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');					           
                   redirect(base_url().'procesos_especiales/index/'.$this->input->post("pagina",true),  301); 
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
//           $clientes=$this->clientes_model->getClientesNormal();     
           $proveedores=$this->proveedores_model->getProveedores();     
           $this->layout->view('edit',compact("datos","id","pagina","proveedores")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }        
        
        public function eliminar($id = null)
        {
         $datos = array("nombre_procesp"=>$this->input->post("proceso",true),"id_procesp"=>$this->uri->segment(3));
         $id=$this->uri->segment(3);
         $resultado = $this->procesos_especiales_model->delete($id);
         $datos = $this->procesos_especiales_model->getProcesosEspeciales();
         $this->layout->view('procesosEspeciales',compact('datos'));     
        }
        
        public function retornaDatosEditar($id = null)
        {
              $val = "";
              $this->load->model('procesos_especiales_model');
              $datos['valores'] = $this->procesos_especiales_model->getProcesosEspecialesPorId($id);       
              $nombreEditar = $datos['valores']->nombre_procesp;
          //    print_r( $datos['valores']->nombre_procesp);// $nombreEditar;
             // print_r("**");
            //  print_r($nombreEditar);
              $datos['nombre_editar'] = $nombreEditar;//$valor['valores']->nombre_procesp;
        //   var_dump($datos['nombre_editar']);
              $datos['id'] = $id;
              $datos['tabla'] = $this->procesos_especiales_model->getProcesosEspeciales();
            //  $$nombreEditar = $valor['valores']->nombre_procesp;
            //   $this->layout->view('procesosEspecialesEditar',compact('datos'));
           // var_dump($nombreEditar);
              
              $this->layout->view('procesosEspecialesEditar',$datos);
            

             //echo $nombreEditar;   
        }

}