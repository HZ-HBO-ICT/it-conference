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
        <img src="https://img.shields.io/badge/License-MIT-yellow.svg" alt="MIT License"/></a>
</p>

# IT-Conference Website

This repository contains the source code for the official HBO-ICT IT-Conference. 

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing 
purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites
This application uses PHP (Composer), NodeJS, and Docker.

### Installing
1. Clone the repository onto your local machine.
2. Run `composer install` and `npm install`.
3. Copy `.env.example` to `.env`.
4. Run `php artisan key:generate`
5. Fill out all remaining empty parameters in the environment files.
6. Run `docker compose up -d`.
7. Run `php artisan migrate`.

> ⚠️ To ensure proper functioning across all operating systems, some folders are given elevated permissions. On a local
> environment, this should not cause issues. Exercise proper operational security, nonetheless.
> 
## Running the tests
Tests are currently only supported through [GitHub Actions](https://github.com/HZ-HBO-ICT/it-conference/actions) and will
run automatically when you push to the repository. Local testing is being worked on.

<!-- Explain how to run the automated tests for this system -->

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

## Authors

* **Tim Kardol** - *Conference Website Project lead* - [TimKardol](https://github.com/TimKardol)
* **Valeria Stamenova** - *Conference Website Developer* - [v-stamenova](https://github.com/v-stamenova)
* **Ihor Novikov** - *Conference Website Developer* - [IGORnvk](https://github.com/IGORnvk)
* **Jesper Bertijn** - *Conference Website Developer* - [Ex6tenze](https://github.com/Ex6tenze)

See also the list of [contributors](https://github.com/HZ-HBO-ICT/it-conference/contributors) who participated in this project.

## License
The code in this repository is licenced MIT. All creative works (photos and videos) on the website itself are copyrighted by HBO-ICT unless otherwise stated. Please contact us at kard0004@hz.nl if you would like to use our work.

<!-- This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details -->

<!-- ## Acknowledgments

* Hat tip to anyone whose code was used
* Inspiration
* etc -->

