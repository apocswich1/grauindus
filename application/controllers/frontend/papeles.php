<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Papeles extends CI_Controller {


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
        $datos=$this->materiales_model->getMaterialesPaginacion($pagina,$porpagina,"limit");
        $cuantos=$this->materiales_model->getMaterialesPaginacion($pagina,$porpagina,"cuantos");
        $config['base_url'] = base_url().'papeles/index';
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
            $tipos=$this->materiales_model->getMaterialesTipo();
           $this->layout->view('index',compact('datos','cuantos','pagina','tipos')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
     public function tipo($id=null)
	{
        
        //echo $session_id;exit;
        if($this->session->userdata('id'))
        {
           if($this->uri->segment(4))
            {
                $pagina=$this->uri->segment(4);
            }else
            {
               $pagina=0;
            }
            $porpagina=10;
        $datos=$this->materiales_model->getMaterialesPaginacionPorTipo($pagina,$porpagina,"limit",$id);
        $cuantos=$this->materiales_model->getMaterialesPaginacionPorTipo($pagina,$porpagina,"cuantos",$id);
        $config['base_url'] = base_url().'papeles/tipo/'.$id;
            $config['total_rows'] = $cuantos;
            $config['per_page'] = $porpagina;
            $config['uri_segment'] = '4';
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
            $tipos=$this->materiales_model->getMaterialesTipo();
            $t=$this->materiales_model->getMaterialesTipoPorId($id);
           $this->layout->view('tipo',compact('datos','cuantos','pagina','tipos','t')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
     public function detalle_ajax($id=null)
    {
         if($this->session->userdata('id'))
        {
             $this->load->library('javascript');
            $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
            $this->layout->setLayout('template_ajax');
            //$id=$this->input->post("valor1",true);
            $datos=$this->materiales_model->getMaterialesPorId($id);
            print_r($datos);exit;
            $this->layout->view('detalle_ajax',compact("datos")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
    }
    public function add()
    {
          if($this->session->userdata('id'))
        {
            if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('ad_materiales') )
    			         {
    			              
                               $data=array
                             (
                                "tipo"=>$this->input->post("tipo",true),
                                "codigo"=>$this->input->post("codigo",true),
                                "nombre"=>$this->input->post("nom",true),
                                "id_proveedor"=>$this->input->post("proveedor",true),
                                "reverso"=>$this->input->post("reverso",true),
                                "procedencia"=>$this->input->post("procedencia",true),
                                "gramaje"=>$this->input->post("gramaje",true),
                                "ancho"=>$this->input->post("ancho",true),
                                "peso_kilos"=>$this->input->post("peso",true),
                                "valor_en_dolares"=>$this->input->post("dolares",true),
                                "tipo_onda"=>$this->input->post("tipo_onda",true),
                                "onda"=>$this->input->post("onda",true),
                                "liner"=>$this->input->post("liner",true),
                             );
                             
                              $guardar=$this->materiales_model->insertar($data);
                            if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
					           redirect(base_url().'papeles',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'papeles/add',  301);
                            }
    			         }
                }
            $tipos=$this->materiales_model->getMaterialesTipo();
           $this->layout->view('add',compact("tipos")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    public function edit($id=null)
    {
         if($this->session->userdata('id'))
        { 
            if(!$id){show_404();}
            $datos=$this->materiales_model->getMaterialesPorId($id);
            if(sizeof($datos)==0){show_404();}
            if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('ad_materiales') )
    			         {
    			             $data=array
                             (
                                "tipo"=>$this->input->post("tipo",true),
                                "codigo"=>$this->input->post("codigo",true),
                                "nombre"=>$this->input->post("nom",true),
                                "id_proveedor"=>$this->input->post("proveedor",true),
                                "reverso"=>$this->input->post("reverso",true),
                                "procedencia"=>$this->input->post("procedencia",true),
                                "gramaje"=>$this->input->post("gramaje",true),
                                "ancho"=>$this->input->post("ancho",true),
                                "peso_kilos"=>$this->input->post("peso",true),
                                "valor_en_dolares"=>$this->input->post("dolares",true),
                                "tipo_onda"=>$this->input->post("tipo_onda",true),
                                "onda"=>$this->input->post("onda",true),
                                "liner"=>$this->input->post("liner",true),
                             );
                              $guardar=$this->materiales_model->update($data,$this->input->post("id",true));
                            if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
					           redirect(base_url().'papeles/index/'.$this->uri->segment(4),  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'papeles/edit/'.$this->input->post("id",true),  301);
                            }
    			         }
                }
            $tipos=$this->materiales_model->getMaterialesTipo();
            $this->layout->view('edit',compact('datos','tipos')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    
}

