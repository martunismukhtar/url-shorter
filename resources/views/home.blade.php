<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bitly.site') }}</title>

    <!-- Scripts -->

    <script src="{{ asset('js/jquery-3.5.1.min.js') }}" defer></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
    // getlink();

        function getlink(){

            $.ajax({
               type:'get',
               url:'/home/getdata',
               dataType: 'JSON',
               headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
               success:function(data) {
                   $('#list-tab').html(data[0]);
                   $('#nav-tabContent').html(data[1]);
                //  console.log(data)
                //   $("#short_link").val(data);
               }
            });
            
            // $.ajax({
            //    type:'POST',
            //    url:'/home/getdata',
            //    headers: {
            //           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //       },
            //    success:function(data) {
            //     //    console.log(data)
            //       $("#list-tab").val(data);
            //    }
            // });
        }

        function store() {
            $long_link = $('#long_link').val();
            $title = $('#title').val();
            $short_link = $('#short_link').val();

            error = true;
            if(!$long_link) {
                $('#long_link').addClass('has-error');
            } else {
                error = false;
                $('#long_link').removeClass('has-error');
            }
            // if(!$title) {
            //     $('#title').addClass('has-error');
            // } else {
            //     error = false;
            //     $('#title').removeClass('has-error');
            // }
            if(!$short_link) {
                $('#short_link').addClass('has-error');
            } else {
                error = false;
                $('#short_link').removeClass('has-error');
            }

            $('.store').html('sedang menyimpan data...');
            if(!error) {
                $.ajax({
                    type:'POST',
                    url:'/home/store',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{
                        long_link:$long_link,
                        title:$title,
                        short_link:$short_link,
                    },
                    success:function(data) {
                        if(data!=1) {
                            alert(data)
                        } else {
                            $('#exampleModal').modal('hide');
                            $('.store').html('Save');
                            getlink()
                        }
                       
                    }
                });
            }

            // alert($long_link)
        }

        function getcode(){
            $.ajax({
               type:'POST',
               url:'/home/code',
               headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
               success:function(data) {
                   console.log(data)
                  $("#short_link").val(data);
               }
            });
        }

        function edit(id) {
            $.ajax({
                    type:'POST',
                    url:'/home/getdatabyid',
                    dataType: 'JSON',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{
                        id:id,
                    },
                    success:function(data) {

                        $('#elong_link').val(data.long_link);
                        $('#etitle').val(data.title);
                        $('#eshort_link').val(data.short_name);
                        $('#eid').val(data.id);

                        $('#editModal').modal('show');

                        console.log(data)
                        // if(data!=1) {
                        //     alert(data)
                        // } else {
                        //     $('#editModal').modal('hide');
                        //     getlink()
                        // }
                       
                    }
                });
        }

        function storeedit() {
            $id = $('#eid').val();
            $long_link = $('#elong_link').val();
            $title = $('#etitle').val();
            $short_link = $('#eshort_link').val();
            // $id = $('#eid').val();

            error = true;
            if(!$long_link) {
                $('#elong_link').addClass('has-error');
            } else {
                error = false;
                $('#elong_link').removeClass('has-error');
            }
            // if(!$title) {
            //     $('#etitle').addClass('has-error');
            // } else {
            //     error = false;
            //     $('#etitle').removeClass('has-error');
            // }
            if(!$short_link) {
                $('#eshort_link').addClass('has-error');
            } else {
                error = false;
                $('#eshort_link').removeClass('has-error');
            }

            if(!error) {
                $.ajax({
                    type:'POST',
                    url:'/home/storeedit',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{
                        long_link:$long_link,
                        title:$title,
                        short_link:$short_link,
                        id:$id
                    },
                    success:function(data) {
                        if(data!=1) {
                            alert(data)
                        } else {
                            $('#editModal').modal('hide');
                            getlink()
                        }
                       
                    }
                });
            }
        }

        function copy() {
            // var copyText = $('.linkshortlink').text()
            
            var copyTextarea = document.querySelector('#linkshortlink');
            copyTextarea.select();

            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';
                console.log('Copying text command was ' + msg);
            } catch (err) {
                console.log('Oops, unable to copy');
            }

        }
        function copytoclipboard(streamitem_id) {
      /* Get the text field */
      var streamitem_id=streamitem_id;
      var copyText = document.getElementsByClassName('copyclip'+streamitem_id)[0];
    
      /* Select the text field */
      copyText.select();
    
      /* Copy the text inside the text field */
      document.execCommand("copy");
    
      /* Alert the copied text */
      alert("Copied the text: " + copyText.value);
    }
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bitly.css') }}" rel="stylesheet">
</head>
<body>
 
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-yy  btn-sm">Create</button>
                                </a>
                            </li>
                        
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
               
                <div class="row">
                    <div class="col-4 divLeft">
                        <div class="list-group" id="list-tab" role="tablist">
                        @php
                            $active='active'
                        @endphp
                        
                        @foreach ($link as $lk)
                           
                            <a class="list-group-item list-group-item-action {{$active}}" 
                                id="list-{{$lk->id}}-list" data-toggle="list" href="#list-{{$lk->id}}" 
                                role="tab" aria-controls="home">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{$lk->title}}</h5>
                                    <small>{{ Carbon\Carbon::parse($lk->created_at)->format('d-m-Y') }}</small>
                                </div>
                                <small class="small-link">{{$lk->short_link}}</small>
                            </a>
                            {{$active=''}}
                        @endforeach
                            <!-- <a class="list-group-item list-group-item-action active" 
                                id="list-home-list" data-toggle="list" href="#list-home" 
                                role="tab" aria-controls="home">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">List group item heading</h5>
                                    <small>3 days ago</small>
                                </div>
                                <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                <small>Donec id elit non mi porta.</small>
                            </a>
                            <a class="list-group-item list-group-item-action" id="list-profile-list" 
                                data-toggle="list" href="#list-profile" 
                                role="tab" aria-controls="profile">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">List group item heading</h5>
                                    <small class="text-muted">3 days ago</small>
                                </div>
                                <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                <small class="text-muted">Donec id elit non mi porta.</small></a>
                            <a class="list-group-item list-group-item-action" id="list-messages-list" 
                                data-toggle="list" href="#list-messages" role="tab" 
                                aria-controls="messages">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">List group item heading</h5>
                                    <small class="text-muted">3 days ago</small>
                                </div>
                                <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                <small class="text-muted">Donec id elit non mi porta.</small>
                            </a> -->
    
                        </div> 
                    </div>
                    <div class="col-8 detail">
                        <div class="tab-content" id="nav-tabContent">
                        @php
                            $active_d='active'
                        @endphp
                        @foreach ($link as $lk)

                            <div class="tab-pane fade show {{$active_d}}" id="list-{{$lk->id}}" 
                                role="tabpanel" aria-labelledby="list-{{$lk->id}}-list"
                                style="margin-top: 15px;"
                                >

                                <div class="wrapper row">
                                  
                                    <div class="details col-md-12">
                                        <h3 class="product-title"></h3>
                                        <h3 class="product-title">{{$lk->title}}</h3>
                                        <a target="_blank" href="{{$lk->short_link}}"><p class="vote">{{$lk->long_link}}</p></a>
                                        <br>
                                        <div>
                                            <a class='a-ref' target="_blank" href="{{$lk->short_link}}">
                                                <input type="hidden" value="{{$lk->short_link}}" id="linkshortlink">
                                                <p class="vote">{{$lk->short_link}}</p></a>
                                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="edit({{$lk->id}})">Edit</button>
                                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="copy()">Copy</button>
                                        </div>
                                        <hr>
                                        <div class="item-detail--click-stats-wrapper"><div class="info-wrapper--user-clicks"><div class="info-wrapper--header"><span class="info-wrapper--clicks-text">{{$lk->jlh_click_link}} <i class='far fa-chart-bar'></i></span><span class="icon clicks-icon"></span></div><div class="item-detail--selected-day">total clicks</div></div></div>
                                    </div>
                                </div>

                            </div>
                            {{$active_d=''}}
                        @endforeach

                            <div class="tab-pane fade" id="list-profile" role="tabpanel" 
                                aria-labelledby="list-profile-list">
                                Cupidatat quis ad sint excepteur laborum in esse qui. Et excepteur consectetur ex nisi eu do 
                                cillum ad laborum. Mollit et eu officia dolore sunt Lorem culpa qui commodo velit ex amet id ex. 
                                Officia anim incididunt laboris deserunt anim aute dolor incididunt veniam aute dolore 
                                do exercitation. Dolor nisi culpa ex ad irure in elit eu dolore. Ad laboris ipsum reprehenderit 
                                irure non commodo enim culpa commodo veniam incididunt veniam ad.
                            </div>
                            <div class="tab-pane fade" id="list-messages" role="tabpanel" 
                                aria-labelledby="list-messages-list">
                                Ut ut do pariatur aliquip aliqua aliquip exercitation do nostrud commodo reprehenderit aute 
                                ipsum voluptate. Irure Lorem et laboris nostrud amet cupidatat cupidatat anim do ut velit 
                                mollit consequat enim tempor. Consectetur est minim nostrud nostrud consectetur irure labore 
                                voluptate irure. Ipsum id Lorem sit sint voluptate est pariatur eu ad cupidatat et deserunt 
                                culpa sit eiusmod deserunt. Consectetur et fugiat anim do eiusmod aliquip nulla laborum elit 
                                adipisicing pariatur cillum.
                            </div>
                       
                        </div>
                    </div>
                    
                </div>
            </div> 
        
        </main>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" 
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Link</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form onsubmit="return false;">
                <div class="modal-body">
                
                    <div class="form-group">
                        <label for="exampleInputEmail1">Long Link</label>
                        <input type="hidden" name="id" id="eid">
                        <textarea class="form-control" onblur="getcode()" name="long_link" id="elong_link" rows="3"></textarea>
                        <small id="long_linkHelp" class="form-text text-muted">Please input the url.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Title</label>
                        <input type="text" class="form-control" id="etitle" name="title" placeholder="Title">
                        <small id="titleHelp" class="form-text text-muted">Please input the title.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Short Link</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">bitly.site/</span>
                            </div>
                            <input type="text" name="short_link" class="form-control" id="eshort_link" 
                                aria-describedby="basic-addon3">
                            
                        </div>
                        
                        <!-- <input type="text" name="short_link" class="form-control" 
                            placeholder="Short Link"
                            value="bit.ly/"> -->
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" onclick="storeedit()"  class="btn btn-primary save">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" 
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Link</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form onsubmit="return false;">
                <div class="modal-body">
                
                    <div class="form-group">
                        <label for="exampleInputEmail1">Long Link</label>
                        <textarea class="form-control" onblur="getcode()" name="long_link" id="long_link" rows="3"></textarea>
                        <small id="long_linkHelp" class="form-text text-muted">Please input the url.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                        <small id="titleHelp" class="form-text text-muted">Please input the title.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Short Link</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">bitly.site/</span>
                            </div>
                            <input type="text" name="short_link" class="form-control" id="short_link" 
                                aria-describedby="basic-addon3">
                            
                        </div>
                        
                        <!-- <input type="text" name="short_link" class="form-control" 
                            placeholder="Short Link"
                            value="bit.ly/"> -->
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" onclick="store()"  class="btn btn-primary save store">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
