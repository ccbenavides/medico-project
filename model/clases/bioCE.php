<?php
require_once 'conexion.php';

class bioCE{
	
	 private $objPDO;
	 private $id_biopsia;
	 private $id_paciente;
	 private $num_biopsia;
	 private $id_institucion;
	 private $dep_id;
	 private $fecha_ingreso;
	 private $id_usuario;
	 private $estado;
	 private $pago_paciente;
	 private $fecha_biopsia;
	 private $servicio;
	 private $institucion;
	 private $medico_tratante;
	 private $pago;
	 private $dni;
	 private $fecha_informe;
	 private $observacion;
	 private $id_tipo;//para saber si es biopsia o pieza quirurgica
	 private $diagnostico_final;
	 private $macroscopia;
	 private $tecnologo;
	 private $patologo;
	 private $num_laminas;
	 private $num_tacos;
	 private $id_res;//dato para saber el resultado de biopsia ya sea displasia o cancer
	 

	 function __construct($id_biopsia ="",$num_biopsia="",$id_institucion="",$dep_id="",$fecha_ingreso="",$id_usuario="",$estado="",$id_paciente ="",$pago_paciente="",$id_ar_top="") {
        $this->id_biopsia = $id_biopsia;
        $this->num_biopsia = $num_biopsia;
        $this->id_institucion=$id_institucion;
        $this->dep_id = $dep_id;
        $this->fecha_ingreso=$fecha_ingreso;
        $this->id_usuario=$id_usuario;
        $this->estado=$estado;
        $this->id_paciente = $id_paciente;
        $this->pago_paciente = $pago_paciente;
        
        $this->objPDO = new Conexion();
    }

