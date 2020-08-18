<?php

namespace App\DataFixtures;

use App\Entity\Article;

use DateInterval;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //dump(self::GetRandomDate());die;
        for ($i = 1; $i <= 100; $i++) {
                $article = new Article();
//                $img=[10,11,12,13,14,15,16,17,18,19,20,21];
                $article->setTitre("Titre de l'article N: $i")
                    ->setContent("Content de l'article N: $i ")
                    //->setImage("https://via.placeholder.com/350x150/0000FF/FFFFFFC")
                    ->setImage(rand(10,21).".jpg")
                    ->setCreatedAt(self::GetRandomDateTimeObject())
                    ->setStatus(rand(0,1));
//                    ->setCreatedAt(new \DateTime(self::GetRandomDateTimeString()));
            $manager->persist($article);
        }

        $manager->flush();
        // Gestion de la mémoire dans une commande Symfony/Doctrine
        // https://www.christophe-meneses.fr/article/gestion-de-la-memoire-dans-une-commande-symfony-doctrine
        $manager->clear(Article::class);

    }


    /**
     * @return \DateTime
     */
    public function GetRandomDateTimeObject(): \DateTime
    {
        $datetime = new \DateTime('2019-01-01');
        $interval=[rand(0,2),rand(1,12),rand(1,30),rand(1,24),rand(1,60)];
        $datetime->modify('+'.$interval[0].'year');
        $datetime->modify('+'.$interval[1].'month');
        $datetime->modify('+'.$interval[2].'day');
        $datetime->modify('+'.$interval[3].'hour');
        $datetime->modify('+'.$interval[4].'minute');
        $datetime->modify('+'.$interval[4].'second');
        return $datetime;
    }


    /**
     * @return string
     * @throws Exception
     */
    public function GetRandomDateTimeString():string
    {
            $interval=[rand(0,2),rand(1,12),rand(1,30),rand(1,24),rand(1,60)];
            $date = new \DateTime('2019-01-01');
            $date->add(new DateInterval('P'.$interval[0].'Y'.$interval[1].'M'.$interval[2].'DT'.$interval[3].'H'.$interval[4].'M'.$interval[4].'S'));
            // this return DateTime Format Object : if you want use it remove type of return :String
            // return $date;
            // this return DateTime Format string
            return $date->format('Y-m-d H:i:s');;
    }

}