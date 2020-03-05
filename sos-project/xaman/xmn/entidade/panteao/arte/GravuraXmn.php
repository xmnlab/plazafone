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
 * @category   artefato
 * @package    xaman
 * @subpackage xaman.panteao
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @see        http://sourceforge.net/projects/xaman/
 */

/** ModeloXaman */
include_once $XAMAN . 'modelo/artefato/ArtefatoXMdl.php';

/**
 * GravuraXmn
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   artefato
 * @package    xaman.panteao
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 */
class GravuraXmn
{
    /*
     * METHOD PARA COLOCAR MOLDURA EM UMA IMAGEM, PODE APLICAR O 
     * REDIMENSIONAMENTO DA IMAGEM ORIGINAL PARA PODER ENQUADRAR NA MOLDURA
     */
    static function aplicaMoldura(GravuraXMdl $gravuraXMdl, 
        GravuraXMdl $molduraXMdl, $ajustarMoldura = true)
    {
        $gravura        = null;
        $novaGravura    = null;
        $moldura        = $molduraXMdl->pegaObjeto();
        
        $medidaGravura  = null; 
        $medidaMoldura  = array(
            'altura'  => imagesY($moldura),
            'largura' => imagesX($moldura),
        );
        
        $corFundo        = null;
        $escalaCor       = array();
        $numeroCor       = null;
        
        /*
         * REDIMENSIONA GRAVURA PARA AS DIMENSÕES DA MOLDURA
         */
        if ($ajustarMoldura == true) {
            $medidaAjustadaGravura = array();
            
            $medidaAjustadaGravura['largura'] = 
                imagesX($gravuraXMdl->pegaObjeto());
            $medidaAjustadaGravura['altura'] = 
                imagesY($gravuraXMdl->pegaObjeto());
            
            $medidaGravura = $medidaMoldura;
            
            if ($medidaMoldura['altura'] 
                    / $medidaAjustadaGravura['altura']
                > $medidaMoldura['largura'] 
                    / $medidaAjustadaGravura['largura']) {
                
                /*
                 * AJUSTAR PELA ALTURA
                 */
                $medidaAjustadaGravura['largura'] = 
                    ($medidaMoldura['altura'] 
                        / $medidaAjustadaGravura['altura']) 
                    * $medidaAjustadaGravura['largura'];
                $medidaAjustadaGravura['altura']  = $medidaMoldura['altura'];
                
            } else {
                /*
                 * AJUSTAR PELA LARGURA
                 */
                $medidaAjustadaGravura['altura'] = 
                    ($medidaMoldura['largura'] 
                        / $medidaAjustadaGravura['largura']) 
                    * $medidaAjustadaGravura['altura'];
                $medidaAjustadaGravura['largura']  = $medidaMoldura['largura'];
                
            }
            
            self::redimensiona(
                $gravuraXMdl,
                  'largura=' . $medidaAjustadaGravura['largura'] . ';'
                . 'altura=' . $medidaAjustadaGravura['altura'] . ';');
                
            unset($medidaAjustadaGravura);
            
        } else {
            self::redimensiona(
                $gravuraXMdl, $molduraXMdl->pegaDetalhes());
        }
        
        $gravura = $gravuraXMdl->pegaObjeto();
        
        $medidaGravura = array(
            'altura'  => imagesY($gravura),
            'largura' => imagesX($gravura),
        );
        
        /*
         * DEFINIÇÃO DE COR BASE PARA EFEITO DE TRANSPARENCIA BORDA
         */
        $corFundo  = $molduraXMdl->pegaDetalhe('cor-fundo');
        
        if (strlen($corFundo) == 7) {
            $escalaCor['vermelho'] =  hexdec(substr($corFundo, 1, 2));
            $escalaCor['verde']    =  hexdec(substr($corFundo, 3, 2));;
            $escalaCor['azul']     =  hexdec(substr($corFundo, 5, 2));;
            
        } else {
            $escalaCor['vermelho'] =  255;
            $escalaCor['verde']    =  255;
            $escalaCor['azul']     =  255;
        }
        
        $numeroCor = imageColorAllocate($moldura,  
            $escalaCor['vermelho'],
            $escalaCor['verde'],
            $escalaCor['azul']);
        
        /*
         * CALCULA AS POSIÇÕES DE CENTRALIZAÇÃO
         */
        if ($medidaGravura['altura'] != $medidaMoldura['altura']) {
            $medidaGravura['posY'] = 
                ($medidaMoldura['altura'] - $medidaGravura['altura']) / 2;
                
        } else if ($medidaGravura['largura'] != $medidaMoldura['largura']) {
            $medidaGravura['posX'] = 
                ($medidaMoldura['largura'] - $medidaGravura['largura']) / 2;
        }
        
        $novaGravura   = imageCreateTrueColor(
            $medidaMoldura['largura'], $medidaMoldura['altura']);
        
        imagefill(
            $novaGravura, 0, 0, 
            imagecolorallocate(
                $novaGravura, 
                $escalaCor['vermelho'], 
                $escalaCor['verde'], 
                $escalaCor['azul'])
        );

        imageCopyResampled(
            $novaGravura, $gravura,
            $medidaGravura['posX'], $medidaGravura['posY'], 0, 0,
            $medidaGravura['largura'], $medidaGravura['altura'],
            $medidaGravura['largura'], $medidaGravura['altura']);
            

        
        imageColorTransparent($moldura, $numeroCor);
        //$medidaGravura['posX'], $medidaGravura['posY'],
        
        imageCopyMerge(
            $moldura, $novaGravura,
            0,0, 
            0, 0, 
            $medidaMoldura['largura'], $medidaMoldura['altura'], 100
        ) or die ('FALHA_NA_MESCLA_DE_IMAGEM');
        
        $molduraXMdl->atribuiObjeto($novaGravura);
        
    }
    
