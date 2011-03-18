<?php
/**
 *
 * @package    sfGuardMember.plugin
 * @subpackage sfGuardMember.plugin
 * @author     sou
 * @version    SVN: $Id: sfGuardMemberSecurityUser.php 741 2010-02-17 12:36:52Z tumf $
 */
class sfGuardMemberSecurityUser extends sfGuardSecurityUser
{
  const YMD_DELIMITTER = '-';
  
  public function getEmail()
  {
    return $this->getProfile()->getEmail();
  }
  
  public function getUserId()
  {
    return $this->getProfile()->getUserId();
  }
  /**
   * #test ::explodeZipcode();
   * <code>
   * #is(sfGuardMemberSecurityUser::explodeZipcode("132-234",0),132,"part 1: n=0");
   * #is(sfGuardMemberSecurityUser::explodeZipcode("132-234",1),234,"part 2: n=1");
   * </code>
   */
  public static function explodeZipcode($zipcode,$n /* 0 or 1 */)
  {
    $parts = explode('-', $zipcode);
    return isset($parts[$n]) ? $parts[$n] : null;
  }
  public function getZipcode1()
  {
    return self::explodeZipcode($this->getProfile()->getZipcode(),0);
  }
  public function getZipcode2()
  {
    return self::explodeZipcode($this->getProfile()->getZipcode(),1);
  }
  
  public function getGender()
  {
    return $this->getProfile()->getGender();
  }
  
  public function isOptedIn()
  {
    return $this->getProfile()->getOptin() === true;
  }
  
  public function getBirthdayInYmd($specify=null)
  {
    $ymd = explode(self::YMD_DELIMITTER, $this->getProfile()->getBirthday());
    
    switch ($specify) {
      case 'year':  return $ymd[0];
      case 'month': return $ymd[1];
      case 'day':   return $ymd[2];
      default:      return $ymd;
    }
  }
}
