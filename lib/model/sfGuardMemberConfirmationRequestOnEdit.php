<?php

/**
 * Subclass for representing a row from the 'sf_guard_member_confirmation_request_on_edit' table.
 *
 * 
 *
 * @package plugins.sfGuardMemberPlugin.lib.model
 */ 
/**
 * #test helpers
 * <code>
 * require_once(sfConfig::get('sf_plugins_dir').'/sfGuardMemberPlugin/lib/helper/sfGuardMemberTestHelper.php');
 * </code>
 */
class sfGuardMemberConfirmationRequestOnEdit extends BasesfGuardMemberConfirmationRequestOnEdit
{
  const DEFAULT_LIFETIME = 10800; // 3h

  /**
   * #test rehash
   * <code>
   * $do = "rehash 前後で異なるハッシュ値を持つ";
   * $r = new_request();
   * #ok($r->getHash() != $r->rehash()->getHash(), $do);
   * $r->delete();
   * </code>
   */
  public function rehash()
  {
    $this->setHash(sfGuardMemberConfirmationRequestOnEditPeer::generateHash());
    return $this;
  }

  /**
   * #test expiration
   * <code>
   * $r = new_request();
   * // should not expired
   * #ok(! $r->hasExpired(), "ok, not expired");
   * $r->setUpdatedAt(time() - $r->getLifetime() - 1);
   * #ok($r->hasExpired(), "ok, expired");
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
   * $lt = new_request()->getLifetime();
   * #ok(is_numeric($lt), "got lifetime: {$lt} sec");
   * </code>
   */
  public function getLifetime()
  {
    return sfConfig::get("app_mail_deadline", self::DEFAULT_LIFETIME);
  }
}

/**
 * #test setup test helper
 * <code>
 * function new_request($address=null) {
   * $u = fixture('sf_guard_user', 'john');
   * return sfGuardMemberConfirmationRequestOnEditPeer::create($u->getId(), ($address) ? $address : gen_address());
 * }
 * </code>
 */

