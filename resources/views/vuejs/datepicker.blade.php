@extends('layouts.default')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/app.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker3.standalone.min.css">
@stop

@section('content')
<div id="app">
  <datepicker :value.sync="startDate"></datepicker>
</div>
@stop

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js"></script>
<script>
  var datepickerComponent = Vue.extend({
  //v-el:select
  template: '<div class="input-group date" v-el:inputgroup>' +
    '<input type="text" class="form-control" v-model="value" style="width:100px">'+
    '<span class="input-group-addon">'+
    '<i class="glyphicon glyphicon-calendar"></i></span>' +
    '</div>',
  props: {
    value: null
  },
  data: function() {
    return {};
  },
  ready: function() {
    $(this.$els.inputgroup).datepicker({
      format: 'yyyy/mm/dd',
      autoclose: true
    });
  }
});
Vue.component('datepicker', datepickerComponent);

new Vue({
  el: '#app',
  data: {
    startDate: '2016/10/13',
  },
  ready: function() {},
  methods: {},
  watch: {
    startDate: function() {
    	alert("DATA: " + this.startDate);
    }
  }
});
</script>
@stop
