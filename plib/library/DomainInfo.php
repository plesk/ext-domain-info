<?php

// Copyright 1999-2016. Parallels IP Holdings GmbH.
class Modules_DomainInfo_DomainInfo
{
    public static function getDomainInfo(pm_Domain $domain)
    {
        return [
            'id' => $domain->getId(),
            'guid' => $domain->getGuid(),
            'name' => $domain->getName(),
            'displayName' => $domain->getDisplayName(),
            'documentRoot' => $domain->getDocumentRoot(),
            'homePath' => $domain->getHomePath(),
            'vhostPath' => $domain->getVhostSystemPath(),
            'systemUser' => $domain->getSysUserLogin(),
            'clientLogin' => $domain->getClient()->getProperty('login'),
            'hasHosting' => pm_Locale::lmsg($domain->hasHosting() ? 'yes' : 'no'),
            'ipAddresses' => $domain->getIpAddresses(),
        ];
    }
}
