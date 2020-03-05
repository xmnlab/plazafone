<?php
/**
 * Xaman - Estrutura de Desenvolvimento
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
 * @category   xaman
 * @package    xaman
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @see        http://sourceforge.net/projects/xaman/
 */

/* 
 * CONFIGURA��O DOS ENDERE�OS DAS ALDEIAS (DIRET�RIOS)
 */

eval("static \$XAMAN              = '" . $XAMAN_PACHAMAMA ."entidade/';");

include_once $XAMAN . 'Xaman.php';

/** CHAMADA DA ORIGEM */
$origem = simplexml_load_file($XAMAN_PACHAMAMA . 'ritual/base/origem.xmn');

$direcaoXMdl = new DirecaoXMdl();

$direcaoXMdl->artefato   = &$_FILES;
$direcaoXMdl->pegada     = &$_GET;
$direcaoXMdl->postagem   = &$_POST;
$direcaoXMdl->requisicao = &$_REQUEST;
$direcaoXMdl->sessao     = &$_SESSION;

eval(Xaman::preparaJornada($origem));