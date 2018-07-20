<?php

namespace EuleNetwork;

use EuleNetwork\Config\Section;
use EuleNetwork\Config\Setting;
use EuleNetwork\Config\Settings;
use EuleNetwork\Model\Action\RefreshFeed;
use EuleNetwork\Model\Storage\Transient;

class Plugin
{
    const WP_TEXTDOMAIN = 'eule-network';

    const RELOAD_POSTS_ACTION_ID = 'eule_network_refresh';

    const FEED_URL = 'https://eulemagazin.de/rss';

    const FEED_ITEM_AMOUNT = '2';

    /**
     * @var ConfigAccessor
     */
    private $config;

    /**
     * @var Loader
     */
    private $loader;

    /**
     * @var Transient
     */
    private $transient;

    /**
     * Plugin constructor.
     */
    public function __construct()
    {
        $this->loader = new Loader();
        $this->config = new ConfigAccessor();
        $this->transient = new Transient();

        if (is_admin()) {
            $configPage = $this->initConfigPage();
            $this->loader->addAction(
                'admin_init',
                $configPage,
                'registerSettings'
            );
            $this->loader->addFilter(
                "plugin_action_links_eule-network/eule-network.php",
                $configPage,
                'addConfigLinkToPluginPage'
            );
        } else {
            $this->initCss();
            $this->initShortcode();
        }

        $this->initWidget();
        $this->loader->run();
    }

    /**
     * @return Settings
     */
    public function initConfigPage()
    {
        new RefreshFeed($this->loader);
        $generalSettings = [
            new Setting(
                ConfigAccessor::KEY_LIGHT_LOGO,
                __('Helles Logo', Plugin::WP_TEXTDOMAIN),
                __('Verwende eine helle Variante des Eule-Logos. Verwende diese Einstellung, wenn dein Widget-Bereich einen dunklen Hintergrund hat.', Plugin::WP_TEXTDOMAIN),
                new \EuleNetwork\Block\Setting('/View/config/setting/boolean.phtml')
            ),
            new Setting(
                self::RELOAD_POSTS_ACTION_ID,
                __('Cache leeren', Plugin::WP_TEXTDOMAIN),
                __('Posts manuell nachladen. Geschieht automatisch alle 12 Stunden.', Plugin::WP_TEXTDOMAIN),
                new \EuleNetwork\Block\Setting('/View/config/setting/button.phtml')
            ),
            new Setting(
                'info',
                '',
                __('Um das "Die Eule" Plugin zu verwenden, verwende den Shortcode "[eule]" oder aktiviere das Widget "Die Eule".', Plugin::WP_TEXTDOMAIN),
                new \EuleNetwork\Block\Setting('/View/config/setting/info.phtml')
            ),
        ];
        $sections = [
            new Section(
                'general',
                '',
                $generalSettings,
                new \EuleNetwork\Block\Section('/View/config/section.phtml')
            ),
        ];
        $configPage = new Settings(__('Die Eule vernetzt', Plugin::WP_TEXTDOMAIN), $sections);

        return $configPage;
    }

    /**
     * @return string
     */
    public static function getSrcDir()
    {
        return plugin_dir_path(__FILE__);
    }

    /**
     * @return string
     */
    public static function getSrcUrl()
    {
        return plugin_dir_url(__FILE__);
    }

    private function initCss()
    {
        wp_enqueue_style(
            'eule',
            plugin_dir_url(__FILE__) . 'css/style.css'
        );
    }

    public function initWidget()
    {
        new \EuleNetwork\Widget\PartnerFeed($this->transient, $this->loader, $this->config);
    }

    private function initShortcode()
    {
        new \EuleNetwork\Shortcode\PartnerFeed($this->transient, $this->loader, $this->config);
    }
}
