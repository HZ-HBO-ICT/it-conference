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

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing
purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

This application uses PHP (Composer), NodeJS, and Docker.\
The development environment must be in Linux for optimal performance and compatibility with Laravel Sail; either use native Linux or use [WSL](https://learn.microsoft.com/en-us/windows/wsl/filesystems).\
For instructions on how to properly install the project within WSL, refer to the [wiki](https://github.com/HZ-HBO-ICT/it-conference/wiki).

### Installing

1. Clone the repository onto your local machine.
2. Run `composer install` and `npm install`.
3. Copy `.env.example` to `.env`.
4. Run `php artisan key:generate`.
5. Run `./vendor/bin/sail up -d`.
6. Run `php artisan migrate`.
7. Run `npm run dev`.

#### Optional steps:

- In some versions of Linux, permissions aren't set correctly. If you run into that issue,
  run `chmod -R 777 storage bootstrap/cache`. [Understanding chmod and why 777 is a security issue.](https://www.redhat.com/sysadmin/introduction-chmod)
- Instead of repeatedly running ./vendor/bin/sail commands, you
  can [set an alias.](https://laravel.com/docs/10.x/sail#configuring-a-shell-alias) In that case, `./vendor/bin/sail` is
  shortened to `sail`.

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

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Current Team

* **Tim Kardol** - *Conference Website Project lead* - [TimKardol](https://github.com/TimKardol)
* **Valeria Stamenova** - *Conference Senior Developer* - [v-stamenova](https://github.com/v-stamenova)
* **Ihor Novikov** - *Conference Senior Developer* - [IGORnvk](https://github.com/IGORnvk)

See also the list of [contributors](https://github.com/HZ-HBO-ICT/it-conference/contributors) who participated in this project.

## License
The code in this repository is licenced MIT. All creative works (photos and videos) on the website itself are copyrighted by HBO-ICT unless otherwise stated. Please contact us at kard0004@hz.nl if you would like to use our work.

<!-- This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details -->

<!-- ## Acknowledgments

* Hat tip to anyone whose code was used
* Inspiration
* etc -->

