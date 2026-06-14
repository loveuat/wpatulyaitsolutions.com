jQuery(document).ready(function ($) {

    $(document).on('click', '.digio-details', function (e) {
        e.preventDefault();

        let entryId = $(this).data('id');

        $.post(digioAdmin.ajaxurl, {
            action: 'get_digio_details',
            entry_id: entryId
        }, function (res) {

            if (!res.success) {
                alert(res.data || 'Something went wrong');
                return;
            }

            let form  = res.data.form_data || {};
            let digio = res.data.digio_data || {};

            let agreementStatus = form.agreement_status || 'Pending';
            let paymentStatus   = form.payment_status || 'Pending';

            let agreementClass =
                agreementStatus.toLowerCase() === 'completed'
                    ? 'digio-success'
                    : 'digio-warning';

            let paymentClass =
                paymentStatus.toLowerCase() === 'paid'
                    ? 'digio-success'
                    : 'digio-danger';

            let html = `
                <div class="digio-popup">

                    <div class="digio-header">
                        <h2>Agreement Details</h2>
                        <button id="digio-close" class="button">✕</button>
                    </div>

                    <div class="digio-status-row">

                        <span class="digio-badge ${agreementClass}">
                            Agreement: ${agreementStatus}
                        </span>

                        <span class="digio-badge ${paymentClass}">
                            Payment: ${paymentStatus}
                        </span>

                    </div>

                    <div class="digio-grid">

                        <div class="digio-card">
                            <h3>Client Information</h3>

                            <div class="digio-row">
                                <strong>Name</strong>
                                <span>${form['name-1'] || '-'}</span>
                            </div>

                            <div class="digio-row">
                                <strong>Phone</strong>
                                <span>${form['phone-1'] || '-'}</span>
                            </div>

                            <div class="digio-row">
                                <strong>Email</strong>
                                <span>${form['email-1'] || '-'}</span>
                            </div>

                            <div class="digio-row">
                                <strong>Entry ID</strong>
                                <span>${res.data.entry_id || '-'}</span>
                            </div>
                        </div>

                        <div class="digio-card">
                            <h3>Agreement Information</h3>

                            <div class="digio-row">
                                <strong>Document ID</strong>
                                <span>${res.data.doc_id || '-'}</span>
                            </div>

                            <div class="digio-row">
                                <strong>Status</strong>
                                <span>${digio.status || '-'}</span>
                            </div>

                            <div class="digio-row">
                                <strong>Created At</strong>
                                <span>${digio.created_at || '-'}</span>
                            </div>

                            <div class="digio-row">
                                <strong>Updated At</strong>
                                <span>${form.digio_updated_at || '-'}</span>
                            </div>
                        </div>

                    </div>

                    <details style="margin-top:20px;">
                        <summary style="cursor:pointer;font-weight:600;">
                            View Complete Response
                        </summary>

                        <pre style="margin-top:10px;background:#f6f7f7;padding:15px;max-height:300px;overflow:auto;">
${JSON.stringify(res.data, null, 2)}
                        </pre>
                    </details>

                </div>
            `;

            $('#digio-modal').html(html).fadeIn();

        }).fail(function () {
            alert('Request failed.');
        });

    });

    $(document).on('click', '#digio-close', function () {
        $('#digio-modal').fadeOut();
    });

    $(document).on('click', '#digio-modal', function (e) {
        if ($(e.target).is('#digio-modal')) {
            $('#digio-modal').fadeOut();
        }
    });

});