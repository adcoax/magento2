<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magento\MediaGalleryImage\Model;

use Magento\Catalog\Helper\Data as CatalogHelper;
use Magento\Cms\Helper\Wysiwyg\Images as ImagesHelper;

/**
 * Get insert image HTML declaration or only its src attribute
 */
class InsertImageHtml implements ImageHtmlInterface
{
    /**
     * @var ImagesHelper
     */
    private $imagesHelper;

    /**
     * @var CatalogHelper
     */
    private $catalogHelper;

    /**
     * GetInsertImageContent constructor.
     * @param ImagesHelper $imagesHelper
     * @param CatalogHelper $catalogHelper
     */
    public function __construct(ImagesHelper $imagesHelper, CatalogHelper $catalogHelper)
    {
        $this->imagesHelper = $imagesHelper;
        $this->catalogHelper = $catalogHelper;
    }

    /**
     * Create a content (just a link or an html block) for inserting image to the content
     *
     * @param string $encodedFilename
     * @param bool $forceStaticPath
     * @param bool $renderAsTag
     * @param int|null $storeId
     * @return string
     */
    public function execute(
        string $encodedFilename,
        bool $forceStaticPath,
        bool $renderAsTag,
        ?int $storeId = null
    ): string {
        $filename = $this->imagesHelper->idDecode($encodedFilename);

        $this->catalogHelper->setStoreId($storeId);
        $this->imagesHelper->setStoreId($storeId);

        if ($forceStaticPath) {
            // phpcs:ignore Magento2.Functions.DiscouragedFunction
            return parse_url($this->imagesHelper->getCurrentUrl() . $filename, PHP_URL_PATH);
        }

        return $this->imagesHelper->getImageHtmlDeclaration($filename, $renderAsTag);
    }
}
