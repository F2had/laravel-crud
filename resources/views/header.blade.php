 <header>
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
         <div class="container-fluid">

             <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                 aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse" id="navbarNav">
                 <ul class="navbar-nav">
                     <li class="nav-item">
                         <a class="nav-link {{ request()->is('student*') ? 'active' : '' }}" aria-current="page"
                             href="/student">Student</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link {{ request()->is('course*') ? 'active' : '' }}" aria-current="page"
                             href="/course">Course</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link {{ request()->is('enrollment*') ? 'active' : '' }}" aria-current="page"
                             href="/enrollment">Enrollment</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link {{ request()->is('chart*') ? 'active' : '' }}" aria-current="page"
                             href="/chart">Chart</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" aria-current="page" href="/logout"><span
                                 class="text-danger">Logout</span></a>
                     </li>
                 </ul>
             </div>
         </div>
     </nav>
 </header>
