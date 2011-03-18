<?php use_helper("PageFlow", 'sfGuardMember') ?>

<p>
  新しいパスワードを設定してください。
</p>

<?php echo form_tag("@sf_guard_member_password_reset") ?>
<ul>
  <li class="form-row">
    <?php
      echo form_error('password'), 
        label_for('password','password:'),
        input_tag("password", $flow->getData('password'));
    ?>
  </li>
  <li class="form-row">
    <?php
      echo form_error('password_c'), 
        label_for('password_c','password(confirmation):'),
        input_tag("password_c", $flow->getData('password_c'));
    ?>
  </li>
  <li class="form-row">
    <?php 
      echo pageflow_submit_tag($flow, "doInput", 'submit');
    ?>
  </li>
</ul>
<?php echo '</form>' ?>
