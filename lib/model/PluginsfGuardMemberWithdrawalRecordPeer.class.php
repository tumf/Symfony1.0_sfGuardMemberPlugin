<?php

/**
 * Subclass for representing a row from the 'sf_guard_member_withdrawal_record' table.
 *
 * @package    sfGuardMember.plugin
 * @subpackage sfGuardMember.plugin
 * @author     sou
 * @version    SVN: $Id: PluginsfGuardMemberWithdrawalRecordPeer.class.php 627 2009-07-07 08:02:58Z sou $
 */ 
/**
 * #test helper
 * <code>
 * require_once(sfConfig::get('sf_plugins_dir').'/sfGuardMemberPlugin/lib/helper/sfGuardMemberTestHelper.php');
 * 
 * function new_rec($user) {
 *   $rec = PluginsfGuardMemberWithdrawalRecordPeer::create($user, gen_params_for_withdrawal());
 * }
 * </code>
 */
class PluginsfGuardMemberWithdrawalRecordPeer extends BasesfGuardMemberWithdrawalRecordPeer
{
  /**
   * #test create
   * <code>
   * $do = "新規レコード作成";
   *   $user = gen_user();
   *   $rs = gen_params_for_withdrawal();
   *   #isa_ok($rec = PluginsfGuardMemberWithdrawalRecordPeer::create($user, $rs), 'sfGuardMemberWithdrawalRecord', $do);
   *   #is($rec->getReason(), $rs['reason'], "matched: {$rs['reason']}");
   * </code>
   */
  public static function create($user, $reason)
  {
    $rec = new sfGuardMemberWithdrawalRecord;
    $rec->setUserId($user->getId());
    $rec->fromArray($reason, BasePeer::TYPE_FIELDNAME);
    $rec->save();
    
    return $rec;
  }
  
  
  /**
   * #test retrieveByUserId
   * <code>
   * $do = "user_id を元にレコード取得";
   *   #isa_ok($r = PluginsfGuardMemberWithdrawalRecordPeer::retrieveByUserId($user->getId()), 'sfGuardMemberWithdrawalRecord', $do.":{$r->getReason()}");
   * </code>
   */
  public static function retrieveByUserId($user_id)
  {
    $c = new Criteria;
    $c->add(self::USER_ID, $user_id);
    return self::doSelectOne($c);
  }
}
