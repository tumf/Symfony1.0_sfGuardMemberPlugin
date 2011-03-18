<?php
/**
 *
 * @package    symfony
 * @subpackage sfGuardMember.plugin
 * @author     sou
 * @version    SVN: $Id: BasesfGuardMemberDeleteActions.class.php 651 2009-07-31 09:49:07Z tsukimiya $
 */
class BasesfGuardMemberDeleteActions extends sfPageFlowActions
{

  public function executeInitialize()
  {
    $this->flow->clearData();
    
    $this->flow->transitOnSuccess();
    return $this->flow->execute();
  }
  
  public function executeValidateAuthRequest()
  {
    if ($this->getUser()->checkPassword($this->flow->getData("auth_password"))){
      $this->flow->transitOnSuccess();
    }
    else{
      $this->getRequest()->setError('auth_password', 'invalid password');
      $this->flow->transitOnError();
    }
    return $this->flow->execute();
  }
  
  public function executeValidate(){
    $this->flow->transitOnSuccess();
    return $this->flow->execute();
  }
  
  public function executeCancel()
  {
    $this->redirect('@homepage');
  }
  
  public function executeSubmit()
  {
    sfLoader::loadHelpers('sfGuardMember');
    $reasons = withdrawal_reason_options();
    sfGuardMemberPeer::withdraw($this->getUser()->getGuardUser(), 
      sprintf("%s:%s", $reasons[$this->flow->getData('reason')], $this->flow->getData('reason_text')));
    
    // loginセッションの消去
    $this->getUser()->signOut();
    
    $this->redirect('@sf_guard_member_delete_result');
    
    // do signout in the view
    // $this->flow->transitOnSuccess();
    //return $this->flow->execute();
  }
  
  public function executeResult()
  {
    $this->setTemplate('displayResult');
  }
}
