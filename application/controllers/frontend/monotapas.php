<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Monotapas extends CI_Controller {


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
        $datos=$this->monotapas_model->getMonotapasPaginacion($pagina,$porpagina,"limit");
        $cuantos=$this->monotapas_model->getMonotapasPaginacion($pagina,$porpagina,"cuantos");
        $config['base_url'] = base_url().'monotapas/index';
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
     public function detalle_ajax($id=null)
    {
         if($this->session->userdata('id'))
        {
             $this->load->library('javascript');
            $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
            $this->layout->setLayout('template_ajax');
            //$id=$this->input->post("valor1",true);
            $datos=$this->monotapas_model->getMonotapaPorId($id);
            //print_r($datos);exit;
            $this->layout->view('detalle_ajax',compact("datos")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
    }
     public function gramaje1()
    {
         if($this->session->userdata('id'))
        {
             $this->load->library('javascript');
            $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
            $this->layout->setLayout('template_ajax');
            $id=$this->input->post("valor1",true);
            $datos=$this->materiales_model->getMaterialesPorId($id);
//            print_r($datos);exit;
            $this->layout->view('gramaje1',compact("datos")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
    }
    public function gramaje2()
    {
         if($this->session->userdata('id'))
        {
             $this->load->library('javascript');
            $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
            $this->layout->setLayout('template_ajax');
            $id=$this->input->post("valor1",true);
            $datos=$this->materiales_model->getMaterialesPorId($id);
//            print_r($datos);exit;
            $this->layout->view('gramaje2',compact("datos")); 
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
                 if ( $this->form_validation->run('ad_monotapas') )
                 {
                        $gramaje=$this->input->post("gramaje",true);
                        $liner=$this->input->post("gramaje2",true);
                        $onda=$this->input->post("onda",true);
                        $precio=$this->input->post("precio",true);
                        $precio2=$this->input->post("precio2",true);
                        if($onda=="Microcorrugado")
                        {
                            $g=$gramaje*1.3+$liner;
                        }else
                        {
                            $g=$gramaje*1.37+$liner;
                        }
                        if($precio2>$precio)
                        {
                          $p=$precio2;
                        }else
                        {
                          $p=$precio;
                        }
                        
                       $data=array
                       (
                          "id_tapa"=>$this->input->post("tapa",true),
                          "codigo"=>$this->input->post("codigo",true),
                          "nombre"=>$this->input->post("nom",true),
                          "gramaje_onda"=>$this->input->post("gramaje",true),
                          "onda"=>$this->input->post("onda",true),
                          "gramaje_liner"=>$this->input->post("gramaje2",true),
                          "liner"=>$this->input->post("liner",true),
                          "gramaje"=>$g,
                          "id_tapa_2"=>$this->input->post("tapa2",true),
                          "precio"=>$p,
                       );

                      $guardar=$this->monotapas_model->insertar($data);
                      if($guardar)
                      {
                          $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
                                             redirect(base_url().'monotapas',  301); 
                      }else
                      {
                         $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
                                             redirect(base_url().'monotapas/add',  301);
                      }
                    }
                }
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
            if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            if(!$id){show_404();}
            $datos=$this->monotapas_model->getMonotapaPorId($id);
//            print_r($datos);
            if(sizeof($datos)==0){show_404();}
            
            if ( $this->input->post() )
            {
                 if ( $this->form_validation->run('edit_monotapas') )
                    {
    			             
                              $gramaje=$this->input->post("gramaje",true);
                              $liner=$this->input->post("gramaje2",true);
                              $onda=$this->input->post("onda",true);
                              $precio=$this->input->post("precio",true);
                              $precio2=$this->input->post("precio2",true);
                              if($onda=="Microcorrugado")
                              {
                                  $g=$gramaje*1.3+$liner;
                              }else
                              {
                                  $g=$gramaje*1.37+$liner;
                              }
                              if($precio2>$precio)
                              {
                                $p=$precio2;
                              }else
                              {
                                $p=$precio;
                              }
                              //echo $g;exit;
                               $data=array
                             (
                                "id_tapa"=>$this->input->post("tapa",true),
                                "codigo"=>$this->input->post("codigo",true),
                                "nombre"=>$this->input->post("nom",true),
                                "gramaje_onda"=>$this->input->post("gramaje",true),
                                "onda"=>$this->input->post("onda",true),
                                "gramaje_liner"=>$this->input->post("gramaje2",true),
                                "liner"=>$this->input->post("liner",true),
                                "gramaje"=>$g,
                                "id_tapa_2"=>$this->input->post("tapa2",true),
                                "precio"=>$p,
                                "estado"=>$this->input->post("estado",true),
                                "quien"=>$this->session->userdata('id'),
                                "cuando"=>date("Y-m-d"),
                                
                             );
                             
                            $guardar=$this->monotapas_model->update($data,$this->input->post("id",true));
                            if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha editado el registro exitosamente.');
					           redirect(base_url().'monotapas/index/'.$this->input->post("pagina",true),  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'monotapas/edit/'.$this->input->post("id",true)."/".$this->input->post("pagina",true),  301);
                            }
    			         }
                }
            
            $this->layout->view('edit',compact("datos","pagina","id")); 
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
			$this->monotapas_model->delete($id);
			$this->session->set_flashdata('ControllerMessage', 'Se ha eliminado el registro seleccionado.');
			redirect(base_url().'monotapas',  301); 			
		}
	}  
}

