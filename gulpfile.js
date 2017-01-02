var gulp = require('gulp'),
    path = require('path'),
    concat = require('gulp-concat'),
    recursiveFolder = require('gulp-recursive-folder'),

    options = {
        pathToFolder: 'webroot/assets_dev/js',
        readFolder: 'webroot/assets_dev/js',
        target: 'webroot/js'
    };

var uglify = require('gulp-uglify');


gulp.task('generateConcatOfFolders', function(){
    return recursiveFolder({
        base: options.pathToFolder,
        exclude: [] // optional array of folders to exclude 
    }, function(folderFound){
        return gulp.src(folderFound.path + "/*.js")
            .pipe(concat(folderFound.name + ".js"));
    })()
        .pipe(concat("bundle.js"))
        .pipe(uglify())
        .pipe(gulp.dest(options.target));
});

gulp.task('bundleCss', function() {
  return gulp.src([
      'webroot/assets_dev/css/style.css'
    ])
    .pipe(concat('bundle.css'))
    .pipe(gulp.dest('webroot/css'));
});

// Default Task
gulp.task('default', ['generateConcatOfFolders', 'bundleCss']);