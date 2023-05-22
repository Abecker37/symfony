<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgramController extends AbstractController
{
    #[Route('/program/', name: 'program_index')]
    public function index(): Response
    {
        return $this->render('program/index.html.twig', [

            'website' => 'Wild Series',

        ]);
    }

    #[Route('/program/{id}', methods: ['GET'], name: 'program_show')]
    public function show($id): Response
    {
        // Vérifier si l'id est un entier
        if (!is_numeric($id)) {
            throw $this->createNotFoundException();
        }
        
        return $this->render('program/show.html.twig', [
            'id' => $id,
        ]);
    }
}
