<?php

namespace App\Repository;

use App\Entity\Tarea;
use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TareaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tarea::class);
    }

    function getTareas(Usuario $user)
    {
        $query = $this->createQueryBuilder('t')
            ->select('t')
            ->join('t.participantes', 'par')
            ->where('par.id_usuario = :usuarioId')
            ->setParameter('usuarioId', $user->getid_usuario())
            ->orderBy('t.fechaInicio');

        return $query->getQuery()->getResult();
    }
}
