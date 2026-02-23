<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #000;
            line-height: 1.2;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Header Box Style */
        .header-box {
            border: 1px solid #cec8c8;
            border-radius: 5px;
            padding: 10px;
            margin-top: 0px;
            margin-bottom: 15px;
        }

        .header-table td {
            vertical-align: middle;
        }

        /* Helpers */
        .text-bold {
            font-weight: bold;
        }

        /* PDF Page Layout */
        @page {
            margin: 180px 40px 100px 40px;
        }

        header {
            position: fixed;
            top: -140px;
            left: 0;
            right: 0;
            /* height: 100px; */
            font-size: 12px;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0;
            right: 0;
            height: 60px;
            text-align: center;
            font-size: 10px;
            border-top: 1px solid #000;
            padding-top: 5px;
        }

        /* .hospital-title {
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            color: #2F6E4D;
            font-size: 22px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0;
        } */

        .doc-header {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            margin-top: 5px;
            padding: 5px 0;
            text-align: left;
        }

        /* Medicine Table */
        .med-table {
            width: 100%;
            border: 1px solid #000;
            margin: 15px 0;
            font-size: 11px;
        }

        .med-table th {
            border: 1px solid #000;
            padding: 5px;
            background-color: #f0f0f0;
            font-weight: bold;
        }

        .med-table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <header>
        <!-- <table class="header-table">
            <tr>
                <td style="">
                    <?php
                    $logommch = FCPATH . 'assets/mmchlogo.png';
                    $mmchLogoData = base64_encode(file_get_contents($logommch));
                    $logommch1 = 'data:image/png;base64,' . $mmchLogoData;
                    ?>
                    <img src="<?= $logommch1 ?>" width="45" height="45" alt="MMCH">
                </td>

                <td style="text-align: center;">
                    <h1 class="hospital-title">MAARUTHI MEDICAL CENTRE AND HOSPITALS</h1>
                    <p style="margin: 0px;">Perundurai Road, Erode - 11. &nbsp; ✆ : 0424 - 2264949, 2250517, 2266768,
                        2257091.</p>
                    <p style="margin: 0px;">
                        Web: www.erodediabetesfoundation.org &nbsp;&nbsp;
                        mail:- a.s.senthilvelu@gmail.com
                    </p>
                </td>

                <td style="width: 60px; text-align: right;">
                    <?php
                    $logoPath = FCPATH . 'assets/edf_logo.png';
                    if (file_exists($logoPath)):
                        $logoData = base64_encode(file_get_contents($logoPath));
                        $logoSrc = 'data:image/png;base64,' . $logoData;
                        ?>
                        <img src="<?= $logoSrc ?>" style="height: 45px;" alt="EDF">
                    <?php else: ?>
                        <div style="font-weight:bold; font-size:10px;">EDF</div>
                    <?php endif; ?>
                </td>
            </tr>
        </table> -->
        <?php
        $header = FCPATH . 'assets/prescriptionHeader.png';
        $headerData = base64_encode(file_get_contents($header));
        $headerSrc = 'data:image/png;base64,' . $headerData;
        ?>
        <img src="<?= $headerSrc ?>" width="710" height="70" alt="Prescription Header">

        <div class="doc-header">
            <table style="width: 100%;" style="margin-bottom: 10px;">
                <tr>
                    <td>
                        <span style=" font-size: 16px; font-weight: bold; color: #2F6E4D;">Dr. A. S. SENTHILVELU,</span>
                        <span style="font-size: 10px; color: #2F6E4D; font-weight:bold;">M.D., FICP</span><br>
                        <span style="font-size: 10px;">
                            <i>Consultant Physician, Diabetologist, Ultrasound, Whole body color Doppler applications,
                                Echocardiography, Critical care physician</i></span><br>
                        <p style="font-size: 10px; font-weight: bold; margin: 0px; padding: 0px;">
                            ERODE DIABETES FOUNDATION (EDF). REGIONAL FACULTY FOR CERTIFICATE COURSE IN EVIDENCE BASED
                            DIABETES MANAGEMENT </p>
                    </td>
                </tr>
            </table>
        </div>
    </header>
    <footer>
        <div style="color: #307352;">
            <i>Kindly fix prior appointment by</i> <br>
            Please book an appointment before meeting the doctor. &nbsp; ✆ : <b>97894 94299</b>
        </div>
        <div style="margin-top: 3px;">
            Consultation Timings: 8:00 AM – 2:00 PM & 6:00 PM – 9:00 PM
        </div>
        <?php
        $logoPath1 = FCPATH . 'assets/edfTitleLogo.png'; // Use local file path
        $logoData = base64_encode(file_get_contents($logoPath1));
        $logoSrc1 = 'data:image/png;base64,' . $logoData;
        ?>
        <div style="margin-top: 3px; padding-top: 5px; font-weight: bold; color: #307352; border-top: 1px solid #000;">
            FOR ONLINE / TELECONSULT VISIT &nbsp;|&nbsp; <img src="<?= $logoSrc1 ?>" width="15" height="15"
                alt="EDF Logo" style="position: relative; top: 3px;">
            consult.edftech.in / DR. A. S. SENTHILVELU
        </div>
    </footer>

    <div class="header-box">
        <table style="width: 100%;">
            <tr>
                <td style="width: 65%; vertical-align: top;">
                    <p style="margin:0px;"><span class="text-bold">Name:</span>
                        <?php echo $patientDetails[0]['firstName'] . ' ' . $patientDetails[0]['lastName']; ?>
                    </p>
                    <p style="margin:0px;"><span class="text-bold">Age & Sex:</span>
                        <?php echo $patientDetails[0]['age']; ?> Year(s) / <?php echo $patientDetails[0]['gender']; ?>
                    </p>
                    <p style="margin:0px;" <span class="text-bold">Patient ID:</span>
                        <?php echo $patientDetails[0]['patientId']; ?>
                    </p>
                </td>

                <td style="width: 35%; vertical-align: top; text-align: right;">
                    <p style="margin:0px;">
                        <span class="text-bold">Consult Date:</span>
                        <?php echo date('d M Y', strtotime($consultation['consult_date'])); ?>
                    </p>
                    <p style="margin:0px;">
                        <span class="text-bold">Mobile:</span> <?php echo $patientDetails[0]['mobileNumber'] ?? '-'; ?>
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <?php if (!empty($consultation['symptoms'])): ?>
        <div style="margin-bottom: 10px;">
            <span class="text-bold">Symptoms:</span>
            <span>
                <?php
                $items = [];
                foreach ($consultation['symptoms'] as $symptom) {
                    $name = trim($symptom['symptom_name'] ?? $symptom['symptom']);
                    $details = [];
                    if (!empty($symptom['since']))
                        $details[] = "since " . trim($symptom['since']);
                    if (!empty($symptom['severity']))
                        $details[] = trim($symptom['severity']);

                    if (!empty($details)) {
                        $items[] = $name . " (" . implode(', ', $details) . ")";
                    } else {
                        $items[] = $name;
                    }
                }
                echo implode(', ', $items) . '.';
                ?>
            </span>
        </div>
    <?php endif; ?>

    <?php if (!empty($consultation['diagnosis'])): ?>
        <div style="margin-bottom: 10px;">
            <span class="text-bold">Diagnosis:</span>
            <span>
                <?php
                $items = [];
                foreach ($consultation['diagnosis'] as $diagnosis) {
                    $dName = isset($diagnosis['diagnosis_name']) ? $diagnosis['diagnosis_name'] : $diagnosis['name'];
                    $name = trim($dName);

                    $details = [];
                    if (!empty($diagnosis['since']))
                        $details[] = "since " . trim($diagnosis['since']);
                    if (!empty($diagnosis['severity']))
                        $details[] = trim($diagnosis['severity']);

                    if (!empty($details)) {
                        $items[] = $name . " (" . implode(', ', $details) . ")";
                    } else {
                        $items[] = $name;
                    }
                }
                echo implode(', ', $items) . '.';
                ?>
            </span>
        </div>
    <?php endif; ?>

    <?php if (!empty($consultation['medicines'])): ?>
        <table class="med-table">
            <thead>
                <tr>
                    <th rowspan="2" style="width: 30px;">Rx</th>
                    <th rowspan="2" style="width: 200px;">Name</th>
                    <th rowspan="2" style="width: 40px;">Qty</th>
                    <th rowspan="2">Food<br>Timing</th>
                    <th colspan="4">Frequency</th>
                    <th rowspan="2" style="width: 150px;">Notes</th>
                </tr>
                <tr>
                    <th>Mrn</th>
                    <th>Aft</th>
                    <th>Eve</th>
                    <th>Ngt</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($consultation['medicines'] as $index => $medicine): ?>
                    <?php
                    $timingString = isset($medicine['timing']) ? trim($medicine['timing']) : '0-0-0-0';
                    $timingParts = preg_split('/\s*-\s*/', $timingString);
                    $timingParts = array_pad($timingParts, 4, '0');
                    list($morning, $afternoon, $evening, $night) = $timingParts;
                    ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td style="text-align: left;">
                            <?php if (!empty($medicine['category']) && strtolower($medicine['category']) !== 'nil'): ?>
                                <span style="font-size: 10px; color: #555;"><?= htmlspecialchars($medicine['category']) ?></span>
                            <?php endif; ?>

                            <strong style="font-size: 13px;"><?= htmlspecialchars($medicine['medicine_name']) ?></strong>

                            <?php if (!empty($medicine['composition_name']) && strtolower($medicine['composition_name']) !== 'nil'): ?>
                                <br><span
                                    style="font-size: 11px; font-style: italic; color: #444;"><?= htmlspecialchars($medicine['composition_name']) ?></span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($medicine['quantity'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($medicine['food_timing'] ?? '-') ?></td>
                        <td><?= ($morning !== '0' && $morning !== '-') ? $morning : '-' ?></td>
                        <td><?= ($afternoon !== '0' && $afternoon !== '-') ? $afternoon : '-' ?></td>
                        <td><?= ($evening !== '0' && $evening !== '-') ? $evening : '-' ?></td>
                        <td><?= ($night !== '0' && $night !== '-') ? $night : '-' ?></td>
                        <td style="text-align: left; font-size: 11px;">
                            <?= !empty($medicine['notes']) ? htmlspecialchars($medicine['notes']) : '-' ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php if (!empty($consultation['advices'])): ?>
        <div style="">
            <p class="text-bold" style="margin: 10px 0 2px 0; padding: 0;">Advices:</p>
            <ul style="padding-left: 20px; margin: 0;">
                <?php foreach ($consultation['advices'] as $adv): ?>
                    <li><?= $adv['advice_name'] ?>
                        <?php if (!empty($adv['note'])): ?>
                            - <?= htmlspecialchars($adv['note']) ?>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (!empty($consultation['instructions'])): ?>
        <div style="">
            <p class="text-bold" style="margin: 15px 0 2px 0;">Instructions:</p>
            <ul style="padding-left: 20px; margin: 0;">
                <?php foreach ($consultation['instructions'] as $ins): ?>
                    <li><?= $ins['instruction_name'] ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (!empty($consultation['next_follow_up'])): ?>
        <div style="margin-top: 15px;">
            <span class="text-bold">Next Follow-Up Date:</span>
            <?= date("d M Y", strtotime($consultation['next_follow_up'])) ?>
        </div>
    <?php endif; ?>

    <table style="width: 100%; margin-top: 0px;">
        <tr>
            <td style="text-align: right; vertical-align: bottom;">
                <div style="display: inline-block; text-align: center;">
                    <?php
                    $sigPath = FCPATH . 'assets/Signature.jpeg';
                    if (file_exists($sigPath)):
                        $sigData = base64_encode(file_get_contents($sigPath));
                        $src = 'data:image/jpeg;base64,' . $sigData;
                        ?>
                        <img src="<?= $src ?>" style="height: 60px; width: auto; display: block; margin: 0 auto 5px;">
                    <?php endif; ?>

                    <p style="margin: 0; font-weight: bold;">Dr. A. S. Senthilvelu</p>
                </div>
            </td>
        </tr>
    </table>

</body>

</html>