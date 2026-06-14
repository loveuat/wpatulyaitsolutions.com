<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'register_content_table_block' );
  function register_content_table_block() {
Block::make( __( 'Dynamic Table' ) )
  
                ->add_fields(array(

                    // Heading
                    Field::make('text', 'table_heading', __('Table Heading')),

                    // Subheading
                    Field::make('text', 'table_subheading', __('Table Subheading')),
                    Field::make('checkbox', 'table_disable_heading', 'Disable Headings'),
                    Field::make( 'text', 'table_extra_classes', __( 'Section Extra Classes' ) )
        ->set_help_text( 'Example: btn btn-primary or btn-secondary' ),
                    // Columns
                    Field::make('complex', 'table_columns', __('Columns'))
                        ->set_layout('tabbed-horizontal')
                        ->set_min(1)
                        ->add_fields(array(
                            Field::make('text', 'column_name', __('Column Name')),
                        )),

                    // Rows
                    Field::make('complex', 'table_rows', __('Rows'))
                        ->set_layout('tabbed-vertical')
                        ->add_fields(array(

                            Field::make('complex', 'row_cells', __('Row Data'))
                                ->set_layout('tabbed-horizontal')
                                ->add_fields(array(
                                    Field::make('text', 'cell_value', __('Cell Value')),
                                )),

                        )),
                     // 🔥 CALL YOUR GLOBAL FUNCTION HERE
                    Field::make('select', 'table_padding', __('Padding'))
                    ->set_options(get_padding_options()),

            Field::make('select', 'table_margin', __('Margin'))
                ->set_options(get_margin_options()),

                ))
  ->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
  ->set_category( 'layout' )
  ->set_icon( 'heart' )
  ->set_keywords( [ __( 'hero' ), __( 'slider' ), __( 'banner' ) ] )
  ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
    $padding = $fields['table_padding'];
$margin  = $fields['table_margin'];
    $pmclass = trim($padding . ' ' . $margin);
    ?>
    <!-- Hero Section -->
    <section class="content section <?php echo esc_attr($fields['table_extra_classes'] ?? '');?> <?php echo esc_attr($pmclass); ?>">

  <div class="container" data-aos="fade-up">

    <?php if(empty($fields['table_disable_heading'])):?>
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <?php if($fields['table_heading']):?>
        <h2><?php echo $fields['table_heading'];?></h2> 
        <p><?php echo $fields['table_subheading'];?></p>
    <?php endif;?>
      </div><!-- End Section Title -->
    <?php endif;?>

    <!-- Content -->
    <div class="content-body">
  
    <div class="table-responsive mt-3">
        <table class="table table-styled mb-0">
            <?php if($fields['table_columns']):?>
            <thead>
                <tr>
                    <?php foreach($fields['table_columns'] as $col):?>
                        <th><?php echo $col['column_name'];?></th>
                    <?php endforeach;?>
                </tr>
            </thead>
        <?php endif;?>
        <?php if($fields['table_rows']):?>
        <tbody>

            <?php foreach($fields['table_rows'] as $rows): ?>
                <tr>
                <?php  foreach($rows['row_cells'] as $row):?>
                <td><?php echo $row['cell_value'];?></td>
              <?php  endforeach; ?>
               </tr>
            <?php endforeach;?>
            
        </tbody>
        <?php endif;?>
        </table>
                </div>
    </div>

    
  </div>

</section>
   
    <?php
  } );
  }
