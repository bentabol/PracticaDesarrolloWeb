<?php
namespace Model\Repository;

use Doctrine\ORM\EntityRepository;
use Model\Entity\bentatecnologies_proyectos;

class ProyectRepository extends EntityRepository
{
    
  

    public function addproyect ($c_nombreProyecto, $c_descripcionProyecto, $c_responsableProyecto, $f_fechaInicioProyecto, $f_fechaFinProyecto, $l_activoProyecto,  $c_tamañoArchivo, $c_ruta_archivo, $n_idusuario) {
        $proyect = new bentatecnologies_proyectos($c_nombreProyecto, $c_descripcionProyecto, $c_responsableProyecto, $f_fechaInicioProyecto, $f_fechaFinProyecto, $l_activoProyecto, $c_tamañoArchivo, $c_ruta_archivo, $n_idusuario);
        if($proyect) {
            //Hacerlo con todos los argumentos de entrada
            $proyect->setc_nombreProyecto($c_nombreProyecto);
            $proyect->setc_descripcionProyecto($c_descripcionProyecto);
            $proyect->setc_responsableProyecto($c_responsableProyecto);
            $proyect->setf_fechaInicioProyecto($f_fechaInicioProyecto);
            $proyect->setf_fechaFinProyecto($f_fechaFinProyecto);
            $proyect->seti_activoProyecto($l_activoProyecto);
            $proyect->setc_tamañoArchivo($c_tamañoArchivo);           
            $proyect->setc_ruta_archivo($c_ruta_archivo);
            $proyect->setn_idusuario($n_idusuario);
            //Añadiria el plugin
            $this->_em->persist($proyect);
            $this->_em->flush();
        }
    }

        
    public function deleteProyect ($id_proyecto) {
            $proyect = $this->findOneBy(['id_proyecto'=>$id_proyecto]);
            if($proyect) {
            $this->_em->persist($proyect);
                $this->_em->remove($proyect);
            }
    }

    function nombreProyectExists($nombreProyecto) { 
        
        $proyect = $this->findOneBy(['c_nombreProyecto'=>$nombreProyecto]);
        if($proyect){
            return true;
        } else {
            return false;
        }
                         
    }
    
    
    public function getProyectsActives($searchProyectName = '')
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT p
            FROM Model\Entity\bentatecnologies_proyectos p
            WHERE p.i_activoProyecto = 1
        ');

        if (!empty($searchProyectName)) {
            $query->andWhere('p.c_nombreProyecto LIKE :searchProyectName')
                ->setParameter('searchProyectName', '%' . $searchProyectName . '%');
        }

        $query->orderBy('p.c_nombreProyecto');

        return $query->getResult();
    }

    public function getAllProyects()
    {
        $allProyects= $this->findAll();
        return $allProyects;
        
    }


    public function getUrlProyect($id_proyecto)
    {
        $urlProyects= $this->findOneBy(['id_proyecto'=>$id_proyecto]);
        if($urlProyects){
            return $urlProyects->getc_ruta_archivo();
        } else {
            return null;
        }
    }
    public function searchProjectsByName($name)
    {
        $qb = $this->createQueryBuilder('p');
        $qb->where('p.c_nombreProyecto LIKE :name')
            ->setParameter('name', '%' . $name . '%');

        return $qb->getQuery()->getResult();
    }

    public function getProyectById($id_proyecto)
    {
        $proyectbyID= $this->findOneBy(['id_proyecto'=>$id_proyecto]);
        if($proyectbyID){
            return $proyectbyID;
        } else {
            return null;
        }
    }

   
    function getMisProyectos($idUsuario)
    {
        $misProyectos= $this->findBy(['n_idusuario'=>$idUsuario]);
        if($misProyectos){
            return $misProyectos;
        } else {
            return null;
        }
    }

    
    

    
 }
