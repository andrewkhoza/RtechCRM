<?php
$total = 0;
$counter = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    h1, h2 { color: #333; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    th { background-color:rgb(71, 184, 131); color: #FFFFFF;}
    .footer, .notes { margin-top: 20px; font-size: 0.9em; }
    .section { margin-top: 40px; }
  </style>
</head>
<body>

  <h1 style="color:rgb(71, 184, 131)">Quote # </h1>
  <p><strong>Quote Date:</strong> <?= date('Y-m-d') ?><br>
     <strong>Reference#:</strong> <br>
     <strong>Sales Person:</strong> <?= htmlspecialchars($agent->name) . ' ' . htmlspecialchars($agent->lastname) ?></p>

  <h2>Bill To</h2>
  <p><?= htmlspecialchars($client->name) . ' ' . htmlspecialchars($client->lastname) ?><br>
     <?= htmlspecialchars($client->cell) ?></p>

  <h2>Company Details</h2>
  <p>
    <strong><?= htmlspecialchars($contact->company_name) ?></strong><br> 
    <?= htmlspecialchars($contact->building) ?><br>
    <?= htmlspecialchars($contact->street_name) ?>, <?= htmlspecialchars($contact->town) ?>, <?= htmlspecialchars($contact->province) ?> <?= htmlspecialchars($contact->code) ?>, <?= htmlspecialchars($contact->country) ?><br>
    TIN: <?= htmlspecialchars($contact->tin) ?><br>
    Phone: <?= htmlspecialchars($contact->phone) ?> / <?= htmlspecialchars($contact->alt_phone) ?><br>
    Email: <?= htmlspecialchars($contact->email) ?><br>
    Website: <?= htmlspecialchars($contact->website) ?>
  </p>

  <h2>Quote Items</h2>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Item & Description</th>
        <th>Qty</th>
        <th>Rate</th>
        <th>VAT</th>
        <th>Amount</th>
      </tr>
    </thead>
    <tbody>      
      <tr>
        <?php if($device->branch === "UMP"){ ?>
        <td>0</td>
        <td>ASSESSMENT FEE</td>
        <td>1.00</td>
        <td>R120.00</td>
        <td>0.00</td>
        <td>R120.00</td>
        <?php }else{ ?>
        <td>0</td>
        <td>ASSESSMENT FEE</td>
        <td>1.00</td>
        <td>R150.00</td>
        <td>0.00</td>
        <td>R150.00</td>
        <?php } ?>
      </tr>

      <?php foreach($items as $item){ ?>
      <tr>
        <td><?= $counter ?></td>
        <td><?= strtoupper(htmlspecialchars($item->proposed_solution)) ?></td>
        <td>1.00</td>
        <td>R<?= number_format($item->cost, 2) ?></td>
        <td>0.00</td>
        <td>R<?= number_format($item->cost, 2) ?></td>
      </tr>
      <?php 
        $total += $item->cost;
        $counter++;
      } ?>
    </tbody>
  </table>

  <p><strong>Sub Total:</strong> R<?= number_format($total, 2) ?><br>
     <?php if($device->branch === "Nelspruit"){?><strong>Grand Total:</strong> R<?=($device->assessment_fee === "Paid") ? number_format($total, 2) : number_format($total + 150, 2) ?><br>
     <?php }else{?><strong>Grand Total:</strong> R<?=($device->assessment_fee === "Paid") ? number_format($total, 2) : number_format($total + 120, 2) ?><br>
      <?php } ?>
     <strong>Items in Total:</strong> <?= $counter ?></p>

  <div class="notes">
    <strong>Notes:</strong><br>
    Looking forward to your business.<br><br>

    <strong>Payment Details:</strong><br>
    RELEVANT TECHNOLOGIES<br>
    Bank: FNB<br>
    Account Number: 6301 348 0429<br>
    Branch: 250016<br>
    Reference: YOUR NAME
  </div>

  <div class="section">
    <h2>Repairs Terms & Conditions</h2>
    <h3>1. Assessment & Quotation</h3>
    <ul>
      <li>All devices submitted for repair will undergo an assessment to determine the fault and repair cost.</li>
      <li>Quotations are valid for 7 days from the date of issue. Prices may change thereafter.</li>
      <li>Devices must be collected within 14 days if the quote is declined to avoid storage fees.</li>
    </ul>

    <h3>2. Repair Process & Timeframe</h3>
    <ul>
      <li>Turnaround time depends on issue complexity and parts availability.</li>
      <li>Customers will be notified of delays due to parts or other circumstances.</li>
      <li>Relevant Technologies is not responsible for delays from third-party suppliers.</li>
    </ul>

    <h3>3. Parts & Warranty</h3>
    <ul>
      <li>Only high-quality or original parts are used when available.</li>
      <li>Repairs carry a 90-day warranty (excluding accidental or liquid damage and negligence).</li>
      <li>Third-party tampering voids the warranty.</li>
      <li>Software issues are not covered.</li>
    </ul>

    <h3>4. Data & Privacy</h3>
    <ul>
      <li>Customers must back up data before repairs.</li>
      <li>Relevant Technologies is not liable for data loss.</li>
      <li>Customer information is kept confidential.</li>
    </ul>

    <h3>5. Collection & Storage</h3>
    <ul>
      <li>Devices must be collected within 14 days after repair completion.</li>
      <li>R35 per day storage fee applies after 30 days.</li>
      <li>Uncollected devices after 90 days may be sold to recover costs.</li>
    </ul>

    <h3>6. Liability & Indemnity</h3>
    <ul>
      <li>Not responsible for pre-existing issues or damage from prior repairs.</li>
      <li>Not liable for unforeseen hardware failures during or after repairs.</li>
    </ul>

    <h3>7. Payment & Refunds</h3>
    <ul>
      <li>Full payment required before collecting repaired device.</li>
      <li>No refunds unless a workmanship error remains unresolved.</li>
      <li>Disputes must be reported within 7 days of collection.</li>
    </ul>

    <p><strong>By submitting a device for repair, the customer agrees to these terms and conditions.</strong></p>
  </div>

  <div class="footer">
    <p><strong>Contact:</strong><br>
    Relevant Technologies<br>
    Mbombela ABSA Square | University of Mpumalanga<br>
    Phone: 013 001 2937 / 067 676 5757<br>
    Email: info@rtecha.com</p>
  </div>

</body>
</html>
