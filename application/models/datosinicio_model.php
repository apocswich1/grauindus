<?php

class datosinicio_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();  
             
	}
  

    public function getCotizacionesEnRevision()
    {   $this->load->database();
     $sql = "SELECT      * FROM     (SELECT          c.id, cl.razon_social, e.nombre, ultimoEstado.fecha     FROM         clientes cl, estado e, cotizaciones c, (SELECT          ec.fecha, ec.cotizaciones_id, ec.id_estado     FROM         estado_cotizacion ec, (SELECT          ec.cotizaciones_id, MAX(ec.id) AS max     FROM         estado_cotizacion ec     GROUP BY ec.cotizaciones_id) AS maximos     WHERE         maximos.max = ec.id) AS ultimoEstado     WHERE         ultimoEstado.cotizaciones_id = c.id             AND c.id_cliente = cl.id             AND ultimoEstado.id_estado = e.id_estado             AND e.codigoEstado <> 'APR_PR'     ORDER BY ultimoEstado.fecha DESC) AS enRevision LIMIT 0 , 10";
//$sql = "select * from usuarios";
//                $query = $this->db->query("select * from
//                                        (select 
//                                        c.id,
//                                        cl.razon_social,
//                                        e.nombre,
//                                        ultimoEstado.fecha
//                                        from
//                                        clientes cl,
//                                        estado e,
//                                        cotizaciones c,
//                                        (select ec.fecha,ec.cotizaciones_id,ec.id_estado from estado_cotizacion ec,
//                                        (select 
//                                        ec.cotizaciones_id,
//                                        max(ec.id) as max
//                                        from 
//                                        estado_cotizacion ec
//                                        group by
//                                        ec.cotizaciones_id) as maximos
//                                        where
//                                        maximos.max = ec.id) as ultimoEstado
//                                        where
//                                        ultimoEstado.cotizaciones_id = c.id and
//                                        c.id_cliente = cl.id and
//                                        ultimoEstado.id_estado = e.id_estado
//                                        and e.codigoEstado <> 'APR_PR'
//                                        order by ultimoEstado.fecha desc) as enRevision limit 0,10");
 $query = $this->db->query($sql);
 

//$con->close();


                return $query;
        
    }

    public function getCotizacionesAprobadas()
    {
          $query = $this->db->query("select * from
                                        (select 
                                        c.id,
                                        cl.razon_social,
                                        e.nombre,
                                        e.id_estado,
                                        ultimoEstado.fecha
                                        from
                                        clientes cl,
                                        estado e,
                                        cotizaciones c,
                                        (select ec.fecha,ec.cotizaciones_id,ec.id_estado from estado_cotizacion ec,
                                        (select 
                                        ec.cotizaciones_id,
                                        max(ec.id) as max
                                        from 
                                        estado_cotizacion ec
                                        group by
                                        ec.cotizaciones_id) as maximos
                                        where
                                        maximos.max = ec.id) as ultimoEstado
                                        where
                                        ultimoEstado.cotizaciones_id = c.id and
                                        c.id_cliente = cl.id and
                                        ultimoEstado.id_estado = e.id_estado
                                        and   e.codigoEstado = 'APR_PR'
                                        order by ultimoEstado.fecha desc) as enRevision where id_estado=9 limit 0,10");
    
                return $query;
    }
    

	
	        public function getTodasCotizaciones()
    {
          $query = $this->db->query("select * from
									(select 
									c.id,
									cl.razon_social,
									e.nombre as estado,
									ultimoEstado.fecha
									from
									clientes cl,
									estado e,
									cotizaciones c,
									(select ec.fecha,ec.cotizaciones_id,ec.id_estado from estado_cotizacion ec,
									(select 
									ec.cotizaciones_id,
									max(ec.id) as max
									from 
									estado_cotizacion ec
									group by
									ec.cotizaciones_id) as maximos
									where
									maximos.max = ec.id) as ultimoEstado
									where
									ultimoEstado.cotizaciones_id = c.id and
									c.id_cliente = cl.id and
									ultimoEstado.id_estado = e.id_estado
																		   
									order by ultimoEstado.fecha desc) as enRevision  limit 0,10");
    
                return $query;
    }
	
	/*
		        public function getTodasCotizaciones()
    {
          $query = $this->db->query("select 
                                    c.id,
                                    c.fecha,
                                    cl.razon_social
									c.estado
                                     from
                                    cotizaciones c,
                                    clientes cl where
                                    c.id_cliente = cl.id
                                    order by c.fecha desc limit 0,10");
    
                return $query;
    }
    */
     public function insertar($data=array())
    {
       //  array $datos = ("nombre_procesp"->$data['proceso']);
 
     //  $this->db->query("insert into procesosespeciales(nombre_procesp) values($data)");
         $this->db->insert("acabados",$data);
        return true;
        
    }
    
    public function update($data=array(),$id)
    {
         $this->db->where('id_acabado', $id);
         $this->db->update("acabados",$data);
        return true;
    }
    
    public function delete($id)
    {
        $this->db->where('id_acabado', $id);
        $this->db->delete('acabados');
        return true;
    }
   
}