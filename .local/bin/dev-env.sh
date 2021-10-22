#!/usr/bin/env bash

# Exit if any command fails.
set -e

print_style () {
    if [[ "$2" == "info" ]] ; then
        COLOR="96m"
    elif [[ "$2" == "success" ]] ; then
        COLOR="92m"
    elif [[ "$2" == "warning" ]] ; then
        COLOR="93m"
    elif [[ "$2" == "danger" ]] ; then
        COLOR="91m"
    else #default color
        COLOR="0m"
    fi

    START_COLOR="\e[$COLOR"
    END_COLOR="\e[0m"

    printf "$START_COLOR%b$END_COLOR" "$1"
}

usage() {
	echo "usage: $0 command"
	echo "  init [-m]                               Init the dev environment. The '-m' option is for setting up a multisite"
	echo "  destroy                                 Destroy the dev environment"
	echo "  start                                   Start the dev environment"
	echo "  stop                                    Stop the dev environment"
	echo "  exec                                    Execute an operation on a dev environment"
	echo "  info                                    Provides basic info about the dev environments"
	echo "  db-import <file.sql>                    Import a SQL file into the dev environment"
	echo '  db-search-replace <file.sql> [options]  Perform a search and replace on a SQL file. The required options are: -s="from,to" -o="<output.sql>"'
	echo "  -h | usage  Output this message"
	exit 1
}

REPO_DIR=$(basename "$(pwd)")
ENV_CONFIG_DIR="$(pwd)/.local/site"
VENDOR_DIR="$(pwd)/client-mu-plugins/vendor"

init_env() {
	MULTISITE='--multisite=false'
	if [[ "$1" ==  "-m" ]]; then
		MULTISITE='--multisite'
	fi;
	echo ${MULTISITE}
	print_style "Installing composer dependencies...\n" "success"
	composer install
	print_style "Installing npm dependencies...\n" "success"
	npm install
	print_style "Initializing the '${REPO_DIR}' VIP local environment...\n" "success"
	vip --slug="${REPO_DIR}" dev-env create --title="${REPO_DIR} Dev Env " --phpmyadmin --mu-plugins="./client-mu-plugins/vendor/automattic/vip-go-mu-plugins" --client-code="./" --wordpress="5.8" ${MULTISITE}
	ENV_DIR=$(vip --slug="${REPO_DIR}" dev-env info | awk '/LOCATION/ {print $2}')
	print_style "Creating a symlink from ${ENV_DIR} to ${ENV_CONFIG_DIR}\n" "success"
	ln -s ${ENV_DIR} ${ENV_CONFIG_DIR}
}

destroy_env() {
	print_style "Removing ${VENDOR_DIR}...\n" "success"
	rm -rf "${VENDOR_DIR}"
	print_style "Removing the node_modules folder...\n" "success"
	rm -rf node_modules
	ENV_DIR=$(vip --slug="${REPO_DIR}" dev-env info | awk '/LOCATION/ {print $2}')
	print_style "Destroying the '${REPO_DIR}' VIP local environment...\n" "success"
	vip --slug="${REPO_DIR}" dev-env destroy
	print_style "Removing the ${ENV_CONFIG_DIR} symlink...\n" "success"
	rm -rf "${ENV_CONFIG_DIR}"
	print_style "Removing ${ENV_DIR}...\n" "success"
	rm -rf "${ENV_DIR}"
}

start_env() {
	print_style "Starting the ${REPO_DIR} VIP local environment...\n" "success"
	vip --slug="${REPO_DIR}" dev-env start
	print_style "WordPress Credentials: Username: vipgo \t Password: password\n" "success"
}

stop_env() {
	print_style "Stopping the ${REPO_DIR} VIP local environment...\n" "success"
	vip --slug="${REPO_DIR}" dev-env stop
}

exec_env() {
	vip --slug="${REPO_DIR}" dev-env exec -- "${@:1}"
}

exec_wp_env() {
	vip --slug="${REPO_DIR}" dev-env exec -- wp "${@:1}"
}

info_env() {
	vip --slug="${REPO_DIR}" dev-env info
}

db_import_env() {
	vip --slug="${REPO_DIR}" dev-env import sql "${@:1}"
}

db_search_replace_env() {
	vip search-replace "${@:1}"
}

if [ "${1}" == "init" ]; then
	init_env "${@:2}"
elif [ "${1}" == "destroy" ]; then
	destroy_env
elif [ "${1}" == "start" ]; then
	start_env
elif [ "${1}" == "stop" ]; then
	stop_env
elif [ "${1}" == "exec" ]; then
	exec_env "${@:2}"
elif [ "${1}" == "wp" ]; then
	exec_wp_env "${@:2}"
elif [ "${1}" == "info" ]; then
	info_env
elif [ "${1}" == "db-import" ]; then
	db_import_env "${@:2}"
elif [ "${1}" == "db-search-replace" ]; then
	db_search_replace_env "${@:2}"
else
	usage
fi
