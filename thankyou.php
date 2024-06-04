<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="thankyou.css">
    <title>Thanks for your order!</title>
</head>
<body>

<?php 

// For defining the full name variable
$fullName = filter_input(INPUT_POST, "fullname");

// For defining the address variable
$address = filter_input(INPUT_POST, "address");

// For defining the city variable
$city = filter_input(INPUT_POST, "city");

// For defining the province variable
$province = filter_input(INPUT_POST, "province");

// For defining the postal code variable
$postalCode = filter_input(INPUT_POST, "postal");

//Validating the email
$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

//Validating the postal code
$postalCodePattern = '/^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/'; 
$postalCode = filter_input(INPUT_POST, 'postal', FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>$postalCodePattern))); 

//Validating the credit card number
$creditCardPattern = '/^\d{10}$/'; 
$creditCardNumber = filter_input(INPUT_POST, 'cardnumber', FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>$creditCardPattern))); 

//Validating the quantity fields
$quantity1 = filter_input(INPUT_POST, 'qty1', FILTER_VALIDATE_INT); 
$quantity2 = filter_input(INPUT_POST, 'qty2', FILTER_VALIDATE_INT); 
$quantity3 = filter_input(INPUT_POST, 'qty3', FILTER_VALIDATE_INT); 
$quantity4 = filter_input(INPUT_POST, 'qty4', FILTER_VALIDATE_INT); 
$quantity5 = filter_input(INPUT_POST, 'qty5', FILTER_VALIDATE_INT);

// Calculating the total sum
$quantityFields = [
    $quantity1 => ['productName' => 'iMac', 'price' => 1899.99],
    $quantity2 => ['productName' => 'Razer Mouse', 'price' => 79.99],
    $quantity3 => ['productName' => 'WD HDD', 'price' => 179.99],
    $quantity4 => ['productName' => 'Nexus', 'price' => 249.99],
    $quantity5 => ['productName' => 'Drums', 'price' => 119.99],
];
?>

<?php 

$totalSum = 0;

if ($quantity1 >= 0 && $quantity2 >= 0 && $quantity3 >= 0 && $quantity4 >= 0 && $quantity5 >= 0) {
    foreach ($quantityFields as $quantity => $details) {
        $totalSum += $quantity * $details['price'];
    }
}

?>

    <div class="invoice">
        <?php if($fullName): ?>
            <h2><?= "Thanks for your order $fullName." ?></h2>
        <?php else: ?>
            <h2>Invalid full name.</h2>
        <?php endif ?>

        <h3><?= "Here's a summary of your order:" ?></h3>

        <table>
            <tbody>
                <tr>
                    <td colspan="4">
                        <h3>Address Information</h3> </td>
                </tr>
                <tr>
                    <td class ="alignright"><span class="bold">Address:</span></td>
                    <?php if($address): ?>
                        <td><?= $address ?></td>
                    <?php else: ?>
                        <td>Invalid address.</td>
                    <?php endif ?>
                
                
                    <td class ="alignright"><span class="bold">City:</span></td> 
                    <?php if($city): ?>
                        <td><?= $city ?></td>
                    <?php else: ?>
                        <td>Invalid city.</td>
                    <?php endif ?>
                    </tr>
                <tr>
                <td class ="alignright"><span class="bold">Province:</span></td>
                    <?php if($province): ?>
                        <td><?= $province ?></td>
                    <?php else: ?>
                        <td>Invalid province.</td>
                    <?php endif ?>
                
                    <td class ="alignright"><span class="bold">Postal Code:</span></td>
                    <?php if($postalCode): ?>
                        <td><?= $postalCode ?></td>
                    <?php else: ?>
                        <td>Invalid postal code.</td>
                    <?php endif ?>
                </tr>
                <tr>
                    <td colspan ="2" class="alignright">
                        <span class="bold">Email:</span></td>
                    <?php if($email): ?>
                        <td colspan ="2"><?= $email ?></td>
                    <?php else: ?>
                        <td>Invalid email.</td>
                    <?php endif ?>
                </tr>
            </tbody>
        </table>
        <table>     
        <tbody>
            <tr>    
           <td colspan="3">
            <h3> Order Information </h3>
                    </td>
            </tr>
                <tr>
                   <td> <span class ="bold">Quantity</span></td>
                   <td> <span class ="bold">Description</span></td>
                   <td> <span class ="bold"></span></td>
                </tr>
                <?php
              if ($quantity1) {
                  echo "<tr>";
                  echo "<td>$quantity1</td>";
                  echo "<td>iMac</td>";
                  echo "<td>$1899.99</td>";
                  echo "</tr>";
              }
          ?>
          
          <?php
              if ($quantity2) {
                  echo "<tr>";
                  echo "<td>$quantity2</td>";
                  echo "<td>Razer</td>";
                  echo "<td>$79.99</td>";
                  echo "</tr>";
              }
          ?>
          
          <?php
              if ($quantity3) {
                  echo "<tr>";
                  echo "<td>$quantity3</td>";
                  echo "<td>WD HDD</td>";
                  echo "<td>$179.99</td>";
                  echo "</tr>";
              }
          ?>
          
          <?php
              if ($quantity4) {
                  echo "<tr>";
                  echo "<td>$quantity4</td>";
                  echo "<td>Nexus</td>";
                  echo "<td>$249.99</td>";
                  echo "</tr>";
              }
          ?>
          
          <?php
              if ($quantity5) {
                  echo "<tr>";
                  echo "<td>$quantity5</td>";
                  echo "<td>Drums</td>";
                  echo "<td>$119.99</td>";
                  echo "</tr>";
              }
          ?>
          
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">Totals</td>
                    <td><?= '$ ' . $totalSum ?></td>
                </tr>
            </tfoot>
        </table>

 <p>Thank you for your order!</p>

    </div>

</body>
</html>
