/* Importa componentes y define variables */
var gulp = require('gulp');
var $    = require('gulp-load-plugins')();
var browserSync = require( 'browser-sync' ),    /* Importa y define 'browser-sync' */
    reload      = browserSync .reload;

/* Variable que define rutas de componentes de 'bower'
 * que serán usadas por la tarea 'sass' */
var sassPaths = [
  'bower_components/normalize.scss/sass',
  'bower_components/foundation-sites/scss',
  'bower_components/motion-ui/src'
];
/* Define tarea de nombre 'sass' */
gulp.task('sass', function() {
  return gulp.src('scss/app.scss')
    .pipe($.sass({
      includePaths: sassPaths,
      outputStyle: 'compressed' // if css compressed **file size**
    })
      .on('error', $.sass.logError))
    .pipe($.autoprefixer({
      browsers: ['last 2 versions', 'ie >= 9']
    }))
    .pipe(gulp.dest('css'));
});

/* Define tarea de nombre 'browser-sync' */
gulp .task( 'browser-sync', function() {
    /* Define Array de rutas y archivos (escuchar cambios) */
    var files = [
        './style.css',
        './*.php',
        './template-parts/*.php',
        './inc/*.php',
        './js/*.js',
        'css/app.css'
    ];
    /* Inicializa Browser Sync */
    browserSync .init(
        files,  /* Listado de archivos a los que se les va a hacer seguimiento */
        {
            proxy: 'http://localhost/projects/gourmet-artist.wp/public_html/',   /* URL: Proyecto */
            notify: false
        }
    );
});

/* Define tarea que arrancará por defecto 'gulp' */
gulp.task(
    'default',                          /* Nombre de la tarea */
    [ 'sass', 'browser-sync' ],         /* Array con las tareas que se ejecutarán */
    function() {
        gulp.watch( ['scss/**/*.scss'], ['sass'] );
    }
);
