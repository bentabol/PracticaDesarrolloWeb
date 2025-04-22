<?php
namespace Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Model\Repository\UserRepository")
 * @ORM\Table(name="bentatecnologies_tipo_usuarios")
 */
class bentatecnologies_tipo_usuarios
{
    /**
     * @ORM\GeneratedValue()
     *  @ORM\Id
     * @ORM\Column(name="id_tipo_usuario", type="integer")
     */
    private $id_tipo_usuario;

    /**
     * @ORM\Column(name="c_descripcion", type="string", length=100, nullable=false)
     */    
    private $c_descripcion;


    public function __construct()
    {        
    }    

    /**
     * Get the value of id_tipo_user
     */ 
    public function getid_tipo_usuario()
    {
        return $this->id_tipo_usuario;
    }

    /**
     * Set the value of id_tipo_user
     *
     * @return  self
     */ 
    public function setid_tipo_usuario($id_tipo_usuario)
    {
        $this->id_tipo_usuario = $id_tipo_usuario;

        return $this;
    }

    /**
     * Get the value of c_descripcion
     */ 
    public function getc_descripcion()
    {
        return $this->c_descripcion;
    }

    /**
     * Set the value of c_descripcion
     *
     * @return  self
     */ 
    public function setc_descripcion($c_descripcion)
    {
        $this->c_descripcion = $c_descripcion;

        return $this;
    }
}