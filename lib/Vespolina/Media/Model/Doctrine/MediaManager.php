<?php

namespace Vespolina\Media\Model\Doctrine;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Util\ClassUtils;
use Vespolina\Media\MediaInterface;
use Vespolina\Media\Entity\MediaManager as BaseMediaManager;

class MediaManager extends BaseMediaManager
{
    protected $managerRegistry;
    protected $managerName;

    /**
     * @param ManagerRegistry $registry
     * @param string          $managerName
     * @param string          $rootPath    path where the filesystem is located
     */
    public function __construct(ManagerRegistry $registry, $managerName, $defaultFileSystem, $filesystems = array(), $rootPath = '/')
    {
        $this->managerRegistry = $registry;
        $this->managerName     = $managerName;

        parent::__construct($defaultFileSystem, $filesystems, $rootPath);
    }
    /**
     * {@inheritdoc}
     */
    public function getPath(MediaInterface $media)
    {
        throw new \Exception('Not implemented');
    }

    /**
     * {@inheritdoc}
     */
    public function getUrlSafePath(MediaInterface $media)
    {
        throw new \Exception('Not implemented');
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaults(MediaInterface $media, $parentPath = null)
    {
        throw new \Exception('Not implemented');
    }

    /**
     * {@inheritdoc}
     */
    public function mapPathToId($path, $rootPath = null)
    {
        throw new \Exception('Not implemented');
    }

    /**
     * {@inheritdoc}
     */
    public function mapUrlSafePathToId($path, $rootPath = null)
    {
        throw new \Exception('Not implemented');
    }

    /**
     * Set the managerName to use to get the object manager;
     * if not called, the default manager will be used.
     *
     * @param string $managerName
     */
    public function setManagerName($managerName)
    {
        $this->managerName = $managerName;
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

    /**
     * Get the object manager from the registry, based on the current
     * managerName
     *
     * @return mixed
     */
    protected function getObjectManager()
    {
        return $this->managerRegistry->getManager($this->managerName);
    }
}