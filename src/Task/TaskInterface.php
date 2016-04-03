<?php

namespace messyOne\Task;

/**
 * Represents a task object.
 */
interface TaskInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return int
     */
    public function getDueAt();

    /**
     * @param int $dueAt
     * @return TaskInterface
     */
    public function setDueAt($dueAt);

    /**
     * @return string
     */
    public function getHandlerClass();

    /**
     * @param string $handlerClass Class which implements the TaskHandlerInterface
     * @return TaskInterface
     */
    public function setHandlerClass($handlerClass);

    /**
     * @return array
     */
    public function getArguments();

    /**
     * @param array $arguments
     * @return TaskInterface
     */
    public function setArguments(array $arguments);

    /**
     * @return boolean
     */
    public function isDisabled();

    /**
     * @return TaskInterface
     */
    public function setDisabled();

    /**
     * @param int $seconds
     * @return TaskInterface
     */
    public function setReoccurInterval($seconds);

    /**
     * @return bool
     */
    public function isReoccurring();

    /**
     * @return TaskInterface
     */
    public function reoccur();
}
