<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.vinyl.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input required pattern="^([^!@#$%^&+*./\<>;:`~-]|[A-Za-z0-9]*([ ][^!@#$%^&+*./\<>;:`~-]|[A-Za-z0-9]*)*)$"  type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.vinyl.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('author'), 'has-success': fields.author && fields.author.valid }">
    <label for="author" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.vinyl.columns.author') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input required pattern="^([A-Za-z]*([0-9]*)?)*((([,][ ])|[-]|[ ])[A-Za-z]*([0-9]*)?)?([ ][&][ ][A-Za-z]*([0-9]*)?)?$" type="text" v-model="form.author" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('author'), 'form-control-success': fields.author && fields.author.valid}" id="author" name="author" placeholder="{{ trans('admin.vinyl.columns.author') }}">
        <div v-if="errors.has('author')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('author') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('year'), 'has-success': fields.year && fields.year.valid }">
    <label for="year" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.vinyl.columns.year') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input required pattern="[0-2]{1}[0-9]{3}" type="text" v-model="form.year" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('year'), 'form-control-success': fields.year && fields.year.valid}" id="year" name="year" placeholder="{{ trans('admin.vinyl.columns.year') }}">
        <div v-if="errors.has('year')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('year') }}</div>
    </div>
</div>


