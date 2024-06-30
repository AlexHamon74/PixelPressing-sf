<?php

namespace App\DataFixtures;

use App\Entity\Category;
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
            'image' => 'test'
        ],
        [
            'name' => 'Blanchisserie',
            'description' => "Explorez notre blanchisserie professionnelle, dédiée au lavage et à l'entretien soigneux de votre linge de maison. Propreté optimale garantie pour draps, serviettes et nappes, adaptée aux besoins domestiques et professionnels. Fiable, efficace et orienté client pour répondre à vos attentes les plus exigeantes.",
            'image' => 'test'
        ]
    ];
    private const SERVICES = [
        [
            'name' => 'Lavage',
            'description' => "Offrez à vos vêtements un lavage professionnel et soigné. Nous utilisons des machines de pointe et des détergents de haute qualité pour garantir un nettoyage en profondeur tout en préservant les fibres et les couleurs de vos vêtements. Votre linge ressortira frais, propre et doux au toucher.",
            'image' => 'test',
            'price' => 2
        ],
        [
            'name' => 'Repassage',
            'description' => "Confiez-nous vos vêtements pour un repassage impeccable. Nos experts maîtrisent les techniques de repassage pour éliminer tous les plis, même les plus tenaces, et redonner à vos vêtements une allure nette et soignée. Vous profiterez d’un gain de temps considérable et d’un rendu impeccable.",
            'image' => 'test',
            'price' => 2
        ],
        [
            'name' => 'Nettoyage à sec',
            'description' => "Nous offrons un service de nettoyage à sec de qualité supérieure pour vos vêtements délicats. Grâce à des solvants spécialisés, nous éliminons les saletés et les taches sans abîmer les tissus les plus fragiles. Vos vêtements retrouveront leur éclat et leur fraîcheur d’origine.",
            'image' => 'test',
            'price' => 6
        ],
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
            'image' => 'test',
            'price' => 2,
            'category' => 'Pressing'
        ],
        [
            'name' => 'Pantalon',
            'image' => 'test',
            'price' => 4,
            'category' => 'Pressing'
        ],
        [
            'name' => 'Drap',
            'image' => 'test',
            'price' => 8,
            'category' => 'Blanchisserie'
        ],
        [
            'name' => 'Couette',
            'image' => 'test',
            'price' => 15,
            'category' => 'Blanchisserie'
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        $generator = \Faker\Factory::create();

        // Ajout des Users
        $regularUser = new User();
        $regularUser->setEmail('bob@test.com')
            ->setRoles(['ROLE_USER'])
            ->setPassword('bob1234')
            ->setName('Test')
            ->setFirstname('Bob')
            ->setBirthdate(new \DateTime)
            ->setAdress('18 rue des potiers')
            ->setGender('Monsieur');

        $adminUser = new User();
        $adminUser->setEmail('admin@test.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword('admin1234')
            ->setName('Test')
            ->setFirstname('Admin')
            ->setBirthdate(new \DateTime)
            ->setAdress('26 rue victor hugo')
            ->setGender('Madame');

        $manager->persist($regularUser);
        $manager->persist($adminUser);


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
