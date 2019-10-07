<?php

/*
 * This file is part of the bk2k/packagebuilder.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Deployer;

require 'recipe/common.php';
require 'recipe/rsync.php';

// Configuration
set('application', 'loottracker');
set('repository', 'git@github.com:Lefaux/loottracker.git');
set('ssh_type', 'native');
set('keep_releases', '3');
set('allow_anonymous_stats', false);
set('default_timeout', 360);

// Shared files/dirs between deploys
add('shared_files', ['.env.local']);
add('shared_dirs', []);

// Writable dirs by web server
set('allow_anonymous_stats', false);

set('rsync',[
    'timeout' => 3600,
    'exclude'      => [
        '.git',
        'deploy.php',
        '.ddev',
        'node_modules',
        '.npmrc',
        '.idea'
    ],
    'exclude-file' => false,
    'include'      => [],
    'include-file' => false,
    'filter'       => [],
    'filter-file'  => false,
    'filter-perdir'=> false,
    'flags'        => 'rz', // Recursive, with compress
    'options'      => ['delete']
]);
set('rsync_src', __DIR__);
set('rsync_dest','{{release_path}}');
// Hosts
host('p523984.webspaceconfig.de')
    ->user('p523984')
    ->port('22')
    ->addSshOption('StrictHostKeyChecking', 'no')
    ->set('bin/php', 'php')
    ->set('bin/composer', 'composer')
    ->set('deploy_path', '~/html/application/{{application}}');
host('p523984.webspaceconfig.de')
    ->user('p523984')
    ->port('22')
    ->addSshOption('StrictHostKeyChecking', 'no')
    ->set('bin/php', 'php')
    ->set('bin/composer', 'composer')
    ->set('deploy_path', '~/html/application/askeria-tracker');


task('yarn', function () {
    run('composer install');
    run('yarn install');
    run('yarn build');
})->local();

//task('upload', function () {
//    upload(__DIR__ . '/', '{{release_path}}');
//});

// Tasks
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'rsync',
    'deploy:shared',
    'deploy:vendors',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
])->desc('Deploy your project');
after('deploy', 'success');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');