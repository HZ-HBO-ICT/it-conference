<p align="center">
 <a href="https://hz.nl">
        <img src="https://img.shields.io/badge/Made for-HZ University of Applied Sciences-blue.svg" alt="HZ University of Applied Sciences"/></a>
</p>
<p align="center">
    <a href="https://github.com/HZ-HBO-ICT/it-conference/graphs/contributors">
        <img src="https://img.shields.io/github/contributors/HZ-HBO-ICT/it-conference" alt="Contributors"/></a>
    <a href="https://github.com/HZ-HBO-ICT/it-conference/actions/workflows/main.yml">
        <img src="https://github.com/HZ-HBO-ICT/it-conference/actions/workflows/main.yml/badge.svg" alt="PHPCS"/></a>
    <a href="https://github.com/HZ-HBO-ICT/it-conference/actions/workflows/laravel.yml">
        <img src="https://github.com/HZ-HBO-ICT/it-conference/actions/workflows/build.yml/badge.svg" alt="Build"/></a>
    <a href="https://opensource.org/licenses/MIT">
        <img src="https://img.shields.io/badge/License-MIT-blue.svg" alt="MIT License"/></a>
</p>

# IT-Conference Website

This repository contains the source code for the official HBO-ICT IT-Conference.

## Environment Setup
### Prerequisites
Since the application uses Docker, the development environment must be in Linux for optimal performance and compatibility with Laravel Sail; either use native Linux or use [WSL](https://learn.microsoft.com/en-us/windows/wsl/filesystems). Installing a Linux distribution also will be needed - the most used one during the development process was Ubuntu, but it is still a personal preference. NPM/Node should also be present on the distro as of this version.

### Configuration and Installation
Since Laravel Sail takes on most of the configuration and installation of the project, the following steps need to be taken in order to install.

1. Clone the repository (https://github.com/HZ-HBO-ICT/it-conference.git) onto your local machine (on the WSL)
2. Open PHPStorm (or the editor of choice) in remote development in the WSL and find the folder
3. Run in the root folder of the project 
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```
4. Install the NPM packages - `npm install`
5. Set up the environment variables - `cp .env.example .env`
6. Add the app key - `./vendor/bin/sail artisan key:generate` 
7. After the dependencies are installed run `./vendor/bin/sail up -d`
8. After the creation of the containers run `./vendor/bin/sail artisan migrate`
9. Run `npm run dev`

### Possible complications 
- __Incorrectly set permissions__

This issue may be encountered after installing the application and trying to access it through the browser. It can be something along the lines of:
> The stream or file "/var/www/html/storage/logs/laravel.log" could not be opened in append mode: Failed to open stream: Permission denied

In order to fix this run `chmod -R 777 storage bootstrap/cache`. This issue might even occur when the artisan commands are used via sail. If that occurs, try granting only the permissions only to the specified directories.

- __Setting an alias__

Instead of using every time `./vendor/bin/sail` this can be shorten by using an alias - `alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'`. This way the commands will shorten (e.g. `sail up -d`)


## Running the tests

[GitHub Actions](https://github.com/HZ-HBO-ICT/it-conference/actions) will trigger a workflow when you push your code to
the repository, which will run the tests automatically.

On a local machine, you may run `./vendor/bin/sail phpunit`. If you get a large amount of errors, check whether the
application key has been set successfully, and that either `npm run build` or `npm run dev` have been run.

<!-- ### Break down into end-to-end tests -->

<!-- Explain what these tests test and why

```
Give an example
``` -->

<!-- ### And coding style tests

Explain what these tests test and why

```
Give an example
``` -->

## Deployment

When the decision has been made to deploy the application to a server, the instructions can be found here.

## Built With

* [Laravel](https://laravel.com/docs) - The web framework used
* [Composer](https://getcomposer.org/) - Dependency Management
<!-- * [ROME](https://rometools.github.io/rome/) - Used to generate RSS Feeds -->

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use the following format for versioning: YYYY.R.B

**YYYY** is the year of the release, so 2024.

**R** represents the release within a year, so if it is the first it would be 1, if it is the second it would be 2.

**B** represents bugfixes.

## Current Team

* **Tim Kardol** - *Conference Website Project lead* - [TimKardol](https://github.com/TimKardol)
* **Valeria Stamenova** - *Conference Senior Developer* - [v-stamenova](https://github.com/v-stamenova)
* **Ihor Novikov** - *Conference Senior Developer* - [IGORnvk](https://github.com/IGORnvk)
* **Silvia Popova** - *Conference Website Developer* - [popo0015](https://github.com/popo0015)
* **Simeon Atanasov** - *Conference Website Developer* - [g0sh06](https://github.com/g0sh06)

See also the list of [contributors](https://github.com/HZ-HBO-ICT/it-conference/contributors) who participated in this project.

## License
The code in this repository is licenced MIT. All creative works (photos and videos) on the website itself are copyrighted by HBO-ICT unless otherwise stated. Please contact us at kard0004@hz.nl if you would like to use our work.

<!-- This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details -->

<!-- ## Acknowledgments

* Hat tip to anyone whose code was used
* Inspiration
* etc -->

