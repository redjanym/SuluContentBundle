<?php

declare(strict_types=1);

/*
 * This file is part of Sulu.
 *
 * (c) Sulu GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Bundle\ContentBundle\Content\Application\ContentFacade;

use Sulu\Bundle\ContentBundle\Content\Application\ContentLoader\ContentLoaderInterface;
use Sulu\Bundle\ContentBundle\Content\Application\ContentPersister\ContentPersisterInterface;
use Sulu\Bundle\ContentBundle\Content\Application\ViewResolver\ApiViewResolverInterface;
use Sulu\Bundle\ContentBundle\Content\Domain\Model\ContentInterface;
use Sulu\Bundle\ContentBundle\Content\Domain\Model\ContentViewInterface;

class ContentFacade implements ContentFacadeInterface
{
    /**
     * @var ContentLoaderInterface
     */
    private $contentLoader;

    /**
     * @var ContentPersisterInterface
     */
    private $contentPersister;

    /**
     * @var ApiViewResolverInterface
     */
    private $contentResolver;

    public function __construct(ContentLoaderInterface $contentLoader, ContentPersisterInterface $contentPersister, ApiViewResolverInterface $contentResolver)
    {
        $this->contentLoader = $contentLoader;
        $this->contentPersister = $contentPersister;
        $this->contentResolver = $contentResolver;
    }

    public function load(ContentInterface $content, array $dimensionAttributes): ContentViewInterface
    {
        return $this->contentLoader->load($content, $dimensionAttributes);
    }

    public function persist(ContentInterface $content, array $data, array $dimensionAttributes): ContentViewInterface
    {
        return $this->contentPersister->persist($content, $data, $dimensionAttributes);
    }

    public function resolve(ContentViewInterface $contentView): array
    {
        return $this->contentResolver->resolve($contentView);
    }
}
