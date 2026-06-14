<?php 
/* Template Name: Pdf Preview */ 
get_header();
?>

 <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">
        <?php
                $ra_sign_name = carbon_get_theme_option('ra_sign_name');
        $jurisdiction_city = carbon_get_theme_option('jurisdiction_city');
        $ra_address = carbon_get_theme_option('ra_address');
        $ra_website = carbon_get_theme_option('ra_website');
        $ra_phone = carbon_get_theme_option('ra_phone');
        $ra_email = carbon_get_theme_option('ra_email');
        $ra_reg_date = carbon_get_theme_option('ra_reg_date');
        $ra_name = carbon_get_theme_option('ra_name');
        $ra_brand = carbon_get_theme_option('ra_brand');
        $ra_registration_number = carbon_get_theme_option('ra_registration_number');
        require_once get_template_directory() . '/tcpdf/tcpdf.php'; // adjust path if Dompdf is 
    class MYPDF extends TCPDF {

    // Page header
        public function Header() {
        // --- Row 1: Logo in center ---
        $pdf_logo = carbon_get_theme_option('pdf_logo');
        $pdf_logo_path = get_attached_file($pdf_logo);
        $logo = $pdf_logo_path;
        $this->Image($logo, '', 3, 40, '', '', '', '', false, 300, 'C', false, false, 0, false, false, false);
        $sebi_registration_number = carbon_get_theme_option('sebi_registration_number');
        $pdf_phone_number = carbon_get_theme_option('pdf_phone_number');
        // --- Row 2: Subheader text ---
        $htmlLeft  = '<span style="font-size:12px; font-weight:bold;">'.$sebi_registration_number.'</span>';
        $htmlRight = '<span style="font-size:12px; font-weight:bold;">'.$pdf_phone_number.'</span>';
        // Left heading (x=12, y=28)
        $this->writeHTMLCell(90, 5, 12, 14, $htmlLeft, 0, 0, 0, true, 'L', true);
        // Right heading (x=108, y=28)
        $this->writeHTMLCell(90, 5, 108, 14, $htmlRight, 0, 0, 0, true, 'R', true);
        $this->Line(5, 20, $this->getPageWidth() - 5,20);
         //$this->Line(15, 52, $this->getPageWidth()-15, 52);
        }


    // Page footer (optional)
        public function Footer() {
        $this->Line(15, $this->GetY(), $this->getPageWidth() - 15, $this->GetY());
        // Position 15 mm from bottom
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);

        // Get current page number and total in group
        $pageNum = $this->getPageNumGroupAlias();
        $pageTot = $this->getPageGroupAlias();

        // Print: Page X of Y (group-wise)
        $this->Cell(0, 10, "Page $pageNum of $pageTot", 0, 0, 'R');
    }
    }
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $docId = uniqid('pdf_', true); // generate unique ID
    $pdf->SetCreator($ra_name);
    $pdf->SetAuthor($ra_name);
    $pdf->SetTitle('Agreement Document');
    $pdf->SetSubject('Digital Agreement');
    $pdf->SetKeywords('agreement, esign, digio, tcpdf');
    $pdf->SetFooterMargin(15);
    // --------------- Global Mapping ----
    $map = [
           '{{agreement_date}}'   => $day,
           '{{agreement_month}}' => $month,
           '{{agreement_year}}'  => $year,
           '{{client_name}}'     => $name,
           '{{client_father}}'   => $fathername,
          '{{client_address}}'  => $street.''.$line.''.$city.''.$state.''.$country,
          '{{fee_amount}}'      => $fee_amount,
          '{{service_name}}'    => $service_name,
          '{{payment_terms}}'   => $payment_terms,
          '{{ra_name}}'         => 'Pavan Prajapati',
          '{{ra_brand}}'        => 'Pavan Prajapati',
          '{{ra_registration}}' => 'INH000025416',
          '{{ra_reg_date}}'     => 'March 12, 2026',
          '{{ra_email}}'        => 'services@pavanprajapati.com',
          '{{ra_phone}}'        => '+91 8758396016',
          '{{ra_website}}'      => 'www.pavanprajapati.com',
          '{{ra_address}}'      => 'R503, Abjibapa Lakeview Nr Nirat Chokdi, Vastral Ahmedabad(Gujrat) 382418',
          '{{jurisdiction_city}}'=> 'Ahmedabad (Gujrat)',
          //'{{client_pan}}'      => $client_pan,
          '{{ra_sign_name}}'    => 'Pavan Prajapati',
        ];
         $upload_dir = wp_upload_dir();
        $timestamp  = time();
         /*
        |--------------------------------------------------------------------------
        | Agreement PDF
        |--------------------------------------------------------------------------
        */
        $agreement_sections = carbon_get_theme_option('pdf_agreement_content');
