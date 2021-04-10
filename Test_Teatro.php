<?php 
    include 'Teatro.php';
    include 'Funcion.php';

    $funcion1 = new Funcion("La vida", 250, array ("hora" => 17, "minuto" => 0), array ("hora" => 1, "minuto" => 0));
    $funcion2 = new Funcion("La vida II", 350, array ("hora" => 19, "minuto" => 0), array ("hora" => 1, "minuto" => 0));
    $funcion3 = new Funcion("La vida III", 450, array ("hora" => 21, "minuto" => 0), array ("hora" => 1, "minuto" => 0));
    $funcion4 = new Funcion("La vida IV", 550, array ("hora" => 23, "minuto" => 0), array ("hora" => 1, "minuto" => 0));
    $listFunciones = [$funcion1, $funcion2, $funcion3, $funcion4];

    $t = new Teatro("Villaspeople","Amaranto Suarez 1114",$listFunciones);

    /*$t->seleccionFuncion();

    $t->cambiarNombre("KFC");
    $t->cambiarDireccion("Changalay 89");
    $t->cambiarNombreFuncion("Matrix pero no en HD",0);
    $t->cambiarPrecioFuncion(999,3);
    echo $t->mostrarFunciones();
    */

    if ($t->cargarFucion()){
        echo "lo cargo con exito";
    } else echo "no lo cargo nada" ;
    