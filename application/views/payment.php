<!DOCTYPE html>
<html>

<head>
    <title>Midtrans Payment</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="YOUR_CLIENT_KEY"></script>
</head>

<body>
    <button id="pay-button">Pay!</button>

    <script>
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function() {
        window.snap.pay('<?= $snapToken; ?>', {
            onSuccess: function(result) {
                alert('Payment success!');
                console.log(result);
            },
            onPending: function(result) {
                alert('Waiting for your payment!');
                console.log(result);
            },
            onError: function(result) {
                alert('Payment failed!');
                console.log(result);
            },
            onClose: function() {
                alert('You closed the popup without finishing the payment');
            }
        });
    });
    </script>
</body>

</html>