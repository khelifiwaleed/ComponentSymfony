<?php
declare(strict_types=1);

namespace App\Controller;

use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

/*
 * bin/console debug:autowiring cache
 */
class UseCacheComponenetController extends AbstractController
{
    public function __invoke(CustomerRepository $customerRepository, CacheInterface $cacheInterface): Response
    {
        // Récupération des données clients en cache si elles existent, sinon exécution de la fonction ci-dessous
        $allCustomers = $cacheInterface->get('allCustomers', function (ItemInterface $item)
        use ($customerRepository) {
            // Durée de vie du cache : 10 secondes
            $item->expiresAfter(10);
            return $this->getInformation($customerRepository);
        });

        return $this->render('cacheComponent/index.html.twig', [
            'controller_name' => 'UseCacheComponenetController',
            'allCustomers' => $allCustomers
        ]);
    }

    public function getInformation(CustomerRepository $customerRepository): array
    {
        $customerRepository = $customerRepository->findAllCustomer();
        sleep(2);
        return $customerRepository;
    }

}