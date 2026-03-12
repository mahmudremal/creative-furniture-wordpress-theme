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

`
<div class="hospitality container-fluid" data-menu-id="0">
  <div class="hospitality__cta">
    <a href="${expectedmenus.link}">View All ${expectedmenus.label} Furniture</a>
  </div>

  <div class="hospitality__content">
    <aside class="hospitality__sidebar">
      <div class="sidebar__group">
        ${expectedmenus.mega
          .map(
            ({ title, link = null }, index) => `
        <div class="sidebar__title ${index === 0 ? "active" : ""}">
            <span>${title}</span>
            <a href="${link || "#"}" class="sidebar__btn" target="_blank">
            View All
            <img
                src="https://creativefurniture.xyz/wp-content/themes/creative-furniture/dist/images/arrow-right.png"
                alt=""
            />
            </a>
        </div>`,
          )
          .join("")}
      </div>
    </aside>

    <div class="hospitality__blocks">
      ${expectedmenus.mega
        .map(
          ({ links = [] }, index) => `
      <div class="hospitality__block ${index === 0 ? "active" : ""}">

        <section class="hospitality__main">
          <div class="columns">
              ${links
                .map(
                  ({ title, link, items = [] }) => `
              <div class="column">
                ${
                  title
                    ? `<h4>${title}</h4>
                `
                    : ""
                }
                <ul>
                  ${items
                    .map(
                      ({
                        title,
                        link,
                      }) => `<li><a href="${link}">${title}</a></li>
                  `,
                    )
                    .join("")}
                </ul>
              </div>`,
                )
                .join("")}
          </div>
        </section>
        <aside class="hospitality__promo">
          <img
            src="https://creativefurniture.xyz/wp-content/themes/creative-furniture/dist/images/megamenucard.jpg"
            alt=""
          />
          <ul class="apromo__links">
            <li>
              <a href="#">
                Sofa Sets
                <img
                  src="https://creativefurniture.xyz/wp-content/themes/creative-furniture/dist/images/arrow-right.png"
                  alt=""
                />
              </a>
            </li>
            <li>
              <a href="#">
                L Shape Sofa
                <img
                  src="https://creativefurniture.xyz/wp-content/themes/creative-furniture/dist/images/arrow-right.png"
                  alt=""
                />
              </a>
            </li>
            <li>
              <a href="#">
                Sofa Cum Bed
                <img
                  src="https://creativefurniture.xyz/wp-content/themes/creative-furniture/dist/images/arrow-right.png"
                  alt=""
                />
              </a>
            </li>
          </ul>
        </aside>
      </div>
      `,
        )
        .join("")}
    </div>
  </div>
</div>

`;
