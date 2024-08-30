<?php
include_once('header.php');
require_once('./fpdf/fpdf.php');

$sql_view = "SELECT tcm.*,  tpy.payment_type, ts.state_name
            FROM tbl_cash_memo tcm
            LEFT JOIN tbl_payment_type tpy ON tcm.payment_type_id = tpy.payment_type_id
            LEFT JOIN tbl_state ts ON tcm.place_of_supply_id = ts.state_id WHERE cash_memo_id  = '" . $_GET['id'] . "'  ";
$rs_view = mysqli_query($con, $sql_view);
if (!$rs_view) 
{
    die('No Record Found.' . mysqli_error($con));
}
$row_view = mysqli_fetch_array($rs_view);


$sql_detail_view = "SELECT tcid.*, ti.item_name 
                    FROM tbl_cash_memo_detail tcid
                    LEFT JOIN tbl_item ti ON tcid.product_id = ti.item_id
                    WHERE cash_memo_id = '" . $_GET['id'] . "'";
$rs_detail_view = mysqli_query($con, $sql_detail_view);
if (!$rs_detail_view) 
{
    die('No Detail Record Found.' . mysqli_error($con));
}
$query_company = "SELECT * FROM tbl_company";
$result_company = mysqli_query($con, $query_company);
$company_data = mysqli_fetch_assoc($result_company);

function getIndianCurrency1(float $number)
    {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(0 => '', 1 => 'one', 2 => 'two',
            3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
            7 => 'seven', 8 => 'eight', 9 => 'nine',
            10 => 'ten', 11 => 'eleven', 12 => 'twelve',
            13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
            16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
            19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
            40 => 'forty', 50 => 'fifty', 60 => 'sixty',
            70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
        $digits = array('', 'hundred','thousand','lakh', 'crore');
        while( $i < $digits_length ) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        // echo $decimal;
    //    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? $Rupees . 'Rupees ' : '');
    }

    $number_show =  $row_view['sub_total'];
    $paidAmountInWords1 =  getIndianCurrency1($number_show);

// Create PDF
$pdf = new FPDF('P', 'mm', "A4");
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 20);
// Add Title
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(189, 10, 'Cash Memo Invoice', 0, 1, 'C');
$pdf->Ln(5);

// Add Company Name and Details
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(189, 10,   $company_data['company_name'], 1, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(189, 10, 'Address: ' . $company_data['address'], 1, 1, 'C');
$pdf->Cell(189, 10, 'Email: ' . $company_data['email'], 1, 1, 'C');
$pdf->Cell(189, 10, 'Mobile: ' . $company_data['phone'], 1, 1, 'C');

// Bill To Section
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(94.5, 10, 'Bill To', 0, 0, 'L');
$pdf->Cell(94.5, 10, '', 0, 1); 
// Party Name, Contact No, Email, and Address
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 5, 'Party Name:', 1, 0);
$pdf->Cell(160, 5, $row_view['customer_name'], 1, 1);
$pdf->Cell(30, 5, 'Contact No:', 1, 0);
$pdf->Cell(160, 5, $row_view['mobile_no'], 1, 1);
// $pdf->Cell(30, 5, 'Email:', 0, 0);
// $pdf->Cell(130, 5, $row_view['email'], 0, 1);
// $pdf->Cell(30, 5, 'Address:', 0, 0);
// $pdf->MultiCell(130, 5, $row_view['address'], 0, 'L');
$pdf->Cell(30, 5, 'State:', 1, 0);
$pdf->MultiCell(160, 5, $row_view['state_name'], 1, 'L');
$pdf->Ln(5);



// **Right Corner Information**
$currentY = $pdf->GetY();
$newY = $currentY - 20;

// Move pointer upward
$pdf->SetY($newY);
$pdf->SetFont('Arial', 'B', 15);
// $pdf->Cell(102.5, 10, 'Details', 0, 1, 'R');
$pdf->Cell(95, 10, '', 0, 0); // Empty cell for spacing

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(60, 5, 'Cash Memo Date:', 1, 0, 'R');
$pdf->Cell(30, 5, date('d F Y', strtotime($row_view['cash_memo_date'])), 0, 0, 'R');
$pdf->Ln(5); 

