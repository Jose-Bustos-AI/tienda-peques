{**
 * Portada de la tienda de ejemplo Peques.
 *}
<div class="peques-portada">

  <section class="peq-hero" aria-labelledby="peq-hero-titulo">
    <img class="peq-hero__img" src="{$peques_ruta}views/img/portada.jpg" alt="Habitación infantil luminosa con juguetes de madera sobre una alfombra" width="1920" height="1072" fetchpriority="high">
    <div class="peq-hero__velo" aria-hidden="true"></div>
    <div class="peq-hero__in">
      <p class="peq-ceja">Juguetes de madera y educativos · Murcia</p>
      <h1 id="peq-hero-titulo" class="peq-hero__titulo">Juguetes que <em>duran</em> más que la infancia.</h1>
      <p class="peq-hero__texto">Madera, algodón y colores suaves. Juguetes sencillos que dejan sitio a la imaginación y pasan de hermano a hermano. ¿Buscas un regalo? Te ayudamos a acertar.</p>
      <div class="peq-botones">
        <a class="peq-btn" href="#regalos">Encuentra el regalo</a>
        <a class="peq-btn peq-btn--linea" href="{$peques_tienda}">Ver los juguetes</a>
      </div>
      <ul class="peq-hero__datos">
        <li><span class="peq-bola peq-bola--coral"></span>Envuelto para regalo por {$peques_envoltorio}</li>
        <li><span class="peq-bola peq-bola--mostaza"></span>Envío gratis desde 40 €</li>
        <li><span class="peq-bola peq-bola--menta"></span>Edad recomendada en cada juguete</li>
      </ul>
    </div>
  </section>

  <section class="peq-buscador" id="regalos" aria-labelledby="peq-bus-titulo">
    <div class="peq-buscador__in">
      <div class="peq-buscador__cab">
        <p class="peq-ceja peq-ceja--oscura">Buscador de regalos</p>
        <h2 class="peq-titulo" id="peq-bus-titulo">¿Para quién es <em>el regalo?</em></h2>
        <p>Dinos su edad, qué le gusta y cuánto quieres gastar. Te proponemos los juguetes que mejor le van.</p>
      </div>
      <form class="peq-buscador__form" data-peques-buscador onsubmit="return false">
        <fieldset>
          <legend>Edad</legend>
          <div class="peq-chips">
            <label><input type="radio" name="edad" value="0-0"><span>Bebé (menos de 1)</span></label>
            <label><input type="radio" name="edad" value="1-2" checked><span>1 a 2 años</span></label>
            <label><input type="radio" name="edad" value="3-5"><span>3 a 5 años</span></label>
            <label><input type="radio" name="edad" value="6-12"><span>6 años o más</span></label>
          </div>
        </fieldset>
        <fieldset>
          <legend>Le encanta</legend>
          <div class="peq-chips">
            <label><input type="radio" name="gusto" value="todo" checked><span>De todo</span></label>
            {foreach $peques_gustos as $clave => $nombre}
              <label><input type="radio" name="gusto" value="{$clave}"><span>{$nombre}</span></label>
            {/foreach}
          </div>
        </fieldset>
        <fieldset>
          <legend>Presupuesto</legend>
          <div class="peq-chips">
            <label><input type="radio" name="presupuesto" value="25"><span>Hasta 25 €</span></label>
            <label><input type="radio" name="presupuesto" value="50"><span>Hasta 50 €</span></label>
            <label><input type="radio" name="presupuesto" value="0" checked><span>Me da igual</span></label>
          </div>
        </fieldset>
      </form>
      <div class="peq-resultado" aria-live="polite" data-peques-resultado></div>
      <p class="peq-buscador__nota">Al finalizar la compra puedes pedir que lo envolvamos para regalo por {$peques_envoltorio} y añadir un mensaje.</p>
    </div>
    <script type="application/json" data-peques-datos>{$peques_buscador nofilter}</script>
  </section>

  {if $peques_categorias}
  <section class="peq-bloque">
    <div class="peq-bloque__cab">
      <div><p class="peq-ceja peq-ceja--oscura">Por tipo de juego</p><h2 class="peq-titulo">¿A qué <em>jugamos?</em></h2></div>
    </div>
    <div class="peq-categorias">
      {foreach $peques_categorias as $cat}
        <a class="peq-categoria peq-revela" href="{$cat.url}">
          <span class="peq-categoria__foto"><img src="{$cat.img}" alt="" loading="lazy" width="1000" height="1000"></span>
          <span class="peq-categoria__txt"><b>{$cat.nombre}</b><small>{$cat.texto}</small></span>
        </a>
      {/foreach}
    </div>
  </section>
  {/if}

  <section class="peq-bloque peq-bloque--productos">
    <div class="peq-bloque__cab">
      <div><p class="peq-ceja peq-ceja--oscura">Los que más regalamos</p><h2 class="peq-titulo">Favoritos de <em>la casa</em></h2></div>
      <a class="peq-enlace" href="{$peques_tienda}">Ver todos →</a>
    </div>
    {$peques_destacados nofilter}
  </section>

  <section class="peq-historia">
    <div class="peq-historia__foto peq-revela"><img src="{$peques_ruta}views/img/taller.jpg" alt="Manos de un artesano lijando una pieza de un juguete de madera en su taller" loading="lazy" width="928" height="1152"></div>
    <div class="peq-historia__texto peq-revela">
      <p class="peq-ceja peq-ceja--oscura">Quiénes somos</p>
      <h2 class="peq-titulo">Menos pilas, <em>más imaginación.</em></h2>
      <p>Peques nace en Murcia de dos maestras de infantil cansadas de juguetes que se rompen en una semana o que lo hacen todo solos. Buscamos talleres pequeños que trabajan la madera y el algodón con cariño.</p>
      <p>Cada juguete de la tienda lo hemos probado en clase: si no aguanta a veinte niños, no entra.</p>
      <div class="peq-cupon">
        <span>Tu primera compra</span>
        <b>10 %</b>
        <span>con el código <strong>BIENVENIDA10</strong></span>
      </div>
    </div>
  </section>
</div>
