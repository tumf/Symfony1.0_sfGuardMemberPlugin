<?php use_helper("PageFlow", 'Validation', 'sfGuardMember') ?>

<?php echo form_tag("@sf_guard_member_edit") ?>

<ul>
  <li class="form-row">
    <?php
      echo form_error('nickname'), 
        label_for('nickname','nickname:'),
        input_tag("nickname", $flow->getData('nickname'));
    ?>
  </li>
  <li class="form-row">
    <?php
      echo form_error('email'), 
        label_for('email','mail:'),
        input_tag("email", $flow->getData('email'));
    ?>
  </li>
  <li class="form-row">
    <?php
      echo form_error('optin'), 
        label_for('optin','optin:'),
        checkbox_tag("optin", "1", $flow->getData("optin"))
    ?>
  </li>
  <li class="form-row">
    <?php
      echo
        form_error('mobile_email'), 
          label_for('mobile_email','mobile_email:'),
          input_tag("mobile_email", $flow->getData('mobile_email'));
    ?>
  </li>
  <li class="form-row">
    <?php
      echo form_error('password'), 
        label_for('password','password:'),
        input_password_tag("password", $flow->getData('password'));
    ?>
  </li>
  <li class="form-row">
    <?php
      echo form_error('password_c'), 
        label_for('password_c','password(confirmation):'),
        input_password_tag("password_c", $flow->getData('password_c'));
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
      echo
        form_error('bloodtype'), 
          label_for("bloodtype", "bloodtype: "),
          bloodtype_select_tag('bloodtype',
          $flow->getData('bloodtype'))
    ?>
  </li>
  <li class="form-row">
    <?php
      echo 
        form_error('zipcode1'), 
        form_error('zipcode2'), 
          label_for("zipcode1", "zipcode: "),
          input_tag("zipcode1", $flow->getData('zipcode1')), 
          "-",
          input_tag("zipcode2", $flow->getData('zipcode2'))
    ?>
  </li>
  <li class="form-row">
	  <?php echo
	    pageflow_submit_tag($flow, "doInput")
	  ?>
  </li>
</ul>
<?php echo '</form>' ?>
