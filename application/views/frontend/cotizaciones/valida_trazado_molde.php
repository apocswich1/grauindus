 <?php 
    $molde=$this->moldes_model->getMoldesPorId($datos->numero_molde);
    $trazados=$this->trazados_model->getTrazadosPorId($datos->trazado);
    
    
    if(sizeof($ing)>0){
        if($datos->existe_trazado=="SI" && $ing->estan_los_moldes=="NO"){
            if($trazados->archivo==""){
            $trazadoarchivo = 'Debe ingresar trazado de ingenieria en el trazado';
            $bloquear="disabled='disabled' onclick='alert($trazadoarchivo);'";
        }else{
            $trazadoarchivo = 'Puede continuar cotizando con este trazado';
            $bloquear="";
        }
        }else if($datos->existe_trazado=="SI" && $ing->estan_los_moldes=="SI"){
            if($trazados->archivo=="" && $molde->archivo==""){
            $trazadoarchivo = 'Debe ingresar trazado de ingenieria para molde o trazado';
            $bloquear="disabled='disabled' onclick='alert($trazadoarchivo);'";
        }else{
            $trazadoarchivo = 'Puede continuar cotizando con este molde';
            $bloquear="";
        } 
        }else if($datos->existe_trazado=="" && $ing->estan_los_moldes=="SI"){
            if($molde->archivo==""){
            $trazadoarchivo = 'Debe ingresar trazado de ingenieria para molde';
            $bloquear="disabled='disabled' onclick='alert($trazadoarchivo);'";
        }else{
            $trazadoarchivo = 'Puede continuar cotizando con este molde';
            $bloquear="";
        } 
        }else if($datos->existe_trazado=="" && $ing->estan_los_moldes=="NO"){
            if($trazados->archivo==""){
            $trazadoarchivo = 'Debe ingresar trazado de ingenieria para cotizar con un trazado';
            $bloquear="disabled='disabled' onclick='alert($trazadoarchivo);'";
        }else{
            $trazadoarchivo = 'Puede continuar cotizando con este trazado';
            $bloquear="";
        } 
        }else if($datos->existe_trazado=="NO" && $ing->estan_los_moldes=="NO"){
            if($trazados->archivo==""){
            $trazadoarchivo = 'Debe ingresar trazado de ingenieria para cotizar con un trazado';
            $bloquear="disabled='disabled' onclick='alert($trazadoarchivo);'";
        }else{
            $trazadoarchivo = 'Puede continuar cotizando con este trazado';
            $bloquear="";
        } 
        }
    }else{
        if($datos->existe_trazado=="SI" && $datos->estan_los_moldes=="NO"){
            if($trazados->archivo==""){
            $trazadoarchivo = 'Debe ingresar trazado de ingenieria en el trazado';
            $bloquear="disabled='disabled' onclick='alert($trazadoarchivo);'";
        }else{
            $trazadoarchivo = 'Puede continuar cotizando con este trazado';
            $bloquear="";
        }
        }else if($datos->existe_trazado=="SI" && $datos->estan_los_moldes=="SI"){
            if($trazados->archivo=="" && $datos->archivo==""){
            $trazadoarchivo = 'Debe ingresar trazado de ingenieria para molde o trazado';
            $bloquear="disabled='disabled' onclick='alert($trazadoarchivo);'";
        }else{
            $trazadoarchivo = 'Puede continuar cotizando con este molde';
            $bloquear="";
        } 
        }else if($datos->existe_trazado=="" && $datos->estan_los_moldes=="SI"){
            if($molde->archivo==""){
            $trazadoarchivo = 'Debe ingresar trazado de ingenieria para molde';
            $bloquear="disabled='disabled'";
        }else{
            $trazadoarchivo = 'Puede continuar cotizando con este molde';
            $bloquear="";
        } 
        }else if($datos->existe_trazado=="" && $datos->estan_los_moldes=="NO"){
            if($trazados->archivo==""){
            $trazadoarchivo = 'Debe ingresar trazado de ingenieria para cotizar con un trazado';
            $bloquear="disabled='disabled'";
        }else{
            $trazadoarchivo = 'Puede continuar cotizando con este trazado';
            $bloquear="";
        } 
        }else if($datos->existe_trazado=="NO" && $datos->estan_los_moldes=="NO"){
            if($trazados->archivo==""){
            $trazadoarchivo = 'Debe ingresar trazado de ingenieria para cotizar con un trazado';
            $bloquear="disabled='disabled'";
        }else{
            $trazadoarchivo = 'Puede continuar cotizando con este trazado';
            $bloquear="";
        } 
        }
    }
    ?>