<?php

namespace messyOne;

/**
 * Persists the task or remove it.
 */
interface TaskPersistInterface
{
    /**
     * @param TaskInterface $task
     * @return void
     */
    public function remove(TaskInterface $task);

    /**
     * @param TaskInterface $task
     * @return void
     */
    public function persist(TaskInterface $task);

    /**
     * @return void
     */
    public function cleanUp();
}
