<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;
add_action( 'carbon_fields_register_fields', 'crb_attach_post_meta' );
function crb_attach_post_meta() {
    $order_statuses = 'test';
    Container::make( 'post_meta', __( 'Page Options', 'crb' ) )
        ->where( 'post_type', '=', 'page' ) // only show our new fields on pages
        ->add_fields( array(
            Field::make('checkbox', 'bypass_slot', 'Bypass Slot')
            ->set_option_value( 'yes' ),
            Field::make( 'complex', 'time_slots', 'Time Slots' )
                ->set_layout( 'grid' )
                ->add_fields([
                    Field::make('time', 'start_time', 'Start Time')
                        ->set_storage_format('H:i:s') // 24-hour format
                         ->set_picker_options([
                            'time_24hr' => false,  
                            'noCalendar' => true, // Ensures it's only a time picker
                            'enableTime' => true, 
                            'enableSeconds' => true, 
                        ]),

                    Field::make('time', 'end_time', 'End Time')
                        ->set_storage_format('H:i:s')
                        ->set_picker_options([
                            'time_24hr' => false,  
                            'noCalendar' => true, // Ensures it's only a time picker
                            'enableTime' => true, 
                            'enableSeconds' => true, 
                        ]),
                ]),
        ) );


     // Container::make( 'post_meta', __( 'Page Options', 'crb' ) )
     //    ->where( 'post_type', '=', 'emailtemplates' ) // only show our new fields on pages
     //    ->add_fields( array(
     //        Field::make( 'complex', 'email_slots', 'Email & Onscreen Message' )
     //            ->set_layout( 'grid' )
     //            ->set_max(1)
     //            ->add_fields([
     //                        Field::make( 'radio', 'close_email', 'Do you want to stop processing order mail for this payment method?' )
     //                ->add_options( array(
     //                    '1' => 'Yes',
     //                    '0' => 'No',
     //                ) )
     //                ->set_default_value( '0' ),

     //            Field::make( 'select', 'custom_order_mark', 'Custom Order Status' )
     //            ->add_options( $order_statuses )
     //            ->set_default_value( 'wc-processing' ),

     //                Field::make('text', 'extra_payment_title', 'Payment method name for onscreen and email'),

     //                Field::make('textarea', 'onscreen_message', 'Onscreen Message')
     //                ->set_rows( 4 ),


                    

     //            Field::make( 'complex', 'email_message_slots', 'Email Mails Content' )
     //            ->set_layout( 'grid' )
     //            ->add_fields([
     //                Field::make( 'select', 'custom_order_mark', 'Custom Order Status' )
     //            ->add_options( $order_statuses ),
     //           Field::make('textarea', 'email_message', 'Email Message')
     //                ->set_rows( 4 ),
     //            ]),
     //            ]),
     //    ) );
}