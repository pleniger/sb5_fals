<?php
    $ssl=new ssl;
    class ssl{
        private $e;private $a;function __construct(){
            global $argv;
            if(@constant('ENCRYPTION_PHRASE')>''){
                $this->e=base64_decode(ENCRYPTION_PHRASE);
            }elseif(php_sapi_name()!='cli'){
                $this->e=base64_decode(apache_getenv('ENCRYPTION_PHRASE'));
            }else{
                $this->e=base64_decode($argv[1]);
            }
            $this->a=ENCRYPTION_ALGORITHM;
        }
        function encrypt($x){
            $i=openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->a));
            $t=openssl_encrypt($x,$this->a,$this->e,0,$i);
            return(base64_encode($t.'::'.$i));
        }
        function decrypt($d){
            list($c,$i)=array_pad(explode('::',base64_decode($d),2),2,null);
            return(openssl_decrypt($c,$this->a,$this->e,0,$i));
        }
    }
?>
