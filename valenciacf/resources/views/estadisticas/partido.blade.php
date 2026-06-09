@extends('layouts.app')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <a href="{{ route('partidos.show', $partido) }}" class="text-muted text-decoration-none small">
            ← Volver al partido
        </a>
        <h2 class="mt-1 mb-0">Estadísticas · VCF vs {{ $partido->rival }}</h2>
        <span class="text-muted small">
            {{ $partido->fecha->format('d/m/Y') }} ·
            {{ $partido->goles_favor }}–{{ $partido->goles_contra }} ·
            {{ $partido->competicion }}
        </span>
    </div>
</div>

<form method="POST" action="{{ route('admin.estadisticas.update', $partido) }}" id="formStats">
@csrf @method('PUT')

<div class="card shadow-sm border-0 mb-3">
    <div class="card-header card-header-vcf-dark d-flex justify-content-between align-items-center">
        <span>👥 Participación de jugadores</span>
        <button type="button" id="btnAddJugador" class="btn btn-sm btn-vcf">+ Añadir jugador</button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" id="tablaStats">
            <thead>
                <tr>
                    <th style="min-width:200px">Jugador</th>
                    <th class="text-center">Titular</th>
                    <th class="text-center" style="min-width:70px">Min</th>
                    <th class="text-center">⚽</th>
                    <th class="text-center">🅰️</th>
                    <th class="text-center">🟨</th>
                    <th class="text-center">🟥</th>
                    <th class="text-center">F.Com</th>
                    <th class="text-center">F.Rec</th>
                    <th class="text-center">🧤</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="filasJugadores">

            {{-- Filas existentes --}}
            @php $i = 0; @endphp
            @foreach($jugadores as $jugador)
                @if(isset($existentes[$jugador->id]))
                @php $e = $existentes[$jugador->id]; @endphp
                <tr class="fila-jugador">
                    <td>
                        <input type="hidden" name="jugadores[{{ $i }}][jugador_id]" value="{{ $jugador->id }}">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge-dorsal">{{ $jugador->dorsal }}</span>
                            <div>
                                <div class="fw-bold small">{{ $jugador->nombre }}</div>
                                <div class="text-muted" style="font-size:.7rem">{{ $jugador->posicion }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <input type="checkbox" name="jugadores[{{ $i }}][titular]"
                               class="form-check-input" value="1"
                               {{ $e->titular ? 'checked' : '' }}>
                    </td>
                    <td><input type="number" name="jugadores[{{ $i }}][minutos_jugados]"
                               class="form-control form-control-sm text-center"
                               value="{{ $e->minutos_jugados }}" min="0" max="120" style="width:65px"></td>
                    <td><input type="number" name="jugadores[{{ $i }}][goles]"
                               class="form-control form-control-sm text-center"
                               value="{{ $e->goles }}" min="0" style="width:55px"></td>
                    <td><input type="number" name="jugadores[{{ $i }}][asistencias]"
                               class="form-control form-control-sm text-center"
                               value="{{ $e->asistencias }}" min="0" style="width:55px"></td>
                    <td><input type="number" name="jugadores[{{ $i }}][amarillas]"
                               class="form-control form-control-sm text-center"
                               value="{{ $e->amarillas }}" min="0" max="2" style="width:55px"></td>
                    <td><input type="number" name="jugadores[{{ $i }}][rojas]"
                               class="form-control form-control-sm text-center"
                               value="{{ $e->rojas }}" min="0" max="1" style="width:55px"></td>
                    <td><input type="number" name="jugadores[{{ $i }}][faltas_cometidas]"
                               class="form-control form-control-sm text-center"
                               value="{{ $e->faltas_cometidas }}" min="0" style="width:55px"></td>
                    <td><input type="number" name="jugadores[{{ $i }}][faltas_recibidas]"
                               class="form-control form-control-sm text-center"
                               value="{{ $e->faltas_recibidas }}" min="0" style="width:55px"></td>
                    <td class="text-center">
                        <input type="checkbox" name="jugadores[{{ $i }}][portero_imbatido]"
                               class="form-check-input" value="1"
                               {{ $e->portero_imbatido ? 'checked' : '' }}
                               {{ $jugador->posicion !== 'Portero' ? 'disabled' : '' }}>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-danger btn-eliminar-fila">✕</button>
                    </td>
                </tr>
                @php $i++; @endphp
                @endif
            @endforeach

            </tbody>
        </table>
        </div>
    </div>
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-vcf btn-lg">💾 Guardar estadísticas</button>
    <a href="{{ route('partidos.show', $partido) }}" class="btn btn-outline-secondary btn-lg">Cancelar</a>
</div>

</form>

{{-- MODAL para añadir jugador --}}
<div class="modal fade" id="modalJugador" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow" style="border-top:3px solid var(--vcf-naranja) !important;border-radius:16px;">
            <div class="modal-header" style="background:#111;color:white;border-radius:13px 13px 0 0;">
                <h5 class="modal-title">Añadir jugador al partido</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-2" id="listaJugadoresModal">
                    @foreach($jugadores as $jugador)
                        <div class="col-md-4 jugador-modal-item" data-id="{{ $jugador->id }}"
                             data-nombre="{{ $jugador->nombre }}" data-dorsal="{{ $jugador->dorsal }}"
                             data-posicion="{{ $jugador->posicion }}">
                            <div class="card border-0 shadow-sm jugador-seleccionable"
                                 style="cursor:pointer;transition:all .2s;border-radius:10px">
                                <div class="card-body py-2 px-3 d-flex align-items-center gap-2">
                                    <span class="badge-dorsal">{{ $jugador->dorsal }}</span>
                                    <div>
                                        <div class="fw-bold small">{{ $jugador->nombre }}</div>
                                        <div class="text-muted" style="font-size:.7rem">{{ $jugador->posicion }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let filaIndex = {{ $i }};

// Obtener jugadores ya en la tabla
function jugadoresEnTabla() {
    return [...document.querySelectorAll('#filasJugadores input[name$="[jugador_id]"]')]
           .map(el => el.value);
}

// Abrir modal
document.getElementById('btnAddJugador').addEventListener('click', () => {
    const enTabla = jugadoresEnTabla();
    document.querySelectorAll('.jugador-modal-item').forEach(item => {
        item.style.display = enTabla.includes(item.dataset.id) ? 'none' : 'block';
    });
    new bootstrap.Modal(document.getElementById('modalJugador')).show();
});

// Seleccionar jugador del modal
document.querySelectorAll('.jugador-seleccionable').forEach(card => {
    card.addEventListener('click', function() {
        const item  = this.closest('.jugador-modal-item');
        const id    = item.dataset.id;
        const nombre  = item.dataset.nombre;
        const dorsal  = item.dataset.dorsal;
        const posicion = item.dataset.posicion;
        const esPortero = posicion === 'Portero';

        const fila = `
        <tr class="fila-jugador">
            <td>
                <input type="hidden" name="jugadores[${filaIndex}][jugador_id]" value="${id}">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge-dorsal">${dorsal}</span>
                    <div>
                        <div class="fw-bold small">${nombre}</div>
                        <div class="text-muted" style="font-size:.7rem">${posicion}</div>
                    </div>
                </div>
            </td>
            <td class="text-center">
                <input type="checkbox" name="jugadores[${filaIndex}][titular]"
                       class="form-check-input" value="1">
            </td>
            <td><input type="number" name="jugadores[${filaIndex}][minutos_jugados]"
                       class="form-control form-control-sm text-center"
                       value="90" min="0" max="120" style="width:65px"></td>
            <td><input type="number" name="jugadores[${filaIndex}][goles]"
                       class="form-control form-control-sm text-center"
                       value="0" min="0" style="width:55px"></td>
            <td><input type="number" name="jugadores[${filaIndex}][asistencias]"
                       class="form-control form-control-sm text-center"
                       value="0" min="0" style="width:55px"></td>
            <td><input type="number" name="jugadores[${filaIndex}][amarillas]"
                       class="form-control form-control-sm text-center"
                       value="0" min="0" max="2" style="width:55px"></td>
            <td><input type="number" name="jugadores[${filaIndex}][rojas]"
                       class="form-control form-control-sm text-center"
                       value="0" min="0" max="1" style="width:55px"></td>
            <td><input type="number" name="jugadores[${filaIndex}][faltas_cometidas]"
                       class="form-control form-control-sm text-center"
                       value="0" min="0" style="width:55px"></td>
            <td><input type="number" name="jugadores[${filaIndex}][faltas_recibidas]"
                       class="form-control form-control-sm text-center"
                       value="0" min="0" style="width:55px"></td>
            <td class="text-center">
                <input type="checkbox" name="jugadores[${filaIndex}][portero_imbatido]"
                       class="form-check-input" value="1"
                       ${!esPortero ? 'disabled' : ''}>
            </td>
            <td>
                <button type="button" class="btn btn-sm btn-outline-danger btn-eliminar-fila">✕</button>
            </td>
        </tr>`;

        document.getElementById('filasJugadores').insertAdjacentHTML('beforeend', fila);
        filaIndex++;

        // Registrar botón eliminar en la nueva fila
        const filas = document.querySelectorAll('.btn-eliminar-fila');
        filas[filas.length - 1].addEventListener('click', function() {
            this.closest('tr').remove();
        });

        bootstrap.Modal.getInstance(document.getElementById('modalJugador')).hide();
    });
});

// Botones eliminar fila existentes al cargar
document.querySelectorAll('.btn-eliminar-fila').forEach(btn => {
    btn.addEventListener('click', function() {
        this.closest('tr').remove();
    });
});
</script>

@endsection