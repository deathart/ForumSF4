# Forum-sf4
I created this forum system with the help of Symfony4, thank you for being lenient I'm not a professional developer, this system just helps me to learn more deeply Symfony but also PHP, don't hesitate to help me in this project and tell me what's going and what's not going well.

# Installation (An automatic installation will come later on)
- First of all, configure the file .env to the root of the folder.
- Then execute the following commands :
  - PHP
      - Normal
          - ```shell
              composer install
              php bin/console doctrine:schema:update --force
              php bin/console doctrine:fixtures:load
              composer dump-autoload --optimize --no-dev --classmap-authoritative
              php bin/console server:run
              ```
      - Docker
          - ```shell
              docker-compose build && docker-compose up -d
              ./docker/composer install
              ./docker/console bin/console doctrine:schema:update --force
              ./docker/console bin/console doctrine:fixtures:load
              ./docker/composer dump-autoload --optimize --no-dev --classmap-authoritative
              ```
  - Theme
      - ```shell
          yarn install
          yarn run encore production
          ```
  - Go to [http://127.0.0.1:8000](http://127.0.0.1:8000)

# Themes and languages
- Themes : (Provisional).
  - For templates files : `Ressources/templates`
  - For assets (JS/CSS/IMG/FONTS) : `Ressources/assets`
- Language : To modify or add a new language, go to [http://127.0.0.1:8000/admin/_trans](http://127.0.0.1:8000/admin/_trans)

# Server Requirements
[PHP](http://php.net) version 7.1.3 or newer is required, with the [intl](http://php.net/manual/fr/book.intl.php) & [iconv](http://php.net/manual/fr/book.iconv.php) extension's installed. [Why 7.1](https://gophp71.org/)?

# Issues
For any problems or suggestions created a new issue (By checking that this issue has not already been created)

# Screenshots
![Home](https://deathart.fr/cv/forumsf4/forum_home.png "Home")
![Forum](https://deathart.fr/cv/forumsf4/forum_forum.png "Forum")
![Topic](https://deathart.fr/cv/forumsf4/forum_topic.png "Topic")