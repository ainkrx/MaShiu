<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark" style="padding: 2rem 2rem 2rem 2rem">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><img src="{{ asset('img/logo.png') }}" alt="" width="35" height="30"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup" style="justify-content: space-between; ">
            <div class="navbar-nav">
                @auth
                    <a class="nav-item nav-link active" href="/home"><i class="fa fa-home"></i> {{__('button.home')}}</a>
                    @if (auth()->user()->role ==='member')
                        <a class="nav-item nav-link" href="/cart"><i class="fa fa-shopping-cart"></i> {{__('button.cart')}}</a>
                        <a class="nav-item nav-link" href="/history"><i class="fa fa-file-text-o"></i> {{__('button.history')}}</a>
                    @endif
                @endauth
            </div>
            <div class="navbar-nav">
                <div class="input-group language">
                    @if (session()->get('locale') == 'en')
                        <a href="/lang/id"><button class="btn btn-outline-secondary" type="button">ID</button></a>
                        <a href="/lang/en"><button class="btn btn-outline-secondary active" type="button">EN</button></a>
                    @else
                        <a href="/lang/id"><button class="btn btn-outline-secondary active" type="button">ID</button></a>
                        <a href="/lang/en"><button class="btn btn-outline-secondary" type="button">EN</button></a>
                    @endif
                </div>
                @auth
                    @if (auth()->user()->role ==='admin')
                        <a class="nav-item nav-link" href="/item/add"><i class="fa fa-plus-circle"></i> {{__('button.add_item')}}</a>
                    @endif
                    @if (auth()->user()->role ==='member')
                        <span class="navbar-text">
                            <b>{{__('text.my_points')}}: {{ number_format(auth()->user()->points, '0', ',', '.') }}</b>
                        </span>
                    @endif
                    <div class="d-flex">
                        <a class="nav-item nav-link" href="/profile"><i class="fa fa-user-circle"></i> {{__('button.profile')}}</a>
                    </div>
                    <div class="d-flex">
                        <a class="nav-item nav-link" href="/logout">{{__('button.logout')}}</a>
                    </div>
                @else
                    <a class="nav-item nav-link" href="/login">Login</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
