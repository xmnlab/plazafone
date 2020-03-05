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

class GuardiaoXmn
{
    public static function verificaPermissaoPedido(DirecaoXMdl $direcaoXMdl, 
        SimpleXMLElement $listaPermissao) {

        $permissao = $listaPermissao->xpath('/permissao/lista_entidade/entidade');
        @$entidade = $direcaoXMdl->requisicao['entidade'];
        @$grupo    = $direcaoXMdl->sessao['permissao'];
        @$pedido   = $direcaoXMdl->requisicao['pedido'];
        
        $estado_proceso = false;

        foreach($permissao as $clave => $contenido) {
            if (get_class($contenido) == 'SimpleXMLElement') {
                $atributos = $contenido->attributes();
                
                if ($atributos['nome'] == $entidade) {
                    $grupoPermissao = $contenido->xpath('grupo');
                    
                    foreach ($grupoPermissao as $claveGrupo => $contenidoGrupo) {
                        $atributoGrupo = $contenidoGrupo->attributes();
                        
                        if ($atributoGrupo['nome'] == $grupo) {
                            
                            $pedidoGrupo = explode(';', $atributoGrupo['pedido']);
                            if (in_array($pedido, $pedidoGrupo)) {
                                $estado_proceso = true;
                            }
                        }
                    }
                    
                }
            }
        }
        
        return $estado_proceso;
        
    }
}