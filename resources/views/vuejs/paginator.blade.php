@extends('layouts.default')
@section('styles')
<style>
.vuetable th.sortable:hover {
    color: #2185d0;
    cursor: pointer;
}
.vuetable-actions {
    width: 11%;
    padding: 12px 0px;
    text-align: center;
}
.vuetable-actions > button {
  padding: 3px 6px;
  margin-right: 4px;
}
.vuetable-pagination {
}
.vuetable-pagination-info {
    float: left;
    margin-top: auto;
    margin-bottom: auto;
}
.vuetable-pagination-component {
  float: right;
}
.vuetable-pagination-component .pagination {
  margin: 0px;
}
.vuetable-pagination-component .pagination .btn {
    cursor: pointer;
    margin: 2px;
}
.highlight {
    background-color: yellow;
}
</style>
@stop
@section('content')
<h4>Paginator using vue-table : <a href="https://github.com/ratiw/vue-table">https://github.com/ratiw/vue-table</a><h4>
<div class="container" id="app">
  <vuetable api-url="/api/employees"
            :fields="columns"
            pagination-path=""
            pagination-class=""
            pagination-info-class=""
            pagination-component-class=""
            table-class="table table-bordered table-striped table-hover"
            ascending-icon="glyphicon glyphicon-chevron-up"
            descending-icon="glyphicon glyphicon-chevron-down"
            wrapper-class="vuetable-wrapper "
            table-wrapper=".vuetable-wrapper"
            loading-class="loading">
  </vuetable>
</div>
@stop
@section('scripts')
  <script>
  new Vue({
    el: '#app',
    data: {
      columns: [
        'first_name',
        'last_name',
        'email'
      ],
      paginationComponent: 'vuetable-pagination',
    },
    methods: {
      paginationConfig: function(componentName) {
        console.log('paginationConfig: ', componentName)
        if (componentName == 'vuetable-pagination') {
          this.$broadcast('vuetable-pagination:set-options', {
            wrapperClass: 'pagination',
            icons: { first: '', prev: '', next: '', last: ''},
            activeClass: 'active',
            linkClass: 'btn btn-default',
            pageClass: 'btn btn-default'
          })
        }
        if (componentName == 'vuetable-pagination-dropdown') {
          this.$broadcast('vuetable-pagination:set-options', {
            wrapperClass: 'form-inline',
            icons: { prev: 'glyphicon glyphicon-chevron-left', next: 'glyphicon glyphicon-chevron-right' },
            dropdownClass: 'form-control'
          })
        }
      }
    }
  });
  </script>
@stop
