<?php

namespace Media\Model\Doctrine\ORM;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Util\ClassUtils;
use PHPCR\Util\PathHelper;
use Media\MediaInterface;
use Media\MediaManagerInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class MediaManager extends BaseMediaManager
{
    /**
     * {@inheritdoc}
     */
    public function getPath(MediaInterface $media)
    {
        return $media->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function getUrlSafePath(MediaInterface $media)
    {
        return ltrim($media->getId(), '/');
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaults(MediaInterface $media, $parentPath = null)
    {
        $class = ClassUtils::getClass($media);

        // check and add name if possible
        if (!$media->getName()) {
            if ($media->getId()) {
                $media->setName(PathHelper::getNodeName($media->getId()));
            } else {
                throw new \RuntimeException(sprintf(
                    'Unable to set defaults, Media of type "%s" does not have a name or id.',
                    $class
                ));
            }
        }

        $rootPath = is_null($parentPath) ? $this->rootPath : $parentPath;
        $path = ($rootPath === '/' ? $rootPath : $rootPath . '/') . $media->getName();

        /** @var DocumentManager $dm */
        $dm = $this->getObjectManager();

        // TODO use PHPCR autoname once this is done: http://www.doctrine-project.org/jira/browse/PHPCR-103
        if ($dm->find($class, $path)) {
            // path already exists
            $media->setName($media->getName() . '_' . time() . '_' . rand());
        }

        if (!$media->getParent()) {
            $parent = $dm->find(null, PathHelper::getParentPath($path));
            $media->setParent($parent);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function mapPathToId($path, $rootPath = null)
    {
        // The path is being the id
        $id = PathHelper::absolutizePath($path, '/');

        if (is_string($rootPath) && 0 !== strpos($id, $rootPath)) {
            throw new \OutOfBoundsException(sprintf(
                'The path "%s" is out of the root path "%s" were the file system is located.',
                $path,
                $rootPath
            ));
        }

        return $id;
    }

    /**
     * {@inheritdoc}
     */
    public function mapUrlSafePathToId($path, $rootPath = null)
    {
        return $this->mapPathToId($path, $rootPath);
    }
}