<?php
/**
 * Created by JetBrains PhpStorm.
 * Date: 26/02/13
 * Time: 10:26
 * To change this template use File | Settings | File Templates.
 */
namespace Ccs\FrontendBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class FrontendBuilder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $em = $this->container->get('doctrine')->getManager();


        $menu->addChild('Inicio', array('route' => 'ccs_home_page'));


        $paginas = $em->getRepository('CcsFrontendBundle:Pagina')->findAll();


        foreach ($paginas as $pagina) {

            if($pagina->getMenu()){
            $menu->addChild($pagina->getMenu(), array(
            'route' => 'pagina_show',
            'routeParameters' => array('slug' => $pagina->getSlug())
        ));
            }

        }

        $menu->addChild('Contactar', array('route' => 'contactar'));

//        $menu->addChild('About Me', array(
//            'route' => 'pagina_show',
//            'routeParameters' => array('id' => 42)
//        ));

        return $menu;
    }
}
