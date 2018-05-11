<?php

namespace EuleNetwork\Block;

use EuleNetwork\Block;

class Section extends Block
{
    /**
     * @var \EuleNetwork\Config\Section
     */
    private $section;

    /**
     * Section constructor.
     *
     * @param string $templatePath
     * @param \EuleNetwork\Config\Section $section
     */
    public function __construct($templatePath, \EuleNetwork\Config\Section $section = null)
    {
        $this->section = $section;

        parent::__construct($templatePath);
    }

    /**
     * @return \EuleNetwork\Config\Section
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * @param \EuleNetwork\Config\Section $section
     */
    public function setSection(\EuleNetwork\Config\Section $section)
    {
        $this->section = $section;
    }
}
