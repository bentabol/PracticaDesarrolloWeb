<?php
namespace Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;

/**
 * @ORM\Entity(repositoryClass="Model\Repository\TareaRepository")
 * @ORM\Table(name="bentatecnologies_tareas")
 */
class bentatecnologies_tarea
{
    /**
     * @ORM\GeneratedValue()
     * @ORM\Id
     * @ORM\Column(name="id_tarea", type="integer")
     * @ORM\ManyToOne(targetEntity="bentatecnologies_informes")
     * @ORM\JoinColumn(name="id_tarea", referencedColumnName="n_idtarea")
     */
    private $id_tarea;

    /**
     * @ORM\Column(name="c_nombreTarea", type="string", length=100, nullable=false)
     */    
    private $c_nombreTarea;

    /**
     * @ORM\Column(name="c_descripcionTarea", type="string", length=100, nullable=false)
     */    
    private $c_descripcionTarea;
    
    /**
     * @ORM\Column(name="c_responsableTarea", type="string", length=100, nullable=false)
     */    
    private $c_responsableTarea;
    
    /**
     * @ORM\Column(name="f_fechaInicioTarea", type="date", nullable=false)
     */    
    private $f_fechaInicioTarea;
    
    /**
     * @ORM\Column(name="f_fechaFinTarea", type="date", nullable=false)
     */    
    private $f_fechaFinTarea;
    
    /**
     * @ORM\Column(name="l_activoTarea", type="boolean", nullable=false)
     */ 
    private $i_activoTarea;
    
    /**
     * @ORM\Column(name="n_idproyecto", type="integer")
     */ 
    private $n_idproyecto; 

    /**
     * @ORM\Column(name="n_idusuario", type="integer")
     */ 
    private $n_idusuario; 

    public function __construct()
    {        
    }

    /**
     * Get the value of id
     */ 
    public function getid_tarea()
    {
        return $this->id_tarea;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setid_tarea($id_tarea)
    {
        $this->id_tarea = $id_tarea;

        return $this;
    }

    /**
     * Get the value of c_nombreTarea
     */ 
    public function getc_nombreTarea()
    {
        return $this->c_nombreTarea;
    }

    /**
     * Set the value of c_nombreTarea
     *
     * @return  self
     */ 
    public function setc_nombreTarea($c_nombreTarea)
    {
        $this->c_nombreTarea = $c_nombreTarea;

        return $this;
    }

    /**
     * Get the value of c_descripcionTarea
     */ 
    public function getc_descripcionTarea()
    {
        return $this->c_descripcionTarea;
    }

    /**
     * Set the value of c_descripcionTarea
     *
     * @return  self
     */ 
    public function setc_descripcionTarea($c_descripcionTarea)
    {
        $this->c_descripcionTarea = $c_descripcionTarea;

        return $this;
    }
    
    /**
    * Get the value of c_responsableTarea
    */ 
    public function getc_responsableTarea()
    {
        return $this->c_responsableTarea;
    }

    /**
     * Set the value of c_responsableTarea
     *
     * @return  self
     */ 
    public function setc_responsableTarea($c_responsableTarea)
    {
        $this->c_responsableTarea = $c_responsableTarea;

        return $this;
    }
    
    /**
    * Get the value of f_fechaInicioTarea
    */ 
    public function getf_fechaInicioTarea()
    {
        return $this->f_fechaInicioTarea;
    }

    /**
     * Set the value of f_fechaInicioTarea
     *
     * @return  self
     */ 
    public function setf_fechaInicioTarea($f_fechaInicioTarea)
    {
        $this->f_fechaInicioTarea = $f_fechaInicioTarea;

        return $this;
    }
    
    /**
    * Get the value of f_fechaFinTarea
    */ 
    public function getf_fechaFinTarea()
    {
        return $this->f_fechaFinTarea;
    }

    /**
     * Set the value of f_fechaFinTarea
     *
     * @return  self
     */ 
    public function setf_fechaFinTarea($f_fechaFinTarea)
    {
        $this->f_fechaFinTarea = $f_fechaFinTarea;

        return $this;
    }
    
     /**
     * Get the value of activoTarea
     */ 
    public function getI_activoTarea()
    {
        return $this->i_activoTarea;
    }

    /**
     * Set the value of activoTarea
     *
     * @return  self
     */ 
    public function setI_activoTarea($i_activoTarea)
    {
        $this->i_activoTarea= $i_activoTarea;

        return $this;
    }
    
    /**
     * Get the value of n_idproyecto
     */ 
    public function getN_idproyecto()
    {
        return $this->n_idproyecto;
    }

    /**
     * Set the value of n_idproyecto
     *
     * @return  self
     */ 
    public function setN_idproyecto($n_idproyecto)
    {
        $this->n_idproyecto = $n_idproyecto;

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