<div class="form-group row align-items-center" :class="{'has-danger': errors.has('descripcion'), 'has-success': fields.descripcion && fields.descripcion.valid }">
    <label for="descripcion" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.status.columns.descripcion') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.descripcion" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('descripcion'), 'form-control-success': fields.descripcion && fields.descripcion.valid}" id="descripcion" name="descripcion" placeholder="{{ trans('admin.status.columns.descripcion') }}">
        <div v-if="errors.has('descripcion')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('descripcion') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('modulo_id'), 'has-success': fields.modulo_id && fields.modulo_id.valid }">
    <label for="modulo_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.status.columns.modulo_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.modulo_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('modulo_id'), 'form-control-success': fields.modulo_id && fields.modulo_id.valid}" id="modulo_id" name="modulo_id" placeholder="{{ trans('admin.status.columns.modulo_id') }}">
        <div v-if="errors.has('modulo_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('modulo_id') }}</div>
    </div>
</div>


