<?php
class Zend_View_Helper_Slider extends Zend_View_Helper_Abstract
{
    private $oggi; 
    private $diff;
    
        public function slider($validità,$imageFile)
        {
            if(is_int($validità)===true){
                $esatto=$validità;
            }else{
            
             $anno= substr($validità,0,4);
             $anno=(int)$anno;
             $mese= substr($validità,5,2);
             $mese=(int)$mese;
             $giorno= substr($validità,8,2);
             $giorno=(int)$giorno;
             $oggi= getdate();
             if($anno<$oggi['year'] || $mese<$oggi['mon'] || $giorno<$oggi['mday'])
             {
                $esatto=$imageFile;
             }
            }
            return $esatto;
            
        }
    
    
}

