<!-- Improved compatibility of back to top link: See: https://github.com/othneildrew/Best-README-Template/pull/73 -->
<a name="readme-top"></a>
<!--
*** Thanks for checking out the Best-README-Template. If you have a suggestion
*** that would make this better, please fork the repo and create a pull request
*** or simply open an issue with the tag "enhancement".
*** Don't forget to give the project a star!
*** Thanks again! Now go create something AMAZING! :D
-->



<!-- PROJECT SHIELDS -->
<!--
*** I'm using markdown "reference style" links for readability.
*** Reference links are enclosed in brackets [ ] instead of parentheses ( ).
*** See the bottom of this document for the declaration of the reference variables
*** for contributors-url, forks-url, etc. This is an optional, concise syntax you may use.
*** https://www.markdownguide.org/basic-syntax/#reference-style-links
-->
[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]



<!-- PROJECT LOGO -->
<br />
<div align="center">

  <a href="https://github.com/marketron-app/app">
    <img src="public/images/marketron-cropped.png" alt="Logo" height="50">
  </a>
<h3 align="center">Marketron</h3>

  <p align="center">
   This is application is a main entry point for Marketron application. It handles user management, template management
with template editor and admin dashboard.
    <br />
    
  </p>
</div>



<!-- ABOUT THE PROJECT -->
## About The Project


This service handles authentication, users, templates.
<p align="right">(<a href="#readme-top">back to top</a>)</p>


<!-- GETTING STARTED -->
## Getting Started
The quickest way to setup the project is using docker-compose.
```sh
docker-compose up -d --build
```

Once you set up the environment with Docker compose, first create .env file (`cp .env.example .env`) and replace values
with [your settings](#environmental-variables). 

After that, run the following Artisan commands to migrate and populate your database:
```bash
php artisan migrate --seed
```

### Environmental variables
IMAGE_ENGINE_URL - URL of the [image engine](https://github.com/marketron-app/image-engine)



<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/marketron-app/api.svg?style=for-the-badge
[contributors-url]: https://github.com/marketron-app/api/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/marketron-app/api.svg?style=for-the-badge
[forks-url]: https://github.com/marketron-app/api/network/members
[stars-shield]: https://img.shields.io/github/stars/marketron-app/api.svg?style=for-the-badge
[stars-url]: https://github.com/marketron-app/api/stargazers
[issues-shield]: https://img.shields.io/github/issues/marketron-app/api.svg?style=for-the-badge
[issues-url]: https://github.com/marketron-app/api/issues
[license-shield]: https://img.shields.io/github/license/marketron-app/api.svg?style=for-the-badge
[license-url]: https://github.com/marketron-app/api/blob/master/LICENSE.txt
