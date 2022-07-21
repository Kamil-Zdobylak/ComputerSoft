<?php

namespace App\Controller;

use App\Repository\CurrencyRepository;
use App\Services\CompareDatabaseApiResoults;
use App\Services\FormatDataCurrencyNBPApi;
use App\Services\GetCurrenciesFromNBPApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Currency;
use Doctrine\ORM\EntityManagerInterface;


class CurrencyController extends AbstractController
{
    #[Route('/Currency', name: 'app_currency')]
    public function test(EntityManagerInterface $entityManager)
    {

        $em = $this->getDoctrine()->getManager();

        $currencyData = new GetCurrenciesFromNBPApi();
        $test2=$currencyData->makeRequest();

        $decode = new FormatDataCurrencyNBPApi();
        $apiResoult=$decode->decodeJson($test2);

        $currenciesNames = $em->getRepository(Currency::class)->findCurrenciesNames();



        $compare=new CompareDatabaseApiResoults($entityManager);
        $compare->compareResoultArrays($apiResoult,$currenciesNames);

        $currencies = $em->getRepository(Currency::class)->findAll();

        return $this->render('currency/index.html.twig', [
            'currencies' => $currencies
        ]);
    }

}
