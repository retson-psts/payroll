<?php 
header("Content-Type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=report_".date('d-M-y_h_i_s_A').".xls");
echo $content;

?>
