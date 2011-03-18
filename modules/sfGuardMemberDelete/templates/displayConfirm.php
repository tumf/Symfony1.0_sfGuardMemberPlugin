<?php use_helper("PageFlow") ?>
<ul>
  <li class="form-row">
    本当に退会されますか？
  </li>
  <li class="form-row">
		<a href="<?php echo pageflow_url_for($flow,"doCancel", "@sf_guard_member_delete") ?>">いいえ</a><br />
		<a href="<?php echo pageflow_url_for($flow,"doSubmit","@sf_guard_member_delete") ?>">はい、退会します</a>
  </li>
</ul>
