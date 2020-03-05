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
 * ListaModeloXmn: Classe Mestre de Lista de Modelos
 * 
 * A classe ListaModeloXmn � utilizada para armazenar e recuperar
 * modelos de uma determinada classe de modelo
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   modelo
 * @package    xaman.modelo
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 */
class ListaModeloXmn extends ModeloXmn
{
    private $arquetipoModelo;
    private $indice = -1;
    private $limiteLista = 0;
    private $lista = array();
    private $primeiroModeloVazio;

    public function __construct($arquetipoModelo = 'ModeloXmn', 
        $primeiroModeloVazio = false)
    {
        $this->arquetipoModelo = (string) $arquetipoModelo;
        $this->primeiroModeloVazio = (bool) $primeiroModeloVazio;

        if ($primeiroModeloVazio == true) {
            $this->adicionaModelo(new $this->arquetipoModelo());
        }
    }

    public function adicionaModelo(ModeloXmn $modelo)
    {
        if (get_class($modelo) == $this->arquetipoModelo) {
            $this->lista[] = $modelo;
            return true;
        }

        return false;
    }

    protected function atribuiArquetipoModelo($arquetipoModelo)
    {
        $this->arquetipoModelo = (string) $arquetipoModelo;
    }

    public function atribuiLimiteLista($limiteLista)
    {
        $this->limiteLista = $limiteLista;
    }

    public function adicionaLista(ListaModeloXmn $listaXLstMdl)
    {
        $this->lista = array_merge($this->lista, $listaXLstMdl->pegaLista());
    }

    public function removeModelo()
    {

    }
    public function movePrimeiro($posicaoZero = false)
    {
        $posicaoZero = (bool) $posicaoZero;

        if ($posicaoZero == true) {
            $this->indice = 0;
        } else {
            $this->indice = -1;
        }
    }
    public function moveProximo()
    {
        if (count($this->lista) > $this->indice + 1) {
            $this->indice++;
            return true;
        }
        return false;
    }
    public function moveAnterior()
    {
        if ($this->indice > -1) {
            $this->indice--;
            return true;
        }
        return false;
    }
    public function moveUltimo()
    {
        if (count($this->lista) < 1) {
            return false;
        }
        $this->indice = count($this->lista) - 1;
        return true;
    }

    public function pegaLista()
    {
        return $this->lista;
    }
    
    public function pegaIds($arquetipo = 'inteiro')
    {
        $lista = '';
        
        foreach ($this->lista as $ponteiro => $modelo) {
            if ($lista != '') {
                $lista .= ', ';
            }
            
            $lista.= $modelo->pegaId();
        }
        
        return $lista;
    }

    public function pegaModelo()
    {
        return $this->lista[$this->indice];
    }
    public function pegaArquetipoModelo()
    {
        return $this->arquetipoModelo;
    }
    public function pegaTotalModelo()
    {
        return count($this->lista);
    }
    public function zeraLista()
    {
        $this->lista = array();
        $this->indice = -1;

        if ($this->primeiroModeloVazio == true) {
            $this->adicionaModelo(new $this->arquetipoModelo());
        }
    }
    
    public static function pegaXml(ListaModeloXmn $listaMdl,
        $lstAtributo = array())
    {
        $xml = '<listaXml>';
        $listaMdl->movePrimeiro();

        while ($listaMdl->moveProximo()) {
            $xml .= parent::pegaXml($listaMdl->pegaModelo(),
                $lstAtributo);
        }
        $xml .= '</listaXml>';
        return $xml;
    }
}
