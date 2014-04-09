<?php

namespace Vespolina\Media\Entity;

use Vespolina\Media\FileInterface;

/**
 * Class File
 * @package Vespolina\Media\Entity
 */
class File extends Metadata implements FileInterface
{
    protected $content;
    protected $extension;
    protected $fileSystem;
    protected $localPath;
    protected $key;
    protected $label;
    protected $mimeType;
    protected $size;

    /**
     * {@inheritdoc}
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * {@inheritdoc}
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * {@inheritdoc}
     */
    public function setFileSystem($fileSystem)
    {
        $this->fileSystem = $fileSystem;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getFileSystem()
    {
        return $this->fileSystem;
    }

    /**
     * {@inheritdoc}
     */
    public function setLocalPath($path)
    {
        $this->localPath = $path;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLocalPath()
    {
        return $this->localPath;
    }

    /**
     * {@inheritdoc}
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * {@inheritdoc}
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * {@inheritdoc}
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * {@inheritdoc}
     */
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSize()
    {
        return $this->size;
    }
}