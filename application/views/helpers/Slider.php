<?php
class Zend_View_Helper_Slider extends Zend_View_Helper_Abstract
{
    private $percorso;
    private $oggi; 
    private $diff;
    
        public function slider($validità,$imageFile)
        {
            if(is_int($validità)===true){
                $percorso=$imageFile;
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
                $percorso=$imageFile;
             }
             else{
                 $percorso=false;
             }
            }
            return $percorso;
            
        }
    
    
}

