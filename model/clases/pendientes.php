<?php
 require_once 'conexion.php';

 class Pendiente{
 	private $objPDO;

 	function __construct(){
 		$this->objPDO = new Conexion();
 	}
    //TACOS PENDIENTES DE PATOLOGIA QUIRURGICA
 	public function totaltacpq(){
        $stmt=$this->objPDO->prepare("SELECT * from sisanatom.biopsia b inner join sisanatom.detalle_biopq db on b.id_biopsia=db.id_biopsia
                            where db.num_tacos=0 and b.condicion_biopsia='A' and (date_part('day',((select now())-b.fecha_ingreso)))>=6 and EXTRACT(YEAR FROM b.fecha_ingreso)=EXTRACT(YEAR FROM (select current_date))");
        $stmt->execute();
        $numpq=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $numpq; 
    }

    public function numerotacpq($usuario){
        $stmt=$this->objPDO->prepare("SELECT * from sisanatom.biopsia b inner join sisanatom.detalle_biopq db on b.id_biopsia=db.id_biopsia
                                    inner join empleados e on b.tecnologo_responsable=e.emp_id inner join sisanatom.usuarios_anat ua on e.emp_id=ua.emp_id
                                    where db.num_tacos=0 and b.condicion_biopsia='A' and db.num_laminas=0 and (date_part('day',((select now())-b.fecha_ingreso)))>=6 and ua.id_usuario=:usuario ");
        $stmt->execute(array('usuario'=>$usuario));
        $numepq=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $numepq;
    }

    //TACOS PENDIENTES DE CITOLOGIA ESPECIAL
    public function totaltacce(){
        $stmt=$this->objPDO->prepare("SELECT * from sisanatom.biopsia b inner join sisanatom.detalle_bioce db on b.id_biopsia=db.id_biopsia
                            where db.num_tacos=0 and b.condicion_biopsia='A' and (date_part('day',((select now())-b.fecha_ingreso)))>=6 and EXTRACT(YEAR FROM b.fecha_ingreso)=EXTRACT(YEAR FROM (select current_date))");
        $stmt->execute();
        $numpq=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $numpq; 
    }

    public function numerotacce($usuario){
        $stmt=$this->objPDO->prepare("SELECT * from sisanatom.biopsia b inner join sisanatom.detalle_bioce db on b.id_biopsia=db.id_biopsia
                                    inner join empleados e on b.tecnologo_responsable=e.emp_id inner join sisanatom.usuarios_anat ua on e.emp_id=ua.emp_id
                                    where db.num_tacos=0 and b.condicion_biopsia='A' and db.num_laminas=0 and (date_part('day',((select now())-b.fecha_ingreso)))>=6 and ua.id_usuario=:usuario ");
        $stmt->execute(array('usuario'=>$usuario));
        $numce=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $numce;
    }

    //MUESTRAS PENDIENTES
//------Patologia Quirurgica
    public function muependpq(){
        $stmt=$this->objPDO->prepare("SELECT * from sisanatom.biopsia b inner join sisanatom.detalle_biopq db on b.id_biopsia=db.id_biopsia 
                                where b.estado_biopsia<3 and b.condicion_biopsia='A' and (date_part('day',((select now())-b.fecha_ingreso)))>=10 and EXTRACT(YEAR FROM b.fecha_ingreso)=EXTRACT(YEAR FROM (select current_date))");
        $stmt->execute();
        $muepq=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $muepq;
    }

    public function emppq($usuario){
       $stmt=$this->objPDO->prepare("SELECT * from sisanatom.biopsia b inner join sisanatom.detalle_biopq db on b.id_biopsia=db.id_biopsia 
                                    inner join empleados e on b.patologo_responsable=e.emp_id inner join sisanatom.usuarios_anat ua on ua.emp_id=e.emp_id
                                    where b.estado_biopsia<3 and b.condicion_biopsia='A' and (date_part('day',((select now())-b.fecha_ingreso)))>=10 and ua.id_usuario=:usuario and EXTRACT(YEAR FROM b.fecha_ingreso)=EXTRACT(YEAR FROM (select current_date)) ");
        $stmt->execute(array('usuario'=>$usuario));
        $muepq=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $muepq; 
    }

//------Citologia Especial
    public function muependce(){
        $stmt=$this->objPDO->prepare("SELECT * from sisanatom.biopsia b inner join sisanatom.detalle_bioce db on b.id_biopsia=db.id_biopsia 
                                where b.estado_biopsia<3 and b.condicion_biopsia='A' and (date_part('day',((select now())-b.fecha_ingreso)))>=7 and EXTRACT(YEAR FROM b.fecha_ingreso)=EXTRACT(YEAR FROM (select current_date))");
        $stmt->execute();
        $muece=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $muece;
    }

    public function empce($usuario){
        $stmt=$this->objPDO->prepare("SELECT * from sisanatom.biopsia b inner join sisanatom.detalle_bioce db on b.id_biopsia=db.id_biopsia 
                                    inner join empleados e on b.patologo_responsable=e.emp_id inner join sisanatom.usuarios_anat ua on ua.emp_id=e.emp_id
                                    where b.estado_biopsia<3 and b.condicion_biopsia='A' and (date_part('day',((select now())-b.fecha_ingreso)))>=7 and ua.id_usuario=:usuario and EXTRACT(YEAR FROM b.fecha_ingreso)=EXTRACT(YEAR FROM (select current_date))");
        $stmt->execute(array('usuario'=>$usuario));
        $muece=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $muece;
    }


//------Citologia Cervico Vaginal
    public function muependccv(){
        $stmt=$this->objPDO->prepare("SELECT * from sisanatom.biopsia b inner join sisanatom.detalle_bioccv db on b.id_biopsia=db.id_biopsia 
                                where b.estado_biopsia<3 and b.condicion_biopsia='A' and (date_part('day',((select now())-b.fecha_ingreso)))>=7");
        $stmt->execute();
        $mueccv=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $mueccv;
    }

    public function empccv($usuario){
        $stmt=$this->objPDO->prepare("SELECT * from sisanatom.biopsia b inner join sisanatom.detalle_bioccv db on b.id_biopsia=db.id_biopsia 
                                    inner join empleados e on b.patologo_responsable=e.emp_id inner join sisanatom.usuarios_anat ua on ua.emp_id=e.emp_id
                                    where b.estado_biopsia<3 and b.condicion_biopsia='A' and (date_part('day',((select now())-b.fecha_ingreso)))>=7 and ua.id_usuario=:usuario and EXTRACT(YEAR FROM b.fecha_ingreso)=EXTRACT(YEAR FROM (select current_date))");
        $stmt->execute(array('usuario'=>$usuario));
        $mueccv=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $mueccv;
    }
//-----Inmunohistoquimica
    public function muependih(){
        $stmt=$this->objPDO->prepare("SELECT * from sisanatom.biopsia b inner join sisanatom.detalle_bioih db on b.id_biopsia=db.id_biopsia 
                                where b.estado_biopsia<3 and b.condicion_biopsia='A' and (date_part('day',((select now())-b.fecha_ingreso)))>=10");
        $stmt->execute();
        $mueih=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $mueih;
    }

    public function empih($usuario){
        $stmt=$this->objPDO->prepare("SELECT * from sisanatom.biopsia b inner join sisanatom.detalle_bioih db on b.id_biopsia=db.id_biopsia 
                                    inner join empleados e on b.patologo_responsable=e.emp_id inner join sisanatom.usuarios_anat ua on ua.emp_id=e.emp_id
                                    where b.estado_biopsia<3 and b.condicion_biopsia='A' and (date_part('day',((select now())-b.fecha_ingreso)))>=10 and ua.id_usuario=:usuario and EXTRACT(YEAR FROM b.fecha_ingreso)=EXTRACT(YEAR FROM (select current_date))");
        $stmt->execute(array('usuario'=>$usuario));
        $mueih=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $mueih;
    }

 }

?>