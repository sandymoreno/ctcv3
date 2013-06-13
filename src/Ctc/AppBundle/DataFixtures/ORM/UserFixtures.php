<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConfigurationFixtures
 *
 * @author sandy
 */

namespace Bg\UserBundle\DataFixtures\ORM;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Cm\ComunBundle\Entity\Usuario\User as U;

class UserFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface{

      private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    
     public function load(ObjectManager $manager)
    {
         
       $userManager =  $this->container->get('fos_user.user_manager');
       
       $user = $userManager->createUser();
        $user->setUsername("admin");
        $user->setEmail("admin@bengalatravel.com");
        $user->setPlainPassword("admin");
        $user->setEnabled((Boolean) true);
        $user->setSuperAdmin((Boolean) true);
        $userManager->updateUser($user);
      $user1 = $userManager->createUser();
        $user1->setUsername("webmaster");
        $user1->setEmail("webmaster@bengalatravel.com");
        $user1->setPlainPassword("webmaster");
        $user1->setEnabled((Boolean) true);
        $user1->setSuperAdmin((Boolean) true);
        $userManager->updateUser($user1);
        
         $user1 = $userManager->createUser();
        $user1->setUsername("webmaster1");
        $user1->setEmail("webmaster1@bengalatravel.com");
        $user1->setPlainPassword("webmaster1");
        $user1->setEnabled((Boolean) true);
        $user1->setSuperAdmin((Boolean) true);
        $userManager->updateUser($user1);
    }
    
        public function getOrder() {
        return 1;
    }
    
}

?>
