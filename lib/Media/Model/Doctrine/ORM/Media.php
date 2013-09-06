<?php

namespace Media\Model\Doctrine\ORM;

use Media\HierarchyInterface;
use Media\Entity\Media as BaseMedia;

class Media extends BaseMedia implements HierarchyInterface
{
    /**
     * @var object
     */
    protected $createdBy;

    /**
     * @var object
     */
    protected $parent;

    /**
     * @var object
     */
    protected $updatedBy;

    /**
     * Getter for createdBy
     * The createdBy is assigned by the content repository
     * This is the name of the (jcr) user that created the node
     *
     * @return string name of the (jcr) user who created the file
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param Object $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        if ($parent instanceof Directory) {
            $parent->addChild($this);
        }
    }

    /**
     * @return Object|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Getter for updatedBy
     * The createdBy is assigned by the content repository
     * This is the name of the (jcr) user that updated the node
     *
     * @return string name of the (jcr) user who updated the file
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
