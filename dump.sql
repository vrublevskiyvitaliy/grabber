CREATE TABLE `site` (
  `site_id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `start_links` (
  `start_link_id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `tittle` varchar(45) NOT NULL,
  PRIMARY KEY (`start_link_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `video_page` (
  `video_page_id` int(11) NOT NULL AUTO_INCREMENT,
  `start_link_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `tittle` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_time` datetime DEFAULT NULL,
  `like_status` enum('like','dislike','pending','best') NOT NULL DEFAULT 'pending',
  `is_hidden` enum('yes','no') NOT NULL DEFAULT 'no',
  `is_downloaded` enum('yes','no','problem') DEFAULT NULL,
  `origin_video_page_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`video_page_id`),
  KEY `fk_start_link_video_link_idx` (`start_link_id`),
  KEY `fk_video_page_video_page_idx` (`origin_video_page_id`),
  CONSTRAINT `fk_start_link_video_link` FOREIGN KEY (`start_link_id`) REFERENCES `start_links` (`start_link_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_video_page_video_page` FOREIGN KEY (`origin_video_page_id`) REFERENCES `video_page` (`video_page_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `downloaded_video` (
  `downloaded_video_id` int(11) NOT NULL AUTO_INCREMENT,
  `video_page_id` int(11) NOT NULL,
  `log` longtext NOT NULL,
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`downloaded_video_id`),
  KEY `fk_downloaded_video_to_video_page_idx` (`video_page_id`),
  CONSTRAINT `fk_downloaded_video_to_video_page` FOREIGN KEY (`video_page_id`) REFERENCES `video_page` (`video_page_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `download_queue` (
  `download_queue_id` int(11) NOT NULL AUTO_INCREMENT,
  `video_page_id` int(11) NOT NULL,
  `download_status` enum('download_now','download_regularly','downloaded') NOT NULL DEFAULT 'download_regularly',
  `add_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`download_queue_id`),
  KEY `fk_download_queue_video_page_idx` (`video_page_id`),
  CONSTRAINT `fk_download_queue_video_page` FOREIGN KEY (`video_page_id`) REFERENCES `video_page` (`video_page_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


