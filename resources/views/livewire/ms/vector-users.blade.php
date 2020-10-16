<div>
  <p class="font-bold">User Similarity via Vector Calculation (Content-Based)</p>
  <p>Alpha User: {{ $result[0] }}</p>
  <div class="grid grid-cols-2 text-center">
    <p>User IDs</p>
    <p>Vector Scores</p>
    @foreach ($result[1] as $res)
      <p>{{ $res['user_id'] }}</p>
      <p>{{ $res['vector_score'] }}</p>
    @endforeach
  </div>
</div>
