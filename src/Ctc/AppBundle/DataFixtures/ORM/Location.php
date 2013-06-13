<?php

namespace Ctc\AppBundle\DataFixtures\ORM;

use Ctc\AppBundle\Entity\Hotel\Location;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ctc\AppBundle\Entity\Common\Destination;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Fixtures de los principales destinos.
 *
 */
class localtionLoad extends AbstractFixture implements OrderedFixtureInterface {

    public function getOrder() {
        return 2;
    }

    public function load(ObjectManager $manager) {
        $locations = array(
            array('Beach'),
            array('City'),
            array('Countryside'),

        );

        foreach ($locations as $key => $nombre) {
            $location = new Location();
            $location->setName($nombre[0]);
            $location->setCode(strtoupper($nombre[0]));
//            $location->setTranslatableLocale('en');
            $location->setDescription('Descripcion de '.$nombre[0]);
            $manager->persist($location);
            $this->addReference(sprintf('location_%s', $key + 1), $location);
        }






        $manager->flush();
    }

}