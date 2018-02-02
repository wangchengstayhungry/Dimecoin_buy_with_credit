
@extends('layouts.app')

@section('content')
<div class="container">
<div class="profile-body">
	<div class="row" style="height: 50px;"></div>
	<div class="row">
		<p class="faq-title">Frequently Asked Questions</p>
	</div>
	<hr style="margin-top:  -10px;margin-bottom:  60px;">
	<div class="faqs">
		@foreach($faqs as $faq)
		<button class="faq-accordion">{{$faq->question}}<span style="float: right;"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i></span></button>
		<div class="faq-panel">
		  <p>{{$faq->answer}}</p>
		</div>
		@endforeach
		
	</div>
</div>
</div>
<script>
var acc = document.getElementsByClassName("faq-accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("faq-active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>

@endsection