$pdf->Cell(95, 5, '', 0, 0); // Empty cell for spacing
$pdf->Cell(60, 5, 'Payment Type:', 1, 0, 'R');
$pdf->Cell(30, 5, $row_view['payment_type'], 0, 0, 'R');
$pdf->Ln(5); 

$pdf->Cell(95, 5, '', 0, 0); // Empty cell for spacing
$pdf->Cell(60, 5, 'Invoice No:', 1, 0, 'R');
$pdf->Cell(30, 5, $row_view['invoice_no'], 0, 1, 'R');
$pdf->Ln(10);
// Table Header
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(189, 10, 'Details', 1, 1, 'C');

$pdf->Cell(40, 6, 'Items', 1, 0, 'C');
$pdf->Cell(20, 6, 'Qty', 1, 0, 'C');
$pdf->Cell(25, 6, 'Rate', 1, 0, 'C');
$pdf->Cell(25, 6, 'G Total', 1, 0, 'C');
$pdf->Cell(25, 6, 'Discount', 1, 0, 'C');
$pdf->Cell(20, 6, 'GST', 1, 0, 'C');
$pdf->Cell(34, 6, 'Amount (Net)', 1, 1, 'C');

// Calculate totals
$total_qty = 0;
$total_rate = 0;
$total_gtotal = 0;
$total_discount = 0;
$total_gst = 0;
$total_amount = 0;

    // Table Data
    $pdf->SetFont('Arial', '', 10);
    while ($row_detail_fetch = mysqli_fetch_array($rs_detail_view)) {
    $gtotal = $row_detail_fetch['qty'] * $row_detail_fetch['rate'];
    $amount = $gtotal - $row_detail_fetch['discount_amt'] + $row_detail_fetch['gst_amt'];

    // Increment totals
    $total_qty += $row_detail_fetch['qty'];
    $total_rate += $row_detail_fetch['rate'];
    $total_gtotal += $gtotal;
    $total_discount += $row_detail_fetch['discount_amt'];
    $total_gst += $row_detail_fetch['gst_amt'];
    $total_amount += $amount;

    $pdf->Cell(40, 6, $row_detail_fetch['item_name'], 1, 0);
    $pdf->Cell(20, 6, $row_detail_fetch['qty'], 1, 0, 'R');
    $pdf->Cell(25, 6, $row_detail_fetch['rate'], 1, 0, 'R');
    $pdf->Cell(25, 6, $gtotal, 1, 0, 'R');
    $pdf->Cell(25, 6, $row_detail_fetch['discount_amt'], 1, 0, 'R');
    $pdf->Cell(20, 6, $row_detail_fetch['gst_amt'], 1, 0, 'R');
    $pdf->Cell(34, 6, $amount, 1, 1, 'R'); 
}

// Print the totals at the bottom of the PDF
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 6, 'Totals', 1, 0, 'C');
$pdf->Cell(20, 6, $total_qty, 1, 0, 'R');
$pdf->Cell(25, 6, $total_rate, 1, 0, 'R');
$pdf->Cell(25, 6, $total_gtotal, 1, 0, 'R');
$pdf->Cell(25, 6, $total_discount, 1, 0, 'R');
$pdf->Cell(20, 6, $total_gst, 1, 0, 'R');
$pdf->Cell(34, 6, $total_amount, 1, 1, 'R');

// Total Section
$pdf->SetFont('Arial', 'B', 12);
// $pdf->Cell(135, 10, 'Discount:', 0, 0, 'R');
// $pdf->Cell(54, 10, $row_view['discount'], 1, 1);

$pdf->Cell(135, 10, 'Net Total:', 1, 0, 'R');
$pdf->Cell(54, 10, $row_view['sub_total'], 1, 0, 'R');

$pdf->Ln(10); // Add spacing

// In Words
$pdf->Cell(189, 10, '(In Words): ' . $paidAmountInWords1, 1, 1, 'L');

$pdf->Ln(15);
// Terms and Conditions Section
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(189, 10, 'Terms and Conditions:', 0, 1);

$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(189, 10, "Please Note, Tax Will not be refunded.\nSubject to SURAT Jurisdiction. E & O.E.", 0, 'L');



// Save PDF to a file
$pdfPath = './fpdf/cash_memo_' . $_GET['id'] . '.pdf';
$pdf->Output($pdfPath, 'F');



