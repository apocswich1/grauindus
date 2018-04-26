<?php

class clientes_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
   public function getClientesPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("c.id,c.rut,c.razon_social,c.nombre_fantasia,c.id_region,c.id_ciudad,c.id_comuna,c.direccion,c.correo,c.telefono,c.celular,c.id_forma_pago,c.direccion_despacho,c.id_comuna_despacho,c.horario_despacho,c.observaciones,c.fecha_ingreso,c.fecha_ultima_compra,c.id_vendedor,c.estado,c.fast,c.cupo_maximo,c.quien,c.cuando")
                ->from("clientes as c")
                //->join("formas_pago as f","c.id_forma_pago=f.id","inner")
                ->order_by("c.rut","desc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("ci.id")
                ->from("clientes as c")
                //->join("formas_pago as f","c.id_forma_pago=f.id","inner")
                ->count_all_results();
                return $query;
            break;
        }
    }
    /*
    public function getClientesPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("c.id,c.rut,c.razon_social,c.nombre_fantasia,c.id_region,c.id_ciudad,c.id_comuna,c.direccion,c.correo,c.telefono,c.celular,c.id_forma_pago,c.direccion_despacho,c.id_comuna_despacho,c.horario_despacho,c.observaciones,c.fecha_ingreso,c.fecha_ultima_compra,c.id_vendedor,c.estado,c.fast,c.cupo_maximo")
                ->from("clientes as c")
                ->join("region as r","c.id_region=r.id","inner")
                ->join("ciudades as ci","c.id_ciudad=ci.id","inner")
                ->join("comuna as co","c.id_comuna=co.id","inner")
                //->join("formas_pago as f","c.id_forma_pago=f.id","inner")
                ->order_by("c.id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("ci.id")
                ->from("clientes as c")
                ->join("region as r","c.id_region=r.id","inner")
                ->join("ciudades as ci","c.id_ciudad=ci.id","inner")
                ->join("comuna as co","c.id_comuna=co.id","inner")
                //->join("formas_pago as f","c.id_forma_pago=f.id","inner")
                ->count_all_results();
                return $query;
            break;
        }
    }
    */
     public function getClientesPaginacionPorEstado($pagina,$porpagina,$quehago,$estado)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("c.id,c.rut,c.razon_social,c.nombre_fantasia,c.id_region,c.id_ciudad,c.id_comuna,c.direccion,c.correo,c.telefono,c.celular,c.id_forma_pago,c.direccion_despacho,c.id_comuna_despacho,c.horario_despacho,c.observaciones,c.fecha_ingreso,c.fecha_ultima_compra,c.estado,c.fast,c.id_vendedor,c.cupo_maximo")
                ->from("clientes as c")
                ->join("region as r","c.id_region=r.id","inner")
                ->join("ciudades as ci","c.id_ciudad=ci.id","inner")
                ->join("comuna as co","c.id_comuna=co.id","inner")
                //->join("formas_pago as f","c.id_forma_pago=f.id","inner")
                ->where(array("c.estado"=>$estado))
                ->order_by("c.id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("c.id")
                ->from("clientes as c")
                ->join("region as r","c.id_region=r.id","inner")
                ->join("ciudades as ci","c.id_ciudad=ci.id","inner")
                ->join("comuna as co","c.id_comuna=co.id","inner")
                //->join("formas_pago as f","c.id_forma_pago=f.id","inner")
                ->where(array("c.estado"=>$estado))
                ->count_all_results();
                return $query;
            break;
        }
    }

     public function getClientesPaginacionPorSearchSinRegion($pagina,$porpagina,$quehago,$valor)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("c.id,c.rut,c.razon_social,c.nombre_fantasia,c.id_region,c.id_ciudad,c.id_comuna,c.direccion,c.correo,c.telefono,c.celular,c.id_forma_pago,c.direccion_despacho,c.id_comuna_despacho,c.horario_despacho,c.observaciones,c.fecha_ingreso,c.fecha_ultima_compra,c.estado,c.fast,c.id_vendedor,c.cupo_maximo")
                ->from("clientes as c")
                ->like('c.rut', $valor, 'both')
                ->or_like('c.razon_social', $valor, 'both')
                ->or_like('c.nombre_fantasia', $valor, 'both')
                ->order_by("c.id","desc")
                ->limit($porpagina,$pagina)
                ->get();
