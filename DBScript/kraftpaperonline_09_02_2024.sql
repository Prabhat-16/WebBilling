-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 09, 2024 at 05:53 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kraftpaperonline`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `deleteCategory`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteCategory` (IN `CID` BIGINT(20))   BEGIN
	DELETE FROM tbl_category WHERE category_id = CID;
END$$

DROP PROCEDURE IF EXISTS `deleteDriver`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteDriver` (IN `DID` BIGINT(20))   BEGIN
	DELETE FROM tbl_driver WHERE driver_id  = DID;
END$$

DROP PROCEDURE IF EXISTS `deleteExpense`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteExpense` (IN `EID` BIGINT(20))   BEGIN
	DELETE FROM tbl_expense WHERE  expense_id  = EID;
END$$

DROP PROCEDURE IF EXISTS `deleteExpenseType`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteExpenseType` (IN `EID` BIGINT(20))   BEGIN
	DELETE FROM tbl_expense_type WHERE expense_type_id   = EID;
END$$

DROP PROCEDURE IF EXISTS `deleteFinancialYear`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteFinancialYear` (IN `FYID` BIGINT(20))   BEGIN
	DELETE FROM tbl_financial_year WHERE  financial_year_id    = FYID;
END$$

DROP PROCEDURE IF EXISTS `deleteGsm`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteGsm` (IN `GID` BIGINT(20))   BEGIN
	DELETE FROM tbl_gsm WHERE gsm_id = GID;
END$$

DROP PROCEDURE IF EXISTS `deleteGst`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteGst` (IN `GSTID` BIGINT(20))   BEGIN
	DELETE FROM tbl_gst_slab WHERE gst_slab_id  = GSTID;
END$$

DROP PROCEDURE IF EXISTS `deleteIncome`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteIncome` (IN `IID` BIGINT(20))   BEGIN
	DELETE FROM tbl_income WHERE  income_id  = IID;
END$$

DROP PROCEDURE IF EXISTS `deleteIncomeType`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteIncomeType` (IN `IID` BIGINT(20))   BEGIN
	DELETE FROM tbl_income_type WHERE  income_type_id   = IID;
END$$

DROP PROCEDURE IF EXISTS `deleteParty`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteParty` (IN `PID` BIGINT(20))   BEGIN
	DELETE FROM tbl_party WHERE party_id  = PID;
END$$

DROP PROCEDURE IF EXISTS `deletePaymentType`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deletePaymentType` (IN `PID` BIGINT(20))   BEGIN
	DELETE FROM tbl_payment_type WHERE payment_type_id   = PID;
END$$

DROP PROCEDURE IF EXISTS `deleteQuality`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteQuality` (IN `QID` BIGINT(20))   BEGIN
	DELETE FROM tbl_quality WHERE quality_id = QID;
END$$

DROP PROCEDURE IF EXISTS `deleteSize`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteSize` (IN `SID` BIGINT(20))   BEGIN
	DELETE FROM tbl_size WHERE size_id = SID;
END$$

DROP PROCEDURE IF EXISTS `deleteTransport`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteTransport` (IN `TID` BIGINT(20))   BEGIN
	DELETE FROM tbl_transport WHERE transport_id   = TID;
END$$

DROP PROCEDURE IF EXISTS `deleteUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteUser` (IN `UID` BIGINT(20))   BEGIN
	DELETE FROM tbl_user WHERE user_id  = UID;
END$$

DROP PROCEDURE IF EXISTS `fetchCategory`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchCategory` (IN `CID` BIGINT(20))   BEGIN
	SELECT * FROM tbl_category WHERE category_id = CID;
END$$

DROP PROCEDURE IF EXISTS `fetchDriver`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchDriver` (IN `DID` BIGINT(20))   BEGIN
	SELECT * FROM tbl_driver WHERE driver_id = DID;
END$$

DROP PROCEDURE IF EXISTS `fetchExpense`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchExpense` (IN `EID` BIGINT(20))   BEGIN
	SELECT * FROM tbl_expense WHERE expense_id  = EID;
END$$

DROP PROCEDURE IF EXISTS `fetchExpenseType`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchExpenseType` (IN `EID` BIGINT(20))   BEGIN
	SELECT * FROM tbl_expense_type WHERE expense_type_id = EID;
END$$

DROP PROCEDURE IF EXISTS `fetchGsm`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchGsm` (IN `GID` BIGINT(20))   BEGIN
	SELECT * FROM tbl_gsm WHERE gsm_id = GID;
END$$

DROP PROCEDURE IF EXISTS `fetchGst`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchGst` (IN `GSTID` BIGINT(20))   BEGIN
	SELECT * FROM tbl_gst_slab WHERE gst_slab_id = GSTID;
END$$

DROP PROCEDURE IF EXISTS `fetchIncome`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchIncome` (IN `IID` BIGINT(20))   BEGIN
	SELECT * FROM tbl_income WHERE income_id  = IID;
END$$

