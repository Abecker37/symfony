<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [
        [
            'title' => 'Walking dead',
            'synopsis' => 'Des zombies envahissent la terre',
            'category' => 'category_Action',
            'country' => 'US',
            'year' => '2010',
            'reference' => 'program_Walking-Dead'
        ],
        [
            'title' => 'my little poney',
            'synopsis' => 'des poneys et des arc en ciels',
            'category' => 'category_Animation',
            'country' => 'US',
            'year' => '2003',
            'reference' => 'program_mlp',
        ],
        [
            'title' => 'punisher',
            'synopsis' => 'Frank Castle, surnommé le Punisher, est un ancien soldat d\'élite du corps des Marines,
            qui a vu toute sa famille tuée car il a participé à des opérations illégales lors de ses missions en Afghanistan. De retour à New York, il cherche à identifier les responsables et à faire justice.',
            'category' => 'category_Action',
            'country' => 'US',
            'year' => '2017',
            'reference' => 'program_Punisher',
        ],
        [
            'title' => 'ça la série ',
            'synopsis' => 'boouuuuuu',
            'category' => 'category_Horreur',
            'country' => 'FR',
            'year' => '2018',
            'reference' => 'program_série',
        ],
        [
            'title' => 'Arcane',
            'synopsis' => 'Championnes de leurs villes jumelles et rivales (la huppée Piltover et la sous-terraine Zaun),
            deux sœurs Vi et Powder se battent dans une guerre où font rage des technologies magiques et des perspectives diamétralement opposées.',
            'country' => 'US',
            'year' => '2021',
            'category' => 'category_Animation',
            'reference' => 'program_Arcane',
        ]
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $key => $programe) {
            $program = new Program();
            $program->setTitle($programe['title']);
            $program->setSynopsis($programe['synopsis']);
            $program->setCountry($programe['country']);
            $program->setYear($programe['year']);
            $program->setCategory($this->getReference($programe['category']));
            $this->addReference($programe['reference'], $program);
            $manager->persist($program);
            }
    
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
        ];
    }


}
