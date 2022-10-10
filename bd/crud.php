<?php
    include_once 'conexion.php';
    $objeto=new Conexion();
    $conexion=$objeto->Conectar();

    $_POST=json_decode(file_get_contents("php://input"),true);

    $opcion=(isset($_POST['opcion'])) ? $_POST['opcion'] : '';
    $id=(isset($_POST['id'])) ? $_POST['id'] : '';
    $marca=(isset($_POST['marca'])) ? $_POST['marca'] : '';
    $modelo=(isset($_POST['modelo'])) ? $_POST['modelo'] : '';
    $stock=(isset($_POST['stock'])) ? $_POST['stock'] : '';

    switch($opcion){
        case 1:
            //alta
            $consulta="insert into moviles (marca,modelo,stock) values('$marca','$modelo','$stock')";
            print $consulta;
            $resultado=$conexion->prepare($consulta);
            $resultado->execute();
            break;
        case 2:
            //edicion
            $consulta="update moviles set marca='$marca', modelo='$modelo', stock='$stock' where id='$id'";
            $resultado=$conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 3:
            //borrar
            $consulta="delete from moviles where id='$id'";
            $resultado=$conexion->prepare($consulta);
            $resultado->execute();
            break;
        case 4:
            $consulta="select id, marca, modelo, stock from moviles";
            $resultado=$conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            //listar
            break;

    }
    print json_encode($data,JSON_UNESCAPED_UNICODE);
    $conexion=NULL;
?>























