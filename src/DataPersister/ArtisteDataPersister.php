<?php

// src/DataPersister

namespace App\DataPersister;

use App\Entity\Artiste;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

class ArticleDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $_entityManager;

    /**
     * @param Request
     */
    private $_request;

    public function __construct(EntityManagerInterface $entityManager, RequestStack $request)
    {
        $this->_entityManager = $entityManager;
        $this->_request = $request->getCurrentRequest();
    }

    /**
     * {@inheritdoc}
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Artiste;
    }

    /**
     * @param Artiste $data
     */
    public function persist($data, array $context = [])
    {
        // TODO: Implement persist() method.
    }

    /**
     * {@inheritdoc}
     */
    public function remove($data, array $context = [])
    {
        $this->_entityManager->remove($data);
        $this->_entityManager->flush();
    }
}
