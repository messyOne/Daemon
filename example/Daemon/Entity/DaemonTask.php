<?php

namespace messyOne\ExampleDaemon\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\Table;
use messyOne\Task\TaskInterface;

/**
 * @Entity(repositoryClass="DaemonTaskRepository")
 * @Table(name="daemon_tasks", indexes={@Index(name="due_at_idx", columns={"due_at"})})
 */
class DaemonTask implements TaskInterface
{
    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     *
     * @var int
     */
    protected $id;

    /**
     * @Column(name="due_at", type="integer")
     *
     * @var int
     */
    protected $dueAt;

    /**
     * @Column(name="handler_class", type="string")
     *
     * @var string
     */
    protected $handlerClass;

    /**
     * @Column(type="json_array")
     *
     * @var array
     */
    protected $arguments;

    /**
     * @Column(type="boolean")
     *
     * @var bool
     */
    protected $disabled = false;

    /**
     * @Column(type="integer", name="reoccur_interval")
     *
     * @var int
     */
    protected $reoccurInterval = 0;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getDueAt()
    {
        return $this->dueAt;
    }

    /**
     * @param int $dueAt
     * @return DaemonTask
     */
    public function setDueAt($dueAt)
    {
        $this->dueAt = $dueAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getHandlerClass()
    {
        return $this->handlerClass;
    }

    /**
     * @param string $handlerClass
     * @return DaemonTask
     */
    public function setHandlerClass($handlerClass)
    {
        $this->handlerClass = $handlerClass;

        return $this;
    }

    /**
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @param array $arguments
     * @return DaemonTask
     */
    public function setArguments(array $arguments)
    {
        $this->arguments = $arguments;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isDisabled()
    {
        return $this->disabled;
    }

    /**
     * @return DaemonTask
     */
    public function setDisabled()
    {
        $this->disabled = true;

        return $this;
    }

    /**
     * @return bool
     */
    public function isReoccurring()
    {
        return $this->reoccurInterval !== 0;
    }

    /**
     * @return void
     */
    public function reoccur()
    {
        $this->dueAt += $this->reoccurInterval;
    }

    /**
     * @param int $seconds
     * @return TaskInterface
     */
    public function setReoccurInterval($seconds)
    {
        $this->reoccurInterval = $seconds;
    }
}
