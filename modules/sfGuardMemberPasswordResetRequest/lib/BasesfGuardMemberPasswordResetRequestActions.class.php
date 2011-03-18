<?php

/**
 *
 * @package    sfGuardMember.plugin
 * @subpackage sfGuardMemberPasswordResetRequest.plugin
 * @author     sou
 * @version    SVN$
 */
class BasesfGuardMemberPasswordResetRequestActions extends sfPageFlowActions
{

  public function executeInitialize()
  {
    $this->flow->clearData();
    
    $this->flow->transitOnSuccess();
    return $this->flow->execute();
  }
  
  public function executeValidate(){
    $this->flow->transitOnSuccess();
    return $this->flow->execute();
  }
  
  public function executeSubmit(){
    $params = $this->flow->getAll();
    $user = sfGuardMemberPeer::retrieveByUsername($params['username']);
    $pattern = sprintf("/%04d.%02d.%02d/", $params['birth_y'], $params['birth_m'], $params['birth_d']);
    
    if ($user && preg_match($pattern, $user->getProfile()->getBirthday())) {
      $req = sfGuardMemberPasswordResetRequestPeer::create($user, $_SERVER["REMOTE_ADDR"]);
      $this->getRequest()->setAttribute('recipient', $req->getsfGuardUser());
      $this->getRequest()->setAttribute('sfGuardMemberPasswordResetRequest', $req);
      
      $r = $this->getPresentationFor('sfGuardMemberMail','sendPasswordResetRequest','jpMail');
    }
    
    $this->flow->transitOnSuccess();
    return $this->flow->execute();
  }
  
  public function executeCheck()
  {
    $req = sfGuardMemberPasswordResetRequestPeer::retrieveAvailableByHash($this->getRequestParameter("hash"));
    if ($req) {
      $this->setFlash('sfGuardMemberPasswordResetRequest', $req);
      return $this->redirect("@sf_guard_member_password_reset");
    }
    else {
      $this->forward("sfGuardMemberError", "expired");
    }
  }  
  
}
