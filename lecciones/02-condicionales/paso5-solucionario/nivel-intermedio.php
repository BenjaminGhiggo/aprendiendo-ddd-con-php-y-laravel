<?php
$nota = 13;
if ($nota >= 18) { echo "P5: excelente\n"; } elseif ($nota >= 11) { echo "P5: aprobado\n"; } else { echo "P5: desaprobado\n"; }
$a = true; $b = false; echo "P6: "; var_export($a && $b); echo " "; var_export($a || $b); echo "\n"; // false true
$dia = 2; echo "P7: " . match($dia){1=>"lun",2=>"mar",default=>"?"} . "\n";                    // mar
$stock = 0; echo "P8: " . ($stock > 0 ? "hay" : "no hay") . "\n";                              // no hay
