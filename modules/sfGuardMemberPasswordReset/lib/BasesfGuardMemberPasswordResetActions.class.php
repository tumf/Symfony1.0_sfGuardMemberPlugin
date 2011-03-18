<?php

/**
 *
 * @package    sfGuardMember.plugin
 * @subpackage sfGuardMemberPasswordReset.plugin
 * @author     sou
 * @version    SVN$
 */
class BasesfGuardMemberPasswordResetActions extends sfPageFlowActions
{
  
  public function executeInitialize()
  {
    $this->flow->clearData();
    $rec = $this->getFlash('sfGuardMemberPasswordResetRequest');
    
    if ($rec) {
      $this->flow->setData('request_record', $rec);
      $this->flow->transitOnSuccess();
      return $this->flow->execute();
    }
    else {
      return $this->redirect("@sf_guard_member_password_reset_request");
    }
  }

  public function executeValidate()
  {
    $this->flow->transitOnSuccess();
    return $this->flow->execute();
  }
  
  public function executeSubmit()
  {
    $rec = $this->flow->getData('request_record');
    $rec->execute($this->flow->getData('password'));
    
    $this->flow->transitOnSuccess();
    return $this->flow->execute();
  }
}
