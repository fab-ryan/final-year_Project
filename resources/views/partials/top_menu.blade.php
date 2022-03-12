<div class="navbar navbar-expand-md navbar-dark ">
    <div class="mt-2 mr-5">
        <a href="#" class="d-inline-block">
        <h4 class="text-bold text-white text-3xl align-text-between">ATTS</h4>
        <h6 class=" text-bold text-white text-xs">({{ Qs::applicationName() }})</h6>
        </a>
    </div>
  {{--  <div class="navbar-brand">
        <a href="index.html" class="d-inline-block">
            <img src="#" alt="">
        </a>
    </div>  --}}

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>


        </ul>

			<span class="navbar-text ml-md-3 mr-md-auto"></span>

        <ul class="navbar-nav">

            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <img style="width: 38px; height:38px;" src="{{ asset('images/user.png') }}" class="rounded-circle" alt="photo">
                     <span>{{ Auth::user()->name }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    @if(Qs::userIsAcademic())
                     <a href="{{ route('academic.user.edit',Auth::user()->id) }}" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
                     @elseif (Qs::userIsHod())
                     <a href="{{ route('hod.user.edit',Auth::user()->id) }}" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
                    @elseif (Qs::userIsLecture())
                     <a href="{{ route('lecture.user.edit',Auth::user()->id) }}" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
                    @elseif (Qs::userIsStudent())
                     <a href="{{ route('student.user.edit',Auth::user()->id) }}"class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
                    @else
                    No User Is There
                     @endif
                    <div class="dropdown-divider"></div>
                    @if(Qs::userIsAcademic())
                    <a href="{{ route('academic.setting') }}" class="dropdown-item"><i class="icon-cog5"></i> Account settings</a>
                    @endif
                    <a href="#" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</div>
