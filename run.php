<?php
/**
 * @author fb.com/www.zeldin.go.id
 * @package CC GENERATOR
 * Thanks to https://github.com/radenvodka/color-php for PHP Color Function
 * Thanks to https://github.com/jacek-9999/credit-card-generator/ 
 * Iam Recode the cc.class.php from jacek-9999 in github'
 * Changelog : - Adding feature Month,
 *             - Adding feature Year,
 *             - Adding feature CVV,
 *             - Adding feature Checker for Live card dll
 * NOTE : FILE NAME SAVED WITH YOUR BIN INPUT.
**/
require "./cc.checker.php";
echo ">> BIN : "; $bin = trim(fgets(STDIN));
echo ">> Date : "; $date = trim(fgets(STDIN));
echo ">> Month : "; $month = trim(fgets(STDIN));
echo ">> Year : "; $year = trim(fgets(STDIN));
echo ">> Check ? 1/0 : "; $check = trim(fgets(STDIN));
echo ">> Amount : "; $amount = trim(fgets(STDIN));
$new = new CC($bin, $date, $month, $year, $check, $amount);
echo $new->Execute();
?>
