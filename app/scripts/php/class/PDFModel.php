<?php


class PDFModel{
    /**
     * @param mysqli $dbCLassObj
     */
    function __construct($dbCLassObj){
        $this->db = $dbCLassObj;
        // current Scope: scripts/php/ajaxtrl.php
        require_once("dompdf/dompdf_config.inc.php");
        $this->pdf = new DOMPDF();
    }
    function preparePDF($content){
        $content["badausstattung"] = array();
        $badArr = json_decode($content["badtyp"]);
        $badAusArray = json_decode($content["badbesonderheit"]);
        if(is_array($badArr)){
            foreach($badArr as $id=>$badTyp){
                if(is_array($badAusArray) && isset($badAusArray[$id])){
                    foreach($badAusArray[$id] as $ind=>$word){
                        switch($word){
                            case "modernes":
                            case "hochwertiges":
                            case "tagesbelichtetes":
                                if(!isset($add)){$add=array();}
                                $add[]=$word;
                                break;
                            case "en Suite":
                                if(!isset($opt)){$opt=array();}
                                $opt[]=$word;
                                break;
                            case "Regendusche":
                            case "freistehender Badewanne":
                            case "Fussbodenheizung":
                            case "bodentiefer Dusche":
                            case "Doppelwaschtisch":
                            case "Bidet":
                                if(!isset($mit)){$mit=array();}
                                $mit[]=$word;
                                break;
                            case "Feinstein":
                            case "Naturstein":
                            case "Fliesen":
                                if(!isset($boden)){$boden=array();}
                                $boden[]=$word;
                                break;
                            default:
                                if(!isset($end)){$end=array();}
                                $end[]=$word;
                                break;
                        }
                    }
                }
                $badString = "";
                $i=0;
                if(isset($add)){
                    foreach($add as $a=>$b){
                        if($i>0){
                            $badString .= ",";
                        }
                        $badString .= " ".$b;
                        $i++;
                    }
                }
                $badString .= " ".$badTyp;
                if(isset($opt)){
                    foreach($opt as $a=>$b){
                        $badString .= " ".$b;
                    }
                }


                if(isset($mit)){
                    $i=0;
                    foreach($mit as $a=>$b){

                        if($i>0){
                            $badString .= ",";
                        }else{
                            $badString .= " mit";
                        }
                        $badString .= " ".$b;
                        $i++;
                    }
                }
                $i=0;
                if(isset($boden)){
                    foreach($boden as $a=>$b){

                        if($i>0){
                            $badString .= ",";
                        }else{
                            if(!isset($mit)){
                                $badString .= " mit";
                            }else{
                                $badString .= " und";
                            }

                        }
                        $badString .= " ".$b;
                        $i++;
                    }
                    $badString .= "-Boden";
                }
                if(isset($end)){
                    foreach($end as $a=>$b){
                        $badString .= ". ".$b;
                    }
                }
                $content["badausstattung"][] = $badString;
                unset($add);
                unset($mit);
                unset($opt);
                unset($boden);
                unset($end);
            }
        }
        // K�che-Syntax
        $kuecheArr = explode(",", $content["kuecheausstattung"]);
        $freitext="";
        foreach($kuecheArr as $ind=>$word){
            switch($word){
                case "modern":
                case "hochwertig":
                case "tagesbelichtet":
                case "klassisch":
                    if(!isset($add)){$add=array();}
                    $add[]=$word."e";
                    break;
                case "Markenger�ten":
                case "allen technischen Ger�ten ausgestattet":
                    if(!isset($mit)){$mit=array();}
                    $mit[]=$word;
                    break;
                case "Wohnk�che":
                case "offene K�che":
                    if(!isset($kuecheTyp)){$kuecheTyp=array();}
                    $kuecheTyp[]=$word;
                    break;
                default:
                    $freitext = $word;
            }
        }
        $kuecheString = "";
        $i=0;
        if(isset($add)){
            foreach($add as $a=>$b){
                if($i>0){
                    $kuecheString .= ",";
                }
                $kuecheString .= " ".$b;
                $i++;
            }
        }
        if(isset($kuecheTyp)){
            if(count($kuecheTyp)>1){
                $kuecheString .= " offene Wohnk�che";
            }else{
                $kuecheString .= " ".$kuecheTyp[0];
            }
        }else{
            $kuecheString .= " K�che";
        }
        if(isset($mit)){
            $i=0;
            foreach($mit as $a=>$b){

                if($i>0){
                    $kuecheString .= ",";
                }else{
                    $kuecheString .= " mit";
                }
                $kuecheString .= " ".$b;
                $i++;
            }
        }
        $content["kuecheausstattung"] = $kuecheString;
        $content["kueche_freitext"] = $freitext;
        return $content;
    }
    function createPDF($objRaw){
        $id = $objRaw["id"];
        $content= $this->preparePDF($objRaw);
        ob_start();
        if($content["ga"]=='Miete'){
            include "templates_pdf/pdfLayoutMiete.php";
        }else{
            include "templates_pdf/pdfLayoutKauf.php";
        }
        $html = ob_get_contents();
        ob_end_clean();
        $this->pdf->load_html($html);
        $this->pdf->set_paper("a4", 'portrait');
        $this->pdf->render();
        $pdf = $this->pdf->output($html);


        $filename = $id."_".date("ymdhis").".pdf";
        $filepath = "../../download/pdf/".$filename;
        $mask = $id.'_*.*';
        //array_map('unlink', glob("../".$filepath."/".$mask));
        try{
           file_put_contents($filepath, $pdf);
        }catch(Exception $e){
            echo $e;
        }
        return array('type' => 'success', 'text' => 'PDF erstellt', 'addData'=>array('filename'=>$filename), 'code' => 1);
    }
}

?>