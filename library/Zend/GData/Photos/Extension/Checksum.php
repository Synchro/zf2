<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_GData
 */

namespace Zend\GData\Photos\Extension;

/**
 * Represents the gphoto:checksum element used by the API.
 * This is an optional field that can be used to store a photo's
 * checksum to ease duplicate checking.
 *
 * @category   Zend
 * @package    Zend_Gdata
 * @subpackage Photos
 */
class Checksum extends \Zend\GData\Extension
{

    protected $_rootNamespace = 'gphoto';
    protected $_rootElement = 'checksum';

    /**
     * Constructs a new Zend_Gdata_Photos_Extension_Checksum object.
     *
     * @param string $text (optional) The value to represent.
     */
    public function __construct($text = null)
    {
        $this->registerAllNamespaces(\Zend\GData\Photos::$namespaces);
        parent::__construct();
        $this->setText($text);
    }

}
