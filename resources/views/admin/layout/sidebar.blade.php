<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.content') }}</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/modulos') }}"><i class="nav-icon icon-globe"></i> {{ trans('admin.modulo.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/statuses') }}"><i class="nav-icon icon-compass"></i> {{ trans('admin.status.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/tipo-documentos') }}"><i class="nav-icon icon-diamond"></i> {{ trans('admin.tipo-documento.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/grados') }}"><i class="nav-icon icon-book-open"></i> {{ trans('admin.grado.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/personas') }}"><i class="nav-icon icon-diamond"></i> {{ trans('admin.persona.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/conceptos') }}"><i class="nav-icon icon-graduation"></i> {{ trans('admin.concepto.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/descuentos') }}"><i class="nav-icon icon-drop"></i> {{ trans('admin.descuento.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/matriculas') }}"><i class="nav-icon icon-ghost"></i> {{ trans('admin.matricula.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/mes') }}"><i class="nav-icon icon-ghost"></i> {{ trans('admin.me.title') }}</a></li>
           {{-- Do not delete me :) I'm used for auto-generation menu items --}}

            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.settings') }}</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/admin-users') }}"><i class="nav-icon icon-user"></i> {{ __('Manage access') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/translations') }}"><i class="nav-icon icon-location-pin"></i> {{ __('Translations') }}</a></li>
            {{-- Do not delete me :) I'm also used for auto-generation menu items --}}
            {{--<li class="nav-item"><a class="nav-link" href="{{ url('admin/configuration') }}"><i class="nav-icon icon-settings"></i> {{ __('Configuration') }}</a></li>--}}
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
