<?php

namespace App\Storage;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ClientSessionStorage
{
    /**
     * The request stack.
     *
     * @var RequestStack
     */
    private $requestStack;

    /**
     * The client repository.
     *
     * @var OrderRepository
     */
    private $clientRepository;

    /**
     * @var string
     */
    const CART_KEY_NAME = 'client_id';

    /**
     * ClientSessionStorage constructor.
     *
     * @param RequestStack $requestStack
     * @param OrderRepository $clientRepository
     */
    public function __construct(RequestStack $requestStack, OrderRepository $clientRepository)
    {
        $this->requestStack = $requestStack;
        $this->clientRepository = $clientRepository;
    }

    /**
     * Gets the client in session.
     *
     * @return Order|null
     */
    public function getClient(): ?Order
    {
        return $this->clientRepository->findOneBy([
            'id' => $this->getClientId(),
            'status' => Order::STATUS_CART
        ]);
    }

    /**
     * Sets the client in session.
     *
     * @param Order $client
     */
    public function setClient(Order $client): void
    {
        $this->getSession()->set(self::CART_KEY_NAME, $client->getId());
    }

    /**
     * Returns the cart id.
     *
     * @return int|null
     */
    private function getClientId(): ?int
    {
        return $this->getSession()->get(self::CART_KEY_NAME);
    }

    private function getSession(): SessionInterface
    {
        return $this->requestStack->getSession();
    }
}
