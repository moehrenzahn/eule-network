<?php

namespace EuleNetwork\Block;

use EuleNetwork\Block;

class Setting extends Block
{
    /**
     * @var \EuleNetwork\Config\Setting
     */
    private $setting;

    /**
     * Setting constructor.
     *
     * @param \EuleNetwork\Config\Setting|null $setting
     * @param string $templatePath
     */
    public function __construct($templatePath, $setting = null)
    {
        $this->setting = $setting;

        parent::__construct($templatePath);
    }

    /**
     * @return \EuleNetwork\Config\Setting
     */
    public function getSetting()
    {
        return $this->setting;
    }

    /**
     * @param \EuleNetwork\Config\Setting $setting
     */
    public function setSetting(\EuleNetwork\Config\Setting $setting)
    {
        $this->setting = $setting;
    }
}
