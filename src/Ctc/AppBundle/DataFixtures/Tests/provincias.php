<?php

namespace Bg\DireccionBundle\DataFixtures\Tests;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Cm\ComunBundle\Entity\Direccion\Provincia;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Fixtures de la entidad Provincia.
 * Crea las 15 Provincias de Cuba.
 */
class provinciasLoad extends AbstractFixture implements OrderedFixtureInterface {

    public function getOrder() {
        return 2;
    }

    public function load(ObjectManager $manager) {
      //  $cuba = $manager->getRepository('CmComunBundle:Direccion\Pais')->findByPais("Cuba");
        $provincias = array(
            'Pinar del Río',
            'Artemisa',
            'Mayabeque',
            'La Habana',
            'Matanzas',
            'Cienfuegos',
            'Villa Clara',
            'Sancti Spíritus',
            'Ciego de Ávila',
            'Camagüey',
            'Las Tunas',
            'Holguín',
            'Granma',
            'Santiago de Cuba',
            'Guantánamo',
            'Isla de la Juventud',
        );

        foreach ($provincias as $key => $nombre) {
            $provincia = new Provincia();
            $provincia->setProvincia($nombre);
            $provincia->setPais($this->getReference('cuba'));
            $manager->persist($provincia);
            $this->addReference(sprintf('provincia_%s', $key + 1), $provincia);
        }
        
        $manager->flush();
    }

}