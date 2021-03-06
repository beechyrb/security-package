<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magento\NotifierAsyncAdminUi\Model\Source\Channel;

use Magento\Framework\Data\OptionSourceInterface;

class SendAsync implements OptionSourceInterface
{
    /**
     * @inheritdoc
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => 1, 'label' => __('Asynchronous')],
            ['value' => 0, 'label' => __('Immediate')],
        ];
    }
}
