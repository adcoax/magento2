<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magento\MediaGalleryUi\Model\InsertImageData;

use Magento\Cms\Helper\Wysiwyg\Images;
use Magento\Cms\Model\Wysiwyg\Images\GetInsertImageContent;
use Magento\Framework\File\Mime;
use Magento\Framework\Filesystem;
use Magento\MediaGalleryImage\Model\InsertImageDataBuilder;
use Magento\MediaGalleryUi\Model\InsertImageDataFactory;
use Magento\MediaGalleryUi\Model\InsertImageDataInterface;

/**
 * Class GetInsertImageData
 * @deprecated
 * @see \Magento\MediaGalleryImage\Model\InsertImageDataBuilder
 */
class GetInsertImageData
{
    /**
     * @var InsertImageDataBuilder
     */
    private $see;

    /**
     * @var InsertImageDataFactory
     */
    private $insertImageDataFactory;

    /**
     * GetInsertImageData constructor.
     *
     * @param GetInsertImageContent $getInsertImageContent
     * @param Filesystem $fileSystem
     * @param Mime $mime
     * @param InsertImageDataFactory $insertImageDataFactory
     * @param Images $imagesHelper
     * @param InsertImageDataBuilder $see
     */
    public function __construct(
        GetInsertImageContent $getInsertImageContent,
        Filesystem $fileSystem,
        Mime $mime,
        InsertImageDataFactory $insertImageDataFactory,
        Images $imagesHelper,
        InsertImageDataBuilder $see
    ) {
        $this->insertImageDataFactory = $insertImageDataFactory;
        $this->see = $see;
    }

    /**
     * Returns image data object
     *
     * @param string $encodedFilename
     * @param bool $forceStaticPath
     * @param bool $renderAsTag
     * @param int|null $storeId
     * @return InsertImageDataInterface
     * @deprecated
     * @see \Magento\MediaGalleryImage\Model\InsertImageDataBuilder::execute()
     */
    public function execute(
        string $encodedFilename,
        bool $forceStaticPath,
        bool $renderAsTag,
        ?int $storeId = null
    ): InsertImageDataInterface {
        $seeResult = $this->see->execute(
            $encodedFilename,
            $forceStaticPath,
            $renderAsTag,
            $storeId
        );

        return $this->insertImageDataFactory->create([
            'content' => $seeResult->getContent(),
            'size' => $seeResult->getSize(),
            'type' => $seeResult->getType()
        ]);
    }

    /**
     * Retrieve MIME type of requested file
     *
     * @param string $path
     * @return string
     * @deprecated
     * @see \Magento\MediaGalleryImage\Model\InsertImageDataBuilder::getType()
     */
    public function getType(string $path): string
    {
        return $this->see->getType($path);
    }
}
