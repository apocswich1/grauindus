<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maquinas extends CI_Controller {


    private $session_id;
    public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('backend_rojo');
      
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
        $datos=$this->maquinas_model->getMaquinasPaginacion($pagina,$porpagina,"limit");
        $cuantos=$this->maquinas_model->getMaquinasPaginacion($pagina,$porpagina,"cuantos");
        
        $config['base_url'] = base_url().'maquinas/index';
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
	
	public function delete() 
	{
	
		if($this->uri->segment(3))
		{
			$id=$this->uri->segment(3);
			$this->clientes_model->deleteFormaDePago($id);
			$this->session->set_flashdata('ControllerMessage', 'Se ha eliminado el registro seleccionado.');
			redirect(base_url().'formas_pago',  301); 			
		}
	}	
	
    public function add()
    {
          if($this->session->userdata('id'))
        {
            if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            $procesos=$this->maquinas_model->getProcesos();
            if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('add_maquina') )
    			         {
			                /*
                            $a=array();
                            for($j=0;$j<sizeof($procesos);$j++)
                            {
                                if(isset($_POST["name_".$j]))
                                 {
                                    $a[]=$_POST["name_".$j];
                                 }    
                            }
                            if(sizeof($a)==0)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Debe seleccionar al menos un proceso.');
					           redirect(base_url().'fast/add',  301);
                            }
                            */
                             $data=array
                             (
                                "nombre"=>$this->input->post("nom",true),
                                "descripcion"=>$this->input->post("des",true),
                                "tamano_maximo"=>$this->input->post("tamano_maximo",true),
                                "tamano_minimo"=>$this->input->post("tamano_minimo",true),
                                "colores"=>$this->input->post("colores",true),
                                "velocidad"=>$this->input->post("velocidad",true),
                                "tiempo_de_postura"=>$this->input->post("tiempo_de_postura",true),
                                "ancho_maximo"=>$this->input->post("ancho_maximo",true),
                                "ancho_minimo"=>$this->input->post("ancho_minimo",true),
                                "fecha"=>date("Y-m-d"),
                             );
                              $guardar=$this->maquinas_model->insertar($data);
                              for($i=0;$i<sizeof($procesos);$i++)
                              {
                                 if(isset($_POST["name_".$i]))
                                 {
                                     $data2=array
                                     (
                                        "id_maquina"=>$guardar,
                                        "id_proceso"=>$_POST["name_".$i],
                                     );
                                     $this->db->insert("maquinas_procesos_relacion",$data2);
                                 }
                              }
                              
                              
                              $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
					           redirect(base_url().'maquinas',  301); 
    			         }
                }
            $this->layout->css
            (
                array
                (
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            ); 
            $this->layout->js
            (
                array
                (
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                   
                )
            ); 
           $this->layout->view('add',compact('procesos')); 
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
            $datos=$this->maquinas_model->getMaquinaPorId($id);
            $procesos=$this->maquinas_model->getProcesos();
            if(sizeof($datos)==0){show_404();}
            if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('add_maquina') )
    			         {
    			            
                            $data=array
                             (
                                "nombre"=>$this->input->post("nom",true),
                                "descripcion"=>$this->input->post("des",true),
                                "tamano_maximo"=>$this->input->post("tamano_maximo",true),
                                "tamano_minimo"=>$this->input->post("tamano_minimo",true),
                                "colores"=>$this->input->post("colores",true),
                                "velocidad"=>$this->input->post("velocidad",true),
                                "tiempo_de_postura"=>$this->input->post("tiempo_de_postura",true),
                                "ancho_maximo"=>$this->input->post("ancho_maximo",true),
                                "ancho_minimo"=>$this->input->post("ancho_minimo",true),
                                "fecha"=>date("Y-m-d"),
                             );
                           $this->maquinas_model->update($data,$this->input->post("id",true));
                           $this->maquinas_model->deleteProcesosMaquinaPorId($this->input->post("id",true)); 
                           for($i=0;$i<sizeof($procesos);$i++)
                              {
                                 if(isset($_POST["name_".$i]))
                                 {
                                     $data2=array
                                     (
                                        "id_maquina"=>$this->input->post("id",true),
                                        "id_proceso"=>$_POST["name_".$i],
                                     );
                                     $this->db->insert("maquinas_procesos_relacion",$data2);
                                 }
                              }
                              
                              
                              $this->session->set_flashdata('ControllerMessage', 'Se ha editado el registro exitosamente.');
	                          redirect(base_url().'maquinas/index/'.$this->input->post("pagina"),  301); 
    			         }
                }
            $this->layout->css
            (
                array
                (
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            ); 
             
            $this->layout->js
            (
                array
                (
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                   
                )
            ); 
            $this->layout->view('edit',compact('datos','id','pagina','procesos')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
   
}

