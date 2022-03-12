<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="card-body">
                <div class="media">
                    <div class="mr-3">

                    </div>

                    <div class="media-body">
                        <div class="media-title font-weight-semibold">{{ Auth::user()->name }}</div>
                        <div class="font-size-xs opacity-50">
                             <i class="icon-user font-size-sm"></i> &nbsp;{{ strtoupper(str_replace('_', ' ', Auth::user()->role)) }}

                        @if (Qs::userIsLecture()||Qs::userIsHod()||Qs::userIsStudent())

                             <i class=" font-size-sm">in</i> &nbsp;{{  Qs::Check_UserDepartment()}}

                        @endif
                        </div>

                    </div>

                    <div class="ml-3 align-self-center">
                        <a href="#" class="text-white"><i class="icon-cog3"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->
        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item">
                    @if(Qs::userIsAcademic())
                      <a href="{{ route('academic.dashboard') }}" class="nav-link {{  (Route::is('academic.dashboard')) ? 'active' : '' }}">

                        @endif
                        @if(Qs::userIsHod())
                      <a href="{{ route('hod.dashboard') }}" class="nav-link {{  (Route::is('hod.dashboard')) ? 'active' : '' }}">
                        @endif
                        @if (Qs::userIsLecture())
                      <a href="{{ route('lecture.dashboard') }}" class="nav-link {{  (Route::is('lecture.dashboard')) ? 'active' : '' }}">

                        @endif
                        @if (Qs::userIsStudent())
                      <a href="{{ route('student.dashboard') }}" class="nav-link {{  (Route::is('student.dashboard')) ? 'active' : '' }}">

                        @endif
                        <i class="icon-home4"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                 {{--Academics--}}
                 @if(Qs::userIsAcademic())
                 <li class="nav-item">
                    <a href="{{ route('academic.setting') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['academic.setting',]) ? 'active' : '' }}"><i class="icon-gear"></i> <span>Settings</span></a>
                </li>
                <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['academic.department', 'academic.create.department', 'academic.distroy.department','academic.course',
                'academic.rooms','academic.rooms.create','academic.level','academic.level.edit','academic.classRoom','academic.course.edit']) ? 'nav-item-expanded nav-item-open' : ''  }}">
                    <a href="#" class="nav-link"><i class="icon-graduation2"></i> <span> Conceptual</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="Manage Academics">

                    {{--Academic with Department , Course,Rooms,level--}}
                        <li class="nav-item"><a href="{{ route('academic.department') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['academic.department']) ? 'active' : '' }}">Department</a></li>

                        <li class="nav-item"><a href="{{ route('academic.level') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['academic.level','academic.level.edit']) ? 'active' : '' }}">Level</a></li>

                        <li class="nav-item"><a href="{{ route('academic.rooms') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['academic.rooms']) ? 'active' : '' }}">Room</a></li>

                        <li class="nav-item"><a href="{{ route('academic.course') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['academic.course','academic.course.edit']) ? 'active' : '' }}">Course</a></li>
                        <li class="nav-item"><a href="{{ route('academic.classRoom') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['academic.classRoom']) ? 'active' : '' }}">Classes</a></li>

                    </ul>
                </li>
                <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['academic.timeslot','academic.timeslot.store','academic.newtimetable','academic.timetable']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                     <a href="#" class="nav-link  "><i class="icon-table"></i> <span> Time Table</span></a>

                     <ul class="nav nav-group-sub" data-submenu-title="Manage Timetable">

                     {{--Timetables--}}

                     <li class="nav-item"><a href="{{ route('academic.timeslot') }}" class="nav-link  {{ in_array(Route::currentRouteName(), ['academic.timeslot',]) ? 'active' : '' }}">Time Slot</a></li>
                        <li class="nav-item"><a href="{{ route('academic.newtimetable') }}" class="nav-link  {{ in_array(Route::currentRouteName(), ['academic.newtimetable','academic.timetable']) ? 'active' : '' }}">Create New Timetable</a></li>



                     </ul>
                 </li>
                 <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['academic.lecture','academic.hod']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                     <a href="#" class="nav-link  "><i class="icon-user"></i> <span> Users</span></a>

                     <ul class="nav nav-group-sub" data-submenu-title="Manage Users">

                     {{--Timetables--}}
                         <li class="nav-item"><a href="{{ route('academic.hod') }}" class="nav-link  {{ in_array(Route::currentRouteName(), ['academic.hod',]) ? 'active' : '' }}">HOD</a></li>
                         {{-- <li class="nav-item"><a href="{{ route('academic.lecture') }}" class="nav-link  {{ in_array(Route::currentRouteName(), ['academic.lecture',]) ? 'active' : '' }} ">Lecture</a></li> --}}

                     </ul>
                 </li>
                 @endif
                 @if (Qs::userIsHod())
                 <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['hod.level','hod.class']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                     <a href="#" class="nav-link  "><i class="icon-pencil"></i> <span> Academic Views</span></a>

                     <ul class="nav nav-group-sub" data-submenu-title="Manage View">

                     {{--Hod --}}
                         <li class="nav-item"><a href="{{ route('hod.level') }}" class="nav-link  {{ in_array(Route::currentRouteName(), ['hod.level',]) ? 'active' : '' }}">levels</a></li>
                         <li class="nav-item"><a href="{{ route('hod.class') }}" class="nav-link  {{ in_array(Route::currentRouteName(), ['hod.class',]) ? 'active' : '' }}">Class Room</a></li>

                     </ul>
                    </li>
                     <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['hod.lecture','hod.student']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                     <a href="#" class="nav-link  "><i class="icon-user"></i> <span> User</span></a>

                     <ul class="nav nav-group-sub" data-submenu-title="Manage Timetable">

                     {{--Timetables--}}
                         <li class="nav-item"><a href="{{ route('hod.lecture') }}" class="nav-link  {{ in_array(Route::currentRouteName(), ['hod.lecture',]) ? 'active' : '' }}">Lecture</a></li>
                        <li class="nav-item">
                      <a href="{{ route('hod.student') }}" class="nav-link {{  (Route::is('hod.student')) ? 'active' : '' }}">

                        <span>Students Chef</span>
                      </a>
                    </li>
                     </ul>
                    </li>

                 <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['hod.create.course','hod.lecture.course.edit']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                     <a href="#" class="nav-link  "><i class="icon-book"></i> <span> Courses</span></a>

                     <ul class="nav nav-group-sub" data-submenu-title="Manage Timetable">


                         <li class="nav-item"><a href="{{ route('hod.create.course') }}" class="nav-link  {{ in_array(Route::currentRouteName(), ['hod.create.course','hod.lecture.course.edit']) ? 'active' : '' }}">Assign Course to lecture</a></li>

                     </ul>
                    </li>


                    <li class="nav-item">
                      <a href="{{ route('hod.timetable') }}" class="nav-link {{  (Route::is('hod.timetable')) ? 'active' : '' }}">
                        <i class="icon-table"></i>
                        <span>Time Table </span>
                      </a>
                    </li>
                 @endif
                 @if (Qs::userIsLecture())
                  <li class="nav-item">
                      <a href="{{ route('lecture.show') }}" class="nav-link {{  (Route::is('lecture.show')) ? 'active' : '' }}">
                        <i class="icon-book"></i>
                        <span>Course </span>
                      </a>
                    </li>
                     <li class="nav-item">
                      <a href="{{ route('lecture.timetable') }}" class="nav-link {{  (Route::is('lecture.timetable')) ? 'active' : '' }}">
                        <i class="icon-table"></i>
                        <span>Time Table </span>
                      </a>
                    </li>
                     <li class="nav-item">
                      <a href="{{ route('lecture.student') }}" class="nav-link {{  (Route::is('lecture.student')) ? 'active' : '' }}">
                        <i class="icon-user"></i>
                        <span>Students Chef</span>
                      </a>
                    </li>
                 @endif
                 @if (Qs::userIsStudent())
                    <li class="nav-item">
                      <a href="{{ route('student.course') }}" class="nav-link {{  (Route::is('student.course')) ? 'active' : '' }}">
                        <i class="icon-book"></i>
                        <span>Courses </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('student.timetable') }}" class="nav-link {{  (Route::is('student.timetable')) ? 'active' : '' }}">
                        <i class="icon-table"></i>
                        <span>Time Table </span>
                      </a>
                    </li>
                 @endif

            </ul>
        </div>
    </div>
</div>
