<?php $clientsImages = get_template_directory_uri() . '/dist/images/v2/clients.png'; ?>
<div class="flex flex-col gap-4 h-[238px] w-full max-w-full md:w-[1440px] m-auto relative overflow-hidden">
  <div class="flex flex-row gap-[1201px] items-center justify-center">
    <div class="text-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-xl sm:text-2xl leading-8 font-semibold relative flex items-center justify-start">
      <?php esc_html_e('Our partner', 'creative-furniture'); ?>
    </div>
  </div>

  <div class="flex flex-row gap-[66px] items-center justify-start absolute left-[50%] top-14" style="translate: -50%">
    <?php for ($i = 0; $i < 8; $i++) : ?>
      <div class="shrink-0 w-[85px] h-12 bg-repeat bg-cover grayscale" style="background-image: url(<?php echo esc_url($clientsImages); ?>); background-position: -<?php echo $i * 80; ?>px 0;"></div>
    <?php endfor; ?>
  </div>

  <div class="flex flex-row gap-[66px] items-center justify-start absolute left-[50%] top-[196px]" style="translate: -50%">
    <?php for ($i = 8; $i < 16; $i++) : ?>
      <div class="shrink-0 w-[85px] h-12 bg-repeat bg-cover grayscale" style="background-image: url(<?php echo esc_url($clientsImages); ?>); background-position: -<?php echo $i * 80; ?>px 0;"></div>
    <?php endfor; ?>
  </div>
</div>