    static function carrega(GravuraXMdl &$gravuraXMdl)
    {
        $fonteGravura = $gravuraXMdl->pegaDetalhe('localizacao');
        $arquetipo    = '';
        
        if ($fonteGravura == '') {
            throw new TratamentoXmn('GRAVURAXMN', 'TIPO_GRAVURA_INVALIDO');
        }
        switch (strtoupper(mime_content_type($fonteGravura))) {
        case 'IMAGE/JPEG':
            $gravura   = imageCreateFromJPEG($fonteGravura);
            $arquetipo = 'IMAGE/JPEG';
            break;
            
        case 'IMAGE/PNG':
            $gravura   = imageCreateFromPNG($fonteGravura);
            $arquetipo = 'IMAGE/PNG';
            break;
            
        case 'IMAGE/GIF':
            $gravura = imageCreateFromGIF($fonteGravura);
            $arquetipo = 'IMAGE/GIF';
            break;
            
        default:
            throw new TratamentoXmn(
                'GRAVURAXMN', 'TIPO_GRAVURA_INVALIDO');
        }
        
        $gravuraXMdl->atribuiDetalhe('arquetipo', $arquetipo);
        $gravuraXMdl->atribuiDetalhe('localizacao', '');
        $gravuraXMdl->atribuiObjeto($gravura);
        
        self::carregaAtributos($gravuraXMdl);
        
    }
    
    /*
     * METHOD DE REDIMENSIONAMENTO PROPORCIONAL DE IMAGEM
     */
    public static function redimensiona(GravuraXMdl &$gravuraXMdl, 
        $lstTxtParam)
    {
        $medidaMaxima = array(
            'largura' => 0, 'altura' => 0, 
            'largura-min' => 0, 'altura-min' => 0,
            'largura-max' => 0, 'algura-max' => 0
        );
        
        $medidaFinal = array();
        
        $gravura = $gravuraXMdl->pegaObjeto();
        
        $medidaInicial = array(
            'largura' => imagesX($gravura), 
            'altura'  => imagesY($gravura),
            'posX'    => 0,
            'posY'    => 0
        );
        
        $medidaFinal['posX']    = 0;
        $medidaFinal['posY']    = 0;
        
        foreach ($medidaMaxima as $chave => $valor) {
            $medidaMaxima[$chave] = (string) EscritaXmn::pegaValorListaTexto(
                $lstTxtParam, $chave);

        }
        
        if ($medidaInicial['altura'] > $medidaInicial['largura']) {
            /*
             * AJUSTAR IMAGEM PELA ALTURA
             */
            $porcent = $medidaInicial['altura']  / $medidaMaxima['altura'];
            $medidaFinal['altura']  = $medidaMaxima['altura'];
            $medidaFinal['largura'] = $medidaInicial['largura'] / $porcent;
        
        } else {
            /*
             * AJUSTAR IMAGEM PELA LARGURA
             */
            $porcent = $medidaInicial['largura'] / $medidaMaxima['largura'];
            $medidaFinal['largura'] = $medidaMaxima['largura'];
            $medidaFinal['altura']  = $medidaInicial['altura'] / $porcent;
        }
        
        $novaGravura = imageCreateTrueColor(
            $medidaFinal['largura'], $medidaFinal['altura']);
                
        imageCopyResized(
            $novaGravura, 
            $gravura, 
            $medidaFinal['posX'], $medidaFinal['posY'],
            $medidaInicial['posX'], $medidaInicial['posY'], 
            $medidaFinal['largura'], $medidaFinal['altura'], 
            $medidaInicial['largura'], $medidaInicial['altura']
        );
        
        $gravuraXMdl->atribuiObjeto($novaGravura);
    }
    
    /*
     * METHOD PARA CARREGAR OS ATRIBUTOS DE UM OBJETO DE IMAGEM
     */
    static function carregaAtributos(GravuraXMdl $gravuraXMdl)
    {
        if ($gravuraXMdl->pegaObjeto() == null) {
            throw new TratamentoXmn('GRAVURAXMN', 'GRAVURA_NAO_ENCONTRADA');
        }
        
        try {
            $gravuraXMdl->atribuiDetalhe('largura', 
                imagesX($gravuraXMdl->pegaObjeto()));
        
            $gravuraXMdl->atribuiDetalhe('altura', 
                imagesY($gravuraXMdl->pegaObjeto()));
                
        } catch (TratamentoXmn $tratXmn) {
            throw $tratXmn;
        }
    }
    
    static function retornaImagem(GravuraXMdl $gravuraXMdl, 
        $arquetipo = 'JPEG')
    {
        if (is_null($gravuraXMdl->pegaObjeto())) {
            return null;
        }
        
        switch (strtoupper($arquetipo)) {
        case 'JPEG':
            ob_start();
            imagejpeg($gravuraXMdl->pegaObjeto(), null, 100);
            $gravura = ob_get_clean();
            break;
            
        case 'PNG':
            ob_start();
            imagepng($gravuraXMdl->pegaObjeto(), null, 100);
            $gravura = ob_get_clean();
            break;
            
        case 'GIF':
            ob_start();
            imagegif($gravuraXMdl->pegaObjeto(), null, 100);
            $gravura = ob_get_clean();
            break;
            
        default:
            throw new TratamentoXmn(
                'GRAVURAXMN', 'TIPO_GRAVURA_INVALIDO');
        }
        
        return $gravura;
    }
}