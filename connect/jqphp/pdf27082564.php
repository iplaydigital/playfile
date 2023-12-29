<?php
    // integer starts at 0 before counting
    $c = 0; 
    $dir = '../cer/27082564/';
    if ($handle = opendir($dir)) {
        while (($file = readdir($handle)) !== false){
            if (!in_array($file, array('.', '..')) && !is_dir($dir.$file)) 
                $c++;
        }
    }
    
    echo $c;

?>