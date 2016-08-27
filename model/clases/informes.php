<?php
require_once 'conexion.php';
class Informes{
	private $objPdo;

	public function __construct() {

        $this->objPdo = new Conexion();
    }

    public function partediario($id_area,$dia,$mes,$anio){
	$stmt=$this->objPdo->prepare("SELECT biomuestra.id_biopsia,biomuestra.num_biopsia,numeromue.numero_muestras,biomuestra.fecha_ingreso,biomuestra.muestras,biomuestra.estado_biopsia,biomuestra.descr_area as area FROM 
								(SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,list(m.descr_muestra)as muestras,(CASE WHEN b.estado_biopsia<3 THEN 'PENDIENTE' ELSE 'FINALIZADO' END) as estado_biopsia,a.descr_area from sisanatom.biopsia b 
								                        inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
								                        inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
								                        inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
								                        where b.estado_biopsia<=3 and EXTRACT(DAY FROM fecha_ingreso)=:dia and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio
								                        and a.id_area=:id_area
								                        group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,a.descr_area
								                        ORDER BY b.codigo ASC)biomuestra INNER JOIN 
								(SELECT id_biopsia,count(*) as numero_muestras from sisanatom.muestras_biopsia
								where id_biopsia IN (SELECT b.id_biopsia from sisanatom.biopsia b 
								                        inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
								                        inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
								                        inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
								                        where b.estado_biopsia<=3 and EXTRACT(DAY FROM fecha_ingreso)=:dia and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio
								                        and a.id_area=:id_area
								                        group by b.id_biopsia
								                        ORDER BY b.codigo ASC )
								group by id_biopsia ORDER BY id_biopsia ASC)numeromue ON biomuestra.id_biopsia=numeromue.id_biopsia ");
	$stmt->execute(array('id_area'=>$id_area,'dia'=>$dia,'mes'=>$mes,'anio'=>$anio));
    $parte=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $parte;
	}

	public function partedpq($dia,$mes,$anio){
		$stmt=$this->objPdo->prepare("SELECT biomuestra.id_biopsia,biomuestra.num_biopsia,numeromue.numero_muestras,biomuestra.fecha_ingreso,biomuestra.muestras,biomuestra.estado_biopsia,biomuestra.descr_area as area FROM 
								(SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,list(m.descr_muestra)as muestras,(CASE WHEN b.estado_biopsia<3 THEN 'PENDIENTE' ELSE 'FINALIZADO' END) as estado_biopsia,a.descr_area from sisanatom.biopsia b 
								                        inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
								                        inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
								                        inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
								                        where b.estado_biopsia<=3 and EXTRACT(DAY FROM fecha_ingreso)=:dia and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio
								                        and a.id_area=1
								                        group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,a.descr_area
								                        ORDER BY b.codigo ASC)biomuestra INNER JOIN 
								(SELECT id_biopsia,count(*) as numero_muestras from sisanatom.muestras_biopsia
								where id_biopsia IN (SELECT b.id_biopsia from sisanatom.biopsia b 
								                        inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
								                        inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
								                        inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
								                        where b.estado_biopsia<=3 and EXTRACT(DAY FROM fecha_ingreso)=:dia and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio
								                        and a.id_area=1
								                        group by b.id_biopsia
								                        ORDER BY b.codigo ASC )
								group by id_biopsia ORDER BY id_biopsia ASC)numeromue ON biomuestra.id_biopsia=numeromue.id_biopsia");
		$stmt->execute(array('dia'=>$dia,'mes'=>$mes,'anio'=>$anio));
		$partepq=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $partepq;
	}

	public function partedce($dia,$mes,$anio){
		$stmt=$this->objPdo->prepare("SELECT biomuestra.id_biopsia,biomuestra.num_biopsia,numeromue.numero_muestras,biomuestra.fecha_ingreso,biomuestra.muestras,biomuestra.estado_biopsia,biomuestra.descr_area as area FROM 
								(SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,list(m.descr_muestra)as muestras,(CASE WHEN b.estado_biopsia<3 THEN 'PENDIENTE' ELSE 'FINALIZADO' END) as estado_biopsia,a.descr_area from sisanatom.biopsia b 
								                        inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
								                        inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
								                        inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
								                        where b.estado_biopsia<=3 and EXTRACT(DAY FROM fecha_ingreso)=:dia and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio
								                        and a.id_area=2
								                        group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,a.descr_area
								                        ORDER BY b.codigo ASC)biomuestra INNER JOIN 
								(SELECT id_biopsia,count(*) as numero_muestras from sisanatom.muestras_biopsia
								where id_biopsia IN (SELECT b.id_biopsia from sisanatom.biopsia b 
								                        inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
								                        inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
								                        inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
								                        where b.estado_biopsia<=3 and EXTRACT(DAY FROM fecha_ingreso)=:dia and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio
								                        and a.id_area=2
								                        group by b.id_biopsia
								                        ORDER BY b.codigo ASC )
								group by id_biopsia ORDER BY id_biopsia ASC)numeromue ON biomuestra.id_biopsia=numeromue.id_biopsia");
		$stmt->execute(array('dia'=>$dia,'mes'=>$mes,'anio'=>$anio));
		$partece=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $partece;
	}

	public function partedccv($dia,$mes,$anio){
		$stmt=$this->objPdo->prepare("SELECT biomuestra.id_biopsia,biomuestra.num_biopsia,numeromue.numero_muestras,biomuestra.fecha_ingreso,biomuestra.muestras,biomuestra.estado_biopsia,biomuestra.descr_area as area FROM 
								(SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,list(m.descr_muestra)as muestras,(CASE WHEN b.estado_biopsia<3 THEN 'PENDIENTE' ELSE 'FINALIZADO' END) as estado_biopsia,a.descr_area from sisanatom.biopsia b 
								                        inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
								                        inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
								                        inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
								                        where b.estado_biopsia<=3 and EXTRACT(DAY FROM fecha_ingreso)=:dia and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio
								                        and a.id_area=3
								                        group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,a.descr_area
								                        ORDER BY b.codigo ASC)biomuestra INNER JOIN 
								(SELECT id_biopsia,count(*) as numero_muestras from sisanatom.muestras_biopsia
								where id_biopsia IN (SELECT b.id_biopsia from sisanatom.biopsia b 
								                        inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
								                        inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
								                        inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
								                        where b.estado_biopsia<=3 and EXTRACT(DAY FROM fecha_ingreso)=:dia and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio
								                        and a.id_area=3
								                        group by b.id_biopsia
								                        ORDER BY b.codigo ASC )
								group by id_biopsia ORDER BY id_biopsia ASC)numeromue ON biomuestra.id_biopsia=numeromue.id_biopsia ");
		$stmt->execute(array('dia'=>$dia,'mes'=>$mes,'anio'=>$anio));
		$parteccv=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $parteccv;
	}
    
    public function partedih($dia,$mes,$anio){
    	$stmt=$this->objPdo->prepare("SELECT biomuestra.id_biopsia,biomuestra.num_biopsia,numeromue.numero_muestras,biomuestra.fecha_ingreso,biomuestra.muestras,biomuestra.estado_biopsia,biomuestra.descr_area as area FROM 
								(SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,list(m.descr_muestra)as muestras,(CASE WHEN b.estado_biopsia<3 THEN 'PENDIENTE' ELSE 'FINALIZADO' END) as estado_biopsia,a.descr_area from sisanatom.biopsia b 
								                        inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
								                        inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
								                        inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
								                        where b.estado_biopsia<=3 and EXTRACT(DAY FROM fecha_ingreso)=:dia and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio
								                        and a.id_area=4
								                        group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,a.descr_area
								                        ORDER BY b.codigo ASC)biomuestra INNER JOIN 
								(SELECT id_biopsia,count(*) as numero_muestras from sisanatom.muestras_biopsia
								where id_biopsia IN (SELECT b.id_biopsia from sisanatom.biopsia b 
								                        inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
								                        inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
								                        inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
								                        where b.estado_biopsia<=3 and EXTRACT(DAY FROM fecha_ingreso)=:dia and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio
								                        and a.id_area=4
								                        group by b.id_biopsia
								                        ORDER BY b.codigo ASC )
								group by id_biopsia ORDER BY id_biopsia ASC)numeromue ON biomuestra.id_biopsia=numeromue.id_biopsia ");
    	$stmt->execute(array('dia'=>$dia,'mes'=>$mes,'anio'=>$anio));
    	$parteih=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $parteih;
    }

    /*OBTENER NOMBRE DE AREA*/
    public function nomarea($id_area){
    	$stmt=$this->objPdo->prepare("SELECT descr_area from sisanatom.area where id_area=:id_area");
    	$stmt->execute(array('id_area'=>$id_area));
    	$nombrearea=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $nombrearea[0]->descr_area;
    }

    public function bioservicio($dep_id,$id_area,$fecha1,$fecha2){
    	$stmt=$this->objPdo->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,list(m.descr_muestra)as muestras,ins.descr_inst,a.descr_area,(p.a_paterno||' '||p.a_materno||' '||p.nombre)as paciente,
									dep.dep_descr from sisanatom.biopsia b 
			                        inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
			                        inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem inner join sisanatom.topografia_area ta on b.id_top=ta.id_top
			                        inner join sisanatom.area a on ta.id_area=a.id_area inner join dependencias dep on b.dep_id=dep.dep_id
			                        inner join sisemer.paciente p on b.id_paciente=p.id_paciente inner join sisanatom.institucion ins on b.id_institucion=ins.id_inst
			                        where b.estado_biopsia<=3 and dep.dep_id=:dep_id and a.id_area=:id_area and fecha_ingreso>=:fecha1 and fecha_ingreso<=:fecha2
			                        group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,a.descr_area,ins.descr_inst,paciente,dep.dep_descr ORDER BY b.codigo ASC");
    	$stmt->execute(array('dep_id'=>$dep_id,'id_area'=>$id_area,'fecha1'=>$fecha1,'fecha2'=>$fecha2));
    	$bservicio=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $bservicio;
    }

    /*OBTENER NOMBRE DEPENDENCIA*/
    public function nomser($dep_id){
    	$stmt=$this->objPdo->prepare("SELECT dep_descr from dependencias where dep_id=:dep_id");
    	$stmt->execute(array('dep_id'=>$dep_id));
    	$sernom=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $sernom[0]->dep_descr;
    }

    /*OBTENER  MUESTRAS POR AREA*/
    public function obtmuestra($id_area){
    	$stmt=$this->objPdo->prepare("SELECT m.id_muestra,m.descr_muestra as muestra from sisanatom.muestra m inner join sisanatom.area a on m.id_area=a.id_area
										where a.id_area=:id_area ORDER BY m.id_muestra ASC  ");
    	$stmt->execute(array('id_area'=>$id_area));
    	$marea=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $marea;
    }

    public function biomuestra($id_area,$fecha1,$fecha2,$id_muestra){
    	$stmt=$this->objPdo->prepare("SELECT BIO.id_biopsia,BIO.num_biopsia,BIO.paciente,BIO.dep_descr,BIO.fecha_ingreso,MUE.descr_muestra,MUE.diag_final,BIO.descr_inst,
									(CASE WHEN BIO.estado_biopsia<3 THEN 'PENDIENTE' ELSE 'FINALIZADO' END)as estado_biopsia  FROM
									(select b.id_biopsia,b.num_biopsia,(pac.a_paterno||' '||pac.a_materno||' '||pac.nombre) as paciente,ta.descr_top,dep.dep_descr,b.fecha_ingreso,b.estado_biopsia,t.descr_inst 
									from sisanatom.biopsia b inner join sisemer.paciente pac on b.id_paciente=pac.id_paciente inner join sisanatom.institucion t on b.id_institucion=t.id_inst
									inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join dependencias dep on b.dep_id=dep.dep_id inner join sisanatom.area a on ta.id_area=a.id_area
									where fecha_ingreso>=:fecha1 and fecha_ingreso<=:fecha2 and a.id_area=:id_area)BIO inner join 
									(select mb.id_biopsia,m.descr_muestra,mb.diag_final from sisanatom.muestras_biopsia mb inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra INNER JOIN 
									sisanatom.area a on m.id_area=a.id_area
									where m.id_muestra=:id_muestra )MUE on BIO.id_biopsia=MUE.id_biopsia
									ORDER BY id_biopsia ASC");
    	$stmt->execute(array('id_area'=>$id_area,'fecha1'=>$fecha1,'fecha2'=>$fecha2,'id_muestra'=>$id_muestra));
    	$bmue=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $bmue;
    }

    /*muestra para ccv*/
    public function biocvmuestra($id_area,$fecha1,$fecha2,$id_muestra){
    	$stmt=$this->objPdo->prepare("SELECT BIO.id_biopsia,BIO.num_biopsia,BIO.paciente,BIO.dep_descr,BIO.fecha_ingreso,MUE.descr_muestra,BIO.diag as diag_final,BIO.descr_inst,
									(CASE WHEN BIO.estado_biopsia<3 THEN 'PENDIENTE' ELSE 'FINALIZADO' END)as estado_biopsia  FROM
									(select b.id_biopsia,b.num_biopsia,(pac.nombre||' '||pac.a_paterno||' '||pac.a_materno) as paciente,
									ta.descr_top,dep.dep_descr,b.fecha_ingreso,b.estado_biopsia,t.descr_inst,cv.descr_diagccv as diag 
									from sisanatom.biopsia b inner join sisemer.paciente pac on b.id_paciente=pac.id_paciente
									inner join sisanatom.detalle_bioccv bc on b.id_biopsia=bc.id_biopsia 
									left join sisanatom.diagnostico_ccv cv on bc.id_diagccv=cv.id_diagccv 
									inner join sisanatom.institucion t on b.id_institucion=t.id_inst
									inner join sisanatom.topografia_area ta on b.id_top=ta.id_top 
									inner join dependencias dep on b.dep_id=dep.dep_id inner join sisanatom.area a on ta.id_area=a.id_area
									where fecha_ingreso>=:fecha1 and fecha_ingreso<=:fecha2 and a.id_area=:id_area)BIO inner join 
									(select mb.id_biopsia,m.descr_muestra,mb.diag_final from sisanatom.muestras_biopsia mb inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra INNER JOIN 
									sisanatom.area a on m.id_area=a.id_area
									where m.id_muestra=:id_muestra)MUE on BIO.id_biopsia=MUE.id_biopsia
									ORDER BY id_biopsia ASC");
		$stmt->execute(array('id_area'=>$id_area,'fecha1'=>$fecha1,'fecha2'=>$fecha2,'id_muestra'=>$id_muestra));
		$cvmue=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $cvmue;
    }
    /*OBTENER NOMBRE DE MUESTRA*/
    public function nommue($id_muestra){
    	$stmt=$this->objPdo->prepare("SELECT descr_muestra from sisanatom.muestra where id_muestra=:id_muestra ");
    	$stmt->execute(array('id_muestra'=>$id_muestra));
    	$nmue=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $nmue[0]->descr_muestra;
    }

    //BIOPSIAS ENTRE 2 FECHAS POR AREA
    public function bio2pq($id_area,$fecha1,$fecha2){
    	$stmt=$this->objPdo->prepare("SELECT b.id_biopsia,b.num_biopsia,(pac.a_paterno||' '||pac.a_materno||' '||pac.nombre)as paciente,b.fecha_ingreso,dep.dep_descr as servicio,
									(CASE WHEN b.estado_biopsia<3 THEN 'PENDIENTE' ELSE 'FINALIZADA' END)AS estado_biopsia,pq.fecha_informe FROM sisanatom.biopsia b 
									inner join sisemer.paciente pac on b.id_paciente=pac.id_paciente inner join
									dependencias dep on b.dep_id=dep.dep_id inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									inner join sisanatom.detalle_biopq pq on b.id_biopsia=pq.id_biopsia
									where a.id_area=:id_area and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2
									order by b.codigo asc ");
    	$stmt->execute(array('id_area'=>$id_area,'fecha1'=>$fecha1,'fecha2'=>$fecha2));
    	$b2pq=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $b2pq;
    }

     public function biopsia2pq($fecha1,$fecha2){
    	$stmt=$this->objPdo->prepare("SELECT b.id_biopsia,b.num_biopsia,(pac.a_paterno||' '||pac.a_materno||' '||pac.nombre)as paciente,b.fecha_ingreso,dep.dep_descr as servicio,
									(CASE WHEN b.estado_biopsia<3 THEN 'PENDIENTE' ELSE 'FINALIZADA' END)AS estado_biopsia,pq.fecha_informe FROM sisanatom.biopsia b 
									inner join sisemer.paciente pac on b.id_paciente=pac.id_paciente inner join
									dependencias dep on b.dep_id=dep.dep_id inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									inner join sisanatom.detalle_biopq pq on b.id_biopsia=pq.id_biopsia
									where a.id_area=1 and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2
									order by b.codigo asc ");
    	$stmt->execute(array('fecha1'=>$fecha1,'fecha2'=>$fecha2));
    	$b2pq=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $b2pq;
    }

    public function bio2ce($id_area,$fecha1,$fecha2){
    	$stmt=$this->objPdo->prepare("SELECT b.id_biopsia,b.num_biopsia,(pac.a_paterno||' '||pac.a_materno||' '||pac.nombre)as paciente,b.fecha_ingreso,dep.dep_descr as servicio,
									(CASE WHEN b.estado_biopsia<3 THEN 'PENDIENTE' ELSE 'FINALIZADA' END)AS estado_biopsia,ce.fecha_informe FROM sisanatom.biopsia b 
									inner join sisemer.paciente pac on b.id_paciente=pac.id_paciente inner join
									dependencias dep on b.dep_id=dep.dep_id inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									inner join sisanatom.detalle_bioce ce on b.id_biopsia=ce.id_biopsia
									where a.id_area=:id_area and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2
									order by b.codigo asc  ");
    	$stmt->execute(array('id_area'=>$id_area,'fecha1'=>$fecha1,'fecha2'=>$fecha2));
    	$b2ce=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $b2ce;
    }

    public function biopsia2ce($fecha1,$fecha2){
    	$stmt=$this->objPdo->prepare("SELECT b.id_biopsia,b.num_biopsia,(pac.a_paterno||' '||pac.a_materno||' '||pac.nombre)as paciente,b.fecha_ingreso,dep.dep_descr as servicio,
									(CASE WHEN b.estado_biopsia<3 THEN 'PENDIENTE' ELSE 'FINALIZADA' END)AS estado_biopsia,ce.fecha_informe FROM sisanatom.biopsia b 
									inner join sisemer.paciente pac on b.id_paciente=pac.id_paciente inner join
									dependencias dep on b.dep_id=dep.dep_id inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									inner join sisanatom.detalle_bioce ce on b.id_biopsia=ce.id_biopsia
									where a.id_area=2 and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2
									order by b.codigo asc  ");
    	$stmt->execute(array('fecha1'=>$fecha1,'fecha2'=>$fecha2));
    	$b2ce=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $b2ce;
    }

    public function bio2ccv($id_area,$fecha1,$fecha2){
    	$stmt=$this->objPdo->prepare("SELECT b.id_biopsia,b.num_biopsia,(pac.a_paterno||' '||pac.a_materno||' '||pac.nombre)as paciente,b.fecha_ingreso,dep.dep_descr as servicio,
									(CASE WHEN b.estado_biopsia<3 THEN 'PENDIENTE' ELSE 'FINALIZADA' END)AS estado_biopsia,ccv.fecha_informe FROM sisanatom.biopsia b 
									inner join sisemer.paciente pac on b.id_paciente=pac.id_paciente inner join
									dependencias dep on b.dep_id=dep.dep_id inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									inner join sisanatom.detalle_bioccv ccv on b.id_biopsia=ccv.id_biopsia
									where a.id_area=:id_area and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2
									order by b.codigo asc  ");
    	$stmt->execute(array('id_area'=>$id_area,'fecha1'=>$fecha1,'fecha2'=>$fecha2));
    	$b2ccv=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $b2ccv;
    }

    public function biopsia2ccv($fecha1,$fecha2){
    	$stmt=$this->objPdo->prepare("SELECT b.id_biopsia,b.num_biopsia,(pac.a_paterno||' '||pac.a_materno||' '||pac.nombre)as paciente,b.fecha_ingreso,dep.dep_descr as servicio,
									(CASE WHEN b.estado_biopsia<3 THEN 'PENDIENTE' ELSE 'FINALIZADA' END)AS estado_biopsia,ccv.fecha_informe FROM sisanatom.biopsia b 
									inner join sisemer.paciente pac on b.id_paciente=pac.id_paciente inner join
									dependencias dep on b.dep_id=dep.dep_id inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									inner join sisanatom.detalle_bioccv ccv on b.id_biopsia=ccv.id_biopsia
									where a.id_area=3 and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2
									order by b.codigo asc  ");
    	$stmt->execute(array('fecha1'=>$fecha1,'fecha2'=>$fecha2));
    	$b2ccv=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $b2ccv;
    }

    public function bio2ih($id_area,$fecha1,$fecha2){
    	$stmt=$this->objPdo->prepare("SELECT b.id_biopsia,b.num_biopsia,(pac.a_paterno||' '||pac.a_materno||' '||pac.nombre)as paciente,b.fecha_ingreso,dep.dep_descr as servicio,
									(CASE WHEN b.estado_biopsia<3 THEN 'PENDIENTE' ELSE 'FINALIZADA' END)AS estado_biopsia,ih.fecha_informe FROM sisanatom.biopsia b 
									inner join sisemer.paciente pac on b.id_paciente=pac.id_paciente inner join
									dependencias dep on b.dep_id=dep.dep_id inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									inner join sisanatom.detalle_bioih ih on b.id_biopsia=ih.id_biopsia
									where a.id_area=:id_area and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2
									order by b.codigo asc ");
    	$stmt->execute(array('id_area'=>$id_area,'fecha1'=>$fecha1,'fecha2'=>$fecha2));
    	$b2ih=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $b2ih;
    }

    public function biopsia2ih($fecha1,$fecha2){
    	$stmt=$this->objPdo->prepare("SELECT b.id_biopsia,b.num_biopsia,(pac.a_paterno||' '||pac.a_materno||' '||pac.nombre)as paciente,b.fecha_ingreso,dep.dep_descr as servicio,
									(CASE WHEN b.estado_biopsia<3 THEN 'PENDIENTE' ELSE 'FINALIZADA' END)AS estado_biopsia,ih.fecha_informe FROM sisanatom.biopsia b 
									inner join sisemer.paciente pac on b.id_paciente=pac.id_paciente inner join
									dependencias dep on b.dep_id=dep.dep_id inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									inner join sisanatom.detalle_bioih ih on b.id_biopsia=ih.id_biopsia
									where a.id_area=4 and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2
									order by b.codigo asc ");
    	$stmt->execute(array('fecha1'=>$fecha1,'fecha2'=>$fecha2));
    	$b2ih=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $b2ih;
    }
    
    //biopsias por mes de acuerdo area
    public function biompq($mes,$anio){
    	$stmt=$this->objPdo->prepare("SELECT b.id_biopsia,b.num_biopsia,(pac.nombre||' '||pac.a_paterno||' '||pac.a_materno)as paciente,b.fecha_ingreso,dep.dep_descr as servicio,
									(CASE WHEN b.estado_biopsia<3 THEN 'PENDIENTE' ELSE 'FINALIZADA' END)AS estado_biopsia,pq.fecha_informe FROM sisanatom.biopsia b 
									inner join sisemer.paciente pac on b.id_paciente=pac.id_paciente inner join
									dependencias dep on b.dep_id=dep.dep_id inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									inner join sisanatom.detalle_biopq pq on b.id_biopsia=pq.id_biopsia
									where EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio
									order by b.codigo asc ");
    	$stmt->execute(array('mes'=>$mes,'anio'=>$anio));
    	$bmpq=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $bmpq;
    }

    public function biomce($mes,$anio){
    	$stmt=$this->objPdo->prepare("SELECT b.id_biopsia,b.num_biopsia,(pac.nombre||' '||pac.a_paterno||' '||pac.a_materno)as paciente,b.fecha_ingreso,dep.dep_descr as servicio,
									(CASE WHEN b.estado_biopsia<3 THEN 'PENDIENTE' ELSE 'FINALIZADA' END)AS estado_biopsia,pq.fecha_informe FROM sisanatom.biopsia b 
									inner join sisemer.paciente pac on b.id_paciente=pac.id_paciente inner join
									dependencias dep on b.dep_id=dep.dep_id inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									inner join sisanatom.detalle_bioce pq on b.id_biopsia=pq.id_biopsia
									where EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio
									order by b.codigo asc ");
    	$stmt->execute(array('mes'=>$mes,'anio'=>$anio));
    	$bmce=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $bmce;
    }

    public function biomccv($mes,$anio){
    	$stmt=$this->objPdo->prepare("SELECT b.id_biopsia,b.num_biopsia,(pac.nombre||' '||pac.a_paterno||' '||pac.a_materno)as paciente,b.fecha_ingreso,dep.dep_descr as servicio,
									(CASE WHEN b.estado_biopsia<3 THEN 'PENDIENTE' ELSE 'FINALIZADA' END)AS estado_biopsia,pq.fecha_informe FROM sisanatom.biopsia b 
									inner join sisemer.paciente pac on b.id_paciente=pac.id_paciente inner join
									dependencias dep on b.dep_id=dep.dep_id inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									inner join sisanatom.detalle_bioccv pq on b.id_biopsia=pq.id_biopsia
									where EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio
									order by b.codigo asc");
    	$stmt->execute(array('mes'=>$mes,'anio'=>$anio));
    	$bmccv=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $bmccv;
    }

    public function biomih($mes,$anio){
    	$stmt=$this->objPdo->prepare("SELECT b.id_biopsia,b.num_biopsia,(pac.nombre||' '||pac.a_paterno||' '||pac.a_materno)as paciente,b.fecha_ingreso,dep.dep_descr as servicio,
									(CASE WHEN b.estado_biopsia<3 THEN 'PENDIENTE' ELSE 'FINALIZADA' END)AS estado_biopsia,pq.fecha_informe FROM sisanatom.biopsia b 
									inner join sisemer.paciente pac on b.id_paciente=pac.id_paciente inner join
									dependencias dep on b.dep_id=dep.dep_id inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									inner join sisanatom.detalle_bioih pq on b.id_biopsia=pq.id_biopsia
									where EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio
									order by b.codigo asc");
    	$stmt->execute(array('mes'=>$mes,'anio'=>$anio));
    	$bmih=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $bmih;
    }
/*biopsias derivadas de PQ a IH*/
    public function biompqih($mes,$anio){
    	$stmt=$this->objPdo->prepare("SELECT b.id_biopsia,b.num_biopsia,(pac.nombre||' '||pac.a_paterno||' '||pac.a_materno)as paciente,b.fecha_ingreso,dep.dep_descr as servicio,
									(CASE WHEN b.estado_biopsia<3 THEN 'PENDIENTE' ELSE 'FINALIZADA' END)AS estado_biopsia,pq.fecha_informe FROM sisanatom.biopsia b 
									inner join sisemer.paciente pac on b.id_paciente=pac.id_paciente inner join
									dependencias dep on b.dep_id=dep.dep_id inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									inner join sisanatom.detalle_biopq pq on b.id_biopsia=pq.id_biopsia
									where pq.requiere_ih='Si' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio
									order by b.codigo asc");
    	$stmt->execute(array('mes'=>$mes,'anio'=>$anio));
    	$bmpqih=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $bmpqih;
    }

    public function biomqih2($fecha1,$fecha2){
    	$stmt=$this->objPdo->prepare("SELECT b.id_biopsia,b.num_biopsia,(pac.a_paterno||' '||pac.a_materno||' '||pac.nombre)as paciente,b.fecha_ingreso,dep.dep_descr as servicio,
									(CASE WHEN b.estado_biopsia<3 THEN 'PENDIENTE' ELSE 'FINALIZADA' END)AS estado_biopsia,pq.fecha_informe FROM sisanatom.biopsia b 
									inner join sisemer.paciente pac on b.id_paciente=pac.id_paciente inner join
									dependencias dep on b.dep_id=dep.dep_id inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									inner join sisanatom.detalle_biopq pq on b.id_biopsia=pq.id_biopsia
									where pq.requiere_ih='Si' and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2
									order by b.codigo asc ");
    	$stmt->execute(array('fecha1'=>$fecha1,'fecha2'=>$fecha2));
    	$pqih=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $pqih;
    }


    public function biomceih($mes,$anio){
    	$stmt=$this->objPdo->prepare("SELECT b.id_biopsia,b.num_biopsia,(pac.nombre||' '||pac.a_paterno||' '||pac.a_materno)as paciente,b.fecha_ingreso,dep.dep_descr as servicio,
									(CASE WHEN b.estado_biopsia<3 THEN 'PENDIENTE' ELSE 'FINALIZADA' END)AS estado_biopsia,pq.fecha_informe FROM sisanatom.biopsia b 
									inner join sisemer.paciente pac on b.id_paciente=pac.id_paciente inner join
									dependencias dep on b.dep_id=dep.dep_id inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									inner join sisanatom.detalle_bioce pq on b.id_biopsia=pq.id_biopsia
									where pq.requiere_ih='Si' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio
									order by b.codigo asc");
    	$stmt->execute(array('mes'=>$mes,'anio'=>$anio));
    	$bmceih=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $bmceih;
    }

    public function bioceih2($fecha1,$fecha2){
    	$stmt=$this->objPdo->prepare("SELECT b.id_biopsia,b.num_biopsia,(pac.a_paterno||' '||pac.a_materno||' '||pac.nombre)as paciente,b.fecha_ingreso,dep.dep_descr as servicio,
									(CASE WHEN b.estado_biopsia<3 THEN 'PENDIENTE' ELSE 'FINALIZADA' END)AS estado_biopsia,pq.fecha_informe FROM sisanatom.biopsia b 
									inner join sisemer.paciente pac on b.id_paciente=pac.id_paciente inner join
									dependencias dep on b.dep_id=dep.dep_id inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									inner join sisanatom.detalle_bioce pq on b.id_biopsia=pq.id_biopsia
									where pq.requiere_ih='Si' and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2
									order by b.codigo asc ");
    	$stmt->execute(array('fecha1'=>$fecha1,'fecha2'=>$fecha2));
    	$ceih=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $ceih; 
    }


/*biopsias con materiales PQ*/
	public function matpq($fecha1,$fecha2){
		$stmt=$this->objPdo->prepare("SELECT bio.id_biopsia,bio.num_biopsia,bio.fecha_ingreso,pq.num_laminas,pq.num_tacos,(CASE WHEN bio.estado_biopsia=3 THEN 'FINALIZADA' ELSE 'PENDIENTE'END)AS estado_biopsia
									from sisanatom.biopsia bio inner join sisanatom.detalle_biopq pq on bio.id_biopsia=pq.id_biopsia
									inner join sisanatom.topografia_area ta on bio.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									where a.id_area=1 and bio.fecha_ingreso>=:fecha1 and bio.fecha_ingreso<=:fecha2
									order by bio.codigo asc ");
		$stmt->execute(array('fecha1'=>$fecha1,'fecha2'=>$fecha2));
		$matepq=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $matepq;
	}

	public function matce($fecha1,$fecha2){
		$stmt=$this->objPdo->prepare("SELECT bio.id_biopsia,bio.num_biopsia,bio.fecha_ingreso,pq.num_laminas,pq.num_tacos,(CASE WHEN bio.estado_biopsia=3 THEN 'FINALIZADA' ELSE 'PENDIENTE'END)AS estado_biopsia
									from sisanatom.biopsia bio inner join sisanatom.detalle_bioce pq on bio.id_biopsia=pq.id_biopsia
									inner join sisanatom.topografia_area ta on bio.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									where a.id_area=2 and bio.fecha_ingreso>=:fecha1 and bio.fecha_ingreso<=:fecha2
									order by bio.codigo asc ");
		$stmt->execute(array('fecha1'=>$fecha1,'fecha2'=>$fecha2));
		$matece=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $matece;
	}

	public function matodos($fecha1,$fecha2){
		$stmt=$this->objPdo->prepare("SELECT a.descr_area,sum(pq.num_laminas)as laminas,sum(pq.num_tacos) as tacos
									from sisanatom.biopsia bio inner join sisanatom.detalle_biopq pq on bio.id_biopsia=pq.id_biopsia
									inner join sisanatom.topografia_area ta on bio.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									where a.id_area=1 and bio.fecha_ingreso>=:fecha1 and bio.fecha_ingreso<=:fecha2
									group by a.descr_area	
									UNION
									SELECT a.descr_area,sum(pq.num_laminas)as laminas,sum(pq.num_tacos) as tacos
									from sisanatom.biopsia bio inner join sisanatom.detalle_bioce pq on bio.id_biopsia=pq.id_biopsia
									inner join sisanatom.topografia_area ta on bio.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									where a.id_area=2 and bio.fecha_ingreso>=:fecha1 and bio.fecha_ingreso<=:fecha2
									group by a.descr_area ");
		$stmt->execute(array('fecha1'=>$fecha1,'fecha2'=>$fecha2));
		$todos=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $todos;
	}
	//lista de grupos ocupacionales
	public function listagrupos(){
		$stmt=$this->objPdo->prepare("SELECT goc_id,goc_descripcion from grupoocup where (goc_id=1 or goc_id=9) order by goc_id asc ");
		$stmt->execute();
		$lista=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $lista;
	}
	//lista de medicos patologos
	public function listaempleados($goc_id){
		$stmt=$this->objPdo->prepare("SELECT emp_id,(emp_appaterno||' '||emp_apmaterno||' '||emp_nombres)as empleado 
									from empleados where goc_id=:goc_id and (dep_id=27 or dep_id=66) and emp_jefedep='1'
									order by empleado asc  ");
		$stmt->execute(array('goc_id'=>$goc_id));
		$grupos=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $grupos;
	}
	/*PRODUCTIVIDAD DE CADA MES POR PATOLOGO*/
	public function producpat($emp_id,$mes,$anio){
		$stmt=$this->objPdo->prepare("SELECT '1'::integer as numero,'PATOLOGIA QUIRURGICA'::text AS area,empl.emp_id,empl.empleado,(CASE WHEN empato.total_area!=0 THEN empato.total_area ELSE 0 END)AS total_area,
									(CASE WHEN empatofin.total_finalizado!=0 THEN empatofin.total_finalizado ELSE 0 END)as total_finalizado,
									(CASE WHEN empatoatiempo.total_atiempo!=0 THEN empatoatiempo.total_atiempo ELSE 0 END)as total_atiempo,
									(CASE WHEN empatofueratiempo.total_destiempo!=0 THEN empatofueratiempo.total_destiempo ELSE 0 END)as total_destiempo,
									(CASE WHEN empatopen.total_pendiente!=0 THEN empatopen.total_pendiente ELSE 0 END)as total_pendiente,
									((total_finalizado/total_area)*100)as porcentaje FROM
									(select emp_id,(emp_nombres||' '||emp_appaterno||' '||emp_apmaterno) as empleado
									from empleados where emp_id=:emp_id)empl left join
									(select patologo_responsable,a.descr_area,count(*) as total_area 
									from sisanatom.biopsia b 
									inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									where patologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and a.id_area=1
									group by patologo_responsable,a.descr_area)empato on empl.emp_id=empato.patologo_responsable LEFT JOIN

									(select patologo_responsable,a.descr_area,count(*) as total_finalizado 
									from sisanatom.biopsia b 
									inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									where patologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and a.id_area=1 and b.estado_biopsia=3
									group by patologo_responsable,a.descr_area)empatofin on empl.emp_id=empatofin.patologo_responsable LEFT JOIN

								        (select patologo_responsable,count(*) as total_atiempo
									from sisanatom.biopsia b inner join sisanatom.detalle_biopq pq on b.id_biopsia=pq.id_biopsia
									where patologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and b.estado_biopsia=3
									and (pq.fecha_informe::date - b.fecha_ingreso::date)<=10
									group by patologo_responsable)empatoatiempo on empl.emp_id=empatoatiempo.patologo_responsable LEFT JOIN

									(select patologo_responsable,count(*) as total_destiempo
									from sisanatom.biopsia b inner join sisanatom.detalle_biopq pq on b.id_biopsia=pq.id_biopsia
									where patologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and b.estado_biopsia=3
									and (pq.fecha_informe::date - b.fecha_ingreso::date)>10
									group by patologo_responsable)empatofueratiempo on empl.emp_id=empatofueratiempo.patologo_responsable LEFT JOIN

									(select patologo_responsable,a.descr_area,count(*) as total_pendiente 
									from sisanatom.biopsia b 
									inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									where patologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and a.id_area=1 and b.estado_biopsia<3
									group by patologo_responsable,a.descr_area)empatopen on empl.emp_id=empatopen.patologo_responsable

									
									UNION

									SELECT '2'::integer as numero,'CITOLOGIA ESPECIAL'::text AS area,empl.emp_id,empl.empleado,(CASE WHEN empato.total_area!=0 THEN empato.total_area ELSE 0 END)AS total_area,
									(CASE WHEN empatofin.total_finalizado!=0 THEN empatofin.total_finalizado ELSE 0 END)as total_finalizado,
									(CASE WHEN empatoatiempo.total_atiempo!=0 THEN empatoatiempo.total_atiempo ELSE 0 END)as total_atiempo,
									(CASE WHEN empatofueratiempo.total_destiempo!=0 THEN empatofueratiempo.total_destiempo ELSE 0 END)as total_destiempo,
									(CASE WHEN empatopen.total_pendiente!=0 THEN empatopen.total_pendiente ELSE 0 END)as total_pendiente,
									((total_finalizado/total_area)*100)as porcentaje FROM

									(select emp_id,(emp_nombres||' '||emp_appaterno||' '||emp_apmaterno) as empleado
									from empleados where emp_id=:emp_id)empl left join

									(select patologo_responsable,a.descr_area,count(*) as total_area 
									from sisanatom.biopsia b 
									inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									where patologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and a.id_area=2
									group by patologo_responsable,a.descr_area)empato on empl.emp_id=empato.patologo_responsable LEFT JOIN

									(select patologo_responsable,a.descr_area,count(*) as total_finalizado 
									from sisanatom.biopsia b 
									inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									where patologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and a.id_area=2 and b.estado_biopsia=3
									group by patologo_responsable,a.descr_area)empatofin on empl.emp_id=empatofin.patologo_responsable LEFT JOIN

									 (select patologo_responsable,count(*) as total_atiempo
									from sisanatom.biopsia b inner join sisanatom.detalle_bioce pq on b.id_biopsia=pq.id_biopsia
									where patologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and b.estado_biopsia=3
									and (pq.fecha_informe::date - b.fecha_ingreso::date)<=7
									group by patologo_responsable)empatoatiempo on empl.emp_id=empatoatiempo.patologo_responsable LEFT JOIN

									(select patologo_responsable,count(*) as total_destiempo
									from sisanatom.biopsia b inner join sisanatom.detalle_bioce pq on b.id_biopsia=pq.id_biopsia
									where patologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and b.estado_biopsia=3
									and (pq.fecha_informe::date - b.fecha_ingreso::date)>7
									group by patologo_responsable)empatofueratiempo on empl.emp_id=empatofueratiempo.patologo_responsable LEFT JOIN

									(select patologo_responsable,a.descr_area,count(*) as total_pendiente 
									from sisanatom.biopsia b 
									inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									where patologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and a.id_area=2 and b.estado_biopsia<3
									group by patologo_responsable,a.descr_area)empatopen on empl.emp_id=empatopen.patologo_responsable

									UNION

									SELECT '3'::integer as numero,'CITOLOGIA CERVICO VAGINAL'::text AS area,empl.emp_id,empl.empleado,(CASE WHEN empato.total_area!=0 THEN empato.total_area ELSE 0 END)AS total_area,
									(CASE WHEN empatofin.total_finalizado!=0 THEN empatofin.total_finalizado ELSE 0 END)as total_finalizado,
									(CASE WHEN empatoatiempo.total_atiempo!=0 THEN empatoatiempo.total_atiempo ELSE 0 END)as total_atiempo,
									(CASE WHEN empatofueratiempo.total_destiempo!=0 THEN empatofueratiempo.total_destiempo ELSE 0 END)as total_destiempo,
									(CASE WHEN empatopen.total_pendiente!=0 THEN empatopen.total_pendiente ELSE 0 END)as total_pendiente,
									((total_finalizado/total_area)*100)as porcentaje  FROM

									(select emp_id,(emp_nombres||' '||emp_appaterno||' '||emp_apmaterno) as empleado
									from empleados where emp_id=:emp_id)empl left join

									(select patologo_responsable,a.descr_area,count(*) as total_area 
									from sisanatom.biopsia b 
									inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									where patologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and a.id_area=3
									group by patologo_responsable,a.descr_area)empato on empl.emp_id=empato.patologo_responsable LEFT JOIN

									(select patologo_responsable,a.descr_area,count(*) as total_finalizado 
									from sisanatom.biopsia b 
									inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									where patologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and a.id_area=3 and b.estado_biopsia=3
									group by patologo_responsable,a.descr_area)empatofin on empl.emp_id=empatofin.patologo_responsable LEFT JOIN

									(select patologo_responsable,count(*) as total_atiempo
									from sisanatom.biopsia b inner join sisanatom.detalle_bioccv pq on b.id_biopsia=pq.id_biopsia
									where patologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and b.estado_biopsia=3
									and (pq.fecha_informe::date - b.fecha_ingreso::date)<=7
									group by patologo_responsable)empatoatiempo on empl.emp_id=empatoatiempo.patologo_responsable LEFT JOIN

									(select patologo_responsable,count(*) as total_destiempo
									from sisanatom.biopsia b inner join sisanatom.detalle_bioccv pq on b.id_biopsia=pq.id_biopsia
									where patologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and b.estado_biopsia=3
									and (pq.fecha_informe::date - b.fecha_ingreso::date)>7
									group by patologo_responsable)empatofueratiempo on empl.emp_id=empatofueratiempo.patologo_responsable LEFT JOIN
									
									(select patologo_responsable,a.descr_area,count(*) as total_pendiente 
									from sisanatom.biopsia b 
									inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									where patologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and a.id_area=3 and b.estado_biopsia<3
									group by patologo_responsable,a.descr_area)empatopen on empl.emp_id=empatopen.patologo_responsable

									UNION

									SELECT '4'::integer as numero,'INMUNOHISTOQUIMICA'::text AS area,empl.emp_id,empl.empleado,(CASE WHEN empato.total_area!=0 THEN empato.total_area ELSE 0 END)AS total_area,
									(CASE WHEN empatofin.total_finalizado!=0 THEN empatofin.total_finalizado ELSE 0 END)as total_finalizado,
									(CASE WHEN empatoatiempo.total_atiempo!=0 THEN empatoatiempo.total_atiempo ELSE 0 END)as total_atiempo,
									(CASE WHEN empatofueratiempo.total_destiempo!=0 THEN empatofueratiempo.total_destiempo ELSE 0 END)as total_destiempo,
									(CASE WHEN empatopen.total_pendiente!=0 THEN empatopen.total_pendiente ELSE 0 END)as total_pendiente,
									((total_finalizado/total_area)*100)as porcentaje FROM

									(select emp_id,(emp_nombres||' '||emp_appaterno||' '||emp_apmaterno) as empleado
									from empleados where emp_id=:emp_id)empl left join

									(select patologo_responsable,a.descr_area,count(*) as total_area 
									from sisanatom.biopsia b 
									inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									where patologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and a.id_area=4
									group by patologo_responsable,a.descr_area)empato on empl.emp_id=empato.patologo_responsable LEFT JOIN

									(select patologo_responsable,a.descr_area,count(*) as total_finalizado 
									from sisanatom.biopsia b 
									inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									where patologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and a.id_area=4 and b.estado_biopsia=3
									group by patologo_responsable,a.descr_area)empatofin on empl.emp_id=empatofin.patologo_responsable LEFT JOIN

									(select patologo_responsable,count(*) as total_atiempo
									from sisanatom.biopsia b inner join sisanatom.detalle_bioih pq on b.id_biopsia=pq.id_biopsia
									where patologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and b.estado_biopsia=3
									and (pq.fecha_informe::date - b.fecha_ingreso::date)<=10
									group by patologo_responsable)empatoatiempo on empl.emp_id=empatoatiempo.patologo_responsable LEFT JOIN

									(select patologo_responsable,count(*) as total_destiempo
									from sisanatom.biopsia b inner join sisanatom.detalle_bioih pq on b.id_biopsia=pq.id_biopsia
									where patologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and b.estado_biopsia=3
									and (pq.fecha_informe::date - b.fecha_ingreso::date)>10
									group by patologo_responsable)empatofueratiempo on empl.emp_id=empatofueratiempo.patologo_responsable LEFT JOIN

									(select patologo_responsable,a.descr_area,count(*) as total_pendiente 
									from sisanatom.biopsia b 
									inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									where patologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and a.id_area=4 and b.estado_biopsia<3
									group by patologo_responsable,a.descr_area)empatopen on empl.emp_id=empatopen.patologo_responsable

									ORDER BY numero ASC ");
		$stmt->execute(array('emp_id'=>$emp_id,'mes'=>$mes,'anio'=>$anio));
		$produccion=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $produccion;
	}

	//obtener nombre de empleado
	public function nomep($emp_id){
		$stmt=$this->objPdo->prepare("SELECT (emp_nombres||' '||emp_appaterno||' '||emp_apmaterno) as nombreemp from empleados where emp_id=:emp_id ");
		$stmt->execute(array('emp_id'=>$emp_id));
		$nombre=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $nombre[0]->nombreemp;
	}

	public function productec($emp_id,$mes,$anio){
		$stmt=$this->objPdo->prepare("SELECT '1'::integer as numero,'PATOLOGIA QUIRURGICA'::text AS area,empl.emp_id,empl.empleado,(CASE WHEN empato.total_area!=0 THEN empato.total_area ELSE 0 END)AS total_area,
								(CASE WHEN empatofin.total_finalizado!=0 THEN empatofin.total_finalizado ELSE 0 END)as total_finalizado,
								(CASE WHEN empatoatiempo.total_atiempo!=0 THEN empatoatiempo.total_atiempo ELSE 0 END)as total_atiempo,
								(CASE WHEN empatodestiempo.total_destiempo!=0 THEN empatodestiempo.total_destiempo ELSE 0 END)as total_destiempo,
								(CASE WHEN empatopen.total_pendiente!=0 THEN empatopen.total_pendiente ELSE 0 END)as total_pendiente FROM

								(select emp_id,(emp_nombres||' '||emp_appaterno||' '||emp_apmaterno) as empleado
								from empleados where emp_id=:emp_id)empl left join

								(select tecnologo_responsable,a.descr_area,count(*) as total_area 
								from sisanatom.biopsia b 
								inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
								where tecnologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and a.id_area=1
								group by tecnologo_responsable,a.descr_area)empato on empl.emp_id=empato.tecnologo_responsable LEFT JOIN

								(select tecnologo_responsable,a.descr_area,count(*) as total_finalizado 
								from sisanatom.biopsia b 
								inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
								where tecnologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and a.id_area=1 and b.estado_biopsia>=2
								group by tecnologo_responsable,a.descr_area)empatofin on empl.emp_id=empatofin.tecnologo_responsable LEFT JOIN

								(select tecnologo_responsable,count(*) as total_atiempo from sisanatom.biopsia b inner join sisanatom.detalle_biopq pq on b.id_biopsia=pq.id_biopsia
								where tecnologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and b.estado_biopsia>=2
								and (pq.fecha_macro::date - b.fecha_ingreso::date)<=6
								group by tecnologo_responsable)empatoatiempo on empl.emp_id=empatoatiempo.tecnologo_responsable LEFT JOIN

								(select tecnologo_responsable,count(*) as total_destiempo from sisanatom.biopsia b inner join sisanatom.detalle_biopq pq on b.id_biopsia=pq.id_biopsia
								where tecnologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and b.estado_biopsia>=2
								and (pq.fecha_macro::date - b.fecha_ingreso::date)>6
								group by tecnologo_responsable)empatodestiempo on empl.emp_id=empatodestiempo.tecnologo_responsable LEFT JOIN 
								
								(select tecnologo_responsable,a.descr_area,count(*) as total_pendiente 
								from sisanatom.biopsia b 
								inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
								where tecnologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and a.id_area=1 and b.estado_biopsia<2
								group by tecnologo_responsable,a.descr_area)empatopen on empl.emp_id=empatopen.tecnologo_responsable

								UNION

								SELECT '2'::integer as numero,'CITOLOGIA ESPECIAL'::text AS area,empl.emp_id,empl.empleado,(CASE WHEN empato.total_area!=0 THEN empato.total_area ELSE 0 END)AS total_area,
								(CASE WHEN empatofin.total_finalizado!=0 THEN empatofin.total_finalizado ELSE 0 END)as total_finalizado,
								(CASE WHEN empatoatiempo.total_atiempo!=0 THEN empatoatiempo.total_atiempo ELSE 0 END)as total_atiempo,
								(CASE WHEN empatodestiempo.total_destiempo!=0 THEN empatodestiempo.total_destiempo ELSE 0 END)as total_destiempo,
								(CASE WHEN empatopen.total_pendiente!=0 THEN empatopen.total_pendiente ELSE 0 END)as total_pendiente FROM

								(select emp_id,(emp_nombres||' '||emp_appaterno||' '||emp_apmaterno) as empleado
								from empleados where emp_id=:emp_id)empl left join

								(select tecnologo_responsable,a.descr_area,count(*) as total_area 
								from sisanatom.biopsia b 
								inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
								where tecnologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and a.id_area=2
								group by tecnologo_responsable,a.descr_area)empato on empl.emp_id=empato.tecnologo_responsable LEFT JOIN

								(select tecnologo_responsable,a.descr_area,count(*) as total_finalizado 
								from sisanatom.biopsia b 
								inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
								where tecnologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and a.id_area=2 and b.estado_biopsia>=2
								group by tecnologo_responsable,a.descr_area)empatofin on empl.emp_id=empatofin.tecnologo_responsable LEFT JOIN

								(select tecnologo_responsable,count(*) as total_atiempo from sisanatom.biopsia b inner join sisanatom.detalle_bioce pq on b.id_biopsia=pq.id_biopsia
								where tecnologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and b.estado_biopsia>=2
								and (pq.fechareg_macroce::date - b.fecha_ingreso::date)<=6
								group by tecnologo_responsable)empatoatiempo on empl.emp_id=empatoatiempo.tecnologo_responsable LEFT JOIN

								(select tecnologo_responsable,count(*) as total_destiempo from sisanatom.biopsia b inner join sisanatom.detalle_bioce pq on b.id_biopsia=pq.id_biopsia
								where tecnologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and b.estado_biopsia>=2
								and (pq.fechareg_macroce::date - b.fecha_ingreso::date)>6
								group by tecnologo_responsable)empatodestiempo on empl.emp_id=empatodestiempo.tecnologo_responsable LEFT JOIN 
								
								(select tecnologo_responsable,a.descr_area,count(*) as total_pendiente 
								from sisanatom.biopsia b 
								inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
								where tecnologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and a.id_area=2 and b.estado_biopsia<2
								group by tecnologo_responsable,a.descr_area)empatopen on empl.emp_id=empatopen.tecnologo_responsable

								UNION

								SELECT '3'::integer as numero,'CITOLOGIA CERVICO VAGINAL'::text AS area,empl.emp_id,empl.empleado,(CASE WHEN empato.total_area!=0 THEN empato.total_area ELSE 0 END)AS total_area,
								(CASE WHEN empatofin.total_finalizado!=0 THEN empatofin.total_finalizado ELSE 0 END)as total_finalizado,
								(CASE WHEN empatoatiempo.total_atiempo!=0 THEN empatoatiempo.total_atiempo ELSE 0 END)as total_atiempo,
								(CASE WHEN empatodestiempo.total_destiempo!=0 THEN empatodestiempo.total_destiempo ELSE 0 END)as total_destiempo,
								(CASE WHEN empatopen.total_pendiente!=0 THEN empatopen.total_pendiente ELSE 0 END)as total_pendiente FROM

								(select emp_id,(emp_nombres||' '||emp_appaterno||' '||emp_apmaterno) as empleado
								from empleados where emp_id=:emp_id)empl left join

								(select bc.tecnologo,a.descr_area,count(*) as total_area 
								from  sisanatom.detalle_bioccv bc inner join sisanatom.biopsia b on b.id_biopsia=bc.id_biopsia
								inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
								where bc.tecnologo=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and a.id_area=3
								group by bc.tecnologo,a.descr_area)empato on empl.emp_id=empato.tecnologo LEFT JOIN

								(select bc.tecnologo,a.descr_area,count(*) as total_finalizado 
								from  sisanatom.detalle_bioccv bc inner join sisanatom.biopsia b on b.id_biopsia=bc.id_biopsia
								inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
								where bc.tecnologo=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and a.id_area=3 and b.estado_biopsia>=2
								group by bc.tecnologo,a.descr_area)empatofin on empl.emp_id=empatofin.tecnologo LEFT JOIN

								(select tecnologo,count(*) as total_atiempo from sisanatom.biopsia b inner join sisanatom.detalle_bioccv pq on b.id_biopsia=pq.id_biopsia
								where pq.tecnologo=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and b.estado_biopsia>=2
								and (pq.fecha_informe::date - b.fecha_ingreso::date)<=7
								group by tecnologo)empatoatiempo on empl.emp_id=empatoatiempo.tecnologo LEFT JOIN

								(select tecnologo,count(*) as total_destiempo from sisanatom.biopsia b inner join sisanatom.detalle_bioccv pq on b.id_biopsia=pq.id_biopsia
								where pq.tecnologo=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and b.estado_biopsia>=2
								and (pq.fecha_informe::date - b.fecha_ingreso::date)>7
								group by tecnologo)empatodestiempo on empl.emp_id=empatodestiempo.tecnologo LEFT JOIN
								
								(select bc.tecnologo,a.descr_area,count(*) as total_pendiente 
								from  sisanatom.detalle_bioccv bc inner join sisanatom.biopsia b on b.id_biopsia=bc.id_biopsia
								inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
								where bc.tecnologo=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and a.id_area=3 and b.estado_biopsia<2
								group by bc.tecnologo,a.descr_area)empatopen on empl.emp_id=empatopen.tecnologo

								UNION

								SELECT '4'::integer as numero,'INMUNOHISTOQUIMICA'::text AS area,empl.emp_id,empl.empleado,(CASE WHEN empato.total_area!=0 THEN empato.total_area ELSE 0 END)AS total_area,
								(CASE WHEN empatofin.total_finalizado!=0 THEN empatofin.total_finalizado ELSE 0 END)as total_finalizado,
								(CASE WHEN empatoatiempo.total_atiempo!=0 THEN empatoatiempo.total_atiempo ELSE 0 END)as total_atiempo,
								(CASE WHEN empatodestiempo.total_destiempo!=0 THEN empatodestiempo.total_destiempo ELSE 0 END)as total_destiempo,
								(CASE WHEN empatopen.total_pendiente!=0 THEN empatopen.total_pendiente ELSE 0 END)as total_pendiente FROM

								(select emp_id,(emp_nombres||' '||emp_appaterno||' '||emp_apmaterno) as empleado
								from empleados where emp_id=:emp_id)empl left join

								(select tecnologo_responsable,a.descr_area,count(*) as total_area 
								from sisanatom.biopsia b 
								inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
								where tecnologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and a.id_area=4
								group by tecnologo_responsable,a.descr_area)empato on empl.emp_id=empato.tecnologo_responsable LEFT JOIN

								(select tecnologo_responsable,a.descr_area,count(*) as total_finalizado 
								from sisanatom.biopsia b 
								inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
								where tecnologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and a.id_area=4 and b.estado_biopsia>=2
								group by tecnologo_responsable,a.descr_area)empatofin on empl.emp_id=empatofin.tecnologo_responsable LEFT JOIN

								(select tecnologo_responsable,count(*) as total_atiempo from sisanatom.biopsia b inner join sisanatom.detalle_bioih pq on b.id_biopsia=pq.id_biopsia
								where tecnologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and b.estado_biopsia>=2
								and (pq.fechareg_macroih::date - b.fecha_ingreso::date)<=7
								group by tecnologo_responsable)empatoatiempo on empl.emp_id=empatoatiempo.tecnologo_responsable LEFT JOIN

								(select tecnologo_responsable,count(*) as total_destiempo from sisanatom.biopsia b inner join sisanatom.detalle_bioih pq on b.id_biopsia=pq.id_biopsia
								where tecnologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and b.estado_biopsia>=2
								and (pq.fechareg_macroih::date - b.fecha_ingreso::date)>7
								group by tecnologo_responsable)empatodestiempo on empl.emp_id=empatodestiempo.tecnologo_responsable LEFT JOIN
								
								(select tecnologo_responsable,a.descr_area,count(*) as total_pendiente 
								from sisanatom.biopsia b 
								inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
								where tecnologo_responsable=:emp_id and EXTRACT(MONTH FROM fecha_ingreso)=:mes and EXTRACT(YEAR FROM fecha_ingreso)=:anio and a.id_area=4 and b.estado_biopsia<2
								group by tecnologo_responsable,a.descr_area)empatopen on empl.emp_id=empatopen.tecnologo_responsable

								ORDER BY numero ASC");
		$stmt->execute(array('emp_id'=>$emp_id,'mes'=>$mes,'anio'=>$anio));
		$protec=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $protec;
	}

	public function infocanceroncologia($fecha1,$fecha2){
		$stmt=$this->objPdo->prepare("SELECT pq.id_ubicacion,ub.descr_ubicacion,b.id_biopsia,b.num_biopsia,pac.dni,(pac.a_paterno||' '||pac.a_materno||' '||pac.nombre) as paciente,b.fecha_ingreso
									 from sisanatom.biopsia b inner join sisanatom.detalle_biopq pq on b.id_biopsia=pq.id_biopsia
									inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area inner join sisanatom.result_bio rb on pq.id_res=rb.id_res
									inner join sisanatom.ubicacion_bio ub on pq.id_ubicacion=ub.id_ubicacion inner join sisemer.paciente pac on b.id_paciente=pac.id_paciente
									where a.id_area=1 and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2 and pq.id_res=3 and b.id_institucion=29
									ORDER BY ub.descr_ubicacion ASC ");
		$stmt->execute(array('fecha1'=>$fecha1,'fecha2'=>$fecha2));
		$infocol=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $infocol;
	}

	public function infodisplaoncologia($fecha1,$fecha2){
		$stmt=$this->objPdo->prepare("SELECT pq.id_ubicacion,ub.descr_ubicacion,b.id_biopsia,b.num_biopsia,pac.dni,(pac.a_paterno||' '||pac.a_materno||' '||pac.nombre) as paciente,b.fecha_ingreso
									 from sisanatom.biopsia b inner join sisanatom.detalle_biopq pq on b.id_biopsia=pq.id_biopsia
									inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area inner join sisanatom.result_bio rb on pq.id_res=rb.id_res
									inner join sisanatom.ubicacion_bio ub on pq.id_ubicacion=ub.id_ubicacion inner join sisemer.paciente pac on b.id_paciente=pac.id_paciente
									where a.id_area=1 and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2 and pq.id_res=2 and b.id_institucion=29
									ORDER BY ub.descr_ubicacion ASC ");
		$stmt->execute(array('fecha1'=>$fecha1,'fecha2'=>$fecha2));
		$infodis=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $infodis;
	}

	public function promediotiempo($fecha1,$fecha2){
		$stmt=$this->objPdo->prepare("SELECT tpq.codigo,tpq.area,tpq.numero,(CASE WHEN tpq.dias!=0 THEN tpq.dias ELSE 0 END)as dias,(CASE WHEN (tpq.dias/tpq.numero)!=0 THEN (tpq.dias/tpq.numero) ELSE 0 END)as tiempo FROM
									(select 1::integer as codigo,'PATOLOGIA QUIRURGICA'::text as area,count(*) as numero,SUM(pq.fecha_informe-b.fecha_ingreso)as dias from sisanatom.biopsia b inner join sisanatom.detalle_biopq pq on b.id_biopsia=pq.id_biopsia 
									where b.estado_biopsia=3 and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2)tpq

									union
									SELECT tce.codigo,tce.area,tce.numero,(CASE WHEN tce.dias!=0 THEN tce.dias ELSE 0 END)as dias,(CASE WHEN (tce.dias/tce.numero)!=0 THEN (tce.dias/tce.numero) ELSE 0 END)as tiempo FROM
									(select 2::integer as codigo,'CITOLOGIA ESPECIAL'::text as area,count(*) as numero,SUM(pq.fecha_informe-b.fecha_ingreso)as dias from sisanatom.biopsia b inner join sisanatom.detalle_bioce pq on b.id_biopsia=pq.id_biopsia 
									where b.estado_biopsia=3 and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2)tce
									union
									SELECT tccv.codigo,tccv.area,tccv.numero,(CASE WHEN tccv.dias!=0 THEN tccv.dias ELSE 0 END)as dias,(CASE WHEN (tccv.dias/tccv.numero)!=0 THEN (tccv.dias/tccv.numero) ELSE 0 END)as tiempo FROM
									(select 3::integer as codigo,'CITOLOGIA CERVICO VAGINAL'::text as area,count(*) as numero,SUM(pq.fecha_informe-b.fecha_ingreso)as dias from sisanatom.biopsia b inner join sisanatom.detalle_bioccv pq on b.id_biopsia=pq.id_biopsia 
									where b.estado_biopsia=3 and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2)tccv
									union
									SELECT tih.codigo,tih.area,tih.numero,(CASE WHEN tih.dias!=0 THEN tih.dias ELSE 0 END)as dias,(CASE WHEN (tih.dias/tih.numero)!=0 THEN (tih.dias/tih.numero) ELSE 0 END)as tiempo FROM
									(select 4::integer as codigo,'INMUNOHISTOQUIMICA'::text as area,count(*) as numero,SUM(pq.fecha_informe-b.fecha_ingreso)as dias from sisanatom.biopsia b inner join sisanatom.detalle_bioih pq on b.id_biopsia=pq.id_biopsia 
									where b.estado_biopsia=3 and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2)tih
									ORDER BY codigo asc  ");
		$stmt->execute(array('fecha1'=>$fecha1,'fecha2'=>$fecha2));
		$ponderado=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $ponderado;
	}


	//informes de controles de seguridad
	public function movimientoxempleado($emp_id,$fecha1,$fecha2){
		$stmt=$this->objPdo->prepare("SELECT (e.emp_appaterno||' '||e.emp_apmaterno||' '||e.emp_nombres) as usuario,ba.accion,fecha::date||' '||
									to_char(to_timestamp(((EXTRACT (HOUR FROM fecha))||':'||(EXTRACT (MINUTE from fecha))),'HH24:MI'),'HH:MI p.m.')as fecha,ba.tabla,ba.host,ba.hostname,ba.campo
									from sisanatom.bitacora_anat ba inner join sisanatom.usuarios_anat ua on ba.id_usuario=ua.id_usuario 
									inner join empleados e on ua.emp_id=e.emp_id where fecha::date>=:fecha1 and fecha::date<=:fecha2 and e.emp_id=:emp_id
									order by usuario asc ");
		$stmt->execute(array('emp_id'=>$emp_id,'fecha1'=>$fecha1,'fecha2'=>$fecha2));
		$movemp=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $movemp;
	}

	public function movimientotodos($fecha1,$fecha2){
		$stmt=$this->objPdo->prepare("SELECT (e.emp_appaterno||' '||e.emp_apmaterno||' '||e.emp_nombres) as usuario,ba.accion,fecha::date||' '||
									to_char(to_timestamp(((EXTRACT (HOUR FROM fecha))||':'||(EXTRACT (MINUTE from fecha))),'HH24:MI'),'HH:MI p.m.')as fecha,ba.tabla,ba.host,ba.hostname,ba.campo
									from sisanatom.bitacora_anat ba inner join sisanatom.usuarios_anat ua on ba.id_usuario=ua.id_usuario 
									inner join empleados e on ua.emp_id=e.emp_id
									where fecha::date>=:fecha1 and fecha::date<=:fecha2
									order by usuario,fecha asc ");
		$stmt->execute(array('fecha1'=>$fecha1,'fecha2'=>$fecha2));
		$movtodos=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $movtodos;
	}

	public function conexiones_user($emp_id,$fecha1,$fecha2){
        $stmt=$this->objPdo->prepare("SELECT cu.fecha_conexion::date,to_char(to_timestamp(((EXTRACT (HOUR FROM cu.fecha_conexion))||':'||(EXTRACT (MINUTE from cu.fecha_conexion))),'HH24:MI'),'HH:MI p.m.') as hora_conexion,
                                        cu.fecha_desconexion::date,to_char(to_timestamp(((EXTRACT (HOUR FROM cu.fecha_desconexion))||':'||(EXTRACT (MINUTE from cu.fecha_desconexion))),'HH24:MI'),'HH:MI p.m.')as hora_desconexion,cu.host,cu.hostname from sisanatom.conexion_usuario cu inner join sisanatom.usuarios_anat ua on cu.id_usuario=ua.id_usuario
                                        inner join empleados e on ua.emp_id=e.emp_id
                                        where e.emp_id=:emp_id and fecha_conexion::date>=:fecha1 and fecha_conexion::date<=:fecha2 order by fecha_conexion,hora_conexion asc ");
        $stmt->execute(array('emp_id'=>$emp_id,'fecha1'=>$fecha1,'fecha2'=>$fecha2));
        $conexiones=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $conexiones;
    }

    public function historial_perfuser($emp_id){
    	$stmt=$this->objPdo->prepare("SELECT hp.fecha_registro::date||' '||to_char(to_timestamp(((EXTRACT (HOUR FROM hp.fecha_registro))||':'||(EXTRACT (MINUTE from hp.fecha_registro))),'HH24:MI'),'HH:MI p.m.')as fecha_historial,
									pu.descr_perfil from sisanatom.historial_perfil hp inner join sisanatom.usuarios_anat ua on hp.id_usuario=ua.id_usuario 
									inner join sisanatom.perfil_usuarios pu on hp.id_perfil=pu.id_perfil inner join empleados e on ua.emp_id=e.emp_id
									where e.emp_id=:emp_id");
    	$stmt->execute(array('emp_id'=>$emp_id));
    	$histoperfiles=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $histoperfiles;
    }

    public function indice_precision($fecha1,$fecha2){
    	$stmt=$this->objPdo->prepare("SELECT '1'::integer as codigo,biopsiapqfin.area,biopsiapqfin.cantidad_finalizadas,biopsiapqaut.cantidad_autorizadas,(biopsiapqfin.cantidad_finalizadas-biopsiapqaut.cantidad_autorizadas) as diferencia FROM
									(select 'PATOLOGIA QUIRURGICA'::text as area,count(*) as cantidad_finalizadas from sisanatom.biopsia b inner join sisanatom.topografia_area ta on b.id_top=ta.id_top
									inner join sisanatom.area a on a.id_area=ta.id_area
									where a.id_area=1 and estado_biopsia=3 and fecha_ingreso>=:fecha1 and fecha_ingreso<=:fecha2)biopsiapqfin INNER JOIN

									(SELECT 'PATOLOGIA QUIRURGICA'::text as area,count(*) as cantidad_autorizadas FROM
									(SELECT bfpq.id_biopsia FROM
									(select id_biopsia from sisanatom.biopsia b inner join sisanatom.topografia_area ta on b.id_top=ta.id_top
									inner join sisanatom.area a on a.id_area=ta.id_area
									where a.id_area=1 and estado_biopsia=3 and fecha_ingreso>=:fecha1 and fecha_ingreso<=:fecha2)bfpq

									INNER JOIN (select id_biopsia from sisanatom.autorizaciones_biopsias /*de agregarse el estado de autorizacion se colocaria aqui la condicion en todas las demas*/
									group by id_biopsia)bfab ON bfpq.id_biopsia=bfab.id_biopsia)biogpq)biopsiapqaut ON biopsiapqfin.area=biopsiapqaut.area

									union 

									SELECT '2'::integer as codigo,biopsiapqfin.area,biopsiapqfin.cantidad_finalizadas,biopsiapqaut.cantidad_autorizadas,(biopsiapqfin.cantidad_finalizadas-biopsiapqaut.cantidad_autorizadas) as diferencia FROM
									(select 'CITOLOGIA ESPECIAL'::text as area,count(*) as cantidad_finalizadas from sisanatom.biopsia b inner join sisanatom.topografia_area ta on b.id_top=ta.id_top
									inner join sisanatom.area a on a.id_area=ta.id_area
									where a.id_area=2 and estado_biopsia=3 and fecha_ingreso>=:fecha1 and fecha_ingreso<=:fecha2)biopsiapqfin INNER JOIN

									(SELECT 'CITOLOGIA ESPECIAL'::text as area,count(*) as cantidad_autorizadas FROM
									(SELECT bfpq.id_biopsia FROM
									(select id_biopsia from sisanatom.biopsia b inner join sisanatom.topografia_area ta on b.id_top=ta.id_top
									inner join sisanatom.area a on a.id_area=ta.id_area
									where a.id_area=2 and estado_biopsia=3 and fecha_ingreso>=:fecha1 and fecha_ingreso<=:fecha2)bfpq

									INNER JOIN (select id_biopsia from sisanatom.autorizaciones_biopsias 
									group by id_biopsia)bfab ON bfpq.id_biopsia=bfab.id_biopsia)biogpq)biopsiapqaut ON biopsiapqfin.area=biopsiapqaut.area

									union

									SELECT '3'::integer as codigo,biopsiapqfin.area,biopsiapqfin.cantidad_finalizadas,biopsiapqaut.cantidad_autorizadas,(biopsiapqfin.cantidad_finalizadas-biopsiapqaut.cantidad_autorizadas) as diferencia FROM
									(select 'CITOLOGIA CERVICO VAGINAL'::text as area,count(*) as cantidad_finalizadas from sisanatom.biopsia b inner join sisanatom.topografia_area ta on b.id_top=ta.id_top
									inner join sisanatom.area a on a.id_area=ta.id_area
									where a.id_area=3 and estado_biopsia=3 and fecha_ingreso>=:fecha1 and fecha_ingreso<=:fecha2)biopsiapqfin INNER JOIN

									(SELECT 'CITOLOGIA CERVICO VAGINAL'::text as area,count(*) as cantidad_autorizadas FROM
									(SELECT bfpq.id_biopsia FROM
									(select id_biopsia from sisanatom.biopsia b inner join sisanatom.topografia_area ta on b.id_top=ta.id_top
									inner join sisanatom.area a on a.id_area=ta.id_area
									where a.id_area=3 and estado_biopsia=3 and fecha_ingreso>=:fecha1 and fecha_ingreso<=:fecha2)bfpq

									INNER JOIN (select id_biopsia from sisanatom.autorizaciones_biopsias 
									group by id_biopsia)bfab ON bfpq.id_biopsia=bfab.id_biopsia)biogpq)biopsiapqaut ON biopsiapqfin.area=biopsiapqaut.area

									UNION

									SELECT '4'::integer as codigo,biopsiapqfin.area,biopsiapqfin.cantidad_finalizadas,biopsiapqaut.cantidad_autorizadas,(biopsiapqfin.cantidad_finalizadas-biopsiapqaut.cantidad_autorizadas) as diferencia FROM
									(select 'INMUNOHISTOQUIMICA'::text as area,count(*) as cantidad_finalizadas from sisanatom.biopsia b inner join sisanatom.topografia_area ta on b.id_top=ta.id_top
									inner join sisanatom.area a on a.id_area=ta.id_area
									where a.id_area=4 and estado_biopsia=3 and fecha_ingreso>=:fecha1 and fecha_ingreso<=:fecha2)biopsiapqfin INNER JOIN

									(SELECT 'INMUNOHISTOQUIMICA'::text as area,count(*) as cantidad_autorizadas FROM
									(SELECT bfpq.id_biopsia FROM
									(select id_biopsia from sisanatom.biopsia b inner join sisanatom.topografia_area ta on b.id_top=ta.id_top
									inner join sisanatom.area a on a.id_area=ta.id_area
									where a.id_area=4 and estado_biopsia=3 and fecha_ingreso>=:fecha1 and fecha_ingreso<=:fecha2)bfpq

									INNER JOIN (select id_biopsia from sisanatom.autorizaciones_biopsias /*de agregarse el estado de autorizacion se colocaria aqui la condicion en todas las demas*/
									group by id_biopsia)bfab ON bfpq.id_biopsia=bfab.id_biopsia)biogpq)biopsiapqaut ON biopsiapqfin.area=biopsiapqaut.area

									ORDER BY codigo ASC  ");
    	$stmt->execute(array('fecha1'=>$fecha1,'fecha2'=>$fecha2));
    	$indices=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $indices;
    }

    // public function reporte_calidad($mes,$anio){
    // 	$stmt=$this->objPdo->prepare("SELECT '1'::integer as numero,'TOTAL DE EXAMENES Y PROCEDIMIENTOS'::text as examen,(dpq.total+dcit.total+pih.total+bcrom.total+bcong.total)as total FROM
				// 					(SELECT 'DIAGNOSTICOS'::text as examen,(t1.totalbio+t2.totalbio)as total FROM
				// 					(select 'PATOLOGIA QUIRURGICA'::text as area,count(*) as totalbio from sisanatom.biopsia b inner join sisanatom.tipo_biopsia tb on b.tipo_estudio=tb.codigo
				// 					where tb.tipo like '%BIOPSIA%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)t1 left join

				// 					(select 'PATOLOGIA QUIRURGICA'::text as area,count(*) as totalbio from sisanatom.biopsia b inner join sisanatom.tipo_biopsia tb on b.tipo_estudio=tb.codigo
				// 					where tb.tipo like '%PIEZA QUIRURGICA%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)t2 on t1.area=t2.area)dpq inner join 

				// 					(SELECT  'DIAGNOSTICOS'::text as examen,(bpap.total+bbaaf.total+bsecre.total+bliquid.total+bmi.total)as total FROM 
				// 					(select 'EXAMEN'::text as examen,count(*)as total  from sisanatom.biopsia b inner join sisanatom.detalle_bioccv bc on b.id_biopsia=bc.id_biopsia inner join
				// 					sisanatom.topografia_area ta on ta.id_top=b.id_top inner join sisanatom.area a on ta.id_area=a.id_area
				// 					where a.id_area=3 and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)bpap left join

				// 					(select 'EXAMEN'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
				// 					inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra
				// 					where descr_muestra like '%BAAF%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)bbaaf on bpap.examen=bbaaf.examen left join

				// 					(select 'EXAMEN'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
				// 					inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra
				// 					where descr_muestra like '%SECRECION%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)bsecre on bpap.examen=bsecre.examen left join 

				// 					(select 'EXAMEN'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
				// 					inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
				// 					where descr_muestra like '%LIQUIDO%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio and a.id_area=2)bliquid on bpap.examen=bliquid.examen
				// 					left join (select 'EXAMEN'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
				// 					inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra
				// 					where descr_muestra like '%MIELOGRAMA%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)bmi on bpap.examen=bmi.examen)dcit 
				// 					on dpq.examen=dcit.examen left join 
				// 					(select 'DIAGNOSTICOS'::text as examen,(CASE WHEN sum(mp.cantidad)>0 THEN sum(mp.cantidad) ELSE 0 END)as total from sisanatom.control_pruebasih cp 
				// 					inner join sisanatom.marcador_prueba mp on cp.id_control=mp.prueba inner join sisanatom.biopsia b on cp.id_biopsia=b.id_biopsia
				// 					where EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)pih on dpq.examen=pih.examen LEFT JOIN
				// 					(select 'DIAGNOSTICOS'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
				// 					inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra
				// 					where descr_muestra like '%CROMATINA SEXUAL%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)bcrom on dpq.examen=bcrom.examen LEFT JOIN
				// 					(select 'DIAGNOSTICOS'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a 
				// 					on a.id_area=ta.id_area where a.descr_area like '%PATOLOGIA QUIRURGICA%' and b.bio_congelacion='0' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)bcong 
				// 					ON dpq.examen=bcong.examen

				// 					UNION
				// 					/*numero de diagnosticos de patologia quirurgica--primera parte del reporte*/
				// 					SELECT '2'::integer as numero,'DIAGNOSTICOS DE PATOLOGIA QUIRURGICA'::text as examen,(t1.totalbio+t2.totalbio)as total FROM
				// 					(select 'PATOLOGIA QUIRURGICA'::text as area,count(*) as totalbio from sisanatom.biopsia b inner join sisanatom.tipo_biopsia tb on b.tipo_estudio=tb.codigo
				// 					where tb.tipo like '%BIOPSIA%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)t1 left join

				// 					(select 'PATOLOGIA QUIRURGICA'::text as area,count(*) as totalbio from sisanatom.biopsia b inner join sisanatom.tipo_biopsia tb on b.tipo_estudio=tb.codigo
				// 					where tb.tipo like '%PIEZA QUIRURGICA%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)t2 on t1.area=t2.area
				// 					UNION
				// 					select '3'::integer as numero,'BIOPSIAS'::text as examen,count(*) as totalbio from sisanatom.biopsia b inner join sisanatom.tipo_biopsia tb on b.tipo_estudio=tb.codigo
				// 					where tb.tipo like '%BIOPSIA%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio
				// 					UNION
				// 					select '4'::integer as numero,'PIEZA QUIRURGICA'::text as examen,count(*) as totalbio from sisanatom.biopsia b inner join sisanatom.tipo_biopsia tb on b.tipo_estudio=tb.codigo
				// 					where tb.tipo like '%PIEZA QUIRURGICA%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio
				// 					union
				// 					/*numero de diagnosticos citologicos*/
				// 					SELECT  '5'::integer as numero,'DIAGNOSTICOS CITOLOGICOS'::text as examen,(bpap.total+bbaaf.total+bsecre.total+bliquid.total+baspi.total)as total FROM 
				// 					(select 'EXAMEN'::text as examen,count(*)as total  from sisanatom.biopsia b inner join sisanatom.detalle_bioccv bc on b.id_biopsia=bc.id_biopsia inner join
				// 					sisanatom.topografia_area ta on ta.id_top=b.id_top inner join sisanatom.area a on ta.id_area=a.id_area
				// 					where a.id_area=3 and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)bpap left join

				// 					(select 'EXAMEN'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
				// 					inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra
				// 					where descr_muestra like '%BAAF%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)bbaaf on bpap.examen=bbaaf.examen left join

				// 					(select 'EXAMEN'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
				// 					inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra
				// 					where descr_muestra like '%SECRECION%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)bsecre on bpap.examen=bsecre.examen left join 

				// 					(select 'EXAMEN'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
				// 					inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
				// 					where descr_muestra like '%LIQUIDO%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio and a.id_area=2)bliquid on bpap.examen=bliquid.examen
				// 					left join (select 'EXAMEN'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
				// 					inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra
				// 					where descr_muestra like '%MIELOGRAMA%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)baspi on bpap.examen=baspi.examen
				// 					UNION
				// 					select  '6'::integer as numero,'LECTURAS DE PAP'::text as examen,count(*)as total  from sisanatom.biopsia b inner join sisanatom.detalle_bioccv bc on b.id_biopsia=bc.id_biopsia inner join
				// 					sisanatom.topografia_area ta on ta.id_top=b.id_top inner join sisanatom.area a on ta.id_area=a.id_area
				// 					where a.id_area=3 and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio
				// 					UNION
				// 					select '7'::integer as numero,'LECTURAS DE LIQUIDOS'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
				// 					inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
				// 					where descr_muestra like '%LIQUIDO%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio and a.id_area=2
				// 					UNION
				// 					select '8'::integer as numero,'LECTURA DE BAAF'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
				// 					inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra
				// 					where descr_muestra like '%BAAF%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio
				// 					UNION
				// 					select '9'::integer as numero,'SECRECIONES'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
				// 					inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra
				// 					where descr_muestra like '%SECRECION%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio
				// 					UNION
				// 					select '10'::integer as numero,'ASPIRACION DE MEDULA OSEA(MIELOGRAMA)'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
				// 					inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra
				// 					where descr_muestra like '%MIELOGRAMA%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio
				// 					UNION
				// 					/*PROCEDIMIENTOS DE INMUNOHISTOQUIMICA*/
				// 					select '11'::integer as numero,'PROCEDIMIENTO DE INMUNOHISTOQUIMICA'::text as examen,(CASE WHEN sum(mp.cantidad)>0 THEN sum(mp.cantidad) ELSE 0 END)as total from sisanatom.control_pruebasih cp 
				// 					inner join sisanatom.marcador_prueba mp on cp.id_control=mp.prueba inner join sisanatom.biopsia b on cp.id_biopsia=b.id_biopsia
				// 					where EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio
				// 					UNION
				// 					select '12'::integer as numero,'CROMATINA SEXUAL'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
				// 					inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra
				// 					where descr_muestra like '%CROMATINA SEXUAL%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio
				// 					UNION
				// 					select '13'::integer as numero,'BIOPSIA POR CONGELACION'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a 
				// 					on a.id_area=ta.id_area where a.descr_area like '%PATOLOGIA QUIRURGICA%' and b.bio_congelacion='0' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio
				// 					ORDER BY numero asc  ");
    // 	$stmt->execute(array('mes'=>$mes,'anio'=>$anio));
    // 	$rcalidad=$stmt->fetchAll(PDO::FETCH_OBJ);
    // 	return $rcalidad;
    // }

    public function reporte_calidad($mes,$anio){
    	$stmt=$this->objPdo->prepare("SELECT '1'::integer as numero,'TOTAL DE EXAMENES Y PROCEDIMIENTOS'::text as examen,(dpq.total+dcit.total+pih.total+bcrom.total+bcong.total)as total FROM
									(SELECT 'DIAGNOSTICOS'::text as examen,(t1.totalbio+t2.totalbio)as total FROM
									(select 'PATOLOGIA QUIRURGICA'::text as area,count(*) as totalbio from sisanatom.muestras_biopsia mb inner join sisanatom.biopsia b on mb.id_biopsia=b.id_biopsia and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)t1 left join

									(select 'PATOLOGIA QUIRURGICA'::text as area,count(*) as totalbio from sisanatom.biopsia b inner join sisanatom.tipo_biopsia tb on b.tipo_estudio=tb.codigo
									where tb.tipo like '%PIEZA QUIRURGICA%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)t2 on t1.area=t2.area)dpq inner join 

									(SELECT  'DIAGNOSTICOS'::text as examen,(bpap.total+bbaaf.total+bsecre.total+bliquid.total+bmi.total)as total FROM 
									(select 'EXAMEN'::text as examen,count(*)as total  from sisanatom.biopsia b inner join sisanatom.detalle_bioccv bc on b.id_biopsia=bc.id_biopsia inner join
									sisanatom.topografia_area ta on ta.id_top=b.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									where a.id_area=3 and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)bpap left join

									(select 'EXAMEN'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
									inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra
									where descr_muestra like '%BAAF%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)bbaaf on bpap.examen=bbaaf.examen left join

									(select 'EXAMEN'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
									inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra
									where descr_muestra like '%SECRECION%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)bsecre on bpap.examen=bsecre.examen left join 

									(select 'EXAMEN'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
									inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									where descr_muestra like '%LIQUIDO%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio and a.id_area=2)bliquid on bpap.examen=bliquid.examen
									left join (select 'EXAMEN'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
									inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra
									where descr_muestra like '%MIELOGRAMA%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)bmi on bpap.examen=bmi.examen)dcit 
									on dpq.examen=dcit.examen left join 
									(select 'DIAGNOSTICOS'::text as examen,(CASE WHEN sum(mp.cantidad)>0 THEN sum(mp.cantidad) ELSE 0 END)as total from sisanatom.control_pruebasih cp 
									inner join sisanatom.marcador_prueba mp on cp.id_control=mp.prueba inner join sisanatom.biopsia b on cp.id_biopsia=b.id_biopsia
									where EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)pih on dpq.examen=pih.examen LEFT JOIN
									(select 'DIAGNOSTICOS'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
									inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra
									where descr_muestra like '%CROMATINA SEXUAL%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)bcrom on dpq.examen=bcrom.examen LEFT JOIN
									(select 'DIAGNOSTICOS'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a 
									on a.id_area=ta.id_area where a.descr_area like '%PATOLOGIA QUIRURGICA%' and b.bio_congelacion='0' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)bcong 
									ON dpq.examen=bcong.examen

									UNION
									/*numero de diagnosticos de patologia quirurgica--primera parte del reporte*/
									SELECT '2'::integer as numero,'DIAGNOSTICOS DE PATOLOGIA QUIRURGICA'::text as examen,(t1.totalbio+t2.totalbio)as total FROM
									(select 'PATOLOGIA QUIRURGICA'::text as area,count(*) as totalbio from sisanatom.muestras_biopsia mb inner join sisanatom.biopsia b on mb.id_biopsia=b.id_biopsia and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)t1 left join

									(select 'PATOLOGIA QUIRURGICA'::text as area,count(*) as totalbio from sisanatom.biopsia b inner join sisanatom.tipo_biopsia tb on b.tipo_estudio=tb.codigo
									where tb.tipo like '%PIEZA QUIRURGICA%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)t2 on t1.area=t2.area
									UNION
									select '3'::integer as numero,'MUESTRAS POR BIOPSIAS'::text as examen,count(*) as totalbio from sisanatom.muestras_biopsia mb inner join sisanatom.biopsia b on mb.id_biopsia=b.id_biopsia
									where  EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio
									UNION
									select '4'::integer as numero,'MUESTRAS POR PIEZA QUIRURGICA'::text as examen,count(*) as totalbio from sisanatom.biopsia b inner join sisanatom.tipo_biopsia tb on b.tipo_estudio=tb.codigo
									where tb.tipo like '%PIEZA QUIRURGICA%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio
									union
									/*numero de diagnosticos citologicos*/
									SELECT  '5'::integer as numero,'DIAGNOSTICOS CITOLOGICOS'::text as examen,(bpap.total+bbaaf.total+bsecre.total+bliquid.total+baspi.total)as total FROM 
									(select 'EXAMEN'::text as examen,count(*)as total  from sisanatom.biopsia b inner join sisanatom.detalle_bioccv bc on b.id_biopsia=bc.id_biopsia inner join
									sisanatom.topografia_area ta on ta.id_top=b.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									where a.id_area=3 and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)bpap left join

									(select 'EXAMEN'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
									inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra
									where descr_muestra like '%BAAF%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)bbaaf on bpap.examen=bbaaf.examen left join

									(select 'EXAMEN'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
									inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra
									where descr_muestra like '%SECRECION%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)bsecre on bpap.examen=bsecre.examen left join 

									(select 'EXAMEN'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
									inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									where descr_muestra like '%LIQUIDO%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio and a.id_area=2)bliquid on bpap.examen=bliquid.examen
									left join (select 'EXAMEN'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
									inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra
									where descr_muestra like '%MIELOGRAMA%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio)baspi on bpap.examen=baspi.examen
									UNION
									select  '6'::integer as numero,'LECTURAS DE PAP'::text as examen,count(*)as total  from sisanatom.biopsia b inner join sisanatom.detalle_bioccv bc on b.id_biopsia=bc.id_biopsia inner join
									sisanatom.topografia_area ta on ta.id_top=b.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									where a.id_area=3 and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio
									UNION
									select '7'::integer as numero,'LECTURAS DE LIQUIDOS'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
									inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									where descr_muestra like '%LIQUIDO%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio and a.id_area=2
									UNION
									select '8'::integer as numero,'LECTURA DE BAAF'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
									inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra
									where descr_muestra like '%BAAF%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio
									UNION
									select '9'::integer as numero,'SECRECIONES'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
									inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra
									where descr_muestra like '%SECRECION%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio
									UNION
									select '10'::integer as numero,'ASPIRACION DE MEDULA OSEA(MIELOGRAMA)'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
									inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra
									where descr_muestra like '%MIELOGRAMA%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio
									UNION
									/*PROCEDIMIENTOS DE INMUNOHISTOQUIMICA*/
									select '11'::integer as numero,'PROCEDIMIENTO DE INMUNOHISTOQUIMICA'::text as examen,(CASE WHEN sum(mp.cantidad)>0 THEN sum(mp.cantidad) ELSE 0 END)as total from sisanatom.control_pruebasih cp 
									inner join sisanatom.marcador_prueba mp on cp.id_control=mp.prueba inner join sisanatom.biopsia b on cp.id_biopsia=b.id_biopsia
									where EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio
									UNION
									select '12'::integer as numero,'CROMATINA SEXUAL'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia 
									inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra
									where descr_muestra like '%CROMATINA SEXUAL%' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio
									UNION
									select '13'::integer as numero,'BIOPSIA POR CONGELACION'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a 
									on a.id_area=ta.id_area where a.descr_area like '%PATOLOGIA QUIRURGICA%' and b.bio_congelacion='0' and EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio
									ORDER BY numero asc");
    	$stmt->execute(array('mes'=>$mes,'anio'=>$anio));
    	$rcalidad=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $rcalidad;
    }

    public function reporte_calidad_procedencia($mes,$anio){
    	$stmt=$this->objPdo->prepare("SELECT '1'::integer as nproc,'EMERGENCIA'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.procedencia_muestra pm on b.id_proc=pm.id_proc
									where EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio and pm.descr_proc like '%EMERGENCIA%'
									union
									select '2'::integer as nproc,'PROCEDIMIENTOS'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.procedencia_muestra pm on b.id_proc=pm.id_proc
									where EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio and pm.descr_proc like '%PROCEDIMIENTOS%'
									union
									select '3'::integer as nproc,'SALA DE OPERACIONES'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.procedencia_muestra pm on b.id_proc=pm.id_proc
									where EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=2016 and pm.descr_proc like '%SALA DE OPERACIONES%'
									UNION
									select '4'::integer as nproc,'PROCEDENCIA NO ESPECIFICADA'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.procedencia_muestra pm on b.id_proc=pm.id_proc
									where EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio and pm.descr_proc like '%NO ESPECIFICADA%'
									UNION
									select '5'::integer as nproc,'HOSPITALIZACION'::text as examen,count(*) as total from sisanatom.biopsia b inner join sisanatom.procedencia_muestra pm on b.id_proc=pm.id_proc
									where EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio and pm.descr_proc like '%HOSPITALIZACION%'
									UNION
									SELECT '6'::integer as nproc,'OTRAS INSTITUCIONES'::text as examen,count(*) as total FROM sisanatom.biopsia b inner join sisanatom.institucion it on b.id_institucion=it.id_inst
									where EXTRACT(MONTH FROM b.fecha_ingreso)=:mes and EXTRACT(YEAR FROM b.fecha_ingreso)=:anio and b.id_institucion!=29
									ORDER BY nproc asc ");
    	$stmt->execute(array('mes'=>$mes,'anio'=>$anio));
    	$rproced=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $rproced;
    }

}


?>