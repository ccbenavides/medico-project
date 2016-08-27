<?php
require_once 'conexion.php';

class bioCCV{
	
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
	 private $id_detalle;
	 private $fecha;
	 private $fecha_informe;
	 private $gestante;
	 private $id_mue_rem;
	 private $pap_anterior;
	 private $diagnostico_clinico;
	 private $observacion;
	 private $gesta;
	 private $para;
	 private $mac;
	 private $fur;
	 private $id_diag;
	 private $id_codigo;
	 private $descripcion;
	 private $tecnologo;
	 private $patologo;

	 function __construct($id_biopsia ="",$num_biopsia="",$id_inst="",$dep_id="",$fecha_ingreso="",$id_usuario="",$estado="",
	 					  $id_paciente ="",$pago_paciente="",$id_ar_top="",$id_detalle="",$fecha="",$fecha_informe="",$gestante="",
	 					  $id_mue_rem="",$pap_anterior="",$diagnostico_clinico="",$observacion="",$gesta="",$para="",$mac="",$fur="",
	 					  $id_diag="",$id_codigo="",$descripcion="",$tecnologo="",$patologo="") {
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
        $this->id_detalle = $id_detalle;
        $this->fecha = $fecha;
        $this->fecha_informe = $fecha_informe;
        $this->gestante = $gestante;
        $this->id_mue_rem = $id_mue_rem;
        $this->pap_anterior = $pap_anterior;
        $this->diagnostico_clinico = $diagnostico_clinico;
        $this->observacion = $observacion;
        $this->gesta = $gesta;
        $this->para = $para;
        $this->mac = $mac;
        $this->fur = $fur;
        $this->id_diag = $id_diag;
        $this->id_codigo = $id_codigo;
        $this->descripcion = $descripcion;
        $this->tecnologo = $tecnologo;
        $this->patologo = $patologo;
        $this->objPDO = new Conexion();
    }

