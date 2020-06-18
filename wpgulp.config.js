/**
 * WPGulp Configuration File
 *
 * 1. Edit the variables as per your project requirements.
 * 2. In paths you can add <<glob or array of globs>>.
 *
 * @package WPGulp
 */

module.exports = {

	// Project options.
	projectURL: 'wpstag.local/forest', // Local project URL of your already running WordPress site. Could be soforesting like wpgulp.local or localhost:3000 depending upon your local WordPress setup.
	productURL: './', // Theme/Plugin URL. Leave it like it is, since our gulpfile.js lives in the root folder.
	browserAutoOpen: false,
	injectChanges: true,
	packageJSON: './package.json',
	versionData: [
		{src: './package.json', dest: './', type: 'json'},
		{src: './composer.json', dest: './', type: 'json'},
	],

	// Style options.
	//SASS Files
	stylesheets: [
		{src: './assets/scss/style.scss', dest: './'},
	],
	sassSRC: './assets/scss/style.scss',
	sassDest: './assets/scss/', // Path to main .scss file.
	outputStyle: 'expanded', // Available options → 'compact' or 'compressed' or 'nested' or 'expanded'
	errLogToConsole: true,
	precision: 10,

	// JS Vendor options.
	jsVendorSRC: './assets/js/vendor/*.js', // Path to JS vendor folder.
	jsVendorDestination: './assets/js/', // Path to place the compiled JS vendors file.
	jsVendorFile: 'vendor', // Compiled JS vendors file name. Default set to vendors i.e. vendors.js.

	// JS Custom options.
	jsCustomSRC: './assets/js/custom/*.js', // Path to JS custom scripts folder.
	jsCustomDestination: './assets/js/', // Path to place the compiled JS custom scripts file.
	jsCustomFile: 'custom', // Compiled JS custom file name. Default set to custom i.e. custom.js.

	// Images options.
	imgSRC: './assets/img/raw/**/*', // Source folder of images which should be optimized and watched. You can also specify types e.g. raw/**.{png,jpg,gif} in the glob.
	imgDST: './assets/img/', // Destination folder of optimized images. Must be different from the imagesSRC folder.

	// Watch files paths.
	watchJsVendor: './assets/js/vendor/*.js', // Path to all vendor JS files.
	watchJsCustom: './assets/js/custom/*.js', // Path to all custom JS files.
	watchPhp: [ '**/*.php', '!build/**', '!languages/**', '!./framework/classes/class-tgm-plugin-activation.php', '!node_modules/**' ], // Path to all PHP files.

	// Translation options.
	textDomain: 'forest', // Your textdomain here.
	translationFile: 'forest.pot', // Name of the translation file.
	translationDestination: './languages', // Where to save the translation files.
	bugReport: 'https://github.com/codestag/forest/issues', // Where can users report bugs.
	lastTranslator: 'Krishna Kant <krishna@codestag.com>', // Last translator Email ID.
	team: 'Codestag <hello@codestag.com>', // Team's Email ID.

	// Google fonts options.
	fontsAPIKey: 'AIzaSyDkCdyJYJyc7AGqE-nkolyU0Ikx832b8gI',
	jsonMassagerSRC: './googlefonts.json',
	jsonFontsDST: './',

	// Browsers you care about for autoprefixing. Browserlist https://github.com/ai/browserslist
	// The following list is set as per WordPress requirements. Though, Feel free to change.
	BROWSERS_LIST: [
		'last 2 version',
		'> 1%',
		'ie >= 11',
		'last 1 Android versions',
		'last 1 ChromeAndroid versions',
		'last 2 Chrome versions',
		'last 2 Firefox versions',
		'last 2 Safari versions',
		'last 2 iOS versions',
		'last 2 Edge versions',
		'last 2 Opera versions'
	],
	export: {
		src: [
			'**/*',
			'!wpgulp.config.js',
			'!dev/**/*',
			'!node_modules',
			'!node_modules/**/*',
			'!vendor',
			'!vendor/**/*',
			'!dist',
			'!dist/**/*',
			'!.*',
			'!composer.*',
			'!googlefonts.json',
			'!google-fonts-array.php',
			'!csscomb.*',
			'!config.*',
			'!Gruntfile.*',
			'!gulpfile.*',
			'!package*.*',
			'!phpcs.*',
			'!*.lock',
			'!*.zip'
		],
		dest: './build/'
	}
};
