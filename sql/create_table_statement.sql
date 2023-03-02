CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `workstation` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `className` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `room` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `groupid` int(100) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `pin` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
 
CREATE TABLE `groups` (
  `id` int(100) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `members` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  `semester` varchar(255) DEFAULT NULL,
  `pin` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 

CREATE TABLE `workstations` (
  `id` int(100) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `room` varchar(255) DEFAULT NULL,
  `seats` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);
 
ALTER TABLE `groups`
  ADD UNIQUE KEY `id` (`id`);
 
ALTER TABLE `workstations`
  ADD PRIMARY KEY (`id`);
 
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
 