<?php
/**
 * Created by PhpStorm.
 * User: naffiq
 * Date: 7/4/17
 * Time: 17:03
 */

namespace naffiq\randomorg;


/**
 * Class Draw
 *
 * Represents draw instance
 *
 * @package naffiq\randomorg
 */
class Draw
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var int
     */
    private $id;

    /**
     * @var array
     */
    private $entries;

    /**
     * @var int
     */
    private $winnerCount;

    /**
     * @var string
     */
    private $recordType;

    /**
     * Draw constructor.
     * @param string $title
     * @param int $id
     * @param array $entries
     * @param int $winnerCount
     * @param string $recordType
     */
    public function __construct($title, $id, array $entries, $winnerCount = 1, $recordType = "public")
    {
        $this->title = $title;
        $this->id = $id;
        $this->entries = $entries;
        $this->winnerCount = $winnerCount;
        $this->recordType = $recordType;
    }

    /**
     * Adds an entry to draw
     *
     * @param $entry
     */
    public function pushEntry($entry)
    {
        $this->entries[] = $entry;
    }

    /**
     * Updates entries with new value
     *
     * @param array $entries
     */
    public function setEntries(array $entries)
    {
        $this->entries = $entries;
    }

    /**
     * Generates digest of entries
     *
     * @return string
     */
    protected function getEntriesDigest()
    {
        return md5(json_encode($this->getEntries()));
    }

    /**
     * @return array
     */
    protected function getEntries()
    {
        return array_map(function ($element) {
            if (is_array($element)) {
                return $element;
            }
            return (string) $element;
        }, $this->entries);
    }

    /**
     * @return int
     */
    public function getEntriesCount()
    {
        return count($this->entries);
    }

    /**
     * Params, required by API
     *
     * @return array
     */
    public function getParams()
    {
        return [
            'title' => $this->title,
            'recordType' => $this->recordType,
            'entries' => $this->getEntries(),
            'entriesDigest' => $this->getEntriesDigest(),
            'winnerCount' => $this->winnerCount,
        ];
    }

    /**
     * Returns draw's id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}