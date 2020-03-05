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
 * @category   panteao
 * @package    xaman
 * @subpackage xaman.tratamento
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @see        http://sourceforge.net/projects/xaman/
 */


/** Gera��o de logs */
include_once $XAMAN . 'panteao/MensageiroXmn.php';

/**
 * TratamentoXaman: Tratamento de Excess�o Gerais
 * 
 * A classe TratamentoXaman tem como objetivo tratar excess�es
 * que n�o tiver um tratamento espec�fico
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   tratamento
 * @package    xaman.tratamento
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
  */
class TratamentoXmn extends Exception
{
    private $tratamento;
    
    public function __construct($tratamento = array())
    {
        if (is_string($tratamento)) {
            $tratamento = array ('codigo' => $tratamento);
        }
        
        MensageiroXmn::registraOcorrencia($this->getTrace());
        
        $debug_backtrace = $this->getTrace();
        $log = date(DATE_RFC822) . "\n";
        
        foreach ($debug_backtrace as $chave => $valor){
            @$log.= '[ Arquivo:' . $valor['file']     . ' ] ';
            @$log.= 'Linha:'   . $valor['line']     . ' ] ';
            @$log.= 'Método:'  . $valor['function'] . ' ] ';
            @$log.= 'Classe:'  . $valor['class']    . ' ] ';
            @$log.= 'Tipo:'    . $valor['type']     . ' ] ';

            $log.= "\n";
        }
        
        MensageiroXmn::log('/tmp/xmn.log', $log);
        
        $this->tratamento = $tratamento;
    }
    
    public function atribuiTratamento($tratamento = array())
    {
        if (is_string($tratamento)) {
            $tratamento = array ('codigo' => $tratamento);
        }
        
        foreach ($tratamento as $chave => $conteudo) {
            $this->tratamento[$chave] = $conteudo;
        }
    }
    
    public function pegaTratamento()
    {
        return $this->tratamento;
    }
    
    public function pegaMensagem($tratamento = array('codigo'))
    {
        $mensagem = '';
        foreach ($tratamento as $chave => $conteudo) {
            if ($mensagem != '') {
                $mensagem .=  ' - ';
            }
            $mensagem .= $this->tratamento[$conteudo];
        }
        
        return $mensagem;
    }
}
