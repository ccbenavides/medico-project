<?php

require_once 'conexion.php';

class bioPQ{
	
 private $objPDO;
 private $id_biopsia;
 private $id_paciente;
 private $nombre;
 private $num_biopsia;
 private $id_institucion;
 private $dep_id;
 private $fecha_ingreso;
 private $id_usuario;
 private $estado;
 private $pago_paciente;
 private $id_ar_top;
 private $sexo;
 private $edad;
 private $fecha_biopsia;
 private $procedencia;
 private $ocupacion;
 private $tipo_seguro;
 private $servicio;
 private $topografia;
 private $institucion;
 private $medico_tratante;
 private $medico_opcional;
 private $dni;
 private $fecha_informe;
 private $num_muestra;
 private $diag_inicial;
 private $observacion;
 private $id_tipo;//para saber si es biopsia o pieza quirurgica
 private $diagnostico_final;
 private $macroscopia;
 private $tecnologo;
 private $patologo_responsable;
 private $bio_congelacion;//es un dato booleano para saber si es biopsia por congelacion
 private $num_laminas;
 private $num_tacos;
 private $fecha_entmat;
 private $id_res;//dato para saber el resultado de biopsia ya sea displasia o cancer
 private $id_ubicacion;//la ubicacion donde se detecto el cancer o displasia
 private $descripcion;
 private $gestante;
 private $gesta;
 private $para;
 private $mac;
 private $fur;
 private $pap_anterior;
 private $id_muestrabio;
 private $descr_inst;
 private $patologo;
 private $requiere_ih;
 private $diag;
 private $fecha_regresult;
 private $id_diagccv;
 private $id_codigo;
 private $conclusion;
 private $res_general;
 private $numero;
 private $creacion;
 private $resultado;
 private $modificamacro;
 private $modificamacroce;
 private $modificamacroih;
 private $id_top;
 private $tipo_estudio;
 private $id_proc;
 private $fecha_registrobio;
 private $muestra1;
 private $muestra2;
 private $muestra3;
 private $muestra4;
 private $muestra5;
 private $muestra6;
 private $muestra7;
 private $muestra8;
 private $muestra9;
 private $muestra10;
 private $muestra11;
 private $muestra12;
 private $muestra13;
 private $muestra14;
 private $muestra15;
 private $muestra16;
 private $muestra17;
 private $muestra18;
 private $muestra19;
 private $muestra20;
 private $idmuestra1;
 private $idmuestra2;
 private $idmuestra3;
 private $idmuestra4;
 private $idmuestra5;
 private $idmuestra6;
 private $idmuestra7;
 private $idmuestra8;
 private $idmuestra9;
 private $idmuestra10;
 private $idmuestra11;
 private $idmuestra12;
 private $idmuestra13;
 private $idmuestra14;
 private $idmuestra15;
 private $idmuestra16;
 private $idmuestra17;
 private $idmuestra18;
 private $idmuestra19;
 private $idmuestra20;
 private $estado_biopsia;
 private $estget;
 
 

 function __construct($id_biopsia ="",$num_biopsia="",$id_institucion="",$dep_id="",$fecha_ingreso="",
                $id_usuario="",$estado="",$id_paciente ="",$pago_paciente="",$id_ar_top="") {
        $this->id_biopsia = $id_biopsia;
        $this->num_biopsia = $num_biopsia;
        $this->id_institucion=$id_institucion;
        $this->dep_id = $dep_id;
        $this->fecha_ingreso=$fecha_ingreso;
        $this->id_usuario=$id_usuario;
        $this->estado=$estado;
        $this->id_paciente = $id_paciente;
        $this->pago_paciente = $pago_paciente;
        $this->id_ar_top = $id_ar_top;
        $this->objPDO = new Conexion();
  }
 
//listar biopsias finalizadas de PQ
 public function listarbiofinPQ(){
    $stmt = $this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,db.fecha_informe,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,
                        list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                        inner join sisanatom.detalle_biopq db on b.id_biopsia=db.id_biopsia
                        inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                        inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra
                        where b.estado_biopsia=3 and b.condicion_biopsia='A'
                        group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,db.fecha_informe,medico");
    $stmt->execute();
    $pacientes = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $pacientes;
 }

