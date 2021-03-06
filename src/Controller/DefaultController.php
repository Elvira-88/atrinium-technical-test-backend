<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// AbstractController es un controlador de symfony que pone
// a disposición nuestra multitud de características.

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default_index")
     * 
     * La clase ruta debe estar precedida en los comentarios por una arroba.
     * El primer parámetro de Route es la URL a la que queremos asociar la acción.
     * El segundo parámetro de Route es el nombre que queremos dar a la ruta.
     */ 
    public function index(Request $request, CompanyRepository $companyRepository): Response
    {
        if($request->query->has('term')) {
            $companies = $companyRepository->findByTerm($request->query->get('term'));

            return $this->render('default/index.html.twig', [
                'companies' => $companies
            ]);
        }

        // Una acción siempre debe devolver una respesta.
        // Por defecto deberá ser un objeto de la clase,
        // Symfony\Component\HttpFoundation\Response


        // render() es un método heredado de AbstractController
        // que devuelve el contenido declarado en una plantilla de Twig.

        $companies = $companyRepository->findAll();

        return $this->render('default/index.html.twig', [
            'companies' => $companies
        ]);
    }
}