<?php

namespace App\Repository;

use App\Entity\Reunion;
use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ReunionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reunion::class);
    }

    function getReuniones(Usuario $user)
    {
        $query = $this->createQueryBuilder('r')
            ->select('r')
            ->join('r.participantes', 'par')
            ->where('par.id_usuario = :usuarioId')
            ->setParameter('usuarioId', $user->getid_usuario())
            ->orderBy('r.fecha');

        return $query->getQuery()->getResult();
    }
}
