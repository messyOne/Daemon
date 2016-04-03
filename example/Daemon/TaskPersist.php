<?php

namespace messyOne\ExampleDaemon;

use Doctrine\ORM\EntityManager;
use messyOne\Task\TaskHandlerInterface;
use messyOne\Task\TaskInterface;
use messyOne\Task\TaskPersistInterface;

/**
 * @inheritdoc
 */
class TaskPersist implements TaskPersistInterface
{
    /** @var EntityManager */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritdoc
     */
    public function cleanUp()
    {
        $this->entityManager->flush();
        $this->entityManager->clear();
    }

    /**
     * @inheritdoc
     *
     * @param TaskHandlerInterface $task
     */
    public function remove(TaskInterface $task)
    {
        $this->entityManager->remove($task);
    }

    /**
     * @inheritdoc
     *
     * @param TaskHandlerInterface $task
     */
    public function persist(TaskInterface $task)
    {
        $this->entityManager->persist($task);
    }
}
