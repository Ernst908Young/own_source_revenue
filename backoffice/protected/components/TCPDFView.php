<?php

require_once(Yii::app()->basePath . '/extensions/tcpdf/tcpdf/tcpdf.php');

class InPrincipleAprovalPDF extends TCPDF {

    public function Header() {
        // Logo
        $line_width = (0.85 / $this->k);
        $this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => '#000'));
        $image_file = $_SERVER['DOCUMENT_ROOT'] . Yii::app()->theme->baseUrl . '/img/PDFLOGO.png';
        $this->Image($image_file, 'C', 0.5, '2.5', '', 'PNG', '', 'C', false, 300, 'C', false, false, 0, false, false, false);
        $this->SetFont('times', '', 10);
        $data = '<hr>';
        $this->Ln();
    }

    public function Footer() {
        @session_start();
        $uname = 'Department User';
        if (isset($_SESSION['uname']) && !empty($_SESSION['uname'])) {
            $uname = ucwords($_SESSION['uname']);
            if (preg_match('/_/', $uname))
                $uname = ucwords(str_replace('_', ' ', $uname));
        }
        $line_width = (0.85 / $this->k);
        $this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => '#000'));
        //print document barcode
        $barcode = $this->getBarcode();
        if (!empty($barcode)) {
            $this->Ln($line_width);
            $barcode_width = round(($this->w - $this->original_lMargin - $this->original_rMargin) / 3);
            $style = array(
                'position' => $this->rtl ? 'R' : 'L',
                'align' => $this->rtl ? 'R' : 'L',
                'stretch' => false,
                'fitwidth' => true,
                'cellfitalign' => '',
                'border' => false,
                'padding' => 0,
                'fgcolor' => array(0, 0, 0),
                'bgcolor' => false,
                'text' => false
            );
            $this->write1DBarcode($barcode, 'C128', '', $cur_y + $line_width, '', (($this->footer_margin / 3) - $line_width), 0.3, $style, '');
        }
        // Position at 15 mm from bottom
        $this->SetY(-1);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        $data = '<hr /><table class="tbl">
		                <tr>
		                 <th>Certificate Date & Time:' . date('Y-m-d H:m:s') . '</th><th> &nbsp;&nbsp;&nbsp;&nbsp;This is system generated certificate</th>
		                </tr>
		              </table>';


        // Page number
        $this->Cell(0, 0, $this->writeHTML($data), '', 1, 'R');
    }

}

class TCPDFView {

    static function generateInPrinciple($content, $name) {
        $pdf = new InPrincipleAprovalPDF('P', 'cm', 'A4', true, 'UTF-8', false);
        $fontname = $pdf->addTTFfont($_SERVER['DOCUMENT_ROOT'] . Yii::app()->theme->baseUrl . '/fonts/Cambria.ttf', '', '', 32);
        $fontname = $pdf->addTTFfont($_SERVER['DOCUMENT_ROOT'] . Yii::app()->theme->baseUrl . '/fonts/cambriab.ttf', '', '', 32);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor("SWCS Uttarakhand");
        $pdf->SetTitle($name . "Application Form");
        $pdf->SetSubject($name);
        $pdf->SetKeywords("SWCS, Application Form");
        $pdf->setPrintHeader(true);
        $pdf->setHeaderFont(Array('Cambria', '', 10));
        $pdf->setFooterFont(Array('Cambria', '', 10));
        $pdf->SetMargins(1, 2.6, 1);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $certificate = 'file://' . dirname(__FILE__) . '/selfcert2.pem';
        $info = array(
            'Name' => 'UK-SWCS',
            'Location' => 'CS',
            'Reason' => 'Empowered Commitee Meeting',
            'ContactInfo' => 'https://caipotesturl.com',
            'SignedBy' => 'https://caipotesturl.com',
        );
        $mnp = array($certificate, '12345678');
        $pv = 'file://' . dirname(__FILE__) . '/cert2.pem';
        $ext = 'file://' . dirname(__FILE__) . '/app.txt';
        $pdf->setSignature($certificate, $pv, '12345678', '', 2, $info);
        $pdf->setPrintFooter(true);
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont("Cambria", "", 12);
        $params = $pdf->serializeTCPDFtagParameters(array('CODE 39', 'C39', '', '', 80, 30, 0.4, array('position' => 'S', 'border' => true, 'padding' => 4, 'fgcolor' => array(0, 0, 0), 'bgcolor' => array(255, 255, 255), 'text' => true, 'font' => 'helvetica', 'fontsize' => 8, 'stretchtext' => 4), 'N'));
        $pdf->writeHTML($content, true, 0, 0, 0);
        $html = '[Digitally Signed]';

        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->lastPage();
        $pdf->Output($name, "D");
        ob_end_clean();
    }

    static function generatePDFWithHindiFont($content, $name) {
        $pdf = new InPrincipleAprovalPDF('P', 'cm', 'A4', true, 'UTF-8', false);
        $fontname = $pdf->addTTFfont($_SERVER['DOCUMENT_ROOT'] . Yii::app()->theme->baseUrl . '/fonts/Cambria.ttf', '', '', 32);
        $fontname = $pdf->addTTFfont($_SERVER['DOCUMENT_ROOT'] . Yii::app()->theme->baseUrl . '/fonts/cambriab.ttf', '', '', 32);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor("SWCS Uttarakhand");
        $pdf->SetTitle($name . "Application Form");
        $pdf->SetSubject($name);
        $pdf->SetKeywords("SWCS, Application Form");
        $pdf->setPrintHeader(true);
        $pdf->setHeaderFont(Array('Cambria', '', 10));
        $pdf->setFooterFont(Array('Cambria', '', 10));
        $pdf->SetMargins(1, 2.6, 1);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
        $pdf->setPrintFooter(true);
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $params = $pdf->serializeTCPDFtagParameters(array('CODE 39', 'C39', '', '', 80, 30, 0.4, array('position' => 'S', 'border' => true, 'padding' => 4, 'fgcolor' => array(0, 0, 0), 'bgcolor' => array(255, 255, 255), 'text' => true, 'font' => 'Cambria', 'fontsize' => 8, 'stretchtext' => 4), 'N'));
        $pdf->writeHTML($content, true, 0, 0, 0);
        $pdf->lastPage();
        $pdf->Output($name, "I");
        ob_end_clean();
    }

}

?>