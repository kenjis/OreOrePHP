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

class Request
{
    protected $get;
    protected $post;
    protected $server;

    public function __construct($get = [], $post = [], $server = [])
    {
        $this->get    = $get;
        $this->post   = $post;
        $this->server = $server;
    }
    
    public function fromGlobals()
    {
        $this->get    = $_GET;
        $this->post   = $_POST;
        $this->server = $_SERVER;
    }
    
    public function getGet($key = null)
    {
        if ($key === null) {
            return $this->get;
        } else {
            if (isset($this->get[$key])) {
                return $this->get[$key];
            } else {
                return null;
            }
        }
    }
    
    public function getPost($key = null)
    {
        if ($key === null) {
            return $this->post;
        } else {
            if (isset($this->post[$key])) {
                return $this->post[$key];
            } else {
                return null;
            }
        }
    }
    
    public function getServer($key = null)
    {
        if ($key === null) {
            return $this->server;
        } else {
            if (isset($this->server[$key])) {
                return $this->server[$key];
            } else {
                return null;
            }
        }
    }
}
