<?php
/**
 * Part of the OreOrePHP framework.
 *
 * @package    OreOrePHP
 * @version    0.1
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2014 Kenji Suzuki
 * @link       https://github.com/kenjis/OreOrePHP
 */

namespace kenjis\OreOrePHP;

class Response
{
    protected $body;
    protected $statusCode = 200;
    protected $httpHeaders = [];

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    public function setHttpHeader($name, $value)
    {
        $this->httpHeaders[$name] = $value;
    }

    public function send()
    {
        http_response_code($this->statusCode);

        foreach ($this->httpHeaders as $name => $value) {
            header($name . ': ' . $value);
        }

        echo $this->body;
    }
}
