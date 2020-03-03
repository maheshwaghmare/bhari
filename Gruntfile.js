module.exports = function (grunt) {
    'use strict';

    /**
     * Project configuration
     */
    const autoprefixer = require('autoprefixer');
    const sass = require('node-sass');
    const flexibility = require('postcss-flexibility');

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
                map: false
            },
            dist: {
                files: [

                    /**
                     * style-rtl.css
                     * editor-style-rtl.css
                     */
                    {
                        expand: true,
                        cwd: '',
                        src: [
                            'style.css',
                            'assets/css/editor-style.css',
                        ],
                        dest: '', 
                        ext: '-rtl.css'
                    },

                    /**
                     * style.min-rtl.css
                     */
                    {
                        expand: true,
                        cwd: 'assets/css/min',
                        src: [
                            'style.min.css',
                            '!editor-style.min.css',
                        ],
                        dest: 'assets/css/min/rtl', 
                        ext: '.min-rtl.css'
                    },
                ]
            }
        },

        /**
         * Generate CSS from SCSS
         */
        sass: {
            options: {
                implementation: sass,
                sourcemap: 'none',
                outputStyle: 'expanded',
                linefeed: 'lf',
            },
            dist: {
                files: [

                    /**
                     * style.css
                     */
                    {
                        'style.css': 'assets/sass/style.scss'
                    },

                    /**
                     * editor-style.css
                     */
                    {
                        'assets/css/editor-style.css': 'assets/sass/editor-style.scss'
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
                    'style.css',
                    'assets/css/editor-style.css',
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
                { // style.min.js from /assets/js/min/**.js
                    src: [
                        'assets/js/*.js',
                    ],
                    dest: 'assets/js/min/style.min.js',
                },

                /**
                 * BACKEND
                 */
                { // ALL *.min.js
                    expand: true,
                    src: [
                        '*.js'
                    ],
                    dest: 'inc/assets/js/min',
                    cwd: 'inc/assets/js',
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
                        '*.css',

                        //  Avoid 'editor-style'
                        '!editor-style.css',
                        '!editor-style-rtl.css',
                    ],
                    dest: 'assets/css/min',
                    cwd: 'assets/css',
                    ext: '.min.css'
                },
                {  //  style.min.css
                    src: 'style.css',
                    dest: 'assets/css/min/style.min.css'
                },

                /**
                 * BACKEND
                 */
                { //  ALL *.min.css
                    expand: true,
                    src: [
                        '*.css'
                    ],
                    dest: 'inc/assets/css/min',
                    cwd: 'inc/assets/css',
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
                    '!README.md',
                    '!CONTRIBUTING.md',
                    '!codesniffer.ruleset.xml',
                    '!phpcs.ruleset.xml',

                    /**
                     * Are you developer? Then add below files.
                     */
                    '!Gruntfile.js',
                    '!package.json',
                    '!assets/sass/**',
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