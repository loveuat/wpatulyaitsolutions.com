function startDigio(documentId, identifier, logoUrl, entry_id, formId) {

    /*
    |--------------------------------------------------------------------------
    | CREATE FULLSCREEN OVERLAY
    |--------------------------------------------------------------------------
    */

    // if (!jQuery('#digioRedirectOverlay').length) {

    //     jQuery('body').append(`

    //         <div id="digioRedirectOverlay">

    //             <div class="digio-loader-box">

    //                 <div class="digio-spinner"></div>

    //                 <h3>Please wait...</h3>

    //                 <p>
    //                     Verification completed successfully.<br>
    //                     Redirecting to secure payment page...
    //                 </p>

    //             </div>

    //         </div>

    //     `);

    //     /*
    //     |--------------------------------------------------------------------------
    //     | APPEND CSS
    //     |--------------------------------------------------------------------------
    //     */

    //     jQuery('head').append(`

    //         <style>

    //             #digioRedirectOverlay{

    //                 position: fixed;

    //                 inset: 0;

    //                 width: 100vw;

    //                 height: 100vh;

    //                 background: rgba(0,0,0,0.75);

    //                 z-index: 999999;

    //                 display: none;

    //                 align-items: center;

    //                 justify-content: center;

    //                 backdrop-filter: blur(5px);

    //                 padding: 20px;

    //                 box-sizing: border-box;

    //             }

    //             .digio-loader-box{

    //                 width: 100%;

    //                 max-width: 420px;

    //                 background: #ffffff;

    //                 border-radius: 18px;

    //                 padding: 40px 30px;

    //                 text-align: center;

    //                 box-shadow:
    //                     0 10px 25px rgba(0,0,0,0.15),
    //                     0 20px 60px rgba(0,0,0,0.20);

    //                 animation: popupFade .35s ease;

    //             }

    //             @keyframes popupFade{

    //                 from{

    //                     opacity:0;

    //                     transform: translateY(15px) scale(.98);

    //                 }

    //                 to{

    //                     opacity:1;

    //                     transform: translateY(0) scale(1);

    //                 }

    //             }

    //             .digio-spinner{

    //                 width: 65px;

    //                 height: 65px;

    //                 margin: 0 auto 20px auto;

    //                 border: 5px solid #eeeeee;

    //                 border-top: 5px solid #AB3498;

    //                 border-radius: 50%;

    //                 animation: digioSpin 1s linear infinite;

    //             }

    //             @keyframes digioSpin{

    //                 100%{

    //                     transform: rotate(360deg);

    //                 }

    //             }

    //             .digio-loader-box h3{

    //                 margin: 0 0 10px;

    //                 font-size: 26px;

    //                 line-height: 1.3;

    //                 color: #111;

    //                 font-weight: 700;

    //             }

    //             .digio-loader-box p{

    //                 margin: 0;

    //                 font-size: 15px;

    //                 line-height: 1.8;

    //                 color: #666;

    //             }

    //             @media(max-width:480px){

    //                 .digio-loader-box{

    //                     padding: 30px 20px;

    //                 }

    //                 .digio-loader-box h3{

    //                     font-size: 22px;

    //                 }

    //             }

    //         </style>

    //     `);

    // }

    /*
    |--------------------------------------------------------------------------
    | DIGIO INIT
    |--------------------------------------------------------------------------
    */

    const digio = new Digio({

        environment: 'production',

        logo: logoUrl,

        callback: function (response) {

            console.log('Digio Response:', response);

            /*
            |--------------------------------------------------------------------------
            | FAILED
            |--------------------------------------------------------------------------
            */

            if (response.error_code) {

                sendDigioStatus({

                    status: 'failed',

                    document_id: documentId,

                    identifier: identifier,

                    entry_id: entry_id,

                    form_id: formId,

                    digio_response: response

                });

                  setTimeout(function(){

    window.location.href = '/';

}, 200);
            }

            /*
            |--------------------------------------------------------------------------
            | SHOW CENTER LOADER
            |--------------------------------------------------------------------------
            */

            // jQuery('#digioRedirectOverlay')
            //     .css('display', 'flex')
            //     .hide()
            //     .fadeIn(300);

            /*
            |--------------------------------------------------------------------------
            | SUCCESS AJAX
            |--------------------------------------------------------------------------
            */

            sendDigioStatus({

                status: 'completed',

                document_id: documentId,

                identifier: identifier,

                entry_id: entry_id,

                form_id: formId,

                digio_response: response

            })

            .done(function(res){

                console.log('AJAX Response:', res);

                /*
                |--------------------------------------------------------------------------
                | VALIDATION
                |--------------------------------------------------------------------------
                */

                // if(!res.success){

                //     jQuery('#digioRedirectOverlay').fadeOut(200);

                //    // alert('Order creation failed');

                //     return;
                // }

                // if(!res.data.ref){

                //     jQuery('#digioRedirectOverlay').fadeOut(200);

                //     alert('Reference missing');

                //     return;
                // }

                /*
                |--------------------------------------------------------------------------
                | UPDATE UI MESSAGE
                |--------------------------------------------------------------------------
                */

                // jQuery('.digio-loader-box h3')
                //     .text('Redirecting Securely');

                // jQuery('.digio-loader-box p')
                //     .html(`
                //         Your document verification is complete.<br>
                //         Opening secure payment gateway...
                //     `);

                /*
                |--------------------------------------------------------------------------
                | REDIRECT
                |--------------------------------------------------------------------------
                */

                // setTimeout(function(){

                //     window.location.href =
                //         '/digio-success/?ref=' + res.data.ref;

                // }, 200);

                 setTimeout(function(){

    window.location.href = '/';

}, 200);
            })

            .fail(function(xhr){

                console.log(xhr);

                jQuery('#digioRedirectOverlay').fadeOut(200);

              //  alert('AJAX request failed');

            });

        },

        theme: {

            primaryColor: "#c9a227",

            secondaryColor: "#000000"

        },

        is_iframe: false,

        method: 'otp'

    });

    digio.init();

    digio.submit(documentId, identifier);

}

/*
|--------------------------------------------------------------------------
| AJAX FUNCTION
|--------------------------------------------------------------------------
*/

function sendDigioStatus(pdfdata) {

    return jQuery.ajax({

        url: customScripts.ajax_url,

        method: "POST",

        dataType: 'json',

        data: {

            action: 'digio_update_status',

            payload: JSON.stringify(pdfdata)

        }

    });

}