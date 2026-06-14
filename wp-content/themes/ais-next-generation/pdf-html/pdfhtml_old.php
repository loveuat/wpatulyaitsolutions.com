<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Client Agreement - Template</title>
  <link rel="stylesheet" href="agreement-style.css"/>
  <style>

   /*header {
  position: fixed;
  top: -90px;
  left: 0;
  right: 0;
  height: 80px;
  border-bottom: 1px solid #ccc;
  text-align: center;
}*/
.top-header {
  font-size: 16px;
  font-weight: bold;
}
.sub-header {
  font-size: 12px;
  margin-top: 4px;
}
    footer {
      position: fixed;
      bottom: -60px;
      left: 0;
      right: 0;
      height: 40px;
      text-align: center;
      border-top: 1px solid #ccc;
      font-size: 11px;
      color: #666;
    }
    .pagenum:before {
      content: counter(page) " of " counter(pages);
    }

  	/* agreement-style.css: Print-friendly CSS for A4 PDF via dompdf */
@page { size: A4; margin: 22mm 18mm 20mm 18mm; }
* { box-sizing: border-box; }
body { font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 1.5; color: #111; }
.header { display: flex; justify-content: space-between; align-items: center; font-size: 11px; margin-bottom: 10px; padding-bottom: 8px; border-bottom: 1px solid #ddd; }
.doc-title { text-align: center; font-size: 18px; font-weight: 700; text-decoration: underline; margin: 10px 0 14px; }
.sub { text-align: center; font-size: 12px; margin-bottom: 14px; }
.section-title { font-weight: 700; margin: 14px 0 6px; font-size: 13.5px; }
.para { margin: 6px 0; text-align: justify; }
.list { margin: 6px 0 6px 16px; }
.list li { margin: 3px 0; }
.kv { margin: 6px 0; }
.kv b { display: inline-block; min-width: 140px; }
.hr { height: 1px; background: #e5e5e5; margin: 12px 0; }
.page-break { page-break-before: always; }
.sign-blocks { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-top: 22px; }
.sign { border: 1px solid #ddd; padding: 12px; min-height: 110px; }
.sign .label { font-weight: 700; margin-bottom: 6px; }
.mt-8 { margin-top: 8px; }
.mt-12 { margin-top: 12px; }
.mt-16 { margin-top: 16px; }
.footer { position: fixed; left: 0; right: 0; bottom: 8mm; font-size: 10px; color: #666; display: flex; justify-content: space-between; padding: 0 18mm; }
.muted { color: #444; }
.center { text-align: center; }
.underline { text-decoration: underline; }
    /* Inline fallback in case external CSS isn't loaded */
    @page { size: A4; margin: 22mm 18mm 20mm 18mm; }
    * { box-sizing: border-box; }
    body { font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 1.5; color: #111; }
    .top-header { display: flex; justify-content: space-between; align-items: center; font-size: 11px; margin-bottom: 10px; padding-bottom: 8px; border-bottom: 1px solid #ddd; }
    .sub-header { display: flex; justify-content: space-between; align-items: center; font-size: 11px; margin-bottom: 10px; padding-bottom: 8px; border-bottom: 1px solid #ddd; }
    .header .left { font-weight: 600; }
    .header .right { text-align: right; }
    .doc-title { text-align: center; font-size: 18px; font-weight: 700; text-decoration: underline; margin: 10px 0 14px; }
    .sub { text-align: center; font-size: 12px; margin-bottom: 14px; }
    .section-title { font-weight: 700; margin: 14px 0 6px; font-size: 13.5px; }
    .para { margin: 6px 0; text-align: justify; }
    .list { margin: 6px 0 6px 16px; }
    .list li { margin: 3px 0; }
    .kv { margin: 6px 0; }
    .kv b { display: inline-block; min-width: 140px; }
    .hr { height: 1px; background: #e5e5e5; margin: 12px 0; }
    .page-break { page-break-before: always; }
    .sign-blocks { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-top: 22px; }
    .sign { border: 1px solid #ddd; padding: 12px; min-height: 110px; }
    .sign .label { font-weight: 700; margin-bottom: 6px; }
    .mt-8 { margin-top: 8px; }
    .mt-12 { margin-top: 12px; }
    .mt-16 { margin-top: 16px; }
    .footer { position: fixed; left: 0; right: 0; bottom: 8mm; font-size: 10px; color: #666; display: flex; justify-content: space-between; padding: 0 18mm; }
    .muted { color: #444; }
    .center { text-align: center; }
    .underline { text-decoration: underline; }
    .logo { width:300px; height:50px; margin: auto; text-align:center;}
  </style>
</head>
<body>
  <header>
   <div class="top-header">
       <img class="logo" src="{{logo}}">
   </div>
   <div class="sub-header">
       <div class="left">SEBI Registration: {{ra_registration}}</div>
    <div class="right">Email: {{ra_email}}</div>
   </div>
</header>

<footer>
   Page <span class="pagenum"></span>
</footer>


  <!-- Header (appears on first page content; for repeating header use PHP in dompdf) -->
  
  <div class="title">CLIENT CONSENT</div>

<div class="section">
 <p style="text-align:center;"><u><strong>By subscribing to the research services, I acknowledge and agree to the following terms and conditions:</strong></u></p>

  <ol>
    <li><strong>Availing the research services:
      <br></strong> By accepting delivery of the research service, the client confirms that he/she has elected to
subscribe to the research service of the RA at his/her sole discretion. RA confirms that research
services shall be rendered in accordance with the applicable provisions of the RA Regulations.</li>

    <li><strong>Obligation on Research Analyst:<br></strong> RA and client shall be bound by SEBI Act and all the applicable rules and regulations of SEBI,
including the RA Regulations and relevant notifications of Government, as may be in force, from
time to time.
</li>

    <li><strong>Client Information and KYC:<br></strong> The client shall furnish all such details in full as may be required by the RA in its standard form
with supporting details if required, as may be made mandatory by RAASB/SEBI from time to
time. RA shall collect, store, upload and/or check KYC records with the KYC Registration Agency
(KRA) as specified by SEBI from time to time. As a client, I agree to pay service fees and provide
my consent to commence the services after fully understanding the standard terms of service
which are as following:<br>
 A) I / We have read and understood the terms and conditions applicable to a research
analyst as defined under regulation 2(1)(u) of the SEBI (Research Analyst) Regulations, 2014,
including the fee structure.<br>
 B) I/We are subscribing to the research services for our own benefits and consumption, and
any reliance placed on the research report provided by the research analyst shall be as per our
own judgment and assessment of the conclusions contained in the research report.<br>
 C) I/We understand that –<br>
I. Any investment made based on the recommendations in the research report is subject
to market risk.<br>
II. Recommendations in the research report do not provide any assurance of returns.<br>
III. There is no recourse to claim any losses incurred on the investments made based on the<br>
recommendations in the research report..</li>

    <li><strong>Declaration of the Research Analyst that:</strong>
      <ol type="i">
      I. I am duly registered with SEBI as Research Analyst with name of  Pavan Choubey under Registration No.  INH000022792 from  August 20, 2025; BSE Enlistment No.
6643 and compliant with the SEBI (Research Analyst) Regulations, 2014.<br>
II. Currently we have valid SEBI registration and have the required qualifications to
render services contemplated under RA regulations.<br>
III. We have no material adverse disciplinary history or any conflicts of interest that
compromise the integrity of its recommendations.<br>
IV. The maximum fee charged by the Research Analyst shall not exceed Rs 1.51 lakhs
per annum per family of clients.<br>
V. The recommendations provided by us do not provide any assurance of returns.<br>
          <strong>Additionally, I declaration that:</strong><br>
I am not engaged in any additional professional or business activities, on a
whole-time basis or in an executive capacity, which interfere with/influence or have the
potential to interfere with/influence the independence of research report and/or
recommendations contained therein.
</li>
      </ol>
    </li>

    <li><strong>Consideration/mode of payment and Consent:</strong> <br>The client shall duly pay to RA, the agreed fees for the services that RA renders to the client and
statutory charges, as applicable. Such fees and statutory charges shall be payable through the
specified manner and modes communicated by the Research Analyst (including but not limited
to payment gateways or processors like Cashfree, Razorpay, UPI, NEFT, IMPS, Centralised Fee
Collection Mechanism for RA, Cheque, etc.). We may collect 1 year advance fees based
on mutual agreement.<br>
I also give my consent that any future changes or updates made by me in any service shall be deemed to be covered under this consent, and I shall not be required to provide a separate consent for the same each time.</li>

    <li><strong> Risk Factors:</strong>:<br> Investments in securities markets are inherently risky and subject to market
dynamics. Registration granted by SEBI, Enlistment as RA with Exchange and certification from
NISM in no way guarantee performance of the intermediary or provide any assurance of
returns to investors.
</li>
 <li><strong> Conflict of Interest:</strong>:<br> The Research Analyst adheres to SEBI's guidelines on the disclosure and
mitigation of actual or potential conflicts of interest. Full disclosures are provided in each
research report.
.</li>

<li><strong> Termination of service and refund of fees</strong>:<br> The Research Analyst reserves the right to
suspend or terminate the provision of research services to clients in the event of suspension or
cancellation of its registration with SEBI. In case the certificate of registration of the Research
Analyst is suspended for a period exceeding sixty (60) days or is cancelled, the Research Analyst
shall refund the subscription fees to the client on a pro-rata basis for the period from the
effective date of such suspension or cancellation to the end of the subscription period.</li>

<li><strong> Grievance redressal and dispute resolution:</strong>:<br> For any support-related grievances, including
issues related to non-receipt of reports or deficiencies in service, clients must email their
concerns to info@investaxresearch.com. If unresolved, grievances must be escalated to the
designated grievance officer. All grievances will be addressed within 7 (seven) business days or
as per latest SEBI RA Regulations. please check the details of grievance redressel
https://investaxresearch.com/grievance-redressal/</li>

<li><strong> Use of Research Reports:</strong>:<br> All research reports and related information are confidential and intended solely for the
subscriber. Unauthorized distribution, reproduction, or use of these materials is strictly
prohibited. Clients must independently assess all recommendations, and the Research Analyst
assumes no responsibility for any losses incurred.
</li>

<li><strong> Mandatory Notice:</strong>:<br> Clients shall be requested to go through Do’s and Don’ts while dealing
with RA as specified in SEBI master circular no. SEBI/HO/MIRSD-POD- 1/P/CIR/2024/49 dated
May 21, 2024 or as may be specified by SEBI from time to time</li>

<li><strong>Most Important Terms and Conditions (MITC):</strong>:<br>
The terms and conditions and the consent
thereon are for the research services provided by the RA and RA cannot execute or carry out
any trade (purchase/sell transaction) on behalf of the client. Thus, you are advised not to
permit the Research Analyst to execute any trade on their behalf.<br>
<strong>Most Important Terms & conditions:</strong>:<br>
  1. Investments in the securities market are subject to market risks. Read all the related
documents carefully before investing.<br>
2. Registration granted by SEBI, membership of a SEBI-recognized supervisory body (if any) and
certification from NISM in no way guarantee the performance of the intermediary or provide
any assurance of returns to investors.<br>
3. The Fees paid are Non-Refundable (unless the registration is suspended or cancelled by SEBI
as per clause 8)<br>
4. The securities quoted (if any) are for illustration only and are not recommendatory. The
returns displayed (if any) are for informational purposes only and should not be considered
advertisements or promotions influencing your subscription decisions.<br>
5. Recommendations provided may not always result in profits. Not adhering to our
recommendations or allocations may affect the profitability of your portfolio.<br>
6. Investing in equity and related instruments involves uncertainties, including companyspecific and market-related risks. We do not assure guaranteed returns as the value of assets
may fluctuate based on market forces like de-listing of securities or market closures etc.<br>
7. Past performance does not ensure future performance. Notwithstanding all the efforts to do
the best research, clients should understand that investing in equities involves a risk of loss of
both income and principal. Please ensure that you fully understand the risks involved in
investing in equities.<br>
8. There is a possibility of communication failures via electronic means such as Email/WhatsApp messages, which may be beyond our control.

</li>

   <!-- <li><strong>Grievance redressal:</strong> For grievances contact <strong>{{ra_email}}</strong>. If unresolved, escalate as per SEBI processes or visit <a class="muted-link" href="{{grievance_url}}">{{grievance_url}}</a>.</li>-->
  </ol>
</div>

<!--<div class="small">
  <p>Use of Research Reports: All research reports and related information are confidential and intended solely for the subscriber. Unauthorized distribution is prohibited.</p>
</div>-->

<div class="sign">
  <div class="box">
    <div class="small"><strong>For Research Analyst</strong></div>
    <div style="margin-top:8px"><strong>Pavan Choubey</strong></div>
    <div class="small">Investa X Research</div>
    <div style="margin-top:10px" class="small">Date &amp; Signature: ____________________</div>
  </div>

  <div class="box">
    <div class="small"><strong>Client Signature</strong></div>
    <div style="margin-top:8px" class="small">Name: <strong>{{client_name}}</strong></div>
    <div style="margin-top:6px" class="small">PAN: <strong>{{client_pan}}</strong></div>
    <div style="margin-top:10px" class="small">Date &amp; Signature: ____________________</div>
  </div>
</div>

  <div class="doc-title">CLIENT AGREEMENT</div>
  <div class="sub">(As per SEBI Research Analysts Regulations, 2014 and Indian Contract Act, 1872)</div>

  <p class="para">This Agreement is made on this <b>{{agreement_date}}</b> day of <b>{{agreement_month}}</b>, <b>{{agreement_year}}</b>.</p>

  <div class="section-title">By and Between:</div>
  <p class="para"><b>{{ra_name}}</b> ({{ra_brand}}), a SEBI registered Research Analyst bearing registration number <b>{{ra_registration}}</b>, having its registered office at <b>{{ra_address}}</b> (hereinafter referred to as the “Research Analyst” or “RA”),</p>

  <div class="para"><b>AND</b></div>

  <p class="para">Mr./Ms. <b>{{client_name}}</b>, S/O / D/O <b>{{client_father}}</b>, residing at “<b>{{client_address}}</b>” (hereinafter referred to as the “Client”).</p>

  <p class="para">Both parties collectively referred to as the “Parties”.</p>

  <p class="para">Whereas, the Research Analyst is duly registered with the Securities and Exchange Board of India (SEBI) as a Research Analyst having registration No.: <b>{{ra_registration}}</b> under SEBI (Research Analysts) Regulations, 2014;</p>

  <p class="para">And Whereas, the Client desires to avail the research services on its own discretion provided by the Research Analyst, and the Research Analyst agrees to provide such services in accordance with the terms and conditions set forth in this Agreement.</p>

  <p class="para">AND Whereas, both the Research Analyst and the Client shall comply with all applicable regulations, rules, circulars, and amendments issued by SEBI, including the SEBI (Research Analysts) Regulations, 2014.</p>

  <p class="para">Now, Therefore, in consideration of the mutual covenants and promises herein contained, the parties hereto agree as follows:</p>

  <div class="section-title">1. Purpose and Scope</div>
  <p class="para">This Agreement sets forth the terms and conditions under which the Research Analyst shall provide research services and recommendations to the Client in compliance with the SEBI (Research Analysts) Regulations, 2014.</p>

  <div class="section-title">2. Legal Basis</div>
  <ul class="list">
    <li>SEBI (Research Analyst) Regulations, 2014 and subsequent amendments.</li>
    <li>Securities and Exchange Board of India Act, 1992.</li>
    <li>The Indian Contract Act, 1872.</li>
    <li>Information Technology Act, 2000.</li>
    <li>Any other applicable laws, circulars, and guidelines issued by SEBI from time to time.</li>
  </ul>

  <div class="section-title">3. Scope of Services</div>
  <p class="para">The Research Analyst agrees to provide research reports, recommendations, and other permissible services strictly in accordance with SEBI (Research Analyst) Regulations, 2014. <b>Note:</b> No Portfolio Management Services or Execution Services shall be provided, as prohibited under SEBI (Research Analysts) Regulations, 2014.</p>

  <div class="section-title">4. Client’s Declaration &amp; Obligations</div>
  <ul class="list">
    <li>All information provided by the Client is true, correct, and complete as required under the Indian Contract Act, 1872 (Section 17 – Free Consent, Section 18 – Misrepresentation).</li>
    <li>The Client is entering into this Agreement in full senses, without any coercion, undue influence, or misrepresentation.</li>
    <li>The Client undertakes to read and understand all Terms &amp; Conditions, Disclaimer &amp; Disclosure, Investor Charter, MITC on the website carefully before signing this Agreement.</li>
    <li>The Client confirms awareness of the risks involved in securities market investment and does not indemnify the Research Analyst against any direct or indirect loss.</li>
    <li>The Client shall not hold the RA liable for any investment losses resulting from implementation of research services.</li>
    <li>Understand that research services are non-binding recommendations, and not assurances or guarantees of returns.</li>
  </ul>

  <div class="section-title">5. Declaration By Research Analyst</div>
  <ul class="list">
    <li>It is duly registered with SEBI as an RA having Registration No.: <b>{{ra_registration}}</b>, Date of Registration: <b>{{ra_reg_date}}</b>.</li>
    <li>It has registration and qualifications required to render the services contemplated under the RA Regulations, and the same are valid and subsisting.</li>
    <li>The services provided by the RA do not conflict with or violate any provision of law, rule, regulation, contract, or other instrument to which it is a party.</li>
    <li>The maximum fee that may be charged by the RA is <b>₹1.51 lakhs per annum</b> per family of clients. All applicable taxes (GST, etc.) shall be borne by the Client only.</li>
    <li>The recommendations provided by the RA do not provide any assurance of returns.</li>
    <li>The RA is not engaged in any additional professional or business activities on a full-time or executive capacity that may interfere with or influence the independence of the research report and/or recommendations.</li>
    <li>No conflict of interest exists in recommendations provided. Independence and objectivity of views shall be maintained.</li>
  </ul>

  <div class="section-title">6. Risk Disclosure</div>
  <p class="para">The Client acknowledges and understands that the services provided by the Research Analyst involve inherent risks, and the Client agrees to bear full responsibility for any financial or other consequences arising from the use of these services. Investment in the market is always subject to market risk, and the following risks apply:</p>
  <ul class="list">
    <li>Trading in equities, derivatives, and other securities are subject to market risks and there is no assurance or guarantee of returns.</li>
    <li>Past performance does not indicate future performance.</li>
    <li>Research recommendations may not always be profitable, as actual market movements may differ from anticipated trends.</li>
    <li>The Research Analyst is not responsible or liable for any losses resulting from research recommendations.</li>
    <li>Investments are subject to market risks; clients should read all related documents carefully before investing.</li>
    <li>Registration granted by SEBI, BASL, and certification from NISM do not guarantee the performance of the intermediary or provide any assurance of returns to investors.</li>
  </ul>

  <div class="section-title">7. Conflict Of Interest</div>
  <p class="para">The RA shall adhere to the applicable regulations/ circulars/directions specified by SEBI from time to time in relation to disclosure and mitigation of any actual or potential conflict of interest. Some disclosures are as follows:</p>
  <ul class="list">
    <li>The Research Analyst or any of its officer/employee does not trade in securities which are subject matter of recommendation.</li>
    <li>There are no actual or potential conflicts of interest arising from any connection to or association with any issuer of products/securities, including any material information or facts that might compromise its objectivity or independence in the carrying on of Research Analyst services. Such conflict of interest shall be disclosed to the client as and when they arise.</li>
    <li>Research Analyst or its employee or its associates have not received any compensation from the company which is subject matter of recommendation.</li>
  </ul>

  <div class="section-title">8. Validity</div>
  <p class="para">This Agreement will remain in effect for the duration specified in the service package. The Client and Research Analyst may mutually agree to renew the services before the term expires. If not renewed, the Agreement will automatically terminate upon completion of the term.</p>

  <div class="section-title">9. Consideration &amp; Payment Terms</div>
  <p class="para">The Client agrees to make all payments via account payee crossed cheque, demand draft, or direct credit to the Research Analyst's designated bank account through NEFT, RTGS, IMPS, Payment Gateway or UPI. Payments are only accepted in the bank accounts listed on the Research Analyst's official website <b>{{ra_website}}</b>. The Research Analyst shall not be liable for any payments made to accounts other than those specified on the website.</p>
  <ul class="list">
    <li>The Client shall make payments only in the name of “<b>{{ra_brand}}</b>” through official banking channels as communicated by the Research Analyst or mentioned on the website <b>{{ra_website}}</b>.</li>
    <li>No payment shall be made to any individual employee, agent, or personal bank account.</li>
    <li>Any such payment, if made, shall not be recognized by the Research Analyst and the Client shall bear sole responsibility.</li>
    <li>The Client shall not communicate with any employee/representative of the Research Analyst over personal WhatsApp numbers, personal emails, or other informal channels.</li>
    <li>All official communication shall only be through designated official email IDs, portals, and telephone numbers provided by the Research Analyst or its website <b>{{ra_website}}</b>.</li>
    <li>The Client agrees not to share Aadhaar OTP, Bank OTP, or any confidential code with anyone including employees of the Research Analyst.</li>
  </ul>

  <div class="section-title">10. Optional Centralised Fee Collection Mechanism</div>
  <p class="para">There is an optional ‘Centralized Fee Collection Mechanism for Investment Advisors and Research Analysts’ (CeFCoM) for fee payments. The Research Analyst has presently not opted for the same and once the Research Analyst gets registered for it, then thereafter said mechanism will be available for the client.</p>

  <div class="section-title">11. Fee Structure</div>
  <p class="para">The Client agrees to pay a fee of <b>INR {{fee_amount}}</b> for the services <b>{{service_name}}</b>. Fee shall be charged in accordance with SEBI RA Regulations and master circular. All applicable taxes (GST, etc.) shall be borne by the Client only. Payment Terms: <b>{{payment_terms}}</b>.</p>

  <div class="section-title">12. Confidentiality</div>
  <p class="para">Both Parties shall maintain confidentiality of information shared and comply with provisions of the Information Technology Act, 2000 and SEBI RA Regulations regarding client data protection. Research Analyst shall be responsible for maintenance of client accounts and data as mandated under the SEBI (Research Analyst) Regulations, 2014.</p>

  <div class="section-title">13. Means Of Communication</div>
  <p class="para">The Research Analyst will provide recommendations via SMS/WhatsApp. The Client shall only accept recommendations received through these specified mediums. The Research Analyst shall not be liable for any communications received by the Client through other means. Additionally, the Client acknowledges communications via email through <b>{{ra_email}}</b> or <b>{{ra_website}}</b> domain name only. Research Analyst will not be liable for any email which is been received by client from any other domain name.</p>

  <div class="section-title">14. Record Keeping</div>
  <p class="para">The RA shall maintain all records related to client communications and recommendations as per Regulation 25 of the SEBI (Research Analysts) Regulations, 2014.</p>

  <div class="section-title">15. Consent as per SEBI Regulations</div>
  <p class="para">The Client, having understood the services, scope, fee structure, and limitations of the Research Analyst, hereby provides informed consent to avail the services, in line with Regulation 22 of SEBI (Research Analyst) Regulations, 2014.</p>

  <div class="section-title">16. Electronic Execution (Aadhaar e-Sign)</div>
  <p class="para">This Agreement shall be digitally executed by the Client using Aadhaar e-Sign through the DGO platform, confirming that:</p>
  <ul class="list">
    <li>The Client has carefully read all the clauses of this Agreement,</li>
    <li>The Client voluntarily gives consent to this Agreement,</li>
    <li>The Client digitally signs this Agreement without any undue influence or misrepresentation.</li>
  </ul>

  <div class="section-title">17. Term &amp; Termination &amp; Amendments</div>
  <ul class="list">
    <li>The Agreement may be terminated by the Client if the Research Analyst fails to provide the research recommendations. However, the Client cannot terminate the Agreement solely based on not achieving the desired returns or incurring losses from trading on the recommendations.</li>
    <li>The RA may suspend or terminate rendering of research services to client on account of suspension/cancellation of registration of RA by SEBI and shall refund the residual amount to the client.</li>
    <li>In case of suspension of certificate of registration of the RA for more than 60 (sixty) days or cancellation of the RA registration, RA shall refund the fees, on a pro rata basis for the period from the effective date of cancellation/ suspension to end of the subscription period.</li>
    <li>This Agreement shall remain valid till terminated by either Party by giving 07 days’ written notice, subject to settlement of dues. In case of breach of terms or violation of applicable laws.</li>
    <li>This Agreement constitutes the entire understanding between the parties.</li>
    <li>No amendment or modification shall be valid unless in writing and signed by both parties.</li>
  </ul>

  <div class="section-title">18. Limitation of Liability</div>
  <ul class="list">
    <li>Market risks or losses incurred.</li>
    <li>Any indirect or consequential damages.</li>
    <li>Decisions taken by the Client solely based on research advice.</li>
    <li>Failure or delay due to circumstances beyond reasonable control, including natural disasters, cyber-attacks, or regulatory changes.</li>
  </ul>

  <div class="section-title">19. Grievance Redressal and Dispute Resolution</div>
  <p class="para">In the event of grievances related to non-receipt of the research report, missing content, or deficiencies in services, the Client may raise a grievance. The Research Analyst will ensure redressal within 7 days of such complaint. The Research Analyst shall be responsible for resolving the grievances within the timelines specified under SEBI circulars. In case of any query or grievance, client shall contact through following medium:</p>
  <ul class="list">
    <li>Contact No.: <b>{{ra_phone}}</b></li>
    <li>Mail id: <b>{{ra_email}}</b></li>
  </ul>
  <p class="para">In case client is not satisfied with our response, they can lodge grievance with SEBI at <span class="muted">http://scores.gov.in</span> or may also write to the office of SEBI. After exhausting the above options for resolution of the grievance, if the investor/client is still not satisfied with the outcome, they can initiate dispute resolution through the ODR Portal: <span class="muted">https://smartodr.in/</span>.</p>

  <p class="para"><b>NOTE:</b> Clients are advised to read the Do's and Don’ts for dealing with the Research Analyst, as mentioned in SEBI Master Circular No. SEBI/HO/MIRSD-POD-1/P/CIR/2024/49 dated May 21, 2024, or any updates provided by SEBI in the future.</p>

  <div class="section-title">20. Governing Law &amp; Jurisdiction</div>
  <p class="para">No suit, prosecution or other legal proceeding shall lie against the Research Analyst for any damage caused or likely to be caused by anything which is done in good faith or intended to be done under the provisions of the Securities and Exchange Board of India (Research Analyst) Regulations, 2014.</p>
  <p class="para">Disputes shall be subject to arbitration under the Arbitration and Conciliation Act, 1996, or other methods mutually agreed upon, in accordance with applicable legal and regulatory guidelines. This Agreement shall be governed by and construed in accordance with the laws of India. Courts at <b>{{jurisdiction_city}}</b> shall have exclusive jurisdiction.</p>

  <div class="section-title">21. Force Majeure</div>
  <p class="para">The RA shall not be held responsible for failure or delay due to circumstances beyond reasonable control, including natural disasters, cyber-attacks, or regulatory changes.</p>

  <div class="section-title">22. Non-Compliance Risks</div>
  <p class="para">The Research Analyst shall not be responsible for any loss, fraud, or unauthorized activity resulting from the Client's failure to follow the above safety guidelines.</p>

  <div class="section-title">23. Declarations</div>
  <p class="para">Client confirms understanding of the risk involved in securities markets. Client agrees that no guaranteed returns are offered. Research Analyst confirms compliance with Code of Conduct as per Third Schedule of SEBI RA Regulations.</p>

  <div class="section-title">24. Acceptance</div>
  <ul class="list">
    <li>That he/she has read, understood, and agreed to all terms and conditions,</li>
    <li>That he/she is bound by SEBI rules, Indian Contract Act provisions, and this Agreement,</li>
    <li>That he/she shall adhere strictly to all compliance guidelines mentioned herein.</li>
  </ul>

  <div class="section-title">25. Miscellaneous</div>
  <p class="para">Each party agrees to perform such further actions and execute such further agreements as are necessary to effectuate the purposes hereof.</p>

  <div class="hr"></div>

  <div class="section-title">Signature and Acceptance</div>
  <p class="para">IN WITNESS WHEREOF, the parties hereto have executed this Agreement on the date first mentioned above.</p>

  <div class="sign-blocks">
    <div class="sign">
      <div class="label">For Research Analyst</div>
      <div class="mt-8"><b>{{ra_sign_name}}</b></div>
      <div>{{ra_brand}}</div>
      <div class="mt-8">Date &amp; Signature: ____________________________</div>
    </div>
    <div class="sign">
      <div class="label">For Client</div>
      <div class="mt-8">Name: <b>{{client_name}}</b></div>
      <div>PAN: <b>{{client_pan}}</b></div>
      <div class="mt-8">Date &amp; Signature: ____________________________</div>
    </div>
  </div>

  <!-- Optional Dompdf page numbers (requires PHP; safe to ignore in browser) -->
  <div class="footer">
    <div>SEBI Registration: {{ra_registration}}</div>
    <div>Page {PAGE_NUM} of {PAGE_COUNT}</div>
  </div>

  <div class="title"><u>MOST IMPORTANT TERMS AND CONDITIONS (MITC)</u></div>

<div class="section">
  <ol>
    <li>These terms and conditions, and consent thereon, are for the research services provided
by the Research Analyst cannot execute/carry out any trade (purchase/sell transaction)
on behalf of the client. Thus, the clients are advised not to permit RA to execute any
trade on their behalf.</li>
    <li>The fee charged by RA to the client will be subject to the maximum of amount
prescribed by SEBI/ Research Analyst Administration and Supervisory Body (RAASB)
from time to time (applicable only for Individual and HUF Clients).<ol type="i">
 a.  The current fee limit is <strong>Rs 1,51,000/-</strong>per annum per family of client for all research services of the RA.<br>
b. The fee limit does not include statutory charges.<br>
c. The fee limits do not apply to a non-individual client / accredited investor.</ol type="i"></li>
    <li>RA may charge fees in advance if agreed by the client. Such advance shall not exceed
the period stipulated by SEBI; presently it is one year. In case of pre-mature
termination of the RA services by either the client or the RA, the client shall be entitled
to seek a refund of proportionate fees only for the unexpired period.</li>
    <li>Fees to RA may be paid by the client through any of the specified modes like cheque,
online bank transfer, UPI, etc. Cash payment is not allowed. Optionally the client can
make payments through Centralized Fee Collection Mechanism – CeFCoM managed by
BSE Limited (i.e. currently recognized RAASB).</li>
    <li>The RA is required to abide by the applicable regulations/ circulars/ directions specified
by SEBI and RAASB from time to time in relation to disclosure and mitigation of any
actual or potential conflict of interest. The RA will endeavor to promptly inform the
client of any conflict of interest that may affect the services being rendered to the client.</li>

<li>Any assured/guaranteed/fixed returns schemes or any other schemes of similar nature
are prohibited by law. No scheme of this nature shall be offered to the client by the RA.</li>

<li>Any investment made based on recommendations in research reports are subject to
market risks, and recommendations do not provide any assurance of returns. There is
no recourse to claim any losses incurred on the investments made based on the
recommendations in the research report. Any reliance placed on the research report
provided by the RA shall be as per the client’s own judgement and assessment of the
conclusions contained in the research report.
</li>

<li>The SEBI registration, Enlistment with RAASB, and NISM certification do not guarantee
the performance of the RA or assure any returns to the client.</li>

<li>For any grievances:<ol type="i">
<strong>Step 1:</strong> the client should first contact the RA using the details on its website or Email
contact details.<br>
<strong>Step 2:</strong> If the resolution is unsatisfactory, the client can also lodge grievances through
SEBI’s SCORES platform at www.scores.sebi.gov.in<br>
<strong>Step 3:</strong> The client may also consider the Online Dispute Resolution (ODR) through the
Smart ODR portal at https://smartodr.in
</ol type="i"></li>

<li>Clients are required to keep contact details, including email id and mobile number/s
updated with the RA at all times.</li>

<li>The RA shall never ask for the client’s login credentials and OTPs for the client’s Trading
Account Demat Account and Bank Account. Never share such information with anyone
including RA.
</li>


   <!-- <li>Grievance redressal: contact <strong>{{ra_email}}</strong> or visit <a href="{{grievance_url}}">{{grievance_url}}</a>.</li>
    <li>Never share OTPs, login credentials or confidential banking details with anyone claiming to be from the Research Analyst.</li>
  </ol>-->
</div>

<div class="signature">
  <div style="margin-top:20px;"><strong>Client Signature</strong></div>
  <div style="margin-top:30px;">__________________________</div>
</div>

  <!-- Optional Dompdf header/footer script -->
  <script type="text/php">
    if ( isset($pdf) ) {
      $pdf->page_text(520, 820, "Page {PAGE_NUM} of {PAGE_COUNT}", "Helvetica", 9, array(0.4,0.4,0.4));
      $pdf->page_text(72, 820, "SEBI Registration: {{ra_registration}}", "Helvetica", 9, array(0.4,0.4,0.4));
    }
  </script>

<div class='signature-box' style='border:1px solid #000; width:250px; height:80px; margin-top:40px; text-align:center; line-height:80px;'>Signature</div>
</body>
</html>