DROP PROCEDURE IF EXISTS `fetchIncomeType`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchIncomeType` (IN `IID` BIGINT(20))   BEGIN
	SELECT * FROM tbl_income_type WHERE income_type_id = IID;
END$$

DROP PROCEDURE IF EXISTS `fetchParty`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchParty` (IN `PID` BIGINT(20))   BEGIN
	SELECT * FROM tbl_party WHERE party_id = PID;
END$$

DROP PROCEDURE IF EXISTS `fetchPaymentType`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchPaymentType` (IN `PID` BIGINT(20))   BEGIN
	SELECT * FROM tbl_payment_type WHERE payment_type_id = PID;
END$$

DROP PROCEDURE IF EXISTS `fetchQuality`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchQuality` (IN `QID` BIGINT(20))   BEGIN
	SELECT * FROM tbl_quality WHERE quality_id = QID;
END$$

DROP PROCEDURE IF EXISTS `fetchSize`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchSize` (IN `SID` BIGINT(20))   BEGIN
	SELECT * FROM tbl_size WHERE size_id = SID;
END$$

DROP PROCEDURE IF EXISTS `fetchTransport`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchTransport` (IN `TID` BIGINT(20))   BEGIN
	SELECT * FROM tbl_transport WHERE transport_id = TID;
END$$

DROP PROCEDURE IF EXISTS `fetchUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchUser` (IN `UID` BIGINT(20))   BEGIN
	SELECT * FROM tbl_user WHERE user_id = UID;
END$$

DROP PROCEDURE IF EXISTS `getLogin`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getLogin` (IN `UNAME` VARCHAR(100), IN `PWD` VARCHAR(10))   BEGIN
	SELECT * FROM tbl_user WHERE ( email = UNAME OR phone = UNAME OR username = UNAME) AND password = PWD;
END$$

DROP PROCEDURE IF EXISTS `insertCategory`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertCategory` (IN `CCODE` VARCHAR(20), IN `CNAME` VARCHAR(100), IN `ISACTIVE` TINYINT(1), IN `UID` BIGINT(20))   BEGIN 
	INSERT INTO tbl_category(category_code,category_name,is_active,created_by)value(CCODE,CNAME,ISACTIVE,UID); 
END$$

DROP PROCEDURE IF EXISTS `insertDriver`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertDriver` (IN `DNAME` VARCHAR(50), IN `CNO` BIGINT(20), IN `EMAIL` VARCHAR(100), IN `ISACTIVE` TINYINT(1), IN `UID` BIGINT(20))   BEGIN
	INSERT INTO tbl_driver(driver_name,mobile,email,is_active,created_by) VALUE (DNAME, CNO , EMAIL , ISACTIVE , UID);
END$$

DROP PROCEDURE IF EXISTS `insertExpenseType`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertExpenseType` (IN `EXPTYPE` VARCHAR(50), IN `UID` BIGINT(20))   BEGIN
	INSERT INTO tbl_expense_type (expense_type,created_by) VALUE (EXPTYPE, UID);
END$$

DROP PROCEDURE IF EXISTS `insertFinancialYear`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertFinancialYear` (IN `FY` VARCHAR(10), IN `SDATE` DATE, IN `EDATE` DATE, IN `ISDEFAULT` TINYINT(1), IN `UID` BIGINT(20))   BEGIN
	INSERT INTO tbl_financial_year (fianacial_year, start_date, end_date, is_default, created_by) VALUE (FY, SDATE, EDATE, ISDEFAULT, UID);
END$$

DROP PROCEDURE IF EXISTS `insertGsm`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertGsm` (IN `GNAME` VARCHAR(50), IN `UID` BIGINT(20))   BEGIN
	INSERT INTO tbl_gsm (gsm_name,created_by) VALUE (GNAME,UID);
END$$

DROP PROCEDURE IF EXISTS `insertGst`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertGst` (IN `GSTNAME` VARCHAR(50), IN `CGST` DECIMAL(18,2), IN `SGST` DECIMAL(18,2), IN `IGST` DECIMAL(18,2), IN `UID` BIGINT(20))   BEGIN
	INSERT INTO tbl_gst_slab (gst_slab_name,cgst,sgst,igst,created_by) VALUE (GSTNAME,CGST,SGST,IGST,UID);
END$$

DROP PROCEDURE IF EXISTS `insertIncomeType`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertIncomeType` (IN `INTYPE` VARCHAR(50), IN `UID` BIGINT(20))   BEGIN
	INSERT INTO tbl_income_type (income_type,created_by) VALUE (INTYPE, UID);
END$$

