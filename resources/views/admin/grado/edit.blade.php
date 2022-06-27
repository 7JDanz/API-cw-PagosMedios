@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.grado.actions.edit', ['name' => $grado->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <grado-form
                :action="'{{ $grado->resource_url }}'"
                :data="{{ $grado->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.grado.actions.edit', ['name' => $grado->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.grado.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </grado-form>

        </div>
    
</div>

@endsection