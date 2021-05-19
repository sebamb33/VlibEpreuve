<?php
    class Station
    {
        private $NUMS;
        private $ETATS;
        private $NOMS;
        private $SITUATIONS;
        private $CAPACITES;
        private  $NUMBORNE;

        public function getNUMBORNE()
        {
            return $this->NUMBORNE;
        }
        public function setNUMBORNE($NUMBORNE)
        {
            $this->NUMBORNE=$NUMBORNE;
        }

        public function getNUMS(){
            return $this->NUMS;
        }

        public function setNUMS($NUMS){
            $this->NUMS = $NUMS;
        }

        public function getETATS(){
            return $this->ETATS;
        }

        public function setETATS($ETATS){
            $this->ETATS = $ETATS;
        }

        public function getNOMS(){
            return $this->NOMS;
        }

        public function setNOMS($NOMS){
            $this->NOMS = $NOMS;
        }

        public function getSITUATIONS(){
            return $this->SITUATIONS;
        }

        public function setSITUATIONS($SITUATIONS){
            $this->SITUATIONS = $SITUATIONS;
        }

        public function getCAPACITES(){
            return $this->CAPACITES;
        }

        public function setCAPACITES($CAPACITES){
            $this->CAPACITES = $CAPACITES;
        }
        public function hydrate(array $donnees)
        {
            foreach ($donnees as $key => $value)
            {
                $method = 'set'.($key);
                if (method_exists($this, $method))
                {
                    $this->$method($value);
                }
            }
        }
    }
