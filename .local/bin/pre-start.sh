#!/usr/bin/env bash

set -e

if [ ! -d ".local/site/wp-admin" ]; then
	wp core download
fi

if [ -d "$WP_CONTENT" ]; then
	rm -rf $WP_CONTENT
fi

mkdir -p $WP_CONTENT

ln -sf $LANDO_MOUNT/client-mu-plugins/ $WP_CONTENT/client-mu-plugins
ln -sf $LANDO_MOUNT/plugins/ $WP_CONTENT/plugins
ln -sf $LANDO_MOUNT/themes/ $WP_CONTENT/themes
ln -sf $LANDO_MOUNT/private/ $WP_CONTENT/private
