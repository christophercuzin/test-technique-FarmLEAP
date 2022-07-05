<?php

namespace App\Controller;

use App\Repository\ReferenceSizeRepository;
use App\Service\SizeUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(
        Request $request,
        SizeUtils $sizeUtils,
        ReferenceSizeRepository $refSizeRepo,
        ): Response {
        $sizeData = $request->request->all();
        $sizeData = array_map('trim', $sizeData);

        if (!empty($sizeData)) {
        $referenceSize = $sizeUtils->flushReferenceSize($sizeData);
        $sizeUtils->flushSize($referenceSize, $sizeData);
        return $this->redirectToRoute('home', []);
        }

        $referenceSizes = $refSizeRepo->findAllJoin();

        return $this->render('home/index.html.twig', [
            'referenceSizes' => $referenceSizes,
        ]);
    }
}
