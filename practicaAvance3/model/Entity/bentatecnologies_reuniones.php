<?php
namespace Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;

/**
 * @ORM\Entity(repositoryClass="Model\Repository\ReunionesRepository")
 * @ORM\Table(name="bentatecnologies_reuniones")
 */
class bentatecnologies_reuniones
{
    /**
     * @ORM\GeneratedValue()
     * @ORM\Id
     * @ORM\Column(name="id_convocatoria", type="integer")
     */
    private $id_convocatoria;
    
    /**
    * @ORM\Column(name="c_tituloReunion", type="string", length=100, nullable=false)
    */    
    private $c_tituloReunion;

     /**
     * @ORM\Column(name="f_fechaReunion", type="date", nullable=false)
     */    
    private $f_fechaReunion;
    
    /**
     * @ORM\Column(name="t_horaReunion", type="time", nullable=false)
     */    
    private $t_horaReunion;

    /**
    * @ORM\Column(name="c_lugarReunion", type="string", length=100, nullable=false)
    */    
    private $c_lugarReunion;
    
    /**
     * @ORM\Column(name="c_descripcionReunion", type="string", length=100, nullable=false)
     */    
    private $c_descripcionReunion;
    
    /**
     * @ORM\ManyToOne(targetEntity="bentatecnologies_proyectos")
     * @ORM\JoinColumn(name="n_idproyecto", referencedColumnName="id_proyecto")
     */ 
    private $n_idproyecto; 

    /**
     * @ORM\ManyToOne(targetEntity="bentatecnologies_usuarios")
     * @ORM\JoinColumn(name="n_idusuario", referencedColumnName="id_usuario")
     */ 
    private $n_idusuario; 

    public function __construct()
    {        
    }

    /**
     * Get the value of id
     */ 
    public function getid_convocatoria()
    {
        return $this->id_convocatoria;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setid_convocatoria($id_convocatoria)
    {
        $this->id_convocatoria = $id_convocatoria;

        return $this;
    }

    /**
     * Get the value of c_tituloReunion
     */ 
    public function getc_tituloReunion()
    {
        return $this->c_tituloReunion;
    }

    /**
     * Set the value of c_tituloReunion
     *
     * @return  self
     */ 
    public function setc_tituloReunion($c_tituloReunion)
    {
        $this->c_tituloReunion = $c_tituloReunion;

        return $this;
    }
    
    /**
    * Get the value of f_fechaReunion
    */ 
    public function getf_fechaReunion()
    {
        return $this->f_fechaReunion;
    }

    /**
     * Set the value of f_fechaReunion
     *
     * @return  self
     */ 
    public function setf_fechaReunion($f_fechaReunion)
    {
        $this->f_fechaReunion = $f_fechaReunion;

        return $this;
    }
    
    /**
    * Get the value of t_horaReunion
    */ 
    public function gett_horaReunion()
    {
        return $this->t_horaReunion;
    }

    /**
     * Set the value of f_fechaReunion
     *
     * @return  self
     */ 
    public function sett_horaReunion($t_horaReunion)
    {
        $this->t_horaReunion = $t_horaReunion;

        return $this;
    }

    /**
     * Get the value of c_lugarReunion
     */ 
    public function getc_lugarReunion()
    {
        return $this->c_lugarReunion;
    }

    /**
     * Set the value of c_lugarReunion
     *
     * @return  self
     */ 
    public function setc_lugarReunion($c_lugarReunion)
    {
        $this->c_lugarReunion = $c_lugarReunion;

        return $this;
    }
    
    /**
     * Get the value of c_descripcionReunion
     */ 
    public function getc_descripcionReunion()
    {
        return $this->c_descripcionReunion;
    }

    /**
     * Set the value of c_descripcionReunion
     *
     * @return  self
     */ 
    public function setc_descripcionReunion($c_descripcionReunion)
    {
        $this->c_descripcionReunion = $c_descripcionReunion;

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