@if (@$slot == 'finalizado' || @$slot == 'suprimento')
<h5><span class="badge bg-success text-uppercase d-none d-sm-none d-md-block d-lg-block">{{$slot}}</span></h5>
<h5><span class="badge bg-success text-lowercase d-sm-block d-md-none d-lg-none ">{{$slot}}</span></h5>
@elseif (@$slot == 'aberto')
<h5><span class="badge bg-primary text-uppercase d-none d-sm-none d-md-block d-lg-block">{{$slot}}</span></h5>
<h5><span class="badge bg-primary text-lowercase d-sm-block d-md-none d-lg-none">{{$slot}}</span></h5>
@elseif (@$slot == 'atrasado' || @$slot == 'retirada')
<h5><span class="badge bg-danger text-uppercase d-none d-sm-none d-md-block d-lg-block" >{{$slot}}</span></h5>
<h5><span class="badge bg-danger text-lowercase d-sm-block d-md-none d-lg-none">{{$slot}}</span></h5>
@endif
