<?php
/**
 * Catálogo y textos de la tienda de ejemplo Peques (juguetes de madera y educativos).
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

class PequesDatos
{
    public static function categorias()
    {
        return [
            'bebes' => ['nombre' => 'Primeros juguetes', 'url' => 'primeros-juguetes', 'foto' => 'arcoiris.jpg', 'corta' => 'De 0 a 2 años', 'desc' => 'Formas, texturas y sonidos para descubrir el mundo con las manos.'],
            'simbolico' => ['nombre' => 'Juego simbólico', 'url' => 'juego-simbolico', 'foto' => 'cocinita.jpg', 'corta' => 'Cocinitas, muñecos y más', 'desc' => 'Jugar a ser mayores: cocinar, cuidar, comprar y vender.'],
            'construccion' => ['nombre' => 'Construir y pensar', 'url' => 'construir-y-pensar', 'foto' => 'canicas.jpg', 'corta' => 'Bloques, circuitos y puzles', 'desc' => 'Juguetes para construir, equivocarse y volver a probar.'],
            'exterior' => ['nombre' => 'Aire libre', 'url' => 'aire-libre', 'foto' => 'cometa.jpg', 'corta' => 'Bicis, cometas y playa', 'desc' => 'Para moverse, correr y mancharse.'],
        ];
    }

    /** Gustos del buscador de regalos. */
    public static function gustos()
    {
        return [
            'construir' => 'Construir',
            'imaginar' => 'Imaginar',
            'moverse' => 'Moverse',
            'descubrir' => 'Descubrir',
        ];
    }

    /**
     * Productos. "edad": [mínima, máxima] en años. "gustos": para el buscador de regalos.
     * "variantes": [valor => impacto en precio]. Precios con IVA incluido.
     */
    public static function productos()
    {
        return [
            ['ref' => 'PEQ-ARC', 'nombre' => 'Arcoíris de madera apilable', 'cat' => 'bebes', 'foto' => 'arcoiris.jpg', 'precio' => 34.90,
                'edad' => [1, 6], 'gustos' => ['construir', 'descubrir'],
                'corta' => 'Doce arcos de madera de tilo en colores suaves. Se apila, se equilibra, se convierte en puente, cuna o tobogán.',
                'larga' => 'Un juguete abierto que crece con el niño: primero para apilar y tocar, luego para construir casas, caminos y lo que se le ocurra. Pintura al agua y cantos redondeados.',
                'ficha' => ['Edad' => 'Desde 1 año', 'Material' => 'Madera de tilo', 'Medidas' => '30 x 15 cm', 'Piezas' => '12']],
            ['ref' => 'PEQ-SON', 'nombre' => 'Sonajero de madera y algodón', 'cat' => 'bebes', 'foto' => 'sonajero.jpg', 'precio' => 14.90,
                'edad' => [0, 1], 'gustos' => ['descubrir'],
                'corta' => 'Aro de haya con cascabel interior y una tela de algodón para morder. El primer regalo perfecto.',
                'larga' => 'Pensado para manos pequeñas: ligero, fácil de agarrar y con un sonido suave que no asusta. La tela se quita y se lava.',
                'ficha' => ['Edad' => 'Desde 0 meses', 'Material' => 'Haya y algodón orgánico', 'Medidas' => 'Ø 8 cm']],
            ['ref' => 'PEQ-ENC', 'nombre' => 'Cubo de encajes de formas', 'cat' => 'bebes', 'foto' => 'encajes.jpg', 'precio' => 24.90,
                'edad' => [1, 3], 'gustos' => ['descubrir', 'construir'],
                'corta' => 'Ocho piezas de colores para meter por su hueco. Formas, colores y mucha paciencia en una caja.',
                'larga' => 'Un clásico que trabaja la coordinación ojo-mano y el reconocimiento de formas. La tapa se abre para sacar las piezas y volver a empezar.',
                'ficha' => ['Edad' => 'Desde 1 año', 'Material' => 'Madera de pino y haya', 'Piezas' => '8']],
            ['ref' => 'PEQ-COC', 'nombre' => 'Cocinita de madera', 'cat' => 'simbolico', 'foto' => 'cocinita.jpg', 'precio' => 119.90, 'oferta' => 20.00,
                'edad' => [3, 8], 'gustos' => ['imaginar'],
                'corta' => 'Fogones, horno con puerta, fregadero y tres cazos. Para cocinar los mejores platos invisibles. Ahora con 20 € de descuento.',
                'larga' => 'Altura pensada para niños de 3 a 8 años y montaje en 20 minutos. Los fogones giran y hacen clic, y el horno tiene bandeja.',
                'ficha' => ['Edad' => 'Desde 3 años', 'Material' => 'Madera y MDF pintado', 'Medidas' => '60 x 30 x 85 cm', 'Incluye' => '3 cazos y utensilios']],
            ['ref' => 'PEQ-FRU', 'nombre' => 'Frutas y verduras para cortar', 'cat' => 'simbolico', 'foto' => 'frutas.jpg', 'precio' => 22.90,
                'edad' => [2, 6], 'gustos' => ['imaginar', 'descubrir'],
                'corta' => 'Fresa, plátano, naranja, zanahoria y tomate que se cortan por la mitad con el cuchillo de madera. Con tabla incluida.',
                'larga' => 'Las piezas se unen con velcro y hacen "crac" al cortarlas. Perfecto para la cocinita o para jugar a la frutería.',
                'ficha' => ['Edad' => 'Desde 2 años', 'Material' => 'Madera de haya', 'Piezas' => '12']],
            ['ref' => 'PEQ-MUN', 'nombre' => 'Muñeco de trapo', 'cat' => 'simbolico', 'foto' => 'munecos.jpg', 'precio' => 29.90,
                'grupo' => 'Modelo', 'variantes' => ['Zorro' => 0, 'Oso' => 0, 'Conejo' => 0],
                'edad' => [0, 6], 'gustos' => ['imaginar'],
                'corta' => 'Cosido a mano en algodón orgánico. Elige zorro, oso o conejo: el compañero de siestas y aventuras.',
                'larga' => 'Relleno de fibra hipoalergénica y ojos bordados, sin piezas que se suelten. Se lava a máquina a 30 grados.',
                'ficha' => ['Edad' => 'Desde 0 meses', 'Material' => 'Algodón orgánico', 'Alto' => '30 cm']],
            ['ref' => 'PEQ-BLO', 'nombre' => 'Bloques de construcción', 'cat' => 'construccion', 'foto' => 'bloques.jpg', 'precio' => 24.90,
                'grupo' => 'Piezas', 'variantes' => ['Caja de 30 piezas' => 0, 'Caja de 60 piezas' => 15],
                'edad' => [2, 8], 'gustos' => ['construir'],
                'corta' => 'Cubos, arcos, cilindros y tejados en madera natural y de colores. Torres, puentes y ciudades enteras.',
                'larga' => 'Medidas proporcionadas entre sí para que todo encaje. Se guardan en una caja de madera con tapa corredera.',
                'ficha' => ['Edad' => 'Desde 2 años', 'Material' => 'Madera de haya', 'Caja' => 'Madera con tapa corredera']],
            ['ref' => 'PEQ-CAN', 'nombre' => 'Circuito de canicas', 'cat' => 'construccion', 'foto' => 'canicas.jpg', 'precio' => 49.90,
                'edad' => [4, 10], 'gustos' => ['construir', 'descubrir'],
                'corta' => '45 piezas de madera para montar circuitos distintos cada día. Incluye 10 canicas de cristal.',
                'larga' => 'Rampas, torres y curvas para inventar recorridos y descubrir por qué una canica va más rápida que otra. Física sin darse cuenta.',
                'ficha' => ['Edad' => 'Desde 4 años', 'Material' => 'Madera de pino', 'Piezas' => '45 y 10 canicas']],
            ['ref' => 'PEQ-PUZ', 'nombre' => 'Puzle mapa de la península', 'cat' => 'construccion', 'foto' => 'puzle.jpg', 'precio' => 19.90,
                'edad' => [6, 12], 'gustos' => ['descubrir'],
                'corta' => '100 piezas de madera con animales, montañas y monumentos. Para aprender geografía jugando.',
                'larga' => 'Ilustrado a mano y cortado en piezas grandes y gruesas que no se doblan. Se guarda en una caja con la imagen completa.',
                'ficha' => ['Edad' => 'Desde 6 años', 'Material' => 'Madera contrachapada', 'Piezas' => '100', 'Medidas' => '40 x 30 cm']],
            ['ref' => 'PEQ-BIC', 'nombre' => 'Bicicleta sin pedales', 'cat' => 'exterior', 'foto' => 'bici.jpg', 'precio' => 79.90,
                'grupo' => 'Color', 'variantes' => ['Azul cielo' => 0, 'Coral' => 0, 'Menta' => 0],
                'edad' => [2, 5], 'gustos' => ['moverse'],
                'corta' => 'Para aprender a mantener el equilibrio antes de pedalear. Sillín regulable y ruedas de goma que no se pinchan.',
                'larga' => 'Cuadro de abedul, manillar con tope de giro y sillín ajustable a dos alturas. Pesa solo 3 kg para que la lleven ellos.',
                'ficha' => ['Edad' => 'De 2 a 5 años', 'Material' => 'Madera de abedul', 'Peso' => '3 kg', 'Sillín' => '30 a 36 cm']],
            ['ref' => 'PEQ-COM', 'nombre' => 'Cometa con forma de pez', 'cat' => 'exterior', 'foto' => 'cometa.jpg', 'precio' => 24.90,
                'edad' => [5, 12], 'gustos' => ['moverse'],
                'corta' => 'Tela de colores y cola de cintas de dos metros. Vuela con muy poco viento. Incluye carrete de madera.',
                'larga' => 'Sin varillas que se rompan: se infla con el viento. Cabe doblada en un bolsillo, ideal para la playa o el campo.',
                'ficha' => ['Edad' => 'Desde 5 años', 'Material' => 'Poliéster ripstop', 'Largo' => '1,5 m (cola de 2 m)']],
            ['ref' => 'PEQ-PLA', 'nombre' => 'Set de playa', 'cat' => 'exterior', 'foto' => 'playa.jpg', 'precio' => 16.90, 'oferta' => 3.00,
                'edad' => [1, 6], 'gustos' => ['moverse', 'imaginar'],
                'corta' => 'Cubo, pala, rastrillo y moldes de estrella y concha en colores suaves. Ahora con 3 € de descuento.',
                'larga' => 'Plástico reciclado y reciclable, sin BPA. Se apila todo dentro del cubo para llevarlo a la playa.',
                'ficha' => ['Edad' => 'Desde 1 año', 'Material' => 'Plástico reciclado', 'Piezas' => '6']],
        ];
    }
}
