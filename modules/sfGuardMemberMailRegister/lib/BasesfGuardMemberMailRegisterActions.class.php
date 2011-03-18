<?php
/**
  * mail address confirmation flow before creating new account
 *
 * @package    symfony
 * @subpackage sfGuardMember.plugin
 * @author     sou
 * @version    SVN: $Id: BasesfGuardMemberMailRegisterActions.class.php 616 2009-07-06 07:31:18Z sou $
 */
class BasesfGuardMemberMailRegisterActions extends sfPageFlowActions
{
  public function executeInitialize()
  {
    $this->flow->clearData();
    $this->flow->transitOnSuccess();
    return $this->flow->execute();
  }
  
  public function executeSetup(){
    $this->flow->transitOnSuccess();
    return $this->flow->execute();
  }
  
  public function executeValidate(){
    $this->flow->transitOnSuccess();
    return $this->flow->execute();
  }
  
  public function executeSubmit(){
    $c = sfGuardMemberConfirmationRequestPeer::rehashOrCreate($this->flow->getData('email'));
    $this->getRequest()->setAttribute('confirmation', $c);
    $this->getPresentationFor('sfGuardMemberMail','sendRequestConfirmation','jpMail');
    
    $this->flow->transitOnSuccess();
    return $this->flow->execute();
  }
  
  /**
   * ハッシュチェック＆承認（確認用メール記載リンクより）
   */
  public function executeConfirm()
  {
    $c = sfGuardMemberConfirmationRequestPeer::retrieveAvailableByHash($this->getRequestParameter("hash"));
    if ($c) {
      $this->setFlash('sfGuardMemberConfirmationRequest', $c);
      return $this->redirect("@sf_guard_member_register");
    }
    else {
      $this->forward("sfGuardMemberError", "expired");
    }
  }  
}
