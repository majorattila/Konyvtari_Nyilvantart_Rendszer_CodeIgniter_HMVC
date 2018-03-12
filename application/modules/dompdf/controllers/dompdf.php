<?php
class Dompdf extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function create_pdf($htmlcontent, $for_upload=false, $new_file="sample_pdf", $title=null)
{
    //create my function for creating pdf. First include my dompdf class
    include(APPPATH."third_party/dompdf/autoload.inc.php");
    //and now I'm creating new instance dompdf

	// Load dompdf and create object
    $options = new Dompdf\Options();
    $options->set('tempDir', __DIR__ . '/site_uploads/dompdf_temp');
    $options->set('isRemoteEnabled', TRUE);
    $options->set('debugKeepTemp', TRUE);
    $options->set('chroot', '/'); // Just for testing :)
    $options->set('isHtml5ParserEnabled', true);
    $dompdf = new Dompdf\Dompdf($options);
	
	//we test first.
    //included.
	
    //now we can use all methods of dompdf
    //first I'm giving our html text to this method.
    $dompdf->load_html($this->make_pdf_fullhtml($htmlcontent, $title), 'UTF-8');
    //and getting rend
    $dompdf->render();
    //now our html converted pdf. with->output method we can get it.
    //and I'm making a pdf file and save.
    //but first zthi method overloaded, if upload, we will give true, if no only stream we will give false
    if($for_upload){
        $dompdf-> stream($dompdf->output(), array("Attachment" => false));
        //file_put_contents($new_file.".pdf", $dompdf->output());
    }else{
        $dompdf-> stream($dompdf->output(), array("Attachment" => true));
    }
    //url wont accept.
    //oh we gave wrong parameters. first we must give true/and file name.
    /*

    saved.
    But we will use this function at everywhere. and we give our html document. for this we must make this function a model.
    I will create a model now.

    Yes we have model for making dfp.
    we make stream also

    bla bla bla

    */
}

function make_pdf_fullhtml($html_content, $title=null)
{
    /*
    and I will create a view. I will load here
    
    now I will send parameter content and if I want title also.
    */

    return $this->load->view("load_html_content", array("html_content" => $html_content, "title" => $title),true);

    //yes when load view i giv the parameter is true, because i don't want load. I wanna only result of this view.
    }
}

?>