<?php
namespace Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;

/**
 * @ORM\Entity(repositoryClass="Model\Repository\ProyectRepository")
 * @ORM\Table(name="bentatecnologies_proyectos")
 */
class bentatecnologies_proyectos
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
    private $c_tamañoArchivo; 


    /**
     * @ORM\Column(name="c_ruta_archivo", type="string", length=100, nullable=false)
     */ 
    private $c_ruta_archivo; 

    /**
     * @ORM\ManyToOne(targetEntity="bentatecnologies_usuarios")
     * @ORM\JoinColumn(name="n_idusuario", referencedColumnName="id_usuario")
     */ 
    private $n_idusuario;
    
    /**
     * @ORM\ManyToMany(targetEntity="bentatecnologies_usuarios")
     * @ORM\JoinTable(name="bentatecnologies_solicitudes",
     *      joinColumns={@ORM\JoinColumn(name="n_idproyecto", referencedColumnName="n_idproyecto")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="n_idusuario", referencedColumnName="n_idusuario")}
     * )
     */ 
    private $usuarios; 

    public function __construct()
    {        
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
     * Get the value of c_tamañoArchivo
     */ 
    public function getc_tamañoArchivo()
    {
        return $this->c_tamañoArchivo;
    }

    /**
     * Set the value of c_tamañoArchivo
     *
     * @return  self
     */ 
    public function setc_tamañoArchivo($c_tamañoArchivo)
    {
        $this->c_tamañoArchivo = $c_tamañoArchivo;

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
    public function getN_idusuario()
    {
        return $this->n_idusuario;
    }

    /**
     * Set the value of n_idusuario
     *
     * @return  self
     */ 
    public function setN_idusuario($n_idusuario)
    {
        $this->n_idusuario = $n_idusuario;

        return $this;
    }

    //Faltan las operaciones  

           
}