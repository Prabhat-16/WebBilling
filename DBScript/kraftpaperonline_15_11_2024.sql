-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 14, 2024 at 06:30 PM
-- Server version: 8.0.40
-- PHP Version: 8.2.18

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
DROP PROCEDURE IF EXISTS `deleteCashMemo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteCashMemo` (IN `CMID` BIGINT(20))   BEGIN
	DELETE FROM tbl_cash_memo WHERE  cash_memo_id = CMID;
END$$

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

DROP PROCEDURE IF EXISTS `deleteItem`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteItem` (IN `IID` BIGINT(20))   BEGIN
	DELETE FROM tbl_item WHERE  item_id  = IID;
END$$

DROP PROCEDURE IF EXISTS `deleteParty`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteParty` (IN `PID` BIGINT(20))   BEGIN
	DELETE FROM tbl_party WHERE party_id  = PID;
END$$

DROP PROCEDURE IF EXISTS `deletePaymentType`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deletePaymentType` (IN `PID` BIGINT(20))   BEGIN
	DELETE FROM tbl_payment_type WHERE payment_type_id   = PID;
END$$

DROP PROCEDURE IF EXISTS `deletePurchaseInvoice`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deletePurchaseInvoice` (IN `PIID` BIGINT(20))   BEGIN
	DELETE FROM tbl_purchase_invoice WHERE purchase_invoice_id = PIID;
END$$

DROP PROCEDURE IF EXISTS `deleteQuality`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteQuality` (IN `QID` BIGINT(20))   BEGIN
	DELETE FROM tbl_quality WHERE quality_id = QID;
END$$

DROP PROCEDURE IF EXISTS `deleteSalesInvoice`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteSalesInvoice` (IN `SIID` BIGINT(20))   BEGIN
	DELETE FROM tbl_sales_invoice WHERE sales_invoice_id = SIID;
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

DROP PROCEDURE IF EXISTS `fetchCashMemo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchCashMemo` (IN `CMID` BIGINT(20))   BEGIN
	SELECT * FROM tbl_cash_memo WHERE cash_memo_id  = CMID;
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

DROP PROCEDURE IF EXISTS `fetchItem`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchItem` (IN `IID` BIGINT(20))   BEGIN
	SELECT * FROM tbl_item WHERE item_id  = IID;
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

DROP PROCEDURE IF EXISTS `insertItem`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertItem` (IN `INAME` VARCHAR(30), IN `QID` BIGINT(20), IN `CID` BIGINT(20), IN `SID` VARCHAR(100), IN `GID` VARCHAR(100), IN `GSTID` BIGINT(20), IN `QTY` BIGINT(50), IN `AMT` BIGINT(100), IN `OPSTOCK` BIGINT(50), IN `ISACTIVE` TINYINT(1), IN `ITEMPHOTO` VARCHAR(2000), IN `UID` BIGINT(20))   BEGIN
	INSERT INTO tbl_item (item_name,quality_id,category_id,size_id,gsm_id,gst_slab_id,quantity,amount,op_stock,is_active,item_photo,created_by) VALUE (INAME,QID,CID,SID,GID,GSTID,QTY,AMT,OPSTOCK,ISACTIVE,ITEMPHOTO,UID);
END$$

DROP PROCEDURE IF EXISTS `insertParty`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertParty` (IN `PNAME` VARCHAR(50), IN `PTYPE` VARCHAR(10), IN `CNO` BIGINT(15), IN `EMAIl` VARCHAR(50), IN `OBAL` VARCHAR(7), IN `ADDRESS` VARCHAR(500), IN `DISCOUNT` DECIMAL(18,2), IN `SID` BIGINT(20), IN `GST` VARCHAR(50), IN `PTY` BIGINT(50), IN `CTP` BIGINT(50), IN `ISACTIVE` TINYINT(1), IN `UID` BIGINT(20))   BEGIN
	INSERT INTO tbl_party (party_name,party_type,contact_no,email,op_balance,address,discount,state_id,gstin,penalty,credit_period,is_active,created_by) VALUE (PNAME,PTYPE,CNO,EMAIL,OBAL,ADDRESS,DISCOUNT,SID,GST,PTY,CTP,ISACTIVE,UID);
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertUser` (IN `FNAME` VARCHAR(100), IN `EMAIL` VARCHAR(100), IN `PHONE` BIGINT(10), IN `USERNAME` VARCHAR(25), IN `PWD` VARCHAR(255), IN `ISACTIVE` TINYINT(1), IN `ISADMIN` TINYINT(1), IN `UPROFILE` VARCHAR(2000), IN `UID` BIGINT(20))   BEGIN
	INSERT INTO tbl_user(full_name,email,phone,username,password,is_active,is_admin,user_profile,created_by) VALUE (FNAME,EMAIL,PHONE,USERNAME,PWD,ISACTIVE,ISADMIN,UPROFILE,UID);
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

