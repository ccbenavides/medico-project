<?php

 require_once 'conexion.php';
 
 class Biopsia{
 	
 	private $objPDO;
    private $id_biopsia;
    private $id_paciente;
    private $num_biopsia;
    private $id_inst;
    private $dep_id;
    private $medico_tratante;
    private $fecha_biopsia;
    private $fecha_ingreso;
    private $tipo_estudio;
    private $id_top;
    private $bio_congelacion;
    private $patologo_responsable;
    private $diag_inicial;
    private $observacion;
    private $pago_paciente;
    private $id_usuario;
    private $fecha_creacion;
    private $estado_biopsia;
    private $codigo;
    private $tecnologo_responsable;
    private $id_anio;
    
    function __construct($id_biopsia="",$id_paciente="",$num_biopsia="",$dep_id="",$medico_tratante="",$fecha_biopsia="",
                         $fecha_ingreso="",$id_inst="",$tipo_estudio="",$id_top="",$bio_congelacion="",$patologo_responsable="",
                         $diag_inicial="",$observacion="",$pago_paciente="",$id_usuario="",$estado_biopsia="",$codigo="",$tecnologo_responsable="",$id_anio=""){
         $this->id_biopsia = $id_biopsia;
         $this->id_paciente = $id_paciente;
         $this->num_biopsia=$num_biopsia;
         $this->id_inst=$id_inst;
         $this->dep_id=$dep_id;
         $this->medico_tratante = $medico_tratante;
         $this->fecha_biopsia=$fecha_biopsia;
         $this->fecha_ingreso=$fecha_ingreso;
         $this->tipo_estudio=$tipo_estudio;
         $this->id_top=$id_top;
         $this->bio_congelacion=$bio_congelacion;
         $this->patologo_responsable=$patologo_responsable;
         $this->diag_inicial=$diag_inicial;
         $this->observacion=$observacion;
         $this->pago_paciente=$pago_paciente;
         $this->id_usuario=$id_usuario;
         $this->estado_biopsia=$estado_biopsia;
         $this->codigo=$codigo;
         $this->tecnologo_responsable=$tecnologo_responsable;
         $this->id_anio=$id_anio;
         $this->objPDO = new Conexion();
    }
    //insertar biopsias patologia quirurgica
    public function insertar(){
        $stmt=$this->objPDO->prepare('INSERT INTO sisanatom.biopsia (id_paciente,num_biopsia,id_institucion,dep_id,medico_tratante,fecha_biopsia,fecha_ingreso,
                             id_top,bio_congelacion,patologo_responsable,diag_inicial,observacion,pago_paciente,id_usuario,estado_biopsia,tipo_estudio,codigo,tecnologo_responsable,id_anio) 
                            VALUES(:id_paciente,:num_biopsia,:id_institucion,:dep_id,:medico_tratante,:fecha_biopsia,:fecha_ingreso,
                                :id_top,:bio_congelacion,:patologo_responsable,:diag_inicial,:observacion,:pago_paciente,:id_usuario,:estado_biopsia,:tipo_estudio,:codigo,:tecnologo_responsable,:id_anio)');
        $stmt->execute(array('id_paciente'=>$this->id_paciente,
                             'num_biopsia'=>$this->num_biopsia,
                             'id_institucion'=>$this->id_institucion,
                             'dep_id'=>$this->dep_id,
                             'medico_tratante'=>$this->medico_tratante,
                             'fecha_biopsia'=>$this->fecha_biopsia,
                             'fecha_ingreso'=>$this->fecha_ingreso,
                             'id_top'=>$this->id_top,
                             'bio_congelacion'=>$this->bio_congelacion,
                             'patologo_responsable'=>$this->patologo_responsable,
                             'diag_inicial'=>$this->diag_inicial,
                             'observacion'=>$this->observacion,
                             'pago_paciente'=>$this->pago_paciente,
                             'id_usuario'=>$this->id_usuario,
                             'estado_biopsia'=>$this->estado_biopsia,
                             'tipo_estudio'=>$this->tipo_estudio,
                             'codigo'=>$this->codigo,
                             'tecnologo_responsable'=>$this->tecnologo_responsable,
                             'id_anio'=>$this->id_anio));
    }
    //insertar las demas biopsias
    public function insertarbio(){
      $stmt=$this->objPDO->prepare('INSERT INTO sisanatom.biopsia (id_paciente,num_biopsia,id_institucion,dep_id,medico_tratante,fecha_biopsia,fecha_ingreso,
                             id_top,patologo_responsable,diag_inicial,observacion,pago_paciente,id_usuario,estado_biopsia,codigo,tecnologo_responsable,id_anio) 
                            VALUES(:id_paciente,:num_biopsia,:id_institucion,:dep_id,:medico_tratante,:fecha_biopsia,:fecha_ingreso,
                                :id_top,:patologo_responsable,:diag_inicial,:observacion,:pago_paciente,:id_usuario,:estado_biopsia,:codigo,:tecnologo_responsable,:id_anio)');
        $stmt->execute(array('id_paciente'=>$this->id_paciente,
                             'num_biopsia'=>$this->num_biopsia,
                             'id_institucion'=>$this->id_institucion,
                             'dep_id'=>$this->dep_id,
                             'medico_tratante'=>$this->medico_tratante,
                             'fecha_biopsia'=>$this->fecha_biopsia,
                             'fecha_ingreso'=>$this->fecha_ingreso,
                             'id_top'=>$this->id_top,
                             'patologo_responsable'=>$this->patologo_responsable,
                             'diag_inicial'=>$this->diag_inicial,
                             'observacion'=>$this->observacion,
                             'pago_paciente'=>$this->pago_paciente,
                             'id_usuario'=>$this->id_usuario,
                             'estado_biopsia'=>$this->estado_biopsia,
                             'codigo'=>$this->codigo,
                             'tecnologo_responsable'=>$this->tecnologo_responsable,
                             'id_anio'=>$this->id_anio));  
    }
    /*codigo del año*/
    public function prefijoanio(){
        $stmt=$this->objPDO->prepare("SELECT substring(max(anio)::text from 3 for 4) as prefijo from sisanatom.anio");
        $stmt->execute();
        $prefijos=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $prefijos[0]->prefijo;
    }
    public function codigoanio($descripcion){
        $stmt=$this->objPDO->prepare("SELECT id_anio as cod_anio from sisanatom.anio
                                        where substring(anio::text from 3 for 4)=:descripcion ");
        $stmt->execute(array('descripcion'=>$descripcion));
        $codanio=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $codanio[0]->cod_anio;
    }

    //informacion de biopsia para autorizar edicion
    public function bioxfechar($id_area,$fecha){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(emp1.emp_nombres||' '||emp1.emp_appaterno||' '||emp1.emp_apmaterno) as tecnologo,
                                    (emp2.emp_nombres||' '||emp2.emp_appaterno||' '||emp2.emp_apmaterno) as patologo,b.estado_biopsia from sisanatom.biopsia b inner join sisanatom.topografia_area ta 
                                    on b.id_top=ta.id_top inner join sisanatom.area a on ta.id_area=a.id_area inner join empleados emp1 on b.tecnologo_responsable=emp1.emp_id
                                    inner join empleados emp2 on b.patologo_responsable=emp2.emp_id
                                    where a.id_area=:id_area and b.fecha_ingreso=:fecha and b.estado_biopsia<=3");
        $stmt->execute(array('id_area'=>$id_area,'fecha'=>$fecha));
        $bfecha=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $bfecha;
    }

    public function bioxfechar1($fecha){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(emp1.emp_nombres||' '||emp1.emp_appaterno||' '||emp1.emp_apmaterno) as tecnologo,
                                    (emp2.emp_nombres||' '||emp2.emp_appaterno||' '||emp2.emp_apmaterno) as patologo,b.estado_biopsia from sisanatom.biopsia b 
                                    inner join sisanatom.detalle_bioccv cb on cb.id_biopsia=b.id_biopsia left join empleados emp1 on cb.tecnologo=emp1.emp_id
                                    inner join empleados emp2 on b.patologo_responsable=emp2.emp_id
                                    where b.fecha_ingreso=:fecha and b.estado_biopsia<=3 ");
        $stmt->execute(array('fecha'=>$fecha));
        $bfech1=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $bfech1;
    }

    public function listobio(){
        $stmt = $this->objPDO->prepare("SELECT id_biopsia,num_biopsia,fecha_ingreso,sisanatom.area.descr_area,(CASE WHEN estado_biopsia<=3 THEN 'ACTIVO' ELSE 'INACTIVO' END) as estado_biopsia 
                                        from sisanatom.biopsia inner join sisanatom.topografia_area on sisanatom.biopsia.id_top=sisanatom.topografia_area.id_top
                                        inner join sisanatom.area on sisanatom.topografia_area.id_area=sisanatom.area.id_area
                                        order by id_biopsia asc ");
        $stmt->execute();
        $listop = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $listop;
    }

    public function actualizabaja($id_biopsia){
       $sql = "UPDATE sisanatom.biopsia set estado_biopsia=4
                where id_biopsia=:id_biopsia;";

        $stmt = $this->objPDO->prepare($sql);

            try{
                $stmt->execute(array('id_biopsia'=> $id_biopsia));
                return true;
            }catch(PDOExeception $e){
                return false;
            } 
        }
    
    /*public function codigoanio(){
        $stmt=$this->objPDO->prepare("SELECT max(id_anio) as cod_anio from sisanatom.anio");
        $stmt->execute();
        $codanio=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $codanio[0]->cod_anio;
    }*/

    /*codigo generativo para control de marcadores*/
    public function codigoprueba(){
        $stmt=$this->objPDO->prepare("SELECT 'P'||ltrim(to_char((CASE WHEN max(codigo_prueba)is null THEN 1 ELSE max(codigo_prueba)+1 END),'00000')) as nuevo from sisanatom.control_pruebasih
                                      WHERE EXTRACT(YEAR FROM fecha)=(SELECT EXTRACT(YEAR FROM current_date))");
        $stmt->execute();
        $pruebas=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $pruebas[0]->nuevo;
    }
    public function codprueba(){
        $stmt=$this->objPDO->prepare("SELECT (CASE WHEN max(codigo_prueba)is null THEN 1 ELSE max(codigo_prueba)+1 END) as codigo from sisanatom.control_pruebasih
                                      WHERE EXTRACT(YEAR FROM fecha)=(SELECT EXTRACT(YEAR FROM current_date))");
        $stmt->execute();
        $cprueba=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $cprueba[0]->codigo;
    }

    public function codigoxarea(){
        $stmt=$this->objPDO->prepare("SELECT ltrim(to_char((CASE WHEN max(codigo)is null THEN 1 ELSE max(codigo)+1 END),'00000')) as nuevo from sisanatom.biopsia
                                      WHERE EXTRACT(YEAR FROM fecha_ingreso)=(SELECT EXTRACT(YEAR FROM current_date))");
        $stmt->execute();
        $codigos=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $codigos[0]->nuevo;
    }  

    public function codigosunicos(){
        $stmt=$this->objPDO->prepare("SELECT (CASE WHEN max(codigo)is null THEN 1 ELSE max(codigo)+1 END) as codigo from sisanatom.biopsia
                                      WHERE EXTRACT(YEAR FROM fecha_ingreso)=(SELECT EXTRACT(YEAR FROM current_date))");
        $stmt->execute();
        $codigos=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $codigos[0]->codigo;
    }       
/*codigo por cada area*/
    public function codigopq(){
        $stmt=$this->objPDO->prepare("SELECT ltrim(to_char((CASE WHEN max(codigo)is null THEN 1 ELSE max(codigo)+1 END),'00000')) as nuevo from sisanatom.biopsia b
                                      inner join sisanatom.topografia_area ta on ta.id_top=b.id_top
                                      WHERE EXTRACT(YEAR FROM fecha_ingreso)=(SELECT EXTRACT(YEAR FROM current_date)) and ta.id_area=1");
        $stmt->execute();
        $codpq=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $codpq[0]->nuevo;
    }

    public function codpq(){
        $stmt=$this->objPDO->prepare("SELECT (CASE WHEN max(codigo)is null THEN 1 ELSE max(codigo)+1 END) as codigo from sisanatom.biopsia b
                                        inner join sisanatom.topografia_area ta on ta.id_top=b.id_top
                                        WHERE EXTRACT(YEAR FROM fecha_ingreso)=(SELECT EXTRACT(YEAR FROM current_date)) and ta.id_area=1");
        $stmt->execute();
        $cpq=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $cpq[0]->codigo;
    }

    public function codigoce(){
        $stmt=$this->objPDO->prepare("SELECT ltrim(to_char((CASE WHEN max(codigo)is null THEN 1 ELSE max(codigo)+1 END),'00000')) as nuevo from sisanatom.biopsia b
                                      inner join sisanatom.topografia_area ta on ta.id_top=b.id_top
                                      WHERE EXTRACT(YEAR FROM fecha_ingreso)=(SELECT EXTRACT(YEAR FROM current_date)) and ta.id_area=2");
        $stmt->execute();
        $codce=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $codce[0]->nuevo;
    }
    public function codce(){
        $stmt=$this->objPDO->prepare("SELECT (CASE WHEN max(codigo)is null THEN 1 ELSE max(codigo)+1 END) as codigo from sisanatom.biopsia b
                                        inner join sisanatom.topografia_area ta on ta.id_top=b.id_top
                                        WHERE EXTRACT(YEAR FROM fecha_ingreso)=(SELECT EXTRACT(YEAR FROM current_date)) and ta.id_area=2");
        $stmt->execute();
        $cce=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $cce[0]->codigo;
    }

    public function codigoccv(){
        $stmt=$this->objPDO->prepare("SELECT ltrim(to_char((CASE WHEN max(codigo)is null THEN 1 ELSE max(codigo)+1 END),'00000')) as nuevo from sisanatom.biopsia b
                                      inner join sisanatom.topografia_area ta on ta.id_top=b.id_top
                                      WHERE EXTRACT(YEAR FROM fecha_ingreso)=(SELECT EXTRACT(YEAR FROM current_date)) and ta.id_area=3");
        $stmt->execute();
        $codccv=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $codccv[0]->nuevo;
    }
    public function codccv(){
        $stmt=$this->objPDO->prepare("SELECT (CASE WHEN max(codigo)is null THEN 1 ELSE max(codigo)+1 END) as codigo from sisanatom.biopsia b
                                        inner join sisanatom.topografia_area ta on ta.id_top=b.id_top
                                        WHERE EXTRACT(YEAR FROM fecha_ingreso)=(SELECT EXTRACT(YEAR FROM current_date)) and ta.id_area=3");
        $stmt->execute();
        $cccv=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $cccv[0]->codigo;
    }

    public function codigoih(){
        $stmt=$this->objPDO->prepare("SELECT ltrim(to_char((CASE WHEN max(codigo)is null THEN 1 ELSE max(codigo)+1 END),'00000')) as nuevo from sisanatom.biopsia b
                                      inner join sisanatom.topografia_area ta on ta.id_top=b.id_top
                                      WHERE EXTRACT(YEAR FROM fecha_ingreso)=(SELECT EXTRACT(YEAR FROM current_date)) and ta.id_area=4");
        $stmt->execute();
        $codih=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $codih[0]->nuevo;
    }
    public function codih(){
        $stmt=$this->objPDO->prepare("SELECT (CASE WHEN max(codigo)is null THEN 1 ELSE max(codigo)+1 END) as codigo from sisanatom.biopsia b
                                        inner join sisanatom.topografia_area ta on ta.id_top=b.id_top
                                        WHERE EXTRACT(YEAR FROM fecha_ingreso)=(SELECT EXTRACT(YEAR FROM current_date)) and ta.id_area=4");
        $stmt->execute();
        $ccih=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $ccih[0]->codigo;
    }

    /*CODIGO Y AREA POR NUMERO DE BIOPSIA PARA EL CODIGO DE CANASTILLAS*/
   public function codnumbio($num_biopsia){
        $stmt=$this->objPDO->prepare("SELECT codigo from sisanatom.biopsia where num_biopsia=:num_biopsia");
        $stmt->execute(array('num_biopsia'=>$num_biopsia));
        $codigobio=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $codigobio[0]->codigo;
    }

    public function codareabio($num_biopsia){
        $stmt=$this->objPDO->prepare("SELECT a.id_area from sisanatom.biopsia b inner join sisanatom.topografia_area a on b.id_top=a.id_top
                                      where num_biopsia=:num_biopsia");
        $stmt->execute(array('num_biopsia'=>$num_biopsia));
        $codigobio=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $codigobio[0]->id_area;
    }

    public function codcanastilla($id_area,$codigo1,$codigo2){
        $stmt=$this->objPDO->prepare("SELECT b.num_biopsia,b.num_biopsia,b.num_biopsia,b.num_biopsia,b.num_biopsia from sisanatom.biopsia b inner join sisanatom.topografia_area a on b.id_top=a.id_top
                                      where a.id_area=:id_area and (b.codigo>=:codigo1 and b.codigo<=:codigo2)
                                      order by id_biopsia asc ");
        $stmt->execute(array('id_area'=>$id_area,'codigo1'=>$codigo1,'codigo2'=>$codigo2));
        $codcanasta=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $codcanasta;
    }

/*LISTADO DE BIOPSIAS ASIGNADAS A TODOS LOS PATOLOGOS EN DIFERENTES AREAS*/
    //listar biopsias de patologia quirurgica 
    public function biopsiasPQ(){
    $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,
                        list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                        inner join sisanatom.detalle_biopq db on b.id_biopsia=db.id_biopsia
                        inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                        inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                        where b.estado_biopsia<3
                        group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico  order by b.id_biopsia desc ");
    $stmt->execute();
    $biospq=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $biospq;
    }
    //listar biopsias de PQ para los tecnicos de macroscopia
    public function biotecPQ(){
      $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,
                        list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                        inner join sisanatom.detalle_biopq db on b.id_biopsia=db.id_biopsia
                        inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                        inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                        where b.estado_biopsia<2
                        group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico");
    $stmt->execute();
    $biostecpq=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $biostecpq;  
    }
    //listar biopsias de CE en general para los tecnicos de macroscopia
    public function biotecnCE(){
       $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,
                        list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                        inner join sisanatom.detalle_bioce db on b.id_biopsia=db.id_biopsia
                        inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                        inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                        where b.estado_biopsia<2
                        group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico");
    $stmt->execute();
    $biostecce=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $biostecce;   
    }
    //listar biopsias de IH en general para los tecnicos de macroscopia
    public function biotecnIH(){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,
                        list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                        inner join sisanatom.detalle_bioih db on b.id_biopsia=db.id_biopsia
                        inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                        inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                        where b.estado_biopsia<2
                        group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico");
    $stmt->execute();
    $biostecih=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $biostecih; 
    }


    //listar biopsias citologia especial
    public function biopsiasCE(){
    $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,
                                list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                                inner join sisanatom.detalle_bioce db on b.id_biopsia=db.id_biopsia
                                inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                                inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                where b.estado_biopsia<3
                                group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico");
    $stmt->execute();
    $biosce=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $biosce;
    }
    //listar biopsias citologia cervico vaginal
    public function biopsiasCCV(){
    $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,
                                    (e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras from sisanatom.biopsia b inner join sisanatom.detalle_bioccv db on b.id_biopsia=db.id_biopsia
                                    inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                                    inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                    where b.estado_biopsia<3
                                    group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico");
    $stmt->execute();
    $biosccv=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $biosccv;
    }
    //listar biopsias finalizadas de CCV
    public function biofinCCV(){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,db.fecha_informe,
                                    (e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras 
                                    from sisanatom.biopsia b inner join sisanatom.detalle_bioccv db on b.id_biopsia=db.id_biopsia
                                    inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                                    inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                    where b.estado_biopsia=3
                                    group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,db.fecha_informe,medico order by id_biopsia asc ");
        $stmt->execute();
        $bioccv=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $bioccv;  
    }
    //listar biopsias inmunohistoquimica
    public function biopsiasIH(){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,
                            (e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras
                            from sisanatom.biopsia b inner join sisanatom.detalle_bioih db on b.id_biopsia=db.id_biopsia
                            inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                            inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                            where b.estado_biopsia<3
                            group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico");
        $stmt->execute();
        $biosih=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $biosih;
    }
/*LISTADO DE BIOPSIAS ASIGNADAS POR PATOLOGO */
    //listar biopsias de patologia quirurgica por patologo
    public function biopqxpat($emp_id){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,
                            (e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras
                            from sisanatom.biopsia b 
                            inner join sisanatom.detalle_biopq db on b.id_biopsia=db.id_biopsia
                            inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                            inner join sisanatom.usuarios_anat ua on e.emp_id=ua.emp_id inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                            where e.emp_id=:emp_id and b.estado_biopsia<3
                            group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico");
        $stmt->execute(array('emp_id'=>$emp_id));
        $bioxp=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $bioxp;
    }
    //listar biopsias de citologia especial por patologo
    public function biocexpat($emp_id){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,
                            (e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras
                            from sisanatom.biopsia b 
                            inner join sisanatom.detalle_bioce db on b.id_biopsia=db.id_biopsia
                            inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                            inner join sisanatom.usuarios_anat ua on e.emp_id=ua.emp_id inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                            where e.emp_id=:emp_id and b.estado_biopsia<3
                            group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico");
        $stmt->execute(array('emp_id'=>$emp_id));
        $biocexp=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $biocexp;
    }
    //listar biopsias de citologia cervico vaginal por patologo
    public function bioccvxpat($emp_id){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,
                            (e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras
                            from sisanatom.biopsia b 
                            inner join sisanatom.detalle_bioccv db on b.id_biopsia=db.id_biopsia
                            inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                            inner join sisanatom.usuarios_anat ua on e.emp_id=ua.emp_id inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                            where e.emp_id=:emp_id and b.estado_biopsia<3
                            group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico");
        $stmt->execute(array('emp_id'=>$emp_id));
        $bioccvxp=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $bioccvxp;
    }
    //listar biopsias de inmunohistoquimica por patologo
    public function bioihxpat($emp_id){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,
                            (e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras
                            from sisanatom.biopsia b 
                            inner join sisanatom.detalle_bioih db on b.id_biopsia=db.id_biopsia
                            inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                            inner join sisanatom.usuarios_anat ua on e.emp_id=ua.emp_id inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                            where e.emp_id=:emp_id and b.estado_biopsia<3
                            group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico");
        $stmt->execute(array('emp_id'=>$emp_id));
        $bioihxp=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $bioihxp;
    }
    /*LISTADO DE BIOPSIAS ASIGNADAS POR TECNOLOGO*/
    public function biopqxtec($emp_id){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,
                            (e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras
                            from sisanatom.biopsia b 
                            inner join sisanatom.detalle_biopq db on b.id_biopsia=db.id_biopsia
                            inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.tecnologo_responsable=e.emp_id
                            inner join sisanatom.usuarios_anat ua on e.emp_id=ua.emp_id inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                            where e.emp_id=:emp_id and b.estado_biopsia<2 and EXTRACT(YEAR FROM b.fecha_ingreso)=(SELECT EXTRACT(YEAR FROM current_date))
                            group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico
                            order by codigo asc ");
        $stmt->execute(array('emp_id'=>$emp_id));
        $biopqxt=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $biopqxt;
    }
    public function biocextec($emp_id){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,
                            (e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras
                            from sisanatom.biopsia b 
                            inner join sisanatom.detalle_bioce db on b.id_biopsia=db.id_biopsia
                            inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.tecnologo_responsable=e.emp_id
                            inner join sisanatom.usuarios_anat ua on e.emp_id=ua.emp_id inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                            where e.emp_id=:emp_id and b.estado_biopsia<2 and EXTRACT(YEAR FROM b.fecha_ingreso)=(SELECT EXTRACT(YEAR FROM current_date))
                            group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico
                            order by codigo asc ");
        $stmt->execute(array('emp_id'=>$emp_id));
        $biocext=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $biocext;
    }
    public function bioihxcet($emp_id){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,
                            (e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras
                            from sisanatom.biopsia b 
                            inner join sisanatom.detalle_bioih db on b.id_biopsia=db.id_biopsia
                            inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.tecnologo_responsable=e.emp_id
                            inner join sisanatom.usuarios_anat ua on e.emp_id=ua.emp_id inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                            where e.emp_id=:emp_id and b.estado_biopsia<2 and EXTRACT(YEAR FROM b.fecha_ingreso)=(SELECT EXTRACT(YEAR FROM current_date))
                            group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico
                            order by codigo asc  ");
        $stmt->execute(array('emp_id'=>$emp_id));
        $bioihxtec=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $bioihxtec;
    }
    /*LISTADO DE BIOPSIAS FINALIZADAS POR PATOLOGO*/
    //patologia quirurgica
    public function biopqfinxpat($emp_id){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,db.fecha_informe,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,
                        list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                        inner join sisanatom.detalle_biopq db on b.id_biopsia=db.id_biopsia
                        inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                        inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra
                        where e.emp_id=:emp_id and b.estado_biopsia=3
                        group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,db.fecha_informe,medico");
        $stmt->execute(array('emp_id'=>$emp_id));
        $biofpq=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $biofpq;
    }
    //citologia especial
    public function biocefinxpat($emp_id){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,db.fecha_informe,
                            (e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras
                            from sisanatom.biopsia b 
                            inner join sisanatom.detalle_bioce db on b.id_biopsia=db.id_biopsia
                            inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                            inner join sisanatom.usuarios_anat ua on e.emp_id=ua.emp_id inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                            where e.emp_id=:emp_id and b.estado_biopsia=3
                            group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,db.fecha_informe,medico");
        $stmt->execute(array('emp_id'=>$emp_id));
        $biofce=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $biofce;
    }
    //citologia cervico vaginal
    public function bioccvfinxpat($emp_id){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,db.fecha_informe,
                            (e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras
                            from sisanatom.biopsia b 
                            inner join sisanatom.detalle_bioccv db on b.id_biopsia=db.id_biopsia
                            inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                            inner join sisanatom.usuarios_anat ua on e.emp_id=ua.emp_id inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                            where e.emp_id=:emp_id and b.estado_biopsia=3
                            group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,db.fecha_informe,medico");
        $stmt->execute(array('emp_id'=>$emp_id));
        $biofccv=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $biofccv;
    }
    //inmunohistoquimica
    public function bioihfinxpat($emp_id){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,db.fecha_informe,
                            (e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras
                            from sisanatom.biopsia b 
                            inner join sisanatom.detalle_bioih db on b.id_biopsia=db.id_biopsia
                            inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                            inner join sisanatom.usuarios_anat ua on e.emp_id=ua.emp_id inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                            where e.emp_id=:emp_id and b.estado_biopsia=3
                            group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,db.fecha_informe,medico");
        $stmt->execute(array('emp_id'=>$emp_id));
        $biofih=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $biofih;
    }
/*LISTADO DE BIOPSIAS PENDIENTES DE PATOLOGIA QUIRUGICA E INMUNOHISTOQUIMICA CON ALARMA DE 10 DIAS*/
    
    public function biopendpq(){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))>=10 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                                    as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                                    inner join sisanatom.detalle_biopq db on b.id_biopsia=db.id_biopsia
                                    inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                                    inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                    where b.estado_biopsia<3 and (date_part('day',((select now())-b.fecha_ingreso)))>=10
                                    group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico");
        $stmt->execute();
        $bpendpq=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $bpendpq;
    }

    public function biopqxemp($emp_id){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))>=10 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                                    as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                                    inner join sisanatom.detalle_biopq db on b.id_biopsia=db.id_biopsia
                                    inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                                    inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                    where b.estado_biopsia<3 and (date_part('day',((select now())-b.fecha_ingreso)))>=10 and b.patologo_responsable=:emp_id
                                    group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico ");
        $stmt->execute(array('emp_id'=>$emp_id));
        $bioporemp=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $bioporemp;
    }

    public function biopendih(){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))>=10 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                            as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                            inner join sisanatom.detalle_bioih db on b.id_biopsia=db.id_biopsia
                            inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                            inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                            where b.estado_biopsia<3 and (date_part('day',((select now())-b.fecha_ingreso)))>=10
                            group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico");
        $stmt->execute();
        $bpendih=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $bpendih;
    }

    public function bioihporemp($emp_id){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))>=10 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                            as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                            inner join sisanatom.detalle_bioih db on b.id_biopsia=db.id_biopsia
                            inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                            inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                            where b.estado_biopsia<3 and (date_part('day',((select now())-b.fecha_ingreso)))>=10 and b.patologo_responsable=:emp_id
                            group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico ");
        $stmt->execute(array('emp_id'=>$emp_id));
        $bihemp=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $bihemp;
    }
    
/*LISTADO DE BIOPSIAS PENDIENTES DE CITOLOGIA ESPECIAL Y CERVICO VAGINAL CON ALARMA DE 7 DIAS*/
    
    public function biopendce(){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))>=7 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                    as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                    inner join sisanatom.detalle_bioce db on b.id_biopsia=db.id_biopsia
                    inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                    inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                    where b.estado_biopsia<3 and (date_part('day',((select now())-b.fecha_ingreso)))>=7
                    group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico");
        $stmt->execute();
        $bpence=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $bpence;
    }

    public function biocexemp($emp_id){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))>=7 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                    as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                    inner join sisanatom.detalle_bioce db on b.id_biopsia=db.id_biopsia
                    inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                    inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                    where b.estado_biopsia<3 and (date_part('day',((select now())-b.fecha_ingreso)))>=7 and b.patologo_responsable=:emp_id
                    group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico ");
        $stmt->execute(array('emp_id'=>$emp_id));
        $bceemp=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $bceemp;
    }

    public function biopendccv(){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))>=7 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                                as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                                inner join sisanatom.detalle_bioccv db on b.id_biopsia=db.id_biopsia
                                inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                                inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                where b.estado_biopsia<3 and (date_part('day',((select now())-b.fecha_ingreso)))>=7
                                group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico");
        $stmt->execute();
        $bpendccv=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $bpendccv;
    }

     public function bioccvxemp($emp_id){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))>=7 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                                as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                                inner join sisanatom.detalle_bioccv db on b.id_biopsia=db.id_biopsia
                                inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                                inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                where b.estado_biopsia<3 and (date_part('day',((select now())-b.fecha_ingreso)))>=7 and b.patologo_responsable=:emp_id
                                group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico ");
        $stmt->execute(array('emp_id'=>$emp_id));
        $bccvemp=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $bccvemp;
    }
/*LISTADO DE BIOPSIAS CON TACOS PENDIENTES DE TODAS LAS AREAS CON UNA ALARMA DE IGUAL O MAYOR A 6 DIAS*/
    
    public function tacpendpq(){
       $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))>=6 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                                    as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as tecnologo,list(m.descr_muestra)as muestras 
                                    from sisanatom.biopsia b inner join sisanatom.detalle_biopq db on b.id_biopsia=db.id_biopsia
                                    inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.tecnologo_responsable=e.emp_id
                                    inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                    where db.num_tacos=0 and (date_part('day',((select now())-b.fecha_ingreso)))>=6
                                    group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,tecnologo");
        $stmt->execute();
        $tpendpq=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $tpendpq; 
    }

    public function tacpqporemp($tecnologo){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))>=6 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                                    as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as tecnologo,list(m.descr_muestra)as muestras 
                                    from sisanatom.biopsia b inner join sisanatom.detalle_biopq db on b.id_biopsia=db.id_biopsia
                                    inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.tecnologo_responsable=e.emp_id
                                    inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                    where db.num_tacos=0 and (date_part('day',((select now())-b.fecha_ingreso)))>=6 and b.tecnologo_responsable=:tecnologo
                                    group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,tecnologo ");
        $stmt->execute(array('tecnologo'=>$tecnologo));
        $tacosemp=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $tacosemp;
    }   

    public function tacpendce(){
       $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))>=6 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                                    as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as tecnologo,list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                                    inner join sisanatom.detalle_bioce db on b.id_biopsia=db.id_biopsia
                                    inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.tecnologo_responsable=e.emp_id
                                    inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                    where db.num_tacos=0 and (date_part('day',((select now())-b.fecha_ingreso)))>=6
                                    group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,tecnologo");
        $stmt->execute();
        $tpendce=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $tpendce; 
    }

     public function taceporemp($tecnologo){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))>=6 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                                    as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as tecnologo,list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                                    inner join sisanatom.detalle_bioce db on b.id_biopsia=db.id_biopsia
                                    inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.tecnologo_responsable=e.emp_id
                                    inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                    where db.num_tacos=0 and (date_part('day',((select now())-b.fecha_ingreso)))>=6 and b.tecnologo_responsable=:tecnologo
                                    group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,tecnologo ");
        $stmt->execute(array('tecnologo'=>$tecnologo));
        $tcemp=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $tcemp;
    }



    /*funciones para alerta de biopsias antes de que se cumpla el plazo de considerarlas pendientes*/

    public function biopqporserpendiente(){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))=9 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                                    as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                                    inner join sisanatom.detalle_biopq db on b.id_biopsia=db.id_biopsia
                                    inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                                    inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                    where b.estado_biopsia<3 and (date_part('day',((select now())-b.fecha_ingreso)))=9
                                    group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico");
        $stmt->execute();
        $biopqspen=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $biopqspen;
    }

    public function bioceporserpendiente(){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))=6 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                                    as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                                    inner join sisanatom.detalle_bioce db on b.id_biopsia=db.id_biopsia
                                    inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                                    inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                    where b.estado_biopsia<3 and (date_part('day',((select now())-b.fecha_ingreso)))=6
                                    group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico ");
        $stmt->execute();
        $biocespen=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $biocespen;
    }

    public function bioccvporserpendiente(){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))=6 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                                as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                                inner join sisanatom.detalle_bioccv db on b.id_biopsia=db.id_biopsia
                                inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                                inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                where b.estado_biopsia<3 and (date_part('day',((select now())-b.fecha_ingreso)))=6
                                group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico ");
        $stmt->execute();
        $bioccvspen=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $bioccvspen;
    }

    public function bioihposerpendiente(){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))=9 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                                    as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                                    inner join sisanatom.detalle_bioih db on b.id_biopsia=db.id_biopsia
                                    inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                                    inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                    where b.estado_biopsia<3 and (date_part('day',((select now())-b.fecha_ingreso)))=9
                                    group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico ");
        $stmt->execute();
        $bioihspen=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $bioihspen;
    }

    public function bioxserpend(){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))=9 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                                    as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                                    inner join sisanatom.detalle_biopq db on b.id_biopsia=db.id_biopsia
                                    inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                                    inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                    where b.estado_biopsia<3 and (date_part('day',((select now())-b.fecha_ingreso)))=9
                                    group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico
                                    UNION
                                    SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))=6 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                                                                        as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                                                                        inner join sisanatom.detalle_bioce db on b.id_biopsia=db.id_biopsia
                                                                        inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                                                                        inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                                                        where b.estado_biopsia<3 and (date_part('day',((select now())-b.fecha_ingreso)))=6
                                                                        group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico
                                    UNION
                                    SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))=6 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                                                                    as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                                                                    inner join sisanatom.detalle_bioccv db on b.id_biopsia=db.id_biopsia
                                                                    inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                                                                    inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                                                    where b.estado_biopsia<3 and (date_part('day',((select now())-b.fecha_ingreso)))=6
                                                                    group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico
                                    UNION
                                    SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))=9 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                                                                        as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                                                                        inner join sisanatom.detalle_bioih db on b.id_biopsia=db.id_biopsia
                                                                        inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                                                                        inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                                                        where b.estado_biopsia<3 and (date_part('day',((select now())-b.fecha_ingreso)))=9
                                                                        group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico ");
        $stmt->execute();
        $bioserpd=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $bioserpd;
    }

    /*funciones para alertas de 1 dia antes que las biopsia se consideren pendientes para los tecnologos*/
    public function bioxtecpqspend($id_usuario){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))=5 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                                    as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as tecnologo,list(m.descr_muestra)as muestras 
                                    from sisanatom.biopsia b inner join sisanatom.detalle_biopq db on b.id_biopsia=db.id_biopsia
                                    inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.tecnologo_responsable=e.emp_id
                                    inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                    inner join sisanatom.usuarios_anat ua on ua.emp_id=e.emp_id
                                    where db.num_tacos=0 and (date_part('day',((select now())-b.fecha_ingreso)))=5 and ua.id_usuario=:id_usuario and b.estado_biopsia<2
                                    group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,tecnologo");
        $stmt->execute(array('id_usuario'=>$id_usuario));
        $biotspend=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $biotspend;
    }

    public function bioxteccespend($id_usuario){
        $stmt=$this->objPDO->prepare(" ");
        $stmt->execute(array('id_usuario'=>$id_usuario));
        $biocetspend=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $biocetspend;
    }


    /*funciones para alertas de 1 dia antes que las biopsias se consideren pendientes para los medicos patologos*/
    public function bioxemppqspend($id_usuario){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))=9 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                                    as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                                    inner join sisanatom.detalle_biopq db on b.id_biopsia=db.id_biopsia
                                    inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                                    inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                    inner join sisanatom.usuarios_anat ua on e.emp_id=ua.emp_id
                                    where b.estado_biopsia<3 and (date_part('day',((select now())-b.fecha_ingreso)))=9 and ua.id_usuario=:id_usuario
                                    group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico ");
        $stmt->execute(array('id_usuario'=>$id_usuario));
        $emppqpend=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $emppqpend;
    }

    public function bioxempcespend($id_usuario){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))=6 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                                    as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                                    inner join sisanatom.detalle_bioce db on b.id_biopsia=db.id_biopsia
                                    inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                                    inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                    inner join sisanatom.usuarios_anat ua on ua.emp_id=e.emp_id
                                    where b.estado_biopsia<3 and (date_part('day',((select now())-b.fecha_ingreso)))=6 and ua.id_usuario=:id_usuario
                                    group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico");
        $stmt->execute(array('id_usuario'=>$id_usuario));
        $empcepend=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $empcepend;

    }
    
    public function bioxempccvspend($id_usuario){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))=6 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                                        as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                                        inner join sisanatom.detalle_bioccv db on b.id_biopsia=db.id_biopsia
                                        inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                                        inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                        inner join sisanatom.usuarios_anat ua on ua.emp_id=e.emp_id
                                        where b.estado_biopsia<3 and (date_part('day',((select now())-b.fecha_ingreso)))=6 and ua.id_usuario=:id_usuario
                                        group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico ");
        $stmt->execute(array('id_usuario'=>$id_usuario));
        $empccvpend=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $empccvpend;
    }

    public function bioxempihspend($id_usuario){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))=9 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                                        as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                                        inner join sisanatom.detalle_bioih db on b.id_biopsia=db.id_biopsia
                                        inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                                        inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                        inner join sisanatom.usuarios_anat ua on ua.emp_id=e.emp_id
                                        where b.estado_biopsia<3 and (date_part('day',((select now())-b.fecha_ingreso)))=9 and ua.id_usuario=:id_usuario
                                        group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico ");
        $stmt->execute(array('id_usuario'=>$id_usuario));
        $empihpend=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $empihpend;
    }

    public function bioxemptotalspend($id_usuario){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))=9 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                                    as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                                    inner join sisanatom.detalle_biopq db on b.id_biopsia=db.id_biopsia
                                    inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                                    inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                    inner join sisanatom.usuarios_anat ua on e.emp_id=ua.emp_id
                                    where b.estado_biopsia<3 and (date_part('day',((select now())-b.fecha_ingreso)))=9 and ua.id_usuario=:id_usuario
                                    group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico
                                    UNION
                                    SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))=6 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                                                                        as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                                                                        inner join sisanatom.detalle_bioce db on b.id_biopsia=db.id_biopsia
                                                                        inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                                                                        inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                                                        inner join sisanatom.usuarios_anat ua on ua.emp_id=e.emp_id
                                                                        where b.estado_biopsia<3 and (date_part('day',((select now())-b.fecha_ingreso)))=6 and ua.id_usuario=:id_usuario
                                                                        group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico
                                    UNION
                                    SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))=6 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                                                                            as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                                                                            inner join sisanatom.detalle_bioccv db on b.id_biopsia=db.id_biopsia
                                                                            inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                                                                            inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                                                            inner join sisanatom.usuarios_anat ua on ua.emp_id=e.emp_id
                                                                            where b.estado_biopsia<3 and (date_part('day',((select now())-b.fecha_ingreso)))=6 and ua.id_usuario=:id_usuario
                                                                            group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico
                                    UNION
                                    SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(case when (date_part('day',((select now())-b.fecha_ingreso)))=9 then date_part('day',((select now())-b.fecha_ingreso)) end) 
                                                                            as dias,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras from sisanatom.biopsia b 
                                                                            inner join sisanatom.detalle_bioih db on b.id_biopsia=db.id_biopsia
                                                                            inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                                                                            inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                                                            inner join sisanatom.usuarios_anat ua on ua.emp_id=e.emp_id
                                                                            where b.estado_biopsia<3 and (date_part('day',((select now())-b.fecha_ingreso)))=9 and ua.id_usuario=:id_usuario
                                                                            group by b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico ");
        $stmt->execute(array('id_usuario'=>$id_usuario));
        $emptotalspend=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $emptotalspend;
    }

    //funciones para alerta con estado critico
    public function alertaparaadmin(){
        $stmt=$this->objPDO->prepare("SELECT listapq.id_biopsia,listapq.num_biopsia,(CASE WHEN (date_part('day',((select now())-listapq.fecha_ingreso)))>=muepq.min then
                                    date_part('day',((select now())-listapq.fecha_ingreso)) END),listapq.medico as responsable,listapq.muestras,listapq.fecha_ingreso,listapq.id_area  FROM

                                    (SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras,a.id_area from sisanatom.biopsia b 
                                                                        inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                                                                        inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                                                        inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on a.id_area=ta.id_area
                                                                        where b.estado_biopsia<3
                                                                        group by a.id_area,b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico)listapq inner join

                                    (select mb.id_biopsia,min(m.tiempo_estudio) from sisanatom.muestras_biopsia mb inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra 
                                    inner join sisanatom.biopsia b on mb.id_biopsia=b.id_biopsia 
                                    group by mb.id_biopsia)muepq on listapq.id_biopsia=muepq.id_biopsia
                                    WHERE date_part('day',((select now())-listapq.fecha_ingreso))>=muepq.min ORDER BY listapq.fecha_ingreso DESC ");
        $stmt->execute();
        $alertacrit=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $alertacrit;
    }

    public function alertaparatec($id_usuario){
        $stmt=$this->objPDO->prepare("SELECT listapq.id_biopsia,listapq.num_biopsia,(CASE WHEN (date_part('day',((select now())-listapq.fecha_ingreso)))>=muepq.min then
                                    date_part('day',((select now())-listapq.fecha_ingreso)) END),listapq.medico as responsable,listapq.muestras,listapq.fecha_ingreso,listapq.id_area  FROM

                                    (SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras,a.id_area from sisanatom.biopsia b 
                                                                        inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.tecnologo_responsable=e.emp_id
                                                                        inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                                                        inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on a.id_area=ta.id_area
                                                        inner join sisanatom.usuarios_anat ua on ua.emp_id=e.emp_id
                                                                        where b.estado_biopsia<2 and ua.id_usuario=:id_usuario
                                                                        group by a.id_area,b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico)listapq inner join
                                    (select mb.id_biopsia,min(m.tiempo_estudio) from sisanatom.muestras_biopsia mb inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra 
                                    inner join sisanatom.biopsia b on mb.id_biopsia=b.id_biopsia 
                                    group by mb.id_biopsia)muepq on listapq.id_biopsia=muepq.id_biopsia
                                    WHERE date_part('day',((select now())-listapq.fecha_ingreso))>=muepq.min ORDER BY listapq.fecha_ingreso DESC ");
        $stmt->execute(array('id_usuario'=>$id_usuario));
        $alertatec=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $alertatec;
    }

    public function alertapat($id_usuario){
        $stmt=$this->objPDO->prepare("SELECT listapq.id_biopsia,listapq.num_biopsia,(CASE WHEN (date_part('day',((select now())-listapq.fecha_ingreso)))>=muepq.min then
                                        date_part('day',((select now())-listapq.fecha_ingreso)) END),listapq.medico as responsable,listapq.muestras,listapq.fecha_ingreso,listapq.id_area  FROM

                                        (SELECT b.id_biopsia,b.num_biopsia,b.fecha_ingreso,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno) as medico,list(m.descr_muestra)as muestras,a.id_area from sisanatom.biopsia b 
                                                                            inner join sisanatom.muestras_biopsia mb on b.id_biopsia=mb.id_biopsia inner join empleados e on b.patologo_responsable=e.emp_id
                                                                            inner join sisanatom.muestra m on m.id_muestra=mb.id_muestrarem
                                                                            inner join sisanatom.topografia_area ta on b.id_top=ta.id_top inner join sisanatom.area a on a.id_area=ta.id_area
                                                            inner join sisanatom.usuarios_anat ua on ua.emp_id=e.emp_id
                                                                            where b.estado_biopsia<3 and ua.id_usuario=:id_usuario
                                                                            group by a.id_area,b.id_biopsia,b.num_biopsia,b.fecha_ingreso,medico)listapq inner join

                                        (select mb.id_biopsia,min(m.tiempo_estudio) from sisanatom.muestras_biopsia mb inner join sisanatom.muestra m on mb.id_muestrarem=m.id_muestra 
                                        inner join sisanatom.biopsia b on mb.id_biopsia=b.id_biopsia 
                                        group by mb.id_biopsia)muepq on listapq.id_biopsia=muepq.id_biopsia
                                        WHERE date_part('day',((select now())-listapq.fecha_ingreso))>=muepq.min ORDER BY listapq.fecha_ingreso DESC");
        $stmt->execute(array('id_usuario'=>$id_usuario));
        $alertapato=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $alertapato;
    }

    public function modificar(){
        $stmt=$this->objPDO->prepare("UPDATE sisanatom.biopsia SET num_muestra=:num_muestra WHERE id_biopsia=:id_biopsia;");
        $stmt->execute(array('num_muestra'=>$this->num_muestra,
                             'id_biopsia'=>$this->id_biopsia));
    }

    public function consultarxpac($num_biopsia){
    	$stmt = $this->objPDO->prepare("SELECT * from sisanatom.biopsia where num_biopsia=:num_biopsia");
        $stmt->execute(array('num_biopsia' => $num_biopsia));
        $biopsias = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $biopsias;
    }

    public function getbiopsiaxid($id_biopsia){
        $stmt=$this->objPDO->prepare("SELECT id_biopsia from sisanatom.biopsia where id_biopsia=:id_biopsia");
        $stmt->execute(array('id_biopsia' => $id_biopsia));
        $bios=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $bios;
    }
    //consultar por numero de biopsia
    public function consultnumbio($num_biopsia){
        $stmt=$this->objPDO->prepare("SELECT * FROM sisanatom.biopsia where num_biopsia=:num_biopsia");
        $stmt->execute(array('num_biopsia' =>$num_biopsia));
        $numerobio=$stmt->rowCount();
        return $numerobio;
    }
    //consultar patologo y tecnologo de las biopsias
    public function listatecpat(){
        $stmt=$this->objPDO->prepare("SELECT b.id_biopsia,b.num_biopsia,(e.emp_nombres||' '||e.emp_appaterno||' '||e.emp_apmaterno)as patologo,(ep.emp_nombres||' '||ep.emp_appaterno||' '||ep.emp_apmaterno) as tecnologo,
                                    a.id_area,b.fecha_ingreso from sisanatom.biopsia b inner join empleados e on b.patologo_responsable=e.emp_id left join empleados ep on b.tecnologo_responsable=ep.emp_id
                                    inner join sisanatom.topografia_area ta on ta.id_top=b.id_top inner join sisanatom.area a on ta.id_area=a.id_area
                                    where b.id_top!=25
                                    order by id_area,b.codigo asc ");
        $stmt->execute();
        $listatp=$stmt->fetchAll(PDO::FETCH_OBJ);
        return $listatp; 
    }

    public function modificartec(){
        $stmt = $this ->objPDO->prepare("UPDATE sisanatom.biopsia
                                         SET tecnologo_responsable=:tecnologo_responsable 
                                         WHERE id_biopsia=:id_biopsia;");
        $rows = $stmt->execute(array('tecnologo_responsable' => $this->tecnologo_responsable,
                              'id_biopsia'=>$this->id_biopsia));
    }
    
    public function obtenertec(){
        $stmt = $this->objPDO->prepare("SELECT id_biopsia,num_biopsia,tecnologo_responsable from sisanatom.biopsia
                                        where id_biopsia='" . $this->id_biopsia . "';");
        $stmt->execute();
        $tecnologos = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($tecnologos as $tec) {
            $this->setIdBio($tec->id_biopsia);
            $this->setNumBio($tec->num_biopsia); 
            $this->setTecR($tec->tecnologo_responsable);                       
        }
        return $this;
    }
    
    public function getIdBio() {
        return $this->id_biopsia;
    }
    public function setIdBio($id_biopsia) {
        $this->id_biopsia = $id_biopsia;
    }
    public function getIdPac() {
        return $this->id_paciente;
    }
    public function setIdPac($id_paciente) {
        $this->id_paciente = $id_paciente;
    }
    public function getNumBio() {
        return $this->num_biopsia;
    }
    public function setNumBio($num_biopsia) {
        $this->num_biopsia = $num_biopsia;
    }
    public function getIdInst() {
        return $this->id_institucion;
    }
    public function setIdInst($id_institucion) {
        $this->id_institucion = $id_institucion;
    }
    public function getIdDep() {
        return $this->dep_id;
    }
    public function setIdDep($dep_id) {
        $this->dep_id = $dep_id;
    }
    public function getFechaIng() {
        return $this->fecha_ingreso;
    }
    public function setFechaIng($fecha_ingreso) {
        $this->fecha_ingreso = $fecha_ingreso;
    }
    public function getIdUser() {
        return $this->id_usuario;
    }
    public function setIdUser($id_usuario) {
        $this->id_usuario = $id_usuario;
    }
    public function getEstado() {
        return $this->estado_biopsia;
    }
    public function setEstado($estado_biopsia) {
        $this->estado_biopsia = $estado_biopsia;
    }
    public function getPago() {
        return $this->pago_paciente;
    }
    public function setPago($pago_paciente) {
        $this->pago_paciente = $pago_paciente;
    }
    public function getIdTop() {
        return $this->id_top;
    }
    public function setIdTop($id_top) {
        $this->id_top = $id_top;
    }
    public function getFecha() {
        return $this->fecha_biopsia;
    }
    public function setFecha($fecha_biopsia) {
        $this->fecha_biopsia = $fecha_biopsia;
    }
    public function getMedico() {
        return $this->medico_tratante;
    }
    public function setMedico($medico_tratante) {
        $this->medico_tratante = $medico_tratante;
    }
    public function getIdT(){
        return $this->tipo_estudio;
    }
    public function setIdT($tipo_estudio){
        $this->tipo_estudio=$tipo_estudio;
    }
    public function getPatR(){
        return $this->patologo_responsable;
    }
    public function setPatR($patologo_responsable){
        $this->patologo_responsable=$patologo_responsable;
    }
    public function getBioC(){
        return $this->bio_congelacion;
    }
    public function setBioC($bio_congelacion){
        $this->bio_congelacion=$bio_congelacion;
    }
    public function getDiagInicial(){
        return $this->diag_inicial;
    }
    public function setDiagInicial($diag_inicial){
        $this->diag_inicial=$diag_inicial;
    }
    public function getObs(){
        return $this->observacion;
    }
    public function setObs($observacion){
        $this->observacion=$observacion;
    }

    public function getCodigo(){
        return $this->codigo;
    }
    public function setCodigo($codigo){
        $this->codigo=$codigo;
    }

    public function getTecR(){
        return $this->tecnologo_responsable;
    }
    public function setTecR($tecnologo_responsable){
        $this->tecnologo_responsable=$tecnologo_responsable;
    }

    public function getAnio(){
        return $this->id_anio;
    }
    public function setAnio($id_anio){
        $this->id_anio=$id_anio;
    }
}
 


?>