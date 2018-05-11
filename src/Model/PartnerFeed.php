<?php

namespace EuleNetwork\Model;

/**
 * Class PartnerFeed
 *
 * @package EuleNetwork\Model
 */
class PartnerFeed
{
    /**
     * @var string
     */
    private $pageTitle;

    /**
     * @var string
     */
    private $pageDescription;

    /**
     * @var string
     */
    private $pageUrl;

    /**
     * @var \SimplePie_Item[]
     */
    private $items;

    /**
     * @var \SimplePie
     */
    private $simplePie;

    /**
     * PartnerFeed constructor.
     *
     * @param string $url
     * @param int $itemAmount
     */
    public function __construct($url, $itemAmount = 2)
    {
        $this->simplePie = new \SimplePie();
        $this->simplePie->enable_cache(false);
        $this->simplePie->set_feed_url($url);
        $this->simplePie->init();
        $this->pageTitle = $this->simplePie->get_title();
        $this->pageDescription = $this->simplePie->get_description();
        $this->pageUrl = $this->simplePie->get_base();
        $this->items = $this->simplePie->get_items(0, $itemAmount);
        if (empty($this->items)) {
            throw new \Exception('eulemagazin.de RSS feed could not be loaded.');
        }
    }

    /**
     * @return string
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    /**
     * @return string
     */
    public function getPageDescription()
    {
        return $this->pageDescription;
    }

    /**
     * @return string
     */
    public function getPageUrl()
    {
        return $this->pageUrl;
    }

    /**
     * @return \SimplePie_Item[]
     */
    public function getItems()
    {
        return $this->items;
    }
}
