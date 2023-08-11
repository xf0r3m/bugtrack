use bugtrack;

ALTER TABLE site ADD theme varchar(10);
UPDATE site SET theme = 'dark' WHERE id = 1;
