<div class="form-group row align-items-center" :class="{'has-danger': errors.has('apellidos'), 'has-success': fields.apellidos && fields.apellidos.valid }">
    <label for="apellidos" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.persona.columns.apellidos') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.apellidos" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('apellidos'), 'form-control-success': fields.apellidos && fields.apellidos.valid}" id="apellidos" name="apellidos" placeholder="{{ trans('admin.persona.columns.apellidos') }}">
        <div v-if="errors.has('apellidos')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('apellidos') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('direccion'), 'has-success': fields.direccion && fields.direccion.valid }">
    <label for="direccion" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.persona.columns.direccion') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.direccion" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('direccion'), 'form-control-success': fields.direccion && fields.direccion.valid}" id="direccion" name="direccion" placeholder="{{ trans('admin.persona.columns.direccion') }}">
        <div v-if="errors.has('direccion')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('direccion') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('email'), 'has-success': fields.email && fields.email.valid }">
    <label for="email" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.persona.columns.email') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.email" v-validate="'email'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('email'), 'form-control-success': fields.email && fields.email.valid}" id="email" name="email" placeholder="{{ trans('admin.persona.columns.email') }}">
        <div v-if="errors.has('email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('email') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('identificacion'), 'has-success': fields.identificacion && fields.identificacion.valid }">
    <label for="identificacion" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.persona.columns.identificacion') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.identificacion" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('identificacion'), 'form-control-success': fields.identificacion && fields.identificacion.valid}" id="identificacion" name="identificacion" placeholder="{{ trans('admin.persona.columns.identificacion') }}">
        <div v-if="errors.has('identificacion')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('identificacion') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('nombres'), 'has-success': fields.nombres && fields.nombres.valid }">
    <label for="nombres" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.persona.columns.nombres') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.nombres" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('nombres'), 'form-control-success': fields.nombres && fields.nombres.valid}" id="nombres" name="nombres" placeholder="{{ trans('admin.persona.columns.nombres') }}">
        <div v-if="errors.has('nombres')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('nombres') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('representante_persona_id'), 'has-success': fields.representante_persona_id && fields.representante_persona_id.valid }">
    <label for="representante_persona_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.persona.columns.representante_persona_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.representante_persona_id" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('representante_persona_id'), 'form-control-success': fields.representante_persona_id && fields.representante_persona_id.valid}" id="representante_persona_id" name="representante_persona_id" placeholder="{{ trans('admin.persona.columns.representante_persona_id') }}">
        <div v-if="errors.has('representante_persona_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('representante_persona_id') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('status'), 'has-success': fields.status && fields.status.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="status" type="checkbox" v-model="form.status" v-validate="''" data-vv-name="status"  name="status_fake_element">
        <label class="form-check-label" for="status">
            {{ trans('admin.persona.columns.status') }}
        </label>
        <input type="hidden" name="status" :value="form.status">
        <div v-if="errors.has('status')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('status') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('telefono'), 'has-success': fields.telefono && fields.telefono.valid }">
    <label for="telefono" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.persona.columns.telefono') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.telefono" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('telefono'), 'form-control-success': fields.telefono && fields.telefono.valid}" id="telefono" name="telefono" placeholder="{{ trans('admin.persona.columns.telefono') }}">
        <div v-if="errors.has('telefono')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('telefono') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('tipo_documento_id'), 'has-success': fields.tipo_documento_id && fields.tipo_documento_id.valid }">
    <label for="tipo_documento_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.persona.columns.tipo_documento_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.tipo_documento_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('tipo_documento_id'), 'form-control-success': fields.tipo_documento_id && fields.tipo_documento_id.valid}" id="tipo_documento_id" name="tipo_documento_id" placeholder="{{ trans('admin.persona.columns.tipo_documento_id') }}">
        <div v-if="errors.has('tipo_documento_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('tipo_documento_id') }}</div>
    </div>
</div>


