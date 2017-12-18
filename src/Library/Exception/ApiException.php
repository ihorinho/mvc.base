<?php

namespace Library\Exception;

/**
 * Class ApiException
 * @package Library\Exception
 */
class ApiException extends \Exception
{
    /**
     * @return string
     */
    public function getResponse()
    {
        return json_encode(['status' => 'fail', 'message' => $this->getMessage()]);
    }
}