# {Site Name} Theme

A theme supporting the block editor based on _s (with lots of changes 😃).

## Build Process

This site uses a Gulp build process in order to support SASS with autoprefixer and logical properties syntax. Gulp also minifies and uglifies JS and provides Live Reload.

Edit CSS and JS files in `/src/`

See `package.json` and `gulpfile.js` for details.

To run build from `/wp-content/themes/{themename}/`

```sh
npm install
gulp
```

Integrated with the [LiveReload browser extension](https://github.com/twolfson/livereload-extensions)

## Expected Icons in images/svg

- `down-arrow.svg` for dropdown menu item indicator
- `search.svg` for search button icon

## Notable Changes from _s

- Lots of block-first development things including:
  - `theme.json`
  - Maps SASS variables to `theme.json` custom properties so `theme.json` is the "source of truth"
  - Block-specific SCSS partials
  - Stylesheets for less-used blocks are enqueued per-block
  - Uses Block Template Parts instead of widgets for the footer and sidebar
  - JavaScript used to set a few default block variations
  - Example of block style ready to go in `/inc/block-editor-config.php`
- Uses [`clicky-menus` script](https://github.com/mrwweb/clicky-menus) for [click-triggered dropdown navigation submenus](https://css-tricks.com/in-praise-of-the-unambiguous-click-menu/)
- Custom toggle script for mobile menu and any other toggles you need
- Fixes search forms not having unique IDs if more than one is on the page
- Custom template tag to get SVGs
- Expects usage of [The Events Calendar](https://wordpress.org/plugins/the-events-calendar/), [Gravity Forms (affiliate link)](https://gravityforms.pxf.io/NkoRO1), and [PublishPress Authors](https://wordpress.org/plugins/publishpress-authors/)
  - Uses [The Events Calendar Reset](https://github.com/mrwweb/the-events-calendar-reset/) for better theme style inheritance

## Dev Environment

Autoformatting/linting:

- `.editorconfig`
- `.stylelintrc.json`
- `.eslintrc`

Make sure your editor supports `.editorconfig` for some very basic coding standards autoformatting.

## Other Notes

See `/wp-content/mu-plugins/` non-theme related site changes. (not included in the Github repository)

## Contact

Mark Root-Wiley
<https://MRWweb.com/contact>
