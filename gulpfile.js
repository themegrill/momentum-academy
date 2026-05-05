/**
 * Gulp workflow for Online Course FSE.
 *
 * Contains the gulp commands to run repetitive tasks.
 */
 var gulp = require("gulp"),
  rename = require("gulp-rename"),
  rtlcss = require("gulp-rtlcss"),
  zip = require("gulp-zip"),
  wpPot = require("gulp-wp-pot"),
  notify = require("gulp-notify");

var info = {
  name: "Momentum Academy",
  slug: "momentum-academy",
  url: "https://themegrill.com/themes/momentum-academy/",
  author: "ThemeGrill",
  authorUrl: "https://themegrill.com/",
  authorEmail: "example@example.com",
  teamEmail: "example@example.com",
  localUrl: "tg.io/kirana",
};

var paths = {
  rtlcss: {
    src: ["./style.css"],
    dest: "./",
  },

  php: {
    src: ["./*.php", "./inc/**/*.php"],
  },

  zip: {
    src: [
      "screenshot.png",
      "**",
       "!node_modules",
      "!node_modules/**",
       "!composer.json",
      "!composer.lock",
      "!package.json",
      "!package-lock.json",
      "!yarn.lock",
      "!gulpfile.js",
      "!webpack.config.js",
      "!babel.config.js",
      "!.babelrc",
      "!tsconfig.json",
       "!**/*.scss",
      "!**/*.sass",
      "!inc/admin/sass",
      "!inc/admin/sass/**",
      "!assets/sass",
      "!assets/sass/**",
      "!src",
      "!src/**",
       "!automate",
      "!automate/**",
      "!dist",
      "!dist/**",
      "!build",
      "!build/**",
       "!phpcs.xml",
      "!phpcs.xml.dist",
      "!phpunit.xml",
      "!phpunit.xml.dist",
      "!.phpcs.xml",
      "!.phpcs.xml.dist",
      "!psalm.xml",
      "!phpstan.neon",
      "!tests",
      "!tests/**",
      "!.eslintrc",
      "!.eslintrc.js",
      "!.eslintrc.json",
      "!.stylelintrc",
      "!.stylelintrc.json",
      "!.prettierrc",
      "!.prettierrc.js",
      "!.editorconfig",
       "!.git",
      "!.git/**",
      "!.gitignore",
      "!.gitattributes",
      "!.gitlab",
      "!.gitlab/**",
      "!.github",
      "!.github/**",
      "!.svn",
      "!.svn/**",
       "!.gitlab-ci.yml",
      "!.travis.yml",
      "!circle.yml",
      "!.circleci",
      "!.circleci/**",
       "!*.md",
      "!README.md",
      "!CHANGELOG.md",
      "!CONTRIBUTING.md",
      "!LICENSE.md",
      "!dest.xml",
       "!.vscode",
      "!.vscode/**",
      "!.idea",
      "!.idea/**",
      "!*.sublime-project",
      "!*.sublime-workspace",
       "!.DS_Store",
      "!Thumbs.db",
      "!desktop.ini",
       "!vendor/**/tests",
      "!vendor/**/Tests",
      "!vendor/**/test",
      "!vendor/**/Test",
      "!vendor/**/*.md",
      "!vendor/**/composer.json",
      "!vendor/**/composer.lock",
      "!vendor/**/.git",
      "!vendor/**/.gitignore",
      "!vendor/**/phpunit.xml",
      "!vendor/**/phpcs.xml",
      "!vendor/**/.travis.yml",
      "!vendor/**/README",
      "!vendor/**/CHANGELOG",
      "!vendor/**/LICENSE",
      "!vendor/**/CONTRIBUTING",
    ],
    dest: "./dist",
  },
};

var build = gulp.series(generateRTLCSS, generatePotFile, compressZip);

function compressZip() {
  return gulp
    .src(paths.zip.src, { encoding: false })
    .pipe(
      rename(function (path) {
        path.dirname = info.slug + "/" + path.dirname;
      })
    )
    .pipe(zip(info.slug + ".zip"))
    .pipe(gulp.dest(paths.zip.dest))
    .on("error", notify.onError())
    .pipe(
      notify({
        message: "Great! Package is ready",
        title: "Build successful",
      })
    );
}

function generateRTLCSS() {
  return gulp
    .src(paths.rtlcss.src)
    .pipe(rtlcss())
    .pipe(rename({ suffix: "-rtl" }))
    .pipe(gulp.dest(paths.rtlcss.dest))
    .on("error", notify.onError());
}

function generatePotFile() {
  return gulp
    .src(paths.php.src)
    .pipe(
      wpPot({
        domain: info.slug,
        package: info.name,
      })
    )
    .pipe(gulp.dest("languages/" + info.slug + ".pot"))
    .on("error", notify.onError());
}

exports.generateRTLCSS = generateRTLCSS;
exports.generatePotFile = generatePotFile;
exports.build = build;