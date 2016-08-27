<?php

require_once 'conexion.php';

class MenuNav {

    private $objPdo;

    public function __construct() {

        $this->objPdo = new Conexion();
    }

 
        public function getmenuxresp($perfil){
        $stmt=$this->objPdo->prepare('SELECT *, (select i.icono_descr from sisreha.iconos i where i.id_icono=nh.id_icono ) as icono,nh.color as color FROM sisanatom.menu_perfil_anat mp inner join sisanatom.menu_ant nh on mp.idmenu_anat = nh.id_menu_anat  where mp.id_perfil = :perfil order by nh.id_menu_anat asc;');
        $stmt->execute(array('perfil' =>$perfil));
        $menunav = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $menunav;
        }

        public function listadomenus(){
        $stmt=$this->objPdo->prepare('SELECT *, (select i.icono_descr from iconos i where i.id_icono=nv.id_icono  ) as icono FROM menu_nav nv where nv.id_padre is null  order by nv.id_menu_nav asc;');
        $stmt->execute();
        $lmenunav = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $lmenunav;
        }

        public function listadoiconos(){
        $stmt=$this->objPdo->prepare('SELECT * FROM iconos;');
        $stmt->execute();
        $licon = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $licon;
    }

        public function obtenericono($cod){
        $stmt=$this->objPdo->prepare('SELECT icono_descr FROM iconos where id_icono= :cod;');
        $stmt->execute(array('cod' => $cod ));
        $licon = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $licon[0]->icono_descr;
    }    

        public function listadosubmenus($cod){
        $stmt=$this->objPdo->prepare('SELECT nv1.* FROM menu_nav nv1 where nv1.id_padre= :cod and  nv1.id_menu_nav NOT IN (select nv2.id_menu_nav from menu_nav nv2 where nv2.id_padre is null) order by id_menu_nav asc;');
        $stmt->execute(array('cod' =>$cod ));
        $lsubmenunav = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $lsubmenunav;
    }


    public function insertarmenu($menunom, $link, $sicono){
        $stmt = $this->objPdo->prepare('INSERT INTO  menu_nav (descripcion, link, id_padre, id_icono) 
            VALUES(:menunom, :link, null , :sicono);');
        $rows = $stmt->execute(array('menunom' => $menunom,
                                    'link' => $link,
                                    'sicono' => $sicono));
    }

}

?>