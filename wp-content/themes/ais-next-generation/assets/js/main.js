/**
* Template Name: Orbit
* Template URL: https://bootstrapmade.com/orbit-bootstrap-template/
* Updated: Jan 13 2026 with Bootstrap v5.3.8
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/

(function($) {
  "use strict";

  /**
   * Apply .scrolled class to the body as the page is scrolled down
   */
  function toggleScrolled() {
    const selectBody = document.querySelector('body');
    const selectHeader = document.querySelector('#header');
    if (!selectHeader.classList.contains('scroll-up-sticky') && !selectHeader.classList.contains('sticky-top') && !selectHeader.classList.contains('fixed-top')) return;
    window.scrollY > 100 ? selectBody.classList.add('scrolled') : selectBody.classList.remove('scrolled');
  }

  document.addEventListener('scroll', toggleScrolled);
  window.addEventListener('load', toggleScrolled);

  /**
   * Mobile nav toggle
   */
  const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');

  function mobileNavToogle() {
    document.querySelector('body').classList.toggle('mobile-nav-active');
    mobileNavToggleBtn.classList.toggle('bi-list');
    mobileNavToggleBtn.classList.toggle('bi-x');
  }
  if (mobileNavToggleBtn) {
    mobileNavToggleBtn.addEventListener('click', mobileNavToogle);
  }

  /**
   * Hide mobile nav on same-page/hash links
   */
  document.querySelectorAll('#navmenu a').forEach(navmenu => {
    navmenu.addEventListener('click', () => {
      if (document.querySelector('.mobile-nav-active')) {
        mobileNavToogle();
      }
    });

  });

  /**
   * Toggle mobile nav dropdowns
   */
  document.querySelectorAll('.navmenu .toggle-dropdown').forEach(navmenu => {
    navmenu.addEventListener('click', function(e) {
      e.preventDefault();
      this.parentNode.classList.toggle('active');
      this.parentNode.nextElementSibling.classList.toggle('dropdown-active');
      e.stopImmediatePropagation();
    });
  });

  /**
   * Preloader
   */
  const preloader = document.querySelector('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      preloader.remove();
    });
  }

  /**
   * Scroll top button
   */
  let scrollTop = document.querySelector('.scroll-top');

  function toggleScrollTop() {
    if (scrollTop) {
      window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
    }
  }
  scrollTop.addEventListener('click', (e) => {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });

  window.addEventListener('load', toggleScrollTop);
  document.addEventListener('scroll', toggleScrollTop);

  /**
   * Animation on scroll function and init
   */
  function aosInit() {
    AOS.init({
      duration: 600,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    });
  }
  window.addEventListener('load', aosInit);
   /**
   * Auto generate the carousel indicators
   */
  document.querySelectorAll('.carousel-indicators').forEach((carouselIndicator) => {
    carouselIndicator.closest('.carousel').querySelectorAll('.carousel-item').forEach((carouselItem, index) => {
      if (index === 0) {
        carouselIndicator.innerHTML += `<li data-bs-target="#${carouselIndicator.closest('.carousel').id}" data-bs-slide-to="${index}" class="active"></li>`;
      } else {
        carouselIndicator.innerHTML += `<li data-bs-target="#${carouselIndicator.closest('.carousel').id}" data-bs-slide-to="${index}"></li>`;
      }
    });
  });
  /**
   * Initiate glightbox
   */
  const glightbox = GLightbox({
    selector: '.glightbox'
  });

  /**
   * Init isotope layout and filters
   */
  document.querySelectorAll('.isotope-layout').forEach(function(isotopeItem) {
    let layout = isotopeItem.getAttribute('data-layout') ?? 'masonry';
    let filter = isotopeItem.getAttribute('data-default-filter') ?? '*';
    let sort = isotopeItem.getAttribute('data-sort') ?? 'original-order';

    let initIsotope;
    imagesLoaded(isotopeItem.querySelector('.isotope-container'), function() {
      initIsotope = new Isotope(isotopeItem.querySelector('.isotope-container'), {
        itemSelector: '.isotope-item',
        layoutMode: layout,
        filter: filter,
        sortBy: sort
      });
    });

    isotopeItem.querySelectorAll('.isotope-filters li').forEach(function(filters) {
      filters.addEventListener('click', function() {
        isotopeItem.querySelector('.isotope-filters .filter-active').classList.remove('filter-active');
        this.classList.add('filter-active');
        initIsotope.arrange({
          filter: this.getAttribute('data-filter')
        });
        if (typeof aosInit === 'function') {
          aosInit();
        }
      }, false);
    });

  });

  /**
   * Initiate Pure Counter
   */
  new PureCounter();

  /**
   * Init swiper sliders
   */
  function initSwiper() {
  document.querySelectorAll(".init-swiper").forEach(function(swiperElement) {

    let configEl = swiperElement.querySelector(".swiper-config");

    // ✅ If config exists (old system)
    if (configEl) {
      let config = JSON.parse(configEl.innerHTML.trim());

      if (swiperElement.classList.contains("swiper-tab")) {
        initSwiperWithCustomPagination(swiperElement, config);
      } else {
        new Swiper(swiperElement, config);
      }
    }

    // ❌ If no config → SKIP (important)
  });
}
  
  window.addEventListener("load", initSwiper);

  /**
   * Frequently Asked Questions Toggle
   */
  document.querySelectorAll('.faq-item h3, .faq-item .faq-toggle, .faq-item .faq-header').forEach((faqItem) => {
    faqItem.addEventListener('click', () => {
      faqItem.parentNode.classList.toggle('faq-active');
    });
  });
  /**
   * Correct scrolling position upon page load for URLs containing hash links.
   */
  window.addEventListener('load', function(e) {
    if (window.location.hash) {
      if (document.querySelector(window.location.hash)) {
        setTimeout(() => {
          let section = document.querySelector(window.location.hash);
          let scrollMarginTop = getComputedStyle(section).scrollMarginTop;
          window.scrollTo({
            top: section.offsetTop - parseInt(scrollMarginTop),
            behavior: 'smooth'
          });
        }, 100);
      }
    }
  });

  /**
   * Navmenu Scrollspy
   */
  let navmenulinks = document.querySelectorAll('.navmenu a');

  function navmenuScrollspy() {
    navmenulinks.forEach(navmenulink => {
      if (!navmenulink.hash) return;
      let section = document.querySelector(navmenulink.hash);
      if (!section) return;
      let position = window.scrollY + 200;
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        document.querySelectorAll('.navmenu a.active').forEach(link => link.classList.remove('active'));
        navmenulink.classList.add('active');
      } else {
        navmenulink.classList.remove('active');
      }
    })
  }
  window.addEventListener('load', navmenuScrollspy);
  document.addEventListener('scroll', navmenuScrollspy);
  document.addEventListener("DOMContentLoaded", function () {

  const sliders = document.querySelectorAll(".testimonials-slider");

  sliders.forEach(function (slider) {

    new Swiper(slider, {
      loop: true,
      speed: 800,
      autoplay: {
        delay: 5000
      },
      slidesPerView: 1,
      spaceBetween: 30,
      pagination: {
        el: slider.querySelector(".swiper-pagination"),
        clickable: true
      },
      breakpoints: {
        768: {
          slidesPerView: 2
        },
        1200: {
          slidesPerView: 3
        }
      }
    });

  });

 

  const blogsliders = document.querySelectorAll(".blog-hero-slider");

  blogsliders.forEach(function (slider) {

    new Swiper(slider, {
      loop: true,
      speed: 1000,
      effect: "slide",
      autoplay: {
        delay: 5000
      },
      slidesPerView: 1,
      pagination: {
        el: slider.querySelector(".swiper-pagination-hero"),
        clickable: true
      },
      navigation: {
                "nextEl": ".swiper-button-next",
                "prevEl": ".swiper-button-prev"
              },
    });

  });



});

 // Example: mask PAN card (AAAAA9999A)
  let panNumber  = jQuery('.panNumber input');
  if(panNumber.length > 0){
  jQuery('.panNumber input').inputmask({
        mask: 'AAAAA9999A',
        placeholder: '',
        showMaskOnHover: false,
        clearIncomplete: false,
        casing: 'upper'
    });
  }
   let dobField  = jQuery('.dobField input');
   if(dobField.length > 0){
     jQuery('.dobField input').inputmask(
    '99/99/9999',
    {
        placeholder: 'MM/DD/YYYY',
        showMaskOnHover: false
    });
   }
 const aadharField = jQuery('.aadharField input');

