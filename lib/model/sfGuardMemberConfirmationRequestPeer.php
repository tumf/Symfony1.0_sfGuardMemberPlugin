<?php

/**
 * Subclass for performing query and update operations on the 'sf_guard_member_confirmation_request' table.
 *
 * 
 *
 * @package plugins.sfGuardMemberPlugin.lib.model
 */
class sfGuardMemberConfirmationRequestPeer extends BasesfGuardMemberConfirmationRequestPeer
{
  /**
   * 新規レコードを作成する or レコードが存在する場合はハッシュを再生成する
   * 
   * #test rehashOrCreate (新規レコード)
   * <code>
   * require_once(sfConfig::get('sf_plugins_dir').'/sfGuardMemberPlugin/lib/helper/sfGuardMemberTestHelper.php');
   * // 新規作成テスト
   * $id = gen_id();
   * $addr = gen_address();
   * #ok($req = sfGuardMemberConfirmationRequestPeer::rehashOrCreate($addr), 'pass');
   *
   * // リハッシュテスト
   * $do = "実行前後でハッシュの値が異なっている";
   * $rehashed = sfGuardMemberConfirmationRequestPeer::rehashOrCreate($req->getEmail());
   * #ok($rehashed->getId() == ($_id = $req->getId()), "matched id:{$_id}");
   * #ok($rehashed->getEmail() == ($_addr = $req->getEmail()), "matched address:{$_addr}");
   * #ok($rehashed->getHash() != $req->getHash(), $do);
   * </code>
   */
  public static function rehashOrCreate($address)
  {
    $rec = self::retrieveByEmail($address);
    if ($rec) {
      $rec->rehash();
      $rec->save();
    }
    else {
      // create
      $rec = sfGuardMemberConfirmationRequestPeer::create($address);
    }
    return $rec;
  }
  
  /**
   * オブジェクトを生成する
   * 
   * #test create object
   * <code>
   * $address = gen_address();
   * $r = sfGuardMemberConfirmationRequestPeer::create($address);
   * #isa_ok($r, 'sfGuardMemberConfirmationRequest', "init done");
   * #isa_ok(sfGuardMemberConfirmationRequestPeer::retrieveByPK($r->getId()), 'sfGuardMemberConfirmationRequest', 'record exist');
   * #is($address, $r->getEmail(), "address matced");
   * $r->delete();
   * #is(sfGuardMemberConfirmationRequestPeer::retrieveByPK($r->getId()), null, 'deleted');
   * </code>
   */
  public static function create($address) {
    $rec = new sfGuardMemberConfirmationRequest;
    $rec->setEmail($address);
    $rec->setHash(self::generateHash());
    if (!$rec->save()) {
      throw new sfException("failed to create object: {$address}");
    }
    
    return $rec;
  }
    
  public static function retrieveAvailableByHash($hash)
  {
    $c = sfGuardMemberConfirmationRequestPeer::retrieveByHash($hash);
    return $c && ! $c->hasExpired() ? $c : null;
  }
  
  /**
   * #test retrieveByEmail
   * <code>
   * $rec = sfGuardMemberConfirmationRequestPeer::retrieveByEmail(gen_address());
   * #is(is_null($rec) || is_a($rec, 'sfGuardMemberConfirmationRequest'), true, 'got null or instance');
   * </code>
   */
  public static function retrieveByEmail($address) 
  {
    $c = new Criteria;
    $c->add(self::EMAIL, $address);
    return self::doSelectOne($c);
  }
  
  /**
   * #test retrieveByHash
   * <code>
   * // create
   * $orig = sfGuardMemberConfirmationRequestPeer::create(gen_address());
   * #isa_ok($orig, 'sfGuardMemberConfirmationRequest', "got instance");
   * // test
   * $do = "ids should be matched against object retrieved ByHash";
   * $from_hash = sfGuardMemberConfirmationRequestPeer::retrieveByHash($orig->getHash());
   * #is($orig->getId(), $from_hash->getId(), $do);
   * // test
   * $do = "got null when record doen't exist";
   * #is(null, sfGuardMemberConfirmationRequestPeer::retrieveByHash('nothing'), $do);
   * </code>
   */
  public static function retrieveByHash($hash)
  {
    $c = new Criteria;
    $c->add(self::HASH, $hash);
    return self::doSelectOne($c);
  }
  
  
  public static function generateHash()
  {
    return md5(mt_rand(100000, 999999999).session_id());
  }
}
