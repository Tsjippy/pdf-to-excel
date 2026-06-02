<?php
namespace TSJIPPY\PDFTOEXCEL;
use TSJIPPY;

use function TSJIPPY\addElement;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class AdminMenu extends \TSJIPPY\ADMIN\SubAdminMenu{

    /**
     * AdminMenu constructor.
     * 
     * @param array $settings The settings for the plugin
     * @param string $name The name of the plugin
     */
    public function __construct($settings, $name){
        parent::__construct($settings, $name);
    }

    public function settings($parent){
        return false;
    }

    public function emails($parent){
        return false;
    }

    public function data($parent=''){

        return false;
    }

    public function functions($parent){
        if(!empty($_FILES['pdf_file']['tmp_name'])){
            $filePath = $_FILES['pdf_file']['tmp_name'];
            $result = readPdf($filePath, 'download', true, 'xlsx');
            if($result){
                // file was created successfully, you can handle the download here
            }else{
                // handle error
            }
        }else{

            ob_start();

            ?>
            <form method="post" enctype="multipart/form-data">
                <input type="file" name="pdf_file" accept=".pdf">
                <br>
                <input type="submit" value="Upload PDF" name="submit">
            </form>
            <?php
            TSJIPPy\addRawHtml(ob_get_clean(), $parent);
        }

        return true;
    }

}