<?php

namespace App\Services;

use App\Entity\Currency;
use Doctrine\ORM\EntityManagerInterface;

class CompareDatabaseApiResoults
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    public function compareResoultArrays($apiResout, $databaseResoult)
    {


        $databaseCurrencyNames = [];


        foreach ($databaseResoult as $singleResult) {
            $databaseCurrencyNames[] = $singleResult['name'];
        }

        foreach ($apiResout as $singleCurrency) {

            $apiCurrencyName = $singleCurrency->currency;//nazwa
            $apiCurrencyCode = $singleCurrency->code;//kod
            $apiCurrencyValue = $singleCurrency->mid;// waluta



            $currencyEntity = new Currency();

            if (in_array($apiCurrencyName, $databaseCurrencyNames)) {

                $currencyEntityRepository = $this->em->getRepository(Currency::class)->findOneBy(['name' => $apiCurrencyName]);
                $currencyEntityRepository->setExchange_rate($apiCurrencyValue);
                $this->em->persist($currencyEntityRepository);
                $this->em->flush();

            } else {
                $currencyEntity->setName($apiCurrencyName);
                $currencyEntity->setExchange_rate($apiCurrencyValue);
                $currencyEntity->setCurrency_code($apiCurrencyCode);
                $this->em->persist($currencyEntity);
                $this->em->flush();
            }
// formatowanie kodu ctrl+alt+l

        }


    }


}