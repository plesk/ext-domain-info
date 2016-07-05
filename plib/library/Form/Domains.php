<?php
// Copyright 1999-2016. Parallels IP Holdings GmbH.
class Modules_DomainInfo_Form_Domains extends pm_Form_Simple
{
    public function init()
    {
        parent::init();

        $this->addElement('description', 'description', [
            'description' => $this->lmsg('descriptionForm'),
        ]);

        $this->addElement('select', 'site_id', [
            'label' => $this->lmsg('listOfDomains'),
        ]);

        $this->addControlButtons([
            'hideLegend' => true,
            'sendHidden' => false,
        ]);
    }
}
