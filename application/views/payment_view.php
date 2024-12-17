<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-YOUR_CLIENT_KEY">
    </script>
</head>

<body>
    <h1>Payment</h1>

    <button id="pay-button">Pay Now</button>

    <script>
    var snapToken = '<?= $snap_token ?>';

    document.getElementById('pay-button').addEventListener('click', function() {
        window.snap.pay(snapToken, {
            onSuccess: function(result) {
                alert("Payment successful!");
                console.log(result);
            },
            onPending: function(result) {
                alert("Payment pending.");
                console.log(result);
            },
            onError: function(result) {
                alert("Payment failed.");
                console.log(result);
            },
            onClose: function() {
                alert("You closed the payment popup.");
            }
        });
    });
    </script>
</body>

</html>