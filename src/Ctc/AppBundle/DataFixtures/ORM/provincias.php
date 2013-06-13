<?php

namespace Ctc\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ctc\AppBundle\Entity\Common\Destination;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Fixtures de los principales destinos.
 *
 */
class destinationLoad extends AbstractFixture implements OrderedFixtureInterface {

    public function getOrder() {
        return 2;
    }

    public function load(ObjectManager $manager) {
        $provincias = array(
            array('Pinar del Río'),
            array('Artemisa'),
            array('Mayabeque'),
            array('La Habana'),
            array('Matanzas'),
            array('Cienfuegos'),
            array('Villa Clara'),
            array('Sancti Spíritus'),
            array('Ciego de Ávila'),
            array('Camagüey'),
            array('Las Tunas'),
            array('Holguín'),
            array('Granma'),
            array('Santiago de Cuba'),
            array('Guantánamo'),
            array('Isla de la Juventud'),
        );

        foreach ($provincias as $key => $nombre) {
            $provincia = new Destination();
            $provincia->setName($nombre[0]);
            $provincia->setDescription('Descripcion de '.$nombre[0]);
            $provincia->setType('provincia');

            $manager->persist($provincia);
            $this->addReference(sprintf('provincia_%s', $key + 1), $provincia);
        }




        $destinations = array(
                'provincia_1'=>array(
                    'Viñales','Soroa'
                ),
                'provincia_2'=>array(
                    'Las Terrazas'
                ),
                'provincia_4'=>array(
                    'Habana vieja','Vedado','Miramar'
                )


        );

        foreach ($destinations as $key => $dest) {

            foreach ($dest as $d){
                $destination = new Destination();
                $destination->setName($d);
                $destination->setDescription('Descripcion de '.$d);
                $destination->setType('destino');
                $destination->setTranslatableLocale('en');
                $destination->setParent($this->getReference($key));
                $manager->persist($destination);
            }
        }


        $manager->flush();
    }

}