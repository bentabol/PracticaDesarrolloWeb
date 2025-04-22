<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="bentatecnologies_usuarios")
 */
class Usuario implements UserInterface, JsonSerializable
{
    /**
     * Define la equivalencia entre los roles de bbdd y con los que vamos a trabajar en symfony.
     * En symfony tienen que empezar con el prefijo ROLE_
     */
    private const ROLE_MAPPING = [
        'Administrador' => 'ROLE_ADMIN',
        'Gestor' => 'ROLE_GESTOR',
        'Cliente' => 'ROLE_CLIENTE'
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id_usuario", type="integer")
     */
    private $id_usuario;

    /**
     * @ORM\Column(name="c_nickname", type="string", length=100, nullable=false)
     */
    private $username;


    /**
     * @ORM\Column(name="c_email", type="string", length=100, nullable=false)
     */
    private $c_email;

    /**
     * @ORM\Column(name="c_nombre", type="string", length=100, nullable=false)
     */
    private $c_nombre;

    /**
     * @ORM\Column(name="c_telefono", type="string", length=9, nullable=true)
     */
    private $telefono;

    /**
     * @ORM\Column(name="c_direccion", type="string", length=200, nullable=true)
     */
    private $direccion;

    /**
     * @ORM\Column(name="c_apellidos", type="string", length=100, nullable=false)
     */
    private $c_apellidos;


    /**
     * @ORM\Column(name="c_password", type="string", length=100, nullable=false)
     */
    private $password;

    /**
     * @ORM\Column(name="l_activo", type="boolean", nullable=false)
     */
    private $i_activo;

    /**
     * @ORM\Column(name="t_conexiones", type="integer", nullable=false)
     */
    private $t_conexiones;

    /**
     * @ORM\ManyToOne(targetEntity=TipoUsuario::class, fetch="EAGER")
     * @ORM\JoinColumn(name="n_idtipo_usuario", referencedColumnName="id_tipo_usuario")
     */
    private TipoUsuario $tipoUsuario;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Solicitud", mappedBy="usuario")
     */
    private $solicitudes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tarea", mappedBy="usuarios")
     */
    private $tareas;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Reunion", mappedBy="reuniones")
     */
    private $reuniones;

    private $roles;


    public function __construct()
    {
        $this->solicitudes = new ArrayCollection();
        $this->tareas = new ArrayCollection();
        $this->reuniones = new ArrayCollection();
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

    public function getTipoUsuario(): TipoUsuario
    {
        return $this->tipoUsuario;
    }

    public function setTipoUsuario($tipoUsuario)
    {

        $this->tipoUsuario = $tipoUsuario;

        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles()
    {
        //Devuelve el rol de symfony correspondiente al que tiene asignado el usuario en bbdd
        return [self::ROLE_MAPPING[$this->tipoUsuario->getc_descripcion()]];
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;

        return $this;
    }

    public function getUserIdentifier()
    {
        return $this->username;
    }

    public function eraseCredentials()
    {
    }

    public function getSalt()
    {
        return null;
    }

    public function getSolicitudes()
    {
        return $this->solicitudes;
    }

    public function setSolicitudes($solicitudes)
    {
        $this->solicitudes = $solicitudes;

        return $this;
    }

    /**
     * Get the value of telefono
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get the value of direccion
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     *
     * @return  self
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Convierte el objeto actual en un array.
     * 
     * Este metodo sirve para convertir a json cuando queramos dar una respuesta de este tipo (para peticiones ajax)
     */
    public function jsonSerialize(): array
    {
        $data = get_object_vars($this);
        unset($data['solicitudes']);

        return $data;
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

    public function __toString()
    {
        return $this->id_usuario;
    }
}
