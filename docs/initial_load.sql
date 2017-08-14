CREATE TABLE `tbl_users`(
  `userId` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'プライマリーキー',
  `password` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'パスワード',
  `displayName` VARCHAR(64) NOT NULL DEFAULT '' COMMENT '氏名',
  `email` VARCHAR(128) NOT NULL DEFAULT '' COMMENT 'メールアドレス',
  `token` CHAR(60) NOT NULL DEFAULT '' COMMENT 'トークン',
  `loginFailureCount` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'ログイン失敗回数',
  `loginFailureDatetime` DATETIME DEFAULT NULL COMMENT 'ログイン失敗日時',
  `deleteFlg` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '削除フラグ',
  PRIMARY KEY (`userId`) COMMENT 'プライマリーキー',
  UNIQUE KEY `email` (`email`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/* 複合キーの設定 */
ALTER TABLE `tbl_users` ADD KEY (`email`, `deleteFlg`);