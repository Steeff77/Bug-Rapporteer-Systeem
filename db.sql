CREATE TABLE `bug` (
  `id` int(11) NOT NULL,
  `bugname` varchar(255) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `screen` varchar(200) NOT NULL,
  `info` varchar(2555) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Nog niet behandeld'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

ALTER TABLE `bug`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `bug`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
