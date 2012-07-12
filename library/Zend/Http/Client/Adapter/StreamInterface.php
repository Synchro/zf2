<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Http
 */

namespace Zend\Http\Client\Adapter;

/**
 * An interface description for Zend_Http_Client_Adapter_Stream classes.
 *
 * This interface decribes Zend_Http_Client_Adapter which supports streaming.
 *
 * @category   Zend
 * @package    Zend_Http
 * @subpackage Client_Adapter
 */
interface StreamInterface
{
    /**
     * Set output stream
     *
     * This function sets output stream where the result will be stored.
     *
     * @param resource $stream Stream to write the output to
     *
     */
    function setOutputStream($stream);
}
