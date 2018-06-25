<?php
// si ingenieria es ya tiene datos guardados
if(sizeof($ing)>0){
    //Consultamos si tiene molde y que tipo de molde
    if(sizeof($moldes2)>0){
        if($moldes2->id!=11 && $moldes2->id!=12 && $moldes2->id!=13 && $moldes2->id!=14 && $moldes2->id!=15 && $moldes2->id!=1){
            $tamano_cuchillo_1 = $moldes2->cuchillocuchillo;
            $tamano_cuchillo_2 = $moldes2->cuchillocuchillo2;
            $tamano_1 = $moldes2->ancho_bobina;
            $tamano_2 = $moldes2->largo_bobina;
            $ccac_1 = ($tamano_1 - $tamano_cuchillo_1)*10;
            $ccac_2 = ($tamano_2 - $tamano_cuchillo_2)*10;}
        else{
            $tamano_cuchillo_1 = $ing->tamano_cuchillo_1;
            $tamano_cuchillo_2 = $ing->tamano_cuchillo_2;
            $tamano_1 = $ing->tamano_a_imprimir_1;
            $tamano_2 = $ing->tamano_a_imprimir_2;
            $ccac_1 = ($tamano_1 - $tamano_cuchillo_1)*10;
            $ccac_2 = ($tamano_2 - $tamano_cuchillo_2)*10;    
        }
    }else{
        //Si no tiene molde consultamos si tiene trazado
        if(sizeof($trazadosing)>0){
            $tamano_cuchillo_1 = $trazadosing->cuchillocuchillo;
            $tamano_cuchillo_2 = $trazadosing->cuchillocuchillo2;
            $tamano_1 = $trazadosing->ancho_bobina;
            $tamano_2 = $trazadosing->largo_bobina;
            $ccac_1 = ($tamano_1 - $tamano_cuchillo_1)*10;
            $ccac_2 = ($tamano_2 - $tamano_cuchillo_2)*10;
        }else{
            $tamano_cuchillo_1 = $ing->tamano_cuchillo_1;
            $tamano_cuchillo_2 = $ing->tamano_cuchillo_2;
            $tamano_1 = $ing->tamano_a_imprimir_1;
            $tamano_2 = $ing->tamano_a_imprimir_2;
            $ccac_1 = ($tamano_1 - $tamano_cuchillo_1)*10;
            $ccac_2 = ($tamano_2 - $tamano_cuchillo_2)*10;
        }
    }
}else{
    //Consultamos si tiene molde y que tipo de molde
    if(sizeof($moldes2)>0){
        $tamano_cuchillo_1 = $moldes2->cuchillocuchillo;
        $tamano_cuchillo_2 = $moldes2->cuchillocuchillo2;
        $tamano_1 = $moldes2->ancho_bobina;
        $tamano_2 = $moldes2->largo_bobina;
        $ccac_1 = ($tamano_1 - $tamano_cuchillo_1)*10;
        $ccac_2 = ($tamano_2 - $tamano_cuchillo_2)*10;
    }else{
        //Si no tiene molde consultamos si tiene trazado
        if(sizeof($trazadosing)>0){
            $tamano_cuchillo_1 = $trazadosing->cuchillocuchillo;
            $tamano_cuchillo_2 = $trazadosing->cuchillocuchillo2;
            $tamano_1 = $trazadosing->ancho_bobina;
            $tamano_2 = $trazadosing->largo_bobina;
            $ccac_1 = ($tamano_1 - $tamano_cuchillo_1)*10;
            $ccac_2 = ($tamano_2 - $tamano_cuchillo_2)*10;
        }else{
            $tamano_cuchillo_1 = "0";
            $tamano_cuchillo_2 = "0";
            $tamano_1 = "0";
            $tamano_2 = "0";
            $ccac_1 = "0";
            $ccac_2 = "0";   
        }
    }
}