if (aadharField.length) {
    aadharField.inputmask('9999 9999 9999', {
        placeholder: '____ ____ ____',
        showMaskOnHover: false
    });
}

   jQuery(document).ajaxSuccess(function (event, xhr, settings) {
    const response = JSON.parse(xhr.responseText);

    // Safety check
    if (!response || !response.data.digio) {
        return;
    }
    console.log(response);
    const docId = response.data.digio.digio_document_id;
    const formId = response.data.digio.formId;
    const identifier = response.data.digio.identifier;
    const logo = response.data.digio.logo;
    const entry_id = response.data.digio.entry_id;
    if (response?.data?.digio?.digio_document_id) {
    // Hide Forminator form
   jQuery('#forminator-module-' + formId + ' .forminator-row')
    .not('.forminator-row-last')
    .hide();
      // Create button
    const button = document.createElement('button');
    button.type = 'button';
    button.innerText = 'Sign Document';
    button.className = 'digio-sign-btn btn-submit';

    button.onclick = function () {
        startDigio(docId, identifier, logo, entry_id, formId);
    };

    // Add button to page
    const wrapper = document.getElementById('digio-button-wrapper');
    wrapper.innerHTML = ''; // remove old button if any
    wrapper.appendChild(button);
    }
  
           //     try {
//         let response = JSON.parse(xhr.responseText);
//         console.log(response);
//        // if (response && response.data && response.data.agreement_pdf_url) {
//         //if (response && response.data && response.data.agreement_pdf_url && response.data.consent_pdf_url && response.data.mitc_pdf_url) {
//             //let agreementPdfUrl = response.data.agreement_pdf_url;
//             //let consentPdfUrl   = response.data.consent_pdf_url;
//            // let mitcPdfUrl      = response.data.mitc_pdf_url;
//             //let themeUrl = customScripts.theme_url;
//             let $form = jQuery("#forminator-module-548");

//             $form.fadeOut(600, function () {
//                 // Remove old previews
//                 jQuery("#pdf-previews").remove();

//                 // Build all previews in one container

//                 // <div id="consent-preview" style="margin-bottom:30px;">
//                 //             <h3>Client Consent Preview</h3>
//                 //             <iframe src="${consentPdfUrl}" width="100%" height="600px" style="border:1px solid #ccc;"></iframe>
//                 //             <div style="margin-top:10px;">
//                 //                 <a href="${consentPdfUrl}" target="_blank" class="button">E Sign</a>
//                 //             </div>
//                 //         </div>

//                 //         <div id="mitc-preview">
//                 //             <h3>MITC Preview</h3>
//                 //             <iframe src="${mitcPdfUrl}" width="100%" height="600px" style="border:1px solid #ccc;"></iframe>
//                 //             <div style="margin-top:10px;">
//                 //                 <a href="${mitcPdfUrl}" target="_blank" class="button">E Sign</a>
//                 //             </div>
//                 //         </div>
//                 // let previewsHtml = `
//                 //     <div id="pdf-previews" style="margin-top:20px; display:none;">
//                 //         <div id="agreement-preview" style="margin-bottom:30px;">
//                 //             <h3>Agreement Preview</h3>
//                 //             <iframe src="${customScripts.theme_url}/assets/pdfjs/viewer.html?file=${agreementPdfUrl}" width="100%" height="600px"></iframe>
//                 //             <div style="margin-top:10px;">
//                 //                 <a href="#" target="_blank" class="button" id="start-digio">E Sign</a>
//                 //             </div>
//                 //             <button id="digio-sign-btn">
//                 //                     Sign Document
//                 //                 </button>
//                 //             <input type="hidden" value="${response.data.last_entry_id}" id="lastEntry"/>
//                 //             <input type="hidden" value="${response.data.form_id}" id="formId"/>
//                 //             <input type="hidden" value="${response.data.pdf_doc_id}" id="docId"/>
//                 //         </div>
//                 //     </div>
//                 // `;
//                 let previewsHtml = `
//                     <div id="pdf-previews" style="margin-top:20px; display:none;">
//                         <div id="agreement-preview" style="margin-bottom:30px;">
//                             <div style="margin-top:10px;">
//                                 <a href="#" target="_blank" class="button" id="start-digio">E Sign</a>
//                             </div>
//                             <input type="hidden" value="${response.data.last_entry_id}" id="lastEntry"/>
//                         </div>
//                     </div>
//                 `;
//                 // Insert after form
//                 $form.after(previewsHtml);

//                 // Smoothly show previews
//                 jQuery("#pdf-previews").fadeIn(800);
//             });
//        // }
//     } catch (e) {
//         console.log("Not JSON:", e);
//     }
 });
