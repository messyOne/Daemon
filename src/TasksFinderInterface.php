<?php

namespace messyOne\Daemon;

/**
 * Find all due tasks.
 */
interface TasksFinderInterface
{
    /**
     * @return TaskInterface[]
     */
    public function findDueTasks();
}
