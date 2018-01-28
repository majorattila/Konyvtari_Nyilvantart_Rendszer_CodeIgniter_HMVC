<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2016, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2016, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['email_must_be_array'] = 'Az e-mail érvényesítési módot egy tömbön kell átadni.';
$lang['email_invalid_address'] = 'Érvénytelen e-mail cím: %s';
$lang['email_attachment_missing'] = 'Nem sikerült megtalálni a következő e-mail mellékletet: %s';
$lang['email_attachment_unreadable'] = 'Nem sikerült megnyitni ezt a mellékletet: %s';
$lang['email_no_from'] = 'Nem lehet leveleket küldeni "From" fejléccel.';
$lang['email_no_recipients'] = 'A címzetteket is tartalmaznia kell: To, Cc vagy Bcc';
$lang['email_send_failure_phpmail'] = 'Nem sikerült e-mailt küldeni a PHP mail() használatával. Lehet, hogy a kiszolgáló nem úgy van beállítva, hogy levelezést küldjön ezzel a módszerrel.';
$lang['email_send_failure_sendmail'] = 'Nem küldhető e-mail a PHP Sendmail használatával. Lehet, hogy a kiszolgáló nem úgy van beállítva, hogy levelezést küldjön ezzel a módszerrel.';
$lang['email_send_failure_smtp'] = 'Nem sikerült e-mailt küldeni a PHP SMTP használatával. Lehet, hogy a kiszolgáló nem úgy van beállítva, hogy levelezést küldjön ezzel a módszerrel.';
$lang['email_sent'] = 'Üzenetét sikeresen elküldtük a következő protokoll használatával: %s';
$lang['email_no_socket'] = 'Nem lehet megnyitni egy csatlakozót a Sendmail számára. Kérjük, ellenőrizze a beállításokat.';
$lang['email_no_hostname'] = 'Nem adott meg SMTP-gazdagépnevet.';
$lang['email_smtp_error'] = 'A következő SMTP hiba történt: %s';
$lang['email_no_smtp_unpw'] = 'Hiba: SMTP felhasználónevet és jelszót kell rendelnie.';
$lang['email_failed_smtp_login'] = 'Nem sikerült elküldeni az AUTH LOGIN parancsot. Hiba: %s';
$lang['email_smtp_auth_un'] = 'Nem sikerült hitelesíteni a felhasználónevet. Hiba: %s';
$lang['email_smtp_auth_pw'] = 'A jelszó hitelesítése nem sikerült. Hiba: %s';
$lang['email_smtp_data_failure'] = 'Nem lehet adatokat küldeni: %s';
$lang['email_exit_status'] = 'Kilépés az állapotkódból: %s';