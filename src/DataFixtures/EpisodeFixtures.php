<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public const EPISODES = [
        [
            'title' => 'Welcome to the Playground',
            'synopsis' => 'Les sœurs orphelines Vi et Powder
            causent des remous dans les rues souterraines de Zaun à la suite d\'un braquage dans le très huppé Piltover.
            ',
            'number' => '1',
            'reference' => 'season1_Arcane',
        ],
        [
            'title' => 'Passé décomposé',
            'synopsis' => 'Après une épidémie post-apocalyptique ayant transformé la quasi-totalité
            de la population américaine et mondiale en mort-vivants ou « rôdeurs », un groupe d\'hommes et de femmes mené par l\'adjoint du shérif
            du comté de Kings (en Géorgie) USA, Rick Grimes, tente de survivre…
            Ensemble, ils vont devoir tant bien que mal faire face à ce nouveau monde devenu méconnaissable,
            à travers leur périple dans le Sud profond des États-Unis. ',
            'number' => '1',
            'reference' => 'season1_TWG',
        ],
        [
            'title' => 'La Magie de l\'amitié (partie 1)',
            'synopsis' => 'Twilight Sparkle, élève de la Princesse Celestia, découvre dans ses livres l\'histoire des deux juments princesses (la Princesse Luna et la Princesse Celestia) et des éléments d\'équilibre. Elle découvre également que le retour de la Jument Séléniaque aura lieu à la Fête du Solstice d\'Été,',
            'number' => '1',
            'reference' => 'season1_MLP',
        ],
        [
            'title' => '3heures du matin',
            'synopsis' => 'Frank Castle, plus connu sous le pseudonyme de Punisher, part en guerre contre tous les criminels dont ceux qui sont responsables de la mort de sa famille. Il va découvrir que cela cache une conspiration plus vaste qu\'il ne l\'avait soupçonnée ...',
            'number' => '1',
            'reference' => 'season1_Punisher',
        ],
        [
            'title' => 'Deux hommes morts',
            'synopsis' => 'Frank est contacté par un homme mystérieux qui se fait appeler Micro. Frank en parle à Karen Page et lui demande de trouver des informations. Derrière le pseudonyme de Micro se cache David Lieberman, un ancien analyste de la NSA, que tout le monde croit mort. De son côté Dinah Madani rencontre Billy Russo...',
            'number' => '2',
            'reference' => 'season1_Punisher',
        ],
        [
            'title' => 'Le Blues du roadhouse',
            'synopsis' => 'Frank Castle a pris la route, fuyant New York après avoir achevé sa vengeance et laissé Billy Russo défiguré. Pendant un soir dans un bar, il sympathise avec la serveuse, Beth, et croise une jeune fille dont il remarque le comportement suspect. Celle-ci a en possession des photos qu\'elle veut revendre à un mafieux russe, mais il est lui-même interrogé par un autre homme pour les mêmes photos. ',
            'number' => '1',
            'reference' => 'season2_Punisher',
        ],
        [
            'title' => 'Le Matin',
            'synopsis' => 'NULL',
            'number' => '1',
            'reference' => 'season1_Arcane',
        ],

    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::EPISODES as $key => $episodes) {
            $episode = new Episode();
            $episode->setTitle($episodes['title']);
            $episode->setNumber($episodes['number']);
            $episode->setSynopsis($episodes['synopsis']);
            $episode->setSeason($this->getReference($episodes['reference']));
            $manager->persist($episode);
            
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            SeasonFixtures::class,
        ];
    }
}