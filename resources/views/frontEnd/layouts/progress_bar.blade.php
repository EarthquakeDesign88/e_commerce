<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<div id="steps">
    <div class="step  {{request()-> routeIs('checkout1')? 'active' : '' }}" data-desc="Billing">1</div>
    <div class="step {{request()-> routeIs('checkout2')? 'active' : '' }}" data-desc="Shipping">2</div>
    <div class="step {{request()-> routeIs('checkout3')? 'active' : '' }}" data-desc="Payment">3</div>
    <div class="step {{request()-> routeIs('checkout4')? 'active' : '' }}" data-desc="Review">4</div>
</div>

<style>
  @import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,600);

  $blue: hsl(206,72%,68%);
  $green: hsl(120,42%,54%);
  $white: hsl(0, 0%, 100%);
  $grey: hsl(226,10%,55%);
  $disa: hsl(226,15%,83%);

  body {
    background-color: hsl(0, 0%, 90%);  
    font-family: 'Open Sans', sans-serif;
  }
  #steps {
    width: 505px;
    margin: 50px auto; 
  }

  .step {
    width: 40px;
    height: 40px;
    background-color: $white;
    display: inline-block;
    border: 4px solid;
    border-color: #f86612;
    border-radius: 50%;
    color: #f86612;
    font-weight: 600;
    text-align: center;
    line-height: 35px;
  }


  .step:first-child {
    line-height: 40px;
  }
  .step:nth-child(n+2) {
    margin: 0 0 0 100px;
    transform: translate(0, -4px);
  }
  .step:nth-child(n+2):before {
    width: 75px;
    height: 3px;
    display: block;
    background-color: $white;
    transform: translate(-95px, 21px);
    content: '';  
  }
  .step:after {
    width: 150px;
    display: block;
    transform: translate(-55px, 3px);
    
    color: $grey;
    content: attr(data-desc);
    font-weight: 400;
    font-size: 13px;
  }
  .step:first-child:after {
    transform: translate(-55px, -1px);  
  }
  .step.active {
    border-color: #00bcb4;
    color: #00bcb4;
  }
  .step.active:before {
    background: linear-gradient(to right, $green 0%,
                                          $blue 100%);
  }
  .step.active:after {
    color: $blue;  
  }
  .step.done {
    background-color: $green;
    border-color: $green;
    
    color: $white;
  }
  .step.done:before {
    background-color: $green;  
  }
</style>

<script>
    $(document).ready( function() {
    $('.step').each(function(index, element) {
        // element == this
        $(element).not('.active').addClass('done');
        $('.done').html('<i class="icon-ok"></i>');
        if($(this).is('.active')) {
        return false;
        }
    });    
    });

</script>