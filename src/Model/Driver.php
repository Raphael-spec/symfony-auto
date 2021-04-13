<?php

namespace App\Model;
use App\Entity\Car;

class Driver{

    public function getCars(){
        
        $car1 = new Car();
        $car1->setId(001);
        $car1->setMarque('Peugeot');
        $car1->setModele('5008');
        $car1->setPays('France');

        $car2 = new Car();
        $car2->setId(002);
        $car2->setMarque('Renault');
        $car2->setModele('Megane');
        $car2->setPays('Suisse');

        $car3 = new Car();
        $car3->setId(003);
        $car3->setMarque('Fiat');
        $car3->setModele('Punto');
        $car3->setPays('Italie');

        $tab_cars = [$car1,$car2,$car3];

        return $tab_cars;
    }
}