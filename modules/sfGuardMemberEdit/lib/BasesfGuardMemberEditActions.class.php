<?php
/**
 *
 * @package    symfony
 * @subpackage sfGuardMember.plugin
 * @author     sou
 * @version    SVN: $Id: BasesfGuardMemberEditActions.class.php 645 2009-07-30 15:25:30Z tsukimiya $
 */
class BasesfGuardMemberEditActions extends sfPageFlowActions
{

  public function executeInitialize()
  {
    $this->flow->clearData();
    $user = $this->getUser();
    
    $this->flow->setData("nickname",$user->getProfile()->getNickname());
    $this->flow->setData("email",   $user->getEmail());
    $this->flow->setData("birth_y", $user->getBirthdayInYmd('year'));
    $this->flow->setData("birth_m", $user->getBirthdayInYmd('month'));
    $this->flow->setData("birth_d", $user->getBirthdayInYmd('day'));
    $this->flow->setData("zipcode1", $user->getZipcode1());
    $this->flow->setData("zipcode2", $user->getZipcode2());
    $this->flow->setData("gender", $user->getGender());
    $this->flow->setData("bloodtype", $user->getProfile()->getBloodtype());
    $this->flow->setData("optin", $user->isOptedIn());
    $this->flow->setData("mobile_email", $user->getProfile()->getMobileEmail());

    $this->flow->transitOnSuccess();
    return $this->flow->execute();
  }
  
  public function executeValidateAuthRequest(){
    if ($this->getUser()->checkPassword($this->flow->getData("auth_password"))){
      $this->flow->transitOnSuccess();
    }
    else{
      $this->getRequest()->setError('auth_password', 'invalid password');
      $this->flow->transitOnError();
    }
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

  public function handleError(){
    // clear password if you want
    // $this->flow->setData('password', '');
    // $this->flow->setData('password_c', '');
    $this->flow->transitOnError();
    return $this->flow->execute();
  }

  public function executeSubmit(){
    $params = $this->flow->getAll();
        
    // email
    if ($this->getUser()->getEmail() != $params['email']) {
      // if changed, send confirmation request
      $cf = sfGuardMemberConfirmationRequestOnEditPeer::rehashOrCreate($this->getUser()->getUserId(), $params['email']);
      $this->getRequest()->setAttribute('sfGuardMemberConfirmationRequestOnEdit', $cf);
      $this->flow->setData('sfGuardMemberConfirmationRequestOnEdit', $cf);
      
      $this->getPresentationFor('sfGuardMemberMail','sendRequestConfirmationOnEdit','jpMail');
    }
    
    // filter params
    if (! $params['password']) {
      unset($params['password']);
    }
    unset($params['email']);
    
    // update
    sfGuardMemberPeer::update($this->getUser()->getGuardUser(), $params);

    $this->flow->transitOnSuccess();
    return $this->flow->execute();
  }
  
  public function executeConfirmEmail()
  {
    $cf = sfGuardMemberConfirmationRequestOnEditPeer::retrieveAvailableByHash($this->getRequestParameter("hash"));
    if ($cf) {
      sfGuardMemberPeer::update($this->getUser()->getGuardUser(), array('email'=>$cf->getEmail()));
      $cf->delete();
      return sfView::SUCCESS;
    }
    else {
      $this->forward("sfGuardMemberError", "expired");
    }
  }
}
