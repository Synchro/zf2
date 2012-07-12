<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_TimeSync
 */

namespace Zend\TimeSync;

use DateTime;

/**
 * Abstract class definition for all timeserver protocols
 *
 * @category  Zend
 * @package   Zend_TimeSync
 */
abstract class AbstractProtocol
{
    /**
     * Holds the current socket connection
     *
     * @var array
     */
    protected $_socket;

    /**
     * Exceptions that might have occured
     *
     * @var array
     */
    protected $_exceptions;

    /**
     * Hostname for timeserver
     *
     * @var string
     */
    protected $_timeserver;

    /**
     * Holds information passed/returned from timeserver
     *
     * @var array
     */
    protected $_info = array();

    /**
     * Abstract method that prepares the data to send to the timeserver
     *
     * @return mixed
     */
    abstract protected function _prepare();

    /**
     * Abstract method that reads the data returned from the timeserver
     *
     * @return mixed
     */
    abstract protected function _read();

    /**
     * Abstract method that writes data to to the timeserver
     *
     * @param  string $data Data to write
     * @return void
     */
    abstract protected function _write($data);

    /**
     * Abstract method that extracts the binary data returned from the timeserver
     *
     * @param  string|array $data Data returned from the timeserver
     * @return integer
     */
    abstract protected function _extract($data);

    /**
     * Connect to the specified timeserver.
     *
     * @return void
     * @throws Exception\RuntimeException When the connection failed
     */
    protected function _connect()
    {
        $socket = @fsockopen($this->_timeserver, $this->_port, $errno, $errstr,
                             TimeSync::$options['timeout']);
        if ($socket === false) {
            throw new Exception\RuntimeException('could not connect to ' .
                "'$this->_timeserver' on port '$this->_port', reason: '$errstr'");
        }

        $this->_socket = $socket;
    }

    /**
     * Disconnects from the peer, closes the socket.
     *
     * @return void
     */
    protected function _disconnect()
    {
        @fclose($this->_socket);
        $this->_socket = null;
    }

    /**
     * Return information sent/returned from the timeserver
     *
     * @return  array
     */
    public function getInfo()
    {
        if (empty($this->_info) === true) {
            $this->_write($this->_prepare());
            $timestamp = $this->_extract($this->_read());
        }

        return $this->_info;
    }

    /**
     * Query this timeserver without using the fallback mechanism
     *
     * @return DateTime
     */
    public function getDate()
    {
        $this->_write($this->_prepare());
        $this->_extract($this->_read());

        // Apply to the local time the offset obtained from the server
        $info = $this->getInfo();
        $time = (time() + round($info['offset']));
        return new DateTime('@' . $time);
    }
}
