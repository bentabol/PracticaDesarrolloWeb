<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 * @ORM\Table(name="bentatecnologies_proyectos")
 */
class Proyecto implements JsonSerializable
{
    /**
     * @ORM\GeneratedValue()
     * @ORM\Id
     * @ORM\Column(name="id_proyecto", type="integer")
     */
    private $id_proyecto;

    /**
     * @ORM\Column(name="c_nombreProyecto", type="string", length=100, nullable=false)
     */
    private $c_nombreProyecto;

    /**
     * @ORM\Column(name="c_descripcionProyecto", type="string", length=100, nullable=false)
     */
    private $c_descripcionProyecto;

    /**
     * @ORM\Column(name="c_responsableProyecto", type="string", length=100, nullable=false)
     */
    private $c_responsableProyecto;

    /**
     * @ORM\Column(name="f_fechaInicioProyecto", type="date", nullable=false)
     */
    private $f_fechaInicioProyecto;

    /**
     * @ORM\Column(name="f_fechaFinProyecto", type="date", nullable=false)
     */
    private $f_fechaFinProyecto;

    /**
     * @ORM\Column(name="l_activoProyecto", type="boolean", nullable=false)
     */
    private $i_activoProyecto;

    /**
     * @ORM\Column(name="c_tamañoArchivo", type="string", length=100, nullable=false)
     */
    private $c_tamanioArchivo;


    /**
     * @ORM\Column(name="c_ruta_archivo", type="string", length=100, nullable=false)
     */
    private $c_ruta_archivo;

    /**
     * @ORM\ManyToOne(targetEntity=Usuario::class, fetch="EAGER")
     * @ORM\JoinColumn(name="n_idusuario", referencedColumnName="id_usuario")
     */
    private Usuario $usuario;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Solicitud", mappedBy="proyecto")
     */
    private $solicitudes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tarea", mappedBy="proyecto")
     */
    private $tareas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reunion", mappedBy="proyecto")
     */
    private $reuniones;

    public function __construct()
    {
        $this->solicitudes = new ArrayCollection();
        $this->tareas = new ArrayCollection();
        $this->reuniones = new ArrayCollection();
    }

    /**
     * Get the value of id
     */
    public function getid_proyecto()
    {
        return $this->id_proyecto;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setid_proyecto($id_proyecto)
    {
        $this->id_proyecto = $id_proyecto;

        return $this;
    }

    /**
     * Get the value of c_nombreProyecto
     */
    public function getc_nombreProyecto()
    {
        return $this->c_nombreProyecto;
    }

    /**
     * Set the value of c_nombreProyecto
     *
     * @return  self
     */
    public function setc_nombreProyecto($c_nombreProyecto)
    {
        $this->c_nombreProyecto = $c_nombreProyecto;

        return $this;
    }

    /**
     * Get the value of c_descripcionProyecto
     */
    public function getc_descripcionProyecto()
    {
        return $this->c_descripcionProyecto;
    }

    /**
     * Set the value of c_descripcionProyecto
     *
     * @return  self
     */
    public function setc_descripcionProyecto($c_descripcionProyecto)
    {
        $this->c_descripcionProyecto = $c_descripcionProyecto;

        return $this;
    }

    /**
     * Get the value of c_responsableProyecto
     */
    public function getc_responsableProyecto()
    {
        return $this->c_responsableProyecto;
    }

    /**
     * Set the value of c_responsableProyecto
     *
     * @return  self
     */
    public function setc_responsableProyecto($c_responsableProyecto)
    {
        $this->c_responsableProyecto = $c_responsableProyecto;

        return $this;
    }

    /**
     * Get the value of f_fechaInicioProyecto
     */
    public function getf_fechaInicioProyecto()
    {
        return $this->f_fechaInicioProyecto;
    }

    /**
     * Set the value of f_fechaInicioProyecto
     *
     * @return  self
     */
    public function setf_fechaInicioProyecto($f_fechaInicioProyecto)
    {
        $this->f_fechaInicioProyecto = $f_fechaInicioProyecto;

        return $this;
    }

    /**
     * Get the value of f_fechaFinProyecto
     */
    public function getf_fechaFinProyecto()
    {
        return $this->f_fechaFinProyecto;
    }

    /**
     * Set the value of f_fechaFinProyecto
     *
     * @return  self
     */
    public function setf_fechaFinProyecto($f_fechaFinProyecto)
    {
        $this->f_fechaFinProyecto = $f_fechaFinProyecto;

        return $this;
    }

    /**
     * Get the value of activoProyecto
     */
    public function getI_activoProyecto()
    {
        return $this->i_activoProyecto;
    }

    /**
     * Set the value of activoProyecto
     *
     * @return  self
     */
    public function setI_activoProyecto($i_activoProyecto)
    {
        $this->i_activoProyecto = $i_activoProyecto;

        return $this;
    }

    /**
     * Get the value of c_ruta_archivo
     */
    public function getc_ruta_archivo()
    {
        return $this->c_ruta_archivo;
    }

    /**
     * Set the value of c_ruta_archivo
     *
     * @return  self
     */
    public function setc_ruta_archivo($c_ruta_archivo)
    {
        $this->c_ruta_archivo = $c_ruta_archivo;

        return $this;
    }


    /**
     * Get the value of n_idusuario
     */
    public function getSolicitudes()
    {
        return $this->solicitudes;
    }

    /**
     * Set the value of n_idusuario
     *
     * @return  self
     */
    public function setSolicitudes($solicitudes)
    {
        $this->solicitudes = $solicitudes;

        return $this;
    }

    /**
     * Get the value of usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     *
     * @return  self
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get the value of c_tamanioArchivo
     */
    public function getC_tamanioArchivo()
    {
        return $this->c_tamanioArchivo;
    }

    /**
     * Set the value of c_tamanioArchivo
     *
     * @return  self
     */
    public function setC_tamanioArchivo($c_tamanioArchivo)
    {
        $this->c_tamanioArchivo = $c_tamanioArchivo;

        return $this;
    }

    /**
     * Convierte el objeto actual en un array.
     * 
     * Este metodo sirve para convertir a json cuando queramos dar una respuesta de este tipo (para peticiones ajax)
     */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    /**
     * Get the value of tareas
     */
    public function getTareas()
    {
        return $this->tareas;
    }

    /**
     * Set the value of tareas
     *
     * @return  self
     */
    public function setTareas($tareas)
    {
        $this->tareas = $tareas;

        return $this;
    }

    /**
     * Get the value of reuniones
     */
    public function getReuniones()
    {
        return $this->reuniones;
    }

    /**
     * Set the value of reuniones
     *
     * @return  self
     */
    public function setReuniones($reuniones)
    {
        $this->reuniones = $reuniones;

        return $this;
    }
}
