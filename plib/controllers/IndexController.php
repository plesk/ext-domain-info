<?php
// Copyright 1999-2016. Parallels IP Holdings GmbH.
class IndexController extends pm_Controller_Action
{
    public function indexAction()
    {
        $this->forward('form');
    }

    public function formAction()
    {
        $this->view->pageTitle = pm_Locale::lmsg('pageTitle');

        $domainSelector = [];
        foreach (pm_Session::getCurrentDomains() as $domain) {
            $domainSelector[$domain->getId()] = $domain->getName();
        }

        $form = new Modules_DomainInfo_Form_Domains();
        $form->getElement('domainId')->setOptions([
            'multiOptions' => $domainSelector,
        ]);

        if ($this->_request->isPost() && $form->isValid($this->_request->getPost())) {
            $domainId = (int)$this->_request->getParam('domainId');
            $this->redirect($this->_helper->url('info', null, null, ['domainId' => $domainId]));
        }

        $this->view->form = $form;
    }

    protected function infoAction()
    {
        $params = $this->getAllParams();

        if (isset($params['domainName'])) {
            $domain = pm_Domain::getByName($params['domainName']);
        } elseif (isset($params['domainGuid'])) {
            $domain = pm_Domain::getByGuid($params['domainGuid']);
        } elseif (isset($params['domainId'])) {
            $domain = pm_Domain::getByDomainId($params['domainId']);
        } elseif (isset($params['site_id'])) {
            $domain = pm_Domain::getByDomainId($params['site_id']);
        } else {
            $domain = pm_Session::getCurrentDomain();
        }

        $this->view->pageTitle = pm_Locale::lmsg('pageInfoTitle', ['domain' => $domain->getName()]);

        $this->view->info = Modules_DomainInfo_DomainInfo::getDomainInfo($domain);
    }
}

