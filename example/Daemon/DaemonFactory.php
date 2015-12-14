<?php

namespace messyOne\ExampleDaemon;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use messyOne\Daemon;
use Monolog\Logger;

/**
 * Create Daemon related instances
 */
class DaemonFactory
{
    /**
     * @return Daemon
     */
    public function getDaemon()
    {
        return new Daemon(
            $this->getTasksFinder(),
            $this->getTaskPersist(),
            new Logger('daemon.log')
        );
    }

    /**
     * @return TasksFinder
     */
    protected function getTasksFinder()
    {
        return new TasksFinder($this->getEntityManager());
    }

    /**
     * @return TaskPersist
     */
    private function getTaskPersist()
    {
        return new TaskPersist($this->getEntityManager());
    }

    /**
     * @return EntityManager
     * @throws \Doctrine\ORM\ORMException
     */
    private function getEntityManager()
    {
        return EntityManager::create([
            'driver' => 'pdo_pgsql',
            'dbname' => 'daemon',
            'user' => 'user',
            'password' => 'password',
            'host' => 'localhost',
        ], Setup::createConfiguration());
    }
}
