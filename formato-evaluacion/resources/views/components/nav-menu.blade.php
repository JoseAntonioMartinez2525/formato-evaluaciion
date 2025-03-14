{{-- filepath: resources/views/components/nav-menu.blade.php --}}
@props(['user'])

<section role="region" aria-label="Response form">
    <form class="printButtonClass">
        @csrf
        <nav class="nav flex-column" style="padding-top: 50px; height: 900px; background: linear-gradient(90deg, #afc7ce, #4281a4);" id="navPrint">
            <div class="nav-header" style="display: flex; align-items: center; padding-top: 50px;">
                <li class="nav-item">
                    <a class="nav-link disabled enlaceSN" style="font-size: medium; color: white;" href="#">
                        <i class="fa-solid fa-user" style="color: white;"></i>&nbsp&nbsp&nbsp&nbsp{{ $user->email }}
                    </a>
                </li>
                <li style="list-style: none; margin-right: 20px;">
                    <a class="enlaceSN" title="cerrar_sesion" href="{{ route('login') }}">
                        <i class="fas fa-power-off" style="font-size: 24px; color: white;"></i>
                    </a>
                </li>
            </div><br>
            <div>
                <ul style="list-style: none;"">
                    <li class="nav-item">
                        <a class="nav-link active enlaceSN" aria-current="page" style="width: 200px;" href="{{ route('rules') }}" title="Reglamento deacuerdo al artículo 10 de PEDPD"><i class="fas fa-book"></i>&nbspReglamento</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active enlaceSN" style="width: 200px;" href="{{ route('resumen') }}" title="A ser llenado por la Comisión del PEDPD""><i class="fas fa-list"></i>&nbspResumen</a>
                    </li><br>
                    <li id="jsonDataLink" class="d-none">
                        <a class="nav-link active enlaceSN" style="width: 200px;" href="{{ route('general') }}" title="Mostrar datos de
                            los Usuarios"><i class="fas fa-users"></i>&nbspUsuarios</a>
                    </li>
                    <li id="reportLink" class="nav-item d-none">
                        <a class="nav-link active enlaceSN" style="width: 200px;" href="{{ route('perfil') }}"><i class="fas fa-chart-bar"></i>Mostrar
                            Reporte</a>
                    </li>
                    <li class="nav-item">
                        @if($user->user_type === 'dictaminador')
                            <a class="nav-link active enlaceSN" style="width: 200px;"
                                href="{{ route('comision_dictaminadora') }}"><i class="fa-regular fa-folder-open"></i>&nbspSelección de Formatos</a>
                        @else
                            <a class="nav-link active enlaceSN" style="width: 200px;" href="{{ route('secretaria') }}"><i class="fa-regular fa-folder-open"></i>&nbspSelección de
                                Formatos</a>
                        @endif
                    </li>
                </ul>
            </div>
        </nav>
    </form>
</section>