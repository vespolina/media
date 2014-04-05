<?php

namespace Vespolina\Media;

interface FileInterface extends MetadataInterface
{
    /**
     * Returns the content
     *
     * @return string
     */
    public function getContent();

    /**
     * Set the content
     *
     * @param string $content
     *
     * @return $this
     */
    public function setContent($content);

    /**
     * Set the extension
     *
     * @param string $extension
     *
     * @return $this
     */
    public function setExtension($extension);

    /**
     * Get the default file name extension for files of this format
     *
     * @return string
     */
    public function getExtension();

    /**
     * Set the filesystem name for libraries like Gaufrette
     *
     * @param string $filesystem
     *
     * @return $this
     */
    public function setFilesystem($filesystem);

    /**
     * Get the filesystem name for libraries like Gaufrette
     *
     * @return string
     */
    public function getFilesystem();

    /**
     * Set label
     *
     * @param string $label
     *
     * @return $this
     */
    public function setLabel($label);

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel();

    /**
     * Set key for the filesystem
     *
     * @param string $key
     *
     * @return $this
     */
    public function setKey($key);

    /**
     * Get key
     *
     * @return string
     */
    public function getKey();

    /**
     * The mime type of this media element
     *
     * @return string
     */
    public function getMimeType();

    /**
     * Get the mime type of this media element
     *
     * @param string $mimeType
     *
     * @return $this
     */
    public function setMimeType($mimeType);

    /**
     * Set the size
     *
     * @param mixed $size
     *
     * @return $this
     */
    public function setSize($size);

    /**
     * Get the file size in bytes
     *
     * @return integer
     */
    public function getSize();
}
