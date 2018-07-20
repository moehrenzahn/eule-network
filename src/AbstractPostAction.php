<?php

namespace EuleNetwork;

/**
 * Class AbstractPostAction
 *
 * @package EuleNetwork
 */
abstract class AbstractPostAction
{
    /**
     * @var string
     */
    private $actionId;

    /**
     * @var string
     */
    private $returnUrl;

    /**
     * @var Loader
     */
    protected $loader;

    /**
     * AbstractPostAction constructor.
     *
     * @param string $actionId
     * @param string $returnUrl
     * @param Loader $loader
     */
    public function __construct($actionId, $returnUrl, Loader $loader)
    {
        $this->actionId = $actionId;
        $this->returnUrl = $returnUrl;
        $this->loader = $loader;

        $this->loader->addAction("admin_post_$actionId", $this, 'doAction');
    }

    /**
     * Perform POST action.
     *
     */
    public function doAction()
    {
        $this->action();
        wp_redirect($this->returnUrl);
        exit;
    }

    abstract protected function action();
}
