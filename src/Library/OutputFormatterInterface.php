<?php

namespace Library;

/**
 * Interface OutputFormatterInterface
 * @package Library
 */
interface OutputFormatterInterface
{
    /**
     * @param $status
     * @param $message
     * @return mixed
     */
    public function output($status, $message);
}