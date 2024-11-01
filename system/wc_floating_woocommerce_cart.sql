CREATE TABLE IF NOT EXISTS `wc_floating_woocommerce_cart` (
  `intid` int(11) NOT NULL AUTO_INCREMENT,
  `modebox` varchar(255) NOT NULL,
  `popbg` varchar(250) NOT NULL,
  `basbg` varchar(250) NOT NULL,
  `position` varchar(250) NOT NULL,
  `varsubject` varchar(255) NOT NULL,
  PRIMARY KEY (`intid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;




INSERT INTO `wc_floating_woocommerce_cart` (`intid`, `modebox`, `popbg`, `basbg`, `position`, `varsubject`) VALUES
(1, 'ON', '#ffffff', 'red', 'left', 'All-pages');


