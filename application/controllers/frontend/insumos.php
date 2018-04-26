<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insumos extends CI_Controller {
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
           if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
           if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3);
            }else
            {
               $pagina=0;
            }
            $porpagina=10;
        $datos=$this->insumos_model->getInsumosPaginacion($pagina,$porpagina,"limit");
        $cuantos=$this->insumos_model->getInsumosPaginacion($pagina,$porpagina,"cuantos");
        $config['base_url'] = base_url().'insumos/index';
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
     public function detalle_ajax($id=null)
    {
         if($this->session->userdata('id'))
        {
             $this->load->library('javascript');
            $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
            $this->layout->setLayout('template_ajax');
            //$id=$this->input->post("valor1",true);
            
            $datos=$this->insumos_model->getInsumosPorId($id);
            //print_r($datos);exit;
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
            if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('ad_insumo') )
    			         {
    			              
                               $data=array
                             (
                                "codigo"=>$this->input->post("codigo",true),
                                "material"=>$this->input->post("nom",true),
                                "caracteristicas"=>$this->input->post("caracteristicas",true),
                                "unidad_de_compra"=>$this->input->post("unidad_de_compra",true),
                                "unidad_de_venta"=>$this->input->post("unidad_de_venta",true),
                                "precio1"=>$this->input->post("precio1",true),
                                "precio2"=>$this->input->post("precio2",true),
                                "proveedor_1"=>$this->input->post("proveedor1",true),
                                "proveedor_2"=>$this->input->post("proveedor2",true),
                                "proveedor_3"=>$this->input->post("proveedor3",true),
                                "fecha_ultima_actualizacion"=>date("Y-m-d")
                             );
                             
                              $guardar=$this->insumos_model->insertar($data);
                            if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
					           redirect(base_url().'insumos',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'insumos/add',  301);
                            }
    			         }
                }
            $proveedores=$this->proveedores_model->getProveedores();
            $this->layout->view('add',compact('proveedores'));
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
            $datos=$this->insumos_model->getInsumosPorId($id);
            //print_r($datos);exit;
            if(sizeof($datos)==0){show_404();}
            
            
            if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('ad_insumo') )
    			         {
    			              
                                $data=array
                             (
                                "codigo"=>$this->input->post("codigo",true),
                                "material"=>$this->input->post("nom",true),
                                "caracteristicas"=>$this->input->post("caracteristicas",true),
                                "unidad_de_compra"=>$this->input->post("unidad_de_compra",true),
                                "unidad_de_venta"=>$this->input->post("unidad_de_venta",true),
                                "precio1"=>$this->input->post("precio1",true),
                                "precio2"=>$this->input->post("precio2",true),
                                "proveedor_1"=>$this->input->post("proveedor1",true),
                                "proveedor_2"=>$this->input->post("proveedor2",true),
                                "proveedor_3"=>$this->input->post("proveedor3",true),
                                "quien"=>$this->session->userdata('id'),
                                "cuando"=>date("Y-m-d"),
                             );
                             
                              $guardar=$this->insumos_model->update($data,$id);
                            if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
					           redirect(base_url().'insumos/index/'.$pagina,  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'insumos/edit/'.$id."/".$pagina,  301);
                            }
    			         }
                }
            
            $proveedores=$this->proveedores_model->getProveedores();
            $this->layout->view('edit',compact('proveedores','datos','id','pagina'));
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	public function delete() 
	{
	
		if($this->uri->segment(3))
		{
			$id=$this->uri->segment(3);
			$this->insumos_model->delete($id);
			$this->session->set_flashdata('ControllerMessage', 'Se ha eliminado el registro seleccionado.');
			redirect(base_url().'insumos',  301); 			
		}
	} 
}

