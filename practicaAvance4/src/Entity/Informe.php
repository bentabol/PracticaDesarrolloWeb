<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InformesRepository")
 * @ORM\Table(name="bentatecnologies_informes")
 */
class Informe
{
    /**
     * @ORM\GeneratedValue()
     *  @ORM\Id
     * @ORM\Column(name="id_informe", type="integer")
     */
    private $id_informe;

    /**
     * @ORM\Column(name="f_fecha", type="string", length=100, nullable=false)
     */
    private $f_fecha;

    /**
     * @ORM\Column(name="t_descargas", type="integer")
     */

    private $t_descargas;

    /**
     * @ORM\Column(name="c_errores", type="string", length=100, nullable=false)
     */

    private $c_errores;

    /**
     * @ORM\Column(name="t_exportaciones", type="integer")
     */
    private $t_exportaciones;

    /**
     * @ORM\ManyToOne(targetEntity=Proyecto::class)
     * @ORM\JoinColumn(name="n_idproyecto", referencedColumnName="id_proyecto")
     */
    private Proyecto $proyecto;

    /**
     * @ORM\Column(name="n_idtarea", type="integer")
     */
    private $n_idtarea;

    /**
     * @ORM\ManyToOne(targetEntity=Usuario::class)
     * @ORM\JoinColumn(name="n_idusuario", referencedColumnName="id_usuario")
     */
    private Usuario $usuario;

    public function __construct()
    {
    }

    /**
     * Get the value of id
     */
    public function getId_informe()
    {
        return $this->id_informe;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId_informe($id_informe)
    {
        $this->id_informe = $id_informe;

        return $this;
    }

    /**
     * Get the value of fecha
     */
    public function getF_fecha()
    {
        return $this->f_fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */
    public function setF_fecha($f_fecha)
    {
        $this->f_fecha = $f_fecha;

        return $this;
    }

    /**
     * Get the value of t_valoracion
     */
    public function getT_valoracion()
    {
        return $this->t_valoracion;
    }

    /**
     * Set the value of t_valoracion
     *
     * @return  self
     */
    public function setT_valoracion($t_valoracion)
    {
        $this->t_valoracion = $t_valoracion;

        return $this;
    }

    /**
     * Get the value of t_descargas
     */
    public function getT_descargas()
    {
        return $this->t_descargas;
    }

    /**
     * Set the value of t_descargas
     *
     * @return  self
     */
    public function setT_descargas($t_descargas)
    {
        $this->t_descargas = $t_descargas;

        return $this;
    }

    /**
     * Get the value of c_errores
     */
    public function getc_errores()
    {
        return $this->c_errores;
    }

    /**
     * Set the value of c_errores
     *
     * @return  self
     */
    public function setc_errores($c_errores)
    {
        $this->c_errores = $c_errores;

        return $this;
    }


    /**
     * Get the value of t_exportaciones
     */
    public function getT_exportaciones()
    {
        return $this->t_exportaciones;
    }

    /**
     * Set the value of t_exportaciones
     *
     * @return  self
     */
    public function setT_exportaciones($t_exportaciones)
    {
        $this->t_exportaciones = $t_exportaciones;

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
     * Get the value of n_idtarea
     */
    public function getN_idtarea()
    {
        return $this->n_idtarea;
    }

    /**
     * Set the value of n_idtarea
     *
     * @return  self
     */
    public function setN_idtarea($n_idtarea)
    {
        $this->n_idtarea = $n_idtarea;

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
    public function setn_idusuario($n_idusuario)
    {
        $this->n_idusuario = $n_idusuario;

        return $this;
    }

    //Faltan las operaciones  


}
