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
 * @package    xaman.modelo
 * @subpackage xaman.modelo.comum
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @see        http://sourceforge.net/projects/xaman/
 */
 
/** ModeloXaman */
include_once $XAMAN . 'modelo/ModeloXmn.php';

/** BairroXMdl */
include_once $XAMAN . 'modelo/comum/BairroXMdl.php';

/** TelefoneXMdl */
include_once $XAMAN . 'modelo/comum/TelefoneXMdl.php';

/** TipoLogradouroXMdl */
include_once $XAMAN . 'modelo/comum/TipoLogradouroXMdl.php';

/**
 * EnderecoXMdl: Classe modelo para armazenar endereço
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   modelo
 * @package    xaman.modelo.comum
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 */
class EnderecoXMdl extends ModeloXmn
{
    private $bairroXMdl;
    private $cep;
    private $complemento;
    private $logradouro;
    private $numero;
    private $tipoLogradouroXMdl;
    
    public function __construct()
    {
        $this->bairroXMdl         = new BairroXMdl();
        $this->tipoLogradouroXMdl = new TipoLogradouroXMdl();
    }
    
    public function &pegaBairroXMdl()
    {
        return $this->bairroXMdl;
    }
    public function pegaLogradouro()
    {
        return $this->logradouro;
    }
    public function &getTipoLogradouroXMdl()
    {
        return $this->tipoLogradouroXMdl;
    }
    public function pegaNumero()
    {
        return $this->numero;
    }
    public function pegaCep()
    {
        return $this->cep;
    }
    public function pegaComplemento()
    {
        return $this->complemento;
    }

    public function atribuiBairroXMdl(BairroXMdl $bairroXMdl)
    {
        $this->bairroXMdl = $bairroXMdl;
    }
    public function atribuiCep($cep)
    {
        $this->cep = (string) $cep;
    }
    public function atribuiComplemento($complemento)
    {
        $this->complemento = (string) $complemento;
    }
    public function atribuiLogradouro($logradouro)
    {
        $this->logradouro = (string) $logradouro;
    }
    public function atribuiTipoLogradouroXMdl(
        TipoLogradouroXMdl $tipoLogradouroXMdl)
    {
        $this->tipoLogradouroXMdl = $tipoLogradouroXMdl;
    }
    public function atribuiNumero($numero)
    {
        $this->numero = (string) $numero;
    }
}
