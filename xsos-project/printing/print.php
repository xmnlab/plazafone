<?php
/**
 * XSOS - Sistema de gestão Ordem de Serviço
 * Copyright (C) 2008  Ivan Ogassavara  
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   mascara
 * @package    sos
 * @subpackage sos.mascara
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 */
error_reporting(E_ALL);

#$cmd = 'touch ' . $_POST['device'];
#exec($cmd);

# change print speed to usb print work properly
exec('stty -F /dev/ttyUSB0 speed 115200');

#$cmd = 'echo "' . $_REQUEST['text'] . '" > ' . $_REQUEST['device'];
$cmd = 'echo "' . $_REQUEST['text'] . '" > ' . '/var/www/html/xsos/xsos_print.txt';
exec($cmd);

$cmd = '/opt/python34/bin/python3 /var/www/html/xsos/print_iso88591.py';
exec($cmd);
