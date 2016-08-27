<?php

require_once 'conexion.php';

class Camas {

    private $objPdo;

    public function __construct() {

        $this->objPdo = new Conexion();
    }

    public function estadoscamas($estadounitario, $estadosec, $estadoter){
    $stmt=$this->objPdo->prepare('SELECT * FROM sishosp.estado_cama where idestado_cama not in (SELECT idestado_cama FROM sishosp.estado_cama where idestado_cama= :estadounitario or idestado_cama= :estadosec  or idestado_cama= :estadoter or idestado_cama = 5);');
    $stmt->execute(array('estadounitario' => $estadounitario, 
                        'estadosec' => $estadosec,
                        'estadoter' => $estadoter, ));
    $estados = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $estados;
    }

    public function listarladoxpiso($idpiso){
    $stmt=$this->objPdo->prepare('SELECT * FROM sishosp.lado l where l.idpiso = :idpiso ;');
    $stmt->execute(array('idpiso' => $idpiso ));
    $olados = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $olados;
    }
 
    public function listarhabitaciones($idlado){
    $stmt=$this->objPdo->prepare('SELECT * FROM sishosp.habitacion h where h.idlado = :idlado ;');
    $stmt->execute(array('idlado' => $idlado ));
    $lhabitaciones = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $lhabitaciones;
    }


    // public function listarcamasxhab($idhab, $letra){
    // $stmt=$this->objPdo->prepare('SELECT * FROM sishosp.cama c where c.idhabitacion = :idhab and c.letracama = :letra ;');
    // $stmt->execute(array('idhab' =>$idhab, 'letra' =>$letra ));
    // $lcamas = $stmt->fetchAll(PDO::FETCH_OBJ);
    // return $lcamas[0];
    // }    

    public function listarcamasxhab($idhab, $offset, $limit){
    $stmt=$this->objPdo->prepare('SELECT row_number() OVER(order by idcama) orden, *  from sishosp.cama c where c.idhabitacion = :idhab and c.idcama not in(select c.idcama from sishosp.cama c where c.estado_cama = 5) offset :offset limit :limit ;');
    $stmt->execute(array('idhab' =>$idhab, 'offset' =>$offset, 'limit' =>$limit ));
    $lcamas = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $lcamas;
    }  
    
    // public function oinfocamas($idcama){
    // $stmt=$this->objPdo->prepare('SELECT * FROM sishosp.cama c inner join sishosp.estado_cama ec on c.estado_cama = idestado_cama inner join sishosp.tipo_cama tp on c.tipo_cama = tp.id_tipocama where c.idcama = :idcama ;');
    // $stmt->execute(array('idcama' => $idcama ));
    // $oinfocama = $stmt->fetchAll(PDO::FETCH_OBJ);
    // return $oinfocama[0];
    // }   


    public function ocantcamaxhabit($idhabitacion){
    $stmt=$this->objPdo->prepare('SELECT count(*) cantidad  from sishosp.cama c where c.idhabitacion = :idhabitacion ;');
    $stmt->execute(array('idhabitacion' => $idhabitacion ));
    $ocantcama = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $ocantcama[0];
    } 

    public function oinfocamas($idcama){
    $stmt=$this->objPdo->prepare('SELECT * FROM sishosp.piso p inner join sishosp.lado l on p.idpiso=l.idpiso inner join sishosp.habitacion h on l.idlado=h.idlado inner join sishosp.cama c on h.idhabitacion = c.idhabitacion inner join sishosp.estado_cama ec on c.estado_cama = ec.idestado_cama inner join sishosp.tipo_cama tp on c.tipo_cama=tp.id_tipocama where c.idcama = :idcama ;');
    $stmt->execute(array('idcama' => $idcama ));
    $oinfocama = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $oinfocama[0];
    }  

    public function oprogcama($idcama){
    $stmt=$this->objPdo->prepare('SELECT * from sishosp.prog_camas pc inner join sishosp.servicios_procedencia sp on pc.serv_procedencia=sp.idservicio inner join sisemer.paciente pac on pc.idpaciente = pac.id_paciente  where pc. idcama = :idcama and pc.finalizado = false ;');
    $stmt->execute(array('idcama' => $idcama ));
    $oprogcama = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $oprogcama[0];
    } 

