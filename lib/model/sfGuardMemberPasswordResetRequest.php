<?php

/**
 * Subclass for representing a row from the 'sf_guard_member_password_reset_request' table.
 *
 * 
 *
 * @package plugins.sfGuardMemberPlugin.lib.model
 */ 
/**
 * #test helpers
 * <code>
 * require_once(sfConfig::get('sf_plugins_dir').'/sfGuardMemberPlugin/lib/helper/sfGuardMemberTestHelper.php');
 *
 * $rh = '__test_remote_host__';
 * $user = gen_user();
 * $rec = new_rec($user);
 * function new_rec($user) {
 *    return sfGuardMemberPasswordResetRequestPeer::create($user, '__test_remote_host__');
 *  }
 * </code>
 */
class sfGuardMemberPasswordResetRequest extends BasesfGuardMemberPasswordResetRequest
{
  const DEFAULT_LIFETIME = 10800; // 3h
  
  /**
   * #test 
   * <code>
   * $do = "利用可能であれば true を返す";
   *   $new = new_rec($user);
   *   #is($new->isAvailable(), true, $do);
   *
   * $do = "available:false であれば false を返す";
   *   $new->setIsAvailable(false);
   *   #is($new->isAvailable(), false, $do);
   *
   * $do = "利用期限切れであれば false を返す";
   *   $new = new_rec($user);
   *   $new->setUpdatedAt(time() - $new->getLifetime() - 1);
   *   #is($new->isAvailable(), false, $do);
   * </code>
   */
  public function isAvailable()
  {
    return ! $this->hasExpired() && ($this->getIsAvailable() === true);
  }
  
  /**
   * update password
   *
   * #test execute
   * <code>
   * $do = "紐付いたユーザのパスワードが更新される: ";
   *   $who = gen_user();
   *   $who_rec = new_rec($who);
   *   $pwd = 'changed-pwd';
   *   #ok($who_rec->execute($pwd), 'executed');
   *   #is(sfGuardUserPeer::retrieveByPk($who->getId())->checkPassword($pwd), true, $do.$pwd);
   *
   * $do = "一度 execute されたレコードは isAvailable が false を返すようになる";
   *   #is($who_rec->isAvailable(), false, $do);
   *   $who->delete();
   * </code>
   */
  public function execute($new_password)
  {
    $user = $this->getsfGuardUser();
    $user->setPassword($new_password);
    $user->save();
    
    $this->setIsAvailable(false);
    $this->save();
    return $this;
  }
  
  /**
   * #test expiration
   * <code>
   * // should not expired
   * #ok(! $rec->hasExpired(), "ok, not expired");
   * $rec->setUpdatedAt(time() - $rec->getLifetime() - 1);
   * #ok($rec->hasExpired(), "ok, expired");
   * </code>
   */
  public function hasExpired()
  {
    return ($this->getExpiredAt() > time()) ? false : true;
  }
  
  public function getExpiredAt()
  {
    return $this->getUpdatedAt(null) + $this->getLifetime();
  }

  /**
   * #test getLifetime
   * <code>
   * $lt = $rec->getLifetime();
   * #ok(is_numeric($lt), "got lifetime: {$lt} sec");
   * </code>
   */
  public function getLifetime()
  {
    return sfConfig::get("app_mail_deadline", self::DEFAULT_LIFETIME);
  }
  
  /**
   * #test clean
   * <code>
   * $rec->delete();
   * del_user($user);
   * </code>
   */
}
