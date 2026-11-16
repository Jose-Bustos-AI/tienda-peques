/* Peques: buscador de regalos, animaciones y textos de PrestaShop en español. */
(function () {
	var reducir = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	// Aparición suave al hacer scroll.
	var revela = document.querySelectorAll('.peq-revela');
	if (reducir || !('IntersectionObserver' in window)) {
		revela.forEach(function (el) { el.classList.add('visto'); });
	} else {
		var obs = new IntersectionObserver(function (es) {
			es.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('visto'); obs.unobserve(e.target); } });
		}, { rootMargin: '0px 0px -8% 0px' });
		revela.forEach(function (el, i) { el.style.transitionDelay = (i % 4) * 90 + 'ms'; obs.observe(el); });
	}

	// Buscador de regalos: edad, gustos y presupuesto.
	var form = document.querySelector('[data-peques-buscador]');
	var caja = document.querySelector('[data-peques-resultado]');
	var fuente = document.querySelector('[data-peques-datos]');
	if (form && caja && fuente) {
		var juguetes = [];
		try { juguetes = JSON.parse(fuente.textContent) || []; } catch (e) {}
		var esc = function (s) { return String(s).replace(/[&<>"]/g, function (c) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c]; }); };
		var valor = function (n) { var r = form.querySelector('[name=' + n + ']:checked'); return r ? r.value : ''; };

		function tarjeta(j, i) {
			return '<a class="peq-regalo" href="' + esc(j.url) + '" style="--i:' + i + '">' +
				'<span class="peq-regalo__foto"><img src="' + esc(j.img) + '" alt="" width="300" height="300" loading="lazy"><span class="peq-regalo__edad">' + esc(j.edadTexto) + '</span></span>' +
				'<span class="peq-regalo__txt"><b>' + esc(j.nombre) + '</b><small>' + esc(j.corta.split('. ')[0]) + '.</small>' +
				'<span class="peq-regalo__pie"><em>' + (j.antes ? '<del>' + esc(j.antes) + '</del> ' : '') + esc(j.precio) + '</em><strong>Ver el juguete →</strong></span></span></a>';
		}

		function calcular() {
			var rango = valor('edad').split('-').map(Number), gusto = valor('gusto'), tope = parseFloat(valor('presupuesto'));
			var porEdad = juguetes.filter(function (j) { return j.edad[0] <= rango[1] && j.edad[1] >= rango[0]; });
			var conGusto = gusto === 'todo' ? porEdad : porEdad.filter(function (j) { return j.gustos.indexOf(gusto) !== -1; });
			var nota = '';
			var lista = conGusto.filter(function (j) { return !tope || j.valor <= tope; });
			if (!lista.length && conGusto.length) {
				lista = conGusto.slice().sort(function (a, b) { return a.valor - b.valor; });
				nota = 'No tenemos nada por debajo de ' + tope + ' € para esa edad y ese gusto. Estas son las opciones más cercanas:';
			}
			if (!lista.length) {
				lista = porEdad;
				nota = 'Para esa edad no tenemos juguetes de ese tipo, pero estos les encantan:';
			}
			// Primero los que encajan justo con su edad; luego, los más baratos.
			lista = lista.slice().sort(function (a, b) {
				var da = Math.abs(a.edad[0] - rango[0]), db = Math.abs(b.edad[0] - rango[0]);
				return da - db || a.valor - b.valor;
			}).slice(0, 3);
			caja.innerHTML = (nota ? '<p class="peq-resultado__nota">' + esc(nota) + '</p>' : '<p class="peq-resultado__nota">' + (lista.length === 1 ? 'Te proponemos este juguete:' : 'Te proponemos estos ' + lista.length + ' juguetes:') + '</p>') +
				'<div class="peq-regalos">' + lista.map(tarjeta).join('') + '</div>';
			caja.classList.remove('entra'); void caja.offsetWidth; caja.classList.add('entra');
		}
		form.addEventListener('change', calcular);
		calcular();
	}

	// Carrito: cuánto falta para el envío gratis.
	var rejilla = document.querySelector('body#cart .cart-grid');
	if (rejilla && window.prestashop) {
		var GRATIS = 40;
		var euros = function (n) { return n.toFixed(2).replace('.', ',') + ' €'; };
		var barra = document.createElement('div');
		barra.className = 'peq-envio';
		barra.hidden = true;
		barra.innerHTML = '<p class="peq-envio__texto" aria-live="polite"></p><div class="peq-envio__pista" aria-hidden="true"><span></span></div>';
		rejilla.parentNode.insertBefore(barra, rejilla);
		var textoEnvio = barra.querySelector('.peq-envio__texto'), relleno = barra.querySelector('.peq-envio__pista span');
		var pintarEnvio = function (carrito) {
			var s = carrito && carrito.subtotals;
			if (!s || !s.products || !carrito.products_count) { barra.hidden = true; return; }
			var total = s.products.amount - (s.discounts ? Math.abs(s.discounts.amount) : 0);
			var falta = GRATIS - total;
			barra.hidden = false;
			barra.classList.toggle('peq-envio--hecho', falta <= 0);
			textoEnvio.textContent = falta > 0 ? 'Te faltan ' + euros(falta) + ' para el envío gratis.' : 'Ya tienes el envío estándar gratis.';
			relleno.style.width = Math.max(4, Math.min(100, total / GRATIS * 100)) + '%';
		};
		pintarEnvio(prestashop.cart);
		if (prestashop.on) {
			prestashop.on('updatedCart', function (e) {
				if (e && e.resp && e.resp.cart) pintarEnvio(e.resp.cart);
			});
		}
	}

	// Textos que la traducción de PrestaShop deja en inglés o suenan raros.
	var CAMBIOS = [
		['Back to ', 'Volver a '], ['Continue to ', 'Continuar a '], ['Next: ', 'Siguiente: '], ['Ahorre un ', 'Ahorras '], ['Quiero mi pedido sea envuelto', 'Quiero que mi pedido sea envuelto'],
		['The personal data you provide is used to answer queries, process orders or allow access to specific information. You have the right to modify and delete all the personal information found in the "My Account" page.',
			'Usamos tus datos para responder a tus consultas, gestionar tus pedidos o darte acceso a información concreta. Puedes modificarlos o borrarlos cuando quieras desde "Mi cuenta".']
	];
	function traducir(raiz) {
		var it = document.createTreeWalker(raiz || document.body, NodeFilter.SHOW_TEXT);
		var n;
		while ((n = it.nextNode())) {
			var t = n.nodeValue, nuevo = t;
			CAMBIOS.forEach(function (c) { if (nuevo.indexOf(c[0]) !== -1) nuevo = nuevo.split(c[0]).join(c[1]); });
			if (nuevo !== t) n.nodeValue = nuevo;
		}
	}
	traducir();
	new MutationObserver(function (cambios) {
		cambios.forEach(function (c) { c.addedNodes.forEach(function (nodo) { if (nodo.nodeType === 1) traducir(nodo); else if (nodo.nodeType === 3 && nodo.parentNode) traducir(nodo.parentNode); }); });
	}).observe(document.body, { childList: true, subtree: true });
})();
