<?php
/**
 * Created by PhpStorm.
 * User: naffiq
 * Date: 7/4/17
 * Time: 18:31
 */

namespace naffiq\randomorg;


class DrawResponse
{
    private $drawId;

    private $status;

    private $entryCount;

    private $winners;

    private $completionTime;

    private $recordUrl;

    private $id;

    public function __construct(\stdClass $response)
    {
        $this->drawId = $response->result->drawId;
        $this->status = $response->result->status;
        $this->entryCount = $response->result->entryCount;
        $this->winners = $response->result->winners;
        $this->completionTime = $response->result->completionTime;
        $this->recordUrl = $response->result->recordUrl;
        $this->id = $response->id;
    }

    /**
     * @return mixed
     */
    public function getDrawId()
    {
        return $this->drawId;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getEntryCount()
    {
        return $this->entryCount;
    }

    /**
     * @return mixed
     */
    public function getWinners()
    {
        return $this->winners;
    }

    /**
     * @return mixed
     */
    public function getCompletionTime()
    {
        return $this->completionTime;
    }

    /**
     * @return mixed
     */
    public function getRecordUrl()
    {
        return $this->recordUrl;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}