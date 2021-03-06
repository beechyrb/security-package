<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magento\Notifier\Model\Channel\Command;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Notifier\Model\ResourceModel\Channel;
use Magento\NotifierApi\Api\Data\ChannelInterface;
use Magento\NotifierApi\Model\Channel\Validator\ValidateChannelInterface;
use Psr\Log\LoggerInterface;

/**
 * @inheritdoc
 */
class Save implements SaveInterface
{
    /**
     * @var Channel
     */
    private $resource;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var ValidateChannelInterface
     */
    private $validateChannel;

    /**
     * @param Channel $resource
     * @param ValidateChannelInterface $validateChannel
     * @param LoggerInterface $logger
     */
    public function __construct(
        Channel $resource,
        ValidateChannelInterface $validateChannel,
        LoggerInterface $logger
    ) {
        $this->resource = $resource;
        $this->logger = $logger;
        $this->validateChannel = $validateChannel;
    }

    /**
     * @inheritdoc
     */
    public function execute(ChannelInterface $channel): int
    {
        $this->validateChannel->execute($channel);

        try {
            $this->resource->save($channel);
            return (int) $channel->getId();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotSaveException(__('Could not save Channel'), $e);
        }
    }
}
