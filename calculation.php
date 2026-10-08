<?php

// What user types in each box
$block1 = "";
$block2 = "";
$block3 = "";
$block4 = "";
$block5 = "";

$warning = "";
$showBill = false;

if(isset($_POST['calculate']))
{
    // Get data from the form
    $block1 = $_POST['block1'];
    $block2 = $_POST['block2'];
    $block3 = $_POST['block3'];
    $block4 = $_POST['block4'];
    $block5 = $_POST['block5'];

    // Empty box means the block was not used
    if($block1 == "")
    {
        $block1 = 0;
    }

    if($block2 == "")
    {
        $block2 = 0;
    }

    if($block3 == "")
    {
        $block3 = 0;
    }

    if($block4 == "")
    {
        $block4 = 0;
    }

    if($block5 == "")
    {
        $block5 = 0;
    }


    // Check the input

    if(!is_numeric($block1) || !is_numeric($block2) || !is_numeric($block3) || !is_numeric($block4) || !is_numeric($block5))
    {
        $warning = "Warning: Please enter numbers only.";
    }
    else if($block1 < 0 || $block1 > 200)
    {
        $warning = "Warning: Block 1 must be between 0 and 200 kWh.";
    }
    else if($block2 < 0 || $block2 > 100)
    {
        $warning = "Warning: Block 2 must be between 0 and 100 kWh.";
    }
    else if($block3 < 0 || $block3 > 300)
    {
        $warning = "Warning: Block 3 must be between 0 and 300 kWh.";
    }
    else if($block4 < 0 || $block4 > 300)
    {
        $warning = "Warning: Block 4 must be between 0 and 300 kWh.";
    }
    else if($block5 < 0)
    {
        $warning = "Warning: Block 5 cannot be less than 0 kWh.";
    }
    else
    {
        // Charge for each block
        $charge1 = $block1 * 0.218;
        $charge2 = $block2 * 0.344;
        $charge3 = $block3 * 0.516;
        $charge4 = $block4 * 0.546;
        $charge5 = $block5 * 0.571;

        // Total electricity consumption
        $totalKwh = $block1 + $block2 + $block3 + $block4 + $block5;

        // Total electricity charge
        $totalCharge = $charge1 + $charge2 + $charge3 + $charge4 + $charge5;

        // Minimum charge
        if($totalCharge < 3.00)
        {
            $totalCharge = 3.00;
        }

        // SST
        if($totalKwh > 600)
        {
            $sst = $totalCharge * 0.06;
        }
        else
        {
            $sst = 0;
        }

        // Final bill
        $totalBill = $totalCharge + $sst;

        $showBill = true;
    }
}

?>