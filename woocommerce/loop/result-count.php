   <?php
   /**
    * Result Count
    *
    * Shows text: Showing x to y of z results (w Pages)
    *
    * This template can be overridden by copying it to yourtheme/woocommerce/loop/result-count.php.
    *
    * HOWEVER, on occasion WooCommerce will need to update template files and you
    * (the theme developer) will need to copy the new files to your theme to
    * maintain compatibility. We try to do this as little as possible, but it does
    * happen. When this occurs the version of the template file will be bumped and
    * the readme will list any important changes.
    *
    * @see         https://woocommerce.com/document/template-structure/
    * @package     WooCommerce\Templates
    * @version     3.7.0
    */

   if ( ! defined( 'ABSPATH' ) ) {
       exit;
   }

   ?>
   <p class="woocommerce-result-count">
       <?php
       if ( $total <= $per_page || -1 === $per_page ) {
           /* translators: %d: total results */
           printf( _n( 'Showing the single result', 'Showing all %d results', $total, 'woocommerce' ), $total );
       } else {
           $first = ( $per_page * $current ) - $per_page + 1;
           $last  = min( $total, $per_page * $current );
           $total_pages = ceil( $total / $per_page );
           /* translators: 1: first result 2: last result 3: total results 4: total pages */
           printf( _n( 'Showing %1$d to %2$d of %3$d result (%4$d Page)', 'Showing %1$d to %2$d of %3$d results (%4$d Pages)', $total, 'woocommerce' ), $first, $last, $total, $total_pages );
       }
       ?>
   </p>
   