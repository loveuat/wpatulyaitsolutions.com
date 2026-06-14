<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'pp_theme_options');

function pp_theme_options() {

    Container::make('theme_options', __('Theme Options'))
        ->set_page_menu_title('Theme Settings')
        ->set_icon('dashicons-admin-generic')

        /*
        |--------------------------------------------------------------------------
        | GENERAL TAB
        |--------------------------------------------------------------------------
        */

        ->add_tab(__('General'), array(

            Field::make('checkbox', 'enable_top_header', 'Enable Top Header'),

            Field::make('text', 'footer_tagline', 'Footer Tagline'),

            Field::make('select', 'selected_forminator_form', 'Select Form')
                ->set_options( get_forminator_forms_options() )
                ->set_default_value(''),

        ))

        /*
        |--------------------------------------------------------------------------
        | CONTACT TAB
        |--------------------------------------------------------------------------
        */

        ->add_tab(__('Contact Info'), array(

            Field::make('complex', 'footer_contact_info', 'Footer Contact Info')
                ->set_max(1)
                ->set_layout('tabbed-vertical')
                ->add_fields(array(

                    Field::make('text', 'footer_address', 'Address'),

                    Field::make('text', 'footer_phone', 'Phone'),

                    Field::make('text', 'footer_whatsapp', 'Whatsapp'),

                    Field::make('text', 'footer_email', 'Email')

                )),
            //Footer Compliance Detail
             Field::make('complex', 'footer_complinace_info', 'Footer Compliance Info')
            ->set_max(1) // 👈 makes it behave like a single group
            ->set_layout('tabbed-vertical')
            ->add_fields(array(
                Field::make('text', 'complinace_name', 'Compliance Name'),
                Field::make('text', 'complinace_number', 'Compliance Phone'),
                Field::make('text', 'complinace_email', 'Compliance Email')
            )),
             // 🔥 Information Repeater
            Field::make('complex', 'information', 'Information')
                ->set_layout('tabbed-horizontal')
                ->add_fields(array(
                    Field::make('text', 'info_label', 'Label (e.g. Phone, Email)'),
                    Field::make('text', 'info_value', 'Value'),
                    Field::make('text', 'info_icon', 'Icon Class (optional)'),
                )),
                 Field::make('rich_text', 'footer_sebi_details', 'Footer SEBI Details'),
            Field::make('rich_text', 'footer_sebi_office', 'Footer SEBI Office'),
            Field::make('rich_text', 'footer_sebi_head_office', 'Footer SEBI Head Office'),
            Field::make('rich_text', 'footer_disclaimer', 'Footer Disclaimer'),
        ))

        /*
        |--------------------------------------------------------------------------
        | SOCIAL TAB
        |--------------------------------------------------------------------------
        */

        ->add_tab(__('Social Media'), array(

            Field::make('complex', 'social_media', 'Social Media')
                ->set_layout('tabbed-horizontal')
                ->add_fields(array(

                    Field::make('text', 'social_name', 'Platform Name'),

                    Field::make('text', 'social_url', 'URL'),

                    Field::make('text', 'social_icon', 'Icon Class'),

                )),

        ))

        /*
        |--------------------------------------------------------------------------
        | DIGIO TAB
        |--------------------------------------------------------------------------
        */

        ->add_tab(__('Digio Settings'), array(

            Field::make( 'checkbox', 'digio_enable', 'Enable Digio' )
                ->set_option_value( 'yes' ),

            Field::make( 'select', 'digio_environment', 'Environment' )
                ->set_options( [
                    'sandbox'    => 'Sandbox',
                    'production' => 'Production',
                ])
                ->set_default_value( 'sandbox' ),

            /*
            |--------------------------------------------------------------------------
            | SANDBOX
            |--------------------------------------------------------------------------
            */

            Field::make( 'text', 'sb_digio_client_id', 'Sandbox Client ID' )
                ->set_conditional_logic([
                    [
                        'field' => 'digio_environment',
                        'value' => 'sandbox',
                    ]
                ]),

            Field::make( 'text', 'sb_digio_client_secret', 'Sandbox Client Secret' )
                ->set_attribute( 'type', 'password' )
                ->set_conditional_logic([
                    [
                        'field' => 'digio_environment',
                        'value' => 'sandbox',
                    ]
                ]),

            Field::make( 'text', 'sb_digio_callback_url', 'Sandbox Callback URL' )
    ->set_help_text('Enter a valid URL including https://')
    ->set_conditional_logic([
        [
            'field' => 'digio_environment',
            'value' => 'sandbox',
        ]
    ]),

            /*
            |--------------------------------------------------------------------------
            | PRODUCTION
            |--------------------------------------------------------------------------
            */

            Field::make( 'text', 'pro_digio_client_id', 'Production Client ID' )
                ->set_conditional_logic([
                    [
                        'field' => 'digio_environment',
                        'value' => 'production',
                    ]
                ]),

            Field::make( 'text', 'pro_digio_client_secret', 'Production Client Secret' )
                ->set_attribute( 'type', 'password' )
                ->set_conditional_logic([
                    [
                        'field' => 'digio_environment',
                        'value' => 'production',
                    ]
                ]),

                Field::make( 'text', 'pro_digio_callback_url', 'Production Callback URL' )
    ->set_help_text('Enter a valid URL including https://')
    ->set_conditional_logic([
        [
            'field' => 'digio_environment',
            'value' => 'production',
        ]
    ]),
    Field::make( 'text', 'pro_digio_webhook_secret', 'Production Webhook Secret' )
                ->set_conditional_logic([
                    [
                        'field' => 'digio_environment',
                        'value' => 'production',
                    ]
                ]),

        ))

          /*
        |--------------------------------------------------------------------------
        | Dynamic  Pdf Generation
        |--------------------------------------------------------------------------
        */

        ->add_tab(__('Dynamic  Pdf Generation'), array(
    Field::make('text', 'sebi_registration_number', 'SEBI Reg. Number'),
    Field::make('text', 'pdf_phone_number', 'PDF Phone Number'),
    Field::make('image', 'pdf_logo', 'PDF Logo'),
    Field::make('image', 'ra_sign', 'RA Sign'),
    Field::make('text', 'ra_registration_number', 'RA Reg. Number'),
    Field::make('text', 'ra_brand', 'RA Brand'),
    Field::make('text', 'ra_name', 'RA Name'),
    Field::make('text', 'ra_reg_date', 'Reg. Date'),
    Field::make('text', 'ra_email', 'Reg. Email'),
    Field::make('text', 'ra_phone', 'Reg. Phone'),
    Field::make('text', 'ra_website', 'Reg. Website'),
    Field::make('text', 'ra_address', 'Reg. Address'),
    Field::make('text', 'jurisdiction_city', 'Jurisdiction City'),
    Field::make('text', 'ra_sign_name', 'RA Sign Name'),

/*
|--------------------------------------------------------------------------
| AGREEMENT CONTENT
|--------------------------------------------------------------------------
*/

Field::make('complex', 'pdf_agreement_content', 'Agreement Content')
    ->set_layout('tabbed-vertical')
    ->add_fields([

        Field::make('text', 'agreement_title', 'Title'),

        Field::make('rich_text', 'agreement_content', 'Content')

    ]),
    /*
|--------------------------------------------------------------------------
| MITC CONTENT
|--------------------------------------------------------------------------
*/

Field::make('complex', 'pdf_mitc_content', 'MITC Content')
    ->set_layout('tabbed-vertical')
    ->add_fields([

        Field::make('text', 'mitc_title', 'Title'),

        Field::make('rich_text', 'mitc_content', 'Content')

    ]),
            /*
|--------------------------------------------------------------------------
| CONSENT CONTENT
|--------------------------------------------------------------------------
*/

Field::make('complex', 'pdf_consent_content', 'Consent Content')
    ->set_layout('tabbed-vertical')
    ->add_fields([

        Field::make('text', 'consent_title', 'Title'),

        Field::make('rich_text', 'consent_content', 'Content')

    ]),
        ));

        Container::make('post_meta', __('Page Settings'))
        ->where('post_type', '=', 'page') // 👈 only pages

        ->add_fields(array(
            // Field::make('text', 'page_heading', 'Page Heading')
            //     ->set_help_text('Custom main heading for this page'),

            Field::make('rich_text', 'page_subheading', 'Page Subheading')
                ->set_rows(3)
                ->set_help_text('Short description / subtitle'),
        ));
}