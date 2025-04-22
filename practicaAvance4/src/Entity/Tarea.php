<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TareaRepository")
 * @ORM\Table(name="bentatecnologies_tareas")
 */
class Tarea
{
    /**
     * @ORM\GeneratedValue()
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @ORM\Column(name="descripcion", type="string", length=250, nullable=false)
     */
    private $descripcion;

    /**
     * @ORM\Column(name="fechaInicio", type="date", nullable=false)
     */
    private $fechaInicio;

    /**
     * @ORM\Column(name="fechaFin", type="date", nullable=true)
     */
    private $fechaFin;

    /**
     * @ORM\Column(name="progreso", type="integer", nullable=false, options={"default" : 0})
     */
    private $progreso = 0;

    /**
     * @ORM\Column(name="fichero", type="string", length=100, nullable=true)
     */
    private $fichero;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Usuario", inversedBy="tareas")
     * @ORM\JoinTable(name="usuarios_tareas",
     *      joinColumns={@ORM\JoinColumn(name="id_tarea", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_usuario", referencedColumnName="id_usuario")}
     * )
     */
    private $participantes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Proyecto", inversedBy="tareas")
     * @ORM\JoinColumn(name="id_proyecto", referencedColumnName="id_proyecto", nullable=false)
     */
    private $proyecto;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario")
     * @ORM\JoinColumn(name="id_usuario", referencedColumnName="id_usuario", nullable=false)
     */
    private $creador;

    public function __construct()
    {
        $this->participantes = new ArrayCollection();
    }

    /**
     * Get the value of progreso
     */
    public function getProgreso()
    {
        return $this->progreso;
    }

    /**
     * Set the value of progreso
     *
     * @return  self
     */
    public function setProgreso($progreso)
    {
        $this->progreso = $progreso;

        return $this;
    }

    /**
     * Get the value of fechaFin
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set the value of fechaFin
     *
     * @return  self
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of fechaInicio
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set the value of fechaInicio
     *
     * @return  self
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get the value of proyecto
     */
    public function getProyecto()
    {
        return $this->proyecto;
    }

    /**
     * Set the value of proyecto
     *
     * @return  self
     */
    public function setProyecto($proyecto)
    {
        $this->proyecto = $proyecto;

        return $this;
    }

    /**
     * Get the value of creador
     */
    public function getCreador()
    {
        return $this->creador;
    }

    /**
     * Set the value of creador
     *
     * @return  self
     */
    public function setCreador($creador)
    {
        $this->creador = $creador;

        return $this;
    }

    /**
     * Get the value of fichero
     */
    public function getFichero()
    {
        return $this->fichero;
    }

    /**
     * Set the value of fichero
     *
     * @return  self
     */
    public function setFichero($fichero)
    {
        $this->fichero = $fichero;

        return $this;
    }

    /**
     * Get joinColumns={@ORM\JoinColumn(name="id_tarea", referencedColumnName="id")},
     */
    public function getParticipantes()
    {
        return $this->participantes;
    }

    /**
     * Set joinColumns={@ORM\JoinColumn(name="id_tarea", referencedColumnName="id")},
     *
     * @return  self
     */
    public function setParticipantes($participantes)
    {
        $this->participantes = $participantes;

        return $this;
    }
}
