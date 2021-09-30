<?php
/** @var ?string $results results from shipping rate request */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Homework task v2.2</title>
    <meta name="description" content="Homework task v2.2">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            max-width: 756px;
            padding: 20px 10px;
            overflow-x: auto;
            margin: auto;
        }

        .mt-4 {
            margin-top: 1.5rem
        }
        label {
            min-width: 120px;
            font-weight: bold;
            align-self: center;
        }

        input {
            width: 100%;
            height: calc(2.125rem + 2px);
            padding: 0.4375rem 1rem;
            font-size: 0.8125rem;
            color: #000000;
            border: 1px solid #dbdfea;
            border-radius: 4px;
        }

        fieldset {
            padding: 20px;
            border-radius: 8px;
            border: 2px solid #bbb;
        }

        legend {
            font-size: 20px;
        }

        fieldset > div {
            display: flex;
            margin-bottom: 10px;
        }

        button {
            padding: 14px 32px;
            background-color: #000;
            color: #fff;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
            border: unset;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Shipment rates</h1>
    <div style="word-break: break-word">
        <?php
        if ($results) {
            echo $results;
        }
        ?>
    </div>
    <form action="/" method="POST" class="mt-4">
        <fieldset>
            <legend>Shipment address</legend>
            <div>
                <label>Address</label>
                <input name="recipient[address1]" value="<?= $_POST['recipient']['address1'] ?? null ?>">
            </div>
            <div>
                <label>City</label>
                <input name="recipient[city]" value="<?= $_POST['recipient']['city'] ?? null ?>">
            </div>
            <div>
                <label>State code</label>
                <input name="recipient[state_code]" value="<?= $_POST['recipient']['state_code'] ?? null ?>">
            </div>
            <div>
                <label>ZIP code</label>
                <input name="recipient[zip]" value="<?= $_POST['recipient']['zip'] ?? null ?>">
            </div>
            <div>
                <label>Country code</label>
                <input name="recipient[country_code]" value="<?= $_POST['recipient']['country_code'] ?? null ?>">
            </div>
        </fieldset>
        <br>
        <fieldset>
            <legend>Shipment items</legend>
            <fieldset>
                <legend>1. item</legend>
                <div>
                    <label>Variant ID</label>
                    <input name="items[0][variant_id]" value="<?= $_POST['items'][0]['variant_id'] ?? null ?>">
                </div>
                <div>
                    <label>Quantity</label>
                    <input name="items[0][quantity]" value="<?= $_POST['items'][0]['quantity'] ?? null ?>">
                </div>
            </fieldset>
            <fieldset class="mt-4">
                <legend>2. item</legend>
                <div>
                    <label>Variant ID</label>
                    <input name="items[1][variant_id]" value="<?= $_POST['items'][1]['variant_id'] ?? null ?>">
                </div>
                <div>
                    <label>Quantity</label>
                    <input name="items[1][quantity]" value="<?= $_POST['items'][1]['quantity'] ?? null ?>">
                </div>
            </fieldset>
        </fieldset>
        <br>
        <div>
            <button type="submit">Get shipping rates</button>
        </div>
    </form>
</div>
</body>
</html>