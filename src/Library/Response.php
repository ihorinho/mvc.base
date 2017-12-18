<?php
namespace Library;

/**
 * Class Response
 * @package Library
 */
class Response
{
    /**
     * @var
     */
    private $code;
    /**
     * @var string
     */
    private $status;
    /**
     * @var
     */
    private $message;
    /**
     * @var OutputFormatterInterface
     */
    private $outputFormatter;

    /**
     * Response constructor.
     * @param $code
     * @param $message
     * @param OutputFormatterInterface $outputFormatter
     */
    public function __construct($code, $message, OutputFormatterInterface $outputFormatter)
    {
        $this->code = $code;
        $this->status = $this->code < 300 ? 'success' : 'fail';
        $this->message = $message;
        $this->outputFormatter = $outputFormatter;
        http_response_code($code);
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->outputFormatter->output($this->status, $this->message);
    }
}