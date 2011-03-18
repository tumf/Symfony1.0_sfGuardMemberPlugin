<?php
/**
 *
 * note:
 *   sfGuardUser 関連を継承しての拡張が難しいため（いくつかのメソッドの戻り値が sfGuardUser インスタンスであるため）
 *   操作関数を集約管理する方法を取った
 *
 * @package    sfGuardMember.plugin
 * @subpackage sfGuardMember.plugin
 * @author     sou
 * @version    SVN: $Id: PluginsfGuardMemberPeer.php 651 2009-07-31 09:49:07Z tsukimiya $
 */
/**
 * #test helper
 * <code>
 * require_once(sfConfig::get('sf_plugins_dir').'/sfGuardMemberPlugin/lib/helper/sfGuardMemberTestHelper.php');
 * </code>
 */
class PluginsfGuardMemberPeer extends sfGuardUserPeer
{
  /**
   * 退会を行う
   * 
   * #test withdraw 
   * <code>
   * $do = "退会を行ったユーザは is_active:true で取得できない: ";
   *   $u = gen_user();
   *   #isa_ok(PluginsfGuardMemberPeer::retrieveByUsername($u->getUsername()), 'sfGuardUser', "got instance");
   *   PluginsfGuardMemberPeer::withdraw($u, array("quit-by-some-reason"));
   *   #is(PluginsfGuardMemberPeer::retrieveByUsername($u->getUsername()), null, $do."got null by {$u->getUsername()}");
   * 
   * $do = "退会処理は論理削除である（is_active:false で取得できる）: ";
   *   #isa_ok(PluginsfGuardMemberPeer::retrieveByUsername($u->getUsername(), false), 'sfGuardUser', $do); 
   *
   * $do = "退会理由が記録されている: ";
   *   #ok($quit = sfGuardMemberWithdrawalRecordPeer::retrieveByUserId($u->getId()), $do."reason - {$quit->getReason()}");
   * </code>
   */
  public static function withdraw($user, $params)
  {
    // 退会理由の記述
    $record = new sfGuardMemberWithdrawalRecord();
    $record->setUserId($user->getId());
    $record->setReason($params);
    $record->save();
    self::delete($user);
  }
  
  /**
   * #test delete account
   * <code>
   * $do = "第二引数が true であれば、物理削除";
   * $id = gen_id();
   * #ok($u = PluginsfGuardMemberPeer::createAllFromForm(array('username'=>$id)), "got instance");
   * #ok(PluginsfGuardMemberPeer::delete($u, true), "do delete");
   * $c = new Criteria;
   * $c->add(sfGuardUserPeer::ID, $u->getId());
   * #is(sfGuardUserPeer::doSelectOne($c), null, $do);
   *
   * $do = "第二引数無しであれば、論理削除: ";
   * $id = gen_id();
   * #ok($u = PluginsfGuardMemberPeer::createAllFromForm(array('username'=>$id)), "got instance");
   * #ok(PluginsfGuardMemberPeer::delete($u), "do delete");
   * $c = new Criteria;
   * $c->add(sfGuardUserPeer::ID, $u->getId());
   * #ok($u = sfGuardUserPeer::doSelectOne($c), "got instance");
   * $d = $u->getProfile()->getDeletedAt();
   * #ok($d != null, $do .$d."deleted_at {$d}");
   * #is($u->getIsActive(), false, $do."is_active:false");
   * </code>
   */
  public static function delete(sfGuardUser $u, $hard=false)
  {
    if ($hard) {
      // 物理削除
      $u->delete();
      return $u;
    }
    else {
      $u->setIsActive(false);
      $u->save();
      $p = $u->getProfile();
      $p->setDeletedAt(time());
      $p->save();
      return $u;
    }
  }
  
