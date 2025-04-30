<?php 
 
require 'vendor/autoload.php'; // if using composer
use Dompdf\Dompdf;

$imagePath = FCPATH . 'assets/images/Capture.PNG';

if (file_exists($imagePath)) {
    $imageData = base64_encode(file_get_contents($imagePath));
    $logoBase64 = 'data:image/PNG;base64,' . $imageData;
} else {
    $logoBase64 = '';
}

$data['logoBase64'] = $logoBase64;

 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Request for Claim Inquiry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        padding: 30px;
        font-family: DejaVu Sans, sans-serif;
        font-size: 12px;
    }

    .section {
        border: 1px solid #000;
        padding: 20px;
        margin-top: 20px;
        border-radius: 5px;
    }

    .title {
        font-size: 24px;
        font-weight: bold;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    .small-text {
        font-size: 12px;
    }

    .box {
        border: 1px solid #000;
        padding: 10px;
        min-height: 50px;
    }

    .checkbox {
        display: inline-block;
        width: 18px;
        height: 18px;
        border: 1px solid #000;
        margin-right: 5px;
        vertical-align: middle;
    }
    </style>
</head>

<body>

    <div class="container">
        <?php if (!empty($logoBase64)): ?>
            <img src="<?= $logoBase64 ?>" style="height: 45px; margin-bottom:-20px;" alt="CommunityCare Logo">
        <?php endif; ?>
        <div class="text-center" style="margin-bottom:-30px;">

            <div class="title"> <b>Request for Claim Inquiry</b> </div>
        </div>
        <hr>

        <table style="width: 100%; border-collapse: collapse; margin-top: -800px;">
            <tr>
                <td style="width: 70%; padding-right: 20px; vertical-align: top;">
                    <p>
                        This form cannot be used to request a formal appeal, refer to the grievance and appeals chapter
                        of
                        the provider manual for more information.<br>
                        Submit this form with all supporting documentation to:
                    </p>
                    <p style="margin-top: -15px; padding-left:40px;">
                        CommunityCare<br>
                        PO Box 3249<br>
                        Tulsa, OK 74101-3249<br>
                    </p>
                    <p style="margin-top:-8px; "> Fax: 918-879-4357</p>
                </td>

                <!-- Right Column -->
                <td style="width:30%; min-width: 300px; box-sizing: border-box; margin-top: -20px;">
                    <table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
                        <tr>
                            <td style="border: 1px solid #000;  padding: 8px; ">Contact Name :</td>
                            <td style="border: 1px solid #000; padding: 8px;"><?php echo $data['name'];?></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 8px; ">Date:</td>
                            <td style="border: 1px solid #000; padding: 8px; "><?php echo date('m/d/Y', strtotime($data['date'])); ?></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 8px;">Phone Number</td>
                            <td style="border: 1px solid #000; padding: 8px; ">918-935-3240</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 8px; ">Fax Number</td>
                            <td style="border: 1px solid #000; padding: 8px; ">918-935-3241</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="row" style=" margin-top: -10px; ">
            <table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
                <!-- First Row -->
                <tr>
                    <td style="border: 1px solid #000; padding: 8px; text-align: left;">
                        Provide Name :
                    </td>
                    <td style="border: 1px solid #000; padding: 8px; text-align: left;">
                        <?php echo $data['pname'];?>
                    </td>
                    <td style="border: 1px solid #000; padding: 8px; text-align: left;">
                        Tax ID Number :
                    </td>
                    <td style="border: 1px solid #000; padding: 8px; text-align: left;">
                        <?php echo $data['taxno'];?>
                    </td>
                </tr>

            </table>
        </div>

        <div style="flex: 1; padding-right: 20px; margin-top: -5px; ">
            <p>
                This form is intended for use with single claims. If submting muliple, please attach a separate list.
            </p>

        </div>

        <div class="row" style=" margin-top: -10px; ">
            <table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
                <!-- First Row -->
                <tr>
                    <td style="border: 1px solid #000; padding: 8px; text-align: left;">
                        Member Name :
                    </td>
                    <td style="border: 1px solid #000; padding: 8px; text-align: left;">
                        <?php echo $data['mname'];?>
                    </td>
                    <td style="border: 1px solid #000; padding: 8px; text-align: left;">
                        Member ID :
                    </td>
                    <td style="border: 1px solid #000; padding: 8px; text-align: left;">
                        <?php echo $data['memberid'];?>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 8px; text-align: left;">
                        Claim Number :
                    </td>
                    <td style="border: 1px solid #000; padding: 8px; text-align: left;">
                        <?php echo $data['claimno'];?>
                    </td>
                    <td style="border: 1px solid #000; padding: 8px; text-align: left;">
                        Date of Service :
                    </td>
                    <td style="border: 1px solid #000; padding: 8px; text-align: left;">
                        <?php echo date('m/d/Y', strtotime($data['dos'])); ?>
                    </td>
                </tr>

            </table>
        </div>

        <div style=" margin-top: -8px; ">
            <p>
                Reason for request (please check one and provide explanation):
            </p>

        </div>

        <div class="row" style=" margin-top: -9px; ">
            <table
                style="width: 100%; border-collapse: collapse; border: 1px solid #000; font-family: Arial, sans-serif; font-size: 14px;">
                <!-- First Row -->
                <tr>
                    <td style="border: 1px solid #000; padding: 8px;">
                        <label style="display: flex; align-items: center;">
                            <input type="checkbox" style="margin-right: 8px;"> Authorization
                        </label>
                    </td>
                    <td style="border: 1px solid #000; padding: 8px;">
                        <label style="display: flex; align-items: center;">
                            <input type="checkbox" style="margin-right: 8px;"> COB
                        </label>
                    </td>
                    <td style="border: 1px solid #000; padding: 8px;">
                        <label style="display: flex; align-items: center;">
                            <input type="checkbox" style="margin-right: 8px;"> Benefits
                        </label>
                    </td>
                    <td style="border: 1px solid #000; padding: 8px;">
                        <label style="display: flex; align-items: center;">
                            <input type="checkbox" style="margin-right: 8px;"> Timely filing
                        </label>
                    </td>
                </tr>

                <!-- Second Row -->
                <tr>
                    <td style="border: 1px solid #000; padding: 8px;">
                        <label style="display: flex; align-items: center;">
                            <input type="checkbox" style="margin-right: 8px;"> Refund request
                        </label>
                    </td>
                    <td style="border: 1px solid #000; padding: 8px;">
                        <label style="display: flex; align-items: center;">
                            <input type="checkbox" style="margin-right: 8px;"> Recoupment
                        </label>
                    </td>
                    <td style="border: 1px solid #000; padding: 8px;">
                        <label style="display: flex; align-items: center;">
                            <input type="checkbox" style="margin-right: 8px;"> Corrected claim
                        </label>
                    </td>
                    <td style="border: 1px solid #000; padding: 8px;">
                        <label style="display: flex; align-items: center;">
                            <input type="checkbox" checked style="margin-right: 8px;"> Other
                        </label>
                    </td>
                </tr>

                <tr>
                    <td colspan="4" style="border: 1px solid #000; padding: 8px;">
                        <label style="display: flex; align-items: center;">
                            <input type="checkbox" style="margin-right: 8px;"> Incorrect payment or denial based on
                            contract (attach supporting documentation)
                        </label>
                    </td>
                </tr>
            </table>
        </div>

        <div class="row" style="padding-top: 10px;">
            <table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">

                <tr>
                    <td colspan="3" style="border: 1px solid #000; padding: 8px; text-align: left;">
                        Remark :
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="border: 1px solid #000; padding: 8px; text-align: left;">
                        <b>Dear CommunityCare Claims Department,</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="border: 1px solid #000; padding: 8px; text-align: left;">
                        <b>Please refer to the attached medical records for the above-mentioned patient's service.</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="border: 1px solid #000; padding: 8px; text-align: left;">
                        <b>Please process this claim as soon as possible and provide us reimbursement for the services.</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="border: 1px solid #000; padding: 8px; text-align: left;">
                        <b>Thank you.</b>
                    </td>
                </tr>


            </table>
        </div>

        <div class="mt-4">
            <p class="large-text"><strong>Please fill out this form completely.</strong> Questions? Call customer
                service at 918-594-5207 or 877-321-0018</p>
            <p class="large-text" style="  margin-top: -10px;">
                This form and any accompanying documentation must be submitted within 180 days* from the date on the
                Explanation of Payment (EOP). Inquiries submitted without all necessary documentation and/or inquiries
                submitted after the timeframe are not eligible for reconsideration.
            </p>
            <p class="large-text">
                *as per outlined limit within provider agreement.
            </p>
        </div>

        <footer class="mt-4">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 70%;  padding-right: 20px; vertical-align: top;">
                        <p class="large-text text-muted">
                            William Center Tower II | Two West Second Street, Suite 100 | Tulsa, Oklahoma 74103
                            918.594.5200 | Toll Free 1.800.722.1353 | TTY/TDD 1.800.722.1353
                        </p>
                    </td>

                    <!-- Right Column -->
                    <td style="width: 30%; min-width: 100px; box-sizing: border-box; margin-top: 20px;">
                        <p class="large-text text-muted">Rev. 03/28/2022</p>
                    </td>
                </tr>
            </table>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>