<?php

namespace EuleNetwork\Widget;

use EuleNetwork\ConfigAccessor;
use EuleNetwork\Loader;
use EuleNetwork\Model\Storage\Transient;
use EuleNetwork\Plugin;
use EuleNetwork\WidgetBlock;

class PartnerFeed extends \WP_Widget
{
    /**
     * @var ConfigAccessor
     */
    private $transient;

    /**
     * @var Loader
     */
    private $loader;

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
    public function __construct(
        Transient $transient,
        Loader $loader,
        ConfigAccessor $config
    ) {
        $this->transient = $transient;
        $this->loader = $loader;
        $this->config = $config;
        $this->loader->addAction('widgets_init', $this, 'register');

        parent::__construct(
            'euleNetzwerk',
            __('Die Eule', Plugin::WP_TEXTDOMAIN),
            ['description' => __('Zeige aktuelle Artikel von eulemagazin.de', Plugin::WP_TEXTDOMAIN)]
        );
    }

    /**
     * Echo widget content.
     *
     * @param $args
     * @param $instance
     * @throws \Exception
     */
    public function widget($args, $instance)
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
            echo $args['before_widget'];
            echo $block->getHtml();
            echo $args['after_widget'];
        } catch (\Exception $e) {
            error_log('Error loading Eule WP Widget: ' . $e->getMessage());
            $block = new WidgetBlock(
                '/View/error-widget.phtml',
                $args['before_widget'],
                $args['after_widget'],
                $args['before_title'],
                $args['after_title']
            );

            echo $block->getHtml();
        }
    }

    /**
     * Echo content of widget configuration area.
     *
     * @param array $instance
     * @return string
     */
    public function form($instance)
    {
        echo '<p>'._('You can configure this widget via the Plugin options page.').'</p>';
        return 'noform';
    }

    public function register()
    {
        register_widget($this);
    }
}
