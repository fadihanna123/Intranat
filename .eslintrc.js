const config = {
  env: {
    browser: true,
    es2023: true,
  },
  extends: [
    'eslint:recommended',
    'plugin:@typescript-eslint/recommended',
    'plugin:css/recommended',
    'plugin:editorconfig/all',
  ],
  overrides: [
    {
      env: {
        node: true,
      },
      files: ['.eslintrc.{js,cjs}'],
      parserOptions: {
        sourceType: 'script',
      },
    },
  ],
  parser: '@typescript-eslint/parser',
  parserOptions: {
    ecmaVersion: 'latest',
    sourceType: 'module',
  },
  plugins: ['@typescript-eslint', 'html', 'css', 'sql', 'editorconfig'],
  rules: {
    'no-console': 'error',
    indent: ['error', 2],
    'linebreak-style': ['error', 'windows'],
    quotes: ['error', 'single'],
    semi: ['error', 'always'],
    'at-rule-no-unknown': 0,
    'editorconfig/eol-last': 'off',
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
};

module.exports = config;
