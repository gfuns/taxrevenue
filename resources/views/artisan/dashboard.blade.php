<p>Welcome Back {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>

<p>The Web Artisan Dashboard is still under development. Please Check Back</p>

<a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><button>LOGOUT</button></a>


<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
