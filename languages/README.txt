translating the plugin:

- create a po file for your language, for example shshortc-de_DE.po
- copy all text from provided plugin pot file into your po file
- edit the po file with poedit http://www.poedit.net/
- create the mo file
- name your translation files with sh shortcodes text domain e.g. shshortc-de_DE.po and shshortc-de_DE.mo and save in languages directory.
- edit wp-config.php file in your installation and set WPLANG so it matches your languages: define('WPLANG', 'de_DE');

Plugin should now display all messages in your language.

-- BACKUP YOUR LANGUAGE PO/MO FILES  --

On a plugin update, language files are *NOT* preserved.
You will need to manually restore your po/mo files right after the update.
*** Also, send us a copy of your translation files and we'll add them into future updates! ***
