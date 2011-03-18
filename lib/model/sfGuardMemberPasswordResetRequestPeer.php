<?php

/**
 * Subclass for performing query and update operations on the 'sf_guard_member_password_reset_request' table.
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
 * </code>
 */
class sfGuardMemberPasswordResetRequestPeer extends BasesfGuardMemberPasswordResetRequestPeer
{
  /**
   * 新しいオブジェクトを生成する
   * 
   * #test create object
   * <code>
   * $do = "オブジェクトが新規作成され、各プロパティが正しく登録されている。";
   *
   * $r = sfGuardMemberPasswordResetRequestPeer::create(john(), $rh);
   * #isa_ok($r, 'sfGuardMemberPasswordResetRequest', "init done");
   * #isa_ok(sfGuardMemberPasswordResetRequestPeer::retrieveByPK($r->getId()), 'sfGuardMemberPasswordResetRequest', 'record exist');
   * #is($rh, $r->getRemoteHost(), "remote host matced");
   * #is(john()->getId(), $r->getUserId(), "user_id matced");
   * 
   * // cleanup
   * $r->delete();
   * </code>
   */
  public static function create($user, $remote_host) {
    $rec = new sfGuardMemberPasswordResetRequest;
    $rec->fromArray(array(
      'UserId' => $user->getId(),
      'RemoteHost' => $remote_host,
      'Hash' => self::generateHash()
    ));
    if (!$rec->save()) {
      throw new sfException("failed to create object with: {$user}");
    }
    
    return $rec;
  }

  /**
   * #test retrieveByHash
   * <code>
   * // create
   * $orig = sfGuardMemberPasswordResetRequestPeer::create(john(), $rh);
   * #isa_ok($orig, 'sfGuardMemberPasswordResetRequest', "got instance");
   * // test
   * $do = "ids should be matched against object retrieved ByHash";
   * $from_hash = sfGuardMemberPasswordResetRequestPeer::retrieveByHash($orig->getHash());
   * #is($orig->getId(), $from_hash->getId(), $do);
   * // test
   * $do = "got null when record doen't exist";
   * #is(null, sfGuardMemberPasswordResetRequestPeer::retrieveByHash('nothing'), $do);
   * </code>
   */
  public static function retrieveByHash($hash)
  {
    $c = new Criteria;
    $c->add(self::HASH, $hash);
    return self::doSelectOne($c);
  }
  
  /**
   * #test retrieveAvailableByHash
   * <code>
   * $do = "取得したレコードが available && 期限内であること: ";
   * 
   * $r = sfGuardMemberPasswordResetRequestPeer::create(john(), $rh);
   * #is($r->hasExpired(), false, $do.'not expired');
   * #is($r->isAvailable(), true, $do."available");
   * </code>
   */
  public static function retrieveAvailableByHash($hash)
  {
    $c = self::retrieveByHash($hash);
    return $c && $c->isAvailable() ? $c : null;
  }
  
  public static function generateHash()
  {
    return md5(mt_rand(100000, 999999999).session_id());
  }
  
}
