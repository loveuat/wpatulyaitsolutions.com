window.onload = function() {

    var options = {

        key: "rzp_test_Ss7LbNUQr9iBtr",

        amount: "1",

        currency: "INR",

        name: "Your Company",

        description: "Payment",

        order_id: "order_Q1xYzAbCdEf",

        handler: function (response){

            console.log(response);

        }

    };

    var rzp = new Razorpay(options);

    rzp.open();

};