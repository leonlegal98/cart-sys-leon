<?php

namespace App\Manager;

use App\Entity\Order;
use App\Factory\OrderFactory;
use App\Storage\ClientSessionStorage;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ClientManager
 * @package App\Manager
 */
class ClientManager
{
    /**
     * @var ClientSessionStorage
     */
    private $clientSessionStorage;

    /**
     * @var OrderFactory
     */
    private $clientFactory;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * ClientManager constructor.
     *
     * @param ClientSessionStorage $clientStorage
     * @param OrderFactory $orderFactory
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        ClientSessionStorage $clientStorage,
        OrderFactory $orderFactory,
        EntityManagerInterface $entityManager
    ) {
        $this->clientSessionStorage = $clientStorage;
        $this->clientFactory = $orderFactory;
        $this->entityManager = $entityManager;
    }

    /**
     * Gets the current client.
     * 
     * @return Order
     */
    public function getCurrentClient(): Order
    {
        $client = $this->clientSessionStorage->getClient();

        if (!$client) {
            $client = $this->clientFactory->create();
        }

        return $client;
    }
    /**
     * Persists the client in database and session.
     *
     * @param Order $client
     */
    public function save(Order $client): void
    {
        // Persist in database
        $this->entityManager->persist($client);
        $this->entityManager->flush();
        // Persist in session
        $this->cartSessionStorage->setClient($client);
    }
}