jQuery("body").on("click", "#start-digio", function(e) {
    e.preventDefault();

    let $btn = jQuery(this);

    jQuery.ajax({
        url: customScripts.ajax_url,
        method: "POST",
        data: {
            action: "start_digio",
            _digio_nonce: customScripts.nonce,
            entry_id: jQuery("#lastEntry").val(),
            form_id: jQuery("#formId").val(),
            doc_id: jQuery("#docId").val()
        },
        success: function(res) {

            jQuery("#digio-message").remove(); // Clear previous message

            if (res.success) {
                $btn.hide();

                $btn.after(`
                    <div id="digio-message" style="margin-top:10px; color: green;">
                        ✅ ${res.data.message}<br>
                        <br><br>
                        <small>🔄 Page will reload in 5 seconds...</small>
                        
                    </div>
                `);
                // setTimeout(function() {
                //     location.reload();
                // }, 5000);
            } else {
                $btn.after(`
                    <div id="digio-message" style="margin-top:10px; color: red;">
                        ❌ ${res.data.message || 'Something went wrong.'}
                    </div>
                `);
            }
        },

        error: function() {
            jQuery("#digio-message").remove();
            $btn.after(`
                <div id="digio-message" style="margin-top:10px; color: red;">
                    ❌ Server Error — Check logs.
                </div>
            `);
        }
    });
});


