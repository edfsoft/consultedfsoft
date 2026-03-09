<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
</head>

<body style="margin:0; padding:0; background-color:#f4f6f9; font-family:Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding:20px;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff; border-radius:8px; overflow:hidden;">

                    <!-- Header -->
                    <tr>
                        <td style="text-align:center;">
                            <img src="https://consult.edftech.in/assets/edf_logo.png" alt="EDF Healthcare" width="145"
                                style="display:block; margin:20px auto;">
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:30px; color:#333;">
                            <?php echo $content; ?>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:15px 30px; color:#333;">
                            <p style="margin:0;">Best regards,</p>
                            <p style="margin:0;"><b>EDF Healthcare Team</b></p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td
                            style="background:#f1f1f1; padding:15px; text-align:center; font-size:12px; color:#666; margin:0px;">
                            © <?php echo date('Y'); ?> EDF Healthcare. All Rights Reserved.
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>