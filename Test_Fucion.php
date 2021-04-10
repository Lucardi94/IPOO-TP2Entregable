<?php
    include 'Funcion.php';
    $funcion1 = new Funcion("La vida", 250, array ("hora" => 16, "minuto" => 0), array ("hora" => 1, "minuto" => 58));
    $funcion2 = new Funcion("La vida", 250, array ("hora" => 15, "minuto" => 0), array ("hora" => 0, "minuto" => 3));
    $funcion3 = new Funcion("La vida", 250, array ("hora" => 23, "minuto" => 0), array ("hora" => 3, "minuto" => 0));
    $funcion4 = new Funcion("La vida", 250, array ("hora" => 22, "minuto" => 0), array ("hora" => 4, "minuto" => 15));
    $funcion5 = new Funcion("La vida", 250, array ("hora" => 15, "minuto" => 58), array ("hora" => 12, "minuto" => 0));
    //echo $funcion2->mostrarHora($funcion->calcularHoraFin());

    /*if ($funcion1->horaMayorInicio(15,59)){
        echo "1";
    } else echo "0";
    if ($funcion1->horaMayorInicio(16,0)){
        echo "1";
    } else echo "0";
    if ($funcion1->horaMayorInicio(16,1)){
        echo "1";
    } else echo "0";

    echo "\n";

    if ($funcion1->horaMenorFin(17,57)){
        echo "1";
    } else echo "0";
    if ($funcion1->horaMenorFin(17,58)){
        echo "1";
    } else echo "0";
    if ($funcion1->horaMenorFin(17,59)){
        echo "1";
    } else echo "0";*/

    /*if ($funcion1->dentroHorario(15,59,17,59)){
        echo "1";
    } else echo "0";
    if ($funcion1->dentroHorario(14,00,14,59)){
        echo "1";
    } else echo "0";
    if ($funcion1->dentroHorario(17,57,18,59)){
        echo "1";
    } else echo "0";*/

    if ($funcion3->horarioPosible($funcion4)){
        echo "1";
    } else echo "0";

    

