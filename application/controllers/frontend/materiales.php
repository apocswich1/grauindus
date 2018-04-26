<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Materiales extends CI_Controller {


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
            $porpagina=20;
        $datos=$this->materiales_model->getMaterialesPaginacion($pagina,$porpagina,"limit");
        $cuantos=$this->materiales_model->getMaterialesPaginacion($pagina,$porpagina,"cuantos");
        $config['base_url'] = base_url().'materiales/index';
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
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
					base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
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
           if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
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
        $config['base_url'] = base_url().'materiales/tipo/'.$id;
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
     public function gramaje()
    {
         if($this->session->userdata('id'))
        {
             $this->load->library('javascript');
            $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
            $this->layout->setLayout('template_ajax');
            $id=$this->input->post("valor1",true);
            $datos=$this->materiales_model->getMaterialesProcedenciaGramaje($id);
            //print_r($datos);exit;
            $this->layout->view('gramaje',compact("datos")); 
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
//            print_r($datos);exit;
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
                    $tridia_repetida=$this->materiales_model->getTridiaMaterialesSelect($this->input->post("tipo",true),$this->input->post("reverso",true),$this->input->post("gramaje",true));
                    if (sizeof($tridia_repetida)==0)
                    {
 		              if ( $this->form_validation->run('ad_materiales') )
    			         {
    			                $tipo=$this->input->post("tipo",true);
                                        if($tipo=="2000")
                                        {
                                              $data1=array
                                              (
                                                  "materiales_tipo"=>$this->input->post("otro_tipo",true)
                                              );
                                              $tipo=$this->materiales_model->insertarTipo($data1);
                                        }else
                                        {
                                              $tipo=$this->input->post("tipo",true);
                                        }
                                        $divisa=$this->input->post("divisa",true);
                                        if($divisa=="Pesos")
                                        { 
                                           $precio_pesos=$this->input->post("precio",true);
                                        }else
                                        {
                                           $dolar=$this->finanzas_model->getFinanzasPorId(1);
                                           $precio_pesos=$this->input->post("precio",true)*$dolar->dolar;
                                        }
                                       $data=array
                                       (
                                          "tipo"=>$tipo,
                                          "codigo"=>$this->input->post("codigo",true),
                                          "nombre"=>$this->input->post("nom",true),
                                          "id_proveedor"=>$this->input->post("proveedor",true),
                                          "reverso"=>$this->input->post("reverso",true),
                                          "id_materiales_procedencia"=>$this->input->post("procedencia",true),
                                          "gramaje"=>$this->input->post("gramaje",true),
                                          "ancho"=>$this->input->post("ancho",true),
                                          "ancho_de_pedido"=>$this->input->post("ancho_de_pedido",true),
                                          "divisa"=>$this->input->post("divisa",true),
                                          "precio"=>$this->input->post("precio",true),
                                          "precio_pesos"=>$precio_pesos,
                                          "unidad_de_compra"=>$this->input->post("unidad_de_compra",true),
                                          "fecha_ultima_actualizacion"=>date("Y-m-d"),
                                       );

                                      $guardar=$this->materiales_model->insertar($data);
                                      if($guardar)
                                      {
                                          $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
                                          redirect(base_url().'materiales',  301); 
                                      }else
                                      {
                                         $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
                                         redirect(base_url().'materiales/add',  301);
                                      }
    			         }
                    }
                    else
                    {
                        $this->session->set_flashdata('ControllerMessage', '¡Combinación de Tipo, Reverso y Gramaje ya Existe!.');
                        redirect(base_url().'materiales',  301);                         
                    }
            }
            $tipos=$this->materiales_model->getMaterialesTipo();
            
           $this->layout->view('add',compact("tipos")); 
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
            $datos=$this->materiales_model->getMaterialesPorId($id);
            if(sizeof($datos)==0){show_404();}
            if ( $this->input->post() )
            {
                    //$tridia_repetida=$this->materiales_model->getTridiaMaterialesSelect($this->input->post("tipo",true),$this->input->post("reverso",true),$this->input->post("gramaje",true));
                    $tridia_repetida=$this->materiales_model->getTridiaMaterialesSelect($this->input->post("nom",true),$this->input->post("codigo",true),$this->input->post("reverso",true),$this->input->post("gramaje",true));
//                    exit($id."==".$tridia_repetida->id);
                    if ($id==$tridia_repetida->id)
                    {                
 		        if (sizeof($tridia_repetida)==1)
                        {//print_r($data);exit(); 
                                if ( $this->form_validation->run('edit_materiales') )
    			        {
    			              $tipo=$this->input->post("tipo",true);
                                        if($tipo=="2000")
                                        {
                                              $data1=array
                                              (
                                                  "materiales_tipo"=>$this->input->post("otro_tipo",true)
                                              );
                                              $tipo=$this->materiales_model->insertarTipo($data1);
                                        }else
                                        {
                                              $tipo=$this->input->post("tipo",true);
                                        }
                                         $divisa=$this->input->post("divisa",true);
                                        if($divisa=="Pesos")
                                        { 
                                          $precio_pesos=$this->input->post("precio",true);
                                        }else
                                        {
                                           $dolar=$this->finanzas_model->getFinanzasPorId(1);
                                           $precio_pesos=$this->input->post("precio",true)*$dolar->dolar;
                                        }
                                        $data=array
                                       (
                                          "tipo"=>$tipo,
                                          "codigo"=>$this->input->post("codigo",true),
                                          "nombre"=>$this->input->post("nom",true),
                                          "id_proveedor"=>$this->input->post("proveedor",true),
                                          "reverso"=>$this->input->post("reverso",true),
                                          "id_materiales_procedencia"=>$this->input->post("procedencia",true),
                                          "gramaje"=>$this->input->post("gramaje",true),
                                          "ancho"=>$this->input->post("ancho",true),
                                          "ancho_de_pedido"=>$this->input->post("ancho_de_pedido",true),
                                          "divisa"=>$this->input->post("divisa",true),
                                          "precio"=>$this->input->post("precio",true),
                                          "precio_pesos"=>$precio_pesos,
                                          "unidad_de_compra"=>$this->input->post("unidad_de_compra",true),
                                          "fecha_ultima_actualizacion"=>date("Y-m-d"),
                                          "estado"=>$this->input->post("estado",true),
                                          "quien"=>$this->session->userdata('id'),
                                          "cuando"=>date("Y-m-d"),


                                       );                                                                       
                                        $guardar=$this->materiales_model->update($data,$this->input->post("id",true));
                                      if($guardar)
                                      {
                                          $this->session->set_flashdata('ControllerMessage', 'Se ha editado el registro exitosamente.');
                                                             redirect(base_url().'materiales/index/'.$this->uri->segment(4),  301); 
                                      }else
                                      {
                                         $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
                                                             redirect(base_url().'materiales/edit/'.$this->input->post("id",true)."/".$this->input->post("pagina",true),  301);
                                      }
    			         }
                        }
                        else
                        {
                            $this->session->set_flashdata('ControllerMessage', '¡Combinación de Tipo, Reverso y Gramaje ya Existe!.');
                            redirect(base_url().'materiales',  301);                         
                        }                          
                    }
                    else
                    {
                        if ( $this->form_validation->run('edit_materiales') )
    			        {
    			              $tipo=$this->input->post("tipo",true);
                                        if($tipo=="2000")
                                        {
                                              $data1=array
                                              (
                                                  "materiales_tipo"=>$this->input->post("otro_tipo",true)
                                              );
                                              $tipo=$this->materiales_model->insertarTipo($data1);
                                        }else
                                        {
                                              $tipo=$this->input->post("tipo",true);
                                        }
                                         $divisa=$this->input->post("divisa",true);
                                        if($divisa=="Pesos")
                                        { 
                                          $precio_pesos=$this->input->post("precio",true);
                                        }else
                                        {
                                           $dolar=$this->finanzas_model->getFinanzasPorId(1);
                                           $precio_pesos=$this->input->post("precio",true)*$dolar->dolar;
                                        }
                                        $data=array
                                       (
                                          "tipo"=>$tipo,
                                          "codigo"=>$this->input->post("codigo",true),
                                          "nombre"=>$this->input->post("nom",true),
                                          "id_proveedor"=>$this->input->post("proveedor",true),
                                          "reverso"=>$this->input->post("reverso",true),
                                          "id_materiales_procedencia"=>$this->input->post("procedencia",true),
                                          "gramaje"=>$this->input->post("gramaje",true),
                                          "ancho"=>$this->input->post("ancho",true),
                                          "ancho_de_pedido"=>$this->input->post("ancho_de_pedido",true),
                                          "divisa"=>$this->input->post("divisa",true),
                                          "precio"=>$this->input->post("precio",true),
                                          "precio_pesos"=>$precio_pesos,
                                          "unidad_de_compra"=>$this->input->post("unidad_de_compra",true),
                                          "fecha_ultima_actualizacion"=>date("Y-m-d"),
                                          "estado"=>$this->input->post("estado",true),
                                          "quien"=>$this->session->userdata('id'),
                                          "cuando"=>date("Y-m-d"),


                                       );                                                                       
                                        $guardar=$this->materiales_model->update($data,$this->input->post("id",true));
                                      if($guardar)
                                      {
                                          $this->session->set_flashdata('ControllerMessage', 'Se ha editado el registro exitosamente.');
                                                             redirect(base_url().'materiales/index/'.$this->uri->segment(4),  301); 
                                      }else
                                      {
                                         $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
                                                             redirect(base_url().'materiales/edit/'.$this->input->post("id",true)."/".$this->input->post("pagina",true),  301);
                                      }
    			         }
//                        $this->session->set_flashdata('ControllerMessage', '¡Combinación de Tipo, Reverso y Gramaje ya Existe!.');
//                        redirect(base_url().'materiales',  301);                         
                    }                         
                }
            $tipos=$this->materiales_model->getMaterialesTipo();
			
            $this->layout->view('edit',compact('datos','tipos',"pagina")); 
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
			$this->materiales_model->delete($id);
			$this->session->set_flashdata('ControllerMessage', 'Se ha eliminado el registro seleccionado.');
			redirect(base_url().'materiales',  301); 			
		}
	}


	public function search()
	{
        
        //echo $session_id;exit;
        if($this->session->userdata('id'))
        {
           if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
           if ( $this->input->post() )
             {
                //$this->session->set_userdata("chelasybares");
                $this->session->set_userdata('valor', $this->input->post('buscar',true));
                $buscar= $this->session->userdata('valor');
             }else
             {
                $buscar= $this->session->userdata('valor');
             }
            //print_r($_POST);exit;
           
           if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3);
            }else
            {
               $pagina=0;
            }
            $porpagina=5;
        $datos=$this->materiales_model->getMaterialesPaginacionPorSearch($pagina,$porpagina,"limit",$buscar);
        $cuantos=$this->materiales_model->getMaterialesPaginacionPorSearch($pagina,$porpagina,"cuantos",$buscar);
        $config['base_url'] = base_url().'materiales/search';
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
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
					base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            ); 
           $this->layout->view('search',compact('datos','cuantos','buscar')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}









    
}