//        echo '<pre>';
//print_r($agreement_sections);
//die;
        $count_agreement = count($agreement_sections);
        if (!empty($agreement_sections)) {
        $pdf->startPageGroup();
            foreach ($agreement_sections as $index => $agreement_section) {
                $pdf->SetAutoPageBreak(TRUE, 10);
                $pdf->SetMargins(20, 25, 20);
                $pdf->AddPage();
                $agreement_title   = $agreement_section['agreement_title'] ?? '';
                $agreement_content = $agreement_section['agreement_content'] ?? '';
                $agreement_content = strtr($agreement_content, $map);
                $agreement_content = preg_replace('/<p([^>]*)>/', '<span$1>', $agreement_content);
                $agreement_content = str_replace('</p>', '</span><br>', $agreement_content);
                if (!empty($agreement_title)) {
                    $html = '
                        <h2 style="font-size:16px;font-weight:bold;">
                            ' . $agreement_title . '
                        </h2>
                    ';
                    $pdf->writeHTML($html, true, false, true, false, '');
                }
               $agreement_html_content = '
                        <div class="section" style="font-size:10px;" >
                            ' . $agreement_content . '
                        </div>
                    ';
                $pdf->writeHTML(
                    $agreement_html_content,
                    true,
                    false,
                    true,
                    false,
                    ''
                );

                }
//              $page_width  = round($pdf->getPageWidth() * 2.83465);
//          $page_height = round($pdf->getPageHeight() * 2.83465);
//              $sign = $ra_sign_url;
//              $imageWidth = 40;
//         $imageHeight = 20;
//         // Place image ABOVE "Analyst Signature"
//         // $pdf->Image(
//         //     $sign,
//         //     $page_width - 60, // center inside box
//         //     $page_height - 40,  // above text
//         //     $imageWidth,
//         //     $imageHeight
//         // );
      
//       // $pdf->Text($x2, $y + $boxHeight + 2, 'Client Signature');
//          $agreement_last_index = $index;
// $right_margin  = 30;
// $bottom_margin = 40;
// $llx = $page_width - $right_margin;
// $lly = $bottom_margin; 
// $urx = $llx;
// $ury = $lly;
                $agreement_last_index = $index;
$page_width  = round($pdf->getPageWidth() * 2.83465);
$page_height = round($pdf->getPageHeight() * 2.83465);

$right_margin  = 30;

// Pehle 40 tha
$bottom_margin = 70; // box ko upar le jayega

$sign_width  = 100;

// Pehle 50 tha
$sign_height = 80; // image + digital sign dono ke liye space

$llx = $page_width - $right_margin - $sign_width;
$lly = $bottom_margin;

$urx = $llx + $sign_width;
$ury = $lly + $sign_height;
$imageWidth  = 35;
$imageHeight = 15;

// Digio box
$llx = $page_width - $right_margin - $sign_width;
$lly = $bottom_margin;

$urx = $llx + $sign_width;
$ury = $lly + $sign_height;

// TCPDF uses mm
$pt_to_mm = 0.352778;

// Image ko sign box ke LEFT me rakho
$imageX = (($llx - 110) * $pt_to_mm); // 110 = image + gap
$imageY = (($page_height - $ury) * $pt_to_mm) + 5;

$pdf->Image(
    $ra_sign_url,
    $imageX,
    $imageY,
    $imageWidth,
    $imageHeight
);
/*
|--------------------------------------------------------------------------
| RA Details Below Signature
|--------------------------------------------------------------------------
*/

$pdf->SetFont('helvetica', '', 6);

$textY = $imageY + $imageHeight + 2;

$ra_name = 'Prajapati Pavan Jitendrabhai';
$sebi_no = 'SEBI Reg. No.: INH0000XXXX';
$sign_date = date('d/m/Y');

$pdf->writeHTMLCell(
    45,                 // width
    0,                  // height
    $imageX,            // x
    $textY,             // y
    '
    <span style="font-size:6px;">
    <b>Research Analyst</b><br>
        <b>'.$ra_name.'</b><br>
        '.$sebi_no.'<br>
        Digitally Signed<br>
        Date: '.$sign_date.'
    </span>
    ',
    0,
    0,
    false,
    true,
    'L',
    true
);
        }
            /*
        |--------------------------------------------------------------------------
        | MITC PDF
        |--------------------------------------------------------------------------
        */
        $mitc_sections = carbon_get_theme_option('pdf_mitc_content');
       $count_mitc = count($mitc_sections);
       // $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            if (!empty($mitc_sections)) {
            $pdf->startPageGroup();
                foreach ($mitc_sections as $index => $mitc_section) {
                    $pdf->SetAutoPageBreak(TRUE, 10);
                    $pdf->SetMargins(20, 25, 20);
                    $pdf->AddPage();
                    $mitc_title   = $mitc_section['mitc_title'] ?? '';
                    $mitc_content = $mitc_section['mitc_content'] ?? '';
                    $mitc_content = strtr($mitc_content, $map);
                    if (!empty($mitc_title)) {
                        $html = '
                            <h2 style="font-size:16px;font-weight:bold;">
                                ' . $mitc_title . '
                            </h2>
                            <br>
                        ';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    }
                   $mitc_html_content = '
                            <div class="section" style="font-size:10px;" >
                                ' . $mitc_content . '
                            </div>
                        ';
                    $pdf->writeHTML(
                        $mitc_html_content,
                        true,
                        false,
                        true,
                        false,
                        ''
                    );

                    }
                   
 $mitc_section_last_index = $index;
 $page_width  = round($pdf->getPageWidth() * 2.83465);
$page_height = round($pdf->getPageHeight() * 2.83465);

$right_margin  = 30;

// Pehle 40 tha
$bottom_margin = 70; // box ko upar le jayega

$sign_width  = 100;

// Pehle 50 tha
$sign_height = 80; // image + digital sign dono ke liye space

$mmx = $page_width - $right_margin - $sign_width;
$mmy = $bottom_margin;

$urx = $mmx + $sign_width;
$ury = $mmy + $sign_height;
$imageWidth  = 35;
$imageHeight = 15;

// Digio box
$mmx = $page_width - $right_margin - $sign_width;
$mmy = $bottom_margin;

$mpx = $mmx + $sign_width;
$mpy = $mmy + $sign_height;

// TCPDF uses mm
$pt_to_mm = 0.352778;

// Image ko sign box ke LEFT me rakho
$imageX = (($mmx - 110) * $pt_to_mm); // 110 = image + gap
$imageY = (($page_height - $ury) * $pt_to_mm) + 5;

$pdf->Image(
    $ra_sign_url,
    $imageX,
    $imageY,
    $imageWidth,
    $imageHeight
);
/*
|--------------------------------------------------------------------------
| RA Details Below Signature
|--------------------------------------------------------------------------
*/

$pdf->SetFont('helvetica', '', 6);

$textY = $imageY + $imageHeight + 2;

$ra_name = 'Prajapati Pavan Jitendrabhai';
$sebi_no = 'SEBI Reg. No.: INH0000XXXX';
$sign_date = date('d/m/Y');

$pdf->writeHTMLCell(
    45,                 // width
    0,                  // height
    $imageX,            // x
    $textY,             // y
    '
    <span style="font-size:6px;">
     <b>Research Analyst</b><br>
        <b>'.$ra_name.'</b><br>
        '.$sebi_no.'<br>
        Digitally Signed<br>
        Date: '.$sign_date.'
    </span>
    ',
    0,
    0,
    false,
    true,
    'L',
    true
);
        
            }
          /*
        |--------------------------------------------------------------------------
        | Consent PDF
        |--------------------------------------------------------------------------
        */
        $consent_sections = carbon_get_theme_option('pdf_consent_content');
        $count_consent = count($consent_sections);
       
       // $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            if (!empty($consent_sections)) {
            $pdf->startPageGroup();
                foreach ($consent_sections as $index => $section) {
                    $pdf->SetAutoPageBreak(TRUE, 10);
                    $pdf->SetMargins(20, 25, 20);
                    $pdf->AddPage();
                    $consent_title   = $section['consent_title'] ?? '';
                    $consent_content = $section['consent_content'] ?? '';
                    $consent_content = strtr($consent_content, $map);
                    if (!empty($title)) {
                        $html = '
                            <h2 style="font-size:16px;font-weight:bold;">
                                ' . $consent_title . '
                            </h2>
                            <br>
                        ';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    }
                   $consent_html_content = '
                            <div class="section" style="font-size:10px;" >
                                ' . $consent_content . '
                            </div>
                        ';
                    $pdf->writeHTML(
                        $consent_html_content,
                        true,
                        false,
                        true,
                        false,
                        ''
                    );

                    }
                   
 $consent_last_index = $index;
 $page_width  = round($pdf->getPageWidth() * 2.83465);
$page_height = round($pdf->getPageHeight() * 2.83465);

$right_margin  = 30;

// Pehle 40 tha
$bottom_margin = 70; // box ko upar le jayega

$sign_width  = 100;

// Pehle 50 tha
$sign_height = 80; // image + digital sign dono ke liye space

$ccx = $page_width - $right_margin - $sign_width;
$ccy = $bottom_margin;

$urx = $ccx + $sign_width;
$ury = $ccy + $sign_height;
$imageWidth  = 35;
$imageHeight = 15;

// Digio box
$ccx = $page_width - $right_margin - $sign_width;
$ccy = $bottom_margin;

$cdx = $ccx + $sign_width;
$cdy = $ccy + $sign_height;

// TCPDF uses mm
$pt_to_mm = 0.352778;

// Image ko sign box ke LEFT me rakho
$imageX = (($ccx - 110) * $pt_to_mm); // 110 = image + gap
$imageY = (($page_height - $ury) * $pt_to_mm) + 5;

$pdf->Image(
    $ra_sign_url,
    $imageX,
    $imageY,
    $imageWidth,
    $imageHeight
);
/*
|--------------------------------------------------------------------------
| RA Details Below Signature
|--------------------------------------------------------------------------
*/

$pdf->SetFont('helvetica', '', 6);

$textY = $imageY + $imageHeight + 2;

$ra_name = 'Prajapati Pavan Jitendrabhai';
$sebi_no = 'SEBI Reg. No.: INH0000XXXX';
$sign_date = date('d/m/Y');

$pdf->writeHTMLCell(
    45,                 // width
    0,                  // height
    $imageX,            // x
    $textY,             // y
    '
    <span style="font-size:6px;">
     <b>Research Analyst</b><br>
        <b>'.$ra_name.'</b><br>
        '.$sebi_no.'<br>
        Digitally Signed<br>
        Date: '.$sign_date.'
    </span>
    ',
    0,
    0,
    false,
    true,
    'L',
    true
);
 
            }
    
       
      
        $unsigned_dir = $upload_dir['basedir'] . '/unsigned';

