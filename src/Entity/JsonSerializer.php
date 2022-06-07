<?php

namespace PierInfor\Gears\Entity;

/**
 * Trait to collect entity protected properties
 *
 */
trait JsonSerializer
{
    /**
     * serializer process
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
