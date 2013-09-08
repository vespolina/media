<?php

namespace Media\Model\Doctrine\ORM;

use Media\BinaryInterface;
use Media\FileInterface;
use Media\FileSystemInterface;

/**
 * TODO: create and add cmf:file mixin
 * This class represents a CmfMedia Doctrine Phpcr file.
 */
class File extends Media implements FileInterface, BinaryInterface
{
    /**
     * @var string $content
     */
    protected $content;

    /**
     * @var string $contentType
     */
    protected $contentType;

    /**
     * @var string $extension
     */
    protected $extension;

    /**
     * @var string
     */
    protected $filesystem;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var int $size
     */
    protected $size;

    /**
     * Set the content for this file from the given filename.
     * Calls file_get_contents with the given filename
     *
     * @param string $filename name of the file which contents should be used
     */
    public function setFileContentFromFilesystem($filename)
    {
        $this->getContent();
        $stream = fopen($filename, 'rb');
        if (! $stream) {
            throw new \RuntimeException("File '$filename' not found");
        }

        $this->content->setData($stream);
        $this->content->setLastModified(new \DateTime('@'.filemtime($filename)));

        $finfo = new \finfo();
        $this->content->setEncoding($finfo->file($filename,FILEINFO_MIME_ENCODING));
        $this->content->setMimeType($finfo->file($filename,FILEINFO_MIME_TYPE));

        $this->updateDimensionsFromContent();
    }

    /**
     * Set the content for this file.
     *
     * @param  $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get the resource representing the data of this file.
     *
     * Ensures the content object is created
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getContentAsString()
    {
        $stream = $this->getContent()->getData();
        $content = stream_get_contents($stream);
        rewind($stream);

        return $content !== false ? $content : '';
    }

    /**
     * @param string $content
     * @return bool|void
     */
    public function setContentFromString($content)
    {
        $this->getContent();

        if (!is_resource($content)) {
            $stream = fopen('php://memory', 'rwb+');
            fwrite($stream, $content);
            rewind($stream);
        } else {
            $stream = $content;
        }

        $this->setContentFromStream($stream);
    }

    /**
     * @param \SplFileInfo|FileInterface $file
     * @throws \InvalidArgumentException
     */
    public function copyContentFromFile($file)
    {
        if ($file instanceof \SplFileInfo) {
            $this->setFileContentFromFilesystem($file->getPathname());
        } elseif ($file instanceof BinaryInterface) {
            $this->setContentFromStream($file->getContentAsStream());
        } elseif ($file instanceof FileSystemInterface) {
            $this->setFileContentFromFilesystem($file->getFileSystemPath());
        } elseif ($file instanceof FileInterface) {
            $this->setContentFromString($file->getContentAsString());
        } else {
            $type = is_object($file) ? get_class($file) : gettype($file);
            throw new \InvalidArgumentException(sprintf(
                'File is not a valid type, "%s" given.',
                 $type
            ));
        }
    }

    /**
     * @return \Symfony\Cmf\Bundle\MediaBundle\stream
     */
    public function getContentAsStream()
    {
        $stream = $this->getContent()->getData();
        rewind($stream);

        return $stream;
    }

    /**
     * @param $stream
     * @throws \InvalidArgumentException
     */
    public function setContentFromStream($stream)
    {
        if (!is_resource($stream)) {
            throw new \InvalidArgumentException('Expected a stream');
        }

        $this->getContent()->setData($stream);
        $this->updateDimensionsFromContent();
    }

    public function setFilesystem($filesystem)
    {
        $this->filesystem = $filesystem;

        return $this;
    }

    public function getFilesystem()
    {
        return $this->filesystem;
    }

    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param int $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return (int) $this->size;
    }

    /**
     * @param string $contentType
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        $this->getContent()->setMimeType($contentType);
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @param string $extension
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Update dimensions like file size after content is set
     */
    protected function updateDimensionsFromContent()
    {
        $stream = $this->getContentAsStream();

        $stat = fstat($stream);
        $this->size = $stat['size'];
        $this->contentType = $this->getContent()->getMimeType();
    }
}
