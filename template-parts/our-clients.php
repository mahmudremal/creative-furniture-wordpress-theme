<?php $clientsImages = get_template_directory_uri() . '/dist/images/v2/clients/logos'; ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">

<div class="flex flex-col gap-8 py-10 w-full max-w-full md:w-[1440px] 2xl:w-[1920px] m-auto relative overflow-hidden">
  <div class="flex flex-row items-center justify-center mb-4">
    <div class="text-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-xl sm:text-2xl leading-8 font-semibold relative flex items-center justify-start">
      <?php esc_html_e('Our partner', 'creative-furniture'); ?>
    </div>
  </div>

  <div class="flex flex-col gap-12 items-center justify-start w-full overflow-hidden">
    <?php
    $images = range(1, 18);
    $row1 = $images;
    shuffle($row1);
    $row2 = $images;
    shuffle($row2);
    ?>

    <div id="splide-row-1" class="splide">
      <div class="splide__track">
        <ul class="splide__list">
          <?php foreach ($row1 as $i) : ?>
            <li class="splide__slide flex items-center justify-center">
              <img class="h-12 w-auto object-contain grayscale hover:grayscale-0 transition-all duration-300" src="<?php echo esc_url($clientsImages . '/client-' . $i . '.png'); ?>" alt="Client <?php echo $i; ?>">
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>

    <div id="splide-row-2" class="splide">
      <div class="splide__track">
        <ul class="splide__list">
          <?php foreach ($row2 as $i) : ?>
            <li class="splide__slide flex items-center justify-center">
              <img class="h-12 w-auto object-contain grayscale hover:grayscale-0 transition-all duration-300" src="<?php echo esc_url($clientsImages . '/client-' . $i . '.png'); ?>" alt="Client <?php echo $i; ?>">
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const commonOptions = {
      type: 'loop',
      drag: 'free',
      focus: 'center',
      arrows: false,
      pagination: false,
      autoWidth: true,
      gap: '3rem',
    };

    new Splide('#splide-row-1', {
      ...commonOptions,
      autoScroll: {
        speed: 1,
        pauseOnHover: false,
      },
    }).mount(window.splide.Extensions);

    new Splide('#splide-row-2', {
      ...commonOptions,
      autoScroll: {
        speed: -1,
        pauseOnHover: false,
      },
    }).mount(window.splide.Extensions);
  });
</script>