DROP PROCEDURE IF EXISTS `updateItem`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateItem` (IN `IID` BIGINT(20), IN `INAME` VARCHAR(30), IN `QID` BIGINT(20), IN `CID` BIGINT(20), IN `SID` VARCHAR(100), IN `GID` VARCHAR(100), IN `GSTID` BIGINT(20), IN `QTY` BIGINT(50), IN `AMT` BIGINT(100), IN `OPSTOCK` BIGINT(50), IN `ISACTIVE` TINYINT(1), IN `ITEMPHOTO` VARCHAR(2000), IN `UID` BIGINT(20))   BEGIN
	UPDATE tbl_item SET item_name  = INAME , quality_id = QID , category_id = CID , size_id = SID , gsm_id = GID , gst_slab_id = GSTID , quantity = QTY , amount = AMT , op_stock = OPSTOCK  ,  is_active = ISACTIVE , item_photo = ITEMPHOTO , created_by = UID WHERE item_id = IID;
END$$

DROP PROCEDURE IF EXISTS `updateParty`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateParty` (IN `PID` BIGINT(20), IN `PNAME` VARCHAR(50), IN `PTYPE` VARCHAR(10), IN `CNO` BIGINT(15), IN `EMAIL` VARCHAR(50), IN `OBAL` VARCHAR(7), IN `ADDRESS` VARCHAR(500), IN `DISCOUNT` DECIMAL(18,2), IN `SID` BIGINT(20), IN `GST` VARCHAR(50), IN `PTY` BIGINT(50), IN `CTP` BIGINT(50), IN `ISACTIVE` TINYINT(1), IN `UID` BIGINT(20))   BEGIN
	UPDATE tbl_party SET party_name = PNAME , party_type = PTYPE , contact_no = CNO , email = EMAIL, op_balance = OBAL , address = ADDRESS , discount = DISCOUNT , state_id = SID , gstin = GST , penalty = PTY , credit_period = CTP ,  is_active = ISACTIVE , created_by = UID WHERE party_id  = PID;
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateUser` (IN `UID` BIGINT(20), IN `FNAME` VARCHAR(100), IN `EMAIL` VARCHAR(100), IN `PHONE` BIGINT(10), IN `USERNAME` VARCHAR(25), IN `ISACTIVE` TINYINT(1), IN `UPROFILE` VARCHAR(2000), IN `UIDD` BIGINT(20))   BEGIN
	UPDATE tbl_user SET full_name = FNAME , email = EMAIL , phone = PHONE , username = USERNAME ,  is_active = ISACTIVE , user_profile = UPROFILE , created_by = UIDD WHERE user_id = UID;
END$$

DROP PROCEDURE IF EXISTS `viewCashMemo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `viewCashMemo` ()   BEGIN
	SELECT tcm.*,tpy.payment_type
	FROM tbl_cash_memo tcm
	LEFT JOIN tbl_payment_type tpy ON tcm.payment_type_id = tpy.payment_type_id
 ORDER BY invoice_no DESC;
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
	WHERE te.financial_year_id = (SELECT financial_year_id FROM tbl_financial_year WHERE is_default = 1)
    ORDER BY expense_invoice_no DESC;
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

DROP PROCEDURE IF EXISTS `viewItem`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `viewItem` ()   BEGIN
	SELECT ti.*, tq.quality_name , tc.category_name , ts.size_name , tg.gsm_name
	FROM tbl_item ti
	LEFT JOIN tbl_quality tq ON ti.quality_id = tq.quality_id
	LEFT JOIN tbl_category tc ON ti.category_id = tc.category_id
	LEFT JOIN tbl_size ts ON ti.size_id = ts.size_id
	LEFT JOIN tbl_gsm tg ON ti.gsm_id = tg.gsm_id
    ;
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
-- Table structure for table `tbl_cash_memo`
--