/* ---------- RESTORE STATE ---------- */
document.addEventListener('DOMContentLoaded', () => {

    if (a11yGetCookie('a11y-contrast') === 'high')
        document.documentElement.classList.add('a11y-high-contrast');

    if (a11yGetCookie('a11y-links'))
        document.body.classList.add('a11y-highlight-links');

    ['invert','saturation','text-spacing','line-height','hide-images','big-cursor']
    .forEach(key=>{
        if (a11yGetCookie('a11y-'+key))
            document.documentElement.classList.add('a11y-'+key);
    });

    const font = a11yGetCookie('a11y-font');
    if (font === 'lg') document.body.classList.add('a11y-font-lg');
    if (font === 'sm') document.body.classList.add('a11y-font-sm');
});

})();
// document.addEventListener("DOMContentLoaded", function () {
//     const observer = new MutationObserver(() => {
//         const link = document.querySelector('#__EAAPS_PORTAL a[href*="elfsight.com"]');
//         if (link) {
//             link.remove();
//         }
//     });

//     observer.observe(document.body, {
//         childList: true,
//         subtree: true
//     });
// });

// document.addEventListener("DOMContentLoaded", function () {

//   const trigger = document.getElementById("waTrigger");
//   const box = document.getElementById("waBox");
//   const close = document.getElementById("waClose");

//   trigger.addEventListener("click", () => {
//     box.style.display = (box.style.display === "block") ? "none" : "block";
//   });

//   close.addEventListener("click", () => {
//     box.style.display = "none";
//   });

// });
  /* ==============================
   ACCESSIBILITY CORE
============================== */
document.addEventListener("DOMContentLoaded", function () {
    const wrapper = document.querySelector(".accessibility-wrapper");
    const btn = document.querySelector(".accessibility-btn");

    btn.addEventListener("click", function (e) {
        e.preventDefault();
        wrapper.classList.toggle("active");
    });

    document.addEventListener("click", function (e) {
        if (!wrapper.contains(e.target)) {
            wrapper.classList.remove("active");
        }
    });
});

function a11ySetCookie(name, value) {
    document.cookie = name + "=" + value + "; path=/; SameSite=Strict;";
}
function a11yGetCookie(name) {
    const m = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    return m ? m[2] : null;
}

function toggleFeature(cls, el, cookie) {
    document.documentElement.classList.toggle(cls);
    const active = document.documentElement.classList.contains(cls);
    el.classList.toggle('is-active', active);
    a11ySetCookie(cookie, active ? '1' : '');
}

