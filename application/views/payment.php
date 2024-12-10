<!-- Include Midtrans Snap JS -->
<script src="https://app.midtrans.com/snap/snap.js" data-client-key="YOUR_CLIENT_KEY"></script>

<script type="text/javascript">
function payNow() {
    // Dapatkan snap_token dari controller
    $.ajax({
        url: 'Payment/create_payment',
        method: 'GET',
        success: function(response) {
            var result = JSON.parse(response);
            snap.pay(result.snap_token, {
                onSuccess: function(result) {
                    alert("Payment success!");
                },
                onPending: function(result) {
                    alert("Waiting for payment approval!");
                },
                onError: function(result) {
                    alert("Payment failed!");
                }
            });
        }
    });
}
</script>

<!-- Payment Button -->
<button onclick="payNow()">Pay Now</button>