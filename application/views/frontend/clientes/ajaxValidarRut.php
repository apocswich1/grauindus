
    <?php 
        $datos=$this->clientes_model->getValidarRut($this->input->post("valor1",true));
//        print_r($datos);
        if(sizeof($datos)>0) { echo "holaa";?>
            <script type="text/javascript">
                document.getElementById("rut").value = "";
                alert("RUT ya Existe");
            </script>
    <?php   }  ?>


