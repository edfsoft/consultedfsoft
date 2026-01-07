<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 13px; color: #000; line-height: 1.4; }
        table { width: 100%; border-collapse: collapse; }
        
        /* Header Box Style */
        .header-box { border: 1px solid #cec8c8; border-radius: 5px; padding: 10px; margin-bottom: 15px; }
        
        /* Medicine Table Styles */
        .med-table { width: 100%; border: 1px solid #000; margin-top: 15px; margin-bottom: 15px; }
        .med-table th { border: 1px solid #000; padding: 6px; text-align: center; font-weight: bold; background-color: #f0f0f0; }
        .med-table td { border: 1px solid #000; padding: 6px; text-align: center; vertical-align: middle; }
        
        /* Helpers */
        .text-bold { font-weight: bold; }
        .text-right { text-align: right; }
        .mb-0 { margin-bottom: 0; }
        .mt-2 { margin-top: 10px; }
    </style>
</head>
<body>

    <div class="header-box">
        <table style="width: 100%;">
            <tr>
                <td style="width: 65%; vertical-align: top;">
                    <p class="mb-0"><span class="text-bold">Name:</span> 
                        <?php echo $patientDetails[0]['firstName'] . ' ' . $patientDetails[0]['lastName']; ?>
                    </p>
                    <p class="mb-0"><span class="text-bold">Age & Sex:</span> 
                        <?php echo $patientDetails[0]['age']; ?> Year(s) / <?php echo $patientDetails[0]['gender']; ?>
                    </p>
                    <p class="mb-0"><span class="text-bold">Patient ID:</span> 
                        <?php echo $patientDetails[0]['patientId']; ?>
                    </p>
                </td>
                
                <td style="width: 35%; vertical-align: top; text-align: right;">
                    <p class="mb-0">
                        <span class="text-bold">Date:</span> <?php echo date('d M Y'); ?> | <?php echo date('h:i A'); ?>
                    </p>
                    <p class="mb-0">
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
                if (!empty($symptom['since'])) $details[] = "since " . trim($symptom['since']);
                if (!empty($symptom['severity'])) $details[] = trim($symptom['severity']);
                
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
                if (!empty($diagnosis['since'])) $details[] = "since " . trim($diagnosis['since']);
                if (!empty($diagnosis['severity'])) $details[] = trim($diagnosis['severity']);
                
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
                    
                    <?php if (!empty($medicine['composition']) && strtolower($medicine['composition']) !== 'nil'): ?>
                        <br><span style="font-size: 11px; font-style: italic; color: #444;"><?= htmlspecialchars($medicine['composition']) ?></span>
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

    <?php if (!empty($consultation['instructions'])): ?>
    <div style="margin-bottom: 15px;">
        <p class="mb-0 text-bold">Instructions:</p>
        <ul style="margin-top: 5px; padding-left: 20px;">
            <?php foreach ($consultation['instructions'] as $ins): ?>
                <li><?= $ins['instruction_name'] ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <?php if (!empty($consultation['next_follow_up'])): ?>
    <div style="margin-bottom: 20px;">
        <span class="text-bold">Next Follow-Up Date:</span> 
        <?= date("d M Y", strtotime($consultation['next_follow_up'])) ?>
    </div>
    <?php endif; ?>

    <table style="width: 100%; margin-top: 40px;">
        <tr>
            <td style="text-align: right; vertical-align: bottom;">
                <?php 
                    $sigPath = FCPATH . 'assets/Signature.jpeg'; 
                    if (file_exists($sigPath)): 
                        $sigData = base64_encode(file_get_contents($sigPath));
                        $src = 'data:image/jpeg;base64,' . $sigData;
                ?>
                    <img src="<?= $src ?>" style="height: 60px; width: auto; margin-bottom: 5px;">
                <?php endif; ?>
                
                <p style="margin: 0; font-weight: bold;">Dr. A. S. Senthilvelu</p>
            </td>
        </tr>
    </table>

</body>
</html>