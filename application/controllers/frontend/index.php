<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
       $this->layout->setLayout('backend');
        $this->load->model('datosinicio_model');
    }
    
	public function index()
	{
         if($this->session->userdata('id'))
        {
         
        $datos['pendientes'] =  $this->datosinicio_model->getCotizacionesEnRevision();   
        $datos['aprobadas'] =  $this->datosinicio_model->getCotizacionesAprobadas();  
        $datos['todas'] =  $this->datosinicio_model->getTodasCotizaciones();  
         
        
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
        
            $this->layout->view('index',$datos);
  
            
            
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
	public function no_acceso()
	{
        if($this->session->userdata('id'))
        {
            $this->layout->view('no_acceso');
       
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    
}
