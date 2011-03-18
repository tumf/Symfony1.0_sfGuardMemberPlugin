下記 URL より、新しいパスワードを設定してください。
<?php echo url_for("@sf_guard_member_password_reset_request_check?hash=".$record->getHash(), true) ?>

* 上記 URL は一定時間経過後、ご利用頂けなくなります。
