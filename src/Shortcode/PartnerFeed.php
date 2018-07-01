<?php

namespace EuleNetwork\Shortcode;

use EuleNetwork\Block;
use EuleNetwork\ConfigAccessor;
use EuleNetwork\Loader;
use EuleNetwork\Model\Storage\Transient;
use EuleNetwork\Plugin;

/**
 * Class PartnerFeed
 *
 * @package EuleNetwork\Shortcode
 */
class PartnerFeed
{
    /**
     * Loader
     */
    private $loader;

    /**
     * @var Transient
     */
    private $transient;

    /**
     * @var ConfigAccessor
     */
    private $config;

    /**
     * PartnerFeed constructor.
     *
     * @param Transient $transient
     * @param Loader $loader
     * @param ConfigAccessor $config
     */
    public function __construct(Transient $transient, Loader $loader, ConfigAccessor $config)
    {
        $this->transient = $transient;
        $this->loader = $loader;
        $this->config = $config;
        $this->loader->addShortcode('eule', $this, 'getShortcodeContent');
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getShortcodeContent()
    {
        try {
            $block = new \EuleNetwork\Block\PartnerFeed($this->config);
            if ($this->transient->exists(Plugin::FEED_URL)) {
                $feed = $this->transient->load(Plugin::FEED_URL);
            } else {
                $feed = new \EuleNetwork\Model\PartnerFeed(Plugin::FEED_URL, Plugin::FEED_ITEM_AMOUNT);
                $this->transient->save(Plugin::FEED_URL, $feed, HOUR_IN_SECONDS*12);
            }
            $block->setFeed($feed);

            return $block->getHtml();
        } catch (\Exception $e) {
            error_log('Error loading Eule WP Shortcode: ' . $e->getMessage());
            $block = new Block(
                '/View/error.phtml'
            );

            return $block->getHtml();
        }
    }
}
