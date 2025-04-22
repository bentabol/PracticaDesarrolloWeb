<?php
namespace Model\Repository;

use Doctrine\ORM\EntityRepository;
use Model\Entity\bentatecnologies_informes;

class InformesRepository extends EntityRepository
{
    public function uploadInforme ($f_fecha, $t_descargas, $n_idproyecto, $n_idusuario) {
        $informeSubir = new bentatecnologies_informes();
        if($informeSubir) {
            //Hacerlo con todos los argumentos de entrada
            $informeSubir->setf_fecha($f_fecha);
            $informeSubir->set_descargas($t_descargas);
            $informeSubir->setn_idproyecto($n_idproyecto);
            $informeSubir->setn_idusuario($n_idusuario);

            //Subiria el informe 
            $this->_em->persist($informeSubir);
            $this->_em->flush();
        }

    }
    
    public function updateError ($n_idproyecto, $n_idusuario, $c_errores) {
        $informeError = $this->findOneBy(['n_idproyecto'=>$n_idproyecto]);
        if($informeError) {
            //Hacerlo con todos los argumentos de entrada
            $informeError->setn_idproyecto($n_idproyecto);
            $informeError->setn_idusuario($n_idusuario);
            $informeError->setc_errores($c_errores);
            //Actualizaria el informe con el error
            $this->_em->persist($informeError);
            $this->_em->flush();
        }

    }
    


    public function getDescargasUser($idproyecto, $idUsuario)
    {
        $descargasUser= $this->findOneBy(['n_idusuario'=>$idUsuario, 'n_idproyecto'=>$idproyecto]);
        if(!empty($descargasUser)){
            return $descargasUser;
        } else {
            return [];
        }
    }



    public function getDescargasDesarrollador($idUsuario)
    {
        $descargasDesarrollador= $this->findOneBy(['n_idusuario'=>$idUsuario]);
        if(!empty($descargasDesarrollador)){
            return $descargasDesarrollador;
        } else {
            return [];
        }
    
    }



    public function informeUserExist($idproyecto, $idUser)
    {
        $informeExiste = $this->findOneBy(['n_idproyecto'=>$idproyecto]);
        if($informeExiste){
            return true;
        } else {
            return false;
        }
    
    }
    
    public function getAllDownloads()
    {
        $allDownloads= $this->findAll();
        return $allDownloads;

    }
    
    public function actualizarInformeDescargas ($descargas,$idproyecto,$n_iduser) {
        //Si fuera añadir un user nuevo ----> $user = new bentatecnologies_usuarios() y ya despues seria igual
        $informesDescargas = $this->findOneBy(['n_idproyecto'=>$n_idproyecto]);
        if($informesDescargas) {
            //Hacerlo con todos los argumentos de entrada
            $informesDescargas->setdescargas($descargas);
            $informesDescargas->setn_idapp($n_idproyecto);
            $informesDescargas->setn_iduser($n_iduser);
            //Actualizaria el informe
            $this->_em->persist($informesDescargas);
            $this->_em->flush();
        }

    }
        
    public function getInformesDescargas()
    {
        $informesDescargas= $this->findAll();
        return $informesDescargas;
    }

   /*
    public function getErrorValorAplicaciones($idAplica)
    {
        $query = $em->createQuery('SELECT i FROM Model\Entity\bentastore_informes i WHERE i.aplicacion IN (SELECT a FROM Model\Entity\bentastore_aplicaciones a WHERE a.id_aplicacion = :idAplica)');
        $query->setParameter('idAplica', $idAplica);
        $aplis = $query->getResult();

        return $aplis;
    }

*/
  

    

}