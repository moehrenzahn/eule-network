<?php
namespace EuleNetwork\Model\Storage;

/**
 * Class Transient
 *
 * Wrapper around the Wordpress transients API
 *
 * @package EuleNetwork\Model\Storage
 */
class Transient
{
    /**
     * @param string $index
     * @param mixed $object
     * @param int $expiration (default 48 hours)
     */
    public function save($index, $object, $expiration = HOUR_IN_SECONDS*48)
    {
        set_transient($index, $object, $expiration);
    }

    /**
     * @param string $index
     * @return mixed|false
     */
    public function load($index)
    {
        return get_transient($index);
    }

    /**
     * @param string $index
     * @return bool
     */
    public function exists($index)
    {
        return get_transient($index) !== false;
    }

    /**
     * @param string $index
     */
    public function delete($index)
    {
        delete_transient($index);
    }
}
