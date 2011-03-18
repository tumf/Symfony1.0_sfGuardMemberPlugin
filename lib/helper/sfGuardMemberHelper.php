<?php
function birth_y_select_tag($name,$value)
{
  $years = array('' => '----');
  for($i=date("Y");$i>=1910;$i--){
      $years[$i] = $i;
  }
  return select_tag($name,options_for_select($years, $value));
}

function birth_m_select_tag($name,$value)
{
  $months = array('' => '--');
  for($i=1;$i<=12;$i++){
      $months[sprintf('%02d', $i)] = $i;
  }
  return select_tag($name,options_for_select($months,$value));
}

function birth_d_select_tag($name,$value)
{
  $days = array('' => '--');
  for($i=1;$i<=31;$i++){
      $days[sprintf('%02d', $i)] = $i;
  }
  return select_tag($name,options_for_select($days,$value));
}

function withdrawal_reason_options()
{
  $conf = sfConfig::get('app_sf_guard_member_withdrawal_reasons');
  return $conf['use_options'];
}

function bloodtype_select_tag($name,$value)
{
  $types = array("" => "--", "A"=>"A","B"=>"B","O"=>"O","AB"=>"AB");
    return select_tag($name,options_for_select($types,$value));
}

function gender_ragiobutton_tag($name, $value)
{
  $types = array("male" => "男性", "female" => "女性");
  $tags = '';
  
  foreach($types as $k => $v) {
    $tags[] = radiobutton_tag($name, $k, $k == $value) . $v;
  }
  
  return implode(' ', $tags);
}
