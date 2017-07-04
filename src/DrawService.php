<?php

namespace naffiq\randomorg;

use Curl\Curl;

/**
 * Class Draw
 *
 *
 *
 */
class DrawService
{
    /**
     * @var string
     */
    private $_login;

    /**
     * @var string
     */
    private $_password;

    /**
     * DrawService constructor.
     * @param string $login
     * @param string $password
     */
    public function __construct($login, $password)
    {
        if (empty($login) || empty($password)) {
            throw new \InvalidArgumentException('You have to specify login and password to Random.org service');
        }

        $this->_login = $login;
        $this->_password = $password;
    }

    public function newDraw($title, $id, array $entries, $winnerCount = 1, $recordType = "public")
    {
        return new Draw($title, $id, $entries, $winnerCount, $recordType);
    }

    public function holdDraw(Draw $draw)
    {

        $curl = new Curl();

        /**
         * @var $response \stdClass
         */
        $response = $curl->post('https://draws.random.org/api/json-rpc/2/invoke', json_encode($this->getHoldDrawParams($draw)));

        if (!empty($response->error)) {
            throw new DrawException($response->error->message, $response->error->code, $response->error->data);
        }

        return new DrawResponse($response);
    }

    protected function getHoldDrawParams(Draw $draw)
    {
        $params = $draw->getParams();
        $params['credentials'] = [
            'login' => $this->_login,
            'password' => $this->_password
        ];

        return [
            'jsonrpc' => '2.0',
            'method' => 'holdDraw',
            'params' => $params,
            'id' => $draw->getId()
        ];
    }
}