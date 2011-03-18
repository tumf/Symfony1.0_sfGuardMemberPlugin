<?php use_helper("PageFlow", 'sfGuardMember') ?>

<h2>ID リマインダ</h2>

<p>
  ご登録頂いた ID をメールにてお知らせ致します。
</p>

<?php echo form_tag("@sf_guard_member_id_remind") ?>
<ul>
  <li class="form-row">
    <?php
      echo form_error('email'), 
        label_for('email','mail:'),
        input_tag("email", $flow->getData('email'));
    ?>
  </li>
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
  <?php 
  echo pageflow_submit_tag($flow, "doInput", 'submit');
  ?>
</ul>
<?php echo '</form>' ?>
