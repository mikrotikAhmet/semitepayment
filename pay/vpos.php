<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * @package     EGC Services Ltd
 * @version     $Id: vpos.php Aug 18, 2014 ahmet
 * @copyright   Copyright (c) 2014 EGC Services Ltd .
 * @license     http://www.semiteproject.com/license/
 */
/**
 * Description of vpos.php
 *
 * @author ahmet
 */

$client = new SoapClient("https://www.e-tahsildar.com.tr/NetProvWS/NetProvWS.asmx?wsdl");

$params = array(
    'pOrgNo' => '009',
    'pFirmNo' => '9709410',
    'pTermNo' => '00063059',
    'pCardNo' => '4183404032416286',
    'pCvv2No' => '062',
    'pExpiry' => '201511',
    'pCurrency'=> '949',
    'pAmount' => '1.00',
    'pTaksit' => '0'
);
$result = $client->GetAuthorizationInstTrn($params);
$res = $result->GetAuthorizationInstTrnResult;

var_dump($res);
//
//$pOrgNo = "009";
//$pFirmNo = "9709410";
//$pTermNo = "00063059";
//$pCardNo = "4183404032416286";
//$pAmount = "1";
//$MerchanKey = "Jhf2DuN4";
//$pCVV2 = "062";
//$pExpDate = "201511";
//
//$h = $pOrgNo.$pFirmNo.$pTermNo.$pCardNo.$pAmount.$MerchanKey;
//
//$pHashB64 = base64_encode(sha1($h));
//$pHashHex = str2hex(sha1($h));
//        
//function hex2str( $hex ) {
//  return pack('H*', $hex);
//}
//
//function str2hex( $str ) {
//  return array_shift( unpack('H*', $str) );
//}

?>
<!--<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" >
<HTML>
	<HEAD>
		<title>PostToMPI</title>
		<meta http-equiv="Content-Language" content="tr">
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-9">
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="Expires" content="now">
	</HEAD>
	<body>
		<form id="PostToMPI" name="PostToMPI" method="post" action="https://www.e-tahsildar.com.tr/V2/NetProvOrtakOdeme/NetProvPost.aspx">
			<input type="hidden" name="pOrgNo" runat="server" value="009"> 
			<input type="hidden" name="pFirmNo"  runat="server" value="9709410"> 
			<input type="hidden" name="pTermNo" runat="server" value="00063059">
			<input type="hidden" name="pAmount" runat="server" value="<?php echo $pAmount?>">
                        <input type="hidden" name="pCardNo" runat="server" value="<?php echo $pCardNo?>">
                        <input type="hidden" name="pCVV2" runat="server" value="<?php echo $pCVV2?>">
                        <input type="hidden" name="pCVV2" runat="server" value="<?php echo $pExpDate?>">
			<input type="hidden" name="pTaksit" runat="server" value="0">
			<input type="hidden" name="pXid" runat="server" value="00000000000000000005">
			<input type="hidden" name="pokUrl" runat="server" value="https://www.e-tahsildar.com.tr/V2/NetProvOrtakOdeme/ControlFields.aspx?Fail=false">
			<input type="hidden" name="pfailUrl" runat="server" value="https://www.e-tahsildar.com.tr/V2/NetProvOrtakOdeme/ControlFields.aspx?Fail=true">
			<input type="hidden" name="pMPI3D" runat="server" value="true">
                        <input type="hidden" name=" pHashB64 " runat="server" value="">
                        <input type="hidden" name=" pHashHex " runat="server" value="<?php echo $pHashHex?>" >
			<input type="submit" name="Submit" value="Submit">
		</form>
	</body>
</HTML>-->
