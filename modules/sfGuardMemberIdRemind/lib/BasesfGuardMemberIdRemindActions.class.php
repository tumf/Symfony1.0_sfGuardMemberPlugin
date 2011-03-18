<?php

/**
 *
 * @package    sfGuardMember.plugin
 * @subpackage sfGuardMemberIdRemind.plugin
 * @author     sou
 * @version    SVN$
 */
require_once(sfConfig::get('sf_plugins_dir').'/sfGuardMemberPlugin/modules/sfGuardMemberIdRemind/lib/BasesfGuardMemberIdRemindActions.class.php');
class BasesfGuardMemberIdRemindActions extends sfPageFlowActions
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
    
    $user = sfGuardMemberPeer::retrieveByEmail($this->flow->getData('email'));
    
    if ($user) {
      $this->getRequest()->setAttribute('recipient', $user);
      $r = $this->getPresentationFor('sfGuardMemberMail','sendIdReminder','jpMail');
    }
    
    $this->flow->transitOnSuccess();
    return $this->flow->execute();
  }
}
