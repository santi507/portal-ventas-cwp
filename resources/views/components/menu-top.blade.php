<nav class="navbar navbar-inverse navbar-fixed-top">
  
  <div class="container-fluid">
    
    <div class="navbar-header">
      
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
      <a class="navbar-brand" href="{{ route('admin.index') }}">
        <img src="{{ asset('assets/images/globo-cwp.png') }}" style="height: 100%;display: inline-block;"> {{ config('app.name') }}</a>
    </div>
    
    <div id="navbar" class="navbar-collapse collapse">
      
      <ul class="nav navbar-nav navbar-right">
        @if(isset(session('admin-auth')['name']) && session('admin-auth')['name'])
          <li><a href="#">{{ mb_strtoupper(session()->get('admin-auth')['name'], 'UTF-8') }}</a></li>
        @else
          <li><a href="#">{{ mb_strtoupper(session()->get('admin-auth')['username'], 'UTF-8') }}</a></li>
        @endif
        @if(isset(session('admin-auth')['photo']) && session('admin-auth')['photo'])
          <li>
            <img src="data:image/jpeg;base64,{{ base64_encode(session('admin-auth')['photo']) }}" style="max-width: 50px;" class="photo" />
          </li>
        @else
          <li>
            <img src="{{ asset('assets/images/default-user.png') }}" style="max-width: 50px;" />
          </li>
        @endif
      </ul>
        
      {{-- <form class="navbar-form navbar-right">
        <input type="text" class="form-control" placeholder="Search...">
      </form> --}}
    </div>
  
  </div>
</nav>