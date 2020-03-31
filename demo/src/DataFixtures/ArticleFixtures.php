<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Articlo;
use App\Entity\Category;
use App\Entity\Comment;



class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    { $faker = \Faker\Factory::create("fr_FR");
      for($i=1;$i<=3;$i++){
        $category = new Category();
        $category->setTitle($faker->sentence())
                  ->setDescription($faker->paragraph());
        $manager->persist($category);
       // creer ent 4 et 6 articles
            for($j=1;$j< \mt_rand(4,6);$j++){
              $article = new Articlo();
              $content = '<p>' .join( $faker->paragraphs(5),'</p><p>') .'</p>';
              $article->setTitle($faker->sentence())
                    ->setContent($content)
                    ->setImage($faker->imageUrl())
                    ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                    ->setCategory($category);
            $manager->persist($article);
            for($k=0;$k<mt_rand(4,10);$k++){
              $comment = new Comment();
             
              $now = new \DateTime();
             $interval = $now -> diff($article->getCreatedAt());// obj de type date interval
             $days= $interval->days;
             $minimum = '-' . $days . ' days'; // -100 days
             $comment->setAuthor($faker->name)
             ->setContent('<p>' .join( $faker->paragraphs(mt_rand(1,4)),'</p><p>') .'</p>')
             ->setCreatedAt($faker->dateTimeBetween($minimum))
             ->setArticle($article);
  
             $manager->persist($comment);
  
            }
          }
         
      }
     

        $manager->flush();
    }
}
