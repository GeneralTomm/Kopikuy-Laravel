@extends('admin.dashboard')
@section('content')
<br>
<div class="container-fluid">
    <div class="col-md-3">
        <a href="/admin/rekap/data" class="btn btn-sm btn-cokelat-muda col">back</a>
    </div>
    <br>
    <div class="col">
        <div class="row">
            @foreach ($data as $item)
                <div class="col-md-3 mb-3">
                    <div class="card shadow">
                        <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                         <center>
                            <img
                            src="/storage/{{$item->image}}"
                            class="img-fluid mt-2"
                            style="max-height:200px;max-width:200px;"
                          />
                         </center>
                          <a href="#!">
                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                          </a>
                        </div>
                        <div class="card-body">
                          <h5 class="card-title">{{$item->product}}</h5>
                         <p>Quantity : {{$item->quantity}}</p>
                        </div>
                      </div>
                </div>
            @endforeach
        </div>
    </div>
</div>