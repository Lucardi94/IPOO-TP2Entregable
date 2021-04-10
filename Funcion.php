<?php
    class Funcion{
        /***
         *  Representacion de la clase Funcion.
         *  - Atributos:
         *      + nombre string
         *      + precio float
         *      + horaInicio array (hora, minuto)
         *      + duracion array (hora, minuto)
         *  - Fuciones:
         *      + horarioPosible($otraFuncion)
         *          - dentroHorario($hora1, $min1, $hora2, $min2)
         *              + horaMayorInicio($hora, $min)
         *              + horaMenorFin($hora, $min)
         *                  - calcularHoraFin()
         *          - dentroHorarioDos($hora1, $min1, $hora2, $min2)
         *              + horaMayorInicio($hora, $min)
         *              + horaMenorFin($hora, $min)
         *                  - calcularHoraFin()
         *      + to_string()
         *          - mostrarHora($tiempo)
         */
        private $nombre;
        private $precio;
        private $horaInicio; // array (hora, minuto)
        private $duracion; // array (hora, minuto)

        public function __construct($nom, $pre, $horIni, $dur)
        {
            $this->nombre = $nom;
            $this->precio = $pre;
            $this->horaInicio = $horIni;
            $this->duracion = $dur;
        }

        public function getNombre(){
            return $this->nombre;
        }
        public function getPrecio(){
            return $this->precio;
        }
        public function getHoraInicio(){
            return $this->horaInicio;
        }
        public function getDuracion(){
            return $this->duracion;
        }

        public function setNombre($nNom){
            $this->nombre = $nNom;
        }
        public function setPrecio($nPre){
            $this->precio = $nPre;
        }
        public function setHoraInicio($nHorI){
            $this->horaInicio = $nHorI;
        }
        public function setDuracion($nDur){
            $this->duracion = $nDur;
        }

        public function calcularHoraFin(){
            /***
             * Retorna un array asosiativo con la hora cuando termina la obra
             * Tiene en cuenta si los minutos pasan la hora y si la hora pasa al dia siguiente
             */ 

            $horFin = $this->getHoraInicio()["hora"] + $this->getDuracion()["hora"];
            $minFin = $this->getHoraInicio()["minuto"]+$this->getDuracion()["minuto"];;
            if ($minFin >= 60){
                $minFin = $minFin - 60;
                $horFin = $horFin + 1;
            }
            if ($horFin >= 24){
                $horFin = $horFin - 24;
            }

            return array ("hora" => $horFin, "minuto" => $minFin);
        }

        public function horaMayorInicio($hora, $min){
            //Retorna un true o false si e horario por parametro es mayor al atributo hora inicio.
            if ($this->getHoraInicio()["hora"] < $hora || ($this->getHoraInicio()["hora"] == $hora && $this->getHoraInicio()["minuto"] < $min)){
                return TRUE;
            } else return FALSE;
        }

        public function horaMenorFin($hora, $min){
            //Retorna un true o false si e horario por parametro es menor a la hora de finalizacion.
            if ($this->calcularHoraFin()["hora"] > $hora || ($this->calcularHoraFin()["hora"] == $hora && $this->calcularHoraFin()["minuto"] > $min)){
                return TRUE;
            } else return FALSE;
        }

        public function dentroHorario($hora1, $min1, $hora2, $min2){
            // Retorna un true o false si dos hoarios ingresados por parametros estan dentro del horario de la funcion.
            if (($this->horaMayorInicio($hora1, $min1) && $this->horaMenorFin($hora1, $min1)) || ($this->horaMayorInicio($hora2, $min2) && $this->horaMenorFin($hora2, $min2))){
                return TRUE;
            } else FALSE;
        }

        public function dentroHorarioDos($hora1, $min1, $hora2, $min2){
            // Similar al anterior; este se utiliza cuando el horario de la funcion pasa de las 00:00, si uno de los horarios ingresado esta dentro de la funcion.
            if ($this->horaMayorInicio($hora1, $min1) || $this->horaMenorFin($hora1, $min1) || $this->horaMayorInicio($hora2, $min2) || $this->horaMenorFin($hora2, $min2)){
                return TRUE;
            } else FALSE;
        }

        public function horarioPosible($otraFuncion){
            /***
             *  Retorna un true o false si los horarios se tocan en algun momento.
             *  Existen 4 posibilidades: 
             *      - 2 contempladas en el deflaut.
             *          - Si el horario de inicio del ingresado por parametro es menor al del acutal y el horario de fin del ingresado por parametro es mayor al del actual. pd: me saco dos años de vida
             *          - Busca si se tocan en algun momento los horarios de inicio y fin.
             *      - Si el horario de la funcion actual pasa de 00:00:
             *          Seria un horario partidos donde hay que comprobar si se tocan los horarios en algun momento los horarios de inicio y fin.
             *      - Si el horario de la funcion por parametro pasa de 00:00.
             *          - Si el horario de inicio y fin del ingredo por parametro, son menores al de inicio del actual. Pd: me genero muchos problemas
             *          - Busca si se tocan en algun momento los horarios de inicio y fin.
             */
            //Retorna un true o false si los horarios no coiciden.
            $hi = $otraFuncion->getHoraInicio();
            $hf = $otraFuncion->calcularHoraFin();

            if ($this->getHoraInicio()["hora"] > $this->calcularHoraFin()["hora"] && !$hi["hora"] > $hf["hora"]){
                if ($this->dentroHorarioDos($hi["hora"],$hi["minuto"],$hf["hora"],$hf["minuto"])){
                    return FALSE;
                } else return TRUE;

            }  elseif ($hi["hora"] > $hf["hora"] && !$this->getHoraInicio()["hora"] > $this->calcularHoraFin()["hora"]){
                if (!$this->horaMayorInicio($hi["hora"], $hi["minuto"]) && !$this->horaMayorInicio($hf["hora"], $hf["minuto"])){
                    return FALSE;
                }
                if ($this->dentroHorario($hi["hora"],$hi["minuto"],$hf["hora"],$hf["minuto"])){
                    return FALSE;
                } else return TRUE;

            }  else {
                if (!$this->horaMayorInicio($hi["hora"], $hi["minuto"]) && !$this->horaMenorFin($hf["hora"], $hf["minuto"])){
                    return FALSE;
                }
                if ($this->dentroHorario($hi["hora"],$hi["minuto"],$hf["hora"],$hf["minuto"])){
                    return FALSE;
                } else return TRUE;
            }
        }

        public function mostrarHora($tiempo){
            // Retorna un string para mostrar el formato de la hora
            return $tiempo["hora"].":".$tiempo["minuto"];
        }

        public function __toString()
        {
            return "Funcion: ".$this->getNombre().
            "\nPrecio: ".$this->getPrecio().
            "\nHora Inicio: ".$this->mostrarHora($this->getHoraInicio()).
            "\nDuracion: ".$this->mostrarHora($this->getDuracion());
        }
    }