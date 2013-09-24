<?php

namespace Vespolina\Media\Entity;

use Vespolina\Media\FileInterface;
use Vespolina\Media\MediaManagerInterface;

abstract class MediaManager implements MediaManagerInterface
{
    protected $defaultFilesystem;
    protected $filesystems;
    protected $rootPath;

    /**
     * @param array of Filesystem $filesystems
     * @param string          $rootPath    path where the filesystem is located
     */
    public function __construct($defaultFilesystem, $filesystems = array(), $rootPath = '/')
    {
        $this->defaultFilesystem = $defaultFilesystem;
        $this->filesystems       = $filesystems;
        $this->rootPath          = $rootPath;
    }

    public function addFilesystem($identifier, $filesystem)
    {
        $this->filesystems[$identifier] = $filesystem;
    }

    public function readContent(FileInterface $file)
    {
        if (!$key = $file->getKey()) {
            throw new \Exception('A key should have been set for the File');
        }

        if (!$identifier = $file->getFilesystem()) {
            throw new \Exception('A filesystem should have been set for the File');
        }

        return $this->filesystems[$identifier]->read($file->getKey());
    }

    public function writeContent(FileInterface $file, $content)
    {
        if (is_file($content)) {
            $content = file_get_contents($content);
        }

        if (!$key = $file->getKey()) {
            throw new \Exception('A key must be set for the File');
        }

        if (!$identifier = $file->getFilesystem()) {
            $file->setFilesystem($this->defaultFilesystem);
            $identifier = $this->defaultFilesystem;
        }

        $this->filesystems[$identifier]->write($file->getKey(), $content);
    }

    /**
     * Set the root path were the file system is located;
     * if not called, the default root path will be used.
     *
     * @param string $rootPath
     */
    public function setRootPath($rootPath)
    {
        $this->rootPath = $rootPath;
    }
}