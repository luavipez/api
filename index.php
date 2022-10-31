<?php

require 'flight/Flight.php';

Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=loginbd','luc','S1ApT3p#2o2o'));

Flight::route('GET /', function () {
    $sql = "select * from datos";
    $consulta = Flight::db()->prepare($sql);
    $consulta->execute();
    $registros = $consulta->fetchAll();
    Flight::json($registros);
});


Flight::route('POST /', function () {
    $nombre = (Flight::request()->data->nombre);
    $passw = (Flight::request()->data->pass);
    $fechaN = (Flight::request()->data->fNac);
    $sql = "insert into datos values(null,?,?,?)";
    $consulta = Flight::db()->prepare($sql);
    $consulta->bindParam(1,$nombre);
    $consulta->bindParam(2,$passw);
    $consulta->bindParam(3,$fechaN);
    $consulta->execute();
    Flight::jsonp(["Registro guardado"]);
});


Flight::route('DELETE /', function () {
    $id = (Flight::request()->data->id);
    $sql = "delete from datos where id=?";
    $consulta = Flight::db()->prepare($sql);
    $consulta->bindParam(1,$id);
    $consulta->execute();
    Flight::jsonp(["Registro eliminado"]);
});


Flight::route('PUT /', function () {
    $id = (Flight::request()->data->id);
    $nombre = (Flight::request()->data->nombre);
    $passw = (Flight::request()->data->pass);
    $fechaN = (Flight::request()->data->fNac);
    $sql = "update datos set nombre=?, contra=?, fechaNac=? where id=?";
    $consulta = Flight::db()->prepare($sql);
    $consulta->bindParam(1,$nombre);
    $consulta->bindParam(2,$passw);
    $consulta->bindParam(3,$fechaN);
    $consulta->bindParam(4,$id);
    $consulta->execute();
    Flight::jsonp(["Registro actualizado"]);
});


Flight::start();
