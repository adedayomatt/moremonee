@servers(['live' => ['root@app.landshop.ng']])

@setup
$path = $path ?? '/var/www/pedpa';
$server = $server ?? 'live';
@endsetup

@task('queues:restart', ['on' => $server])
cd {{ $path }}
php artisan queue:restart
@endtask

@task('cache:all', ['on' => $server])
cd {{ $path }}
php artisan config:cache
php artisan route:cache
php artisan view:cache
@endtask

@task('cache:clear', ['on' => $server])
cd {{ $path }}

@if(!$module || $module === 'config')
    php artisan config:clear
@elseif(!$module || $module === 'route')
    php artisan config:clear
@elseif(!$module || $module === 'view')
    php artisan config:clear
@else
    php artisan config:clear
    php artisan route:clear
    php artisan view:clear
@endif
@endtask

@task('dependencies:composer', ['on' => $server])
cd {{ $path }}
composer install
@endtask

@task('dependencies:npm', ['on' => $server])
cd {{ $path }}
npm install
@endtask

@task('dependencies:yarn', ['on' => $server])
cd {{ $path }}
yarn install
@endtask

@task('npm:prod', ['on' => $server])
cd {{ $path }}
npm run production
@endtask

@task('npm:build', ['on' => $server])
cd {{ $path }}
npm run build
@endtask

@task('migrate', ['on' => $server])
cd {{ $path }}
php artisan migrate --force
@endtask

@task('migrate:fresh', ['on' => $server])
cd {{ $path }}
php artisan migrate:fresh --force
@endtask

@task('git:pull', ['on' => $server])
cd {{ $path }}
git pull origin {{ $branch ?? '' }}
@endtask

@story('laravel')
git:pull
dependencies:composer
migrate
cache:all
dependencies:npm
npm:prod
@endstory
