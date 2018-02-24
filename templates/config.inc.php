<?php

/*
 +-----------------------------------------------------------------------+
 | Local configuration for the Roundcube Webmail installation.           |
 |                                                                       |
 | This is a sample configuration file only containing the minimum       |
 | setup required for a functional installation. Copy more options       |
 | from defaults.inc.php to this file to override the defaults.          |
 |                                                                       |
 | This file is part of the Roundcube Webmail client                     |
 | Copyright (C) 2005-2013, The Roundcube Dev Team                       |
 |                                                                       |
 | Licensed under the GNU General Public License version 3 or            |
 | any later version with exceptions for skins & plugins.                |
 | See the README file for a full license statement.                     |
 +-----------------------------------------------------------------------+
*/

$config = array();

// Database connection string (DSN) for read+write operations
// Format (compatible with PEAR MDB2): db_provider://user:password@host/database
// Currently supported db_providers: mysql, pgsql, sqlite, mssql, sqlsrv, oracle
// For examples see http://pear.php.net/manual/en/package.database.mdb2.intro-dsn.php
// NOTE: for SQLite use absolute path (Linux): 'sqlite:////full/path/to/sqlite.db?mode=0646'
//       or (Windows): 'sqlite:///C:/full/path/to/sqlite.db'
$config['db_dsnw'] = 'mysql://{{ roundcube_sql_user }}:{{ roundcube_sql_password | mandatory }}@{{ roundcube_sql_host }}/{{ roundcube_sql_database }}';

// The mail host chosen to perform the log-in.
// Leave blank to show a textbox at login, give a list of hosts
// to display a pulldown menu or set one host as string.
// To use SSL/TLS connection, enter hostname with prefix ssl:// or tls://
// Supported replacement variables:
// %n - hostname ($_SERVER['SERVER_NAME'])
// %t - hostname without the first part
// %d - domain (http hostname $_SERVER['HTTP_HOST'] without the first part)
// %s - domain name after the '@' from e-mail address provided at login screen
// For example %n = mail.domain.tld, %t = domain.tld
$config['default_host'] = '{{ roundcube_imap_host }}';
$config['default_port'] = '{{ roundcube_imap_port }}';

// SMTP server host (for sending mails).
// To use SSL/TLS connection, enter hostname with prefix ssl:// or tls://
// If left blank, the PHP mail() function is used
// Supported replacement variables:
// %h - user's IMAP hostname
// %n - hostname ($_SERVER['SERVER_NAME'])
// %t - hostname without the first part
// %d - domain (http hostname $_SERVER['HTTP_HOST'] without the first part)
// %z - IMAP domain (IMAP hostname without the first part)
// For example %n = mail.domain.tld, %t = domain.tld
$config['smtp_server'] = '{{ roundcube_smtp_server }}';

// SMTP port (default is 25; use 587 for STARTTLS or 465 for the
// deprecated SSL over SMTP (aka SMTPS))
$config['smtp_port'] = '{{ roundcube_smtp_port }}';

// SMTP username (if required) if you use %u as the username Roundcube
// will use the current username for login
$config['smtp_user'] = '{{ roundcube_smtp_user }}';

// SMTP password (if required) if you use %p as the password Roundcube
// will use the current user's password for login
$config['smtp_pass'] = '{{ roundcube_smtp_pass }}';

// provide an URL where a user can get support for this Roundcube installation
// PLEASE DO NOT LINK TO THE ROUNDCUBE.NET WEBSITE HERE!
$config['support_url'] = '{{ roundcube_support_url }}';

// Name your service. This is displayed on the login screen and in the window title
$config['product_name'] = '{{ roundcube_product_name }}';

// this key is used to encrypt the users imap password which is stored
// in the session record (and the client cookie if remember password is enabled).
// please provide a string of exactly 24 chars.
// YOUR KEY MUST BE DIFFERENT THAN THE SAMPLE VALUE FOR SECURITY REASONS
$config['des_key'] = '{{ roundcube_des_key }}';

// List of active plugins (in plugins/ directory)
$config['plugins'] = array('{{ roundcube_plugins  | join("', '")}}');

// skin name: folder from skins/dependencies
$config['skin'] = '{{ roundcube_skin }}';

# Other configuration
$config['ip_check'] = '{{ roundcube_ip_check }}';
$config['language'] = '{{ roundcube_language }}';
$config['enable_spellcheck'] = '{{ roundcube_enable_spellcheck }}';
$config['mail_pagesize'] = '{{ roundcube_mail_pagesize }}';
$config['draft_autosave'] = '{{ roundcube_draft_autosave }}';
$config['mime_param_folding'] = '{{ roundcube_mime_param_folding }}';
$config['mdn_requests'] = '{{ roundcube_mdn_requests }}';
{% if 'managesieve' in roundcube_plugins %}
$config['managesieve_host'] = '{{ roundcube_managesieve_host }}';
$config['managesieve_port'] = '{{ roundcube_managesieve_port }}';
{% endif %}
{% if roundcube_mail_domain is defined %}
$config['mail_domain'] = '{{ roundcube_mail_domain }}';
{% endif %}
