<?php

/**
 * Subclass for performing query and update operations on the 'sf_guard_member_confirmation_request_on_edit' table.
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
class sfGuardMemberConfirmationRequestOnEditPeer extends BasesfGuardMemberConfirmationRequestOnEditPeer
{
  /**
   * 新規レコードを作成する or レコードが存在する場合はハッシュを再生成する
   * 
   * #test rehashOrCreate
   * <code>
   * $do = "該当レコードが無ければ新規レコードを作成する";
   *   $address = gen_address();
   *   #ok($r = sfGuardMemberConfirmationRequestOnEditPeer::rehashOrCreate(john()->getId(), $address), 'executed');
   *   #isa_ok($r, 'sfGuardMemberConfirmationRequestOnEdit', $do);
   *
   * $do = "既存レコードがあればハッシュ値を再生成する";
   *   $new_r = sfGuardMemberConfirmationRequestOnEditPeer::rehashOrCreate(john()->getId(), $address);
   *   #is($new_r->getId(), $r->getId(), "id matched");
   *   #ok($new_r->getHash() != $r->getHash(), $do);
   * </code>
   */
  public static function rehashOrCreate($user_id, $address)
  {
    $rec = self::retrieveByKeys($user_id, $address);
    if ($rec) {
      $rec->rehash();
      $rec->save();
    }
    else {
      // create
      $rec = sfGuardMemberConfirmationRequestOnEditPeer::create($user_id, $address);
    }
    return $rec;
  }
  
  /**
   * 新しいオブジェクトを生成する
   * 
   * #test create object
   * <code>
   * $do = "オブジェクトが新規作成され、各プロパティが正しく登録されている。";
   *
   * $address = gen_address();
   * $r = sfGuardMemberConfirmationRequestOnEditPeer::create(john()->getId(), $address);
   * #isa_ok($r, 'sfGuardMemberConfirmationRequestOnEdit', "init done");
   * #isa_ok(sfGuardMemberConfirmationRequestOnEditPeer::retrieveByPK($r->getId()), 'sfGuardMemberConfirmationRequestOnEdit', 'record exist');
   * #is($address, $r->getEmail(), "address matced");
   * #is(john()->getId(), $r->getUserId(), "user_id matced");
   * 
   * // cleanup
   * $r->delete();
   * </code>
   */
  public static function create($user_id, $address) {
    $rec = new sfGuardMemberConfirmationRequestOnEdit;
    $rec->fromArray(array(
      'UserId' => $user_id,
      'Email' => $address,
      'Hash' => self::generateHash()
    ));
    if (!$rec->save()) {
      throw new sfException("failed to create object: {$address}");
    }
    
    return $rec;
  }
  
  public static function retrieveAvailableByHash($hash)
  {
    $c = sfGuardMemberConfirmationRequestOnEditPeer::retrieveByHash($hash);
    return $c && ! $c->hasExpired() ? $c : null;
  }
  
  /**
   * #test retrieveByKeys
   * <code>
   * $do = "user_id & address に応じたオブジェクトを取得する";
   * 
   * $address = gen_address();
   * $created = sfGuardMemberConfirmationRequestOnEditPeer::create(john()->getId(), $address);
   * $retrieved = sfGuardMemberConfirmationRequestOnEditPeer::retrieveByKeys(john()->getId(), $address);
   * #is($created->getId(), $retrieved->getId(), $do);
   * 
   * // cleanup
   * $created->delete();
   * </code>
   */
  public static function retrieveByKeys($user_id, $address) 
  {
    $c = new Criteria;
    $c->add(self::EMAIL, $address);
    return self::doSelectOne($c);
  }
  
  /**
   * #test retrieveByHash
   * <code>
   * // create
   * $orig = sfGuardMemberConfirmationRequestOnEditPeer::create(john()->getId(), gen_address());
   * #isa_ok($orig, 'sfGuardMemberConfirmationRequestOnEdit', "got instance");
   * // test
   * $do = "ids should be matched against object retrieved ByHash";
   * $from_hash = sfGuardMemberConfirmationRequestOnEditPeer::retrieveByHash($orig->getHash());
   * #is($orig->getId(), $from_hash->getId(), $do);
   * // test
   * $do = "got null when record doen't exist";
   * #is(null, sfGuardMemberConfirmationRequestOnEditPeer::retrieveByHash('nothing'), $do);
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
