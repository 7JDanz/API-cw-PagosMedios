<div class="form-group row align-items-center" :class="{'has-danger': errors.has('fecha_fin'), 'has-success': fields.fecha_fin && fields.fecha_fin.valid }">
    <label for="fecha_fin" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.matricula.columns.fecha_fin') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.fecha_fin" :config="datetimePickerConfig" v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('fecha_fin'), 'form-control-success': fields.fecha_fin && fields.fecha_fin.valid}" id="fecha_fin" name="fecha_fin" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_date_and_time') }}"></datetime>
        </div>
        <div v-if="errors.has('fecha_fin')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('fecha_fin') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('fecha_inicio'), 'has-success': fields.fecha_inicio && fields.fecha_inicio.valid }">
    <label for="fecha_inicio" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.matricula.columns.fecha_inicio') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.fecha_inicio" :config="datetimePickerConfig" v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('fecha_inicio'), 'form-control-success': fields.fecha_inicio && fields.fecha_inicio.valid}" id="fecha_inicio" name="fecha_inicio" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_date_and_time') }}"></datetime>
        </div>
        <div v-if="errors.has('fecha_inicio')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('fecha_inicio') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('grado_id'), 'has-success': fields.grado_id && fields.grado_id.valid }">
    <label for="grado_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.matricula.columns.grado_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.grado_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('grado_id'), 'form-control-success': fields.grado_id && fields.grado_id.valid}" id="grado_id" name="grado_id" placeholder="{{ trans('admin.matricula.columns.grado_id') }}">
        <div v-if="errors.has('grado_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('grado_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('persona_id'), 'has-success': fields.persona_id && fields.persona_id.valid }">
    <label for="persona_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.matricula.columns.persona_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.persona_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('persona_id'), 'form-control-success': fields.persona_id && fields.persona_id.valid}" id="persona_id" name="persona_id" placeholder="{{ trans('admin.matricula.columns.persona_id') }}">
        <div v-if="errors.has('persona_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('persona_id') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('status'), 'has-success': fields.status && fields.status.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="status" type="checkbox" v-model="form.status" v-validate="''" data-vv-name="status"  name="status_fake_element">
        <label class="form-check-label" for="status">
            {{ trans('admin.matricula.columns.status') }}
        </label>
        <input type="hidden" name="status" :value="form.status">
        <div v-if="errors.has('status')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('status') }}</div>
    </div>
</div>


