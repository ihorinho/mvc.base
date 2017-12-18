<?php

namespace Library\API;

use Library\OutputFormatterInterface;

/**
 * Class JsonFormatter
 * @package Library\API
 */
class JsonFormatter implements OutputFormatterInterface
{
    /**
     * @param integer $status
     * @param string $message
     * @return string
     */
    public function output($status, $message)
    {
        header('Content-Type: application/json');
        return json_encode(compact('status', 'message'));
    }
}