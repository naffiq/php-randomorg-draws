<?php
/**
 * Created by PhpStorm.
 * User: naffiq
 * Date: 7/5/2017
 * Time: 12:30 AM
 */

namespace naffiq\randomorg;

use Throwable;

/**
 * Class DrawException
 *
 * Any error returned by Random.org's Draw API
 *
 * @package naffiq\randomorg
 */
class DrawException extends \Exception
{
    /**
     * @var array
     */
    private $data;

    /**
     * DrawException constructor.
     * @param string $message
     * @param int $code
     * @param array $data
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, array $data, Throwable $previous = null)
    {
        $this->setData($data);
        parent::__construct($message, $code, $previous);
    }

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}