    public function listarBiopsiasCE() {

        $stmt = $this->objPDO->prepare("SELECT m.id_biopsia,m.num_biopsia,pac.dni,(pac.nombre||' '||pac.a_paterno||' '||pac.a_materno)as nombre,
                                        d.dep_descr as servicio,m.fecha_ingreso::date as Fecha_Ingreso,i.descr_institucion as institucion
                                                from sisanatom.biopsia m inner join sisanatom.detbio_ce dm on m.id_biopsia=dm.id_biopsia inner join empleados e on
                                        m.medico_tratante = e.emp_id inner join sisanatom.institucion i on m.id_institucion = i.id_institucion inner join sisanatom.usuarios_anat ua
                                        on m.id_usuario = ua.id_usuario inner join dependencias d on m.dep_id=d.dep_id inner join sisanatom.topografia_area art on m.id_top = art.id_top
                                        inner join sisanatom.area ar on art.id_area=ar.id_area inner join sisemer.paciente pac on m.id_paciente = pac.id_paciente 
                                        inner join sisemer.ubigeo u on pac.id_ubigeo = u.id_ubigeo inner join
                                        sisemer.tipo_paciente tp on pac.id_tipo_paciente = tp.id_tipo_paciente inner join grupoocup gp on pac.goc_id = gp.goc_id
                                        where ar.descr_area='Citologia Especial' and m.condicion_biopsia='A' and m.estado_biopsia=1 order by m.num_biopsia asc");
        $stmt->execute();
        $paccv = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $paccv;
 	}
    //listado de biopsias finalizadas CE
    public function listarbiofinCE(){
        $stmt = $this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,db.fecha_informe,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,
                            list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                            inner join sisanatom.detalle_bioce db on b.id_biopsia=db.id_biopsia
                            inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                            inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                            where b.estado_biopsia=3 and b.condicion_biopsia='A'
                            group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,db.fecha_informe,medico");
        $stmt->execute();
        $pacientes = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $pacientes;
    }
//actualiza los materiales
 	public function actualizarmaterial($id_biopsia,$num_laminas,$num_tacos,$fecha_entmat,$id_usuarioregmat,$fecha_regmat){
    $sql = "UPDATE sisanatom.detalle_bioce set num_laminas=:num_laminas,num_tacos=:num_tacos,fecha_entmat=:fecha_entmat,id_usuarioregmat=:id_usuarioregmat,fecha_regmat=:fecha_regmat
            where id_biopsia =:id_biopsia;";

    $stmt = $this->objPDO->prepare($sql);

        try{
            $stmt->execute(array('id_biopsia'=> $id_biopsia,'num_laminas'=>$num_laminas,'num_tacos'=>$num_tacos,'fecha_entmat'=>$fecha_entmat,'id_usuarioregmat'=>$id_usuarioregmat,'fecha_regmat'=>$fecha_regmat));
            return true;
        }catch(PDOExeception $e){
            return false;
        }
	}

	public function getmateriales($id_biopsia){
        $stmt=$this->objPDO->prepare("SELECT pq.num_laminas,pq.num_tacos,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno)as tecnologo from sisanatom.detalle_bioce pq inner join sisanatom.usuarios_anat ua
                            on pq.id_usuarioregmat=ua.id_usuario inner join empleados e on ua.emp_id=e.emp_id where pq.id_biopsia=:id_biopsia");
        $stmt->execute(array('id_biopsia' => $id_biopsia));
        $bmat=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $bmat; 
	}

    //obtener laminas de biopsia CE
    public function obtlamce($id_biopsia){
        $stmt=$this->objPDO->prepare("SELECT num_laminas from sisanatom.detalle_bioce where id_biopsia=:id_biopsia");
        $stmt->execute(array('id_biopsia'=>$id_biopsia));
        $ltpq=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $ltpq[0]->num_laminas;
    }

    //obtener tacos de biopsia CE
    public function obttacce($id_biopsia){
        $stmt=$this->objPDO->prepare("SELECT num_tacos from sisanatom.detalle_bioce where id_biopsia=:id_biopsia");
        $stmt->execute(array('id_biopsia'=>$id_biopsia));
        $tacospq=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $tacospq[0]->num_tacos;
    }

    //obtener macroscopia de biopsia CE
    public function obtmacroscopiace($id_biopsia){
        $stmt=$this->objPDO->prepare("SELECT macroscopia from sisanatom.detalle_bioce where id_biopsia=:id_biopsia");
        $stmt->execute(array('id_biopsia'=>$id_biopsia));
        $macropq=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $macropq[0]->macroscopia;
    }

    public function actualizarmacro($id_biopsia,$macroscopia,$usureg_macroce,$fechareg_macroce){
       $sql = "UPDATE sisanatom.detalle_bioce set macroscopia=:macroscopia,usureg_macroce=:usureg_macroce,fechareg_macroce=:fechareg_macroce
            where id_biopsia =:id_biopsia;";

        $stmt = $this->objPDO->prepare($sql);

            try{
                $stmt->execute(array('id_biopsia'=> $id_biopsia,'macroscopia'=>$macroscopia,'usureg_macroce'=>$usureg_macroce,'fechareg_macroce'=>$fechareg_macroce));
                return true;
            }catch(PDOExeception $e){
                return false;
            } 
    }

    public function getmacro1($id_biopsia){
        $stmt=$this->objPDO->prepare("SELECT macroscopia from sisanatom.detalle_bioce bpq
                                    inner join sisanatom.biopsia b on b.id_biopsia=bpq.id_biopsia
                                    where bpq.id_biopsia=:id_biopsia and b.estado_biopsia=2");
        $stmt->execute(array('id_biopsia'=>$id_biopsia));
        $macros1=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $macros1;
    }

    public function getmacro($id_biopsia){
        $stmt=$this->objPDO->prepare("SELECT macroscopia from sisanatom.detalle_bioce where id_biopsia=:id_biopsia");
        $stmt->execute(array('id_biopsia'=>$id_biopsia));
        $macros=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $macros;
    }

    public function actualizaregres($id_biopsia,$fecha_regresultce){
        $sql = "UPDATE sisanatom.detalle_bioce set fecha_regresultce=:fecha_regresultce
                where id_biopsia =:id_biopsia;";

        $stmt = $this->objPDO->prepare($sql);

            try{
                $stmt->execute(array('id_biopsia'=> $id_biopsia,'fecha_regresultce'=>$fecha_regresultce));
                return true;
            }catch(PDOExeception $e){
                return false;
            }   
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

    public function getdiag($id_biopsia){
            $stmt=$this->objPDO->prepare("SELECT m.descr_muestra as muestra_remitida,diag_final,descrip_muestce from sisanatom.muestras_biopsia mb 
                                        inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                        where id_biopsia=:id_biopsia");
            $stmt->execute(array('id_biopsia' => $id_biopsia));
            $bdi=$stmt->fetchAll(PDO::FETCH_OBJ);
            return $bdi; 
    }

    public function actualizaresultado($id_biopsia,$resultado,$valida_patologo,$fecha_informe){
         
         $sql = "UPDATE sisanatom.detalle_bioce set resultado=:resultado,valida_patologo=:valida_patologo,fecha_informe=:fecha_informe
                where id_biopsia =:id_biopsia;";

         $stmt = $this->objPDO->prepare($sql);

            try{
                $stmt->execute(array('id_biopsia'=> $id_biopsia,'resultado'=>$resultado,'valida_patologo'=>$valida_patologo,'fecha_informe'=>$fecha_informe));
                return true;
            }catch(PDOExeception $e){
                return false;
            } 
    }

    public function getresultado($id_biopsia){
        $stmt=$this->objPDO->prepare("SELECT r.descr_res as resultado,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno)as patologo,ce.fecha_informe
                                from sisanatom.detalle_bioce ce inner join empleados e on ce.valida_patologo=e.emp_id inner join sisanatom.result_bio r on ce.resultado=r.id_res
                                where ce.id_biopsia=:id_biopsia");
        $stmt->execute(array('id_biopsia'=>$id_biopsia));
        $resbio=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $resbio;
    }
    /*informacion para reporte de informe de biopsia para el paciente */
    public function obtenerinfpace($id_biopsia){
    $stmt=$this->objPDO->prepare("SELECT bio.num_biopsia,pac.dni,(pac.nombre||' '||pac.a_paterno||' '||pac.a_materno)as paciente,(pac.edad||' años') as edad,
                                (case when pac.sexo='1' then 'FEMENINO' when pac.sexo='0' then 'MASCULINO' end) as sexo,('DISTRITO DE '||ub.distrito) as procedencia,dp.dep_descr as servicio,
                                bio.diag_inicial as diagnostico,bio.medico_tratante,bio.medico_opcional,bio.observacion,(ep.emp_nombres||' '||ep.emp_appaterno||' '||ep.emp_apmaterno) as patologo,ep.emp_colegiatura,ep.emp_rne,
                                ((EXTRACT (DAY FROM bio.fecha_biopsia))||'/'||(EXTRACT (MONTH FROM bio.fecha_biopsia))||'/'||(EXTRACT (YEAR FROM bio.fecha_biopsia))) AS fecha_biopsia,
                                ((EXTRACT (DAY FROM pq.fecha_informe))||'/'||(EXTRACT (MONTH FROM pq.fecha_informe))||'/'||(EXTRACT (YEAR FROM pq.fecha_informe))) AS fecha_informe
                                from sisanatom.biopsia bio inner join sisemer.paciente pac on bio.id_paciente=pac.id_paciente left join sisemer.ubigeo ub on pac.id_ubigeo=ub.id_ubigeo
                                inner join dependencias dp ON bio.dep_id=dp.dep_id inner join sisanatom.detalle_bioce pq ON bio.id_biopsia=pq.id_biopsia
                                inner join empleados ep ON bio.patologo_responsable=ep.emp_id
                                where bio.id_biopsia=:id_biopsia");
    $stmt->execute(array('id_biopsia'=>$id_biopsia));
    $informepac=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $informepac;
    }
    /*cantidad de diagnostico clinico de una biopsia*/
    public function cantinfce($id_biopsia){
        $stmt=$this->objPDO->prepare("SELECT bio.num_biopsia,pac.dni,(pac.nombre||' '||pac.a_paterno||' '||pac.a_materno)as paciente,(((select now()::date - pac.fecha_nacimiento::date)/365)||' '||' años') as edad,
                                (case when pac.sexo='1' then 'FEMENINO' when pac.sexo='0' then 'MASCULINO' end) as sexo,('DISTRITO DE '||ub.distrito) as procedencia,dp.dep_descr as servicio,
                                bio.diag_inicial as diagnostico,bio.medico_tratante,bio.observacion,(ep.emp_nombres||' '||ep.emp_appaterno||' '||ep.emp_apmaterno) as patologo,ep.emp_colegiatura,
                                ((EXTRACT (DAY FROM bio.fecha_biopsia))||'/'||(EXTRACT (MONTH FROM bio.fecha_biopsia))||'/'||(EXTRACT (YEAR FROM bio.fecha_biopsia))) AS fecha_biopsia,
                                ((EXTRACT (DAY FROM pq.fecha_informe))||'/'||(EXTRACT (MONTH FROM pq.fecha_informe))||'/'||(EXTRACT (YEAR FROM pq.fecha_informe))) AS fecha_informe
                                from sisanatom.biopsia bio inner join sisemer.paciente pac on bio.id_paciente=pac.id_paciente left join sisemer.ubigeo ub on pac.id_ubigeo=ub.id_ubigeo
                                inner join dependencias dp ON bio.dep_id=dp.dep_id inner join sisanatom.detalle_bioce pq ON bio.id_biopsia=pq.id_biopsia
                                inner join empleados ep ON bio.patologo_responsable=ep.emp_id
                                where bio.id_biopsia=:id_biopsia");
        $stmt->execute(array('id_biopsia'=>$id_biopsia));
        $mydiag=$stmt->rowCount();
        return $mydiag;
    }
    /*obtener macroscopia de una biopsia de citologia especial para informe de paciente*/
    public function obtmacroce($id_biopsia){
        $stmt=$this->objPDO->prepare("SELECT macroscopia from sisanatom.detalle_bioce where id_biopsia=:id_biopsia");
        $stmt->execute(array('id_biopsia'=>$id_biopsia));
        $macros=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $macros;
    }

    /*obtener requiere_ih de biopsia*/
    public function obtrequiereih($id_biopsia){
        $stmt=$this->objPDO->prepare("SELECT requiere_ih as requeridoih from sisanatom.detalle_bioce where id_biopsia=:id_biopsia");
        $stmt->execute(array('id_biopsia'=>$id_biopsia));
        $reqbio=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $reqbio[0]->requeridoih;
    }


	}
?>