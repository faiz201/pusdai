@extends('backend.v_layouts.app') 
@section('content') 
<!-- contentAwal --> 
 
<div class="row"> 
    <div class="col-12"> 
        <div class="card"> 
            <div class="card-body border-top"> 
                <h5 class="card-title"> {{$judul}}</h5> 
                <div class="alert alert-success" role="alert"> 
                    <h4 class="alert-heading"> Selamat Datang, Squad Pencegahan {{ Auth::user()->nama 
}}</h4> 
                    Aplikasi <b>KITA KUAT</b> merupakan akronim dari <b>K</b>epatuhan <b>I</b>nternal <b>T</b>ools <b>A</b>nalysis <b>KUA</b>dran <b>T</b>erintegrasi. Selamat Bekerja dan Jaga Selalu Integritas ya
                    <b> 
                        @if (Auth::user()->role ==1) 
                        Pengguna
                        @elseif(Auth::user()->role ==0) 
                        Admin 
                        @endif 
                    </b> 
                    Semoga aplikasi <b>KITA KUAT</b> ini dapat membantumu dalam pelaksanaan tugas secara efektif, efisien, dan akuntabel                      
                    <hr> 
                    <p class="mb-0">Tolak dan Laporkan Gratifikasi! Bea Cukai Makin Baik</p> 
                </div> 
            </div> 
        </div> 
    </div> 
</div> 
 
<!-- contentAkhir --> 
@endsection