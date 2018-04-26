<?php

class migracion_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
        
     
    public function insertar($data=array())
    {
        $this->db->insert("migracion",$data);
//                echo $this->db->last_query()."<br>";         
        
        return true;
    }
    
    public function getMigracionPorId($id)
    {
           $query=$this->db
                ->select("n_costo")
                ->from("migracion")
                ->where(array("n_costo"=>$id))
                ->get();
//                echo $this->db->last_query();exit;           
                return $query->row();
    }    
    
    
    public function getMigracionPorCodigo($id)
    {
        $sql = "select codigo from n_costo_migrado where codigo =".$id;
        $query=$this->db->query($sql);
                        //echo $this->db->last_query();exit;           
        return $query->row();
    }
    
    
    public function getMigracionPorCodigo2($id)
    {
         $query=$this->db
                ->select('codigo')
                ->from("n_costo_migrado")
                ->where(array("codigo"=>$id))
                ->get();
                return $query->num_rows();
    }

    public function getMigracion_MicroondaPorId($id)
    {
           $query=$this->db
                ->select("*")
                ->from("migracion_microonda")
                ->where(array("codmicro"=>$id))
                ->get();
//               echo $this->db->last_query();exit;           
                return $query->row();
    }        
    

    public function getPlacaSistemaViejoPorId($id)
    {
	
	$sql = "select * from placas_migradas where id_viejo=".$id;
        $query=$this->db->query($sql);
        return $query->row();
    } 
    
    public function getPlacaPorId($id)
    {
	
	$sql = "select * from materiales where id =".$id;
        $query=$this->db->query($sql);
        return $query->row();
    }       
    
    public function getOndaPorId($id)
    {
	
	$sql = "select * from materiales where id =".$id;
	//$sql = "select * from materiales where id =1";
        $query=$this->db->query($sql);
        return $query->row();
    }        
    

    public function getLinerPorId($id)
    {
	
	$sql = "select * from materiales where id =".$id;
        $query=$this->db->query($sql);
        return $query->row();
    }      
        
    
//    public function getPlacaPorId($gramaje,$reverso)
//    {
//        $sql="select m.nombre from materiales as m where m.estado = 1 and (m.tipo=1 or m.tipo = 10 or m.tipo = 14 or m.tipo = 15 or m.tipo = 3 or m.tipo = 4) and gramaje='".$gramaje."' and UPPER(m.reverso) like '%".strtoupper($reverso)."%' LIMIT 1";
//        $query=$this->db->query($sql);
//        return $query->row();
//    }        
    

    public function getFormaPagoPorId($formapago)
    {
        $sql="select id from formas_pago as m where UPPER(m.forma_pago) like '".strtoupper($formapago)."' LIMIT 1";
        $query=$this->db->query($sql);
        return $query->row();
    }        

    public function getClientePorId($cliente)
    {
        $cliente=str_replace("S. A.", "", $cliente);
        $cliente=str_replace("S.A.", "", $cliente);        
        $cliente=str_replace("S . A.", "", $cliente);        
        $sql="select id from clientes as m where UPPER(m.razon_social) like '%".strtoupper(trim($cliente))."%' LIMIT 1";
        $query=$this->db->query($sql);
        return $query->row();
    }      
    

    public function getMigracionRegistroPorId($id)
    {
           $query=$this->db
                ->select("*")
                ->from("migracion")
                ->where(array("id"=>$id))
                ->get();
//                echo $this->db->last_query();exit;           
                return $query->row();
    }     
    
   public function getMigracionAll_indexPaginacion()
    {
       

       $id=55546;
//        $sql="SELECT  migracion.ID,migracion.N_COSTO,migracion.TRABAJO,migracion.FECHA,migracion.NOMBRE,migracion.RUT FROM migracion LEFT JOIN cotizaciones ON cotizaciones.id_antiguo=migracion.N_COSTO";
//        $query=$this->db->query($sql);
//        return $query->result();
        
         $query=$this->db
                ->select("*")
                ->from("migracion")
//                ->where(array("N_COSTO"=>$id))     
                ->order_by("n_costo desc,nombre asc")                 
//                ->limit(200)       
                ->get();
//                echo $this->db->last_query();exit;            
                return $query->result();
    }

    public function getFormaPagoPorId2($formapago)
    {
        $sql="select * from formas_pago where id=".$formapago;
        $query=$this->db->query($sql);
        return $query->row();
    }        

    public function getMigracionRegistroPorNcosto($id)
    {
           $query=$this->db
                ->select("*")
                ->from("migracion")
                ->where(array("N_COSTO"=>$id))
                ->get();
//                echo $this->db->last_query();exit;           
                return $query->row();
    } 
    
    public function getMigracionRegistroCotizacion()
    {
        $sql="select max(n_costo) as maximo from migracion";
        $query=$this->db->query($sql);
        return $query->row();
    }     
    
    
    public function getMigracionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("*")
                ->from("migracion")
                ->order_by("n_costo desc")    
                ->limit($porpagina,$pagina)
                ->get();
//                echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("*")
                ->from("migracion")
                ->order_by("n_costo desc")  
                ->count_all_results();
                return $query;
            break;
        }
    }
    
    public function getMigracionSearchPaginacion($pagina,$porpagina,$quehago,$buscar)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("*")
                ->from("migracion")
                ->like('nombre', $buscar, 'both')
                ->or_like('trabajo', $buscar, 'both')
                ->or_like('n_costo', $buscar, 'both')
                ->or_like('rut', $buscar, 'both')                    
                ->order_by("n_costo desc")  
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("*")
                ->from("migracion")
                ->like('nombre', $buscar, 'both')
                ->or_like('trabajo', $buscar, 'both')
                ->or_like('n_costo', $buscar, 'both')
                ->or_like('rut', $buscar, 'both')     
                ->count_all_results();
                return $query;
            break;
        }
    }    

    public function update($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("migracion",$data);
//                echo $this->db->last_query();exit;            
        return true;
    }    
	
   
    
    
}