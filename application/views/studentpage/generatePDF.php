<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetTitle('Print Grades for '.$SubjCode);
// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetFont('helvetica', '', 12);
// add a page
$pdf->AddPage('L');

// -----------------------------------------------------------------------------
$heading = '
<h1>Grades in '.$SubjCode.'</h1><br>
<h2>'.$SubjDesc.'</h2>';
$pdf->writeHTMLCell(0, 0, '', '', $heading, 0, 1, 0, true, 'C', true);
$pdf->Ln(8);

if($GradingPeriod == 'Finals' && $Balance != 0)
{
  if($parentNotif == 1)
  {
    $table .= '
    <table border="1">
        <tr id="user_tbl_head">
          <td id="user_tbl_data">Student No.</td>
          <td id="user_tbl_data">Student Name</td>
          <td id="user_tbl_data">Percentage Midterm Grade</td>
          <td id="user_tbl_data">Decimal Midterm Grade</td>
          <td id="user_tbl_data">Percentage Pre-final Grade</td>
          <td id="user_tbl_data">Decimal Pre-Final Grade</td>
          <td id="user_tbl_data">Percentage Final Grade</td>
          <td id="user_tbl_data">Decimal Final Grade</td>
        </tr>';

    $table .= '</table>';
  }
  else
  {
    $table .= '
    <table border="1">
        <tr id="user_tbl_head">
          <td id="user_tbl_data">Student No.</td>
          <td id="user_tbl_data">Student Name</td>
          <td id="user_tbl_data">Percentage Midterm Grade</td>
          <td id="user_tbl_data">Percentage Final Grade</td>
        </tr>';

    $table .= '</table>';
  }
}
else
{
  if($parentNotif == 1)
  {
    $table .= '
    <table border="1">
        <tr id="user_tbl_head">
          <td id="user_tbl_data">Student No.</td>
          <td id="user_tbl_data">Student Name</td>
          <td id="user_tbl_data">Percentage Midterm Grade</td>
          <td id="user_tbl_data">Decimal Midterm Grade</td>
          <td id="user_tbl_data">Percentage Pre-final Grade</td>
          <td id="user_tbl_data">Decimal Pre-Final Grade</td>
          <td id="user_tbl_data">Percentage Final Grade</td>
          <td id="user_tbl_data">Decimal Final Grade</td>
        </tr>';

    foreach($rec_from_db as $row)
    {
        $table .= '
        <tr id="user_tbl_content">
          <td id="user_tbl_data">'.$row->StudNo.'</td>
          <td id="user_tbl_data">'.$row->StudName.'</td>
          <td id="user_tbl_data">'.$row->PercMidtermGrade.'</td>
          <td id="user_tbl_data">'.$row->DecMidtermGrade.'</td>
          <td id="user_tbl_data">'.$row->PercPreFinalGrade.'</td>
          <td id="user_tbl_data">'.$row->DecPreFinalGrade.'</td>
          <td id="user_tbl_data">'.$row->PercFinalGrade.'</td>
          <td id="user_tbl_data">'.$row->FinalGrade.'</td>
        </tr>';
    }

    $table .= '</table>';
  }
  else
  {
    $table .= '
    <table border="1">
        <tr id="user_tbl_head">
          <td id="user_tbl_data">Student No.</td>
          <td id="user_tbl_data">Student Name</td>
          <td id="user_tbl_data">Percentage Midterm Grade</td>
          <td id="user_tbl_data">Percentage Final Grade</td>
        </tr>';

    foreach($rec_from_db as $row)
    {
        $table .= '
        <tr id="user_tbl_content">
          <td id="user_tbl_data">'.$row->StudNo.'</td>
          <td id="user_tbl_data">'.$row->StudName.'</td>
          <td id="user_tbl_data">'.$row->PercMidtermGrade.'</td>
          <td id="user_tbl_data">'.$row->PercFinalGrade.'</td>
        </tr>';
    }

    $table .= '</table>';
  }
}

$pdf->writeHTMLCell(0, 0, '', '', $table, 0, 1, 0, true, 'C', true);


// -----------------------------------------------------------------------------
//Close and output PDF document
ob_clean();
$pdf->Output('Grades for '.$SubjCode.'.pdf', 'I');
//============================================================+
// END OF FILE
