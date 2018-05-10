<?php

namespace App\Controller;

use App\Entity\DecorationItem;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/home/{balloonsUsageYear}", name="home", requirements={"balloonsUsageYear"="^[12]\d{3}$"})
     * @param null $balloonsUsageYear
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function index($balloonsUsageYear = null)
    {
        $balloonsUsageYear = $balloonsUsageYear ?: date('Y');
        $decorationItems = $this->getDoctrine()
            ->getRepository(DecorationItem::class)
            ->getUsedDecorationItemsInYear($balloonsUsageYear);
//        var_dump($decorationItems);die();
        $usedBalloonsInYearTotalPrice = 0;
        $decorationItems = array_map(function ($item) use (&$usedBalloonsInYearTotalPrice) {
            $item['totalPrice'] = $item['quantity'] * $item['price'];
            $usedBalloonsInYearTotalPrice += $item['totalPrice'];
//            var_dump($item);die();
            return $item;
        }, $decorationItems);

        return $this->render('home/index.html.twig', [
            'balloonsUsageYear' => $balloonsUsageYear,
            'decorationItems' => $decorationItems,
            'yearsWithCelebrations' => range( date('Y'), date('Y') - 10 ),
            'usedBalloonsInYearTotalPrice' => $usedBalloonsInYearTotalPrice,
        ]);
    }
}
