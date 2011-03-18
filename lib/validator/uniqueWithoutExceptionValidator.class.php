<?php
/**
 * uniqueWithoutExceptionValidator
 *
 * do uniqueness validation with exception
 * - check uniqueness without own mailaddress
 * 
 * @package    validator
 * @subpackage symfony
 * @author     sou
 * @version    SVN: $Id: uniqueWithoutExceptionValidator.class.php 697 2009-11-23 06:23:31Z sou $
 */
/**
 * <code>
 *  # オリヂナル + exception 入れた + myUser 以外でも指定可能に
 *  # この方法は脆弱性があるため管理画面以外では使わないこと（重複排除のパラメータがリクエストに由来する）
 *  # myUser->getEmail の値でない場合に、ユニークチェックを行う
 *  unique_address:
 *    class: uniqueWithoutExceptionValidator
 *    param:
 *      class: sfGuardUserProfile
 *      column: email
 *      unique_error:  ご入力のメールアドレスは既に登録済みです。
 *      exception:
 *          field_of: current_email
 * 
 *  # オリヂナル + exception 入れた
 *  # myUser->getEmail の値でない場合に、ユニークチェックを行う
 *  unique_address:
 *    class: uniqueWithoutExceptionValidator
 *    param:
 *      class: sfGuardUserProfile
 *      column: email
 *      unique_error:  ご入力のメールアドレスは既に登録済みです。
 *      exception:
 *          value_of: getEmail
 *  # オリヂナル
 *  # クラスと static メソッドを指定し、ユニークチェックを行う（論理削除を考慮したい場合等）
 *  unique_address:
 *    class: uniqueWithoutExceptionValidator
 *    param:
 *      class: sfGuardUserProfile
 *      method: retrieveByEmail
 *      unique_error:  ご入力のメールアドレスは既に登録済みです。
 * </code>
 */
class uniqueWithoutExceptionValidator extends sfPropelUniqueValidator
{
  public $defaults = array(
    'unique_error' => 'not unique',
    'column' => 'override_me_if_necessary'
  );
  
  public function initialize ($context, $parameters = null)
  {
    foreach ($this->defaults as $key => $value) {
      if (!isset($parameters[$key])) {
        $parameters[$key] = $value;
      }
    }
    
    parent::initialize($context, $parameters);
    $this->getParameterHolder()->add($parameters);
    
    return true;
  }

  public function execute (&$value, &$error)
  {
    $exception = $this->getParameterHolder()->get('exception');
    if ($exception && $this->matchWithException($value, $exception)) {
      return true;
    }
    else {
      return $this->validateUniqueness($value, $error);
    }
  }
  
  protected function validateUniqueness(&$value, &$error)
  {
    $params = $this->getParameterHolder()->getAll();
    if (isset($params['class'], $params['method']) && $params['class'] && $params['method']) {
      $res = call_user_func(array($params['class'], $params['method']), $value);
      if ($res) {
        $error = $params['unique_error'];
      }
    }
    else {
      parent::execute($value, $error);
    }
    
    return empty($error) ? true:false;
  }
  
  protected function matchWithException($value, $conf)
  {
    if (isset($conf['value_of'])) {
      $user = $this->getContext()->getUser();
      if (! $user) {
        return false;
      }
      $v = call_user_func(array($user, $conf['value_of']));
      return $v === $value ? true:false;
    }
    elseif (isset($conf['field_of'])) {
      $v = $this->getContext()->getRequest()->getParameter($conf['field_of']);
      return $v === $value ? true:false;
    }
    else {
      return false;
    }
  }
}
