module.exports = function(grunt) {
  grunt.initConfig({
    //pkg: grunt.file.readJSON('package.json'),
    jshint: {
      options: {
        jshintrc: '.jshintrc'
      },
      all: [
        'Gruntfile.js',
        './js/uncompiled/*.js',
        './js/uncompiled/plugins/*.js',
      ]
    },
    sass: {
      options: {
        includePaths: ['bower_components/foundation/scss']
      },
      dist: {
        options: {
          outputStyle: 'compressed'
        },
        files: {
          'css/app.css': 'scss/app.scss'
        }        
      }
    },
    uglify: {
      dist: {
        options: {
          sourceMap: false,
          sourceMapIncludeSources: false,
          sourceMapName: 'js/app.sourceMap.map'
        },
        files: {
          // COMPONENTS
          'js/components.min.js': [
            // 'bower_components/modernizr/modernizr.js',
            'bower_components/jquery-placeholder/jquery.placeholder.js',
            'bower_components/jquery.cookie/jquery.cookie.js',
            'bower_components/respond/src/respond.js',
            //'bower_components/selectivizr/selectivizr.js',
            'bower_components/foundation/js/foundation.js',
            'bower_components/FitText/jquery.fittext.js',
            //'bower_components/jquery-hashchange/jquery.ba-hashchange.js',
            'bower_components/source-web-files/js/custom/detect.browser.js',
            'bower_components/source-web-files/js/custom/make.square.js',
            'bower_components/source-web-files/js/custom/make.windowHeight.js',
            'bower_components/source-web-files/js/custom/smart.resize.js',
            'bower_components/underscore/underscore.js'
          ],
          'js/jquery.min.js': [
            'bower_components/jquery/dist/jquery.js'
          ],
          // MAIN SCRIPTS...
          'js/app.min.js': [
            //'js/plugins/*.js',
            'js/uncompiled/doors.load.object.js',
            'js/uncompiled/app.js',
          ],
          'js/pace.min.js': [
            //'js/uncompiled/pace.config.js',
            'bower_components/pace/pace.js',
            // error pace is not defined, comment out below
          ],
        }
      }
    },
    phpunit: {
      //...
      options: {}
    },
    watch: {
      sass: {
        options: {
          livereload: true
        },
        files: 'scss/**/*.scss',
        tasks: ['sass']
      },
      js: {
        options: {
          livereload: true
        },
        files: '<%= jshint.all %>',
        tasks: ['uglify'],
      },
    }
  });
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-sass');
  

  // Register tasks
  grunt.registerTask('default', [
    'sass',
    'uglify',
  ]);
  grunt.registerTask('dev', [
    'watch'
  ]);
}