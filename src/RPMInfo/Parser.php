<?php

namespace RPMInfo;

/**
 * Parses RPM info generated by rpm -qi
 *
 * @author Joseph Wynn <joseph_wynn@ipcmedia.com>
 */
class Parser
{

    protected $fields = array(
        'name' => '/Name *: (.+?) {4}/',
        'version' => '/Version *: (.*?) {4}/',
        'release' => '/Release *: (.*?) {4}/',
        'install_date' => '/Install Date *: (.*?) {4}/',
        'group' => '/Group *: (.*?) {4}/',
        'size' => '/Size *: (\d+) {4}/',
        'signature' => '/Signature *: (.*)/',
        'url' => '/URL *: (.*)/',
        'summary' => '/Summary *: (.*)/',
        'description' => '/Description *:\n(.*)/s',
        'relocations' => '/Relocations: (.*)/',
        'vendor' => '/Vendor: (.*)/',
        'build_date' => '/Build Date: (.*)/',
        'build_host' => '/Build Host: (.*)/',
        'source_rpm' => '/Source RPM: (.*)/',
        'license' => '/License: (.*)/',
    );

    /**
     * Parse an RPM info string
     *
     * @param  string $string
     * @return Info
     */
    public function parse($string)
    {
        $info = new Info;

        foreach ($this->fields as $fieldName => $regex) {
            $info[$fieldName] = null;

            preg_match_all($regex, $string, $matches);

            if (isset($matches[1]) && ! empty($matches[1])) {
                $info[$fieldName] = $matches[1][0];
            }
        }

        return $info;
    }

}
