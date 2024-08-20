<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Employee;
use App\Entity\Item;
use App\Entity\Service;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private const CATEGORIES = [
        [
            'name' => 'Pressing',
            'description' => "Découvrez notre pressing de qualité, spécialisé dans le nettoyage à sec et le soin méticuleux de vos vêtements. Repassage impeccable, réparations expertes et service clientèle attentionné pour préserver l'élégance et la durabilité de vos tenues favorites.",
            'image' => 'iconePressing.png'
        ],
        [
            'name' => 'Blanchisserie',
            'description' => "Explorez notre blanchisserie professionnelle, dédiée au lavage et à l'entretien soigneux de votre linge de maison. Propreté optimale garantie pour draps, serviettes et nappes, adaptée aux besoins domestiques et professionnels. Fiable, efficace et orienté client pour répondre à vos attentes les plus exigeantes.",
            'image' => 'iconeBlanchisserie.png'
        ]
    ];
    private const SERVICES = [
        [
            'name' => 'Traitement des tâches',
            'description' => "Ne laissez pas les taches gâcher vos vêtements préférés. Nos experts en traitement des taches utilisent des techniques avancées pour éliminer les taches les plus difficiles, qu’il s’agisse de vin, de graisse ou d’encre. Nous prenons soin de chaque vêtement pour un résultat impeccable et durable.",
            'image' => 'test',
            'price' => 3
        ],
        [
            'name' => 'Réparations et retouches',
            'description' => "Notre service de réparation et retouches offre des ajustements précis pour tous types de vêtements, remplace les boutons, et répare les déchirures avec soin. Nous veillons à ce que vos vêtements vous vont parfaitement et restent en parfait état, prolongeant ainsi leur durabilité et votre satisfaction.",
            'image' => 'test',
            'price' => 3
        ]
    ];
    private const ITEMS = [
        [
            'name' => 'Chemise',
            'image' => 'skirt.png',
            'price' => 6,
            'category' => 'Pressing'
        ],
        [
            'name' => 'Pantalon',
            'image' => 'jean.png',
            'price' => 8,
            'category' => 'Pressing'
        ],
        [
            'name' => 'Tapis',
            'image' => 'tapis.png',
            'price' => 10,
            'category' => 'Blanchisserie'
        ],
        [
            'name' => 'Couette',
            'image' => 'couette.png',
            'price' => 18,
            'category' => 'Blanchisserie'
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        $generator = \Faker\Factory::create();

        // Ajout d'un user
        $regularUser = new User();
        $regularUser->setEmail('bob@test.com')
            ->setRoles(['ROLE_USER'])
            ->setPassword('bob1234')
            ->setName('Test')
            ->setFirstname('Bob')
            ->setBirthdate(new \DateTime)
            ->setAdress('18 rue des potiers')
            ->setGender('Mr');

        // Ajout d'un admin
        $adminUser = new User();
        $adminUser->setEmail('admin@test.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword('admin1234')
            ->setName('Test')
            ->setFirstname('Admin')
            ->setBirthdate(new \DateTime)
            ->setAdress('26 rue victor hugo')
            ->setGender('Mme');


        //Ajout d'un employee
        $employee = new Employee();
        $employee->setEmail('employee@test.com')
            ->setRoles(['ROLE_EMPLOYEE'])
            ->setPassword('employee1234')
            ->setName('Test')
            ->setFirstname('Employee')
            ->setBirthdate(new \DateTime)
            ->setAdress('42 avenue Charles de gaulle')
            ->setGender('Mme');

        $manager->persist($regularUser);
        $manager->persist($adminUser);
        $manager->persist($employee);


        //Tableau pour stocker les catégories
        $categories = [];

        //Ajout des catégories
        foreach (self::CATEGORIES as $categoryData) {
            $category = new Category();
            $category->setName($categoryData['name'])
                ->setDescription($categoryData['description'])
                ->setImage($categoryData['image']);

            $manager->persist($category);
            $categories[$categoryData['name']] = $category;
        }


        //Ajout des services
        foreach(self::SERVICES as $serviceData){
            $service = new Service();
            $service->setName($serviceData['name'])
                ->setDescription($serviceData['description'])
                ->setImage($serviceData['image'])
                ->setPrice($serviceData['price']);
            
            $manager->persist($service);
        }

        //Ajout des items
        foreach(self::ITEMS as $itemData){
            $item = new Item();
            $item->setName($itemData['name'])
                ->setImage($itemData['image'])
                ->setPrice($itemData['price'])
                ->setCategory($categories[$itemData['category']]);

            $manager->persist($item);
        }

        $manager->flush();
    }
}
