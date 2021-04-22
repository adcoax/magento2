<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magento\Cms\Model\Wysiwyg\Images;

use Magento\MediaGalleryImage\Model\ImageHtmlInterface;

/**
 * Old wrapper around newer InsertImageHtml
 * @deprecated
 * @see \Magento\MediaGalleryImage\Model\InsertImageHtml
 */
class GetInsertImageContent
{
    /**
     * @var ImageHtmlInterface
     */
    private $see;

    /**
     * GetInsertImageContent constructor.
     * @param ImageHtmlInterface $see
     */
    public function __construct(ImageHtmlInterface $see)
    {
        $this->see = $see;
    }

    /**
     * Create a content (just a link or an html block) for inserting image to the content
     *
     * @param string $encodedFilename
     * @param bool $forceStaticPath
     * @param bool $renderAsTag
     * @param int|null $storeId
     * @return string
     * @deprecated
     * @see \Magento\MediaGalleryImage\Model\InsertImageHtml::execute()
     */
    public function execute(
        string $encodedFilename,
        bool $forceStaticPath,
        bool $renderAsTag,
        ?int $storeId = null
    ): string {
        return $this->see->execute(
            $encodedFilename,
            $forceStaticPath,
            $renderAsTag,
            $storeId
        );
    }
}
