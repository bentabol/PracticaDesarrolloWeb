<?php

namespace App\Repository;

use App\Entity\Solicitud;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SolicitudesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Solicitud::class);
    }

    public function addsolicitud($usuario, $proyecto, $status)
    {
        $solicitud = new Solicitud();
        //Hacerlo con todos los argumentos de entrada
        $solicitud->setUsuario($usuario);
        $solicitud->setProyecto($proyecto);
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
            ->select('s')
            ->join('s.usuario', 'u')
            ->join('s.proyecto', 'p')
            ->where('s.status = :status')
            ->andWhere('p.usuario = :idUsuario')
            ->setParameter('status', Solicitud::STATUS_PENDIENTE_PROFESOR)
            ->setParameter('idUsuario', $idUsuario)
            ->getQuery();

        return $query->getResult();
    }


    public function aceptarSolicitudUsuarioProyecto($idUsuario, $idProyecto)
    {
        $query = $this->createQueryBuilder('s')
            ->select('s, u, p')
            ->join('s.usuario', 'u')
            ->join('s.proyecto', 'p')
            ->where('s.usuario = :idUsuario')
            ->andWhere('s.proyecto = :idProyecto')
            ->setParameter('idUsuario', $idUsuario)
            ->setParameter('idProyecto', $idProyecto)
            ->getQuery();

        $solicitud = $query->getSingleResult();
        $solicitud->setstatus(Solicitud::STATUS_ACEPTADO);
        $this->_em->persist($solicitud);
        $this->_em->flush();
    }
}
