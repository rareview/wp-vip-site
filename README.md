[![We're Hiring Banner](https://rareview.com/wp-content/uploads/2021/07/repo-banner.jpg)](https://rareview.com/careers/)

# WordPress VIP Site Template

[1]: https://rareview.com
[2]: https://wpvip.com
[3]: https://getcomposer.org
[4]: https://nodejs.org
[5]: https://npmjs.com
[6]: https://github.com/features/actions
[8]: https://lando.dev
[9]: https://www.docker.com/products/docker-desktop
[10]: https://docs.wpvip.com/technical-references/vip-cli/
[11]: https://docs.wpvip.com/how-tos/local-development/use-the-vip-local-development-environment/

A starter template, built and maintained by [Rareview][1], to jumpstart development for the [WP VIP Platform][2]. 
This template brings together some of the most modern forms for engineering and continuous integration, leveraging tools like [Composer][3], [Node][4] + [NPM][5], and [Github Actions][6].

## Prerequisites

- PHP 7.4 or higher
- [VIP CLI][10] Latest version recommended
- [Docker Desktop][9] Latest version recommended
- [Composer][3] Latest version recommended
- [Node][4] Latest version recommended
- [NPM][5] Latest version recommended
- [Lando][8] Latest version recommended

## Local Development

This project local development is powered by the [VIP Local Development Environment][11].

_Note: All the commands described below should be executed from the root of the repo._

### Environment setup

The first step which should be done only once per repository is to initialize the environment using the following command:

```shell
npm run env:init # or for a multiste: npm run env:init -- -m 
```

This command will run the following steps:

- Run the `composer install` command to install PHP dependencies.
- Run the `npm install` command to install the Node dependencies.
- Run the VIP command to setup a local WordPress development environment.
- Create a symlink of the new VIP WordPress development environment setup folder to the `.local/site` folder local to the repo.

**Note**: Please ignore the message in the output of the command above mentioned the following:

```
To start it please run:

vip dev-env start --slug SLUG_OF_THE_SITE
```

As the next command to progress will be `npm run env:start`. See below for more details.

### Environment usage

Once you have initialized the environment wih the command above you can:

```shell
- npm run env:start # Start the environment.
- npm run env:stop # Stop the environment.
- npm run env:wp # Run a WP CLI command .
- npm run env:exec # Execute a command on the environment (any bash command).
- npm run env:info # Get some info about the environment.
- npm run env:db:import # Import a SQL file into the environment.
- npm run env:db:search-replace # Perform a search and replace on a SQL file.
```

**Note - The default WordPress credentials are:**

```shell
Username: vipgo
Passoword: password
```
#### importing a remote environment database.

To import a remote environment database, the usual workflow would be :
- Place the database sql dump into the ./local/db-dump directory, so it will be ignored from git.
- Run the DB search and replace command which will look like:
```shell
npm run env:db:search-replace -- ./.local/db_dumps/file.sql -s="REMOTE_ENV_DOMAIN_NAME,LOCAL_DEV_ENV_DOMAIN_NAME" -o="./.local/db_dumps/updated-file.sql"
```
- Run the DB import command which will look like:
```shell
npm run env:db:import ./.local/db_dumps/updated-file.sql
```

### Environment termination

If you want to destroy the environment and start from scratch again, run the following command:

```shell
npm run env:destroy
```

This command will run the following steps:

- Remove the `./client-mu-plugins/vendor/` Composer dependencies folder in .
- Remove the `node_modules` Node dependencies folder.
- Run the VIP command to destroy the local WordPress development environment.
- Remove the symlink of the VIP WordPress development environment setup folder to the `.local/site` folder local to the repo.

## VSCode Config

While development with a particular IDE is not required, this particular project does include configuration for VSCode, which consists of recommended extensions and default XDebug configuration for PHP.

## License

[MIT](https://en.wikipedia.org/wiki/MIT_License) &copy; [Rareview][1] 2021-present