DROP PROCEDURE IF EXISTS `insertParty`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertParty` (IN `PNAME` VARCHAR(50), IN `PTYPE` VARCHAR(10), IN `CNO` BIGINT(15), IN `EMAIl` VARCHAR(50), IN `OBAL` VARCHAR(7), IN `ADDRESS` VARCHAR(500), IN `DISCOUNT` DECIMAL(18,2), IN `SID` BIGINT(20), IN `GST` VARCHAR(50), IN `ISACTIVE` TINYINT(1), IN `UID` BIGINT(20))   BEGIN
	INSERT INTO tbl_party (party_name,party_type,contact_no,email,op_balance,address,discount,state_id,gstin,is_active,created_by) VALUE (PNAME,PTYPE,CNO,EMAIL,OBAL,ADDRESS,DISCOUNT,SID,GST,ISACTIVE,UID);
END$$

DROP PROCEDURE IF EXISTS `insertPaymentType`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertPaymentType` (IN `PTYPE` VARCHAR(50), IN `UID` BIGINT(20))   BEGIN
	INSERT INTO tbl_payment_type (payment_type,created_by) VALUE (PTYPE,UID);
END$$

DROP PROCEDURE IF EXISTS `insertQuality`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertQuality` (IN `QNAME` VARCHAR(50), IN `UID` BIGINT(20))   BEGIN
	INSERT INTO tbl_quality (quality_name,created_by) VALUE (QNAME,UID);
END$$

DROP PROCEDURE IF EXISTS `insertSize`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertSize` (IN `SNAME` VARCHAR(50), IN `UID` BIGINT(20))   BEGIN
	INSERT INTO tbl_size (size_name,created_by) VALUE (SNAME,UID);
END$$

DROP PROCEDURE IF EXISTS `insertTransport`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertTransport` (IN `VNAME` VARCHAR(50), IN `VNO` VARCHAR(40), IN `ISACTIVE` TINYINT(1), IN `UID` BIGINT(20))   BEGIN
	INSERT INTO tbl_transport(vehicle_name,vehicle_no,is_active,created_by) VALUE (VNAME, VNO , ISACTIVE , UID);
END$$

DROP PROCEDURE IF EXISTS `insertUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertUser` (IN `FNAME` VARCHAR(100), IN `EMAIL` VARCHAR(100), IN `PHONE` BIGINT(10), IN `USERNAME` VARCHAR(25), IN `PWD` VARCHAR(15), IN `ISACTIVE` TINYINT(1), IN `ISADMIN` TINYINT(1), IN `UPROFILE` VARCHAR(2000))   BEGIN
	INSERT INTO tbl_user(full_name,email,phone,username,password,is_active,is_admin,user_profile) VALUE (FNAME,EMAIL,PHONE,USERNAME,PWD,ISACTIVE,ISADMIN,UPROFILE);
END$$

DROP PROCEDURE IF EXISTS `updateCategory`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateCategory` (IN `CID` BIGINT(20), IN `CCODE` VARCHAR(50), IN `CNAME` VARCHAR(100), IN `ISACTIVE` TINYINT(1), IN `UID` BIGINT(20))   BEGIN
	UPDATE tbl_category SET category_code = CCODE , category_name = CNAME,  is_active = ISACTIVE , created_by = UID WHERE category_id = CID;
END$$

DROP PROCEDURE IF EXISTS `updateCompany`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateCompany` (IN `CID` BIGINT(20), IN `CNAME` VARCHAR(100), IN `EMAIL` VARCHAR(50), IN `PHONE` BIGINT(12), IN `SETASDEF` TINYINT(1), IN `ALTPHONE` BIGINT(12), IN `ADDRESS` VARCHAR(200), IN `STATE` VARCHAR(30), IN `CLOGO` VARCHAR(2000), IN `SIGNATURE` VARCHAR(2000))   BEGIN
	UPDATE tbl_company SET company_name = CNAME , email = EMAIL , phone = PHONE , set_as_default = SETASDEF , alternate_phone = ALTPHONE , address = ADDRESS , state = STATE , company_logo = CLOGO , signature = SIGNATURE WHERE company_id = CID;
END$$

DROP PROCEDURE IF EXISTS `updateDriver`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateDriver` (IN `DID` BIGINT(20), IN `DNAME` VARCHAR(50), IN `CNO` BIGINT(20), IN `EMAIL` VARCHAR(100), IN `ISACTIVE` TINYINT(1), IN `UID` BIGINT(20))   BEGIN
	UPDATE tbl_driver SET driver_name = DNAME , mobile = CNO , email = EMAIL , is_active = ISACTIVE , created_by = UID  WHERE driver_id = DID;
END$$

DROP PROCEDURE IF EXISTS `updateExpenseType`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateExpenseType` (IN `EID` BIGINT(20), IN `EXPTYPE` VARCHAR(50), IN `UID` BIGINT(20))   BEGIN
	UPDATE tbl_expense_type SET expense_type = EXPTYPE , created_by = UID WHERE expense_type_id = EID;
END$$

DROP PROCEDURE IF EXISTS `updateFinancialYear`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateFinancialYear` (IN `FYID` BIGINT(20))   BEGIN
	UPDATE tbl_financial_year SET is_default = '1' WHERE financial_year_id = FYID;
