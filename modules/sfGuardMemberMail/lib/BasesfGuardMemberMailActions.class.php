<?php
/**
 * send mail
 *
 * @package    symfony
 * @subpackage sfGuardMember.plugin
 * @author     sou
 * @version    SVN: $Id: BasesfGuardMemberMailActions.class.php 616 2009-07-06 07:31:18Z sou $
 */
class BasesfGuardMemberMailActions extends sfActions 
{
  /**
   * 新規登録時、アドレス確認メール
   */
  public function executeSendRequestConfirmation()
  {
    $this->confirmation = $this->getRequest()->getAttribute('confirmation');
    $this->mail = $this->createMail(
      $this->confirmation->getEmail(),
      '__request_confirmation__'
    );
  }
  
  /**
   * 新規登録完了、ご案内メール
   */
  public function executeSendWelcome()
  {
    $this->user = $this->getRequest()->getAttribute('recipient');
    $this->mail = $this->createMail(
      $this->user->getProfile()->getEmail(),
      '__welcome__'
    );
  }
  
  /**
   * 登録情報変更時、アドレス確認メール
   */
  public function executeSendRequestConfirmationOnEdit()
  {
    $this->confirmation = $this->getRequest()->getAttribute('sfGuardMemberConfirmationRequestOnEdit');
    $this->mail = $this->createMail(
      $this->confirmation->getEmail(),
      '__request_confirmation__'
    );
  }
  
  /**
   * ID リマインダ
   */
  public function executeSendIdReminder()
  {
    $this->user = $this->getRequest()->getAttribute('recipient');
    $this->mail = $this->createMail(
      $this->user->getProfile()->getEmail(),
      '__your_id__'
    );
  }

  /**
   * パスワードリセット
   */
  public function executeSendPasswordResetRequest()
  {
    $this->user = $this->getRequest()->getAttribute('recipient');
    $this->record = $this->getRequest()->getAttribute('sfGuardMemberPasswordResetRequest');
    $this->mail = $this->createMail(
      $this->user->getProfile()->getEmail(),
      '__password_reset__'
    );
  }
  
  protected function createMail($to, $subject)
  {
    $mail = new jpEmail();
    $mail->setSender(sfConfig::get('app_mail_sender'), 'define me at app_mail_sender in app.yml'); # Return-Path:
    $mail->setFrom(sfConfig::get('app_mail_from', 'define me at app_mail_fromin app.yml'), ''); # From:
    $mail->addAddress($to); # To:
    $mail->setSubject($subject);
    
    return $mail;
  }
  
}
