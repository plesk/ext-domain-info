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
        $form->getElement('site_id')->setOptions([
            'multiOptions' => $domainSelector,
        ]);
        if ($this->_request->isPost() && $form->isValid($this->_request->getPost())) {
            $domainId = (int)$this->_request->getParam('site_id');
            $this->redirect($this->_helper->url('info', null, null, ['site_id' => $domainId]));
        }
        $this->view->form = $form;
    }
    protected function infoAction()
    {
        $params = $this->getAllParams();
        if (isset($params['site_id'])) {
            $domain = pm_Domain::getByDomainId($params['site_id']);
        } else {
            $domain = pm_Session::getCurrentDomain();
        }
        $this->view->pageTitle = pm_Locale::lmsg('pageInfoTitle', ['domain' => $domain->getName()]);
        $this->view->info = Modules_DomainInfo_DomainInfo::getDomainInfo($domain);
    }
}
