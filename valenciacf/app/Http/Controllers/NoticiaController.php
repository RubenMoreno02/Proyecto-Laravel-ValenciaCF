<?php
namespace App\Http\Controllers;

class NoticiaController extends Controller
{
    private function todasLasNoticias(): array
    {
        return [
            [
                'id' => 1,
                'titulo' => 'Hugo Duro renueva hasta 2028',
                'subtitulo' => 'El delantero valenciano amplía su vinculación con el club tras una gran primera vuelta de temporada',
                'categoria' => 'Club',
                'fecha' => '2026-02-10',
                'imagen' => 'https://placehold.co/800x420/1a1a1a/FF6600?text=Hugo+Duro+Renovación',
                'destacada' => true,
                'cuerpo' => 'El Valencia CF y Hugo Duro han alcanzado un acuerdo para renovar el contrato del delantero hasta junio de 2028. El ariete valenciano, pieza fundamental del esquema de Rubén Baraja, ha firmado su renovación en un acto celebrado en las instalaciones del club.

Hugo Duro llegó al Valencia CF en el verano de 2021 y desde entonces no ha dejado de crecer. Esta temporada 2025/26 está siendo su mejor campaña como profesional, con goles importantes en Liga y Copa del Rey.

El propio jugador ha declarado: "Estoy muy feliz de continuar en mi casa. Este club y esta afición me lo dan todo, y yo quiero devolverlo dentro del campo."

La renovación es una apuesta clara del club por el talento local y por construir un proyecto sólido de cara a los próximos años.',
                'autor' => 'Redacción VCF',
                'tags' => ['Renovación', 'Hugo Duro', 'Primera Plantilla'],
            ],
            [
                'id' => 2,
                'titulo' => 'Pepelu, nominado al Once de la semana de LaLiga',
                'subtitulo' => 'El centrocampista suma su tercera nominación en la temporada 25/26',
                'categoria' => 'LaLiga',
                'fecha' => '2026-02-03',
                'imagen' => 'https://placehold.co/800x420/FF6600/ffffff?text=Pepelu',
                'destacada' => true,
                'cuerpo' => 'Pepelu vuelve a ser reconocido por LaLiga tras una actuación sobresaliente en el último partido disputado. El mediocentro ha sido nominado al Once de la Semana por tercera vez en la presente temporada, consolidándose como uno de los mejores pivotes del campeonato.

El centrocampista valenciano, formado en las categorías inferiores del club, ha dado un salto de calidad enorme esta temporada. Su capacidad de recuperación, su visión de juego y su llegada al área han sido determinantes para el equipo.

LaLiga destacó en su nota oficial que Pepelu "ha vuelto a demostrar por qué es uno de los centrocampistas más completos del campeonato", valorando especialmente su rendimiento defensivo y su participación en la creación de juego.',
                'autor' => 'LaLiga Press',
                'tags' => ['Pepelu', 'LaLiga', 'Once de la Semana'],
            ],
            [
                'id' => 3,
                'titulo' => 'Mestalla, sold out frente al Real Madrid',
                'subtitulo' => 'Las 49.430 entradas para el partido del 26 de octubre se agotaron en tiempo récord',
                'categoria' => 'Mestalla',
                'fecha' => '2025-10-20',
                'imagen' => 'https://placehold.co/800x420/111111/FF6600?text=Mestalla+Lleno',
                'destacada' => false,
                'cuerpo' => 'El estadio de Mestalla colgará el cartel de "No hay entradas" para el partido de LaLiga contra el Real Madrid. Las localidades se agotaron en menos de 24 horas desde que salieron a la venta, confirmando que el Valencia CF vive un momento especial con su afición.

El duelo ante los madridistas siempre es uno de los más esperados del año. Con la rivalidad histórica entre ambos clubes y la posición competitiva del equipo en la tabla, la expectación era máxima.

Desde el club han pedido a los aficionados que eviten los accesos a las puertas del estadio sin entrada para evitar problemas logísticos. El partido comenzará a las 21:00h y podrá seguirse también en directo por DAZN.',
                'autor' => 'Comunicación VCF',
                'tags' => ['Mestalla', 'Real Madrid', 'Entradas'],
            ],
            [
                'id' => 4,
                'titulo' => 'Mosquera convocado con la Selección Sub-21',
                'subtitulo' => 'El central del Valencia CF entra en la lista de Santi Denia para los próximos compromisos',
                'categoria' => 'Selección',
                'fecha' => '2025-10-01',
                'imagen' => 'https://placehold.co/800x420/cc0000/ffffff?text=Mosquera+Sub21',
                'destacada' => false,
                'cuerpo' => 'Cristhian Mosquera ha recibido una nueva convocatoria con la Selección Española Sub-21. El defensa central del Valencia CF, uno de los jugadores más destacados de la categoría, continúa siendo un fijo en los planes del seleccionador Santi Denia.

Mosquera, formado en la cantera del Valencia CF, ha dado el salto definitivo al primer equipo esta temporada y sus actuaciones han llamado la atención de los técnicos de la federación. Con tan solo 21 años, ya acumula varias convocatorias con la absoluta española y se perfila como uno de los grandes centrales del fútbol español del futuro.

Los compromisos de la Sub-21 se disputarán en las próximas semanas, por lo que el jugador podría perderse algún partido de Liga con su club.',
                'autor' => 'Redacción VCF',
                'tags' => ['Mosquera', 'Selección', 'Sub-21'],
            ],
            [
                'id' => 5,
                'titulo' => 'Análisis táctico: cómo Baraja plantea el 4-4-2 en Mestalla',
                'subtitulo' => 'La solidez defensiva del equipo, clave en los partidos en casa esta temporada',
                'categoria' => 'Análisis',
                'fecha' => '2025-12-05',
                'imagen' => 'https://placehold.co/800x420/1a1a1a/ffffff?text=Análisis+Táctico',
                'destacada' => false,
                'cuerpo' => 'El equipo de Rubén Baraja ha construido una identidad táctica muy clara a lo largo de esta temporada 2025/26: presión alta, transiciones rápidas y una sólida organización defensiva. Mestalla se ha convertido en un verdadero fortín.

El 4-4-2 que propone Baraja tiene como pilares fundamentales la dupla Pepelu-André Almeida en el centro del campo, que ejerce un control total del juego. Por las bandas, Sergi Canós y Javi Guerra aportan velocidad y desborde.

En ataque, la pareja Hugo Duro-Dani Gómez ha funcionado de maravilla: Duro como referencia y pivot, y Gómez como segundo delantero móvil que genera espacios y llegadas.

Defensivamente, la línea de cuatro con Mosquera y Özkacar de centrales ha sido la más sólida de los últimos años, con Mamardashvili como muro infranqueable bajo los palos.',
                'autor' => 'Análisis Técnico VCF',
                'tags' => ['Táctica', 'Baraja', 'Análisis'],
            ],
            [
                'id' => 6,
                'titulo' => 'El Valencia CF alcanza los 50 puntos en Liga',
                'subtitulo' => 'Victoria ante el Athletic Club que mantiene al equipo en puestos europeos',
                'categoria' => 'LaLiga',
                'fecha' => '2026-04-06',
                'imagen' => 'https://placehold.co/800x420/FF6600/ffffff?text=50+Puntos+LaLiga',
                'destacada' => true,
                'cuerpo' => 'El Valencia CF suma tres puntos vitales en Mestalla ante el Athletic Club de Bilbao y alcanza los 50 puntos en LaLiga. El equipo mantiene su posición en zona europea a falta de diez jornadas para el final de la temporada.

El partido fue un duelo de alta intensidad entre dos equipos que luchan por los mismos objetivos. El Valencia CF aprovechó la solidez de Mestalla para imponer su juego y conseguir una victoria trabajada y merecida.

El técnico Rubén Baraja declaró tras el partido: "Cincuenta puntos es un número muy importante. Hemos trabajado mucho para llegar aquí y el equipo merece este reconocimiento. Pero no nos podemos relajar, porque quedan muchas jornadas y el objetivo está claro."

El próximo partido del Valencia CF será el domingo ante el Real Madrid en el Santiago Bernabéu, uno de los retos más difíciles de lo que resta de temporada.',
                'autor' => 'Redacción VCF',
                'tags' => ['LaLiga', '50 puntos', 'Athletic Club'],
            ],
        ];
    }

    public function index()
    {
        $noticias = collect($this->todasLasNoticias());
        $destacadas = $noticias->where('destacada', true)->take(3)->values();
        $resto = $noticias->where('destacada', false)->values();
        return view('noticias.index', compact('noticias', 'destacadas', 'resto'));
    }

    public function show($id)
    {
        $noticias = collect($this->todasLasNoticias());
        $noticia = $noticias->firstWhere('id', (int)$id);
        if (!$noticia) abort(404);

        $relacionadas = $noticias
            ->where('id', '!=', $noticia['id'])
            ->where('categoria', $noticia['categoria'])
            ->take(3)
            ->values();

        if ($relacionadas->isEmpty()) {
            $relacionadas = $noticias->where('id','!=',$noticia['id'])->take(3)->values();
        }

        return view('noticias.show', compact('noticia', 'relacionadas'));
    }
}