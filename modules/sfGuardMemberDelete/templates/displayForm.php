<?php use_helper("PageFlow", 'Validation', 'sfGuardMember') ?>

<?php echo form_tag("@sf_guard_member_delete") ?>
<ul>
  <li class="form-row">
    退会理由:
    <ul>
      <?php 
        foreach(withdrawal_reason_options() as $num => $opt) {
          echo '<li>', radiobutton_tag('reason', $num), label_for("reason_{$num}", $opt), '</li>';
        }
      ?>
      <li><?php echo textarea_tag('reason_text') ?></li>
    </ul>
  </li>
  <li class="form-row">
	  <?php echo
	    pageflow_submit_tag($flow, "doInput", '退会する')
	  ?>
  </li>
</ul>
<?php echo '</form>' ?>
