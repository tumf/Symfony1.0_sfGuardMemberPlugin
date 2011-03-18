<?php

/**
 * Subclass for representing a row from the 'sf_guard_member_confirmation_request' table.
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
 * function new_rec($mail=null) {
 *    return sfGuardMemberConfirmationRequestPeer::create(
 *      ($mail) ? $mail : gen_address());
 *  }
 * </code>
 */
class sfGuardMemberConfirmationRequest extends BasesfGuardMemberConfirmationRequest
{
  const DEFAULT_LIFETIME = 10800; // 3h
  
  /**
   * #test rehash
   * <code>
   * $do = "rehash 前後で異なるハッシュ値を持つ";
   * $r = new_rec();
   * #ok($r->getHash() != $r->rehash()->getHash(), $do);
   * </code>
   */
  public function rehash()
  {
    $this->setHash(sfGuardMemberConfirmationRequestPeer::generateHash());
    return $this;
  }
  
  
  /**
   * confirmation に対応するレコードを作成し、当レコードを削除する
   * 
   * @return object an instance of sfGuardUser
   *
   * #test execute
   * <code>
   * $do = "execute() により対応した sfGuardUser オブジェクトが生成される: ";
   * 
   * $params = gen_params_for_user();
   * $rec = new_rec($params['email']);
   * $rec->execute($params);
   * 
   * $u = sfGuardMemberPeer::retrieveByEmail($params['email']);
   * #isa_ok($u, 'sfGuardUser', $do."mail:{$params['email']}");
   * #is($email = $u->getProfile()->getEmail(), $params['email'], "matched: {$email}");
   *
   * $do = "一度 execute() されたレコードは再取得できない";
   * #is(sfGuardMemberConfirmationRequestPeer::retrieveAvailableByHash($rec->getHash()), null, $do);
   * </code>
   */
  public function execute($params)
  {
    $params['email'] = $this->getEmail(); // should be overwrite
    $user = sfGuardMemberPeer::createAllFromForm($params);
    $this->delete();
    
    return $user;
  }
  
  /**
   * #test expiration
   * <code>
   * // should not expired
   * #ok(! $r->hasExpired(), "ok, not expired");
   * $r->setUpdatedAt(time() - $r->getLifetime() - 1);
   * #ok($r->hasExpired(), "ok, expired");
   *
   * // restore
   * $r->delete();
   * $r = new_rec();
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
   * $lt = $r->getLifetime();
   * #ok(is_numeric($lt), "got lifetime: {$lt} sec");
   * </code>
   */
  public function getLifetime()
  {
    return sfConfig::get("app_mail_deadline", self::DEFAULT_LIFETIME);
  }
}
