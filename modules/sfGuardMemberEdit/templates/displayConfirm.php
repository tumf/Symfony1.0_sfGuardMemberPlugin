<?php use_helper("PageFlow") ?>
<ul>
  <li class="form-row">
    <?php
      echo $flow->getData('nickname')
    ?>
  </li>
  <li class="form-row">
    <?php
      echo $flow->getData('email')
    ?>
  </li>
  <li class="form-row">
    <?php
      echo "メール受け取り: ", $flow->getData('optin') ? "許可":"拒否";
    ?>
  </li>
  <li class="form-row">
    <?php
      echo $flow->getData('mobile_email')
    ?>
  </li>
  <li class="form-row">
    <?php
      echo $flow->getData('password')
    ?>
  </li>
  <li class="form-row">
    <?php echo
          $flow->getData('birth_y')
    ?>
  </li>
  <li class="form-row">
    <?php echo
          $flow->getData('birth_m')
    ?>
  </li>
  <li class="form-row">
    <?php echo
          $flow->getData('birth_d')
    ?>
  </li>
  <li class="form-row">
    <?php echo
          $flow->getData('bloodtype')
    ?>
  </li>
  <li class="form-row">
    <?php
      echo $flow->getData('zipcode1'), "-", $flow->getData('zipcode2')
    ?>
  </li>
  
  <li class="form-row">
		<a href="<?php echo pageflow_url_for($flow,"doCancel", "@sf_guard_member_edit") ?>">edit</a><br />
		<a href="<?php echo pageflow_url_for($flow,"doConfirm","@sf_guard_member_edit") ?>">complete</a>
  </li>
</ul>
