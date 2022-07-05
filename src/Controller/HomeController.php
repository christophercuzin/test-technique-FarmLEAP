<?php

namespace App\Controller;

use App\Repository\ReferenceSizeRepository;
use App\Service\SizeUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/home')]
class HomeController extends AbstractController
{
    #[Route('/index/list', name: 'home_index_get_list', methods: ['GET'])]
    public function getPartialList(ReferenceSizeRepository $refSizeRepo): Response
    {
        return $this->render('home/_listSizes.html.twig', [
            'referenceSizes' => $refSizeRepo->findAllJoin()
        ]);
    }

    #[Route('/index', name: 'home_index_get', methods: ['GET'])]
    public function adminGet(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/index', name: 'home_index', methods: ['POST'])]
    public function index(
        Request $request,
        SizeUtils $sizeUtils,

        ): Response {
        $sizeData = $request->request->all();
        $sizeData = array_map('trim', $sizeData);

        if (!empty($sizeData)) {
        $referenceSize = $sizeUtils->flushReferenceSize($sizeData);
        $sizeUtils->flushSize($referenceSize, $sizeData);
        }

        
        return new Response();
        
    }
}
