import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            // Tokens from spesifikasi-desain-ui.md section 2.
            fontFamily: {
                sans: ['Lexend', 'system-ui', '-apple-system', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: '#0F2A6B',
                    hover: '#0B1F52',
                    soft: '#EEF2FF',
                },
                ink: {
                    DEFAULT: '#111827',
                    secondary: '#374151',
                    muted: '#6B7280',
                },
                line: '#E5E7EB',
                subtle: '#F8FAFC',
                danger: '#E11D48',
            },
            borderRadius: {
                sm: '8px',
                md: '12px',
                lg: '16px',
            },
            boxShadow: {
                sm: '0 1px 3px rgba(0,0,0,0.06)',
                md: '0 4px 14px rgba(0,0,0,0.08)',
            },
        },
    },

    plugins: [forms],
};
