<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Media\Entity;

use Vespolina\Media\AssetInterface;
use Vespolina\Media\MediaInterface;

/**
 * @author Myke Hines <myke@webhines.com>
 */
class Asset implements AssetInterface
{
    protected $height;
    protected $id;
    protected $label;
    protected $media;
    protected $mime;
    protected $priority;
    protected $src;
    protected $type;
    protected $width;

    /**
     * Return the id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the asset label
     *
     * @param $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * Get the asset label.
     * @return label
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * {@inheritdoc}
     */
    public function setMedia(MediaInterface $media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set the asset priority
     *
     * @param $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * Get the asset priority.
     * @return priority
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @inheritdoc
     */
    public function setSrc($src)
    {
        $this->src = $src;
    }

    /**
     * @inheritdoc
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * Set the asset height
     *
     * @param $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * Get the asset height.
     * @return height
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set the asset width
     *
     * @param $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * Get the asset width.
     * @return width
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set the asset mime
     *
     * @param $mime
     */
    public function setMime($mime)
    {
        $this->mime = $mime;
    }

    /**
     * Get the asset mime.
     * @return mime
     */
    public function getMime()
    {
        return $this->mime;
    }

    /**
     * Set the asset type
     *
     * @param $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get the asset type.
     * @return type
     */
    public function getType()
    {
        return $this->type;
    }
}
