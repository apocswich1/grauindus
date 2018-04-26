<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class unidades_de_venta extends CI_Controller {


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
        $datos=$this->unidades_de_venta_model->getUnidadesDeVenta();
           $this->layout->view('index',compact('datos')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
	
	public function delete() 
	{
	
		if($this->uri->segment(3))
		{
			if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            $id=$this->uri->segment(3);
			$this->unidades_de_venta_model->delete($id);
			$this->session->set_flashdata('ControllerMessage', 'Se ha eliminado el registro seleccionado.');
			redirect(base_url().'unidades_de_venta',  301); 			
		}
	}	
	
    public function add()
    {
        if($this->session->userdata('id'))
        {
            if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            if($this->input->post())
            {
                if($this->form_validation->run("ad_unidad_de_venta"))
                {
                    $data=array
                    (
                        "unidades_de_venta"=>$this->input->post("nom",true),
                        
                    );
                    $guardar=$this->unidades_de_venta_model->insertar($data);
                     if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
					           redirect(base_url().'unidades_de_venta',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'unidades_de_venta/add',  301);
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
    public function edit($id=null)
    {
        if($this->session->userdata('id'))
        {
            if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            if(!$id){show_404();}
            $datos=$this->unidades_de_venta_model->getUnidadesDeVentaPorId($id);
            if(sizeof($datos)==0){show_404();}
             if($this->input->post())
            {
                if($this->form_validation->run("ad_unidad_de_venta"))
                {
                    $data=array
                    (
                        "unidades_de_venta"=>$this->input->post("nom",true),
                        
                    );
                    $guardar=$this->unidades_de_venta_model->update($data,$this->input->post("id",true));
                     if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha editado el registro exitosamente.');
					           redirect(base_url().'unidades_de_venta',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'unidades_de_venta/edit/'.$this->input->post("id",true),  301);
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

