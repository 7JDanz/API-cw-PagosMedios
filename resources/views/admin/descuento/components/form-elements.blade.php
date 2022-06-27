<div class="form-group row align-items-center" :class="{'has-danger': errors.has('descripcion'), 'has-success': fields.descripcion && fields.descripcion.valid }">
    <label for="descripcion" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.descuento.columns.descripcion') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.descripcion" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('descripcion'), 'form-control-success': fields.descripcion && fields.descripcion.valid}" id="descripcion" name="descripcion" placeholder="{{ trans('admin.descuento.columns.descripcion') }}">
        <div v-if="errors.has('descripcion')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('descripcion') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('grado_id'), 'has-success': fields.grado_id && fields.grado_id.valid }">
    <label for="grado_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.descuento.columns.grado_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.grado_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('grado_id'), 'form-control-success': fields.grado_id && fields.grado_id.valid}" id="grado_id" name="grado_id" placeholder="{{ trans('admin.descuento.columns.grado_id') }}">
        <div v-if="errors.has('grado_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('grado_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('max'), 'has-success': fields.max && fields.max.valid }">
    <label for="max" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.descuento.columns.max') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.max" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('max'), 'form-control-success': fields.max && fields.max.valid}" id="max" name="max" placeholder="{{ trans('admin.descuento.columns.max') }}">
        <div v-if="errors.has('max')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('max') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('min'), 'has-success': fields.min && fields.min.valid }">
    <label for="min" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.descuento.columns.min') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.min" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('min'), 'form-control-success': fields.min && fields.min.valid}" id="min" name="min" placeholder="{{ trans('admin.descuento.columns.min') }}">
        <div v-if="errors.has('min')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('min') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('status'), 'has-success': fields.status && fields.status.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="status" type="checkbox" v-model="form.status" v-validate="''" data-vv-name="status"  name="status_fake_element">
        <label class="form-check-label" for="status">
            {{ trans('admin.descuento.columns.status') }}
        </label>
        <input type="hidden" name="status" :value="form.status">
        <div v-if="errors.has('status')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('status') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('valor'), 'has-success': fields.valor && fields.valor.valid }">
    <label for="valor" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.descuento.columns.valor') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.valor" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('valor'), 'form-control-success': fields.valor && fields.valor.valid}" id="valor" name="valor" placeholder="{{ trans('admin.descuento.columns.valor') }}">
        <div v-if="errors.has('valor')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('valor') }}</div>
    </div>
</div>


