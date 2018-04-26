<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos_asociados extends CI_Controller {


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
           if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3);
            }else
            {
               $pagina=0;
            }
            $porpagina=10;
        $datos=$this->productos_asociados_model->getProductosAsociadosPaginacion($pagina,$porpagina,"limit");
        $cuantos=$this->productos_asociados_model->getProductosAsociadosPaginacion($pagina,$porpagina,"cuantos");
		
		
		
        $config['base_url'] = base_url().'productos_asociados/index';
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
    public function clientes($id=null,$pagina=null)
    {
        if($this->session->userdata('id'))
        { 
            if(!$id){show_404();}
            $cliente=$this->clientes_model->getClientePorId($id);
            if(sizeof($cliente)==0){show_404();}
            $datos=$this->productos_asociados_model->getProductosAsociadosPorCliente($id);
            $this->layout->view('clientes',compact('cliente','datos','id','pagina')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    public function por_cliente()
    {
         $this->load->library('javascript');
        $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
        $this->layout->setLayout('template_ajax');
        $id=$this->input->post("valor1",true);
        //die("ddd");
        $datos=$this->productos_asociados_model->getProductosAsociadosPorCliente($id);
        //print_r($datos);
        $this->layout->view('por_cliente',compact("datos")); 
    }
    public function add()
    {
          if($this->session->userdata('id'))
        {
            if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('ad_producto_asociado') )
    			         {
    			             $data=array
                             (
                                "id_cliente"=>$this->input->post("id_cliente",true),
                                "nombre"=>$this->input->post("nom",true),
                                "descripcion"=>$this->input->post("des",true),
                             );
                              $guardar=$this->productos_asociados_model->insertar($data);
                            if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
					           redirect(base_url().'productos_asociados',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'productos_asociados/add',  301);
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
           $this->layout->view('add'); 
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
            $datos=$this->productos_asociados_model->getProductosAsociadosPorId($id);
            if(sizeof($datos)==0){show_404();}
            if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('ad_producto_asociado') )
    			         {
    			              $data=array
                             (
                                "id_cliente"=>$this->input->post("id_cliente",true),
                                "nombre"=>$this->input->post("nom",true),
                                "descripcion"=>$this->input->post("des",true),
                             );
                              $guardar=$this->productos_asociados_model->update($data,$this->input->post("id",true));
                            if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
					           redirect(base_url().'productos_asociados/index/'.$this->input->post("pagina",true),  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'productos_asociados/edit/'.$this->input->post("id",true)."/".$this->input->post("pagina",true),  301);
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
            $this->layout->view('edit',compact('datos',"id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    
}

