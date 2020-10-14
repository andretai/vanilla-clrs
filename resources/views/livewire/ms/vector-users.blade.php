<div>
  <p class="font-bold">User Similarity via Vector Calculation by Favourites (Content-Based)</p>
  <p>Alpha User: {{ $alpha }}</p>
  <div class="grid grid-cols-2 text-center">
    <p>User IDs</p>
    <p>Vector Scores</p>
    @foreach ($result as $res)
      <p>{{ $res['user_id'] }}</p>
      <p>{{ $res['vector_score'] }}</p>
    @endforeach
  </div>
</div>
