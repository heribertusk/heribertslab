@extends('layouts.default')
@section('content')
<div class="container" id="app">
  <!--
  <table class="table table-hover">
    <thead>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="employee in employees">
        <td>
          @{{ employee.first_name }}
        </td>
        <td>
          @{{ employee.last_name }}
        </td>
      </tr>
    </tbody>
  </table>
  <v-paginator :resource_url="resource_url"></v-paginator>
  -->

  <pre>@{{ $data | json }}</pre>

</div>

@stop
@section('scripts')
<script>
new Vue({
  el: '#app',
});
</script>
@stop