//                echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("ci.id")
                ->from("clientes as c")
                ->like('c.rut', $valor, 'both')
                ->or_like('c.razon_social', $valor, 'both')
                ->or_like('c.nombre_fantasia', $valor, 'both')
                ->count_all_results();
                return $query;
            break;
        }
    }

    
    
     public function getClientesPaginacionPorSearch($pagina,$porpagina,$quehago,$valor)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("c.id,c.rut,c.razon_social,c.nombre_fantasia,c.id_region,c.id_ciudad,c.id_comuna,c.direccion,c.correo,c.telefono,c.celular,c.id_forma_pago,c.direccion_despacho,c.id_comuna_despacho,c.horario_despacho,c.observaciones,c.fecha_ingreso,c.fecha_ultima_compra,c.estado,c.fast,c.id_vendedor,c.cupo_maximo")
                ->from("clientes as c")
                ->join("region as r","c.id_region=r.id","inner")
                ->join("ciudades as ci","c.id_ciudad=ci.id","inner")
                ->join("comuna as co","c.id_comuna=co.id","inner")
                //->join("formas_pago as f","c.id_forma_pago=f.id","inner")
                ->like('c.rut', $valor, 'both')
                ->or_like('c.razon_social', $valor, 'both')
                ->or_like('c.nombre_fantasia', $valor, 'both')
                ->order_by("c.id","desc")
                ->limit($porpagina,$pagina)
                ->get();
