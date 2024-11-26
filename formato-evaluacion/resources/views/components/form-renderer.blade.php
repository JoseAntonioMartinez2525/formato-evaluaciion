@props(['forms'])

{{-- Iteramos sobre los formularios --}}
@foreach ($forms as $form)
    {{-- Solo una página si startPage y endPage son iguales --}}
    @if ($form['startPage'] === $form['endPage'])
        <div>
            <p>Página {{ $form['startPage'] }} de {{ $form['endPage'] }}</p>
        </div>
    @else
        {{-- Varias páginas si los valores son diferentes --}}
        @for ($page = $form['startPage']; $page <= $form['endPage']; $page++)
            <div>
                <p>Página {{ $page }} de {{ $form['endPage'] }}</p>
            </div>
        @endfor
    @endif
@endforeach