  public function modificarbio(){
          $stmt = $this->objPDO->prepare('UPDATE sisanatom.biopsia
                                                 SET id_institucion=:id_institucion,dep_id=:dep_id,
                                                     medico_tratante=:medico_tratante,fecha_biopsia=:fecha_biopsia, 
                                                     id_top=:id_top,bio_congelacion=:bio_congelacion,tipo_estudio=:tipo_estudio, id_proc=:id_proc, patologo_responsable=:patologo_responsable, 
                                                     diag_inicial=:diag_inicial,observacion=:observacion,pago_paciente=:pago_paciente,id_usuario=:id_usuario,fecha_registrobio=:fecha_registrobio,medico_opcional=:medico_opcional
                                                     WHERE id_biopsia= :id_biopsia;');
          $rows = $stmt->execute(array('id_institucion' => $this->id_institucion,
            'dep_id' => $this->dep_id,
            'medico_tratante' => $this->medico_tratante,
            'fecha_biopsia' => $this->fecha_biopsia,
            'id_top' => $this->id_top,
            'bio_congelacion' => $this->bio_congelacion,
            'tipo_estudio'=>$this->tipo_estudio,
            'id_proc'=>$this->id_proc,
            'patologo_responsable'=>$this->patologo_responsable,
            'diag_inicial'=>$this->diag_inicial,
            'observacion'=>$this->observacion,
            'pago_paciente'=>$this->pago_paciente,
            'id_usuario'=>$this->id_usuario,
            'fecha_registrobio'=>$this->fecha_registrobio,
            'medico_opcional'=>$this->medico_opcional,
            'id_biopsia'=> $this->id_biopsia));
}

public function modificarbioce(){
    $stmt=$this->objPDO->prepare('UPDATE sisanatom.biopsia SET id_institucion=:id_institucion,dep_id=:dep_id,medico_tratante=:medico_tratante,
                                  fecha_biopsia=:fecha_biopsia,id_top=:id_top,id_proc=:id_proc,patologo_responsable=:patologo_responsable,
                                  diag_inicial=:diag_inicial,observacion=:observacion,pago_paciente=:pago_paciente,id_usuario=:id_usuario,fecha_registrobio=:fecha_registrobio,medico_opcional=:medico_opcional
                                  WHERE id_biopsia=:id_biopsia;');
    $rows = $stmt->execute(array('id_institucion' => $this->id_institucion,
            'dep_id' => $this->dep_id,
            'medico_tratante' => $this->medico_tratante,
            'fecha_biopsia' => $this->fecha_biopsia,
            'id_top' => $this->id_top,
            'id_proc'=>$this->id_proc,
            'patologo_responsable'=>$this->patologo_responsable,
            'diag_inicial'=>$this->diag_inicial,
            'observacion'=>$this->observacion,
            'pago_paciente'=>$this->pago_paciente,
            'id_usuario'=>$this->id_usuario,
            'fecha_registrobio'=>$this->fecha_registrobio,
            'medico_opcional'=>$this->medico_opcional,
            'id_biopsia'=> $this->id_biopsia));
}

public function modificarbioccv(){
    $stmt=$this->objPDO->prepare('UPDATE sisanatom.biopsia SET id_institucion=:id_institucion,dep_id=:dep_id,medico_tratante=:medico_tratante,
                                  fecha_biopsia=:fecha_biopsia,id_proc=:id_proc,patologo_responsable=:patologo_responsable,
                                  diag_inicial=:diag_inicial,observacion=:observacion,pago_paciente=:pago_paciente,id_usuario=:id_usuario,fecha_registrobio=:fecha_registrobio,medico_opcional=:medico_opcional
                                  WHERE id_biopsia=:id_biopsia;');
    $rows = $stmt->execute(array('id_institucion' => $this->id_institucion,
            'dep_id' => $this->dep_id,
            'medico_tratante' => $this->medico_tratante,
            'fecha_biopsia' => $this->fecha_biopsia,
            'id_proc'=>$this->id_proc,
            'patologo_responsable'=>$this->patologo_responsable,
            'diag_inicial'=>$this->diag_inicial,
            'observacion'=>$this->observacion,
            'pago_paciente'=>$this->pago_paciente,
            'id_usuario'=>$this->id_usuario,
            'fecha_registrobio'=>$this->fecha_registrobio,
            'medico_opcional'=>$this->medico_opcional,
            'id_biopsia'=> $this->id_biopsia)); 
}

public function modificardetalleccv(){
    $stmt=$this->objPDO->prepare('UPDATE sisanatom.detalle_bioccv SET gestante=:gestante,gesta=:gesta,para=:para,
                                  mac=:mac,fur=:fur,pap_anterior=:pap_anterior
                                  WHERE id_biopsia=:id_biopsia;');
    $rows = $stmt->execute(array('gestante' => $this->gestante,
            'gesta' => $this->gesta,
            'para' => $this->para,
            'mac' => $this->mac,
            'fur'=>$this->fur,
            'pap_anterior'=>$this->pap_anterior,
            'id_biopsia'=> $this->id_biopsia));
}

//listar los tipos ya sea biopsia o pieza quirurgica
public function listatipos(){
        $stmt = $this->objPDO->prepare("SELECT codigo,tipo from sisanatom.tipo_biopsia");
        $stmt->execute();
        $tipos = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $tipos;
}
//listar las procedencias de las muestras
public function listaproc(){
    $stmt=$this->objPDO->prepare("SELECT id_proc,descr_proc from sisanatom.procedencia_muestra");
    $stmt->execute();
    $proc=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $proc;
}
//listar muestras remitidas de citologia cervico vaginal
public function listamuestra(){
        $stmt = $this->objPDO->prepare("SELECT id_muestra as codigo,descr_muestra as muestra from sisanatom.muestra where id_area=3");
        $stmt->execute();
        $mrem = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $mrem;
}
//listar muestras de patologia quirurgica
public function listamuepq(){
        $stmt = $this->objPDO->prepare("SELECT id_muestra as codigo,descr_muestra from sisanatom.muestra where id_area=1 order by descr_muestra asc ");
        $stmt->execute();
        $mremp = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $mremp;
}
//listar muestras de citologia especial
public function listamuece(){
        $stmt = $this->objPDO->prepare("SELECT id_muestra as codigo,descr_muestra from sisanatom.muestra where id_area=2 order by descr_muestra asc ");
        $stmt->execute();
        $mrempce = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $mrempce;
}
//listar muestras de citologia cervico vaginal
public function listamueccv(){
        $stmt = $this->objPDO->prepare("SELECT id_muestra as codigo,descr_muestra from sisanatom.muestra where id_area=3 order by descr_muestra asc ");
        $stmt->execute();
        $mrempccv = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $mrempccv;
}
//listar muestras de inmunohistoquimica
public function listamueih(){
        $stmt = $this->objPDO->prepare("SELECT id_muestra as codigo,descr_muestra from sisanatom.muestra where id_area=4 order by descr_muestra asc ");
        $stmt->execute();
        $mrempih = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $mrempih;
}
//listar los resultados de una biopsia
public function listaresultado(){
        $stmt = $this->objPDO->prepare("SELECT * from sisanatom.result_bio order by descr_res");
        $stmt->execute();
        $rest = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rest;
}
//listar los resultados para una biopsia de citologia especial
public function listresultce(){
        $stmt=$this->objPDO->prepare("SELECT * from sisanatom.result_bio where id_res!=2");
        $stmt->execute();
        $resc=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $resc;
}
//listar ubicacion del resultado de biopsia
public function listaubicacion(){
        $stmt = $this->objPDO->prepare("SELECT * from sisanatom.ubicacion_bio WHERE estado='0' order by descr_ubicacion;");
        $stmt->execute();
        $ubic = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $ubic;
}
//listar tecnologos solo de anatomia patologica
public function listatecnologos(){
        $stmt = $this->objPDO->prepare("SELECT det.emp_id,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno)as nombre from rolesturnos rt inner join rolesturnos_det det on rt.rtur_id=det.rtur_id
                                        inner join empleados e on e.emp_id=det.emp_id
                                        where (rt.dep_id=156 ) and  rtur_fecha=(select current_date)
                                        ORDER BY nombre asc ");
        $stmt->execute();
        $tec = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $tec;
}
//listar los patologos
public function listapatologos(){
        $stmt = $this->objPDO->prepare("SELECT emp_id,(emp_nombres||' '||emp_appaterno||' '||emp_apmaterno)as nombre from empleados
                                        where goc_id=1 and (emp_id=256 or emp_id=532 or emp_id=222 or emp_id=115 or emp_id=1148) and empleados.emp_jefedep='1' order by nombre asc");
        $stmt->execute();
        $pat =$stmt->fetchAll(PDO::FETCH_OBJ);
        return $pat;
}

//contar diagnosticos vacios
public function diagvacios($id_biopsia){
    $stmt=$this->objPDO->prepare("SELECT count(*)as vacios from sisanatom.muestras_biopsia where id_biopsia=:id_biopsia and diag_final is null ");
    $stmt->execute(array('id_biopsia'=>$id_biopsia));
    $dv=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $dv[0]->vacios;
}

//obtener la informacion del paciente por numero de biopsia
public function obtenerinfo(){
    $stmt = $this->objPDO->prepare("SELECT biopq.id_biopsia,biopq.num_biopsia,biopq.dni,biopq.nombre,biopq.edad,biopq.sexo,biopq.fecha_biopsia,biopq.fecha_ingreso,biopq.servicio,biopq.medico_opcional,biopq.medico_tratante,biopq.id_top,
biopq.topografia,biopq.dep_id,biopq.estado_biopsia,biopq.tipo_estudio,nommue.muestra1,nommue.muestra2,nommue.muestra3,nommue.muestra4,nommue.muestra5,nommue.muestra6,nommue.muestra7,nommue.muestra8,nommue.muestra9,nommue.muestra10,nommue.muestra11,nommue.muestra12,nommue.muestra13,nommue.muestra14,nommue.muestra15,nommue.muestra16,nommue.muestra17,nommue.muestra18,nommue.muestra19,nommue.muestra20,idmue.idmuestra1,idmue.idmuestra2,idmue.idmuestra3,idmue.idmuestra4,idmue.idmuestra5,idmue.idmuestra6,idmue.idmuestra7,idmue.idmuestra8,idmue.idmuestra9,idmue.idmuestra10,idmue.idmuestra11,idmue.idmuestra12,idmue.idmuestra13,idmue.idmuestra14,idmue.idmuestra15,idmue.idmuestra16,idmue.idmuestra17,idmue.idmuestra18,idmue.idmuestra19,idmue.idmuestra20,biopq.bio_congelacion,biopq.pago_paciente,biopq.id_proc,biopq.diag_inicial,biopq.observacion,biopq.patologo_responsable,biopq.id_institucion,biopq.tipo_seguro,biopq.num_laminas,biopq.num_tacos,biopq.macroscopia,biopq.requiere_ih,muepq.total as diag,biopq.creacion,biopq.id_res,biopq.id_ubicacion,biopq.modificamacro FROM

(SELECT b.id_biopsia,b.num_biopsia,e.dni,(e.nombre||' '||e.a_paterno||' '||e.a_materno)as nombre,
                                    age((select now())::date,e.fecha_nacimiento::date)as edad,(case when e.sexo='1' then 'Femenino'
                                    when e.sexo='0' then 'Masculino' end) as sexo,b.estado_biopsia,b.fecha_biopsia,b.fecha_ingreso,d.dep_id,d.dep_descr as servicio,b.medico_opcional,b.medico_tratante,ta.id_top,
                                    ta.descr_top as topografia,b.id_institucion,(b.pago_paciente::numeric)::integer,b.diag_inicial,b.observacion,b.bio_congelacion,b.patologo_responsable,b.id_proc,b.tipo_estudio,tp.descripcion as tipo_seguro,pq.num_laminas,pq.num_tacos,pq.macroscopia,pq.requiere_ih,
                                    ((em.emp_nombres||' '||em.emp_appaterno||' '||em.emp_apmaterno)||' '||EXTRACT(DAY FROM b.fecha_registrobio::date)||'-'||EXTRACT(MONTH FROM b.fecha_registrobio)||'-'||EXTRACT(YEAR FROM b.fecha_registrobio::date)||' '||to_char(to_timestamp(((EXTRACT (HOUR FROM b.fecha_registrobio))||':'||(EXTRACT (MINUTE from b.fecha_registrobio))),'HH24:MI'),'HH:MI p.m.')) as creacion,
                                    pq.id_res,pq.id_ubicacion,
                                    ((ep1.emp_nombres||' '||ep1.emp_appaterno||' '||ep1.emp_apmaterno)||' '||EXTRACT(DAY FROM pq.fecha_macro::date)||'-'||EXTRACT(MONTH FROM pq.fecha_macro)||'-'||EXTRACT(YEAR FROM pq.fecha_macro::date)||' '||to_char(to_timestamp(((EXTRACT (HOUR FROM pq.fecha_macro))||':'||(EXTRACT (MINUTE from pq.fecha_macro))),'HH24:MI'),'HH:MI p.m.')) as modificamacro
                                    from sisanatom.biopsia b inner join sisemer.paciente e on b.id_paciente=e.id_paciente
                                    inner join sisemer.tipo_paciente tp on e.id_tipo_paciente=tp.id_tipo_paciente inner join dependencias d on b.dep_id=d.dep_id
                                    inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.detalle_biopq pq on b.id_biopsia=pq.id_biopsia
                                    inner join sisanatom.usuarios_anat ua on b.id_usuario=ua.id_usuario inner join empleados em on ua.emp_id=em.emp_id left join
                                    sisanatom.usuarios_anat uat on pq.usuario_macro=uat.id_usuario left join empleados ep1 on uat.emp_id=ep1.emp_id
                                    where b.id_biopsia='". $this->id_biopsia . "')biopq left join (select id_biopsia,count(*) as total from sisanatom.muestras_biopsia where id_biopsia='". $this->id_biopsia . "' group by id_biopsia)muepq on biopq.id_biopsia=muepq.id_biopsia inner join 
(SELECT * FROM crosstab('select id_biopsia,id_muestrabio,id_muestrarem from sisanatom.muestras_biopsia where id_biopsia=". $this->id_biopsia . " order by id_muestrabio asc') AS ct(id_biopsia integer, muestra1 integer, 
muestra2 integer,muestra3 integer,muestra4 integer,muestra5 integer,muestra6 integer,muestra7 integer,muestra8 integer,muestra9 integer,muestra10 integer,muestra11 integer,muestra12 integer,muestra13 integer,muestra14 integer,muestra15 integer,muestra16 integer,muestra17 integer,muestra18 integer,muestra19 integer,muestra20 integer))nommue on biopq.id_biopsia=nommue.id_biopsia
inner join (SELECT * FROM crosstab('select id_biopsia,id_muestrarem,id_muestrabio from sisanatom.muestras_biopsia where id_biopsia=". $this->id_biopsia . " order by id_muestrabio asc') AS ct(id_biopsia integer, idmuestra1 integer, 
idmuestra2 integer,idmuestra3 integer,idmuestra4 integer,idmuestra5 integer,idmuestra6 integer,idmuestra7 integer,idmuestra8 integer,idmuestra9 integer,idmuestra10 integer,idmuestra11 integer,idmuestra12 integer,idmuestra13 integer,idmuestra14 integer,idmuestra15 integer,idmuestra16 integer,idmuestra17 integer,idmuestra18 integer,idmuestra19 integer,idmuestra20 integer))idmue on biopq.id_biopsia=idmue.id_biopsia;");
    $stmt->execute();
    $infopacs = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($infopacs as $infopac) {
            $this->setIdBio($infopac->id_biopsia);
            $this->setNumBio($infopac->num_biopsia);
            $this->setDni($infopac->dni);
            $this->setNombre($infopac->nombre);
            $this->setEdad($infopac->edad);
            $this->setSexo($infopac->sexo);
            $this->setFecha($infopac->fecha_biopsia);
            $this->setFechaI($infopac->fecha_ingreso);
            $this->setServicio($infopac->servicio);
            $this->setmedopc($infopac->medico_opcional);
            $this->setMedicoT($infopac->medico_tratante);
            $this->settopg($infopac->id_top);
            $this->setTopografia($infopac->topografia);
            $this->setdepid($infopac->dep_id);
            $this->setestadobiopsia($infopac->estado_biopsia);
            $this->settipoest($infopac->tipo_estudio);
            $this->setmuestra1($infopac->muestra1);
            $this->setmuestra2($infopac->muestra2);
            $this->setmuestra3($infopac->muestra3);
            $this->setmuestra4($infopac->muestra4);
            $this->setmuestra5($infopac->muestra5);
            $this->setmuestra6($infopac->muestra6);
            $this->setmuestra7($infopac->muestra7);
            $this->setmuestra8($infopac->muestra8);
            $this->setmuestra9($infopac->muestra9);
            $this->setmuestra10($infopac->muestra10);
            $this->setmuestra11($infopac->muestra11);
            $this->setmuestra12($infopac->muestra12);
            $this->setmuestra13($infopac->muestra13);
            $this->setmuestra14($infopac->muestra14);
            $this->setmuestra15($infopac->muestra15);
            $this->setmuestra16($infopac->muestra16);
            $this->setmuestra17($infopac->muestra17);
            $this->setmuestra18($infopac->muestra18);
            $this->setmuestra19($infopac->muestra19);
            $this->setmuestra20($infopac->muestra20);
            $this->setidmue1($infopac->idmuestra1);
            $this->setidmue2($infopac->idmuestra2);
            $this->setidmue3($infopac->idmuestra3);
            $this->setidmue4($infopac->idmuestra4);
            $this->setidmue5($infopac->idmuestra5);
            $this->setidmue6($infopac->idmuestra6);
            $this->setidmue7($infopac->idmuestra7);
            $this->setidmue8($infopac->idmuestra8);
            $this->setidmue9($infopac->idmuestra9);
            $this->setidmue10($infopac->idmuestra10);
            $this->setidmue11($infopac->idmuestra11);
            $this->setidmue12($infopac->idmuestra12);
            $this->setidmue13($infopac->idmuestra13);
            $this->setidmue14($infopac->idmuestra14);
            $this->setidmue15($infopac->idmuestra15);
            $this->setidmue16($infopac->idmuestra16);
            $this->setidmue17($infopac->idmuestra17);
            $this->setidmue18($infopac->idmuestra18);
            $this->setidmue19($infopac->idmuestra19);
            $this->setidmue20($infopac->idmuestra20);
            $this->setBioC($infopac->bio_congelacion);
            $this->setPago($infopac->pago_paciente);
            $this->setidproc($infopac->id_proc);
            $this->setDiagClinico($infopac->diag_inicial);
            $this->setObs($infopac->observacion);
            $this->setPatog($infopac->patologo_responsable);
            $this->setidinst($infopac->id_institucion);
            $this->setTipoSeguro($infopac->tipo_seguro);
            $this->setNumLamina($infopac->num_laminas);
            $this->setNumTaco($infopac->num_tacos);
            $this->setMacro($infopac->macroscopia);
            $this->setrequiereih($infopac->requiere_ih);
            $this->setdiag($infopac->diag);
            $this->setcreacion($infopac->creacion);
            $this->setIdRes($infopac->id_res);
            $this->setIdUbic($infopac->id_ubicacion);
            $this->setmodificamacro($infopac->modificamacro);
            }
        return $this;  

}

public function obtenerinfoce(){
    $stmt = $this->objPDO->prepare("SELECT bioce.id_biopsia,bioce.num_biopsia,bioce.dni,bioce.nombre,bioce.edad,bioce.sexo,bioce.fecha_biopsia,bioce.fecha_ingreso,bioce.pago_paciente,bioce.estado_biopsia,
bioce.id_proc,bioce.patologo_responsable,bioce.diag_inicial,bioce.observacion,bioce.dep_id,bioce.servicio,bioce.medico_opcional,bioce.medico_tratante,bioce.id_top,bioce.topografia,
bioce.id_institucion,bioce.tipo_seguro,bioce.num_laminas,bioce.num_tacos,bioce.macroscopia,bioce.requiere_ih,bioce.creacion,bioce.resultado,bioce.modificamacroce,muece.total as diag,
nommue.muestra1,nommue.muestra2,nommue.muestra3,nommue.muestra4,nommue.muestra5,nommue.muestra6,nommue.muestra7,nommue.muestra8,nommue.muestra9,nommue.muestra10,nommue.muestra11,nommue.muestra12,nommue.muestra13,nommue.muestra14,nommue.muestra15,nommue.muestra16,nommue.muestra17,nommue.muestra18,nommue.muestra19,nommue.muestra20,idmue.idmuestra1,idmue.idmuestra2,idmue.idmuestra3,idmue.idmuestra4,idmue.idmuestra5,idmue.idmuestra6,idmue.idmuestra7,idmue.idmuestra8,idmue.idmuestra9,idmue.idmuestra10,idmue.idmuestra11,idmue.idmuestra12,idmue.idmuestra13,idmue.idmuestra14,idmue.idmuestra15,idmue.idmuestra16,idmue.idmuestra17,idmue.idmuestra18,idmue.idmuestra19,idmue.idmuestra20 FROM
        (SELECT b.id_biopsia,b.num_biopsia,e.dni,(e.nombre||' '||e.a_paterno||' '||e.a_materno)as nombre,
                                    age((select now())::date,e.fecha_nacimiento::date)as edad,(case when e.sexo='1' then 'Femenino'
                                    when e.sexo='0' then 'Masculino' end) as sexo,b.fecha_biopsia,b.fecha_ingreso,(b.pago_paciente::numeric)::integer,b.estado_biopsia,b.id_proc,b.patologo_responsable,b.diag_inicial,b.observacion,
                                    d.dep_id,d.dep_descr as servicio,b.medico_opcional,b.medico_tratante,ta.id_top,
                                    ta.descr_top as topografia,b.id_institucion,tp.descripcion as tipo_seguro,pq.num_laminas,pq.num_tacos,pq.macroscopia,pq.requiere_ih,
                                    ((em.emp_nombres||' '||em.emp_appaterno||' '||em.emp_apmaterno)||' '||EXTRACT(DAY FROM b.fecha_registrobio::date)||'-'||EXTRACT(MONTH FROM b.fecha_registrobio)||'-'||EXTRACT(YEAR FROM b.fecha_registrobio::date)||' '||to_char(to_timestamp(((EXTRACT (HOUR FROM b.fecha_registrobio))||':'||(EXTRACT (MINUTE from b.fecha_registrobio))),'HH24:MI'),'HH:MI p.m.')) as creacion,
                                    pq.resultado,
                                    ((ep1.emp_nombres||' '||ep1.emp_appaterno||' '||ep1.emp_apmaterno)||' '||EXTRACT(DAY FROM pq.fechareg_macroce::date)||'-'||EXTRACT(MONTH FROM pq.fechareg_macroce)||'-'||EXTRACT(YEAR FROM pq.fechareg_macroce::date)||' '||to_char(to_timestamp(((EXTRACT (HOUR FROM pq.fechareg_macroce))||':'||(EXTRACT (MINUTE from pq.fechareg_macroce))),'HH24:MI'),'HH:MI p.m.')) as modificamacroce
                                    from sisanatom.biopsia b inner join sisemer.paciente e on b.id_paciente=e.id_paciente
                                    inner join sisemer.tipo_paciente tp on e.id_tipo_paciente=tp.id_tipo_paciente inner join dependencias d on b.dep_id=d.dep_id
                                    inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.detalle_bioce pq on b.id_biopsia=pq.id_biopsia
                                    inner join sisanatom.usuarios_anat ua on b.id_usuario=ua.id_usuario inner join empleados em on ua.emp_id=em.emp_id left join
                                    sisanatom.usuarios_anat uat on pq.usureg_macroce=uat.id_usuario left join empleados ep1 on uat.emp_id=ep1.emp_id
                                    where b.id_biopsia='" . $this->id_biopsia . "')bioce left join (select id_biopsia,count(*) as total from sisanatom.muestras_biopsia where id_biopsia='". $this->id_biopsia . "' group by id_biopsia)muece on bioce.id_biopsia=muece.id_biopsia inner join 
(SELECT * FROM crosstab('select id_biopsia,id_muestrabio,id_muestrarem from sisanatom.muestras_biopsia where id_biopsia=". $this->id_biopsia . " order by id_muestrabio asc') AS ct(id_biopsia integer, muestra1 integer, 
muestra2 integer,muestra3 integer,muestra4 integer,muestra5 integer,muestra6 integer,muestra7 integer,muestra8 integer,muestra9 integer,muestra10 integer,muestra11 integer,muestra12 integer,muestra13 integer,muestra14 integer,muestra15 integer,muestra16 integer,muestra17 integer,muestra18 integer,muestra19 integer,muestra20 integer))nommue on bioce.id_biopsia=nommue.id_biopsia
inner join (SELECT * FROM crosstab('select id_biopsia,id_muestrarem,id_muestrabio from sisanatom.muestras_biopsia where id_biopsia=". $this->id_biopsia . " order by id_muestrabio asc') AS ct(id_biopsia integer, idmuestra1 integer, 
idmuestra2 integer,idmuestra3 integer,idmuestra4 integer,idmuestra5 integer,idmuestra6 integer,idmuestra7 integer,idmuestra8 integer,idmuestra9 integer,idmuestra10 integer,idmuestra11 integer,idmuestra12 integer,idmuestra13 integer,idmuestra14 integer,idmuestra15 integer,idmuestra16 integer,idmuestra17 integer,idmuestra18 integer,idmuestra19 integer,idmuestra20 integer))idmue on bioce.id_biopsia=idmue.id_biopsia;");
    $stmt->execute();
    $infopacs = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($infopacs as $infopac) {
            $this->setIdBio($infopac->id_biopsia);
            $this->setNumBio($infopac->num_biopsia);
            $this->setDni($infopac->dni);
            $this->setNombre($infopac->nombre); 
            $this->setEdad($infopac->edad);
            $this->setSexo($infopac->sexo);
            $this->setFecha($infopac->fecha_biopsia);
            $this->setFechaI($infopac->fecha_ingreso);
            $this->setPago($infopac->pago_paciente);
            $this->setestadobiopsia($infopac->estado_biopsia);
            $this->setidproc($infopac->id_proc);
            $this->setPatog($infopac->patologo_responsable);
            $this->setDiagClinico($infopac->diag_inicial);
            $this->setObs($infopac->observacion);
            $this->setdepid($infopac->dep_id);
            $this->setServicio($infopac->servicio);
            $this->setmedopc($infopac->medico_opcional);
            $this->setMedicoT($infopac->medico_tratante);
            $this->settopg($infopac->id_top);
            $this->setTopografia($infopac->topografia);
            $this->setidinst($infopac->id_institucion);
            $this->setTipoSeguro($infopac->tipo_seguro);
            $this->setNumLamina($infopac->num_laminas);
            $this->setNumTaco($infopac->num_tacos);
            $this->setMacro($infopac->macroscopia);
            $this->setrequiereih($infopac->requiere_ih);
            $this->setcreacion($infopac->creacion);
            $this->setresultadoce($infopac->resultado);
            $this->setmodificamacroce($infopac->modificamacroce);
            $this->setdiag($infopac->diag);
            $this->setmuestra1($infopac->muestra1);
            $this->setmuestra2($infopac->muestra2);
            $this->setmuestra3($infopac->muestra3);
            $this->setmuestra4($infopac->muestra4);
            $this->setmuestra5($infopac->muestra5);
            $this->setmuestra6($infopac->muestra6);
            $this->setmuestra7($infopac->muestra7);
            $this->setmuestra8($infopac->muestra8);
            $this->setmuestra9($infopac->muestra9);
            $this->setmuestra10($infopac->muestra10);
            $this->setmuestra11($infopac->muestra11);
            $this->setmuestra12($infopac->muestra12);
            $this->setmuestra13($infopac->muestra13);
            $this->setmuestra14($infopac->muestra14);
            $this->setmuestra15($infopac->muestra15);
            $this->setmuestra16($infopac->muestra16);
            $this->setmuestra17($infopac->muestra17);
            $this->setmuestra18($infopac->muestra18);
            $this->setmuestra19($infopac->muestra19);
            $this->setmuestra20($infopac->muestra20);
            $this->setidmue1($infopac->idmuestra1);
            $this->setidmue2($infopac->idmuestra2);
            $this->setidmue3($infopac->idmuestra3);
            $this->setidmue4($infopac->idmuestra4);
            $this->setidmue5($infopac->idmuestra5);
            $this->setidmue6($infopac->idmuestra6);
            $this->setidmue7($infopac->idmuestra7);
            $this->setidmue8($infopac->idmuestra8);
            $this->setidmue9($infopac->idmuestra9);
            $this->setidmue10($infopac->idmuestra10);
            $this->setidmue11($infopac->idmuestra11);
            $this->setidmue12($infopac->idmuestra12);
            $this->setidmue13($infopac->idmuestra13);
            $this->setidmue14($infopac->idmuestra14);
            $this->setidmue15($infopac->idmuestra15);
            $this->setidmue16($infopac->idmuestra16);
            $this->setidmue17($infopac->idmuestra17);
            $this->setidmue18($infopac->idmuestra18);
            $this->setidmue19($infopac->idmuestra19);
            $this->setidmue20($infopac->idmuestra20);
            }
        return $this;  

}

public function obtenerinfoih(){
    $stmt = $this->objPDO->prepare("SELECT bi.id_biopsia,bi.num_biopsia,bi.dni,bi.id_institucion,bi.dep_id,bi.id_top,bi.id_proc,bi.patologo_responsable,bi.diag_inicial,bi.observacion,bi.pago_paciente,bi.nombre,bi.edad,bi.sexo,bi.fecha_biopsia,bi.fecha_ingreso,bi.servicio,bi.medico_opcional,
                                    bi.medico_tratante,bi.topografia,bi.tipo_seguro,bi.macroscopia,bi.conclusion,bi.res_general,(CASE WHEN bip.numero!=0 THEN bip.numero ELSE 0 END)as numero,bi.creacion,bi.modificamacroih,muece.total as diag,
nommue.muestra1,nommue.muestra2,nommue.muestra3,nommue.muestra4,nommue.muestra5,nommue.muestra6,nommue.muestra7,nommue.muestra8,nommue.muestra9,nommue.muestra10,nommue.muestra11,nommue.muestra12,nommue.muestra13,nommue.muestra14,nommue.muestra15,nommue.muestra16,nommue.muestra17,nommue.muestra18,nommue.muestra19,nommue.muestra20,idmue.idmuestra1,idmue.idmuestra2,idmue.idmuestra3,idmue.idmuestra4,idmue.idmuestra5,idmue.idmuestra6,idmue.idmuestra7,idmue.idmuestra8,idmue.idmuestra9,idmue.idmuestra10,idmue.idmuestra11,idmue.idmuestra12,idmue.idmuestra13,idmue.idmuestra14,idmue.idmuestra15,idmue.idmuestra16,idmue.idmuestra17,idmue.idmuestra18,idmue.idmuestra19,idmue.idmuestra20 FROM

                                    (SELECT b.id_biopsia,b.num_biopsia,e.dni,b.id_institucion,b.dep_id,b.id_top,b.id_proc,b.patologo_responsable,b.diag_inicial,b.observacion,(b.pago_paciente::numeric)::integer,(e.nombre||' '||e.a_paterno||' '||e.a_materno)as nombre,
                                    age((select now())::date,e.fecha_nacimiento::date)as edad,(case when e.sexo='1' then 'Femenino'
                                    when e.sexo='0' then 'Masculino' end) as sexo,b.fecha_biopsia,b.fecha_ingreso,d.dep_descr as servicio,b.medico_tratante,b.medico_opcional,
                                    ta.descr_top as topografia,tp.descripcion as tipo_seguro,pq.macro_ih as macroscopia,pq.conclusion,pq.res_general,
                                    ((em.emp_nombres||' '||em.emp_appaterno||' '||em.emp_apmaterno)||' '||EXTRACT(DAY FROM b.fecha_registrobio::date)||'-'||EXTRACT(MONTH FROM b.fecha_registrobio)||'-'||EXTRACT(YEAR FROM b.fecha_registrobio::date)||' '||to_char(to_timestamp(((EXTRACT (HOUR FROM b.fecha_registrobio))||':'||(EXTRACT (MINUTE from b.fecha_registrobio))),'HH24:MI'),'HH:MI p.m.')) as creacion,
                                    ((ep1.emp_nombres||' '||ep1.emp_appaterno||' '||ep1.emp_apmaterno)||' '||EXTRACT(DAY FROM pq.fechareg_macroih::date)||'-'||EXTRACT(MONTH FROM pq.fechareg_macroih)||'-'||EXTRACT(YEAR FROM pq.fechareg_macroih::date)||' '||to_char(to_timestamp(((EXTRACT (HOUR FROM pq.fechareg_macroih))||':'||(EXTRACT (MINUTE from pq.fechareg_macroih))),'HH24:MI'),'HH:MI p.m.')) as modificamacroih
                                    from sisanatom.biopsia b inner join sisemer.paciente e on b.id_paciente=e.id_paciente
                                    inner join sisemer.tipo_paciente tp on e.id_tipo_paciente=tp.id_tipo_paciente inner join dependencias d on b.dep_id=d.dep_id
                                    inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.detalle_bioih pq on b.id_biopsia=pq.id_biopsia
                                    inner join sisanatom.usuarios_anat ua on b.id_usuario=ua.id_usuario inner join empleados em on ua.emp_id=em.emp_id left join 
                                    sisanatom.usuarios_anat uat on pq.usureg_macroih=uat.id_usuario left join empleados ep1 on ep1.emp_id=uat.emp_id
                                    where b.id_biopsia='" . $this->id_biopsia . "')bi LEFT JOIN (SELECT id_biopsia,count(*)as numero from sisanatom.control_pruebasih where id_biopsia='" . $this->id_biopsia . "'
                                    group by id_biopsia)bip ON bi.id_biopsia=bip.id_biopsia left join (select id_biopsia,count(*) as total from sisanatom.muestras_biopsia where id_biopsia='". $this->id_biopsia . "' group by id_biopsia)muece on bi.id_biopsia=muece.id_biopsia inner join 
(SELECT * FROM crosstab('select id_biopsia,id_muestrabio,id_muestrarem from sisanatom.muestras_biopsia where id_biopsia=". $this->id_biopsia . " order by id_muestrabio asc') AS ct(id_biopsia integer, muestra1 integer, 
muestra2 integer,muestra3 integer,muestra4 integer,muestra5 integer,muestra6 integer,muestra7 integer,muestra8 integer,muestra9 integer,muestra10 integer,muestra11 integer,muestra12 integer,muestra13 integer,muestra14 integer,muestra15 integer,muestra16 integer,muestra17 integer,muestra18 integer,muestra19 integer,muestra20 integer))nommue on bi.id_biopsia=nommue.id_biopsia
inner join (SELECT * FROM crosstab('select id_biopsia,id_muestrarem,id_muestrabio from sisanatom.muestras_biopsia where id_biopsia=". $this->id_biopsia . " order by id_muestrabio asc') AS ct(id_biopsia integer, idmuestra1 integer, 
idmuestra2 integer,idmuestra3 integer,idmuestra4 integer,idmuestra5 integer,idmuestra6 integer,idmuestra7 integer,idmuestra8 integer,idmuestra9 integer,idmuestra10 integer,idmuestra11 integer,idmuestra12 integer,idmuestra13 integer,idmuestra14 integer,idmuestra15 integer,idmuestra16 integer,idmuestra17 integer,idmuestra18 integer,idmuestra19 integer,idmuestra20 integer))idmue on bi.id_biopsia=idmue.id_biopsia;");
    $stmt->execute();
    $infopacs = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($infopacs as $infopac) {
            $this->setIdBio($infopac->id_biopsia);
            $this->setNumBio($infopac->num_biopsia);
            $this->setDni($infopac->dni);
            $this->setidinst($infopac->id_institucion);
            $this->setdepid($infopac->dep_id);
            $this->settopg($infopac->id_top);
            $this->setidproc($infopac->id_proc);
            $this->setPatog($infopac->patologo_responsable);
            $this->setDiagClinico($infopac->diag_inicial);
            $this->setObs($infopac->observacion);
            $this->setPago($infopac->pago_paciente);
            $this->setNombre($infopac->nombre);
            $this->setEdad($infopac->edad);
            $this->setSexo($infopac->sexo);
            $this->setFecha($infopac->fecha_biopsia);
            $this->setFechaI($infopac->fecha_ingreso);
            $this->setServicio($infopac->servicio);
            $this->setmedopc($infopac->medico_opcional);
            $this->setMedicoT($infopac->medico_tratante);
            $this->setTopografia($infopac->topografia);
            $this->setTipoSeguro($infopac->tipo_seguro);
            $this->setMacro($infopac->macroscopia);
            $this->setconclu($infopac->conclusion);
            $this->setresgeneral($infopac->res_general);
            $this->setnumero($infopac->numero);
            $this->setcreacion($infopac->creacion);
            $this->setmodificamacroih($infopac->modificamacroih);
            $this->setdiag($infopac->diag);
            $this->setmuestra1($infopac->muestra1);
            $this->setmuestra2($infopac->muestra2);
            $this->setmuestra3($infopac->muestra3);
            $this->setmuestra4($infopac->muestra4);
            $this->setmuestra5($infopac->muestra5);
            $this->setmuestra6($infopac->muestra6);
            $this->setmuestra7($infopac->muestra7);
            $this->setmuestra8($infopac->muestra8);
            $this->setmuestra9($infopac->muestra9);
            $this->setmuestra10($infopac->muestra10);
            $this->setmuestra11($infopac->muestra11);
            $this->setmuestra12($infopac->muestra12);
            $this->setmuestra13($infopac->muestra13);
            $this->setmuestra14($infopac->muestra14);
            $this->setmuestra15($infopac->muestra15);
            $this->setmuestra16($infopac->muestra16);
            $this->setmuestra17($infopac->muestra17);
            $this->setmuestra18($infopac->muestra18);
            $this->setmuestra19($infopac->muestra19);
            $this->setmuestra20($infopac->muestra20);
            $this->setidmue1($infopac->idmuestra1);
            $this->setidmue2($infopac->idmuestra2);
            $this->setidmue3($infopac->idmuestra3);
            $this->setidmue4($infopac->idmuestra4);
            $this->setidmue5($infopac->idmuestra5);
            $this->setidmue6($infopac->idmuestra6);
            $this->setidmue7($infopac->idmuestra7);
            $this->setidmue8($infopac->idmuestra8);
            $this->setidmue9($infopac->idmuestra9);
            $this->setidmue10($infopac->idmuestra10);
            $this->setidmue11($infopac->idmuestra11);
            $this->setidmue12($infopac->idmuestra12);
            $this->setidmue13($infopac->idmuestra13);
            $this->setidmue14($infopac->idmuestra14);
            $this->setidmue15($infopac->idmuestra15);
            $this->setidmue16($infopac->idmuestra16);
            $this->setidmue17($infopac->idmuestra17);
            $this->setidmue18($infopac->idmuestra18);
            $this->setidmue19($infopac->idmuestra19);
            $this->setidmue20($infopac->idmuestra20);
            }
        return $this;  

}

//obtener informacion de biopsia PQ para IH
public function obtinfopqih(){
    $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,e.dni,its.descr_inst,d.dep_descr as servicio,b.medico_tratante,b.fecha_biopsia,b.pago_paciente,(ea.emp_nombres||' '||ea.emp_appaterno||' '||ea.emp_apmaterno)
                                as patologo,b.fecha_ingreso from sisanatom.biopsia b inner join sisemer.paciente e on b.id_paciente=e.id_paciente inner join sisemer.tipo_paciente tp on e.id_tipo_paciente=tp.id_tipo_paciente inner join dependencias d on b.dep_id=d.dep_id
                                inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.institucion its on b.id_institucion=its.id_inst inner join empleados ea on b.patologo_responsable=ea.emp_id
                                where b.id_biopsia='" . $this->id_biopsia . "';");
    $stmt->execute();
    $infoihs=$stmt->fetchAll(PDO::FETCH_OBJ);
        foreach($infoihs as $infoih){
            $this->setIdBio($infoih->id_biopsia);
            $this->setNumBio($infoih->num_biopsia);
            $this->setDni($infoih->dni);
            $this->setnominst($infoih->descr_inst);
            $this->setServicio($infoih->servicio);
            $this->setMedicoT($infoih->medico_tratante);
            $this->setFecha($infoih->fecha_biopsia);
            $this->setPago($infoih->pago_paciente);
            $this->setnompat($infoih->patologo);
            $this->setFechaI($infoih->fecha_ingreso);
        }
        return $this;
}
//obtener la informacion del paciente de una biopsia ccv
public function obtinfoccv(){
    $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,e.dni,b.id_institucion,(e.nombre||' '||e.a_paterno||' '||e.a_materno)as nombre,(b.pago_paciente::numeric)::integer,b.estado_biopsia,
                                    age((select now())::date,e.fecha_nacimiento::date)as edad,(case when e.sexo='1' then 'Femenino'
                                    when e.sexo='0' then 'Masculino' end) as sexo,b.fecha_biopsia,b.fecha_ingreso,b.id_proc,b.patologo_responsable,d.dep_id,d.dep_descr as servicio,b.medico_opcional,b.medico_tratante,
                                    (case when bc.gestante='0' then 'Si' when bc.gestante='1' then 'No' end)as gestante,bc.gestante as estget,bc.gesta,bc.para,bc.mac,bc.fur,bc.pap_anterior,b.diag_inicial,b.observacion,tp.descripcion as tipo_seguro,
                                    mb.id_muestrabio as idmuestra1,mb.id_muestrarem as muestra1,m.descr_muestra as muestra_remitida,bc.id_diagccv,bc.id_codigo,bc.tecnologo,bc.descripcion,
                                    ((em.emp_nombres||' '||em.emp_appaterno||' '||em.emp_apmaterno)||' '||EXTRACT(DAY FROM b.fecha_registrobio::date)||'-'||EXTRACT(MONTH FROM b.fecha_registrobio)||'-'||EXTRACT(YEAR FROM b.fecha_registrobio::date)||' '||to_char(to_timestamp(((EXTRACT (HOUR FROM b.fecha_registrobio))||':'||(EXTRACT (MINUTE from b.fecha_registrobio))),'HH24:MI'),'HH:MI p.m.')) as creacion
                                    from sisanatom.biopsia b inner join sisemer.paciente e on b.id_paciente=e.id_paciente
                                    inner join sisanatom.usuarios_anat ua on b.id_usuario=ua.id_usuario inner join empleados em on ua.emp_id=em.emp_id
                                    inner join sisemer.tipo_paciente tp on e.id_tipo_paciente=tp.id_tipo_paciente inner join dependencias d on b.dep_id=d.dep_id
                                    inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.detalle_bioccv bc on 
                                    b.id_biopsia=bc.id_biopsia inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia
                                    inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem left join sisanatom.diagnostico_ccv dcv on
                                    bc.id_diagccv=dcv.id_diagccv left join sisanatom.codigo_bethesda cb on bc.id_codigo=cb.id_codigo left join 
                                    empleados emp on bc.tecnologo=emp.emp_id
                                    where b.id_biopsia='" . $this->id_biopsia . "';");
    $stmt->execute();
    $infocvs=$stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($infocvs as $infocv) {
            $this->setIdBio($infocv->id_biopsia);
            $this->setNumBio($infocv->num_biopsia);
            $this->setDni($infocv->dni);
            $this->setidinst($infocv->id_institucion);
            $this->setNombre($infocv->nombre);
            $this->setPago($infocv->pago_paciente);
            $this->setestadobiopsia($infopac->estado_biopsia);
            $this->setEdad($infocv->edad);
            $this->setSexo($infocv->sexo);
            $this->setFecha($infocv->fecha_biopsia);
            $this->setFechaI($infocv->fecha_ingreso);
            $this->setidproc($infocv->id_proc);
            $this->setPatog($infocv->patologo_responsable);
            $this->setdepid($infocv->dep_id);
            $this->setServicio($infocv->servicio);
            $this->setmedopc($infocv->medico_opcional);
            $this->setMedicoT($infocv->medico_tratante);
            $this->setgestante($infocv->gestante);
            $this->setestgesta($infocv->estget);
            $this->setgesta($infocv->gesta);
            $this->setpara($infocv->para);
            $this->setmac($infocv->mac);
            $this->setfur($infocv->fur);
            $this->setpap($infocv->pap_anterior);
            $this->setDiagClinico($infocv->diag_inicial);
            $this->setObs($infocv->observacion);
            $this->setTipoSeguro($infocv->tipo_seguro);
            $this->setidmue1($infocv->idmuestra1);
            $this->setmuestra1($infocv->muestra1);
            $this->setMuestra($infocv->muestra_remitida); 
            $this->setdiagccv($infocv->id_diagccv);
            $this->setidcodigo($infocv->id_codigo);
            $this->setTecn($infocv->tecnologo);
            $this->setDescripcion($infocv->descripcion);
            $this->setcreacion($infocv->creacion);
        }
        return $this;
}
//obtener muestras de una biopsia

public function obtmuestras($id_biopsia){
        $stmt=$this->objPDO->prepare("SELECT id_muestrabio,descr_muestra as muestra_remitida from sisanatom.muestras_biopsia mb
                                      inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                      where id_biopsia=:id_biopsia");
        
        $stmt->execute(array('id_biopsia'=>$id_biopsia));
        $nummuestra=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $nummuestra;
}

//obtener estado de la biopsia
public function obtestbio($id_biopsia){
    $stmt=$this->objPDO->prepare("SELECT estado_biopsia from sisanatom.biopsia where id_biopsia=:id_biopsia");
    $stmt->execute(array('id_biopsia'=>$id_biopsia));
    $ebio=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ebio[0]->estado_biopsia;
}

//obtener laminas de biopsia PQ
public function obtlampq($id_biopsia){
    $stmt=$this->objPDO->prepare("SELECT num_laminas from sisanatom.detalle_biopq where id_biopsia=:id_biopsia");
    $stmt->execute(array('id_biopsia'=>$id_biopsia));
    $ltpq=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ltpq[0]->num_laminas;
}

//obtener tacos de biopsia PQ
public function obttacpq($id_biopsia){
    $stmt=$this->objPDO->prepare("SELECT num_tacos from sisanatom.detalle_biopq where id_biopsia=:id_biopsia");
    $stmt->execute(array('id_biopsia'=>$id_biopsia));
    $tacospq=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $tacospq[0]->num_tacos;
}

//obtener macroscopia de biopsia PQ
public function obtmacropq($id_biopsia){
    $stmt=$this->objPDO->prepare("SELECT macroscopia from sisanatom.detalle_biopq where id_biopsia=:id_biopsia");
    $stmt->execute(array('id_biopsia'=>$id_biopsia));
    $macropq=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $macropq[0]->macroscopia;
}

//obtener diagnostico por muestra
public function obtdiagmue($id_muestrabio){
    $stmt=$this->objPDO->prepare("SELECT diag_final from sisanatom.muestras_biopsia where id_muestrabio=:id_muestrabio");
    $stmt->execute(array('id_muestrabio'=>$id_muestrabio));
    $diagmue=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $diagmue[0]->diag_final;
}

//actualizar los materiales de cada muestra de una biopsia de patologia quirurgica
public function actualizamaterial($id_biopsia,$num_laminas,$num_tacos,$fecha_entmat,$usu_regmat,$fecha_regmat){
    $sql = "UPDATE sisanatom.detalle_biopq set num_laminas=:num_laminas,num_tacos=:num_tacos,fecha_entmat=:fecha_entmat,usu_regmat=:usu_regmat,fecha_regmat=:fecha_regmat
            where id_biopsia =:id_biopsia;";

    $stmt = $this->objPDO->prepare($sql);

        try{
            $stmt->execute(array('id_biopsia'=> $id_biopsia,'num_laminas'=>$num_laminas,'num_tacos'=>$num_tacos,'fecha_entmat'=>$fecha_entmat,'usu_regmat'=>$usu_regmat,'fecha_regmat'=>$fecha_regmat));
            return true;
        }catch(PDOExeception $e){
            return false;
        }
}
public function buscartec($id_biopsia){
    $stmt=$this->objPDO->prepare("SELECT tecnologo_responsable from sisanatom.biopsia where id_biopsia=:id_biopsia");
    $stmt->execute(array('id_biopsia'=>$id_biopsia));
    $tecnolbio=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $tecnolbio[0]->tecnologo_responsable;
}

public function buscarpatologo($id_biopsia){
    $stmt=$this->objPDO->prepare("SELECT patologo_responsable from sisanatom.biopsia where id_biopsia=:id_biopsia");
    $stmt->execute(array('id_biopsia'=>$id_biopsia));
    $patbio=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $patbio[0]->patologo_responsable;
}
//lista de tecnologos para entrega de materiales que se manejara desde administrador
public function listecmat(){
    $stmt=$this->objPDO->prepare("SELECT emp_id,(emp_appaterno||' '||emp_apmaterno||' '||emp_nombres)as nombre from empleados where goc_id=9 and dep_id=27
                                order by nombre asc ");
    $stmt->execute();
    $tecmat=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $tecmat;
}
//muestra los materiales y tecnologo cuando el estado de biopsia es 2 para los medicos
public function getmaterial1($id_biopsia){
    $stmt=$this->objPDO->prepare("SELECT pq.num_laminas,pq.num_tacos,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno)as tecnologo from sisanatom.detalle_biopq pq inner join sisanatom.usuarios_anat ua
                                    on pq.usu_regmat=ua.id_usuario inner join empleados e on ua.emp_id=e.emp_id inner join sisanatom.biopsia b on pq.id_biopsia=b.id_biopsia
                                    where pq.id_biopsia=:id_biopsia and b.estado_biopsia=2");
    $stmt->execute(array('id_biopsia'=>$id_biopsia));
    $mat1=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $mat1;
}
//muestra la informacion de materiales para el tecnologo y administrador
public function getmaterial($id_biopsia){
    $stmt=$this->objPDO->prepare("SELECT pq.num_laminas,pq.num_tacos,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno)as tecnologo from sisanatom.detalle_biopq pq inner join sisanatom.usuarios_anat ua
                        on pq.usu_regmat=ua.id_usuario inner join empleados e on ua.emp_id=e.emp_id where pq.id_biopsia=:id_biopsia");
    $stmt->execute(array('id_biopsia' => $id_biopsia));
    $bmat=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $bmat; 
}

public function actualizamacro($id_biopsia,$macroscopia,$usuario_macro,$fecha_macro){
   $sql = "UPDATE sisanatom.detalle_biopq set macroscopia=:macroscopia,usuario_macro=:usuario_macro,fecha_macro=:fecha_macro
            where id_biopsia =:id_biopsia;";

    $stmt = $this->objPDO->prepare($sql);

        try{
            $stmt->execute(array('id_biopsia'=> $id_biopsia,'macroscopia'=>$macroscopia,'usuario_macro'=>$usuario_macro,'fecha_macro'=>$fecha_macro));
            return true;
        }catch(PDOExeception $e){
            return false;
        } 
}
//muestra la macroscopia siempre y cuando el estado de biopsia sea 2 para el medico
public function getmacros1($id_biopsia){
    $stmt=$this->objPDO->prepare("SELECT macroscopia from sisanatom.detalle_biopq bpq
                                    inner join sisanatom.biopsia b on b.id_biopsia=bpq.id_biopsia
                                    where bpq.id_biopsia=:id_biopsia and b.estado_biopsia=2");
    $stmt->execute(array('id_biopsia'=>$id_biopsia));
    $mac1=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $mac1;
}
//muestra la macroscopia de la biopsia para el tecnologo y administrador
public function getmacros($id_biopsia){
    $stmt=$this->objPDO->prepare("SELECT macroscopia from sisanatom.detalle_biopq
                                  where id_biopsia=:id_biopsia");
    $stmt->execute(array('id_biopsia' => $id_biopsia));
    $bmac=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $bmac; 
}

public function actualizadiag($id_biopsia,$id_muestrabio,$diag_final,$usuario_diagfinal,$fecha_diagfinal){
   $sql = "UPDATE sisanatom.muestras_biopsia set diag_final=:diag_final,usuario_diagfinal=:usuario_diagfinal,fecha_diagfinal=:fecha_diagfinal
            where id_biopsia =:id_biopsia and id_muestrabio=:id_muestrabio;";

    $stmt = $this->objPDO->prepare($sql);

        try{
            $stmt->execute(array('id_biopsia'=> $id_biopsia,'id_muestrabio'=>$id_muestrabio,'diag_final'=>$diag_final,'usuario_diagfinal'=>$usuario_diagfinal,'fecha_diagfinal'=>$fecha_diagfinal));
            return true;
        }catch(PDOExeception $e){
            return false;
        }  
}

public function getdiagnostico($id_biopsia){
    $stmt=$this->objPDO->prepare("SELECT m.descr_muestra as muestra_remitida,diag_final from sisanatom.muestras_biopsia mb
                                  inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                  where id_biopsia=:id_biopsia");
    $stmt->execute(array('id_biopsia' => $id_biopsia));
    $bdi=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $bdi; 
}

public function actualizares($id_biopsia,$id_res,$id_ubicacion,$valida_patologo,$fecha_informe){
    $sql = "UPDATE sisanatom.detalle_biopq set id_res=:id_res,id_ubicacion=:id_ubicacion,valida_patologo=:valida_patologo,fecha_informe=:fecha_informe
            where id_biopsia =:id_biopsia;";

    $stmt = $this->objPDO->prepare($sql);

        try{
            $stmt->execute(array('id_biopsia'=> $id_biopsia,'id_res'=>$id_res,'id_ubicacion'=>$id_ubicacion,'valida_patologo'=>$valida_patologo,'fecha_informe'=>$fecha_informe));
            return true;
        }catch(PDOExeception $e){
            return false;
        }   
}

public function actualizaregres($id_biopsia,$fecha_regresult){
    $sql = "UPDATE sisanatom.detalle_biopq set fecha_regresult=:fecha_regresult
            where id_biopsia =:id_biopsia;";

    $stmt = $this->objPDO->prepare($sql);

        try{
            $stmt->execute(array('id_biopsia'=> $id_biopsia,'fecha_regresult'=>$fecha_regresult));
            return true;
        }catch(PDOExeception $e){
            return false;
        }   
}

public function getresultado($id_biopsia){
     $stmt=$this->objPDO->prepare("SELECT r.descr_res,u.descr_ubicacion,pq.fecha_informe,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno)as patologo
                                 from sisanatom.detalle_biopq pq inner join empleados e on pq.valida_patologo=e.emp_id inner join sisanatom.result_bio r on pq.id_res=r.id_res
                                 inner join sisanatom.ubicacion_bio u on pq.id_ubicacion=u.id_ubicacion
                                 where pq.id_biopsia=:id_biopsia");
    $stmt->execute(array('id_biopsia' => $id_biopsia));
    $bdi=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $bdi; 
}
//actualizar estado de biopsia cuando se registra los materiales(2:En Analisis)
public function actualizaest2($id_biopsia){
    $sql = "UPDATE sisanatom.biopsia set estado_biopsia='2' where id_biopsia =:id_biopsia;";

    $stmt = $this->objPDO->prepare($sql);

        try{
            $stmt->execute(array('id_biopsia' => $id_biopsia));
            return true;
        }catch(PDOExeception $e){
            return false;
        }
}
/*
public function actest2($id_biopsia){
    $stmt=$this->objPdo->prepare("UPDATE sisanatom.biopsia set estado_biopsia='2' where id_biopsia =:id_biopsia;");
    $rows=$stmt->execute(array('id_biopsia'=>$id_biopsia));
}*/
//actualizar estado de biopsia cuando se registra el resultado(3:finalizado)
public function actualizaest3($id_biopsia){
    $sql = "UPDATE sisanatom.biopsia set estado_biopsia='3' where id_biopsia =:id_biopsia;";

    $stmt = $this->objPDO->prepare($sql);

        try{
            $stmt->execute(array('id_biopsia' => $id_biopsia));
            return true;
        }catch(PDOExeception $e){
            return false;
    }
}

//actualizar si se requiere inmunohistoquimica

public function actualizareqih($id_biopsia){
    $sql = "UPDATE sisanatom.detalle_biopq set requiere_ih='Si' where id_biopsia =:id_biopsia;";

    $stmt = $this->objPDO->prepare($sql);

        try{
            $stmt->execute(array('id_biopsia' => $id_biopsia));
            return true;
        }catch(PDOExeception $e){
            return false;
        }
}

public function modificarih(){
        $stmt = $this->objPDO->prepare("UPDATE sisanatom.detalle_biopq set requiere_ih=:requiere_ih where id_biopsia =:id_biopsia;");
        $stmt->execute(array('id_biopsia' =>$this->id_biopsia,
                             'requiere_ih'=>$this->requiere_ih));
}

//modificar requiere_ih de citologia especial
public function modificarceih(){
        $stmt = $this->objPDO->prepare("UPDATE sisanatom.detalle_bioce set requiere_ih=:requiere_ih where id_biopsia =:id_biopsia;");
        $stmt->execute(array('id_biopsia' =>$this->id_biopsia,
                             'requiere_ih'=>$this->requiere_ih));
}

//buscar codigo de muestra
public function getcodmue($muestra_remitida,$id_biopsia){
    $stmt=$this->objPDO->prepare("SELECT id_muestrabio from sisanatom.muestras_biopsia
                        where id_muestrarem=:muestra_remitida and id_biopsia=:id_biopsia");
    $stmt->execute(array('id_muestrarem' => $muestra_remitida,'id_biopsia'=>$muestra_remitida));
    $cmat=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $cmat[0]->id_muestrabio;
}
/*informacion para reporte de informe de biopsia para el paciente */
public function obtenerinfpac($id_biopsia){
    $stmt=$this->objPDO->prepare("SELECT bio.num_biopsia,pac.dni,(pac.nombre||' '||pac.a_paterno||' '||pac.a_materno)as paciente, (pac.edad||' años') as edad,
                                (case when pac.sexo='1' then 'FEMENINO' when pac.sexo='0' then 'MASCULINO' end) as sexo,('DISTRITO DE '||ub.distrito) as procedencia,dp.dep_descr as servicio,
                                bio.diag_inicial as diagnostico,bio.medico_tratante,bio.medico_opcional,bio.observacion,(ep.emp_nombres||' '||ep.emp_appaterno||' '||ep.emp_apmaterno) as patologo,ep.emp_colegiatura,ep.emp_rne,
                                ((EXTRACT (DAY FROM bio.fecha_biopsia))||'/'||(EXTRACT (MONTH FROM bio.fecha_biopsia))||'/'||(EXTRACT (YEAR FROM bio.fecha_biopsia))) AS fecha_biopsia,
                                ((EXTRACT (DAY FROM pq.fecha_informe))||'/'||(EXTRACT (MONTH FROM pq.fecha_informe))||'/'||(EXTRACT (YEAR FROM pq.fecha_informe))) AS fecha_informe
                                from sisanatom.biopsia bio inner join sisemer.paciente pac on bio.id_paciente=pac.id_paciente left join sisemer.ubigeo ub on pac.id_ubigeo=ub.id_ubigeo
                                inner join dependencias dp ON bio.dep_id=dp.dep_id inner join sisanatom.detalle_biopq pq ON bio.id_biopsia=pq.id_biopsia
                                inner join empleados ep ON bio.patologo_responsable=ep.emp_id
                                where bio.id_biopsia=:id_biopsia");
    $stmt->execute(array('id_biopsia'=>$id_biopsia));
    $informepac=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $informepac;
}

// public function obtenerinfpac($id_biopsia){
//     $stmt=$this->objPDO->prepare("SELECT bio.num_biopsia,pac.dni,(pac.nombre||' '||pac.a_paterno||' '||pac.a_materno)as paciente,(((select now()::date - pac.fecha_nacimiento::date)/365)||' '||'Años') as edad,
//                                 (case when pac.sexo='1' then 'FEMENINO' when pac.sexo='0' then 'MASCULINO' end) as sexo,('DISTRITO DE '||ub.distrito) as procedencia,dp.dep_descr as servicio,
//                                 bio.diag_inicial as diagnostico,bio.medico_tratante,bio.medico_opcional,bio.observacion,(ep.emp_nombres||' '||ep.emp_appaterno||' '||ep.emp_apmaterno) as patologo,ep.emp_colegiatura,ep.emp_rne,
//                                 ((EXTRACT (DAY FROM bio.fecha_biopsia))||'/'||(EXTRACT (MONTH FROM bio.fecha_biopsia))||'/'||(EXTRACT (YEAR FROM bio.fecha_biopsia))) AS fecha_biopsia,
//                                 ((EXTRACT (DAY FROM pq.fecha_informe))||'/'||(EXTRACT (MONTH FROM pq.fecha_informe))||'/'||(EXTRACT (YEAR FROM pq.fecha_informe))) AS fecha_informe
//                                 from sisanatom.biopsia bio inner join sisemer.paciente pac on bio.id_paciente=pac.id_paciente left join sisemer.ubigeo ub on pac.id_ubigeo=ub.id_ubigeo
//                                 inner join dependencias dp ON bio.dep_id=dp.dep_id inner join sisanatom.detalle_biopq pq ON bio.id_biopsia=pq.id_biopsia
//                                 inner join empleados ep ON bio.patologo_responsable=ep.emp_id
//                                 where bio.id_biopsia=:id_biopsia");
//     $stmt->execute(array('id_biopsia'=>$id_biopsia));
//     $informepac=$stmt->fetchAll(PDO::FETCH_OBJ);
//     return $informepac;
// }


/*informacion para reporte sobre las muestras y diagnosticos de una biopsia */
public function obtenermuestydiag($id_biopsia){
    $stmt=$this->objPDO->prepare("SELECT bio.id_biopsia,muestrabio.id_muestrabio,muestrabio.muestra_remitida,muestrabio.diag_final,muestrabio.descrip_muestce FROM
                                    (select id_biopsia,num_biopsia from sisanatom.biopsia)bio inner join 
                                    (SELECT id_biopsia,id_muestrabio,m.descr_muestra as muestra_remitida,diag_final,descrip_muestce from sisanatom.muestras_biopsia mb
                                    inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem)muestrabio ON bio.id_biopsia=muestrabio.id_biopsia
                                    where bio.id_biopsia=:id_biopsia order by muestrabio.id_muestrabio");
    $stmt->execute(array('id_biopsia'=>$id_biopsia));
    $mydiag=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $mydiag;
}
/*funcion que obtiene cantidad de filas del reporye sobre las muestras y diagnosticos de una biopsia*/
public function cantidadmuestydiag($id_biopsia){
    $stmt=$this->objPDO->prepare("SELECT bio.id_biopsia,muestrabio.id_muestrabio,muestrabio.muestra_remitida,muestrabio.diag_final FROM
                                    (select id_biopsia,num_biopsia from sisanatom.biopsia)bio inner join 
                                    (SELECT id_biopsia,id_muestrabio,m.descr_muestra as muestra_remitida,diag_final from sisanatom.muestras_biopsia mb
                                    inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem)muestrabio ON bio.id_biopsia=muestrabio.id_biopsia
                                    where bio.id_biopsia=:id_biopsia");
    $stmt->execute(array('id_biopsia'=>$id_biopsia));
    $mydiag=$stmt->rowCount();
    return $mydiag;
}
/*funcion para obtener los marcadores de IH de una biopsia PQ*/
public function obtenermarcpq($id_biopsia){
    $stmt=$this->objPDO->prepare("SELECT mp.id_marc_prueba, bio.id_biopsia,m.descr_marcador,mp.resultado from sisanatom.biopsia bio inner join sisanatom.control_pruebasih cp on bio.id_biopsia=cp.id_biopsia
                                inner join sisanatom.marcador_prueba mp on cp.id_control=mp.prueba inner join sisanatom.marcador m on mp.marcador=m.id_marcador
                                where bio.id_biopsia=:id_biopsia");
    $stmt->execute(array('id_biopsia'=>$id_biopsia));
    $marcpq=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $marcpq;
}
/*obtener la macroscopia de una biopsia para el informe*/
public function obtenermacrobio($id_biopsia){
    $stmt=$this->objPDO->prepare("SELECT macroscopia from sisanatom.detalle_biopq where id_biopsia=:id_biopsia");
    $stmt->execute(array('id_biopsia'=>$id_biopsia));
    $macrobio=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $macrobio;
}
/*obtener el patologo responsable de una biopsia*/
public function obtpatobio($id_biopsia){
    $stmt=$this->objPDO->prepare("SELECT patologo_responsable as responsable from sisanatom.biopsia where id_biopsia=:id_biopsia");
    $stmt->execute(array('id_biopsia'=>$id_biopsia));
    $patobio=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $patobio[0]->responsable;
}
/*obtener el tecnologo responsable de una biopsia*/
public function obttecbio($id_usuario){
    $stmt=$this->objPDO->prepare("SELECT b.tecnologo_responsable as responsable from sisanatom.biopsia b inner join empleados e on b.tecnologo_responsable=e.emp_id 
                                 inner join sisanatom.usuarios_anat ua on e.emp_id=ua.emp_id where ua.id_usuario=:id_usuario
                                 group by b.tecnologo_responsable");
    $stmt->execute(array('id_usuario'=>$id_usuario));
    $tecnobio=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $tecnobio[0]->responsable;
}
/*obtener requiere_ih de biopsia*/
public function obtreqih($id_biopsia){
    $stmt=$this->objPDO->prepare("SELECT requiere_ih as requeridoih from sisanatom.detalle_biopq where id_biopsia=:id_biopsia");
    $stmt->execute(array('id_biopsia'=>$id_biopsia));
    $reqbio=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $reqbio[0]->requeridoih;
}


public function actualizarbiosiaPQ($estado, $id_biopsia){
        $stmt = $this->objPDO->prepare("UPDATE sisanatom.biopsia set estado_biopsia= :estado where id_biopsia =:id_biopsia;");
        $stmt->execute(array('estado' =>$estado,
                            'id_biopsia' =>$id_biopsia));
}

/* Functions for Model Revision */

//listar biopsias de revision por fecha
  public function listarbioRevisionFecha($fecha_inicial, $fecha_final){
    // die( $fecha_final . " espacio " . $fecha_inicial);
      $stmt = $this->objPDO->prepare("select b.num_biopsia, (p.nombre||' '||p.a_paterno||' '||p.a_materno) as nombre, p.edad, p.sexo, su.provincia, 
                        p.sishrl_paciente, b.medico_tratante, b.patologo_responsable,(emp.emp_nombres||' '||emp.emp_appaterno||' '||emp.emp_apmaterno) 
                        as patologo, b.observacion, b.fecha_biopsia, b.fecha_ingreso, db.fecha_informe, (b.pago_paciente::numeric)::integer
                        from sisanatom.biopsia b
                        inner join sisemer.paciente p on p.id_paciente = b.id_paciente
                        inner join sisanatom.procedencia_muestra pm on b.id_proc=pm.id_proc
                        inner join sisemer.ubigeo su on su.id_ubigeo=p.id_ubigeo
                        inner join sisanatom.detalle_biopq db on b.id_biopsia=db.id_biopsia
                        inner join empleados emp on emp.emp_id = b.patologo_responsable
                        where b.estado_biopsia=3 and fecha_ingreso >= ' $fecha_inicial ' and fecha_ingreso<=' $fecha_final ' order by fecha_ingreso ASC;");
 
      $stmt->execute();
      $pacientes = $stmt->fetchAll(PDO::FETCH_OBJ);
      return $pacientes;
  }


  public function listardatesbio(){
      $stmt= $this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia, (p.nombre||' '||p.a_paterno||' '||p.a_materno) as nombre, p.edad, p.sexo, 
                        su.provincia, p.sishrl_paciente, b.medico_tratante, top.descr_top, b.id_top, mb.id_muestrarem, m.descr_muestra, b.dep_id, 
                        dpq.id_res,dpq.id_ubicacion,b.patologo_responsable,(emp.emp_nombres||' '||emp.emp_appaterno||' '||emp.emp_apmaterno) 
                        as patologo, b.diag_inicial,b.observacion, b.fecha_biopsia, b.fecha_ingreso, db.fecha_informe, (b.pago_paciente::numeric)::integer
                        FROM sisanatom.biopsia b
                        inner join sisemer.paciente p on p.id_paciente = b.id_paciente
                        inner join sisanatom.procedencia_muestra pm on b.id_proc=pm.id_proc
                        inner join sisemer.ubigeo su on su.id_ubigeo=p.id_ubigeo
                        inner join sisanatom.detalle_biopq db on b.id_biopsia=db.id_biopsia
                        inner join empleados emp on emp.emp_id = b.patologo_responsable
                        inner join sisanatom.topografia_area top on top.id_top=b.id_top 
                        inner join sisanatom.muestras_biopsia mb on mb.id_biopsia= b.id_biopsia
                        inner join sisanatom.muestra m on m.id_muestra = mb.id_muestrarem
                        inner join sisanatom.detalle_biopq dpq on dpq.id_biopsia = b.id_biopsia
                        where b.estado_biopsia=3");
      $stmt->execute();
      $pacientes = $stmt->fetchAll(PDO::FETCH_OBJ);
      return $pacientes;
  }

 //listar topografia
  public function listarTopografia(){
      $stmt = $this ->objPDO -> prepare("SELECT * FROM sisanatom.topografia_area where id_area=1");
      $stmt->execute();
      $topologias = $stmt->fetchAll(PDO::FETCH_OBJ);
      return $topologias;
  }
 //listar dependencias - servicio
  public function listarServicio(){
      $stmt = $this ->objPDO ->prepare("SELECT dep_id, dep_descr, dep_estado, usr_id, dep_fechareg FROM dependencias ORDER BY dep_descr");
      $stmt->execute();
      $servicios = $stmt->fetchAll(PDO::FETCH_OBJ);
      return $servicios;
  }
/* End Functions Revision */

public function getreqih(){
    return $this->requiere_ih;
}
public function setreqih($requiere_ih){
    $this->requiere_ih = $requiere_ih;
}

public function getnominst(){
    return $this->descr_inst;
}
public function setnominst($descr_inst){
    $this->descr_inst = $descr_inst;
}

public function getnompat(){
    return $this->patologo;
}
public function setnompat($patologo){
    $this->patologo = $patologo;
}

public function getIdMuestraBio() {
        return $this->id_muestrabio;
    }

public function setMuestraBio($id_muestrabio) {
        $this->id_muestrabio = $id_muestrabio;
}
public function getMuestra() {
        return $this->muestra_remitida;
}

public function setMuestra($muestra_remitida) {
        $this->muestra_remitida = $muestra_remitida;
}

public function getIdBio(){
    return $this->id_biopsia;    
}

public function setIdBio($id_biopsia){
    $this->id_biopsia=$id_biopsia;
}

public function getNumBio() {
        return $this->num_biopsia;
}

public function setNumBio($num_biopsia){
     $this->num_biopsia = $num_biopsia;
}

public function getDni() {
        return $this->dni;
}

public function setDni($dni){
     $this->dni = $dni;
}

public function getNombre() {
        return $this->nombre;
}

public function setNombre($nombre){
     $this->nombre = $nombre;
}

public function getEdad() {
        return $this->edad;
}

public function setEdad($edad){
     $this->edad = $edad;
}

public function getSexo() {
        return $this->sexo;
}

public function setSexo($sexo){
     $this->sexo = $sexo;
}

public function getProcedencia() {
        return $this->procedencia;
}

public function setProcedencia($procedencia){
     $this->procedencia = $procedencia;
}

public function getOcu() {
        return $this->ocupacion;
}

public function setOcu($ocupacion){
     $this->ocupacion = $ocupacion;
}

public function getTipoSeguro() {
        return $this->tipo_seguro;
}

public function setTipoSeguro($tipo_seguro){
     $this->tipo_seguro = $tipo_seguro;
}

public function getServicio() {
        return $this->servicio;
}

public function setServicio($servicio){
     $this->servicio = $servicio;
}
public function getTopografia() {
        return $this->topografia;
}

public function setTopografia($topografia){
     $this->topografia = $topografia;
}

public function getInstit() {
        return $this->institucion;
}

public function setInstit($institucion){
     $this->institucion = $institucion;
}

public function getMedicoT() {
        return $this->medico_tratante;
}

public function setMedicoT($medico_tratante){
     $this->medico_tratante = $medico_tratante;
}

public function getFecha() {
        return $this->fecha_biopsia;
}

public function setFecha($fecha_biopsia){
     $this->fecha_biopsia = $fecha_biopsia;
}

public function getFechaI() {
        return $this->fecha_ingreso;
}

public function setFechaI($fecha_ingreso){
     $this->fecha_ingreso = $fecha_ingreso;
}

public function getPago() {
        return $this->pago_paciente;
}

public function setPago($pago_paciente){
     $this->pago_paciente = $pago_paciente;
}

public function getFechaInfo() {
        return $this->fecha_informe;
}

public function setFechaInfo($fecha_informe){
     $this->fecha_informe = $fecha_informe;
}
//muestra remitida citologia especial
public function getMuesRem() {
        return $this->muestra_rem_ce;
}

public function setMuesRem($muestra_rem_ce){
     $this->muestra_rem_ce = $muestra_rem_ce;
}

public function getNumMuestra() {
        return $this->num_muestra;
}

public function setNumMuestra($num_muestra){
     $this->num_muestra = $num_muestra;
}

public function getDiagClinico() {
        return $this->diag_inicial;
}

public function setDiagClinico($diag_inicial){
     $this->diag_inicial = $diag_inicial;
}

public function getObs() {
        return $this->observacion;
}

public function setObs($observacion){
     $this->observacion = $observacion;
}

public function getIdTipo() {
        return $this->id_tipo;
}

public function setIdTipo($id_tipo){
     $this->id_tipo = $id_tipo;
}

public function getDiagFinal() {
        return $this->diagnostico_final;
}

public function setDiagFinal($diagnostico_final){
     $this->diagnostico_final = $diagnostico_final;
}

public function getMacro() {
    return $this->macroscopia;
}

public function setMacro($macroscopia){
     $this->macroscopia = $macroscopia;
}

public function getTecn() {
        return $this->tecnologo;
}

public function setTecn($tecnologo){
     $this->tecnologo = $tecnologo;
}

public function getPatog() {
        return $this->patologo_responsable;
}

public function setPatog($patologo_responsable){
     $this->patologo_responsable = $patologo_responsable;
}

public function getDescripcion() {
        return $this->descripcion;
}

public function setDescripcion($descripcion){
     $this->descripcion = $descripcion;
}

public function getBioC() {
        return $this->bio_congelacion;
}

public function setBioC($bio_congelacion){
     $this->bio_congelacion = $bio_congelacion;
}

public function getNumLamina() {
        return $this->num_laminas;
}

public function setNumLamina($num_laminas){
     $this->num_laminas = $num_laminas;
}

public function getNumTaco() {
        return $this->num_tacos;
}

public function setNumTaco($num_tacos){
     $this->num_tacos = $num_tacos;
}

public function getIdRes() {
        return $this->id_res;
}

public function setIdRes($id_res){
     $this->id_res = $id_res;
}

public function getIdUbic() {
        return $this->id_ubicacion;
}

public function setIdUbic($id_ubicacion){
     $this->id_ubicacion = $id_ubicacion;
}
public function getgestante() {
    return $this->gestante;
}
public function setgestante($gestante){
     $this->gestante = $gestante;
}
public function getgesta() {
    return $this->gesta;
}
public function setgesta($gesta){
     $this->gesta = $gesta;
}
public function getmac() {
    return $this->mac;
}
public function setmac($mac){
     $this->mac = $mac;
}
public function getpara() {
    return $this->para;
}
public function setpara($para){
     $this->para = $para;
}
public function getfur() {
    return $this->fur;
}
public function setfur($fur){
     $this->fur = $fur;
}
public function getpap() {
    return $this->pap_anterior;
}
public function setpap($pap_anterior){
     $this->pap_anterior = $pap_anterior;
}

public function getpac() {
    return $this->id_paciente;
}
public function setpac($id_paciente){
     $this->id_paciente = $id_paciente;
}

public function getrequiereih() {
    return $this->requiere_ih;
}
public function setrequiereih($requiere_ih){
     $this->requiere_ih = $requiere_ih;
}

public function getdiag() {
    return $this->diag;
}
public function setdiag($diag){
     $this->diag = $diag;
}

public function getdiagccv() {
    return $this->id_diagccv;
}
public function setdiagccv($id_diagccv){
     $this->id_diagccv = $id_diagccv;
}

public function getidcodigo() {
    return $this->id_codigo;
}
public function setidcodigo($id_codigo){
     $this->id_codigo = $id_codigo;
}

public function getconclu() {
    return $this->conclusion;
}
public function setconclu($conclusion){
     $this->conclusion = $conclusion;
}

public function getresgeneral() {
    return $this->res_general;
}
public function setresgeneral($res_general){
     $this->res_general = $res_general;
}

public function getnumero() {
    return $this->numero;
}
public function setnumero($numero){
     $this->numero = $numero;
}

public function getcreacion() {
    return $this->creacion;
}
public function setcreacion($creacion){
     $this->creacion = $creacion;
}

public function getmodificamacro() {
    return $this->modificamacro;
}
public function setmodificamacro($modificamacro){
     $this->modificamacro = $modificamacro;
}

public function getmodificamacroce() {
    return $this->modificamacroce;
}
public function setmodificamacroce($modificamacroce){
     $this->modificamacroce = $modificamacroce;
}

public function getmodificamacroih() {
    return $this->modificamacroih;
}
public function setmodificamacroih($modificamacroih){
     $this->modificamacroih = $modificamacroih;
}

public function getresultadoce() {
    return $this->resultado;
}
public function setresultadoce($resultado){
     $this->resultado = $resultado;
}

public function gettopg() {
    return $this->id_top;
}
public function settopg($id_top){
     $this->id_top = $id_top;
}

public function getidinst() {
    return $this->id_institucion;
}
public function setidinst($id_institucion){
     $this->id_institucion = $id_institucion;
}

public function getdepid() {
    return $this->dep_id;
}
public function setdepid($dep_id){
     $this->dep_id = $dep_id;
}

public function gettipoest() {
    return $this->tipo_estudio;
}
public function settipoest($tipo_estudio){
     $this->tipo_estudio = $tipo_estudio;
}

public function getidproc() {
    return $this->id_proc;
}
public function setidproc($id_proc){
     $this->id_proc = $id_proc;
}

public function getusrbio() {
    return $this->id_usuario;
}
public function setusrbio($id_usuario){
     $this->id_usuario = $id_usuario;
}

public function getfechabio() {
    return $this->fecha_registrobio;
}
public function setfechabio($fecha_registrobio){
     $this->fecha_registrobio = $fecha_registrobio;
}

public function getmuestra1() {
    return $this->muestra1;
}
public function setmuestra1($muestra1){
     $this->muestra1 = $muestra1;
}

public function getmuestra2() {
    return $this->muestra2;
}
public function setmuestra2($muestra2){
     $this->muestra2 = $muestra2;
}

public function getmuestra3() {
    return $this->muestra3;
}
public function setmuestra3($muestra3){
     $this->muestra3 = $muestra3;
}

public function getmuestra4() {
    return $this->muestra4;
}
public function setmuestra4($muestra4){
     $this->muestra4 = $muestra4;
}

public function getmuestra5() {
    return $this->muestra5;
}
public function setmuestra5($muestra5){
     $this->muestra5 = $muestra5;
}

public function getmuestra6() {
    return $this->muestra6;
}
public function setmuestra6($muestra6){
     $this->muestra6 = $muestra6;
}

public function getmuestra7() {
    return $this->muestra7;
}
public function setmuestra7($muestra7){
     $this->muestra7 = $muestra7;
}

public function getmuestra8() {
    return $this->muestra8;
}
public function setmuestra8($muestra8){
     $this->muestra8 = $muestra8;
}

public function getmuestra9() {
    return $this->muestra9;
}
public function setmuestra9($muestra9){
     $this->muestra9 = $muestra9;
}

public function getmuestra10() {
    return $this->muestra10;
}
public function setmuestra10($muestra10){
     $this->muestra10 = $muestra10;
}

public function getmuestra11() {
    return $this->muestra11;
}
public function setmuestra11($muestra11){
     $this->muestra11 = $muestra11;
}

public function getmuestra12() {
    return $this->muestra12;
}
public function setmuestra12($muestra12){
     $this->muestra12 = $muestra12;
}

public function getmuestra13() {
    return $this->muestra13;
}
public function setmuestra13($muestra13){
     $this->muestra13 = $muestra13;
}

public function getmuestra14() {
    return $this->muestra14;
}
public function setmuestra14($muestra14){
     $this->muestra14 = $muestra14;
}

public function getmuestra15() {
    return $this->muestra15;
}
public function setmuestra15($muestra15){
     $this->muestra15 = $muestra15;
}

public function getmuestra16() {
    return $this->muestra16;
}
public function setmuestra16($muestra16){
     $this->muestra16 = $muestra16;
}

public function getmuestra17() {
    return $this->muestra17;
}
public function setmuestra17($muestra17){
     $this->muestra17 = $muestra17;
}

public function getmuestra18() {
    return $this->muestra18;
}
public function setmuestra18($muestra18){
     $this->muestra18 = $muestra18;
}

public function getmuestra19() {
    return $this->muestra19;
}
public function setmuestra19($muestra19){
     $this->muestra19 = $muestra19;
}

public function getmuestra20() {
    return $this->muestra20;
}
public function setmuestra20($muestra20){
     $this->muestra20 = $muestra20;
}

public function getidmue1() {
    return $this->idmuestra1;
}
public function setidmue1($idmuestra1){
     $this->idmuestra1 = $idmuestra1;
}

public function getidmue2() {
    return $this->idmuestra2;
}
public function setidmue2($idmuestra2){
     $this->idmuestra2 = $idmuestra2;
}

public function getidmue3() {
    return $this->idmuestra3;
}
public function setidmue3($idmuestra3){
     $this->idmuestra3 = $idmuestra3;
}

public function getidmue4() {
    return $this->idmuestra4;
}
public function setidmue4($idmuestra4){
     $this->idmuestra4 = $idmuestra4;
}

public function getidmue5() {
    return $this->idmuestra5;
}
public function setidmue5($idmuestra5){
     $this->idmuestra5 = $idmuestra5;
}

public function getidmue6() {
    return $this->idmuestra6;
}
public function setidmue6($idmuestra6){
     $this->idmuestra6 = $idmuestra6;
}

public function getidmue7() {
    return $this->idmuestra7;
}
public function setidmue7($idmuestra7){
     $this->idmuestra7 = $idmuestra7;
}

public function getidmue8() {
    return $this->idmuestra8;
}
public function setidmue8($idmuestra8){
     $this->idmuestra8 = $idmuestra8;
}

public function getidmue9() {
    return $this->idmuestra9;
}
public function setidmue9($idmuestra9){
     $this->idmuestra9 = $idmuestra9;
}

public function getidmue10() {
    return $this->idmuestra10;
}
public function setidmue10($idmuestra10){
     $this->idmuestra10 = $idmuestra10;
}

public function getidmue11() {
    return $this->idmuestra11;
}
public function setidmue11($idmuestra11){
     $this->idmuestra11 = $idmuestra11;
}

public function getidmue12() {
    return $this->idmuestra12;
}
public function setidmue12($idmuestra12){
     $this->idmuestra12 = $idmuestra12;
}

public function getidmue13() {
    return $this->idmuestra13;
}
public function setidmue13($idmuestra13){
     $this->idmuestra13 = $idmuestra13;
}

public function getidmue14() {
    return $this->idmuestra14;
}
public function setidmue14($idmuestra14){
     $this->idmuestra14 = $idmuestra14;
}

public function getidmue15() {
    return $this->idmuestra15;
}
public function setidmue15($idmuestra15){
     $this->idmuestra15 = $idmuestra15;
}

public function getidmue16() {
    return $this->idmuestra16;
}
public function setidmue16($idmuestra16){
     $this->idmuestra16 = $idmuestra16;
}

public function getidmue17() {
    return $this->idmuestra17;
}
public function setidmue17($idmuestra17){
     $this->idmuestra17 = $idmuestra17;
}

public function getidmue18() {
    return $this->idmuestra18;
}
public function setidmue18($idmuestra18){
     $this->idmuestra18 = $idmuestra18;
}

public function getidmue19() {
    return $this->idmuestra19;
}
public function setidmue19($idmuestra19){
     $this->idmuestra19 = $idmuestra19;
}

public function getidmue20() {
    return $this->idmuestra20;
}
public function setidmue20($idmuestra20){
     $this->idmuestra20 = $idmuestra20;
}

public function getestadobiopsia() {
    return $this->estado_biopsia;
}
public function setestadobiopsia($estado_biopsia){
     $this->estado_biopsia = $estado_biopsia;
}

public function getestgesta() {
    return $this->estget;
}
public function setestgesta($estget){
     $this->estget = $estget;
}

public function getmedopc() {
    return $this->medico_opcional;
}
public function setmedopc($medico_opcional){
     $this->medico_opcional = $medico_opcional;
}

public function eliminarM($id_marc_prueba) {
        $stmt = $this->objPDO->prepare('DELETE from sisanatom.marcador_prueba where id_marc_prueba=:id_marc_prueba');
        $rows = $stmt->execute(array('id_marc_prueba' => $id_marc_prueba));
    } 
    
}

?>