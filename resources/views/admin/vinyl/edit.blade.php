@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.vinyl.actions.edit', ['name' => $vinyl->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <vinyl-form
                :action="'{{ $vinyl->resource_url }}'"
                :data="{{ $vinyl->toJson() }}"
                v-cloak
                inline-template>

                <form class="form-horizontal form-edit" method="get" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.vinyl.actions.edit', ['name' => $vinyl->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.vinyl.components.form-elements')
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>

                </form>

        </vinyl-form>

        </div>

</div>

@endsection
