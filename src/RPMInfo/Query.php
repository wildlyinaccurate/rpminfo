<?php

namespace RPMInfo;

/**
 * Queries the local filesystem for RPM information
 *
 * @author Joseph Wynn <joseph_wynn@ipcmedia.com>
 */
class Query
{

    /**
     * @var string
     */
    protected $packageName;

    /**
     * @param  string $packageName
     */
    public function __construct($packageName)
    {
        $this->packageName = $packageName;
    }

    /**
     * Get the package information
     *
     * @return Info
     */
    public function getInfo()
    {
        exec("rpm -qi {$this->packageName}", $rawInfo);

        $rawInfo = implode("\n", $rawInfo);

        $parser = new Parser;

        return $parser->parse($rawInfo);
    }

}