//                echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("ci.id")
                ->from("clientes as c")
                ->join("region as r","c.id_region=r.id","inner")
                ->join("ciudades as ci","c.id_ciudad=ci.id","inner")
                ->join("comuna as co","c.id_comuna=co.id","inner")
                //->join("formas_pago as f","c.id_forma_pago=f.id","inner")
                ->like('c.rut', $valor, 'both')
                ->or_like('c.razon_social', $valor, 'both')
                ->or_like('c.nombre_fantasia', $valor, 'both')
                ->count_all_results();
                return $query;
            break;
        }
    }
    public function getClientePorId($id)
    {
         $query=$this->db              
		->select(" cid.nombre AS ciudad_despacho,rd.region AS region_despacho,cod.nombre AS comuna_despacho,c.id,c.rut,c.razon_social,u.nombre as nombre_vendedor,c.nombre_fantasia,c.id_region,c.id_ciudad,c.id_comuna,c.direccion,c.correo,c.telefono,c.celular,c.id_forma_pago,c.direccion_despacho,c.id_comuna_despacho,c.horario_despacho,c.observaciones,c.fecha_ingreso,c.fecha_ultima_compra,c.id_vendedor,c.estado,id_region_despacho,id_ciudad_despacho,id_comuna_despacho,r.region,ci.nombre as ciudad,co.nombre as comuna,c.fast,c.contacto,c.id_vendedor,c.cupo_maximo,c.deuda_total,c.deuda_vigente")
                ->from("clientes as c")
                ->join("region as r","c.id_region=r.id","left")
                ->join("region as rd","c.id_region_despacho=rd.id","left")
                ->join("ciudades as ci","c.id_ciudad=ci.id","left")
                ->join("ciudades as cid","c.id_ciudad_despacho=cid.id","left")
                ->join("comuna as co","c.id_comuna=co.id","left")
                ->join("comuna as cod","c.id_comuna_despacho=cod.id","left")
                ->join("formas_pago as f","c.id_forma_pago=f.id","left")
              //  ->join("formas_pago as f","c.id_forma_pago=f.id","left")
                ->join("usuarios as u","c.id_vendedor=u.id","left")
                ->where(array("c.id"=>$id))
                ->get();
              //  echo $this->db->last_query()."<br />";    
                return $query->row();
    }
	public function getClientePorIdSinJoin($id)
    {
         $query=$this->db
		->select("id,rut,razon_social,nombre_fantasia,id_region,id_ciudad,id_comuna,direccion,correo,telefono,celular,id_forma_pago,direccion_despacho,id_region_despacho,id_ciudad_despacho,id_comuna_despacho,horario_despacho,observaciones,fecha_ingreso,fecha_ultima_compra,id_vendedor,deuda_vigente,deuda_total,estado,monto_inventario,fast,contacto,cupo_maximo,bloqueado")
                ->from("clientes")
                ->where(array("id"=>$id))
                ->get();
                //echo $this->db->last_query();exit;    
                return $query->row();
    }
	    public function getClientePorId2($id)
    {
         $query=$this->db
		->select("c.id,c.rut,c.razon_social,c.nombre_fantasia,c.id_region,c.id_ciudad,c.id_comuna,c.direccion,c.correo,c.telefono,c.celular,c.id_forma_pago,c.direccion_despacho")
                ->from("clientes as c")
                ->where(array("c.id"=>$id))
                ->get();
                //echo $this->db->last_query();exit;    
                return $query->row();
    }
    
	    public function getClientePorRutMigracion($rut)
    {
         $query=$this->db
		->select("c.id,c.rut,c.razon_social,c.nombre_fantasia,c.id_region,c.id_ciudad,c.id_comuna,c.direccion,c.correo,c.telefono,c.celular,c.id_forma_pago,c.direccion_despacho")
                ->from("clientes as c")
//                ->like('c.rut', $valor, 'both')                 
                ->where(array("c.rut"=>$rut))
                ->get();
//                echo $this->db->last_query();    
                return $query->row();
    }    
	
	
	  public function getClientePorId3($id)
    {
         $query=$this->db
               
				->select("c.id,c.rut,c.razon_social,c.nombre_fantasia,c.id_region,c.id_ciudad,c.id_comuna,c.direccion,c.correo,c.telefono,c.celular,c.id_forma_pago,c.direccion_despacho,c.id_comuna_despacho,c.horario_despacho,c.observaciones,c.fecha_ingreso,c.fecha_ultima_compra,c.id_vendedor,c.estado,id_region_despacho,id_ciudad_despacho,id_comuna_despacho,r.region,ci.nombre as ciudad,co.nombre as comuna,f.forma_pago as pago")
                ->from("clientes as c")
                ->join("region as r","c.id_region=r.id","inner")
                ->join("ciudades as ci","c.id_ciudad=ci.id","inner")
                ->join("comuna as co","c.id_comuna=co.id","inner")
                ->join("formas_pago as f","c.id_forma_pago=f.id","inner")
                ->where(array("c.id"=>$id))
                ->get();
                //echo $this->db->last_query();exit;    
                return $query->row();
    }
	
    public function getClientesNormal()
    {
         $query=$this->db
                ->select("c.id,c.rut,c.razon_social,c.nombre_fantasia,c.id_region,c.id_ciudad,c.id_comuna,c.direccion,c.correo,c.telefono,c.celular,c.id_forma_pago,c.direccion_despacho,c.id_comuna_despacho,c.horario_despacho,c.observaciones,c.fecha_ingreso,c.fecha_ultima_compra,c.id_vendedor,c.estado,id_region_despacho,id_ciudad_despacho,id_comuna_despacho")
                ->from("clientes as c")
                //->where(array("c.estado"=>'0'))
                ->join("region as r","c.id_region=r.id","left")
                ->join("ciudades as ci","c.id_ciudad=ci.id","left")
                ->join("comuna as co","c.id_comuna=co.id","left")

                ///->join("formas_pago as f","c.id_forma_pago=f.id","inner")
                ->get();
                //echo $query;$this->db->last_query();
                return $query->result();
    }
    public function getClientesNormalsinfiltro()
    {
         $query=$this->db
                ->select("c.id,c.rut,c.razon_social,c.nombre_fantasia,c.id_region,c.id_ciudad,c.id_comuna,c.direccion,c.correo,c.telefono,c.celular,c.id_forma_pago,c.direccion_despacho,c.id_comuna_despacho,c.horario_despacho,c.observaciones,c.fecha_ingreso,c.fecha_ultima_compra,c.id_vendedor,c.estado")
                ->from("clientes as c")
                ->get();
                echo $query;$this->db->last_query();
                return $query->result();
    }
    /*
     public function getClientesNormal()
    {
         $query=$this->db
                ->select("c.id,c.rut,c.razon_social,c.nombre_fantasia,c.id_region,c.id_ciudad,c.id_comuna,c.direccion,c.correo,c.telefono,c.celular,c.id_forma_pago,c.direccion_despacho,c.id_comuna_despacho,c.horario_despacho,c.observaciones,c.fecha_ingreso,c.fecha_ultima_compra,c.id_vendedor,c.estado,id_region_despacho,id_ciudad_despacho,id_comuna_despacho")
                ->from("clientes as c")
                ->join("region as r","c.id_region=r.id","inner")
                ->join("ciudades as ci","c.id_ciudad=ci.id","inner")
                ->join("comuna as co","c.id_comuna=co.id","inner")

                ///->join("formas_pago as f","c.id_forma_pago=f.id","inner")
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
    }
    */
	
     public function getClientesNormalFast()
    {
         $query=$this->db
                ->select("c.id,c.rut,c.razon_social,c.nombre_fantasia,c.id_region,c.id_ciudad,c.id_comuna,c.direccion,c.correo,c.telefono,c.celular,c.id_forma_pago,c.direccion_despacho,c.id_comuna_despacho,c.horario_despacho,c.observaciones,c.fecha_ingreso,c.fecha_ultima_compra,c.id_vendedor,c.estado,id_region_despacho,id_ciudad_despacho,id_comuna_despacho,c.cupo_maximo")
                ->from("clientes as c")
                ->join("region as r","c.id_region=r.id","inner")
                ->join("ciudades as ci","c.id_ciudad=ci.id","inner")
                ->join("comuna as co","c.id_comuna=co.id","inner")
                ->join("formas_pago as f","c.id_forma_pago=f.id","inner")
                ->where(array("c.fast"=>"1"))
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
    }
    
	public function getClientesAll()
    {
         $query=$this->db
                ->select("id,rut,razon_social,nombre_fantasia")
                ->from("clientes")
                ->get();
                //echo $this->db->last_query();exit;
                return $query;
    }
	
     public function insertar($data=array())
    {
		//var_dump($data);
         $this->db->insert("clientes",$data);
        return true;
        
    }
    public function update($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("clientes",$data);
        return true;
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('clientes');
        return true;
    }
     /**
     * #######################################################
     * CONTACTOS CLIENTES
     * */
     public function geContactosClientePorId($id)
    {
        $query=$this->db
        ->select("id,id_cliente,nombre,telefono,correo,funcion")
        ->from("clientes_contacto")
        ->where(array("id_cliente"=>$id))
        ->get();
        //echo $this->db->last_query();exit;
        return $query->result(); 
    }
     public function geContactosClientePorIdUltimo($id)
    {
        $query=$this->db
        ->select("id,id_cliente,nombre,telefono,correo,funcion")
        ->from("clientes_contacto")
        ->where(array("id_cliente"=>$id))
        ->order_by("id","desc")
        ->limit(1)
        ->get();
        //echo $this->db->last_query();exit;
        return $query->row(); 
    }
    public function geContactosPorId($id)
    {
        $query=$this->db
        ->select("id,id_cliente,nombre,telefono,correo,funcion")
        ->from("clientes_contacto")
        ->where(array("id"=>$id))
        ->get();
        //echo $this->db->last_query();exit;
        return $query->row(); 
    }
     public function insertarContacto($data=array())
    {
         $this->db->insert("clientes_contacto",$data);
        return true;
        
    }
     public function updateContacto($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("clientes_contacto",$data);
        return true;
    }
    public function deleteContacto($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('clientes_contacto');
        return true;
    }
    /**
     * #######################################################
     * FORMAS DE PAGO
     * */
       public function getFormasPago()
    {
        $query=$this->db
        ->select("id,forma_pago,dias")
        ->from("formas_pago")
        //->order_by("forma_pago","asc")
        ->order_by("dias","asc")
        ->get();
        //echo $this->db->last_query();exit;
        return $query->result(); 
    }
     public function getFormasPagoPorId($id)
    {
        $query=$this->db
        ->select("id,forma_pago,dias")
        ->from("formas_pago")
        ->where(array("id"=>$id))
        ->get();
      //  echo $this->db->last_query();exit;
        return $query->row(); 
    }
	  public function getFormasPagoPorId2($id)
    {
        $query=$this->db
        ->select("id,forma_pago,dias")
        ->from("formas_pago")
        ->where(array("id"=>$id))
        ->get();
      //  echo $this->db->last_query();exit;
        return $query->result(); 
    }
    public function getFormasPagoPorNombre($id)
    {
        $query=$this->db
        ->select("id,forma_pago,dias")
        ->from("formas_pago")
        ->where(array("forma_pago"=>$id))
        ->get();
        //echo $this->db->last_query();exit;
        return $query->row(); 
    }
     public function insertarFormaDePago($data=array())
    {
         $this->db->insert("formas_pago",$data);
        return true;
        
    }
    public function updateFormaDePago($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("formas_pago",$data);
        return true;
    }
    public function deleteFormaDePago($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('formas_pago');
        return true;
    }
    
	
	  public function getClientesNormalTodo()
    {
         $query=$this->db
                ->select("c.id,c.rut,c.razon_social,c.nombre_fantasia,c.id_region,c.id_ciudad,id_comuna,c.estado")
                ->from("clientes as c")
                ->get();               
                return $query->result();
    }
	
	
	 public function getClientePorIdBasico($id)
    {
         $query=$this->db              
		->select("c.id,c.rut,c.razon_social,c.nombre_fantasia,id_vendedor,c.id_forma_pago")
                ->from("clientes as c")
                ->where(array("c.id"=>$id))
                ->get();  
                return $query->row();
    }
	
	  public function getClientePorIdParaDespacho($id)
    {
         $query=$this->db
               
				->select("c.id,c.rut,c.razon_social,c.nombre_fantasia,c.id_region,c.id_ciudad,c.id_comuna,c.direccion,c.correo,c.telefono,c.celular,c.id_forma_pago,c.direccion_despacho,c.id_comuna_despacho,c.horario_despacho,c.observaciones,c.fecha_ingreso,c.fecha_ultima_compra,c.id_vendedor,c.estado,id_region_despacho,id_ciudad_despacho,id_comuna_despacho,r.region,ci.nombre as ciudad,co.nombre as comuna,f.forma_pago as pago,ven.nombre as venom,c.contacto")
                ->from("clientes as c")
                ->join("region as r","c.id_region=r.id","inner")
                ->join("ciudades as ci","c.id_ciudad=ci.id","inner")
                ->join("comuna as co","c.id_comuna=co.id","inner")
                ->join("formas_pago as f","c.id_forma_pago=f.id","inner")
                ->join("vendedores as ven","ven.id=c.id_vendedor","inner")
                ->where(array("c.id"=>$id))
                ->get();
                //echo $this->db->last_query();exit;    
                return $query->row();
    }
    
     public function getValidarRut($rut)
    {
        $query=$this->db
        ->select("*")
        ->from("clientes")
        ->where(array("rut"=>$rut))
        ->get();
//               echo $this->db->last_query();exit;    
        
        return $query->row(); 
    }    
    
     public function getBuscarFormaPagoCliente($id)
    {
        $query=$this->db
        ->select("id_forma_pago")
        ->from("clientes")
        ->where(array("id"=>$id))
        ->get();
        return $query->row(); 
    }     
    
     public function getBuscarBuscarVendedorCliente($id)
    {
        $query=$this->db
        ->select("id_vendedor")
        ->from("clientes")
        ->where(array("id"=>$id))
        ->get();
        return $query->row(); 
    }     
    
    
    public function getIdCodigoFormaPagoTexto($texto)
    {
        $sql = "select id from formas_pago where forma_pago like '%".$texto."%'";
        $query=$this->db->query($sql);
        return $query->row(); 
    }
    
     public function getBuscarRutRepetidoCliente($rut)
    {
        $query=$this->db
        ->select("numero")
        ->from("rut_repetidos")
        ->where(array("rut"=>$rut))
        ->get();
        return $query->row()->numero; 
    }         
        
	
}