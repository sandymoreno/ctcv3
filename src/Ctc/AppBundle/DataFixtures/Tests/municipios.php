<?php

namespace Bg\DireccionBundle\DataFixtures\Tests;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use \Cm\ComunBundle\Entity\Direccion\Municipio;
use Doctrine\Common\Persistence\ObjectManager;
use Cm\ComunBundle\Entity\Direccion\Ciudad;

/**
 * Fixtures de la entidad Municipio.
 * Crea los Municipios de Cuba.
 */
class municipiosLoad extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 3;
    }
    
    public function load(ObjectManager $manager)
    {
        $lista_municipios = array(
            1 => array(
                'Consolación del Sur',
                'Guane',
                'La Palma',
                'Los Palacios',
                'Mantua',
                'Minas de Matahambre',
                'Pinar del Río',
                'San Juan y Martínez',
                'San Luis',
                'Sandino',
                'Viñales'			
            ),
            2 => array(
                'Alquízar',
                'Artemisa',
                'Bauta',
                'Caimito',
                'Guanajay',
                'Güira de Melena',
                'Mariel',
                'San Antonio de los Baños',
                'Bahía Honda',
                'Candelaria',
                'San Cristóbal'
            ),
            3 => array(
                'Batabanó',
                'Bejucal',
                'Güines',
                'Jaruco',
                'Madruga',
                'Melena del Sur',
                'Nueva Paz',
                'Quivicán',
                'San José de las Lajas',
                'San Nicolás de Bari',
                'Santa Cruz del Norte'
            ),
            4 => array(
                'Arroyo Naranjo',
                'Boyeros',
                'Centro Habana',
                'Cerro',
                'Cotorro',
                'Diez de Octubre',
                'Guanabacoa',
                'Habana del Este',
                'Habana Vieja',
                'La Lisa',
                'Marianao',
                'Playa',
                'Plaza',
                'Regla',
                'San Miguel del Padrón'
            ),
            5 => array(
                'Calimete',
                'Cárdenas',
                'Ciénaga de Zapata',
                'Colón',
                'Jagüey Grande',
                'Jovellanos',
                'Limonar',
                'Los Arabos',
                'Martí',
                'Matanzas',
                'Pedro Betancourt',
                'Perico',
                'Unión de Reyes',
            ),
            6 => array(
                'Abreus',
                'Aguada de Pasajeros',
                'Cienfuegos',
                'Cruces',
                'Cumanayagua',
                'Palmira',
                'Rodas',
                'Santa Isabel de las Lajas'
            ),
            7 => array(
                'Caibarien',
                'Camajuaní',
                'Cifuentes',
                'Corralillo',
                'Encrucijada',
                'Manicaragua',
                'Placetas',
                'Quemado de Güines',
                'Ranchuelo',
                'Remedios',
                'Sagua la Grande',
                'Santa Clara',
                'Santo Domingo'			
            ),
            8 => array(
                'Cabaiguán',				
                'Fomento',
                'Jatibonico',
                'La Sierpe',
                'Sancti Spíritus',
                'Taguasco',
                'Trinidad',
                'Yaguajay'			
            ),
            9 => array(
                'Ciro Redondo',
                'Baraguá',
                'Bolivia',
                'Chambas',
                'Ciego de Ávila',
                'Florencia',
                'Majagua',
                'Morón',
                'Primero de Enero',
                'Venezuela'
            ),
            10 => array(
                'Camagüey',
                'Carlos Manuel de Céspedes',
                'Esmeralda',
                'Florida',
                'Guaimaro',
                'Jimagüayú',
                'Minas',
                'Najasa',
                'Nuevitas',
                'Santa Cruz del Sur',
                'Sibanicú',
                'Sierra de Cubitas',
                'Vertientes'
            ),
            11 => array(
                'Amancio Rodríguez',
                'Colombia',
                'Jesús Menéndez',
                'Jobabo',
                'Las Tunas',
                'Majibacoa',
                'Manatí',
                'Puerto Padre'
            ),
            12 => array(
                'Antilla',
                'Báguanos',
                'Banes',
                'Cacocum',
                'Calixto García',
                'Cueto',
                'Frank País',
                'Gibara',
                'Holguín',
                'Mayarí',
                'Moa',
                'Rafael Freyre',
                'Sagua de Tánamo',
                'Urbano Noris'			
            ),
            13 => array(
                'Bartolomé Masó',
                'Bayamo',
                'Buey Arriba',
                'Campechuela',
                'Cauto Cristo',
                'Guisa',
                'Jiguaní',
                'Manzanillo',
                'Media Luna',
                'Niquero',
                'Pilón',
                'Río Cauto',
                'Yara'
            ),
            14 => array(
                'Contramaestre',
                'Guamá',
                'Julio Antonio Mella',
                'Palma Soriano',
                'San Luis',
                'Santiago de Cuba',
                'Segundo Frente',
                'Songo la Maya',
                'Tercer Frente'			
            ),
            15=> array(
                'Baracoa',
                'Caimanera',
                'El Salvador',
                'Guantánamo',
                'Imías',
                'Maisí',
                'Manuel Tames',
                'Niceto Pérez',
                'San Antonio del Sur',
                'Yateras'		
            ),
            16 => array(
                'Isla de la Juventud',
            )    
        );
        
        for ($i = 1; $i < 17; $i++) {
            foreach($lista_municipios[$i] as $nombre) {
                $municipio = new Municipio();
                $municipio->setMunicipio($nombre);
                $municipio->setProvincia($this->getReference(sprintf('provincia_%s', $i)));
                $manager->persist($municipio);
                
                $ciudad = new Ciudad();
                $ciudad->setCiudad($municipio->getMunicipio());
                $ciudad->setMunicipio($municipio);
                $manager->persist($ciudad);
            }
        }
        
        $manager->flush();
    }
}