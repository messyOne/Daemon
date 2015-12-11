<?php

namespace messyOne\Daemon;

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
     * @return $this
     */
    public function setDueAt($dueAt);

    /**
     * @return string
     */
    public function getHandlerClass();

    /**
     * @param string $handlerClass Class which implements the TaskHandlerInterface
     * @return $this
     */
    public function setHandlerClass($handlerClass);

    /**
     * @return array
     */
    public function getArguments();

    /**
     * @param array $arguments
     * @return $this
     */
    public function setArguments(array $arguments);

    /**
     * @return boolean
     */
    public function isDisabled();

    /**
     * @return $this
     */
    public function setDisabled();
}
