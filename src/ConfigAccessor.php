<?php
namespace EuleNetwork;

/**
 * Class ConfigAccessor
 *
 * @package Eule
 */
class ConfigAccessor
{
    const CONFIG_PREFIX = 'eule_network_';

    const KEY_LIGHT_LOGO = self::CONFIG_PREFIX . 'light_logo';
    
    const DEFAULTS = [
        self::KEY_LIGHT_LOGO => false,
    ];

    /**
     * @return mixed
     * @throws \Exception
     */
    public function useLightLogo()
    {
        return $this->getConfigValue(self::KEY_LIGHT_LOGO);
    }

    /**
     * @param string $key
     * @return mixed
     * @throws \Exception
     */
    public function getConfigValue($key)
    {
        if (substr($key, 0, strlen(self::CONFIG_PREFIX)) !== self::CONFIG_PREFIX) {
            $key = self::CONFIG_PREFIX.$key;
        }
        $value = get_option($key, null);
        if (is_null($value)) {
            $value = $this->getDefaultValue($key);
        }

        return $value;
    }

    /**
     * @param string $key
     * @return mixed|string
     * @throws \Exception
     */
    private function getDefaultValue($key)
    {
        if (self::DEFAULTS[$key] !== null) {
            $value = self::DEFAULTS[$key];
        } else {
            throw new \Exception('No default set for '.$key);
        }

        return $value;
    }
}
