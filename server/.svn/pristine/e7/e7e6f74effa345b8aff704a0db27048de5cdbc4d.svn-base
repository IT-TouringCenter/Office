{{--@include('easybook.templates.ticket.watermark')--}}
<div style="background-color: #a8ddf5;padding: 5px 10px 5px 10px;border: 1px dashed #020202;border-radius: 5px;max-width: 360px;margin-bottom: 10px;margin-top:10px">
    @include('easybook.templates.ticket.header')  
    <div>
        {{-- ticket number --}}
        <div style="margin-top: 10px;">
            <div style="width: 105px;float: left;">Ticket Number</div>
            <div>:&nbsp;{{ array_get($ticket,'ticketNumber') }}&nbsp;({{ array_get($ticket,'transferMode') }})</div>
        </div>        
       
        @if(array_get($ticket,'transferMode') =='One Way')
            <div style="margin-top: 10px;">
                @if(array_get($ticket,'isArrival') ==true)                    
                    <div style="width: 105px;float: left;">Arrival</div>
                @else
                    <div style="width: 105px;float: left;">Departure</div>
                @endif

                <div>:&nbsp;{{array_get($ticket,'arrivalFlightNumber')}}&nbsp;({{ array_get($ticket,'arrivalDate') }})</div>
            </div>
        @else
            {{-- arival flight detail --}}
             <div style="margin-top: 10px;">            
                <div style="width: 105px;float: left;">Arrival</div>           
                <div>:&nbsp;{{array_get($ticket,'arrivalFlightNumber')}}&nbsp;({{ array_get($ticket,'arrivalDate') }})</div>
            </div>

             {{-- departure flight detail --}}
             <div style="margin-top: 10px;">                        
                <div style="width: 105px;float: left;">Departure</div>            
                <div>:&nbsp;{{array_get($ticket,'departureFlightNumber')}}&nbsp;({{ array_get($ticket,'departureDate') }})</div>
            </div>
        @endif

        {{-- hotel --}}
        <div style="margin-top: 10px;">
            <div style="width: 105px;float: left;">Hotel</div>
            <div>:&nbsp;{{ array_get($ticket,'hotelName') }}</div>
        </div>

    </div>
    @include('easybook.templates.airport.footer')
</div>