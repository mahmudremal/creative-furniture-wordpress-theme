  <div class="bg-[#ffffff] flex flex-col gap-6 items-center justify-start px-4 w-full max-w-full md:w-[1440px] m-auto relative">
    <div class="blaze-slider w-full" data-slider="customer-stories" data-config="<?php echo esc_attr(json_encode(['all' => ['loop' => true, 'slidesToShow' => 5, 'slidesToScroll' => 1, 'slideGap' => '16px'], '(max-width: 900px)' => ['slidesToShow' => 3], '(max-width: 500px)' => ['slidesToShow' => 1]])); ?>">
      <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative mb-6">
        <div class="text-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-xl sm:text-2xl leading-8 font-semibold relative flex items-center justify-start">
          <?php esc_html_e('Customer Stories', 'creative-furniture'); ?>
        </div>
        <div class="flex flex-row gap-1 items-center justify-start shrink-0 relative">
          <svg class="blaze-prev shrink-0 w-7 h-7 relative overflow-visible cursor-pointer"
            width="28"
            height="28"
            viewBox="0 0 28 28"
            fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M17.5 21L10.5 14L17.5 7"
              stroke="#BFBFBF"
              stroke-width="2.33333"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
          <svg class="blaze-next shrink-0 w-7 h-7 relative overflow-visible cursor-pointer"
            width="28"
            height="28"
            viewBox="0 0 28 28"
            fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M10.5 21L17.5 14L10.5 7"
              stroke="var(--ui-light-black-primary, #111111)"
              stroke-width="2.33333"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </div>
      </div>
      <div class="blaze-container">
        <div class="blaze-track-container">
          <div class="blaze-track">
            <?php
            $reviews = [
              [
                'name' => 'Michael Carter',
                'verified' => true,
                'rating' => 5,
                'comment' => 'Great customer service and high-quality furniture. The installation team was very professional and everything was more than expected.',
                'date' => '5 days ago',
                'glink' => '#'
              ],
              [
                'name' => 'Michael Carter',
                'verified' => true,
                'rating' => 5,
                'comment' => 'Great customer service and high-quality furniture. The installation team was very professional and everything was more than expected.',
                'date' => '5 days ago',
                'glink' => '#'
              ],
              [
                'name' => 'Michael Carter',
                'verified' => true,
                'rating' => 3,
                'comment' => 'Great customer service and high-quality furniture. The installation team was very professional and everything was more than expected.',
                'date' => '5 days ago',
                'glink' => '#'
              ],
              [
                'name' => 'Michael Carter',
                'verified' => true,
                'rating' => 5,
                'comment' => 'Great customer service and high-quality furniture. The installation team was very professional and everything was more than expected.',
                'date' => '5 days ago',
                'glink' => '#'
              ],
              [
                'name' => 'Michael Carter',
                'verified' => true,
                'rating' => 5,
                'comment' => 'Great customer service and high-quality furniture. The installation team was very professional and everything was more than expected.',
                'date' => '5 days ago',
                'glink' => '#'
              ],
            ];
            $reviews = [...$reviews, ...$reviews, ...$reviews];
            ?>
            <?php foreach ($reviews as $index => $review): ?>
            <div>
              <a href="<?php echo esc_url($review['glink']); ?>" class="rounded-2xl border-solid border-[#dadada] border p-4 flex flex-col gap-[57px] items-start justify-start h-full relative">
                <div class="flex flex-col gap-7 items-start justify-start self-stretch shrink-0 relative">
                  <div class="flex flex-row gap-3 items-center justify-start self-stretch shrink-0 relative">
                    <div class="flex flex-col gap-1 items-start justify-start flex-1 relative">
                      <div class="text-[#000000] text-left font-['Raleway-SemiBold',_sans-serif] text-sm leading-5 font-semibold relative self-stretch">
                        <?php echo esc_html($review['name']); ?>
                      </div>
                      <div class="flex flex-row gap-1 items-center justify-start shrink-0 relative">
                        <svg class="shrink-0 w-4 h-4 relative overflow-visible"
                          width="16"
                          height="16"
                          viewBox="0 0 16 16"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <g clip-path="url(#clip0_2507_3935)">
                            <path
                              d="M6.00016 7.99967L7.3335 9.33301L10.3335 6.33301M6.13476 13.7336C6.35326 13.7047 6.57399 13.764 6.74805 13.898L7.5502 14.5136C7.81536 14.7173 8.18422 14.7173 8.44864 14.5136L9.28117 13.8743C9.43671 13.7551 9.63299 13.7025 9.82705 13.7284L10.8684 13.8654C11.1995 13.9091 11.5188 13.7247 11.6469 13.4158L12.0476 12.447C12.1224 12.2655 12.2661 12.1218 12.4476 12.047L13.4164 11.6462C13.7252 11.5188 13.9097 11.1988 13.866 10.8677L13.7341 9.86407C13.7052 9.64556 13.7645 9.42482 13.8986 9.25075L14.5141 8.44855C14.7178 8.18337 14.7178 7.81449 14.5141 7.55006L13.8749 6.71749C13.7556 6.56194 13.703 6.36565 13.7289 6.17158L13.866 5.13013C13.9097 4.79902 13.7252 4.47977 13.4164 4.35163L12.4476 3.9509C12.2661 3.87609 12.1224 3.73239 12.0476 3.55091L11.6469 2.58205C11.5195 2.27317 11.1995 2.08873 10.8684 2.13243L9.82705 2.26946C9.63299 2.29613 9.43671 2.24354 9.28191 2.12502L8.44938 1.48578C8.18422 1.28208 7.81536 1.28208 7.55094 1.48578L6.71842 2.12502C6.56288 2.24354 6.3666 2.29613 6.17254 2.27094L5.13114 2.13391C4.80006 2.09021 4.48083 2.27465 4.35269 2.58353L3.95272 3.55239C3.87717 3.73313 3.73348 3.87683 3.55276 3.95238L2.58395 4.35237C2.27508 4.48051 2.09066 4.79976 2.13436 5.13087L2.27138 6.17232C2.29656 6.36639 2.24398 6.56268 2.12547 6.71749L1.48626 7.55006C1.28257 7.81524 1.28257 8.18411 1.48626 8.44855L2.12547 9.28112C2.24472 9.43667 2.2973 9.63296 2.27138 9.82703L2.13436 10.8685C2.09066 11.1996 2.27508 11.5188 2.58395 11.647L3.55276 12.0477C3.73422 12.1225 3.87791 12.2662 3.95272 12.4477L4.35343 13.4166C4.48083 13.7254 4.8008 13.9099 5.13188 13.8662L6.13476 13.7336Z"
                              stroke="var(--ui-light-black-primary, #111111)"
                              stroke-width="1.33333"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                          </g>
                          <defs>
                            <clipPath id="clip0_2507_3935">
                              <rect width="16" height="16" fill="white" />
                            </clipPath>
                          </defs>
                        </svg>
                        <div class="text-[#1f1f1f] text-left font-['Raleway-Regular',_sans-serif] text-sm font-normal relative">
                          <?php echo esc_html($review['verified'] ? 'Verified Buyer' : 'Unverified Buyer'); ?>
                        </div>
                      </div>
                    </div>
                    <div class="flex flex-row gap-[4.67px] items-center justify-start shrink-0 relative">
                      <div class="flex flex-row gap-0 items-center justify-start shrink-0 relative">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                        <svg class="shrink-0 w-3.5 h-3.5 relative overflow-visible"
                          width="14"
                          height="14"
                          viewBox="0 0 14 14"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M10.2435 12.2498C10.1502 12.2502 10.0581 12.2282 9.97512 12.1856L7.00012 10.6281L4.02512 12.1856C3.82803 12.2893 3.58913 12.2717 3.40937 12.1402C3.22961 12.0088 3.14034 11.7865 3.17929 11.5673L3.76262 8.28313L1.35929 5.94979C1.20649 5.79731 1.15039 5.57291 1.21345 5.36646C1.28243 5.15496 1.4657 5.0011 1.68595 4.96979L5.01095 4.48563L6.47512 1.49313C6.57259 1.29188 6.77652 1.16406 7.00012 1.16406C7.22373 1.16406 7.42765 1.29188 7.52512 1.49313L9.00679 4.47979L12.3318 4.96396C12.552 4.99527 12.7353 5.14912 12.8043 5.36063C12.8674 5.56708 12.8113 5.79148 12.6585 5.94396L10.2551 8.27729L10.8385 11.5615C10.881 11.7848 10.7899 12.0124 10.6051 12.1448C10.4995 12.2188 10.3723 12.2557 10.2435 12.2498Z"
                            fill="<?php echo esc_attr($review['rating'] >= $i ? '#FEA500' : '#D3D3D3'); ?>"
                          />
                        </svg>
                        <?php endfor; ?>
                      </div>
                    </div>
                  </div>
                  <div class="flex flex-col gap-2 items-start justify-start self-stretch shrink-0 relative">
                    <div class="text-left font-['Raleway-Medium',_sans-serif] text-sm leading-[22px] font-medium relative self-stretch">
                      <span>
                        <span class="the-quality-of-the-sofa-exceeded-my-expectations-the-design-fits-perfectly-in-our-living-room-and-the-comfort-level-is-more-span">
                          <?php echo esc_html($review['comment']); ?>....
                        </span>
                        <span class="the-quality-of-the-sofa-exceeded-my-expectations-the-design-fits-perfectly-in-our-living-room-and-the-comfort-level-is-more-span2">
                          <?php esc_html_e('More', 'creative-furniture'); ?>
                        </span>
                      </span>
                    </div>
                  </div>
                  <div class="flex flex-row items-start justify-between self-stretch shrink-0 relative mt-auto">
                    <div class="text-[#2b2b2b] text-left font-['Raleway-Medium',_sans-serif] text-xs font-medium relative flex-1">
                      <?php echo esc_html($review['date']); ?>
                    </div>
                    <svg class="shrink-0 w-6 h-6 relative overflow-visible"
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M22.56 12.25C22.56 11.47 22.49 10.72 22.36 10H12V14.26H17.92C17.66 15.63 16.88 16.79 15.71 17.57V20.34H19.28C21.36 18.42 22.56 15.6 22.56 12.25Z"
                        fill="#4285F4"
                      />
                      <path
                        d="M12.0002 22.9996C14.9702 22.9996 17.4602 22.0196 19.2802 20.3396L15.7102 17.5696C14.7302 18.2296 13.4802 18.6296 12.0002 18.6296C9.14018 18.6296 6.71018 16.6996 5.84018 14.0996H2.18018V16.9396C3.99018 20.5296 7.70018 22.9996 12.0002 22.9996Z"
                        fill="#34A853"
                      />
                      <path
                        d="M5.84 14.0903C5.62 13.4303 5.49 12.7303 5.49 12.0003C5.49 11.2703 5.62 10.5703 5.84 9.91031V7.07031H2.18C1.43 8.55031 1 10.2203 1 12.0003C1 13.7803 1.43 15.4503 2.18 16.9303L5.03 14.7103L5.84 14.0903Z"
                        fill="#FBBC05"
                      />
                      <path
                        d="M12.0002 5.38C13.6202 5.38 15.0602 5.94 16.2102 7.02L19.3602 3.87C17.4502 2.09 14.9702 1 12.0002 1C7.70018 1 3.99018 3.47 2.18018 7.07L5.84018 9.91C6.71018 7.31 9.14018 5.38 12.0002 5.38Z"
                        fill="#EA4335"
                      />
                    </svg>
                  </div>
                </div>
              </a>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  