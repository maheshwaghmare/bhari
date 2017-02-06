module.exports = function (grunt) {
    'use strict';

    /**
     * Project configuration
     */
    var autoprefixer = require('autoprefixer');
    var flexibility = require('postcss-flexibility');

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        /**
         * Generate RTL from CSS
         */
        rtlcss: {
            options: {
                config: {
                    preserveComments: true,
                    greedy: true
                },
                map: false  // generate source maps
            },
            dist: {
                files: [

                    /**
                     * style.css => style-rtl.css
                     */
                    {
                        expand: true,
                        cwd: '',
                        src: [
                            'style.css',
                        ],
                        dest: '', 
                        ext: '-rtl.css'
                    },

                    /**
                     * All /unminified/ ** /.css
                     */
                    {
                        expand: true,
                        cwd: 'assets/unminified/css/',
                        src: [
                            '*.css',
                            '!*-rtl.css',

                            //  avoid
                            '!font-awesome.css',
                        ],
                        dest: 'assets/unminified/css/rtl', 
                        ext: '-rtl.css'
                    },

                ]
            }
        },

        /**
         * Generate CSS from SCSS
         */
        sass: {
            options: {
                sourcemap: 'none',
                outputStyle: 'expanded'
            },
            dist: {
                files: [

                    /**
                     * style.css => assets/unminified/sass/style.scss
                     */
                    {
                        'style.css': 'assets/unminified/sass/style.scss'
                    },

                    /**
                     * assets/unminified/css/editor-style.css => assets/unminified/sass/editor-style.scss
                     */
                    {
                        'assets/unminified/css/editor-style.css': 'assets/unminified/sass/editor-style.scss'
                    },
                ]
            }
        },

        /**
         * Vendar prefixes
         */
        postcss: {
            options: {
                map: false,
                processors: [
                    flexibility,
                    autoprefixer({
                        browsers: [
                            'Android >= 2.1',
                            'Chrome >= 21',
                            'Edge >= 12',
                            'Explorer >= 7',
                            'Firefox >= 17',
                            'Opera >= 12.1',
                            'Safari >= 6.0'
                        ],
                        cascade: false
                    })
                ]
            },
            style: {
                expand: true,
                src: [
                    'style.css'
                ]
            }
        },

        /**
         * JS Minify
         */
        uglify: {
            js: {
                files: [

                /**
                 * FRONTEND
                 */
                { // ALL *.min.js
                    expand: true,
                    src: [
                        '*.js'
                    ],
                    dest: 'assets/minified/js',
                    cwd: 'assets/unminified/js',
                    ext: '.min.js'
                },
                { // bhari.min.js
                    src: [
                        'assets/minified/js/navigation.min.js',
                        'assets/minified/js/skip-link-focus-fix.min.js',
                    ],
                    dest: 'assets/minified/js/bhari.min.js',
                },

                /**
                 * BACKEND
                 */
                { // ALL *.min.js
                    expand: true,
                    src: [
                        '*.js'
                    ],
                    dest: 'inc/assets/minified/js',
                    cwd: 'inc/assets/unminified/js',
                    ext: '.min.js'
                } ]
            }
        },

        /**
         * CSS Minify
         */
        cssmin: {
            options: {
                keepSpecialComments: 0
            },
            css: {
                files: [

                /**
                 * FRONTEND
                 */
                { //  ALL *.min.css
                    expand: true,
                    src: [
                        '**/*.css'
                    ],
                    dest: 'assets/minified/css',
                    cwd: 'assets/unminified/css',
                    ext: '.min.css'
                },
                {  //  bhari.min.css
                    src: [
                        'style.css'
                    ],
                    dest: 'assets/minified/css/bhari.min.css'
                },

                /**
                 * BACKEND
                 */
                { //  ALL *.min.css
                    expand: true,
                    src: [
                        '*.css'
                    ],
                    dest: 'inc/assets/minified/css',
                    cwd: 'inc/assets/unminified/css',
                    ext: '.min.css'
                }]
            }
        },

        /**
         * Copy files
         */
        copy: {
            main: {
                options: {
                    mode: true
                },
                src: [
                    '**',
                    '!style - Copy.css',
                    '!node_modules/**',
                    '!build/**',
                    '!css/sourcemap/**',
                    '!.git/**',
                    '!bin/**',
                    '!.gitlab-ci.yml',
                    '!bin/**',
                    '!tests/**',
                    '!phpunit.xml.dist',
                    '!*.sh',
                    '!*.map',
                    '!.gitignore',
                    '!phpunit.xml',
                    '!CONTRIBUTING.md',
                    '!codesniffer.ruleset.xml',

                    /**
                     * Disable for master
                     */
                    '!Gruntfile.js',
                    '!package.json',
                ],
                dest: 'bhari/'
            }
        },

        /**
         * Compress files
         */
        compress: {
            main: {
                options: {
                    archive: 'bhari.zip',
                    mode: 'zip'
                },
                files: [
                    {
                        src: [
                            './bhari/**'
                        ]

                    }
                ]
            }
        },

        /**
         * Clean files
         */
        clean: {
            main: ["bhari"],
            zip: ["bhari.zip"]

        },

        /**
         * Generate POT
         */
        makepot: {
            target: {
                options: {
                    domainPath: '/',
                    potFilename: 'languages/bhari.pot',
                    potHeaders: {
                        poedit: true,
                        'x-poedit-keywordslist': true
                    },
                    type: 'wp-theme',
                    updateTimestamp: true
                }
            }
        },
        
        /**
         * Add textdomain
         */
        addtextdomain: {
            options: {
                textdomain: 'bhari',
            },
            target: {
                files: {
                    src: [
                        '*.php',
                        '**/*.php',
                        '!node_modules/**',
                        '!php-tests/**',
                        '!bin/**',
                    ]
                }
            }
        }
    });

    /**
     * Load Grunt Tasks
     */
    grunt.loadNpmTasks('grunt-rtlcss');
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-wp-i18n');

    //  Generate RTL
    grunt.registerTask('rtl', ['rtlcss']);

    //  Compile SCSS
    grunt.registerTask('scss', ['sass']);

    // Compile & Generate CSS & RTL from SCSS
    grunt.registerTask('style', ['scss', 'postcss:style', 'rtl']);

    // Minify JS & CSS
    grunt.registerTask('minify', ['style', 'uglify:js', 'cssmin:css']);

    // Generate Release package
    grunt.registerTask('release', ['clean:zip', 'copy', 'compress', 'clean:main']);

    // i18n
    grunt.registerTask('i18n', ['addtextdomain', 'makepot']);

    grunt.util.linefeed = '\n';
};