END$$

DROP PROCEDURE IF EXISTS `updateGsm`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateGsm` (IN `GID` BIGINT(20), IN `GNAME` VARCHAR(50), IN `UID` BIGINT(20))   BEGIN
	UPDATE tbl_gsm SET gsm_name = GNAME , created_by = UID WHERE gsm_id = GID;
END$$

DROP PROCEDURE IF EXISTS `updateGst`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateGst` (IN `GSTID` BIGINT(20), IN `GSTNAME` VARCHAR(50), IN `CGST` DECIMAL(18,2), IN `SGST` DECIMAL(18,2), IN `IGST` DECIMAL(18,2), IN `UID` BIGINT(20))   BEGIN
	UPDATE tbl_gst_slab SET gst_slab_name = GSTNAME , cgst = CGST , sgst =  SGST , igst = IGST , created_by = UID WHERE gst_slab_id  = GSTID;
END$$

DROP PROCEDURE IF EXISTS `updateIncomeType`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateIncomeType` (IN `IID` BIGINT(20), IN `INTYPE` VARCHAR(50), IN `UID` BIGINT(20))   BEGIN
	UPDATE tbl_income_type SET income_type = INTYPE , created_by = UID WHERE income_type_id = IID;
END$$

DROP PROCEDURE IF EXISTS `updateParty`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateParty` (IN `PID` BIGINT(20), IN `PNAME` VARCHAR(50), IN `PTYPE` VARCHAR(10), IN `CNO` BIGINT(15), IN `EMAIL` VARCHAR(50), IN `OBAL` VARCHAR(7), IN `ADDRESS` VARCHAR(500), IN `DISCOUNT` DECIMAL(18,2), IN `SID` BIGINT(20), IN `GST` VARCHAR(50), IN `ISACTIVE` TINYINT(1), IN `UID` BIGINT(20))   BEGIN
	UPDATE tbl_party SET party_name = PNAME , party_type = PTYPE , contact_no = CNO , email = EMAIL, op_balance = OBAL , address = ADDRESS , discount = DISCOUNT , state_id = SID , gstin = GST , is_active = ISACTIVE , created_by = UID WHERE party_id  = PID;
END$$

DROP PROCEDURE IF EXISTS `updatePaymentType`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updatePaymentType` (IN `PID` BIGINT(20), IN `PTYPE` VARCHAR(50), IN `UID` BIGINT(20))   BEGIN
	UPDATE tbl_payment_type SET payment_type = PTYPE , created_by = UID WHERE payment_type_id  = PID;
END$$

DROP PROCEDURE IF EXISTS `updateQuality`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateQuality` (IN `QID` BIGINT(20), IN `QNAME` VARCHAR(50), IN `UID` BIGINT(20))   BEGIN
	UPDATE tbl_quality SET quality_name = QNAME , created_by = UID WHERE quality_id = QID;
END$$

DROP PROCEDURE IF EXISTS `updateSize`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateSize` (IN `SID` BIGINT(20), IN `SNAME` VARCHAR(50), IN `UID` BIGINT(20))   BEGIN
	UPDATE tbl_size SET size_name = SNAME , created_by = UID WHERE size_id = SID;
END$$

DROP PROCEDURE IF EXISTS `updateTransport`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateTransport` (IN `TID` BIGINT(20), IN `VNAME` VARCHAR(50), IN `VNO` VARCHAR(40), IN `ISACTIVE` TINYINT(1), IN `UID` BIGINT(20))   BEGIN
	UPDATE tbl_transport SET vehicle_name = VNAME , vehicle_no = VNO , is_active = ISACTIVE , created_by = UID WHERE transport_id  = TID ;
END$$

DROP PROCEDURE IF EXISTS `updateUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateUser` (IN `UID` BIGINT(20), IN `FNAME` VARCHAR(100), IN `EMAIL` VARCHAR(100), IN `PHONE` BIGINT(10), IN `USERNAME` VARCHAR(25), IN `ISACTIVE` TINYINT(1), IN `UPROFILE` VARCHAR(2000))   BEGIN
	UPDATE tbl_user SET full_name = FNAME , email = EMAIL , phone = PHONE , username = USERNAME ,  is_active = ISACTIVE , user_profile = UPROFILE WHERE user_id = UID;
END$$

DROP PROCEDURE IF EXISTS `viewCategory`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `viewCategory` ()   BEGIN 
	SELECT * FROM tbl_category;
END$$

DROP PROCEDURE IF EXISTS `viewCompany`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `viewCompany` ()   BEGIN
	SELECT * FROM tbl_company;
END$$

DROP PROCEDURE IF EXISTS `viewDriver`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `viewDriver` ()   BEGIN
	SELECT * FROM tbl_driver;
END$$

