<?php declare(strict_types=1);
/**
 * Copyright © 2019 MultiSafepay, Inc. All rights reserved.
 * See DISCLAIMER.md for disclaimer details.
 */

namespace MultiSafepay\Shopware6\Helper;

use MultiSafepay\Shopware6\API\MspClient;
use MultiSafepay\Shopware6\Service\SettingsService;

class ApiHelper
{
    /** @var SettingsService $settingsService */
    private $settingsService;
    /** @var MspClient $mspClient */
    private $mspClient;

    /**
     * ApiHelper constructor.
     * @param SettingsService $settingsService
     * @param MspClient $client
     */
    public function __construct(SettingsService $settingsService, MspClient $client)
    {
        $this->settingsService = $settingsService;
        $this->mspClient = $client;
    }

    /**
     * @return MspClient
     */
    public function initializeMultiSafepayClient(): MspClient
    {
        $environment = $this->settingsService->getSetting('environment');
        $this->mspClient->setApiUrl(UrlHelper::TEST);
        if ($environment === 'live') {
            $this->mspClient->setApiUrl(UrlHelper::LIVE);
        }
        $this->mspClient->setApiKey($this->settingsService->getSetting('apiKey'));

        return $this->mspClient;
    }
}
