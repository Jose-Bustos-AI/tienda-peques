# Peques · tienda PrestaShop de demostración

Juguetería de madera y juguetes educativos: primeros juguetes, juego simbólico, construcción y aire libre, con un buscador de regalos en la portada que propone juguetes según la edad, lo que le gusta al niño o la niña y el presupuesto, y envoltorio de regalo con nota en el pago.

**Verla publicada:** https://peques.dania360.com/

## Qué hay en este repositorio
Solo el módulo hecho a medida para esta tienda; PrestaShop no se incluye.

```
modulo/peques/peques.php                 Módulo principal: ganchos de la portada, estilos y scripts
modulo/peques/classes/                  Datos del catálogo
modulo/peques/controllers/front/        Montaje de la tienda y pago de demostración
modulo/peques/views/                    Plantilla de la portada, CSS sobre el tema Hummingbird, JavaScript y tipografías
```

## Cómo está hecha
- PrestaShop 9.2 con el tema oficial Hummingbird, en el hosting de Hostinger, con su propio subdominio y certificado de seguridad
- Módulo propio para PrestaShop que añade la portada, el buscador de regalos, la edad en cada ficha, los estilos, el aviso de tienda de prueba y el pago de prueba
- Paleta suave (crema, coral, mostaza y menta) y tipografías Fredoka y Nunito servidas desde la propia tienda
- Portada con foto, buscador de regalos, categorías en círculo, productos destacados e historia de la tienda; en el móvil la foto va arriba y el texto debajo
- Tienda, carrito y pago en español, también los textos que PrestaShop deja en inglés o con erratas

## Catálogo y compra
- 12 productos en 4 categorías: primeros juguetes, juego simbólico, construir y pensar, y aire libre
- Combinaciones con su stock: bicicleta en tres colores con muestra de color, muñeco en tres modelos y bloques en caja de 30 o 60 piezas
- Edad recomendada en cada ficha, con una frase sobre a quién le va a gustar
- Ficha técnica de cada juguete (edad, material, medidas, piezas)
- Ofertas con precio tachado y etiqueta de descuento
- Fotos de producto creadas para la marca
- Dos transportistas: envío estándar a 3,95 € y gratis desde 40 €, y exprés en 24 h a 6,95 €
- Envoltorio de regalo por 2 € con nota, que se elige al finalizar la compra
- Cupón de bienvenida BIENVENIDA10 con un 10 % de descuento
- Compra como invitado, sin tener que crear cuenta
- Pago de prueba propio que no pide tarjeta y deja el pedido como pagado, con su factura
- Dos pedidos de prueba completos: cocinita en oferta con cupón, envío gratis y envoltorio con nota, y desde el móvil con variante de modelo y envío exprés

## Detalles
- Sin módulos de pago: lo propio está en un módulo hecho a medida
- Buscador de regalos: edad, gustos (construir, imaginar, moverse, descubrir) y presupuesto; propone hasta tres juguetes y, si no hay nada en ese presupuesto, enseña los más cercanos
- Montaje automático del catálogo, las combinaciones, los transportistas, el envoltorio, el cupón y el pago desde el propio módulo
- Lista para conectar Redsys, Bizum o Stripe cuando sea una tienda real

## Cómo instalarlo
1. PrestaShop 9 con el tema Hummingbird.
2. Copia `modulo/peques` en la carpeta `modules/` e instálalo desde el panel.
3. El controlador de montaje solo funciona mientras exista un archivo de claves en la instalación, y se elimina al terminar.

Tipografías de Google Fonts con licencia SIL Open Font License, incluidas en `modulo/peques/views/fonts`.

## Sobre esta tienda
Diseño y desarrollo de [Dania360](https://dania360.com). Es una tienda de ejemplo: la marca y los productos son inventados, las fotos se crearon para la marca y el pago es de prueba, no cobra nada. El código se publica para enseñar cómo está hecha; no tiene licencia de uso.

Más tiendas en el portafolio: https://tiendas.dania360.com