DROP PROCEDURE IF EXISTS `viewExpense`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `viewExpense` ()   BEGIN
	SELECT te.*, tey.expense_type, tpy.payment_type
	FROM tbl_expense te
	LEFT JOIN tbl_expense_type tey ON te.expense_type_id = tey.expense_type_id
	LEFT JOIN tbl_payment_type tpy ON te.payment_type_id  = tpy.payment_type_id
	WHERE te.financial_year_id = (SELECT financial_year_id FROM tbl_financial_year WHERE is_default = 1);
END$$

DROP PROCEDURE IF EXISTS `viewExpenseType`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `viewExpenseType` ()   BEGIN
	SELECT * FROM tbl_expense_type;
END$$

DROP PROCEDURE IF EXISTS `viewFinancialYear`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `viewFinancialYear` ()   BEGIN
	SELECT * FROM tbl_financial_year;
END$$

DROP PROCEDURE IF EXISTS `viewGsm`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `viewGsm` ()   BEGIN 
	SELECT * FROM tbl_gsm;
END$$

DROP PROCEDURE IF EXISTS `viewGst`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `viewGst` ()   BEGIN 
	SELECT * FROM tbl_gst_slab;
END$$

DROP PROCEDURE IF EXISTS `viewIncome`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `viewIncome` ()   BEGIN
	SELECT ti.*, tiy.income_type, tpy.payment_type
	FROM tbl_income ti
	LEFT JOIN tbl_income_type tiy ON ti.income_type_id = tiy.income_type_id
	LEFT JOIN tbl_payment_type tpy ON ti.payment_type_id = tpy.payment_type_id
WHERE ti.financial_year_id = (SELECT financial_year_id FROM tbl_financial_year WHERE is_default = 1);
END$$

DROP PROCEDURE IF EXISTS `viewIncomeType`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `viewIncomeType` ()   BEGIN
	SELECT * FROM tbl_income_type;
END$$

DROP PROCEDURE IF EXISTS `viewParty`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `viewParty` ()   BEGIN
	SELECT tp.*,ts.state_name
	FROM tbl_party tp
	LEFT JOIN tbl_state ts ON tp.state_id = ts.state_id;
END$$

DROP PROCEDURE IF EXISTS `viewPaymentType`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `viewPaymentType` ()   BEGIN 
	SELECT * FROM tbl_payment_type;
END$$

DROP PROCEDURE IF EXISTS `viewQuality`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `viewQuality` ()   BEGIN 
	SELECT * FROM tbl_quality;
END$$

DROP PROCEDURE IF EXISTS `viewSize`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `viewSize` ()   BEGIN 
	SELECT * FROM tbl_size;
END$$

DROP PROCEDURE IF EXISTS `viewTransport`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `viewTransport` ()   BEGIN
	SELECT * FROM tbl_transport;
END$$

DROP PROCEDURE IF EXISTS `viewUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `viewUser` ()   BEGIN 
	SELECT * FROM tbl_user;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `category_id` bigint NOT NULL AUTO_INCREMENT,
  `category_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_by` bigint NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_code`, `category_name`, `is_active`, `created_by`, `added_date`) VALUES
