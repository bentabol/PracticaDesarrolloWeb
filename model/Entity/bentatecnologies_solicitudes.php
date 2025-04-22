<?php
namespace Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;

/**
 * @ORM\Entity(repositoryClass="Model\Repository\SolicitudesRepository")
 * @ORM\Table(name="bentatecnologies_solicitudes")
 */
class bentatecnologies_solicitudes
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
     * @ORM\ManyToOne(targetEntity="bentatecnologies_usuarios")
     * @ORM\JoinColumn(name="n_idusuario", referencedColumnName="id_usuario")
     */ 
    private $n_idusuario;
    
    /**
     * @Id
     * @ORM\ManyToOne(targetEntity="bentatecnologies_proyectos")
     * @ORM\JoinColumn(name="n_idproyecto", referencedColumnName="id_proyecto")
     */ 
    private $n_idproyecto;
    
    
    public function __construct()
    {
        
    }
    
     /**
     * Get the value of status
     */ 
    public function getstatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setstatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getn_idproyecto()
    {
        return $this->n_idproyecto;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setn_idproyecto($n_idproyecto)
    {
        $this->n_idproyecto = $n_idproyecto;

        return $this;
    }


    /**
     * Get the value of n_idusuario
     */ 
    public function getn_idusuario()
    {
        return $this->n_idusuario;
    }

    /**
     * Set the value of n_idusuario
     *
     * @return  self
     */ 
    public function setn_idusuario($n_idusuario)
    {
        $this->n_idusuario = $n_idusuario;

        return $this;
    }

    //Faltan las operaciones  

           
}