<?php use_helper("PageFlow") ?>

<div id="sf_guard_member_mail_register_form">
<?php echo form_tag('@sf_guard_member_mail_register') ?>

  <fieldset>

    <div class="form-row" id="sf_guard_member_username">
      <?php
        echo form_error('email'), 
          label_for('email','mail:'),
          input_tag("email", $flow->getData('email'));
      ?>
    </div>
    
    <div class="form-row">
      <?php echo captcha_image(),captcha_reload_button(); ?>
    </div>

    <div class="form-row">
      <?php
        echo form_error('captcha'), 
          label_for('captcha','captcha:'),
          input_tag("captcha","") 
      ?>
    </div>
  </fieldset>

  <?php 
  echo pageflow_submit_tag($flow, "doInput", 'submit');
  ?>
<?php echo '</form>' ?>
</div>
