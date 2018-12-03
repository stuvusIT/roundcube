# Roundcube

Sets up and configures a roundcube instance.


## Requirements

It needs an apt based system like Debian or Ubuntu. Also the [stuvusIT.nginx](https://github.com/stuvusIT/nginx), [stuvusIT.php-fpm](https://github.com/stuvusIT/php-fpm) and [stuvusIT.mariadb](https://github.com/stuvusIT/mariadb) roles are required.


## Role Variables

| Name                                | Required                 | Default                                                                     | Description                                                                                                                                                                                     |
|:------------------------------------|:------------------------:|:----------------------------------------------------------------------------|:------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `global_cache_dir`                  | :heavy_check_mark:       |                                                                             | Cache directory to download roundcube files to                                                                                                                                                  |
| `roundcube_sql_password`            | :heavy_check_mark:       |                                                                             | Password of the `roundcube_sql_user`                                                                                                                                                            |
| `roundcube_des_key`                 | :heavy_check_mark:       |                                                                             | This key is used to encrypt the users imap password which is stored in the session record (and the client cookie if remember password is enabled). Please provide a string of exactly 24 chars. |
| `roundcube_install_version`         | :heavy_multiplication_x: | `1.3.8`                                                                     | Version to install                                                                                                                                                                              |
| `roundcube_user`                    | :heavy_multiplication_x: | `www-data`                                                                  | Name of the user to be used for roundcube                                                                                                                                                       |
| `roundcube_group`                   | :heavy_multiplication_x: | `www-data`                                                                  | Group to be used for roundcube                                                                                                                                                                  |
| `roundcube_validate_certs`          | :heavy_multiplication_x: | `true`                                                                      | Should roundcube validate certs during connection to the mail server                                                                                                                            |
| `roundcube_sql_host`                | :heavy_multiplication_x: | `localhost`                                                                 | Host of for the database                                                                                                                                                                        |
| `roundcube_sql_user`                | :heavy_multiplication_x: | `roundcube`                                                                 | Database user                                                                                                                                                                                   |
| `roundcube_sql_database`            | :heavy_multiplication_x: |                                                                             | Database name                                                                                                                                                                                   |
| `roundcube_imap_host`               | :heavy_multiplication_x: | `ssl://localhost`                                                           | Imap server                                                                                                                                                                                     |
| `roundcube_imap_port`               | :heavy_multiplication_x: | `993`                                                                       | Imap port                                                                                                                                                                                       |
| `roundcube_smtp_server`             | :heavy_multiplication_x: | `tls://localhost`                                                           | smtp server                                                                                                                                                                                     |
| `roundcube_smtp_port`               | :heavy_multiplication_x: | `993`                                                                       | smtp port                                                                                                                                                                                       |
| `roundcube_smtp_user`               | :heavy_multiplication_x: | `%u`                                                                        | smtp user                                                                                                                                                                                       |
| `roundcube_smtp_pass`               | :heavy_multiplication_x: | `%p`                                                                        | smtp password                                                                                                                                                                                   |
| `roundcube_support_url`             | :heavy_multiplication_x: | ` `                                                                         | Provide an URL where a user can get support for this Roundcube installation.                                                                                                                    |
| `roundcube_ip_check`                | :heavy_multiplication_x: | `true`                                                                      | check client IP in session authorization                                                                                                                                                        |
| `roundcube_product_name`            | :heavy_multiplication_x: | `roundcube-Webmail`                                                         | This is displayed on the login screen and in the window title                                                                                                                                   |
| `roundcube_plugins`                 | :heavy_multiplication_x: | `['archive', 'zipdownload', 'managesieve', 'password']`                     | A list of strings. Plugins that should be activated                                                                                                                                             |
| `roundcube_language`                | :heavy_multiplication_x: | `de`                                                                        | Language to use                                                                                                                                                                                 |
| `roundcube_enable_spellcheck`       | :heavy_multiplication_x: | `true`                                                                      | Enable spellcheck                                                                                                                                                                               |
| `roundcube_mail_pagesize`           | :heavy_multiplication_x: | `50`                                                                        | Mails to be displayed on one page                                                                                                                                                               |
| `roundcube_draft_autosave`          | :heavy_multiplication_x: | `300`                                                                       | After how many seconds roundcube should do an autosave                                                                                                                                          |
| `roundcube_mime_param_folding`      | :heavy_multiplication_x: | `0`                                                                         | Encoding of long/non-ascii attachment names                                                                                                                                                     |
| `roundcube_mdn_requests`            | :heavy_multiplication_x: | `2`                                                                         | Behavior if a received message requests a message delivery notification (read receipt)                                                                                                          |
| `roundcube_skin`                    | :heavy_multiplication_x: | `larry`                                                                     | Theme to be used                                                                                                                                                                                |
| `roundcube_log_driver`              | :heavy_multiplication_x: | `syslog`                                                                    | Where should roundcube log to.                                                                                                                                                                  |
| `roundcube_working_dir`             | :heavy_multiplication_x: | `/opt/roundcube`                                                            | Working dir for this installation                                                                                                                                                               |
| `roundcube_managesieve_host`        | :heavy_multiplication_x: | `localhost`                                                                 | Host of the sieve server.                                                                                                                                                                       |
| `roundcube_managesieve_port`        | :heavy_multiplication_x: | `4190`                                                                      | Port of the sieve server.                                                                                                                                                                       |
| `roundcube_mail_domain`             | :heavy_multiplication_x: | ` `                                                                         | This domain will be used to form e-mail addresses of new users.                                                                                                                                 |
| `roundcube_roundcube_extra_options` | :heavy_multiplication_x: | `[]`                                                                        | List of dicts each with a value and key option that will be written into the config file                                                                                                        |

For more information please read the [roundcube default config file](https://github.com/roundcube/roundcubemail/blob/master/config/defaults.inc.php)
The role will download and extract the selected version to `{{ roundcube_working_dir }}/roundcubemail-{{ roundcube_install_version }}` and symlink the current version to `{{ roundcube_working_dir }}/current-version/`.

## Example Playbook

```yml
- hosts: all
  become: true
  vars:
    roundcube_working_dir: /opt/roundcube
    roundcube_user: www-data
    roundcube_group: www-data
    roundcube_default_host: ssl://imap01.faveve.uni-stuttgart.de
    roundcube_default_port: 993
    roundcube_product_name: "stuvus - WebMail"
    roundcube_smtp_server: tls://mail01.faveve.uni-stuttgart.de
    roundcube_smtp_port: 587
    roundcube_smtp_user: "%u"
    roundcube_smtp_pass: "%p"
    roundcube_des_key: igTkbqVCYr8EYxXntKWWJw9H 
    roundcube_sql_password: wjzi9oRC2wcdgGOJnvXv2suQ
    php_fpm_pools:
      - name: roundcube
        listen: /run/php/php7.0-fpm.sock
        user: www-data
        pm: static
        pm_max_children: 20

    # mariadb
    mariadb_socket: /var/run/mysqld/mysqld.sock
    served_domains:
      - domains:
          - roundcube
        privkey_path: /etc/ssl/privkey.pem
        fullchain_path: /etc/ssl/fullchain.pem
        default_server: true
        crypto: true
        https: false
        root: "{{ roundcube_working_dir }}/current-version/"
        index_files:
          - index.php
        locations:
          - condition: ~ ^/(bin|CHANGELOG|composer.json|composer.json-dist|config|INSTALL|LICENSE|logs|README.md|SQL|temp|UPGRADING)/ 
            content: deny all;
          - condition: /robots.txt
            content: allow all; log_not_found off; access_log off;
          - condition: /
            content: 
              |
                index index.php
                try_files $uri $uri/ index.php =404;
          - condition: ~ \.php$
            content: include fastcgi.conf; fastcgi_intercept_errors on; fastcgi_pass unix:/run/php/php7.0-fpm.sock;
  roles:
    - mariadb
    - roundcube
    - php-fpm
    - nginx
```

## License

This work is licensed under a [Creative Commons Attribution-ShareAlike 4.0 International License](https://creativecommons.org/licenses/by-sa/4.0/).


## Author Information

- [Fritz Otlinghaus (Scriptkiddi)](https://github.com/scriptkiddi) _fritz.otlinghaus@stuvus.uni-stuttgart.de_
