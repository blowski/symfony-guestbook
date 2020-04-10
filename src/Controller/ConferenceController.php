<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ConferenceController
{

    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }


    /**
     * @Route("/conference/{name}", name="conference", methods={"GET"})
     */
    public function index(string $name): Response
    {
        return new Response($this->twig->render('conference/index.html.twig', [
            'name' => $name,
        ]));
    }

}
