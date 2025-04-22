<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReunionRepository")
 * @ORM\Table(name="bentatecnologies_reuniones")
 */
class Reunion
{
    /**
     * @ORM\GeneratedValue()
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="titulo", type="string", length=100, nullable=false)
     */
    private $titulo;

    /**
     * @ORM\Column(name="descripcion", type="string", length=250, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @ORM\Column(name="fichero", type="string", length=100, nullable=true)
     */
    private $fichero;

    /**
     * @ORM\Column(name="hora", type="string", length=5, nullable=false)
     */
    private $hora;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Usuario", inversedBy="reuniones")
     * @ORM\JoinTable(name="usuarios_reuniones",
     *      joinColumns={@ORM\JoinColumn(name="id_reunion", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_usuario", referencedColumnName="id_usuario")}
     * )
     */
    private $participantes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Proyecto", inversedBy="reuniones")
     * @ORM\JoinColumn(name="id_proyecto", referencedColumnName="id_proyecto", nullable=true)
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
     * Get the value of hora
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set the value of hora
     *
     * @return  self
     */
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get the value of titulo
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     *
     * @return  self
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of fecha
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

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
     * Get joinColumns={@ORM\JoinColumn(name="id_reunion", referencedColumnName="id")},
     */
    public function getParticipantes()
    {
        return $this->participantes;
    }

    /**
     * Set joinColumns={@ORM\JoinColumn(name="id_reunion", referencedColumnName="id")},
     *
     * @return  self
     */
    public function setParticipantes($participantes)
    {
        $this->participantes = $participantes;

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
}
