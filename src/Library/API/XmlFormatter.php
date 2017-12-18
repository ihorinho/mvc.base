<?php

namespace Library\API;

use Library\OutputFormatterInterface;

/**
 * Class XmlFormatter
 * @package Library\API
 */
class XmlFormatter implements OutputFormatterInterface
{
    /**
     * @param integer $status
     * @param string $message
     * @return mixed
     */
    public function output($status, $message)
    {
        header('Content-Type: text/xml');

        $xmlString = <<<XML
<?xml version='1.0' standalone='yes'?>
    <response>
        <status>$status</status>
    </response>
XML;
        $xml = new \SimpleXMLElement($xmlString);

        if(!is_array($message)){
            $xml->addChild('message', $message);
            return $xml->asXML();
        }

        $msgTag = $xml->addChild('message');
        foreach($message as $books){
            $bookTag = $msgTag->addChild('book');
            foreach($books as $key => $bookAttr){
                $bookTag->addChild($key, $bookAttr);
            }
        }

        return $xml->asXML();
    }
}