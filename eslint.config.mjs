import typescriptEslint from '@typescript-eslint/eslint-plugin';
import html from 'eslint-plugin-html';
import css from 'eslint-plugin-css';
import sql from 'eslint-plugin-sql';
import globals from 'globals';
import tsParser from '@typescript-eslint/parser';
import path from 'node:path';
import { fileURLToPath } from 'node:url';
import js from '@eslint/js';
import { FlatCompat } from '@eslint/eslintrc';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const compat = new FlatCompat({
  baseDirectory: __dirname,
  recommendedConfig: js.configs.recommended,
  allConfig: js.configs.all,
});

export default [
  {
    ignores: [
      'node_modules/*',
      'Js/*',
      'Dashboard/Js/*',
      'Dashboard/ckeditor5/webpack.config.js',
    ],
  },
  ...compat.extends(
    'eslint:recommended',
    'plugin:@typescript-eslint/recommended',
    'plugin:css/recommended'
  ),
  {
    plugins: {
      '@typescript-eslint': typescriptEslint,
      html,
      css,
      sql,
    },

    languageOptions: {
      globals: {
        ...globals.browser,
      },

      parser: tsParser,
      ecmaVersion: 'latest',
      sourceType: 'module',
    },

    rules: {
      'no-console': 'error',
      indent: ['error', 2],
      'linebreak-style': ['error', 'windows'],
      quotes: ['error', 'single'],
      semi: ['error', 'always'],
      'at-rule-no-unknown': 0,

      'sql/format': [
        2,
        {
          ignoreExpressions: false,
          ignoreInline: true,
          ignoreTagless: true,
        },
      ],

      'sql/no-unsafe-query': [
        2,
        {
          allowLiteral: false,
        },
      ],
    },
  },
  {
    files: ['**/.eslintrc.{js,cjs}'],

    languageOptions: {
      globals: {
        ...globals.node,
      },

      ecmaVersion: 5,
      sourceType: 'commonjs',
    },
  },
];
