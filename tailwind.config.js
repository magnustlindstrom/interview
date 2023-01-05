const defaultTheme = require('tailwindcss/defaultTheme');

const generateColorClass = (variable) => {
    return `var(--color-${variable})`;

    return ({opacityValue}) => {
        if (opacityValue === undefined) {
            return `rgb(var(--${variable}))`
        }
        return `rgb(var(--${variable}))`
    }
}

module.exports = {
    content: [
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        './resources/**/*.svg',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: generateColorClass('primary'),
                secondary: generateColorClass('secondary'),
                tertiary: generateColorClass('tertiary'),
                accent: generateColorClass('accent'),
                button: generateColorClass('button'),
                page: generateColorClass('page'),
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
};
