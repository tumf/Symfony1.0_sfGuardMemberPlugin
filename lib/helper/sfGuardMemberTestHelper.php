<?php

function gen_id() {
  static $counter;
  if (is_null($counter)) {
    $counter = mt_rand(100000, 99999999);
  }
  return $counter++;
}

function clear_records($p) {
  $u = PluginsfGuardMemberPeer::retrieveByUsername($p['username']);
  if ($u) {
    echo "delete account for test: user {$u->getUsername()}";
    PluginsfGuardMemberPeer::delete($u, true);
   echo "... done\n";
  }
}

function gen_address($id=null) {
  if (! $id) $id = md5(mt_rand(100000, 999999999).session_id());
  $mail = $id.'@example.com';
  return $mail;
}

function gen_params_for_user()
{
  $id = 'test_'. gen_id();
  return array(
    'username'=>$id,
    'nickname'=>'JohnDoe',
    'password'=>'password',
    'birthday'=>'2009-01-01',
    'email'=>"{$id}@example.com"
  );
}

function gen_params_for_withdrawal()
{
  return array(
    'reason'=>'quit-by-reason'
  );
}

function gen_user()
{
  return PluginsfGuardMemberPeer::createAllFromForm(gen_params_for_user());
}

function del_user($user)
{
  return PluginsfGuardMemberPeer::delete($user);
}


// todo, change to use fixture
function fixture($model, $key)
{
  if ($model=='sf_guard_user' && $key=='john') {
    $params = array(
      'username'=>'john_the_tester', 'email'=>'john@example.com', 'password'=>'password',
      'birth_y'=>'1980', 'birth_m'=>'2', 'birth_d'=>'28'
    );
    $user = sfGuardMemberPeer::retrieveByUsername($params['username']);
    if (! $user) {
      sfGuardMemberPeer::createAllFromForm($params);
      $user = sfGuardMemberPeer::retrieveByUsername($params['username']);
    }
    return $user;
  }
}

function john() {
   static $_john;
   if (! $_john) {
     $_john = fixture('sf_guard_user', 'john');
   }
   return $_john;
}
