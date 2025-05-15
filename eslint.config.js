import globals from 'globals';
import pluginJs from '@eslint/js';
import pluginVue from 'eslint-plugin-vue';

export default [
    ...pluginVue.configs['flat/recommended'],
    {
        files: ['**/*.{js,vue}'],
        rules: {
            'no-unused-var': 'off',
            'vue/max-attributes-per-line': [
                'error',
                {
                    singleline: 10,
                    multiline: 1,
                },
            ],
            'vue/multi-word-component-names': 'off',
            'vue/html-indent': ['error', 4],
        },
        languageOptions: {
            sourceType: 'module',
            globals: {
                ...globals.browser,
                route: true,
                axios: true,
            },
        },
    },
    pluginJs.configs.recommended,
];
