 
<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
        set_include_path(get_include_path().PATH_SEPARATOR .BASEPATH.'libraries/PHPExcel/PHPExcel');
        require_once("PHPExcel/PHPExcel.php");
        /**
         * DK_PHPExcel extends PHPExcel
         * Author: Daker.W
         * Create Time: 2010/08/10
         **/
        class Excel extends PHPExcel
        {
            public function __construct(){
                parent::__construct();
            }
               

        }
?>