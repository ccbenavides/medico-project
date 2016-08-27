<?php
require_once 'conexion.php';
class Estadistica{
	private $objPdo;

	public function __construct() {

        $this->objPdo = new Conexion();
    }

    public function biomescaso1($id_area,$fecha1,$fecha2,$mes1,$mes2){
    	$stmt=$this->objPdo->prepare("SELECT 1 as numero,nombres.id_mes,substring(nombres.descr_mes from 1 for 3) as abr,nombres.descr_mes,meses.anio,(CASE when meses.num_pac_atend!=0 THEN meses.num_pac_atend ELSE 0 END)as num_pac_atend,
									(CASE WHEN examenes.total_examenes!=0 THEN examenes.total_examenes ELSE 0 END)AS total_examenes FROM

									(SELECT mes::integer,anio,count(id_paciente)AS num_pac_atend FROM
									(select distinct(b.id_paciente),EXTRACT(MONTH FROM b.fecha_ingreso)as mes,EXTRACT(YEAR FROM b.fecha_ingreso) as anio from sisanatom.biopsia b inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join
									sisanatom.area a on ta.id_area=a.id_area 
									where a.id_area=:id_area and (b.fecha_ingreso>=:fecha1 AND  b.fecha_ingreso<=:fecha2))pacientes
									group by mes,anio)meses RIGHT JOIN 
									(select distinct(id_mes),descr_mes from sisanatom.mes    /*<-caso1 caso2: id_mes>=7 and id_mes<=8 caso3:id_mes=7*/
									where id_mes>=:mes1 ORDER BY id_mes asc)nombres ON nombres.id_mes=meses.mes LEFT JOIN

									(SELECT mes::integer,anio,sum(numero) as total_examenes FROM
									(select count(*) as numero,EXTRACT(MONTH FROM b.fecha_ingreso)as mes,EXTRACT(YEAR FROM b.fecha_ingreso) as anio from sisanatom.biopsia b inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join
									sisanatom.area a on ta.id_area=a.id_area 
									where a.id_area=:id_area and (b.fecha_ingreso>=:fecha1 AND  b.fecha_ingreso<=:fecha2)
									group by b.fecha_ingreso)numbios
									group by numbios.mes,numbios.anio)examenes on nombres.id_mes=examenes.mes

									UNION
									SELECT 2 as numero,nombres1.id_mes,substring(nombres1.descr_mes from 1 for 3) as abr,nombres1.descr_mes,meses.anio,(CASE when meses.num_pac_atend!=0 THEN meses.num_pac_atend ELSE 0 END)as num_pac_atend,
									(CASE WHEN examenes1.total_examenes!=0 THEN examenes1.total_examenes ELSE 0 END) AS total_examenes FROM

									(SELECT mes::integer,anio,count(id_paciente)AS num_pac_atend FROM
									(select distinct(b.id_paciente),EXTRACT(MONTH FROM b.fecha_ingreso)as mes,EXTRACT(YEAR FROM b.fecha_ingreso) as anio from sisanatom.biopsia b inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join
									sisanatom.area a on ta.id_area=a.id_area 
									where a.id_area=:id_area and (b.fecha_ingreso>=:fecha1 AND  b.fecha_ingreso<=:fecha2))pacientes
									group by mes,anio)meses RIGHT JOIN 
									(select distinct(id_mes),descr_mes from sisanatom.mes    /*<-caso1 caso2: id_mes>=7 and id_mes<=8 caso3:id_mes=7*/
									where id_mes<=:mes2 ORDER BY id_mes asc)nombres1 ON nombres1.id_mes=meses.mes LEFT JOIN
									(SELECT mes::integer,anio,sum(numero) as total_examenes FROM
									(select count(*) as numero,EXTRACT(MONTH FROM b.fecha_ingreso)as mes,EXTRACT(YEAR FROM b.fecha_ingreso) as anio from sisanatom.biopsia b inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join
									sisanatom.area a on ta.id_area=a.id_area 
									where a.id_area=:id_area and (b.fecha_ingreso>=:fecha1 AND  b.fecha_ingreso<=:fecha2)
									group by b.fecha_ingreso)numbios
									group by numbios.mes,numbios.anio)examenes1 on nombres1.id_mes=examenes1.mes
									order by numero,id_mes asc  ");
    	$stmt->execute(array('id_area'=>$id_area,'fecha1'=>$fecha1,'fecha2'=>$fecha2,'mes1'=>$mes1,'mes2'=>$mes2));
    	$caso1=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $caso1;
    }

    public function biomescaso2($id_area,$fecha1,$fecha2,$mes1,$mes2){

    	$stmt=$this->objPdo->prepare("SELECT 1 as numero,nombres.id_mes,substring(nombres.descr_mes from 1 for 3) as abr,nombres.descr_mes,meses.anio,(CASE when meses.num_pac_atend!=0 THEN meses.num_pac_atend ELSE 0 END)as num_pac_atend,
									(CASE WHEN examenes.total_examenes!=0 THEN examenes.total_examenes ELSE 0 END)AS total_examenes FROM

									(SELECT mes::integer,anio,count(id_paciente)AS num_pac_atend FROM
									(select distinct(b.id_paciente),EXTRACT(MONTH FROM b.fecha_ingreso)as mes,EXTRACT(YEAR FROM b.fecha_ingreso) as anio from sisanatom.biopsia b inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join
									sisanatom.area a on ta.id_area=a.id_area 
									where a.id_area=:id_area and (b.fecha_ingreso>=:fecha1 AND  b.fecha_ingreso<=:fecha2))pacientes
									group by mes,anio)meses RIGHT JOIN 
									(select distinct(id_mes),descr_mes from sisanatom.mes    /*<-caso1 caso2: id_mes>=7 and id_mes<=8 caso3:id_mes=7*/
									where id_mes>=:mes1 and id_mes<=:mes2 ORDER BY id_mes asc)nombres ON nombres.id_mes=meses.mes LEFT JOIN

									(SELECT mes::integer,anio,sum(numero) as total_examenes FROM
									(select count(*) as numero,EXTRACT(MONTH FROM b.fecha_ingreso)as mes,EXTRACT(YEAR FROM b.fecha_ingreso) as anio from sisanatom.biopsia b inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join
									sisanatom.area a on ta.id_area=a.id_area 
									where a.id_area=:id_area and (b.fecha_ingreso>=:fecha1 AND  b.fecha_ingreso<=:fecha2)
									group by b.fecha_ingreso)numbios
									group by numbios.mes,numbios.anio)examenes on nombres.id_mes=examenes.mes ");
    	$stmt->execute(array('id_area'=>$id_area,'fecha1'=>$fecha1,'fecha2'=>$fecha2,'mes1'=>$mes1,'mes2'=>$mes2));
    	$caso2=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $caso2;
    }

    public function edadarea($id_area,$fecha1,$fecha2){
    	$stmt=$this->objPdo->prepare("SELECT edad,sum(numero) as total FROM
									(select substring(age((select now())::date,p.fecha_nacimiento::date)::text from 1 for 2)::integer as edad,
									count(*) as numero from sisanatom.biopsia b inner join sisemer.paciente p on b.id_paciente=p.id_paciente
									inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									where a.id_area=:id_area and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2
									group by p.fecha_nacimiento
									order by edad asc)edades
									GROUP BY edad ");
    	$stmt->execute(array('id_area'=>$id_area,'fecha1'=>$fecha1,'fecha2'=>$fecha2));
    	$edades=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $edades;
    }

    public function generoarea($id_area,$fecha1,$fecha2){
    	$stmt=$this->objPdo->prepare("SELECT SEXOS.genero,(CASE WHEN totales.total!=0 THEN totales.total ELSE 0 END) as total FROM 
									(select 'FEMENINO'::text as genero
									UNION
									select 'MASCULINO'::text as genero)SEXOS LEFT JOIN

									(select (CASE WHEN p.sexo='0' THEN 'MASCULINO' WHEN p.sexo='1' THEN 'FEMENINO' END)as sexo,count(*)as total from sisanatom.biopsia b inner join sisemer.paciente p on b.id_paciente=p.id_paciente inner join 
									sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area
									where a.id_area=:id_area and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2
									group by p.sexo)totales ON SEXOS.genero=totales.sexo");
    	$stmt->execute(array('id_area'=>$id_area,'fecha1'=>$fecha1,'fecha2'=>$fecha2));
    	$generos=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $generos;
    }
    /*falta considerar los demas servicios es en general*/
    public function serviciohrl($id_area,$fecha1,$fecha2){
    	$stmt=$this->objPdo->prepare("SELECT 'S'||b.dep_id::text as dep_id,d.dep_descr,count(*) as total_bio from sisanatom.biopsia b inner join dependencias d on b.dep_id=d.dep_id inner join sisanatom.topografia_area ta on b.id_top=ta.id_top
									inner join sisanatom.area a on ta.id_area=a.id_area
									where a.id_area=:id_area and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2 and b.id_institucion=29
									GROUP BY d.dep_descr,b.dep_id
									ORDER BY d.dep_descr ASC  ");
    	$stmt->execute(array('id_area'=>$id_area,'fecha1'=>$fecha1,'fecha2'=>$fecha2));
    	$servicios=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $servicios;
    }

    public function institucion($id_area,$fecha1,$fecha2){
    	$stmt=$this->objPdo->prepare("SELECT 'I'||it.id_inst::text as id_inst,it.descr_inst,count(*) as total_bio FROM sisanatom.biopsia b inner join sisanatom.institucion it on b.id_institucion=it.id_inst inner join sisanatom.topografia_area ta on b.id_top=ta.id_top
									inner join sisanatom.area a on ta.id_area=a.id_area
									where a.id_area=:id_area and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2
									group by it.descr_inst,it.id_inst ");
    	$stmt->execute(array('id_area'=>$id_area,'fecha1'=>$fecha1,'fecha2'=>$fecha2));
    	$instituciones=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $instituciones;
    }

    public function cancerporubicacion($fecha1,$fecha2){
    	$stmt=$this->objPdo->prepare("SELECT ubicaciones.id_ubicacion,substring(ubicaciones.descr_ubicacion from 1 for 4) as abr,ubicaciones.descr_ubicacion,(CASE WHEN resultados.total!=0 THEN resultados.total ELSE 0 END )AS total FROM
									(SELECT id_ubicacion,descr_ubicacion FROM sisanatom.ubicacion_bio)ubicaciones INNER JOIN 

									(select pq.id_ubicacion,ub.descr_ubicacion,count(*)as total from sisanatom.biopsia b inner join sisanatom.detalle_biopq pq on b.id_biopsia=pq.id_biopsia
									inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area inner join sisanatom.result_bio rb on pq.id_res=rb.id_res
									inner join sisanatom.ubicacion_bio ub on pq.id_ubicacion=ub.id_ubicacion
									where a.id_area=1 and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2 and pq.id_res=3
									GROUP BY pq.id_ubicacion,ub.descr_ubicacion ORDER BY ub.descr_ubicacion ASC)resultados on ubicaciones.id_ubicacion=resultados.id_ubicacion ");
    	$stmt->execute(array('fecha1'=>$fecha1,'fecha2'=>$fecha2));
    	$canceres=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $canceres;
    }

    public function displasiaporubicacion($fecha1,$fecha2){
    	$stmt=$this->objPdo->prepare("SELECT ubicaciones.id_ubicacion,substring(ubicaciones.descr_ubicacion from 1 for 4) as abr,ubicaciones.descr_ubicacion,(CASE WHEN resultados.total!=0 THEN resultados.total ELSE 0 END )AS total FROM
									(SELECT id_ubicacion,descr_ubicacion FROM sisanatom.ubicacion_bio)ubicaciones INNER JOIN 

									(select pq.id_ubicacion,ub.descr_ubicacion,count(*)as total from sisanatom.biopsia b inner join sisanatom.detalle_biopq pq on b.id_biopsia=pq.id_biopsia
									inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area inner join sisanatom.result_bio rb on pq.id_res=rb.id_res
									inner join sisanatom.ubicacion_bio ub on pq.id_ubicacion=ub.id_ubicacion
									where a.id_area=1 and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2 and pq.id_res=2
									GROUP BY pq.id_ubicacion,ub.descr_ubicacion ORDER BY ub.descr_ubicacion ASC)resultados on ubicaciones.id_ubicacion=resultados.id_ubicacion ");
    	$stmt->execute(array('fecha1'=>$fecha1,'fecha2'=>$fecha2));
    	$displasias=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $displasias;
    }

    public function tipoestudio($fecha1,$fecha2){
    	$stmt=$this->objPdo->prepare("SELECT estudios.codigo,estudios.tipo,(CASE WHEN biopsias.total!=0 THEN biopsias.total ELSE 0 END)AS total FROM
									(SELECT codigo,tipo FROM sisanatom.tipo_biopsia)estudios LEFT JOIN

									(SELECT b.tipo_estudio,tb.tipo,count(*) as total FROM sisanatom.biopsia b inner join sisanatom.topografia_area ta on ta.id_top=b.id_top 
									inner join sisanatom.area a on ta.id_area=a.id_area inner join sisanatom.tipo_biopsia tb on b.tipo_estudio=tb.codigo
									where a.id_area=1 and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2
									GROUP BY b.tipo_estudio,tb.tipo ORDER BY tb.tipo ASC)biopsias ON estudios.codigo=biopsias.tipo_estudio
									ORDER BY estudios.tipo ASC  ");
    	$stmt->execute(array('fecha1'=>$fecha1,'fecha2'=>$fecha2));
    	$estudios=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $estudios;
    }

    public function congelacion($fecha1,$fecha2){
    	$stmt=$this->objPdo->prepare("SELECT estados.estado,(CASE WHEN bios.total!=0 THEN bios.total ELSE 0 END)AS total FROM
									(select 'SI'::text as estado
									UNION
									select 'NO'::text as estado)estados LEFT JOIN 

									(select (CASE WHEN b.bio_congelacion='0' THEN 'SI' ELSE 'NO' END)AS bio_congelacion,count(*) as total from sisanatom.biopsia b 
									inner join sisanatom.topografia_area ta on ta.id_top=b.id_top 
									inner join sisanatom.area a on a.id_area=ta.id_area
									where a.id_area=1 and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2
									GROUP BY b.bio_congelacion)bios on bios.bio_congelacion=estados.estado
									ORDER BY estados.estado DESC  ");
    	$stmt->execute(array('fecha1'=>$fecha1,'fecha2'=>$fecha2));
    	$congela=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $congela;
    }

    public function cromacaso1($fecha1,$fecha2,$mes1,$mes2){
    	$stmt=$this->objPdo->prepare("SELECT 1 as numero,meses.id_mes,substring(meses.descr_mes from 1 for 3)as abr_mes,meses.descr_mes,BIOCRO.anio,(CASE WHEN BIOCRO.total!=0 THEN SUM(BIOCRO.total) ELSE 0 END)AS total FROM

									(SELECT EXTRACT(MONTH FROM b.fecha_ingreso) as mes,EXTRACT(YEAR FROM b.fecha_ingreso) as anio,mu.descr_muestra,count(*)as total FROM sisanatom.biopsia b inner join sisanatom.topografia_area ta 
									on b.id_top=ta.id_top inner join sisanatom.area a on a.id_area=ta.id_area inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia
									inner join sisanatom.muestra mu on mb.id_muestrarem=mu.id_muestra
									where a.id_area=2 and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2 and mu.descr_muestra like '%CROMATINA SEXUAL%'
									GROUP BY b.fecha_ingreso,mu.descr_muestra)BIOCRO RIGHT JOIN

									(select distinct(id_mes),descr_mes from sisanatom.mes   
									where id_mes>=:mes1 ORDER BY id_mes asc)meses ON BIOCRO.mes=meses.id_mes
									group by numero,meses.id_mes,meses.descr_mes,BIOCRO.anio,BIOCRO.total
									UNION

									SELECT 2 as numero,meses.id_mes,substring(meses.descr_mes from 1 for 3)as abr_mes,meses.descr_mes,BIOCRO.anio,(CASE WHEN BIOCRO.total!=0 THEN SUM(BIOCRO.total) ELSE 0 END)AS total FROM

									(SELECT EXTRACT(MONTH FROM b.fecha_ingreso) as mes,EXTRACT(YEAR FROM b.fecha_ingreso) as anio,mu.descr_muestra,count(*)as total FROM sisanatom.biopsia b inner join sisanatom.topografia_area ta 
									on b.id_top=ta.id_top inner join sisanatom.area a on a.id_area=ta.id_area inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia
									inner join sisanatom.muestra mu on mb.id_muestrarem=mu.id_muestra
									where a.id_area=2 and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2 and mu.descr_muestra like '%CROMATINA SEXUAL%'
									GROUP BY b.fecha_ingreso,mu.descr_muestra)BIOCRO RIGHT JOIN

									(select distinct(id_mes),descr_mes from sisanatom.mes   
									where id_mes<=:mes2 ORDER BY id_mes asc)meses ON BIOCRO.mes=meses.id_mes
									group by numero,meses.id_mes,meses.descr_mes,BIOCRO.anio,BIOCRO.total
									order by numero,id_mes asc ");
    	$stmt->execute(array('fecha1'=>$fecha1,'fecha2'=>$fecha2,'mes1'=>$mes1,'mes2'=>$mes2));
    	$cromas=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $cromas;
    }

    public function cromacaso2($fecha1,$fecha2,$mes1,$mes2){
    	$stmt=$this->objPdo->prepare("SELECT nombres.id_mes,substring(nombres.descr_mes from 1 for 3)as abr_mes,nombres.descr_mes,BIOCRO.anio,(CASE WHEN BIOCRO.total!=0 THEN sum(BIOCRO.total) ELSE 0 END)as total FROM
									(SELECT EXTRACT(MONTH FROM b.fecha_ingreso) as mes,EXTRACT(YEAR FROM b.fecha_ingreso) as anio,mu.descr_muestra,count(*)as total FROM sisanatom.biopsia b inner join sisanatom.topografia_area ta 
									on b.id_top=ta.id_top inner join sisanatom.area a on a.id_area=ta.id_area inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia
									inner join sisanatom.muestra mu on mb.id_muestrarem=mu.id_muestra
									where a.id_area=2 and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2 and mu.descr_muestra like '%CROMATINA SEXUAL%'
									GROUP BY b.fecha_ingreso,mu.descr_muestra)BIOCRO RIGHT JOIN

									(select distinct(id_mes),descr_mes from sisanatom.mes   
									where id_mes>=:mes1 and id_mes<=:mes2 ORDER BY id_mes asc)nombres ON BIOCRO.mes=nombres.id_mes
									GROUP BY nombres.id_mes,nombres.descr_mes,BIOCRO.anio,BIOCRO.total
									ORDER BY id_mes ASC  ");
    	$stmt->execute(array('fecha1'=>$fecha1,'fecha2'=>$fecha2,'mes1'=>$mes1,'mes2'=>$mes2));
    	$cromas2=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $cromas2;
    }

    public function diferentecroma($fecha1,$fecha2){

    	$stmt=$this->objPdo->prepare("SELECT muestrasce.id_muestra,('M'||muestrasce.id_muestra) as codigo,muestrasce.descr_muestra,(CASE WHEN totales.total!=0 THEN totales.total ELSE 0 END)AS total FROM
									(select id_muestra,descr_muestra from sisanatom.muestra where id_area=2 order by descr_muestra ASC)muestrasce INNER JOIN

									(SELECT mb.id_muestrarem,mu.descr_muestra,count(*) as total FROM sisanatom.biopsia b inner join sisanatom.topografia_area ta on b.id_top=ta.id_top 
									inner join sisanatom.area a on ta.id_area=a.id_area inner join sisanatom.muestras_biopsia mb on mb.id_biopsia=b.id_biopsia 
									inner join sisanatom.muestra mu on mb.id_muestrarem=mu.id_muestra
									where a.id_area=2 and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2 and mu.descr_muestra  not like '%CROMATINA SEXUAL%'
									GROUP BY mb.id_muestrarem,mu.descr_muestra)totales ON muestrasce.id_muestra=totales.id_muestrarem ");
    	$stmt->execute(array('fecha1'=>$fecha1,'fecha2'=>$fecha2));
    	$difcroma=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $difcroma;
    }

    public function diagnosticoccv($fecha1,$fecha2){
    	$stmt=$this->objPdo->prepare("SELECT diagnosticos.id_diagccv,('D'||diagnosticos.id_diagccv) as abr,diagnosticos.descr_diagccv,(CASE WHEN totales.total!=0 THEN totales.total ELSE 0 END)AS total FROM
									(select id_diagccv,descr_diagccv from sisanatom.diagnostico_ccv order by descr_diagccv ASC)diagnosticos INNER JOIN

									(select bc.id_diagccv,dc.descr_diagccv,count(*)as total from sisanatom.biopsia b inner join sisanatom.detalle_bioccv bc on b.id_biopsia=bc.id_biopsia
									inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on a.id_area=ta.id_area inner join sisanatom.diagnostico_ccv dc on bc.id_diagccv=dc.id_diagccv
									where a.id_area=3 and b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2
									GROUP BY bc.id_diagccv,dc.descr_diagccv
									ORDER BY dc.descr_diagccv ASC )totales ON diagnosticos.id_diagccv=totales.id_diagccv ");
    	$stmt->execute(array('fecha1'=>$fecha1,'fecha2'=>$fecha2));
    	$diag=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $diag;
    }

    public function marcadores($fecha1,$fecha2){
    	$stmt=$this->objPdo->prepare("SELECT marcadores.id_marcador,('M'||marcadores.id_marcador)as codigo,marcadores.descr_marcador,(CASE WHEN totales.total!=0 THEN totales.total ELSE 0 END)AS total FROM
									(select id_marcador,descr_marcador from sisanatom.marcador order by descr_marcador ASC)marcadores INNER JOIN 

									(SELECT mp.marcador,m.descr_marcador,count(*)as total FROM sisanatom.biopsia b inner join sisanatom.control_pruebasih cp on b.id_biopsia=cp.id_biopsia 
									inner join sisanatom.marcador_prueba mp on cp.id_control=mp.prueba inner join sisanatom.marcador m on mp.marcador=m.id_marcador
									where b.fecha_ingreso>=:fecha1 and b.fecha_ingreso<=:fecha2
									GROUP BY mp.marcador,m.descr_marcador
									order by m.descr_marcador ASC)totales ON marcadores.id_marcador=totales.marcador ");
    	$stmt->execute(array('fecha1'=>$fecha1,'fecha2'=>$fecha2));
    	$lmarcador=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $lmarcador;
    }

    // editado
    public function laminastacoscitologia($fechas1, $fechas2){ //laminas y tacos en citologia
    	$stmt=$this->objPdo->prepare("SELECT sum(db.num_laminas) as total_laminas, sum(db.num_tacos) as total_tacos, b.patologo_responsable,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as nombres FROM sisanatom.biopsia b INNER JOIN sisanatom.detalle_bioce db
    		ON b.id_biopsia = db.id_biopsia INNER JOIN empleados e ON e.emp_id = b.patologo_responsable
    		WHERE db.fecha_regmat BETWEEN :fechas1 AND :fechas2 GROUP BY b.patologo_responsable, nombres");
    	$stmt->execute(array('fechas1'=>$fechas1,'fechas2'=>$fechas2));
    	$ltc=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $ltc;
    }
    public function laminastacospatologia($fechas1, $fechas2){ //laminas y tacos en patologia
    	$stmt=$this->objPdo->prepare("SELECT sum(db.num_laminas) as total_laminas, sum(db.num_tacos) as total_tacos, b.patologo_responsable, (e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as nombres FROM sisanatom.biopsia b INNER JOIN sisanatom.detalle_biopq db
    		ON b.id_biopsia = db.id_biopsia INNER JOIN empleados e ON e.emp_id = b.patologo_responsable
    		WHERE db.fecha_regmat BETWEEN :fechas1 AND :fechas2 GROUP BY b.patologo_responsable, nombres");
    	$stmt->execute(array('fechas1'=>$fechas1,'fechas2'=>$fechas2));
    	$ltp=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $ltp;
    }
    public function laminascitologiacv($fechas1, $fechas2){ //laminas en citologia cervico vaginal
    	$stmt=$this->objPdo->prepare("SELECT COUNT(ccv.id_biopsia) as total_laminas, (e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as nombres FROM sisanatom.detalle_bioccv ccv INNER JOIN sisanatom.biopsia b
    		ON b.id_biopsia = ccv.id_biopsia INNER JOIN empleados e ON e.emp_id = b.patologo_responsable
    		WHERE ccv.fecha_regdiagcod BETWEEN :fechas1 AND :fechas2 GROUP BY b.patologo_responsable, nombres");
    	$stmt->execute(array('fechas1'=>$fechas1,'fechas2'=>$fechas2));
    	$ltp=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $ltp;
    }
    public function numeromarcadores($fechas1, $fechas2){ //numero de marcadores en inmunohistoquimica
    	$stmt=$this->objPdo->prepare("SELECT sum(mp.cantidad) as total_marcadores, (e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as nombres FROM sisanatom.detalle_bioih ih 
    		INNER JOIN sisanatom.biopsia b ON b.id_biopsia = ih.id_biopsia 
    		INNER JOIN empleados e ON e.emp_id = b.patologo_responsable
    		INNER JOIN sisanatom.control_pruebasih cp on cp.id_biopsia = ih.id_biopsia
    		INNER JOIN sisanatom.marcador_prueba mp on mp.prueba = cp.id_control
    		WHERE cp.fecha_registro BETWEEN :fechas1 AND :fechas2
    		GROUP BY nombres");
    	$stmt->execute(array('fechas1'=>$fechas1,'fechas2'=>$fechas2));
    	$ltp=$stmt->fetchAll(PDO::FETCH_OBJ);
    	return $ltp;
    }

}

?>