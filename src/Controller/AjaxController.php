<?php

namespace App\Controller;

use App\Entity\Location;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AjaxController extends Controller
{
    /**
     * @Route("/celebration/get-location-percentage", name="percentage_for_given_location", methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     * @throws \LogicException
     */
    public function getPercentageForGivenLocation(Request $request): JsonResponse
    {
        $locationId = $request->query->get('locationId');

        $location = $this->getDoctrine()
            ->getRepository(Location::class)
            ->findOneBy(['id' => $locationId]);

        $percentageNum = $location->getPercentage();

        return $this->json($percentageNum);
    }
}
