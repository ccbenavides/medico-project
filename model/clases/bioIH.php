<?php
require_once 'conexion.php';

class bioIH{
	
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
	 private $id_ar_top;

	 function __construct($id_biopsia ="",$num_biopsia="",$id_inst="",$dep_id="",$fecha_ingreso="",$id_usuario="",$estado="",$id_paciente ="",$pago_paciente="",$id_ar_top="") {
        $this->id_biopsia = $id_biopsia;
        $this->num_biopsia = $num_biopsia;
        $this->id_inst=$id_inst;
        $this->dep_id = $dep_id;
        $this->fecha_ingreso=$fecha_ingreso;
        $this->id_usuario=$id_usuario;
        $this->estado=$estado;
        $this->id_paciente = $id_paciente;
        $this->pago_paciente = $pago_paciente;
        $this->id_ar_top = $id_ar_top;
        $this->objPDO = new Conexion();
    }

    public function listarBiopsiasIH() {

        $stmt = $this->objPDO->prepare("SELECT m.id_biopsia,m.num_biopsia,pac.dni,(pac.nombre||' '||pac.a_paterno||' '||pac.a_materno)as nombre,
                                        d.dep_descr as servicio,m.fecha_ingreso::date as Fecha_Ingreso,i.descr_institucion as institucion
                                                from sisanatom.biopsia m inner join sisanatom.det_bioih dm on m.id_biopsia=dm.id_biopsia inner join empleados e on
                                        m.medico_tratante = e.emp_id inner join sisanatom.institucion i on m.id_institucion = i.id_institucion inner join sisanatom.usuarios_anat ua
                                        on m.id_usuario = ua.id_usuario inner join dependencias d on m.dep_id=d.dep_id inner join sisanatom.topografia_area art on m.id_top = art.id_top
                                        inner join sisanatom.area ar on art.id_area=ar.id_area inner join sisemer.paciente pac on m.id_paciente = pac.id_paciente 
                                        inner join sisemer.ubigeo u on pac.id_ubigeo = u.id_ubigeo inner join
                                        sisemer.tipo_paciente tp on pac.id_tipo_paciente = tp.id_tipo_paciente inner join grupoocup gp on pac.goc_id = gp.goc_id
                                        where ar.descr_area='Inmunohistoquimica' and m.condicion_biopsia='A' and m.estado_biopsia=1 order by m.num_biopsia asc");
        $stmt->execute();
        $pacih = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $pacih;
    }
    
    public function listarfinbioIH(){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,db.fecha_informe,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,
                            list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                            inner join sisanatom.detalle_bioih db on b.id_biopsia=db.id_biopsia
                            inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                            inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                            where b.estado_biopsia=3 and b.condicion_biopsia='A'
                            group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,db.fecha_informe,medico");
        $stmt->execute();
        $finbioih=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $finbioih;
    }

    public function modificarmacro($id_biopsia,$macro_ih,$tecnologo,$usureg_macroih,$fechareg_macroih){
    
    $sql = "UPDATE sisanatom.detalle_bioih set macro_ih=:macro_ih,tecnologo=:tecnologo,usureg_macroih=:usureg_macroih,fechareg_macroih=:fechareg_macroih
            where id_biopsia =:id_biopsia;";

    $stmt = $this->objPDO->prepare($sql);

        try{
            $stmt->execute(array('id_biopsia'=> $id_biopsia,'macro_ih'=>$macro_ih,'tecnologo'=>$tecnologo,'usureg_macroih'=>$usureg_macroih,'fechareg_macroih'=>$fechareg_macroih));
            return true;
        }catch(PDOExeception $e){
            return false;
        }
    }

    public function getmacroih($id_biopsia){
        $stmt=$this->objPDO->prepare("SELECT ih.macro_ih,(ep.emp_nombres||' '||ep.emp_appaterno||' '||ep.emp_apmaterno)as tecnologo from sisanatom.detalle_bioih ih 
                            inner join empleados ep on ih.tecnologo=ep.emp_id where ih.id_biopsia=:id_biopsia");
        $stmt->execute(array('id_biopsia' => $id_biopsia));
        $bmac=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $bmac; 
    }

    public function modificardiag($id_biopsia,$id_muestrabio,$diag_final,$usuario_diagfinal,$fecha_diagfinal){
        
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

    public function getdiagih($id_biopsia){
        $stmt=$this->objPDO->prepare("SELECT m.descr_muestra as muestra_remitida,diag_final from sisanatom.muestras_biopsia mb inner join
                                      sisanatom.muestra m on mb.id_muestrarem=m.id_muestra
                                      where id_biopsia=:id_biopsia");
        $stmt->execute(array('id_biopsia' => $id_biopsia));
        $diagih=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $diagih; 
    }

    public function marcadoresxbiopsia($id_biopsia){
        $stmt=$this->objPDO->prepare("SELECT mp.id_marc_prueba,m.descr_marcador from sisanatom.marcador_prueba mp inner join sisanatom.marcador m on m.id_marcador=mp.marcador
                                inner join sisanatom.control_pruebasih cp on mp.prueba=cp.id_control inner join sisanatom.biopsia bio on cp.id_biopsia=bio.id_biopsia
                                where bio.id_biopsia=:id_biopsia order by mp.id_marc_prueba");
        $stmt->execute(array('id_biopsia' =>$id_biopsia));
        $marcxbio=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $marcxbio;
    }

    public function obtresmar($id_marc_prueba){
    $stmt=$this->objPDO->prepare("SELECT resultado from sisanatom.marcador_prueba where id_marc_prueba=:id_marc_prueba");
    $stmt->execute(array('id_marc_prueba'=>$id_marc_prueba));
    $diagmue=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $diagmue[0]->resultado;
}

    public function actualizaresultado($id_marc_prueba,$resultado){
        $sql = "UPDATE sisanatom.marcador_prueba set resultado=:resultado 
        where id_marc_prueba=:id_marc_prueba ;";

        $stmt = $this->objPDO->prepare($sql);

        try{
            $stmt->execute(array('id_marc_prueba'=> $id_marc_prueba,'resultado'=>$resultado));
            return true;
        }catch(PDOExeception $e){
            return false;
        }    
    }

    public function getresultado($id_biopsia){
        $stmt=$this->objPDO->prepare("SELECT mp.id_marc_prueba,m.descr_marcador,mp.resultado from sisanatom.marcador_prueba mp inner join sisanatom.marcador m on m.id_marcador=mp.marcador
                                    inner join sisanatom.control_pruebasih cp on mp.prueba=cp.id_control inner join sisanatom.biopsia bio on cp.id_biopsia=bio.id_biopsia
                                    where bio.id_biopsia=:id_biopsia order by m.descr_marcador");
        $stmt->execute(array('id_biopsia'=>$id_biopsia));
        $result=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function actualizaconclusion($id_biopsia,$conclusion,$valida_patologo,$fecha_informe){

        $sql = "UPDATE sisanatom.detalle_bioih set conclusion=:conclusion,valida_patologo=:valida_patologo,fecha_informe=:fecha_informe
            where id_biopsia =:id_biopsia ;";

        $stmt = $this->objPDO->prepare($sql);

        try{
            $stmt->execute(array('id_biopsia'=> $id_biopsia,'conclusion'=>$conclusion,'valida_patologo'=>$valida_patologo,'fecha_informe'=>$fecha_informe));
            return true;
        }catch(PDOExeception $e){
            return false;
        } 

    }

    public function actualizaregconclu($id_biopsia,$usu_regconclu,$fecha_regconclu){
    $sql = "UPDATE sisanatom.detalle_bioih set usu_regconclu=:usu_regconclu,fecha_regconclu=:fecha_regconclu
            where id_biopsia =:id_biopsia;";

    $stmt = $this->objPDO->prepare($sql);

        try{
            $stmt->execute(array('id_biopsia'=> $id_biopsia,'usu_regconclu'=>$usu_regconclu,'fecha_regconclu'=>$fecha_regconclu));
            return true;
        }catch(PDOExeception $e){
            return false;
        }   
}

    public function getconclusion($id_biopsia){

        $stmt=$this->objPDO->prepare("SELECT bih.conclusion,(ep.emp_nombres||' '||ep.emp_appaterno||' '||ep.emp_apmaterno) as patologo,bih.fecha_informe from sisanatom.detalle_bioih bih inner join sisanatom.biopsia bio 
                                        on bih.id_biopsia=bio.id_biopsia inner join empleados ep on ep.emp_id=bih.valida_patologo
                                        where bio.id_biopsia=:id_biopsia");
        $stmt->execute(array('id_biopsia'=>$id_biopsia));
        $concl=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $concl;
    }

    public function obtenerinfpacih($id_biopsia){
        $stmt=$this->objPDO->prepare("SELECT bio.num_biopsia,pac.dni,(pac.nombre||' '||pac.a_paterno||' '||pac.a_materno)as paciente,(pac.edad||' años') as edad,
                                (case when pac.sexo='1' then 'FEMENINO' when pac.sexo='0' then 'MASCULINO' end) as sexo,('DISTRITO DE '||ub.distrito) as procedencia,dp.dep_descr as servicio,
                                bio.diag_inicial as diagnostico,bio.medico_tratante,bio.medico_opcional,bio.observacion,(ep.emp_nombres||' '||ep.emp_appaterno||' '||ep.emp_apmaterno) as patologo,ep.emp_colegiatura,ep.emp_rne,
                                ((EXTRACT (DAY FROM bio.fecha_biopsia))||'/'||(EXTRACT (MONTH FROM bio.fecha_biopsia))||'/'||(EXTRACT (YEAR FROM bio.fecha_biopsia))) AS fecha_biopsia,
                                ((EXTRACT (DAY FROM pq.fecha_informe))||'/'||(EXTRACT (MONTH FROM pq.fecha_informe))||'/'||(EXTRACT (YEAR FROM pq.fecha_informe))) AS fecha_informe
                                from sisanatom.biopsia bio inner join sisemer.paciente pac on bio.id_paciente=pac.id_paciente left join sisemer.ubigeo ub on pac.id_ubigeo=ub.id_ubigeo
                                inner join dependencias dp ON bio.dep_id=dp.dep_id inner join sisanatom.detalle_bioih pq ON bio.id_biopsia=pq.id_biopsia
                                inner join empleados ep ON bio.patologo_responsable=ep.emp_id
                                where bio.id_biopsia=:id_biopsia");
        $stmt->execute(array('id_biopsia'=>$id_biopsia));
        $infih=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $infih;
    }

    /*obtener la macroscopia de una biopsia para el informe*/
    public function obtenermacroih($id_biopsia){
        $stmt=$this->objPDO->prepare("SELECT macro_ih as macroscopia from sisanatom.detalle_bioih where id_biopsia=:id_biopsia");
        $stmt->execute(array('id_biopsia'=>$id_biopsia));
        $macrobio=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $macrobio;
    }

    /*obtener la macroscopia de una biopsia para el informe*/
    public function obtenerconclusionih($id_biopsia){
        $stmt=$this->objPDO->prepare("SELECT conclusion from sisanatom.detalle_bioih where id_biopsia=:id_biopsia");
        $stmt->execute(array('id_biopsia'=>$id_biopsia));
        $conclusionbio=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $conclusionbio;
    }

    public function obtenerresgeneralih($id_biopsia){
        $stmt=$this->objPDO->prepare("SELECT res_general from sisanatom.detalle_bioih where id_biopsia=:id_biopsia");
        $stmt->execute(array('id_biopsia'=>$id_biopsia));
        $resgeneralbio=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $resgeneralbio;
    }

    public function getresultadogen($id_biopsia){

        $stmt=$this->objPDO->prepare("SELECT bih.res_general from sisanatom.detalle_bioih bih inner join sisanatom.biopsia bio 
                                        on bih.id_biopsia=bio.id_biopsia 
                                        where bio.id_biopsia=:id_biopsia");
        $stmt->execute(array('id_biopsia'=>$id_biopsia));
        $resultgen=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $resultgen;
    }

    public function actualizaresultadoGen($id_biopsia,$res_general){

        $sql = "UPDATE sisanatom.detalle_bioih set res_general=:res_general
            where id_biopsia =:id_biopsia ;";

        $stmt = $this->objPDO->prepare($sql);

        try{
            $stmt->execute(array('id_biopsia'=> $id_biopsia,'res_general'=>$res_general));
            return true;
        }catch(PDOExeception $e){
            return false;
        } 

    }

    public function eliminarM($id_marc_prueba) {
        $stmt = $this->objPDO->prepare('DELETE from sisanatom.marcador_prueba where id_marc_prueba=:id_marc_prueba');
        $rows = $stmt->execute(array('id_marc_prueba' => $id_marc_prueba));
    } 
    
	}
?>