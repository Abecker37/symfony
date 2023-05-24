<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Season;
use App\Entity\Episode;
use App\Entity\Program;
use App\Repository\SeasonRepository;
use App\Repository\ProgramRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProgramController extends AbstractController
{
    #[Route('/program/', name: 'program_index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();
        return $this->render('program/index.html.twig', [

            'website' => 'Wild Series', 'programs' => $programs

        ]);
    }

    #[Route('/program/{id}/', name: 'program_show')]

    public function show(Program $program): Response

    {
        return $this->render('program/show.html.twig', ['program' => $program]);
    }

    #[Route('/{program}/season/{season}', requirements: ['programId' => '\d+', 'seasonId' => '\d+'], methods: ['GET'], name: 'program_season_show')]
    public function showSeason(Season $season, Program $program): Response
    {
        return $this->render('program/season_show.html.twig', ['program' => $program, 'season' => $season]);
    }

    #[Route('/program/{program}/season/{season}/episode/{episode}', requirements: ['programId' => '\d+', 'seasonId' => '\d+'], methods: ['GET'], name: 'program_episode_show')]
    public function showEpisode(Program $program, Season $season, Episode $episode): Response{
        return $this->render('program/episode_show.html.twig',['program' => $program, 'season' => $season , 'episode' => $episode]);
    }
}
