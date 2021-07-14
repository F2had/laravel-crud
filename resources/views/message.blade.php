 <div class="container d-flex justify-content-center text-center">
     <div class="w-25">
         @if (session()->has('message'))
             <div class="alert alert-success alert-dismissible fade show">
                 {{ session()->get('message') }}
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
         @endif
     </div>
 </div>

 <div class="container d-flex justify-content-center text-center">
     <div class="w-25">
         @if (session()->has('error'))
             <div class="alert alert-danger alert-dismissible fade show">
                 {{ session()->get('error') }}
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
         @endif
     </div>
 </div>
