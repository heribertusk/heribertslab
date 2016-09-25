<html>
<head>
  <title>Test Vuejs</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
      <div class="panel-body" id="app">
        <table class="table table-hover">
          <thead>
            <tr>
              <th style="width: 20px;">No.</th>
              <th style="width: 130px;">Category</th>
              <th style="width: 130px;">Subcategory</th>
            </tr>
          </thead>
          <tbody v-sortable.tr="rows">
            <button class="btn btn-primary btn-xs" @click="addRow(rows.length-1)">add row</button>
            <tr v-for="row in rows" track-by="$index">
              <td>
                @{{ $index +1 }}
              </td>
              <td>
                <select class="form-control" v-model="row.category">
                  <option value="0">0%</option>
                  <option value="10">10%</option>
                  <option value="20">20%</option>
                </select>
              </td>
              <td>
                <select class="form-control" v-model="row.tax">
                  <option value="0">0%</option>
                  <option value="10">10%</option>
                  <option value="20">20%</option>
                </select>
              </td>
              <td>
                <button class="btn btn-primary btn-xs" @click="addRow($index)">add row</button>
                <button class="btn btn-danger btn-xs" @click="removeRow($index)">remove row</button>
              </td>
            </tr>
          </tbody>
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
  <script src="https://github.com/TahaSh/vue-dependon/blob/master/vue-dependon.js" type="text/javascript"></script>
  <script>

  var vm = new Vue({
    el: '#app',
    data: {
      rows: [ ],
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
