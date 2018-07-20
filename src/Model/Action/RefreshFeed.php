<?php

namespace EuleNetwork\Model\Action;

use EuleNetwork\AbstractPostAction;
use EuleNetwork\Loader;
use EuleNetwork\Model\Storage\Transient;
use EuleNetwork\Plugin;

/**
 * Class RefreshFeed
 *
 * @package EuleNetwork\Model\Action
 */
class RefreshFeed extends AbstractPostAction
{
    /**
     * @var Transient
     */
    private $transientManager;

    /**
     * RefreshFeed constructor.
     *
     * @param Loader $loader
     */
    public function __construct(Loader $loader)
    {
        $actionId = Plugin::RELOAD_POSTS_ACTION_ID;
        $returnUrl = admin_url('options-general.php?page=die_eule_vernetzt');
        $this->transientManager = new Transient();

        parent::__construct($actionId, $returnUrl, $loader);
    }

    protected function action()
    {
        $this->transientManager->delete(Plugin::FEED_URL);
    }
}