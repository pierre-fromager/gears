<?php

namespace PierInfor\Gears\Entity;

/**
 * Entity manager for json marshalling unmarshalling
 * 
 */
class Serializable
{
    const _ENTITY_NS_PREFIX = 'PierInfor\\Gears\\Entity\\';
    const _SETTER_PREFIX = 'set';
    const _GETTER_PREFIX = 'get';

    /**
     * ctor
     */
    public function __construct()
    {
    }

    /**
     * json encoder
     */
    public function __toString()
    {
        return json_encode($this);
    }

    /**
     * hydrate an object from \stdClass
     */
    public function hydrate(\stdClass $instance): Serializable
    {
        foreach ($instance as $key => $value) {
            $setter = self::_SETTER_PREFIX . ucfirst($key);
            $callee = [$this, $setter];
            if (is_callable($callee)) {
                $className = self::_ENTITY_NS_PREFIX . ucfirst($key);
                $arg = (is_object($value)) ? (new $className())->hydrate($value) : $value;
                call_user_func_array($callee, [$arg]);
            }
        }
        return $this;
    }
}
