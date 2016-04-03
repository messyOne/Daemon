<?php

namespace messyOne\Task;

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
