<?php
namespace Model\Repository;

use Doctrine\ORM\EntityRepository;
use Model\Entity\bentatecnologies_tarea;

class TareaRepository extends EntityRepository
{
    
  

    public function addTarea ($c_nombreTarea, $c_descripcionTarea, $c_responsableTarea, $f_fechaInicioTarea, $f_fechaFinTarea, $l_activoTarea, $n_idproyecto, $n_idusuario) {
        $tarea = new bentatecnologies_tarea($c_nombreTarea, $c_descripcionTarea, $c_responsableTarea, $f_fechaInicioTarea, $f_fechaFinTarea, $l_activoTarea, $n_idproyecto, $n_idusuario);
        if($tarea) {
            //Hacerlo con todos los argumentos de entrada
            $tarea->setc_nombreTarea($c_nombreTarea);
            $tarea->setc_descripcionTarea($c_descripcionTarea);
            $tarea->setc_responsableTarea($c_responsableTarea);
            $tarea->setf_fechaInicioTarea($f_fechaInicioTarea);
            $tarea->setf_fechaFinTarea($f_fechaFinTarea);
            $tarea->setl_activoTarea($l_activoTarea);
            $tarea->setN_idproyecto($n_idproyecto);
            $tarea->setN_idusuario($n_idusuario);
            //Añadiria el plugin
            $this->_em->persist($tarea);
            $this->_em->flush();
        }
    }

        
    public function deleteTarea ($id_tarea) {
            $tarea = $this->findOneBy(['id_tarea'=>$id_tarea]);
            if($tarea) {
            $this->_em->persist($tarea);
                $this->_em->remove($tarea);
            }
    }

    function nombreTareaExists($nombreTarea) { 
        
        $tarea = $this->findOneBy(['c_nombreTarea'=>$nombreTarea]);
        if($tarea){
            return true;
        } else {
            return false;
        }
                         
    }


    public function getTareaNameById($id_tarea)
    {
        $tareabyID= $this->findOneBy(['id_tarea'=>$id_tarea]);
        if($tareabyID){
            return $tareabyID;
        } else {
            return null;
        }
    }

   
    function getMisTareas($idUsuario)
    {
        $misTareas= $this->findOneBy(['n_idusuario'=>$idUsuario]);
        if($misTareas){
            return $misTareas;
        } else {
            return null;
        }
    }

    
    

    
 }
