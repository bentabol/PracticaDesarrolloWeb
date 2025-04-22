<?php

namespace App\Repository;

use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;

class UserRepository extends ServiceEntityRepository implements UserLoaderInterface
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usuario::class);
    }

    public function newUser($c_username, $c_email, $c_nombre, $c_apellidos, $c_password, $tipoUsuario): Usuario
    {
        //Si fuera añadir un user nuevo ----> $user = new bentastore_usuarios() y ya despues seria igual
        $user = new Usuario($c_username, $c_email, $c_nombre, $c_apellidos, $c_password, $tipoUsuario);

        if ($user) {
            //Hacerlo con todos los argumentos de entrada
            $user->setUsername($c_username);
            $user->setc_email($c_email);
            $user->setc_nombre($c_nombre);
            $user->setc_apellidos($c_apellidos);
            $user->setPassword($c_password);
            $user->setTipoUsuario($tipoUsuario);
            $user->setI_activo(true);

            //Insertaria el usuario
            $this->_em->persist($user);
            $this->_em->flush();

            return $user;
        }
    }

    public function deleteUser($c_username, $c_email, $c_nombre, $c_apellidos, $c_password)
    {
        $user = $this->findOneBy(['c_nickname' => $c_username]);
        if ($user) {
            $this->_em->persist($user);
            $this->_em->remove($user);
        }
    }

    public function loginUser($t_conexiones, $n_idusero)
    {
        $logeado = new Usuario($t_conexiones, $n_idusero);
        if ($logeado) {
            //Hacerlo con todos los argumentos de entrada
            $logeado->sett_conexiones($t_conexiones);
            $logeado->setid_usuario($n_idusero);
            //Insertaria el usuario
            $this->_em->persist($logeado);
            $this->_em->flush();
        }
    }
    //Verifica q la sesion de ese usuario ya existe y no puedes registrarte ya que son exactamente los mismos datos
    public function usuarioExiste($nickname, $contrasena)
    {
        $sesionExiste = $this->findOneBy(['c_nickname' => $nickname, 'c_password' => $contrasena]);
        if ($sesionExiste) {
            return true;
        } else {
            return false;
        }
    }

    //Indica que ya hay un usuario con ese nombre
    public function usernameExists($nickname, $email)
    {
        $userExists = $this->findOneBy(['username' => $nickname, 'c_email' => $email]);
        if ($userExists) {
            return true;
        } else {
            return false;
        }
    }

    public function esActivo($idUsuario)
    {
        $userActive = $this->findOneBy(['id_usuario' => $idUsuario]);
        if ($userActive->geti_activo() == 1) {
            return 2;
        } else {
            return 1;
        }
    }

    public function usuarioActivo($activo)
    {
        if ($activo == 1) {
            return "Activo";
        } else {
            return "Inactivo";
        }
    }

    public function tipoUsuario($tipoUser)
    {
        $tipoUserId = $tipoUser->getid_tipo_usuario();
        if ($tipoUserId == 1) {
            return "Administrador";
        } else if ($tipoUserId == 2) {
            return "Gestor";
        } else if ($tipoUserId == 3) {
            return "Cliente";
        }
    }

    public function comprobarNameEmail($nombreusuario, $correo)
    {
        $recuperarPassword = $this->findOneBy(['c_nickname' => $nombreusuario, 'c_email' => $correo]);
        if ($recuperarPassword) {
            return $recuperarPassword->getc_password();
        } else {
            return false;
        }
    }

    public function getDatosUsuario($nombreUser)
    {
        $user = $this->findOneBy(['c_nickname' => $nombreUser]);
        if ($user) {
            return $user;
        } else {
            return null;
        }
    }


    public function getUsersOrderActives($rol = null, $username = null, $activo = null)
    {
        $qb =
            $this->createQueryBuilder('u')
            ->join('u.tipoUsuario', 'rol');

        if (!empty($rol)) {
            $qb
                ->andWhere('rol.id_tipo_usuario = :rol')
                ->setParameter('rol', $rol);
        }

        if (!empty($username)) {
            $qb
                ->andWhere('UPPER(u.username) LIKE UPPER(:username)')
                ->setParameter('username', '%' . $username . '%');
        }

        if (!empty($activo)) {
            $qb
                ->andWhere('u.i_activo = :activo')
                ->setParameter('activo', $activo);
        }

        $qb->orderBy('u.t_conexiones', 'DESC');

        return $qb->getQuery()->getResult();
    }

    public function getParticipantesActivos($username = null)
    {
        $qb =
            $this->createQueryBuilder('u')
            ->join('u.tipoUsuario', 'rol');

        $qb
            ->where('rol.id_tipo_usuario = :rol')
            ->andWhere('u.i_activo = :activo')
            ->setParameter('rol', 3)
            ->setParameter('activo', true);


        if (!empty($username)) {
            $qb
                ->andWhere('UPPER(u.username) LIKE UPPER(:username)')
                ->setParameter('username', '%' . $username . '%');
        }

        $qb->orderBy('u.t_conexiones', 'DESC');

        return $qb->getQuery()->getResult();
    }

    public function getCreadorProyect($userID)
    {
        $creadorProyect = $this->findOneBy(['id_usuario' => $userID]);
        if ($creadorProyect) {
            return $creadorProyect;
        } else {
            return null;
        }
    }

    public function getUserById($idUsuario)
    {
        $nicknameID = $this->findOneBy(['id_usuario' => $idUsuario]);
        if ($nicknameID) {
            return $nicknameID;
        } else {
            return null;
        }
    }
    public function loadUserByIdentifier(string $username)
    {
        return $this->loadUserByUsername($username);
    }

    public function loadUserByUsername(string $username)
    {
        $user = $this->createQueryBuilder('u')
            ->where('u.username = :username')
            ->andWhere('u.i_activo = :isActive')
            ->setParameter('username', $username)
            ->setParameter('isActive', true)
            ->getQuery()
            ->getOneOrNullResult();

        if (!$user) {
            throw new UserNotFoundException(sprintf('Usuario "%s" no encontrado o no activo.', $username));
        }

        return $user;
    }
}
