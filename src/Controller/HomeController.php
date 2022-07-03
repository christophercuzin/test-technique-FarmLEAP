<?php

namespace App\Controller;

use App\Entity\ReferenceSize;
use App\Repository\ReferenceSizeRepository;
use App\Repository\SizeRepository;
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
        SizeRepository $sizeRepository
        ): Response {
        $sizeData = $request->request->all();
        $sizeData = array_map('trim', $sizeData);

        if (!empty($sizeData)) {
        $referenceSize = $sizeUtils->flushReferenceSize($sizeData);
        $sizeUtils->flushSize($referenceSize, $sizeData);
        return $this->redirectToRoute('home', []);
        }
        $referenceSizes = $refSizeRepo->findAll();
        $sums = $sizeRepository->findSum();
        $avgs = $sizeRepository->findAvg();
        return $this->render('home/index.html.twig', [
            'referenceSizes' => $referenceSizes,
            'sums' => $sums,
            'avgs' => $avgs,
        ]);
    }
}
