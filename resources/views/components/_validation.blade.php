<div class="row">

    <div class="col-md-10 col-md-offset-1" style="margin: 0 auto; text-align: center; list-style: inside;">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="padding-left: 2%">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @elseif (Session::has('success'))
            <div class="alert alert-success alert-dismissable fade in">
                <a href="#" class="close text-default" data-dismiss="alert" aria-label="close">&times;</a>
                <ul style="padding-left: 2%">
                    <li>{{ Session::get('success') }}</li>
                </ul>
            </div>
        @endif
    </div>

</div>
