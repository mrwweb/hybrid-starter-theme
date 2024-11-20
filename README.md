<!-- markdownlint-disable MD014 -->
# {Site Name} Theme

A theme supporting the block editor based on [_s](https://github.com/Automattic/_s/) but with a _tremendous_ number of changes 😃.

## See Also

There are other `README.md` files in this theme in specific folders where explanations of rationale and structure are useful. e.g. `src/scss/blocks/` describes when to make a partial for a block and when to compile it into the main sheet

## Quick Start

Clone or download this repository and it's submodules:

```sh
$ git clone --recursive https://github.com/mrwweb/hybrid-starter-theme.git <THEME_FOLDER_NAME>
```

Update theme details in `style.css` and set new 1200x900 `screenshot.png`.

Finally, do a six-step find and replace on the name in all the templates.

1. Search for `'_mrw'` (inside single quotations) to capture the text domain and replace with: `'theme-prefix'`.
2. Search for `"_mrw"` (double quotes) to capture phpcs ruleset and replace with `"theme-prefix"`
3. Search for `_mrw_` to capture all the functions names and replace with: `theme_prefix_`.
4. Search for ` _mrw` (with a space before it) to capture DocBlocks and replace with: `Theme_Prefix`. {{< /_<!-- markdownlint-disable -->_/ >}}
5. Search for `_mrw-` to capture prefixed handles and replace with: `theme-prefix-`.
6. Search for `_MRW_` (in uppercase) to capture constants and replace with: `THEME_PREFIX_`.

## Build Process

This site uses a SASS build process in order to support SASS with autoprefixer.

Edit CSS files in `/src/scss/`

See `package.json` for details.

To install build from `/wp-content/themes/{themename}/`

```sh
$ npm install
$ npm audit fix
```

To run build for development:

```sh
$ npm run watch
```

To build prefixed and minified CSS for release:

```sh
$ npm run sass-build
```

To compile scripts that run in the Block Editor:

```sh
$ npm run wp-scripts
```

## Expected Icons in `assets/images/svg`

- `logo.svg` for logo
- Right-pointing `arrow.svg` for dropdown menu item indicator
- `search.svg` for search button icon
- Right-pointing `chevron.svg` for paging links
- `close.svg` for menu toggle button
- `menu.svg` for menu toggle button

## Notable Changes from _s Theme

- Lots of block-first development things including:
  - `theme.json`
  - Maps SASS variables to `theme.json` custom properties so `theme.json` is the "source of truth" (Notable downside of this technique: cannot perform SASS calculations on custom properties.)
  - Block-specific SCSS partials
  - Stylesheets for less-used blocks are enqueued per-block
  - Uses Block Template Parts instead of widgets for the footer,  sidebar, and 404 page
  - PHP used to set a few default block variations
  - Example of custom block style ready to go in `/inc/block-editor-config.php`
  - Uses template parts instead of most template tags
- Uses [`clicky-menus` script](https://github.com/mrwweb/clicky-menus) for [click-triggered dropdown navigation submenus](https://css-tricks.com/in-praise-of-the-unambiguous-click-menu/)
- Includes a toggle script (`assets/js/toggle.js`) to quickly build accessible toggles
- Custom toggle script for mobile menu and any other toggles you need
- Fixes search forms not having unique IDs if more than one is on the page
- Custom template tag to get SVGs (props @aurooba [Inline SVG Helper function](https://aurooba.com/inline-svgs-in-your-wordpress-code-with-this-helper-function/))
- Expects usage of [MRW Simplified Editor](https://wordpress.org/plugins/mrw-web-design-simple-tinymce), [The Events Calendar](https://wordpress.org/plugins/the-events-calendar/), [Gravity Forms (affiliate link)](https://gravityforms.pxf.io/NkoRO1), and [PublishPress Authors](https://wordpress.org/plugins/publishpress-authors/)
  - Recommended: Use [The Events Calendar Reset](https://github.com/mrwweb/the-events-calendar-reset/) for better theme style inheritance

## Dev Environment

Autoformatting/linting:

- `.editorconfig`
- `.stylelintrc.json`
- `.eslintrc`
- `.phpcs.xml.dist`
- `prettier` configured in `package.json`

Make sure your editor supports `.editorconfig` for some very basic coding standards autoformatting.

## Other Notes

See `/wp-content/mu-plugins/` non-theme related site changes. (not included in the Github repository)

## Credit & Contact

Mark Root-Wiley, MRW Web Design
<https://MRWweb.com/contact>