/*
|--------------------------------------------------------------------------
| CREATE DIRECTORY IF NOT EXISTS
|--------------------------------------------------------------------------
*/

if ( ! file_exists($unsigned_dir) ) {

    wp_mkdir_p($unsigned_dir);

}

/*
|--------------------------------------------------------------------------
| FILE NAME
|--------------------------------------------------------------------------
*/

$file_name = 'agreement-' . sanitize_title($name) . '-' . $timestamp . '.pdf';

/*
|--------------------------------------------------------------------------
| FULL PATH
|--------------------------------------------------------------------------
*/

$agreement_pdf_path = $unsigned_dir . '/' . $file_name;

/*
|--------------------------------------------------------------------------
| PUBLIC URL
|--------------------------------------------------------------------------
*/

$agreement_pdf_url = $upload_dir['baseurl'] . '/unsigned/' . $file_name;

/*
|--------------------------------------------------------------------------
| SAVE PDF
|--------------------------------------------------------------------------
*/

$pdf->Output($agreement_pdf_path, 'F');

/*
|--------------------------------------------------------------------------
| SHOW PDF ON PAGE
|--------------------------------------------------------------------------
*/
echo '<iframe 
        src="' . esc_url($agreement_pdf_url) . '" 
        width="100%" 
        height="900"
        style="
            border:1px solid #ddd;
            border-radius:12px;
            margin-top:20px;
            background:#fff;
        ">
      </iframe>';

        ?>
      </div>
    </section><!-- End About Section -->
    

<?php
global $wpdb;
$entry_id =142;
    $pdf_url = $wpdb->get_results(
         $wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}frmt_form_entry_meta WHERE entry_id = %d  ORDER BY entry_id DESC",$entry_id));

    //print_r($pdf_url);
    $data = [];

foreach ($pdf_url as $row) {
    $value = maybe_unserialize($row->meta_value); // WordPress built-in helper
    $data[$row->meta_key] = $value;
}

//print_r($data);
get_footer();