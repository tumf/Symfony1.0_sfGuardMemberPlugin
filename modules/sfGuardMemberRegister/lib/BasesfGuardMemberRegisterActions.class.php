<?php
/**
 *
 * @package    sfGuardMember.plugin
 * @subpackage sfGuardMemberRegister.plugin
 * @author     sou
 * @version    SVN: $Id: BasesfGuardMemberRegisterActions.class.php 631 2009-07-13 07:28:14Z sou $
 */
class BasesfGuardMemberRegisterActions extends sfPageFlowActions
{

  public function executeInitialize()
  {
    $this->flow->clearData();
    $this->flow->setData('confirmation', $this->getConfirmationOrRedirect('@sf_guard_member_mail_register'));
    $this->flow->setData("birth_y", 1980);
    $this->flow->setData("birth_m", 1);
    $this->flow->setData("birth_d", 1);
    $this->flow->setData("optin", true);

    $this->flow->transitOnSuccess();
    return $this->flow->execute();
  }

  public function executeSetup()
  {
    $this->flow->transitOnSuccess();
    return $this->flow->execute();
  }


  public function executeValidate()
  {
    $this->flow->transitOnSuccess();
    return $this->flow->execute();
  }

  public function handleError()
  {
    // clear password if you want
    // $this->flow->setData('password', '');
    // $this->flow->setData('password_c', '');
    $this->flow->transitOnError();
    return $this->flow->execute();
  }

  public function executeSubmit()
  {
    $u = $this->flow->getData('confirmation')->execute($this->flow->getAll());
    
    // send mail
    $this->getRequest()->setAttribute('recipient', $u);
    $this->getPresentationFor('sfGuardMemberMail','sendWelcome','jpMail');
    
    // logging in
    $this->getUser()->signIn($u);

    $this->flow->transitOnSuccess();
    return $this->flow->execute();
  }
  
  protected function getConfirmationOrRedirect($goto_on_fail)
  {
    $c = $this->getFlash('sfGuardMemberConfirmationRequest');
    if (! $c) {
      sfLogger::getInstance()->info(sprintf("{%s} %s", __CLASS__, 
        __METHOD__ .': found no instance of sfGuardMemberConfirmationRequest'));
      return $this->redirect($goto_on_fail);
    }
    return $c;
  }
  
  // protected function getConfig($key=null)
  // {
  //   $conf = sfConfig::get('app_sf_guard_member_profile');
  //   if ($key) {
  //     return isset($conf[$key]) ? $conf[$key] : null;
  //   }
  //   else {
  //     return $conf;
  //   }
  // }
}
