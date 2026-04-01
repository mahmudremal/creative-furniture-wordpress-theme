/** @type {import('tailwindcss').Config} */
module.exports = {
  // darkMode: "class", // '[data-theme="dark"]',
  // prefix: "xpo_", // /hunting
  content: [...Array(10)].map(
    (u, i) =>
      `./${[...Array(i)].map((o) => "**/").join("")}*.{txt,php,js,jsx,ts,tsx}`,
  ),
  theme: {
    extend: {
      colors: {},
      fontFamily: {
        // sans: ["Inter", "sans-serif"],
      },
      zIndex: {
        100: "100",
        999: "999",
      },
      screens: {
        "3xl": "1920px",
      },
      gridColumn: {
        "span-9": "span 9 / span 9",
        "span-10": "span 10 / span 10",
        "span-20": "span 20 / span 20",
      },
      gridTemplateColumns: {
        29: "repeat(29, minmax(0, 1fr))",
      },
    },
  },
  // plugins: [require("daisyui")],
  // corePlugins: {
  //   preflight: false,
  // },
  // safelist: [
  //   {
  //     pattern: /xpo_/,
  //   },
  // ],
};