// Provide a link for downloading the PDF
// echo '<a href="'.$pdfPath.'" target="_blank">Download PDF</a>';
?>


<!-- Content wrapper start -->
<div class="content-wrapper">

    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <!-- Card start -->
            <div class="card">
                <div class="card-body">

                    <div class="invoice-container">

                        <div class="invoice-header">
                            <!-- Row start -->
                            <div class="row justify-content-between">
                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">
                                    <!-- <a href="index.html" class="invoice-logo">
                                        <img src="img/logo.svg" alt="Meow Admin Dashboard">
                                    </a> -->
                                </div>
                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">
                                   <strong style="font-size: 34px; font-family: Arial, sans-serif;text-align: center;">Cash Memo Invoice</strong>
                                </div>
                            </div>
                            <!-- Row end -->
                        </div>
                         <!-- Company details label -->
                         <h3>Company Details</h3>
                         <!-- Company details after sales invoice -->
                         <div class="company-details">
                            <!-- Replace 'Your Company Name' and other details with actual company information -->
                            <h2><?php echo $company_data['company_name']; ?></h2>
                            <p>Address: <?php echo $company_data['address']; ?></p>
                            <p>Contact: <?php echo $company_data['phone']; ?></p>
                            <p>Email: <?php echo $company_data['email']; ?></p>
                        </div>

                        <!-- Row start -->
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="invoice-details">
                                    <address class="m-0">
                                       <div>Party Name :- <?php echo $row_view['customer_name']; ?></div>
                                       <div>Contact No :- <?php echo $row_view['mobile_no']; ?></div>
                                       <!-- <div>E-mail :- <?php echo $row_view['email']; ?></div>
                                       <div>Address :- <?php echo $row_view['address']; ?></div> -->
                                        <div>State :-<?php echo $row_view['state_name']; ?></div>
                                        <!-- San Francisco, California(CA), 94124 -->
                                    </address>

                                    <div class="invoice-num">
                                    <address class="m-0">
                                        
                                        <div> Purchase  Date :-
                                            <?php
                                            $purchase_date_timestamp = strtotime($row_view['cash_memo_date']);
                                            echo date('d F Y', $purchase_date_timestamp);
                                            ?>
                                        </div>
                                        <div>Payment Type :- <?php echo $row_view['payment_type']; ?></div>
                                        <div>Invoice No :- <?php echo $row_view['invoice_no']; ?></div>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Row end -->

                        <!-- Row start -->
                        <div class="row gutters">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Items</th>
                                                <th>Qty</th>
                                                <th>Rate</th>
                                                <th>G Total</th>
                                                <th>Discount</th>
                                                <th>GST</th>
                                                <th>Amount (Net)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                              function getIndianCurrency(float $number)
                                              {
                                             $decimal = round($number - ($no = floor($number)), 2) * 100;
                                             $hundred = null;
                                             $digits_length = strlen($no);
                                             $i = 0;
                                             $str = array();
                                             $words = array(0 => '', 1 => 'one', 2 => 'two',
                                                 3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
                                                 7 => 'seven', 8 => 'eight', 9 => 'nine',
                                                 10 => 'ten', 11 => 'eleven', 12 => 'twelve',
                                                 13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
                                                 16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
                                                 19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
                                                 40 => 'forty', 50 => 'fifty', 60 => 'sixty',
                                                 70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
                                             $digits = array('', 'hundred','thousand','lakh', 'crore');
                                             while( $i < $digits_length ) {
                                                 $divider = ($i == 2) ? 10 : 100;
                                                 $number = floor($no % $divider);
                                                 $no = floor($no / $divider);
                                                 $i += $divider == 10 ? 1 : 2;
                                                 if ($number) {
                                                     $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                                                     $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                                                     $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
                                                 } else $str[] = null;
                                             }
                                             $Rupees = implode('', array_reverse($str));
                                          //    echo $decimal;
                                          //    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
                                             return ($Rupees ? $Rupees . 'Rupees ' : '');
                                         }
                                          
                                          
                                              
                                            $number_show =  $row_view['sub_total'];
                                            $paidAmountInWords =  getIndianCurrency($number_show);
                                            $total_qty = 0;
                                            $total_rate = 0;
                                            $total_discount = 0;
                                            $total_gst = 0;
                                            $total_gtotal = 0;
                                            $total_amt = 0;
                                            $sql_detail_view1 = "SELECT tcid.*, ti.item_name 
                                                                FROM tbl_cash_memo_detail tcid
                                                                LEFT JOIN tbl_item ti ON tcid.product_id = ti.item_id
                                                                WHERE cash_memo_id = '" . $_GET['id'] . "'";
                                            $rs_detail_view1 = mysqli_query($con, $sql_detail_view1);
                                            if (!$rs_detail_view1) 
                                            {
                                                die('No Detail Record Found.' . mysqli_error($con));
                                            }
                                            while ($row_detail_fetch = mysqli_fetch_array($rs_detail_view1)) {
                                                $gtotal = $row_detail_fetch['qty'] * $row_detail_fetch['rate'];
                                                $amount = $gtotal - $row_detail_fetch['discount_amt'] + $row_detail_fetch['gst_amt'];
                                                $total_qty += $row_detail_fetch['qty'];
                                                $total_rate += $row_detail_fetch['rate'];
                                                $total_gtotal += $gtotal;
                                                $total_discount += $row_detail_fetch['discount_amt'];
                                                $total_gst += $row_detail_fetch['gst_amt'];
                                                $total_amt += $amount;
                                            ?>
                                                <tr>
                                                    <td>
                                                        <h6><?php echo $row_detail_fetch['item_name']; ?></h6>
                                                        <!-- <p>Create quality mockups and prototypes and Design mobile-based features.</p> -->
                                                    </td>
                                                    <td>
                                                        <h6><?php echo $row_detail_fetch['qty']; ?></h6>
                                                    </td>
                                                    <td>
                                                        <h6><?php echo $row_detail_fetch['rate']; ?></h6>
                                                    </td>
                                                    <td>
                                                        <h6><?php echo $gtotal; ?></h6>
                                                    </td>
                                                    <td>
                                                        <h6><?php echo $row_detail_fetch['discount_amt']; ?></h6>
                                                    </td>
                                                    <td>
                                                        <h6><?php echo $row_detail_fetch['gst_amt']; ?></h6>
                                                    </td>
                                                    <td>
                                                        <h6><?php echo $amount; ?></h6>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                             <tr>
                                                <td colspan="7">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>Total</td>
                                                <td><?php echo $total_qty; ?></td>
                                                <td><?php echo $total_rate; ?></td>
                                                <td><?php echo $total_gtotal; ?></td>
                                                <td><?php echo $total_discount; ?></td>
                                                <td><?php echo $total_gst; ?></td>
                                                <td><?php echo $total_amt; ?></td>
                                            </tr>
                                            <tr>
                                            <td colspan="5"><h4 class="mt-2 text-danger"><strong>In Words:</strong></h4><h5 class="mt-2 text-danger"><?php echo $paidAmountInWords; ?> only</h5></td>
                                                <td>
                                                    <!-- <p class="m-0">Discount</p> -->
                                                    <!-- <p class="m-0">Payment Type</p> -->
                                                    <!-- <strong>Sub Total</strong> -->
                                                    <h5 class="mt-2 text-danger">Net Total</h5>
                                                </td>
                                                <td>
                                                    <!-- <strong><?php echo $row_view['net_total']; ?></strong> -->
                                                    <!-- <p class="m-0"><?php echo $row_view['payment_type']; ?></p> -->
                                                    <h5 class="mt-2 text-danger"><?php echo $row_view['sub_total']; ?></h5>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Row end -->

                        <!-- Row start -->
                        <div class="row gutters">

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-start">
                                <h5>Terms and Conditions:</h5>
                                <p>Please Note, Tax Will not be refunded.</p>
                                <p>Subject to SURAT Juridiction. E & O.E.</p>
                                <!-- Add your terms and conditions here -->

                                    <?php
                                    echo '<a href="' . $pdfPath . '" class="btn btn-primary" target="_blank">Download PDF</a>';
                                    ?>
                                </div>
                            </div>

                        </div>
                        <!-- Row end -->

                    </div>

                </div>
            </div>
            <!-- Card end -->

        </div>
    </div>
    <!-- Row end -->

</div>
<!-- Content wrapper end -->

<?php
include_once('footer.php');
?>