  /**
   * #test update
   * <code>
   * $do = "登録情報が正しく更新されること: ";
   * 
   * $updates = array('password'=>'changed', 'birth_y'=>'1930', 'birth_m'=>'7', 'birth_d'=>'7');
   * $user = gen_user();
   * PluginsfGuardMemberPeer::update($user, $updates);
   * $updated = PluginsfGuardMemberPeer::retrieveByUsername($user->getUsername());
   * $prof = $updated->getProfile();
   *
   * $birthday = sprintf("%04d-%02d-%02d", $updates['birth_y'], $updates['birth_m'], $updates['birth_d']);
   * #is($prof->getBirthday(), $birthday, $do."birthday");
   * #is($user->checkPassword($updates['password']), true, $do."password");
   * 
   * del_user($u);
   * </code>
   */
  public static function update($user, $params, $update_type=BasePeer::TYPE_FIELDNAME)
  {
    $params = self::fromFormParams($params);
    
    $user->fromArray($params, $update_type);
    $user->save();
    $prof = $user->getProfile();
    $prof->fromArray($params, $update_type);
    $prof->save();
    return $user;
  }
  
  /**
   * #test retrieveByUsername
   * <code>
   * </code>
   */
  public static function retrieveByUsername($name, $is_active=true)
  {
    $c = self::getCriteria($is_active);
    $c->add(self::USERNAME, $name);
    
    return self::doSelectOne($c);
  }
  
  /**
   * #test retrieveByEmail
   * <code>
   * $do = "email アドレスに対応したユーザを返す: ";
   *   $u = gen_user();
   *   $prof = $u->getProfile();
   *   #ok($res=PluginsfGuardMemberPeer::retrieveByEmail($prof->getEmail()), "got return");
   *   #isa_ok($res, 'sfGuardUser', "got instance");
   *   #is($m1=$res->getProfile()->getEmail(), $m2=$prof->getEmail(), $do);
   *
   * $do = "! active であれば必ず null が返る: ";
   *   $res->setIsActive(false);
   *   $res->save();
   *   $notactive=PluginsfGuardMemberPeer::retrieveByEmail($prof->getEmail());
   *   #is($notactive, NULL, $do."got {$notactive}");
   * del_user($u);
   * </code>
   */
  public static function retrieveByEmail($email, $is_active=true)
  {
    $c = self::getCriteria($is_active);
    $c->add(sfGuardUserProfilePeer::EMAIL, $email);
    
    return self::doSelectOne($c);
  }

  
  /**
   * create user with all related records and return it
   *
   * #test create with form parameters
   * <code>
   * $do = "フォームのパラメータをまるっと渡すと関連するレコードも含め新しいユーザアカウントが生成される";
   *
   * $p = array('username'=>'__test', 'password'=>'hoge', 'birth_y'=>1975, 'birth_m'=>12, 'birth_d'=>25);
   * clear_records($p);
   *
   * $u = PluginsfGuardMemberPeer::createAllFromForm($p);
   * $prof = $u->getProfile();
   * #is($u->getUsername(), $p['username'], "matched");
   * #is($d=$prof->getBirthday(), '1975-12-25', "matched:".$d);
   * </code>
   */
  public static function createAllFromForm($params)
  {
    $params = self::fromFormParams($params);

    $user = new sfGuardUser();
    $user->fromArray($params, BasePeer::TYPE_FIELDNAME);
    $user->setIsActive(true);
    $user->save();

    $profile = new sfGuardUserProfile();
    $profile->fromArray($params, BasePeer::TYPE_FIELDNAME);
    $profile->setsfGuardUser($user);
    $profile->save();

    return $user;
  }
  
  public static function getCriteria($is_active=true, $c=null)
  {
    if (! $c) {
      $c = new Criteria;
    }
    
    if ($is_active) {
      $c->add(BasesfGuardUserProfilePeer::DELETED_AT, null, Criteria::ISNULL);
      $c->addJoin(BasesfGuardUserPeer::ID, BasesfGuardUserProfilePeer::USER_ID, Criteria::INNER_JOIN);
      $c->add(self::IS_ACTIVE, true);
    }
    return $c;
  }
  
  /**
   * convert form-style parameters to object-style
   */
  public static function fromFormParams($params)
  {
    if (!isset($params['birthday']) && isset($params['birth_y'])) {
      $params['birthday'] = sprintf("%04d/%02d/%02d", 
        $params['birth_y'], 
        $params['birth_m'], 
        $params['birth_d']);
    }
    
    if (! isset($params['zipcode']) && isset($params['zipcode1'])) {
      $params['zipcode'] = sprintf('%03d-%04d', $params['zipcode1'], $params['zipcode2']);
    }
    
    return $params;
  }
}
