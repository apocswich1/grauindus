<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendedores extends CI_Controller {


    private $session_id;
    public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('backend');
      
    }
    
	public function delete()
	{
	
		if($this->uri->segment(3))
		{
			$id=$this->uri->segment(3);
			$this->vendedores_model->delete($id);
			$this->session->set_flashdata('ControllerMessage', 'Se ha eliminado el registro seleccionado.');
			redirect(base_url().'vendedores',  301); 			
		}
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
        $datos=$this->vendedores_model->getVendedoresPaginacion($pagina,$porpagina,"limit");
        $cuantos=$this->vendedores_model->getVendedoresPaginacion($pagina,$porpagina,"cuantos");
        $config['base_url'] = base_url().'vendedores/index';
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
    public function add()
    {
        if($this->session->userdata('id'))
        {
            if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            if($this->input->post())
            {
                if($this->form_validation->run("ad_vendedor"))
                {
                    $data=array
                    (
                        "nombre"=>$this->input->post("nom",true),
                        "rut"=>$this->input->post("rut",true),
                        "correo"=>$this->input->post("correo",true),
                        "telefono"=>$this->input->post("tel",true),
                        "celular"=>$this->input->post("cel",true),
                        "situacion_laboral"=>$this->input->post("situacion",true),
                        'id_region'=>$this->input->post("region",true),
                        'id_ciudad'=>$this->input->post("ciudad",true),
                        'id_comuna'=>$this->input->post("comuna",true),
                        'direccion'=>$this->input->post("dir",true),
                        'comision'=>$this->input->post("comision",true),
                        'fecha_ingreso'=>date("Y-m-d"),
						'id_vendedor'=>$this->input->post("id_vendedor",true),
                    );
                    $guardar=$this->vendedores_model->insertar($data);
                     if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
					           redirect(base_url().'vendedores',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'vendedores/add',  301);
                            }
                }
            }
            $regions=$this->direccion_model->getRegion();
            $this->layout->view('add',compact('regions')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    public function edit($id=null,$pagina=null)
    {
        if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
        if($this->session->userdata('id'))
        {
            if(!$id){show_404();}
            $datos=$this->vendedores_model->getVendedorPorId($id);
			// var_dump($datos);
            if(sizeof($datos)==0){show_404();}
             if($this->input->post())
            {
                if($this->form_validation->run("ad_vendedor"))
                {
                     $data=array
                    (
                        "nombre"=>$this->input->post("nom",true),
                        "rut"=>$this->input->post("rut",true),
                        "correo"=>$this->input->post("correo",true),
                        "telefono"=>$this->input->post("tel",true),
                        "celular"=>$this->input->post("cel",true),
                        "situacion_laboral"=>$this->input->post("situacion",true),
                        'id_region'=>$this->input->post("region",true),
                        'id_ciudad'=>$this->input->post("ciudad",true),
                        'id_comuna'=>$this->input->post("comuna",true),
                        'direccion'=>$this->input->post("dir",true),
                        'comision'=>$this->input->post("comision",true),
                        'fecha_ingreso'=>date("Y-m-d"),
						'id_vendedor'=>$this->input->post("id_vendedor",true),
						
                    );
                    $guardar=$this->vendedores_model->update($data,$this->input->post("id",true));
                     if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha editado el registro exitosamente.');
					           redirect(base_url().'vendedores/index/'.$this->input->post("pagina",true),  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'vendedores/edit/'.$this->input->post("id",true)."/".$this->input->post("pagina",true),  301);
                            }
                }
            }    
            $regions=$this->direccion_model->getRegion();
            $this->layout->view('edit',compact('regions','id','pagina','datos')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
   
}