    public function oprogcamadetalle($idprog){
    $stmt=$this->objPdo->prepare('SELECT row_number() OVER(ORDER BY id_detprog_cama ASC) as orden, * FROM sishosp.prog_camas_det pcd inner join sishosp.cie cie on  pcd.cie_id=cie.id_cie where pcd.idprog_cama= :idprog  and pcd.cie_tipo = 1 
        union all
        SELECT row_number() OVER(ORDER BY id_detprog_cama ASC) as orden, * FROM sishosp.prog_camas_det pcd inner join sishosp.cie cie on  pcd.cie_id=cie.id_cie where pcd.idprog_cama= :idprog  and pcd.cie_tipo = 2 
        ;');
    $stmt->execute(array('idprog' => $idprog ));
    $oprogcama_det = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $oprogcama_det;
    } 


    public function insertarprogcama($idpaciente, $hora_ingreso, $fecha_ingreso, $idcama, $usuarioreg ,$idservicio, $estadoprog ,$observacion, $inpespec){
        $stmt = $this->objPdo->prepare('INSERT INTO sishosp.prog_camas (idpaciente, hora_ingreso, fecha_ingreso, hora_salida, fecha_salida, idcama, usu_reg, fecha_hora_reg, usuario_update, fecha_hora_update, serv_procedencia, finalizado, observacion_ingreso, observacion_salida, idcondicionegreso, id_destino, idespingreso) 
                        VALUES(:idpaciente, :hora_ingreso, :fecha_ingreso, null, null, :idcama, :usuarioreg, now(), null, null,   :idservicio, :estadoprog,  :observacion, null, null, null, :inpespec )');
        $rows = $stmt->execute(array('idpaciente' => $idpaciente,
                                    'hora_ingreso' => $hora_ingreso,
                                    'fecha_ingreso' => $fecha_ingreso,
                                    'idcama' => $idcama,
                                    'usuarioreg' => $usuarioreg,
                                    'idservicio' => $idservicio,
                                    'estadoprog' => $estadoprog,
                                    'observacion' => $observacion,
                                    'inpespec' => $inpespec));
    }    


    public function updatecama($estadocama, $idcama) {
        $stmt = $this->objPdo->prepare('UPDATE sishosp.cama set estado_cama = :estadocama where idcama = :idcama');
        $rows = $stmt->execute(array('estadocama' => $estadocama,
                                    'idcama' => $idcama));
    } 

    public function ocamaisertada($idpaciente, $hora_ingreso, $fecha_ingreso, $idcama, $usuarioreg ,$idservicio, $estadoprog ){
    $stmt=$this->objPdo->prepare('SELECT * FROM sishosp.prog_camas pc where pc.idpaciente = :idpaciente and hora_ingreso = :hora_ingreso and fecha_ingreso = :fecha_ingreso  and idcama= :idcama and usu_reg= :usuarioreg and pc.serv_procedencia = :idservicio and pc.finalizado = :estadoprog  ;');
    $stmt->execute(array('idpaciente' => $idpaciente,
                        'hora_ingreso' => $hora_ingreso,
                        'fecha_ingreso' => $fecha_ingreso,
                        'idcama' => $idcama,
                        'usuarioreg' => $usuarioreg,
                        'idservicio' => $idservicio,
                        'estadoprog' => $estadoprog));
    $oidprogcama = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $oidprogcama[0];
    } 

   public function idetalle_camaprog($idprog_cama, $cie, $tipocie, $usuarioreg){
        $stmt = $this->objPdo->prepare('INSERT INTO sishosp.prog_camas_det (idprog_cama, cie_id, cie_tipo, usuario_reg, fecha_hora_reg) 
                        VALUES(:idprog_cama, :cie, :tipocie, :usuarioreg, now() )');
        $rows = $stmt->execute(array('idprog_cama' => $idprog_cama,
                                    'cie' => $cie,
                                    'tipocie' => $tipocie,
                                    'usuarioreg' => $usuarioreg));
    }  


//INSERT INTO sishosp.prog_camas (idpaciente, hora_ingreso, fecha_ingreso, hora_salida, fecha_salida, idcama, usu_reg, fecha_hora_reg, usuario_update, fecha_hora_update, serv_procedencia, finalizado, observacion_ingreso, observacion_salida) 


    public function actualizarprogcama($hora_salida, $fecha_salida, $usuarioreg ,$estadoprog ,$observacion_salida, $scondicion, $id_destino, $idprog){
        $stmt = $this->objPdo->prepare('UPDATE sishosp.prog_camas set hora_salida = :hora_salida, fecha_salida = :fecha_salida, usuario_update = :usuarioreg, fecha_hora_update = now(), finalizado = :estadoprog , observacion_salida = :observacion_salida, idcondicionegreso = :scondicion, id_destino = :id_destino where idprog_cama = :idprog');
        $rows = $stmt->execute(array('hora_salida' => $hora_salida,
                                    'fecha_salida' => $fecha_salida,
                                    'usuarioreg' => $usuarioreg,
                                    'estadoprog' => $estadoprog,
                                    'observacion_salida' => $observacion_salida,
                                    'scondicion' => $scondicion,
                                    'id_destino' => $id_destino,
                                    'idprog' => $idprog));
    } 


    public function actualizarprogcamaingreso($hora_salida, $fecha_salida, $usuarioreg ,$estadoprog ,$observacion_salida, $scondicion, $id_destino,$idprog){
        $stmt = $this->objPdo->prepare('UPDATE sishosp.prog_camas set hora_ingreso = :hora_salida, fecha_ingreso = :fecha_salida, usuario_update = :usuarioreg, fecha_hora_update = now(), finalizado = :estadoprog , observacion_ingreso = :observacion_salida, idcondicionegreso = :scondicion, id_destino = :id_destino where idprog_cama = :idprog');
        $rows = $stmt->execute(array('hora_salida' => $hora_salida,
                                    'fecha_salida' => $fecha_salida,
                                    'usuarioreg' => $usuarioreg,
                                    'estadoprog' => $estadoprog,
                                    'observacion_salida' => $observacion_salida,
                                    'scondicion' => $scondicion,
                                    'id_destino' => $id_destino,                                    
                                    'idprog' => $idprog));
    } 



}    