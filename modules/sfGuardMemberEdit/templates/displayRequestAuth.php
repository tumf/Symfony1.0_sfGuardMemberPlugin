<?php 
  use_helper("PageFlow", 'Validation', 'sfGuardMember');
  function _has_password_error() {
    return sfContext::getInstance()->getRequest()->hasError('auth_password') ? true:false;
  }
?>

<p>
  登録情報の変更を行います。パスワードを入力してください。
</p>

<?php echo form_tag("@sf_guard_member_edit") ?>
<ul>
  <li class="form-row">
    <?php
      if (_has_password_error()) {
        echo "<p>invalid password.</p>";
      }
      echo
        label_for('auth_password','enter your password:'),
        input_tag("auth_password", $flow->getData('auth_password'));
    ?>
  </li>
  <li class="form-row">
	  <?php echo
	    pageflow_submit_tag($flow, "doInput", 'proceed')
	  ?>
  </li>
</ul>

