<?php

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use App\Entity\User;
use App\Entity\Commentaire;
use Faker\Factory;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;



class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');
        for ($i=0;$i<50;$i++){
            $product = new Product();
            $product->setTitre($faker->words(2, true))
                    ->setDescrip($faker->realText(1200))
                    ->setImg($faker->imageUrl($width = 640, $height = 480))
                    ->setQte($faker->randomDigitNotNull())
                    ->setPrix($faker->numberBetween(10, 50));

         $manager->persist($product);

        }
        for ($i=0;$i<20;$i++){
            $user = new User();
            $user->setEmail($faker->email())
                 ->setPassword($faker->password('123456'))
                 ->setAvatar($faker->imageUrl($width = 640, $height = 480))
                 ->setPseudo($faker->userName());

         $manager->persist($user);

        }
        // for ($i=0;$i<20;$i++){
        //     $commentaire = new Commentaire();
        //     $commentaire->setContenu($faker->sentence(3))
        //                 ->setProduct($faker->password('123456'))
        //                 ->setCreatedAt($faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = null)) // DateTime('2003-03-15 02:00:49', 'Africa/Lagos'))
        //                 ->setAuteur($faker->firstName());

        //  $manager->persist($user);

        // }

        $manager->flush();
    }
}