/* ---------- CONTRAST ---------- */
function setContrast(type) {
    document.documentElement.classList.remove('a11y-high-contrast');
    a11ySetCookie('a11y-contrast','');

    document.querySelectorAll('[onclick^="setContrast"]').forEach(b=>b.classList.remove('is-active'));

    if (type === 'high') {
        document.documentElement.classList.add('a11y-high-contrast');
        a11ySetCookie('a11y-contrast','high');
        event.currentTarget.classList.add('is-active');
    }
}

/* ---------- LINKS ---------- */
function toggleHighlightLinks() {
    document.body.classList.toggle('a11y-highlight-links');
    a11ySetCookie('a11y-links',
        document.body.classList.contains('a11y-highlight-links') ? '1' : ''
    );
}

/* ---------- FILTERS ---------- */
function toggleInvert() {
    toggleFeature('a11y-invert', event.currentTarget, 'a11y-invert');
}
function toggleSaturation() {
    toggleFeature('a11y-saturation', event.currentTarget, 'a11y-saturation');
}

/* ---------- FONT SIZE ---------- */
function fontIncrease() {
    document.body.classList.remove('a11y-font-sm');
    document.body.classList.add('a11y-font-lg');
    a11ySetCookie('a11y-font','lg');
}
function fontDecrease() {
    document.body.classList.remove('a11y-font-lg');
    document.body.classList.add('a11y-font-sm');
    a11ySetCookie('a11y-font','sm');
}
function fontReset() {
    document.body.classList.remove('a11y-font-lg','a11y-font-sm');
    a11ySetCookie('a11y-font','');
}

/* ---------- OTHERS ---------- */
function toggleTextSpacing() {
    toggleFeature('a11y-text-spacing', event.currentTarget, 'a11y-spacing');
}
function toggleLineHeight() {
    toggleFeature('a11y-line-height', event.currentTarget, 'a11y-lineheight');
}
function toggleHideImages() {
    toggleFeature('a11y-hide-images', event.currentTarget, 'a11y-images');
}
function toggleBigCursor() {
    toggleFeature('a11y-big-cursor', event.currentTarget, 'a11y-cursor');
}

jQuery(document).ready(function($) {

    if ($.validator && $.validator.methods.forminatorPhoneNational) {

        const original = $.validator.methods.forminatorPhoneNational;

        $.validator.methods.forminatorPhoneNational = function(value, element) {

            // get instance safely
            let iti = null;

            if (typeof intlTelInput !== 'undefined') {
                iti = intlTelInput.getInstance(element);
            }

            // 🔥 prevent crash
            if (!iti) {
                return true; // skip validation instead of breaking
            }

            return original.call(this, value, element);
        };
    }

});

function updatePricingAmount() {

    let serviceVal  = jQuery('.pricingServices select').val();
    let durationVal = jQuery('.pricingDuration select').val();
let $amountBox  = jQuery('.pricingAmount input');
     if (serviceVal) {
        if (serviceVal === "Customised-Plan") {
            // Allow manual entry
            $amountBox.val("").prop("readonly", false);
        } else {
            // Auto-fill price and lock field
            let price = getPrice(serviceVal, durationVal);
            $amountBox.val(price).prop("readonly", true);
        }
    } else {
        // Reset if incomplete selection
        $amountBox.val("").prop("readonly", true);
    }
}

// Lookup function for price
function getPrice(service, duration) {
    // 🔹 Define pricing table
    let pricingTable = {
    "Index-Option-Service": {
        "2-Month": 4999,
       // "Monthly": 11800,
       // "Quarterly": 31000,
       // "Half-yearly": 70800,
      //  "Yearly": null
    },
    "Stock-Option-Service": {
        "2-Month": 4999,
    },
    "Stock-Future-Service": {
       "2-Month": 9999,
    },
    "Equity-Swing-Basic": {
        "2-Month": 5999,
    },
    "Equity-Swing-Pro": {
       "2-Month": 9999,
    },
     "Pro-Trader-Combo": {
       "2-Month": 19999,
    }
    
};


    return pricingTable[service] && pricingTable[service][duration] 
        ? pricingTable[service][duration] 
        : "";
}

// Bind events
jQuery('.pricingServices select').on('change', updatePricingAmount);
jQuery('.pricingDuration select').on('change', updatePricingAmount);
