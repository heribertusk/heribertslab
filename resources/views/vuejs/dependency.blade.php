<html>
<head>
  <title>Dependency Combobox Vuejs</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
  <a href="/"><< Back to Home</a>
  <div class="container">
    <div class="panel-body" id="app">
      <table class="table table-hover">
        <thead>
          <tr>
            <th style="width: 20px;">No.</th>
            <th style="width: 130px;">Category</th>
            <th style="width: 130px;">Subcategory</th>
            <th style="width: 60px;">Checkbox</th>
          </tr>
        </thead>
        <tbody>
          <button class="btn btn-primary btn-xs" @click="addRow(rows.length-1)">add row</button>
          <tr v-for="row in rows" track-by="$index">
            <td>
              @{{ $index +1 }}
            </td>
            <td>
              <select v-model="row.selectedCategory" id="category" @change="changeItem($index, $event)">
                <option v-for="category in categories" v-bind:value="category.id">
                  @{{ category.name }}
                </option>
              </select>
            </td>
            <td>
              <select v-model="row.selectedSubCategory" id="subcategory">
                <option v-for="item in subcategories | filterBy row.selectedCategory in 'category_id'" v-bind:value="item.id">
                  @{{ item.name }}
                </option>
              </select>
            </td>
            <td>
              <!--<input type="checkbox" v-model="row.checkbox">-->
              <input type="radio" value="@{{$index}}" v-model="radioDefault">
            </td>
            <td>
              <button class="btn btn-primary btn-xs" @click="addRow($index)">add row</button>
              <button class="btn btn-danger btn-xs" @click="removeRow($index)">remove row</button>
            </td>
          </tr>
        </tbody>
      </table>
      <button @click="postData()">SUBMIT DATA</button>
      <pre>@{{ $data | json }}</pre>
    </div>
  </div>

  <!--javascript-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" type="text/javascript"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.27/vue.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.0/vue-resource.js" type="text/javascript"></script>

  <script>
  var token = "{{ Session::getToken() }}";
  var vm = new Vue({
    el: '#app',
    data: {
      radioDefault: 0,
      rows: [],
      categories: [],
      subcategories: []
    },
    ready: function() {
      this.initCategories();
    },
    methods: {
      addRow: function (index) {
        try {
          this.rows.splice(index + 1, 0, {"checkbox": false});
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
        this.$http.get('/api/categories').then((response) => {
          // success callback
          this.$set('categories', response.data.categories)
        }, (response) => {
          // error callback
        });
        this.$http.get('/api/subcategories').then((response) => {
          // success callback
          this.$set('subcategories', response.data.subcategories)
        }, (response) => {
          // error callback
        });
      },
      postData: function () {
        $.ajax({
          context: this,
          type: "POST",
          data: {
            _token: token,
            rows: JSON.stringify(this.rows),
          },
          url: "/api/testpost"
        });
      },
      changeItem(rowId, event) {
        var message = "Category Index : " +rowId+" change to "+event.target.value;
        Vue.delete(this.rows[rowId], 'selectedSubCategory');        
      }
    }
  });
  </script>
</body>
</html>
