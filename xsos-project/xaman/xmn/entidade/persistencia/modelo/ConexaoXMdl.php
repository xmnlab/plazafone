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

/**
 * ConexaoXMdl: Classe que armazena as informa��es da conex�o
 * da camada de persist�ncia
 * 
 * A classe ConexaoXMdl � utilizada para armazenar e recuperar
 * informa��es referentes �s informa��es pertinentes a uma conex�o
 * da camada de persist�ncia com o SGBD especificado
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   modelo
 * @package    xaman.modelo
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 */
class ConexaoXMdl extends ModeloXmn
{
    private $banco;
    private $esquema;
    private $porta;
    private $senha;
    private $servidor;
    private $sgbd;
    private $usuario;
    
    public function __construct()
    {
        $this->banco    = '';
        $this->esquema  = '';
        $this->porta    = '';
        $this->senha    = '';
        $this->servidor = '';
        $this->sgbd     = '';
        $this->usuario  = '';
    }
    
    public function pegaServidor()
    {
        return $this->servidor;
    }
    public function pegaBanco()
    {
        return $this->banco;
    }
    public function pegaEsquema()
    {
        return $this->esquema;
    }
    public function pegaSGBD()
    {
        return $this->sgbd;
    }
    public function pegaUsuario()
    {
        return $this->usuario;
    }
    public function pegaSenha()
    {
        return $this->senha;
    }
    public function pegaPorta()
    {
        return $this->porta;
    }

    public function atribuiServidor($servidor)
    {
        $this->servidor = $servidor;
    }
    public function atribuiBanco($banco)
    {
        $this->banco = $banco;
    }
    public function atribuiEsquema($esquema)
    {
        $this->esquema = $esquema;
    }
    public function atribuiSGBD($sgbd)
    {
        $this->sgbd = $sgbd;
    }
    public function atribuiUsuario($usuario)
    {
        $this->usuario = $usuario;
    }
    public function atribuiSenha($senha)
    {
        $this->senha = $senha;
    }
    public function atribuiPorta($porta)
    {
        $this->porta = $porta;
    }
}
