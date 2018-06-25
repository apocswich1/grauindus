<?php

class Trazados_model extends CI_Model{

function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
        
    public function getTrazadosAll(){
        
        $query=$this->db
                ->select("*")
                ->from("trazados")
                ->order_by("id","desc")
                ->get();
                return $query->result();
        
    }    
    
    
    /* Jaime suarez */
    
    
    public function getTrazadosAll_indexPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("id, nombre, nombrecliente, tamano_caja,unidades_productos_completos,piezas_totales, cuchillocuchillo, cuchillocuchillo2, ancho_bobina, largo_bobina, fecha, numero, archivo, estado, nombrecliente2, tipo")
                ->from("trazados")
                ->order_by("id","desc")
                ->limit($porpagina,$pagina)
                ->get();
         //       echo $this->db->last_query();exit;    
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("id")
                ->from("trazados")
                ->count_all_results();
         //       echo $this->db->last_query();exit;    
                return $query;
            break;
        }
    }
    
    public function getTrazadosAll_indexPaginacion_Seachr($pagina,$porpagina,$quehago,$buscar)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("id, nombre, nombrecliente, tamano_caja,unidades_productos_completos,piezas_totales, cuchillocuchillo, cuchillocuchillo2, ancho_bobina, largo_bobina, fecha, numero, archivo, estado, nombrecliente2, tipo")
                ->from("trazados")
                ->like('tipo', $buscar, 'both')                                        
                ->order_by("id","desc")
                ->limit($porpagina,$pagina)
                ->get();
