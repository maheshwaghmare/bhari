=== CHANGELOG ===

= 1.0.4.9 =
* Remove : Removed social shares for single post which is plugin territory.

= 1.0.4.8 =
* New : Added `add_theme_support( 'custom-logo' )` for custom site logo.

= 1.0.4.7 =
* New : Added social shares for single post. To disable add filter `add_filter( 'bhari_social_shares', '__return_false' );` in child theme.

= 1.0.4.6 =
* Enhancement : Updated site content line height from 2 with 1.8 which is nice for reading contents.
* Enhancement : Decreased mobile menu line height from 4 with 3.
* Enhancement : Updated &lt;code&gt; tag background color as per the body background color.
* Enhancement : Added mobile toggle submenu support.
* Enhancement : Highlighted outline for the pagination & meta tag links for better accessibility.
* Fixed       : Next and previous link icon position issue.
* Fixed       : Added padding for password protected post button.
* Fixed       : All HTML & HTML5 input fields spacing spacing issues.

= 1.0.4.5 =
* Enhancement : Focus for inputs: E.g. https://qsnapnet.com/snaps/1djrdsqywuerk9
* Enhancement : Focus for buttons: E.g. https://qsnapnet.com/snaps/pscegszcmamgf1o
* Updated 	  : Updated: Skip to content JS: https://github.com/Automattic/_s/blob/master/js/skip-link-focus-fix.js
* Enhancement : Added missing screen-reader-text for edit post link.
* Enhancement : Updated contrasts colors for next & previous links.
* Enhancement : Updated CSS transitions from ease-in-out with ease.
* Enhancement : Updated contrasts colors for next & previous links.
* Enhancement : Updated contrasts colors for logout link & cancel reply button.
* Enhancement : Updated screen-reader-text CSS @see https://qsnapnet.com/snaps/bsonh00nsysnhfr
* Added       : POT file for localization.
* Added       : Translation strings missing contexts.
* Fixed       : Site Title wrong selector from customizer.

= 1.0.4.4 =
* This is similar to the version 1.0.4.3. Updated due to version upload fail on wp.org

= 1.0.4.3 =
* Enhancement: CSS Tweak for comment reply title.
* Enhancement: :focus state on keyboard navigation for .nav-links .next & .nav-links .prev.
* Enhancement: Updated color #555 for links in .entry-footer & .entry-meta to meet the color contrast requirements.
* Enhancement: attribute aria-hidden="true" for font awesome icons.

= 1.0.4.2 =
* Added: 'accessibility-ready' tag.

= 1.0.4.1 =
* Removed: 'accessibility-ready' tag.
* Added: Font Awesome double license.

= 1.0.4 =
* Could not able to upload the package so updated the version no.

= 1.0.3.4 =
* Fixed: Escaping the CSS from bhari_dynamic_css().
* Added: Font Awesome double license.
* Fixed: Found usage of constant HEADER_TEXTCOLOR. Use add_theme_support()

= 1.0.3.3 =
* Added: Proper Copyright/License Attribution for Themes.
* Fixed: On a small screen, the default menu is not indented (submenus).
* Fixed: Folder named "vender" is misspelled. Should be "vendor".
* Fixed: My static home Page does not show its featured image issue.
* Removed: Tag 'sticky-post'. We'll add this in future release once we decide the sticky post design.
* Removed: String 'Maybe try one of the links below.' from 404 page.

= 1.0.3.2 =
* Added: focus styling for <a> tag.
* Tweak: Comments & Pingback spacing.
* Tweak: Design changes for single post tags.

= 1.0.3.1 =
* Removed: Before & After hooks from jetpack infinite posts loop.
* Tweak: Added credit note for jQuery UI CSS.
* Removed: Function bhari_strings() and its instances.
* Enhancement: Design & font size tweaks.
* Enhancement: Updated theme hook prefixes.

= 1.0.3 =
* Tweak: Missing tag 'accessibility-ready'.
* Enhancement: Added directory 'compatibility' for 3rd party plugins support.
* Enhancement: Theme Hook Alliance.
* Tweak: Added spacing for read more link from archive page.
* Fixed: parent menu arrow issue from pages menu.
* Removed: vl developer debugging function.

= 1.0.2 =
* Fixed: Vendor file asset URLs issue.
* Removed: wpcom.php file which was not used yet. If required then we'll add this in future.
* Updated: editor-style CSS file location.

= 1.0.1 =
* Tweak: Moved font awesome assets in /assets/vendor/ directory.
* Tweak: Added missing Font awesome credit note.
* Tweak: Fixed font awesome font location issue.
* Added: RTL support for bhari.min.css
* Fixed: CSS & JS enqueue logic as per new asset location.
* Enhancement: Improved the folder structure for minified files.
* Added: VL function for testing.
* Fixed: PHPCS errors & Warnings with WordPress coding stranded.
* Added: bhari_asset_url() function to load assets minified / unminified depends RTL & SCRIPT_DEBUG.
* Fixed: Escaping issue.  …
* Tweak: Avoided SCSS from package.
