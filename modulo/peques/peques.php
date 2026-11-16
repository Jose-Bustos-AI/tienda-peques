<?php
/**
 * Peques: módulo a medida de la tienda de ejemplo Peques (juguetes de madera y educativos).
 * Portada propia, buscador de regalos por edad, gustos y presupuesto, edad recomendada en la ficha,
 * aviso de tienda de prueba, pago de prueba y estilos.
 * Hecho por Dania360.
 */

use PrestaShop\PrestaShop\Core\Payment\PaymentOption;

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once __DIR__ . '/classes/PequesDatos.php';

class Peques extends PaymentModule
{
    public function __construct()
    {
        $this->name = 'peques';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Dania360';
        $this->need_instance = 0;
        $this->bootstrap = true;
        $this->ps_versions_compliancy = ['min' => '8.0.0', 'max' => _PS_VERSION_];
        $this->currencies = true;
        $this->currencies_mode = 'checkbox';
        parent::__construct();
        $this->displayName = 'Peques';
        $this->description = 'Portada, buscador de regalos, estilos y pago de prueba de la tienda de ejemplo Peques.';
    }

    public function install()
    {
        return parent::install()
            && $this->registerHook('displayHeader')
            && $this->registerHook('displayHome')
            && $this->registerHook('displayAfterBodyOpeningTag')
            && $this->registerHook('displayProductAdditionalInfo')
            && $this->registerHook('displayFooterAfter')
            && $this->registerHook('paymentOptions')
            && $this->registerHook('displayPaymentReturn');
    }

    public function hookDisplayHeader()
    {
        $this->context->controller->registerStylesheet('peques-css', 'modules/' . $this->name . '/views/css/peques.css', ['media' => 'all', 'priority' => 900]);
        $this->context->controller->registerJavascript('peques-js', 'modules/' . $this->name . '/views/js/peques.js', ['position' => 'bottom', 'priority' => 900]);
        return '<link rel="preload" href="' . $this->_path . 'views/fonts/fredoka.woff2" as="font" type="font/woff2" crossorigin>'
            . '<meta name="robots" content="noindex, nofollow">';
    }

    public function hookDisplayAfterBodyOpeningTag()
    {
        return '<div class="peques-aviso">Tienda de demostración hecha por <a href="https://tiendas.dania360.com/">Dania360</a>: puedes comprar de prueba, no se cobra nada ni se envía nada.</div>';
    }

    private function precio($valor)
    {
        return $this->context->getCurrentLocale()->formatPrice($valor, $this->context->currency->iso_code);
    }

    private static function textoEdad($edad)
    {
        if (0 === $edad[0]) {
            return 'Desde el nacimiento';
        }
        return 'De ' . $edad[0] . ' a ' . $edad[1] . ' años';
    }

    /** Datos de todos los juguetes para el buscador de regalos. */
    private function datosBuscador()
    {
        $idLang = (int) $this->context->language->id;
        $salida = [];
        foreach (PequesDatos::productos() as $d) {
            $id = (int) Product::getIdByReference($d['ref']);
            if (!$id) {
                continue;
            }
            $p = new Product($id, false, $idLang);
            $portada = Product::getCover($id);
            $actual = Product::getPriceStatic($id, true);
            $normal = Product::getPriceStatic($id, true, null, 6, null, false, false);
            $salida[] = [
                'nombre' => $p->name,
                'precio' => $this->precio($actual),
                'valor' => round($actual, 2),
                'antes' => $normal > $actual + 0.01 ? $this->precio($normal) : '',
                'img' => $portada ? $this->context->link->getImageLink($p->link_rewrite, $id . '-' . $portada['id_image'], 'home_default') : '',
                'url' => $this->context->link->getProductLink($p),
                'edad' => $d['edad'],
                'edadTexto' => self::textoEdad($d['edad']),
                'gustos' => $d['gustos'],
                'corta' => $d['corta'],
            ];
        }
        return $salida;
    }

