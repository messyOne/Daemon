<?php

namespace messyOne;

/**
 * TaskHandler gets the arguments from the due task injected and handles the task.
 */
interface TaskHandlerInterface
{
    /**
     * Do the work.
     *
     * @return void
     */
    public function handle();
}
