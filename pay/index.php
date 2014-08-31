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
 * @version     $Id: index.php Jul 11, 2014 ahmet
 * @copyright   Copyright (c) 2014 EGC Services Ltd .
 * @license     http://www.egamingc.com/license/
 */
/**
 * Description of index.php
 *
 * @author ahmet
 */
//if (isset($_POST['submit'])) {
//    require_once 'cc.php';
//
//    $data = $_POST;
//
//    $result = CallAPI('POST', 'http://lapi.semitepayment.com/v1/payment/pay', $data);
//
//    $output = json_decode($result);
//
//
//    echo '<pre>';
//    print_r($_GET);
//    print_r($output);
//    echo '</pre>';
//}

    $pOrgNo = "009";
    $pFirmNo = "9709410";
    $pTermNo = "00063059";
    $pAmount = "000000000001";
    $pCardNo = "";
    $pCVV2 = "";
    $pExpDate = "";
    $pTaksit = "0";
    $pSipNo = "000000000012345";
    $pXid = date("YmdHis") . rand(100000, 999999);
    $merchant = "Jhf2DuN4";
    $pokUrl = 'http://merchant.semitepayment.com';
    $pfailUrl = 'http://local.semitepayment.com/pay';
    ?>


<!DOCTYPE HTML>
<html lang="en-GB">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />

        <title>Semite Payment</title>

        <link rel="stylesheet" href="style.css">

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script type="text/javascript" src="jquery.creditCardValidator.js"></script>
        <script type="text/javascript" src="demo.js"></script>
    </head>
    <style>
        .demo a:hover{text-decoration: none}
    </style>
    <body>
        <div id="container">
            <div class="demo">
                <div style="width: 100px;margin: 0 auto;">
                    <a href="http://www.semitepayment.com"><img src="semite_logo.png"/></a>
                </div> 
                <form id="PostToMPI" name="PostToMPI" method="post" action="https://www.e-tahsildar.com.tr/V2/NetProvOrtakOdeme/NetProvPost.aspx"> 
                       
                    <input type="hidden" name="pOrgNo" value="<?php echo $pOrgNo?>" /> 
                        <input type="hidden" name="pFirmNo"  value="<?php echo $pFirmNo?>" /> 
                        <input type="hidden" name="pTermNo" value="<?php echo $pTermNo?>" /> 
                            <input type="hidden" name="pAmount" value="<?php echo $pAmount ?>" /> 
                            <input type="hidden" name="pTaksit" value="<?php echo $pTaksit?>" /> 
                            <input type="hidden" name="pXid" value="<?php echo $pXid?>" /> 
                            <input type="hidden" name="pokUrl" value="<?php echo $pokUrl?>" /> 
                            <input type="hidden" name="pfailUrl" value="<?php echo $pfailUrl?>" /> 
                            <input type="hidden" name="pHashB64" value="" /> 
                            <input type="hidden" name="pHashHex" value="" /> 
                            <input type="hidden" name="pSipNo" value="<?php echo $pSipNo?>"/> 
                            <input type="hidden" name="pCurrency" value="949"/> 
                            <input type="hidden" name="pMPI3D" value="true" />
                    <div style="width: 239px;margin: 0 auto;">
                    <img src="Provus2.JPG"/>
                </div> 
                    <ul>
                        <li>
                            <ul class="cards" style="">
                                <li class="visa">Visa</li>
                                <li class="visa_electron">Visa Electron</li>
                                <li class="mastercard">MasterCard</li>
                                <li class="maestro">Maestro</li>
                                <li class="discover">Discover</li>
                            </ul>
                        </li>

                        <li>
                            <label for="card_number">Card number</label>
                            <input type="text" name="pCardNo" id="card_number">
                        </li>
                        <li class="vertical">
                            <ul>
                                <li>
                                    <label for="expiry_date">Expiry date <small>yyyymm</small></label>
                                    <input type="text" name="pExpDate" id="expiry_date" maxlength="6">
                                </li>

                                <li>
                                    <label for="cvv">CVV</label>
                                    <input type="text" name="pCVV2" id="cvv" maxlength="4">
                                </li>
                            </ul>
                        </li>
                        <li>
                            <label for="name_on_card">Name on card</label>
                            <input type="text" name="name_on_card" id="name_on_card">
                        </li>
                    </ul>
                <input type="button" value="Pay Now!" id="ode"/>
                <div style="width: 239px;margin: 0 auto;">
                    <img src="vbv.gif"/>
                    <img src="sclogo_140x75.gif"/>
                </div>
                </form>
                
                
            </div>
            <script>
    
    
                $("#ode").bind('click',function(){
        
                    var pOrgNo = '<?php echo $pOrgNo ?>';
                    var pFirmNo = '<?php echo $pFirmNo ?>';
                    var pTermNo = '<?php echo $pTermNo ?>';
                    var pCardNo = $('input[name=\'pCardNo\']').val();
                    var pAmount = $('input[name=\'pAmount\']').val();
                    var merchantKey = "Jhf2DuN4";
    
                    hashdata = pOrgNo + pFirmNo + pTermNo + pCardNo + pAmount +merchantKey;
        
                    $("input[name=\'pHashB64\']").val(createHash(hashdata));
                    $("input[name=\'pHashHex\']").val(sha1Hash(pOrgNo + pFirmNo + pTermNo + pCardNo + pAmount +merchantKey));
                    
                    $('#PostToMPI').submit();
                });
    
                function createHash(hash)
                {
                    //	var hashdata = pOrgNo + pFirmNo + pTermNo + pCardNo + pAmount +merchantKey;
	
                    return encode64(sha1Hash(hash));
                }

                var keyStr = "ABCDEFGHIJKLMNOP" +
                    "QRSTUVWXYZabcdef" +
                    "ghijklmnopqrstuv" +
                    "wxyz0123456789+/" +
                    "=";

                function encode64(input) {
                    var output = "";
                    var chr1, chr2, chr3 = "";
                    var enc1, enc2, enc3, enc4 = "";
                    var i = 0;

                    do {
                        chr1 = eval('0x' + input.charAt(i++) + input.charAt(i++));
                        if (i<input.length)
                        chr2 = eval('0x' + input.charAt(i++) + input.charAt(i++));
                        else 
                            i=i+2;
                        if (i<input.length) 
                        chr3 = eval('0x' + input.charAt(i++) + input.charAt(i++));
                        else 
                            i=i+2;
		
                        enc1 = chr1 >> 2;
                        enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
                        enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
                        enc4 = chr3 & 63;
 
                        if (i == input.length + 4) {
                            enc3 = enc4 = 64;
                        } else if (i == input.length + 2) {
                            enc4 = 64;
                        } 

                        output = output + 
                            keyStr.charAt(enc1) + 
                            keyStr.charAt(enc2) + 
                            keyStr.charAt(enc3) + 
                            keyStr.charAt(enc4);
                        chr1 = chr2 = chr3 = "";
                        enc1 = enc2 = enc3 = enc4 = "";
                    } while (i < input.length);

                    return output;
                }


                function sha1Hash(msg)
                {
                    // constants [4.2.1]
                    var K = [0x5a827999, 0x6ed9eba1, 0x8f1bbcdc, 0xca62c1d6];

                    // PREPROCESSING 
 
                    msg += String.fromCharCode(0x80); // add trailing '1' bit to string [5.1.1]

                    // convert string msg into 512-bit/16-integer blocks arrays of ints [5.2.1]
                    var l = Math.ceil(msg.length/4) + 2;  // long enough to contain msg plus 2-word length
                    var N = Math.ceil(l/16);              // in N 16-int blocks
                    var M = new Array(N);
                    for (var i=0; i<N; i++) {
                        M[i] = new Array(16);
                        for (var j=0; j<16; j++) {  // encode 4 chars per integer, big-endian encoding
                            M[i][j] = (msg.charCodeAt(i*64+j*4)<<24) | (msg.charCodeAt(i*64+j*4+1)<<16) | 
                                (msg.charCodeAt(i*64+j*4+2)<<8) | (msg.charCodeAt(i*64+j*4+3));
                        }
                    }
                    // add length (in bits) into final pair of 32-bit integers (big-endian) [5.1.1]
                    // note: most significant word would be ((len-1)*8 >>> 32, but since JS converts
                    // bitwise-op args to 32 bits, we need to simulate this by arithmetic operators
                    M[N-1][14] = ((msg.length-1)*8) / Math.pow(2, 32); M[N-1][14] = Math.floor(M[N-1][14])
                    M[N-1][15] = ((msg.length-1)*8) & 0xffffffff;

                    // set initial hash value [5.3.1]
                    var H0 = 0x67452301;
                    var H1 = 0xefcdab89;
                    var H2 = 0x98badcfe;
                    var H3 = 0x10325476;
                    var H4 = 0xc3d2e1f0;

                    // HASH COMPUTATION [6.1.2]

                    var W = new Array(80); var a, b, c, d, e;
                    for (var i=0; i<N; i++) {

                        // 1 - prepare message schedule 'W'
                        for (var t=0;  t<16; t++) W[t] = M[i][t];
                        for (var t=16; t<80; t++) W[t] = ROTL(W[t-3] ^ W[t-8] ^ W[t-14] ^ W[t-16], 1);

                        // 2 - initialise five working variables a, b, c, d, e with previous hash value
                        a = H0; b = H1; c = H2; d = H3; e = H4;

                        // 3 - main loop
                        for (var t=0; t<80; t++) {
                            var s = Math.floor(t/20); // seq for blocks of 'f' functions and 'K' constants
                            var T = (ROTL(a,5) + f(s,b,c,d) + e + K[s] + W[t]) & 0xffffffff;
                            e = d;
                            d = c;
                            c = ROTL(b, 30);
                            b = a;
                            a = T;
                        }

                        // 4 - compute the new intermediate hash value
                        H0 = (H0+a) & 0xffffffff;  // note 'addition modulo 2^32'
                        H1 = (H1+b) & 0xffffffff; 
                        H2 = (H2+c) & 0xffffffff; 
                        H3 = (H3+d) & 0xffffffff; 
                        H4 = (H4+e) & 0xffffffff;
                    }

                    return H0.toHexStr() + H1.toHexStr() + H2.toHexStr() + H3.toHexStr() + H4.toHexStr();
                }

                //
                // function 'f' [4.1.1]
                //
                function f(s, x, y, z) 
                {
                    switch (s) {
                        case 0: return (x & y) ^ (~x & z);
                        case 1: return x ^ y ^ z;
                        case 2: return (x & y) ^ (x & z) ^ (y & z);
                        case 3: return x ^ y ^ z;
                    }
                }

                //
                // rotate left (circular left shift) value x by n positions [3.2.5]
                //
                function ROTL(x, n)
                {
                    return (x<<n) | (x>>>(32-n));
                }

                //
                // extend Number class with a tailored hex-string method 
                //   (note toString(16) is implementation-dependant, and 
                //   in IE returns signed numbers when used on full words)
                //
                Number.prototype.toHexStr = function()
                {
                    var s="", v;
                    for (var i=7; i>=0; i--) { v = (this>>>(i*4)) & 0xf; s += v.toString(16); }
                    return s;
                }
            </script>
    </body>
</html>


