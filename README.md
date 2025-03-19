<p align="center">
 <a href="https://hz.nl">
        <img src="https://img.shields.io/badge/Made for-HZ University of Applied Sciences-blue.svg" alt="HZ University of Applied Sciences"/></a>
</p>
<p align="center">
    <a href="https://github.com/HZ-HBO-ICT/it-conference/graphs/contributors">
        <img src="https://img.shields.io/github/contributors/HZ-HBO-ICT/it-conference" alt="Contributors"/></a>
    <a href="https://github.com/HZ-HBO-ICT/it-conference/actions/workflows/main.yml">
        <img src="https://github.com/HZ-HBO-ICT/it-conference/actions/workflows/phpcs.yml/badge.svg" alt="PHPCS"/></a>
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
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs
```
We highly recommend adding an alias for the `./vendor/bin/sail` command. Check the wiki or read further down in the README on how to do that.
 
4. Set up the environment variables - `cp .env.example .env`
5. After the dependencies are installed run `./vendor/bin/sail up -d`
6. Install the NPM packages - `./vendor/bin/sail npm install`
7. Add the app key - `./vendor/bin/sail artisan key:generate`
8. After the creation of the containers run `./vendor/bin/sail artisan migrate`
9. Run `./vendor/bin/sail npm run dev` or `./vendor/bin/sail npm run build` to either start a dev server or to create a build.

### Possible complications 
- __Incorrectly set permissions__

This issue may be encountered after installing the application and trying to access it through the browser. It can be something along the lines of:
> The stream or file "/var/www/html/storage/logs/laravel.log" could not be opened in append mode: Failed to open stream: Permission denied

In order to fix this run `chmod -R 777 storage bootstrap/cache`. This issue might even occur when the artisan commands are used via sail. If that occurs, try granting only the permissions only to the specified directories.

- __Setting an alias__

Instead of using every time `./vendor/bin/sail` this can be shorten by using an alias - `alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'`. This way the commands will shorten (e.g. `sail up -d`)


## Commonly used commands

### Setting up database (based on stages)

The application supports a couple of "stages". We created a specific function to ensure that the seeded data is as close as possible to the actual data at each stage. You can use it by running: `sail artisan db:setup [stage]`. The `stage` parameter allows for the following values: `initial`, `company-registration`, `participant-registration`.

### Running tests
> Note: The most important tests we have are also running as 
[GitHub Actions](https://github.com/HZ-HBO-ICT/it-conference/actions). Opening a PR or making new commits to it will trigger a workflow when you push your code to
the repository, which will run the tests automatically.

#### PHPUnit
If you run the test normally you can use: `sail phpunit`. 

If you want to run your tests a bit faster you can run them in parallel you can use: `sail artisan test --parallel`

Keep in mind that in the [GitHub actions workflow](https://github.com/HZ-HBO-ICT/it-conference/blob/main/.github/workflows/build.yml) is running using the parallel testing which might cause some conflicting results if you run the local tests "normally" (e.g. actions fails while tests pass locally).

#### PHP_CodeSniffer (PHPCS)

If you want to check if your code passes the coding standards you can use: `sail run vendor/bin/phpcs`.

Some of the sniffs can be fixed automatically - to fix those you can use: `sail run vendor/bin/phpcbf`

#### Larastan (PHPStan)

If you want to check if your code passes the PHPStan conventions you can use: `sail run /vendor/bin/phpstan analyse --configuration=phpstan.neon`

### Model documentation

If you have made changes on any model you can generate the new documentation using: `sail run artisan ide-helper:models -RW`

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

**YYYY** is the year of the release, so 2025.

**R** represents the release within a year, so if it is the first it would be 1, if it is the second it would be 2.

**B** represents bugfixes.

## Current Team

* **Tim Kardol** - *Conference Organiser* - [TimKardol](https://github.com/TimKardol)
* **Valeria Stamenova** - *Conference Website Project Lead* - [v-stamenova](https://github.com/v-stamenova)
* **Ihor Novikov** - *Conference Senior Developer* - [IGORnvk](https://github.com/IGORnvk)
* **Silvia Popova** - *Conference Design Specialist* - [popo0015](https://github.com/popo0015)
* **Gijs Borghouts** - *Fullstack Developer* - [CaptainPancakeWithBacon](https://github.com/CaptainPancakeWithBacon)
* **Gabriella Khayutin** - *Frontend Developer* - [GabriellaKhayutin1](https://github.com/GabriellaKhayutin1)
* **Nikol Alexandrova** - *Frontend Developer* -[NikolAlexandrova](https://github.com/NikolAlexandrova)
* **Erik van den Broek** - *Backend Developer* - [erjbroek](https://github.com/erjbroek)
* **Alisiia Mishchenko** - *Fullstack Developer* - [alisiia02](https://github.com/alisiia02)

See also the list of [contributors](https://github.com/HZ-HBO-ICT/it-conference/contributors) who participated in this project.

## License
The code in this repository is licenced MIT. All creative works (photos and videos) on the website itself are copyrighted by HBO-ICT unless otherwise stated. Please contact us at tim.kardol@hz.nl if you would like to use our work.

<!-- This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details -->

<!-- ## Acknowledgments

* Hat tip to anyone whose code was used
* Inspiration
* etc -->

