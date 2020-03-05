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
 * @category   modelo
 * @package    xaman
 * @subpackage xaman.modelo
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @see        http://sourceforge.net/projects/xaman/
 */

/** ModeloXaman */
include_once $XAMAN . 'modelo/ModeloXmn.php';

/** ModeloXaman */
include_once $XAMAN . 'modelo/artefato/MensagemXMdl.php';

/**
 * CorrespondenciaXMdl: Classe que armazena informa��es para
 * de correspond�ncia
 * 
 * A classe CorrespondenciaXMdl � utilizada para armazenar
 * e recuperar informa��es referentes a envio de mensagem.
 * A camada de fluxo popular� essa classe para enviar uma mensagem
 * com ou sem arquivos anexos a um destinat�rio especificado.
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   modelo
 * @package    xaman.modelo
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 */
class CorrespondenciaXMdl extends MensagemXMdl
{
    private $listaArtefatoXaman;
    private $destinatario;
    private $assunto;
    private $caracteristicas;

    public function atribuiListaArtefatoXaman(ListaArtefatoXaman $listaArtefatoXaman)
    {
        $this->listaArtefatoXaman = $listaArtefatoXaman;
    }
    public function atribuiDestinatario($destinatario)
    {
        $this->destinatario = (string) $destinatario;
    }
    public function atribuiAssunto($assunto)
    {
        $this->assunto = (string) $assunto;
    }
    public function atribuiCaracteristicas($caracteristicas)
    {
        $this->caracateristicas = (string) $caracteristicas;
    }
    
    public function &pegaListaArtefatoXaman()
    {
        return $this->listaArtefatoXaman;
    }
    public function &pegaDestinatario()
    {
        return $this->destinatario;
    }
    public function &pegaAssunto()
    {
        return $this->assunto;
    }
    public function &pegaCaracteristicas()
    {
        return $this->caracteristicas;
    }
}

