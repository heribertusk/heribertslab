<html>
<head>
  <title>Dynamic Table with Vuejs</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
  <a href="/"><< Back to Home</a>
  <div class="container">
    <h1>Dynamic Table with vuejs</h1>
    <a href="http://am2studio.hr/blog/creating-dynamic-table-with-vue-js/">Ref : http://am2studio.hr/blog/creating-dynamic-table-with-vue-js/</a>
      <div class="panel-body" id="app">
        <table class="table table-hover">
          <thead>
            <tr>
              <th style="width: 20px;">No.</th>
              <th>Description</th>
              <th style="width: 80px;">Qty</th>
              <th style="width: 130px;" class="text-right">Price</th>
              <th style="width: 90px;">Tax</th>
              <th style="width: 130px;">Total</th>
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
                <input class="form-control" v-model="row.description"/>
              </td>
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
                <input class="form-control text-right" :value="row.qty * row.price | currencyDisplay" v-model="row.total | currencyDisplay" number readonly />
                <input type="hidden" :value="row.qty * row.price * row.tax / 100" v-model="row.tax_amount | currencyDisplay" number/>
              </td>
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

  <!--javascript-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.4.2/Sortable.min.js" type="text/javascript"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.27/vue.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.0/vue-resource.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/accounting.js/0.4.1/accounting.min.js" type="text/javascript"></script>
  <script>
  Vue.filter('currencyDisplay', {
    // model -> view
    read: function (val) {
      if (val > 0) {
        return accounting.formatMoney(val, "Rp.", 0, ".", ",");
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

  var vm = new Vue({
    el: '#app',
    data: {
      rows: [
        //initial data
        {qty: 3, description: "Something", price: 1500000, tax: 10},
        {qty: 2, description: "Something else", price: 35000, tax: 0},
      ],
      total: 0,
      grandtotal: 0,
      taxtotal: 0,
      delivery: 28000
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
</body>
</html>
