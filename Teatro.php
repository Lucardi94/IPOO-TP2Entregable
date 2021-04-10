<?php
    class Teatro{
        /***
         * Representacion de la clase teatro.
         *  - Atributos:
         *      + string nombre
         *      + string dirección
         *      + array funciones al día (4)
         *  - Funciones:
         *      + cambiarNombre($nuevoNombre)
         *      + cambiarDirección($nuevaDireccion)
         *      + CambiarNombreFunción($nuevoNombre, $i)
         *      + CambiarPrecioFuncion($nuevoPrecio, $i)
         *      + seleccionFuncion()
         *      + mostrarFunciones()
         *      + cargarFucion()
         *          - verificarHorario($otraFuncion)
         *      + tooString()
         *          - mostrarFunciones()
         */

        private $nombre;
        private $direccion;
        private $listaObjFuncion;

        public function __construct($nom, $dir, $lisOF)
        {
            $this->nombre = $nom;
            $this->direccion = $dir;
            $this->listaObjFuncion = $lisOF;
        }

        public function getNombre(){
             return $this->nombre;
        }
        public function getDireccion(){
            return $this->direccion;
        }
        public function getListaObjFuncion(){
            return $this->listaObjFuncion;
        }

        public function setNombre($nom){
            $this->nombre = $nom;
        }
        public function setDireccion($dir){
            $this->direccion = $dir;
        }
        public function setListaObjFuncion($lisOF){
            $this->listaObjFuncion = $lisOF;
        }

        public function cambiarNombre($nuevoNombre){
            //Seatea el atributo nombre con un nuevo valor por parametro.
            $this->setNombre($nuevoNombre);
        }
        public function cambiarDireccion($nuevaDireccion){
            //Seatea el atributo direccion con un nuevo valor por parametro.
            $this->setDireccion($nuevaDireccion);
        }

        public function mostrarFunciones(){
            /* Retorna un string con los datos del atributo listaObjFuncion */
            $txt = "";
            foreach ($this->getlistaObjFuncion() as $indice => $funcion){
                $numero = $indice + 1;
                $txt = $txt.$funcion."\n";
            }
            return $txt;
        }

        public function seleccionFuncion(){
            /* Muestra las funciones y retorna el indice de la funcion deseada */
            echo $this->mostrarFunciones()."\nIngrese el numero de funcion a cambiar ";
            return  trim(fgets(STDIN)) - 1;

        }

        public function cambiarNombreFuncion($nuevoNombre, $i){
            /* Setea la lista con la mosificacion deseada */
            $lisFun = $this->getlistaObjFuncion();
            $lisFun[$i]->setNombre($nuevoNombre);
            $this->setlistaObjFuncion($lisFun);
        }

        public function cambiarPrecioFuncion($nuevoPrecio, $i){
            /* Setea la lista con la mosificacion deseada */
            $lisFun = $this->getlistaObjFuncion();
            $lisFun[$i]->setPrecio($nuevoPrecio);
            $this->setlistaObjFuncion($lisFun);
        }

        public function verificarHorario($otraFuncion){
            /***
             *  Retorna un true o false sino existe el lugar disponible.
             *  Recorre la lista de forma parcial hasta encontra que un horario no es posible.
             */
            
            $horarioDisponible = TRUE;
            $listaFuncion = $this->getListaObjFuncion();
            $i=0;
            while ($i < count($listaFuncion) && $horarioDisponible){
                $funcion = $listaFuncion[$i];
                if (!$funcion->horarioPosible($otraFuncion)){
                    $horarioDisponible = FALSE;
                }
                $i++;
            }
            return $horarioDisponible;
        }

        public function cargarFucion(){
            /***
             *  Retorna un true o false si pudo cargar una funcion a la lista.
             *  Pide datos por teclado y verifica el horario es posible.
             */
            echo "[Nueva Funcion]\nIngrese nombre ";
            $nom = trim(fgets(STDIN));
            echo "Ingrese precio ";
            $pre = trim(fgets(STDIN));
            echo "Hora inicio; primero hora despues minutos ";
            $horI = array ("hora" => trim(fgets(STDIN)), "minuto" => trim(fgets(STDIN)));
            echo "Duracion; primero hora despues minutos ";
            $dur = array ("hora" => trim(fgets(STDIN)), "minuto" => trim(fgets(STDIN)));

            $funcion = new Funcion($nom, $pre, $horI, $dur);
            if ($this->verificarHorario($funcion)){
                $listaFunciones = $this->getListaObjFuncion();
                array_push($listaFunciones, $funcion);
                return TRUE;
            }else return FALSE;        
        }

        public function __toString()
        {
            return "Teatro: ".$this->getNombre().
            "\nDireccion: ".$this->getDireccion().
            "\n[Funciones]\n".$this->mostrarFunciones();
        }

    }