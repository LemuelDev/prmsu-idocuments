/** @type {import('tailwindcss').Config} */

module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      backgroundImage: theme => ({
        'mesh-gradient': "radial-gradient(circle at 20% 30%, #ff9a9e, transparent 25%), radial-gradient(circle at 70% 40%, #fad0c4, transparent 25%), radial-gradient(circle at 40% 80%, #fad0c4, transparent 25%), radial-gradient(circle at 80% 70%, #a18cd1, transparent 25%), radial-gradient(circle at 90% 90%, #fbc2eb, transparent 25%), radial-gradient(circle at 30% 50%, #a18cd1, transparent 25%)",
      }),
    },
  },
  plugins: [],
}

