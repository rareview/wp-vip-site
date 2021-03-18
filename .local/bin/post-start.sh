#!/usr/bin/env bash

set -e

# If WordPress is not installed, run the installation.
if ! $(wp core is-installed); then
	wp core install --url=wp-vip.lndo.site --title=WPVIP --admin_user=lando --admin_password=password --admin_email=lando@wp-vip.lndo.site --skip-email
fi

# Ensure VIP Go must use plugins are installed.
if [ ! -d "$LANDO_MOUNT/client-mu-plugins/vendor/automattic/vip-go-mu-plugins/" ]; then
	composer install --no-scripts --no-progress --optimize-autoloader
fi

# Setup Caching.
if [ ! -d "$WP_CONTENT/object-cache/" ]; then
	cp -r $LANDO_MOUNT/client-mu-plugins/vendor/automattic/vip-go-mu-plugins/drop-ins/object-cache/ $WP_CONTENT/object-cache
	cp $LANDO_MOUNT/client-mu-plugins/vendor/automattic/vip-go-mu-plugins/drop-ins/object-cache.php $WP_CONTENT/object-cache.php
fi