    public function listarBiopsiasCCV() {

        $stmt = $this->objPDO->prepare("SELECT m.id_biopsia,m.num_biopsia,pac.dni,(pac.nombre||' '||pac.a_paterno||' '||pac.a_materno)as nombre,
                                        d.dep_descr as servicio,m.fecha_ingreso::date as Fecha_Ingreso,i.descr_institucion as institucion
                                        from sisanatom.biopsia m inner join sisanatom.detbio_ccv dm on m.id_biopsia=dm.id_biopsia inner join empleados e on
                                        m.medico_tratante = e.emp_id inner join sisanatom.institucion i on m.id_institucion = i.id_institucion inner join sisanatom.usuarios_anat ua
                                        on m.id_usuario = ua.id_usuario inner join dependencias d on m.dep_id=d.dep_id inner join sisanatom.topografia_area art on m.id_top = art.id_top
                                        inner join sisanatom.area ar on art.id_area=ar.id_area inner join sisemer.paciente pac on m.id_paciente = pac.id_paciente 
                                        inner join sisemer.ubigeo u on pac.id_ubigeo = u.id_ubigeo inner join
                                        sisemer.tipo_paciente tp on pac.id_tipo_paciente = tp.id_tipo_paciente inner join grupoocup gp on pac.goc_id = gp.goc_id
                                        where ar.descr_area='Citologia Cervico Vaginal' and  m.condicion_biopsia='A' and m.estado_biopsia=1 order by m.num_biopsia asc");
        $stmt->execute();
        $paccv = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $paccv;
 	}
 	
 	public function listardiagPPA(){
 		$stmt = $this->objPDO->prepare("SELECT * FROM sisanatom.diagnostico_ccv order by descr_diagccv");
 		$stmt->execute();
 		$listdiag = $stmt->fetchAll(PDO::FETCH_OBJ);
 		return $listdiag;
 	}

 	public function listarcodbet(){
 		$stmt = $this->objPDO->prepare("SELECT * FROM sisanatom.codigo_bethesda");
 		$stmt->execute();
 		$listcod = $stmt->fetchAll(PDO::FETCH_OBJ);
 		return $listcod;
 	}

    public function actualizarDiagnostico($id_biopsia, $id_codigo,$otro_codbet,$id_diagccv,$usu_regdiagcod,$fecha_regdiagcod){

        $sql = "UPDATE sisanatom.detalle_bioccv set id_codigo=:id_codigo,otro_codbet=:otro_codbet,id_diagccv=:id_diagccv,usu_regdiagcod=:usu_regdiagcod,fecha_regdiagcod=:fecha_regdiagcod
               where id_biopsia =:id_biopsia;";

        $stmt = $this->objPDO->prepare($sql);

        try{
            $stmt->execute(array('id_biopsia' => $id_biopsia,'id_codigo'=>$id_codigo,'otro_codbet'=>$otro_codbet,'id_diagccv' => $id_diagccv,'usu_regdiagcod'=>$usu_regdiagcod,'fecha_regdiagcod'=>$fecha_regdiagcod));
            return true;
        }catch(PDOExeception $e){
            return false;
        }
    }

    public function getdiag($id_biopsia){
        $stmt=$this->objPDO->prepare("SELECT dc.descr_diagccv,(case WHEN bc.id_codigo=38 THEN bc.otro_codbet WHEN bc.id_codigo!=38 
                                        THEN co.descr_codigo end)as codigo from sisanatom.detalle_bioccv bc inner join sisanatom.codigo_bethesda co 
                                        on bc.id_codigo=co.id_codigo
                                        inner join sisanatom.diagnostico_ccv dc on bc.id_diagccv=dc.id_diagccv
                                        where id_biopsia=:id_biopsia");
        $stmt->execute(array('id_biopsia' => $id_biopsia));
        $bdiag=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $bdiag;  
    }

    public function actualizarDescripcion($id_biopsia,$tecnologo,$descripcion,$fecha_informe,$usu_regdescrip,$fecha_regdescrip){
        $sql = "UPDATE sisanatom.detalle_bioccv set tecnologo=:tecnologo,descripcion=:descripcion,fecha_informe=:fecha_informe,usu_regdescrip=:usu_regdescrip,fecha_regdescrip=:fecha_regdescrip
             where id_biopsia =:id_biopsia;";
        $stmt = $this->objPDO->prepare($sql);

        try{
            $stmt->execute(array('id_biopsia' => $id_biopsia,'tecnologo'=>$tecnologo,'descripcion'=>$descripcion,'fecha_informe'=>$fecha_informe,'usu_regdescrip'=>$usu_regdescrip,'fecha_regdescrip'=>$fecha_regdescrip));
            return true;
        }catch(PDOExeception $e){
            return false;
        }
    }

    public function getdesc($id_biopsia){
        $stmt=$this->objPDO->prepare("SELECT (ep.emp_nombres||' '||ep.emp_appaterno||' '||ep.emp_apmaterno) as patologo,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as tecnologo,
                                    bc.descripcion,bc.fecha_informe FROM sisanatom.biopsia b inner join empleados ep
                                    on b.patologo_responsable=ep.emp_id inner join sisanatom.detalle_bioccv bc on bc.id_biopsia=b.id_biopsia
                                    inner join empleados e on bc.tecnologo=e.emp_id
                                    where bc.id_biopsia=:id_biopsia");
        $stmt->execute(array('id_biopsia' => $id_biopsia));
        $bdesc=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $bdesc; 
    }

     public function insertarVerificacion($id_biopsia, $valida_patologo, $fecha_informe,$id_usuario,$fecha_validacion){

        $sql = "INSERT INTO sisanatom.biopsia_validaciones(id_biopsia, valida_patologo, fecha_informe,id_usuario,fecha_validacion) VALUES(:id_biopsia, :valida_patologo,:fecha_informe,:id_usuario,:fecha_validacion);";

        $stmt = $this->objPDO->prepare($sql);

        try{
            $stmt->execute(array('id_biopsia' => $id_biopsia, 'valida_patologo' =>  $valida_patologo, 'fecha_informe' => $fecha_informe,'id_usuario'=>$id_usuario,'fecha_validacion'=>$fecha_validacion));
            return true;
        }catch(PDOExeception $e){
            return false;
        }
    }
    public function getVerf($id_biopsia){
        $stmt=$this->objPDO->prepare("SELECT (e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno)as patologo,bv.fecha_informe from sisanatom.biopsia_validaciones bv 
                                    inner join empleados e on bv.valida_patologo=e.emp_id where bv.id_biopsia=:id_biopsia");
        $stmt->execute(array('id_biopsia' => $id_biopsia));
        $bver=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $bver; 
    }

    public function actualizarestado($id_biopsia){
        $sql = "UPDATE sisanatom.biopsia set estado_biopsia='2' where id_biopsia =:id_biopsia;";

        $stmt = $this->objPDO->prepare($sql);

        try{
            $stmt->execute(array('id_biopsia' => $id_biopsia));
            return true;
        }catch(PDOExeception $e){
            return false;
        }
    }

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
    
    public function obtenerinfopaccv($id_biopsia){
        $stmt=$this->objPDO->prepare("SELECT bio.num_biopsia,pac.dni,(pac.nombre||' '||pac.a_paterno||' '||pac.a_materno)as paciente,(pac.edad||' años') as edad,
                                (case when pac.sexo='1' then 'FEMENINO' when pac.sexo='0' then 'MASCULINO' end) as sexo,('DISTRITO DE '||ub.distrito) as procedencia,dp.dep_descr as servicio,
                                bio.diag_inicial as diagnostico,bio.medico_tratante,bio.medico_opcional,bio.observacion,(ep.emp_nombres||' '||ep.emp_appaterno||' '||ep.emp_apmaterno) as patologo,ep.emp_colegiatura,ep.emp_rne,
                                ccv.gesta,ccv.para,ccv.mac,ccv.fur,ccv.pap_anterior,m.descr_muestra as muestra_remitida,dcv.descr_diagccv,
                                (case when ccv.otro_codbet='' then cobet.descr_codigo else ccv.otro_codbet end ) as codigo,ccv.descripcion,
                                ((EXTRACT (DAY FROM bio.fecha_biopsia))||'/'||(EXTRACT (MONTH FROM bio.fecha_biopsia))||'/'||(EXTRACT (YEAR FROM bio.fecha_biopsia))) AS fecha_biopsia,
                                ((EXTRACT (DAY FROM ccv.fecha_informe))||'/'||(EXTRACT (MONTH FROM ccv.fecha_informe))||'/'||(EXTRACT (YEAR FROM ccv.fecha_informe))) AS fecha_informe
                                from sisanatom.biopsia bio inner join sisemer.paciente pac on bio.id_paciente=pac.id_paciente left join sisemer.ubigeo ub on pac.id_ubigeo=ub.id_ubigeo
                                inner join dependencias dp ON bio.dep_id=dp.dep_id inner join sisanatom.detalle_bioccv ccv ON bio.id_biopsia=ccv.id_biopsia
                                inner join empleados ep ON bio.patologo_responsable=ep.emp_id inner join sisanatom.muestras_biopsia mbio 
                                on bio.id_biopsia=mbio.id_biopsia inner join sisanatom.muestra m on mbio.id_muestrarem=m.id_muestra 
                                left join sisanatom.codigo_bethesda cobet on ccv.id_codigo=cobet.id_codigo
                                left join sisanatom.diagnostico_ccv dcv on ccv.id_diagccv=dcv.id_diagccv
                                where bio.id_biopsia=:id_biopsia");
        $stmt->execute(array('id_biopsia'=>$id_biopsia));
        $informepaciente=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $informepaciente;
    }
    

 	public function getIdCCV() {
        return $this->id_biopsia;
    }

    public function setIdCCV($id_biopsia){
        $this->id_biopsia=$id_biopsia;
    }

    public function getNumBioCCV(){
    	return $this->num_biopsia;
    }

    public function getIdInstCCV() {
        return $this->id_institucion;
    }

    public function getIdDepCCV() {
        return $this->dep_id;
    }
   
    public function getFecIngCCV(){
    	return $this->fecha_ingreso;
    }
   
    public function getUserCCV(){
    	return $this->id_usuario;
    }

    public function getEstCCV(){
    	return $this->estado;
    }

    public function getPacCCV(){
    	return $this->id_paciente;
    }

    public function getPagoCCV(){
    	return $this->pago_paciente;
    }

    public function getartopCCV(){
    	return $this->id_ar_top;    
    }

    public function getDiagCCV(){
    	return $this->id_diagccv;
    }

    public function getCodCCV(){
    	return $this->id_codigo;
    }
    public function getotrocod(){
        return $this->otro_codbet;
    }

    public function getTecCCV(){
    	return $this->tecnologo;
    }

    public function getPatCCV(){
    	return $this->patologo;
    }

    public function setDiagCCV($id_diagccv) {
        $this->id_diagccv=$id_diagccv;
    }

    public function setCodCCV($id_codigo) {
        $this->id_codigo=$id_codigo;
    }

    public function setotrocod($otro_codbet){
        $this->otro_codbet=$otro_codbet;
    }

    public function setTecCCV($tecnologo) {
        $this->tecnologo=$tecnologo;
    }

    public function setPatCCV($patologo) {
        $this->patologo=$patologo;
    }

	}
?>