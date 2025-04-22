<?php
namespace Model\Repository;

use Doctrine\ORM\EntityRepository;
use Model\Entity\bentatecnologies_solicitudes;

class SolicitudesRepository extends EntityRepository
{
    
  

    public function addsolicitud ($usuario, $proyecto, $status) {
        $solicitud = new bentatecnologies_solicitudes();
            //Hacerlo con todos los argumentos de entrada
            $solicitud->setn_idUsuario($usuario);
            $solicitud->setn_idProyecto($proyecto);
            $solicitud->setstatus($status);
            $this->_em->persist($solicitud);
            $this->_em->flush();   
    }
    
    


    
    
    //Obtener solicitudes usuario pendientes(idusuario[session],where status=pendiente_usuario)
    
    public function getSolicitudesUsuario($idUsuario)
    {   
    $query = $this->createQueryBuilder('s')
        ->select('s, u, p, proyecto')
        ->join('s.n_idusuario', 'u')
        ->join('s.n_idproyecto', 'p')
        ->join('p.n_idusuario', 'proyecto')
        ->where('s.status = :status')
        ->andWhere('s.n_idusuario = :idUsuario')
        ->setParameter('status', 'Pendiente_Usuario')
        ->setParameter('idUsuario', $idUsuario)
        ->getQuery();

    return $query->getResult();
    }
    
    public function getSolicitudesGestor($idUsuario)
    {   
    $query = $this->createQueryBuilder('s')
        ->select('s, u, p')
        ->join('s.n_idusuario', 'u')
        ->join('s.n_idproyecto', 'p')
        ->where('s.status = :status')
        ->andWhere('p.n_idusuario = :idUsuario')
        ->setParameter('status', 'Pendiente_Profesor')
        ->setParameter('idUsuario', $idUsuario)
        ->getQuery();

    return $query->getResult();
    }
    
    
    public function aceptarSolicitudUsuarioProyecto($idUsuario, $idProyecto)
    {   
    $query = $this->createQueryBuilder('s')
        ->select('s, u, p')
        ->join('s.n_idusuario', 'u')
        ->join('s.n_idproyecto', 'p')
        ->where('s.n_idusuario = :idUsuario')
        ->andWhere('s.n_idproyecto = :idProyecto')
        ->setParameter('idUsuario', $idUsuario)
        ->setParameter('idProyecto', $idProyecto)
        ->getQuery();

    $solicitud = $query->getSingleResult();
    $solicitud->setstatus(bentatecnologies_solicitudes::STATUS_ACEPTADO);
    $this->_em->persist($solicitud);
    $this->_em->flush();   
    }
    
    
    
    /*
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
    */

    
    

    
    

    
 }
