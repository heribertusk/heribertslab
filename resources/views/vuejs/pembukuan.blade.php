@extends('layouts.default')
@section('styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/app.css')}}">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker3.standalone.min.css">
@stop
@section('content')
  <div class="container">
    <h1>Contoh Pembukuan</h1>
    <div class="panel-body" id="app">
      <table class="table table-hover">
        <thead>
          <tr>
            <th style="width: 20px;">No.</th>
            <th style="width: 60px;">Project</th>
            <th style="width: 80px;">Activity</th>
            <th style="width: 50px;">Kode Akun</th>
            <th style="width: 100px;">Tanggal 1</th>
            <th style="width: 100px;">Tanggal 2</th>
            <th style="width: 90px;">Tipe</th>
            <th style="width: 130px;"></th>
          </tr>
        </thead>
        <tbody v-sortable.tr="rows">
          <button class="btn btn-primary btn-xs" @click="addRow(rows.length-1)">add row</button>
          <tr v-for="row in rows" track-by="$index">
            <td>
              @{{ $index +1 }}
            </td>
            <td>
              <select v-model="row.selected_project_id" id="project">
                <option v-for="item in projects" v-bind:value="item.id">
                  @{{ item.name }}
                </option>
              </select>
            </td>
            <td>
              <select v-model="row.selected_activity_id" id="activity">
                <option v-for="item in activities | filterBy row.selected_project_id in 'project_id'" v-bind:value="item.id">
                  @{{ item.name }}
                </option>
              </select>
            </td>
            <td>
              <select v-select="row.kode_akun_id" :options="account_codes" style="width: 400px; height: 1em;">
              </select>
            </td>
            <td>
              <datepicker :value.sync="row.startDate"></datepicker>
            </td>
            <td>
              <datepicker :value.sync="row.endDate"></datepicker>
            </td>
            <!--
            <td>
              <input class="form-control" v-model="row.qty" number/>
            </td>
            <td>
              <input class="form-control text-right" v-model="row.price | currencyDisplay" number data-type="currency"/>
            </td>
            <td>
              <select class="form-control" v-model="row.tax">
                <option value="0">0%</option>
                <option value="10">10%</option>
                <option value="20">20%</option>
              </select>
            </td>
            <td>
              <select class="form-control" v-model="row.tipe">
                <option value="D">Debet</option>
                <option value="K">Kredit</option>
              </select>
            </td>
            <td>
              <input class="form-control text-right" :value="row.qty * row.price | currencyDisplay" v-model="row.total | currencyDisplay" number readonly />
              <input type="hidden" :value="row.qty * row.price * row.tax / 100" v-model="row.tax_amount | currencyDisplay" number/>
            </td>
            -->
            <td>
              <button class="btn btn-primary btn-xs" @click="addRow($index)">add row</button>
              <button class="btn btn-danger btn-xs" @click="removeRow($index)">remove row</button>
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="5" class="text-right">TAX</td>
            <td colspan="1" class="text-right">@{{ taxtotal | currencyDisplay }}</td>
            <td></td>
          </tr>
          <tr>
            <td colspan="5" class="text-right">TOTAL</td>
            <td colspan="1" class="text-right">@{{ total | currencyDisplay }}</td>
            <td></td>
          </tr>
          <tr>
            <td colspan="5" class="text-right">DELIVERY</td>
            <td colspan="1" class="text-right"><input class="form-control text-right" v-model="delivery | currencyDisplay" number/></td>
            <td></td>
          </tr>
          <tr>
            <td colspan="5" class="text-right"><strong>GRANDTOTAL</strong></td>
            <td colspan="1" class="text-right"><strong>@{{ grandtotal = total + delivery | currencyDisplay }}</strong></td>
            <td></td>
          </tr>
        </tfoot>
      </table>
      <button @click="getData()">SUBMIT DATA</button>
      <pre>@{{ $data | json }}</pre>
    </div>
  </div>
@stop
@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.4.2/Sortable.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/accounting.js/0.4.1/accounting.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js"></script>
  <script>
  Vue.filter('currencyDisplay', {
    // model -> view
    read: function (val) {
      if (val > 0) {
        return accounting.formatMoney(val, "$", 2, ".", ",");
      }
    },
    // view -> model
    write: function (val, oldVal) {
      return accounting.unformat(val, ",");
    }
  });

  Vue.directive('sortable', {
    twoWay: true,
    deep: true,
    bind: function () {
      var that = this;

      var options = {
        draggable: Object.keys(this.modifiers)[0]
      };

      this.sortable = Sortable.create(this.el, options);
      console.log('sortable bound!')

      this.sortable.option("onUpdate", function (e) {
        that.value.splice(e.newIndex, 0, that.value.splice(e.oldIndex, 1)[0]);
      });

      this.onUpdate = function(value) {
        that.value = value;
      }
    },
    update: function (value) {
      this.onUpdate(value);
    }
  });

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
        format: 'yyyy-mm-dd',
        autoclose: true
      });
    }
  });

  Vue.component('datepicker', datepickerComponent);

  Vue.directive('select', {
    twoWay: true,
    priority: 1000,

    params: ['options'],

    bind: function() {
      var self = this
      $(this.el)
      .select2({
        data: this.params.options
      })
      .on('change', function() {
        self.set(this.value)
      })
    },
    update: function(value) {
      $(this.el).val(value).trigger('change')
    },
    unbind: function() {
      $(this.el).off().select2('destroy')
    }
  });

  var vm = new Vue({
    el: '#app',
    data: {
      rows: [],
      total: 0,
      grandtotal: 0,
      taxtotal: 0,
      delivery: 0,
      projects: [],
      activities: [],
      account_codes: [],
      options: [
        { id: 1, text: 'Hello' },
        { id: 2, text: 'World' }
      ]
    },
    ready: function() {
      this.initCategories();
    },
    computed: {
      total: function () {
        var t = 0;
        $.each(this.rows, function (i, e) {
          t += accounting.unformat(e.total, ",");
        });
        return t;
      },
      taxtotal: function () {
        var tt = 0;
        $.each(this.rows, function (i, e) {
          tt += accounting.unformat(e.tax_amount, ",");
        });
        return tt;
      }
    },
    methods: {
      addRow: function (index) {
        try {
          this.rows.splice(index + 1, 0, {});
        } catch(e)
        {
          console.log(e);
        }
      },
      removeRow: function (index) {
        this.rows.splice(index, 1);
      },
      initCategories: function() {
        // GET /someUrl
        this.$http.get('/api/projects').then((response) => {
          // success callback
          this.$set('projects', response.data.projects)
        }, (response) => {
          // error callback
        });
        this.$http.get('/api/activities').then((response) => {
          // success callback
          this.$set('activities', response.data.activities)
        }, (response) => {
          // error callback
        });
        this.$http.get('/api/account_codes').then((response) => {
          // success callback
          this.$set('account_codes', response.data.account_codes)
        }, (response) => {
          // error callback
        });
      },
      getData: function () {
        $.ajax({
          context: this,
          type: "POST",
          data: {
            rows: this.rows,
            total: this.total,
            delivery: this.delivery,
            taxtotal: this.taxtotal,
            grandtotal: this.grandtotal,
          },
          url: "/api/data"
        });
      }
    }
  });
  </script>
@stop