(3, '90876AQ', 'T-Shirt', 1, 0, '2024-01-24 06:34:19'),
(4, '098iok', 'BURGER', 0, 0, '2024-01-24 06:58:07'),
(7, 'O245', 'PIZZA', 1, 0, '2024-01-24 07:19:01'),
(8, 'QWE1238', 'Shirt', 1, 4, '2024-01-24 09:30:32'),
(90, '456', 'Asus', 0, 4, '2024-02-09 13:59:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company`
--

DROP TABLE IF EXISTS `tbl_company`;
CREATE TABLE IF NOT EXISTS `tbl_company` (
  `company_id` bigint NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` bigint NOT NULL,
  `set_as_default` tinyint(1) NOT NULL,
  `alternate_phone` bigint NOT NULL,
  `address` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `state` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `company_logo` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `signature` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_company`
--

INSERT INTO `tbl_company` (`company_id`, `company_name`, `email`, `phone`, `set_as_default`, `alternate_phone`, `address`, `state`, `company_logo`, `signature`, `added_date`) VALUES
(1, 'TRYON INFOSOFT', 'tryoninfosoft@gmail.com', 7874063236, 1, 7990676099, 'E-Space , VIP Road , Surat , India.', 'Gujarat', '1631333733870.jpg', 'download (1).png', '2024-01-11 09:27:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company_ledger`
--

DROP TABLE IF EXISTS `tbl_company_ledger`;
CREATE TABLE IF NOT EXISTS `tbl_company_ledger` (
  `company_ledger_id` bigint NOT NULL AUTO_INCREMENT,
  `related_id` bigint NOT NULL,
  `related_obj` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `credit` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `debit` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `company_ledger_date` date NOT NULL,
  `financial_year_id` bigint NOT NULL,
  PRIMARY KEY (`company_ledger_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_company_ledger`
--

INSERT INTO `tbl_company_ledger` (`company_ledger_id`, `related_id`, `related_obj`, `description`, `credit`, `debit`, `company_ledger_date`, `financial_year_id`) VALUES
(1, 29, '', 'kkljkkoj;', '', '', '2024-02-29', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_driver`
--

DROP TABLE IF EXISTS `tbl_driver`;
CREATE TABLE IF NOT EXISTS `tbl_driver` (
  `driver_id` bigint NOT NULL AUTO_INCREMENT,
  `driver_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mobile` bigint NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_by` bigint NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`driver_id`),
  UNIQUE KEY `driver_name` (`driver_name`),
  UNIQUE KEY `mobile` (`mobile`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_driver`
--

INSERT INTO `tbl_driver` (`driver_id`, `driver_name`, `mobile`, `email`, `is_active`, `created_by`, `added_date`) VALUES
(2, 'MAHESH', 8521479632, 'mahesh@gmail.com', 1, 4, '2024-01-29 08:02:26'),
(3, 'Ramesh Sharma', 7896523146, 'ramesh@gmail.comm', 0, 4, '2024-01-29 08:30:57'),
(5, 'Manish Bhai ', 7456321012, 'manish@gmail.com', 0, 4, '2024-02-05 09:52:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expense`
--

DROP TABLE IF EXISTS `tbl_expense`;
CREATE TABLE IF NOT EXISTS `tbl_expense` (
  `expense_id` bigint NOT NULL AUTO_INCREMENT,
  `expense_type_id` bigint NOT NULL,
  `expense_invoice_no` bigint NOT NULL,
  `expense_invoice_date` date NOT NULL,
  `expense_amount` bigint NOT NULL,
  `expense_description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `expense_photo` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `payment_type_id` bigint NOT NULL,
  `financial_year_id` bigint NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`expense_id`),
  UNIQUE KEY `expense_invoice_no` (`expense_invoice_no`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_expense`
--

INSERT INTO `tbl_expense` (`expense_id`, `expense_type_id`, `expense_invoice_no`, `expense_invoice_date`, `expense_amount`, `expense_description`, `expense_photo`, `payment_type_id`, `financial_year_id`, `added_date`) VALUES
(34, 3, 1, '2024-02-16', 75000, 'Tour For Bussiness FR', '1631333733870.jpg', 1, 2, '2024-02-02 12:46:23'),
(37, 6, 2, '2024-02-02', 6500, 'Filling the Disel in truck', '', 1, 2, '2024-02-02 15:07:58'),
(38, 7, 3, '2024-02-23', 75000000, 'Mink ka kharcha', '', 4, 2, '2024-02-05 10:47:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expense_type`
--

DROP TABLE IF EXISTS `tbl_expense_type`;
CREATE TABLE IF NOT EXISTS `tbl_expense_type` (
  `expense_type_id` bigint NOT NULL AUTO_INCREMENT,
  `expense_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` bigint NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`expense_type_id`),
  UNIQUE KEY `expense_type` (`expense_type`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_expense_type`
--

INSERT INTO `tbl_expense_type` (`expense_type_id`, `expense_type`, `created_by`, `added_date`) VALUES
(2, 'Holdings', 4, '2024-01-30 05:58:27'),
(3, 'travelling', 4, '2024-01-30 06:02:19'),
(6, 'Vehicle', 1, '2024-02-02 04:45:17'),
(7, 'Big Disastert', 4, '2024-02-05 08:15:48'),
(9, 'Tea', 4, '2024-02-06 16:41:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_financial_year`
--

DROP TABLE IF EXISTS `tbl_financial_year`;
CREATE TABLE IF NOT EXISTS `tbl_financial_year` (
  `financial_year_id` bigint NOT NULL AUTO_INCREMENT,
  `financial_year` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_default` tinyint(1) NOT NULL,
  `created_by` bigint NOT NULL,
  PRIMARY KEY (`financial_year_id`),
  UNIQUE KEY `financial_year` (`financial_year`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_financial_year`
--

INSERT INTO `tbl_financial_year` (`financial_year_id`, `financial_year`, `start_date`, `end_date`, `is_default`, `created_by`) VALUES
(2, '2023-2024', '2023-04-01', '2024-03-31', 1, 4),
(3, '2024-2025', '2024-04-01', '2025-03-31', 0, 4),
(4, '2025-2026', '2025-04-01', '2026-03-31', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gsm`
--

DROP TABLE IF EXISTS `tbl_gsm`;
CREATE TABLE IF NOT EXISTS `tbl_gsm` (
  `gsm_id` bigint NOT NULL AUTO_INCREMENT,
  `gsm_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` bigint NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`gsm_id`),
  UNIQUE KEY `gsm_name` (`gsm_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_gsm`
--

INSERT INTO `tbl_gsm` (`gsm_id`, `gsm_name`, `created_by`, `added_date`) VALUES
(1, '18%', 4, '2024-01-24 15:00:44'),
(3, '20%', 4, '2024-01-24 15:16:03'),
(6, '', 4, '2024-02-09 11:37:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gst_slab`
--

DROP TABLE IF EXISTS `tbl_gst_slab`;
CREATE TABLE IF NOT EXISTS `tbl_gst_slab` (
  `gst_slab_id` bigint NOT NULL AUTO_INCREMENT,
  `gst_slab_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cgst` decimal(18,2) NOT NULL,
  `sgst` decimal(18,2) NOT NULL,
  `igst` decimal(18,2) NOT NULL,
  `created_by` bigint NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`gst_slab_id`),
  UNIQUE KEY `gst_slab_name` (`gst_slab_name`),
  UNIQUE KEY `cgst` (`cgst`),
  UNIQUE KEY `sgst` (`sgst`),
  UNIQUE KEY `igst` (`igst`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_gst_slab`
--

INSERT INTO `tbl_gst_slab` (`gst_slab_id`, `gst_slab_name`, `cgst`, `sgst`, `igst`, `created_by`, `added_date`) VALUES
(2, 'GSTIN', 18.00, 21.00, 20.00, 4, '2024-01-24 16:34:22'),
(3, 'GSNUM', 18.21, 16.21, 75.25, 4, '2024-01-24 16:34:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_income`
--

DROP TABLE IF EXISTS `tbl_income`;
CREATE TABLE IF NOT EXISTS `tbl_income` (
  `income_id` bigint NOT NULL AUTO_INCREMENT,
  `income_type_id` bigint NOT NULL,
  `income_invoice_no` bigint NOT NULL,
  `income_invoice_date` date NOT NULL,
  `income_amount` bigint NOT NULL,
  `income_description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `income_photo` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `payment_type_id` bigint NOT NULL,
  `financial_year_id` bigint NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`income_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_income`
--

INSERT INTO `tbl_income` (`income_id`, `income_type_id`, `income_invoice_no`, `income_invoice_date`, `income_amount`, `income_description`, `income_photo`, `payment_type_id`, `financial_year_id`, `added_date`) VALUES
(3, 2, 1, '2024-02-02', 74000, 'New Sales', '', 4, 2, '2024-02-02 15:55:18'),
(7, 3, 2, '2024-02-05', 85000, 'Goodwill Recived by Last King', '', 6, 2, '2024-02-05 15:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_income_type`
--

DROP TABLE IF EXISTS `tbl_income_type`;
CREATE TABLE IF NOT EXISTS `tbl_income_type` (
  `income_type_id` bigint NOT NULL AUTO_INCREMENT,
  `income_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` bigint NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`income_type_id`),
  UNIQUE KEY `income_type` (`income_type`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_income_type`
--

INSERT INTO `tbl_income_type` (`income_type_id`, `income_type`, `created_by`, `added_date`) VALUES
(2, 'Sales', 4, '2024-01-30 08:33:33'),
(3, 'Goodwill', 4, '2024-02-05 08:43:15'),
(5, 'Computer Sell', 4, '2024-02-06 06:30:45'),
(8, 'Newspaper Sell', 4, '2024-02-09 15:07:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_party`
--

DROP TABLE IF EXISTS `tbl_party`;
CREATE TABLE IF NOT EXISTS `tbl_party` (
  `party_id` bigint NOT NULL AUTO_INCREMENT,
  `party_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `party_type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contact_no` bigint NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `op_balance` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `discount` decimal(18,2) NOT NULL,
  `state_id` bigint NOT NULL,
  `gstin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_by` bigint NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`party_id`),
  UNIQUE KEY `party_name` (`party_name`),
  UNIQUE KEY `contact_no` (`contact_no`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `gstin` (`gstin`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_party`
--

INSERT INTO `tbl_party` (`party_id`, `party_name`, `party_type`, `contact_no`, `email`, `op_balance`, `address`, `discount`, `state_id`, `gstin`, `is_active`, `created_by`, `added_date`) VALUES
(1, 'Prabhat Mishra', 'Supplier', 7990676099, 'mprabhat@gmail.com', '78930', 'Orchid Greens', 41.00, 1, '7412365', 1, 4, '2024-01-27 14:46:08'),
(4, 'Deep Pandya', 'Supplier', 6325417896, 'deep@gmail.com', '7836', 'Adajan,Surat,395009', 78.23, 4, 'AFG4563217', 0, 4, '2024-01-29 06:15:51'),
(23, 'Anup Mishra', 'Customer', 7874063236, 'anup@gmail.com', '851', 'A-203', 0.00, 4, 'ANNN856', 0, 4, '2024-02-09 14:17:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_type`
--

DROP TABLE IF EXISTS `tbl_payment_type`;
CREATE TABLE IF NOT EXISTS `tbl_payment_type` (
  `payment_type_id` bigint NOT NULL AUTO_INCREMENT,
  `payment_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` bigint NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`payment_type_id`),
  UNIQUE KEY `payment_type` (`payment_type`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_payment_type`
--

INSERT INTO `tbl_payment_type` (`payment_type_id`, `payment_type`, `created_by`, `added_date`) VALUES
(1, 'Cash', 4, '2024-01-27 06:57:35'),
(3, 'Google Pay', 4, '2024-01-27 07:03:13'),
(4, 'Cheque', 4, '2024-01-27 07:10:49'),
(6, 'NEFT', 4, '2024-02-05 08:00:50'),
(9, 'Credit Card', 4, '2024-02-09 14:53:50'),
(11, 'Debit Card', 4, '2024-02-09 14:55:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quality`
--

DROP TABLE IF EXISTS `tbl_quality`;
CREATE TABLE IF NOT EXISTS `tbl_quality` (
  `quality_id` bigint NOT NULL AUTO_INCREMENT,
  `quality_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` bigint NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`quality_id`),
  UNIQUE KEY `quality_name` (`quality_name`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_quality`
--

INSERT INTO `tbl_quality` (`quality_id`, `quality_name`, `created_by`, `added_date`) VALUES
(1, 'GOLD', 4, '2024-01-24 10:02:11'),
(3, 'SILVER', 4, '2024-01-24 10:10:28'),
(8, 'METAL', 4, '2024-01-24 14:41:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_size`
--

DROP TABLE IF EXISTS `tbl_size`;
CREATE TABLE IF NOT EXISTS `tbl_size` (
  `size_id` bigint NOT NULL AUTO_INCREMENT,
  `size_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` bigint NOT NULL,
  PRIMARY KEY (`size_id`),
  UNIQUE KEY `size_name` (`size_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_size`
--

INSERT INTO `tbl_size` (`size_id`, `size_name`, `added_date`, `created_by`) VALUES
(3, '7ltr', '2024-01-24 09:37:40', 4),
(4, 'xxll', '2024-02-05 06:57:28', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state`
--

DROP TABLE IF EXISTS `tbl_state`;
CREATE TABLE IF NOT EXISTS `tbl_state` (
  `state_id` bigint NOT NULL AUTO_INCREMENT,
  `state_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_state`
--

INSERT INTO `tbl_state` (`state_id`, `state_name`) VALUES
(1, 'Gujarat'),
(2, 'Andhra Pradesh'),
(3, 'Bihar'),
(4, 'Assam'),
(5, 'Goa'),
(6, 'Madhya Pradesh');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transport`
--

DROP TABLE IF EXISTS `tbl_transport`;
CREATE TABLE IF NOT EXISTS `tbl_transport` (
  `transport_id` bigint NOT NULL AUTO_INCREMENT,
  `vehicle_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `vehicle_no` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_by` bigint NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`transport_id`),
  UNIQUE KEY `vehicle_name` (`vehicle_name`),
  UNIQUE KEY `vehicle_no` (`vehicle_no`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_transport`
--

INSERT INTO `tbl_transport` (`transport_id`, `vehicle_name`, `vehicle_no`, `is_active`, `created_by`, `added_date`) VALUES
(2, 'MARUTI', 'GJ05KL4856', 1, 4, '2024-01-29 09:03:08'),
(3, 'TATA Truck', 'GJ06LK1230', 0, 4, '2024-01-29 11:28:11'),
(7, 'CIAZ', 'GJ05CN1783', 1, 4, '2024-02-05 10:17:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` bigint NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` bigint NOT NULL,
  `username` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `user_profile` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `full_name` (`full_name`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `full_name`, `email`, `phone`, `username`, `password`, `is_active`, `is_admin`, `user_profile`, `added_date`) VALUES
(1, 'TRYON INFOSFT', 'admin@gmail.com', 1234567890, 'tryon', '4562', 1, 1, 'user.png', '2024-01-23 08:37:52'),
(4, 'Prabhat Mishra', 'mprabhat@gmail.com', 7874063236, 'prabhat', '1230', 1, 0, 'wallpapersden.com_satoru-gojo-cool-jujutsu-kaisen-hd_1920x1080.jpg', '2024-01-09 09:58:10'),
(7, 'Roshan Dhanavade', 'roshan@gmail.com', 7410236585, 'admin', '4560', 1, 0, '1631333733870.jpg', '2024-01-14 15:29:36'),
(14, 'Ayush Mishra', 'ayush@gmail.com', 7410236588, 'ayush@admin', '74123', 1, 0, 'DecItRbV4AIwbpO.jpg', '2024-01-16 16:34:24'),
(18, 'Mink', 'mink@gmail.com', 7410236589, 'mink', '1010', 1, 0, '9070206.png', '2024-01-17 08:42:00'),
(22, 'Chandan', 'chandan@gmail.com', 7456321025, 'chandan', '7410', 0, 0, 'civil-construction-services-1530505022-4044360.jpeg', '2024-01-19 07:31:41'),
(26, 'Prashant Mishra', 'prashant@gmail.com', 8741236589, 'p@admin', '45620', 1, 0, 'a47eb4acfa1b04ed8957bb88f4a57f6f.jpg', '2024-01-22 07:35:05');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
