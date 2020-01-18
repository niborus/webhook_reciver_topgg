CREATE TABLE `topgg`.`votes` (
    `entry_id` INT NOT NULL AUTO_INCREMENT COMMENT 'The ID for this database.' ,
    `bot` BIGINT NOT NULL COMMENT 'ID of the bot that received a vote' ,
    `user` BIGINT NOT NULL COMMENT 'ID of the user who voted' ,
    `type` VARCHAR(10) NOT NULL COMMENT 'The type of the vote (should always be \"upvote\" except when using the test button it\'s \"test\")' ,
    `isWeekend` BOOLEAN NOT NULL COMMENT 'Whether the weekend multiplier is in effect, meaning users votes count as two' ,
    `timestamp` BIGINT NOT NULL COMMENT 'The Unix-Timestamp, when the Request was incoming.' ,
    PRIMARY KEY (`entry_id`)
  );
