<?php

/*
 * This file is part of the bk2k/packagebuilder.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Deployer;

require 'recipe/common.php';

// Configuration
set('application', 'loottracker');
set('repository', 'git@github.com:Lefaux/loottracker.git');
set('ssh_type', 'native');
set('keep_releases', '3');
set('allow_anonymous_stats', false);

// Shared files/dirs between deploys
add('shared_files', ['.env', 'var/guildbank.sqlite']);
add('shared_dirs', []);

// Writable dirs by web server
set('allow_anonymous_stats', false);

// Hosts
host('p523984.webspaceconfig.de')
    ->user('p523984')
    ->port('22')
    ->addSshOption('StrictHostKeyChecking', 'no')
    ->set('bin/php', 'php')
    ->set('bin/composer', 'composer')
    ->set('deploy_path', '~/html/application/{{application}}');

// Tasks
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
])->desc('Deploy your project');
after('deploy', 'success');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');