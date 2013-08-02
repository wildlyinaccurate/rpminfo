<?php

namespace RPMInfo;

/**
 * Represents parsed RPM information
 *
 * @author Joseph Wynn <joseph_wynn@ipcmedia.com>
 */
class Info implements \ArrayAccess
{

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return isset($this->{$offset});
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->{$offset};
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        if ($offset === null) {
            throw new \InvalidArgumentException('Offset cannot be null.');
        } else {
            $this->{$offset} = $value;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        unset($this->{$offset});
    }

}
