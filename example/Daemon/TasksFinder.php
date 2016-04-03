<?php

namespace messyOne\ExampleDaemon;

use Daemon\Entity\DaemonTask;
use Daemon\Entity\DaemonTaskRepository;
use Doctrine\ORM\EntityManager;
use messyOne\Task\TasksFinderInterface;

/**
 * @inheritdoc
 */
class TasksFinder implements TasksFinderInterface
{
    /** @var EntityManager */
    private $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritdoc
     *
     * @return DaemonTask[]
     */
    public function findDueTasks()
    {
        /** @var DaemonTaskRepository $repository */
        $repository = $this->entityManager->getRepository(DaemonTask::class);

        return $repository->findDue(time());
    }
}
