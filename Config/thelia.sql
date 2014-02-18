SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- transfer_payment_config
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `transfer_payment_config`;

CREATE TABLE `transfer_payment_config`
(
    `name` VARCHAR(255) NOT NULL,
    `value` VARCHAR(255),
    PRIMARY KEY (`name`)
) ENGINE=InnoDB;

INSERT INTO `transfer_payment_config`(`name`) VALUES
  ("companyName"),("iban"),("swift");

SET FOREIGN_KEY_CHECKS = 1;
