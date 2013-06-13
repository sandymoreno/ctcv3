<?php

namespace Bg\DireccionBundle\DataFixtures\Tests;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Cm\ComunBundle\Entity\Direccion\Pais;
use Doctrine\Common\Persistence\ObjectManager;

class paisLoad extends AbstractFixture implements OrderedFixtureInterface {

    public function getOrder() {
        return 1;
    }

    public function load(ObjectManager $manager) {
        $nombre = "Cuba";
        $pais = new Pais();
        $pais->setPais($nombre);
        $manager->persist($pais);        
        $manager->flush();
        $this->addReference('cuba', $pais);
    }

}