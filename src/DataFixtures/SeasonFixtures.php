<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public const SEASONS = 
    [
        [
            'number' => '1',
            'year' => '2021',
            'description' => 'Championnes de leurs villes jumelles et rivales (la huppée Piltover et la sous-terraine Zaun), deux sœurs Vi et Powder 
            se battent dans une guerre où font rage des technologies magiques et des perspectives diamétralement opposées.',
            'getreference' => 'program_Arcane',
            'addreference' => 'season1_Arcane',
        ],
        [
            'number' => '11',
            'year' => '2010',
            'description' => 'Dans le Kentucky, Rick Grimes, un policier, se
            réveille à l\'hôpital après plusieurs semaines de coma provoqué par une fusillade qui a mal tourné.
            Il découvre que le monde, ravagé par une épidémie, est envahi par les morts-vivants.
            Rick ne songe qu\'à une chose : retrouver sa femme Lori et son fils Carl.',
            'getreference' => 'program_Walking-Dead',
            'addreference' => 'season1_TWG',
        ],
        [
            'number' => '9',
            'year' => '2010',
            'description' => 'l\'héroïne de la série, une licorne violette nommée Twilight Sparkle,
            est l’élève de la Princesse Celestia, alicorne souveraine du royaume d\'Equestria. Bibliophile et étudiante extrêmement assidue,
            Twilight ne prend pas le temps de se lier d\'amitié avec ses camarades. Par hasard, elle découvre l\'existence d\'une terrible prophétie
            qui évoque le royaume sombrant dans une nuit éternelle.',
            'getreference' => 'program_mlp',
            'addreference' => 'season1_MLP',
        ],
        [
            'number' => '1',
            'year' => '2017',
            'description' => 'Synopsis. Après s\'être vengé des responsables de la mort de sa femme et de ses enfants,
            Frank Castle décèle un complot qui va bien plus loin que le milieu des criminels newyorkais.
            Désormais connu à travers toute la ville comme The Punisher, il doit découvrir la vérité sur les injustices qui l\'entourent.',
            'getreference' => 'program_Punisher',
            'addreference' => 'season1_Punisher',
        ],
        [
            'number' => '2',
            'year' => '2017',
            'description' => 'The Punisher se trouve dans un territoire un peu trop familier. Billy Russo, l\'ancien frère d\'arme de Frank, commence à guérir des blessures que Frank lui a infligé, ce n\'est qu\'une question de temps avant que Billy ne reconstitue les pièces du puzzle.',
            'getreference' => 'program_Punisher',
            'addreference' => 'season2_Punisher',
        ],
        [
            'number' => '1',
            'year' => '2018',
            'description' => 'NULL',
            'getreference' => 'program_série',
            'addreference' => 'season1_Série',
        ]
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::SEASONS as $key => $seasons) {
            $season = new Season();
            $season->setNumber($seasons['number']);
            $season->setDescription($seasons['description']);
            $season->setYear($seasons['year']);
            $season->setProgramId($this->getReference($seasons['getreference']));
            $this->addReference($seasons['addreference'], $season);
            $manager->persist($season);
            }
    
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            ProgramFixtures::class,
        ];
    }
}