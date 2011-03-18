<?php
/**
 *
 * @package    symfony
 * @subpackage sfGuardMember.plugin
 * @author     sou
 * @version    SVN: $Id: BasesfGuardMemberErrorActions.class.php 616 2009-07-06 07:31:18Z sou $
 */
class BasesfGuardMemberErrorActions extends sfActions
{
  /**
   * 期限切れ、タイムアウト表示
   */
  public function executeExpired()
  {
    $this->message = $this->getRequest()->getAttribute('message', "expired");
  }
}
