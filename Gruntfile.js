module.exports = function(grunt) {

  var pkg = grunt.file.readJSON('package.json');

  grunt.initConfig({
    cssmin: {
      compress: {
        files: {
          'app/webroot/css/min.css': ['app/webroot/css/app.css', 'app/webroot/css/test.css']
        }
      }
    },
    rsync: {
      nodefault:{},
      dryrun: {
        src: "./",
        dest: "/var/www/html",
        host: "ec2-54-249-212-16.ap-northeast-1.compute.amazonaws.com",
        recursive: true,
        compareMode: "checksum",
        syncDestIgnoreExcl: true,
        dryRun: true,
        exclude:[ "app/tmp/", "node_modules/", ".git/", ".DS_Store" ]
      },
      deploy: {
        src: "./",
        dest: "/var/www/html",
        host: "ec2-54-249-212-16.ap-northeast-1.compute.amazonaws.com",
        recursive: true,
        compareMode: "checksum",
        syncDestIgnoreExcl: true,
        exclude:[ "app/tmp/", "node_modules/", ".git/", ".DS_Store" ]
      }
    },
    sshexec: {
      test: {
        command: 'date > ./date.txt',
        options: {
          host: 'ec2-54-249-212-16.ap-northeast-1.compute.amazonaws.com',
          username: 'ec2-user',
          password: '',
          privateKey: grunt.file.read("/Users/anaisatoshi/AWS/matilda/matilda-pk.pem")
        }
      }
    },
    sftp: {
      test: {
        host: 'ec2-54-249-212-16.ap-northeast-1.compute.amazonaws.com',
        username: 'ec2-user',
        password: '',
        privateKey: grunt.file.read("/Users/anaisatoshi/AWS/matilda/matilda-pk.pem"),
        path: "/home/ec2-user/TWTodo",
        srcBasePath: 'TWTodo/',
        files: {
          "./app": "./app/*", "./lib": "./lib/*", "./": "./index.php"
        }
      }
    },
    watch: {
      main: {
        files: [
          '**/*.php',
          '**/*.ctp'
        ],
        tasks: 'deploy'
      }
    }
  });


  var taskName;
  for(taskName in pkg.devDependencies) {
    if(taskName.substring(0, 6) == 'grunt-') {
      grunt.loadNpmTasks(taskName);
    }
  }

  // grunt.registerTask('deploy', ['sftp']);
};
