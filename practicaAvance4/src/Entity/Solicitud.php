<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SolicitudesRepository")
 * @ORM\Table(name="bentatecnologies_solicitudes")
 */
class Solicitud
{
    public const STATUS_ACEPTADO = "Aceptado";
    public const STATUS_PENDIENTE_PROFESOR = "Pendiente_Profesor";
    public const STATUS_PENDIENTE_USUARIO = "Pendiente_usuario";

    /**
     * @ORM\Column(name="status", type="string", length=100, nullable=false, columnDefinition="ENUM('Aceptado', 'Pendiente_Profesor', 'Pendiente_usuario')")
     */
    private $status;

    /**
     * @Id
     * @ORM\ManyToOne(targetEntity=Usuario::class, inversedBy="solicitudes")
     * @ORM\JoinColumn(name="n_idusuario", referencedColumnName="id_usuario")
     */
    private Usuario $usuario;

    /**
     * @Id
     * @ORM\ManyToOne(targetEntity=Proyecto::class, inversedBy="solicitudes")
     * @ORM\JoinColumn(name="n_idproyecto", referencedColumnName="id_proyecto")
     */
    private Proyecto $proyecto;

    public function __construct()
    {
    }

    public function getstatus()
    {
        return $this->status;
    }

    public function setstatus($status)
    {
        $this->status = $status;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function getProyecto()
    {
        return $this->proyecto;
    }

    public function setProyecto($proyecto)
    {
        $this->proyecto = $proyecto;
    }
}
