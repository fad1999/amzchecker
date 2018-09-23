<?php
error_reporting(0);
function getStr($string,$start,$end){
 $str = explode($start,$string);
 $str = explode($end,$str[1]);
 return $str[0];
}
function save($name,$data){
        $myfile = fopen($name, "a+") or die("Unable to open file!");
        fwrite($myfile, $data);
        fclose($myfile);
        if($myfile){
                return true;
        }else{
                return false;
        }
}

function check($email,$name){
$fgt = file_get_contents("http://firstideashop.com/js/epel/epel.php?email=".$email."");
//$valid = getStr($fgt, '"status":"','"');
//$used = getStr($fgt, '"used" : ',',');
$deco = getStr($fgt, '{"status":"','"}');
if($deco == "Dead") {
return false;
}
if($deco == "Live") {
$status = "Live";
 $data = "$email => LIVE\r\n";
 if(!save($name,$data)){
  echo "ops... chmod dulu/buat file kosong dulu\r\n";
  exit();
 }
 return true;
} else {
return false;
}
}


if(isset($argv[1]) && isset($argv[2])){
if(file_exists($argv[1])){
cover();
$no=1;
$valid=0;
$invalid=0;

$load = file_get_contents($argv[1]);
$mail_explode = explode("\n", $load);
$cont = count($mail_explode);

foreach ($mail_explode as $key => $email) {
 echo "[$no/$cont] $email -> ";
if(check($email,$argv[2])) {
  echo "LIVE\n";
  $valid++;
 }else {
echo "DEAD\n";
$invalid++;
}
$no++;
}

echo "[HASIL] Valid : $valid | Invalid : $invalid | Total : $cont\r\n";

}
}else{
 echo "php ".$argv[0]." {list} {output}\r\n";
}

function cover(){
$cover.="========================================\r\n";
$cover.="=         Apple Email Checker          =\r\n";
$cover.="=       Only Check DIE or LIVE         =\r\n";
$cover.="= Recoded From : Badboy404AppleValidMail  =\r\n";
$cover.="========================================\r\n";
echo $cover;
}

?>
