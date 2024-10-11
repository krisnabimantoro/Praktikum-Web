/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/index.html"],
  theme: {
    extend: {
      fontFamily: {
        poppins: ["poppins"],
      },
      colors: {
        primary: "#1966FF",
        secondary: "#F2F3F6",
        third: "#0F3D99",
        abu: "#94A3B8",
        background_col: "#F2F3F6",
      },
    },
  },
  plugins: [],
};
