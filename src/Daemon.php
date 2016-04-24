<?php

namespace messyOne;

use Exception;
use messyOne\Task\TaskHandlerInterface;
use messyOne\Task\TaskPersistInterface;
use messyOne\Task\TasksFinderInterface;
use Psr\Log\LoggerInterface;

/**
 * Daemon fetches due tasks and call the handle method.
 */
class Daemon
{
    const SUCCESS = 0;
    const ERROR = 1;

    /** @var LoggerInterface */
    private $logger;

    /** @var TasksFinderInterface */
    private $tasksFinder;

    /** @var TaskPersistInterface */
    private $taskPersist;

    /**
     * @param TasksFinderInterface $tasksFinder
     * @param TaskPersistInterface $taskPersist
     * @param LoggerInterface $logger
     */
    public function __construct(TasksFinderInterface $tasksFinder, TaskPersistInterface $taskPersist, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->tasksFinder = $tasksFinder;
        $this->taskPersist = $taskPersist;
    }

    /**
     * Run the daemon.
     *
     * @return int
     */
    public function run()
    {
        $this->logger->info("Status: starting up.");

        while (true) {
            // TODO add transaction
            $tasks = $this->tasksFinder->findDueTasks();
            foreach ($tasks as $task) {
                try {
                    $handlerClass = $task->getHandlerClass();
                    /** @var TaskHandlerInterface $handler */
                    $handler = new $handlerClass(...$task->getArguments());
                    
                    $this->decorate($handler);

                    $this->logger->info("Handle {$handlerClass}");

                    $handler->handle();

                    if ($task->isReoccurring()) {
                        $task->reoccur();
                        $this->taskPersist->persist($task);
                    } else {
                        $this->taskPersist->remove($task);
                    }
                } catch (Exception $e) {
                    $this->logger->error("{$e->getMessage()}\n{$e->getTraceAsString()}");

                    $task->setDisabled();
                    $this->taskPersist->persist($task);
                }
            }
            $this->taskPersist->cleanUp();

            sleep(1);
        }
    }

    /**
     * Hook to do additional things with the tasks e.g. setting further dependencies.
     * 
     * @param TaskHandlerInterface $handler
     */
    public function decorate(TaskHandlerInterface $handler)
    {
    }
}
