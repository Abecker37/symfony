<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Season;
use App\Entity\Episode;
use App\Entity\Program;
use App\Form\ProgramType;
use App\Repository\SeasonRepository;
use App\Repository\ProgramRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ProgramController extends AbstractController
{
    #[Route('/program/', name: 'program_index')]
    public function index(ProgramRepository $programRepository, RequestStack $requestStack): Response
    {
        $programs = $programRepository->findAll();
        $session = $requestStack->getSession();

    if (!$session->has('total')) {

        $session->set('total', 0); // if total doesn’t exist in session, it is initialized.

    }

    $total = $session->get('total'); // get actual value in session with ‘total' key.

    // ...
        return $this->render('program/index.html.twig', [

            'website' => 'Wild Series', 'programs' => $programs

        ]);
    }

#[Route('program/new', name: 'new')]
public function new(Request $request, ProgramRepository $ProgramRepository): Response
{

    // Create a new Category Object

    $program = new Program();

    $form = $this->createForm(ProgramType::class, $program);


    $form->handleRequest($request);


    if ($form->isSubmitted()&& $form->isValid()) {
        $ProgramRepository->save($program, true);
        $this->addFlash('success', 'The new program has been created');

        return $this->redirectToRoute('program_index');

    }


    // Render the form

    return $this->render('program/new.html.twig', [

        'form' => $form,

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
