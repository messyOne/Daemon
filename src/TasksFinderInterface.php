<?php

namespace messyOne;

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
