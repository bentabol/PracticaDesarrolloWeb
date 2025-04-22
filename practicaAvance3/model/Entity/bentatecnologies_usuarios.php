<?php
namespace Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Model\Repository\UserRepository")
 * @ORM\Table(name="bentatecnologies_usuarios")
 */
class bentatecnologies_usuarios
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id_usuario", type="integer")
     */
    private $id_usuario;

    /**
     * @ORM\Column(name="c_nickname", type="string", length=100, nullable=false)
     */    
    private $c_nickname;

    
    /**
     * @ORM\Column(name="c_email", type="string", length=100, nullable=false)
     */    
    private $c_email;

    /**
     * @ORM\Column(name="c_nombre", type="string", length=100, nullable=false)
     */    
    private $c_nombre;

    /**
     * @ORM\Column(name="c_apellidos", type="string", length=100, nullable=false)
     */    
    private $c_apellidos;

    /**
     * @ORM\Column(name="c_password", type="string", length=100, nullable=false)
     */    
    private $c_password;

    /**
     * @ORM\Column(name="l_activo", type="boolean", nullable=false)
     */ 
    private $i_activo; 

    /**
     * @ORM\Column(name="t_conexiones", type="integer", nullable=false)
     */ 
    private $t_conexiones; 
    
    /**
     * @ORM\ManyToOne(targetEntity="bentatecnologies_tipo_usuarios")
     * @ORM\JoinColumn(name="n_idtipo_usuario", referencedColumnName="id_tipo_usuario")
     */ 
    private $n_idtipo_usuario; 
    
    /**
     * @ORM\ManyToMany(targetEntity="bentatecnologies_proyectos", mappedBy="usuarios")
     */ 
    private $proyectos; 


    public function __construct()
    {       
    }

    /**
     * Get the value of id
     */ 
    public function getid_usuario()
    {
        return $this->id_usuario;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setid_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    /**
     * Get the value of nickname
     */ 
    public function getc_nickname()
    {
        return $this->c_nickname;
    }

    /**
     * Set the value of nickname
     *
     * @return  self
     */ 
    public function setc_nickname($c_nickname)
    {
        $this->c_nickname = $c_nickname;

        return $this;
    }

     /**
     * Get the value of email
     */ 
    public function getc_email()
    {
        return $this->c_email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setc_email($c_email)
    {
        $this->c_email = $c_email;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getc_nombre()
    {
        return $this->c_nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setc_nombre($c_nombre)
    {
        $this->c_nombre = $c_nombre;

        return $this;
    }
    
    /**
     * Get the value of apellidos
     */ 
    public function getc_apellidos()
    {
        return $this->c_apellidos;
    }

    /**
     * Set the value of apellidos
     *
     * @return  self
     */ 
    public function setc_apellidos($c_apellidos)
    {
        $this->c_apellidos = $c_apellidos;

        return $this;
    }


    /**
     * Get the value of password
     */ 
    public function getc_password()
    {
        return $this->c_password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setc_password($c_password)
    {
        $this->c_password = $c_password;

        return $this;
    }


    
     /**
     * Get the value of activo
     */ 
    public function getI_activo()
    {
        return $this->i_activo;
    }

    /**
     * Set the value of activo
     *
     * @return  self
     */ 
    public function setI_activo($i_activo)
    {
        $this->i_activo = $i_activo;

        return $this;
    }

     /**
     * Get the value of conexiones
     */ 
    public function gett_conexiones()
    {
        return $this->t_conexiones;
    }

    /**
     * Set the value of conexiones
     *
     * @return  self
     */ 
    public function sett_conexiones($t_conexiones)
    {
        $this->t_conexiones = $t_conexiones;

        return $this;
    }

     /**
     * Get the value of n_idtipo_usuario
     */ 
    public function getn_idtipo_usuario()
    {
        return $this->n_idtipo_usuario;
    }

    /**
     * Set the value of n_idtipo_usuario
     *
     * @return  self
     */ 
    public function setn_idtipo_usuario($n_idtipo_usuario)
    {
       
        $this->n_idtipo_usuario = $n_idtipo_usuario;   

        return $this;
    }



    //Faltan las operaciones  

           
}