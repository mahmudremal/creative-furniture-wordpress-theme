const fs = require("fs");

const list = [
  {
    label: "Home",
    link: "{{home_url}}/product-category/ct-b-home-furniture/",
    mega: [
      {
        title: "Living Furniture",
        links: [
          {
            title: "Accent Furniture",
            link: "{{home_url}}/product-category/ct-b-home-furniture/",
            head: true,
          },
          {
            title: "TV Unit/Media Console",
            link: "{{home_url}}/product-category/ac00-accent-furniture/ac03-tv-units-media-console/ac03a-tv-units-media-console-lv/",
            head: false,
          },
          {
            title: "Shoe Racks",
            link: "{{home_url}}/product-category/ac00-accent-furniture/ac04-shoe-racks-cabinets/",
            head: false,
          },
          {
            title: "Wall Shelves",
            link: "{{home_url}}/product-category/ac00-accent-furniture/ac05-wall-shelves_1/",
            head: false,
          },
          {
            title: "Display Unit/Bookshelf",
            link: "{{home_url}}/product-category/st00-storages/st01-full-height-open-cabinet-crockery-unit/st01c-display-unit-book-shelves/",
            head: false,
          },
          {
            title: "Coffee Table",
            link: "{{home_url}}/product-category/ac00-accent-furniture/ac01-coffee-tables/ac01b-coffee-table-lv/",
            head: false,
          },
          {
            title: "Side & End Table",
            link: "{{home_url}}/product-category/ac00-accent-furniture/ac02-side-end-tables/ac02b-side-end-tables-lv/",
            head: false,
          },
          {
            title: "Credenza/Console Table",
            link: "{{home_url}}/product-category/st00-storages/st07-low-hieght-storages/st07b-credenza-console-tables/",
            head: false,
          },
          {
            title: "Sofa Seating",
            link: "{{home_url}}/product-category/ct-b-home-furniture/",
            head: true,
          },
          {
            title: "Sofa Set",
            link: "{{home_url}}/product-category/ss00-seatings/ss01-sofa-sets/ss01a-sofa-sets-lv/",
            head: false,
          },
          {
            title: "Lshape-Sofa",
            link: "{{home_url}}/product-category/ss00-seatings/ss02-l-shape-sofas/ss02a-l-shape-sofas-lv/",
            head: false,
          },
          {
            title: "Sofa Cum Bed",
            link: "{{home_url}}/product-category/ss00-seatings/ss03-sofa-cum-beds/",
            head: false,
          },
          {
            title: "Chaise Lounge/Sun Lounger",
            link: "{{home_url}}/product-category/ss00-seatings/ss04-chaise-lounge-sun-lounger/ss04a-chaise-lounge-sun-loungers-lv/",
            head: false,
          },
          {
            title: "Seating & Chair",
            link: "{{home_url}}/product-category/c00-chairs/",
            head: true,
          },
          {
            title: "Bench with Storage",
            link: "{{home_url}}/product-category/ss00-seatings/ss05-benches-ottomans/ss05a-benches-with-storage/",
            head: false,
          },
          {
            title: "Ottomans/Bench without Storage",
            link: "{{home_url}}/product-category/ss00-seatings/ss05-benches-ottomans/ss05b-ottomans-bench-without-storage/",
            head: false,
          },
          {
            title: "Pouff/Stool",
            link: "{{home_url}}/product-category/ss00-seatings/ss06-pouffs-stool/ss06a-pouffs-stool-lv/",
            head: false,
          },
          {
            title: "Single Seater Swings/Bucket Swings",
            link: "{{home_url}}/product-category/ss00-seatings/ss07-swings/ss07a-single-seater-swing-bucket-swings/",
            head: false,
          },
          {
            title: "Arm Chair",
            link: "{{home_url}}/product-category/c00-chairs/c01-arm-chair/c01a-arm-chair-lv/",
            head: false,
          },
          {
            title: "Bean Bags",
            link: "{{home_url}}/product-category/ss00-seatings/ss08-bean-bags/",
            head: false,
          },
          {
            title: "Temples/Mandir",
            link: "{{home_url}}/product-category/ct-b-home-furniture/",
            head: true,
          },
          {
            title: "Wall Hung Temple",
            link: "{{home_url}}/product-category/ac09-mandir-temples/ac09a-mandir-temples-wall-hung/",
            head: false,
          },
          {
            title: "Free Standing Temple",
            link: "{{home_url}}/product-category/ac09-mandir-temples/ac09b-mandir-temples-free-standing/",
            head: false,
          },
          {
            title: "Altars/Home Chappels",
            link: "{{home_url}}/product-category/ac09-mandir-temples/ac10-altars/",
            head: false,
          },
          {
            title: "Mirrors",
            link: "{{home_url}}/product-category/w01-wall-mirrors/w00-mirrors/",
            head: true,
          },
          {
            title: "Wall Mirrors",
            link: "{{home_url}}/product-creativefurniture-category/w01-wall-mirrors/",
            head: false,
          },
          {
            title: "Back Lit Mirrors",
            link: "{{home_url}}/product-category/w01-wall-mirrors/w00-mirrors/w02-back-lit-mirrors/",
            head: false,
          },
          {
            title: "Floor Standing Mirrors",
            link: "{{home_url}}/product-category/w01-wall-mirrors/w00-mirrors/w03-floor-standing-mirrors/",
            head: false,
          },
          {
            title: "Wall Decor Mirrors",
            link: "{{home_url}}/product-category/w01-wall-mirrors/w00-mirrors/w04-wall-decor-mirrors/",
            head: false,
          },
        ],
      },
      {
        title: "Study & Home Office Furniture",
        links: [
          {
            title: "Desk",
            link: "{{home_url}}/product-category/d00-desk/",
            head: true,
          },
          {
            title: "Sit & Stand Desk",
            link: "{{home_url}}/product-category/d00-desk/d07-sit-stand-desk/",
            head: false,
          },
          {
            title: "Study Tables",
            link: "{{home_url}}/product-category/d00-desk/d03-one-seater-tables/d03c-study-tables/",
            head: false,
          },
          {
            title: "Chairs",
            link: "{{home_url}}/product-category/c00-chairs/",
            head: true,
          },
          {
            title: "Study Chair",
            link: "{{home_url}}/product-category/c00-chairs/c02-study-dinning-chair/c02a-study-dinning-chair-st/",
            head: false,
          },
          {
            title: "Mesh Chair",
            link: "{{home_url}}/product-category/c00-chairs/c03a-modular-chairs/c03b-mesh-chairs/",
            head: false,
          },
          {
            title: "Bean Bags",
            link: "{{home_url}}/product-category/ss00-seatings/ss08-bean-bags/",
            head: false,
          },
          {
            title: "Storage",
            link: "{{home_url}}/product-category/st00-storages/",
            head: true,
          },
          {
            title: "Book Shelves/Display Unit",
            link: "{{home_url}}/product-category/st00-storages/st01-full-height-open-cabinet-crockery-unit/st01c-display-unit-book-shelves/",
            head: false,
          },
          {
            title: "Full Height Closed Cabinet",
            link: "{{home_url}}/product-category/st00-storages/st03-closed-cabinets-wadrobes/st03a-full-height-closed-cabinets-double-door-wadrobes/",
            head: false,
          },
          {
            title: "Low Height Closed Cabinet",
            link: "{{home_url}}/product-category/st00-storages/st07-low-hieght-storages/st07a-low-height-closed-cabinets/",
            head: false,
          },
        ],
      },
      {
        title: "Washroom Furniture",
        links: [
          {
            title: "Under Counter Vanities with Basin",
            link: "{{home_url}}/product-category/st00-storages/st09-vanities/st09a-under-counter-vanities-with-basin/",
            head: false,
          },
          {
            title: "Under Counter Vanities without Basin",
            link: "{{home_url}}/product-category/st00-storages/st09-vanities/st09b-under-counter-vanities-without-basin/",
            head: false,
          },
          {
            title: "Wall Cabinet",
            link: "{{home_url}}/product-category/st00-storages/st06-wall-cabinets/",
            head: false,
          },
          {
            title: "Wall Shelves",
            link: "{{home_url}}/product-category/ac00-accent-furniture/ac05-wall-shelves/",
            head: false,
          },
        ],
      },
      {
        title: "Bedroom Set",
        links: [
          {
            title: "SBD-01-Hayden",
            link: "{{home_url}}/product-category/set01-set-house-designs/sbd-00-standard-bedroom-set/sbd-01-hayden-series/",
            head: false,
          },
          {
            title: "SBD-07-Aldino",
            link: "{{home_url}}/product-category/set01-set-house-designs/sbd-00-standard-bedroom-set/sbd-07-aldino-series/",
            head: false,
          },
          {
            title: "SSH-03-Odmo",
            link: "{{home_url}}/product-category/hotel/standard-hotel-set/ssh-03-odmo-series/",
            head: false,
          },
          {
            title: "SSH-09-Brealy",
            link: "{{home_url}}/product-category/hotel/standard-hotel-set/ssh-09-brealy-series/",
            head: false,
          },
          {
            title: "SSH-15-Volen",
            link: "{{home_url}}/product-category/hotel/standard-hotel-set/ssh-15-volen-series/",
            head: false,
          },
          {
            title: "SBD-02-Zey",
            link: "{{home_url}}/product-category/set01-set-house-designs/sbd-00-standard-bedroom-set/sbd-02-zey-series/",
            head: false,
          },
          {
            title: "SBD-08-Classy",
            link: "{{home_url}}/product-category/set01-set-house-designs/sbd-00-standard-bedroom-set/sbd-08-classy-series/",
            head: false,
          },
          {
            title: "SSH-04-Cances",
            link: "{{home_url}}/product-category/hotel/standard-hotel-set/ssh-04-cances-series/",
            head: false,
          },
          {
            title: "SSH-10-Loma",
            link: "{{home_url}}/product-category/hotel/standard-hotel-set/ssh-10-loma-series/",
            head: false,
          },
          {
            title: "SSH-16-Cince",
            link: "{{home_url}}/product-category/set01-set-house-designs/ssh-00-standard-hotel-room-set/ssh-16-cince-series/",
            head: false,
          },
          {
            title: "SBD-03-Akins",
            link: "{{home_url}}/product-category/set01-set-house-designs/sbd-00-standard-bedroom-set/sbd-03-akins-series/",
            head: false,
          },
          {
            title: "SBD-09-Kerlin",
            link: "{{home_url}}/product-category/set01-set-house-designs/sbd-00-standard-bedroom-set/sbd-09-kerlin-series/",
            head: false,
          },
          {
            title: "SSH-05-Wackje",
            link: "{{home_url}}/product-category/hotel/standard-hotel-set/ssh-05-wackje-series/",
            head: false,
          },
          {
            title: "SSH-11-Ferien",
            link: "{{home_url}}/product-category/hotel/standard-hotel-set/ssh-11-ferien-series/",
            head: false,
          },
          {
            title: "SSH-17-Atosto",
            link: "{{home_url}}/product-category/hotel/standard-hotel-set/ssh-17-atosto-series/",
            head: false,
          },
          {
            title: "SBD-04-Bryce",
            link: "{{home_url}}/product-category/set01-set-house-designs/sbd-00-standard-bedroom-set/sbd-04-bryce-series/",
            head: false,
          },
          {
            title: "SBD-10-Pine",
            link: "{{home_url}}/product-category/set01-set-house-designs/sbd-00-standard-bedroom-set/sbd-10-pine-series/",
            head: false,
          },
          {
            title: "SSH-06-Doval",
            link: "{{home_url}}/product-category/hotel/standard-hotel-set/ssh-06-doval-series/",
            head: false,
          },
          {
            title: "SSH-12-Vakacio",
            link: "{{home_url}}/product-category/hotel/standard-hotel-set/ssh-12-vakacio-series/",
            head: false,
          },
          {
            title: "SBD-05-Alysa",
            link: "{{home_url}}/product-category/set01-set-house-designs/sbd-00-standard-bedroom-set/sbd-05-alysa-series/",
            head: false,
          },
          {
            title: "SSH-01-Shime",
            link: "{{home_url}}/product-category/hotel/standard-hotel-set/ssh-01-shime-series/",
            head: false,
          },
          {
            title: "SSH-07-Ferie",
            link: "{{home_url}}/product-category/hotel/standard-hotel-set/ssh-07-ferie-series/",
            head: false,
          },
          {
            title: "SSH-13-Kanza",
            link: "{{home_url}}/product-category/hotel/standard-hotel-set/ssh-13-kanza-series/",
            head: false,
          },
          {
            title: "SBD-06-Artur",
            link: "{{home_url}}/product-category/set01-set-house-designs/sbd-00-standard-bedroom-set/sbd-06-artur-series/",
            head: false,
          },
          {
            title: "SSH-02-Orak",
            link: "{{home_url}}/product-category/hotel/standard-hotel-set/ssh-02-orak-series/",
            head: false,
          },
          {
            title: "SSH-08-Vacaly",
            link: "{{home_url}}/product-category/hotel/standard-hotel-set/ssh-08-vacaly-series/",
            head: false,
          },
          {
            title: "SSH-14-Mester",
            link: "{{home_url}}/product-category/home-furniture/bedroom-set/24-mester/",
            head: false,
          },
        ],
      },
      {
        title: "Bedroom Furniture",
        links: [
          {
            title: "BedRoom Sets",
            link: "{{home_url}}/product-category/set02-set-house/",
            head: true,
          },
          {
            title: "Double Bed Room Sets",
            link: "{{home_url}}/product-category/set02-set-house/set04a-sbd-ssh-double-bed-room-set/",
            head: false,
          },
          {
            title: "Double Bed with Side Table Sets",
            link: "{{home_url}}/product-category/set02-set-house/set02a-sbd-sbdt-ssh-double-bedside-table-set/",
            head: false,
          },
          {
            title: "Upholstered Double Bed with Side Table Sets",
            link: "{{home_url}}/product-category/set02-set-house/set02b-sbd-sbdt-ssh-upholstered-double-bedside-table-set/",
            head: false,
          },
          {
            title: "Single Bed Room Sets",
            link: "{{home_url}}/product-category/set02-set-house/set05a-sbd-ssh-single-bed-room-set/",
            head: false,
          },
          {
            title: "Single Bed with Side Table Sets",
            link: "{{home_url}}/product-category/set02-set-house/set03a-sbd-sbdt-ssh-single-bedside-table-set/",
            head: false,
          },
          {
            title: "Bed",
            link: "{{home_url}}/product-category/b00-beds/",
            head: true,
          },
          {
            title: "Upholstered Bed with Storage",
            link: "{{home_url}}/product-category/b00-beds/b01-beds-upholstered-with-storage/",
            head: false,
          },
          {
            title: "Upholstered Bed without Storage",
            link: "{{home_url}}/product-category/b00-beds/b02-beds-upholstered-without-storage/",
            head: false,
          },
          {
            title: "Headboard Bed with Storage",
            link: "{{home_url}}/product-category/b00-beds/b03-bed-headboard-with-storage/",
            head: false,
          },
          {
            title: "Headboard Bed without Storage",
            link: "{{home_url}}/product-category/b00-beds/b04-bed-headboard-without-storage/",
            head: false,
          },
          {
            title: "Four Poster Beds",
            link: "{{home_url}}/product-category/b00-beds/b05-four-poster-beds/",
            head: false,
          },
          {
            title: "Bed Frames",
            link: "{{home_url}}/product-category/b00-beds/b06-bed-frames/",
            head: false,
          },
          {
            title: "Headboards without Bed Frame",
            link: "{{home_url}}/product-category/b00-beds/b07-headboards-without-bed/",
            head: false,
          },
          {
            title: "Murphy Bed",
            link: "{{home_url}}/product-category/b00-beds/b08-murphy-beds/",
            head: false,
          },
          {
            title: "Bunk Bed",
            link: "{{home_url}}/product-category/b00-beds/b09-bunk-beds/",
            head: false,
          },
          {
            title: "Trundle Bed",
            link: "{{home_url}}/product-category/b00-beds/b10-trundle-beds/",
            head: false,
          },
          {
            title: "Single/Twin Bed",
            link: "{{home_url}}/product-category/b00-beds/b11-twin-single-beds/b11a-twin-single-beds-bd/",
            head: false,
          },
          {
            title: "Mattress",
            link: "{{home_url}}/product-category/m00-mattress/",
            head: true,
          },
          {
            title: "Single Bed Mattress",
            link: "{{home_url}}/product-category/m00-mattress/m01-single-bed-mattress/",
            head: false,
          },
          {
            title: "Queen Bed Mattress",
            link: "{{home_url}}/product-category/m00-mattress/m02-queen-bed-mattress/",
            head: false,
          },
          {
            title: "King Bed Mattress",
            link: "{{home_url}}/product-category/m00-mattress/m03-king-bed-mattress/",
            head: false,
          },
          {
            title: "Foldable Mattress",
            link: "{{home_url}}/product-category/m00-mattress/m05-foldable-mattress/",
            head: false,
          },
          {
            title: "Pillow",
            link: "{{home_url}}/product-category/m00-mattress/m06-pillow/",
            head: false,
          },
          {
            title: "Bed Wedge",
            link: "{{home_url}}/product-category/m00-mattress/m07-bed-wedge/",
            head: false,
          },
          {
            title: "Accent Tables",
            link: "{{home_url}}/product-category/ct-b-home-furniture/",
            head: true,
          },
          {
            title: "Chest of Drawer",
            link: "{{home_url}}/product-category/st00-storages/st08-chest-of-drawers/",
            head: false,
          },
          {
            title: "Dressing Table",
            link: "{{home_url}}/product-category/ac00-accent-furniture/ac06-dressing-tables/",
            head: false,
          },
          {
            title: "Bedside Table",
            link: "{{home_url}}/product-category/ac00-accent-furniture/ac07-bedside-tables-night-stands/ac07a-bedside-tables-night-stands-bd/",
            head: false,
          },
          {
            title: "TV Unit/Media Console",
            link: "{{home_url}}/product-category/ac00-accent-furniture/ac03-tv-units-media-console/ac03b-tv-units-media-console-bd/",
            head: false,
          },
          {
            title: "Study Table",
            link: "{{home_url}}/product-category/d00-desk/d03-one-seater-tables/d03c-study-tables/",
            head: false,
          },
          {
            title: "Storage",
            link: "{{home_url}}/product-category/st00-storages/",
            head: true,
          },
          {
            title: "Double Door Wadrobes + Full Height Closed Cabinet",
            link: "{{home_url}}/product-category/st00-storages/st03-closed-cabinets-wadrobes/st03a-full-height-closed-cabinets-double-door-wadrobes/",
            head: false,
          },
          {
            title: "Openable Swing Door Wardrobe",
            link: "{{home_url}}/product-category/st00-storages/st03-closed-cabinets-wadrobes/st03b-openable-swing-door-wardrobes/",
            head: false,
          },
          {
            title: "Sliding Door Wadrobe",
            link: "{{home_url}}/product-category/st00-storages/st04-sliding-door-wadrobes/",
            head: false,
          },
          {
            title: "Locker/Trunk",
            link: "{{home_url}}/product-category/st00-storages/st02-lockers-trunks/",
            head: false,
          },
        ],
      },
      {
        title: "Kids Furniture",
        links: [
          {
            title: "Kids Bed with Side Table Sets",
            link: "{{home_url}}/product-category/set02-set-house/set03b-skbt-kids-single-bedside-table-set/",
            head: false,
          },
          {
            title: "Kids Bed",
            link: "{{home_url}}/product-category/b00-beds/b11-twin-single-beds/b11b-twin-single-beds-kf/",
            head: false,
          },
          {
            title: "Baby Cots",
            link: "{{home_url}}/product-category/b00-beds/b12-baby-cots/",
            head: false,
          },
          {
            title: "Bunk Bed",
            link: "{{home_url}}/product-category/b00-beds/b09-bunk-beds/",
            head: false,
          },
          {
            title: "Kids Mattress",
            link: "{{home_url}}/product-category/m00-mattress/m04-kids-mattress/",
            head: false,
          },
          {
            title: "Bedside Table",
            link: "{{home_url}}/product-category/ac00-accent-furniture/ac07-bedside-tables-night-stands/ac07b-bedside-tables-night-stands-kd/",
            head: false,
          },
          {
            title: "Nursing Table",
            link: "{{home_url}}/product-category/st00-storages/st07-low-hieght-storages/st07d-nursing-tables/",
            head: false,
          },
          {
            title: "Kids Storage",
            link: "{{home_url}}/product-category/st00-storages/st05-kids-storage/",
            head: false,
          },
          {
            title: "Kids Study Table",
            link: "{{home_url}}/product-category/d00-desk/d03-one-seater-tables/d03d-study-tables-kf/",
            head: false,
          },
          {
            title: "Kids Study Chair",
            link: "{{home_url}}/product-category/c00-chairs/c02-study-dinning-chair/c02a-study-dinning-chair-st/",
            head: false,
          },
          {
            title: "Bean Bags",
            link: "{{home_url}}/product-category/ss00-seatings/ss08-bean-bags/",
            head: false,
          },
          {
            title: "Sit & Stand Desk",
            link: "{{home_url}}/product-category/d00-desk/d07-sit-stand-desk/",
            head: false,
          },
          {
            title: "Alphabetic Shelf",
            link: "{{home_url}}/product-category/ac00-accent-furniture/ac05-wall-shelves/ac05a-alphabetic-shelves/",
            head: false,
          },
        ],
      },
      {
        title: "Dining Room Set",
        links: [
          {
            title: "SDN-01-Ornet",
            link: "{{home_url}}/product-category/set01-set-house-designs/sdn-00-dining-room-set/sdn-01-ornet-series/",
            head: false,
          },
          {
            title: "SDN-05-Nova",
            link: "{{home_url}}/product-category/set01-set-house-designs/sdn-00-dining-room-set/sdn-05-nova-series/",
            head: false,
          },
          {
            title: "SDN-09-Harvey",
            link: "{{home_url}}/product-category/set01-set-house-designs/sdn-00-dining-room-set/sdn-09-harvey-series/",
            head: false,
          },
          {
            title: "SDN-13-Hali",
            link: "{{home_url}}/product-category/set01-set-house-designs/sdn-00-dining-room-set/sdn-13-hali-series/",
            head: false,
          },
          {
            title: "SDN-17-Dora",
            link: "{{home_url}}/product-category/set01-set-house-designs/sdn-00-dining-room-set/sdn-17-dora-series/",
            head: false,
          },
          {
            title: "SDN-02-Milton",
            link: "{{home_url}}/product-category/set01-set-house-designs/sdn-00-dining-room-set/sdn-02-milton-series/",
            head: false,
          },
          {
            title: "SDN-06-Niles",
            link: "{{home_url}}/product-category/set01-set-house-designs/sdn-00-dining-room-set/sdn-06-niles-series/",
            head: false,
          },
          {
            title: "SDN-10-Ramen",
            link: "{{home_url}}/product-category/set01-set-house-designs/sdn-00-dining-room-set/sdn-10-ramen-series/",
            head: false,
          },
          {
            title: "SDN-14-Hashwood",
            link: "{{home_url}}/product-category/set01-set-house-designs/sdn-00-dining-room-set/sdn-14-hashwood-series/",
            head: false,
          },
          {
            title: "SDN-18-Vitra",
            link: "{{home_url}}/product-category/set01-set-house-designs/sdn-00-dining-room-set/sdn-18-vitra-series/",
            head: false,
          },
          {
            title: "SDN-03-Mashriya",
            link: "{{home_url}}/product-category/set01-set-house-designs/sdn-00-dining-room-set/sdn-03-mashriya-series/",
            head: false,
          },
          {
            title: "SDN-07-Victor",
            link: "{{home_url}}/product-category/set01-set-house-designs/sdn-00-dining-room-set/sdn-07-victor-series/",
            head: false,
          },
          {
            title: "SDN-11-Fetro",
            link: "{{home_url}}/product-category/set01-set-house-designs/sdn-00-dining-room-set/sdn-11-fetro-series/",
            head: false,
          },
          {
            title: "SDN-15-Levina",
            link: "{{home_url}}/product-category/set01-set-house-designs/sdn-00-dining-room-set/sdn-15-levina-series/",
            head: false,
          },
          {
            title: "SDN-19-Evelin",
            link: "{{home_url}}/product-category/set01-set-house-designs/sdn-00-dining-room-set/sdn-19-evelin-series/",
            head: false,
          },
          {
            title: "SDN-04-Arra",
            link: "{{home_url}}/product-category/set01-set-house-designs/sdn-00-dining-room-set/sdn-04-arra-series/",
            head: false,
          },
          {
            title: "SDN-08-Zeehan",
            link: "{{home_url}}/product-category/set01-set-house-designs/sdn-00-dining-room-set/sdn-08-zeehan-series/",
            head: false,
          },
          {
            title: "SDN-12-Ritz",
            link: "{{home_url}}/product-category/set01-set-house-designs/sdn-00-dining-room-set/sdn-12-ritz-series/",
            head: false,
          },
          {
            title: "SDN-16-Luca",
            link: "{{home_url}}/product-category/set01-set-house-designs/sdn-00-dining-room-set/sdn-16-luca-series/",
            head: false,
          },
          {
            title: "SDN-20-Dussel",
            link: "{{home_url}}/product-category/set01-set-house-designs/sdn-00-dining-room-set/sdn-20-dussel-series/",
            head: false,
          },
        ],
      },
      {
        title: "Dining Furniture",
        links: [
          {
            title: "Dining Table Set",
            link: "{{home_url}}/product-category/set02-set-house/set01a-sdn-dining-table-set/",
            head: true,
          },
          {
            title: "4 Seater Dining Table Set",
            link: "{{home_url}}/product-category/set02-set-house/set01a-sdn-dining-table-set/set01b-sdn-4-seater-dining-table-set/",
            head: false,
          },
          {
            title: "6 Seater Dining Table Set",
            link: "{{home_url}}/product-category/set02-set-house/set01a-sdn-dining-table-set/set01c-sdn-6-seater-dining-table-set/",
            head: false,
          },
          {
            title: "8 Seater Dining Table Set",
            link: "{{home_url}}/product-category/set02-set-house/set01a-sdn-dining-table-set/set01d-sdn-8-seater-dining-table-set/",
            head: false,
          },
          {
            title: "Table",
            link: "{{home_url}}/product-category/t00-functional-tables/t06-dining-table/",
            head: true,
          },
          {
            title: "Dining Table",
            link: "{{home_url}}/product-category/t00-functional-tables/t06-dining-table/",
            head: false,
          },
          {
            title: "Folding Dining Table",
            link: "{{home_url}}/product-category/t00-functional-tables/t05-folding-tables/",
            head: false,
          },
          {
            title: "Cafeteria/Outdoor Pantry Tables",
            link: "{{home_url}}/product-category/t00-functional-tables/t07-cafeteria-outdoor-pantry-tables/",
            head: false,
          },
          {
            title: "Chair",
            link: "{{home_url}}/product-category/c00-chairs/c02-study-dinning-chair/c02b-study-dinning-chair-dn/",
            head: true,
          },
          {
            title: "Dining Chair",
            link: "{{home_url}}/product-category/c00-chairs/c02-study-dinning-chair/c02b-study-dinning-chair-dn/",
            head: false,
          },
          {
            title: "Bench with Storage",
            link: "{{home_url}}/product-category/ss00-seatings/ss05-benches-ottomans/ss05a-benches-with-storage/",
            head: false,
          },
          {
            title: "Ottomans/Bench without Storage",
            link: "{{home_url}}/product-category/ss00-seatings/ss05-benches-ottomans/ss05b-ottomans-bench-without-storage/",
            head: false,
          },
          {
            title: "Storage",
            link: "{{home_url}}/product-category/st00-storages/",
            head: true,
          },
          {
            title: "Full Height Open Cabinet + Crockery Unit",
            link: "{{home_url}}/product-category/st00-storages/st01-full-height-open-cabinet-crockery-unit/st01d-crockery-unit-dn/",
            head: false,
          },
          {
            title: "Low Height Cabinets",
            link: "{{home_url}}/product-category/st00-storages/st07-low-hieght-storages/st07c-low-height-credenzas/",
            head: false,
          },
          {
            title: "Wall Cabinet",
            link: "{{home_url}}/product-category/st00-storages/st06-wall-cabinets/",
            head: false,
          },
          {
            title: "Bar Counter",
            link: "{{home_url}}/product-category/ac00-accent-furniture/ac12-bar-counters-cabinets/ac08a-bar-counters-cabinets-dn/",
            head: true,
          },
          {
            title: "Bar Cabinet/Counter",
            link: "{{home_url}}/product-category/ac00-accent-furniture/ac08-bar-counters-cabinets/ac08a-bar-counters-cabinets-dn/",
            head: false,
          },
          {
            title: "Bar Stool",
            link: "{{home_url}}/product-category/c00-chairs/c03a-modular-chairs/c3h-bar-stools/",
            head: false,
          },
        ],
      },
    ],
  },
  {
    label: "Office",
    link: "{{home_url}}/product-category/ct-a-office/",
    mega: [
      {
        title: "Office Furniture",
        links: [
          {
            title: "Desk/Workstations",
            link: "{{home_url}}/product-category/d00-desk/",
            head: true,
          },
          {
            title: "Reception Desks",
            link: "{{home_url}}/product-category/d00-desk/d01-reception-concierge-tables/",
            head: false,
          },
          {
            title: "Executive Desks",
            link: "{{home_url}}/product-category/d00-desk/d02-executive-desks/",
            head: false,
          },
          {
            title: "Workstations - One Seater",
            link: "{{home_url}}/product-category/d00-desk/d03-one-seater-tables/d03a-workstations-1a-seater/",
            head: false,
          },
          {
            title: "Workstations - One Seater (L Type)",
            link: "{{home_url}}/product-category/d00-desk/d03-one-seater-tables/d03b-workstations-1b-seater-l-type/",
            head: false,
          },
          {
            title: "Workstations - Two Seater",
            link: "{{home_url}}/product-category/d00-desk/d04-two-seater-workstations/d04a-workstations-2a-seater/",
            head: false,
          },
          {
            title: "Workstations - Two Seater (L Type)",
            link: "{{home_url}}/product-category/d00-desk/d04-two-seater-workstations/d04b-workstations-2b-seater-l-type/",
            head: false,
          },
          {
            title: "Workstations - Three Seater",
            link: "{{home_url}}/product-category/d00-desk/d05-three-seater-workstations/",
            head: false,
          },
          {
            title: "Workstations - Four Seater",
            link: "{{home_url}}/product-category/d00-desk/d06-four-seater-workstations/d06a-workstations-4a-seater/",
            head: false,
          },
          {
            title: "Workstations - Four Seater (PlusType)",
            link: "{{home_url}}/product-category/d00-desk/d06-four-seater-workstations/d06b-workstations-4b-seater-type/",
            head: false,
          },
          {
            title: "Sit & Stand Desk",
            link: "{{home_url}}/product-category/d00-desk/d07-sit-stand-desk/",
            head: false,
          },
          {
            title: "Conversation Tables",
            link: "{{home_url}}/product-category/ct-a-office/",
            head: true,
          },
          {
            title: "Meeting Tables",
            link: "{{home_url}}/product-category/t00-functional-tables/t01-meeting-tables/",
            head: false,
          },
          {
            title: "Conference Tables",
            link: "{{home_url}}/product-category/t00-functional-tables/t02-conference-tables/",
            head: false,
          },
          {
            title: "Small Meeting Tables",
            link: "{{home_url}}/product-category/t00-functional-tables/t03-small-meeting-tables/",
            head: false,
          },
          {
            title: "Training Tables",
            link: "{{home_url}}/product-category/t00-functional-tables/t04-training-tables/",
            head: false,
          },
          {
            title: "Folding Tables",
            link: "{{home_url}}/product-category/t00-functional-tables/t05-folding-tables/",
            head: false,
          },
          {
            title: "Cafeteria + Pantry Tables",
            link: "{{home_url}}/product-category/t00-functional-tables/t07-cafeteria-outdoor-pantry-tables/",
            head: false,
          },
          {
            title: "Coffee Tables",
            link: "{{home_url}}/product-category/ac00-accent-furniture/ac01-coffee-tables/ac01a-coffee-table-of/",
            head: false,
          },
          {
            title: "Side & End Tables",
            link: "{{home_url}}/product-category/ac00-accent-furniture/ac02-side-end-tables/ac02a-side-end-tables-of/",
            head: false,
          },
          {
            title: "Storage & Filling Cabinet",
            link: "{{home_url}}/product-category/ct-a-office/",
            head: true,
          },
          {
            title: "Full Height Open Cabinet",
            link: "{{home_url}}/product-category/st00-storages/st01-full-height-open-cabinet-crockery-unit/st01a-full-height-open-cabinet-of/",
            head: false,
          },
          {
            title: "Full Height Filling Cabinet",
            link: "{{home_url}}/product-category/st00-storages/st01-full-height-open-cabinet-crockery-unit/st01b-full-height-filling-cabinets/",
            head: false,
          },
          {
            title: "Locker/Trunk",
            link: "{{home_url}}/product-category/st00-storages/st02-lockers-trunks/",
            head: false,
          },
          {
            title: "Full Height Closed Cabinet",
            link: "{{home_url}}/product-category/st00-storages/st03-closed-cabinets-wadrobes/st03a-full-height-closed-cabinets-double-door-wadrobes/",
            head: false,
          },
          {
            title: "Low Height Closed Cabinet",
            link: "{{home_url}}/product-category/st00-storages/st07-low-hieght-storages/st07a-low-height-closed-cabinets/",
            head: false,
          },
          {
            title: "Low Height Credenza",
            link: "{{home_url}}/product-category/st00-storages/st07-low-hieght-storages/st07c-low-height-credenzas/",
            head: false,
          },
          {
            title: "Sofa Seating",
            link: "{{home_url}}/product-category/ss00-seatings/",
            head: true,
          },
          {
            title: "Sofa Set",
            link: "{{home_url}}/product-category/ss00-seatings/ss01-sofa-sets/",
            head: false,
          },
          {
            title: "Lshape-Sofa",
            link: "{{home_url}}/product-category/ss00-seatings/ss02-l-shape-sofas/",
            head: false,
          },
          {
            title: "Arm Chairs",
            link: "{{home_url}}/product-category/c00-chairs/c01-arm-chair/",
            head: false,
          },
          {
            title: "Bench with Storage",
            link: "{{home_url}}/product-category/ss00-seatings/ss05-benches-ottomans/ss05a-benches-with-storage/",
            head: false,
          },
          {
            title: "Pouffes/Stool",
            link: "{{home_url}}/product-category/ss00-seatings/ss06-pouffs-stool/",
            head: false,
          },
          {
            title: "Bean Bags",
            link: "{{home_url}}/product-category/ss00-seatings/ss08-bean-bags/",
            head: false,
          },
          {
            title: "Chair",
            link: "{{home_url}}/product-category/office-furniture/office-chairs/{{home_url}}/product-category/c00-chairs/",
            head: true,
          },
          {
            title: "Exceutive Chairs",
            link: "{{home_url}}/product-category/c00-chairs/c03a-modular-chairs/c03-executive-chairs/",
            head: false,
          },
          {
            title: "Mesh Chairs",
            link: "{{home_url}}/product-category/c00-chairs/c03a-modular-chairs/c03b-mesh-chairs/",
            head: false,
          },
          {
            title: "Secretary Chairs",
            link: "{{home_url}}/product-category/c00-chairs/c03a-modular-chairs/c03c-secretary-chairs/",
            head: false,
          },
          {
            title: "Economic Chairs",
            link: "{{home_url}}/product-category/c00-chairs/c03a-modular-chairs/c03d-economic-chairs/",
            head: false,
          },
          {
            title: "Visitor Chairs",
            link: "{{home_url}}/product-category/c00-chairs/c03a-modular-chairs/c03e-visitor-chairs/",
            head: false,
          },
          {
            title: "Waiting Area Chairs",
            link: "{{home_url}}/product-category/c00-chairs/c03a-modular-chairs/c03f-waiting-area-chairs/",
            head: false,
          },
          {
            title: "Training Room Chairs",
            link: "{{home_url}}/product-category/c00-chairs/c03a-modular-chairs/c03g-training-room-chairs/",
            head: false,
          },
          {
            title: "Bar Stool / High Stools",
            link: "{{home_url}}/product-category/c00-chairs/c03a-modular-chairs/c3h-bar-stools/",
            head: false,
          },
        ],
      },
      {
        title: "Office Room Set",
        links: [
          {
            title: "SOF-01-Arian",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-01-arian-series/",
            head: false,
          },
          {
            title: "SOF-06-Gray Module",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-06-gray-module-series/",
            head: false,
          },
          {
            title: "SOF-11-Kona",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-11-kona-series/",
            head: false,
          },
          {
            title: "SOF-16-Anto",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-16-anto-series/",
            head: false,
          },
          {
            title: "SOF-21-Cloud",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-21-cloud-series/",
            head: false,
          },
          {
            title: "SOF-26-Snow-Module",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-26-snow-module-series/",
            head: false,
          },
          {
            title: "SOF-31-Diamond",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-31-diamond-series/",
            head: false,
          },
          {
            title: "SOF-02-Box",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-02-box-series/",
            head: false,
          },
          {
            title: "SOF-07-Walli",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-07-walli-series/",
            head: false,
          },
          {
            title: "SOF-12-Alder",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-12-alder-series/",
            head: false,
          },
          {
            title: "SOF-17-Muke",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-17-muke-series/",
            head: false,
          },
          {
            title: "SOF-22-Plank",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-22-plank-series/",
            head: false,
          },
          {
            title: "SOF-27-Frosty",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-27-frosty-series/",
            head: false,
          },
          {
            title: "SOF-32-Jane",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-32-jane-series/",
            head: false,
          },
          {
            title: "SOF-03-Pasa",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-03-pasa-series/",
            head: false,
          },
          {
            title: "SOF-08-Ashley",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-08-ashley-series/",
            head: false,
          },
          {
            title: "SOF-13-Dina",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-13-dina-series/",
            head: false,
          },
          {
            title: "SOF-18-Hats",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-18-hats-series/",
            head: false,
          },
          {
            title: "SOF-23-X-Module",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-23-x-module-series/",
            head: false,
          },
          {
            title: "SOF-28-Luna",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-28-luna-series/",
            head: false,
          },
          {
            title: "SOF-33-Opal",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-33-opal-series/",
            head: false,
          },
          {
            title: "SOF-04-Mint",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-04-mint-series/",
            head: false,
          },
          {
            title: "SOF-09-Honey",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-09-honey-series/",
            head: false,
          },
          {
            title: "SOF-14-Asma",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-14-asma-series/",
            head: false,
          },
          {
            title: "SOF-19-Marraw",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-19-marraw-series/",
            head: false,
          },
          {
            title: "SOF-24-Pyramid",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-24-pyramid-series/",
            head: false,
          },
          {
            title: "SOF-29-Nova",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-29-nova-series/",
            head: false,
          },
          {
            title: "SOF-05-Sunny",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-05-sunny-series/",
            head: false,
          },
          {
            title: "SOF-10-Mist",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-10-mist-series/",
            head: false,
          },
          {
            title: "SOF-15-Mona",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-15-mona-series/",
            head: false,
          },
          {
            title: "SOF-20-Concrete",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-20-concrete-series/",
            head: false,
          },
          {
            title: "SOF-25-Sleek",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-25-sleek-series/",
            head: false,
          },
          {
            title: "SOF-30-Ruby",
            link: "{{home_url}}/product-category/set01-set-house-designs/sof-00-office-set/sof-30-ruby-series/",
            head: false,
          },
        ],
      },
    ],
  },
  {
    label: "Hospitality",
    link: "{{home_url}}/product-category/ct-d-hospitality-furniture/",
    mega: [
      {
        title: "Hospitality Furniture",
        links: [
          {
            title: "Sofa",
            link: "{{home_url}}/product-category/ss00-seatings/ss01-sofa-sets/",
            head: true,
          },
          {
            title: "Sofa Sets",
            link: "{{home_url}}/product-category/ss00-seatings/ss01-sofa-sets/",
            head: false,
          },
          {
            title: "L Shape Sofa",
            link: "{{home_url}}/product-category/ss00-seatings/ss02-l-shape-sofas/",
            head: false,
          },
          {
            title: "Sofa cum Bed",
            link: "{{home_url}}/product-category/ss00-seatings/ss03-sofa-cum-beds/",
            head: false,
          },
          {
            title: "Chaise Lounge",
            link: "{{home_url}}/product-category/ss00-seatings/ss04-chaise-lounge-sun-lounger/",
            head: false,
          },
          {
            title: "Seating & Chair",
            link: "{{home_url}}/product-category/ct-d-hospitality-furniture/",
            head: true,
          },
          {
            title: "Arm Chair",
            link: "{{home_url}}/product-category/c00-chairs/c01-arm-chair/",
            head: false,
          },
          {
            title: "Dining Chair",
            link: "{{home_url}}/product-category/c00-chairs/c02-study-dinning-chair/",
            head: false,
          },
          {
            title: "Bar Stool",
            link: "{{home_url}}/product-category/c00-chairs/c03a-modular-chairs/c3h-bar-stools/",
            head: false,
          },
          {
            title: "Bench with Storage",
            link: "{{home_url}}/product-category/ss00-seatings/ss05-benches-ottomans/ss05a-benches-with-storage/",
            head: false,
          },
          {
            title: "Ottoman/Bench without storage",
            link: "{{home_url}}/product-category/ss00-seatings/ss05-benches-ottomans/ss05b-ottomans-bench-without-storage/",
            head: false,
          },
          {
            title: "Pouff/Stool",
            link: "{{home_url}}/product-category/ss00-seatings/ss06-pouffs-stool/",
            head: false,
          },
          {
            title: "Bean Bags",
            link: "{{home_url}}/product-category/ss00-seatings/ss08-bean-bags/",
            head: false,
          },
          {
            title: "Utility Tables + Storage",
            link: "{{home_url}}/product-category/st00-storages/",
            head: true,
          },
          {
            title: "Cash Counter",
            link: "{{home_url}}/product-category/st00-storages/st10-cash-counters/",
            head: false,
          },
          {
            title: "Service Station",
            link: "{{home_url}}/product-category/st00-storages/st11-service-stations/",
            head: false,
          },
          {
            title: "DJ Console",
            link: "{{home_url}}/product-category/st00-storages/st12-dj-consoles/",
            head: false,
          },
          {
            title: "Low Height Cabinet",
            link: "{{home_url}}/product-category/st00-storages/st07-low-hieght-storages/st07c-low-height-credenzas/",
            head: false,
          },
          {
            title: "Full Height Filling Cabinets",
            link: "{{home_url}}/product-category/st00-storages/st01-full-height-open-cabinet-crockery-unit/st01b-full-height-filling-cabinets/",
            head: false,
          },
          {
            title: "Bar Cabinets / Counters",
            link: "{{home_url}}/product-category/ac00-accent-furniture/ac08-bar-counters-cabinets/",
            head: false,
          },
          {
            title: "Mirror",
            link: "{{home_url}}/product-category/w01-wall-mirrors/w00-mirrors/",
            head: true,
          },
          {
            title: "Wall Mirror",
            link: "{{home_url}}/product-category/w01-wall-mirrors/",
            head: false,
          },
          {
            title: "Back Lit Mirror",
            link: "{{home_url}}/product-category/w01-wall-mirrors/w00-mirrors/w02-back-lit-mirrors/",
            head: false,
          },
          {
            title: "Floor Standing Mirror",
            link: "{{home_url}}/product-category/w01-wall-mirrors/w00-mirrors/w03-floor-standing-mirrors/",
            head: false,
          },
          {
            title: "Wall Decor Mirror",
            link: "{{home_url}}/product-category/w01-wall-mirrors/w00-mirrors/w04-wall-decor-mirrors/",
            head: false,
          },
          {
            title: "Accent Table",
            link: "{{home_url}}/product-category/ct-d-hospitality-furniture/",
            head: true,
          },
          {
            title: "Reception/Conceirge Table",
            link: "{{home_url}}/product-category/d00-desk/d01-reception-concierge-tables/",
            head: false,
          },
          {
            title: "Coffee Table",
            link: "{{home_url}}/product-category/ac00-accent-furniture/ac01-coffee-tables/",
            head: false,
          },
          {
            title: "Side & End Table",
            link: "{{home_url}}/product-category/ac00-accent-furniture/ac02-side-end-tables/",
            head: false,
          },
          {
            title: "Credenza/Console Table",
            link: "{{home_url}}/product-category/st00-storages/st07-low-hieght-storages/st07b-credenza-console-tables/",
            head: false,
          },
          {
            title: "Dine in Set",
            link: "{{home_url}}/product-category/set02-set-house/set01a-sdn-dining-table-set/",
            head: false,
          },
          {
            title: "Cafeteria + Pantry Tables",
            link: "{{home_url}}/product-category/t00-functional-tables/t07-cafeteria-outdoor-pantry-tables/",
            head: false,
          },
        ],
      },
      {
        title: "Hotel Bedroom Set",
        links: [
          {
            title: "Standard Hotel Sets",
            link: "{{home_url}}/product-category/ssh-00-standard-hotel-room-set/",
            head: true,
          },
          {
            title: "SSH-01-Shime",
            link: "{{home_url}}/product-category/home-furniture/bedroom-set/ssh-01-shime-series/",
            head: false,
          },
          {
            title: "SSH-02-Orak",
            link: "{{home_url}}/product-category/set01-set-house-designs/ssh-00-standard-hotel-room-set/ssh-02-orak-series/",
            head: false,
          },
          {
            title: "SSH-03-Odmo",
            link: "{{home_url}}/product-category/set01-set-house-designs/ssh-00-standard-hotel-room-set/ssh-03-odmo-series/",
            head: false,
          },
          {
            title: "SSH-04-Cances",
            link: "{{home_url}}/product-category/set01-set-house-designs/ssh-00-standard-hotel-room-set/ssh-04-cances-series/",
            head: false,
          },
          {
            title: "SSH-05-Wackje",
            link: "{{home_url}}/product-category/set01-set-house-designs/ssh-00-standard-hotel-room-set/ssh-05-wackje-series/",
            head: false,
          },
          {
            title: "SSH-06-Doval",
            link: "{{home_url}}/product-category/set01-set-house-designs/ssh-00-standard-hotel-room-set/ssh-06-doval-series/",
            head: false,
          },
          {
            title: "SSH-07-Ferie",
            link: "{{home_url}}/product-category/set01-set-house-designs/ssh-00-standard-hotel-room-set/ssh-07-ferie-series/",
            head: false,
          },
          {
            title: "SSH-08-Vacaly",
            link: "{{home_url}}/product-category/set01-set-house-designs/ssh-00-standard-hotel-room-set/ssh-08-vacaly-series/",
            head: false,
          },
          {
            title: "SSH-09-Brealy",
            link: "{{home_url}}/product-category/set01-set-house-designs/ssh-00-standard-hotel-room-set/ssh-09-brealy-series/",
            head: false,
          },
          {
            title: "SSH-10-Loma",
            link: "{{home_url}}/product-category/set01-set-house-designs/ssh-00-standard-hotel-room-set/ssh-10-loma-series/",
            head: false,
          },
          {
            title: "SSH-11-Ferien",
            link: "{{home_url}}/product-category/set01-set-house-designs/ssh-00-standard-hotel-room-set/ssh-11-ferien-series/",
            head: false,
          },
          {
            title: "SSH-12-Vakacio",
            link: "{{home_url}}/product-category/set01-set-house-designs/ssh-00-standard-hotel-room-set/ssh-12-vakacio-series/",
            head: false,
          },
          {
            title: "SSH-13-Kanza",
            link: "{{home_url}}/product-category/set01-set-house-designs/ssh-00-standard-hotel-room-set/ssh-13-kanza-series/",
            head: false,
          },
          {
            title: "SSH-14-Mester",
            link: "{{home_url}}/product-category/set01-set-house-designs/ssh-00-standard-hotel-room-set/ssh-14-mester-series/",
            head: false,
          },
          {
            title: "SSH-15-Volen",
            link: "{{home_url}}/product-category/set01-set-house-designs/ssh-00-standard-hotel-room-set/ssh-15-volen-series/",
            head: false,
          },
          {
            title: "SSH-16-Cince",
            link: "{{home_url}}/product-category/set01-set-house-designs/ssh-00-standard-hotel-room-set/ssh-16-cince-series/",
            head: false,
          },
          {
            title: "SSH-17-Atosto",
            link: "{{home_url}}/product-category/set01-set-house-designs/ssh-00-standard-hotel-room-set/ssh-17-atosto-series/",
            head: false,
          },
          {
            title: "Premium Hotel Sets",
            link: "file:///C:/Users/Lenovo/Downloads/Untitled-1.html#",
            head: true,
          },
          {
            title: "Luxury Hotel Sets",
            link: "file:///C:/Users/Lenovo/Downloads/Untitled-1.html#",
            head: true,
          },
        ],
      },
      {
        title: "University Furniture",
        links: [
          {
            title: "Desk & Table",
            link: "{{home_url}}/product-category/d00-desk/",
            head: true,
          },
          {
            title: "Student Desk",
            link: "{{home_url}}/product-category/d00-desk/d08-student-desk/",
            head: false,
          },
          {
            title: "Teachers Desk",
            link: "{{home_url}}/product-category/d00-desk/d02-executive-desks/",
            head: false,
          },
          {
            title: "Staff Room Table",
            link: "{{home_url}}/product-category/d00-desk/d09-staff-room-table/",
            head: false,
          },
          {
            title: "Cafeteria + Pantry Tables",
            link: "{{home_url}}/product-category/t00-functional-tables/t07-cafeteria-outdoor-pantry-tables/",
            head: false,
          },
          {
            title: "Storage",
            link: "{{home_url}}/product-category/st00-storages/",
            head: true,
          },
          {
            title: "Locker/Trunks",
            link: "{{home_url}}/product-category/st00-storages/st02-lockers-trunks/",
            head: false,
          },
          {
            title: "Full Height Closed Cabinet",
            link: "{{home_url}}/product-category/st00-storages/st03-closed-cabinets-wadrobes/st03a-full-height-closed-cabinets-double-door-wadrobes/",
            head: false,
          },
          {
            title: "Openable Swing Door Wadrobe",
            link: "{{home_url}}/product-category/st00-storages/st03-closed-cabinets-wadrobes/st03b-openable-swing-door-wardrobes/",
            head: false,
          },
          {
            title: "Seating & Chair",
            link: "{{home_url}}/product-category/ct-d-hospitality-furniture/",
            head: true,
          },
          {
            title: "Student Bench",
            link: "{{home_url}}/product-category/ss00-seatings/ss05-benches-ottomans/",
            head: false,
          },
          {
            title: "Student Chair",
            link: "{{home_url}}/product-category/c00-chairs/c02-study-dinning-chair/",
            head: false,
          },
          {
            title: "Student Stool",
            link: "{{home_url}}/product-category/c00-chairs/c03a-modular-chairs/c3h-bar-stools/",
            head: false,
          },
          {
            title: "Bean Bags",
            link: "{{home_url}}/product-category/ss00-seatings/ss08-bean-bags/",
            head: false,
          },
          {
            title: "Beds",
            link: "{{home_url}}/product-category/b00-beds/",
            head: true,
          },
          {
            title: "Bunk Bed",
            link: "{{home_url}}/product-category/b00-beds/b09-bunk-beds/",
            head: false,
          },
          {
            title: "Trundle Bed",
            link: "{{home_url}}/product-category/b00-beds/b10-trundle-beds/",
            head: false,
          },
          {
            title: "Single/Twin Bed",
            link: "{{home_url}}/product-category/b00-beds/b11-twin-single-beds/",
            head: false,
          },
          {
            title: "Bedside Table + Night Stands",
            link: "{{home_url}}/product-category/ac00-accent-furniture/ac07-bedside-tables-night-stands/",
            head: false,
          },
        ],
      },
      {
        title: "Medical Center Furniture",
        links: [],
      },
      {
        title: "Bank Furniture",
        links: [],
      },
    ],
  },
  {
    label: "Outdoor",
    link: "{{home_url}}/product-category/ct-c-outdoor-furniture/",
    mega: [
      {
        title: "Outdoor Furniture",
        links: [
          {
            title: "Sofa Seating",
            link: "{{home_url}}/product-category/ct-c-outdoor-furniture/",
            head: true,
          },
          {
            title: "Sofa Set",
            link: "{{home_url}}/product-category/ss00-seatings/ss01-sofa-sets/",
            head: false,
          },
          {
            title: "Lshape-Sofa Set",
            link: "{{home_url}}/product-category/ss00-seatings/ss02-l-shape-sofas/",
            head: false,
          },
          {
            title: "Sun Lounger",
            link: "{{home_url}}/product-category/ss00-seatings/ss04-chaise-lounge-sun-lounger/",
            head: false,
          },
          {
            title: "Swing",
            link: "{{home_url}}/product-category/ct-c-outdoor-furniture/",
            head: true,
          },
          {
            title: "Single Seater Swing",
            link: "{{home_url}}/product-category/ss00-seatings/ss07-swings/ss07a-single-seater-swing-bucket-swings/",
            head: false,
          },
          {
            title: "Double Seater Swing",
            link: "{{home_url}}/product-category/ss00-seatings/ss07-swings/ss07b-double-seater-swing/",
            head: false,
          },
          {
            title: "Seating & Chair",
            link: "{{home_url}}/product-category/ct-c-outdoor-furniture/",
            head: true,
          },
          {
            title: "Arm Chair",
            link: "{{home_url}}/product-category/c00-chairs/c01-arm-chair/",
            head: false,
          },
          {
            title: "Ottoman",
            link: "{{home_url}}/product-category/ss00-seatings/ss06-ottomans-bench-without-storage/",
            head: false,
          },
          {
            title: "Pouff/Stool",
            link: "{{home_url}}/product-category/ss00-seatings/ss07-pouffes-stool/",
            head: false,
          },
          {
            title: "Chair",
            link: "{{home_url}}/product-category/c00-chairs/c02-study-dinning-chair/c02c-study-dinning-chair-ou/",
            head: false,
          },
          {
            title: "Bean Bags",
            link: "{{home_url}}/product-category/ss00-seatings/ss08-bean-bags/",
            head: false,
          },
          {
            title: "Table",
            link: "{{home_url}}/product-category/ct-c-outdoor-furniture/",
            head: true,
          },
          {
            title: "Coffee Table",
            link: "{{home_url}}/product-category/ac00-accent-furniture/ac01-coffee-tables/ac01c-coffee-table-ou/",
            head: false,
          },
          {
            title: "Side & End Table",
            link: "{{home_url}}/product-category/ac00-accent-furniture/ac02-side-end-tables/ac02c-side-end-tables-ou/",
            head: false,
          },
          {
            title: "Dining Table",
            link: "{{home_url}}/product-category/t00-functional-tables/t06-dining-table/",
            head: false,
          },
          {
            title: "Cafeteria + Outdoor Pantry Tables",
            link: "{{home_url}}/product-category/t00-functional-tables/t07-cafeteria-outdoor-pantry-tables/",
            head: false,
          },
          {
            title: "Bar Cabinet/Counter",
            link: "{{home_url}}/product-category/ac00-accent-furniture/ac08-bar-counters-cabinets/ac08b-bar-counters-cabinets-ou/",
            head: false,
          },
        ],
      },
    ],
  },
];
list.forEach((megaMenus) => {
  const expectedmenus = {
    ...megaMenus,
    mega: megaMenus.mega.map((mega) => {
      const result = [];
      let current = null;

      for (const row of mega.links) {
        if (row.head) {
          current = { ...row, items: [] };
          result.push(current);
        } else {
          if (!current) {
            current = { head: null, items: [] };
            result.push(current);
          }
          current.items.push(row);
        }
      }

      return { ...mega, links: result };
    }),
  };
  const content = `
  <div class="bg-[#ffffff] flex flex-col gap-0 items-start justify-start relative hospitality-menu" data-menu-id="0">
  <div class="w-full max-w-full md:w-[1440px] 2xl:w-[1920px] m-auto relative">
      <div class="2xl:max-w-[1440px] py-12 px-4 flex flex-col gap-10 items-start justify-start self-stretch shrink-0">
        <div class="flex flex-row gap-10 items-start justify-start self-stretch shrink-0 min-h-[600px] relative">
          
          <aside class="flex flex-col gap-10 items-start justify-start self-stretch shrink-0 relative sidebar-area">
            <div class="flex flex-col gap-4 items-start justify-center self-stretch shrink-0 relative sidebar__group">
              ${expectedmenus.mega
                .map(
                  ({ title }, index) => `
              <div class="flex flex-row items-center justify-between shrink-0 w-full relative cursor-pointer group sidebar__title ${index === 0 ? "active" : ""}" data-block-index="${index}">
                <div class="flex flex-row gap-2 items-center justify-start shrink-0 relative">
                  <div class="sidebar-label text-[#222222] group-[.active]:text-[#bd262a] text-left font-['Raleway-SemiBold',_sans-serif] text-base leading-5 font-semibold relative flex-1 transition-colors">
                    ${title}
                  </div>
                </div>
                <svg class="shrink-0 w-6 h-6 relative overflow-visible transition-transform group-[.active]:translate-x-1" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M9 18L15 12L9 6" stroke="currentColor" class="text-[#222222] group-[.active]:text-[#bd262a]" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </div>`,
                )
                .join("")}
            </div>
          </aside>

          <div class="flex flex-col gap-0 items-start justify-start flex-1 relative content-area">
            ${expectedmenus.mega
              .map(
                ({ links = [], title: megaTitle, link: megaLink }, index) => `
            <div class="hospitality__block w-full grid grid-cols-[1fr,366px] gap-10 items-start justify-start flex-1 relative ${index === 0 ? "" : "hidden"} transition-all duration-300" data-index="${index}">
              
              <div class="columns-3 gap-x-12 gap-y-10 items-start justify-start relative">
                ${links
                  .map(
                    ({ title, link, items = [] }) => `
                <div class="break-inside-avoid flex flex-col gap-4 items-start justify-start min-relative border-l border-[#D1D1D1] pl-4 pb-4" style="border-left: 1px solid #D1D1D1; padding-left: 16px; padding-bottom: 16px;">
                  ${
                    title
                      ? `<a href="${link || "#"}" class="text-[#222222] text-left font-['Raleway-SemiBold',_sans-serif] text-base leading-5 font-semibold relative flex flex-row items-center justify-between w-full hover:text-[#bd262a] transition-colors group/item">
                          <span>${title}</span>
                          <svg class="w-4 h-4 opacity-0 group-hover/item:opacity-100 transition-opacity" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18L15 12L9 6" /></svg>
                        </a>`
                      : ""
                  }
                  <div class="flex flex-col gap-2.5 items-start justify-start shrink-0 relative opacity-80">
                    ${items
                      .map(
                        ({ title, link }) => `
                    <a href="${link}" class="text-[#222222] text-left font-['Raleway-Regular',_sans-serif] text-base leading-5 font-normal relative hover:text-[#bd262a] transition-colors">
                      ${title}
                    </a>`,
                      )
                      .join("")}
                  </div>
                </div>`,
                  )
                  .join("")}
              </div>

                <div class="flex flex-col gap-6 items-start justify-start shrink-0 relative p-6" style="background: #F4F4F4;">
                  <div class="shrink-0 w-full relative overflow-hidden rounded-[4px]" style="aspect-ratio: 5/4;">
                    <img class="w-full h-full object-cover" src="{{home_url}}/wp-content/themes/creative-furniture/dist/images/v2/rectangle-346243760.png" alt="Promo" />
                  </div>
                  <a href="${megaLink || expectedmenus.link}" class="flex flex-row gap-2 items-center justify-around shrink-0 w-full relative" target="_blank">
                    <div class="text-[#3f3f3f] text-right font-['Raleway-SemiBold',_sans-serif] text-xl leading-6 font-semibold relative">
                      See All ${megaTitle}
                    </div>
                    <div class="bg-[#bd262a] rounded-[25px] p-0.5 flex flex-row gap-2.5 items-center justify-start">
                      <svg class="shrink-0 w-7 h-7 relative overflow-visible" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.16663 19.8332L19.8333 8.1665M19.8333 8.1665H8.16663M19.8333 8.1665V19.8332" stroke="white" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"></path>
                      </svg>
                    </div>
                  </a>
                </div>

            </div>`,
              )
              .join("")}
          </div>

        </div>
      </div>
    </div>
  </div>
  `;
  fs.writeFileSync(`./${megaMenus.label}.txt`, content);
});