//		echo $this->db->last_query();exit;                
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("id")
                ->from("trazados")
                ->like('tipo', $buscar, 'both')                    
                ->count_all_results();
                return $query;
            break;
        }
    }    
    
    
    public function getComprobarMolde($id){
        
        
        $sql= "SELECT c.razon_social as nombre FROM 
            `trazados` m INNER JOIN clientes c 
            ON m.nombrecliente = c.id WHERE m.id = $id";   
       // echo $sql;
    	$return=$this->db->query($sql);
    	return $return->result();        
    }       
    
    public function getTrazadosAll_index(){
        
        
        $sql= "select a.id, a.nombre, a.nombrecliente, a.tamano_caja, a.cuchillocuchillo, a.cuchillocuchillo2, a.ancho_bobina, a.largo_bobina, a.fecha, a.numero, a.archivo, a.estado, a.nombrecliente2, a.tipo, ";
        $sql.= " (SELECT razon_social FROM clientes WHERE id= a.nombrecliente) AS razon_social ";
        $sql.= "FROM trazados as a order by id desc ";   
        //echo $sql;
    	$return=$this->db->query($sql);
    	return $return->result();        
    }       
        
        
    /* fin jaime suarez*/
    
     public function getTrazadosPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("*")
                ->from("trazados")
                ->order_by("id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("id,nombre,nombrecliente,tamano_caja,cuchillocuchillo,ancho_bobina,largo_bobina,fecha")
                ->from("trazados")
                ->count_all_results();
                return $query;
            break;
        }
    }
    public function getTrazadosSearchPaginacion($pagina,$porpagina,$quehago,$buscar)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("m.id,m.nombre,m.nombrecliente,m.tamano_caja,m.unidades_productos_completos,m.piezas_totales,m.cuchillocuchillo,m.ancho_bobina,m.largo_bobina,m.fecha,numero,m.archivo,m.estado,m.nombrecliente2,m.tipo")
                ->from("trazados m")
                ->join("clientes c","c.id = m.nombrecliente","left")
                ->like('m.nombre', $buscar, 'both')
                ->or_like('m.numero', $buscar, 'both')
                ->or_like('c.razon_social', $buscar, 'both')
                ->order_by("id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                //		echo $this->db->last_query();exit;                
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("id,nombre,nombrecliente,tamano_caja,cuchillocuchillo,ancho_bobina,largo_bobina,fecha")
                ->from("trazados")
                ->like('nombre', $buscar, 'both')
                ->or_like('numero', $buscar, 'both')
                ->count_all_results();
                return $query;
            break;
        }
    }
	
    public function getTrazados()
    {
        $query=$this->db
                ->select("*")
                ->from("trazados")
                ->where(array("estado"=>"0"))
                ->order_by("id","desc")
                ->get();
//		echo $this->db->last_query();exit;                
        
                return $query->result();
    }
    
    public function getNumeroTrazados($numeromolde)
    {
        $query=$this->db
                ->select("id")
                ->from("trazados")
                ->where(array("numero"=>$numeromolde))
                ->get();
//		echo $this->db->last_query();exit;                
                return $query->result();
    }    
    
  public function getTrazados2()
    {
        $query=$this->db
                ->select("*")
                ->from("trazados")
                ->where(array("estado"=>"0","tipo"=>"Genérico"))
                ->order_by("id","desc")
                ->get();
				//echo $query->result();
                return $query->result();
    }
		
    public function getTrazadosPorId($id)
    {
		//,nombrecliente,tamano_caja,cuchillocuchillo,abobina,lbobina,fecha
         $query=$this->db
                ->select("m.*")
                ->from("trazados m")
                ->join("clientes c","m.nombrecliente=c.id","inner")
                ->where(array("m.id"=>$id))
                ->order_by("m.id","desc")
                ->get();
              //  echo $this->db->last_query();exit();
                return $query->row();		
    }
    
    public function getTrazadosDetallePorId($id)
    {
		//,nombrecliente,tamano_caja,cuchillocuchillo,abobina,lbobina,fecha
         $query=$this->db
                ->select("m.*,ma.`nombre` AS mat1,ma.gramaje as gramaje1,mo.gramaje as gramaje2,ml.gramaje as gramaje3,mt.materiales_tipo AS matt1,mo.`nombre` AS mat2,mto.materiales_tipo AS matt2,ml.nombre AS mat3,mtl.materiales_tipo AS matt3,ma.precio as precio1,mo.precio as precio2,ml.precio as precio3,ma.reverso as reverso1,mo.reverso as reverso2,ml.reverso as reverso3,")
                ->from("trazados m")
                ->join("clientes c","m.nombrecliente=c.id","inner")
                ->join("materiales ma","ma.id=m.placa1","left")
                ->join("materiales_tipo mt","mt.id=ma.tipo","left")
                ->join("materiales mo","mo.id=m.onda1","left")
                ->join("materiales_tipo mto","mto.id=mo.tipo","left")
                ->join("materiales ml","ml.id=m.liner1","left")
                ->join("materiales_tipo mtl","mtl.id=ml.tipo","left")
                ->where(array("m.id"=>$id))
                ->order_by("m.id","desc")
                ->get();
              //  echo $this->db->last_query();exit();
                return $query->row();		
    }
    
    public function getTrazadosConClientePorId($id)
    {
		//,nombrecliente,tamano_caja,cuchillocuchillo,abobina,lbobina,fecha
         $query=$this->db
                ->select("m.cuchillocuchillo as cuchillocuchillo,m.cuchillocuchillo2 as cuchillocuchillo2,m.archivo as archivo,m.numero as numero,m.nombre as nombre,c.razon_social as razon_social,m.tamano_caja as tamano_caja,m.unidades_productos_completos as unidades_productos_completos,m.piezas_totales as piezas_totales,m.tipo as tipo,m.ancho_bobina as ancho_bobina,m.largo_bobina as largo_bobina")
                ->from("trazados m")
                ->join("clientes c","m.nombrecliente=c.id","inner")
                ->where(array("m.id"=>$id))
                ->get();
               // echo $this->db->last_query();exit();
                return $query->row();		
    }
   public function insertar($data=array())
    {
         $this->db->insert("trazados",$data);
        return $this->db->insert_id();
        
    }
    
    public function update($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("trazados",$data);
        return true;
    }
    
    public function delete($id)
    {
	   try{
                $this->db->where('id_acabado', $id);
                $this->db->delete('trazados');
		}
		catch(Exception $e)
		{
			return false;
		}
        return true;
    }
    
    public function delete_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('trazados');
        return true;
    }    
    
     public function getHistorialArchivosTrazados($id)
    {
        $sql = "select archivo,DATE_FORMAT(`fecha`,'%d/%m/%Y') as fecha  from trazados_archivos where id_trazados =".$id." order by id desc limit 1";
        $query=$this->db->query($sql);
        return $query->result();
    }    
    
    public function insertar_historial($data=array())
    {
        $this->db->insert("trazados_archivos",$data);
        return true;
        
    }    

        public function getTrazadosClientes($id_cliente){
        
        $query=$this->db
                ->select("*")
                ->from("trazados")
                ->where(array("nombrecliente"=>$id_cliente))                
                ->order_by("id","desc")
                ->get();
//                echo $this->db->last_query();exit;
//        exit();
                return $query->result();;
        
    } 
    public function getTrazadosPorMolde($id){
        
        $query=$this->db
                ->select("*")
                ->from("trazados")
                ->where(array("nombrecliente"=>$id_cliente))                
                ->order_by("id","desc")
                ->get();
//                echo $this->db->last_query();exit;
//        exit();
                return $query->result();;
        
    } 
     public function getUltimoMoldeGuardado()
    {
        $sql = "SELECT (id+1) as max FROM trazados order by id desc limit 1";
        $query=$this->db->query($sql);
        return $query->result();
    }       

     public function getUltimoMoldeGuardado2()
    {
        $sql = "SELECT (id+1) as maximo FROM trazados order by id desc limit 1";
        $query=$this->db->query($sql);
        return $query->result();
    }       
	
    public function getNumeroTrazadosTodos($numeromolde)
    {
        $query=$this->db
                ->select("*")
                ->from("trazados")
                ->where(array("numero"=>$numeromolde))
                ->get();
//		echo $this->db->last_query();exit;                
                return $query->row();
    }        
	
	
}