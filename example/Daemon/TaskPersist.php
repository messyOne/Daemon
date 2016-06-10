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
     *
     * @return void
     */
    public function begin()
    {
        $this->entityManager->beginTransaction();
    }

    /**
     * @inheritdoc
     */
    public function commit()
    {
        $this->entityManager->flush();
        $this->entityManager->clear();

        $this->entityManager->commit();
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
