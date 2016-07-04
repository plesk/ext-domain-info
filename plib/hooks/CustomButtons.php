<?php
// Copyright 1999-2016. Parallels IP Holdings GmbH.
class Modules_DomainInfo_CustomButtons extends pm_Hook_CustomButtons
{
    public function getButtons()
    {
        return [
            [
                'place' => self::PLACE_DOMAIN_PROPERTIES,
                'title' => pm_Locale::lmsg('domainInfoButtonTitle'),
                'additionalComments' => pm_Locale::lmsg('domainInfoButtonDescription'),
                'icon' => pm_Context::getBaseUrl() . 'images/button.png',
                'link' => pm_Context::getActionUrl('index', 'info'),
                'contextParams' => true,
            ],
        ];
    }
}
