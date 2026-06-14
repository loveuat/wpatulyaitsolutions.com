<?php
/* Template Name: Razorpay payment Template */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

global $wpdb;

$redirect_url = home_url();

/*
|--------------------------------------------------------------------------
| GET REF
|--------------------------------------------------------------------------
*/

$ref = sanitize_text_field($_GET['ref'] ?? '');

if (empty($ref)) {
    wp_redirect($redirect_url);
    exit;
}

/*
|--------------------------------------------------------------------------
| GET ENTRY ID USING REF
|--------------------------------------------------------------------------
*/

$entry_id = $wpdb->get_var(

    $wpdb->prepare(

        "
        SELECT entry_id
        FROM {$wpdb->prefix}frmt_form_entry_meta
        WHERE meta_key = %s
        AND meta_value = %s
        LIMIT 1
        ",

        'ref',
        $ref

    )

);

if (!$entry_id) {

    wp_redirect($redirect_url);
    exit;

}

/*
|--------------------------------------------------------------------------
| FETCH ALL META
|--------------------------------------------------------------------------
*/

$results = $wpdb->get_results(

    $wpdb->prepare(

        "
        SELECT meta_key, meta_value
        FROM {$wpdb->prefix}frmt_form_entry_meta
        WHERE entry_id = %d
        ",

        $entry_id

    )

);

/*
|--------------------------------------------------------------------------
| CONVERT TO ARRAY
|--------------------------------------------------------------------------
*/

$payment_data = [];

foreach ($results as $row) {

    $payment_data[$row->meta_key] = $row->meta_value;

}

/*
|--------------------------------------------------------------------------
| VALUES
|--------------------------------------------------------------------------
*/

$razorpay_order_id = $payment_data['razorpay_order_id'] ?? '';

$amount = isset($payment_data['number-1'])
    ? (int) $payment_data['number-1']
    : 0;

$payment_status = $payment_data['payment_status'] ?? 'pending';

$razorpay_payment_id = $payment_data['razorpay_payment_id'] ?? '';

$order_created_at = $payment_data['order_created_at'] ?? '';

$name = $payment_data['name-1'] ?? '';

$email = $payment_data['email-1'] ?? '';

$mobile = $payment_data['phone-1'] ?? '';

?>

<style>

.payment-wrapper{
    max-width:900px;
    margin:40px auto;
    padding:30px;
    background:#fff;
    border-radius:10px;
    box-shadow:0 0 15px rgba(0,0,0,0.08);
}

.payment-success{
    background:#d4edda;
    color:#155724;
    padding:15px;
    border-radius:6px;
    margin-bottom:20px;
}

.payment-pending{
    background:#fff3cd;
    color:#856404;
    padding:15px;
    border-radius:6px;
    margin-bottom:20px;
}

.payment-table{
    width:100%;
    border-collapse:collapse;
}

.payment-table th,
.payment-table td{
    border:1px solid #ddd;
    padding:14px;
}

.payment-table th{
    background:#f7f7f7;
    width:250px;
    text-align:left;
}

</style>

<div class="payment-wrapper">

    <h2>Payment Details</h2>

    <div id="payment-message">

        <?php if ($payment_status === 'paid') : ?>

            <div class="payment-success">
                Payment Successful
            </div>

        <?php else : ?>

            <div class="payment-pending">
                Waiting for payment...
            </div>

        <?php endif; ?>

    </div>

    <table class="payment-table">

        <tr>
            <th>Reference</th>
            <td><?php echo esc_html($ref); ?></td>
        </tr>

        <tr>
            <th>Name</th>
            <td><?php echo esc_html($name); ?></td>
        </tr>

        <tr>
            <th>Email</th>
            <td><?php echo esc_html($email); ?></td>
        </tr>

        <tr>
            <th>Mobile</th>
            <td><?php echo esc_html($mobile); ?></td>
        </tr>

        <tr>
            <th>Order ID</th>
            <td><?php echo esc_html($razorpay_order_id); ?></td>
        </tr>

        <tr>
            <th>Payment ID</th>
            <td id="payment-id">
                <?php echo esc_html($razorpay_payment_id); ?>
            </td>
        </tr>

        <tr>
            <th>Amount</th>
            <td>
                ₹<?php echo $amount; ?>
            </td>
        </tr>

        <tr>
            <th>Status</th>
            <td id="payment-status">
                <?php echo esc_html($payment_status); ?>
            </td>
        </tr>

        <tr>
            <th>Order Created At</th>
            <td>
                <?php echo esc_html($order_created_at); ?>
            </td>
        </tr>

    </table>

</div>

<?php get_footer(); ?>

<?php if ($payment_status !== 'paid') : ?>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>

window.onload = function () {

    var options = {

        key: "rzp_test_Ss7LbNUQr9iBtr",

        amount: "<?php echo $amount; ?>",

        currency: "INR",

        name: "Your Company",

        description: "Payment",

        order_id: "<?php echo $razorpay_order_id; ?>",

        prefill: {

            name: "<?php echo esc_js($name); ?>",

            email: "<?php echo esc_js($email); ?>",

            contact: "<?php echo esc_js($mobile); ?>"

        },

        handler: function (response) {

            /*
            |--------------------------------------------------------------------------
            | VERIFY PAYMENT
            |--------------------------------------------------------------------------
            */

            jQuery.ajax({

                url: "<?php echo admin_url('admin-ajax.php'); ?>",

                type: "POST",

                dataType: "json",

                data: {

                    action: "verify_razorpay_payment",

                    entry_id: "<?php echo $entry_id; ?>",

                    ref: "<?php echo esc_js($ref); ?>",

                    razorpay_payment_id:
                        response.razorpay_payment_id,

                    razorpay_order_id:
                        response.razorpay_order_id,

                    razorpay_signature:
                        response.razorpay_signature

                },

                success: function(res){

                    console.log(res);

                    if(res.success){

                        /*
                        |--------------------------------------------------------------------------
                        | UPDATE UI
                        |--------------------------------------------------------------------------
                        */

                        document.getElementById('payment-status')
                            .innerHTML = 'paid';

                        document.getElementById('payment-id')
                            .innerHTML =
                            response.razorpay_payment_id;

                        document.getElementById('payment-message')
                            .innerHTML =
                            '<div class="payment-success">Payment Successful</div>';

                        /*
                        |--------------------------------------------------------------------------
                        | REDIRECT AFTER SUCCESS
                        |--------------------------------------------------------------------------
                        */

                        setTimeout(function(){

                            window.location.href = "<?php echo esc_url($redirect_url); ?>";

                        }, 3000);

                    } else {

                        alert(res.data.message);

                    }

                },

                error: function(){

                    alert('Payment verification failed');

                }

            });

        },

        modal: {

            ondismiss: function(){

                console.log('Popup closed');

            }

        },

        theme: {

            color: "#AB3498"

        }

    };

    var rzp = new Razorpay(options);

    rzp.open();

};

</script>

<?php else : ?>

<script>

setTimeout(function(){

    window.location.href = "<?php echo esc_url($redirect_url); ?>";

}, 3000);

</script>

<?php endif; ?>