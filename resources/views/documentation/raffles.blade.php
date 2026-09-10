<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Guía de rifas · {{ config('dashboard.APP_NAME') }}</title>
    <style>
        :root { color-scheme: light; font-family: system-ui, -apple-system, sans-serif; color: #243447; background: #f1f5f9; line-height: 1.65; }
        * { box-sizing: border-box; }
        body { margin: 0; }
        a { color: #075985; text-underline-offset: 3px; }
        a:hover { color: #0c4a6e; }
        a:focus-visible { outline: 3px solid #0284c7; outline-offset: 4px; }
        .skip { position: absolute; top: -100px; left: 1rem; background: white; padding: .5rem; }
        .skip:focus { top: 1rem; }
        .wrap { max-width: 1080px; margin: auto; padding: 2rem 1.25rem 3rem; }
        .topbar, .actions { display: flex; flex-wrap: wrap; align-items: center; gap: .75rem 1.5rem; }
        .topbar { justify-content: space-between; font-size: .9rem; }
        .brand { font-weight: 700; }
        header { padding: 2.5rem 0 2rem; max-width: 760px; }
        .eyebrow { color: #0369a1; font-size: .8rem; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; }
        h1 { font-size: clamp(2rem, 5vw, 3.2rem); line-height: 1.15; letter-spacing: -.035em; margin: .6rem 0 1rem; color: #0f172a; }
        header p { font-size: 1.1rem; }
        .layout { display: grid; grid-template-columns: 220px minmax(0, 1fr); gap: 2rem; align-items: start; }
        .toc { position: sticky; top: 1.5rem; font-size: .95rem; }
        .toc h2 { margin: 0 0 .75rem; font-size: 1rem; }
        .toc a { display: block; padding: .4rem 0; }
        section { background: white; border: 1px solid #dbe3ec; border-radius: 12px; padding: 1.75rem; margin-bottom: 1.25rem; scroll-margin-top: 1rem; }
        h2 { font-size: 1.4rem; line-height: 1.3; color: #0f172a; margin: 0 0 1rem; }
        h3 { font-size: 1.05rem; color: #0f172a; margin: 1.4rem 0 .5rem; }
        p { margin: .6rem 0 1rem; }
        ul, ol { padding-left: 1.4rem; margin: .75rem 0 1rem; }
        li { padding-left: .2rem; margin: .55rem 0; }
        .note { border-left: 3px solid #0284c7; background: #f0f9ff; padding: .8rem 1rem; margin: 1.2rem 0; }
        .attention { border-color: #b45309; background: #fffbeb; }
        .note p { margin: 0; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: .95rem; }
        caption { text-align: left; font-weight: 600; padding-bottom: .75rem; }
        th, td { text-align: left; vertical-align: top; padding: .75rem; border-bottom: 1px solid #e2e8f0; }
        th { background: #f8fafc; color: #0f172a; }
        .muted, footer { color: #526174; font-size: .9rem; }
        footer { padding-top: 1rem; }
        @media (max-width: 760px) {
            .layout { grid-template-columns: 1fr; gap: 1.25rem; }
            .toc { position: static; background: #e2e8f0; padding: 1rem; border-radius: 10px; }
            section { padding: 1.25rem; }
            header { padding: 1.75rem 0 1rem; }
        }
        @media print {
            :root { background: white; font-size: 10pt; }
            .wrap { max-width: none; padding: 0; }
            .topbar, .toc, .actions, .skip, footer { display: none; }
            .layout { display: block; }
            header { padding: 0 0 1rem; }
            h1 { font-size: 26pt; }
            section { border: 0; border-radius: 0; padding: 0 0 1rem; }
            h2, h3 { break-after: avoid; }
            tr, .note { break-inside: avoid; }
            .table-wrap { overflow: visible; }
            a { color: inherit; text-decoration: none; }
        }
    </style>
</head>
<body>
<a class="skip" href="#contenido">Ir al contenido</a>
<div class="wrap">
    <div class="topbar">
        <span class="brand">{{ config('dashboard.APP_NAME') }} · Centro de ayuda</span>
        <a href="{{ url('/') }}">Volver al sistema</a>
    </div>
    <header>
        <span class="eyebrow">Guía de uso</span>
        <h1>Rifas y boletos</h1>
        <p>Una venta que cumple los requisitos recibe un boleto al azar. Aquí puedes consultar cómo se asigna, qué hacer si faltó el teléfono y cómo administrar los números.</p>
        <nav class="actions" aria-label="Accesos a rifas">
            <a href="{{ route('raffles.index') }}">Lista de rifas</a>
            <a href="{{ route('raffle-numbers.index') }}">Boletos de rifa</a>
            <a href="{{ route('raffle-assginaments.assign-by-saleable.create') }}">Asignar boleto</a>
        </nav>
        <p class="muted">Las acciones disponibles dependen de tus permisos y de la sucursal seleccionada.</p>
    </header>
    <div class="layout">
        <nav class="toc" aria-label="Contenido de la guía">
            <h2>En esta guía</h2>
            <a href="#requisitos">1. Cuándo participa una venta</a>
            <a href="#vender">2. Al realizar una venta</a>
            <a href="#asignar">3. Asignar después de vender</a>
            <a href="#consultar">4. Consultar e imprimir</a>
            <a href="#telefono">5. Corregir el teléfono</a>
            <a href="#liberar">6. Liberar un boleto</a>
            <a href="#administrar">7. Crear y finalizar rifas</a>
            <a href="#dudas">8. Resolver dudas</a>
        </nav>
        <main id="contenido">
            <section id="requisitos">
                <h2>1. ¿Cuándo participa una venta?</h2>
                <p>Las mismas condiciones aplican a la <strong>venta Express</strong> (rápida, identificada como «Expres» en algunas pantallas) y a la <strong>venta Stock</strong> (productos inventariados). Deben cumplirse todas:</p>
                <ul>
                    <li>Hay una rifa <strong>activa y vigente en ese momento</strong> para la sucursal de la venta.</li>
                    <li>La <strong>fecha de creación de la venta</strong> está entre el inicio y el fin de esa rifa.</li>
                    <li>El total de la venta es <strong>igual o mayor al importe mínimo</strong> de la rifa.</li>
                    <li>La venta tiene guardado el <strong>teléfono del cliente</strong>.</li>
                    <li>La venta está <strong>completada</strong>; una venta pendiente todavía no participa.</li>
                    <li>La venta <strong>no tiene otro boleto asignado</strong>.</li>
                    <li>Quedan <strong>boletos disponibles</strong>.</li>
                </ul>
                <div class="note"><p>Se asigna <strong>un boleto por venta</strong>, elegido al azar entre los disponibles. Comprar más artículos o duplicar el monto mínimo no da boletos adicionales en la misma venta.</p></div>
                <div class="table-wrap">
                    <table>
                        <caption>Ejemplo: una rifa con compra mínima de $500</caption>
                        <thead><tr><th scope="col">Total de la venta</th><th scope="col">¿Recibe boleto?</th></tr></thead>
                        <tbody>
                            <tr><td>$499</td><td>No alcanza el mínimo.</td></tr>
                            <tr><td>$500</td><td>Sí, un boleto si cumple las demás condiciones.</td></tr>
                            <tr><td>$1,500</td><td>Sí, un boleto si cumple las demás condiciones.</td></tr>
                        </tbody>
                    </table>
                </div>
            </section>
            <section id="vender">
                <h2>2. Al realizar una venta</h2>
                <ol>
                    <li>Verifica que estás trabajando en la sucursal correcta.</li>
                    <li>Captura la venta Express o Stock como de costumbre.</li>
                    <li>Si aparece el campo de teléfono para la rifa, pide el número al cliente y comprueba que esté bien escrito.</li>
                    <li>Completa el proceso de venta y, si corresponde, su autorización.</li>
                    <li>Consulta el comprobante de la venta: cuando se asignó un boleto, aparece el nombre de la rifa y <strong>«Boleto de rifa asignado»</strong> con su número.</li>
                </ol>
                <p>Confirma el número asignado antes de comunicarlo al cliente. Si no aparece, revisa los requisitos y la lista de boletos.</p>
            </section>
            <section id="asignar">
                <h2>3. ¿La venta se hizo sin teléfono?</h2>
                <p>Utiliza <strong>Rifas → Asignar boleto</strong> para registrar el teléfono en una venta que ya existe e intentar asignarle un número.</p>
                <ol>
                    <li>Selecciona la misma sucursal en la que se hizo la venta.</li>
                    <li>Abre <a href="{{ route('raffle-assginaments.assign-by-saleable.create') }}">Asignar boleto</a>.</li>
                    <li>Escribe el <strong>Número de teléfono</strong> del cliente.</li>
                    <li>En <strong>Nota</strong>, escribe el número de la venta que aparece como «Nota #» en su comprobante. No es el número del boleto de rifa.</li>
                    <li>En <strong>Tipo de venta</strong>, selecciona <strong>Expres</strong> o <strong>Stock</strong>, según el comprobante.</li>
                    <li>Pulsa <strong>Guardar</strong>. Si procede, verás la confirmación y se abrirá el boleto en PDF en otra pestaña.</li>
                </ol>
                <div class="note"><p>La asignación manual también elige el número al azar y exige <strong>todos los requisitos</strong>. Debe hacerse mientras la rifa siga activa y vigente, aunque la venta se haya realizado dentro del periodo.</p></div>
                <p>El teléfono se guarda en la venta antes de intentar asignar el boleto. Si después aparece un aviso de que la venta no participa, el teléfono puede haber quedado guardado; eso no significa que ya tenga boleto.</p>
                <p>Si ya existe un boleto, consulta el asignado. Para corregir su teléfono, sigue el apartado 5.</p>
            </section>
            <section id="consultar">
                <h2>4. Consultar e imprimir boletos</h2>
                <ol>
                    <li>Entra a <strong>Rifas → Boletos de rifa</strong>.</li>
                    <li>Selecciona la rifa que quieres revisar. Al entrar se muestran los boletos de la más reciente de tu sucursal, que puede estar finalizada.</li>
                    <li>Usa <strong>Todos</strong>, <strong>Disponibles</strong> o <strong>Asignados</strong> para filtrar.</li>
                    <li>Busca por número de boleto, número de nota o teléfono del cliente.</li>
                    <li>Comprueba el estado, teléfono, tipo de venta y nota de la fila encontrada.</li>
                </ol>
                <p><strong>DISPONIBLE:</strong> el número está libre. <strong>ASIGNADO:</strong> el número está vinculado a una venta.</p>
                <h3>Comprobantes</h3>
                <p>La asignación manual abre el boleto en PDF. Usa la opción de impresión del visor. Si el navegador bloquea la pestaña, permite las ventanas emergentes del sistema y consulta primero si el boleto ya se asignó.</p>
                <p>También puedes volver a abrir el comprobante de la venta desde su listado: incluye el número de rifa cuando la venta está completada y conserva un boleto asignado.</p>
            </section>
            <section id="telefono">
                <h2>5. Corregir el teléfono de un boleto</h2>
                <ol>
                    <li>Localiza el boleto en <strong>Boletos de rifa</strong>.</li>
                    <li>En esa fila, pulsa el <strong>icono de editar (lápiz)</strong>.</li>
                    <li>Verifica el tipo de venta y la nota que aparecen en el formulario.</li>
                    <li>Corrige el teléfono y pulsa <strong>Guardar</strong>.</li>
                </ol>
                <p>Esta acción actualiza el teléfono de la venta vinculada y <strong>conserva el mismo boleto</strong>. El teléfono es obligatorio y admite hasta 20 caracteres.</p>
                <p>Solo aplica a boletos asignados y requiere permiso para actualizarlos.</p>
            </section>
            <section id="liberar">
                <h2>6. Dejar libre un boleto</h2>
                <p>Liberar un boleto quita su vínculo con la venta y lo devuelve a los números disponibles de su rifa.</p>
                <ol>
                    <li>Busca el boleto en <strong>Boletos de rifa</strong>.</li>
                    <li>Comprueba su número, teléfono, tipo de venta y nota.</li>
                    <li>Pulsa el <strong>botón gris con el signo menos (−)</strong>.</li>
                    <li>Comprueba que ahora aparezca como <strong>DISPONIBLE</strong>. Si usabas el filtro «Asignados», búscalo en «Disponibles».</li>
                </ol>
                <div class="note attention"><p>El botón libera el boleto <strong>directamente, sin una confirmación adicional</strong>. La venta pierde ese número y, si la rifa sigue vigente, el número puede asignarse a otra venta.</p></div>
                <p>Liberarlo no cancela la venta ni borra su teléfono. Tampoco reabre una rifa finalizada. Si la venta vuelve a cumplir todos los requisitos, puedes usar <strong>Asignar boleto</strong>; el nuevo número puede ser distinto.</p>
                <p>Esta acción requiere el permiso específico para liberar boletos.</p>
            </section>
            <section id="administrar">
                <h2>7. Crear y finalizar rifas</h2>
                <h3>Crear una rifa</h3>
                <p>Con los permisos correspondientes, entra a <strong>Rifas → Crear Rifa</strong> y completa:</p>
                <ul>
                    <li><strong>Inventarios:</strong> la sucursal que participará.</li>
                    <li><strong>Nombre y descripción:</strong> identifica la rifa y explica sus detalles.</li>
                    <li><strong>Total importe:</strong> el monto mínimo que debe alcanzar cada venta para participar.</li>
                    <li><strong>Número total de boletos:</strong> cuántos números tendrá la rifa.</li>
                    <li><strong>Fecha de inicio y Fecha de fin:</strong> el periodo de participación. El fin debe ser posterior al inicio.</li>
                </ul>
                <p>Pulsa <strong>Guardar</strong>. Los números se preparan en segundo plano; comprueba que aparezcan disponibles antes de comenzar a ofrecer boletos. Si no aparecen, solicita apoyo al administrador.</p>
                <p>El sistema impide registrar otra rifa activa para la misma sucursal. Revisa la existente en <strong>Lista de rifas</strong>.</p>
                <div class="note attention"><p><strong>Atención al último día:</strong> actualmente las fechas capturadas se toman a las 00:00. Si eliges el 30 de septiembre como fin, las ventas realizadas más tarde ese día quedan fuera. Para incluir todo el día 30, configura el 1 de octubre como fecha de fin.</p></div>
                <p>Se revisa la fecha en que se creó la venta. Una venta iniciada antes del periodo no participa por el solo hecho de completarla durante la rifa.</p>
                <h3>Editar y finalizar</h3>
                <p>En <strong>Lista de rifas</strong>, el lápiz permite editar los datos. La cantidad total de boletos está deshabilitada al editar.</p>
                <p>El <strong>icono rojo de papelera</strong> finaliza la rifa directamente: cambia su estado a <strong>finished</strong> (finalizada) y deja de asignar boletos. La rifa y sus números se conservan para consulta.</p>
                <p>El estado <strong>active</strong> significa activa, pero también deben cumplirse las fechas. Al agotarse los boletos, la rifa se finaliza automáticamente. Una rifa vencida deja de admitir asignaciones aunque su estado todavía aparezca activo.</p>
                <p>Finalizar la rifa no elige un ganador. Estas pantallas administran la participación y los boletos.</p>
            </section>
            <section id="dudas">
                <h2>8. Si no se asigna el boleto</h2>
                <div class="table-wrap">
                    <table>
                        <caption>Mensajes y qué revisar</caption>
                        <thead><tr><th scope="col">Mensaje o situación</th><th scope="col">Qué hacer</th></tr></thead>
                        <tbody>
                            <tr><td>«No hay rifas activas.»</td><td>Revisa la sucursal, el estado y las fechas de la rifa. Debe estar vigente al intentar asignar.</td></tr>
                            <tr><td>«La rifa está fuera de la fecha actual.»</td><td>Comprueba que la fecha de creación de la venta esté dentro del inicio y fin de la rifa.</td></tr>
                            <tr><td>La venta no tiene teléfono.</td><td>Usa «Asignar boleto» con el teléfono, la nota y el tipo de venta correctos.</td></tr>
                            <tr><td>El total es inferior al mínimo.</td><td>Revisa el total de esa venta. No se suman varias notas para alcanzar el mínimo.</td></tr>
                            <tr><td>«La venta no está completada.»</td><td>Revisa su estado y termina el proceso habitual de venta o autorización.</td></tr>
                            <tr><td>La venta ya tiene un boleto.</td><td>Busca el número asignado en «Boletos de rifa»; la misma venta no recibe un segundo boleto.</td></tr>
                            <tr><td>La nota no existe o no pertenece al inventario actual.</td><td>Verifica «Nota #», el tipo Expres/Stock y la sucursal. El mismo número puede existir en ambos tipos de venta.</td></tr>
                            <tr><td>«Boletos agotados para la rifa.»</td><td>No quedan números disponibles. Consulta al responsable de la rifa.</td></tr>
                            <tr><td>«Problema de concurrencia, vuelva a intentarlo.»</td><td>Coincidieron varias asignaciones. Consulta si la venta ya tiene boleto y, si no lo tiene, vuelve a intentar.</td></tr>
                            <tr><td>No puedes acceder o realizar una acción.</td><td>Solicita al administrador que revise tus permisos y la sucursal seleccionada.</td></tr>
                        </tbody>
                    </table>
                </div>
                <h3>¿Un cliente puede tener varios boletos?</h3>
                <p>Sí, si corresponden a ventas distintas y cada una cumple los requisitos. El límite es un boleto asignado por venta; el teléfono no limita al cliente a un solo boleto.</p>
                <h3>¿Puedo elegir un número específico?</h3>
                <p>No. Tanto al vender como al asignar después, el sistema escoge un número disponible al azar.</p>
                <h3>¿Puedo asignar después de que termine la rifa?</h3>
                <p>No. Haber comprado durante el periodo no permite asignar un boleto cuando la rifa ya finalizó o venció.</p>
            </section>
        </main>
    </div>
    <footer>Para imprimir o guardar esta guía como PDF, utiliza la opción Imprimir del navegador (Ctrl + P o ⌘ + P).</footer>
</div>
</body>
</html>
