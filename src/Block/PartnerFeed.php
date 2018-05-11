<?php

namespace EuleNetwork\Block;

use \EuleNetwork\Block;
use EuleNetwork\ConfigAccessor;

/**
 * Class PartnerFeed
 *
 * @package Eule\Block\Frontend
 */
class PartnerFeed extends Block
{
    /**
     * @var \EuleNetwork\Model\PartnerFeed
     */
    private $feed;

    /**
     * @var ConfigAccessor
     */
    private $config;

    /**
     * PartnerFeed constructor.
     *
     * @param ConfigAccessor $config
     */
    public function __construct(ConfigAccessor $config)
    {
        $this->config = $config;
        $this->templatePath = '/View/PartnerFeed.phtml';

        parent::__construct($this->templatePath);
    }

    /**
     * @return \EuleNetwork\Model\PartnerFeed
     */
    public function getFeed()
    {
        return $this->feed;
    }

    /**
     * @param \EuleNetwork\Model\PartnerFeed $feed
     */
    public function setFeed(\EuleNetwork\Model\PartnerFeed $feed)
    {
        $this->feed = $feed;
    }

    public function getEuleIconUrl()
    {
        if ($this->config->useLightLogo()) {
            return plugins_url() . '/eule-network/src/img/logo_white_medium.png';
        } else {
            return plugins_url() . '/eule-network/src/img/logo_gray_medium.png';
        }
    }
}
