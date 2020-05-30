<nav class="tabs is-boxed">
    <div class="container">
        <ul>

            <router-link tag='li' to='/' exact>
                <a>Translate</a>
            </router-link>


            <router-link tag='li' to='/support'>
                <a>Contact</a>
            </router-link>

            @if(auth()->user()->name == 'admin')
            <router-link tag='li' to='/admin'>
                <a>Admin</a>
            </router-link>
            @endif

        </ul>
    </div>
</nav>
