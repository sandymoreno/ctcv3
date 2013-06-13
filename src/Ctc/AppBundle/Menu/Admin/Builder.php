<?php

namespace Ctc\AppBundle\Menu\Admin;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Mopa\Bundle\BootstrapBundle\Navbar\AbstractNavbarMenuBuilder;
use Symfony\Component\DependencyInjection\Container;

/**
 * Class for creating menus.
 *
 * @author sandy
 */
class Builder extends AbstractNavbarMenuBuilder
{

    protected $factory;
    protected $securityContext;
    protected $isLoggedIn;


    public function __construct(FactoryInterface $factory, SecurityContextInterface $securityContext)
    {
        $this->factory = $factory;

        $this->securityContext = $securityContext;
        $this->isLoggedIn = $this->securityContext->isGranted('IS_AUTHENTICATED_FULLY');

    }


    public function mainMenu(Request $request)
    {

        $menu = $this->factory->createItem('root');

        $menu->setChildrenAttribute('class', 'nav');



        $dropdown = $this->createDropdownMenuItem($menu, "Configuracion", true, array('caret'=>true));
        $dropdown->addChild('Destinos', array('route' => 'admin_destination'));
        $dropdown->addChild('Nomencladores', array('route' => 'admin_location'));



        $dropdown_service = $this->createDropdownMenuItem($menu, "Sevicios", true, array('caret'=>true));
        $dropdown_service->addChild('Hoteles', array('route' => 'admin_hotel'));
        $dropdown_service->addChild('Combinados', array('uri' => 'revorix_xptool'));


//        $menu->addChild('usuarios', array('route' => 'admin_user', 'label' => 'Usuarios'));


        return $menu;
    }


    public function createRightSideDropdownMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');
        $menu->setUri($request->getRequestUri());
        $menu->setChildrenAttribute('class', 'nav pull-right');
        if ($this->isLoggedIn) {
            $dropdown = $this->createDropdownMenuItem($menu, "Usuario: " . $this->securityContext->getToken()->getUser(), true, array('icon' => 'caret'));
            $dropdown->addChild('Perfil', array('route' => 'fos_user_profile_edit'));
            $dropdown->addChild('Cambiar contraseña', array('route' => 'fos_user_change_password', 'icon' => 'caret'));
            //adding a nice divider
            $this->addDivider($dropdown);
            $dropdown->addChild('Salir', array('route' => 'fos_user_security_logout'));
        }
        return $menu;
    }


}

?>