DROP TABLE IF EXISTS `tbl_cash_memo`;
CREATE TABLE IF NOT EXISTS `tbl_cash_memo` (
  `cash_memo_id` bigint NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(50) NOT NULL,
  `mobile_no` bigint NOT NULL,
  `invoice_no` bigint NOT NULL,
  `cash_memo_date` date NOT NULL,
  `narration` varchar(100) NOT NULL,
  `sub_total` decimal(18,2) NOT NULL,
  `pay` decimal(18,2) NOT NULL,
  `place_of_supply_id` bigint NOT NULL,
  `payment_type_id` bigint NOT NULL,
  `financial_year_id` bigint NOT NULL,
  `created_by` bigint NOT NULL,
  PRIMARY KEY (`cash_memo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_cash_memo`
--

INSERT INTO `tbl_cash_memo` (`cash_memo_id`, `customer_name`, `mobile_no`, `invoice_no`, `cash_memo_date`, `narration`, `sub_total`, `pay`, `place_of_supply_id`, `payment_type_id`, `financial_year_id`, `created_by`) VALUES
(32, 'Minakshi', 45632101452, 5, '2024-03-13', 'For testing', 108800.00, 10.00, 1, 4, 2, 4),
(31, 'Roshan ', 7456321012, 4, '2024-03-13', 'For New Purchase', 116712.00, 10000.00, 6, 1, 2, 4),
(21, 'Prabhat Mishra', 7874063236, 1, '2024-03-04', 'Testing For All Round', 17013.00, 14594.00, 1, 1, 2, 4),
(22, 'Meet Panchal', 9632587412, 2, '2024-03-04', 'Given Cash For Raw Material', 478907.50, 249749.25, 3, 6, 2, 4),
(27, 'Last King', 7412365896, 3, '2024-03-05', 'Testing For On Chnage ', 6191703.00, 67000.00, 2, 4, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cash_memo_detail`
--

DROP TABLE IF EXISTS `tbl_cash_memo_detail`;
CREATE TABLE IF NOT EXISTS `tbl_cash_memo_detail` (
  `cash_memo_detail_id` bigint NOT NULL AUTO_INCREMENT,
  `cash_memo_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `qty` decimal(18,2) NOT NULL,
  `rate` decimal(18,2) NOT NULL,
  `discount_per` decimal(18,2) NOT NULL,
  `discount_amt` decimal(18,2) NOT NULL,
  `gst_per` decimal(18,2) NOT NULL,
  `gst_amt` decimal(18,2) NOT NULL,
  `financial_year_id` decimal(18,2) NOT NULL,
  PRIMARY KEY (`cash_memo_detail_id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_cash_memo_detail`
--

INSERT INTO `tbl_cash_memo_detail` (`cash_memo_detail_id`, `cash_memo_id`, `product_id`, `qty`, `rate`, `discount_per`, `discount_amt`, `gst_per`, `gst_amt`, `financial_year_id`) VALUES
(47, 22, 21, 100.00, 2500.00, 5.00, 12500.00, 0.00, 0.00, 2.00),
(58, 27, 22, 15.00, 412300.00, 10.00, 618450.00, 10.00, 556605.00, 2.00),
(46, 21, 1, 10.00, 20.00, 1.00, 2.00, 0.00, 0.00, 2.00),
(59, 21, 21, 10.00, 1500.00, 5.00, 750.00, 18.00, 2565.00, 2.00),
(57, 27, 21, 15.00, 1500.00, 1.00, 225.00, 12.00, 2673.00, 2.00),
(60, 22, 23, 25.00, 8500.00, 2.00, 4250.00, 12.00, 24990.00, 2.00),
(69, 32, 23, 10.00, 8500.00, 0.00, 0.00, 28.00, 23800.00, 2.00),
(56, 27, 1, 10.00, 4500.00, 2.00, 900.00, 0.00, 0.00, 2.00),
(48, 22, 1, 50.00, 150.00, 1.00, 75.00, 10.00, 742.50, 2.00),
(68, 31, 1, 2.00, 4500.00, 0.00, 0.00, 0.00, 0.00, 2.00),
(67, 31, 23, 10.00, 8500.00, 1.00, 850.00, 28.00, 23562.00, 2.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cash_memo_return`
--

DROP TABLE IF EXISTS `tbl_cash_memo_return`;
CREATE TABLE IF NOT EXISTS `tbl_cash_memo_return` (
  `cash_memo_return_id` bigint NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mobile_no` bigint NOT NULL,
  `invoice_no` bigint NOT NULL,
  `cash_memo_return_date` date NOT NULL,
  `narration` varchar(200) NOT NULL,
  `sub_total` decimal(18,2) NOT NULL,
  `pay` decimal(18,2) NOT NULL,
  `place_of_supply_id` bigint NOT NULL,
  `payment_type_id` bigint NOT NULL,
  `financial_year_id` bigint NOT NULL,
  `created_by` bigint NOT NULL,
  PRIMARY KEY (`cash_memo_return_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cash_memo_return_detail`
--

DROP TABLE IF EXISTS `tbl_cash_memo_return_detail`;
CREATE TABLE IF NOT EXISTS `tbl_cash_memo_return_detail` (
  `cash_memo_return_detail_id` bigint NOT NULL AUTO_INCREMENT,
  `cash_memo_return_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `qty` decimal(18,2) NOT NULL,
  `rate` decimal(18,2) NOT NULL,
  `discount_per` decimal(18,2) NOT NULL,
  `discount_amt` decimal(18,2) NOT NULL,
  `gst_per` decimal(18,2) NOT NULL,
  `gst_amt` decimal(18,2) NOT NULL,
  `financial_year_id` bigint NOT NULL,
  PRIMARY KEY (`cash_memo_return_detail_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_code`, `category_name`, `is_active`, `created_by`, `added_date`) VALUES
(3, '90876AQ', 'T-Shirt', 1, 0, '2024-01-24 06:34:19'),
(4, '098iok', 'BURGER', 0, 0, '2024-01-24 06:58:07'),
(7, 'O245', 'PIZZA', 1, 4, '2024-01-24 07:19:01'),
(8, 'QWE1238', 'Shirt', 1, 4, '2024-01-24 09:30:32'),
(92, '784QWE', 'NEW', 0, 4, '2024-02-12 12:18:47'),
(94, 'QWR1230', 'OLD', 1, 4, '2024-02-25 12:55:26'),
(96, 'QWE345', 'ROUGH', 1, 4, '2024-03-20 12:08:15');

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
  `credit` decimal(18,2) NOT NULL,
  `debit` decimal(18,2) NOT NULL,
  `company_ledger_date` date NOT NULL,
  `financial_year_id` bigint NOT NULL,
  PRIMARY KEY (`company_ledger_id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_company_ledger`
--

INSERT INTO `tbl_company_ledger` (`company_ledger_id`, `related_id`, `related_obj`, `description`, `credit`, `debit`, `company_ledger_date`, `financial_year_id`) VALUES
(5, 9, 'Income', 'Purchase:Invoice_no:1', 0.00, 3000.00, '2024-03-04', 2),
(7, 48, 'Expense', 'Expense For Employee Tea', 0.00, 1500.00, '2024-02-14', 2),
(8, 10, 'Income', 'Purchase:Invoice_no:1', 0.00, 3000.00, '2024-03-04', 2),
(9, 49, 'Expense', 'Expense holding for Advertising', 0.00, 8500.00, '2024-02-10', 2),
(10, 11, 'Income', 'Purchase:Invoice_no:1', 0.00, 3000.00, '2024-03-04', 2),
(42, 10, 'SO', 'Sales:Invoice_no:1', 1000.00, 0.00, '2024-03-04', 2),
(43, 22, 'PO', 'Purchase:Invoice_no:1', 0.00, 100000.00, '2024-03-04', 2),
(44, 21, 'CashMemo', 'CashMemo:Invoice_no:1', 0.00, 14594.00, '2024-03-04', 2),
(45, 23, 'PO', 'Purchase:Invoice_no:2', 0.00, 0.00, '2024-03-04', 2),
(46, 22, 'CashMemo', 'CashMemo:Invoice_no:2', 0.00, 249749.25, '2024-03-04', 2),
(49, 13, 'SO', 'Sales:Invoice_no:2', 576008.90, 0.00, '2024-03-04', 2),
(54, 27, 'CashMemo', 'CashMemo:Invoice_no:3', 0.00, 67000.00, '2024-03-05', 2),
(55, 24, 'PO', 'Purchase:Invoice_no:3', 0.00, 8950885.96, '2024-03-05', 2),
(56, 14, 'SO', 'Sales:Invoice_no:3', 100000.00, 0.00, '2024-03-05', 2),
(57, 50, 'Expense', 'Expense For Personal Coffee', 0.00, 1500.00, '2024-03-05', 2),
(58, 51, 'Expense', 'Expense Traveld For Bussiness', 0.00, 10000.00, '2024-03-04', 2),
(59, 13, 'Income', 'Income To Mukesh Bhaii', 12000.00, 0.00, '2024-03-05', 2),
(63, 25, 'PO', 'Purchase:Invoice_no:4', 0.00, 8500.00, '2024-03-07', 2),
(64, 31, 'CashMemo', 'CashMemo:Invoice_no:4', 0.00, 10000.00, '2024-03-13', 2),
(65, 32, 'CashMemo', 'CashMemo:Invoice_no:5', 0.00, 10.00, '2024-03-13', 2),
(66, 15, 'SO', 'Sales:Invoice_no:4', 115752.00, 0.00, '2024-03-14', 2),
(67, 52, 'Expense', 'Expense For Self', 0.00, 1400.00, '2024-03-27', 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_expense`
--

INSERT INTO `tbl_expense` (`expense_id`, `expense_type_id`, `expense_invoice_no`, `expense_invoice_date`, `expense_amount`, `expense_description`, `expense_photo`, `payment_type_id`, `financial_year_id`, `added_date`) VALUES
(48, 9, 1, '2024-02-14', 1500, 'For Employee Tea', '', 1, 2, '2024-02-14 12:23:42'),
(49, 2, 2, '2024-02-10', 8500, 'holding for Advertising', '', 3, 2, '2024-02-16 07:10:34'),
(50, 16, 3, '2024-03-05', 1500, 'For Personal Coffee', '', 1, 2, '2024-03-05 10:40:04'),
(51, 3, 4, '2024-03-04', 10000, 'Traveld For Bussiness', '', 11, 2, '2024-03-05 10:40:38'),
(52, 16, 5, '2024-03-27', 1400, 'For Self', '', 1, 2, '2024-03-27 09:28:17');

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_expense_type`
--

INSERT INTO `tbl_expense_type` (`expense_type_id`, `expense_type`, `created_by`, `added_date`) VALUES
(2, 'Holdings', 4, '2024-01-30 05:58:27'),
(3, 'travelling', 4, '2024-01-30 06:02:19'),
(6, 'Vehicle', 1, '2024-02-02 04:45:17'),
(7, 'Big Disastert', 4, '2024-02-05 08:15:48'),
(9, 'Tea', 4, '2024-02-06 16:41:46'),
(16, 'Coffee', 4, '2024-02-22 07:59:30');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_gsm`
--

INSERT INTO `tbl_gsm` (`gsm_id`, `gsm_name`, `created_by`, `added_date`) VALUES
(1, '18%', 4, '2024-01-24 15:00:44'),
(3, '20%', 4, '2024-01-24 15:16:03'),
(8, '19%', 4, '2024-02-12 08:59:04'),
(9, '21%', 4, '2024-02-20 06:22:38'),
(10, '22%', 4, '2024-02-20 06:23:26');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_gst_slab`
--

INSERT INTO `tbl_gst_slab` (`gst_slab_id`, `gst_slab_name`, `cgst`, `sgst`, `igst`, `created_by`, `added_date`) VALUES
(11, 'GST SLAB 12%', 6.00, 6.00, 12.00, 4, '2024-03-06 07:17:11'),
(12, 'GST SLAB 10%', 5.00, 5.00, 10.00, 4, '2024-03-06 07:18:57'),
(13, 'GST SLAB 18%', 9.00, 9.00, 18.00, 4, '2024-03-06 07:25:24'),
(14, 'GST SLAB 28%', 14.00, 14.00, 28.00, 4, '2024-03-06 07:28:31'),
(15, 'GST NILL', 0.00, 0.00, 0.00, 4, '2024-03-06 07:28:44');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_income`
--

INSERT INTO `tbl_income` (`income_id`, `income_type_id`, `income_invoice_no`, `income_invoice_date`, `income_amount`, `income_description`, `income_photo`, `payment_type_id`, `financial_year_id`, `added_date`) VALUES
(9, 3, 1, '2024-02-14', 45000, 'Goodwill Recived by Last King', '', 1, 2, '2024-02-14 08:21:42'),
(10, 2, 2, '2024-02-02', 45000, 'Sales To Prabhat Mishra a', '', 6, 2, '2024-02-16 07:08:36'),
(11, 10, 3, '2024-02-19', 45000, 'Sales Of Furniture To XYZ ', '', 4, 2, '2024-02-19 06:52:50'),
(13, 5, 4, '2024-03-05', 12000, 'To Mukesh Bhaii', '', 3, 2, '2024-03-05 10:43:30');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_income_type`
--

INSERT INTO `tbl_income_type` (`income_type_id`, `income_type`, `created_by`, `added_date`) VALUES
(2, 'Sales', 4, '2024-01-30 08:33:33'),
(3, 'Goodwill', 4, '2024-02-05 08:43:15'),
(5, 'Computer Sell', 4, '2024-02-06 06:30:45'),
(8, 'Newspaper Sell', 4, '2024-02-09 15:07:59'),
(10, 'Furniture Sell', 1, '2024-02-19 04:37:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

DROP TABLE IF EXISTS `tbl_item`;
CREATE TABLE IF NOT EXISTS `tbl_item` (
  `item_id` bigint NOT NULL AUTO_INCREMENT,
  `item_name` varchar(30) NOT NULL,
  `quality_id` bigint NOT NULL,
  `category_id` bigint NOT NULL,
  `size_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `gsm_id` varchar(100) NOT NULL,
  `gst_slab_id` bigint NOT NULL,
  `quantity` bigint NOT NULL,
  `amount` bigint NOT NULL,
  `op_stock` bigint NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `item_photo` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_by` bigint NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `item_name` (`item_name`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`item_id`, `item_name`, `quality_id`, `category_id`, `size_id`, `gsm_id`, `gst_slab_id`, `quantity`, `amount`, `op_stock`, `is_active`, `item_photo`, `created_by`, `added_date`) VALUES
(1, 'Kraft Paper', 8, 92, '7', '8', 12, 52, 4500, 456, 1, 'desktop-wallpaper-the-light-of-dawn-rays-dawn-sunlight-trees-autumn-orange-leaves-forest.jpg', 4, '2024-02-12 12:16:20'),
(23, 'Mix Gold Silver', 15, 94, '3,7', '1,10', 14, 20, 8500, 120, 1, '', 4, '2024-03-05 09:49:27'),
(21, 'Gold Kraft Paper NP', 1, 92, '3,7,8', '1,3,8', 13, 10, 1500, 120, 0, '', 4, '2024-02-25 12:46:56'),
(22, 'SILVER OLD Paper', 3, 94, '3', '1', 11, 12, 412300, 520, 1, '', 4, '2024-02-25 12:56:20'),
(24, 'Other Kraft  Paper', 15, 4, '3,7,8', '1,3,8', 12, 120, 500, 100, 1, '', 4, '2024-03-06 09:05:53');

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
  `penalty` bigint NOT NULL,
  `credit_period` bigint NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_by` bigint NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`party_id`),
  UNIQUE KEY `party_name` (`party_name`),
  UNIQUE KEY `contact_no` (`contact_no`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `gstin` (`gstin`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_party`
--

INSERT INTO `tbl_party` (`party_id`, `party_name`, `party_type`, `contact_no`, `email`, `op_balance`, `address`, `discount`, `state_id`, `gstin`, `penalty`, `credit_period`, `is_active`, `created_by`, `added_date`) VALUES
(1, 'Prabhat Mishra', 'Supplier', 7990676099, 'mprabhat@gmail.com', '78930', 'Orchid Greens', 41.00, 1, '7412365', 0, 40, 1, 4, '2024-01-27 14:46:08'),
(4, 'Deep Pandya', 'Supplier', 6325417896, 'deep@gmail.com', '7836', 'Adajan,Surat,395009', 78.23, 4, 'AFG4563217', 0, 60, 0, 4, '2024-01-29 06:15:51'),
(23, 'Anup Mishra', 'Customer', 7874063236, 'anup@gmail.com', '851', 'A-203', 0.00, 4, 'ANNN856', 0, 45, 0, 4, '2024-02-09 14:17:43'),
(24, 'Meet Panchal', 'Supplier', 8541236547, 'meet@gmail.com', '5200', 'Dindoli, Surat', 18.00, 1, 'ANI7845', 2000, 20, 1, 4, '2024-02-21 11:42:52'),
(27, 'Murtaza Motagam', 'Customer', 7412365890, 'murt@gmail.com', '520', 'Motagam', 5.00, 4, 'AKY-7456', 500, 60, 0, 4, '2024-02-22 05:51:46'),
(28, 'Minakshi Barabde', 'Supplier', 1236547890, 'mink@gmail.com', '0.00', 'Surat,Gujarat', 5.00, 5, 'AMINK78456', 0, 10, 1, 4, '2024-02-28 11:33:14'),
(30, 'LAST KING ', 'Customer', 9586817952, 'lastking@gmail.com', '0.00', 'A-204 Orchid Greens Opp Raj World , Surat', 50.00, 4, '22AAAAA0000A1Z5', 520, 25, 1, 4, '2024-03-04 17:46:26'),
(32, 'Harshit Mishra', 'Customer', 7456320125, 'harshit@gmail.com', '4562', 'Surat,gujarat,395509', 10.00, 1, 'AGFRY74563', 1450, 25, 1, 4, '2024-03-14 07:13:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_party_ledger`
--

DROP TABLE IF EXISTS `tbl_party_ledger`;
CREATE TABLE IF NOT EXISTS `tbl_party_ledger` (
  `party_ledger_id` bigint NOT NULL AUTO_INCREMENT,
  `party_type` varchar(20) NOT NULL,
  `party_id` bigint NOT NULL,
  `related_id` bigint NOT NULL,
  `related_obj_name` varchar(50) NOT NULL,
  `invoice_type` bigint NOT NULL,
  `invoice_no` bigint NOT NULL,
  `narration` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `credit` decimal(18,2) NOT NULL,
  `debit` decimal(18,2) NOT NULL,
  `party_ledger_date` date NOT NULL,
  `financial_year_id` bigint NOT NULL,
  `created_by` bigint NOT NULL,
  PRIMARY KEY (`party_ledger_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_party_ledger`
--

INSERT INTO `tbl_party_ledger` (`party_ledger_id`, `party_type`, `party_id`, `related_id`, `related_obj_name`, `invoice_type`, `invoice_no`, `narration`, `credit`, `debit`, `party_ledger_date`, `financial_year_id`, `created_by`) VALUES
(24, 'Customer', 30, 13, 'SO', 0, 2, 'Sales:Invoice_no:2', 576008.90, 0.00, '2024-03-04', 2, 4),
(25, 'Supplier', 24, 24, 'PO', 0, 3, 'Purchase:Invoice_no:3', 0.00, 8950885.96, '2024-03-05', 2, 4),
(21, 'Supplier', 4, 23, 'PO', 0, 2, 'Purchase:Invoice_no:2', 0.00, 0.00, '2024-03-04', 2, 4),
(19, 'Customer', 23, 10, 'SO', 0, 1, 'Sales:Invoice_no:1', 1000.00, 0.00, '2024-03-04', 2, 4),
(20, 'Supplier', 1, 22, 'PO', 0, 1, 'Purchase:Invoice_no:1', 0.00, 100000.00, '2024-03-04', 2, 4),
(26, 'Customer', 27, 14, 'SO', 0, 3, 'Sales:Invoice_no:3', 100000.00, 0.00, '2024-03-05', 2, 4),
(27, 'Supplier', 28, 25, 'PO', 0, 4, 'Purchase:Invoice_no:4', 0.00, 8500.00, '2024-03-07', 2, 4),
(28, 'Customer', 32, 15, 'SO', 0, 4, 'Sales:Invoice_no:4', 115752.00, 0.00, '2024-03-14', 2, 4);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `tbl_purchase_invoice`
--

DROP TABLE IF EXISTS `tbl_purchase_invoice`;
CREATE TABLE IF NOT EXISTS `tbl_purchase_invoice` (
  `purchase_invoice_id` bigint NOT NULL AUTO_INCREMENT,
  `party_id` bigint NOT NULL,
  `ref_order_no` varchar(50) NOT NULL,
  `invoice_no` bigint NOT NULL,
  `due_days` bigint NOT NULL,
  `purchase_date` date NOT NULL,
  `due_date` date NOT NULL,
  `narration` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `net_total` decimal(18,2) NOT NULL,
  `discount` decimal(18,2) NOT NULL,
  `pay` decimal(18,2) NOT NULL,
  `place_of_supply_id` bigint NOT NULL,
  `payment_type_id` bigint NOT NULL,
  `financial_year_id` bigint NOT NULL,
  `created_by` bigint NOT NULL,
  PRIMARY KEY (`purchase_invoice_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_purchase_invoice`
--

INSERT INTO `tbl_purchase_invoice` (`purchase_invoice_id`, `party_id`, `ref_order_no`, `invoice_no`, `due_days`, `purchase_date`, `due_date`, `narration`, `net_total`, `discount`, `pay`, `place_of_supply_id`, `payment_type_id`, `financial_year_id`, `created_by`) VALUES
(22, 1, 'S001', 1, 40, '2024-03-04', '2024-04-13', 'Final Testing', 836200.00, 20000.00, 100000.00, 1, 4, 2, 4),
(23, 4, 'S002', 2, 60, '2024-03-04', '2024-05-03', 'Purchasing  Raw Material', 117449.80, 1250.00, 0.00, 5, 11, 2, 4),
(24, 24, 'S003', 3, 20, '2024-03-05', '2024-03-25', 'Testing For On Change ', 8950885.96, 154378.00, 8950885.96, 3, 11, 2, 4),
(25, 28, '', 4, 10, '2024-03-07', '2024-03-17', 'Testing Purpose', 141332.50, 4425.00, 8500.00, 6, 3, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_invoice_detail`
--

DROP TABLE IF EXISTS `tbl_purchase_invoice_detail`;
CREATE TABLE IF NOT EXISTS `tbl_purchase_invoice_detail` (
  `purchase_invoice_detail_id` bigint NOT NULL AUTO_INCREMENT,
  `purchase_invoice_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `qty` decimal(18,2) NOT NULL,
  `rate` decimal(18,2) NOT NULL,
  `discount_per` decimal(18,2) NOT NULL,
  `discount_amt` decimal(18,2) NOT NULL,
  `gst_per` decimal(18,2) NOT NULL,
  `gst_amt` decimal(18,2) NOT NULL,
  `financial_year_id` bigint NOT NULL,
  PRIMARY KEY (`purchase_invoice_detail_id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_purchase_invoice_detail`
--

INSERT INTO `tbl_purchase_invoice_detail` (`purchase_invoice_detail_id`, `purchase_invoice_id`, `product_id`, `qty`, `rate`, `discount_per`, `discount_amt`, `gst_per`, `gst_amt`, `financial_year_id`) VALUES
(37, 23, 1, 1000.00, 10.00, 2.00, 200.00, 10.00, 980.00, 2),
(36, 23, 21, 100.00, 20.00, 1.00, 20.00, 28.00, 554.40, 2),
(39, 24, 23, 35.00, 8500.00, 2.00, 5950.00, 18.00, 52479.00, 2),
(38, 23, 22, 150.00, 30.00, 4.00, 180.00, 12.00, 518.40, 2),
(35, 22, 21, 50.00, 10000.00, 2.00, 10000.00, 28.00, 137200.00, 2),
(34, 22, 1, 200.00, 1000.00, 5.00, 10000.00, 10.00, 19000.00, 2),
(41, 24, 22, 18.00, 412300.00, 2.00, 148428.00, 18.00, 1309134.96, 2),
(40, 24, 1, 5.00, 4500.00, 0.00, 0.00, 10.00, 2250.00, 2),
(42, 23, 23, 10.00, 8500.00, 1.00, 850.00, 18.00, 15147.00, 2),
(43, 25, 23, 1.00, 8500.00, 0.00, 0.00, 0.00, 0.00, 2),
(44, 25, 1, 10.00, 4500.00, 1.50, 675.00, 10.00, 4432.50, 2),
(45, 25, 21, 50.00, 1500.00, 5.00, 3750.00, 18.00, 12825.00, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_quality`
--

INSERT INTO `tbl_quality` (`quality_id`, `quality_name`, `created_by`, `added_date`) VALUES
(1, 'GOLD', 4, '2024-01-24 10:02:11'),
(3, 'SILVER', 4, '2024-01-24 10:10:28'),
(8, 'METAL', 4, '2024-01-24 14:41:07'),
(15, 'GOLD + Silver', 4, '2024-02-12 08:53:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales_invoice`
--

DROP TABLE IF EXISTS `tbl_sales_invoice`;
CREATE TABLE IF NOT EXISTS `tbl_sales_invoice` (
  `sales_invoice_id` bigint NOT NULL AUTO_INCREMENT,
  `party_id` bigint NOT NULL,
  `ref_order_no` varchar(20) NOT NULL,
  `invoice_no` bigint NOT NULL,
  `due_days` bigint NOT NULL,
  `sales_date` date NOT NULL,
  `due_date` date NOT NULL,
  `narration` varchar(200) NOT NULL,
  `net_total` decimal(18,2) NOT NULL,
  `discount` decimal(18,2) NOT NULL,
  `pay` decimal(18,2) NOT NULL,
  `place_of_supply_id` bigint NOT NULL,
  `payment_type_id` bigint NOT NULL,
  `financial_year_id` bigint NOT NULL,
  `created_by` bigint NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sales_invoice_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_sales_invoice`
--

INSERT INTO `tbl_sales_invoice` (`sales_invoice_id`, `party_id`, `ref_order_no`, `invoice_no`, `due_days`, `sales_date`, `due_date`, `narration`, `net_total`, `discount`, `pay`, `place_of_supply_id`, `payment_type_id`, `financial_year_id`, `created_by`, `added_date`) VALUES
(10, 23, 'S001', 1, 45, '2024-03-04', '2024-04-18', 'All Testing', 23560.00, 204.00, 1000.00, 1, 1, 2, 4, '2024-03-04 13:38:35'),
(13, 30, 'S002', 2, 25, '2024-03-04', '2024-03-29', 'Sales For Goood Palers..', 576008.90, 10445.00, 576008.90, 4, 4, 2, 4, '2024-03-04 17:47:45'),
(14, 27, 'S003', 3, 60, '2024-03-05', '2024-05-04', 'Testing For All Purpose', 656528.50, 3000.00, 100000.00, 2, 1, 2, 4, '2024-03-05 10:27:46'),
(15, 32, 'S004', 4, 25, '2024-03-14', '2024-04-08', 'Good Sales For Kraft papers', 115752.00, 5225.00, 115752.00, 5, 11, 2, 4, '2024-03-14 07:14:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales_invoice_detail`
--

DROP TABLE IF EXISTS `tbl_sales_invoice_detail`;
CREATE TABLE IF NOT EXISTS `tbl_sales_invoice_detail` (
  `sales_invoice_detail_id` bigint NOT NULL AUTO_INCREMENT,
  `sales_invoice_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `qty` decimal(18,2) NOT NULL,
  `rate` decimal(18,2) NOT NULL,
  `discount_per` decimal(18,2) NOT NULL,
  `discount_amt` decimal(18,2) NOT NULL,
  `gst_per` decimal(18,2) NOT NULL,
  `gst_amt` decimal(18,2) NOT NULL,
  `financial_year_id` bigint NOT NULL,
  PRIMARY KEY (`sales_invoice_detail_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_sales_invoice_detail`
--

INSERT INTO `tbl_sales_invoice_detail` (`sales_invoice_detail_id`, `sales_invoice_id`, `product_id`, `qty`, `rate`, `discount_per`, `discount_amt`, `gst_per`, `gst_amt`, `financial_year_id`) VALUES
(17, 13, 22, 100.00, 5200.00, 2.00, 10400.00, 12.00, 61152.00, 2),
(11, 10, 21, 20.00, 1000.00, 1.00, 200.00, 18.00, 3564.00, 2),
(10, 10, 1, 10.00, 20.00, 2.00, 4.00, 0.00, 0.00, 2),
(18, 13, 21, 10.00, 450.00, 1.00, 45.00, 18.00, 801.90, 2),
(19, 14, 23, 15.00, 8500.00, 1.00, 1275.00, 10.00, 12622.50, 2),
(20, 14, 1, 5.00, 4500.00, 1.00, 225.00, 0.00, 0.00, 2),
(21, 14, 21, 20.00, 1500.00, 5.00, 1500.00, 18.00, 5130.00, 2),
(22, 14, 22, 1.00, 412300.00, 0.00, 0.00, 12.00, 49476.00, 2),
(23, 15, 1, 10.00, 4500.00, 10.00, 4500.00, 10.00, 4050.00, 2),
(24, 15, 23, 5.00, 8500.00, 1.00, 425.00, 28.00, 11781.00, 2),
(25, 15, 21, 10.00, 1500.00, 2.00, 300.00, 18.00, 2646.00, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_size`
--

INSERT INTO `tbl_size` (`size_id`, `size_name`, `added_date`, `created_by`) VALUES
(3, '7ltr', '2024-01-24 09:37:40', 4),
(4, 'xxll', '2024-02-05 06:57:28', 4),
(7, 'xxl', '2024-02-16 09:21:49', 4),
(8, '6Cm', '2024-02-20 05:12:52', 4),
(9, 'M', '2024-02-20 06:24:17', 4);

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
  `username` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `user_profile` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` bigint NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `full_name` (`full_name`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `full_name`, `email`, `phone`, `username`, `password`, `is_active`, `is_admin`, `user_profile`, `added_date`, `created_by`) VALUES
(1, 'TRYON INFOSOFT', 'tryoninfosoft@gmail.com', 7410236589, 'tryon', '$2y$10$qmEDT.KH6ZmQqJ6rggLZdeXttmzc2miSeNh9woixKeMeINVhySCBm', 1, 1, '1631333733870.jpg', '2024-02-17 17:10:24', 4),
(4, 'Prabhat Mishra', 'mprabhat846@gmail.com', 7874063236, 'prabhat', '$2y$10$Kx8LJnuVQCYkZFZLWiD1POM0nujT1b8s5GE02wk258GEFtCO52gIu', 1, 0, 'naruto_nine_tails-wallpaper-1920x1080.jpg', '2024-01-09 09:58:10', 4),
(57, 'Deep Pandya', 'deep@gmail.com', 6325874125, 'deep@123', '$2y$10$aXKW/Q99/8RXHRKgmWJoouBzq2ECR.iCiK866Bacishm89UU/.aWa', 0, 0, 'pexels-cesar-perez-733745.jpg', '2024-02-17 17:24:29', 4),
(61, 'Meet Panchal', 'meet@gmail.com', 7896541230, 'meet@123', '$2y$10$67yEEOT2ML4ktUvMRFGkWOyiDyH3EOixpzsphuN1vf/E6s8K2lWeK', 0, 0, '10466877.jpg', '2024-02-19 06:02:19', 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
