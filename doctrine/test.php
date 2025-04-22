<?php
    require_once("bootstrap.php");

    // select * from users
    $allUsers = $em->getRepository("\\Model\\Entity\\User")->findAll();
    // select * from users where id = 1
    $user1 = $em->getRepository("\\Model\\Entity\\User")->find(1);
    // select * from users where username='admin'
    $users = $em->getRepository("\\Model\\Entity\\User")->findBy(['username'=>'admin']);        // array con 1 elemento
    $user2 = $em->getRepository("\\Model\\Entity\\User")->findOneBy(['username'=>'admin']);     // objeto User
    
    // Metodos custom de repositorio
    $mayusers = $em->getRepository("\\Model\\Entity\\User")->getCustomUsers1();
    $user5 = $em->getRepository("\\Model\\Entity\\User")->getCustomUser('fperez');
    // select * from facturas where user_id = 2
    $u5_facturas = $user5->getFacturas();

    $newf = new \Model\Entity\Factura();
    $newf->setCantidad(123.56)
         ->setDate(new \DateTime())
         ->setUsuario($user5)
    ;
    $user5->addFactura($newf);
    try {
        $em->persist($newf);
        $em->persist($user5);
        $em->flush();
    }
    catch(\Exception $ex) {
        // Error de base de datos
        echo $ex->getMessage();
        exit;
    }

    $leer = $em->getRepository("\\Model\\Entity\\Interes")->findOneBy(['nombre'=>'Leer']);
    $user5->addInteres($leer);
    $leer->addUser($user5);
    try {
        $em->persist($leer);
        $em->persist($user5);
        $em->flush();
    }
    catch(\Exception $ex) {
        // Error de base de datos
        echo $ex->getMessage();
        exit;
    }

    // insert into users (...) values (...)
    $user3 = new \Model\Entity\User();
    $user3->setUsername('prueba')
          ->setPassword(md5('1234'))
          ->setNombre('Usuario')
          ->setApellidos('Pruebas')
          ->setEmail('prueba@localhost.local')
          ->setCreatedAt(new \DateTime())
          ->setUpdatedAt(new \DateTime())
    ;
    $em->persist($user3);
    try {
        $em->flush();
    }
    catch(\Exception $ex) {
        // Error de base de datos
    }

    // update users set ... where ...
    $user4 = $em->getRepository("\\Model\\Entity\\User")->findOneBy(['username'=>'prueba']); 
    $user4->setEmail('prueba@gmail.com')
          ->setUpdatedAt(new \DateTime())
    ;
    $em->persist($user4);
    try {
        $em->flush();
    }
    catch(\Exception $ex) {
        // Error de base de datos
    }    

    // delete from users where ...
    $em->remove($user4);
    try {
        $em->flush();
    }
    catch(\Exception $ex) {
        // Error de base de datos
    }          
?>
<!DOCTYPE html>
<html>
<head>    
    <meta charset="utf-8" />
</head>
<body>
    <pre>
        <b>Resultados</b>
        <ul>
        <?php
            foreach($allUsers as $u) {
                echo "<li>".$u->getNombre().' '.$u->getApellidos()."</li>";
            }
        ?>
        </ul>
        El usuario con id=1 es <?php echo $user1->fullname();?><br>
        Hay <?php echo count($users);?> con username = admin<br>
        El correo del usuario con username=admin es <?php echo $user2->getEmail();?><br>
        <ul>
        <?php
            foreach($mayusers as $key=>$u) {
                echo "<li>key=".$key." fullname=".$u->getNombre().' '.$u->getApellidos()."</li>";
            }
        ?>
        </ul>   
        El usuario con username=jsanchez es <?php echo $user5->fullname();?><br>     
    </pre>
</body>
</html>