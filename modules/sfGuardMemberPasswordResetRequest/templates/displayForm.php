<?php use_helper("PageFlow", 'Validation', 'sfGuardMember') ?>

<p>
  パスワードの再設定を行います。
</p>

<?php echo form_tag("@sf_guard_member_password_reset_request") ?>
<ul>
  <li class="form-row">
    <?php
      echo form_error('username'), 
        label_for('username','id:'),
        input_tag("username", $flow->getData('username'));
    ?>
  </li>
  <li class="form-row">
    <?php 
      echo form_error('birth_y'), 
        birth_y_select_tag('birth_y',
        $flow->getData('birth_y'))
    ?>
  </li>
  <li class="form-row">
    <?php 
      echo form_error('birth_m'),
        birth_m_select_tag('birth_m',
        $flow->getData('birth_m'))
    ?>
  </li>
  <li class="form-row">
    <?php 
      echo form_error('birth_d'),
        birth_d_select_tag('birth_d',
        $flow->getData('birth_d'))
    ?>
  </li>
  <li class="form-row">
    <?php 
      echo pageflow_submit_tag($flow, "doInput", 'submit');
    ?>
  </li>
</ul>
<?php echo '</form>' ?>
