<?php

namespace App\Repository;

use App\Entity\Proyecto;
use App\Entity\Solicitud;
use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProjectRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Proyecto::class);
    }

    public function addproyect($c_nombreProyecto, $c_descripcionProyecto, $c_responsableProyecto, $f_fechaInicioProyecto, $f_fechaFinProyecto, $l_activoProyecto,  $c_tamañoArchivo, $c_ruta_archivo, $n_idusuario)
    {
        $proyect = new Proyecto($c_nombreProyecto, $c_descripcionProyecto, $c_responsableProyecto, $f_fechaInicioProyecto, $f_fechaFinProyecto, $l_activoProyecto, $c_tamañoArchivo, $c_ruta_archivo, $n_idusuario);
        if ($proyect) {
            //Hacerlo con todos los argumentos de entrada
            $proyect->setc_nombreProyecto($c_nombreProyecto);
            $proyect->setc_descripcionProyecto($c_descripcionProyecto);
            $proyect->setc_responsableProyecto($c_responsableProyecto);
            $proyect->setf_fechaInicioProyecto($f_fechaInicioProyecto);
            $proyect->setf_fechaFinProyecto($f_fechaFinProyecto);
            $proyect->seti_activoProyecto($l_activoProyecto);
            $proyect->setC_tamanioArchivo($c_tamañoArchivo);
            $proyect->setc_ruta_archivo($c_ruta_archivo);
            $proyect->setUsuario($n_idusuario);
            //Añadiria el plugin
            $this->_em->persist($proyect);
            $this->_em->flush();
        }
    }


    public function deleteProyect($id_proyecto)
    {
        $proyect = $this->findOneBy(['id_proyecto' => $id_proyecto]);
        if ($proyect) {
            $this->_em->persist($proyect);
            $this->_em->remove($proyect);
        }
    }

    function nombreProyectExists($nombreProyecto)
    {

        $proyect = $this->findOneBy(['c_nombreProyecto' => $nombreProyecto]);
        if ($proyect) {
            return true;
        } else {
            return false;
        }
    }

    public function getProyectosByFilter($nombre = '', $activo = null, ?Usuario $participante = null, ?Usuario $gestor = null)
    {
        $query = $this->createQueryBuilder('p')->select('p');

        if ($participante) {
            //Evitamos añadir los proyectos a los que ya se ha unido
            $query
                ->leftJoin('p.solicitudes', 's')
                ->leftJoin('s.usuario', 'u', 'WITH', 'u.username = :username')
                ->andWhere('s.status IS NULL')
                ->setParameter('username', $participante->getUsername());
        }

        if ($gestor) {
            $query
                ->join('p.usuario', 'gestor')
                ->andWhere('gestor.id_usuario = :idGestor')
                ->setParameter('idGestor', $gestor->getid_usuario());
        }

        if (!empty($nombre)) {
            $query->andWhere('p.c_nombreProyecto LIKE UPPER(:searchProyectName)')
                ->setParameter('searchProyectName', '%' . strtoupper($nombre) . '%');
        }

        if (!empty($activo)) {
            $query->andWhere('p.i_activoProyecto = :activo')
                ->setParameter('activo', $activo);
        }

        $query->orderBy('p.c_nombreProyecto');

        return $query->getQuery()->getResult();
    }

    public function getAllProyects()
    {
        $allProyects = $this->findAll();
        return $allProyects;
    }


    public function getUrlProyect($id_proyecto)
    {
        $urlProyects = $this->findOneBy(['id_proyecto' => $id_proyecto]);
        if ($urlProyects) {
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
        $proyectbyID = $this->findOneBy(['id_proyecto' => $id_proyecto]);
        if ($proyectbyID) {
            return $proyectbyID;
        } else {
            return null;
        }
    }

    function getMisProyectos($idUsuario)
    {
        $misProyectos = $this->findBy(['usuario' => $idUsuario]);
        if ($misProyectos) {
            return $misProyectos;
        } else {
            return null;
        }
    }

    function getMisProyectosUsuario(Usuario $user)
    {
        $query = $this->createQueryBuilder('p')
            ->select('p')
            ->join('p.solicitudes', 's', 'WITH', 's.status = :status')
            ->join('s.usuario', 'u', 'WITH', 'u.username = :username')
            ->setParameter('status', Solicitud::STATUS_ACEPTADO)
            ->setParameter('username', $user->getUsername())
            ->orderBy('p.c_nombreProyecto');

        return $query->getQuery()->getResult();
    }

    public function actualizarFichero($id_proyecto, $nombreFichero, $fileSize)
    {
        /** @var Proyecto $proyecto */
        $proyecto = $this->find($id_proyecto);

        if ($proyecto) {
            $proyecto->setc_ruta_archivo($nombreFichero);
            $proyecto->setC_tamanioArchivo($fileSize);

            $this->_em->persist($proyecto);
            $this->_em->flush();
        }
    }
}
