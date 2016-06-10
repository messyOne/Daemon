<?php

namespace messyOne\Task;

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
     * Starts with fetching due tasks. 
     * 
     * Good place for opening a transaction.
     * 
     * @return void
     */
    public function begin();

    /**
     * Finish the handling of tasks. 
     * 
     * Clean if you have to. Close transaction etc.
     * 
     * @return void
     */
    public function commit();
}