    public function hookDisplayHome()
    {
        $destacados = '';
        $modulo = Module::getInstanceByName('ps_featuredproducts');
        if ($modulo && $modulo->active) {
            $destacados = $modulo->renderWidget('displayHome', []);
        }

        $categorias = [];
        foreach (PequesDatos::categorias() as $clave => $cat) {
            $idCat = (int) Configuration::get('PEQUES_CAT_' . strtoupper($clave));
            if ($idCat) {
                $categorias[] = [
                    'nombre' => $cat['nombre'],
                    'texto' => $cat['corta'],
                    'url' => $this->context->link->getCategoryLink($idCat),
                    'img' => $this->_path . 'views/img/productos/' . $cat['foto'],
                ];
            }
        }

        $this->context->smarty->assign([
            'peques_ruta' => $this->_path,
            'peques_destacados' => $destacados,
            'peques_categorias' => $categorias,
            'peques_gustos' => PequesDatos::gustos(),
            'peques_buscador' => json_encode($this->datosBuscador(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP),
            'peques_envoltorio' => $this->precio((float) Configuration::get('PS_GIFT_WRAPPING_PRICE')),
            'peques_tienda' => $this->context->link->getCategoryLink((int) Configuration::get('PS_HOME_CATEGORY')),
        ]);

        return $this->fetch('module:peques/views/templates/hook/portada.tpl');
    }

    public function hookDisplayProductAdditionalInfo($params)
    {
        $html = '';
        $id = isset($params['product']['id_product']) ? (int) $params['product']['id_product'] : 0;
        $ref = $id ? (new Product($id))->reference : '';
        foreach (PequesDatos::productos() as $d) {
            if ($d['ref'] !== $ref) {
                continue;
            }
            $gustos = PequesDatos::gustos();
            $html .= '<div class="peques-edad"><span class="peques-edad__num">' . (0 === $d['edad'][0] ? '0+' : (int) $d['edad'][0] . '+') . '</span><p><b>' . htmlspecialchars(self::textoEdad($d['edad'])) . '</b>';
            $html .= 'Ideal para niños y niñas a los que les gusta ' . htmlspecialchars(mb_strtolower(implode(' y ', array_map(function ($g) use ($gustos) {
                return $gustos[$g];
            }, $d['gustos'])))) . '.</p></div>';
        }
        return $html . '<ul class="peques-ventajas-ficha">'
            . '<li><b>Envuelto para regalo</b> por ' . htmlspecialchars($this->precio((float) Configuration::get('PS_GIFT_WRAPPING_PRICE'))) . ': elígelo al finalizar la compra</li>'
            . '<li><b>Envío gratis</b> desde 40 €</li>'
            . '<li><b>Hecho para durar</b> y pasar de hermano a hermano</li>'
            . '</ul>';
    }

    public function hookDisplayFooterAfter()
    {
        return '<div class="peques-pie-base">© Peques · Tienda de ejemplo hecha por <a href="https://tiendas.dania360.com/">Dania360</a> con PrestaShop · Fotos creadas para la marca</div>';
    }

    /* ---------- Pago de prueba ---------- */

    public function hookPaymentOptions($params)
    {
        if (!$this->active) {
            return [];
        }
        $opcion = new PaymentOption();
        $opcion->setModuleName($this->name)
            ->setCallToActionText('Pago de prueba')
            ->setAction($this->context->link->getModuleLink($this->name, 'validacion', [], true))
            ->setAdditionalInformation('<p class="peques-pago-info">Tienda de demostración: no se pide tarjeta y no se cobra nada. Al confirmar verás cómo termina un pedido real.</p>');
        return [$opcion];
    }

    public function hookDisplayPaymentReturn($params)
    {
        return '<p class="peques-pago-info">Este pedido es de prueba: no se ha cobrado nada y no se enviará nada.</p>';
    }
}
